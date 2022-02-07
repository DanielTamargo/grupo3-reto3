<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Response;

class DownloadController extends Controller
{
    /**
     * Recibe un parámetro llamado nombre y lo busca en la ruta manuales.
     * El parámetro nombre deberá contener la extensión del fichero a descargar.
     * Descarga el fichero en cuestión.
     */
    public function descargarManual(Request $request) {
        $ruta_fichero = public_path('modelos/' . $request->manual_nombre);
        $existe = File::exists($ruta_fichero);

        if (!$existe) {
            return back()->with('error','Imposible descargar el PDF :(');
        }
        
        
        return Response::download($ruta_fichero); 
    }

}
