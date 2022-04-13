<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
   protected $table = 'dbo.cargos';

   protected $fillable = ['nombre'];

   public function cedulas(){
      return $this->hasMany('App\Cedula');
   }

   public function users(){
      return $this->hasMany('App\User');
   }
}
