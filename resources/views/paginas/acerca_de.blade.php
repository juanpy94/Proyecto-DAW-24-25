@extends('plantillas.base')

@section('titulo', 'Acerca de')

@section('contenido')

        <h3 style="color: #d35400;">Acerca de</h3>

        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 border border-dark rounded-3 p-4 mt-3" style="background-color: rgba(0, 0, 0, 0.15);">

                                <h3>Juan Pablo Peñuela Cámara</h3>
                                
                                <img src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/imagenes/logo_ies.png') }}" class="img-fluid w-50 mt-3">

                        </div>

                </div>

        </div>

@endsection
