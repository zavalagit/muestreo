@component('componentes.componente_sidenav_buscador')
      <section class="nuc-section">
         
         <div class="row" style="">
            <div class="col s12">
               <a href="" id="add-nuc" class="i-btn"><i class="fa fa-plus-circle fa-lg"></i><span> <b>- AGREGAR CAMPO</b> </span></a>
            </div>
         </div>
         <div id="div-row-nucs" class="row">
            <div class="input-field col s3">
               <a href="" class="nuc-x"><i class="fas fa-times i-x"></i></a>
               <input form="form-codificacion-busqueda" id="nuc" type="text" placeholder="N.U.C." class="validate" name="nucs[]">
            </div>
         </div>
      </section>

   <div class="row">
      {{--  <div class="input-field col s12" id="input-buscar">
         @isset($buscar_texto)
            <input form="form-codificacion-busqueda" type="text" id="buscar-texto" name="buscar_texto" value="{{$buscar_texto}}">
         @endisset
         @empty($buscar_texto)
            <input form="form-codificacion-busqueda" type="text" id="buscar-texto" placeholder="Folio ~ N.U.C. ~ Descripción" name="buscar_texto">
         @endempty
      </div>  --}}
      
      <div class="col s12">
         <hr class="hr-main">
      </div>

      <div class="input-field col s12">
         <button form="form-codificacion-busqueda" class="btn-guardar" id="btn-buscar" style="display: inline-block !important; width:100%;" type="submit" name="btn" value="buscar">Buscar...</button>
      </div>
   </div>

@endcomponent