<div class="row">
    <div class="col s12 div-fieldset">
       <fieldset>
          <legend>1. DATOS GENERALES</legend>
          <div class="row">
             <!--fecha_intervencion-->
             <div class="input-field col s6 m4 l4">
                <input type="date" id="fecha-registro" class="fecha-actual"
                   name="fecha_registro"
                   {{-- value="{{date('Y-m-d',strtotime($cadena->fecha_))}}" --}}
                >
                <label class="active" for="fecha-registro"><i class="fas fa-calendar-alt"></i> ~ FECHA DE INTERVENCION
                   <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
                </label>
             </div>
             <!--ci_pp-->
             <div class="input-field col s12 m6 l4">
                <input type="text" id="ci-pp" name="ci_pp" value="">
                <label for="ci-pp"><i class="fas fa-folder"></i> ~ CI - PP
                   <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
                </label>
             </div>
             <!--amp-->
             <div class="input-field col s12 m6 l4">
                <input type="text" id="amp" name="amp" value="">
                <label for="amp"><i class="fas fa-folder"></i> ~ AMP
                   <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
                </label>
             </div>
             <!--agencia-->
             <div class="input-field col s11">
                <input type="hidden" id="unidad-hidden" name="unidad_id"
                   value="{{isset($cadena->id) ? $cadena->unidad_id : ''}}">
                <input type="text" id="unidad-autocomplete" class="autocomplete" {{isset($cadena->id) ? 'disabled' : ''}}
                   data-input-hidden="unidad-hidden"
                   data-modelo="unidad"
                   data-url="{{route('unidades.get')}}"
                   data-btn="btn-unidad-autocomplete-reset"
                   placeholder="Escriba el nombre de la Unidad y despues seleccione alguna de las sugerencias mostradas"
                   value="{{isset($cadena->id) ? $cadena->unidad->nombre : ''}}">
                <label for="autocomplete-input"><i class="fas fa-archway"></i> ~ Autoridad Investigadora: Agencia
                   <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
                </label>
             </div>
             <div class="input-field col s1">
                <a href="" id="btn-unidad-autocomplete-reset" class="btn-autocomplete-reset"
                   data-input-hidden="unidad-hidden" data-input-autocomplete="unidad-autocomplete">
                   <i class="fas fa-times-circle fa-lg"></i>
                </a>
             </div>
          </div>
       </fieldset>
    </div>
 </div>
 
 <div class="row">
    <div class="col s12">
       <hr class="hr-2">
    </div>
 </div>