<?php

namespace App;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $guarded = [];

    public function procesos()
    {
        return $this->hasMany('App\Proceso');
    }
}
