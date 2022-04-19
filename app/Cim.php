<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cim extends Model
{
    protected $fillable = [
        'user_id', //usuario que realiza el registro
        'indicio_id', //id del indicio para relacionar cim
        'codigo' //numero denominado cim numero consecutivo/año de registro
        
    ];

    //Usuario que hace el registro
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function indicio(){
        return $this->belongsTo('App\Indicio','indicio_id');
    }
}
