@extends('plantillas.base')

@section('titulo', 'Restablecer Contraseña')

@section('contenido')

        <div class="col-8 col-md-6 col-lg-3 mx-auto border border-dark rounded-3 p-4 mt-3">

                <h2>Restablecer Contraseña</h2>

                <form method='post' action='{{ route("update_password") }}'>
                @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="text-start mt-4">
                                <label for="email" class="form-label fs-5 fw-bold">Correo electrónico:</label>
                                <input type="email" class="form-control border-dark" name="email" placeholder="Correo electrónico*" value="{{ $email ?? old('email') }}">
                                @error('email')
                                        <span class="text-danger">*{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="text-start mt-4">
                                <label for="password" class="form-label fs-5 fw-bold">Nueva Contraseña:</label>
                                <input type="password" class="form-control border-dark" name="password" placeholder="Nueva contraseña*" value="{{ old('password') }}">
                                @error('password')
                                        <span class="text-danger">*{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="text-start mt-4">
                                <label for="password_confirmation" class="form-label fs-5 fw-bold">Confirmar Contraseña:</label>
                                <input type="password" class="form-control border-dark" name="password_confirmation" placeholder="Confirmar nueva contraseña*">
                        </div>
                        
                        <input type="submit" class="btn btn-dark mt-4" value="Restablecer Contraseña">
                </form>

        </div>

@endsection
