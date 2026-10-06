@extends('plantillas.base')

@section('titulo', 'Configuracion Factura')

@section('contenido')

        <h3 style="color: #d35400;">Configuración Factura</h3>

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

                                <div id="invoices_table">
                                        <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                        <thead class="bg bg-warning">
                                                                <tr>
                                                                        <th>IVA</th>
                                                                        <th>Precio Mano de obra</th>
                                                                        <th>Acciones</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($configInvoice as $invoice)
                                                                <tr class="table-light">
                                                                        <td>{{ $invoice->iva }}%</td>
                                                                        <td>{{ $invoice->precio_mano_obra }}€</td>
                                                                        <td>
                                                                                <div class="d-flex justify-content-center">
                                                                                        <form action="{{ route('adm_edit_config_invoice', $invoice->id) }}" method="GET">
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
                                        <p id="result_count"><strong>Mostrando del {{ $configInvoice->firstItem() }} al {{ $configInvoice->lastItem() }} de {{ $configInvoice->total() }} resultados.</strong></p>
                                </div>

                                <!-- Paginación -->
                                <div class="d-flex justify-content-center">
                                        {{ $configInvoice->links('pagination::bootstrap-4') }}
                                </div>
                                        
                        </div>

                </div>

        </div>

        <!-- script para ocultar los mensajes status y error a los 10 segundos -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/status_error_hide.js') }}"></script>

@endsection
