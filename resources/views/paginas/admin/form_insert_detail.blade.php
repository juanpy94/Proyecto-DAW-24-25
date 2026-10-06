@extends('plantillas.base')

@section('titulo', 'Insertar Detalle')

@section('contenido')

        <h3 style="color: #d35400;">Insertar Detalle</h3>

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 mx-auto border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                                <form action="{{ route('adm_insert_detail') }}" method="POST">
                                        @csrf

                                        <!-- Campo oculto para pasar el id de la reparación -->
                                        <input type="hidden" name="id_reparacion" value="{{ $repair->id }}">

                                        <!-- Campo oculto para pasar el id de la factura -->
                                        <input type="hidden" name="id_factura" value="{{ $invoice->id }}">
                                        
                                        <div class="text-start mb-3">
                                                <label for="descripcion" class="form-label  fw-bold fs-5">Descripción</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion') }}" placeholder="Descripción del detalle...">
                                                @error('descripcion')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="cantidad" class="form-label  fw-bold fs-5">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad') }}" placeholder="Cantidad..." step="0.01">
                                                @error('cantidad')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="precio_unidad" class="form-label  fw-bold fs-5">Precio Unidad</label>
                                                <input type="number" class="form-control" id="precio_unidad" name="precio_unidad" value="{{ old('precio_unidad') }}" placeholder="Precio unidad..." step="0.01">
                                                @error('precio_unidad')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="porcentaje_iva" class="form-label  fw-bold fs-5">% IVA</label>
                                                <input type="number" class="form-control" id="porcentaje_iva" name="porcentaje_iva" value="{{ old('porcentaje_iva', $dato_factura->iva) }}" placeholder="% de IVA..." step="0.01">
                                                @error('porcentaje_iva')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="porcentaje_descuento" class="form-label  fw-bold fs-5">% Descuento</label>
                                                <input type="number" class="form-control" id="porcentaje_descuento" name="porcentaje_descuento" value="{{ old('porcentaje_descuento', 0) }}" placeholder="% de Descuento..." step="0.01">
                                                @error('porcentaje_descuento')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <input type="submit" class="btn btn-dark mt-4" value="Añadir Detalle">
                        
                                </form>

                        </div>
                </div>

        </div>

@endsection
