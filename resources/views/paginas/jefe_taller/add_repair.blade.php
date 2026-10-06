@extends('plantillas.base')

@section('titulo', 'Añadir Reparación')

@section('contenido')

        <h3 style="color: #d35400;">Añadir Reparación</h3>
        
        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        @include('paginas.jefe_taller.navReparaciones')

                        <div class="col-md-8">
                                
                                <form action="{{ route('add_repair') }}" method="POST">
                                        @csrf
                                        <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                        <h4>Nueva Reparación</h4>
                                                </div>
                                                <div class="card-body" style="background-color: rgba(0, 0, 0, 0.15);">
                                                        
                                                        <div class="text-start mb-3">
                                                                <label for="usuario" class="form-label  fw-bold fs-5">Buscar Usuario</label>
                                                                <input type="text" id="usuario_search" class="form-control" placeholder="Buscar usuario...">
                                                                <div id="usuario_list" class="list-group" style="display:none;"></div>
                                                        </div>

                                                        <div class="text-start mb-3">
                                                                <label for="vehiculo_maquina" class="form-label  fw-bold fs-5">Seleccionar Vehículo o Máquina</label>
                                                                <select id="vehiculo_maquina" name="id_vehiculo_maquina" class="form-control">
                                                                        <option value="">Seleccionar...</option>
                                                                </select>
                                                                @error('id_vehiculo_maquina')
                                                                        <span class="text-danger">*El campo seleccionar vehículo o máquina es obligatorio.</span>
                                                                @enderror
                                                        </div>

                                                        <div class="text-start mb-3">
                                                                <label for="descripcion" class="form-label  fw-bold fs-5">Descripción de la reparación</label>
                                                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion') }}" placeholder="Descripción de la reparación...">
                                                                @error('descripcion')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <div class="text-start mb-3">
                                                                <label for="mecanico" class="form-label  fw-bold fs-5">Asignar Mecánico</label>
                                                                <select id="mecanico" name="id_mecanico" class="form-control">
                                                                        <option value="">Seleccionar mecánico...</option>
                                                                        @foreach($mecanicos as $mecanico)
                                                                                <option value="{{ $mecanico->id }}">{{ $mecanico->nombre }}</option>
                                                                        @endforeach
                                                                </select>
                                                                @error('id_mecanico')
                                                                        <span class="text-danger">*El campo asignar mecánico es obligatorio.</span>
                                                                @enderror
                                                        </div>

                                                        <button type="submit" class="btn btn-outline-light" style="background: #d35400;">Añadir Reparación</button>
                                                </div>
                                        </div>
                                </form>

                        </div>
                </div>

        </div>

        <!-- script para buscar los vehiculos o maquinas de un usuario -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/jefe_taller/buscar_usuario.js') }}"></script>

@endsection
