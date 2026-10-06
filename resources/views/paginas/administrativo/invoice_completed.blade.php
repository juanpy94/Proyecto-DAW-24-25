@extends('plantillas.base')

@section('titulo', 'Realizar Factura')

@section('contenido')

        <h3 style="color: #d35400;">Emitir Factura</h3>

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

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
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <tr class="table-light">
                                                                <td>{{ $repair->VehiculoMaquina->categoria->nombre }}</td>
                                                                <td>{{ $repair->VehiculoMaquina->marca }}</td>
                                                                <td>{{ $repair->VehiculoMaquina->modelo }}</td>
                                                                <td>{{ $repair->VehiculoMaquina->matricula ?: '-' }}</td>
                                                                <td>{{ date('d-m-Y', strtotime($repair->fecha_entrada)) }}</td>
                                                                <td>{{ $repair->descripcion }}</td>
                                                        </tr>
                                                </tbody>
                                        </table>
                                </div>
                        </div>

                        <div class="col-12">
                                
                                <form action="{{ route('add_invoice', $repair->id) }}" method="POST">
                                        @csrf
                                        <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                        <h4>Detalles de la Reparación</h4>
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
                                                                                                        <input type="number" class="form-control" name="precio[{{ $index }}]" value="{{ old('precio.' . $index, $detalle->descripcion === 'Horas empleadas' ? $dato_factura->precio_mano_obra : '') }}" placeholder="Precio unidad..." step="0.01">
                                                                                                        @error('precio.' . $index)
                                                                                                                <span class="text-danger">*{{ $message }}</span>
                                                                                                        @enderror
                                                                                                </td>
                                                                                                <td>
                                                                                                        <input type="number" class="form-control" name="iva[{{ $index }}]" value="{{ old('iva.' . $index, $dato_factura->iva) }}" placeholder="% IVA..." step="0.01">
                                                                                                        @error('iva.' . $index)
                                                                                                                <span class="text-danger">*{{ $message }}</span>
                                                                                                        @enderror
                                                                                                </td>
                                                                                                <td>
                                                                                                        <input type="number" class="form-control" name="descuento[{{ $index }}]" value="{{ old('descuento.' . $index, $detalle->descuento ?: 0) }}" placeholder="% Descuento..." step="0.01">
                                                                                                        @error('descuento.' . $index)
                                                                                                                <span class="text-danger">*{{ $message }}</span>
                                                                                                        @enderror
                                                                                                </td>
                                                                                                <td>
                                                                                                        <div class="input-group">
                                                                                                                <input type="text" class="form-control text-end fw-bold" name="precio_total[{{ $index }}]" value="{{ old('precio_total.' . $index, $detalle->cantidad * $detalle->precio_unidad) }}" step="0.01" readonly>
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
                                                                                                                <input type="text" class="form-control text-center fw-bold fs-5" name="precio_total_factura" value="{{ old('precio_total_factura', 0) }}" step="0.01" readonly>
                                                                                                                <span class="input-group-text fw-bold fs-5">€</span>
                                                                                                        </div>
                                                                                                </td>
                                                                                        </tr>
                                                                                </tbody>
                                                                        </table>
                                                                </div>

                                                        </div>

                                                        <button type="submit" class="btn btn-outline-light mt-2" style="background: #d35400;">Completar Factura</button>
                                                </div>
                                        </div>
                                </form>

                        </div>
                </div>

        </div>

        <!-- script para calcular el precio de cada detalle y el precio total de la factura -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/administrativo/calcular_precios_factura.js') }}"></script>

@endsection
