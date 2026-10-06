@extends('plantillas.base')

@section('titulo', 'Reparación Completada')

@section('contenido')

        <h3 style="color: #d35400;">Reparación Completada</h3>
        
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
                                
                                <form action="{{ route('repair_add_details', $repair->id) }}" method="POST">
                                        @csrf
                                        <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                        <h4>Detalles de la Reparación</h4>
                                                </div>
                                                <div class="card-body" style="background-color: rgba(0, 0, 0, 0.15);">

                                                        <div id="detalles-container">

                                                                <div class="row mb-3 detalle-row">
                                                                        <div class="col-md-10 col-8">
                                                                                <label for="detalle" class="form-label fw-bold fs-5">Detalle de la reparación</label>
                                                                                <input type="text" class="form-control" name="detalle[]" placeholder="Detalle de la reparación..." value="{{ old('detalle.0') }}">
                                                                                @error('detalle.0')
                                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                                @enderror
                                                                        </div>

                                                                        <div class="col-md-2 col-4">
                                                                                <label for="cantidad" class="form-label fw-bold fs-5">Cantidad</label>
                                                                                <input type="text" class="form-control" name="cantidad[]" placeholder="Cantidad..." value="{{ old('cantidad.0') }}">
                                                                                @error('cantidad.0')
                                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                                @enderror
                                                                        </div>
                                                                </div>

                                                                <!-- Esto hace que las filas generadas con js no se pierdan -->
                                                                @foreach(old('detalle', []) as $index => $detalle)
                                                                        @if ($index > 0)
                                                                        <div class="row mb-3 detalle-row">
                                                                                <div class="col-md-10 col-8">
                                                                                        <input type="text" class="form-control" name="detalle[]" value="{{ $detalle }}" placeholder="Detalle de la reparación...">
                                                                                </div>
                                                                                <div class="col-md-2 col-4">
                                                                                        <input type="text" class="form-control" name="cantidad[]" value="{{ old('cantidad.' . $index) }}" placeholder="Cantidad...">
                                                                                </div>
                                                                        </div>
                                                                        @endif
                                                                @endforeach

                                                        </div>

                                                        <div class="row mb-3">
                                                                <div class="col-12 d-flex justify-content-center">
                                                                <button type="button" class="btn btn-outline-success me-2" id="add-row">+</button>
                                                                <button type="button" class="btn btn-outline-danger" id="remove-row">-</button>
                                                                </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                                <div class="col-md-10 col-8">
                                                                        <input type="text" class="form-control" id="horas" name="horas" value="Horas empleadas" readonly>
                                                                        @error('horas')
                                                                                <span class="text-danger">*{{ $message }}</span>
                                                                        @enderror
                                                                </div>

                                                                <div class="col-md-2 col-4">
                                                                        <input type="text" class="form-control" id="cantidad_horas" name="cantidad_horas" value="{{ old('cantidad_horas') }}" placeholder="Cantidad...">
                                                                        @error('cantidad_horas')
                                                                                <span class="text-danger">*El formato no es válido. Use hh:mm (0-999 horas, 01-59 minutos)</span>
                                                                        @enderror
                                                                </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-outline-light" style="background: #d35400;">Completar Reparación</button>
                                                </div>
                                        </div>
                                </form>

                        </div>
                </div>

        </div>

        <!-- script para agregar una fila para otro detalle y cantidad y opcion de elimnar la fila -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/mecanico/agregar_detalle.js') }}"></script>

@endsection
