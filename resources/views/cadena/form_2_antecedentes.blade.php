<div class="row">
    <div class="col s12 div-fieldset">
       <fieldset>
          <legend>2. ANTECEDENTES DEL EVENTO Y ORIGEN DE LOS INDICIOS</legend>
          <div class="row">
             <!--servicio-->
             <div class="input-field col s12 m12 l12">
                <input type="text" id="servivcio" name="servicio" value="">
                <label for="servivcio"><i class="fas fa-folder"></i> ~ TIPO DE SERVICIO
                   <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
                </label>
             </div>
             <!--calle1-->
             <div class="input-field col s12 m6 l4">
                <input type="text" id="calle1" name="calle1" value="">
                <label for="calle1"><i class="fas fa-folder"></i> ~ CALLE (EDIFICIO)
                   <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
                </label>
             </div>
             <!--calle2-->
             <div class="input-field col s12 m6 l4">
                <input type="text" id="calle2" name="calle2" value="">
                <label for="calle2"><i class="fas fa-folder"></i> ~ ENTRE LA CALLE
                   <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
                </label>
             </div> 
             <!--calle3-->
             <div class="input-field col s12 m6 l4">
                <input type="text" id="calle3" name="calle3" value="">
                <label for="calle3"><i class="fas fa-folder"></i> ~ Y LA CALLE
                   <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
                </label>
             </div>     
             <!--numero_exterior-->
             <div class="input-field col s12 m6 l4">
                <input type="text" id="numero-exterior" name="numero_exterior" value="">
                <label for="numero-exterior"><i class="fas fa-folder"></i> ~ NÚMERO EXTERIOR
                   <span class="asterisco-campo-obligatorio"><strong>*</strong></span>
                </label>
             </div>
             <!--numero_interior-->
             <div class="input-field col s12 m6 l4">
                <input type="text" id="numero-interior" name="numero_interior" value="">
                <label for="numero-interior"><i class="fas fa-folder"></i> ~ NÚMERO INTERIOR
                   {{-- <span class="asterisco-campo-obligatorio"><strong>*</strong></span> --}}
                </label>
             </div>            
             <!--municipio-->
             <div class="input-field col s12 m12 l4">
                <select
                   {{-- {{in_array($accion, ['validar','entregar']) ? 'readonly' : ''}}
                   {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}} --}}
                   name="municipio_id"
                >
                   <option value="0" disabled selected></option>
                   @foreach ($municipios->sortBy('nombre')->values() as $i => $municipio)
                      <option value="{{$municipio->id}}" {{isset($cadena) && $cadena->municipio_id == $municipio->id ? 'selected' : '' }}>{{$i+1}}.- {{$municipio->nombre}}</option>
                   @endforeach
                </select>
                <label><i class="fas fa-map-marker-alt"></i> ~ MUNICIPIO</label>
             </div>
             <!--referencias-->
             <div class="input-field col s12 m4 l12">
                <textarea id="referencias" class="materialize-textarea" name="referencias"></textarea>
                <label for="referencias"><i class="fas fa-map"></i> ~ OTRAS REFERENCIAS
                  {{-- <span class="asterisco-campo-obligatorio"><strong>*</strong></span> --}}
                </label>
             </div>
    
             <!--s.p. autocomplete-->
             <div class="input-field col s12">
                <input type="hidden" id="autocomplete-user" name="id_perito">
                <input type="text" class="autocomplete-servidor-publico-cadena-cuscodia" id="autocomplete-input"
                   placeholder="Añadir a servidor público interviviente" data-input-hidden="autocomplete-user"
                   data-tabla="users" data-user-tipo="usuario" data-url="{{route('users.get')}}">
                <label for="autocomplete-input"><i class="fas fa-user-plus"></i> ~ SERVIDORES PÚBLICOS QUE INICIAN LA CADENA DE CUSTODIA</label>
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
                      @if ( request()->route()->named('cadenas.create') )
                        @include('cadena.form_2_1_servidor_publico',[
                           'indice' => 0
                        ])
                      @elseif( request()->route()->named('cadenas.edit') )
                        @foreach ($cadena->users->values() as $indice => $sp)
                           @include('cadena.form_2_1_servidor_publico')
                        @endforeach
                      @endif
                   </tbody>
                </table>
             </div>
          
          </div>
       </fieldset>
    </div>
 </div>
 
 <div class="row">
    <div class="col s12">
       <hr class="hr-2">
    </div>
 </div>