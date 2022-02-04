<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class DownloadController extends Controller
{
    /**
     * Recibe un parámetro llamado nombre y lo busca en la ruta manuales.
     * El parámetro nombre deberá contener la extensión del fichero a descargar.
     * Descarga el fichero en cuestión.
     */
    public function descargarManual(Request $request) {
        $filepath = public_path('manuales/' . $request->nombre);
        return Response::download($filepath); 
    }

}
