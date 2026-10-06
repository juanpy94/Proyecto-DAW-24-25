<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VehiculoMaquina;
use App\Models\Categoria;
use App\Models\Reparacion;
use App\Models\Factura;
use App\Models\ConfiguracionFactura;

use Dompdf\Dompdf;
use Dompdf\Options;
use DateTime;

class ClienteController extends Controller
{
    // Metodo para cargar la vista con el los vehiculos y maquinarias del usuario autenticado
    public function myVehiclesMachinerys(){

        // Obtener el usuario autenticado
        $user = auth()->user();

        // Obtenemos los vehiculos y maquinarias del usuario autenticado
        $vehicles_machinerys = VehiculoMaquina::where('id_usuario', $user->id)->get();

        return view('paginas.cliente.my_vehicles_machinerys', compact('vehicles_machinerys'));
    }

    // Metodo para editar el vehiculo o maquinaria seleccionada
    public function editVehiclesMachinerys($id){

        $vehicle_machinery = VehiculoMaquina::find($id);

        // Si el vehiculo o maquina no se encuentra
        if(!$vehicle_machinery){
            return redirect()->route('my_vehicles_machinerys')->with('error', 'El vehículo o máquina no se encuentra.');
        }

        // Verificar si el vehículo o maquinaria pertenece al usuario autenticado
        if ($vehicle_machinery->id_usuario != auth()->id()) {
            return redirect()->route('my_vehicles_machinerys')->with('error', 'No tienes permiso para editar este vehículo o máquina.');
        }

        // Recogemos las categorias disponibles
        $categorias = Categoria::where('id', '!=', $vehicle_machinery->categoria->id)->orderBy('nombre', 'asc')->get();

        return view('paginas.cliente.edit_vehicles_machinerys', compact('vehicle_machinery', 'categorias'));
    }

    // Metodo para actualizar los campos del vehiculo o maquina seleccionada
    public function updateVehicleMachinery($id, Request $request){

        // Año actual
        $currentYear = date('Y');

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'categoria' => 'required|exists:categorias,id',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'matricula' => 'nullable|string|max:50',
            'ano' => 'required|integer|digits:4|between:1990,' . $currentYear,
        ]);

        // Actualizamos los campos del vehiculo o maquina
        VehiculoMaquina::where('id', $id)->update([
            'id_categoria' => $request->categoria,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'matricula' => $request->matricula,
            'ano' => $request->ano,
        ]);

        return redirect()->route('my_vehicles_machinerys')->with('status', 'El vehículo o máquina ha sido actualizado correctamente.');
    }

    // Metodo para eliminar un vehiculo o maquina
    public function deleteVehicleMachinery($id){

        // Buscamos el vehiculo o maquina a eliminar
        $vehicle_machinery = VehiculoMaquina::find($id);

        // Verificamos si el vehículo o maquina existe
        if (!$vehicle_machinery) {
            return redirect()->route('my_vehicles_machinerys')->with('error', 'El vehículo o máquina no se ha encontrado.');
        }

        // Eliminamos el vehiculo o maquina
        $vehicle_machinery->delete();

        return redirect()->route('my_vehicles_machinerys')->with('status', 'El vehículo o máquina ha sido eliminado correctamente.');
    }

    // Metodo para cargar la vista con las reparaciones del cliente autenticado
    public function myRepairs(Request $request){

        $year = $request->input('year');

        $userId = auth()->user()->id;

        // Obtenemos las reparaciones del usuario autenticado
        $repairsQuery = Reparacion::with('vehiculoMaquina')
                                    ->whereHas('vehiculoMaquina', function($query) use ($userId) {
                                    $query->where('id_usuario', $userId);
        });

        // Si se pasa el año, filtra por ese año
        if ($year) {
            $repairsQuery->whereYear('reparaciones.fecha_entrada', $year);
        }

        $repairs = $repairsQuery->orderBy('reparaciones.fecha_entrada', 'desc')->paginate(10);

        // Obtener los años disponibles
        $years = Reparacion::distinct()
            ->orderByDesc('fecha_entrada')
            ->pluck(\DB::raw('YEAR(fecha_entrada) as year'))
            ->toArray();

        return view('paginas.cliente.my_repairs', compact('repairs', 'years'));
    }

    // Metodo para cargar la vista para insertar un vehiculo o maquina
    public function insertVehicleMachinery(){

        // Recogemos las categorias disponibles
        $categorias = Categoria::orderBy('nombre', 'asc')->get();

        return view('paginas.cliente.insert_vehicle_machinery', compact('categorias'));
    }

    // Metodo para añadir vehiculo maquina del usuario autenticado
    public function addVehicleMachinery(Request $request){

        // Obtenemos el usuario autenticado
        $user = auth()->user()->id;

        // Año actual
        $currentYear = date('Y');

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'categoria' => 'required|exists:categorias,id',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'matricula' => 'nullable|string|max:50',
            'ano' => 'required|integer|digits:4|between:1990,' . $currentYear,
        ]);

        // Insertamos los campos del vehiculo o maquina
        VehiculoMaquina::create([
            'id_categoria' => $request->categoria,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'matricula' => $request->matricula,
            'ano' => $request->ano,
            'id_usuario' => $user,
        ]);

        return redirect()->route('my_vehicles_machinerys')->with('status', 'El vehículo o máquina ha sido añadido correctamente.');
    }

    // Metodo para cargar la vista con las facturas del cliente autenticado
    public function myInvoices(Request $request){

        // Obtenemos el usuario autenticado
        $userId = auth()->user()->id;

        $year = $request->input('year');

        // Año actual
        $currentYear = date('Y');

        // Obtenemos las facturas del usuario autenticado
        $invoicesQuery = Factura::with('detalleReparacion.reparacion.vehiculoMaquina.categoria')
                                ->whereHas('detalleReparacion.reparacion.vehiculoMaquina', function($query) use ($userId) {
                                $query->where('id_usuario', $userId);
        });

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

        return view('paginas.cliente.my_invoices', compact('invoices', 'years'));
    }
    
    // Metodo para cargar la factura del cliente autenticado en PDF en el navegador
    public function myInvoicePDF($id){

        // Obtenemos la factura
        $factura = Factura::find($id);

        // Obtenemos el usuario logueado
        $user = auth()->user();

        // Verificamos si la factura existe
        if (!$factura) {
            return redirect()->route('my_invoices')->with('error', 'La factura no existe.');
        }

        // Verificamos si la factura pertenece al usuario logueado
        if ($factura->detalleReparacion->first()->reparacion->vehiculoMaquina->usuario->id != $user->id) {
            return redirect()->route('my_invoices')->with('error', 'No tienes permiso para ver esta factura.');
        }

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

}
