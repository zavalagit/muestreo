@component('componentes.componente_sidenav_buscador')
<form class="col s12">
   {{-- <div class="row">
      <div class="col s12">
         <p style="line-height: 25px;"><i style="color:#152f4a;" class="fas fa-certificate"></i> El parametro por "fecha" es de acuedo a la fecha en que se realizó el registro. 
      </div>
   </div> --}}

   <div class="row">
      <div class="col s12">
         <p style="line-height: 25px;"><i style="color: tomato;" class="fas fa-sticky-note fa-sm"></i> <span><b>El parametro "fecha" es de acuerdo a la fecha en que se realizó el registro.</b></span> 
      </div>
      <div class="col s12">
         <hr class="hr-2">
      </div>
      <!--peticion_estado-->
      <div class="col s12" style="line-height: 28px;">
         <P><b>TIPO DE PETICIÓN:</b></P>
      </div>
      <div class="col s12" style="line-height: 28px;">
         <label>
            <input type="radio" id="peticion-pendiente" name="peticion_estado" value="pendiente"/>
            <span>PENDIENTES DE ATENDER</span>
         </label>
      </div>
      <div class="col s12" style="line-height: 28px;">
         <label>
            <input type="radio" id="peticion-atendida" name="peticion_estado" value="atendida"/>
            <span>PENDIENTES DE ENTREGAR</span>
         </label>
      </div>
      <div class="col s12" style="line-height: 28px;">
         <label>
            <input type="radio" id="peticion-entregada" name="peticion_estado" value="entregada"/>
            <span for="peticion-entregada">CONCLUSAS</span>
         </label>
      </div>
      <div class="col s12" style="line-height: 28px;">
         <label>
            <input type="radio" id="peticion-todo" checked name="peticion_estado" value="0"/>
            <span>TODAS LAS ANTERIORES</span>
         </label>
      </div>
      <div class="col s12">
         <hr class="hr-2">
      </div>
      @if (Auth::user()->tipo == 'administrador_peticiones')
         <!--peticion_region-->
         <div class="input-field col s12">
            <select name="b_region">
               <option value="0" selected>---</option>
               @foreach ($regiones->sortBy('nombre')->values() as $i => $region)
                  <option value="{{$region->id}}" {{(old('b_region') == $region->id) ? 'selected' : ''}}>{{$i+1}}.- {{$region->nombre}}</option>
               @endforeach
            </select>
            <label>REGIÓN</label>
         </div>
         <div class="col s12">
            <hr class="hr-2">
         </div>         
      @endif
      <!--peticion_nuc-numero_oficio-folio_interno-->
      <div class="input-field col s12">
         <input type="text" id="b-nuc" name="b_nuc" value="{{old('b_nuc')}}">
         <label for="b-nuc">N.U.C.</label>
      </div>
      <div class="col s12">
         <hr class="hr-2">
      </div>      
      <!--especilidad-->
      <div class="input-field col s12">
         <select id="b-especialidad" name="b_especialidad">
            <option value="0" selected>---</option>
            @foreach ($especialidades->sortBy('nombre')->values() as $i => $especialidad)
               <option value="{{$especialidad->id}}" {{(old('b_especialidad') == $especialidad->id) ? 'selected' : ''}}>{{$i+1}}.- {{$especialidad->nombre}}</option>
            @endforeach
         </select>
         <label>ESPECIALIDAD</label>
      </div>
      <div class="col s12">
         <hr class="hr-2">
      </div>
      <!--solicitud-->
      <div id="select-solicitud" class="input-field col s12 {{!old('b_especialidad') ? 'hide' : ''}}">
         <select id="b-solicitud" name="b_solicitud">            
            @includeWhen(old('b_especialidad'), 'solicitud.solicitud_form_select_options', ['solicitudes' => $solicitudes->where('especialidad_id',old('b_especialidad'))])
         </select>
         <label>SOLICITUD</label>
      </div>
      <div id="hr-select-solicitud" class="col s12 {{!old('b_especialidad') ? 'hide' : ''}}">
         <hr class="hr-2">
      </div>      
      <!--peticion_fecha-->
      <div class="input-field col s12">
         <input id="fecha-inicio" type="date" name="b_fecha_inicio" value="{{old('b_fecha_inicio')}}">
         <label class="active" for="fecha-inicio">FECHA INICIO</label>
      </div>
      <div class="input-field col s12">
         <input id="fecha-fin" type="date" name="b_fecha_fin" value="{{old('b_fecha_fin')}}">
         <label class="active" for="fecha-fin">FECHA TERMINO</label>
      </div>
      <div class="col s12">
         <hr class="hr-2">
      </div>
      <!--peticion_user-->
      @if ( Auth::user()->tipo != 'usuario' )
      <div class="input-field col s12">
         <input id="peticion_user" type="hidden" name="b_user">
         <input  class="autocomplete" id="autocomplete-input" data-tabla="users" data-input-hidden="peticion_user" data-user-tipo="usuario" type="text">
         <label for="autocomplete-input">Usuario</label>
      </div>
      <div class="col s12">
         <hr class="hr-2">
      </div>
      @endif
      <!--peticion_btn_buscar-->
      <div class="input-field col s12">
        <button type="submit" class="btn-sidenav-buscar" name="btn_buscar" value="buscar">Buscar</button>
      </div>
   </div>
</form>
@endcomponent
