@component('componentes.componente_sidenav_buscador')
<form class="col s12" autocomplete="off">

   <div class="row">
      <div class="input-field col s12">
         <input type="text" id="folio-nuc" placeholder="Folio o N.U.C." name="arma_folio_nuc" value="{{old('arma_folio_nuc')}}"> <!--Folio,nuc-->
         <label for="folio-nuc" class="active">Folio o N.U.C.</label>
      </div>
      {{-- <div class=" input-field col s12">
         <input type="text" id="arma-atributos" placeholder="Serie, marca, modelo o descripción" name="arma_atributos"> <!--serie,marca,modelo,descripcion-->
         <label for="arma-atributos" class="active">Serie, marca, modelo o descripción</label>
      </div> --}}
      <div class="input-field col s12">
         <select name="arma_clasificacion">            
            <option value="0" selected>---</option>
            <option value="corta" {{old('arma_clasificacion') == 'corta' ? 'selected' : ''}}>1. Corta</option>
            <option value="larga" {{old('arma_clasificacion') == 'larga' ? 'selected' : ''}}>2. Larga</option>            
         </select>
         <label>CLASIFICACIÓN</label>
      </div>
      <div class="input-field col s12">
         <input type="date" id="fecha-inicio" name="fecha_inicio">
         <label for="fecha-inicio" class="active">FECHA DE INICIO</label>
      </div>
      <div id="fecha-fin" class="input-field col s12">
         <input type="date" id="fecha-fin" disabled name="fecha_fin">
         <label for="fecha-fin" class="active">FECHA DE TERMINO</label>
      </div>
      <!--fecha_tipo-->
      <div class="col s12 hide fecha-tipo">
         <label>
            <input type="radio" name="fecha_tipo" value="fecha_recoleccion"/>
            <span>Fecha de recolección</span>
          </label>
      </div>
      <div class="col s12 hide fech-tipo">
         <label>
            <input type="radio" name="fecha_tipo" value="fecha_ingreso"/>
            <span>Fecha de ingreso</span>
          </label>
      </div>      
      {{-- <div class="input-field col s12">
         <select name="">            
            <option value="0" selected>---</option>
            <option value="Fuego">1. Fuego</option>
            <option value="Fuego">2. Hechiza</option>
            <option value="Fuego">3. Deportiva</option>
            <option value="Fuego">3. Juguete</option>
         </select>
         <label>AGRUPACIÓN</label>
      </div> --}}
      {{-- <div class="input-field col s12">
         <select name="">
            <option value="0" selected>---</option>
            @foreach ($regiones->sortBy('nombre')->values() as $i => $region)
               <option value="{{$region->id}}">{{$i+1}}. {{$region->nombre}}</option>
            @endforeach
         </select>
         <label>REGIÓN</label>         
      </div> --}}
      
      <div class="col s12">
         <hr class="hr-main">
      </div>
   
      <div class="input-field col s12">
         <button class="btn-guardar" id="btn-buscar" style="display: inline-block !important; width:100%;" type="submit" name="btn" value="buscar">Buscar</button>
      </div>
   </div>

</form>
@endcomponent