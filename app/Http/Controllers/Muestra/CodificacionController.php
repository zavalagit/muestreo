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
   public function codificacion_multipleindicios_form(Request $request){
       $formAccion = 'registrar';
    //dd($request->filled('nucs'));
       set_time_limit(0);
       if ( $request->has('btn') && ( $request->filled('nucs') ) ) {
          //  dd('entassssaddasdasdasd');
          $cadenas = Cadena::where(function($q) use($request){
                               if ( $request->filled('nucs') ) {
                                  $q->where(function($a) use($request){
                                    foreach ($request->nucs as $key => $nuc) {
                                       if($nuc != null)
                                          $a->orWhere('nuc','like',"%{$nuc}%");
                                    }
                                     
                                  });
                               }
                            })
                           
                            ->with('entrada')
                            ->with('indicios')
                            ->get();
       }
       else{
        $cadenas = [];   
       }
       
    //    else{
    //       $cadenas = Cadena::where('estado','validada')
    //                         #Región
    //                         ->where(function($q) use($request){
    //                            if( $request->filled('buscar_region') ){
    //                               $q->where('fiscalia_id',$request->buscar_region);
    //                            }
    //                            else{
    //                               $q->where('fiscalia_id',Auth::user()->fiscalia_id);
    //                            }
    //                         })
    //                         ->latest('updated_at')->take(1)
    //                         ->with('entrada')
    //                         ->with('indicios')
    //                         ->get();    
    //    }
       
    //    if ($cadenas->count()) {
    //       $cadenas = $cadenas->sortByDesc('folio_bodega')->values();
    //    }
      //dd($cadenas);
    // $cadenas = explode( ',',str_replace(['[',']'],'',$cadenas) ); //cadenas llega como string ej: "[1,2,3,..,n-1,n]", hay que convertirlo a array pero primero hay que quitar los caracteres '[' y ']'
    return view('muestreo.codificacion.codificacion_multipleindicios_formulario',[
        'formAccion' => $formAccion,
        'cadenas' => $cadenas,
        'buscar_texto' => $request->buscar_texto,
    ]);
 }
}
