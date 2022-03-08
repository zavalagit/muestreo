<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

class PrestamoController extends Controller
{
   use TraitIndicioEstado;

   public $formAccion;
   public $prestamo;
   public $cadena;
   public $array_prestamos_id = [];

   public function set_formAccion($formAccion){
      $this->formAccion = $formAccion;
   }
   public function set_prestamo(Prestamo $prestamo){
      $this->prestamo = $prestamo;
   }
   public function set_cadena(Cadena $cadena){
      $this->cadena = $cadena;
   }
   #prestamo_form
   public function prestamo_form($formAccion,Cadena $cadena,Prestamo $prestamo){
      if ($formAccion == 'prestar' || ($formAccion == 'editar' && $prestamo->estado == 'activo')) {
         return view('prestamo.prestamo_form',compact('formAccion','cadena','prestamo'));
      }
      elseif ($formAccion == 'reingresar' || ($formAccion == 'editar' && $prestamo->estado == 'concluso')) {
         return view('prestamo.reingreso_form',compact('formAccion','prestamo'));
      }
   }
   #prestamo_multiple_form
   public function prestamo_multiple_form($formAccion, $cadenas){
      $cadenas = explode( ',',str_replace(['[',']'],'',$cadenas) ); //cadenas llega como string ej: "[1,2,3,..,n-1,n]", hay que convertirlo a array pero primero hay que quitar los caracteres '[' y ']'
      return view('prestamo.prestamo_multiple',['formAccion' => $formAccion,'cadenas' => Cadena::find($cadenas)]);
   }
   #reingreso_multiple_form
   public function reingreso_multiple_form($formAccion,$prestamos){
      return view('prestamo.reingreso_multiple',[
         'prestamos' => Prestamo::find(json_decode($prestamos)),
         'formAccion' => $formAccion,
      ]);
   }
   #prestamo, reingreso multiples save
   public function prestamo_save(PrestamoFormRequest $request, $formAccion, Prestamo $prestamo){
      $this->set_formAccion($formAccion);
      $this->set_prestamo($prestamo);
      //formAccion -> prestar
      if( $formAccion == 'prestar' ){
         DB::transaction(function () use($request) {
            $this->set_prestamo_modelo($request);
         },3);
      }
      //formAccion -> reingresar
      elseif( $formAccion == 'reingresar' ){
         if( $request->has('reingreso_multiple') ){
            foreach ($request->prestamos as $i => $prestamo) {
               $this->set_prestamo(Prestamo::find($prestamo));
               DB::transaction(function () use($request) {
                  $this->set_reingreso_atributos($request);
                  $this->set_reingreso_pivot($request);
                  $this->set_reingreso_indicios($request);
               },3);
            }
         }else{
            DB::transaction(function () use($request) {
               $this->set_reingreso_atributos($request);
               $this->set_reingreso_pivot($request);
               $this->set_reingreso_indicios($request);
            },3);
         }
      }
      //formAccion -> editar
      elseif( $formAccion == 'editar' ){
         DB::transaction(function () use($request) {
            $this->set_prestamo_atributos($request);
            if($this->prestamo->estado == 'concluso') $this->set_reingreso_atributos($request);
         },3);
      }
      
      //respuesta
      return response()->json([
            'status' => true,
            'formAccion' => $formAccion,
            'prestamo' => $this->prestamo,
            'prestamo_multiple' => $request->has('prestamo_multiple') ? true : false,
            'array_prestamos_id' => $this->array_prestamos_id,
      ]);
   }
   public function set_prestamo_modelo(Request $request){
      if ( $request->filled('cadenas') ) {
         foreach (Cadena::find($request->cadenas) as $key => $cadena) {
            $this->prestamo = new Prestamo;
            $this->set_cadena($cadena);
            $this->set_prestamo_atributos($request); //se relailiza el prestamo por cadena
            $this->set_prestamo_indicios($cadena->indicios);
            $this->array_prestamos_id[] = $this->prestamo->id;
         }
      }
      if ( $request->filled('indicios') ) {
         $gruposIndicios = Indicio::find($request->indicios)->groupBy('cadena_id'); //separando los indicios en grupos de acuerdo a la cadena que pertenecen         
         foreach ($gruposIndicios as $cadena_id => $grupoIndicios) { //iterando cada grupo
            $this->prestamo = new Prestamo;
            $this->set_cadena(Cadena::find($cadena_id));
            $this->set_prestamo_atributos($request); //se relailiza el prestamo por grupo de cadena
            $this->set_prestamo_indicios($grupoIndicios);            
            $this->array_prestamos_id[] = $this->prestamo->id;
         }
      }
   }
   public function set_prestamo_atributos(Request $request){      
      $this->prestamo->prestamo_ordena = $request->prestamo_autoriza;
      $this->prestamo->prestamo_hora = $request->prestamo_hora;
      $this->prestamo->prestamo_fecha = $request->prestamo_fecha;
      // if( $this->formAccion == 'prestar' ) = isset($cadena->id) ? $cadena->indicios->sum('indicio_cantidad_disponible') : null;
      if( $this->formAccion == 'prestar' ) $this->prestamo->prestamo_numindicios = 0;
      $this->prestamo->perito1_id = $request->prestamo_resguardante; //prestamo recibe (Resguardante)
      $this->prestamo->user1_id = $request->prestamo_responsable_bodega; //prestamo entrega (Responsable de bodega)
      // if( $cadena->id ) $this->prestamo->cadena_id = $cadena->id;
      if( $this->formAccion == 'prestar' ) $this->prestamo->cadena_id = $this->cadena->id;
      $this->prestamo->save();
   }
   public function set_prestamo_indicios($indicios){
      foreach ($indicios as $key => $indicio) {               
         $this->prestamo->indicios()->attach($indicio,[ //relacion prestamo-indicios
            'prestamo_cantidad_indicios' => $indicio->indicio_cantidad_disponible,
            'prestamo_descripcion' => isset($indicio->indicio_descripcion_disponible) ? $indicio->indicio_descripcion_disponible : null, 
         ]);
         $this->prestamo->prestamo_numindicios += $indicio->indicio_cantidad_disponible; //suma de cantidad de indicios prestados en el prestamo
         $this->prestamo->save(); //guardando prestamo
         $this->set_indicio_estado($indicio); //update estado del indicio
      }
   }
   public function set_reingreso_atributos(Request $request){
      $this->prestamo->reingreso_fecha = $request->reingreso_fecha;
      $this->prestamo->reingreso_hora = $request->reingreso_hora;
      $this->prestamo->estado = 'concluso';
      $this->prestamo->perito2_id = $request->reingreso_resguardante;
      $this->prestamo->user2_id = $request->reingreso_responsable_bodega;
      if($this->formAccion == 'reingresar'){//si es editar no entrar
         $this->prestamo->reingreso_numindicios = ($request->has('reingreso_multiple')) ? $this->prestamo->prestamo_numindicios : array_sum($request->reingreso_cantidad_indicios);
      }
      $this->prestamo->save();
   }
   public function set_reingreso_pivot(Request $request){
      foreach ($this->prestamo->indicios as $key => $indicio) {
         $this->prestamo->indicios()->updateExistingPivot($indicio->id,[
            'reingreso_descripcion' => $request->filled("reingreso_descripcion_disponible[{$indicio->id}]") ? $request->reingreso_descripcion_disponible[$indicio->id] : null,
            'reingreso_cantidad_indicios' => ($request->has('reingreso_multiple')) ? $indicio->pivot->prestamo_cantidad_indicios : $request->reingreso_cantidad_indicios[$indicio->id],
         ]);
      }
   }
   public function set_reingreso_indicios(Request $request){
      foreach ($this->prestamo->indicios as $key => $indicio) {
         if( $request->filled("reingreso_descripcion_disponible[{$indicio->id}]") ) $indicio->indicio_descripcion_disponible = $request->reingreso_descripcion_disponible[$indicio];
         if(!$request->has('reingreso_multiple')) $indicio->indicio_cantidad_disponible = $request->reingreso_cantidad_indicios[$indicio->id];
         $indicio->save();
         $this->set_indicio_estado($indicio);     
      }
   }
   public function prestamo_multiple_pdf($array_prestamos){
      $prestamos = Prestamo::with('cadena')->whereIn('id',explode(',',$array_prestamos))->get();
      return view('prestamo.prestamo_multiple_pdf',['prestamos' => $prestamos]);
   }


