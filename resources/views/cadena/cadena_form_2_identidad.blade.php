<div class="row">
  @component('componentes.seccion_form')
    @slot('mensaje','2. IDENTIDAD (ÚNICAMENTE REGISTRAR INDICIOS QUE PRESENTEN LA MISMA NATURALEZA) ~ ')
    @slot('icono','fas fa-edit')
  @endcomponent
  <!--naturaleza-->
  {{-- <div class="input-field col s12 m12 l4">
    <select id="select-cadena-naturaleza" name="cadena_naturaleza">
      <option value="" disabled selected>Indica la naturaleza de los indicios a describir*</option>
      @foreach ($naturalezas->sortBy('nombre')->values() as $i => $naturaleza)
        <option value="{{$naturaleza->id}}" {{($cadena->naturaleza_id == $naturaleza->id) ? 'selected' : ''}}>{{$i+1}}.- {{$naturaleza->nombre}}</option>
      @endforeach
    </select>
    <label>Indica la naturaleza de los indicios a describir*</label>
  </div> --}}
  <!--btn agregar indicio-->
  <div class="col s12 l2 offset-l10">
    <a href="" id="add-desc" style="color: #152f4a; display: block;" class="right-align">
      <i class="fas fa-plus-circle fa-2x" style="color: #c09f77;"></i><b><span style="vertical-align: super !important"> - AGREGAR RUBRO</span></b>
    </a>
  </div>
  <!--hr-->
  <div class="col s12">
    <hr class="hr-1">
  </div>
</div>

<!--div de indicios-->
@if ( $formAccion == 'registrar' )
   @include('cadena.cadena_form_22_descripcion_indicios')
@elseif( in_array($formAccion,['editar','clonar']) )
   @foreach ($cadena->indicios->values() as $key => $indicio)
      @include('cadena.cadena_form_22_descripcion_indicios')
   @endforeach   
@endif

@if (!in_array(Auth::user()->unidad_id,[1,2]))
  <div class="row">
    <div class="col s12">
      <hr class="hr-1">
    </div>
    <div class="col s12 m12 l4">
      <span style="font-size: 16px;">
        <strong><b>¿Alguno de los indicios que describe es un arma?</b></strong>
        <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
      </span> 
    </div>
    <div class="col s6 m6 l2">
      <label for="arma-si">
        <input type="radio" id="arma-si" class="cadena-arma" {{($formAccion != 'registrar') ? ( $cadena->indicios->where('indicio_is_arma',true)->count() ? 'checked' : '') : ''}}  name="cadena_arma" value="si" />
        <span>Si</span>
      </label>
    </div>
    <div class="col s6 m6 l2">
      <label for="arma-no">
        <input type="radio" id="arma-no" class="cadena-arma" {{($formAccion == 'registrar') ? 'checked' : ''}} {{($formAccion == 'editar') ? ( $cadena->indicios->where('indicio_is_arma',true)->count() ? '' : 'checked') : ''}} name="cadena_arma" value="no" />
        <span>No</span>
      </label>
    </div>
  </div>
@endif


<!--tabla checkbox arma-->
@include('cadena.cadena_form_23_tabla_checkbox_arma')



<div class="row">
  <div class="col s12">
    <hr class="hr-2">
  </div>
</div>