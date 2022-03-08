<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arma extends Model
{
    protected $table = 'bodega.armas';

    protected $fillable = ['tipo','clasificacion','fabricante','modelo','serie','calibre','pais_id','importador','domicilio','indicio_id','observacion'];

    public function indicio(){
        return $this->belongsTo('App\Indicio');
    }

    public function pais(){
        return $this->belongsTo('App\Pais');
    }
    
    public function fotos(){
		return $this->morphMany('App\Foto','fotografia');
	}
}
