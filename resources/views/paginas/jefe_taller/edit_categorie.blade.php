@extends('plantillas.base')

@section('titulo', 'Editar Categoría')

@section('contenido')

        <h3 style="color: #d35400;">Editar Categoría de Vehículos o Máquinas</h3>
        
        <div class="container mt-3">

                <div class="d-flex justify-content-center">

                        <form action="{{ route('update_categorie', $categorie->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card">
                                        <div class="card-header bg-dark text-white">
                                                <h4>Editar Categoría</h4>
                                        </div>
                                        <div class="card-body" style="background-color: rgba(0, 0, 0, 0.15);">
                                                        
                                                <div class="text-start mb-3">
                                                        <label for="nombre" class="form-label fw-bold fs-5">Nombre de la categoría</label>
                                                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $categorie->nombre }}" placeholder="Nombre de la categoría...">
                                                        @error('nombre')
                                                                <span class="text-danger">*{{ $message }}</span>
                                                        @enderror
                                                </div>

                                                <button type="submit" class="btn btn-outline-light" style="background: #d35400;">Guardar Cambios</button>
                                        </div>
                                </div>
                        </form>

                </div>

        </div>

@endsection
