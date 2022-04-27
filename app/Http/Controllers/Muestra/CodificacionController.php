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
   public $data;
   public $actual;
   public $c;

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
            'codificacion' => $this->codificacion,
            'registro_multiple' => $request->has('registro_multiple') ? true : false,
            'array_codificacion_id' => $this->array_codificacion_id,
         ]);
      }

      public function set_registro_modelo(Request $request){
         
         if ( $request->filled('indicios') ) {
            $gruposIndicios = Indicio::find($request->indicios)->groupBy('cadena_id'); //separando los indicios en grupos de acuerdo a la cadena que pertenecen         
            $this->codificacion = new Codificacion;
            $this->set_registro_atributos($request); //se realiza el registro en tabla codificacion
            foreach ($gruposIndicios as $cadena_id => $grupoIndicios) { //iterando cada grupo
               $this->set_cadena(Cadena::find($cadena_id));
               $this->set_registro_indicios($grupoIndicios);            
               $this->array_codificacion_id[] = $this->codificacion->id;
            }
         }
      }

      public function set_registro_atributos(Request $request){      
         $this->codificacion->bitacora = $request->nombre_bitacora;
         $this->codificacion->numero_libro = $request->numero_libro;
         $this->codificacion->folio_interno = $request->folio_interno;
         $this->codificacion->hora_inicio = $request->codificacion_hora;
         $this->codificacion->fecha_inicio = $request->codificacion_fecha;
         $this->codificacion->observaciones = $request->observaciones;
         // if( $this->formAccion == 'prestar' ) = isset($cadena->id) ? $cadena->indicios->sum('indicio_cantidad_disponible') : null;
         //******if( $this->formAccion == 'registro' ) $this->codificacion->prestamo_numindicios = 0;
         $this->codificacion->perito_id = $request->registra_perito; //prestamo recibe (Resguardante)
         $this->codificacion->supervisor_id = $request->supervisor_autoriza; //prestamo entrega (Responsable de bodega)
         // if( $cadena->id ) $this->prestamo->cadena_id = $cadena->id;
         //$this->codificacion->cadena_id = $this->cadena->id;
         $this->codificacion->save();
      }
      public function set_registro_indicios($indicios){
         foreach ($indicios as $key => $indicio) {               
            $this->codificacion->indicios()->attach($indicio,[ //relacion codificacion-indicios
               'cadena_id' => $indicio->cadena_id, //guardamos cadena id
               'codificacion_cantidad_indicios' => $indicio->indicio_cantidad_disponible, //guardamos cantidad de indicios
               'descripcion' => isset($indicio->indicio_descripcion_disponible) ? $indicio->indicio_descripcion_disponible : $indicio->descripcion, //guardamos descripcion
            ]);
            $this->cim = new Cim;
            $this->cim->user_id = Auth::user()->id;
            $this->cim->indicio_id = $indicio->id;
            $data = Cim::latest('id')->first();
            $actual =  date("Y");
            $c = isset($data->id) ? $data->id + 1 : 0 + 1;
            
            $this->cim->codigo = "{$c}/{$actual}";
            $this->cim->save(); //guardamos en tabla cim
            
         }
      }

#mostar lista de registros de codificacion
         public function index(Request $request){
            if ( $request->has('btn_buscar') ) {
               // dd('entra');
               $prestamos = Prestamo::whereHas('cadena',function($q) use($request){
                                       // $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                                       if( $request->filled('buscar_region') ){
                                          $q->where('fiscalia_id',$request->buscar_region);
                                       }
                                       else{
                                          if(Auth::user()->tipo != 'administrador')
                                             $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                                       }
                                    })
                                    ->where(function($q) use($request){
                                       #prestamo_estado
                                       if($request->buscar_prestamo_estado != 'todo'){
                                          $q->where('estado',$request->buscar_prestamo_estado);
                                       }
                                       #prestamo_fecha_inicio
                                       if ( $request->filled('buscar_fecha_inicio') ) {
                                             if($request->filled('buscar_fecha_fin'))
                                                $q->where(function($a) use($request){
                                                   $a->whereBetween('prestamo_fecha',[$request->buscar_fecha_inicio,$request->buscar_fecha_fin])
                                                   ->orWhereBetween('reingreso_fecha',[$request->buscar_fecha_inicio,$request->buscar_fecha_fin]);
                                                });
                                             else
                                                $q->where(function($a) use($request){
                                                   $a->where('prestamo_fecha',$request->buscar_fecha_inicio)
                                                   ->orWhere('reingreso_fecha',$request->buscar_fecha_inicio);
                                                });
                                       }
                                       #prestamo_fecha_fin
                                       if ( $request->filled('buscar_texto') ) {
                                          $q->where(function($a) use($request){
                                             $a->whereHas('cadena',function($b) use($request){
                                                $b->where('folio_bodega','like',"%{$request->buscar_texto}%")
                                                ->orWhere('nuc','like',"%{$request->buscar_texto}%");
                                             })
                                             ->orWhereHas('perito1',function($b) use($request){
                                                $b->where('nombre','like',"%{$request->buscar_texto}%");
                                             })
                                             ->orWhereHas('perito2',function($b) use($request){
                                                $b->where('nombre','like',"%{$request->buscar_texto}%");
                                             });
                                          });
                                       }
                                       #prestamo_resguardante
                                       if($request->filled('resguardante')){
                                          $q->where('perito1_id',$request->resguardante);
                                       }
                                    })
                                    ->orderBy('prestamo_fecha')
                                    ->get();
            }
            $request->flash();
            $codificaciones = Codificacion::latest('id')->get();
            //dd($codificacion);
            return view('muestreo.codificacion.listado_codificacion',[
               'prestamos' => isset($prestamos) ? $prestamos : null,
               'codificaciones' => $codificaciones,
               'regiones' => Fiscalia::all(),
            ]);

         }

 
}
