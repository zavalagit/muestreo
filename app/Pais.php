<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'bodega.paises';

    protected $fillable = ['nombre'];

   
}
