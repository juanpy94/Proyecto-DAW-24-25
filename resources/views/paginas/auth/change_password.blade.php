@extends('plantillas.base')

@section('titulo', 'Cambiar Contraseña')

@section('contenido')

        <div class="container mt-3">

                <div class="row d-flex justify-content-center fs-5">

                        @include('paginas.auth.navProfile')

                        <div class="col-md-4">

                                <form action="{{ route('update_password') }}" method="POST">
                                        @csrf
                                        <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                        <h4>Cambiar Contraseña</h4>
                                                </div>
                                                <div class="card-body" style="background-color: rgba(0, 0, 0, 0.15);">
                                                        <div class="text-start mb-3">
                                                                <label for="current_password" class="form-label fw-bold fs-5">Contraseña Actual</label>
                                                                <div class="input-group">
                                                                        <input type="password" class="form-control" id="current_password" name="current_password">
                                                                        <button type="button" class="btn btn-outline-dark" id="toggleCurrentPassword">
                                                                                <i class="fas fa-eye"></i>
                                                                        </button>
                                                                </div>
                                                                @error('current_password')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>
                                                        <div class="text-start mb-3">
                                                                <label for="password" class="form-label fw-bold fs-5">Nueva Contraseña</label>
                                                                <div class="input-group">
                                                                        <input type="password" class="form-control" id="password" name="password">
                                                                        <button type="button" class="btn btn-outline-dark" id="togglePassword">
                                                                                <i class="fas fa-eye"></i>
                                                                        </button>
                                                                </div>
                                                                @error('password')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>
                                                        <div class="text-start mb-3">
                                                                <label for="password_confirmation" class="form-label fw-bold fs-5">Confirmar Nueva Contraseña</label>
                                                                <div class="input-group">
                                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                                                        <button type="button" class="btn btn-outline-dark" id="togglePasswordConfirmation">
                                                                                <i class="fas fa-eye"></i>
                                                                        </button>
                                                                </div>
                                                                @error('password_confirmation')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <button type="submit" class="btn btn-outline-light" style="background: #d35400;">Cambiar Contraseña</button>
                                                </div>
                                        </div>
                                </form>

                        </div>

                </div>

        
        </div>

        <!-- link para agregar el icono del ojo al input contraseña y confirmar contraseña -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <!-- script para mostrar u ocultar el ojo de las contraseñas -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/change_password.js') }}"></script>

@endsection

