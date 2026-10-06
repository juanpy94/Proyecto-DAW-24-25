<!-- Menu hamburguesa -->
<nav class="navbar navbar-expand-lg navbar-light bg-light d-md-none mb-3">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background-color: rgba(0, 0, 0, 0.30);">
        <span class="navbar-toggler-icon fs-6"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item mt-1">
                <a class="nav-link {{ Request::is('administrativo/realizar_factura') ? 'active' : '' }}" href="{{ route('make_invoice') }}" style="{{ Request::is('administrativo/realizar_factura') ? 'background-color: #d35400; color:white;' : '' }}">
                    Realizar Factura
                </a>
            </li>

            <li class="nav-item mt-1">
                <a class="nav-link {{ Request::is('administrativo/ver_factura') ? 'active' : '' }}" href="{{ route('view_invoice') }}" style="{{ Request::is('administrativo/ver_factura') ? 'background-color: #d35400; color:white;' : '' }}">
                    Ver Factura
                </a>
            </li>

            <li class="nav-item mt-1">
                <a class="nav-link {{ Request::is('administrativo/seleccionar_factura') ? 'active' : '' }}" href="{{ route('select_invoice') }}" style="{{ Request::is('administrativo/select_invoice_factura') ? 'background-color: #d35400; color:white;' : '' }}">
                    Editar Factura
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Menu normal en la izquierda en pantallas mas grandes -->
<div class="col-md-3 d-none d-md-block fs-5">
    <div class="list-group">
        <a href="{{ route('make_invoice') }}" class="list-group-item list-group-item-action list-group-item-light {{ Request::is('administrativo/realizar_factura') ? 'active' : '' }}" style="{{ Request::is('administrativo/realizar_factura') ? 'background-color: #d35400;' : '' }}">
            Realizar Factura
        </a>

        <a href="{{ route('view_invoice') }}" class="list-group-item list-group-item-action list-group-item-light {{ Request::is('administrativo/ver_factura') ? 'active' : '' }}" style="{{ Request::is('administrativo/ver_factura') ? 'background-color: #d35400;' : '' }}">
            Ver Factura
        </a>

        <a href="{{ route('select_invoice') }}" class="list-group-item list-group-item-action list-group-item-light {{ Request::is('administrativo/seleccionar_factura') ? 'active' : '' }}" style="{{ Request::is('administrativo/seleccionar_factura') ? 'background-color: #d35400;' : '' }}">
            Editar Factura
        </a>
    </div>
</div>