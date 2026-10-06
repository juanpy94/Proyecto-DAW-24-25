@extends('plantillas.base')

@section('titulo', 'Insertar Reparacion')

@section('contenido')

        <h3 style="color: #d35400;">Insertar Reparación</h3>

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 mx-auto border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                                <form action="{{ route('adm_insert_repair') }}" method="POST">
                                        @csrf
                                        
                                        <div class="text-start mb-3">
                                                <label for="usuario" class="form-label  fw-bold fs-5">Buscar Usuario</label>
                                                <input type="text" id="searchInput" class="form-control" placeholder="Buscar usuario... (Nombre, usuario, email o teléfono)">
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
                                                <label for="estado" class="form-label fw-bold fs-5">Estado de la reparación</label>
                                                <select id="estado" name="estado" class="form-control">
                                                        <option value="">Seleccionar estado...</option>
                                                        @foreach($estados as $estado)
                                                                <option value="{{ $estado->estado }}">{{ $estado->estado }}</option>
                                                        @endforeach
                                                </select>
                                                @error('estado')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="fecha_entrada" class="form-label  fw-bold fs-5">Fecha Entrada</label>
                                                <input type="date" class="form-control" id="fecha_entrada" name="fecha_entrada" value="{{ old('fecha_entrada') }}" placeholder="Fecha entrada...">
                                                @error('fecha_entrada')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="fecha_inicio" class="form-label  fw-bold fs-5">Fecha Inicio</label>
                                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" placeholder="Fecha inicio de la reparación...">
                                                @error('fecha_inicio')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mb-3">
                                                <label for="fecha_fin" class="form-label  fw-bold fs-5">Fecha Fin</label>
                                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" placeholder="Fecha fin de la reparación...">
                                                @error('fecha_fin')
                                                        <span class="text-danger">*{{ $message }}</span>
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

                                        <input type="submit" class="btn btn-dark mt-4" value="Añadir Reparación">
                        
                                </form>

                        </div>
                </div>

        </div>

        <!-- script para buscar los vehiculos o maquinas de un usuario -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/admin/search_repair_vehicle.js') }}"></script>

@endsection
