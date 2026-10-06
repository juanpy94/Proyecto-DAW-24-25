@extends('plantillas.base')

@section('titulo', 'Editar Perfil')

@section('contenido')

        <div class="container mt-3">

                <div class="row d-flex justify-content-center fs-5">

                        @include('paginas.auth.navProfile')

                        <div class="col-md-7">

                                <form action="{{ route('update_profile') }}" method="POST">
                                        @csrf
                                        <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                        <h4>Editar Datos</h4>
                                                </div>
                                                <div class="card-body" style="background-color: rgba(0, 0, 0, 0.15);">
                                                        <div class="text-start mb-3">
                                                                <label for="nombre" class="form-label  fw-bold fs-5">Nombre</label>
                                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $user->nombre) }}">
                                                                @error('nombre')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>
                                                        <div class="text-start mb-3">
                                                                <label for="usuario" class="form-label fw-bold fs-5">Usuario</label>
                                                                <input type="text" class="form-control" id="usuario" name="usuario" value="{{ old('usuario', $user->usuario) }}" data-current-user="{{ $user->usuario }}">
                                                                <span id="usuarioError" class="text-danger" style="display: none;">El usuario ya está en uso. Por favor, ingrese otro.</span>
                                                                @error('usuario')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>
                                                        <div class="text-start mb-3">
                                                                <label for="email" class="form-label  fw-bold fs-5">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" readonly>
                                                        </div>
                                                        <div class="text-start mb-3">
                                                                <label for="direccion" class="form-label  fw-bold fs-5">Dirección</label>
                                                                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $user->direccion) }}">
                                                                @error('direccion')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>
                                                        <div class="text-start mb-3">
                                                                <label for="ciudad" class="form-label  fw-bold fs-5">Ciudad</label>
                                                                <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ old('ciudad', $user->ciudad) }}">
                                                                @error('ciudad')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>
                                                        <div class="text-start mb-3">
                                                                <label for="telefono" class="form-label  fw-bold fs-5">Teléfono</label>
                                                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $user->telefono) }}">
                                                                @error('telefono')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <button type="submit" class="btn btn-outline-light" style="background: #d35400;">Guardar Cambios</button>
                                                </div>
                                        </div>
                                </form>

                        </div>

                </div>

        </div>

        <!-- script para verificar si el usuario esta en uso -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/verificar_usuario.js') }}"></script>

@endsection

