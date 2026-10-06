<!-- Menu hamburguesa -->
<nav class="navbar navbar-expand-lg navbar-light bg-light d-md-none mb-3">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background-color: rgba(0, 0, 0, 0.30);">
        <span class="navbar-toggler-icon fs-6"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item mt-1">
                <a class="nav-link {{ Request::is('perfil') ? 'active' : '' }}" href="{{ route('user_profile') }}" style="{{ Request::is('perfil') ? 'background-color: #d35400; color:white;' : '' }}">
                    Ver perfil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('editar-perfil') ? 'active' : '' }}" href="{{ route('edit_profile') }}" style="{{ Request::is('editar-perfil') ? 'background-color: #d35400;  color:white;' : '' }}">
                    Editar perfil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('cambiar-contraseña') ? 'active' : '' }}" href="{{ route('change_password') }}" style="{{ Request::is('cambiar-contraseña') ? 'background-color: #d35400;  color:white;' : '' }}">
                    Cambiar contraseña
                </a>
            </li>

            @if(auth()->user()->rol != 'administrador')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('eliminar-usuario') ? 'active' : '' }}" href="{{ route('confirm_delete_user') }}" style="{{ Request::is('eliminar-usuario') ? 'background-color: #d35400;  color:white;' : '' }}">
                        Eliminar usuario
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>

<!-- Menu normal en la izquierda en pantallas mas grandes -->
<div class="col-md-3 d-none d-md-block">
    <div class="list-group">
        <a href="{{ route('user_profile') }}" class="list-group-item list-group-item-action list-group-item-light {{ Request::is('perfil') ? 'active' : '' }}" style="{{ Request::is('perfil') ? 'background-color: #d35400;' : '' }}">
            Ver perfil
        </a>
        <a href="{{ route('edit_profile') }}" class="list-group-item list-group-item-action list-group-item-light {{ Request::is('editar-perfil') ? 'active' : '' }}" style="{{ Request::is('editar-perfil') ? 'background-color: #d35400;' : '' }}">
            Editar perfil
        </a>
        <a href="{{ route('change_password') }}" class="list-group-item list-group-item-action list-group-item-light {{ Request::is('cambiar-contraseña') ? 'active' : '' }}" style="{{ Request::is('cambiar-contraseña') ? 'background-color: #d35400;' : '' }}">
            Cambiar contraseña
        </a>
        @if(auth()->user()->rol != 'administrador')
            <a href="{{ route('confirm_delete_user') }}" class="list-group-item list-group-item-action list-group-item-light {{ Request::is('eliminar-usuario') ? 'active' : '' }}" style="{{ Request::is('eliminar-usuario') ? 'background-color: #d35400;' : '' }}">
                Eliminar usuario
            </a>
        @endif
    </div>
</div>