   #prestamo_consultar
   public function prestamo_consultar(Request $request){
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
      return view('prestamo.prestamo_consultar',[
         'prestamos' => isset($prestamos) ? $prestamos : null,
         'regiones' => Fiscalia::all(),
      ]);

   }


   

   

   // public function reingreso_multiple_save(PrestamoRequest $request){
   //    $prestamos = Prestamo::find($request->prestamos);
   //    foreach ($prestamos as $key => $prestamo) {
   //       $this->prestamo = $prestamo;
         
   //       #actualizando estado de los indicios
   //       Indicio::whereIn('id',$prestamo->indicios->pluck('id'))->update(['estado' => 'activo']);
   //    }
   //    return response()->json([
   //       'satisfactorio' => true,
   //    ]);
   // }


   // public function prestamo_editar_form($id_prestamo = 0){
   //       $prestamo = Prestamo::find($id_prestamo);
   //       return view('prestamo.prestamo_editar_form', compact('prestamo'));
   // }

   // public function prestamo_editar_save(PrestamoRequest $request){
   //    $prestamos = Prestamo::find($request->prestamos);

   //    // return response()->json([
   //    //    'satisfactorio' => true,
   //    //    'request' => $request->all(),
   //    // ]);

   //    foreach ($prestamos as $key => $prestamo) {
   //       $prestamo->prestamo_ordena = $request->prestamo_autoriza;
   //       $prestamo->prestamo_hora = $request->prestamo_hora;
   //       $prestamo->prestamo_fecha = $request->prestamo_fecha;
   //       $prestamo->perito1_id = $request->prestamo_resguardante; //prestamo recibe (Resguardante)
   //       $prestamo->user1_id = $request->prestamo_responsable_bodega; //prestamo entrega (Responsable de bodega)

   //       if($request->prestamo_estado == 'concluso'){
   //          $prestamo->reingreso_numindicios = $prestamo->indicios->sum('numero_indicios');
   //          $prestamo->reingreso_fecha = $request->reingreso_fecha;
   //          $prestamo->reingreso_hora = $request->reingreso_hora;
   //          $prestamo->estado = 'concluso';
   //          $prestamo->perito2_id = $request->reingreso_resguardante;
   //          $prestamo->user2_id = $request->reingreso_responsable_bodega;
   //       }
   //       $prestamo->save();
   //    }

   //    return response()->json([
   //       'satisfactorio' => true,
   //    ]);
   // }



   public function prestamo_eliminar(Prestamo $prestamo){
      $indicios = $prestamo->indicios;
      $prestamo->indicios()->detach();
      $prestamo->delete();
      foreach ($indicios as $i => $indicio) {
         $this->set_indicio_estado($indicio); //indicio_estado
      }
      return response()->json([
         'satisfactorio' => true,
      ]);

   }

   // public function masivo_tipo($masivo_tipo){
   //    if ($masivo_tipo == 'prestamo') {
   //       return view('entrada.hola');
   //    }
   //    elseif ($masivo_tipo == 'baja') {
   //       # code...
   //    }
   // }


   

}
