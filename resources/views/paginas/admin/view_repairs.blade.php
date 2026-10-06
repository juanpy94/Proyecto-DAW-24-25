@extends('plantillas.base')

@section('titulo', 'Reparaciones')

@section('contenido')

        <h3 style="color: #d35400;">Reparaciones</h3>

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

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">


                                <div class="text-end mb-3">
                                                
                                        <form action="{{ route('form_insert_repair') }}" method="GET">
                                                <button type="submit" class="btn btn-warning btn-md">Insertar Reparación</button>
                                        </form>

                                </div>

                                <!-- Agregar campo de búsqueda -->
                                <div class="mb-3 text-start">

                                        <label for="usuario" class="form-label  fw-bold fs-5">Buscar Usuario</label>
                                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar usuario... (Nombre, usuario, email o teléfono)">
                                        <div id="usuario_list" class="list-group" style="display:none;"></div>

                                </div>

                                <div id="repairs_table">
                                        <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                        <thead class="bg bg-warning">
                                                                <tr>
                                                                        <th>Estado</th>
                                                                        <th>Fecha Entrada</th>
                                                                        <th>Fecha Inicio</th>
                                                                        <th>Fecha Fin</th>
                                                                        <th>Descripcion</th>
                                                                        <th>Usuario</th>
                                                                        <th>Vehiculo/Maquinaria</th>
                                                                        <th>Mecánico</th>
                                                                        <th>Acciones</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($repairs as $repair)
                                                                <tr class="table-light">
                                                                        <td>{{ $repair->estado }}</td>
                                                                        <td>{{ date('d-m-Y', strtotime($repair->fecha_entrada)) }}</td>
                                                                        <td>{{ $repair->fecha_inicio ? date('d-m-Y', strtotime($repair->fecha_inicio)) : '-' }}</td>
                                                                        <td>{{ $repair->fecha_fin ? date('d-m-Y', strtotime($repair->fecha_fin)) : '-' }}</td>
                                                                        <td style="max-width: 300px;">{{ $repair->descripcion }}</td>
                                                                        <td>{{ $repair->VehiculoMaquina->usuario->usuario }}</td>
                                                                        <td>{{ $repair->VehiculoMaquina->marca }} {{ $repair->VehiculoMaquina->modelo }}</td>
                                                                        <td>{{ $repair->usuario->nombre }}</td>
                                                                        <td>
                                                                                <div class="d-flex justify-content-center">
                                                                                        <form action="{{ route('adm_edit_repair', $repair->id) }}" method="GET">
                                                                                                <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                                                                                        </form>

                                                                                        <form action="{{ route('adm_delete_repair', $repair->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar esta reparación?');">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit" class="btn btn-danger btn-sm ms-3">Eliminar</button>
                                                                                        </form>
                                                                                </div>

                                                                                @if($repair->estado === 'completado')
                                                                                        <div class="d-flex justify-content-center mt-2">
                                                                                                <form action="{{ route('adm_view_details_repair', $repair->id) }}" method="GET">
                                                                                                        <button type="submit" class="btn btn-dark btn-sm">Detalles</button>
                                                                                                </form>
                                                                                        </div>
                                                                                @endif
                                                                        </td>
                                                                </tr>
                                                        @endforeach
                                                        </tbody>
                                                </table>
                                        </div>

                                </div>

                                <!-- Mostrar total de resultados -->
                                <div class="col-12 mt-3">
                                        <p id="result_count"><strong>Mostrando del {{ $repairs->firstItem() }} al {{ $repairs->lastItem() }} de {{ $repairs->total() }} resultados.</strong></p>
                                </div>

                                <!-- Paginación -->
                                <div class="d-flex justify-content-center">
                                        {{ $repairs->links('pagination::bootstrap-4') }}
                                </div>
                                        
                        </div>

                </div>

        </div>

        <!-- script para ocultar los mensajes status y error a los 10 segundos -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/status_error_hide.js') }}"></script>

        <!-- script para buscar un usuario -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/admin/search_user_repairs.js') }}"></script>

@endsection
