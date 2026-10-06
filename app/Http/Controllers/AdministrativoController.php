<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reparacion;
use App\Models\DetalleReparacion;
use App\Models\Factura;
use App\Models\ConfiguracionFactura;

use Illuminate\Support\Facades\Mail;
use Dompdf\Dompdf;
use Dompdf\Options;
use DateTime;

class AdministrativoController extends Controller
{
    // Metodo para cargar la vista con las reparaciones que no tienen factura, con la opcion de realizar la factura
    public function makeInvoice(){

        $repairs = Reparacion::join('usuarios', 'reparaciones.id_usuario', '=', 'usuarios.id')
                ->join('detalles_reparacion', 'reparaciones.id', '=', 'detalles_reparacion.id_reparacion')
                ->with('vehiculoMaquina.categoria')
                ->whereNull('detalles_reparacion.id_factura')
                ->orderBy('reparaciones.fecha_entrada', 'asc')
                ->distinct('reparaciones.id')
                ->select('reparaciones.*', 'usuarios.nombre')
                ->paginate(10);

        return view('paginas.administrativo.make_invoice', compact('repairs'));
    }
    
    // Metodo para cargar la vista con la reparacion seleccionada y sus detalles asociados
    public function invoiceCompleted($id){

        $repair = Reparacion::find($id);

        if (!$repair) {
            return redirect()->route('make_invoice')->with('error', 'Reparación no encontrada.');
        }

        // Obtener los detalles asociados a la reparación
        $detalles = DetalleReparacion::where('id_reparacion', $id)->get();

        // Verificar si no hay detalles
        if($detalles->isEmpty()){
            return redirect()->route('make_invoice')->with('error', 'Reparación no encontrada. Solo puedes seleccionar una de las siguientes');
        }

        // Verificar si la reparacion ya tiene la factura realizada
        $facturaExistente = $detalles->firstWhere('id_factura', '!=', null);

        if ($facturaExistente) {
            return redirect()->route('make_invoice')->with('error', 'Esta reparación ya tiene una factura asociada.');
        }
        
        // Obtener los datos del iva y el precio de la mano de obra de la tabla auxiliar configuracion_factura
        $dato_factura = ConfiguracionFactura::first();

        return view('paginas.administrativo.invoice_completed', compact('repair', 'detalles', 'dato_factura'));
    }

