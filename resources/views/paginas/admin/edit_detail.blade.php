@extends('plantillas.base')

@section('titulo', 'Editar Detalle')

@section('contenido')

        <h3 style="color: #d35400;">Editar Detalle</h3>

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-8 col-md-10 col-sm-12 mx-auto border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                                <form action="{{ route('adm_update_detail', $detail->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="text-start mb-3">
                                                <label for="descripcion" class="form-label  fw-bold fs-5">Descripción</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion', $detail->descripcion) }}" placeholder="Descripción del detalle...">
                                                @error('descripcion')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="cantidad" class="form-label  fw-bold fs-5">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad', $detail->cantidad) }}" placeholder="Cantidad..." step="0.01">
                                                @error('cantidad')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="precio_unidad" class="form-label  fw-bold fs-5">Precio Unidad</label>
                                                <input type="number" class="form-control" id="precio_unidad" name="precio_unidad" value="{{ old('precio_unidad', $detail->precio_unidad) }}" placeholder="Precio unidad..." step="0.01">
                                                @error('precio_unidad')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="porcentaje_iva" class="form-label  fw-bold fs-5">% IVA</label>
                                                <input type="number" class="form-control" id="porcentaje_iva" name="porcentaje_iva" value="{{ old('porcentaje_iva', $detail->getAttribute('%_iva')) }}" placeholder="% de IVA..." step="0.01">
                                                @error('porcentaje_iva')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="porcentaje_descuento" class="form-label  fw-bold fs-5">% Descuento</label>
                                                <input type="number" class="form-control" id="porcentaje_descuento" name="porcentaje_descuento" value="{{ old('porcentaje_descuento', $detail->getAttribute('%_descuento')) }}" placeholder="% de Descuento..." step="0.01">
                                                @error('porcentaje_descuento')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>                                        

                                        <input type="submit" class="btn btn-dark mt-4" value="Editar Detalle">
                        
                                </form>

                        </div>
                </div>

        </div>

@endsection
