<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Arma;
use App\Cadena;
use App\Indicio;

trait ArmaTrait{
   // public $arma;
   // public $indicio;

   public function arma_save_trait($formAccion,$request, $modelo, $modelo_id,$index = 0){
      if ($modelo == 'cadena')
         $indicio = Cadena::find($modelo_id)->indicios()->where('indicio_is_arma',true)->get()->slice($index)->first();
      elseif ($modelo == 'indicio')
         $indicio = Indicio::find($modelo_id);
      elseif ($modelo == 'arma')
         $arma = Arma::find($modelo_id);
      
      //Si es 'registrar'
      if($formAccion == 'registrar') $arma = new Arma;
      //Si es 'editar'
      elseif( ($formAccion == 'editar') && ($modelo != 'arma') ){
         $arma = $indicio->arma;
      }

      $arma->clasificacion    = $request->clasificacion[$index];
      $arma->tipo             = $request->tipo[$index];
      $arma->fabricante       = $request->fabricante[$index];
      $arma->serie            = $request->serie[$index];
      $arma->modelo           = $request->modelo[$index];
      $arma->calibre_id       = $request->calibre[$index];
      $arma->pais_id          = $request->pais[$index];
      $arma->importador       = $request->importador[$index];
      $arma->domicilio        = $request->domicilio[$index];
      if( isset($indicio) ) $arma->indicio_id = $indicio->id; //si existe indicio
      $arma->save();
   } 
}