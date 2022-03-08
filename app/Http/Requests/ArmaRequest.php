<?php

namespace App\Http\Requests;

// use App\Arma;
use Illuminate\Foundation\Http\FormRequest;

class ArmaRequest extends FormRequest
{
    public function __construct()
    {
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
        return [
            'clasificacion.*' => 'required',
            'tipo_arma.*' => 'required',
            'fabricante.*' => 'required',
            'modelo.*' => 'required',
            'serie.*' => 'required',
            'calibre.*' => 'required',
            'pais.*' => 'required',
            'importador.*' => 'required',
            'domicilio.*' => 'required',
        ];


        
    }

    /**
     *  mensaje de error por cada atributo y por cada regla de validación que no fue aprobada.
     * 
     */
    public function messages(){
        return [
            'clasificacion.*.required' => 'Seleccione una CLASIFICACION',
            'tipo_arma.*.required' => 'El campo "TIPO DE ARMA" es requerido.',
            'fabricante.*.required' => 'El campo "FABRICANTE" es requerido.',
            'modelo.*.required' => 'El campo "MODELO" es requerido.',
            'serie.*.required' => 'El campo "SERIE" es requerido.',
            'calibre.*.required' => 'El campo "CALIBLE" es requerido.',
            'pais.*.required' => 'El campo "PAIS" es requerido.',
            'importador.*.required' => 'El campo "IMPORTADOR" es requerido.',
            'domicilio.*.required' => 'El campo "DOMICILIO" es requerido.',
        ];
    }
}
