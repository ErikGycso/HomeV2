<?php

namespace App\Http\Middleware;

use App\Http\Utilidades\UtilidadGeneral;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthenticateStart
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
        $sesion =UtilidadGeneral::validarSession();

        if(!$sesion){
            return Redirect::to(env('DOMAIN_LOGIN'));
        }

        $urisAlu = UtilidadGeneral::getUserUris();
        $urisAdmin = UtilidadGeneral::getAdminUris();

        if(in_array($request->getRequestUri(), array_merge($urisAlu, $urisAdmin))){
            if($_SESSION['usuario_tipo'] === 'Alumno' && in_array($request->getRequestUri(),$urisAdmin)){
                return Redirect::to($request->getUriForPath($urisAlu[0]));
            }

            if($_SESSION['usuario_tipo'] !== 'Alumno' && in_array($request->getRequestUri(),$urisAlu)){
                return Redirect::to($request->getUriForPath($urisAdmin[0]));
            }
        }
        return $next($request);
    }
}
