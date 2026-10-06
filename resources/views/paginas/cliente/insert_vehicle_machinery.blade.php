@extends('plantillas.base')

@section('titulo', 'Insertar Vehículo/Maquinaria')

@section('contenido')

        <h3 style="color: #d35400;">Insertar Vehículo/Maquinaria</h3>
        
        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-8 col-md-10 col-sm-12">
                                
                                <form action="{{ route('insert_vehicle_machinery') }}" method="POST">
                                        @csrf
                                        
                                        <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                        <h4>Vehículo/Máquina</h4>
                                                </div>
                                                <div class="card-body" style="background-color: rgba(0, 0, 0, 0.15);">

                                                        <div class="text-start mb-3">
                                                                <label for="categoria" class="form-label  fw-bold fs-5">Categoria</label>
                                                                <select id="categoria" name="categoria" class="form-control">
                                                                        <option value="" {{ old('categoria') == '' ? 'selected' : '' }}>
                                                                                Seleccione categoria...
                                                                        </option>

                                                                        <!-- Otras categorías disponibles -->
                                                                        @foreach($categorias as $categoria)
                                                                                <option value="{{ $categoria->id }}" {{ old('categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                                                        @endforeach
                                                                </select>
                                                                @error('categoria')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <div class="text-start mb-3">
                                                                <label for="marca" class="form-label  fw-bold fs-5">Marca</label>
                                                                <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca') }}" placeholder="Marca...">
                                                                @error('marca')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <div class="text-start mb-3">
                                                                <label for="modelo" class="form-label  fw-bold fs-5">Modelo</label>
                                                                <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo') }}" placeholder="Modelo...">
                                                                @error('modelo')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <div class="text-start mb-3">
                                                                <label for="matricula" class="form-label  fw-bold fs-5">Matrícula</label>
                                                                <input type="text" class="form-control" id="matricula" name="matricula" value="{{ old('matricula') }}" placeholder="Matricula...">
                                                                @error('matricula')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <div class="text-start mb-3">
                                                                <label for="ano" class="form-label  fw-bold fs-5">Año</label>
                                                                <input type="text" class="form-control" id="ano" name="ano" value="{{ old('ano') }}" placeholder="Año...">
                                                                @error('ano')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <button type="submit" class="btn btn-outline-light mt-2" style="background: #d35400;">Añadir Vehículo/Maquinaria</button>
                                                </div>
                                        </div>
                                </form>

                        </div>
                      
                </div>

        </div>

@endsection
