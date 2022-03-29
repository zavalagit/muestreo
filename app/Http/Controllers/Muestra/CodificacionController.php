<?php

namespace App\Http\Controllers\Muestra;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PrestamoFormRequest;
use App\Http\Requests\PrestamoRequest;
use App\Http\Requests\PrestamoCreateRequest;
use App\Http\Requests\PrestamoReingresoRequest;
use App\Http\Requests\PrestamoEditarRequest;
use App\Traits\TraitIndicioEstado;
use Auth;
use Validator;
use DB;
use App\Cadena;
use App\Cargo;
use App\Fiscalia;
use App\Indicio;
use App\Naturaleza;
use App\Prestamo;
use App\Unidad;

class CodificacionController extends Controller
{
    #codificacion multiple indicios formulario 
   public function codificacion_multipleindicios_form(Request $request, $formAccion, $cadenas){
       //dd($cadenas);
   
    $cadenas = explode( ',',str_replace(['[',']'],'',$cadenas) ); //cadenas llega como string ej: "[1,2,3,..,n-1,n]", hay que convertirlo a array pero primero hay que quitar los caracteres '[' y ']'
    return view('muestreo.codificacion.codificacion_multipleindicios_formulario',[
        'formAccion' => $formAccion,
        'cadenas' => Cadena::find($cadenas),
        'buscar_texto' => $request->buscar_texto,
    ]);
 }
}
