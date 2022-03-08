<?php
namespace App\Traits;

trait TraitFechahoy{
   public $fecha_hoy;

   public function set_fecha_hoy($fecha_inicio, $fecha_fin = null){      
      if ($fecha_fin != null) {
          if ( date('Y-m',strtotime($fecha_inicio)) == date('Y-m',strtotime($fecha_fin))  ){ //comprando que las dos fechas esten dentro del mismo año y mes
              if ( ( date('Y-m-01', strtotime($fecha_fin)) == $fecha_fin ) && ( date('Y-m-t', strtotime($fecha_fin)) == $fecha_fin ) ){ //compando que las dos fechas sean el primer y ultmo día del mes
                  $fecha_formato = strftime('%B del %Y',strtotime($fecha_inicio));
              }
              else{
                  $fecha_formato = date('d-m-Y',strtotime($fecha_inicio)).' al '. date('d-m-Y',strtotime($fecha_fin));
              }
          }
      }
      elseif ($fecha_inicio != null) {
          $fecha_formato = strftime('%A %d de %B del %Y',strtotime($fecha_inicio));
      }

      $this->fecha_formato = $fecha_formato;
   }
}