<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Contemplamos permisos
        $user = Auth::user();
        if (!$user) return back();

        // Descargamos ficheros
        $modelo = Modelo::find($request->modelo_id);
        if (!$modelo) {
            return back()->with('error','Imposible descargar el PDF :(');
        }

        $ruta_fichero = public_path('modelos/' . $modelo->manual);
        $existe = File::exists($ruta_fichero);

        if (!$existe) {
            return back()->with('error','Imposible descargar el PDF :(');
        }
        
        return Response::download($ruta_fichero, ($modelo->nombre . ".pdf")); 
    }

}
