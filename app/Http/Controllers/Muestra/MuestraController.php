<?php

namespace App\Http\Controllers\Muestra;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\TraitFechaFormato;

class MuestraController extends Controller
{
    public function __construct(){
        set_time_limit(0);
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_TIME, "spanish");
    }
    
    #Traits
    use TraitFechaFormato;
    /**
     * Form (crear,editar)
     */
    public function muestra_form($formAccion, $modelo=0){
        #accion: registrar, editar, clonar
         //dd($formAccion);
        if ($formAccion == 'cadena'){
            $cadena = Cadena::find($modelo);
                return view('muestreo.arma_form',[
                    'cadena' => $cadena,
                    'paises' => Pais::all(),
                    'calibres' => Calibre::all(),
                    'formAccion' => $formAccion,
                ]);  
        }
        if ($formAccion == 'registrar'){
            //dd($formAccion);
            return view('muestreo.muestra_form',[
                
                'formAccion' => $formAccion,
                'fecha_hoy' => date('Y-m-d'),
                
            ]);  


        }      
    } 
}
