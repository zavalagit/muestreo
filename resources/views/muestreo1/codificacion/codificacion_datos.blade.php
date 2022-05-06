{{-- <div class="row"> --}}
   <div class="col s12 div-fieldset">
      <fieldset>
         <legend>2. Expediente</legend>
         <!--hora registro de codificacion-->
         <div class="row">
            <div class="input-field col s12 m6 l4">
               <input form="form-codificacion-registro" type="time" class="{{isset($prestamo->id) ? '' : 'hora-actual'}}" id="hora" name="codificacion_hora" value="{{ isset($prestamo->id) ? date('H:i:s',strtotime($prestamo->prestamo_hora)) : '' }}">
               <label class="active" for="hora">HORA
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
            <!--fecha registro de codificacion-->
            <div class="input-field col s12 m6 l4">
               <input form="form-codificacion-registro" type="date" class="{{isset($prestamo->id) ? '' : 'fecha-actual'}}" id="fecha" name="codificacion_fecha" value="{{ isset($prestamo->id) ? date('Y-m-d',strtotime($prestamo->prestamo_fecha)) : '' }}">
               <label class="active" for="fecha">FECHA
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
            <!--FOLIO INTERNO registro de codificacion-->
            <div class="input-field col s12 m12 l4">
               <input form="form-codificacion-registro" id="folio_interno" type="text" name="folio_interno" value="{{ isset($prestamo->id) ? $prestamo->prestamo_ordena : '' }}">
               <label for="folio_interno">FOLIO INTERNO
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
            <!--NOMBRE DE LA BITACORA registro de codificacion-->
            <div class="input-field col s12 m12 l4">
               <input form="form-codificacion-registro" id="nombre_bitacora" type="text" name="nombre_bitacora" value="{{ isset($prestamo->id) ? $prestamo->prestamo_ordena : '' }}">
               <label for="nombre_bitacora">BITACORA
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
            <!--NUMERO DE LIBRO registro de codificacion-->
            <div class="input-field col s12 m12 l4">
               <input form="form-codificacion-registro" id="numero_libro" type="text" name="numero_libro" value="{{ isset($prestamo->id) ? $prestamo->prestamo_ordena : '' }}">
               <label for="numero_libro">NUMERO DE LIBRO
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
          
      </fieldset>
   </div>
   
   <!--perito que registra-->
    <div class="col s12 div-fieldset">
      <fieldset class="fieldset-subseccion">
         <legend>2.1. Perito (Registra)</legend>
         
         <div class="input-field col s11">
            <input type="hidden" id="registra_perito" name="registra_perito"  value="{{ isset($codificacion->id) ?  $codificacion->perito_id : Auth::user()->id }}">
            <input type="text" id="registra-perito-autocomplete" class="autocomplete" readonly data-input-hidden="perito-registra" data-tabla="users" value="{{ isset($codificacion->id) ? "{$codificacion->perito->folio} - {$codificacion->perito->name}" : Auth::user()->folio.' - '.Auth::user()->name }}">
            <label for="reingreso-responsable-bodega-autocomplete">Responsable de Bodega
               <span class="asterisco-obligatorio">*</span>
               <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
            </label>
         </div>
      </fieldset>
   </div>
   <!--supervisor-->
   <div class="col s12 div-fieldset">
      <fieldset class="fieldset-subseccion">
         <legend>2.2.Supervisor (Autoriza)</legend>
        
         <div class="input-field col s11">
            <input autocomplete="off" type="hidden" id="supervisor_autoriza" name="supervisor_autoriza" value="{{ isset($codificacion->id) ? $codificacion->supervisor_id : '' }}">
            <input autocomplete="off" type="text" class="autocomplete" id="supervisor-autoriza-autocomplete" data-tabla="users" data-input-hidden="supervisor_autoriza" value="{{ isset($codificacion->id) ? "{$codificacion->supervisor->folio} - {$codificacion->supervisor->name}" : '' }}">
            <label for="prestamo-resguardante-autocomplete">Ingrese Nombre o Folio
               <span class="asterisco-obligatorio">*</span>
               <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
            </label>
         </div>
      </fieldset>
   </div> 
   
{{-- </div> --}}




