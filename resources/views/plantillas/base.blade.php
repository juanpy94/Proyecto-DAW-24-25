<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- favicon -->
    <link rel="icon" href="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/favicon.png') }}" sizes="32x32" type="image/png">

    <title>@yield('titulo')</title>

    <!-- Enlace para usar bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
	integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
</head>
<body class="d-flex flex-column min-vh-100">

    <header class="text-center" style="background-color: rgba(0, 0, 0, 0.30);">
        
        <div class="col-8 col-md-6 col-lg-4 mx-auto mt-3">
            <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/logo_repar.png') }}" class="img-fluid">
        </div>
        
        @include('plantillas.menu_hamburguesa')

        <nav class="navbar navbar-expand-lg p-3 d-none d-xl-block mt-3" style="background: #d35400;">
            
            <div class="container-fluid">

                <ul class='navbar-nav mx-auto mb-2 mb-md-0'>

                    <!-- ------------------------------ Inicio ------------------------------ -->
                    @if (Route::is('inicio')) 
                        <li class='nav-item me-4'>
                            <a href="{{ route('inicio') }}" class="btn btn-secondary rounded-pill">Inicio</a>
                        </li>
                    @else
                        <li class='nav-item me-4'>
                            <a href="{{ route('inicio') }}" class="btn btn-dark rounded-pill">Inicio</a>
                        </li>
                    @endif

                    <!-- ------------------------------ Promociones y sobre nosotros ------------------------------ -->
                    @guest
                        @if (Route::is('promociones')) 
                            <li class="nav-item me-4">
                                <a href="{{ route('promociones') }}" class="btn btn-secondary rounded-pill">Promociones</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('promociones') }}" class="btn btn-dark rounded-pill">Promociones</a>
                            </li>
                        @endif
                        @if (Route::is('sobre_nosotros')) 
                            <li class="nav-item me-4">
                                <a href="{{ route('sobre_nosotros') }}" class="btn btn-secondary rounded-pill">Sobre Nosotros</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('sobre_nosotros') }}" class="btn btn-dark rounded-pill">Sobre Nosotros</a>
                            </li>
                        @endif
                    @endguest

                    <!-- ------------------------------ Roles autenticados ------------------------------ -->
                    @auth
                    <!-- ------------------------------ Administrador ------------------------------ -->
                        @if (auth()->user()->rol === 'administrador')

                            @if (Route::is('view_users') || Route::is('form_insert_user') || Route::is('edit_user')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('view_users') }}" class="btn btn-secondary rounded-pill">Usuarios</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('view_users') }}" class="btn btn-dark rounded-pill">Usuarios</a>
                                </li>
                            @endif

                            @if (Route::is('adm_view_vehicles_machinerys') || Route::is('form_insert_vehicle') || Route::is('adm_edit_vehicle') ||
                                Route::is('view_categories') || Route::is('form_insert_category') || Route::is('edit_category')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('adm_view_vehicles_machinerys') }}" class="btn btn-secondary rounded-pill">Vehículos/Maquinas</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('adm_view_vehicles_machinerys') }}" class="btn btn-dark rounded-pill">Vehículos/Maquinas</a>
                                </li>
                            @endif

                            @if (Route::is('adm_view_repairs') || Route::is('form_insert_repair') || Route::is('adm_edit_repair') ||
                                 Route::is('adm_view_details_repair') || Route::is('form_insert_detail') || Route::is('adm_edit_detail'))
                                <li class="nav-item me-4">
                                    <a href="{{ route('adm_view_repairs') }}" class="btn btn-secondary rounded-pill">Reparaciones</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('adm_view_repairs') }}" class="btn btn-dark rounded-pill">Reparaciones</a>
                                </li>
                            @endif

                            @if (Route::is('adm_view_invoices') || Route::is('adm_view_repairs_invoice') || Route::is('form_insert_invoice') ||
                                Route::is('adm_edit_invoice') || Route::is('adm_view_config_invoice') || Route::is('adm_edit_config_invoice'))
                                <li class="nav-item me-4">
                                    <a href="{{ route('adm_view_invoices') }}" class="btn btn-secondary rounded-pill">Facturas</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('adm_view_invoices') }}" class="btn btn-dark rounded-pill">Facturas</a>
                                </li>
                            @endif
                            
                        <!-- ------------------------------ Cliente ------------------------------ -->
                        @elseif (auth()->user()->rol === 'cliente')

                            @if (Route::is('my_vehicles_machinerys') || Route::is('edit_vehicles_machinerys') || Route::is('insert_vehicle_machinery')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('my_vehicles_machinerys') }}" class="btn btn-secondary rounded-pill">Vehículos/Máquinas</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('my_vehicles_machinerys') }}" class="btn btn-dark rounded-pill">Vehículos/Máquinas</a>
                                </li>
                            @endif

                            @if (Route::is('my_repairs')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('my_repairs') }}" class="btn btn-secondary rounded-pill">Reparaciones</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('my_repairs') }}" class="btn btn-dark rounded-pill">Reparaciones</a>
                                </li>
                            @endif

                            @if (Route::is('my_invoices')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('my_invoices') }}" class="btn btn-secondary rounded-pill">Facturas</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('my_invoices') }}" class="btn btn-dark rounded-pill">Facturas</a>
                                </li>
                            @endif

                        <!-- ------------------------------ Jefe taller ------------------------------ -->
                        @elseif (auth()->user()->rol === 'jefe_taller')

                            @if (Route::is('assigned_repairs') || Route::is('form_add_repair') || Route::is('select_repair') || Route::is('edit_repair') || Route::is('select_delete_repair')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('assigned_repairs') }}" class="btn btn-secondary rounded-pill">Reparaciones</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('assigned_repairs') }}" class="btn btn-dark rounded-pill">Reparaciones</a>
                                </li>
                            @endif

                            @if (Route::is('repairs_inProgress')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('repairs_inProgress') }}" class="btn btn-secondary rounded-pill">En Proceso</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('repairs_inProgress') }}" class="btn btn-dark rounded-pill">En Proceso</a>
                                </li>
                            @endif

                            @if (Route::is('categories') || Route::is('edit_categorie')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('categories') }}" class="btn btn-secondary rounded-pill">Categorías</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('categories') }}" class="btn btn-dark rounded-pill">Categorías</a>
                                </li>
                            @endif

                        <!-- ------------------------------ Mecanico ------------------------------ -->
                        @elseif (auth()->user()->rol === 'mecanico')

                            @if (Route::is('assigned_repairs_mechanic')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('assigned_repairs_mechanic') }}" class="btn btn-secondary rounded-pill">Reparaciones Asignadas</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('assigned_repairs_mechanic') }}" class="btn btn-dark rounded-pill">Reparaciones Asignadas</a>
                                </li>
                            @endif

                            @if (Route::is('repairs_inProgress_mechanic') || Route::is('repair_completed_mechanic')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('repairs_inProgress_mechanic') }}" class="btn btn-secondary rounded-pill">Reparaciones en Proceso</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('repairs_inProgress_mechanic') }}" class="btn btn-dark rounded-pill">Reparaciones en Proceso</a>
                                </li>
                            @endif
                        
                            @if (Route::is('completed_repairs_mechanic')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('completed_repairs_mechanic') }}" class="btn btn-secondary rounded-pill">Reparaciones Completadas</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('completed_repairs_mechanic') }}" class="btn btn-dark rounded-pill">Reparaciones Completadas</a>
                                </li>
                            @endif

                        <!-- ------------------------------ Administrativo ------------------------------ -->
                        @elseif (auth()->user()->rol === 'administrativo')

                            @if (Route::is('make_invoice') || Route::is('invoice_completed') || Route::is('view_invoice') || Route::is('select_invoice') || Route::is('edit_invoice')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('make_invoice') }}" class="btn btn-secondary rounded-pill">Facturas</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('make_invoice') }}" class="btn btn-dark rounded-pill">Facturas</a>
                                </li>
                            @endif
                            
                            @if (Route::is('collect_invoice')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('collect_invoice') }}" class="btn btn-secondary rounded-pill">Cobrar Factura</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('collect_invoice') }}" class="btn btn-dark rounded-pill">Cobrar Factura</a>
                                </li>
                            @endif

                            @if (Route::is('completed_invoices')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('completed_invoices') }}" class="btn btn-secondary rounded-pill">Facturas Completadas</a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('completed_invoices') }}" class="btn btn-dark rounded-pill">Facturas Completadas</a>
                                </li>
                            @endif

                        @endif
                    @endauth

                    <!-- ------------------------------ acerca de ------------------------------ -->
                    @if (Route::is('acerca_de')) 
                        <li class='nav-item me-4'>
                            <a href="{{ route('acerca_de') }}" class="btn btn-secondary rounded-pill">Acerca de</a>
                        </li>
                    @else
                        <li class='nav-item me-4'>
                            <a href="{{ route('acerca_de') }}" class="btn btn-dark rounded-pill">Acerca de</a>
                        </li>
                    @endif

                    <!-- ------------------------------ Ayuda ------------------------------ -->

                    @guest
                        @if (Route::is('help_register')) 
                            <li class="nav-item me-4">
                                <a href="{{ route('help_register') }}" class="">
                                    <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/ayuda.png') }}" alt="icono ayuda" class="img-fluid bg-secondary rounded-circle" style="width: 35px;">
                                </a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('help_register') }}" class="">
                                    <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/ayuda.png') }}" alt="icono ayuda" class="img-fluid bg-light rounded-circle" style="width: 35px;">
                                </a>
                            </li>
                        @endif
                    @endguest

                    @auth
                        @if (auth()->user()->rol === 'administrador')

                            @if (Route::is('help_admin')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('help_admin') }}" class="">
                                        <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/ayuda.png') }}" alt="icono ayuda" class="img-fluid bg-secondary rounded-circle" style="width: 35px;">
                                    </a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('help_admin') }}" class="">
                                        <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/ayuda.png') }}" alt="icono ayuda" class="img-fluid bg-light rounded-circle" style="width: 35px;">
                                    </a>
                                </li>
                            @endif

                        @elseif (auth()->user()->rol === 'cliente')

                            @if (Route::is('help_client')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('help_client') }}" class="">
                                        <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/ayuda.png') }}" alt="icono ayuda" class="img-fluid bg-secondary rounded-circle" style="width: 35px;">
                                    </a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('help_client') }}" class="">
                                        <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/ayuda.png') }}" alt="icono ayuda" class="img-fluid bg-light rounded-circle" style="width: 35px;">
                                    </a>
                                </li>
                            @endif

                        @elseif (auth()->user()->rol === 'jefe_taller')

                            @if (Route::is('help_boss')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('help_boss') }}" class="">
                                        <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/ayuda.png') }}" alt="icono ayuda" class="img-fluid bg-secondary rounded-circle" style="width: 35px;">
                                    </a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('help_boss') }}" class="">
                                        <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/ayuda.png') }}" alt="icono ayuda" class="img-fluid bg-light rounded-circle" style="width: 35px;">
                                    </a>
                                </li>
                            @endif

                        @elseif (auth()->user()->rol === 'mecanico')

                            @if (Route::is('help_mechanic')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('help_mechanic') }}" class="">
                                        <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/ayuda.png') }}" alt="icono ayuda" class="img-fluid bg-secondary rounded-circle" style="width: 35px;">
                                    </a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('help_mechanic') }}" class="">
                                        <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/ayuda.png') }}" alt="icono ayuda" class="img-fluid bg-light rounded-circle" style="width: 35px;">
                                    </a>
                                </li>
                            @endif

                        @elseif (auth()->user()->rol === 'administrativo')

                            @if (Route::is('help_administrative')) 
                                <li class="nav-item me-4">
                                    <a href="{{ route('help_administrative') }}" class="">
                                        <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/ayuda.png') }}" alt="icono ayuda" class="img-fluid bg-secondary rounded-circle" style="width: 35px;">
                                    </a>
                                </li>
                            @else
                                <li class="nav-item me-4">
                                    <a href="{{ route('help_administrative') }}" class="">
                                        <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/ayuda.png') }}" alt="icono ayuda" class="img-fluid bg-light rounded-circle" style="width: 35px;">
                                    </a>
                                </li>
                            @endif

                        @endif
                    @endauth

                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-md-0">

                    <!-- ------------------------------ Iniciar sesion ------------------------------ -->
                    @guest
                        @if (Route::is('login_form')) 
                            <li class="nav-item me-4">
                                <a href="{{ route('login_form') }}" class="btn btn-light rounded-pill" style="background-color: rgba(255, 255, 255, 0.75);">
                                    <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/icono_iniciar_sesion.png') }}" alt="icono iniciar sesion" class="img-fluid me-1">
                                    Iniciar sesión
                                </a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('login_form') }}" class="btn btn-light rounded-pill">
                                    <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/icono_iniciar_sesion.png') }}" alt="icono iniciar sesion" class="img-fluid me-1">
                                    Iniciar sesión
                                </a>
                            </li>
                        @endif

                        <!-- ------------------------------ Registrarse ------------------------------ -->
                        @if (Route::is('register_form')) 
                            <li class="nav-item me-4">
                                <a href="{{ route('register_form') }}" class="btn btn-light rounded-pill" style="background-color: rgba(255, 255, 255, 0.75);">
                                    <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/icono_registrarse.png') }}" alt="icono registrar usuario" class="img-fluid me-1">
                                    Registrarse
                                </a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('register_form') }}" class="btn btn-light rounded-pill">
                                    <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/icono_registrarse.png') }}" alt="icono registrar usuario" class="img-fluid me-1">    
                                    Registrarse
                                </a>
                            </li>
                        @endif
                    @endguest

                    <!-- ------------------------------ Nombre del usuario ------------------------------ -->
                    @auth
                        <li class="nav-item me-4">
                            <a href="{{ route('user_profile') }}" class="text-white text-decoration-none fs-4" title="Mi perfil">
                                {{ Auth::user()->usuario }}
                                <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/icono_user.png') }}" alt="icono usuario" class="img-fluid" style="max-width: 35px;">
                            </a>
                        </li>

                        <!-- ------------------------------ Cerrar sesion ------------------------------ -->
                        <li class="nav-item me-4">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-light rounded-pill">
                                    <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/icono_cerrar_sesion.png') }}" alt="icono cerrar sesion" class="img-fluid me-1">
                                    Cerrar sesión
                                </button>
                            </form>
                        </li>
                    @endauth

                </ul>

            </div>

        </nav>

    </header>

    <main class="flex-grow-1 text-center p-3">

        @yield('contenido')

    </main>

    <footer class="footer text-center p-3 bg-dark">

        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <!-- Enlaces a la izquierda -->
            <ul class="list-unstyled d-flex mb-0 flex-column flex-md-row text-center text-sm-start">
                <li class="me-2"><p class="text-white">Copyright ©2024</p></li>
                <li class="me-2 d-none d-md-inline"><p class="text-white">|</p></li>
                <li class="me-2"><a href="{{ route('menciones_legales') }}" class="text-white">Menciones legales</a></li>
                <li class="me-2 d-none d-md-inline"><p class="text-white">|</p></li>
                <li class="me-2"><a href="{{ route('terminos_uso') }}" class="text-white">Términos de Uso</a></li>
            </ul>

            <!-- Texto a la derecha -->
            <h5 class="fw-bold text-white mb-0 mt-3 mt-md-0">Juan Pablo Peñuela Cámara</h5>
        </div>
			
    </footer>
    
</body>
</html>