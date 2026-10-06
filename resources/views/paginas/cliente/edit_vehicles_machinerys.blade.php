@extends('plantillas.base')

@section('titulo', 'Editar Vehículo/Maquinaria')

@section('contenido')

        <h3 style="color: #d35400;">Editar Vehículo/Maquinaria</h3>
        
        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-8 col-md-10 col-sm-12">
                                
                                <form action="{{ route('update_vehicle_machinery', $vehicle_machinery->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                        <h4>Vehículo/Máquina</h4>
                                                </div>
                                                <div class="card-body" style="background-color: rgba(0, 0, 0, 0.15);">

                                                        <div class="text-start mb-3">
                                                                <label for="categoria" class="form-label  fw-bold fs-5">Categoria</label>
                                                                <select id="categoria" name="categoria" class="form-control">
                                                                        <option value="{{ $vehicle_machinery->categoria->id }}" selected>
                                                                                {{ $vehicle_machinery->categoria->nombre }}
                                                                        </option>

                                                                        <!-- Otras categorías disponibles -->
                                                                        @foreach($categorias as $categoria)
                                                                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                                                        @endforeach
                                                                </select>
                                                                @error('categoria')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <div class="text-start mb-3">
                                                                <label for="marca" class="form-label  fw-bold fs-5">Marca</label>
                                                                <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $vehicle_machinery->marca) }}">
                                                                @error('marca')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <div class="text-start mb-3">
                                                                <label for="modelo" class="form-label  fw-bold fs-5">Modelo</label>
                                                                <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo', $vehicle_machinery->modelo) }}">
                                                                @error('modelo')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <div class="text-start mb-3">
                                                                <label for="matricula" class="form-label  fw-bold fs-5">Matrícula</label>
                                                                <input type="text" class="form-control" id="matricula" name="matricula" value="{{ old('matricula', $vehicle_machinery->matricula) }}">
                                                                @error('matricula')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <div class="text-start mb-3">
                                                                <label for="ano" class="form-label  fw-bold fs-5">Año</label>
                                                                <input type="text" class="form-control" id="ano" name="ano" value="{{ old('ano', $vehicle_machinery->ano) }}">
                                                                @error('ano')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <button type="submit" class="btn btn-outline-light mt-2" style="background: #d35400;">Actualizar Vehículo/Maquinaria</button>
                                                </div>
                                        </div>
                                </form>

                        </div>
                      
                </div>

        </div>

@endsection
