@extends('plantillas.base')

@section('titulo', 'Editar Categoria')

@section('contenido')

        <h3 style="color: #d35400;">Editar Categoria</h3>

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-8 col-md-10 col-sm-12 mx-auto border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                                <form action="{{ route('update_category', $category->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="text-start mt-4">
                                                <label for="nombre" class="form-label fs-5 fw-bold">Nombre de la Categoria:</label>
                                                <input type="text" class="form-control border-dark" name="nombre" placeholder="Nombre categoria*" value="{{ old('nombre', $category->nombre) }}">
                                                @error('nombre')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <input type="submit" class="btn btn-dark mt-4" value="Editar Categoria">
                        
                                </form>

                        </div>
                </div>

        </div>

@endsection
