<?php

// eliminar-archivo

namespace App\Http\Controllers\Peticiones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PeticionFormRequest;

use Auth;
use PDF;
use Validator;
use App\Delegacion;
use App\Especialidad;
use App\Unidad;
use App\Fiscalia;
use App\Necropsia;
use App\Petadscripcion;
use App\Petfiscalia;
use App\Peticion;
use App\Solicitud;

class PeritoController extends Controller
{
    public function __construct(){
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
    }

    public function get_petadscripciones(Request $request){
        $petadscripciones = Petfiscalia::find($request->petfiscalia_id)->petadscripciones()->orderBy('nombre', 'asc')->get();
        return response()->json(
            [
                'petadscripciones' => $petadscripciones,
            ]
        );
    }
    
    public function get_solicitudes(Request $request){
        $solicitudes = Solicitud::where('especialidad_id',$request->especialidad_id)->orderBy('nombre', 'asc')->get();
        return response()->json(
            [
                'solicitudes' => $solicitudes,
            ]
        );
    }

    public function get_necropsias(Request $request){
        $necropsias = Necropsia::where('necropsia_tipo',$request->necropsia_tipo)->get();
        return response()->json(
            [
                'necropsias' => $necropsias,
            ]
        );
    }

    public function peticion_form($accionForm, Peticion $peticion){

    }

    public function peticion_registrar($accion = NULL,$peticion_id=0){
        
        $fecha_hoy = date("Y-m-d");
        $petfiscalias = Petfiscalia::orderBy('nombre', 'asc')->get();
        $petadscripciones = Petadscripcion::all();
        $solicitudes = Solicitud::all();
        $especialidades = Especialidad::where('unidad_id',Auth::user()->unidad_id)->orderBy('nombre', 'asc')->get();
        $unidades = Unidad::where('peticion','si')->get();
        $fiscalias = Fiscalia::all();
        $necropsias = Necropsia::all();
        

        if($peticion_id != 0){
            $peticion = Peticion::find($peticion_id);
            $bandera = $accion;
            return view('peticiones.perito_registrar',
                compact(
                    'peticion',
                    'bandera',
                    'petfiscalias',
                    'petadscripciones',
                    'solicitudes',
                    'especialidades',
                    'unidades',
                    'fiscalias',
                    'necropsias',
                    'fecha_hoy'
                )
            );
        }

        $bandera = 'registrar';
        return view('peticiones.perito_registrar',
            compact(
                'bandera',
                'petfiscalias',
                'petadscripciones',
                'solicitudes',
                'especialidades',
                'unidades',
                'fiscalias',
                'necropsias',
                'fecha_hoy'
            )
        );
    }

    //Vista Editar Peticion
    public function peticion_editar($peticion_id){
        $peticion = Peticion::find($peticion_id);
        $solicitudes = Solicitud::all();
        $especialidades = Especialidad::where('unidad_id',Auth::user()->unidad_id)->orderBy('nombre', 'asc')->get();
        $petfiscalias = Petfiscalia::orderBy('nombre', 'asc')->get();
        $petadscripciones = Petadscripcion::all();
        $unidades = Unidad::where('coordinacion','si')->get();
        $fiscalias = Fiscalia::all();
        $necropsias = Necropsia::all();
        
        return view('peticiones.perito_peticion_editar',
            compact(
                'peticion',
                'solicitudes',
                'especialidades',
                'petfiscalias',
                'petadscripciones',
                'unidades',
                'fiscalias',
                'necropsias'
            )
        );
    }

