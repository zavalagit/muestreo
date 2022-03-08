<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Objeto extends Model
{
    protected $table = 'bodega.objetos';

    protected $fillable = ['nombre'];

    public function colectivo(){
        return $this->belongsTo('App\Colectivo');
    }
}
