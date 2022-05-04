<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodificacionRequest extends FormRequest
{
    public $reglas;

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
        $this->set_rules();
        if ( $this->route('codificacion') == NULL ) return $this->reglas['registrar'];
        // if ( $this->route('formAccion') == 'reingresar' ) return $this->request->has('reingreso_multiple') ? $this->reglas['reingreso'] : array_collapse( $this->reglas );
        // if ( $this->route('formAccion') == 'editar' ) {
        //     $prestamo = $this->route('prestamo');
        //     return $prestamo->estado == 'activo' ? $this->reglas['prestamo'] : array_collapse( $this->reglas );                    
        // }    

    }

    public function set_rules(){
        $this->reglas = [
            'registrar' => [
                'indicios' => $this->route('codificacion') == NULL ? 'required_without:cadenas' : '',
                'cadenas' => $this->route('codifcacaion') == NULL ? 'required_without:indicios' : '',
                'codificacion_hora' => 'required',
                'codificacion_fecha' => 'required|date|before_or_equal:today',
                'folio_interno' => 'required',
                'nombre_bitacora' => 'required',
                'numero_libro' => 'required',
                'registra_perito' => 'required',
                'supervisor_autoriza' => 'required',
            ],
            
        ];
    }

    public function messages(){
        return [
            //registrar formulario codificacion
            'indicios.required_without' => 'Seleccione al menos un indicio para registrar.',
            'cadenas.required_without' => 'Seleccione al menos un indicio para registrar.',
            'folio_interno.required' => 'El campo "Folio" es requerido.',
            'nombre_bitacora.required' => 'El campo "Bitacora" es requerido.',
            'numero_libro.required' => 'El campo "No. libro" es requerido.',
            'registra_perito.required' => 'Indique el Perito que realiza el registro.',
            'supervisor_autoriza.required' => 'Indique el Supervisor que Autoriza su registro.',
            
        ];
    }
}
