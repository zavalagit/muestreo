<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class Peticion3Controller extends Controller
{

    protected $modelo;

    public function __construct(){
        set_time_limit(0);
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_TIME, "spanish");

        if(Auth::user()->tipo == 'user') $this->modelo = 'user';
        else if(Auth::user()->tipo == 'coordinador_peticiones_unidad') $this->modelo = 'unidad';
        else if(Auth::user()->tipo == 'coordinador_peticiones_region') $this->modelo = 'region';
    }

    public function peticion_estadistica(){

    }
}
