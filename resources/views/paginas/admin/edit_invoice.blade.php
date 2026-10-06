@extends('plantillas.base')

@section('titulo', 'Editar Factura')

@section('contenido')

        <h3 style="color: #d35400;">Editar Factura</h3>

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-8 col-md-10 col-sm-12 mx-auto border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                                <form action="{{ route('adm_update_invoice', $invoice->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="text-start mb-3">
                                                <label for="fecha_emision" class="form-label  fw-bold fs-5">Fecha Emisión</label>
                                                <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="{{ old('fecha_emision', $invoice->fecha_emision) }}" placeholder="Fecha emisión...">
                                                @error('fecha_emision')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="estado" class="form-label fw-bold fs-5">Estado de la factura</label>
                                                <select id="estado" name="estado" class="form-control">
                                                        <option value="{{ $invoice->estado }}">{{ $invoice->estado }}</option>
                                                        @foreach($estados as $estado)
                                                                <option value="{{ $estado->estado }}">{{ $estado->estado }}</option>
                                                        @endforeach
                                                </select>
                                                @error('estado')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="administrativo" class="form-label  fw-bold fs-5">Asignar Administrativo</label>
                                                <select id="administrativo" name="id_administrativo" class="form-control">
                                                        <option value="{{ $invoice->usuario->id }}" selected>{{ $invoice->usuario->nombre }}</option>
                                                        @foreach($administrativos as $administrativo)
                                                                <option value="{{ $administrativo->id }}">{{ $administrativo->nombre }}</option>
                                                        @endforeach
                                                </select>
                                                @error('id_administrativo')
                                                        <span class="text-danger">*El campo asignar administrativo es obligatorio.</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="total_factura" class="form-label  fw-bold fs-5">Total Factura</label>
                                                <input type="text" class="form-control" id="total_factura" name="total_factura" value="{{ old('total_factura', $invoice->total_factura) }}€" readonly>
                                                @error('total_factura')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <input type="submit" class="btn btn-dark mt-4" value="Editar Factura">
                        
                                </form>

                        </div>
                </div>

        </div>

@endsection
