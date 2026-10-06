@extends('plantillas.base')

@section('titulo', 'Perfil')

@section('contenido')

        @if(session('status'))
                <div class="alert alert-success mx-auto d-inline-block">
                {{ session('status') }}
                </div>
        @endif

        <div class="container mt-3">
                <div class="row d-flex justify-content-center fs-5">

                        @include('paginas.auth.navProfile')

                        <div class="col-md-7">
                                <div class="card">
                                        <div class="card-header bg-dark text-white">
                                                <h4>Mis Datos</h4>
                                        </div>
                                        <div class="card-body" style="background-color: rgba(0, 0, 0, 0.15);">
                                                <p class="text-start"><strong>Nombre:</strong> {{ $user->nombre }}</p>
                                                <p class="text-start"><strong>Usuario:</strong> {{ $user->usuario }}</p>
                                                <p class="text-start"><strong>Email:</strong> {{ $user->email }}</p>
                                                <p class="text-start"><strong>Dirección:</strong> {{ $user->direccion }}</p>
                                                <p class="text-start"><strong>Ciudad:</strong> {{ $user->ciudad }}</p>
                                                <p class="text-start"><strong>Teléfono:</strong> {{ $user->telefono }}</p>
                                                <p class="text-start"><strong>Rol:</strong> {{ $user->rol_nombre }}</p>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>

@endsection

