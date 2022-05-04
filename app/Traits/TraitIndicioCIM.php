<?php
namespace App\Traits;
use App\Indicio;

trait TraitIndicioCIM{
   public function set_indicio_cim(Indicio $indicio){
     
      //registro de codificaciones en la COLUMNAS codigo llenas numero CIM automaticamente No./año
      if ( $indicio->codificacion->count() ) {
         if ( $indicio->codificacion->contains('estado','activo') ) $indicio->estado = 'prestamo';
         else $indicio->estado = 'activo';
      }
      //activo
      else $indicio->estado = 'activo';

      $indicio->save();
   }
}