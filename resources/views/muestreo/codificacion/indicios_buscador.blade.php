@component('componentes.componente_sidenav_buscador')

   <div class="row">
      <div class="input-field col s12" id="input-buscar">
         @isset($buscar_texto)
            <input form="form-codificacion-busqueda" type="text" id="buscar-texto" name="buscar_texto" value="{{$buscar_texto}}">
         @endisset
         @empty($buscar_texto)
            <input form="form-codificacion-busqueda" type="text" id="buscar-texto" placeholder="Folio ~ N.U.C. ~ Descripción" name="buscar_texto">
         @endempty
      </div>
      
      <div class="col s12">
         <hr class="hr-main">
      </div>

      <div class="input-field col s12">
         <button form="form-codificacion-busqueda" class="btn-guardar" id="btn-buscar" style="display: inline-block !important; width:100%;" type="submit" name="btn" value="buscar">Buscar...</button>
      </div>
   </div>

@endcomponent