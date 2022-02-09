<?php

namespace App\Http\Controllers;

class JefeEquipoController extends Controller
{

    public function estadisticasShow(){
        return view('jefes.estadisticas');
    }

    public function mostrarVistaNuevosUsuarios(){
        return view('jefes.nuevoUsuario');
    }

    public function mostrarVistaBorrarUsuarios(){
        return view('jefes.borrarUsuario');
    }

    public function mostrarVistaModificarUsuarios(){
        return view('jefes.modificarUsuario');
    }

    public function mostrarVistaSubirManuales(){
        return view('jefes.subirManuales');
    }

    public function mostrarVistaHistorial(){
        return view('jefes.subirManuales');
    }
}
