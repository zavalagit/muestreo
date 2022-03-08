<div class="row">
  <!--titulo seccion-->
  @component('componentes.seccion_form')
    @slot('mensaje','8. ANEXO 4 ~ ')
    @slot('icono','fas fa-edit')
  @endcomponent
  <!--textarea-->
  <div class="input-field col s12">
     {{-- <p><b>SEÑALE LAS CONDICIONES EN LAS QUE SE ENCUENTRAN LOS EMBALAJES. CUANDO ALGUNO DE ELLOS PRESENTE ALTERACIÓN, DETERIORO O CUALQUIER OTRA ANOMALÍA, ESPECIFIQUE DICHA CONDICIÓN *</b></p> --}}
      <textarea id="embalaje" class="materialize-textarea" name="anexo_4">{{$cadena->embalaje}}</textarea>
      <label for="embalaje"><i class="fas fa-box-open"></i> ~ SEÑALE LAS CONDICIONES EN LAS QUE SE ENCUENTRAN LOS EMBALAJES. CUANDO ALGUNO DE ELLOS PRESENTE ALTERACIÓN, DETERIORO O CUALQUIER OTRA ANOMALÍA, ESPECIFIQUE DICHA CONDICIÓN
        <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
      </label>
  </div>
 </div>