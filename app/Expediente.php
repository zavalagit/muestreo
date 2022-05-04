<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table = 'bodega.expedientes';

    protected $fillable = [
        'nuc', //nuc de los indicios
        'folio_expediente', //folio del expediente automatico e irrepetible
        'hora_creacion', //hora de la creacion
        'fecha_creacion', //fecha de creacion
        'fecha_inicio', //fecha de inicio de las etapas
        'fecha_final', //fecha final donde realizas un reporte o informe
        
    ];
}
