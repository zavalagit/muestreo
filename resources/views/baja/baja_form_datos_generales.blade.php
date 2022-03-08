<section id="baja-datos">
   <div class="row">
      @component('componentes.componente_seccion_titulo')
         @slot('mensaje','2. DATOS DE LA BAJA ~ ')
         @slot('icono','fas fa-file-alt')
      @endcomponent
      <!--concepto-->
      <div class="input-field col s12">
         <input type="text" id="baja-concepto" name="baja_concepto" value="{{ isset($baja->id) ? $baja->concepto : '' }}">
         <label for="baja-concepto">Concepto de Baja</label>
      </div>
      {{-- <div class="input-field col s2">
         <input type="text" id="numindicios" name="numindicios" disabled>
         <label for="numindicios">Num. Indicios</label>
      </div> --}}
      <!--hora baja-->
      <div class="input-field col s3">
         <input type="time" id="baja-hora" name="baja_hora" value="{{ isset($baja->id) ? date('H:i:s',strtotime($baja->hora)) : date('H:i')}}">
         <label class="active" for="baja-hora">Hora</label>
      </div>
      <!--fecha baja-->
      <div class="input-field col s3">
         <input type="date" id="baja-fecha" name="baja_fecha" value="{{ isset($baja->id) ? $baja->fecha : date('Y-m-d') }}">
         <label class="active" for="baja-fecha">Fecha</label>
      </div>
      <!--tipo de baja-->
      {{-- <div class="input-field col s3">
         <select name="baja_tipo">
            <option value="" disabled selected></option>
            <option value="definitiva" {{ isset($baja->id && $baja->tipo == 'definitiva') ? 'selected' : '' }}>DEFINITIVA</option>
            <option value="parcial" {{ isset($baja->id && $baja->tipo == 'parcial') ? 'selected' : '' }}>PARCIAL</option>
            <option value="pertenencia" {{ isset($baja->id && $baja->tipo == 'pertenencias') ? 'selected' : '' }}>PERTENENCIA</option>
         </select>
         <label>Tipo de Baja</label>
      </div> --}}
      <!--estado de la cadena-->
      <div class="input-field col s3">
         <select name="baja_cadena_estado">
            <option value="" disabled selected></option>
            <option value="x" {{ isset($baja->id) && ($baja->estado_cadena == 'x') ? 'selected' : '' }}>Entregada</option>
            <option value="o" {{ isset($baja->id) && ($baja->estado_cadena == 'o') ? 'selected' : '' }}>No entregada</option>
         </select>
         <label>Estado de la cadena</label>
      </div>
      <!--embajale-->
      <div class="input-field col s12">
         <textarea id="textarea1" class="materialize-textarea" name="baja_embalaje">{{ isset($baja->id) ? $baja->embalaje : 'SE APERTURA EMBALAJE PARA SU ENTREGA FINAL' }}</textarea>
         <label for="textarea1">EMBALAJE</label>
      </div>
      <!--observaciones-->
      <div class="input-field col s12">
         <textarea id="textarea2" class="materialize-textarea" name="baja_observaciones">{{ isset($baja->id) ? $baja->observaciones : '' }}</textarea>
         <label for="textarea2">OBSERVACIONES</label>
      </div>
   </div>
</section>