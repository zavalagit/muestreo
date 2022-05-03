<div class="col s12 div-fieldset">
   <fieldset>
      <legend>2. IDENTIDAD ~ (ÚNICAMENTE INDICIOS QUE PRESENTEN LA MISMA NATURALEZA)</legend>
      <div class="row">
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
         <!--div de indicios-->
         <div class="col s12">
            @if ( request()->route()->named('cadenas.create') )
               @include('cadena.form_4_1_descripcion')
            @elseif( request()->route()->named('cadenas.edit') )
               @foreach ($cadena->indicios->values() as $key => $indicio)
                  @include('cadena.form_4_1_descripcion')
               @endforeach   
            @endif
         </div>
      </div>
    </fieldset>
  </div>
  
  
  <!--arma-->
  {{-- @if (!in_array(Auth::user()->unidad_id,[1,2])) --}}
    {{-- <div class="row">
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
    </div> --}}
  {{-- @endif --}}
  
  
  <!--tabla checkbox arma-->
  {{-- @include('cadena.cadena_form_23_tabla_checkbox_arma') --}}
  
  
  
  <div class="row">
    <div class="col s12">
      <hr class="hr-2">
    </div>
  </div>


  <div class="row">
   <div class="col s12 m12 l2 offset-l10">
       <button type="submit" class="btn-guardar">Guardar</button>
   </div>
</div>