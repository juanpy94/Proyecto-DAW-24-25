@extends('plantillas.base')

@section('titulo', 'Iniciar sesión')

@section('contenido')

        @if (session('error'))
                <div class="alert alert-danger mx-auto d-inline-block">
                        {{ session('error') }}
                </div>
        @endif

        <div class="col-8 col-md-6 col-lg-3 mx-auto border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                <h2>Iniciar Sesión</h2>

                <form method='post' action='{{ route("login_auth") }}'>
                @csrf

                        @if(session('status'))
                                <div class="alert alert-success">
                                        {{ session('status') }}
                                </div>
                        @endif
                        
                        <div class="text-start mt-4">
                                <label for="usuario" class="form-label fs-5 fw-bold">Usuario:</label>
                                <input type="text" class="form-control border-dark" name="usuario" placeholder="Usuario o email*" value="{{ old('usuario') }}">
                                @error('usuario')
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
                        
                        <input type="submit" class="btn btn-dark mt-4" value="Iniciar Sesión">

                        <div class="mt-3 text-center">
                                <a href="{{ route('forgot_password') }}" class="text-danger text-decoration-none">¿Olvidaste tu contraseña?</a>
                        </div>
                        
                </form>

        </div>

        <!-- link para agregar el icono del ojo al input contraseña -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <!-- script para mostrar la contraseña al pulsar el icono del ojo -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/login_password.js') }}"></script>

@endsection
