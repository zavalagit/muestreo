<?php

namespace App\Http\Controllers\Muestra;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CodificacionRequest;
use App\Traits\TraitIndicioCIM;
use Auth;
use Validator;
use DB;
use App\Cadena;
use App\Cim;
use App\Codificacion;
use App\Fiscalia;
use App\Indicio;


class CodificacionController extends Controller
{
   use TraitIndicioCIM;

   public $formAccion;
   public $codificacion;
   public $cadena;
   public $cim;
   public $array_codificacion_id = [];

   public function __construct(){
      setlocale(LC_TIME,"es_MX.UTF-8");
      date_default_timezone_set('America/Mexico_City');
   }

   public function set_formAccion($formAccion){
      $this->formAccion = $formAccion;
   }

   public function set_codificacion(Codificacion $codificacion){
      $this->codificacion = $codificacion;
   }

   public function set_cadena(Cadena $cadena){
      $this->cadena = $cadena;
   }

   public function set_cim(Cim $cim){
      $this->cim = $cim;
   }

    #codificacion multiple indicios formulario 
   public function create(Request $request){
       $formAccion = 'registrar';
    //dd($request->filled('nucs'));
       set_time_limit(0);
       if ( $request->has('btn') && ( $request->filled('nucs') ) ) {
            // dd('entassssaddasdasdasd');
            //dd($request->filled('nucs'));
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
       
   //dd($cadenas);
    return view('muestreo.codificacion.codificacion_multipleindicios_formulario',[
        'formAccion' => $formAccion,
        'cadenas' => $cadenas,
        'buscar_texto' => $request->buscar_texto,
    ]);
 }

 #prestamo, reingreso multiples save
      public function store(CodificacionRequest $request){
         //dd($request->all());
         $formAccion = 'registrar';
         $this->set_formAccion($formAccion);
         //$this->set_codificacion($codificacion);
         //formAccion -> registrar
         if( $formAccion == 'registrar' ){
            DB::transaction(function () use($request) {
               $this->set_registro_modelo($request);
            },3);
         }

         //respuesta
         return response()->json([
            'status' => true,
            'formAccion' => $formAccion,
            // 'codificacion' => $this->codificacion,
            // 'registro_multiple' => $request->has('registro_multiple') ? true : false,
            'array_codificacion_id' => $this->array_codificacion_id,
         ]);
      }

      public function set_registro_modelo(Request $request){
         if ( $request->filled('cadenas') ) {
            foreach (Cadena::find($request->cadenas) as $key => $cadena) {
               $this->codificacion = new Codificacion;
               $this->set_cadena($cadena);
               $this->set_registro_atributos($request); //se relailiza el prestamo por cadena
               $this->set_registro_indicios($cadena->indicios);
               $this->array_codificacion_id[] = $this->codificacion->id;
            }
         }
         if ( $request->filled('indicios') ) {
            $gruposIndicios = Indicio::find($request->indicios)->groupBy('cadena_id'); //separando los indicios en grupos de acuerdo a la cadena que pertenecen         
            foreach ($gruposIndicios as $cadena_id => $grupoIndicios) { //iterando cada grupo
               $this->codificacion = new Codificacion;
               $this->set_cadena(Cadena::find($cadena_id));
               $this->set_registro_atributos($request); //se relailiza el prestamo por grupo de cadena
               $this->set_registro_indicios($grupoIndicios);            
               $this->array_codificacion_id[] = $this->codificacion->id;
            }
         }
      }

      public function set_registro_atributos(Request $request){      
         $this->codificacion->bitacora = $request->prestamo_autoriza;
         $this->codificacion->numero_libro = $request->prestamo_autoriza;
         $this->codificacion->folio_interno = $request->prestamo_autoriza;
         $this->codificacion->hora_inicio = $request->prestamo_hora;
         $this->codificacion->fecha_inicio = $request->prestamo_fecha;
         $this->codificacion->observaciones = $request->observaciones;
         // if( $this->formAccion == 'prestar' ) = isset($cadena->id) ? $cadena->indicios->sum('indicio_cantidad_disponible') : null;
         //******if( $this->formAccion == 'registro' ) $this->codificacion->prestamo_numindicios = 0;
         $this->codificacion->perito_id = $request->prestamo_resguardante; //prestamo recibe (Resguardante)
         $this->codificacion->supervisor_id = $request->prestamo_responsable_bodega; //prestamo entrega (Responsable de bodega)
         // if( $cadena->id ) $this->prestamo->cadena_id = $cadena->id;
         if( $this->formAccion == 'registro' ) $this->codificacion->cadena_id = $this->cadena->id;
         //$this->codificacion->save();
      }
      public function set_registro_indicios($indicios){
         foreach ($indicios as $key => $indicio) {               
            $this->codificacion->indicios()->attach($indicio,[ //relacion codificacion-indicios
               'codificacion_cantidad_indicios' => $indicio->indicio_cantidad_disponible,
               'descripcion' => isset($indicio->indicio_descripcion_disponible) ? $indicio->indicio_descripcion_disponible : null, 
            ]);
            $this->cim = new Cim;
            $this->cim->user_id = Auth::user()->id;
            $this->cim->indicio_id = $indicio->id;

            $data = Cim::latest('id')->first();
            $actual =  date("Y");
            $c = $data->id + 1;
            $this->cim->codigo = "{$c}/{$actual}";
            $this->cim->save(); //guardamos en tabla cim
            
         }
      }

 
}
