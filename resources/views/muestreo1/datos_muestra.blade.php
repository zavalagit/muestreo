{{-- <div class="row">
    @component('componentes.componente_seccion_titulo')
        @slot('mensaje','1. DATOS DE LA PETICIÓN ~ ')
        @slot('icono','fas fa-edit')
    @endcomponent
</div> --}}

@php
    $readonly = false;
    if ($formAccion == 'editar') {
        $readonly = ( date('Y-m-d',strtotime($peticion->created_at)) != date('Y-m-d') ) ? true : false;
    }
    elseif($formAccion == 'continuar'){
        $readonly = true;
    }
@endphp

<div class="row">
    <div class="col s12 div-fieldset">
        <fieldset>
            <legend>1. Datos de Codificación de Items</legend>
            <div class="row">
                <!--nuc-->
                <div class="input-field col s12 m6 l3">
                    <input id="nuc" type="text" name="nuc" class="{{$formAccion == 'continuar' ? 'readonly' : ''}}" value="{{isset($peticion) ? $peticion->nuc : ''}}">
                    <label for="nuc"><i class="fas fa-folder"></i> ~ FOLIO INTERNO
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{$formAccion == 'continuar' ? 'ocultar' : ''}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion != 'editar' ? 'ocultar' : ''}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--fecha_peticion-->
                <div class="input-field col s12 m6 l3">
                    <input type="date" id="fecha_peticion" class="center-align {{$readonly ? 'readonly' : ''}}" name="fecha_peticion" value="{{isset($peticion) ? $peticion->fecha_peticion : ''}}">
                    <label class="active" for="fecha_peticion"><i class="fas fa-calendar-alt"></i> ~ FECHA DE INICIO
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                
                <!--no. oficio-->
                <div class="input-field col s12 m6 l3">
                    <input type="text" id="oficio_numero" class="{{$formAccion == 'continuar' ? 'readonly' : ''}}" name="oficio_numero" value="{{isset($peticion) ? $peticion->oficio_numero : ''}}">
                    <label for="oficio_numero">NO. OFICIO
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{$formAccion == 'continuar' ? 'ocultar' : ''}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion != 'editar' ? 'ocultar' : ''}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--folio interno-->
                <div class="input-field col s12 m6 l3">
                    <input type="text" id="folio-interno" class="{{$formAccion == 'continuar' ? 'readonly' : ''}}" name="folio_interno" value="{{isset($peticion) ? $peticion->folio_interno : ''}}">
                    <label for="folio-interno">FOLIO INTERNO O NÚMERO DE CONTROL EN LIBRO
                        <span class="asterisco-campo-editar asterisco-etapa-uno {{$formAccion != 'editar' ? 'ocultar' : ''}}"><strong>*</strong></span>
                    </label>
                </div>
                <!--M.P. solicita-->
                <div class="input-field col s12 m12 l4">
                    <input type="text" id="sp_solicita" class="{{$readonly ? 'readonly' : ''}}" name="sp_solicita" value="{{isset($peticion) ? $peticion->sp_solicita : ''}}">
                    <label for="sp_solicita"><i class="fas fa-user-tie"></i> ~ M. P. o Servidor Público Solicita
                        <span class="asterisco-campo-obligatorio asterisco-etapa-uno {{in_array($formAccion,['registrar','clonar']) || !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                        <span class="asterisco-campo-editar {{$formAccion == 'editar' && !$readonly ? '' : 'ocultar'}}"><strong>*</strong></span>
                    </label>
                </div>
                
                
                
                
                
                
                
                
               
               
                

                <div class="col s12 m12 l1 offset-l11 {{$formAccion != 'registrar' ? 'ocultar' : ''}}">
                    <button type="submit" id="btn-peticion-etapa-uno" class="btn-peticion-etapa btn-guardar" name="btn_etapa" value="etapa_uno">{{$formAccion}}</button>
                </div>
            </div>
        </fieldset>
    </div>
</div>