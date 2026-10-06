@extends('plantillas.base')

@section('titulo', 'Reparaciones Completadas')

@section('contenido')

        <h3 style="color: #d35400;">Reparaciones Completadas</h3>
        
        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-12">

                                <!-- Filtro por Año -->
                                <form id="yearFilterForm" method="GET" action="{{ route('completed_repairs_mechanic') }}">
                                        <div class="form-group col-4 mb-3">
                                                <label for="yearSelect">Selecciona un año para filtrar:</label>
                                                <select id="yearSelect" name="year" class="form-control" onchange="this.form.submit()">
                                                        <option value="">Todos</option>
                                                        @foreach($years as $year)
                                                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                        @endforeach
                                                </select>
                                        </div>
                                </form>

                                @foreach ($repairs->groupBy('usuario.id') as $userRepairs)

                                        <div class="col-12 col-xl-12 mb-3">

                                                <div class="card">
                                                        <div class="card-header bg bg-dark">
                                                                <h5 class="text-white">{{ $userRepairs->first()->usuario->nombre }}</h5>
                                                        </div>
                                                        <div class="card-body">
                
                                                                <div class="table-responsive">
                                                                        <table class="table table-striped table-sm">
                                                                                <thead class="bg bg-warning">
                                                                                        <tr>
                                                                                                <th>Tipo</th>
                                                                                                <th>Marca</th>
                                                                                                <th>Modelo</th>
                                                                                                <th>Matrícula</th>
                                                                                                <th>Fecha entrada</th>
                                                                                                <th>Fecha inicio</th>
                                                                                                <th>Fecha fin</th>
                                                                                                <th>Descripción</th>
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
                                                                                                <td>{{ date('d-m-Y', strtotime($userRepair->fecha_inicio)) }}</td>
                                                                                                <td>{{ date('d-m-Y', strtotime($userRepair->fecha_fin)) }}</td>
                                                                                                <td>{{ $userRepair->descripcion }}</td>
                                                                                        </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                        </table>
                                                                </div>

                                                                <!-- Mostrar total de resultados -->
                                                                <div class="col-12 mt-3">
                                                                        <p><strong>Mostrando del {{ $repairs->firstItem() }} al {{ $repairs->lastItem() }} de {{ $repairs->total() }} resultados.</strong></p>
                                                                </div>

                                                                <!-- Paginación -->
                                                                <div class="d-flex justify-content-center">
                                                                        {{ $repairs->links('pagination::bootstrap-4') }}
                                                                </div>
                                                        </div>
                                                </div>

                                        </div>

                                @endforeach

                        </div>
                </div>

        </div>

        <!-- script para filtrar por año las reparaciones completadas -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/mecanico/filtrar_reparaciones_completadas.js') }}"></script>

@endsection
