<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CadenaFormRequest;
use App\Traits\IndicioTrait;
use App\Cadena;
use App\Entrada;
use App\Delegacion;
use App\Categoria;
use App\Embalaje;
use App\Entidad;
use App\Fiscalia;
use App\Indicio;
use App\Unidad;
use App\Naturaleza;
use App\Usuario;
use App\User;
use Validator;
use Auth;

class CadenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   use IndicioTrait;

   public $cadena;

   /**Return de vistas */
   public function form_indicio(Request $request){
      return view('cadena.cadena_form_22_descripcion_indicios');
   }
   public function fila_tabla_recoleccion(Request $request){
      return view('cadena.cadena_form_41_fila_identificador_recoleccion',[
         'indice' => $request->indice,
         'identificador' => $request->identificador
      ]);
   }
   public function fila_tabla_embalaje(Request $request){
      return view('cadena.cadena_form_51_fila_identificador_embalaje',[
         'indice' => $request->indice,
         'identificador' => $request->identificador
      ]);
   }
   public function fila_tabla_servidor_publico(Request $request){
      return view('cadena.cadena_form_61_fila_servidor_publico',[
         'indice' => $request->indice,
         'sp' => User::find($request->sp_id),
      ]);
   }

   public function cadena_form($formAccion, Cadena $cadena){
      return view('cadenas.registrar',[
         'cadena' => $cadena,
         'unidades' => Unidad::where('unidad_estado','activo')->get(),
         'naturalezas' => Naturaleza::all(),
         'formAccion' => $formAccion
      ]);
   }

     public function editar_form($id){
        $cadena = Cadena::find($id);
        $unidades = Unidad::all();
        return view('cadenas.editar', [
           'id' => $id,
           'cadena' => $cadena,
           'unidades' => $unidades,
        ]);
     }

     public function clonar_form($id){
       $cadena = Cadena::find($id);
       $unidades = Unidad::all();
       return view('cadenas.clonar', [
          'id' => $id,
          'cadena' => $cadena,
          'unidades' => $unidades,
       ]);
     }

   public function fiscalia_cambiar($id){
      $cadena = Cadena::find($id);
      $fiscalias = Fiscalia::all();

      return view('administrador.cadenas.cadena_fiscalia_cambiar',
         [
            'cadena' => $cadena,
            'fiscalias' => $fiscalias,
         ]
      );
   }
   public function fiscalia_cambiar_guardar(Request $request){
      $cadena = Cadena::find($request->id_cadena);
      $cadena->fiscalia_id = $request->fiscalia;
      $cadena->save();

      //Mandando mensaje satisfactorio
      return response()->json([
         'satisfactorio' => true
      ]);
   }

   

   public function cadena_save(CadenaFormRequest $request, $formAccion, Cadena $cadena){
      // return response()->json([
      //    'satisfactorio' => true,
      //    'request' => $request->all(),
      // ]);

      if(in_array($formAccion,['registrar','clonar'])){ 
         $cadena = new Cadena;
         $cadena->fiscalia_id = Auth::user()->fiscalia->id; 
         $cadena->user_id = Auth::user()->id; 
      }        

      #1. Datos generales
      $cadena->nuc = $request->nuc;
      $cadena->unidad_id = $request->unidad;
      $cadena->folio = $request->folio;
      $cadena->intervencion_lugar = $request->intervencion_lugar;
      $cadena->intervencion_hora = $request->intervencion_hora;
      $cadena->intervencion_fecha = $request->intervencion_fecha;
      $cadena->motivo = $request->motivo;
      #2. Identidad
      // $cadena->naturaleza_id = $request->cadena_naturaleza;
      #3. Documentacion
      $cadena->escrito = $request->escrito;
      $cadena->fotografico = $request->fotografico;
      $cadena->croquis = $request->croquis;
      $cadena->otro = $request->otro;
      if ( $request->has('especifique') ) $cadena->especifique = $request->especifique;
      #7. Traslado
      $cadena->traslado = $request->traslado_via;
      $cadena->trasladoCondiciones = $request->traslado_condiciones;
      if ( $request->has('traslado_recomendaciones') ) $cadena->trasladoRecomendaciones = $request->traslado_recomendaciones;
      #8. Anexo-4
      $cadena->embalaje = $request->anexo_4;
      #cadena_save
      $cadena->save();
      #Save_indicios
      for ($indice=0; $indice < count($request->identificador); $indice++){
         $this->indicio_save($request, $cadena, $indice);
      }
      #Delete_indicio - Solo para la acción "editar"
      if ($formAccion == 'editar') {
         if ($cadena->indicios->count() > count($request->identificador) )
            $this->indicio_delete($cadena, $request->identificador->count());
      }
      #Servidores públicos
      //Agregando Servidores Publicos a la tabla pivote
      if($formAccion == 'editar')//Solo cuando es editar
        $cadena->users()->detach();//Borra los usuarios de la tabla cadena_user
      for ($i=0; $i < count($request->sp_id); $i++) {
         $cadena->users()->attach($request->sp_id[$i],['etapa'=>$request->sp_etapa[$i]]);
      }

      $arma = ($cadena->indicios->where('arma',1)->count()) ? true : false;

        //Mandando mensaje satisfactorio
        return response()->json([
           'satisfactorio' => true,
           'cadena' => $cadena,
           'tipo_usuario' => Auth::user()->tipo,
           'request' => $request->all(),
        ]);

  }//cadena_guardar

}
