<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reparacion;
use App\Models\VehiculoMaquina;
use App\Models\Categoria;

class JefeTallerController extends Controller
{
    // Metodo para cargar la vista de las reparaciones asignadas
    public function assignedRepairs(){

        $repairs = Reparacion::join('usuarios', 'reparaciones.id_usuario', '=', 'usuarios.id')
                ->with('vehiculoMaquina.categoria')
                ->where('reparaciones.estado', 'asignado')
                ->orderBy('usuarios.nombre', 'asc')
                ->orderBy('reparaciones.fecha_entrada', 'asc')
                ->select('reparaciones.*', 'usuarios.nombre')
                ->get();

        return view('paginas.jefe_taller.assigned_repairs', compact('repairs'));
    }

    // Metodo para cargar la vista con el formulario para añadir reparacion
    public function formAddRepair(){

        $mecanicos = User::where('rol', 'mecanico')->orderBy('nombre', 'asc')->get();

        return view('paginas.jefe_taller.add_repair', compact('mecanicos'));
    }

    // Método AJAX para buscar usuarios
    public function searchUsers(Request $request)
    {
        $query = $request->input('query');

        $usuarios = User::where('nombre', 'like', "%$query%")
                    ->orWhere('usuario', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%")
                    ->orWhere('telefono', 'like', "%$query%")
                    ->get();

        return response()->json($usuarios);
    }

    // Método AJAX para obtener vehículos de un usuario
    public function getVehiculosByUser($userId)
    {
        $vehiculos = VehiculoMaquina::where('id_usuario', $userId)
                                    ->with('categoria')
                                    ->get();

        return response()->json($vehiculos);
    }

    // Metodo para añadir una reparacion
    public function addRepair(Request $request){

        $request->validate([
            'id_vehiculo_maquina' => 'required|exists:vehiculos_maquinarias,id',
            'descripcion' => 'required|string|max:255',
            'id_mecanico' => 'required|exists:usuarios,id',
        ]);

        Reparacion::create([
            'id_vehiculo_maquina' => $request->id_vehiculo_maquina,
            'descripcion' => $request->descripcion,
            'id_usuario' => $request->id_mecanico,
            'estado' => 'asignado',
            'fecha_entrada' => today(),
        ]);

        return redirect()->route('assigned_repairs')->with('status', 'Reparación añadida correctamente.');
    }

    // Metodo para cargar la vista para editar una reparacion
    public function selectRepair(){

        $repairs = Reparacion::join('usuarios', 'reparaciones.id_usuario', '=', 'usuarios.id')
                ->with('vehiculoMaquina.categoria')
                ->where('reparaciones.estado', 'asignado')
                ->orderBy('usuarios.nombre', 'asc')
                ->orderBy('reparaciones.fecha_entrada', 'asc')
                ->select('reparaciones.*', 'usuarios.nombre')
                ->get();

        return view('paginas.jefe_taller.select_repair', compact('repairs'));
    }

    // Metodo para recoger los datos de la reparacion seleccionada para editar
    public function editRepair($id)
    {
        $repair = Reparacion::with('usuario', 'vehiculoMaquina.categoria')->findOrFail($id);

        $vehiculos = VehiculoMaquina::where('id_usuario', $repair->vehiculoMaquina->usuario->id)
                                    ->with('categoria')
                                    ->get();

        $mecanicos = User::where('rol', 'mecanico')
                        ->where('id', '!=', $repair->usuario->id)
                        ->get();

        return view('paginas.jefe_taller.edit_repair', compact('repair', 'vehiculos', 'mecanicos'));
    }
    
    // Metodo para actualizar la reparacion
    public function updateRepair(Request $request, $id){

        $request->validate([
            'id_vehiculo_maquina' => 'required|exists:vehiculos_maquinarias,id',
            'descripcion' => 'required|string|max:255',
            'id_mecanico' => 'required|exists:usuarios,id',
        ]);

        $repair = Reparacion::find($id);

        if ($repair->estado !== 'asignado') {
            return redirect()->route('select_repair')->with('error', 'Solo se pueden editar reparaciones de las mostradas aquí.');
        }

        Reparacion::where('id', $id)->update([
            'id_vehiculo_maquina' => $request->id_vehiculo_maquina,
            'descripcion' => $request->descripcion,
            'id_usuario' => $request->id_mecanico,
        ]);

        return redirect()->route('select_repair')->with('status', 'Reparación actualizada correctamente.');
    }

    // Metodo para cargar la vista con las reparaciones asignadas para poder eliminar
    public function selectDeleteRepair(){

        $repairs = Reparacion::join('usuarios', 'reparaciones.id_usuario', '=', 'usuarios.id')
                ->with('vehiculoMaquina.categoria')
                ->where('reparaciones.estado', 'asignado')
                ->orderBy('usuarios.nombre', 'asc')
                ->orderBy('reparaciones.fecha_entrada', 'asc')
                ->select('reparaciones.*', 'usuarios.nombre')
                ->get();

        return view('paginas.jefe_taller.select_delete_repair', compact('repairs'));
    }

    // Metodo para eliminar reparacion
    public function deleteRepair($id){
        
        $repair = Reparacion::find($id);

        if (!$repair) {
            return redirect()->route('select_delete_repair')->with('status', 'Reparación no encontrada.');
        }

        try {
            $repair->delete();
    
            return redirect()->route('select_delete_repair')->with('status', 'Reparación eliminada correctamente.');

        } catch (\Exception $e) {
            return redirect()->route('select_delete_repair')->with('status', 'Error al eliminar la reparación. Intente de nuevo.');
        }
    }

    // Metodo para controlar eliminar una reparacion desde la URL
    public function deleteRepairURL($id){
        return redirect()->route('select_delete_repair')->with('error', 'No puedes eliminar una reparación desde la URL, solo las que se muestran en esta ventana.');
    }

    // Metodo para cargar la vista de las reparaciones en proceso
    public function repairsInProgress(){

        $repairs = Reparacion::join('usuarios', 'reparaciones.id_usuario', '=', 'usuarios.id')
                ->with('vehiculoMaquina.categoria')
                ->where('reparaciones.estado', 'en proceso')
                ->orderBy('usuarios.nombre', 'asc')
                ->orderBy('reparaciones.fecha_entrada', 'asc')
                ->select('reparaciones.*', 'usuarios.nombre')
                ->get();

        return view('paginas.jefe_taller.repairs_inProgress', compact('repairs'));
    }

    // Metodo para cargar la vista con las categorias y formulario para insertar categoria
    public function categories(){

        $categories = Categoria::orderBy('nombre', 'asc')->get();

        return view('paginas.jefe_taller.categories', compact('categories'));
    }

    // Metodo para añadir categoria
    public function addCategorie(Request $request){

        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('categories')->with('status', 'Categoría añadida correctamente.');
    }

    // Metodo para recoger los datos de la categoria seleccionada para editar
    public function editCategorie($id){
        
        $categorie = Categoria::find($id);

        if (!$categorie) {
            return redirect()->route('categories')->with('error', 'Categoría no encontrada');
        }

        return view('paginas.jefe_taller.edit_categorie', compact('categorie'));
    }

    // Metodo para actualizar categoria
    public function updateCategorie(Request $request, $id){

        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
        ]);

        Categoria::where('id', $id)->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('categories')->with('status', 'Categoría editada correctamente.');
    }

    // Metodo para eliminar categoria
    public function deleteCategorie($id){

        $categorie = Categoria::find($id);

        if (!$categorie) {
            return redirect()->route('categories')->with('status', 'Categoría no encontrada.');
        }

        try {
            $categorie->delete();
    
            return redirect()->route('categories')->with('status', 'Categoría eliminada correctamente.');

        } catch (\Exception $e) {
            return redirect()->route('categories')->with('status', 'Error al eliminar la categoría. Intente de nuevo.');
        }
    }

    // Metodo para controlar eliminar una categoria desde la URL
    public function deleteCategorieURL($id){
        return redirect()->route('categories')->with('error', 'No puedes eliminar una categoría desde la URL, solo las que se muestran en la siguiente lista.');
    }

}
