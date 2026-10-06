@extends('plantillas.base')

@section('titulo', 'Registrar Usuario')

@section('contenido')

        <div class="col-10 col-md-8 col-lg-8 mx-auto border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                <h2>Registrar Usuario</h2>

                <form method='post' action='{{ route("register") }}'>
                @csrf
                        <div class="text-start mt-4">
                                <label for="nombre" class="form-label fs-5 fw-bold">Nombre completo:</label>
                                <input type="text" class="form-control border-dark" name="nombre" placeholder="Nombre completo*" value="{{ old('nombre') }}">
                                @error('nombre')
                                        <span class="text-danger">*{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="text-start mt-4">
                                <label for="direccion" class="form-label fs-5 fw-bold">Dirección:</label>
                                <input type="text" class="form-control border-dark" name="direccion" placeholder="Dirección*" value="{{ old('direccion') }}">
                                @error('direccion')
                                        <span class="text-danger">*{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="text-start mt-4">
                                <label for="ciudad" class="form-label fs-5 fw-bold">Ciudad:</label>
                                <input type="text" class="form-control border-dark" name="ciudad" placeholder="Ciudad*" value="{{ old('ciudad') }}">
                                @error('ciudad')
                                        <span class="text-danger">*{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="text-start mt-4">
                                <label for="telefono" class="form-label fs-5 fw-bold">Teléfono:</label>
                                <input type="text" class="form-control border-dark" name="telefono" placeholder="Teléfono*" value="{{ old('telefono') }}">
                                @error('telefono')
                                        <span class="text-danger">*{{ $message }}</span>
                                @enderror
                        </div>
                        
                        <div class="text-start mt-4">
                                <label for="usuario" class="form-label fs-5 fw-bold">Usuario:</label>
                                <input type="text" class="form-control border-dark" name="usuario" placeholder="Usuario*" value="{{ old('usuario') }}">
                                <span id="usuarioError" class="text-danger" style="display: none;">El usuario ya está en uso. Por favor, ingrese otro.</span>
                                @error('usuario')
                                        <span class="text-danger">*{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="text-start mt-4">
                                <label for="email" class="form-label fs-5 fw-bold">Correo electrónico:</label>
                                <input type="email" class="form-control border-dark" name="email" placeholder="Correo electrónico*" value="{{ old('email') }}">
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

                        <input type="submit" class="btn btn-dark mt-4" value="Registrar">

                        <div class="mt-3 text-center">
                                <a href="{{ route('login_form') }}" class="text-danger text-decoration-none">¿Ya tienes cuenta? Inicia sesión</a>
                        </div>
                        
                </form>

        </div>

        <!-- link para agregar el icono del ojo al input contraseña y confirmar contraseña -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <!-- script para verificar si el usuario o email esta en uso -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/verificar_usuario_email.js') }}"></script>

@endsection

