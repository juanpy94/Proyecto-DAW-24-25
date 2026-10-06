<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Password as PasswordFacade;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Categoria;
use App\Models\VehiculoMaquina;
use App\Models\Reparacion;
use App\Models\DetalleReparacion;
use App\Models\ConfiguracionFactura;
use App\Models\Factura;

use Illuminate\Support\Facades\Mail;
use Dompdf\Dompdf;
use Dompdf\Options;
use DateTime;

class AdminController extends Controller
{   
    // -------------------------------------------------- Metodos para la tabla usuarios --------------------------------------------------
    // Metodo para mostrar todos los usuarios
    public function viewUsers(){

        // Obtenemos todos los ususarios
        $users = User::paginate(10);

        return view('paginas.admin.view_users', compact('users'));
    }

    // Método AJAX para buscar usuario
    public function searchUser(Request $request)
    {
        $query = $request->input('query');

        $usuarios = User::where('nombre', 'like', "%$query%")
                    ->orWhere('usuario', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%")
                    ->orWhere('telefono', 'like', "%$query%")
                    ->get();

        return response()->json($usuarios);
    }

    // Metodo para buscar el usuario buscado
    public function viewUserSearch(Request $request) {
        $userId = $request->input('user_id');
    
        // Si se pasa un ID de usuario, filtrar por ese usuario
        if ($userId) {
            $users = User::where('id', $userId)->paginate(10);
        } else {
            // Si no se pasa un ID
            $users = User::paginate(10);
        }
    
        // Solo devolver la tabla de usuarios
        return response()->json([
            'table' => view('paginas.admin.partials.user_table', compact('users'))->render(),
            'pagination' => view('pagination::bootstrap-4', ['paginator' => $users])->render(),
            'total' => $users->total(),
            'from' => $users->firstItem(),
            'to' => $users->lastItem(),
        ]);
    }

    // Metodos para cargar la vista con el formulario para insertar un usuario y para añadirlo
    public function formInsertUser(){
        return view('paginas.admin.form_insert_user');
    }

    public function insertUser(Request $request){

        // validamos los input
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'usuario' => 'required|string|unique:usuarios,usuario|max:255',
            'email' => 'required|email|unique:usuarios,email|max:255',
            'password' => 'required|string|confirmed',
            'rol' => 'required|string|in:cliente,jefe_taller,mecanico,administrativo,administrador'
        ]);

        // Creamos el usuario nuevo
        $user = User::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'telefono' => $request->telefono,
            'usuario' => $request->usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        // Verificamos el usuario sin necesidad de que lo haga desde el email
        $user->markEmailAsVerified();

