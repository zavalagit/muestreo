<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $table = 'bodega.procesos';

    protected $fillable = [
        'expediente_id', //relacion con la tabla expediente
        'folio_proceso', //folio del proceso automatico e irrepetible
        'nombre', //nombre que se le da al proceso
        'hora_creacion', //hora de la creacion
        'fecha_creacion', //fecha de creacion
        
    ];

    //Expediente que hace el registro
    public function expediente(){
        return $this->belongsTo('App\Expediente','expediente_id');
    }
}
