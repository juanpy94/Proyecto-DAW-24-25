@extends('plantillas.base')

@section('titulo', 'Ayuda')

@section('contenido')

        <h3 style="color: #d35400;">Ayuda</h3>
        
        <div class="container mt-3">

                <div class="row d-flex justify-content-center">

                        <div class="col-xl-6 col-lg-10 col-md-12 col-sm-12">

                                <video width="100%" height="auto" controls>
                                        <source src="{{ asset('alumnado/curso2425/DAW/dawfp2425a13/proyecto/public/storage/ayuda/jefe_taller.webm') }}" type="video/webm">
                                        Tu navegador no soporta el formato de video.
                                </video>
                
                        </div>

                </div>

        </div>

@endsection
