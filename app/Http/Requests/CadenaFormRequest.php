<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\in_array_contains;

class CadenaFormRequest extends FormRequest
{
    public function __construct(){
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $arma = ['si','no'];
        $reglas =  [
            #1. Datos generales
            'nuc' => 'required|min:13',
            'unidad' => 'required',
            'intervencion_lugar' => 'required',
            'intervencion_hora' => 'required',
            'intervencion_fecha' => 'required|before_or_equal:today',
            'motivo' => 'required',
            #2. Identidad
            // 'cadena_naturaleza' => 'required',
            'identificador.*' => 'required',
            'descripcion.*' => 'required',
            'ubicacion.*' => 'required',
            'recoleccion_hora.*' => 'required',
            'recoleccion_fecha.*' => 'required|after_or_equal:intervencion_fecha|before_or_equal:today',
            #3. Documentación
            'escrito' => 'required',
            'fotografico' => 'required',
            'croquis' => 'required',
            'otro' => 'required',
            'especifique' => 'required_if:otro,si', 
            #4. Recoleccion
            'recoleccion.*' => 'required',
            #6. servidores publicos
            'sp_etapa.*' => 'required',
            #7. Traslado
            'traslado_via' => 'required',
            'traslado_condiciones' => 'required',
            'traslado_recomendaciones' => 'required_if:traslado_recomendaciones,si',
            #8. Anexo 4
            'embalaje' => 'required',
        ];

        #intervencion
        $intervencion_fecha = $this->request->get('intervencion_fecha'); // Get the input value
        if($intervencion_fecha == date('Y-m-d')){
            $reglas['intervencion_hora'] = "required|before_or_equal:".date('H:i:s');
        }
        #recoleccion
        $recoleccion_fecha = $this->request->get('recoleccion_fecha'); // Get the input value
        //si una "fecha de recoleccion" es igual a una "fecha de intervencion"
        if( in_array($intervencion_fecha,$recoleccion_fecha) ){
            //si el motivo es "aportacion", entonces la "hora de recoleccion" puede ser igual a la "hora de intervencion", pero menor a la hora actual
            if( $this->request->get('motivo') == 'aportacion' )
                $reglas['recoleccion_hora.*'] = "required|after_or_equal:intervencion_hora|before_or_equal:".date('H:i:s');
            //en caso de que no es aportacion, entonces la "hora de recoleccion" debe ser mayor a la "hora de intervencion", pero menor a la hora actual
            else
                $reglas['recoleccion_hora.*'] = "required|after:intervencion_hora|before_or_equal:".date('H:i:s');
        //Si hay una "fecha de recoleccion" igual a la fecha actual, dado que la "fecha de intervencion" es menor a la fecha actual
        }elseif( in_array(date('Y-m-d'),$recoleccion_fecha) ){
            //la "hora de intervencion" debe ser menor a la hora actual
            $reglas['recoleccion_hora.*'] = "required|before_or_equal:".date('H:i:s');
        }
        #arma
        //Si indica que alguno de los indicios descritos es un arma
        if( $this->request->get('cadena_arma') == 'si' ){
            $reglas['indicio_arma'] = new in_array_contains;
        }


        return $reglas;
    }
    /**
     *  mensaje de error por cada atributo y por cada regla de validación que no fue aprobada.
     * 
     */
    public function messages(){
        return [
            #1. Datos generales
            'nuc.required' => 'El campo "NUC" es requerido.',
            'nuc.min' => 'El campo "NUC" debe contener al menos 13 caracteres.',
            'unidad.required' => 'El campo "UNIDAD" es requerido.',
            'intervencion_lugar.required' => 'El campo "LUGAR DE INTERVENCIÓN" es requerido.',
            'intervencion_hora.required' => 'El campo "HORA DE INTERVENCIÓN" es requerido.',
            'intervencion_hora.before_or_equal' => 'La "HORA DE INTERVENCIÓN" debe ser menor o igual a '.date('H:i:s'),
            'intervencion_fecha.required' => 'El campo "FECHA DE INTERVENCIÓN" es requerido.',
            'intervencion_fecha.before_or_equal' => 'El campo "FECHA DE INTERVENCIÓN" debe ser menor o igual a '.date('d-m-Y'),
            'motivo.required' => 'El campo "MOTIVO DEL REGISTRO" es requerido.',
            #2. Identidad
            'cadena_naturaleza.required' => "Indique la «naturaleza de los indicios» en el apartado 2.",
            'identificador.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "IDENTIFICADOR" es requerido.',
            'descripcion.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "DESCRIPCIÓN" es requerido.',
            'ubicacion.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "UBICACIÓN DEL LUGAR" es requerido.',
            'recoleccion_hora.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "HORA DE RECOLECCIÓN" es requerido.',
            'recoleccion_fecha.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "FECHA DE RECOLECCIÓN" es requerido.',
            'recoleccion_fecha.*.after_or_equal' => '[APARTADO "2"]. La "FECHA DE RECOLECCIÓN" debe ser mayor o igual a la "FECHA DE INTERVENCIÓN".',
            'recoleccion_fecha.*.before_or_equal' => '[APARTADO "2"]. La "FECHA DE RECOLECCIÓN" debe ser menor o igual a '.date('d-m-Y'),
            'escrito.required' => 'Verifique el apartado "2. DOCUMENTACIÓN" el campo "ESCRITO" es requerido.',
            'fotografico.required' => 'Verifique el apartado "2. DOCUMENTACIÓN" el campo "FOTOGRÁFICO" es requerido.',
            'croquis.required' => 'Verifique el apartado "2. DOCUMENTACIÓN" el campo "CROQUIS" es requerido.',
            'otro.required' => 'Verifique el apartado "2. DOCUMENTACIÓN" el campo "OTRO" es requerido.',
            'etapa.*.required' => 'Verifique el apartado "5. SERVIDORES PÚBLICOS" el campo "ETAPA" es requerido.',
            'traslado.required' => 'Verifique el apartado "6. TRASLADO" el campo "VÍA" es requerido.',
            'trasladoCondiciones.required' => 'Verifique el apartado "6. TRASLADO" el campo "CONDICIONES DEL TRASLADO" es requerido.',
            'embalaje.required' => 'Verifique el apartado "ANEXO 4".',
            #6. Servidor público
            'sp_etapa.*.required' => 'El campo «etapa» es requerido en el apartado 6.',

        ];
    }
}
