<?php

// eliminar-archivo

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\PeticionFormRequest;
use Auth;
use PDF;
use Validator;
use App\Colectivo;
use App\Especialidad;
use App\Unidad;
use App\Fiscalia;
use App\Prueba;
use App\Petadscripcion;
use App\Necropsia;
use App\Petfiscalia;
use App\Peticion;
use App\Solicitud;
use App\Exports\ExcelViewExport;
use App\NecropsiaClasificacion;
use Maatwebsite\Excel\Facades\Excel;

class PeticionController extends Controller
{

    protected $es_mes = false;
    private $formAccion;
    public $peticion;

    public function __construct()
    {
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
    }

    /**__get registro */
    public function get_registro(Request $request){
        $registro = Peticion::find($request->id);
        $especialidad = Especialidad::find($registro->solicitud->especialidad->id);

        return response()->json(
            [
                'registro' => $registro,
                'especialidad' => $especialidad
            ]
        );
    }
    

    public function peticion_dia(Request $request, $lugar = null, $lugar_id = 0){
        // dd($lugar_id);
        //dd($request->filled('solicitud_buscar'));


        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
        $fecha_hoy = date("Y-m-d");
        //dd($fecha_hoy);
        //dd('entra');  

        //se determinan las fechas de busqueda
        $es_mes = false;

       
        if( $request->filled('fecha_inicio') ){
            $fecha_encabezado = strtoupper(strftime('%A %d de %B del %Y', strtotime($request->fecha_inicio)));
            $fecha_inicio = $request->fecha_inicio;
           
        }
        else{
            $mes = date('m');
            $ano = date('Y');
            $fecha_encabezado = strtoupper(strftime('%A %d de %B del %Y', strtotime($fecha_hoy)));
            $fecha_inicio = date("Y-m-d");
           
        }


        #Coordinador
        #Para las busqueda por fiscalia o unidad en la vista
        if($request->filled('buscar_fiscalia')){
            if($request->filled('buscar_unidad')){
                $lugar = 'unidad';
                $lugar_id = $request->buscar_unidad;
            }
            else{
                $lugar = 'fiscalia';
                $lugar_id = $request->buscar_fiscalia;
            }
        }

        

        $peticiones= Peticion::whereDate('created_at',$fecha_inicio)
                                    ->where(function($q) use($request,$lugar,$lugar_id){
                                        if ($lugar === 'fiscalia') {
                                            $q->where('fiscalia2_id',$lugar_id);    
                                        }
                                        elseif ($lugar === 'unidad') {
                                            $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);
                                        }
                                        elseif ($lugar === 'usuario') {
                                            $q->where('user_id',$lugar_id);
                                        }

                                        #especialidad y solicitud
                                        if($request->especialidad_buscar > 0){
                                            if( $request->filled('solicitud_buscar') ){
                                                $q->where('solicitud_id',$request->solicitud_buscar);
                                            }
                                            else{
                                                $q->whereHas('solicitud',function($a) use($request){
                                                    $a->where('especialidad_id',$request->especialidad_buscar);
                                                });
                                            }
                                        }

                                        #buscar_texto
                                        if($request->filled('texto_buscar')){
                                            $q->where(function($a) use($request){
                                                $a->where('nuc','like',"%{$request->texto_buscar}%")
                                                    ->orWhere('oficio_numero','like',"%{$request->texto_buscar}%")
                                                    ->orWhere('folio_interno','like',"%{$request->texto_buscar}%")
                                                    ->orWhereHas('user',function($b) use($request){
                                                        $b->where('name','like',"%{$request->texto_buscar}%");
                                                    });
                                            });
                                        }
                                    })
                                    ->get();
        $rezagos= Peticion::whereDate('created_at','<',$fecha_inicio)->where('fecha_sistema',$fecha_inicio)
                                    ->where(function($q) use($request,$lugar,$lugar_id){
                                        if ($lugar === 'fiscalia') {
                                            $q->where('fiscalia2_id',$lugar_id);    
                                        }
                                        elseif ($lugar === 'unidad') {
                                            $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);
                                        }
                                        elseif ($lugar === 'usuario') {
                                            $q->where('user_id',$lugar_id);
                                        }

                                        #especialidad y solicitud
                                        if($request->especialidad_buscar > 0){
                                            if( $request->filled('solicitud_buscar') ){
                                                $q->where('solicitud_id',$request->solicitud_buscar);
                                            }
                                            else{
                                                $q->whereHas('solicitud',function($a) use($request){
                                                    $a->where('especialidad_id',$request->especialidad_buscar);
                                                });
                                            }
                                        }

                                        #buscar_texto
                                        if($request->filled('texto_buscar')){
                                            $q->where(function($a) use($request){
                                                $a->where('nuc','like',"%{$request->texto_buscar}%")
                                                    ->orWhere('oficio_numero','like',"%{$request->texto_buscar}%")
                                                    ->orWhere('folio_interno','like',"%{$request->texto_buscar}%")
                                                    ->orWhereHas('user',function($b) use($request){
                                                        $b->where('name','like',"%{$request->texto_buscar}%");
                                                    });
                                            });
                                        }
                                    })
                                    ->get();

        
        $especialidades = Especialidad::where(function($q){
            if (Auth::user()->tipo == 'director_unidad') {
                $q->where('unidad_id',Auth::user()->unidad_id);
            }
        })
        ->get();

        if( $request->especialidad_buscar > 0 )
            $solicitudes = Solicitud::where('especialidad_id',$request->especialidad_buscar)->get();
        else
            $solicitudes = '';
