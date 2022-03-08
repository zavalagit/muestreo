<?php

namespace App\Http\Controllers\Arma;

use Illuminate\Http\Request;
use App\Http\Requests\ArmaRequest;
use App\Http\Controllers\Controller;
use App\Traits\ArmaTrait;
use Auth;
use Validator;
use App\Arma;
use App\Cadena;
use App\Calibre;
use App\Pais;
use App\Indicio;
use App\Fiscalia;
use App\Parentesco;
use App\Prueba;
use App\Usuario;
use App\Naturaleza;


class ArmaController extends Controller
{
    use ArmaTrait;

    public $armas;
    public $modelo;
    public $modelo_id;
    public $request;

    public function __construct()
    {
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * return vista
     */
    public function fila_tabla_armas(Request $request){
        return view('arma.arma_fila_checkbox',[
            'indice' => $request->indice,
            'identificador' => $request->identificador
        ]);
    }
    /**
     * Form (crear,editar)
     */
    public function arma_form($formAccion, $modelo, $modelo_id=0){
        #accion: registrar, editar, clonar
        // dd($modelo_id);
        if ($modelo == 'cadena'){
            $cadena = Cadena::find($modelo_id);
                return view('arma.arma_form',[
                    'cadena' => $cadena,
                    'paises' => Pais::all(),
                    'calibres' => Calibre::all(),
                    'formAccion' => $formAccion,
                    'modelo' => $modelo,
                ]);  
        }
        if ($modelo == 'todas'){

            return view('arma.arma_form',[
                'armas' => Arma::all(),
                'paises' => Pais::all(),
                'calibres' => Calibre::all(),
                'formAccion' => $formAccion,
                'modelo' => $modelo,
            ]);  


        }      
    } 
    public function arma_save(ArmaRequest $request, $formAccion, $modelo, $modelo_id){       
        // return response()->json([
        //     'satisfactorio' => true,
        //     'request' => $request->all(),
        //     // 'indicio' => Cadena::find($modelo_id)->indicios()->where('indicio_arma','si')->get()->slice(1)->first(),
        // ]);
        
        $this->request = $request;
        $this->formAccion = $formAccion;
        $this->modelo = $modelo;
        $this->modelo_id = $modelo_id;
        
       self::arma_modelo_save();

        return response()->json([
            'accion' => $formAccion,
            'request' => $request->all(),
            'cadena' => Cadena::find($modelo_id),
        ]);
    }
    public function arma_modelo_save(){
        if($this->modelo == 'cadena'){
            foreach (Cadena::find($this->modelo_id)->indicios()->where('indicio_is_arma',true)->get()->values() as $index => $indicio) {
                $this->arma_save_trait($this->formAccion,$this->request,$this->modelo,$this->modelo_id,$index);
            }
        }
        elseif ($this->modelo == 'indicio') {
            # code...
        }
        elseif ($this->modelo == 'arma') {
            # code...
        }
    }

    public function arma_consultar(Request $request){
        //$unidades_hijos = Relacion_Unidad::where('unidad1_id','46')->get();
        //$unidad = Unidad::find(46)->relaciones;
        //dd($unidad);
        //$unidades_hijos = Relacion_Unidad::where('unidad1_id','46')->get();
        // foreach ($unidades_hijos as $key) {
        //     dd($key->unidad2->id);
        // }
        //dd($unidades_hijos);
        set_time_limit(0);
        if ( $request->has('btn') && ( $request->filled('buscar_fecha_inicio') || $request->filled('buscar_texto') ) ) {
            //dd('entassssaddasdasdasd');
           $armas = Arma::where(function($q) use($request){
                                if ( $request->filled('buscar_pais') && ($request->buscar_pais > 0) ) {
                                    $q->where(function($a) use($request){
                                        $a->where('pais_id',$request->buscar_pais);
                                    });
                                }    


                                if ( $request->filled('buscar_fecha_inicio') ) {
                                   
                                      if($request->filled('buscar_fecha_fin'))
                                         $q->whereBetween('created_at',[$request->buscar_fecha_inicio,$request->buscar_fecha_fin]);
                                      else
                                         $q->where('created_at',$request->buscar_fecha_inicio);
                                   
                                }
                                if ( $request->filled('buscar_texto') ) {
                                   $q->where(function($a) use($request){
                                      $a->where('serie','like',"%{$request->buscar_texto}%")
                                      ->orWhere('calibre','like',"%{$request->buscar_texto}%")
                                      ->orWhere('fabricante','like',"%{$request->buscar_texto}%");
                                   });
                                }
                             })
                             
                             ->get();
        }
        else{
            //muestra primero el mas antiguo
           $armas = Arma::latest('updated_at')->take(50)->get();    
        }
  
        if($request->filled('prestamo_multiple')){
           return view('prestamo.prestamo_multiple',compact('cadenas'));
        }
        else{
            //dd('entrasd');
           $naturalezas = Naturaleza::all();
           $regiones = Fiscalia::all();
           $pais = Pais::all();
           return view('arma.arma_consultar',[
              'armas' => $armas,
              'regiones' => $regiones,
              'naturalezas' => $naturalezas,
              'paises' => $pais,
              'buscar_region' => $request->buscar_region,
              'buscar_pais' => $request->buscar_pais,
              'buscar_fecha_inicio' => $request->buscar_fecha_inicio,
              'buscar_fecha_fin' => $request->buscar_fecha_fin,
              'buscar_texto' => $request->buscar_texto,
           ]);
        }
  
    }
    public function arma_consultar2(Request $request){
        $armas = Arma::where('pais_id',20)->get();

        // dd($request->all());

        if( $request->has('btn') ){
            $armas = Arma::where(function($q) use($request){
                if ( $request->arma_clasificacion != '0' ){
                    // dd('entra');
                    $q->where('clasificacion',$request->arma_clasificacion);                    
                }
                #folio o nuc
                if( $request->filled('arma_folio_nuc') ){
                    $q->whereHas('indicio',function($a) use($request){
                        $a->whereHas('cadena',function($b) use($request){
                            $b->where('nuc','like',"%{$request->arma_folio_nuc}%")
                                ->orWhere('folio_bodega','like',"%{$request->arma_folio_nuc}%");
                        });
                    });
                }
                #fecha                
                if( $request->filled('fecha_inicio') ){
                    //fecha_recoleccion
                    if ( $request->fecha_tipo == 'fecha_recoleccion' ) {
                        $q->whereHas('indicio',function($a) use($request){
                            if ( $request->filled('fecha_fin') ) {
                                $a->whereBetween('fecha',[$request->fecha_inicio,$request->fecha_fin]);
                            } else{
                                $a->where('fecha',$request->fecha_inicio);
                            }
                        });
                    }
                    //fecha_ingreso
                    elseif( $request->fecha_tipo == 'fecha_ingreso' ) {
                        # code...
                    }                    
                }
                #arma_atributos
                if ( $request->filled('arma_atributos') ) {
                    # code...
                }   
            })
            ->get();
        }

        // dd($armas);
        $request->flash();
        return view('arma.arma_consultar2',[
            'armas' => isset($armas) ? $armas : null,
            'regiones' => Fiscalia::all(),
        ]);
    }

     //pasar el id por el modal y tenerlo en la vista del modal
     public function acciones_modal(Arma $arma){
      return view('arma.entrada_acciones_modal_arma',['arma' => $arma]);
   }

   //pasar el indicio_id por el modal y tenerlo en la vista del modal de la realcion de los indicio realacion arma
   public function realacion_arma_indicio(Indicio $indicio){
      return view('arma.modal_relacion_arma_indicio',['indicio' => $indicio]);

   }

    public function arma_estadistica(){        
        return view('arma.arma_estadistica',[
            'armas' => Arma::all(),
        ]);
    }

}
