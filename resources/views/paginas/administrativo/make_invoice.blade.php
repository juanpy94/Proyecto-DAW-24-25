@extends('plantillas.base')

@section('titulo', 'Realizar Factura')

@section('contenido')

        <h3 style="color: #d35400;">Partes de trabajo pendientes de facturar</h3>

        @if(session('status'))
                <div id="statusMessage" class="alert alert-success mx-auto d-inline-block mt-3">
                        {{ session('status') }}

                        @if(session('invoice_url'))
                                <p class="mt-2">Puedes ver la factura <a href="{{ session('invoice_url') }}" target="_blank">aquí</a>.</p>
                        @endif
                </div>
        @endif

        @if(session('error'))
                <div id="errorMessage" class="alert alert-danger mx-auto d-inline-block mt-3">
                        {{ session('error') }}
                </div>
        @endif
        
        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        @include('paginas.administrativo.navFacturas')

                        <div class="col-md-9">

                                <div class="col-12 col-xl-12 mb-3">

                                        <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                        <thead class="bg bg-warning">
                                                                <tr>
                                                                        <th>Tipo</th>
                                                                        <th>Marca</th>
                                                                        <th>Modelo</th>
                                                                        <th>Matrícula</th>
                                                                        <th>Fecha entrada</th>
                                                                        <th>Descripción</th>
                                                                        <th>Mecánico</th>
                                                                        <th></th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($repairs as $userRepair)
                                                                <tr class="table-light">
                                                                        <td>{{ $userRepair->VehiculoMaquina->categoria->nombre }}</td>
                                                                        <td>{{ $userRepair->VehiculoMaquina->marca }}</td>
                                                                        <td>{{ $userRepair->VehiculoMaquina->modelo }}</td>
                                                                        <td>{{ $userRepair->VehiculoMaquina->matricula ?: '-' }}</td>
                                                                        <td>{{ date('d-m-Y', strtotime($userRepair->fecha_entrada)) }}</td>
                                                                        <td>{{ $userRepair->descripcion }}</td>
                                                                        <td>{{ $userRepair->usuario->nombre }}</td>
                                                                        <th>             
                                                                                <a href="{{ route('invoice_completed', $userRepair->id) }}" class="btn btn-warning btn-sm">Crear</a>
                                                                        </th>
                                                                </tr>
                                                        @endforeach
                                                        </tbody>
                                                </table>
                                        </div>

                                        <!-- Mostrar total de resultados -->
                                        <div class="col-12 mt-3">
                                                <p><strong>Mostrando del {{ $repairs->firstItem() }} al {{ $repairs->lastItem() }} de {{ $repairs->total() }} resultados.</strong></p>
                                        </div>

                                        <!-- Paginación -->
                                        <div class="d-flex justify-content-center">
                                                {{ $repairs->links('pagination::bootstrap-4') }}
                                        </div>
                                        
                                </div>

                        </div>
                </div>

        </div>

        <!-- script para ocultar los mensajes status y error a los 10 segundos -->
        <script src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/js/status_error_hide.js') }}"></script>

@endsection
