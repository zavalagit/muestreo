@extends('plantilla.template')

{{--item menu selected--}}
,'vista-cadena-capturar')

@section('titulo')
CADENA-CAPTURA
@endsection

@section('seccion', 'CAPTURA DE CADENA DE CUSTODIA')

@section('css')
   <link rel="stylesheet" href="{{asset('/css/block.css')}}">
   <style media="screen">
      body{
        padding: 0 !important;
        margin: 0 !important;
      }

      textarea{
         padding: 0 !important;
         padding-top: 0px !important;
      }
   </style>
@endsection

@section('contenido')

    <form class="" id="form-foranea">
      <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
      <input type="hidden" name="id_cadena" value="">

      <div class="row">
         <div class="input-field col s12">
            <input id="folio" type="text" autocomplete="off" name="folio">
            <label for="folio">FOLIO</label>
         </div>
      </div>

      <div class="row">
         <div class="input-field col s12 m6 l3">
            <input id="nuc" type="text" name="nuc">
            <label for="nuc">N.U.C.</label>
         </div>
        <div class="input-field col s12 m6 l3">
           <select name="entidad" id="select-entidad">
               <option disabled selected></option>
               @foreach ($entidades as $key => $entidad)
                  @if($entidad->id == 16)
                    <option selected value={{$entidad->id}}>{{$entidad->nombre}}</option>
                  @else
                    <option value="{{$entidad->id}}">{{$entidad->nombre}}</option>
                  @endif
               @endforeach
            </select>
            <label>ENTIDAD\ESTADO</label>
        </div>
         <div class="input-field col s3">
            <select name="delegacion" id="select-delegacion">
               <option disabled selected></option>
               @foreach ($delegaciones as $key => $delegacion)
                  @if($delegacion->id == 782)
                    <option selected value="{{$delegacion->id}}">{{$delegacion->nombre}}</option>
                  @else
                    <option value={{$delegacion->id}}>{{$delegacion->nombre}}</option>
                  @endif
               @endforeach
            </select>
            <label>DELEGACIÓN\MUNICIPIO</label>
         </div>
        <div class="input-field col s3">
            <select name="unidad">
              <option disabled selected></option>
                @foreach ($unidades as $key => $unidad)
                  <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
                @endforeach
            </select>
            <label>UNIDAD ADMINISTRATIVA</label>
        </div>

      </div>
      <div class="row">
         <div class="input-field col s3">
            <input id="hora" type="time" name="hora">
            <label class="active" for="hora">HORA*</label>
         </div>
         <div class="input-field col s3">
            <input id="fecha" type="date" name="fecha">
            <label class="active" for="fecha">FECHA*</label>
         </div>
         <div class="input-field col s3">
            <select name="naturaleza">
               <option disabled selected></option>
               @foreach ($naturalezas as $key => $naturaleza)
                  <option value={{$naturaleza->id}}>{{$naturaleza->nombre}}</option>
               @endforeach
            </select>
            <label>NATURALEZA*</label>
         </div>
         <div class="input-field col s3">
          <select name="embalaje">
               <option disabled selected></option>
               <option value="bolsa">BOLSA</option>
               <option value="caja">CAJA</option>
               <option value="recipiente">RECIPIENTE</option>
            </select>
            <label>EMBALAJE*</label>
         </div>
      </div>

      <section id="identidad">
         <div class="row">
            <div class="col s12">
               <blockquote>
                  <h6><b>REGISTRO DE INDICIOS O EVIDENCIAS</b></h6>
               </blockquote>
            </div>
         </div>
            <div class="row">
               <div class="col s2">
                  <a id="add-desc" class="tooltipped" data-position="right" data-delay="50" data-tooltip="
            Agregar nvo. indicio o evidencia" href="">
                     <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>
                  </a>
               </div>
            </div>
            <div class="row">
               <div class="input-field col s2">
                  <input id="identificador" type="text" class="center-align" name="identificador[]">
                  <label for="identificador">IDENTIFICADOR</label>
               </div>
               <div class="input-field col s7">
                  <textarea id="descripcion" class="materialize-textarea" name="descripcion[]"></textarea>
                  <label for="descripcion">DESCRIPCIÓN</label>
               </div>
               <div class="input-field col s2">
                  <input id="identificador" type="number" class="center-align" name="numero_indicios[]">
                  <label for="identificador">NO. INDICIOS</label>
               </div>
            </div>
         </section>


      <div class="row">
         <div class="row">
            <div class="col s12">
               <blockquote>
                 <h6><b>PERITO QUE ENTREGA</b></h6>
               </blockquote>
            </div>
         </div>
        <div class="col s12">
         <div class="row">
            <div class="input-field col s11">
               <input type="hidden" id="input-hidden-perito" name="perito">
               <input type="text" class="autocomplete" id="input-text-perito" data-input-hidden="input-hidden-perito" data-tabla="peritos">
               <label for="input-text-perito">Servidor público</label>
            </div>
            <div class="input-field col s1">
               <a href="" class="btn-limpiar-input-autocomplete" data-input-autocomplete="input-text-perito" data-input-hidden="input-hidden-perito">
                  <i class="fas fa-times-circle fa-lg" ></i>
               </a>
            </div>
         </div>
      </div>
      </div>


      <div class="row">
         <div class="col s12">
            <blockquote>
              <h6><b>RESPONSABLE DE BODEGA RECIBE</b></h6>
            </blockquote>
         </div>
      </div>
      <div class="row">
         <div class="input-field col s11">
            <input type="hidden" id="input-hidden-responsable-bodega" name="responsable_bodega" value="{{Auth::user()->id}}">
            <input type="text" class="autocomplete" id="input-text-responsable-bodega" data-input-hidden="input-hidden-responsable-bodega" data-tabla="users" data-user-tipo="responsable_bodega" value="{{Auth::user()->folio}} - {{Auth::user()->name}}">
            <label for="input-text-perito">Responsable de bodega</label>
         </div>
         <div class="input-field col s1">
            <a href="" class="btn-limpiar-input-autocomplete" data-input-autocomplete="input-text-responsable-bodega" data-input-hidden="input-hidden-responsable-bodega">
               <i class="fas fa-times-circle fa-lg" ></i>
            </a>
         </div>
      </div>

      <div class="row">
         <div class=" col s2">
            <p><b>TIPO:</b></p>
            <input name="tipo" type="radio" id="indicio" value="indicio"/>
            <label for="indicio">INDICIO</label>
            <input name="tipo" type="radio" id="evidencia" value="evidencia"/>
            <label for="evidencia">EVIDENCIA</label>
         </div>
      </div>
      <div class="row">
         <div class="input-field col s12">
            <textarea id="observacion" class="materialize-textarea" name="observacion"></textarea>
            <label for="observacion">OBSERVACIÓN</label>
         </div>
      </div>

      <div class="row">
         <div class="col s12">
            <hr class="hr-main">
         </div>
      </div>

      <div class="row">
         <div class="col s1 offset-s11">
            <button class="btn-guardar" type="submit" id="btn-capturar">
               Guardar
            </button>
         </div>
      </div>

    </form>

@endsection

@section('js')
  <script src="{{asset('js/modelo/get_modelo.js')}}"></script>
  <script src="{{asset('js/modelo/input_autocomplete.js')}}"></script>
  <script src="{{asset('js/foranea.js')}}"></script>
@endsection
