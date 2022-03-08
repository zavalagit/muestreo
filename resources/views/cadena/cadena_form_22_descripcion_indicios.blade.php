<div class="row div-indicio" style="border: 3px solid rgba(21,47,74,1); padding-top: 10px !important; margin: 0px 12px !important;">
   <div class="col s4 m4 l1 offset-l9" style="padding-right: 0">
      <div style="background-color:rgba(21,47,74,0.8) !important; padding: 8px 15px;">
         <span class="div-indicio-indice" style="color:#fff !important; font-weight: bold;">{{isset($key) ? $key+1 : 1}}</span>
      </div>
   </div>
   <!--acciones-->
   <div class="col s8 m8 l2" style="padding-left: 0">
      <div class="right-align" style="background-color:rgba(21,47,74,0.8) !important; padding: 8px 15px; ">
         <a href="" class="clonar-indicio"><i class="fas fa-clone" style="color:#c6c6c6;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;   
         <a href="" class="x-desc hide"><i class="fas fa-times-circle fa-lg" style="color:#c6c6c6;"></i></a>
      </div>
   </div>
   <!--identificador-->
   <div class="input-field col s12 m12 l2">
      <input type="text" id="identificador" class="input-identificador center-align" name="identificador[]" value="{{(isset($indicio)) ? $indicio->identificador : ''}}">
      <label for="identificador"><i class="fas fa-fingerprint"></i> ~ IDENTIFICADOR
         <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
      </label>
   </div>
   <!--descripcion del indicio-->
   <div class="input-field col s12 m12 l10">
      <textarea id="descripcion" class="materialize-textarea" name="descripcion[]">{{(isset($indicio) ? $indicio->descripcion : '')}}</textarea>
      <label for="descripcion"><i class="fas fa-edit"></i> ~ DESCRIPCIÓN
         <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
      </label>
   </div>
   <!--ubicacion del lugar-->
   <div class="input-field col s12 m12 {{(Auth::user()->unidad_id == 1) ? 'l6' : 'l12'}}">
      <textarea id="ubicacion" class="materialize-textarea" name="ubicacion[]">{{(isset($indicio) ? $indicio->indicio_ubicacion_lugar : '')}}</textarea>
      <label for="ubicacion"><i class="fas fa-map-marker-alt"></i> ~ UBICACIÓN DEL LUGAR
         <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
      </label>
   </div>
   <!--recolectado de...-->
   @if (Auth::user()->unidad_id == 1)
   <div class="input-field col s12 m12 l6">
      <textarea id="recolectado_de" class="materialize-textarea" name="recolectado_de[]">{{(isset($indicio) ? $indicio->recolectado_de : '')}}</textarea>
      <label for="recolectado_de">RECOLECTADO DE
         <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
      </label>
   </div>
   @endif
   <!--hora de recoleccion-->
   <div class="input-field col s6 m6 l2">
      <input id="hora-rec" type="time" class="center-align" name="recoleccion_hora[]" value="{{(isset($indicio) ? date('H:i',strtotime($indicio->hora)) : '')}}">
      <label class="active" for="hora-rec"><i class="fas fa-clock"></i> ~ HORA DE RECOLECCIÓN
         <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
      </label>
   </div>
   <!--fecha de recoleccion-->
   <div class="input-field col s6 m6 l2">
      <input id="fecha-rec" type="date" class="center-align" name="recoleccion_fecha[]" value="{{(isset($indicio) ? $indicio->fecha : '')}}">
      <label class="active" for="fecha-rec"><i class="fas fa-calendar-alt"></i> ~ FECHA DE RECOLECCIÓN
         <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
      </label>
   </div>
   <!--estado del indicio-->
   <div class="input-field col s12 m6 l4">
      <input id="estado_indicio" type="text" name="estado_indicio[]" value="{{(isset($indicio) ? $indicio->condicion : '')}}">
      <label for="estado_indicio">ESTADO DEL INDICIO</label>
   </div>
   <!--observacion en etiqueta-->
   <div class="input-field col s12 m6 l4">
      <textarea id="observacion" class="materialize-textarea" name="observacion[]">{{(isset($indicio) ? $indicio->observacion : '')}}</textarea>
      <label for="observacion">OBSERVACIÓN EN ETIQUETA</label>
   </div>
</div>

 