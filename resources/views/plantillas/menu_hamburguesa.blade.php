<nav class="navbar navbar-expand-xl navbar-light d-xl-none mt-3" style="background: #d35400;">
    <div class="container-fluid">

        <button class="navbar-toggler bg bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav2" aria-controls="navbarNav2" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon fs-6"></span>
        </button>

        <div class="ms-auto">
            <ul class="navbar-nav ms-auto mb-md-0">

                <!-- ------------------------------ Iniciar sesion y nombre del usuario autenticado ------------------------------ -->
                @guest
                    @if (Route::is('login_form')) 
                        <li class="nav-item">
                            <a href="{{ route('login_form') }}" class="btn btn-light rounded-pill" style="background-color: rgba(255, 255, 255, 0.75);">
                                <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/icono_iniciar_sesion.png') }}" alt="icono iniciar sesion" class="img-fluid me-1">
                                Iniciar sesión
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login_form') }}" class="btn btn-light rounded-pill">
                                <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/icono_iniciar_sesion.png') }}" alt="icono iniciar sesion" class="img-fluid me-1">
                                Iniciar sesión
                            </a>
                        </li>
                    @endif
                @endguest

                @auth
                    <li class="nav-item me-4">
                        <a href="{{ route('user_profile') }}" class="text-white text-decoration-none fs-4" title="Mi perfil">
                            {{ Auth::user()->usuario }}
                            <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/icono_user.png') }}" alt="icono login" class="img-fluid" style="max-width: 35px;">
                        </a>
                    </li>
                @endauth

            </ul>

        </div>

        <div class="collapse navbar-collapse" id="navbarNav2">
            <ul class="navbar-nav mx-auto mb-2 mb-md-0 mt-1 text-start fs-6 p-3 rounded-3" style="background-color: rgba(255, 255, 255, 0.25);">

                <!-- ------------------------------ Registrarse ------------------------------ -->
                @guest
                    @if (Route::is('register_form')) 
                        <li class="nav-item">
                            <a href="{{ route('register_form') }}" class="nav-link text-white fw-bold">Registrarse</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('register_form') }}" class="nav-link text-dark fw-bold">Registrarse</a>
                        </li>
                    @endif
                @endguest

                <!-- ------------------------------ Inicio ------------------------------ -->
                @if (Route::is('inicio')) 
                    <li class='nav-item'>
                        <a href="{{ route('inicio') }}" class="nav-link text-white fw-bold">Inicio</a>
                    </li>
                @else
                    <li class='nav-item'>
                        <a href="{{ route('inicio') }}" class="nav-link text-dark fw-bold">Inicio</a>
                    </li>
                @endif

                <!-- ------------------------------ Promociones y Sobre nosotros ------------------------------ -->
                @guest
                    @if (Route::is('promociones')) 
                        <li class="nav-item">
                            <a href="{{ route('promociones') }}" class="nav-link text-white fw-bold">Promociones</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('promociones') }}" class="nav-link text-dark fw-bold">Promociones</a>
                        </li>
                    @endif

                    @if (Route::is('sobre_nosotros')) 
                        <li class="nav-item">
                            <a href="{{ route('sobre_nosotros') }}" class="nav-link text-white fw-bold">Sobre Nosotros</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('sobre_nosotros') }}" class="nav-link text-dark fw-bold">Sobre Nosotros</a>
                        </li>
                    @endif
                @endguest

                <!-- ------------------------------ Roles autenticados ------------------------------ -->
                @auth
                    <!-- ------------------------------ Cliente ------------------------------ -->
                    @if (auth()->user()->rol === 'cliente')

                        @if (Route::is('my_vehicles_machinerys') || Route::is('edit_vehicles_machinerys') || Route::is('insert_vehicle_machinery'))
                            <li class="nav-item me-4">
                                <a href="{{ route('my_vehicles_machinerys') }}" class="nav-link text-white fw-bold">Vehículos/Máquinas</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('my_vehicles_machinerys') }}" class="nav-link text-dark fw-bold">Vehículos/Máquinas</a>
                            </li>
                        @endif

                        @if (Route::is('my_repairs'))
                            <li class="nav-item me-4">
                                <a href="{{ route('my_repairs') }}" class="nav-link text-white fw-bold">Reparaciones</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('my_repairs') }}" class="nav-link text-dark fw-bold">Reparaciones</a>
                            </li>
                        @endif

                        @if (Route::is('my_invoices'))
                            <li class="nav-item me-4">
                                <a href="{{ route('my_invoices') }}" class="nav-link text-white fw-bold">Facturas</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('my_invoices') }}" class="nav-link text-dark fw-bold">Facturas</a>
                            </li>
                        @endif

                    <!-- ------------------------------ Administrador ------------------------------ -->
                    @elseif (auth()->user()->rol === 'administrador')

                        @if (Route::is('view_users') || Route::is('form_insert_user') || Route::is('edit_user'))
                            <li class="nav-item me-4">
                                <a href="{{ route('view_users') }}" class="nav-link text-white fw-bold">Usuarios</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('view_users') }}" class="nav-link text-dark fw-bold">Usuarios</a>
                            </li>
                        @endif

                        @if (Route::is('adm_view_vehicles_machinerys') || Route::is('form_insert_vehicle') || Route::is('adm_edit_vehicle') ||
                            Route::is('view_categories') || Route::is('form_insert_category') || Route::is('edit_category'))
                            <li class="nav-item me-4">
                                <a href="{{ route('adm_view_vehicles_machinerys') }}" class="nav-link text-white fw-bold">Vehículos/Maquinas</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('adm_view_vehicles_machinerys') }}" class="nav-link text-dark fw-bold">Vehículos/Maquinas</a>
                            </li>
                        @endif

                        @if (Route::is('adm_view_repairs') || Route::is('form_insert_repair') || Route::is('adm_edit_repair') ||
                            Route::is('adm_view_details_repair') || Route::is('form_insert_detail') || Route::is('adm_edit_detail'))
                            <li class="nav-item me-4">
                                <a href="{{ route('adm_view_repairs') }}" class="nav-link text-white fw-bold">Reparaciones</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('adm_view_repairs') }}" class="nav-link text-dark fw-bold">Reparaciones</a>
                            </li>
                        @endif

                        @if (Route::is('adm_view_invoices') || Route::is('adm_view_repairs_invoice') || Route::is('form_insert_invoice') ||
                        Route::is('adm_edit_invoice') || Route::is('adm_view_config_invoice') || Route::is('adm_edit_config_invoice'))
                            <li class="nav-item me-4">
                                <a href="{{ route('adm_view_invoices') }}" class="nav-link text-white fw-bold">Facturas</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('adm_view_invoices') }}" class="nav-link text-dark fw-bold">Facturas</a>
                            </li>
                        @endif

                    <!-- ------------------------------ Jefe taller ------------------------------ -->
                    @elseif (auth()->user()->rol === 'jefe_taller')

                        @if (Route::is('assigned_repairs') || Route::is('form_add_repair') || Route::is('select_repair') || Route::is('edit_repair') || Route::is('select_delete_repair')) 
                            <li class="nav-item me-4">
                                <a href="{{ route('assigned_repairs') }}" class="nav-link text-white fw-bold">Reparaciones</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('assigned_repairs') }}" class="nav-link text-dark fw-bold">Reparaciones</a>
                            </li>
                        @endif

                        @if (Route::is('repairs_inProgress')) 
                            <li class="nav-item me-4">
                                <a href="{{ route('repairs_inProgress') }}" class="nav-link text-white fw-bold">En Proceso</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('repairs_inProgress') }}" class="nav-link text-dark fw-bold">En Proceso</a>
                            </li>
                        @endif

                        @if (Route::is('categories') || Route::is('edit_categorie')) 
                            <li class="nav-item me-4">
                                <a href="{{ route('categories') }}" class="nav-link text-white fw-bold">Categorías</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('categories') }}" class="nav-link text-dark fw-bold">Categorías</a>
                            </li>
                        @endif

                    <!-- ------------------------------ Mecanico ------------------------------ -->
                    @elseif (auth()->user()->rol === 'mecanico')
                    
                        @if (Route::is('assigned_repairs_mechanic')) 
                            <li class="nav-item me-4">
                                <a href="{{ route('assigned_repairs_mechanic') }}" class="nav-link text-white fw-bold">Reparaciones Asignadas</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('assigned_repairs_mechanic') }}" class="nav-link text-dark fw-bold">Reparaciones Asignadas</a>
                            </li>
                        @endif

                        @if (Route::is('repairs_inProgress_mechanic') || Route::is('repair_completed_mechanic')) 
                            <li class="nav-item me-4">
                                <a href="{{ route('repairs_inProgress_mechanic') }}" class="nav-link text-white fw-bold">Reparaciones en Proceso</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('repairs_inProgress_mechanic') }}" class="nav-link text-dark fw-bold">Reparaciones en Proceso</a>
                            </li>
                        @endif
                        
                        @if (Route::is('completed_repairs_mechanic')) 
                            <li class="nav-item me-4">
                                <a href="{{ route('completed_repairs_mechanic') }}" class="nav-link text-white fw-bold">Reparaciones Completadas</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('completed_repairs_mechanic') }}" class="nav-link text-dark fw-bold">Reparaciones Completadas</a>
                            </li>
                        @endif

                    <!-- ------------------------------ Administrativo ------------------------------ -->
                    @elseif (auth()->user()->rol === 'administrativo')
                        
                        @if (Route::is('make_invoice') || Route::is('invoice_completed') || Route::is('view_invoice') || Route::is('select_invoice') || Route::is('edit_invoice'))
                            <li class="nav-item me-4">
                                <a href="{{ route('make_invoice') }}" class="nav-link text-white fw-bold">Facturas</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('make_invoice') }}" class="nav-link text-dark fw-bold">Facturas</a>
                            </li>
                        @endif

                        @if (Route::is('collect_invoice'))
                            <li class="nav-item me-4">
                                <a href="{{ route('collect_invoice') }}" class="nav-link text-white fw-bold">Cobrar Factura</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('collect_invoice') }}" class="nav-link text-dark fw-bold">Cobrar Factura</a>
                            </li>
                        @endif

                        @if (Route::is('completed_invoices'))
                            <li class="nav-item me-4">
                                <a href="{{ route('completed_invoices') }}" class="nav-link text-white fw-bold">Facturas Completadas</a>
                            </li>
                        @else
                            <li class="nav-item me-4">
                                <a href="{{ route('completed_invoices') }}" class="nav-link text-dark fw-bold">Facturas Completadas</a>
                            </li>
                        @endif

                    @endif
                @endauth

                <!-- ------------------------------ acerca de ------------------------------ -->

                @if (Route::is('acerca_de')) 
                    <li class='nav-item'>
                        <a href="{{ route('acerca_de') }}" class="nav-link text-white fw-bold">Acerca de</a>
                    </li>
                @else
                    <li class='nav-item'>
                        <a href="{{ route('acerca_de') }}" class="nav-link text-dark fw-bold">Acerca de</a>
                    </li>
                @endif

                <!-- ------------------------------ Ayuda ------------------------------ -->

                @guest
                    @if (Route::is('help_register')) 
                        <li class="nav-item">
                            <a href="{{ route('help_register') }}" class="nav-link text-white fw-bold">Ayuda</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('help_register') }}" class="nav-link text-dark fw-bold">Ayuda</a>
                        </li>
                    @endif
                @endguest

                @auth
                    @if (auth()->user()->rol === 'administrador')

                        @if (Route::is('help_admin')) 
                            <li class="nav-item">
                                <a href="{{ route('help_admin') }}" class="nav-link text-white fw-bold">Ayuda</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('help_admin') }}" class="nav-link text-dark fw-bold">Ayuda</a>
                            </li>
                        @endif

                    @elseif (auth()->user()->rol === 'cliente')

                        @if (Route::is('help_client')) 
                            <li class="nav-item">
                                <a href="{{ route('help_client') }}" class="nav-link text-white fw-bold">Ayuda</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('help_client') }}" class="nav-link text-dark fw-bold">Ayuda</a>
                            </li>
                        @endif

                    @elseif (auth()->user()->rol === 'jefe_taller')

                        @if (Route::is('help_boss')) 
                            <li class="nav-item">
                                <a href="{{ route('help_boss') }}" class="nav-link text-white fw-bold">Ayuda</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('help_boss') }}" class="nav-link text-dark fw-bold">Ayuda</a>
                            </li>
                        @endif

                    @elseif (auth()->user()->rol === 'mecanico')

                        @if (Route::is('help_mechanic')) 
                            <li class="nav-item">
                                <a href="{{ route('help_mechanic') }}" class="nav-link text-white fw-bold">Ayuda</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('help_mechanic') }}" class="nav-link text-dark fw-bold">Ayuda</a>
                            </li>
                        @endif
                            
                    @elseif (auth()->user()->rol === 'administrativo')

                        @if (Route::is('help_administrative')) 
                            <li class="nav-item">
                                <a href="{{ route('help_administrative') }}" class="nav-link text-white fw-bold">Ayuda</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('help_administrative') }}" class="nav-link text-dark fw-bold">Ayuda</a>
                            </li>
                        @endif

                    @endif
                @endauth
                


                <!-- ------------------------------ Cerrar sesion ------------------------------ -->
                @auth
                    <li class="nav-item text-end">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light rounded-pill">
                                <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/icono_cerrar_sesion.png') }}" alt="icono login" class="img-fluid me-1">
                                    Cerrar sesión
                            </button>
                        </form>
                    </li>
                @endauth

            </ul>
        </div>

    </div>
    
</nav>