<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PaginaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JefeTallerController;
use App\Http\Controllers\MecanicoController;
use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Rutas para la vista de inicio, promociones y sobre nosotros
Route::get('/', [PaginaController::class, 'principal'])->name('inicio');
Route::get('/promociones', [PaginaController::class, 'promociones'])->name('promociones');
Route::get('/sobre_nosotros', [PaginaController::class, 'sobre_nosotros'])->name('sobre_nosotros');

// Rutas del footer
Route::get('/menciones_legales', [PaginaController::class, 'menciones_legales'])->name('menciones_legales');
Route::get('/terminos_de_uso', [PaginaController::class, 'terminos_uso'])->name('terminos_uso');

// Rutas de iniciar sesion y cerrar sesion
Route::get('/iniciar_sesion', [AuthController::class, 'loginForm'])->name('login_form')->middleware('guest');
Route::post('/iniciar_sesion', [AuthController::class, 'login_auth'])->name('login_auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas de recuperar contraseña
Route::get('/recuperar_contraseña', [AuthController::class, 'forgot_password'])->name('forgot_password');
Route::post('/recuperar_contraseña', [AuthController::class, 'email_password'])->name('email_password');
Route::get('/restablecer_contraseña/{token}', [AuthController::class, 'reset_password'])->name('password.reset');
Route::post('/restablecer_contraseña', [AuthController::class, 'update_password'])->name('update_password');

// Rutas de registrar usuario
Route::get('/registrar', [AuthController::class, 'registerForm'])->name('register_form')->middleware('guest');
Route::post('/registrar', [AuthController::class, 'register'])->name('register');

// Rutass para verificar el usuario registrado
Route::get('/verificar-correo/{id}/{hash}', [AuthController::class, 'verify'])->name('verification.verify');

// Rutas para verificar si el usuario o email estan en uso
Route::post('/validar_usuario_email', [AuthController::class, 'validarUsuarioEmail'])->name('validar_usuario_email');

// Rutas para mostrar los datos del usuario autenticado
Route::get('/perfil', [AuthController::class, 'userProfile'])->name('user_profile')->middleware('auth');

// Rutas para editar perfil
Route::get('/editar-perfil', [AuthController::class, 'editProfile'])->name('edit_profile')->middleware('auth');
Route::post('/editar-perfil', [AuthController::class, 'updateProfile'])->name('update_profile')->middleware('auth');

// Rutas para cambiar contraseña
Route::get('/cambiar-contraseña', [AuthController::class, 'changePassword'])->name('change_password')->middleware('auth');
Route::post('/cambiar-contraseña', [AuthController::class, 'updatePassword'])->name('update_password')->middleware('auth');

// Rutas para eliminar un usuario
Route::get('/eliminar-usuario', [AuthController::class, 'confirmDelete'])->name('confirm_delete_user')->middleware('auth');
Route::delete('/eliminar-usuario', [AuthController::class, 'deleteUser'])->name('delete_user')->middleware('auth');

// -------------------------------------------------- Rutas para el rol jefe taller --------------------------------------------------
// Ruta para cargar la vista de las reparaciones asignadas
Route::get('/jefe_taller/reparaciones_asignadas', [JefeTallerController::class, 'assignedRepairs'])->name('assigned_repairs')->middleware('rol:jefe_taller');

// Rutas para añadir reparacion y asignar al mecanico
Route::get('/jefe_taller/anadir_reparacion', [JefeTallerController::class, 'formAddRepair'])->name('form_add_repair')->middleware('rol:jefe_taller');
Route::post('/jefe_taller/anadir_reparacion', [JefeTallerController::class, 'addRepair'])->name('add_repair')->middleware('rol:jefe_taller');

// Rutas AJAX para buscar usuario y sus vehiculos
Route::get('/jefe_taller/search-users', [JefeTallerController::class, 'searchUsers'])->name('search_users')->middleware('rol:jefe_taller');
Route::get('/jefe_taller/get-vehiculos/{userId}', [JefeTallerController::class, 'getVehiculosByUser'])->name('get_vehiculos')->middleware('rol:jefe_taller');

// Rutas para editar una reparacion asignada, recoger el id de la reparacion para editar y actualizar la reparacion
Route::get('/jefe_taller/editar_reparacion', [JefeTallerController::class, 'selectRepair'])->name('select_repair')->middleware('rol:jefe_taller');
Route::get('/jefe_taller/reparacion/{id}/editar', [JefeTallerController::class, 'editRepair'])->name('edit_repair')->middleware('rol:jefe_taller');
Route::put('/jefe_taller/reparacion/{id}', [JefeTallerController::class, 'updateRepair'])->name('update_repair')->middleware('rol:jefe_taller');

// Rutas para cargar la vista de las reparaciones y eliminar reparacion
Route::get('/jefe_taller/eliminar_reparacion', [JefeTallerController::class, 'selectDeleteRepair'])->name('select_delete_repair')->middleware('rol:jefe_taller');
Route::delete('/jefe_taller/eliminar_reparacion/{id}', [JefeTallerController::class, 'deleteRepair'])->name('delete_repair')->middleware('rol:jefe_taller');
// Ruta para controlar que se ponga la url para eliminar una reparacion
Route::get('/jefe_taller/eliminar_reparacion/{id}', [JefeTallerController::class, 'deleteRepairURL'])->name('delete_repair_url')->middleware('rol:jefe_taller');

// Ruta para cargar la vista de reparaciones en proceso
Route::get('/jefe_taller/reparaciones_enProceso', [JefeTallerController::class, 'repairsInProgress'])->name('repairs_inProgress')->middleware('rol:jefe_taller');

// Rutas para cargar la vista con las categorias, poder actualizarlas e insertar una categoria
Route::get('/jefe_taller/categorias', [JefeTallerController::class, 'categories'])->name('categories')->middleware('rol:jefe_taller');
Route::post('/jefe_taller/categorias', [JefeTallerController::class, 'addCategorie'])->name('add_categorie')->middleware('rol:jefe_taller');
Route::get('/jefe_taller/categoria/{id}/editar', [JefeTallerController::class, 'editCategorie'])->name('edit_categorie')->middleware('rol:jefe_taller');
Route::put('/jefe_taller/categoria/{id}', [JefeTallerController::class, 'updateCategorie'])->name('update_categorie')->middleware('rol:jefe_taller');
Route::delete('/jefe_taller/eliminar_categoria/{id}', [JefeTallerController::class, 'deleteCategorie'])->name('delete_categorie')->middleware('rol:jefe_taller');
// Ruta para controlar que se ponga la url para eliminar una categoria
Route::get('/jefe_taller/eliminar_categoria/{id}', [JefeTallerController::class, 'deleteCategorieURL'])->name('delete_categorie_url')->middleware('rol:jefe_taller');

// -------------------------------------------------- Rutas para el rol mecanico --------------------------------------------------
// Ruta para cargar la vista con las reparaciones asignadas
Route::get('/mecanico/reparaciones_asignadas', [MecanicoController::class, 'assignedRepairs'])->name('assigned_repairs_mechanic')->middleware('rol:mecanico');

// Ruta para proceder a reparar una reparacion asignada, y controlar que no pueda hacerlo desde la url
Route::get('/mecanico/reparaciones_asignadas/{id}', [MecanicoController::class, 'repairURL'])->name('repair_mechanic_URL')->middleware('rol:mecanico');
Route::put('/mecanico/reparaciones_asignadas/{id}', [MecanicoController::class, 'repair'])->name('repair_mechanic')->middleware('rol:mecanico');

// Ruta para cargar la vista con las reparaciones en proceso
Route::get('/mecanico/reparaciones_enProceso', [MecanicoController::class, 'repairsInProgress'])->name('repairs_inProgress_mechanic')->middleware('rol:mecanico');

// Rutas para controlar que no se pueda cancelar la reparacion y volver a reparaciones asignadas mediante la url y para cancelar una reparacion y volver a asignada
Route::get('/mecanico/reparaciones_enProceso/{id}', [MecanicoController::class, 'repairInProgressURL'])->name('repair_inProgress_mechanic_url')->middleware('rol:mecanico');
Route::put('/mecanico/reparaciones_enProceso/{id}', [MecanicoController::class, 'repairBack'])->name('repair_back_mechanic')->middleware('rol:mecanico');

// Ruta para cargar la vista donde se añadiran los detalles de la reparacion
Route::get('/mecanico/reparacion_completar/{id}/detalles', [MecanicoController::class, 'repairCompleted'])->name('repair_completed_mechanic')->middleware('rol:mecanico');

// Ruta para agregar los detalles de la reparacion completada
Route::post('/mecanico/reparacion_detalles/{id}', [MecanicoController::class, 'repairAddDetails'])->name('repair_add_details')->middleware('rol:mecanico');

// Ruta para cargar la vista con las reparaciones completadas
Route::get('/mecanico/reparaciones_completadas', [MecanicoController::class, 'completedRepairs'])->name('completed_repairs_mechanic')->middleware('rol:mecanico');

// -------------------------------------------------- Rutas para el rol administrativo --------------------------------------------------
// Ruta para cargar la vista con las reparaciones que estan completadas y no tienen factura
Route::get('/administrativo/realizar_factura', [AdministrativoController::class, 'makeInvoice'])->name('make_invoice')->middleware('rol:administrativo');

// Ruta para completar la factura de la reparacion seleccionada introduciendo precios, iva, descuento, etc...
Route::get('/administrativo/realizar_factura/{id}/detalles', [AdministrativoController::class, 'invoiceCompleted'])->name('invoice_completed')->middleware('rol:administrativo');

// Ruta para agregar la factura y actualizar los datos de los detalles de la reparacion
Route::post('/administrativo/realizar_factura/{id}', [AdministrativoController::class, 'addInvoice'])->name('add_invoice')->middleware('rol:administrativo');

// Ruta para cargar las facturas en la vista
Route::get('/administrativo/ver_factura', [AdministrativoController::class, 'viewInvoice'])->name('view_invoice')->middleware('rol:administrativo');

// Ruta AJAX para buscar usuario
Route::get('/administrativo/search-invoices', [AdministrativoController::class, 'searchInvoices'])->name('search_invoices')->middleware('rol:administrativo');

// Ruta para cargar las facturas del cliente buscado
Route::get('/administrativo/ver_facturas_cliente', [AdministrativoController::class, 'invoicesClient'])->name('view_invoices_client')->middleware('rol:administrativo');

// Ruta para mostrar la factura en PDF
Route::get('/administrativo/ver_factura_pdf/{id}', [AdministrativoController::class, 'viewInvoicePDF'])->name('view_invoice_PDF')->middleware('rol:administrativo');

// Ruta para mostrar las facturas que estan pendientes para poder editarlas, por si tuviese algun error
Route::get('/administrativo/seleccionar_factura', [AdministrativoController::class, 'selectInvoice'])->name('select_invoice')->middleware('rol:administrativo');

// Ruta para editar los campos de la factura seleccionada
Route::get('/administrativo/editar_factura/{id}', [AdministrativoController::class, 'editInvoice'])->name('edit_invoice')->middleware('rol:administrativo');

// Ruta para actualizar los campos de la factura editada
Route::post('/administrativo/actualizar_factura/{id}', [AdministrativoController::class, 'updateInvoice'])->name('update_invoice')->middleware('rol:administrativo');

// Ruta para mostrar las facturas pendientes de pago para realizar el cobro
Route::get('/administrativo/cobrar_factura', [AdministrativoController::class, 'collectInvoice'])->name('collect_invoice')->middleware('rol:administrativo');
Route::put('/administrativo/cobrar_factura/{id}', [AdministrativoController::class, 'collectInvoiceUpdate'])->name('collect_invoice_update')->middleware('rol:administrativo');

// Ruta para mostrar las facturas completadas por el usuario administrativo autenticado
Route::get('/administrativo/facturas_completadas', [AdministrativoController::class, 'completedInvoices'])->name('completed_invoices')->middleware('rol:administrativo');

// -------------------------------------------------- Rutas para el rol cliente --------------------------------------------------
// Ruta para cargar la vista con los vehiculos y maquinarias del usuario cliente autenticado
Route::get('/cliente/mis_vehiculos-maquinarias', [ClienteController::class, 'myVehiclesMachinerys'])->name('my_vehicles_machinerys')->middleware('rol:cliente');

// Ruta para cargar la vista con el vehiculo o maquina seleccionada para poder editar los datos
Route::get('/cliente/editar_vehiculos-maquinarias/{id}', [ClienteController::class, 'editVehiclesMachinerys'])->name('edit_vehicles_machinerys')->middleware('rol:cliente');

// Ruta para actualizar el vehiculo o maquina con los datos nuevos
Route::put('/cliente/update_vehiculos-maquinarias/{id}', [ClienteController::class, 'updateVehicleMachinery'])->name('update_vehicle_machinery')->middleware('rol:cliente');

// Ruta para eliminar un vehiculo o maquina
Route::delete('/cliente/eliminar_vehiculo-maquina/{id}', [ClienteController::class, 'deleteVehicleMachinery'])->name('delete_vehicle_machinery')->middleware('rol:cliente');

// Ruta para cargar la vista con las reparaciones del cliente autenticado
Route::get('/cliente/mis_reparaciones', [ClienteController::class, 'myRepairs'])->name('my_repairs')->middleware('rol:cliente');

// Ruta para cargar la vista para insertar vehiculo o maquina
Route::get('/cliente/insertar_vehiculo-maquinaria', [ClienteController::class, 'insertVehicleMachinery'])->name('insert_vehicle_machinery')->middleware('rol:cliente');

// Ruta para añadir el vehiculo o maquina del cliente autenticado
Route::post('/cliente/insertar_vehiculo-maquinaria', [ClienteController::class, 'addVehicleMachinery'])->name('add_vehicle_machinery')->middleware('rol:cliente');

// Ruta para cargar la vista con las facturas del cliente autenticado
Route::get('/cliente/mis_facturas', [ClienteController::class, 'myInvoices'])->name('my_invoices')->middleware('rol:cliente');

// Ruta para ver la factura en PDF del usuario autenticado
Route::get('/cliente/mi_factura_pdf/{id}', [ClienteController::class, 'myInvoicePDF'])->name('my_invoice_PDF')->middleware('rol:cliente');

// -------------------------------------------------- Rutas para el rol administrador --------------------------------------------------
// ------------------------ Usuarios --------------------------
// Ruta para cargar la vista con los usuarios
Route::get('/admin/ver_usuarios', [AdminController::class, 'viewUsers'])->name('view_users')->middleware('rol:administrador');

// Ruta AJAX para buscar usuario
Route::get('/admin/search-user', [AdminController::class, 'searchUser'])->name('search_user')->middleware('rol:administrador');

// Ruta para cargar el usuario buscado
Route::get('/admin/ver_usuario_buscado', [AdminController::class, 'viewUserSearch'])->name('view_user_search')->middleware('rol:administrador');

// Rutas para mostrar la vista con el formulario para insertar un usuario y para añadir el usuario
Route::get('/admin/insertar_usuario', [AdminController::class, 'formInsertUser'])->name('form_insert_user')->middleware('rol:administrador');
Route::post('/admin/insertar_usuario', [AdminController::class, 'insertUser'])->name('insert_user')->middleware('rol:administrador');

// Ruta para editar el usuario seleccionado y actualizarlo
Route::get('/admin/editar_usuario/{id}', [AdminController::class, 'editUser'])->name('edit_user')->middleware('rol:administrador');
Route::put('/admin/update_usuario/{id}', [AdminController::class, 'updateUser'])->name('update_user')->middleware('rol:administrador');

// Ruta para eliminar un usuario
Route::delete('/admin/eliminar_usuario/{id}', [AdminController::class, 'deleteUser'])->name('delete_user_adm')->middleware('rol:administrador');

// ------------------------ Categorias --------------------------
// Ruta para cargar la vista con las categorias
Route::get('/admin/ver_categorias', [AdminController::class, 'viewCategories'])->name('view_categories')->middleware('rol:administrador');

// Rutas para mostrar la vista con el formulario para insertar una categoria y para añadir la categoria
Route::get('/admin/insertar_categoria', [AdminController::class, 'formInsertCategory'])->name('form_insert_category')->middleware('rol:administrador');
Route::post('/admin/insertar_categoria', [AdminController::class, 'insertCategory'])->name('insert_category')->middleware('rol:administrador');

// Ruta para editar la categoria seleccionada y actualizarla
Route::get('/admin/editar_categoria/{id}', [AdminController::class, 'editCategory'])->name('edit_category')->middleware('rol:administrador');
Route::put('/admin/update_categoria/{id}', [AdminController::class, 'updateCategory'])->name('update_category')->middleware('rol:administrador');

// Ruta para eliminar una categoria
Route::delete('/admin/eliminar_categoria/{id}', [AdminController::class, 'deleteCategory'])->name('delete_category')->middleware('rol:administrador');

// ------------------------ Vehiculos/Maquinarias --------------------------
// Ruta para cargar la vista con los vehiculos/maquinarias
Route::get('/admin/ver_vehiculos_maquinarias', [AdminController::class, 'viewVehiclesMachinerys'])->name('adm_view_vehicles_machinerys')->middleware('rol:administrador');

// Ruta para cargar el usuario buscado con sus vehiculos o maquinarias
Route::get('/admin/ver_usuario_vehiculos_maquinarias', [AdminController::class, 'viewUservehicles'])->name('view_user_vehicles')->middleware('rol:administrador');

// Rutas para mostrar la vista con el formulario para insertar un vehiculo o maquinaria y para añadir el vehiculo o la maquinaria
Route::get('/admin/insertar_vehiculo_maquinaria', [AdminController::class, 'formInsertVehicle'])->name('form_insert_vehicle')->middleware('rol:administrador');
Route::post('/admin/insertar_vehiculo_maquinaria', [AdminController::class, 'insertVehicle'])->name('adm_insert_vehicle')->middleware('rol:administrador');

// Ruta para editar el vehiculo o maquinaria seleccionada y actualizarla
Route::get('/admin/editar_vehiculo_maquinaria/{id}', [AdminController::class, 'editVehicle'])->name('adm_edit_vehicle')->middleware('rol:administrador');
Route::put('/admin/update_vehiculo_maquinaria/{id}', [AdminController::class, 'updateVehicle'])->name('adm_update_vehicle')->middleware('rol:administrador');

// Ruta para eliminar un vehiculo o maquinaria
Route::delete('/admin/eliminar_vehiculo_maquinaria/{id}', [AdminController::class, 'deleteVehicle'])->name('adm_delete_vehicle')->middleware('rol:administrador');

// ------------------------ Reparaciones --------------------------
// Ruta para cargar la vista con las reparaciones
Route::get('/admin/ver_reparaciones', [AdminController::class, 'viewRepairs'])->name('adm_view_repairs')->middleware('rol:administrador');

// Ruta para cargar el usuario buscado y mostrar sus reparaciones
Route::get('/admin/ver_usuario_reparaciones', [AdminController::class, 'viewUserRepairs'])->name('view_user_repairs')->middleware('rol:administrador');

// Rutas para mostrar la vista con el formulario para insertar una reparacion y para añadir la reparacion
Route::get('/admin/insertar_reparacion', [AdminController::class, 'formInsertRepair'])->name('form_insert_repair')->middleware('rol:administrador');
Route::post('/admin/insertar_reparacion', [AdminController::class, 'insertRepair'])->name('adm_insert_repair')->middleware('rol:administrador');

// Rutas AJAX para seleccionar el vehiculo maquinaria del usuario buscado
Route::get('/admin/get-vehiculos/{userId}', [AdminController::class, 'getVehiculosByUser'])->name('adm_get_vehiculos')->middleware('rol:administrador');

// Ruta para editar la reparacion seleccionada y actualizarla
Route::get('/admin/editar_reparacion/{id}', [AdminController::class, 'editRepair'])->name('adm_edit_repair')->middleware('rol:administrador');
Route::put('/admin/update_reparacion/{id}', [AdminController::class, 'updateRepair'])->name('adm_update_repair')->middleware('rol:administrador');

// Ruta para eliminar una reparacion
Route::delete('/admin/eliminar_reparacion/{id}', [AdminController::class, 'deleteRepair'])->name('adm_delete_repair')->middleware('rol:administrador');

// ------------------------ Detalles Reparacion --------------------------
// Ruta para cargar la vista con los detalles de la reparacion
Route::get('/admin/ver_detalles_reparacion/{id}', [AdminController::class, 'viewDetailsRepair'])->name('adm_view_details_repair')->middleware('rol:administrador');

// Rutas para mostrar la vista con el formulario para insertar un detalle a la reparacion y para añadir el detalle
Route::get('/admin/insertar_detalle', [AdminController::class, 'formInsertDetail'])->name('form_insert_detail')->middleware('rol:administrador');
Route::post('/admin/insertar_detalle', [AdminController::class, 'insertDetail'])->name('adm_insert_detail')->middleware('rol:administrador');

// Ruta para editar el detalle de un vehiculo o maquinaria seleccionado y actualizarla
Route::get('/admin/editar_detalle/{id}', [AdminController::class, 'editDetail'])->name('adm_edit_detail')->middleware('rol:administrador');
Route::put('/admin/update_detalle/{id}', [AdminController::class, 'updateDetail'])->name('adm_update_detail')->middleware('rol:administrador');

// Ruta para eliminar un detalle de una reparacion
Route::delete('/admin/eliminar_detalle/{id}', [AdminController::class, 'deleteDetail'])->name('adm_delete_detail')->middleware('rol:administrador');

// ------------------------ Facturas --------------------------
// Ruta para cargar la vista con las facturas
Route::get('/admin/ver_facturas', [AdminController::class, 'viewInvoices'])->name('adm_view_invoices')->middleware('rol:administrador');

// Ruta AJAX para buscar usuario
Route::get('/admin/search-invoices', [AdminController::class, 'searchInvoices'])->name('adm_search_invoices')->middleware('rol:administrador');

// Ruta para cargar las facturas del cliente buscado
Route::get('/admin/ver_facturas_cliente', [AdminController::class, 'invoicesClient'])->name('adm_view_invoices_client')->middleware('rol:administrador');

// Ruta para cargar la vista con las reparaciones pendientes de facturar
Route::get('/admin/ver_reparaciones_facturar', [AdminController::class, 'viewRepairsInvoice'])->name('adm_view_repairs_invoice')->middleware('rol:administrador');

// Ruta para completar la factura de la reparacion seleccionada introduciendo precios, iva, descuento, etc... y para insertar la factura
Route::get('/admin/insertar_factura/{id}/detalles', [AdminController::class, 'formInsertInvoice'])->name('form_insert_invoice')->middleware('rol:administrador');
Route::post('/admin/insertar_factura/{id}', [AdminController::class, 'insertInvoice'])->name('adm_insert_invoice')->middleware('rol:administrador');

// Ruta para editar la factura seleccionada y actualizarla
Route::get('/admin/editar_factura/{id}', [AdminController::class, 'editInvoice'])->name('adm_edit_invoice')->middleware('rol:administrador');
Route::put('/admin/update_factura/{id}', [AdminController::class, 'updateInvoice'])->name('adm_update_invoice')->middleware('rol:administrador');

// ------------------------ Configuracion Factura --------------------------
// Ruta para cargar la vista con los detalles de configuracion de la factura
Route::get('/admin/ver_configuracion_factura', [AdminController::class, 'viewConfigInvoice'])->name('adm_view_config_invoice')->middleware('rol:administrador');

// Ruta para editar la configuracion de la factura y actualizarla
Route::get('/admin/editar_configuracion_factura/{id}', [AdminController::class, 'editConfigInvoice'])->name('adm_edit_config_invoice')->middleware('rol:administrador');
Route::put('/admin/update_configuracion_factura/{id}', [AdminController::class, 'updateConfigInvoice'])->name('adm_update_config_invoice')->middleware('rol:administrador');

// -------------------------------------------------- Rutas para Acerca de y Ayuda --------------------------------------------------
// Ruta para cargar la vista de acerca de
Route::get('/acerca_de', [PaginaController::class, 'acercade'])->name('acerca_de');

// Rutas para cargar las vistas de las paginas de ayuda de cada rol
Route::get('/ayuda_registrar', [PaginaController::class, 'helpRegister'])->name('help_register');
Route::get('/ayuda_cliente', [PaginaController::class, 'helpClient'])->name('help_client')->middleware('rol:cliente');
Route::get('/ayuda_jefe_taller', [PaginaController::class, 'helpBoss'])->name('help_boss')->middleware('rol:jefe_taller');
Route::get('/ayuda_mecanico', [PaginaController::class, 'helpMechanic'])->name('help_mechanic')->middleware('rol:mecanico');
Route::get('/ayuda_administrativo', [PaginaController::class, 'helpAdministrative'])->name('help_administrative')->middleware('rol:administrativo');
Route::get('/ayuda_admin', [PaginaController::class, 'helpAdmin'])->name('help_admin')->middleware('rol:administrador');

