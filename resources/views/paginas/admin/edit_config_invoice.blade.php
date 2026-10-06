@extends('plantillas.base')

@section('titulo', 'Editar Configuracion Factura')

@section('contenido')

        <h3 style="color: #d35400;">Editar Configuración de la Factura</h3>

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-8 col-md-10 col-sm-12 mx-auto border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                                <form action="{{ route('adm_update_config_invoice', $configInvoice->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="text-start mb-3">
                                                <label for="iva" class="form-label  fw-bold fs-5">% IVA</label>
                                                <input type="number" class="form-control" id="iva" name="iva" value="{{ old('iva', $configInvoice->iva) }}" placeholder="% IVA...">
                                                @error('iva')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="mano_obra" class="form-label  fw-bold fs-5">Precio mano de obra</label>
                                                <input type="number" class="form-control" id="mano_obra" name="mano_obra" value="{{ old('mano_obra', $configInvoice->precio_mano_obra) }}" placeholder="Precio mano de obra...">
                                                @error('mano_obra')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <input type="submit" class="btn btn-dark mt-4" value="Editar Configuracion">
                        
                                </form>

                        </div>
                </div>

        </div>

@endsection
