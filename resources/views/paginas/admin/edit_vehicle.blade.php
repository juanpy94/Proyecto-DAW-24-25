@extends('plantillas.base')

@section('titulo', 'Editar Vehiculo/Maquinaria')

@section('contenido')

        <h3 style="color: #d35400;">Editar Vehículo/Maquinaria</h3>

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-8 col-md-10 col-sm-12 mx-auto border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                                <form action="{{ route('adm_update_vehicle', $vehicle->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="text-start mb-3">
                                                <label for="marca" class="form-label  fw-bold fs-5">Marca</label>
                                                <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $vehicle->marca) }}" placeholder="Marca...">
                                                @error('marca')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="modelo" class="form-label  fw-bold fs-5">Modelo</label>
                                                <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo', $vehicle->modelo) }}" placeholder="Modelo...">
                                                @error('modelo')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="matricula" class="form-label  fw-bold fs-5">Matrícula</label>
                                                <input type="text" class="form-control" id="matricula" name="matricula" value="{{ old('matricula', $vehicle->matricula) }}" placeholder="Matricula...">
                                                @error('matricula')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="ano" class="form-label  fw-bold fs-5">Año</label>
                                                <input type="text" class="form-control" id="ano" name="ano" value="{{ old('ano', $vehicle->ano) }}" placeholder="Año...">
                                                @error('ano')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="categoria" class="form-label  fw-bold fs-5">Categoria</label>
                                                <select id="categoria" name="categoria" class="form-control">
                                                        <option value="{{ $vehicle->categoria->id }}" selected>
                                                                {{ $vehicle->categoria->nombre }}
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
                                                <label for="usuario" class="form-label  fw-bold fs-5">Cliente</label>
                                                <input type="text" id="searchInput" class="form-control" value="{{ old('searchInput', $vehicle->usuario->nombre ) }}" placeholder="Buscar cliente... (Nombre, usuario, email o teléfono)">
                                                <div id="usuario_list" class="list-group" style="display:none;"></div>

                                                <!-- Campo oculto para almacenar el id del usuario -->
                                                <input type="hidden" id="id_user" name="id_user">
                                                @error('id_user')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <input type="submit" class="btn btn-dark mt-4" value="Editar Vehiculo/Maquinaria">
                        
                                </form>

                        </div>
                </div>

        </div>

        <!-- script para buscar al cliente -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/admin/search_client.js') }}"></script>

@endsection