    /*__Guarda registro nuevo y guarda editar__*/
    public function peticion_guardar(PeticionFormRequest $request, $accion = null ){

        
        
        $fecha_hoy = date("Y-m-d");


        if ($request->filled('peticion_id')) $peticion = Peticion::find($request->peticion_id);
        else $peticion = new Peticion;

        $permisos = [
            'etapa_1' => false,
            'etapa_2' => false,
            'etapa_3' => false,
        ];

        if($accion == 'registrar'){
            foreach ($permisos as $key => $permiso) {
                $permisos[$key] = true;
            }
        }
        elseif ($accion == 'continuar') {
            if($peticion->estado === 'pendiente'){
                $permisos['etapa_2'] = true;
                $permisos['etapa_3'] = true;
            }
            elseif ($peticion->estado === 'atendida') {
                $permisos['etapa_3'] = true;
            }
        }
        elseif($accion == 'editar'){
            if($peticion->estado === 'pendiente'){
                $permisos['etapa_1'] = true;
            }
            elseif($peticion->estado === 'atendida'){
                $permisos['etapa_1'] = true;
                $permisos['etapa_2'] = true;
            }
            elseif($peticion->estado === 'entregada'){
                $permisos['etapa_1'] = true;
                $permisos['etapa_2'] = true;
                $permisos['etapa_3'] = true;
            }
        }
        elseif ($accion == 'clonar') {
            foreach ($permisos as $key => $permiso) {
                $permisos[$key] = true;
            }
        }

          


        $mensajes = [
            'nuc.required' => 'El campo "NUC" es requerido.',
            //'nuc.min' => 'El campo "NUC" debe contener 13 digitos.',
            'fiscalia1.required' => 'El campo "FISCAÍA A LA QUE PERTENECE LA PETICIÓN" es requerido.',
            'fiscalia2.required' => 'El campo "FISCAÍA EN LA QUE SE ATIENDE PETICIÓN" es requerido.',
            'fecha_peticion.required' => 'El campo "FECHA DE PETICIÓN" es requerido.',
            'fecha_peticion.before_or_equal' => 'El campo "FECHA DE PETICIÓN" debe ser menor o igual a la fecha de hoy.',
            'fecha_recepcion.required' => 'El campo "FECHA DE RECEPCIÓN" es requerido.',
            'fecha_recepcion.after_or_equal' => 'El campo "FECHA DE RECEPCIÓN" debe ser igual o mayor a la "FECHA DE PETICIÓN".',
            'oficio_numero.required' => 'El campo "NÚMERO DE OFICIO" es requerido.',
            'sp_solicita.required' => 'El campo "M. P. O SERVIDOR PÚBLICO SOLICITA" es requerido.',
            'petfiscalia.required' => 'El campo "FISCALÍA DEL M.P. O SERVIDOR PÚBLICO SOLICITA" es requerido.',
            'petadscripcion.required' => 'El campo "LUGAR DE ADSCRIPCIÓN DEL M.P. O SERVIDOR PÚBLICO SOLICITA" es requerido.',
            'solicitud.required' => 'El campo "TIPO DE SOLICITUD" es requerido.',
            'especialidad.required' => 'El campo "TIPO DE ESPECIALIDAD" es requerido.',
            //2da etapa
            'fecha_elaboracion.required' => 'El campo "FECHA DE ELABORACIÓN" es requerido.',
            'fecha_elaboracion.after_or_equal' => 'El campo "FECHA DE ELABORACIÓN" debe ser mayor o igual a la "FECHA DE RECEPCIÓN".',
            'fecha_elaboracion.before_or_equal' => 'El campo "FECHA DE ELABORACIÓN" debe ser menor o igual a la fecha de hoy.',
            'documento_emitido.required' => 'El campo "DOCUMENTO EMITIDO" es requerido.',
            //'especialidad.required_if' => 'El campo "TIPO DE ESPECIALIDAD" es requerido.',
            //3ra etapa
            'fecha_entrega.required' => 'El campo "FECHA DE ENTREGA" es requerido.',
            'fecha_entrega.after_or_equal' => 'El campo "FECHA DE ENTREGA" debe ser mayor o igual a la "FECHA DE ELABORACIÓN".',
            'fecha_entrega.before_or_equal' => 'El campo "FECHA DE ENTREGA" debe ser menor o igual a la fecha de hoy.',
            'sp_recibe.required' => 'El campo "M. P. RECIBE" es requerido.',
        ];

        if($permisos['etapa_1']){
            $validator = Validator::make($request->all(), [
                'nuc' => 'required',
                'fiscalia1' => 'required',
                'fiscalia2' => 'required',
                'fecha_peticion' => 'required|before_or_equal:today',
                'fecha_recepcion' => 'required|after_or_equal:fecha_peticion',
                'oficio_numero' => 'required',
                'sp_solicita' => 'required',
                'petfiscalia' => 'required',
                'solicitud' => 'required',
                'especialidad' => 'required',
                //'petadscripcion' => 'required',
            ], $mensajes);
    
            if ($validator->fails()) {
                return response()->json([
                   'satisfactorio' => false,
                   'error' => $validator->errors()->all(),
                ]);
            }
    
            //necropsias
            if($request->solicitud === '61'){
                if( $request->filled('necropsia_clasificacion') ){
                    if( !$request->filled('necropsia_tipo') ){
                        return response()->json([
                            'satisfactorio' => false,
                            'error' => ['Seleccione el tipo de necropsia'],
                        ]);
                    }
                }
                else{
                    return response()->json([
                        'satisfactorio' => false,
                        'error' => ['Selecione la clasificasión de la necropsia'],
                    ]);
                }
            }
        }
        
        

        if($permisos['etapa_2']){
            //2da etapa validación
            if ($request->filled('fecha_elaboracion')   ||
                $request->filled('documento_emitido')   ||
                $request->filled('cantidad_estudios')  /* ||
                $request->has('peticion_antigua')*/ ) {
                
                $validator = Validator::make($request->all(), [
                    'fecha_elaboracion' => 'required|date|after_or_equal:fecha_recepcion|before_or_equal:today',
                    'fecha_necropsia' => 'sometimes|required|date|before_or_equal:fecha_elaboracion',
                    'documento_emitido' => 'required',
                    'cantidad_estudios' => 'required|numeric|min:0'
                ], $mensajes);
    
                if ($validator->fails()) {
                    return response()->json([
                       'satisfactorio' => false,
                       'error' => $validator->errors()->all(),
                    ]);
                }
            }
        }

        

        if($permisos['etapa_3']){
            //3da etapa validación
            if($request->filled('fecha_entrega') || $request->filled('sp_recibe')){
                $validator = Validator::make($request->all(), [
                    'fecha_elaboracion' => 'required|date|after_or_equal:fecha_recepcion|before_or_equal:today',
                    'fecha_entrega' => 'required|date|after_or_equal:fecha_elaboracion|before_or_equal:today',
                    'sp_recibe' => 'required',
                ], $mensajes);
    
                if ($validator->fails()) {
                    return response()->json([
                       'satisfactorio' => false,
                       'error' => $validator->errors()->all(),
                    ]);
                }
            }
        }

        // return response()->json([
        //     'satisfactorio' => $permisos,
        //  ]);

        if( (Auth::user()->tipo === 'admin_peticiones') ){

            if( !$request->filled('peticion_id') ){
                if( !$request->has('id_sp') ){
                    return response()->json([
                        'satisfactorio' => false,
                        'error' => ['Seleccione al servidor público que realiza la solicitud'],
                    ]);
                }
            }

        }

        

if( (Auth::user()->tipo != 'admin_peticiones') || ($accion != 'clonar') ){
    if($request->peticion_antigua){

        // if( !( /*( strtotime($request->fecha_recepcion) < strtotime('2020-04-30') ) || */( ( strtotime($request->fecha_recepcion) >= strtotime('2020-07-10') ) && ( strtotime($request->fecha_recepcion) <= strtotime('2020-07-14') ) ) ) ){
        //     return response()->json([
        //         'satisfactorio' => false,
        //         'error' => ['La "fecha de recepción" no está dentro del rango de fechas permitidas'],
        //     ]);
        // }

        // if($request->filled('fecha_elaboracion')){

        //     if( !( ( strtotime($request->fecha_elaboracion) < strtotime('2020-04-30') ) || ( ( strtotime($request->fecha_elaboracion) >= strtotime('2020-07-10') ) && ( strtotime($request->fecha_elaboracion) <= strtotime('2020-07-14') ) ) ) ){
        //         return response()->json([
        //             'satisfactorio' => false,
        //             'error' => ['La "fecha de elaboración" no está dentro del rango de fechas permitidas'],
        //         ]);
        //     }
        // }
        
    }
    else{

        $fecha_antier = strtotime("{$fecha_hoy} -60 day");

        if( ($accion == 'registrar') ){

            if( strtotime($request->fecha_recepcion) < $fecha_antier ){
                return response()->json([
                    'satisfactorio' => false,
                    'error' => ['Selecciona la casilla de al principio'],
                ]);
    
            }

        }

        if( ($accion == 'continuar') && ($peticion->estado == 'pendiente') ){

            
            

            if( $request->fecha_elaboracion ){

                if( strtotime($request->fecha_elaboracion) < $fecha_antier ){
                    return response()->json([
                        'satisfactorio' => false,
                        'error' => ['Selecciona la casilla de al principio'],
                    ]);
        
                }

            }

            
        }

        if( $accion == 'editar' ){
            $created_at_menos_dos = strtotime($peticion->created_at);
            $created_at_menos_dos = date('Y-m-d',$created_at_menos_dos);
            $created_at_menos_dos = strtotime("{$created_at_menos_dos} -2 day");
            $created_at_menos_dos = date('Y-m-d',$created_at_menos_dos);
            $created_at_menos_dos = strtotime($created_at_menos_dos);
            //$created_at_menos_dos = date('Y-m-d',$created_at_menos_dos);
                    // return response()->json([
                    //     'satisfactorio' => false,
                    //     'error' => [$created_at_menos_dos],
                    // ]);



            if( strtotime($request->fecha_recepcion) < $created_at_menos_dos ){
                return response()->json([
                    'satisfactorio' => false,
                    'error' => ['No es posible cambiar la fecha de recepción'],
                ]);
    
            }
        }
    }
}

                

        if($permisos['etapa_1']){
            $peticion->nuc = $request->nuc;
            $peticion->fiscalia1_id = $request->fiscalia1;
            $peticion->fiscalia2_id = $request->fiscalia2;
            $peticion->unidad_id = $request->unidad;
            $peticion->fecha_peticion = $request->fecha_peticion;
            $peticion->fecha_recepcion = $request->fecha_recepcion;
            $peticion->oficio_numero = $request->oficio_numero;
            $peticion->folio_interno = $request->folio_interno;
            $peticion->sp_solicita = $request->sp_solicita;
            $peticion->petfiscalia_id = $request->petfiscalia;
            $peticion->petadscripcion_id = $request->petadscripcion;
            $peticion->solicitud_id = $request->solicitud;
            #Si es necropsia
            if($request->has('necropsia_tipo')){
                $peticion->necropsia_id = $request->necropsia_tipo;
            }
            else{
                $peticion->necropsia_id = null;
            }
        }

       

        if($permisos['etapa_2']){
            $peticion->fecha_elaboracion = $request->fecha_elaboracion;
            $peticion->documento_emitido = $request->documento_emitido;
            $peticion->cantidad_estudios = $request->cantidad_estudios;
            #fecha_reporte_necro
            if($request->has('fecha_necropsia')){
                $peticion->fecha_necropsia = $request->fecha_necropsia;
            }
            else{
                $peticion->fecha_necropsia = null;
            }
        }

      

        if($permisos['etapa_3']){
            $peticion->fecha_entrega = $request->fecha_entrega;
            $peticion->sp_recibe = $request->sp_recibe;
        }
        

        // return response()->json([
        //     'satisfactorio' => false,
        //     'error' => ['todo bien'],
        // ]);
        
        
        
       

        
        if($accion === 'registrar'){
            $peticion->estado = 'pendiente';
            if( Auth::user()->tipo == 'admin_peticiones' ){
                if( !$request->filled('peticion_id') )
                    $peticion->user_id = $request->id_sp;
            }
            else
                $peticion->user_id = Auth::user()->id;
        }


      
        

        if($accion === 'clonar'){
           
            if( Auth::user()->tipo == 'admin_peticiones' ){
                if( !$request->filled('peticion_id') )
                    $peticion->user_id = $request->id_sp;
            }
            else
                $peticion->user_id = Auth::user()->id;

        }

        
        
        

        // return response()->json([
        //     'satisfactorio' => true,
        //     'error' => ['Selecione la clasificasión de la necropsia'],
        // ]);

        #despeues de guardar para verificsr los campor de las fechas
        if($accion === 'clonar'){
           
            #estado peticion
            $peticion->estado = 'pendiente';

            if($peticion->fecha_elaboracion != NULL){
                $peticion->estado = 'atendida';
            }
            if($peticion->fecha_entrega != NULL) 
                $peticion->estado = 'entregada';

                $peticion->fecha_sistema = $fecha_hoy;
        }

        
        // $peticion->save();


            

/*
            return response()->json([
                'satisfactorio' => $request->all(),
             ]);
  */

             

        if($accion === 'registrar'){

            if($request->peticion_antigua){
                $hora_hoy = date('H:i:s');
                $peticion->created_at = "{$request->fecha_recepcion} {$hora_hoy}.000";
                // return "arre";
                // return "{$request->fecha_recepcion} {$hora_hoy}";

            }
            

            if($peticion->fecha_elaboracion != NULL){
                
                if($request->has('peticion_antigua'))
                    $peticion->fecha_sistema = $peticion->fecha_elaboracion;
                else
                    $peticion->fecha_sistema = $fecha_hoy;


                $peticion->estado = 'atendida';
            }

            if($peticion->fecha_entrega != NULL) 
                $peticion->estado = 'entregada';
        }

        
        if($accion === 'continuar'){

            if( $peticion->estado == 'pendiente' ){

                if($peticion->fecha_elaboracion != NULL){
                
                    if($request->has('peticion_antigua'))
                        $peticion->fecha_sistema = $peticion->fecha_elaboracion;
                    else
                        $peticion->fecha_sistema = $fecha_hoy;
    
    
                    $peticion->estado = 'atendida';
                }

            }
            else if($peticion->estado == 'atendida'){
                if($peticion->fecha_entrega != NULL) 
                    $peticion->estado = 'entregada';
            }


        }


/*             
        if($peticion->filled('fecha_elaboracion')){
            $peticion->estado = 'atendida';

            if($peticion->fecha_sistema == NULL){
                if($request->has('peticion_antigua'))
                    $peticion->fecha_sistema = $request->fecha_elaboracion;
                else
                    $peticion->fecha_sistema = $fecha_hoy;
            }
        }
        if($request->filled('fecha_entrega')) $peticion->estado = 'entregada';
  */      

  
        $peticion->save();
  
  
        
        
        
        return response()->json([
            'satisfactorio' => true,
         ]);
    }

    public function peticion_clonar($id_peticion){
        $peticion = Peticion::find($id_peticion);
        $nvaPeticion = $peticion->replicate();
        $nvaPeticion->save();

        return back()->withInput();
    }

    public function peticion_eliminar(Request $request){
        Peticion::destroy($request->id);

        return response()->json([
            'satisfactorio' => true,
         ]);
    }

}