    // Metodo para crear la factura de la reparacion seleccionada y actualizacion de los detalles con los campos rellenados para hacer la factura
    public function addInvoice($id, Request $request){

        $validatedData = request()->validate([
            'descripcion' => 'required|array',
            'descripcion.*' => 'required|string',
            'cantidad' => 'required|array',
            'cantidad.*' => 'required|numeric|min:1',
            'precio' => 'required|array',
            'precio.*' => 'required|numeric',
            'iva' => 'required|array',
            'iva.*' => 'required|numeric',
            'descuento' => 'required|array',
            'descuento.*' => 'required|numeric',
            'precio_total' => 'required|array',
        ]);
        
        // Creamos una factura nueva
        $factura = Factura::create([
            'fecha_emision' => today(),
            'estado' => 'pendiente',
            'total_factura' => $request->precio_total_factura,
            'id_usuario' => auth()->id(),
        ]);

        // Array para mostrar los detalles en la factura pdf
        $detallesFactura = [];

        // Inicializamos las variables para las sumas de  las cantidades descuento, iva y precio_unidad para la factura
        $totalDescuento = 0;
        $totalIva = 0;
        $baseImponible = 0;

        foreach ($request->descripcion as $index => $descripcion) {

            // Buscar el detalle de la reparación que se va a actualizar
            $detalle = DetalleReparacion::where('id_reparacion', $id)
                                        ->where('id', $request->id_detalle[$index])
                                        ->first();
    
            if ($detalle) {

                // Calculamos el precio por la cantidad
                $precio_base_imponible = ($request->cantidad[$index] * $request->precio[$index]);

                // Calculamos el descuento
                $descuento = ($request->cantidad[$index] * $request->precio[$index]) * ($request->descuento[$index] / 100);
    
                // Calculamos el IVA
                $iva = (($request->cantidad[$index] * $request->precio[$index]) - $descuento) * ($request->iva[$index] / 100);
    
                // Calculamos el precio total
                $precioTotal = ($request->cantidad[$index] * $request->precio[$index]) - $descuento + $iva;

                // Sumamos las cantidades a las variables
                $totalDescuento += $descuento;
                $totalIva += $iva;
                $baseImponible += $precio_base_imponible;

                // Guardamos el detalle en el array
                $detallesFactura[] = [
                    'descripcion' => $descripcion,
                    'cantidad' => $request->cantidad[$index],
                    'precio_unidad' => $request->precio[$index],
                    'descuento_por' => $request->descuento[$index],
                    'descuento' => $descuento,
                    'iva' => $iva,
                    'precio_total' => $precioTotal,
                    'precio_base_imponible' => $precio_base_imponible,
                ];
    
                // Actualizamos los campos del detalle
                $detalle->update([
                    'descripcion' => $descripcion,
                    'cantidad' => $request->cantidad[$index],
                    'precio_unidad' => $request->precio[$index],
                    '%_iva' => $request->iva[$index],
                    'iva' => $iva,
                    '%_descuento' => $request->descuento[$index],
                    'descuento' => $descuento,
                    'precio_total' => $precioTotal,
                    'id_factura' => $factura->id,
                ]);
            }
        }

        // Obtenemos la reparacion seleccionada
        $repair = Reparacion::findOrFail($id);

        // Obtener el correo del propietario del vehículo o maquinaria
        $propietarioEmail = $repair->vehiculoMaquina->usuario->email;

        // Obtenemos el iva de la tabla auxiliar
        $dato_factura = ConfiguracionFactura::first();

        // Embeber la imagen para que aparezca en el email y en la factura
        $imagePath = storage_path('app/public/imagenes/logo_repar.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        // Enviar el correo sin necesidad de crear un Mailable
        $data = [
            'cliente_nombre' => $repair->vehiculoMaquina->usuario->nombre,
            'cliente_direccion' => $repair->vehiculoMaquina->usuario->direccion,
            'cliente_telefono' => $repair->vehiculoMaquina->usuario->telefono,
            'vehiculo' => $repair->VehiculoMaquina->marca . ' ' . $repair->VehiculoMaquina->modelo,
            'matricula' => $repair->VehiculoMaquina->matricula,
            'fecha_emision' => today()->format('d-m-Y'),
            'precio_factura' => $request->precio_total_factura . '€',
            'logo_url' => $imageSrc,
            'detalles' => $detallesFactura,
            'iva_porcentaje' => $dato_factura->iva,
            'total_descuento' => $totalDescuento,
            'total_iva' => $totalIva,
            'baseImponible' => $baseImponible,
        ];

        // Configuración de Dompdf
        $dompdf = new Dompdf();

        // Cargar la vista HTML para generar el PDF
        $html = view('plantillas.factura', $data)->render();
        $dompdf->loadHtml($html);

        // Configurar opciones de Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Renderizar el PDF
        $dompdf->render();

        $facturaDirectory = storage_path('app/public/facturas');

        if (!file_exists($facturaDirectory)) {
            mkdir($facturaDirectory, 0777, true); // Crear el directorio si no existe
        }

        $path = storage_path('app/public/facturas/factura_' . $factura->id . '.pdf');
        file_put_contents($path, $dompdf->output());

        // Enviar el correo
        Mail::send(
            'paginas.administrativo.email_invoice_completed',
            $data,
            function ($message) use ($propietarioEmail, $path) {
                $message->to($propietarioEmail)
                        ->subject('Factura Completada')
                        ->attach($path, [
                            'as' => 'factura.pdf', // Nombre con el que se enviará el archivo
                            'mime' => 'application/pdf', // Tipo MIME del archivo
                        ]);
            }
        );

        // Url de la factura para poder verla una vez se crea y redirige a la vista make_invoice
        $invoice_url = asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/storage/app/public/facturas/factura_' . $factura->id . '.pdf');

        return redirect()->route('make_invoice', $repair->id)->with('status', 'Factura creada correctamente')->with('invoice_url', $invoice_url);
    }

    // Metodo para cargar la vista para ver las facturas
    public function viewInvoice(Request $request) {

        $invoices = Factura::with('detalleReparacion.reparacion.vehiculoMaquina.categoria')
                ->orderBy('fecha_emision', 'desc')
                ->paginate(10);
    
        return view('paginas.administrativo.view_invoice', compact('invoices'));
    }
    
    // Metodo para buscar las facturas de un cliente el cual buscamos
    public function invoicesClient(Request $request) {
        $userId = $request->input('user_id');
    
        // Si se pasa un ID de usuario, filtrar las facturas por ese usuario
        if ($userId) {
            $invoices = Factura::with('detalleReparacion.reparacion.vehiculoMaquina.usuario', 'detalleReparacion.reparacion.vehiculoMaquina.categoria')
                ->whereHas('detalleReparacion.reparacion.vehiculoMaquina.usuario', function($query) use ($userId) {
                    $query->where('id', $userId);
                })
                ->orderBy('fecha_emision', 'desc')
                ->paginate(10);
        } else {
            // Si no se pasa un ID, simplemente mostrar todas las facturas
            $invoices = Factura::with('detalleReparacion.reparacion.vehiculoMaquina.categoria')
                ->orderBy('fecha_emision', 'desc')
                ->paginate(10);
        }
    
        // Solo devolver la tabla de facturas
        return response()->json([
            'table' => view('paginas.administrativo.partials.invoice_table', compact('invoices'))->render(),
            'pagination' => view('pagination::bootstrap-4', ['paginator' => $invoices])->render(),
            'total' => $invoices->total(),
            'from' => $invoices->firstItem(),
            'to' => $invoices->lastItem(),
        ]);
    }
    
    // Método AJAX para buscar usuarios
    public function searchInvoices(Request $request)
    {
        $query = $request->input('query');

        $usuarios = User::where('nombre', 'like', "%$query%")
                    ->orWhere('usuario', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%")
                    ->orWhere('telefono', 'like', "%$query%")
                    ->get();

        return response()->json($usuarios);
    }

    // Metodo para cargar la factura en PDF en el navegador
    public function viewInvoicePDF($id){

        // Obtenemos la factura
        $factura = Factura::findOrFail($id);

        // Obtenemos los detalles de la reparacion
        $details_repair = $factura->detalleReparacion;
        
        // Creamos un array para guardar los detalles de la factura
        $detallesFactura = [];

        // Inicializamos las variables para las sumas de  las cantidades descuento, iva y precio_unidad para la factura
        $totalDescuento = 0;
        $totalIva = 0;
        $baseImponible = 0;

        foreach ($details_repair as $detalle) {

            $detallesFactura[] = [
                'descripcion' => $detalle->descripcion,
                'cantidad' => $detalle->cantidad,
                'precio_unidad' => $detalle->precio_unidad,
                'descuento_por' => $detalle->getAttribute('%_descuento'),
                'descuento' => $detalle->descuento,
                'iva' => $detalle->iva,
                'precio_total' => $detalle->precio_total,
                'precio_base_imponible' => ($detalle->cantidad * $detalle->precio_unidad),
            ];

            // Sumamos las cantidades a las variables
            $totalDescuento += $detalle->descuento;
            $totalIva += $detalle->iva;
            $baseImponible += ($detalle->cantidad * $detalle->precio_unidad);

        }
        
        // Obtenemos el primer detalle de la factura
        $primer_detalle = $details_repair->first();

        // Obtenemos el vehiculo o maquina
        $vehiculo_maquina = $primer_detalle->reparacion->vehiculoMaquina;

        // Obtenemos el usuario al que pertenece la factura
        $user = $primer_detalle->reparacion->vehiculoMaquina->usuario;

        // Obtenemos el iva de la tabla auxiliar
        $dato_factura = ConfiguracionFactura::first();

        // Embeber la imagen para que aparezca en el email y en la factura
        $imagePath = storage_path('app/public/imagenes/logo_repar.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        // Enviamos los datos a la factura
        $data = [
            'cliente_nombre' => $user->nombre,
            'cliente_direccion' => $user->direccion,
            'vehiculo' => $vehiculo_maquina->marca . ' ' . $vehiculo_maquina->modelo,
            'matricula' => $vehiculo_maquina->matricula,
            'fecha_emision' => (new DateTime($factura->fecha_emision))->format('d-m-Y'),
            'precio_factura' => $factura->total_factura . '€',
            'logo_url' => $imageSrc,
            'detalles' => $detallesFactura,
            'iva_porcentaje' => $dato_factura->iva,
            'total_descuento' => $totalDescuento,
            'total_iva' => $totalIva,
            'baseImponible' => $baseImponible,
        ];

        // Configuración de Dompdf
        $dompdf = new Dompdf();

        // Cargar la vista HTML con los datos
        $html = view('plantillas.factura', $data)->render();

        // Inicializar dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Cargar el HTML en dompdf
        $dompdf->loadHtml($html);

        // (Opcional) Definir el tamaño del papel
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar el PDF
        $dompdf->render();

        // Mostrar el archivo PDF en el navegador
        return $dompdf->stream('factura_' . $factura->id . '.pdf', ['Attachment' => 0]);
    }

    // Metodo para mostrar las facturas que se pueden editar que son las pendientes de pago
    public function selectInvoice(){

        $invoices = Factura::with('detalleReparacion.reparacion.vehiculoMaquina.categoria')
                ->orderBy('fecha_emision', 'desc')
                ->where('estado', 'pendiente')
                ->paginate(10);
    
        return view('paginas.administrativo.select_invoice', compact('invoices'));
    }

    // Metodo para mostrar la factura seleccionada para editar con los detalles
    public function editInvoice($id){

        $invoice = Factura::find($id);

        // Si no se encuentra ninguna factura
        if (!$invoice) {
            return redirect()->route('select_invoice')->with('error', 'Factura no encontrada.');
        }

        // Obtener los detalles asociados a la factura
        $detalles = DetalleReparacion::where('id_factura', $id)->get();

        // Verificar si no hay detalles
        if($detalles->isEmpty()){
            return redirect()->route('select_invoice')->with('error', 'Factura no encontrada. Solo puedes seleccionar una de las siguientes');
        }

        // Verificar si la factura esta ya pagada
        if($invoice->estado === 'pagada'){
            return redirect()->route('select_invoice')->with('error', 'La factura esta ya pagada. Solo puedes seleccionar una de las siguientes');
        }

        return view('paginas.administrativo.edit_invoice', compact('invoice', 'detalles'));
    }

    // Metodo para actualizar la factura y los detalles de la factura
    public function updateInvoice($id, Request $request){

        $validatedData = request()->validate([
            'descripcion' => 'required|array',
            'descripcion.*' => 'required|string',
            'cantidad' => 'required|array',
            'cantidad.*' => 'required|numeric|min:1',
            'precio' => 'required|array',
            'precio.*' => 'required|numeric',
            'iva' => 'required|array',
            'iva.*' => 'required|numeric',
            'descuento' => 'required|array',
            'descuento.*' => 'required|numeric',
            'precio_total' => 'required|array',
        ]);

        // Obtenemos la factura
        $invoice = Factura::find($id);

        // Obtenemos el primer detalle de la factura
        $primer_detalle = $invoice->detalleReparacion->first();

        // Obtenemos la reparacion seleccionada
        $repair = $primer_detalle->reparacion;

        // Array para mostrar los detalles en la factura pdf
        $detallesFactura = [];

        // Inicializamos las variables para las sumas de  las cantidades descuento, iva y precio_unidad para la factura
        $totalDescuento = 0;
        $totalIva = 0;
        $baseImponible = 0;

        foreach ($request->descripcion as $index => $descripcion) {

            // Buscar el detalle de la reparación que se va a actualizar
            $detalle = DetalleReparacion::where('id_reparacion', $repair->id)
                                        ->where('id', $request->id_detalle[$index])
                                        ->first();
    
            if ($detalle) {

                // Calculamos el precio por la cantidad
                $precio_base_imponible = ($request->cantidad[$index] * $request->precio[$index]);

                // Calculamos el descuento
                $descuento = ($request->cantidad[$index] * $request->precio[$index]) * ($request->descuento[$index] / 100);
    
                // Calculamos el IVA
                $iva = (($request->cantidad[$index] * $request->precio[$index]) - $descuento) * ($request->iva[$index] / 100);
    
                // Calculamos el precio total
                $precioTotal = ($request->cantidad[$index] * $request->precio[$index]) - $descuento + $iva;

                // Sumamos las cantidades a las variables
                $totalDescuento += $descuento;
                $totalIva += $iva;
                $baseImponible += $precio_base_imponible;

                // Guardamos el detalle en el array
                $detallesFactura[] = [
                    'descripcion' => $descripcion,
                    'cantidad' => $request->cantidad[$index],
                    'precio_unidad' => $request->precio[$index],
                    'descuento_por' => $request->descuento[$index],
                    'descuento' => $descuento,
                    'iva' => $iva,
                    'precio_total' => $precioTotal,
                    'precio_base_imponible' => $precio_base_imponible,
                ];
    
                // Actualizamos los campos del detalle
                $detalle->update([
                    'descripcion' => $descripcion,
                    'cantidad' => $request->cantidad[$index],
                    'precio_unidad' => $request->precio[$index],
                    '%_iva' => $request->iva[$index],
                    'iva' => $iva,
                    '%_descuento' => $request->descuento[$index],
                    'descuento' => $descuento,
                    'precio_total' => $precioTotal,
                ]);
            }
        }

        // Actualizamos el precio total de la factura
        $invoice->update([
            'fecha_emision' => today(),
            'total_factura' => $request->precio_total_factura,
        ]);

        // Obtener el correo del propietario del vehículo o maquinaria
        $propietarioEmail = $repair->vehiculoMaquina->usuario->email;

        // Obtenemos el iva de la tabla auxiliar
        $dato_factura = ConfiguracionFactura::first();

        // Embeber la imagen para que aparezca en el email y en la factura
        $imagePath = storage_path('app/public/imagenes/logo_repar.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        // Enviar el correo sin necesidad de crear un Mailable
        $data = [
            'cliente_nombre' => $repair->vehiculoMaquina->usuario->nombre,
            'cliente_direccion' => $repair->vehiculoMaquina->usuario->direccion,
            'cliente_telefono' => $repair->vehiculoMaquina->usuario->telefono,
            'vehiculo' => $repair->VehiculoMaquina->marca . ' ' . $repair->VehiculoMaquina->modelo,
            'matricula' => $repair->VehiculoMaquina->matricula,
            'fecha_emision' => today()->format('d-m-Y'),
            'precio_factura' => $request->precio_total_factura . '€',
            'logo_url' => $imageSrc,
            'detalles' => $detallesFactura,
            'iva_porcentaje' => $dato_factura->iva,
            'total_descuento' => $totalDescuento,
            'total_iva' => $totalIva,
            'baseImponible' => $baseImponible,
        ];

        // Configuración de Dompdf
        $dompdf = new Dompdf();

        // Cargar la vista HTML para generar el PDF
        $html = view('plantillas.factura', $data)->render();
        $dompdf->loadHtml($html);

        // Configurar opciones de Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Renderizar el PDF
        $dompdf->render();

        $facturaDirectory = storage_path('app/public/facturas');

        $path = storage_path('app/public/facturas/factura_nueva_' . $invoice->id . '.pdf');
        file_put_contents($path, $dompdf->output());

        // Enviar el correo
        Mail::send(
            'paginas.administrativo.email_update_invoice',
            $data,
            function ($message) use ($propietarioEmail, $path) {
                $message->to($propietarioEmail)
                        ->subject('Factura Completada Modificada')
                        ->attach($path, [
                            'as' => 'factura_nueva.pdf', // Nombre con el que se enviará el archivo
                            'mime' => 'application/pdf', // Tipo MIME del archivo
                        ]);
            }
        );

        // Url de la factura para poder verla una vez se crea y redirige a la vista edit_invoice
        $invoice_url = asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/storage/app/public/facturas/factura_nueva_' . $invoice->id . '.pdf');

        return redirect()->route('select_invoice', $repair->id)->with('status', 'Factura actualizada correctamente')->with('invoice_url', $invoice_url);
    }

    // Metodo para mostrar las facturas pendientes de pago
    public function collectInvoice(){

        $invoices = Factura::with('detalleReparacion.reparacion.vehiculoMaquina.categoria')
                ->orderBy('fecha_emision', 'desc')
                ->where('estado', 'pendiente')
                ->paginate(10);
    
        return view('paginas.administrativo.collect_invoice', compact('invoices'));
    }

    // Metodo para realizar el cobro y actualizar la factura pendiente de pago por pagada
    public function collectInvoiceUpdate($id){

        Factura::where('id', $id)->update([
            'estado' => 'pagada',
        ]);

        return redirect()->route('collect_invoice')->with('status', 'La Factura ha sido cobrada correctamente.');
    }

    // Metodo para mostrar las facturas completadas por el usuario administrativo autenticado
    public function completedInvoices(Request $request){

        $year = $request->input('year');

        $invoicesQuery = Factura::with('detalleReparacion.reparacion.vehiculoMaquina.categoria')
                        ->where('facturas.id_usuario', auth()->user()->id);

        // Si se pasa el año, filtra por ese año
        if ($year) {
            $invoicesQuery->whereYear('facturas.fecha_emision', $year);
        }

        $invoices = $invoicesQuery->orderBy('facturas.fecha_emision', 'desc')->paginate(10);
        
        // Obtener los años disponibles
        $years = Factura::distinct()
            ->orderByDesc('fecha_emision')
            ->pluck(\DB::raw('YEAR(fecha_emision) as year'))
            ->toArray();

        return view('paginas.administrativo.completed_invoices', compact('invoices', 'years'));
    }

}
