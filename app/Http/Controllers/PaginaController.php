<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaController extends Controller
{
    // Metodo para cargar la vista de inicio
    public function principal(){
        return view('paginas.inicio');
    }

    // Metodo para cargar la vista de promociones
    public function promociones(){
        return view('paginas.promociones');
    }

    // Metodo para cargar la vista de sobre nosotros
    public function sobre_nosotros(){
        return view('paginas.sobre_nosotros');
    }
    
    // Enlaces del footer, cargan las vistas de menciones legales y terminos de uso
    public function menciones_legales(){
        return view('paginas.menciones_legales');
    }

    public function terminos_uso(){
        return view('paginas.terminos_uso');
    }

    // Metodo para cargar la vista de acerca de
    public function acercade(){
        return view('paginas.acerca_de');
    }

    // Metodo para cargar la vista de ayuda de un usuario sin autenticar
    public function helpRegister(){
        return view('paginas.ayuda.help_register');
    }

    // Metodo para cargar la vista de ayuda de un usuario cliente
    public function helpClient(){
        return view('paginas.ayuda.help_client');
    }

    // Metodo para cargar la vista de ayuda de un usuario jefe taller
    public function helpBoss(){
        return view('paginas.ayuda.help_boss');
    }

    // Metodo para cargar la vista de ayuda de un usuario mecanico
    public function helpMechanic(){
        return view('paginas.ayuda.help_mechanic');
    }

    // Metodo para cargar la vista de ayuda de un usuario administrativo
    public function helpAdministrative(){
        return view('paginas.ayuda.help_administrative');
    }

    // Metodo para cargar la vista de ayuda de un usuario administrador
    public function helpAdmin(){
        return view('paginas.ayuda.help_Admin');
    }
    
}
