@extends('plantillas.base')

@section('titulo', 'Mis Reparaciones')

@section('contenido')

        <h3 style="color: #d35400;">Mis Reparaciones</h3>
        
        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-12">

                                <!-- Filtro por Año -->
                                <form id="yearFilterForm" method="GET" action="{{ route('my_repairs') }}">
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

                                <div class="col-12 col-xl-12 mb-3">

                                        <div class="table-responsive">
                                                <table class="table table-striped">
                                                        <thead class="bg bg-warning">
                                                                <tr>
                                                                        <th>Tipo</th>
                                                                        <th>Marca</th>
                                                                        <th>Modelo</th>
                                                                        <th>Matrícula</th>
                                                                        <th>Fecha Entrada</th>
                                                                        <th>Fecha Inicio</th>
                                                                        <th>Fecha Finalizado</th>
                                                                        <th>Descripción</th>
                                                                        <th>Estado</th>
                                                                </tr>
                                                                                        
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($repairs as $repair)
                                                                <tr class="table-light">
                                                                        <td>{{ $repair->vehiculoMaquina->categoria->nombre }}</td>
                                                                        <td>{{ $repair->vehiculoMaquina->marca }}</td>
                                                                        <td>{{ $repair->vehiculoMaquina->modelo }}</td>
                                                                        <td>{{ $repair->vehiculoMaquina->matricula ?: '-' }}</td>
                                                                        <td>{{ date('d-m-Y', strtotime($repair->fecha_entrada)) }}</td>
                                                                        <td>{{ $repair->fecha_inicio ? date('d-m-Y', strtotime($repair->fecha_inicio)) : '-' }}</td>
                                                                        <td>{{ $repair->fecha_fin ? date('d-m-Y', strtotime($repair->fecha_fin)) : '-' }}</td>
                                                                        <td>{{ $repair->descripcion }}</td>
                                                                        <td>{{ $repair->estado }}</td>
                                                                </tr>
                                                        @endforeach
                                                                                
                                                        </tbody>
                                                </table>
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

        </div>

        <!-- script para filtrar por año las facturas completadas -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/administrativo/filtrar_facturas_completadas.js') }}"></script>

@endsection
