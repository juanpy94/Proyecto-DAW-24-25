@extends('plantillas.base')

@section('titulo', 'Reparaciones en Proceso')

@section('contenido')

        <h3 style="color: #d35400;">Reparaciones en Proceso</h3>

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
  
                         @foreach ($repairs->groupBy('usuario.id') as $userRepairs)

                                <div class="col-12 col-sm-12 col-md-12 col-xl-12 mb-3">

                                        <div class="card">
                                                <div class="card-header bg bg-dark">
                                                        <h5 class="text-white">{{ $userRepairs->first()->usuario->nombre }}</h5>
                                                </div>
                                                <div class="card-body">
                
                                                        <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                        <thead class="bg bg-warning">
                                                                                <tr>
                                                                                        <th>Tipo</th>
                                                                                        <th>Marca</th>
                                                                                        <th>Modelo</th>
                                                                                        <th>Matrícula</th>
                                                                                        <th>Fecha entrada</th>
                                                                                        <th>Descripción</th>
                                                                                        <th>Fecha Inicio</th>
                                                                                        <th></th>
                                                                                        <th></th>
                                                                                </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach ($userRepairs as $userRepair)
                                                                                <tr class="table-light">
                                                                                        <td>{{ $userRepair->VehiculoMaquina->categoria->nombre }}</td>
                                                                                        <td>{{ $userRepair->VehiculoMaquina->marca }}</td>
                                                                                        <td>{{ $userRepair->VehiculoMaquina->modelo }}</td>
                                                                                        <td>{{ $userRepair->VehiculoMaquina->matricula ?: '-' }}</td>
                                                                                        <td>{{ date('d-m-Y', strtotime($userRepair->fecha_entrada)) }}</td>
                                                                                        <td>{{ $userRepair->descripcion }}</td>
                                                                                        <td>{{ date('d-m-Y', strtotime($userRepair->fecha_inicio)) }}</td>
                                                                                        <td>
                                                                                                <a href="{{ route('repair_completed_mechanic', $userRepair->id) }}" class="btn btn-warning btn-sm">Completado</a>
                                                                                        </td>
                                                                                        <td>
                                                                                                <form action="{{ route('repair_back_mechanic', $userRepair->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas reparar esta reparación otro día?');">
                                                                                                        @csrf
                                                                                                        @method('PUT')
                                                                                                        <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                                                                                                </form>
                                                                                        </td>
                                                                                </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                </table>
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
