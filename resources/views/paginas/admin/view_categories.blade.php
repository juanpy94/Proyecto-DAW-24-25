@extends('plantillas.base')

@section('titulo', 'Categorias')

@section('contenido')

        <h3 style="color: #d35400;">Categorias</h3>

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

                        <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12">


                                <div class="text-end mb-3">
                                                
                                        <form action="{{ route('form_insert_category') }}" method="GET">
                                                <button type="submit" class="btn btn-warning btn-md">Insertar Categoria</button>
                                        </form>

                                </div>

                                <div id="category_table">
                                        <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                        <thead class="bg bg-warning">
                                                                <tr>
                                                                        <th>Nombre</th>
                                                                        <th>Acciones</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($categories as $category)
                                                                <tr class="table-light">
                                                                        <td>{{ $category->nombre }}</td>
                                                                        <td>
                                                                                <div class="d-flex justify-content-center">
                                                                                        <form action="{{ route('edit_category', $category->id) }}" method="GET">
                                                                                                <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                                                                                        </form>

                                                                                        <form action="{{ route('delete_category', $category->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar esta categoria?');">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit" class="btn btn-danger btn-sm ms-3">Eliminar</button>
                                                                                        </form>
                                                                                </div>
                                                                        </td>
                                                                </tr>
                                                        @endforeach
                                                        </tbody>
                                                </table>
                                        </div>

                                </div>

                                <!-- Mostrar total de resultados -->
                                <div class="col-12 mt-3">
                                        <p id="result_count"><strong>Mostrando del {{ $categories->firstItem() }} al {{ $categories->lastItem() }} de {{ $categories->total() }} resultados.</strong></p>
                                </div>

                                <!-- Paginación -->
                                <div class="d-flex justify-content-center">
                                        {{ $categories->links('pagination::bootstrap-4') }}
                                </div>
                                        
                        </div>

                </div>

        </div>

        <!-- script para ocultar los mensajes status y error a los 10 segundos -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/status_error_hide.js') }}"></script>

@endsection
