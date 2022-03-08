<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PeticionFormMiddleware
{
    private $peticion;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private function is_user(){
        return $this->peticion->user_id == Auth::id() ? true : false;
    }
    public function handle($request, Closure $next)
    {
        $formAccion = $request->route('formAccion');
        $this->peticion = $request->route('peticion');

        //verificacos que el registro sea del usuario
        if ($formAccion != 'registrar' && !$this->is_user()) return back();

        #continuar
        if ( $formAccion == 'continuar' ) {
            if ($this->peticion->estado == 'entregada')
                return back();
        }

        return $next($request);
    }
}
