@extends('plantillas.base')

@section('titulo', 'Reparaciones en Proceso')

@section('contenido')

        <h3 style="color: #d35400;">Reparaciones en Proceso</h3>

        @if(session('status'))
                <div class="alert alert-success mx-auto d-inline-block mt-3">
                        {{ session('status') }}
                </div>
        @endif
        
        <div class="container mt-3">

                <div class="row d-flex justify-content-center">
  
                         @foreach ($repairs->groupBy('usuario.id') as $userRepairs)

                                <div class="col-12 col-sm-12 col-md-12 col-xl-10 mb-3">

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

@endsection
