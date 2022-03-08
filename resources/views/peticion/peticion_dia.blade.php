@extends('template.template')

@section('css')
<link rel="stylesheet" href="{{asset('/css/materialize/chips.css')}}">
<link rel="stylesheet" href="{{asset('/css/nav/sidenav_buscador.css')}}">
<link rel="stylesheet" href="{{asset('/css/btn.css')}}">
<link rel="stylesheet" href="{{asset('/css/table.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas/tabla_modal.css')}}">
<link rel="stylesheet" href="{{asset('/css/buscador/buscador_parametros_busqueda.css')}}">
<link rel="stylesheet" href="{{asset('css/materialize/carousel_panel.css')}}">
<style>
   body{
         /* background-color:rgba(21, 47, 74, 0.5); */
         /* background-color:rgba(57, 64, 73, 0.9); */
      } 

 
   .fecha-encabezado{
        margin: 0 !important;
    }
    .fecha-encabezado h5{
        text-align: center;
        background-color: #152f4a;
        color: #c09f77;
        padding-top: 6px;
        padding-bottom: 6px;
        /* border-radius: 15px; */
    }
   body{ background-color: rgba(57, 64, 73, 0.2); }
   .carousel{
      width: 98.5% !important;
      height:70vh !important;
      /* margin: auto; */
      /* background-color: tomato; */
      background-color: rgba(57, 64, 73, 0);
   }
</style>
@endsection

@section('titulo','CONSULTAR-CADENA')

@section('header')
<div class="col offset-l11 l1 center-align" style="padding-top: 3px;">
   <a href="#" class="btn-sidenav-buscador-open pulse"><i class="fas fa-search" style="color: #fff;"></i></a>
</div>
@endsection

@section('main')
   <!--section ~ Buscador-->
   <section>
      <div class="row" style="margin-bottom: 0;">
         <!--parametros de busqueda-->
         @include('peticion.peticion_parametros_busqueda')
         <div class="col s12">
            <hr class="hr-4">
         </div>
      </div>
   </section>
   <!--section ~ encabezado-->
   <section>
      <div class="row">
         <div class="fecha-encabezado col s12" style="margin-bottom:0 !important;">
             <h5 style="margin-bottom:0 !important;"> <b>PETICIONES {{strtoupper($fecha_formato)}}</b> </h5>
         </div>
     </div>
   </section>

   <section>
      <div class="row">
         <div class="col s12">
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato" class="fas fa-comment-alt"></i>
               @endslot
               @slot('mensaje')
                  <span><strong><em>Recibidas</em>.</strong></span> Peticiones que fueron registradas en el día.
               @endslot
            @endcomponent
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato" class="fas fa-comment-alt"></i>
               @endslot
               @slot('mensaje')
                  <span><strong><em>Atendidas</em>.</strong></span> Peticiones que se registraron en el día y fueron atendidas en el día.
               @endslot
            @endcomponent
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato" class="fas fa-comment-alt"></i>
               @endslot
               @slot('mensaje')
                  <span><strong><em>Pendientes</em>.</strong></span> Peticiones que se registraron en el día, pero <strong>no</strong> fueron atendidas en el día. Pude que ya hayan sido atendidas en fecha posterior.
               @endslot
            @endcomponent
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato" class="fas fa-comment-alt"></i>
               @endslot
               @slot('mensaje')
                  <span><strong><em>Rezago</em>.</strong></span> Peticiones que se registraron en el día y aún <strong>no</strong> han sido atendidas.
               @endslot
            @endcomponent
      </div>
   </section>

   <!--1 y 2. section ~ peticiones_entradas_atendidas - peticion_documento_emitido-->
   <section>
      @component('componentes.componente_carousel')
         @component('componentes.componente_carousel_panel',['previo' => false, 'siguiente' => true])
            @include('peticion.peticion_dia.panel_1')
         @endcomponent  
         @component('componentes.componente_carousel_panel',['previo' => true, 'siguiente' => true])
            @include('peticion.peticion_dia.panel_2')
         @endcomponent  
         @component('componentes.componente_carousel_panel',['previo' => true, 'siguiente' => false])
            @include('peticion.peticion_dia.panel_3')
         @endcomponent  
      @endcomponent
   </section>

   <!-- Modal Info -->
   <div id="modal-peticion-informacion" class="modal">
      <div class="modal-content">
      </div>
   </div>

   <!--buscador-->
   @include('peticion.peticion_dia_buscador')
@endsection

@section('js')
{{-- <script src="{{asset('/js/peticiones/peticion_accion.js')}}"></script> --}}
<script src="{{asset('/js/general/sidenav_buscador.js')}}"></script>
<script src="{{asset('/js/modelo/get_modelo.js')}}"></script>
<script src="{{asset('/js/peticiones/peticion_informacion.js')}}"></script>
<script src="{{asset('/js/peticiones/peticion_eliminar.js')}}"></script>
<script src="{{asset('/js/especialidad/especialidad_solicitudes.js')}}"></script>


<script src="{{asset('/js/materialize/carousel_panel.js')}}"></script>

<script src="{{asset('/js/peticion/peticion_buscador.js')}}"></script>



{{-- <script>
   $('.carousel.carousel-slider').carousel({
    fullWidth: true,
    indicators: true,
    indicators: false
  });
</script> --}}
@endsection
