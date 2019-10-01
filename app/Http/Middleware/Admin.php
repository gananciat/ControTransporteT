<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->tipo_usuario->nombre == 'administrador')
            return $next($request);
        else
            return redirect()->route('home')->withStatus(__('NO tiene autorización para esta acción.'));
            
    }
}
