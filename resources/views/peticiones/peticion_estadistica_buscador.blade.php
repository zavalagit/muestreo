@component('componentes.componente_sidenav_buscador')
<form class="col s12">
   <div class="row">
       
       @if (Auth::user()->tipo === 'admin_peticiones')
           <div id="div-fiscalias" class="input-field col s12">
               <select id="fiscalia-select" name="buscar_fiscalia">
               @foreach ($fiscalias->sortBy('nombre') as $f)
                   <option value="{{$f->id}}" {{ ($f->id === $fiscalia->id) ? 'selected' : '' }}>{{$f->nombre}}</option>
               @endforeach
               </select>
               <label>Seleccione Fiscalía</label>
           </div>
           
           @if ($lugar === 'unidad')
               <div id="div-unidades" class="input-field col s12">
                   <select id="unidad-select" name="buscar_unidad">
                   @foreach ($unidades->sortBy('nombre') as $u)
                       <option value="{{$u->id}}" {{ ($u->id === $unidad->id) ? 'selected' : '' }}>{{$u->nombre}}</option>
                   @endforeach
                   </select>
                   <label>Seleccione Unidad</label>
               </div>
           @endif
       @endif

       

       <div class="input-field col s12">
           @isset($fecha_inicio)
               <input type="date" name="fecha_inicio" value="{{$fecha_inicio}}">
           @endisset
           @empty($fecha_inicio)
               <input type="date" name="fecha_inicio" >
           @endempty
       </div>
       <div class="input-field col s12">
           @isset($fecha_fin)
               <input type="date" name="fecha_fin" value="{{$fecha_fin}}">
           @endisset
           @empty($fecha_fin)
               <input type="date" name="fecha_fin" >
           @endempty
       </div>
       <!--peticion_btn_buscar-->
      <div class="input-field col s12">
         <button type="submit" class="btn-sidenav-buscar" name="btn_buscar" value="buscar">Buscar</button>
      </div>
       {{-- @if (Auth::user()->tipo != 'usuario')
           <div class="input-field col s12">
               <button class="btn waves-effect waves-light" type="submit" name="btn_buscar" value="pdf">
                   <span>PDF</span>
               </button>
           </div>
       
       @endif --}}
   </div>
</form>
@endcomponent