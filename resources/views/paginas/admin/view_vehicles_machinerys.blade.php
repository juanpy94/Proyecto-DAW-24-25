@extends('plantillas.base')

@section('titulo', 'Vehiculos/Maquinarias')

@section('contenido')

        <h3 style="color: #d35400;">Vehículos/Maquinarias</h3>

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

                        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">


                                <div class="d-flex justify-content-between mb-3">
                                        <form action="{{ route('view_categories') }}" method="GET">
                                                <button type="submit" class="btn btn-dark btn-md">Categorias</button>
                                        </form>
                                                
                                        <form action="{{ route('form_insert_vehicle') }}" method="GET">
                                                <button type="submit" class="btn btn-warning btn-md">Insertar Vehículo/Maquinaria</button>
                                        </form>

                                </div>

                                <!-- Agregar campo de búsqueda -->
                                <div class="mb-3 text-start">

                                        <label for="usuario" class="form-label  fw-bold fs-5">Buscar Usuario</label>
                                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar usuario... (Nombre, usuario, email o teléfono)">
                                        <div id="usuario_list" class="list-group" style="display:none;"></div>

                                </div>

                                <div id="vehicles_table">
                                        <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                        <thead class="bg bg-warning">
                                                                <tr>
                                                                        <th>Marca</th>
                                                                        <th>Modelo</th>
                                                                        <th>Matrícula</th>
                                                                        <th>Año</th>
                                                                        <th>Categoria</th>
                                                                        <th>Propietario</th>
                                                                        <th>Usuario</th>
                                                                        <th>Acciones</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($vehiclesMachinerys as $vehicle)
                                                                <tr class="table-light">
                                                                        <td>{{ $vehicle->marca }}</td>
                                                                        <td>{{ $vehicle->modelo }}</td>
                                                                        <td>{{ $vehicle->matricula ?: '-' }}</td>
                                                                        <td>{{ $vehicle->ano }}</td>
                                                                        <td>{{ $vehicle->categoria->nombre }}</td>
                                                                        <td>{{ $vehicle->usuario->nombre }}</td>
                                                                        <td>{{ $vehicle->usuario->usuario }}</td>
                                                                        <td>
                                                                                <div class="d-flex justify-content-center">
                                                                                        <form action="{{ route('adm_edit_vehicle', $vehicle->id) }}" method="GET">
                                                                                                <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                                                                                        </form>

                                                                                        <form action="{{ route('adm_delete_vehicle', $vehicle->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar este vehiculo/maquinaria?');">
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
                                        <p id="result_count"><strong>Mostrando del {{ $vehiclesMachinerys->firstItem() }} al {{ $vehiclesMachinerys->lastItem() }} de {{ $vehiclesMachinerys->total() }} resultados.</strong></p>
                                </div>

                                <!-- Paginación -->
                                <div class="d-flex justify-content-center">
                                        {{ $vehiclesMachinerys->links('pagination::bootstrap-4') }}
                                </div>
                                        
                        </div>

                </div>

        </div>

        <!-- script para ocultar los mensajes status y error a los 10 segundos -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/status_error_hide.js') }}"></script>

        <!-- script para buscar un usuario -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/admin/search_user_vehicles.js') }}"></script>

@endsection
