<!-- Menu hamburguesa -->
<nav class="navbar navbar-expand-lg navbar-light bg-light d-md-none mb-3">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background-color: rgba(0, 0, 0, 0.30);">
        <span class="navbar-toggler-icon fs-6"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item mt-1">
                <a class="nav-link {{ Request::is('jefe_taller/reparaciones_asignadas') ? 'active' : '' }}" href="{{ route('assigned_repairs') }}" style="{{ Request::is('jefe_taller/reparaciones_asignadas') ? 'background-color: #d35400; color:white;' : '' }}">
                    Reparaciones Asignadas
                </a>
            </li>
            <li class="nav-item mt-1">
                <a class="nav-link {{ Request::is('jefe_taller/anadir_reparacion') ? 'active' : '' }}" href="{{ route('form_add_repair') }}" style="{{ Request::is('jefe_taller/anadir_reparacion') ? 'background-color: #d35400; color:white;' : '' }}">
                    Añadir Reparación
                </a>
            </li>
            <li class="nav-item mt-1">
                <a class="nav-link {{ Request::is('jefe_taller/editar_reparacion') || Request::is('jefe_taller/reparacion/*/editar')? 'active' : '' }}" 
                    href="{{ route('select_repair') }}" style="{{ Request::is('jefe_taller/editar_reparacion') || Request::is('jefe_taller/reparacion/*/editar') ? 'background-color: #d35400; color:white;' : '' }}">
                    Editar Reparación
                </a>
            </li>
            <li class="nav-item mt-1">
                <a class="nav-link {{ Request::is('jefe_taller/eliminar_reparacion') ? 'active' : '' }}" href="{{ route('select_delete_repair') }}" style="{{ Request::is('jefe_taller/eliminar_reparacion') ? 'background-color: #d35400; color:white;' : '' }}">
                    Eliminar Reparación
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Menu normal en la izquierda en pantallas mas grandes -->
<div class="col-md-3 d-none d-md-block fs-5">
    <div class="list-group">
        <a href="{{ route('assigned_repairs') }}" class="list-group-item list-group-item-action list-group-item-light {{ Request::is('jefe_taller/reparaciones_asignadas') ? 'active' : '' }}" style="{{ Request::is('jefe_taller/reparaciones_asignadas') ? 'background-color: #d35400;' : '' }}">
            Reparaciones Asignadas
        </a>
        <a href="{{ route('form_add_repair') }}" class="list-group-item list-group-item-action list-group-item-light {{ Request::is('jefe_taller/anadir_reparacion') ? 'active' : '' }}" style="{{ Request::is('jefe_taller/anadir_reparacion') ? 'background-color: #d35400;' : '' }}">
            Añadir Reparación
        </a>
        <a href="{{ route('select_repair') }}" class="list-group-item list-group-item-action list-group-item-light 
                {{ Request::is('jefe_taller/editar_reparacion') || Request::is('jefe_taller/reparacion/*/editar') ? 'active' : '' }}" 
                style="{{ Request::is('jefe_taller/editar_reparacion') || Request::is('jefe_taller/reparacion/*/editar') ? 'background-color: #d35400;' : '' }}">
            Editar Reparación
        </a>
        <a href="{{ route('select_delete_repair') }}" class="list-group-item list-group-item-action list-group-item-light {{ Request::is('jefe_taller/eliminar_reparacion') ? 'active' : '' }}" style="{{ Request::is('jefe_taller/eliminar_reparacion') ? 'background-color: #d35400;' : '' }}">
            Eliminar Reparación
        </a>
    </div>
</div>