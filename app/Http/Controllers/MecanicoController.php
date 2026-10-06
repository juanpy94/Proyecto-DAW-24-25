<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reparacion;
use App\Models\DetalleReparacion;

use Illuminate\Support\Facades\Mail;

class MecanicoController extends Controller
{
    // Metodo para cargar la vista con las reparaciones asignadas del mecanico autenticado
    public function assignedRepairs(){

        $repairs = Reparacion::join('usuarios', 'reparaciones.id_usuario', '=', 'usuarios.id')
                ->with('vehiculoMaquina.categoria')
                ->where('reparaciones.estado', 'asignado')
                ->where('reparaciones.id_usuario', auth()->user()->id)
                ->orderBy('reparaciones.fecha_entrada', 'asc')
                ->select('reparaciones.*', 'usuarios.nombre')
                ->get();

        return view('paginas.mecanico.assigned_repairs', compact('repairs'));
    }

    // Metodo para controlar que no se pueda proceder a reparar una reparacion mediante la url
    public function repairURL($id){
        return redirect()->route('assigned_repairs_mechanic')->with('error', 'No puedes proceder a reparar una reparacion desde la URL, por favor hazlo desde la siguiente lista.');
    }

    // Metodo para que la reparacion que haya sido dada a reparar pase a proceso
    public function repair($id){

        Reparacion::where('id', $id)->update([
            'estado' => 'en proceso',
            'fecha_inicio' => today(),
        ]);

        return redirect()->route('assigned_repairs_mechanic')->with('status', 'Reparación en proceso.');
    }

    // Metodo para cargar la vista con las reparaciones en proceso
    public function repairsInProgress(){

        $repairs = Reparacion::join('usuarios', 'reparaciones.id_usuario', '=', 'usuarios.id')
                ->with('vehiculoMaquina.categoria')
                ->where('reparaciones.estado', 'en proceso')
                ->where('reparaciones.id_usuario', auth()->user()->id)
                ->orderBy('usuarios.nombre', 'asc')
                ->orderBy('reparaciones.fecha_entrada', 'asc')
                ->select('reparaciones.*', 'usuarios.nombre')
                ->get();

        return view('paginas.mecanico.repairs_inProgress', compact('repairs'));
    }

    // Metodo para controlar que no se pueda cancelar la reparacion mediante la url
    public function repairInProgressURL($id){
        return redirect()->route('repairs_inProgress_mechanic')->with('error', 'No puedes proceder a realizar dicha operación desde la URL, por favor hazlo desde la siguiente lista.');
    }

    // Metodo para cancelar una reparacion y volverla a reparaciones asignadas
    public function repairBack($id){

        Reparacion::where('id', $id)->update([
            'estado' => 'asignado',
            'fecha_inicio' => null,
        ]);

        return redirect()->route('repairs_inProgress_mechanic')->with('status', 'La reparación vuelve a estar en reparaciones asignadas.');
    }

    // Metodo para cargar la vista con el formulario para rellenar los detalles de la reparacion
    public function repairCompleted($id){

        $repair = Reparacion::find($id);

        if (!$repair) {
            return redirect()->route('repairs_inProgress_mechanic')->with('error', 'Reparación no encontrada.');
        }

        if ($repair->id_usuario !== auth()->user()->id) {
            return redirect()->route('repairs_inProgress_mechanic')->with('error', 'No tienes acceso a esta reparación.');
        }

        if ($repair->estado !== 'en proceso') {
            return redirect()->route('repairs_inProgress_mechanic')->with('error', 'Solo puedes seleccionar una de la siguientes.');
        }

        return view('paginas.mecanico.repair_details', compact('repair'));
    }

    // Metodo para añadir los detalles de la reparacion
    public function repairAddDetails($id, Request $request){

        $repair = Reparacion::findOrFail($id);

        $validatedData = request()->validate([
            'detalle' => 'required|array|min:1',
            'detalle.0' => 'required|string|max:255',
            'detalle.*' => 'nullable|string|max:255',  
            'cantidad' => 'required|array|min:1',
            'cantidad.0' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', 
            'cantidad.*' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',  
            'horas' => 'required|string|max:255',  
            'cantidad_horas' => ['required', 'regex:/^(?!0(\:00)?$)(\d{1,3})(\:(0[0-9]|[1-5][0-9]))$/'],
        ]);

        foreach ($validatedData['detalle'] as $index => $detalle) {
            $cantidad = $validatedData['cantidad'][$index];

            // Verifica si tanto 'detalle' como 'cantidad' no están vacíos
            if (!empty($detalle) && !empty($cantidad)) {
                DetalleReparacion::create([
                    'id_reparacion' => $repair->id,
                    'descripcion' => $detalle,
                    'cantidad' => $cantidad,
                ]);
            }
        }

        // Obtener el valor del campo horas, en formato "H:i"
        $horas = $request->cantidad_horas;

        // Separar las horas y los minutos
        list($horasParte, $minutosParte) = explode(":", $horas);

        // Asegurarse de que los minutos tengan siempre dos dígitos
        $cantidad_decimal = $horasParte . '.' . str_pad($minutosParte, 2, '0', STR_PAD_LEFT);

        DetalleReparacion::create([
            'id_reparacion' => $repair->id,
            'descripcion' => $request->horas,
            'cantidad' => $cantidad_decimal,
        ]);

        // Actualizamos el estado de la reparacion y la fecha fin
        Reparacion::where('id', $id)->update([
            'estado' => 'completado',
            'fecha_fin' => today(),
        ]);

        // Obtener el correo del propietario del vehículo
        $propietarioEmail = $repair->vehiculoMaquina->usuario->email;

        // Enviar el correo sin necesidad de crear un Mailable
        $data = [
            'vehiculo' => $repair->VehiculoMaquina->marca . ' ' . $repair->VehiculoMaquina->modelo,
            'matricula' => $repair->VehiculoMaquina->matricula,
            'fecha_fin' => today()->format('d-m-Y'),
            'logo_url' => url('storage/imagenes/logo_repar.png'),
        ];

        // Enviar el correo
        Mail::send(
            'paginas.mecanico.email_repair_completed',
            $data,
            function ($message) use ($propietarioEmail) {
                $message->to($propietarioEmail)
                        ->subject('Reparación Completada');
            }
        );

        return redirect()->route('repairs_inProgress_mechanic', $repair->id)->with('status', 'Detalles de la reparación agregados correctamente!');
    }

    // Metodo para cargar la vista con las reparaciones completadas del mecanico autenticado
    public function completedRepairs(Request $request){

        $year = $request->input('year');
        
        // Consulta las reparaciones, filtra por año si se pasa el parámetro
        $repairsQuery = Reparacion::join('usuarios', 'reparaciones.id_usuario', '=', 'usuarios.id')
            ->with('vehiculoMaquina.categoria')
            ->where('reparaciones.estado', 'completado')
            ->where('reparaciones.id_usuario', auth()->user()->id);
        
        // Si se pasa el año, filtra por ese año
        if ($year) {
            $repairsQuery->whereYear('reparaciones.fecha_fin', $year);
        }
        
        $repairs = $repairsQuery->orderBy('reparaciones.fecha_fin', 'desc')
            ->select('reparaciones.*', 'usuarios.nombre')
            ->paginate(10);

        // Obtener los años disponibles
        $years = Reparacion::where('estado', 'completado')
            ->distinct()
            ->orderByDesc('fecha_fin')
            ->pluck(\DB::raw('YEAR(fecha_fin) as year'))
            ->toArray();
        
        return view('paginas.mecanico.completed_repairs', compact('repairs', 'years'));
    }
}
