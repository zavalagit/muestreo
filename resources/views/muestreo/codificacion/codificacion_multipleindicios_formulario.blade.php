{{-- {{dd('vista')}} --}}
@extends('plantillas.plantilla_sin_menu')

@section('css')
   <link rel="stylesheet" href="{{asset('css/colores.css')}}">
   <link rel="stylesheet" href="{{asset('css/table.css')}}">
   <link rel="stylesheet" href="{{asset('css/form/form.css')}}">
   <link rel="stylesheet" href="{{asset('css/materialize/carousel_panel.css')}}">
@endsection

@section('titulo')
   FORMULARIO DE CODIFICACION
@endsection
@section('seccion', 'REGISTRAR CODIFICACION papirriquis')


@section('contenido')

<div class="row">
   
      
      @component('componentes.componente_carousel')
         <!--panel-1-->
         @component('componentes.componente_carousel_panel',['previo' => false, 'siguiente' => true])
   <form class="col s12" autocomplete="off" id="form-codificacion-busqueda" action="{{route('codificacion.create')}}">
     
         @include('muestreo.codificacion.indicios_buscador')
   </form>
   <form class="col s12" id="form-codificacion-registro" action="{{route('codificacion.store')}}" method="POST">
      {{ csrf_field() }}      
         @include('muestreo.codificacion.codificacion_multipleindicios_panel_1')
         @endcomponent
         <!--panel-2-->
         @component('componentes.componente_carousel_panel',['previo' => true, 'siguiente' => false])
            @include('muestreo.codificacion.codificacion_multipleindicios_panel_2')
         @endcomponent
   </form>      
      @endcomponent

   
</div>


@endsection

@section('js')

<script>
   $(function(){
      $('.carousel').carousel({
         noWrap: true,
      });
      $('.carousel.carousel-slider').carousel({fullWidth: true});

      $('.adelante').click(function(e){
         e.preventDefault();
         $('.carousel').carousel('next');
      })
      $('.atras').click(function(e){
         e.preventDefault();
         $('.carousel').carousel('prev');
      })
   });
</script>




{{-- <script src="{{asset('js/entrada/cadena_accion.js')}}" charset="utf-8"></script> --}}
<script src="{{asset('js/codificacion/get_modelo.js')}}"></script>
<script src="{{asset('js/codificacion/codificacion_form.js')}}"></script>
{{--agrega campo de nuc para su busqueda --}}
<script src="{{asset('js/codificacion/datos_busqueda_indicios.js')}}"></script>
{{--selecionar el checkbox del indicio --}}
<script src="{{asset('js/codificacion/select_checkbox.js')}}"></script>

   
   {{-- <script src="{{asset('js/cadenas/cadena_estado.js')}}"></script> --}}
  
   <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script>

   

@endsection
