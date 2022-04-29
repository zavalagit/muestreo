<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $guarded = [];

    public function pcr()
    {
        return $this->hasOne('App\PCR');
    }
}
