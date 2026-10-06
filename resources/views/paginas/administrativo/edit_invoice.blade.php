@extends('plantillas.base')

@section('titulo', 'Editar Factura')

@section('contenido')

        <h3 style="color: #d35400;">Editar Factura</h3>

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="card-body">
                
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
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <tr class="table-light">
                                                                <td>{{ date('d-m-Y', strtotime($invoice->fecha_emision)) }}</td>
                                                                <td>{{ $invoice->estado }}</td>
                                                                <td>{{ $invoice->total_factura }}€</td>
                                                                <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->categoria->nombre }}</td>
                                                                <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->marca }}</td>
                                                                <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->modelo }} </td>
                                                                <td>{{ $invoice->detalleReparacion->first()->reparacion->VehiculoMaquina->matricula ?: '-' }}</td>
                                                        </tr>
                                                </tbody>
                                        </table>
                                </div>
                        </div>

                        <div class="col-12">
                                
                                <form action="{{ route('update_invoice', $invoice->id) }}" method="POST">
                                        @csrf
                                        <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                        <h4>Detalles de la Factura</h4>
                                                </div>
                                                <div class="card-body" style="background-color: rgba(0, 0, 0, 0.15);">

                                                        <div id="detalles-container">

                                                                <div class="table-responsive">
                                                                        <table class="table table-striped">
                                                                                <thead class="bg-warning">
                                                                                        <tr>
                                                                                                <th class="col-4">Descripción</th>
                                                                                                <th class="col-2">Cantidad</th>
                                                                                                <th class="col-2">Precio Unidad</th>
                                                                                                <th class="col-1">IVA (%)</th>
                                                                                                <th class="col-1">Descuento (%)</th>
                                                                                                <th class="col-2">Precio Total</th>
                                                                                        </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                        @foreach ($detalles as $index => $detalle)
                                                                                        <tr>
                                                                                                <td>
                                                                                                        <input type="hidden" name="id_detalle[{{ $index }}]" value="{{ $detalle->id }}">

                                                                                                        <input type="text" class="form-control" name="descripcion[{{ $index }}]" value="{{ old('descripcion.' . $index, $detalle->descripcion) }}" placeholder="Descripción..." @if($detalle->descripcion === 'Horas empleadas') readonly @endif>
                                                                                                        @error('descripcion.' . $index)
                                                                                                                <span class="text-danger">*{{ $message }}</span>
                                                                                                        @enderror
                                                                                                </td>
                                                                                                <td>
                                                                                                        <input type="number" class="form-control text-end" name="cantidad[{{ $index }}]" value="{{ old('cantidad.' . $index, $detalle->cantidad) }}" placeholder="Cantidad..." step="0.01">
                                                                                                        @error('cantidad.' . $index)
                                                                                                                <span class="text-danger">*{{ $message }}</span>
                                                                                                        @enderror
                                                                                                </td>
                                                                                                <td>
                                                                                                        <input type="number" class="form-control" name="precio[{{ $index }}]" value="{{ old('precio.' . $index, $detalle->precio_unidad) }}" placeholder="Precio unidad..." step="0.01">
                                                                                                        @error('precio.' . $index)
                                                                                                                <span class="text-danger">*{{ $message }}</span>
                                                                                                        @enderror
                                                                                                </td>
                                                                                                <td>
                                                                                                        <input type="number" class="form-control" name="iva[{{ $index }}]" value="{{ old('iva.' . $index, $detalle->getAttribute('%_iva')) }}" placeholder="% IVA..." step="0.01">
                                                                                                        @error('iva.' . $index)
                                                                                                                <span class="text-danger">*{{ $message }}</span>
                                                                                                        @enderror
                                                                                                </td>
                                                                                                <td>
                                                                                                        <input type="number" class="form-control" name="descuento[{{ $index }}]" value="{{ old('descuento.' . $index, $detalle->getAttribute('%_descuento')) }}" placeholder="% Descuento..." step="0.01">
                                                                                                        @error('descuento.' . $index)
                                                                                                                <span class="text-danger">*{{ $message }}</span>
                                                                                                        @enderror
                                                                                                </td>
                                                                                                <td>
                                                                                                        <div class="input-group">
                                                                                                                <input type="text" class="form-control text-end fw-bold" name="precio_total[{{ $index }}]" value="{{ old('precio_total.' . $index, $detalle->precio_total) }}€" step="0.01" readonly>
                                                                                                                <span class="input-group-text fw-bold">€</span>
                                                                                                        </div>
                                                                                                </td>
                                                                                        </tr>
                                                                                        @endforeach

                                                                                        <tr>
                                                                                                <td class="fw-bold fs-5">Precio Total de la factura</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td>
                                                                                                        <div class="input-group">
                                                                                                                <input type="text" class="form-control text-center fw-bold fs-5" name="precio_total_factura" value="{{ old('precio_total.' . $index, $invoice->total_factura) }}€" step="0.01" readonly> 
                                                                                                                <span class="input-group-text fw-bold fs-5">€</span>
                                                                                                        </div>
                                                                                                </td>
                                                                                        </tr>
                                                                                </tbody>
                                                                        </table>
                                                                </div>

                                                        </div>

                                                        <button type="submit" class="btn btn-outline-light mt-2" style="background: #d35400;">Actualizar Factura</button>
                                                </div>
                                        </div>
                                </form>

                        </div>
                </div>

        </div>

        <!-- script para calcular el precio de cada detalle y el precio total de la factura -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/administrativo/calcular_precios_factura.js') }}"></script>

@endsection
