@extends('plantillas.base')

@section('titulo', 'Insertar Vehiculo/Maquinaria')

@section('contenido')

        <h3 style="color: #d35400;">Insertar Vehículo/Maquinaria</h3>

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 mx-auto border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                                <form action="{{ route('adm_insert_vehicle') }}" method="POST">
                                        @csrf
                                        
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
                                                <label for="usuario" class="form-label  fw-bold fs-5">Cliente</label>
                                                <input type="text" id="searchInput" class="form-control" placeholder="Buscar cliente... (Nombre, usuario, email o teléfono)">
                                                <div id="usuario_list" class="list-group" style="display:none;"></div>

                                                <!-- Campo oculto para almacenar el id del usuario -->
                                                <input type="hidden" id="id_user" name="id_user">
                                                @error('id_user')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <input type="submit" class="btn btn-dark mt-4" value="Añadir Vehiculo/Maquinaria">
                        
                                </form>

                        </div>
                </div>

        </div>

        <!-- script para buscar al cliente -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/admin/search_client.js') }}"></script>

@endsection
