<div class="row">
   <div class="col s12 div-fieldset">
      <fieldset>
         <legend>1. Expediente</legend>
         <div class="row">
            <div class="input-field col s12 l3">
               <input type="text" id="ci-pp" readonly name="ci_pp" value="{{old('ci_pp')}}">
               <label for="nuc">C.I. - PP</label>
             </div>
            <div class="input-field col s12 l3">
               <input type="text" id="folio" name="folio">
               <label for="folio">FOLIO</label>
            </div>
            {{-- <div class="input-field col s12 l3">
                  <input type="time" id="hora" name="hora">
                  <label class="active" for="hora">HORA</label>
            </div>
            <div class="input-field col s12 l3">
                  <input type="date" id="fecha" name="fecha">
                  <label class="active" for="fecha">FECHA</label>
            </div> --}}
            <div class="input-field col s12 l3">
               <select name="tipo">
                  <option value="" disabled selected>Indique el tipo de expediente</option>
                  <option value="identificacion">1. Identificación</option>
                  <option value="investigacion">2. Investigación</option>                  
               </select>
               <label>Tipo de Expediente</label>
            </div>
            
            <div class="col s12 div-fieldset">
               <fieldset>
                  <legend>2. Proceso</legend>
                  <div class="row">
                     <div class="input-field col s12 l3">
                        <input type="text" id="nombre" name="nombre">
                        <label for="nombre">NOMBRE</label>
                     </div> 
                     <div class="input-field col s12 l3">
                        <input type="time" id="hora" name="hora">
                        <label class="active" for="hora">HORA</label>
                     </div>
                     <div class="input-field col s12 l3">
                        <input type="date" id="fecha" name="fecha">
                        <label class="active" for="fecha">FECHA</label>
                     </div>


                     <div class="col s12">
                        <fieldset>
                           <legend>3. Primera etapa - Codificación</legend>
                           <div class="row">
                              <div class="col s12 right-align">
                                 @component('componentes.componente_nota_2')
                                    @slot('icono')
                                       <i class="fas fa-sticky-note"></i>
                                    @endslot
                                    @slot('mensaje')
                                       Esta etapa asignara los CIM (Contro Interno de Muestra) a los indicios
                                    @endslot
                                 @endcomponent
                              </div>

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
                              {{-- <div class="input-field col s12 m12 l4">
                                 <input form="form-codificacion-registro" id="folio_interno" type="text" name="folio_interno" value="{{ isset($prestamo->id) ? $prestamo->prestamo_ordena : '' }}">
                                 <label for="folio_interno">FOLIO INTERNO
                                    <span class="asterisco-obligatorio">*</span>
                                    <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
                                 </label>
                              </div> --}}
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
                           </div>
                        </fieldset>
                     </div>

                  </div>
               </fieldset>
            </div>


         </div>
      </fieldset>
   </div>
   
   {{-- <div class="col s12 div-fieldset">
      <fieldset>
         <legend>2. Proceso</legend>
         <div class="input-field col s12 l3">
            <input type="text" id="nombre" name="nombre">
            <label for="nombre">NOMBRE</label>
        </div> 
        <div class="input-field col s12 l3">
            <input type="time" id="hora" name="hora">
            <label class="active" for="hora">HORA</label>
        </div>
        <div class="input-field col s12 l3">
            <input type="date" id="fecha" name="fecha">
            <label class="active" for="fecha">FECHA</label>
        </div>
      </fieldset>
   </div> --}}
   
   {{-- @include('muestreo1.codificacion.codificacion_datos') --}}
   
   <div class="col s12">
      <hr class="hr-main">
   </div>
   <!--Boton prestamo-->
   <div class="col s12 m4 l1 offset-m8 offset-l11">
      <button form="form-codificacion-registro" type="submit" class="btn-guardar" id="btn-registrar" style="display: inline-block !important; width:100%;" name="btn_registrar" value="registrar">
         {{$formAccion}}
      </button>
   </div>
   <!--Boton pdf-->
   <div class="col s12 m4 l1 offset-m8 offset-l11 ocultar">
      <a class="a-btn" id="btn-prestamo-pdf" style="display: inline-block !important; width:100%;" href="" target="_blank">
         <span>PDF</span> ~ <i class="fas fa-file-pdf"></i>
      </a>
   </div>
</div>