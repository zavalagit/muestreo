<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

   protected $redirectTo = '/bodega/cadenas';


   protected function redirectTo(){
      $tipo = Auth::user()->tipo;
      if(($tipo == 'usuario') && (Auth::user()->unidad->coordinacion == 'si'))
         return '/elegir';
      elseif(($tipo == 'usuario') && (Auth::user()->unidad->coordinacion == 'no'))
         return '/cadena-form/registrar';
      elseif($tipo == 'responsable_bodega')
         return '/bodega/revisar';
      elseif($tipo == 'coordinador_peticiones_region')
         return '/peticion-consultar';
         // return '/peticion-dia/fiscalia/'.Auth::user()->fiscalia_id;
      elseif($tipo == 'coordinador_peticiones_unidad')
         return '/peticion-consultar';
      elseif($tipo == 'coordinador')
         return '/peticion-estadistica-elegir';
      elseif($tipo == 'fiscal')
         return 'fiscal-vista';
      elseif($tipo == 'administrador')
         return '/administrador/inicio';
      elseif($tipo == 'administrador_peticiones')
         return '/peticion-consultar';
      elseif($tipo == 'registro_peticiones')
         return '/peticion-registrar';
      elseif($tipo == 'coordinador_colectivos')
         return '/colectivo-consultar';
   }

   public function username(){
      return 'folio';
   }

/*
   public function login(){

   }
*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
