@extends('plantillas.base')

@section('titulo', 'Editar Factura')

@section('contenido')

        <h3 style="color: #d35400;">Seleccionar factura para editar</h3>

        @if(session('status'))
                <div id="statusMessage" class="alert alert-success mx-auto d-inline-block mt-3">
                        {{ session('status') }}

                        @if(session('invoice_url'))
                                <p class="mt-2">Puedes ver la factura <a href="{{ session('invoice_url') }}" target="_blank">aquí</a>.</p>
                        @endif
                </div>
        @endif

        @if(session('error'))
                <div id="errorMessage" class="alert alert-danger mx-auto d-inline-block mt-3">
                        {{ session('error') }}
                </div>
        @endif
        
        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        @include('paginas.administrativo.navFacturas')

                        <div class="col-md-9">

                                <div class="col-12 col-xl-12 mb-3">

                                        <!-- Agregar campo de búsqueda -->
                                        <div class="mb-3 text-start">

                                                <label for="usuario" class="form-label  fw-bold fs-5">Buscar Cliente</label>
                                                <input type="text" id="searchInput" class="form-control" placeholder="Buscar cliente... (Nombre, usuario, email o teléfono)">
                                                <div id="usuario_list" class="list-group" style="display:none;"></div>
                                                
                                        </div>

                                        <div id="invoice_table">
                                        <div class="table-responsive">
                                                <table class="table table-striped table-sm">
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
                                                                                <form action="{{ route('edit_invoice', $invoice->id) }}" method="GET">
                                                                                        <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                                                                                </form>         
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

        </div>

        <!-- script para ocultar los mensajes status y error a los 10 segundos -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/status_error_hide.js') }}"></script>

        <!-- script para buscar facturas de un usuario -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/administrativo/search_invoices.js') }}"></script>

@endsection
