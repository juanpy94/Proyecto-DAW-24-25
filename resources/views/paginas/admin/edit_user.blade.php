@extends('plantillas.base')

@section('titulo', 'Editar Usuario')

@section('contenido')

        <h3 style="color: #d35400;">Editar Usuario</h3>

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-8 col-md-10 col-sm-12 mx-auto border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                                <form action="{{ route('update_user', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="text-start mt-4">
                                                <label for="nombre" class="form-label fs-5 fw-bold">Nombre completo:</label>
                                                <input type="text" class="form-control border-dark" name="nombre" placeholder="Nombre completo*" value="{{ old('nombre', $user->nombre) }}">
                                                @error('nombre')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mt-4">
                                                <label for="direccion" class="form-label fs-5 fw-bold">Dirección:</label>
                                                <input type="text" class="form-control border-dark" name="direccion" placeholder="Dirección*" value="{{ old('direccion', $user->direccion) }}">
                                                @error('direccion')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mt-4">
                                                <label for="ciudad" class="form-label fs-5 fw-bold">Ciudad:</label>
                                                <input type="text" class="form-control border-dark" name="ciudad" placeholder="Ciudad*" value="{{ old('ciudad', $user->ciudad) }}">
                                                @error('ciudad')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mt-4">
                                                <label for="telefono" class="form-label fs-5 fw-bold">Teléfono:</label>
                                                <input type="text" class="form-control border-dark" name="telefono" placeholder="Teléfono*" value="{{ old('telefono', $user->telefono) }}">
                                                @error('telefono')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>
                        
                                        <div class="text-start mt-4">
                                                <label for="usuario" class="form-label fs-5 fw-bold">Usuario:</label>
                                                <input type="text" class="form-control border-dark" name="usuario" placeholder="Usuario*" value="{{ old('usuario', $user->usuario) }}">
                                                <span id="usuarioError" class="text-danger" style="display: none;">El usuario ya está en uso. Por favor, ingrese otro.</span>
                                                @error('usuario')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mt-4">
                                                <label for="email" class="form-label fs-5 fw-bold">Correo electrónico:</label>
                                                <input type="email" class="form-control border-dark" name="email" placeholder="Correo electrónico*" value="{{ old('email', $user->email) }}">
                                                <span id="emailError" class="text-danger" style="display: none;">El correo electrónico ya está en uso. Por favor, ingrese otro.</span>
                                                @error('email')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mt-4">
                                                <label for="password" class="form-label fs-5 fw-bold">Contraseña:</label>
                                                <div class="input-group">
                                                        <input type="password" class="form-control border-dark" name="password" id="password" placeholder="Contraseña*" value="{{ old('password') }}">
                                                        <button type="button" class="btn btn-outline-dark" id="togglePassword">
                                                                <i class="fas fa-eye"></i>
                                                        </button>
                                                </div>

                                                @error('password')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="text-start mt-4">
                                                <label for="password_confirmation" class="form-label fs-5 fw-bold">Confirmar contraseña:</label>
                                                <div class="input-group">
                                                        <input type="password" class="form-control border-dark" name="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña*">
                                                        <button type="button" class="btn btn-outline-dark" id="togglePasswordConfirmation">
                                                                <i class="fas fa-eye"></i>
                                                        </button>
                                                </div>
                                        </div>

                                        <div class="text-start mt-4">
                                                <label for="rol" class="form-label fs-5 fw-bold">Rol:</label>
                                                <select name="rol" id="rol" class="form-control">
                                                        <option value="" disabled {{ old('rol') == '' ? 'selected' : '' }}>Selecciona el rol</option>
                                                        <option value="administrador" {{ old('rol', $user->rol) == 'administrador' ? 'selected' : '' }}>Administrador</option>
                                                        <option value="administrativo" {{ old('rol', $user->rol) == 'administrativo' ? 'selected' : '' }}>Administrativo</option>
                                                        <option value="cliente" {{ old('rol', $user->rol) == 'cliente' ? 'selected' : '' }}>Cliente</option>
                                                        <option value="jefe_taller" {{ old('rol', $user->rol) == 'jefe_taller' ? 'selected' : '' }}>Jefe Taller</option>
                                                        <option value="mecanico" {{ old('rol', $user->rol) == 'mecanico' ? 'selected' : '' }}>Mecánico</option>
                                                </select>
                                                @error('rol')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <input type="submit" class="btn btn-dark mt-4" value="Editar Usuario">
                        
                                </form>

                        </div>
                </div>

        </div>

        <!-- link para agregar el icono del ojo al input contraseña y confirmar contraseña -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <!-- script para verificar si el usuario o email esta en uso -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/verificar_usuario_email.js') }}"></script>

@endsection
