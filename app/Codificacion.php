<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codificacion extends Model
{
    protected $table = 'bodega.codificaciones';

    protected $fillable = [
        'proceso_id', //relacion de la tabla procesos
        'perito_id', //perito que realiza el registro
        'supervisor_id', //supermisor que autoriza su registro
        'bitacora', //nombre de libro de bitacora
        'numero_libro', //numero del libro de bitacoras
        'folio_interno', //folio interno para el registro
        'hora_inicio',
        'fecha_inicio'
    ];
    public function proceso(){
        return $this->belongsTo('App\Proceso','proceso_id');
     }


    public function perito(){
        return $this->belongsTo('App\User','perito_id');
     }

     public function supervisor(){
        return $this->belongsTo('App\User','supervisor_id');
     }

     public function indicios(){
        return $this->belongsToMany('App\Indicio')
                    ->withPivot('id','indicio_id','codificacion_id','codigo','descripcion','observaciones')   
                    ->withTimestamps();
     }
}
