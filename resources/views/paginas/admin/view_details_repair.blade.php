@extends('plantillas.base')

@section('titulo', 'Detalles Reparacion')

@section('contenido')

        <h3 style="color: #d35400;">Detalles Reparación</h3>

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
                                                
                                        <form action="{{ route('form_insert_detail') }}" method="GET">

                                                <!-- Campo oculto para pasar el id de la reparación -->
                                                <input type="hidden" name="id_reparacion" value="{{ $repair->id }}">

                                                <!-- Campo oculto para pasar el id de la factura -->
                                                <input type="hidden" name="id_factura" value="{{ $details->first()->id_factura }}">

                                                <button type="submit" class="btn btn-warning btn-md">Insertar Detalle</button>
                                        </form>

                                </div>

                                <div id="repairs_table">
                                        <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                        <thead class="bg bg-warning">
                                                                <tr>
                                                                        <th>Descripcion</th>
                                                                        <th>Cantidad</th>
                                                                        <th>Precio Unidad</th>
                                                                        <th>% IVA</th>
                                                                        <th>IVA</th>
                                                                        <th>% Descuento</th>
                                                                        <th>Descuento</th>
                                                                        <th>Precio Total</th>
                                                                        <th>Acciones</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($details as $detail)
                                                                <tr class="table-light">
                                                                        <td style="max-width: 300px;">{{ $detail->descripcion }}</td>
                                                                        <td>{{ $detail->cantidad }}</td>
                                                                        <td>{{ $detail->precio_unidad }}</td>
                                                                        <td>{{ $detail->getAttribute('%_iva') }}</td>
                                                                        <td>{{ $detail->iva }}</td>
                                                                        <td>{{ $detail->getAttribute('%_descuento') }}</td>
                                                                        <td>{{ $detail->descuento }}</td>
                                                                        <td>{{ $detail->precio_total }}</td>
                                                                        <td>
                                                                                <div class="d-flex justify-content-center">
                                                                                        <form action="{{ route('adm_edit_detail', $detail->id) }}" method="GET">
                                                                                                <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                                                                                        </form>

                                                                                        <form action="{{ route('adm_delete_detail', $detail->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar este detalle de la reparación?');">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit" class="btn btn-danger btn-sm ms-3">Eliminar</button>
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
                                        <p id="result_count"><strong>Mostrando del {{ $details->firstItem() }} al {{ $details->lastItem() }} de {{ $details->total() }} resultados.</strong></p>
                                </div>

                                <!-- Paginación -->
                                <div class="d-flex justify-content-center">
                                        {{ $details->links('pagination::bootstrap-4') }}
                                </div>
                                        
                        </div>

                </div>

        </div>

        <!-- script para ocultar los mensajes status y error a los 10 segundos -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/status_error_hide.js') }}"></script>

@endsection
