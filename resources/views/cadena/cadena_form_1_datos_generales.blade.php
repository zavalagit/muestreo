<div class="row">
   <!--titulo seccion-->
   @component('componentes.seccion_form')
      @slot('mensaje','1. DATOS GENERALES ~ ')
      @slot('icono','fas fa-edit')
   @endcomponent
  
  <!--unidad-->
  <div class="input-field col s11">
    <input type="hidden" id="unidad-hidden" name="unidad" value="{{isset($cadena->id) ? $cadena->unidad_id : ''}}">
    <input type="text" id="unidad-autocomplete" class="autocomplete"
      {{isset($cadena->id) ? 'disabled' : ''}}
      data-input-hidden="unidad-hidden"
      data-modelo="unidad"
      data-url="{{route('get_modelo_unidad')}}"
      data-btn="btn-unidad-autocomplete-reset"
      placeholder="Escriba el nombre de la Unidad y despues seleccione alguna de las sugerencias mostradas"
      value="{{isset($cadena->id) ? $cadena->unidad->nombre : ''}}"
    >
    <label for="autocomplete-input"><i class="fas fa-archway"></i> ~ UNIDAD ADMINISTRATIVA
      <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
    </label>
  </div>
  <div class="input-field col s1">
    <a href="" id="btn-unidad-autocomplete-reset" class="btn-autocomplete-reset" 
       data-input-hidden="unidad-hidden"
       data-input-autocomplete="unidad-autocomplete">
       <i class="fas fa-times-circle fa-lg" ></i>
    </a>
  </div>
   {{-- <div class="input-field col s12 m12 l12">
    <select name="unidad">
      <option value="" disabled selected></option>
      @foreach ($unidades as $unidad)
      <option value="{{$unidad->id}}" {{($cadena->unidad_id == $unidad->id) ? 'selected' : ''}}>{{$unidad->nombre}}</option>
      @endforeach
    </select>
    <label>UNIDAD ADMINISTRATIVA*</label>
 </div> --}}
   <!--nuc-->
   <div class="input-field col s12 m6 l6">
      <input type="text" name="nuc" value="{{$cadena->nuc}}">
      <label for="nuc"><i class="fas fa-folder"></i> ~ NUC
        <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
      </label>
   </div>
   <!--folio-->
   <div class="input-field col s12 m4 l6">
      <input id="folio" type="text" name="folio" value="{{$cadena->folio}}">
      <label for="folio">FOLIO</label>
   </div>
   <!--lugar_intervencion-->
   <div class="input-field col s12 m4 l12">
      <textarea id="lugarIntervencion" class="materialize-textarea" name="intervencion_lugar">{{$cadena->intervencion_lugar}}</textarea>
      <label for="lugarIntervencion"><i class="fas fa-map"></i> ~ LUGAR DE INTERVENCIÓN
        <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
      </label>
    </div>
    <!--hora intervencion-->
    <div class="input-field col s6 m6 l6">
      <input type="time" id="intervencion_hora"  class="{{($formAccion == 'registrar') ? 'hora-actual' : ''}}" name="intervencion_hora" value="{{date('H:i',strtotime($cadena->intervencion_hora))}}">
      <label class="active" for="horaIntervencion"><i class="fas fa-clock"></i> ~ HORA DE INTERVENCIÓN
        <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
      </label>
    </div>
    <!--fecha_intervencion-->
    <div class="input-field col s6 m4 l6">
      <input type="date" id="intervencion_fecha" class="{{($formAccion == 'registrar') ? 'fecha-actual' : ''}}" name="intervencion_fecha" value="{{date('Y-m-d',strtotime($cadena->intervencion_fecha))}}">
      <label class="active" for="fechaIntervencion"><i class="fas fa-calendar-alt"></i> ~ FECHA DE INTERVENCION
        <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
      </label>
    </div>

    <div class="col s12">
      <table>
        <tbody>
          <tr>
            <td width="51%" style="border: 1pt solid grey !important;"> <strong> MOTIVO DEL REGISTRO </strong> <span class="asterisco-campo-obligatorio"><strong>*</strong></span></td>
            <td width="17%" style="border: 1pt solid grey !important;">
               <label>
                  <input name="motivo" type="radio" id="localizacion" {{($cadena->motivo == 'localizacion') ? 'checked' : ''}} value="localizacion" />
                  <span>LOCALIZACIÓN</span>
               </label>
            </td>
            <td width="17%" style="border: 1pt solid grey !important;">
               <label>
                  <input name="motivo" type="radio" id="descubrimiento" {{($cadena->motivo == 'descubrimiento') ? 'checked' : ''}} value="descubrimiento" />
                  <span>DESCUBRIMIENTO</span>
               </label>
            </td>
            <td width="17%" style="border: 1pt solid grey !important;">
               <label>
                  <input name="motivo" type="radio" id="aportacion" {{($cadena->motivo == 'aportacion') ? 'checked' : ''}} value="aportacion" />
                  <span>APORTACIÓN</span>
               </label>
            </td>
         </tr>
        </tbody>
      </table>
    </div>


    {{-- <div class="col l4">
      <b>MOTIVO DEL REGISTRO*</b>
    </div>
    <div class="col l3">
      <input name="motivo" type="radio" id="localizacion" {{($cadena->motivo == 'localizacion') ? 'checked' : ''}} value="localizacion" />
      <label for="localizacion">LOCALIZACIÓN</label>
    </div>
    <div class="col l3">
      <input name="motivo" type="radio" id="descubrimiento" {{($cadena->motivo == 'descubrimiento') ? 'checked' : ''}} value="descubrimiento" />
      <label for="descubrimiento">DESCUBRIMIENTO</label>
    </div>
    <div class="col l3">
      <input name="motivo" type="radio" id="aportacion" {{($cadena->motivo == 'aportacion') ? 'checked' : ''}} value="aportacion" />
      <label for="aportacion">APORTACIÓN</label>
    </div> --}}
</div>

<div class="row">
  <div class="col s12">
    <hr class="hr-2">
  </div>
</div>