<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilADM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $idperfil = Auth::user()->id_perfil;
        if ($idperfil < 2) {
            return redirect('dashboard');
        }
        return $next($request);
    }
}
