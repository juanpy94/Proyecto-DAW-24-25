@extends('plantillas.base')

@section('titulo', 'Facturas')

@section('contenido')

        <h3 style="color: #d35400;">Facturas</h3>

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

                                <div class="d-flex justify-content-between mb-3">
                                        <form action="{{ route('adm_view_config_invoice') }}" method="GET">
                                                <button type="submit" class="btn btn-dark btn-md">Config Factura</button>
                                        </form>

                                        <form action="{{ route('adm_view_repairs_invoice') }}" method="GET">
                                                <button type="submit" class="btn btn-warning btn-md">Insertar Factura</button>
                                        </form>
                                </div>

                                <!-- Agregar campo de búsqueda -->
                                <div class="mb-3 text-start">

                                        <label for="usuario" class="form-label  fw-bold fs-5">Buscar Usuario</label>
                                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar usuario... (Nombre, usuario, email o teléfono)">
                                        <div id="usuario_list" class="list-group" style="display:none;"></div>

                                </div>

                                <div id="invoices_table">
                                        <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                        <thead class="bg bg-warning">
                                                                <tr>
                                                                        <th>Fecha Emisión</th>
                                                                        <th>Estado</th>
                                                                        <th>Total Factura</th>
                                                                        <th>Administrativo</th>
                                                                        <th>Tipo</th>
                                                                        <th>Marca</th>
                                                                        <th>Modelo</th>
                                                                        <th>Matrícula</th>
                                                                        <th>Acciones</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($invoices as $invoice)
                                                                <tr class="table-light">
                                                                        <td>{{ date('d-m-Y', strtotime($invoice->fecha_emision)) }}</td>
                                                                        <td>{{ $invoice->estado }}</td>
                                                                        <td>{{ $invoice->total_factura }}€</td>
                                                                        <td>{{ $invoice->usuario->nombre }}</td>
                                                                        <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->categoria->nombre }}</td>
                                                                        <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->marca }}</td>
                                                                        <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->modelo }} </td>
                                                                        <td>{{ $invoice->detalleReparacion->first()->reparacion->VehiculoMaquina->matricula ?: '-' }}</td>
                                                                        <td>
                                                                                <div class="d-flex justify-content-center">
                                                                                        <form action="{{ route('adm_edit_invoice', $invoice->id) }}" method="GET">
                                                                                                <button type="submit" class="btn btn-warning btn-sm">Editar</button>
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
                                        <p id="result_count"><strong>Mostrando del {{ $invoices->firstItem() }} al {{ $invoices->lastItem() }} de {{ $invoices->total() }} resultados.</strong></p>
                                </div>

                                <!-- Paginación -->
                                <div class="d-flex justify-content-center">
                                        {{ $invoices->links('pagination::bootstrap-4') }}
                                </div>
                                        
                        </div>

                </div>

        </div>

        <!-- script para ocultar los mensajes status y error a los 10 segundos -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/status_error_hide.js') }}"></script>
        
        <!-- script para buscar facturas de un usuario -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/admin/search_invoices.js') }}"></script>

@endsection
