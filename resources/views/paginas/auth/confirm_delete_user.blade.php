@extends('plantillas.base')

@section('titulo', 'Eliminar Usuario')

@section('contenido')

<div class="container mt-3">

    <div class="row d-flex justify-content-center fs-5">

        @include('paginas.auth.navProfile')

        <div class="col-md-7">
            <form action="{{ route('delete_user') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta?');">
                @csrf
                @method('delete')
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4>Eliminar Usuario</h4>
                    </div>
                    <div class="card-body" style="background-color: rgba(0, 0, 0, 0.15);">
                        <div class="text-start mb-3">
                            <label for="confirmar" class="form-label  fw-bold fs-5">¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.</label>
                        </div>
                        <button type="submit" class="btn btn-outline-light bg bg-dark">Aceptar</button>

                        <a href="{{ route('user_profile') }}" class="btn btn-outline-light ms-5" style="background: #d35400;">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
