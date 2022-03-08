<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calibre extends Model
{
    protected $table = 'bodega.calibres';
    protected $fillable = ['nombre'];
}
