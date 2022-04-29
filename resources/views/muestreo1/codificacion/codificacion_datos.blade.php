{{-- <div class="row"> --}}
   <div class="col s12 div-fieldset">
      <fieldset>
         <legend>2. Datos del Prestamo</legend>
         <!--hora prestamo-->
         <div class="row">
            <div class="input-field col s12 m6 l4">
               <input type="time" class="{{isset($prestamo->id) ? '' : 'hora-actual'}}" id="hora" name="prestamo_hora" value="{{ isset($prestamo->id) ? date('H:i:s',strtotime($prestamo->prestamo_hora)) : '' }}">
               <label class="active" for="hora">HORA
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
            <!--fecha prestamo-->
            <div class="input-field col s12 m6 l4">
               <input type="date" class="{{isset($prestamo->id) ? '' : 'fecha-actual'}}" id="fecha" name="prestamo_fecha" value="{{ isset($prestamo->id) ? date('Y-m-d',strtotime($prestamo->prestamo_fecha)) : '' }}">
               <label class="active" for="hora">FECHA
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
            <!--FOLIO INTERNO-->
            <div class="input-field col s12 m12 l4">
               <input id="prestamo-autoriza" type="text" name="prestamo_autoriza" value="{{ isset($prestamo->id) ? $prestamo->prestamo_ordena : '' }}">
               <label for="prestamo-autoriza">FOLIO INTERNO
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
            <!--NOMBRE DE LA BITACORA-->
            <div class="input-field col s12 m12 l4">
               <input id="prestamo-autoriza" type="text" name="prestamo_autoriza" value="{{ isset($prestamo->id) ? $prestamo->prestamo_ordena : '' }}">
               <label for="prestamo-autoriza">BITACORA
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
            <!--NUMERO DE LIBRO-->
            <div class="input-field col s12 m12 l4">
               <input id="prestamo-autoriza" type="text" name="prestamo_autoriza" value="{{ isset($prestamo->id) ? $prestamo->prestamo_ordena : '' }}">
               <label for="prestamo-autoriza">NUMERO DE LIBRO
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
            <!--perito que registra-->
            <div class="input-field col s12 m12 l6">
               <input id="prestamo-autoriza" type="text" name="prestamo_autoriza" value="{{ isset($prestamo->id) ? $prestamo->prestamo_ordena : '' }}">
               <label for="prestamo-autoriza">PERITO REGISTRA
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
            <!--supervisor-->
            <div class="input-field col s12 m12 l6">
               <input id="prestamo-autoriza" type="text" name="prestamo_autoriza" value="{{ isset($prestamo->id) ? $prestamo->prestamo_ordena : '' }}">
               <label for="prestamo-autoriza">SUPERVISOR
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
         </div>
      </fieldset>
   </div>
   
   {{--  <div class="col s12 div-fieldset">
      <fieldset class="fieldset-subseccion">
         <legend>2.1. Responsable de bodega (Entrega)</legend>
         <div class="input-field col s1">
            <a href="" class="btn-limpiar-input-autocomplete" 
               data-input-hidden="prestamo-responsable-bodega"
               data-input-autocomplete="prestamo-responsable-bodega-autocomplete"> 
               <i class="fas fa-times-circle fa-lg" ></i>
            </a>
         </div>
         <div class="input-field col s11">
            <input type="hidden" id="prestamo-responsable-bodega" name="prestamo_responsable_bodega"  value="{{ isset($prestamo->id) ? $prestamo->user1_id : Auth::user()->id }}">
            <input type="text" id="prestamo-responsable-bodega-autocomplete" class="autocomplete" readonly data-input-hidden="prestamo-responsable-bodega" data-tabla="users" data-user-tipo="responsable_bodega" data-user-fiscalia="{{Auth::user()->fiscalia_id}}" value="{{ isset($prestamo->id) ? "{$prestamo->user1->folio} - {$prestamo->user1->name}" : Auth::user()->folio.' - '.Auth::user()->name }}">
            <label for="reingreso-responsable-bodega-autocomplete">Responsable de Bodega
               <span class="asterisco-obligatorio">*</span>
               <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
            </label>
         </div>
      </fieldset>
   </div>  --}}
   
   {{--  <div class="col s12 div-fieldset">
      <fieldset class="fieldset-subseccion">
         <legend>2.2. Resguardante (Recibe)</legend>
         <div class="input-field col s1">
            <a href="" class="btn-limpiar-input-autocomplete"
               data-input-hidden="prestamo-resguardante"
               data-input-autocomplete="prestamo-resguardante-autocomplete">
               <i class="fas fa-times-circle fa-lg" ></i>
            </a>
         </div>
         <div class="input-field col s11">
            <input type="hidden" id="prestamo-resguardante" name="prestamo_resguardante" value="{{ isset($prestamo->id) ? $prestamo->perito1_id : '' }}">
            <input type="text" class="autocomplete" id="prestamo-resguardante-autocomplete" data-tabla="peritos" data-input-hidden="prestamo-resguardante" value="{{ isset($prestamo->id) ? "{$prestamo->perito1->folio} - {$prestamo->perito1->nombre}" : '' }}">
            <label for="prestamo-resguardante-autocomplete">Resguardante
               <span class="asterisco-obligatorio">*</span>
               <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
            </label>
         </div>
      </fieldset>
   </div>  --}}
{{-- </div> --}}




