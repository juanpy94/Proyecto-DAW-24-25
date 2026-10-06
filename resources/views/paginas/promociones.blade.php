@extends('plantillas.base')

@section('titulo', 'Promociones')

@section('contenido')

    <h3 style="color: #d35400;">Promociones</h3>
        
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/promocion_1.png') }}" class="img-fluid w-100">
        </div>
        <div class="col-12 col-md-6 mb-4">
            <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/promocion_2.png') }}" class="img-fluid w-100">
        </div>
        <div class="col-12 col-md-6 mb-4">
            <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/promocion_3.png') }}" class="img-fluid w-100">
        </div>
        <div class="col-12 col-md-6 mb-4">
            <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/promocion_4.png') }}" class="img-fluid w-100">
        </div>
    </div>

@endsection
