{{-- <div class="row"> --}}
   <div class="col s12 div-fieldset">
      <fieldset >
         <legend>1. Datos del expediente y proceso</legend>
         <!--NOMBRE DEL PROCESO-->
         <div class="row">
            <div class="input-field col s12 m6 l12">
               <input form="form-codificacion-registro" id="nombre_proceso" type="text" name="nombre_proceso"  value="{{ isset($codificacion->id) ? $codificacion->prestamo_ordena : '' }}">
               <label  for="nombre_proceso">NOMBRE DEL PROCESO
                  <span class="asterisco-obligatorio">*</span>
                  <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
               </label>
            </div>
            
         
      </fieldset>
   </div>
   
   
   
   
{{-- </div> --}}




