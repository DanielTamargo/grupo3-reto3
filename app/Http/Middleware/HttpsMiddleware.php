<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Fuente: https://programmingfields.com/redirect-http-to-https-using-middleware-in-laravel/#Create_Middleware_in_Laravel_8
        // Redirigimos solo en producción
        /*if(env('APP_ENV') === "production") {
            if (!$request->secure()) {
                return redirect()->secure($request->path());
            }
        }*/
        return $next($request);
    }
}
