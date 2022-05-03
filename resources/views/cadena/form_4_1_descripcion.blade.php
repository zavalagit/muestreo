<div class="row div-indicio">
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
    <!--cantidad-->
    <div class="input-field col s12 m12 l1">
       <input type="text" id="cantidad" class="input-cantidad center-align" name="cantidad[]" value="{{(isset($indicio)) ? $indicio->cantidad : ''}}">
       <label for="cantidad"><i class="fas fa-fingerprint"></i> ~ CANTIDAD
          <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
       </label>
    </div>
    <!--descripcion del indicio-->
    <div class="input-field col s12 m12 l9">
       <textarea id="descripcion" class="materialize-textarea" name="descripcion[]">{{(isset($indicio) ? $indicio->descripcion : '')}}</textarea>
       <label for="descripcion"><i class="fas fa-edit"></i> ~ DESCRIPCIÓN
          <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
       </label>
    </div>
 
 
    <!--embalaje-->
    <div class="input-field col s12 m12 l2">
       <input type="text" id="embalaje" class="input-embalaje center-align" name="embalaje[]" value="{{(isset($indicio)) ? $indicio->embalaje : ''}}">
       <label for="embalaje"><i class="fas fa-fingerprint"></i> ~ EMBALAJE
          <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
       </label>
    </div>
 
    <!--observaciones-->
    <div class="input-field col s12 m12 l8">
       <input type="text" id="observaciones" class="input-observaciones center-align" name="observaciones[]" value="{{(isset($indicio)) ? $indicio->observaciones : ''}}">
       <label for="observaciones"><i class="fas fa-fingerprint"></i> ~ OBSERVACIONES
          <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
       </label>
    </div>
 </div>
 
  