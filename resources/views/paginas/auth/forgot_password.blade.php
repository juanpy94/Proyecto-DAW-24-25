@extends('plantillas.base')

@section('titulo', 'Recuperar Contraseña')

@section('contenido')

        <div class="col-8 col-md-6 col-lg-3 mx-auto border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                <h2>Recuperar Contraseña</h2>

                @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form method='post' action='{{ route("email_password") }}'>
                @csrf
                        <div class="text-start mt-4">
                                <label for="email" class="form-label fs-5 fw-bold">Correo Electrónico:</label>
                                <input type="email" class="form-control border-dark" name="email" placeholder="Correo electrónico*" value="{{ old('email') }}">
                                @error('email')
                                        <span class="text-danger">*{{ $message }}</span>
                                @enderror
                        </div>
                        
                        <input type="submit" class="btn btn-dark mt-4" value="Enviar enlace de recuperación">
                </form>

        </div>

@endsection
