<?php

namespace App\Http\Controllers\Muestra;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\TraitFechaFormato;
use Auth;
use PDF;
use Validator;
use App\Cadena;
use App\Cargo;
use App\Delegacion;
use App\Entidad;
use App\Entrada;
use App\Fiscalia;
use App\Indicio;
use App\Naturaleza;
use App\Prestamo;
use App\Perito;
use App\Unidad;
use App\User;
use App\Exports\ExcelViewExport;
use Maatwebsite\Excel\Facades\Excel;

class MuestraController extends Controller
{
    public function __construct(){
        set_time_limit(0);
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_TIME, "spanish");
    }
    
    #Traits
    use TraitFechaFormato;
    /**
     * Form (crear,editar)
     */
    public function muestra_form($formAccion, $modelo=0){
        #accion: registrar, editar, clonar
         //dd($formAccion);
        if ($formAccion == 'cadena'){
            $cadena = Cadena::find($modelo);
                return view('muestreo.arma_form',[
                    'cadena' => $cadena,
                    'paises' => Pais::all(),
                    'calibres' => Calibre::all(),
                    'formAccion' => $formAccion,
                ]);  
        }
        if ($formAccion == 'registrar'){
            //dd($formAccion);
            return view('muestreo.muestra_form',[
                
                'formAccion' => $formAccion,
                'fecha_hoy' => date('Y-m-d'),
                
            ]);  


        }      
    }
    
    public function muestra_entradas(Request $request){

        //dd(request()->route());
        set_time_limit(0);
        if ( $request->has('btn') && ( $request->filled('buscar_fecha_inicio') || $request->filled('buscar_texto') ) ) {
           //  dd('entassssaddasdasdasd');
           $cadenas = Cadena::where(function($q) use($request){
                                if ( $request->filled('buscar_naturaleza') && ($request->buscar_naturaleza > 0) ) {
                                   $q->whereHas('entrada',function($a) use($request){
                                      $a->where('naturaleza_id',$request->buscar_naturaleza);
                                   });
                                }
                                if ( $request->filled('buscar_fecha_inicio') ) {
                                   $q->whereHas('entrada',function($a) use($request){
                                      if($request->filled('buscar_fecha_fin'))
                                         $a->whereBetween('fecha',[$request->buscar_fecha_inicio,$request->buscar_fecha_fin]);
                                      else
                                         $a->where('fecha',$request->buscar_fecha_inicio);
                                   });
                                }
                                if ( $request->filled('buscar_texto') ) {
                                   $q->where(function($a) use($request){
                                      $a->where('folio_bodega','like',"%{$request->buscar_texto}%")
                                      ->orWhere('nuc','like',"%{$request->buscar_texto}%")
                                      ->orWhereHas('indicios',function($b) use($request){
                                         $b->where('descripcion','like',"%{$request->buscar_texto}%");
                                      });
                                   });
                                }
                             })
                             #Región
                             ->where(function($q) use($request){
                                if( $request->filled('buscar_region') ){
                                   $q->where('fiscalia_id',$request->buscar_region);
                                }
                                else{
                                   if(Auth::user()->tipo != 'administrador')
                                      $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                                }
                             })
                             #validada cadena
                             ->where(function($q) use($request){
                                if( (Auth::user()->tipo == 'responsable_bodega') || ($request->filled('prestamo_multiple')) )
                                   $q->where('estado','validada');
                             })
                             ->with('entrada')
                             ->with('indicios')
                             ->get();
        }
        else{
           $cadenas = Cadena::where('estado','validada')
                             #Región
                             ->where(function($q) use($request){
                                if( $request->filled('buscar_region') ){
                                   $q->where('fiscalia_id',$request->buscar_region);
                                }
                                else{
                                   $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                                }
                             })
                             ->latest('updated_at')->take(20)
                             ->with('entrada')
                             ->with('indicios')
                             ->get();    
        }
        
        if ($cadenas->count()) {
           $cadenas = $cadenas->sortByDesc('folio_bodega')->values();
        }
  
        
           // dd('entrasd');
           $naturalezas = Naturaleza::all();
           $regiones = Fiscalia::all();
           return view('muestreo.entradas_muestreo',[
              'cadenas' => $cadenas,
              'regiones' => $regiones,
              'naturalezas' => $naturalezas,
              'buscar_region' => $request->buscar_region,
              'buscar_naturaleza' => $request->buscar_naturaleza,
              'buscar_fecha_inicio' => $request->buscar_fecha_inicio,
              'buscar_fecha_fin' => $request->buscar_fecha_fin,
              'buscar_texto' => $request->buscar_texto,
           ]);
        
  
     }
}
