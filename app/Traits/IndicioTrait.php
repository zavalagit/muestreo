<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Cadena;
use App\Indicio;

trait IndicioTrait{
   public function indicio_save(Request $request, Cadena $cadena, $indice){   
      $indicio = $cadena->indicios->slice($indice,1)->first();
      if( is_null($indicio) ) $indicio = new Indicio;
      $indicio->identificador = $request->identificador[$indice];
      $indicio->descripcion = $request->descripcion[$indice];
      $indicio->indicio_ubicacion_lugar = $request->ubicacion[$indice];
      if($request->has('recolectado_de')) $indicio->recolectado_de = $request->recolectado_de[$indice];
      $indicio->hora = $request->recoleccion_hora[$indice];
      $indicio->fecha = $request->recoleccion_fecha[$indice];
      $indicio->condicion = $request->estado_indicio[$indice];
      $indicio->observacion = $request->observacion[$indice];
      $indicio->recoleccion = $request->recoleccion[$indice];
      $indicio->embalaje = $request->embalaje[$indice];
      $indicio->indicio_is_arma = ($request->cadena_arma == 'si') ? ($request->indicio_arma[$indice] == 'si' ? true : false) : false;
      $indicio->cadena_id = $cadena->id;
      $indicio->save();
   }
   public function indicio_delete(Cadena $cadena, $indice){
      Indicio::destroy( $cadena->indicios->slice($indice)->pluck('id') );
   }
}