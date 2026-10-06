@extends('plantillas.base')

@section('titulo', 'Mis Facturas')

@section('contenido')

        <h3 style="color: #d35400;">Mis Facturas</h3>

        @if(session('error'))
                <div id="errorMessage" class="alert alert-danger mx-auto d-inline-block mt-3">
                        {{ session('error') }}
                </div>
        @endif
        
        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-12">

                                <!-- Filtro por Año -->
                                <form id="yearFilterForm" method="GET" action="{{ route('my_invoices') }}">
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
                                                                        <th>Fecha emisión</th>
                                                                        <th>Estado</th>
                                                                        <th>Precio Total</th>
                                                                        <th>Tipo</th>
                                                                        <th>Marca</th>
                                                                        <th>Modelo</th>
                                                                        <th>Matrícula</th>
                                                                        <th></th>
                                                                </tr>
                                                                                        
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($invoices as $invoice)
                                                                <tr class="table-light">
                                                                        <td>{{ date('d-m-Y', strtotime($invoice->fecha_emision)) }}</td>
                                                                        <td>{{ $invoice->estado }}</td>
                                                                        <td>{{ $invoice->total_factura }}€</td>
                                                                        <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->categoria->nombre }}</td>
                                                                        <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->marca }}</td>
                                                                        <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->modelo }} </td>
                                                                        <td>{{ $invoice->detalleReparacion->first()->reparacion->VehiculoMaquina->matricula ?: '-' }}</td>
                                                                        <td>
                                                                                <a href="{{ route('my_invoice_PDF', $invoice->id) }}" class="btn btn-warning btn-sm" target="_blank">Ver</a>
                                                                        </td>
                                                                        
                                                                </tr>
                                                        @endforeach
                                                                                
                                                        </tbody>
                                                </table>
                                        </div>

                                        <!-- Mostrar total de resultados -->
                                        <div class="col-12 mt-3">
                                                <p id="result_count"><strong>Mostrando del {{ $invoices->firstItem() }} al {{ $invoices->lastItem() }} de {{ $invoices->total() }} resultados.</strong></p>
                                        </div>

                                        <!-- Paginación -->
                                        <div class="d-flex justify-content-center">
                                                {{ $invoices->links('pagination::bootstrap-4') }}
                                        </div>
                                                        
                                </div>

                        </div>
                </div>

        </div>

        <!-- script para ocultar los mensajes status y error a los 10 segundos -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/status_error_hide.js') }}"></script>

        <!-- script para filtrar por año las facturas completadas -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/administrativo/filtrar_facturas_completadas.js') }}"></script>

@endsection