        return redirect()->route('view_users')->with('status', 'El Usuario ha sido añadido correctamente.');
    }

    // Metodo para editar el usuario seleccionado y actualizarlo
    public function editUser($id){

        // Obtenemos el usuario a editar
        $user = User::find($id);

        // Si el usuario no se encuentra
        if (!$user) {
            return redirect()->route('view_users')->with('error', 'Usuario no encontrado');
        }

        return view('paginas.admin.edit_user', compact('user'));
    }
    
    public function updateUser($id, Request $request){

        // Obtenemos al usuario que se va a actualizar
        $user = User::findOrFail($id);

        // validamos los input
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'usuario' => 'required|string|max:255|unique:usuarios,usuario,' . $user->id,
            'email' => 'required|email|max:255|unique:usuarios,email,' . $user->id,
            'password' => 'nullable|string|confirmed',
            'rol' => 'required|string|in:cliente,jefe_taller,mecanico,administrativo,administrador'
        ]);

        // Actualizamos los campos del usuario
        $dataToUpdate = [
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'telefono' => $request->telefono,
            'usuario' => $request->usuario,
            'email' => $request->email,
            'rol' => $request->rol,
        ];
        
        // Verificar si se ha proporcionado una nueva contraseña
        if ($request->filled('password')) {
            // Si hay una nueva contraseña, se agrega al arreglo de datos a actualizar
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        // Actualizamos al usuario
        $user->update($dataToUpdate);

        return redirect()->route('view_users')->with('status', 'El Usuario ha sido actualizado correctamente.');
    }

    // Metodo para eliminar un usuario
    public function deleteUser($id){

        // Obtenemos el usuario autenticado administrador
        $userAdmin = auth()->user()->id;

        // Comprobamos si el usuario que esta intentado eliminar es su propio usuario administrador
        if ($id == $userAdmin) {
            return redirect()->route('view_users')->with('error', 'No puedes eliminar tu usuario administrador.');
        }

        // Obtenemos el usuario a eliminar
        $user = User::find($id);

        // Verificamos si el usuario no existe para que aparezca un mensaje de error
        if (!$user) {
            return redirect()->route('view_users')->with('error', 'El Usuario no se ha encontrado.');
        }

        // Eliminamos el usuario
        $user->delete();

        return redirect()->route('view_users')->with('status', 'El Usuario ha sido eliminado correctamente.');
    }

    // -------------------------------------------------- Metodos para la tabla categorias --------------------------------------------------
    // Metodo para mostrar todas las categorias
    public function viewCategories(){

        // Obtenemos todas las categorias
        $categories = Categoria::orderBy('nombre', 'asc')->paginate(10);

        return view('paginas.admin.view_categories', compact('categories'));
    }

    // Metodos para cargar la vista con el formulario para insertar una categoria y para añadirla
    public function formInsertCategory(){
        return view('paginas.admin.form_insert_category');
    }

    public function insertCategory(Request $request){

        // Validamos el input de la categoria
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
        ]);

        // Creamos la categoria nueva
        Categoria::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('view_categories')->with('status', 'La Categoria ha sido añadida correctamente.');
    }

    // Metodo para editar la categoria seleccionada y actualizarla
    public function editCategory($id){

        // Obtenemos la categoria a editar
        $category = Categoria::find($id);

        // Si la categoria no se encuentra
        if (!$category) {
            return redirect()->route('view_categories')->with('error', 'Categoría no encontrada');
        }

        return view('paginas.admin.edit_category', compact('category'));
    }

    public function updateCategory($id, Request $request){

        // Validamos el input de la categoria
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $id,
        ]);

        // Actualizamos la categoria nueva
        Categoria::where('id', $id)->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('view_categories')->with('status', 'La Categoria ha sido actualizada correctamente.');
    }

    // Metodo para eliminar una categoria
    public function deleteCategory($id){

        // Obtenemos la categoria a eliminar
        $category = Categoria::find($id);

        // Verificamos si la categoria no existe para que aparezca un mensaje de error
        if (!$category) {
            return redirect()->route('view_category')->with('error', 'La Categoria no se ha encontrado.');
        }

        // Eliminamos la categoria
        $category->delete();

        return redirect()->route('view_categories')->with('status', 'La Categoria ha sido eliminada correctamente.');
    }

    // -------------------------------------------------- Metodos para la tabla vehiculos_maquinarias --------------------------------------------------
    // Metodo para mostrar todos los vehiculo y maquinarias
    public function viewVehiclesMachinerys(){

        // Obtenemos todos los vehiculos y maquinarias
        $vehiclesMachinerys = VehiculoMaquina::orderBy('marca', 'asc')->orderBy('modelo', 'asc')->paginate(10);

        return view('paginas.admin.view_vehicles_machinerys', compact('vehiclesMachinerys'));
    }

    // Metodo para buscar el usuario y mostrar sus vehiculos o maquinarias
    public function viewUserVehicles(Request $request) {
        $userId = $request->input('user_id');
    
        // Si se pasa un ID de usuario, filtrar por ese usuario
        if ($userId) {
            $vehiclesMachinerys = VehiculoMaquina::where('id_usuario', $userId)->orderBy('marca', 'asc')->orderBy('modelo', 'asc')->paginate(10);
        } else {
            // Si no se pasa un ID
            $vehiclesMachinerys = VehiculoMaquina::paginate(10);
        }
    
        // Solo devolver la tabla de vehiculos y maquinarias
        return response()->json([
            'table' => view('paginas.admin.partials.vehicles_table', compact('vehiclesMachinerys'))->render(),
            'pagination' => view('pagination::bootstrap-4', ['paginator' => $vehiclesMachinerys])->render(),
            'total' => $vehiclesMachinerys->total(),
            'from' => $vehiclesMachinerys->firstItem(),
            'to' => $vehiclesMachinerys->lastItem(),
        ]);
    }

    // Metodos para cargar la vista con el formulario para insertar un vehiculo o maquina y para añadirlo
    public function formInsertVehicle(){

        // Recogemos las categorias disponibles
        $categorias = Categoria::orderBy('nombre', 'asc')->get();

        return view('paginas.admin.form_insert_vehicle', compact('categorias'));
    }

    public function insertVehicle(Request $request){

        // Año actual
        $currentYear = date('Y');

        // Validamos los datos del formulario
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'matricula' => 'nullable|string|max:50',
            'ano' => 'required|integer|digits:4|between:1990,' . $currentYear,
            'categoria' => 'required|exists:categorias,id',
            'id_user' => 'required|exists:usuarios,id',

        ]);

        // Insertamos los campos del vehiculo o maquinaria
        VehiculoMaquina::create([
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'matricula' => $request->matricula,
            'ano' => $request->ano,
            'id_categoria' => $request->categoria,
            'id_usuario' => $request->id_user,
        ]);

        return redirect()->route('adm_view_vehicles_machinerys')->with('status', 'El Vehículo o Maquinaria ha sido añadido correctamente.');
    }

    // Metodo para editar el vehiculo o maquinaria seleccionada y actualizarla
    public function editVehicle($id){

        // Obtenemos el vehiculo o la maquinaria
        $vehicle = VehiculoMaquina::find($id);

        // Si el vehiculo o la maquinaria no se encuentra
        if (!$vehicle) {
            return redirect()->route('adm_view_vehicles_machinerys')->with('error', 'Vehiculo o Maquinaria no encontrado');
        }

        // Recogemos las categorias disponibles
        $categorias = Categoria::where('id', '!=', $vehicle->categoria->id)->orderBy('nombre', 'asc')->get();

        return view('paginas.admin.edit_vehicle', compact('vehicle', 'categorias'));
    }

    public function updateVehicle($id, Request $request){

        // Año actual
        $currentYear = date('Y');

        // Validamos los datos del formulario
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'matricula' => 'nullable|string|max:50',
            'ano' => 'required|integer|digits:4|between:1990,' . $currentYear,
            'categoria' => 'required|exists:categorias,id',
            'id_user' => 'nullable|exists:usuarios,id',

        ]);

        // Actualizamos los campos del vehiculo o maquina
        $updateData = [
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'matricula' => $request->matricula,
            'ano' => $request->ano,
            'id_categoria' => $request->categoria,
        ];

        // Si se pasa un nuevo usuario, se actualiza
        if ($request->filled('id_user')) {
            $updateData['id_usuario'] = $request->id_user;
        }

        // Se actualiza el vehiculo o maquina
        VehiculoMaquina::where('id', $id)->update($updateData);

        return redirect()->route('adm_view_vehicles_machinerys')->with('status', 'El Vehículo o Maquinaria ha sido actualizado correctamente.');
    }
    
    // Metodo para eliminar un vehiculo o maquinaria
    public function deleteVehicle($id){

        // Obtenemos el vehiculo o maquinaria
        $vehicle = VehiculoMaquina::find($id);

        // Verificamos si el vehiculo o maquinaria no existe para que aparezca un mensaje de error
        if(!$vehicle){
            return redirect()->route('adm_view_vehicles_machinerys')->with('error', 'El Vehículo o Maquinaria no se ha encontrado.');
        }

        // Eliminamos el vehiculo o maquinaria
        $vehicle->delete();

        return redirect()->route('adm_view_vehicles_machinerys')->with('status', 'El Vehículo o Maquinaria ha sido eliminado correctamente.');
    }
    
    // -------------------------------------------------- Metodos para la tabla reparaciones --------------------------------------------------
    // Metodo para mostrar todas las reparaciones
    public function viewRepairs(){

        // Obtenemos todos los vehiculos y maquinarias
        $repairs = Reparacion::orderBy('fecha_entrada', 'desc')->orderBy('fecha_inicio', 'desc')->paginate(10);

        return view('paginas.admin.view_repairs', compact('repairs'));
    }

    // Metodo para buscar el usuario y mostrar sus reparaciones
    public function viewUserRepairs(Request $request) {
        $userId = $request->input('user_id');
    
        // Si se pasa un ID de usuario, filtrar por ese usuario
        if ($userId) {
            $repairs = Reparacion::whereHas('vehiculoMaquina', function($query) use ($userId) {
                $query->where('id_usuario', $userId);
            })->orderBy('fecha_entrada', 'desc')->orderBy('fecha_inicio', 'desc')->paginate(10);
        } else {
            // Si no se pasa un ID
            $repairs = Reparacion::paginate(10);
        }
    
        // Solo devolver la tabla de vehiculos y maquinarias
        return response()->json([
            'table' => view('paginas.admin.partials.repairs_table', compact('repairs'))->render(),
            'pagination' => view('pagination::bootstrap-4', ['paginator' => $repairs])->render(),
            'total' => $repairs->total(),
            'from' => $repairs->firstItem(),
            'to' => $repairs->lastItem(),
        ]);
    }

    // Metodos para cargar la vista con el formulario para insertar una reparacion y para añadirla
    public function formInsertRepair(){

        // Obtener los valores distintos de estados
        $estados = Reparacion::select('estado')->distinct()->orderBy('estado', 'asc')->get();

        // Obtenenmos los mecanicos para asinarle la reparacion
        $mecanicos = User::where('rol', 'mecanico')->orderBy('nombre', 'asc')->get();

        return view('paginas.admin.form_insert_repair', compact('estados', 'mecanicos'));
    }
    
    public function insertRepair(Request $request){

        // Validamos los datos del formulario
        $request->validate([
            'estado' => 'required|string|max:255',
            'fecha_entrada' => 'required|date|before_or_equal:today',
            'fecha_inicio' => 'nullable|date|before_or_equal:today',
            'fecha_fin' => 'nullable|date|before_or_equal:today',
            'descripcion' => 'required|string|max:255',
            'id_mecanico' => 'required|exists:usuarios,id',
            'id_vehiculo_maquina' => 'required|exists:vehiculos_maquinarias,id',
        ]);
        
        // Insertamos los campos para insertar la reparacion
        Reparacion::create([
            'estado' => $request->estado,
            'fecha_entrada' => $request->fecha_entrada,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'descripcion' => $request->descripcion,
            'id_usuario' => $request->id_mecanico,
            'id_vehiculo_maquina' => $request->id_vehiculo_maquina, 
        ]);

        return redirect()->route('adm_view_repairs')->with('status', 'La Reparación ha sido añadida correctamente.');
    }

    // Método AJAX para obtener vehículos de un usuario
    public function getVehiculosByUser($userId)
    {
        $vehiculos = VehiculoMaquina::where('id_usuario', $userId)
                                    ->with('categoria')
                                    ->get();

        return response()->json($vehiculos);
    }

    // Metodo para editar la reparacion seleccionada y actualizarla
    public function editRepair($id){

        // Obtenemos la reparacion
        $repair = Reparacion::find($id);

        // Si la reparacion no se encuentra
        if (!$repair) {
            return redirect()->route('adm_view_repairs')->with('error', 'Reparación no encontrada');
        }

        // Obtener los valores distintos de estados
        $estados = Reparacion::select('estado')->distinct()->where('estado', '!=', $repair->estado)->orderBy('estado', 'asc')->get();

        // Obtenenmos los mecanicos para asinarle la reparacion
        $mecanicos = User::where('rol', 'mecanico')->where('id', '!=', $repair->usuario->id)->orderBy('nombre', 'asc')->get();

        $vehiculos = VehiculoMaquina::where('id_usuario', $repair->vehiculoMaquina->usuario->id)
                                    ->with('categoria')
                                    ->get();

        // Si la reparacion esta completada no se puede editar
        if($repair->estado == 'completado'){
            return redirect()->route('adm_view_repairs')->with('error', 'Esta Reparación ya esta completada y no puedes editarla');
        }

        return view('paginas.admin.edit_repair', compact('repair', 'estados', 'mecanicos', 'vehiculos'));
    }

    public function updateRepair($id, Request $request){

        // Validamos los datos del formulario
        $request->validate([
            'estado' => 'required|string|max:255',
            'fecha_entrada' => 'required|date|before_or_equal:today',
            'fecha_inicio' => 'nullable|date|before_or_equal:today',
            'fecha_fin' => 'nullable|date|before_or_equal:today',
            'descripcion' => 'required|string|max:255',
            'id_mecanico' => 'required|exists:usuarios,id',
            'id_vehiculo_maquina' => 'required|exists:vehiculos_maquinarias,id',
        ]);

        // Se actualiza la reparacion
        Reparacion::where('id', $id)->update([
            'estado' => $request->estado,
            'fecha_entrada' => $request->fecha_entrada,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'descripcion' => $request->descripcion,
            'id_usuario' => $request->id_mecanico,
            'id_vehiculo_maquina' => $request->id_vehiculo_maquina,
        ]);

        return redirect()->route('adm_view_repairs')->with('status', 'La Reparación ha sido actualizada correctamente.');
    }

    // Metodo para eliminar una reparacion
    public function deleteRepair($id){

        // Obtenemos la reparacion
        $repair = Reparacion::find($id);

        // Verificamos si la reparacion no existe para que aparezca el mensaje de error
        if(!$repair){
            return redirect()->route('adm_view_repairs')->with('error', 'La Reparación no se ha encontrado.');
        }

        // Si la reparacion esta completada no se puede eliminar
        if($repair->estado == 'completado'){
            return redirect()->route('adm_view_repairs')->with('error', 'Esta Reparación ya esta completada y no puedes eliminarla');
        }

        // Eliminamos la reparacion
        $repair->delete();

        return redirect()->route('adm_view_repairs')->with('status', 'La Reparación ha sido eliminada correctamente.');
    }

    // -------------------------------------------------- Metodos para la tabla detalles reparacion --------------------------------------------------
    // Metodo para mostrar los detalles de una reparacion
    public function viewDetailsRepair($id){

        // Obtenemos la reparacion
        $repair = Reparacion::find($id);

        // Obtenemos los detalles de la reparacion
        $details = DetalleReparacion::where('id_reparacion', $id)->paginate(10);

        // Si la reparacion no existe o no se ha completado todavia
        if($details->isEmpty()){
            return redirect()->route('adm_view_repairs')->with('error', 'Esta reparación no existe o no se ha completado todavia');
        }

        // Si la reparacion no tiene la factura creada todavia
        if(is_null($details->first()->id_factura)){
            return redirect()->route('adm_view_repairs')->with('error', 'Esta reparación está completada pero no tiene la factura creada');
        }
        
        return view('paginas.admin.view_details_repair', compact('repair', 'details'));
    }

    // Metodos para cargar la vista con el formulario para insertar un detalle a la reparacion y para añadirlo
    public function formInsertDetail(Request $request){

        // Obtenemos el id de la reparacion
        $repairId = $request->input('id_reparacion');

        // Obtenemos los datos de la reparación
        $repair = Reparacion::find($repairId);

        // Obtenemos el id de la factura
        $inoviceId = $request->input('id_factura');

        // Obtenemos los datos de la factura
        $invoice = Factura::find($inoviceId);

        // Obtenemos el iva de la tabla auxiliar
        $dato_factura = ConfiguracionFactura::first();

        // Si la factura esta pagada no se puede insertar detalles
        if($invoice->estado == 'pagada'){
            return redirect()->route('adm_view_repairs')->with('error', 'No puedes insertar un detalle en una reparación que tiene la factura pagada');
        }

        return view('paginas.admin.form_insert_detail', compact('repair', 'invoice', 'dato_factura'));
    }

    public function insertDetail(Request $request){

        // Validamos los datos del formulario
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'cantidad' => 'required|numeric|min:1',
            'precio_unidad' => 'required|numeric',
            'porcentaje_iva' => 'required|numeric',
            'porcentaje_descuento' => 'required|numeric',
        ]);

        // Calculamos el precio por la cantidad
        $precio_base_imponible = ($request->input('cantidad') * $request->input('precio_unidad'));

        // Calculamos el descuento
        $descuento = $precio_base_imponible * ($request->input('porcentaje_descuento') / 100);

        // Calculamos el IVA
        $iva = ($precio_base_imponible - $descuento) * ($request->input('porcentaje_iva') / 100);

        // Calculamos el precio total
        $precioTotal = $precio_base_imponible - $descuento + $iva;

        // Insertamos los campos para insertar el detalle de la reparacion
        DetalleReparacion::create([
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'precio_unidad' => $request->precio_unidad,
            '%_iva' => $request->porcentaje_iva,
            'iva' => $iva,
            '%_descuento' => $request->porcentaje_descuento,
            'descuento' => $descuento,
            'precio_total' => $precioTotal,
            'id_reparacion' => $request->id_reparacion,
            'id_factura' => $request->id_factura,
        ]);

        // Obtenemos la factura
        $factura = Factura::find($request->id_factura);

        // Sumamos el precio total del nuevo detalle al precio total de la factura
        $total_factura = $factura->total_factura + $precioTotal;
        
        // Actualizamos el precio de la factura
        $factura->update([
            'total_factura' => $total_factura,
        ]);

        return redirect()->route('adm_view_repairs')->with('status', 'El detalle ha sido añadido correctamente.');
    }

    // Metodo para editar el detalle de una reparacion seleccionada y actualizarlo
    public function editDetail($id){

        // Obtenemos el detalle de la reparacion
        $detail = DetalleReparacion::find($id);

        // Si el detalle de la reparacion no se encuentra
        if (!$detail) {
            return redirect()->route('adm_view_repairs')->with('error', 'Detalle de la reparación no encontrado');
        }

        // Obtenemos la factura
        $invoice = Factura::find($detail->id_factura);

        // Si la factura esta pagada no se puede editar el detalle de la reparacion
        if($invoice->estado == 'pagada'){
            return redirect()->route('adm_view_repairs')->with('error', 'No puedes editar un detalle en una reparación que tiene la factura pagada');
        }

        return view('paginas.admin.edit_detail', compact('detail'));
    }

    public function updateDetail($id, Request $request){

        // Validamos los datos del formulario
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'cantidad' => 'required|numeric|min:1',
            'precio_unidad' => 'required|numeric',
            'porcentaje_iva' => 'required|numeric',
            'porcentaje_descuento' => 'required|numeric',
        ]);

        // Obtenemos el detalle de la reparacion
        $detail = DetalleReparacion::find($id);

        // Obtenemos la factura
        $invoice = Factura::find($detail->id_factura);

        // Le restamos el precio total del detalle a la factura
        $total_factura = $invoice->total_factura - $detail->precio_total;

        // Calculamos el precio por la cantidad
        $precio_base_imponible = ($request->input('cantidad') * $request->input('precio_unidad'));

        // Calculamos el descuento
        $descuento = $precio_base_imponible * ($request->input('porcentaje_descuento') / 100);

        // Calculamos el IVA
        $iva = ($precio_base_imponible - $descuento) * ($request->input('porcentaje_iva') / 100);

        // Calculamos el precio total
        $precioTotal = $precio_base_imponible - $descuento + $iva;

        // Se actualiza el detalle
        DetalleReparacion::where('id', $id)->update([
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'precio_unidad' => $request->precio_unidad,
            '%_iva' => $request->porcentaje_iva,
            'iva' => $iva,
            '%_descuento' => $request->porcentaje_descuento,
            'descuento' => $descuento,
            'precio_total' => $precioTotal,
        ]);

        // Sumamos el nuevo detalle editado al total de la factura
        $total_factura = $total_factura + $precioTotal;

        // Actualizamos el precio de la factura
        $invoice->update([
            'total_factura' => $total_factura,
        ]);

        return redirect()->route('adm_view_repairs')->with('status', 'El Detalle de la Reparación ha sido actualizado correctamente.');
    }

    // Metodo para eliminar una reparacion
    public function deleteDetail($id){

        // Obtenemos el detalle de la reparacion
        $detail = DetalleReparacion::find($id);

        // Verificamos si la reparacion no existe para que aparezca el mensaje de error
        if(!$detail){
            return redirect()->route('adm_view_repairs')->with('error', 'El detalle de la Reparación no se ha encontrado.');
        }

        // Obtenemos la factura
        $invoice = Factura::find($detail->id_factura);

        // Si la factura esta pagada no se puede eliminar el detalle de la reparacion
        if($invoice->estado == 'pagada'){
            return redirect()->route('adm_view_repairs')->with('error', 'No puedes eliminar un detalle en una reparación que tiene la factura pagada');
        }

        // Actualizamos el total de la factura restando el precio total del detalle
        $total_factura = $invoice->total_factura - $detail->precio_total;

        // Actualizamos el precio de la factura
        $invoice->update([
            'total_factura' => $total_factura,
        ]);
        
        // Eliminamos el detalle
        $detail->delete();

        return redirect()->route('adm_view_repairs')->with('status', 'El detalle de la Reparación ha sido eliminado correctamente.');
    }

    // -------------------------------------------------- Metodos para la tabla facturas --------------------------------------------------
    // Metodo para mostrar todas las facturas
    public function viewInvoices(){

        // Obtenemos todas las facturas
        $invoices = Factura::orderBy('fecha_emision', 'desc')->paginate(10);

        return view('paginas.admin.view_invoices', compact('invoices'));
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
            'table' => view('paginas.admin.partials.invoices_table', compact('invoices'))->render(),
            'pagination' => view('pagination::bootstrap-4', ['paginator' => $invoices])->render(),
            'total' => $invoices->total(),
            'from' => $invoices->firstItem(),
            'to' => $invoices->lastItem(),
        ]);
    }

    // Metodo para cargar la vista con las reparaciones que no tienen factura, con la opcion de realizar la factura
    public function viewRepairsInvoice(){

        // Obtenemos las reparaciones que no tienen factura 
        $repairs = Reparacion::join('usuarios', 'reparaciones.id_usuario', '=', 'usuarios.id')
                ->join('detalles_reparacion', 'reparaciones.id', '=', 'detalles_reparacion.id_reparacion')
                ->with('vehiculoMaquina.categoria')
                ->whereNull('detalles_reparacion.id_factura')
                ->orderBy('reparaciones.fecha_entrada', 'asc')
                ->distinct('reparaciones.id')
                ->select('reparaciones.*', 'usuarios.nombre')
                ->paginate(10);

        return view('paginas.admin.view_repairs_invoice', compact('repairs'));
    }

    // Metodo para cargar la vista con la reparacion seleccionada y sus detalles asociados
    public function formInsertInvoice($id){

        $repair = Reparacion::find($id);

        if (!$repair) {
            return redirect()->route('adm_view_repairs_invoice')->with('error', 'Reparación no encontrada.');
        }

        // Obtener los detalles asociados a la reparación
        $detalles = DetalleReparacion::where('id_reparacion', $id)->get();

        // Verificar si no hay detalles
        if($detalles->isEmpty()){
            return redirect()->route('adm_view_repairs_invoice')->with('error', 'Reparación no encontrada. Solo puedes seleccionar una de las siguientes');
        }

        // Verificar si la reparacion ya tiene la factura realizada
        $facturaExistente = $detalles->firstWhere('id_factura', '!=', null);

        if ($facturaExistente) {
            return redirect()->route('adm_view_repairs_invoice')->with('error', 'Esta reparación ya tiene una factura asociada.');
        }
        
        // Obtener los datos del iva y el precio de la mano de obra de la tabla auxiliar configuracion_factura
        $dato_factura = ConfiguracionFactura::first();

        // Obtener los administrativos
        $administrativos = User::where('rol', 'administrativo')->orderBy('nombre', 'asc')->get();

        return view('paginas.admin.form_insert_invoice', compact('repair', 'detalles', 'dato_factura', 'administrativos'));
    }

    // Metodo para insertar la factura con los detalles asociados
    public function insertInvoice($id, Request $request){

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
            'id_administrativo' => 'required|exists:usuarios,id',
        ]);
        
        // Creamos una factura nueva
        $factura = Factura::create([
            'fecha_emision' => today(),
            'estado' => 'pendiente',
            'total_factura' => $request->precio_total_factura,
            'id_usuario' => $request->id_administrativo,
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

        // Url de la factura para poder verla una vez se crea y redirige a la vista
        $invoice_url = asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/storage/app/public/facturas/factura_' . $factura->id . '.pdf');

        return redirect()->route('adm_view_repairs_invoice', $repair->id)->with('status', 'Factura creada correctamente')->with('invoice_url', $invoice_url);
    }

    // Metodos para editar la factura seleccionada y actualizarla
    public function editInvoice($id){

        // Obtenemos la factura
        $invoice = Factura::find($id);

        // Si la factura no se encuentra
        if (!$invoice) {
            return redirect()->route('adm_view_invoices')->with('error', 'Factura no encontrada');
        }

        // Obtener los valores distintos de estados
        $estados = Factura::select('estado')->distinct()->where('estado', '!=', $invoice->estado)->orderBy('estado', 'asc')->get();

        // Obtenemos los administrativos para asignarle la factura
        $administrativos = User::where('rol', 'administrativo')->where('id', '!=', $invoice->usuario->id)->orderBy('nombre', 'asc')->get();



        return view('paginas.admin.edit_invoice', compact('invoice', 'estados', 'administrativos'));
    }

    public function updateInvoice($id, Request $request){

        // Validamos los datos del formulario
        $request->validate([
            'fecha_emision' => 'required|date|before_or_equal:today',
            'estado' => 'required|string|max:255',
            'id_administrativo' => 'required|exists:usuarios,id',
        ]);

        // Se actualiza la factura
        Factura::where('id', $id)->update([
            'fecha_emision' => $request->fecha_emision,
            'estado' => $request->estado,
            'id_usuario' => $request->id_administrativo,
        ]);

        return redirect()->route('adm_view_invoices')->with('status', 'La Factura ha sido actualizada correctamente.');
    }

    // -------------------------------------------------- Metodos para la tabla configuracion factura --------------------------------------------------
    // Metodo para mostrar los detalles de la configuracion de la factura
    public function viewConfigInvoice(){

        // Obtenemos los detalles
        $configInvoice = ConfiguracionFactura::paginate(10);

        return view('paginas.admin.view_config_invoice', compact('configInvoice'));
    }

    // Metodos para editar la configuracion de la factura y actualizarla
    public function editConfigInvoice($id){

        // Obtenemos los detalles de la configuracion
        $configInvoice = ConfiguracionFactura::find($id);

        // Si la configuracion de la factura no se encuentra
        if (!$configInvoice) {
            return redirect()->route('adm_view_config_invoice')->with('error', 'Configuración de la factura no encontrada');
        }

        return view('paginas.admin.edit_config_invoice', compact('configInvoice'));
    }

    public function updateConfigInvoice($id, Request $request){

        // Validamos los datos del formulario
        $request->validate([
            'iva' => 'required|numeric',
            'mano_obra' => 'required|numeric',
        ]);

        // Se actualiza la configuracion de la factura
        ConfiguracionFactura::where('id', $id)->update([
            'iva' =>$request->iva,
            'precio_mano_obra' => $request->mano_obra,
        ]);

        return redirect()->route('adm_view_config_invoice')->with('status', 'La configuración de la Factura ha sido actualizada correctamente.');

    }

}
