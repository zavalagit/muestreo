<div class="row">
   <!--titulo seccion-->
   @component('componentes.seccion_form')
     @slot('mensaje','6. SERVIDORES PÚBLICOS ~ ')
     @slot('icono','fas fa-edit')
   @endcomponent
   <!--s.p. autocomplete-->
   <div class="input-field col s12">
     <input type="hidden" id="autocomplete-user" name="id_perito">
     <input type="text" class="autocomplete-servidor-publico-cadena-cuscodia" id="autocomplete-input"
       placeholder="Añadir a servidor público interviviente"
       data-input-hidden="autocomplete-user"
       data-tabla="users"
       data-user-tipo="usuario"
       data-url="{{route('get_modelo_user')}}"
     >
     <label for="autocomplete-input"><i class="fas fa-user-plus"></i> ~ SERVIDOR PÚBLICO</label>
   </div>
   <!--s.p. tabla-->
   <div class="col s12">
     <table id="tabla-servidor-publico">
       <thead>
         <tr>
           <th class="th-center" width="3%">Nº</th>
           <th width="7%">PARTICIPE</th>
           <th width="30%">NOMBRE</th>
           <th width="10%">INSTITUCIÓN</th>
           <th width="12%">CARGO</th>
           <th>ETAPA <span class="asterisco-campo-obligatorio"><strong>*</strong></span></th>
           <th class="th-center" width="5%">ELIMINAR</th>
         </tr>
       </thead>
       <tbody>
        @if ( $formAccion == 'registrar' )
          @include('cadena.cadena_form_61_fila_servidor_publico',[
            'indice' => 0
          ])
        @elseif( in_array($formAccion,['editar','clonar']) )
          {{-- {{dd($cadena->users)}} --}}
          @foreach ($cadena->users->values() as $indice => $sp)
            @include('cadena.cadena_form_61_fila_servidor_publico')  
          @endforeach
        @endif
       </tbody>
     </table>
   </div>
 </div>

 <div class="row">
   <div class="col s12">
     <hr class="hr-2">
   </div>
 </div>