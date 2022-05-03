<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicio extends Model
{
   protected $table = 'indicios';

   protected $guarded = ['estado','cadena_id'];

   public function cadena(){
      return $this->belongsTo('App\Cadena');
   }

   public function prestamos(){
      return $this->belongsToMany('App\Prestamo')->withTimestamps();
   }

   public function ubicacion(){
      return $this->belongsTo('App\Ubicacion');
   }

   public function bajas(){
      return $this->belongsToMany('App\Baja')->withPivot('id','baja_descripcion','baja_cantidad_indicios','baja_tipo','baja_descripcion_antes');
   }

   public function arma(){
        return $this->hasOne('App\Arma');
   }

   public function indicio_region($region_id){
      return Indicio::whereHas('cadena',function($q) use($region_id){
         $q->where('fiscalia_id',$region_id);
      })->sum('numero_indicios');
   }
   
   public static function indicios_naturaleza($naturaleza_id){
      return Indicio::whereHas('cadena',function($q) use($naturaleza_id){
                        if($naturaleza_id > 0) $q->where('naturaleza_id',$naturaleza_id);
                        $q->where('estado','validada')
                        ->whereHas('entrada',function($a){
                           $a->whereIn('tipo',['indicio','evidencia']);
                        });
                     })
                     ->sum('indicio_cantidad_disponible');
   }
}
