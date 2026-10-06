@extends('plantillas.base')

@section('titulo', 'Mis Vehículos/Maquinarias')

@section('contenido')

        <h3 style="color: #d35400;">Mis Vehículos/Maquinarias</h3>

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

                        <div class="text-end mb-4">
                                
                                <form action="{{ route('insert_vehicle_machinery') }}" method="GET">
                                        <button type="submit" class="btn btn-warning btn-md">Insertar Vehículo o Máquina</button>
                                </form>

                        </div>

                        @foreach ($vehicles_machinerys as $vehicle)

                                <div class="col-12 col-sm-12 col-md-6 col-xl-6 mb-3">

                                        <div class="card">
                                                <div class="card-header bg bg-dark">
                                                        <h5 class="text-white">{{ $vehicle->categoria->nombre }}</h5>
                                                </div>
                                                <div class="card-body">

                                                        <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                        <tbody>
                                                                                <tr>
                                                                                        <td class="fw-bold">Marca</td>
                                                                                        <td>{{ $vehicle->marca }}</td>
                                                                                </tr>

                                                                                <tr>
                                                                                        <td class="fw-bold">Modelo</td>
                                                                                        <td>{{ $vehicle->modelo }}</td>
                                                                                </tr>

                                                                                <tr>
                                                                                        <td class="fw-bold">Matrícula</td>
                                                                                        <td>{{ $vehicle->matricula ?: '-' }}</td>
                                                                                </tr>

                                                                                <tr>
                                                                                        <td class="fw-bold">Año</td>
                                                                                        <td>{{ $vehicle->ano }}</td>
                                                                                </tr>
                                                                        </tbody>
                                                                </table>

                                                                <div class="d-flex justify-content-center">

                                                                        <form action="{{ route('edit_vehicles_machinerys', $vehicle->id) }}" method="GET">
                                                                                <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                                                                        </form>
                                                                                                
                                                                        <form action="{{ route('delete_vehicle_machinery', $vehicle->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar este Vehículo/Máquina?');">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger btn-sm ms-5">Eliminar</button>
                                                                        </form>
                                                                </div>

                                                        </div>
                                                </div>
                                        </div>

                                </div>

                        @endforeach

                </div>

        </div>

        <!-- script para ocultar los mensajes status y error a los 10 segundos -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/status_error_hide.js') }}"></script>

@endsection