/*
                            $array_peticion_estado = ['pendiente','atendida','entregada'];
                            */
        
        

        #unidad o fiscalia
        if( $lugar == null ){
            if( Auth::user()->tipo === 'director_unidad' ){
                $lugar = 'unidad';
                $unidad = Unidad::find(Auth::user()->unidad_id);
            }
            elseif( Auth::user()->tipo === 'director_fiscalia' ){
                $lugar = 'fiscalia';
                $fiscalia = Fiscalia::find(Auth::user()->fiscalia_id);
                $unidad = '';
            }
        }
        elseif( $lugar === 'unidad' ){
            $unidad = Unidad::find($lugar_id);
            $fiscalia = Fiscalia::find(4);
        }
        elseif( $lugar === 'fiscalia' ){
            $fiscalia = Fiscalia::find($lugar_id);
            $unidad = '';
        }
        elseif( $lugar === 'usuario' ){
            $fiscalia = '';
            $unidad = '';
        }

        $fiscalias = Fiscalia::all();
        $unidades = Unidad::where('coordinacion','si')->get();


        // $colectivos = Colectivo::whereDate('created_at',$fecha_inicio)
        // ->orWhere('colectivo_validada_fecha',$fecha_inicio)                    
        //     ->get();
        // $colectivos_validada = Colectivo::where('colectivo_validada_fecha',$fecha_inicio)->get();

        
        // $suma = $colectivos->sum(function ($colectivo) {
        //     return $colectivo->pruebas->sum('pivot.cantidad_estudios');
        // });

        // $cantidad_estudios = $colectivos->sum(function($colectivo){
        //     return $colectivo->pruebas->count('prueba_id');
        // });

        // dd('suma = '. $suma);

        $request->flash();

        //dd($lugar);



        // return Excel::download(new ExcelViewExport("peticiones.excel.peticion_dia", ['peticiones'=>$peticiones,'fecha_encabezado' => $fecha_encabezado]),'consulta_entradas.xlsx');
