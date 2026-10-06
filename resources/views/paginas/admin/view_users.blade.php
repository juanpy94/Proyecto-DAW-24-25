@extends('plantillas.base')

@section('titulo', 'Usuarios')

@section('contenido')

        <h3 style="color: #d35400;">Usuarios</h3>

        @if(session('status'))
                <div id="statusMessage" class="alert alert-success mx-auto d-inline-block mt-3">
                        {{ session('status') }}
                </div>
        @endif

        @if(session('error'))
                <div id="errorMessage" class="alert alert-danger mx-auto d-inline-block mt-3">
                        {{ session('error') }}
                </div>
        @endif
        
        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-md-12">

                                <div class="col-12 col-xl-12 mb-3">

                                        <div class="text-end mb-3">
                                                
                                                <form action="{{ route('form_insert_user') }}" method="GET">
                                                        <button type="submit" class="btn btn-warning btn-md">Insertar Usuario</button>
                                                </form>

                                        </div>

                                        <!-- Agregar campo de búsqueda -->
                                        <div class="mb-3 text-start">

                                                <label for="usuario" class="form-label  fw-bold fs-5">Buscar Usuario</label>
                                                <input type="text" id="searchInput" class="form-control" placeholder="Buscar usuario... (Nombre, usuario, email o teléfono)">
                                                <div id="usuario_list" class="list-group" style="display:none;"></div>
                                                
                                        </div>

                                        <div id="user_table">
                                        <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                        <thead class="bg bg-warning">
                                                                <tr>
                                                                        <th>Nombre</th>
                                                                        <th>Dirección</th>
                                                                        <th>Ciudad</th>
                                                                        <th>Email</th>
                                                                        <th>Usuario</th>
                                                                        <th>Telófono</th>
                                                                        <th>Rol</th>
                                                                        <th>Acciones</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($users as $user)
                                                                <tr class="table-light">
                                                                        <td>{{ $user->nombre }}</td>
                                                                        <td>{{ $user->direccion }}</td>
                                                                        <td>{{ $user->ciudad }}</td>
                                                                        <td>{{ $user->email }}</td>
                                                                        <td>{{ $user->usuario }}</td>
                                                                        <td>{{ $user->telefono }}</td>
                                                                        <td>{{ $user->rol }}</td>
                                                                        <td>
                                                                                <div class="d-flex justify-content-center">
                                                                                        <form action="{{ route('edit_user', $user->id) }}" method="GET">
                                                                                                <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                                                                                        </form>

                                                                                        <form action="{{ route('delete_user_adm', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar este usuario?');">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit" class="btn btn-danger btn-sm ms-3">Eliminar</button>
                                                                                        </form>
                                                                                </div>
                                                                        </td>
                                                                </tr>
                                                        @endforeach
                                                        </tbody>
                                                </table>
                                        </div>

                                        </div>

                                        <!-- Mostrar total de resultados -->
                                        <div class="col-12 mt-3">
                                                <p id="result_count"><strong>Mostrando del {{ $users->firstItem() }} al {{ $users->lastItem() }} de {{ $users->total() }} resultados.</strong></p>
                                        </div>

                                        <!-- Paginación -->
                                        <div class="d-flex justify-content-center">
                                                {{ $users->links('pagination::bootstrap-4') }}
                                        </div>
                                        
                                </div>

                        </div>
                </div>

        </div>

        <!-- script para ocultar los mensajes status y error a los 10 segundos -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/status_error_hide.js') }}"></script>

        <!-- script para buscar un usuario -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/admin/search_user.js') }}"></script>

@endsection
