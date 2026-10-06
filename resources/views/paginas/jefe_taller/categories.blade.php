@extends('plantillas.base')

@section('titulo', 'Categorías')

@section('contenido')

        <h3 style="color: #d35400;">Categorías de Vehículos y Máquinas</h3>
        
        @if(session('status'))
                <div id="statusMessage" class="alert alert-success mx-auto d-inline-block mt-3">
                        {{ session('status') }}
                </div>
        @endif

        @if(session('error'))
                <div id="errorMessage" class="alert alert-danger mx-auto d-inline-block mt-3">
                        {{ session('error') }}
                </div>
        @endif

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">
                        
                        <div class="col-12 col-xl-6">

                                <form action="{{ route('add_categorie') }}" method="POST">
                                        @csrf
                                        <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                        <h4>Nueva Categoría</h4>
                                                </div>
                                                <div class="card-body" style="background-color: rgba(0, 0, 0, 0.15);">
                                                        
                                                        <div class="text-start mb-3">
                                                                <label for="nombre" class="form-label  fw-bold fs-5">Nombre de la Categoría</label>
                                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre de la categoría...">
                                                                @error('nombre')
                                                                        <span class="text-danger">*{{ $message }}</span>
                                                                @enderror
                                                        </div>

                                                        <button type="submit" class="btn btn-outline-light" style="background: #d35400;">Añadir Categoría</button>
                                                </div>
                                        </div>
                                </form>

                        </div>

                        <div class="col-12 col-xl-6">

                                <div class="col-12 col-xl-12 mb-3">

                                        <div class="card">
                                                <div class="card-header bg bg-dark">
                                                        <h5 class="text-white">Categorías</h5>
                                                </div>
                                                <div class="card-body">

                                                        <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                        <thead class="bg bg-warning">
                                                                                <tr>
                                                                                        <th>Nombre</th>
                                                                                        <th></th>
                                                                                        <th></th>
                                                                                </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach ($categories as $categorie)
                                                                                <tr class="table-light">
                                                                                        <td>{{ $categorie->nombre }}</td>  
                                                                                        <td><a href="{{ route('edit_categorie', $categorie->id) }}" class="btn btn-warning btn-sm">Editar</a></td>
                                                                                        <td>
                                                                                                <form action="{{ route('delete_categorie', $categorie->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');">
                                                                                                        @csrf
                                                                                                        @method('DELETE')
                                                                                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                                                                </form>
                                                                                        </td>
                                                                                </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                </table>
                                                        </div>
                                                </div>
                                        </div>

                                </div>

                        </div>
                </div>

        </div>

        <!-- script para ocultar los mensajes status y error a los 10 segundos -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/status_error_hide.js') }}"></script>

@endsection