// dd('holas');
        return view('peticiones.peticion_dia',[
            'request' => $request,
            // 'colectivos' => $colectivos,
            'fecha_hoy' => $fecha_hoy,
            'peticiones' => $peticiones,
            'rezagos' => $rezagos,
            'fecha_encabezado' => $fecha_encabezado,
            'fecha_inicio' => $fecha_inicio,
            'lugar' => $lugar,
            'lugar_id' => $lugar_id,
            'especialidades' => $especialidades,
            'solicitudes' => $solicitudes,
            'fiscalias' => $fiscalias,
            'unidades' => $unidades,
            'fiscalia' => $fiscalia,
            'unidad' => $unidad,
        ]);
        
    }

    public function peticion_buscar(Request $request, $lugar=null, $lugar_id=0){
        set_time_limit(0);

        $mensaje = 'Realice una busqueda: Puede buscar por fecha, por un intervalo de fechas, por nuc, etc.';
        

        //dd($request->all());

            $peticiones = Peticion::where(function($q) use($request){
                                        #fiscalia
                                        $q->where('fiscalia2_id',Auth::user()->fiscalia_id);
                                        #unidad
                                        if ( Auth::user()->tipo === 'director_unidad' ) {
                                            $q->where('unidad_id',Auth::user()->unidad_id);
                                        }

                                        #especialidad
                                        if( $request->especialidad_buscar != '0'){
                                            $q->whereHas('solicitud',function($a) use($request){
                                                $a->where('especialidad_id',$request->especialidad_buscar);
                                            });
                                        }
                                        

                                        if($request->filled('peticion_estado')){
                                            $q->whereIn('estado',$request->peticion_estado);
                                        }

                                        #fecha, fecha_tipo
                                        if( $request->filled(['fecha_inicio','fecha_fin']) ){
                                            if($request->fecha_tipo != 'todo'){
                                                $q->whereBetween($request->fecha_tipo,[$request->fecha_inicio, $request->fecha_fin]);
                                            }
                                            else{
                                                $q->where(function($a) use($request){
                                                    $a->whereBetween('fecha_peticion',[$request->fecha_inicio,$request->fecha_fin])
                                                        ->orWhereBetween('fecha_elaboracion',[$request->fecha_inicio,$request->fecha_fin])
                                                        ->orWhereBetween('fecha_entrega',[$request->fecha_inicio,$request->fecha_fin]);
                                                });
                                            }
                                        }
                                        elseif( $request->filled('fecha_inicio') ){
                                            if($request->fecha_tipo != 'todo'){
                                                $q->where($request->fecha_tipo,$request->fecha_inicio);
                                            }
                                            else{
                                                $q->where(function($a) use($request){
                                                    $a->where('fecha_peticion',$request->fecha_inicio)
                                                        ->orWhere('fecha_elaboracion',$request->fecha_inicio)
                                                        ->orWhere('fecha_entrega',$request->fecha_inicio);
                                                });
                                            }
                                        }

                                        #buscar_texto
                                        if( $request->filled('buscar_texto') ){
                                            $q->where(function($a) use($request){
                                                $a->where('nuc','like',"%{$request->buscar_texto}%")
                                                ->orWhere('oficio_numero','like',"%{$request->buscar_texto}%")
                                                ->orWhere('sp_solicita','like',"%{$request->buscar_texto}%")
                                                ->orWhere('sp_recibe','like',"%{$request->buscar_texto}%")
                                                ->orWhereHas('user',function($b) use($request){
                                                    $b->where('folio','like',"%{$request->buscar_texto}%")
                                                    ->orWhere('name','like',"%{$request->buscar_texto}%");
                                                });
                                            });
                                        }

                                    })
                                    ->get();
    
   
            
        $array_peticion_estado = ['pendiente','atendida','entregada'];
        $array_fecha_tipo = ['todo','fecha_peticion','fecha_elaboracion','fecha_entrega'];
        
        /*
        $peticion_estado = $request->peticion_estado;
        $fecha_tipo = $request->fecha_tipo;
        $especialidad_buscar = $request->especialidad_buscar;
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        $buscar_texto = $request->buscar_texto;
        */


        $especialidades = Especialidad::where(function($q){
                                            if (Auth::user()->tipo == 'director_unidad') {
                                                $q->where('unidad_id',Auth::user()->unidad_id);
                                            }
                                        })
                                        ->get();

        $request->flash();

        if($request->btn_buscar === 'pdf'){
            $pdf = PDF::loadView('peticiones.pdf.peticion_buscar',
                    compact(
                        'peticiones'
                    )
                );
                $pdf->setPaper('A4', 'landscape');
                return $pdf->download('Busqueda.pdf');
        }

        return view('peticiones.peticion_buscar',
        compact(
            'request',
            'peticiones',
            'array_peticion_estado',
            'array_fecha_tipo',
            'especialidades',
            'mensaje'
            )
        );
    }

    public function peticion_estadistica_elegir(Request $request,$lugar = null){
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');

        if( $request->filled('fecha_inicio') && $request->filled('fecha_fin') ){
            $primer_dia = mktime(0,0,0,date('m',strtotime($request->fecha_inicio)),1,date('Y',strtotime($request->fecha_inicio)));
            $primer_dia = date('Y-m-d',$primer_dia);
            $ultimo_dia = mktime(0,0,0,date('m',strtotime($request->fecha_inicio))+1,0,date('Y',strtotime($request->fecha_inicio)));
            $ultimo_dia = date('Y-m-d',$ultimo_dia);

            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;

            if( ( $request->fecha_inicio === $primer_dia ) && ( $request->fecha_fin === $ultimo_dia ) ){
                $fecha_encabezado = strtoupper(strftime('%B %Y',strtotime($primer_dia)));
                $es_mes = true;
            }
            else
                $fecha_encabezado = date('d-m-Y', strtotime($request->fecha_inicio)) . " / " . date('d-m-Y', strtotime($request->fecha_fin));
        }
        elseif( $request->filled('fecha_inicio') ){
            $fecha_encabezado = strtoupper(strftime('%A %d del %Y', strtotime($request->fecha_inicio)));
        }
        else{
            $mes = date('m');
            $ano = date('Y');
            $fecha_encabezado = strtoupper(strftime("%B %Y"));
            $fecha_inicio = date('Y-m-d',mktime(0,0,0,$mes,1,$ano));
            $fecha_fin =  date('Y-m-d',mktime(0,0,0,$mes+1,0,$ano));
            $es_mes = true;
        }


        $peticiones = Peticion::where(function($q) use($request,$fecha_inicio,$fecha_fin,$lugar){
                                    #Fechas
                                    if( $request->filled('fecha_inicio') ){
                                        if( $request->filled('fecha_fin'))
                                            $q->whereBetween('created_at',[$fecha_inicio,$fecha_fin]);
                                        else
                                            $q->where('created_at',$fecha_inicio);
                                    }
                                    else{
                                        $q->whereBetween('created_at',[$fecha_inicio,$fecha_fin]);
                                    }

                                    if($lugar === 'unidad'){
                                        $q->where('fiscalia2_id',4);
                                    }
                                })
                                ->get();

                                
        $atendidas = Peticion::where(function($q) use($request,$fecha_inicio,$fecha_fin,$lugar){
                                    #Fechas
                                    if( $request->filled('fecha_inicio') ){
                                        if( $request->filled('fecha_fin'))
                                            $q->whereBetween('fecha_sistema',[$fecha_inicio,$fecha_fin]);
                                        else
                                            $q->where('fecha_sistema',$fecha_inicio);
                                    }
                                    else{
                                        $q->whereBetween('fecha_sistema',[$fecha_inicio,$fecha_fin]);
                                    }

                                    if($lugar === 'unidad'){
                                        $q->where('fiscalia2_id',4);
                                    }
                                })
                                ->get();


        


        $fiscalias = Fiscalia::all();
 
        
        if($lugar === 'unidad'){
            $unidades = Unidad::where('coordinacion','si')->get();

            return view('peticiones.coordinador.peticion_estadistica_unidad_elegir',[
                'peticiones' => $peticiones,
                'atendidas' => $atendidas,
                'unidades' => $unidades,
                'fecha_inicio' =>$fecha_inicio,
                'fecha_fin' =>$fecha_fin,
                'fecha_encabezado' => $fecha_encabezado
            ]);

        }


        return view('peticiones.coordinador.peticion_estadistica_elegir',[
            'peticiones' => $peticiones,
            'atendidas' => $atendidas,
            'fiscalias' => $fiscalias,
            'fecha_inicio' =>$fecha_inicio,
            'fecha_fin' =>$fecha_fin,
            'fecha_encabezado' => $fecha_encabezado
        ]);

    }

    public function peticion_estadistica(Request $request, $lugar = null, $lugar_id = 0){
        // dd('holas');
        set_time_limit(0);

        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
       
        $es_mes = false;

        if( $request->filled('fecha_inicio') && $request->filled('fecha_fin') ){
            $primer_dia = mktime(0,0,0,date('m',strtotime($request->fecha_inicio)),1,date('Y',strtotime($request->fecha_inicio)));
            $primer_dia = date('Y-m-d',$primer_dia);
            $ultimo_dia = mktime(0,0,0,date('m',strtotime($request->fecha_inicio))+1,0,date('Y',strtotime($request->fecha_inicio)));
            $ultimo_dia = date('Y-m-d',$ultimo_dia);

            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;

            if( ( $request->fecha_inicio === $primer_dia ) && ( $request->fecha_fin === $ultimo_dia ) ){
                $fecha_encabezado = strtoupper(strftime('%B %Y',strtotime($primer_dia)));
                $es_mes = true;
            }
            else
                $fecha_encabezado = date('d-m-Y', strtotime($request->fecha_inicio)) . " / " . date('d-m-Y', strtotime($request->fecha_fin));
        
            #Estadistica
            $dia_siguiente = date("Y-m-d", strtotime("{$request->fecha_fin} +1 day"));
        
        }
        elseif( $request->filled('fecha_inicio') ){
            $fecha_encabezado = strtoupper(strftime('%A %d del %Y', strtotime($request->fecha_inicio)));
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
            #Estadistica
            $dia_siguiente = date("Y-m-d", strtotime("{$request->fecha_inicio} +1 day"));
        }
        else{
            $mes = date('m');
            $ano = date('Y');
            $fecha_encabezado = strtoupper(strftime("%B %Y"));
            $fecha_inicio = date('Y-m-d',mktime(0,0,0,$mes,1,$ano));
            $fecha_fin =  date('Y-m-d',mktime(0,0,0,$mes+1,0,$ano));
            $es_mes = true;
            #Estadistica
            $dia_siguiente = date("Y-m-d", strtotime("{$fecha_fin} +1 day"));
        }
                  

        #Coordinador
        #Para las busqueda por fiscalia o unidad en la vista
        if($request->filled('buscar_fiscalia')){
            if($request->filled('buscar_unidad')){
                $lugar = 'unidad';
                $lugar_id = $request->buscar_unidad;
            }
            else{
                $lugar = 'fiscalia';
                $lugar_id = $request->buscar_fiscalia;
            }
        }
    


        $peticiones_recibidas = Peticion::where(function($q) use($request,$fecha_inicio,$fecha_fin,$lugar,$lugar_id){
                                    #Fiscalía o unidad
                                    //($lugar == 'fiscalia') ? $q->where('fiscalia2_id',$lugar_id) : $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id); 

                                        if ($lugar === 'fiscalia') {
                                            $q->where('fiscalia2_id',$lugar_id);    
                                        }
                                        elseif ($lugar === 'unidad') {
                                            $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);
                                        }
                                        elseif ($lugar === 'usuario'){
                                            
                                            $q->where('user_id',Auth::user()->id);
                                        }
                                    #Falta para usuario

                                    #Fechas
                                    if( $request->filled('fecha_inicio') ){
                                        if( $request->filled('fecha_fin'))
                                            $q->whereBetween('created_at',["{$fecha_inicio} 00:00:00","{$fecha_fin} 23:59:59"]);
                                        else
                                            $q->where('created_at',$fecha_inicio);
                                    }
                                    else{
                                        $q->whereBetween('created_at',["{$fecha_inicio} 00:00:00","{$fecha_fin} 23:59:59"]);
                                    } 
                                })
                                ->get();

        
                               // dd($peticiones_recibidas);
        
        $atendidas = Peticion::where(function($q) use($request,$fecha_inicio,$fecha_fin,$lugar,$lugar_id){
                                    #Fiscalía y unidad
                                    //if( (Auth::user()->tipo === 'coordinador' || Auth::user()->tipo === 'administrador') ){
                                        if ($lugar === 'fiscalia') {
                                            $q->where('fiscalia2_id',$lugar_id);    
                                        }
                                        elseif ($lugar === 'unidad') {
                                            $q->where('fiscalia2_id',4)
                                            ->where('unidad_id',$lugar_id);
                                        }
                                        elseif ($lugar === 'usuario'){
                                            $q->where('user_id',$lugar_id);
                                        }
                                        
                                    // }
                                    // elseif( Auth::user()->tipo === 'director_fiscalia' ){
                                    //     $q->where('fiscalia2_id',Auth::user()->fiscalia_id);
                                    // }
                                    // elseif( Auth::user()->tipo === 'director_unidad' ) {
                                    //     $q->where('fiscalia2_id',4)
                                    //     ->where('unidad_id',Auth::user()->unidad_id);
                                    // }
                                    // elseif( Auth::user()->tipo === 'usuario' ){
                                    //     $q->where('user_id',Auth::user()->id);
                                    // }

                                    #Fechas
                                    if( $request->filled('fecha_inicio') ){
                                        if( $request->filled('fecha_fin'))
                                            $q->whereBetween('fecha_sistema',[$fecha_inicio,$fecha_fin]);
                                        else
                                            $q->where('fecha_sistema',$fecha_inicio);
                                    }
                                    else{
                                        $q->whereBetween('fecha_sistema',[$fecha_inicio,$fecha_fin]);
                                        
                                    } 
                                })
                                ->get();

                               // dd($atendidas);

        $necros_atendidas = Peticion::where(function($q) use($fecha_inicio,$fecha_fin,$lugar,$lugar_id,$dia_siguiente){
                                    ($lugar == 'fiscalia') ? $q->where('fiscalia2_id',$lugar_id) : $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);                        
                                    $q->whereBetween('fecha_necropsia',[$fecha_inicio, $fecha_fin]);
                                })
                                ->where('solicitud_id',61)
                                //->whereIn('estado',['atendida','entregada'])
                                ->get();
        $osteologicos_atendidas = Peticion::where(function($q) use($fecha_inicio,$fecha_fin,$lugar,$lugar_id,$dia_siguiente){
                                    ($lugar == 'fiscalia') ? $q->where('fiscalia2_id',$lugar_id) : $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);                        
                                    $q->whereBetween('fecha_necropsia',[$fecha_inicio,$fecha_fin]);
                                })
                                ->where('solicitud_id',62)
                                //->whereIn('estado',['atendida','entregada'])
                                ->get();
        $necropsias_uspec = Peticion::where(function($q) use($fecha_inicio,$fecha_fin,$lugar,$lugar_id,$dia_siguiente){                        
                                    $q->whereBetween('fecha_necropsia',[$fecha_inicio, $fecha_fin])
                                        ->where('fiscalia2_id',4)
                                        ->where('unidad_id',6);
                                })
                                ->where('solicitud_id',61)
                                //->whereIn('estado',['atendida','entregada'])
                                ->get();
        $necropsias_uecs = Peticion::where(function($q) use($fecha_inicio,$fecha_fin,$lugar,$lugar_id,$dia_siguiente){                        
                                    $q->whereBetween('fecha_necropsia',[$fecha_inicio, $fecha_fin])
                                        ->where('fiscalia2_id',4)
                                        ->where('unidad_id',7);
                                })
                                ->where('solicitud_id',61)
                                //->whereIn('estado',['atendida','entregada'])
                                ->get();
        $colectivos_registrados = Colectivo::where(function($q) use($request,$fecha_inicio,$fecha_fin,$lugar,$lugar_id){    
                                    if ($lugar === 'fiscalia') {
                                        $q->where('fiscalia_id',$lugar_id);    
                                    }
                                    elseif ($lugar === 'unidad') {
                                        $q->where('fiscalia_id',4);
                                    }
                                    elseif ($lugar === 'usuario'){
                                        
                                        $q->where('user1_id',Auth::user()->id);
                                    }

                                    #Fechas
                                    if( $request->filled('fecha_inicio') ){
                                        if( $request->filled('fecha_fin'))
                                            $q->whereBetween('created_at',["{$fecha_inicio} 00:00:00","{$fecha_fin} 23:59:59"]);
                                        else
                                            $q->where('created_at',$fecha_inicio);
                                    }
                                    else{
                                        $q->whereBetween('created_at',["{$fecha_inicio} 00:00:00","{$fecha_fin} 23:59:59"]);
                                    } 
                                });
        $colectivos_estudios = Colectivo::where(function($q) use($request,$fecha_inicio,$fecha_fin,$lugar,$lugar_id){    
                                    if ($lugar === 'fiscalia') {
                                        $q->where('fiscalia_id',$lugar_id);    
                                    }
                                    elseif ($lugar === 'unidad') {
                                        $q->where('fiscalia_id',4);
                                    }
                                    elseif ($lugar === 'usuario'){
                                        $q->where('user2_id',Auth::user()->id);
                                    }

                                    #Fechas
                                    if( $request->filled('fecha_inicio') ){
                                        if( $request->filled('fecha_fin'))
                                            $q->whereBetween('colectivo_validacion_fecha',[$fecha_inicio,$fecha_fin]);
                                        else
                                            $q->where('colectivo_validacion_fecha',$fecha_inicio);
                                    }
                                    else{
                                        $q->whereBetween('colectivo_validacion_fecha',[$fecha_inicio,$fecha_fin]);
                                    } 
                                })
                                ->union($colectivos_registrados)
                                ->get();
            $colectivos = $colectivos_estudios->unique();
        
        


            #unidad o fiscalia
            if( $lugar == null ){
                if( Auth::user()->tipo === 'director_unidad' ){
                    $lugar = 'unidad';
                    $unidad = Unidad::find(Auth::user()->unidad_id);
                }
                elseif( Auth::user()->tipo === 'director_fiscalia' ){
                    $lugar = 'fiscalia';
                    $fiscalia = Fiscalia::find(Auth::user()->fiscalia_id);
                }
            }
            elseif( $lugar === 'unidad' ){
                $unidad = Unidad::find($lugar_id);
                $fiscalia = Fiscalia::find(4);
            }
            elseif( $lugar === 'fiscalia' ){
                $fiscalia = Fiscalia::find($lugar_id);
            }
            elseif( $lugar === 'usuario' ){
                $fiscalia = Fiscalia::find(Auth::user()->fiscalia_id);
            }

            #especialidades
            if ( $lugar === 'unidad' )
                $especialidades = Especialidad::where('unidad_id',$unidad->id)->get();
            elseif( $lugar === 'fiscalia' )
                $especialidades = Especialidad::all();
            elseif( $lugar === 'usuario' ){
                $especialidades = Especialidad::where('unidad_id',Auth::user()->unidad_id)->get();
            }
            #necropsias
            $necropsias = Necropsia::all();
            #fiscalias
            $fiscalias = Fiscalia::all();
            #unidades
            $unidades = Unidad::where('coordinacion','si')->get();


            $pruebas = Prueba::all();

            //dd($peticiones_recibidas);


            if ($request->btn_buscar === 'pdf') {
                $pdf = PDF::loadView('pdf.peticiones.estadistica_director_unidad',
                    compact(
                        'fecha_encabezado',
                        'fecha_inicio',
                        'fecha_fin',
                        'lugar',
                        'unidad',
                        'fiscalia',
                        'especialidades',
                        'necropsias',
                        'fiscalias',
                        'es_mes',
                        'peticiones_recibidas',
                        'atendidas',
                        /*'peticiones_rezago_atendido',*/
                        'rezago_total'
                    )
                );
                return $pdf->download('Estadistica_' . $fecha_encabezado . '.pdf');
            }
            return view('peticiones.director_peticiones_estadistica',
                compact(
                    'fecha_encabezado',
                    'fecha_inicio',
                    'fecha_fin',
                    'lugar',
                    'lugar_id',
                    'unidad',
                    'fiscalia',
                    'especialidades',
                    'necropsias',
                    'fiscalias',
                    'unidades',
                    'es_mes',
                    'peticiones_recibidas',
                    'atendidas',
                    'necros_atendidas',
                    'osteologicos_atendidas',
                    'necropsias_uspec',
                    'necropsias_uecs',
                    /*'peticiones_rezago_atendido',*/
                    // 'rezago_total',
                    'colectivos',
                    'pruebas'
                )
            );


            
    }

    public function concentrado(){
        
    }
    
    public function concentrado_dia(Request $request, $lugar = null, $lugar_id = 0){

        //dd($lugar_id);

        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
       
        $es_mes = false;

        if( $request->filled('fecha_inicio') && $request->filled('fecha_fin') ){
            $primer_dia = mktime(0,0,0,date('m',strtotime($request->fecha_inicio)),1,date('Y',strtotime($request->fecha_inicio)));
            $primer_dia = date('Y-m-d',$primer_dia);
            $ultimo_dia = mktime(0,0,0,date('m',strtotime($request->fecha_inicio))+1,0,date('Y',strtotime($request->fecha_inicio)));
            $ultimo_dia = date('Y-m-d',$ultimo_dia);

            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;

            if( ( $request->fecha_inicio === $primer_dia ) && ( $request->fecha_fin === $ultimo_dia ) ){
                $fecha_encabezado = strtoupper(strftime('%B %Y',strtotime($primer_dia)));
                $es_mes = true;
            }
            else
                $fecha_encabezado = date('d-m-Y', strtotime($request->fecha_inicio)) . " / " . date('d-m-Y', strtotime($request->fecha_fin));
        }
        elseif( $request->filled('fecha_inicio') ){
            $fecha_encabezado = strtoupper(strftime('%A %d del %Y', strtotime($request->fecha_inicio)));
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
        }
        else{
            $mes = date('m');
            $ano = date('Y');
            $fecha_encabezado = strtoupper(strftime("%B %Y"));
            $fecha_inicio = date('Y-m-d',mktime(0,0,0,$mes,1,$ano));
            $fecha_fin =  date('Y-m-d',mktime(0,0,0,$mes+1,0,$ano));
            $es_mes = true;

            //$request->prepend($fecha_inicio,'fecha_inicio');
            //$request->prepend('fecha_fin',$fecha_fin);
        }


        #Coordinador
        #Para las busqueda por fiscalia o unidad en la vista
        if($request->filled('buscar_fiscalia')){
            if($request->filled('buscar_unidad')){
                $lugar = 'unidad';
                $lugar_id = $request->buscar_unidad;
            }
            else{
                $lugar = 'fiscalia';
                $lugar_id = $request->buscar_fiscalia;
            }
        }

        $solicitudes = Peticion::where(function($q) use($fecha_inicio,$fecha_fin,$lugar,$lugar_id){
                                    // ($lugar == 'fiscalia') ? $q->where('fiscalia2_id',$lugar_id) : $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);                        
                                    // $q->whereBetween('created_at',["{$fecha_inicio} 00:00:00","{$fecha_fin} 23:59:59"]);

                                    if($lugar == 'fiscalia'){
                                        $q->where('fiscalia2_id',$lugar_id);
                                    }
                                    elseif($lugar == 'unidad'){
                                        $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);
                                    }
                                    elseif($lugar == 'usuario'){
                                        $q->where('user_id',$lugar_id);
                                    }

                                    $q->whereBetween('created_at',["{$fecha_inicio} 00:00:00","{$fecha_fin} 23:59:59"]);
                                })
                                ->get();
        $atendidas = Peticion::where(function($q) use($fecha_inicio,$fecha_fin,$lugar,$lugar_id){
                                    // ($lugar == 'fiscalia') ? $q->where('fiscalia2_id',$lugar_id) : $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);                        
                                    // $q->whereBetween('fecha_sistema',[$fecha_inicio,$fecha_fin]);

                                    if($lugar == 'fiscalia'){
                                        $q->where('fiscalia2_id',$lugar_id);
                                    }
                                    elseif($lugar == 'unidad'){
                                        $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);
                                    }
                                    elseif($lugar == 'usuario'){
                                        $q->where('user_id',$lugar_id);
                                    }

                                    $q->whereBetween('fecha_sistema',[$fecha_inicio,$fecha_fin]);
                                })
                                ->get();


        //dd($atendidas);


        #unidad o fiscalia
        if( $lugar == null ){
            if( Auth::user()->tipo === 'director_unidad' ){
                $lugar = 'unidad';
                $unidad = Unidad::find(Auth::user()->unidad_id);
            }
            elseif( Auth::user()->tipo === 'director_fiscalia' ){
                $lugar = 'fiscalia';
                $fiscalia = Fiscalia::find(Auth::user()->fiscalia_id);
            }
        }
        elseif( $lugar === 'unidad' ){
            $unidad = Unidad::find($lugar_id);
            $fiscalia = Fiscalia::find(4);
        }
        elseif( $lugar === 'fiscalia' ){
            $fiscalia = Fiscalia::find($lugar_id);
        }
        


        $fiscalias = Fiscalia::all();
            #unidades
            $unidades = Unidad::where('coordinacion','si')->get();

        $request->flash();
        

        

        return view('peticiones.concentrado_dia',
            compact(
                'solicitudes',
                'atendidas',
                'fecha_inicio',
                'fecha_fin',
                'lugar',
                'lugar_id',
                'fiscalias',
                'unidades',
                'fecha_encabezado',
                'fiscalia',
                'unidad'
            )
        );


    }

    public function concentrado_necros(Request $request, $lugar = null, $lugar_id = 0){

        //dd($lugar_id);

        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
       
        $es_mes = false;

        if( $request->filled('fecha_inicio') && $request->filled('fecha_fin') ){
            $primer_dia = mktime(0,0,0,date('m',strtotime($request->fecha_inicio)),1,date('Y',strtotime($request->fecha_inicio)));
            $primer_dia = date('Y-m-d',$primer_dia);
            $ultimo_dia = mktime(0,0,0,date('m',strtotime($request->fecha_inicio))+1,0,date('Y',strtotime($request->fecha_inicio)));
            $ultimo_dia = date('Y-m-d',$ultimo_dia);

            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;

            if( ( $request->fecha_inicio === $primer_dia ) && ( $request->fecha_fin === $ultimo_dia ) ){
                $fecha_encabezado = strtoupper(strftime('%B %Y',strtotime($primer_dia)));
                $es_mes = true;
            }
            else
                $fecha_encabezado = date('d-m-Y', strtotime($request->fecha_inicio)) . " / " . date('d-m-Y', strtotime($request->fecha_fin));
        }
        elseif( $request->filled('fecha_inicio') ){
            $fecha_encabezado = strtoupper(strftime('%A %d del %Y', strtotime($request->fecha_inicio)));
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
        }
        else{
            $mes = date('m');
            $ano = date('Y');
            $fecha_encabezado = strtoupper(strftime("%B %Y"));
            $fecha_inicio = date('Y-m-d',mktime(0,0,0,$mes,1,$ano));
            $fecha_fin =  date('Y-m-d',mktime(0,0,0,$mes+1,0,$ano));
            $es_mes = true;

            //$request->prepend($fecha_inicio,'fecha_inicio');
            //$request->prepend('fecha_fin',$fecha_fin);
        }


        #Coordinador
        #Para las busqueda por fiscalia o unidad en la vista
        if($request->filled('buscar_fiscalia')){
            if($request->filled('buscar_unidad')){
                $lugar = 'unidad';
                $lugar_id = $request->buscar_unidad;
            }
            else{
                $lugar = 'fiscalia';
                $lugar_id = $request->buscar_fiscalia;
            }
        }

        $solicitudes = Peticion::where(function($q) use($fecha_inicio,$fecha_fin,$lugar,$lugar_id){
                                    // ($lugar == 'fiscalia') ? $q->where('fiscalia2_id',$lugar_id) : $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);                        
                                    // $q->whereBetween('created_at',["{$fecha_inicio} 00:00:00","{$fecha_fin} 23:59:59"]);

                                    if($lugar == 'fiscalia'){
                                        $q->where('fiscalia2_id',$lugar_id);
                                    }
                                    elseif($lugar == 'unidad'){
                                        $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);
                                    }
                                    elseif($lugar == 'usuario'){
                                        $q->where('user_id',$lugar_id);
                                    }

                                    $q->whereBetween('created_at',["{$fecha_inicio} 00:00:00","{$fecha_fin} 23:59:59"]);
                                })
                                ->get();
        $atendidas = Peticion::where(function($q) use($fecha_inicio,$fecha_fin,$lugar,$lugar_id){
                                    // ($lugar == 'fiscalia') ? $q->where('fiscalia2_id',$lugar_id) : $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);                        
                                    // $q->whereBetween('fecha_sistema',[$fecha_inicio,$fecha_fin]);

                                    if($lugar == 'fiscalia'){
                                        $q->where('fiscalia2_id',$lugar_id);
                                    }
                                    elseif($lugar == 'unidad'){
                                        $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);
                                    }
                                    elseif($lugar == 'usuario'){
                                        $q->where('user_id',$lugar_id);
                                    }

                                    $q->whereBetween('fecha_sistema',[$fecha_inicio,$fecha_fin]);
                                })
                                ->get();


        //dd($atendidas);


        #unidad o fiscalia
        if( $lugar == null ){
            if( Auth::user()->tipo === 'director_unidad' ){
                $lugar = 'unidad';
                $unidad = Unidad::find(Auth::user()->unidad_id);
            }
            elseif( Auth::user()->tipo === 'director_fiscalia' ){
                $lugar = 'fiscalia';
                $fiscalia = Fiscalia::find(Auth::user()->fiscalia_id);
            }
        }
        elseif( $lugar === 'unidad' ){
            $unidad = Unidad::find($lugar_id);
            $fiscalia = Fiscalia::find(4);
        }
        elseif( $lugar === 'fiscalia' ){
            $fiscalia = Fiscalia::find($lugar_id);
        }
        


        $fiscalias = Fiscalia::all();
            #unidades
            $unidades = Unidad::where('coordinacion','si')->get();

        $request->flash();
        

        

        return view('peticiones.concentrado_dia',
            compact(
                'solicitudes',
                'atendidas',
                'fecha_inicio',
                'fecha_fin',
                'lugar',
                'lugar_id',
                'fiscalias',
                'unidades',
                'fecha_encabezado',
                'fiscalia',
                'unidad'
            )
        );


    }


    public function peticion_necropsias(Request $request, $lugar = null, $lugar_id = 0){

        
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
       
        $es_mes = false;

        if( $request->filled('fecha_inicio') && $request->filled('fecha_fin') ){
            $primer_dia = mktime(0,0,0,date('m',strtotime($request->fecha_inicio)),1,date('Y',strtotime($request->fecha_inicio)));
            $primer_dia = date('Y-m-d',$primer_dia);
            $ultimo_dia = mktime(0,0,0,date('m',strtotime($request->fecha_inicio))+1,0,date('Y',strtotime($request->fecha_inicio)));
            $ultimo_dia = date('Y-m-d',$ultimo_dia);

            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;

            if( ( $request->fecha_inicio === $primer_dia ) && ( $request->fecha_fin === $ultimo_dia ) ){
                $fecha_encabezado = strtoupper(strftime('%B %Y',strtotime($primer_dia)));
                $es_mes = true;
            }
            else
                $fecha_encabezado = date('d-m-Y', strtotime($request->fecha_inicio)) . " / " . date('d-m-Y', strtotime($request->fecha_fin));
        
            $dia_siguiente = date("Y-m-d", strtotime("{$request->fecha_fin} +1 day"));
        }
        elseif( $request->filled('fecha_inicio') ){
            $fecha_encabezado = strtoupper(strftime('%A %d del %Y', strtotime($request->fecha_inicio)));
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
            $dia_siguiente = date("Y-m-d", strtotime("{$request->fecha_inicio} +1 day"));
        }
        else{
            $mes = date('m');
            $ano = date('Y');
            $fecha_encabezado = strtoupper(strftime("%B %Y"));
            $fecha_inicio = date('Y-m-d',mktime(0,0,0,$mes,1,$ano));
            $fecha_fin =  date('Y-m-d',mktime(0,0,0,$mes+1,0,$ano));
            $es_mes = true;

            //$request->prepend($fecha_inicio,'fecha_inicio');
            //$request->prepend('fecha_fin',$fecha_fin);

            $dia_siguiente = date("Y-m-d", strtotime("{$fecha_fin} +1 day"));
        }


        $peticiones = Peticion::where(function($q) use($fecha_inicio,$fecha_fin,$lugar,$lugar_id,$dia_siguiente){
                                    ($lugar == 'fiscalia') ? $q->where('fiscalia2_id',$lugar_id) : $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);                        
                                    $q->whereBetween('created_at',["{$fecha_inicio} 07:00:00","{$dia_siguiente} 06:59:59"]);
                                })
                                ->where('solicitud_id',61)
                                //->whereIn('estado',['atendida','entregada'])
                                ->get();

        // $uecs = Peticion::where(function($q) use($fecha_inicio,$fecha_fin,$lugar,$lugar_id,$dia_siguiente){
        //                             ($lugar == 'fiscalia') ? $q->where('fiscalia2_id',$lugar_id) : $q->where('fiscalia2_id',4)->where('unidad_id',$lugar_id);                        
        //                             $q->whereBetween('created_at',["{$fecha_inicio} 07:00:00","{$dia_siguiente} 06:59:59"]);
        //                         })
        //                         ->where('solicitud_id',61)
        //                         ->whereIn('estado',['atendida','entregada'])
        //                         ->get();
        

        $necropsias = Necropsia::all(); 

        $request->flash();
        
        
        

        //dd($request->all());

        return view('peticiones.peticion_necropsias',
            compact(
                'peticiones',
                'necropsias',
                'fecha_inicio',
                'fecha_fin'
            )
        );


    }
    

    public function peticion_diaria_compacta(Request $request){
        if ( $request->filled('b_fecha_inicio') ) {
            $peticiones = Peticion::whereDate('created_at',$request->b_fecha_inicio)
                                    ->orWhere('fecha_sistema',$request->b_fecha_inicio)
                                    ->get();
        }
        $request->flash();
        return view('peticion.peticion_diaria_compacta',
            [
                'peticiones' => isset($peticiones) ? $peticiones->unique() : null,
                'regiones' => Fiscalia::where('id','<>',4)->get(),
                'unidades' => Unidad::where('coordinacion','si')->get(),
            ]
        );
    }


    Public function peticion_form($formAccion, Peticion $peticion){
        // dd(Unidad::find(56)->relacion_unidad()->get());
        return view('peticion.peticion_form',
            [
                'peticion' => $peticion,
                'formAccion' => $formAccion,
                'fecha_hoy' => date('Y-m-d'),
                'petfiscalias' => Petfiscalia::orderBy('nombre', 'asc')->get(),
                'petadscripciones' => Petadscripcion::all(),
                'solicitudes' => isset($peticion->id) ? Solicitud::where('especialidad_id',$peticion->solicitud->especialidad_id)->get() : null,
                'especialidades' => isset($peticion->id) ? Especialidad::where('unidad_id',$peticion->unidad_id)->get() : Especialidad::where('unidad_id',Auth::user()->unidad_id)->get(),
                'unidades' => Unidad::where('peticion','si')->get(),
                'unidades1' => Unidad::whereIn('nivel',[0,1])->where('unidad_estado','activo')->get(),
                // 'unidades2' => isset($peticion) ? Unidad::where('nivel',[0,1])->where('unidad_estado','activo')->get(),
                'fiscalias' => Fiscalia::all(),
                'necropsia_clasificaciones' => NecropsiaClasificacion::all(),
                'necropsias' => isset($peticion->necropsia_id) ? Necropsia::where('necropsia_clasificacion_id',$peticion->necropsia->necropsia_clasificacion_id)->get() : null,
            ]
        );
    }
    
    // public function peticion_save_por_etapa($peticion_etapa){
    //     if ($peticion_etapa == 'etapa_uno') {
    //         $this->peticion_save_etapa_uno();
    //     }
    //     elseif ($peticion_etapa == 'etapa_dos') {
    //         $this->peticion_save_etapa_dos();
    //     }
    //     elseif ($peticion_etapa == 'etapa_tres') {
    //         $this->peticion_save_etapa_tres();
    //     }
    // }
    public function peticion_save_en_conjunto(){

    }
    public function peticion_save_etapa_uno(Request $request){
        $this->peticion->nuc = $request->nuc;
        $this->peticion->fiscalia1_id = $request->fiscalia1;
        $this->peticion->fiscalia2_id = $request->fiscalia2;
        $this->peticion->unidad_id = $request->unidad;
        $this->peticion->fecha_peticion = $request->fecha_peticion;
        $this->peticion->fecha_recepcion = $request->fecha_recepcion;
        $this->peticion->oficio_numero = $request->oficio_numero;
        $this->peticion->folio_interno = $request->folio_interno;
        $this->peticion->sp_solicita = $request->sp_solicita;
        // $this->peticion->petfiscalia_id = $request->petfiscalia;
        // $this->peticion->petadscripcion_id = $request->petadscripcion;
        $this->peticion->unidad1_id = $request->unidad1;
        $this->peticion->unidad2_id = $request->unidad2;
        $this->peticion->solicitud_id = $request->solicitud;
        //user_id
        ($request->filled('peticion_user')) ?  $this->peticion->user_id = $request->peticion_user : $this->peticion->user_id = Auth::id();
        //estado
        $this->peticion->estado == null ? $this->peticion->estado = 'pendiente' : '';
        #Si es necropsia
        $this->peticion->necropsia_id = in_array($request->solicitud,['61','62']) ? $request->necropsia_diagnostico : null;
        $this->peticion->necropsia_apoyo = $request->filled('necropsia_clasificacion') && ($request->necropsia_clasificacion == 1) && ($request->necropsia_apoyo != 'no') ? $request->necropsia_apoyo : null;
        $this->peticion->unidad3_id = $request->filled('necropsia_pertenece') && ($request->necropsia_pertenece != 'no') ? $request->necropsia_pertenece : null;
    }
    public function peticion_save_etapa_dos(Request $request){
        $this->peticion->fecha_elaboracion = $request->fecha_elaboracion;
        $this->peticion->documento_emitido = $request->documento_emitido;
        $this->peticion->cantidad_estudios = $request->cantidad_estudios;
        //fecha_de_necro
        $this->peticion->fecha_necropsia = $request->has('fecha_necropsia') ? $request->fecha_necropsia : null;
        //fecha_sistema
        $this->peticion->fecha_sistema == null || $this->formAccion == 'clonar' ?  $this->peticion->fecha_sistema = date('Y-m-d') : '';
        //estado
        $this->peticion->estado == 'pendiente' ? $this->peticion->estado = 'atendida' : '';
    }
    public function peticion_save_etapa_tres(Request $request){
        $this->peticion->fecha_entrega = $request->fecha_entrega;
        $this->peticion->sp_recibe = $request->sp_recibe;
        //estado
        $this->peticion->estado == 'atendida' ? $this->peticion->estado = 'entregada' : '';
        //fecha_entrega_sistema
        $this->peticion->fecha_entrega_sistema == null || $this->formAccion == 'clonar' ?  $this->peticion->fecha_entrega_sistema = date('Y-m-d') : '';
    }
    
    #Eliminar
    public function peticion_eliminar(Request $request, Peticion $peticion){
        $peticion->delete();
        return response()->json([            
            'status' => true,
        ]);
    }


    
}
