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
@section('seccion', 'REGISTRAR CODIFICACION')


@section('contenido')

<div class="row">
   <form class="col s12" id="form-prestamo" action="{{route('prestamo_save',['formAccion'=>$formAccion])}}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" id="prestamo-tipo" name="prestamo_multiple" value="prestamo_multiple">


      {{-- <div class="carousel carousel-slider center">
         <!--panel-1-->
         @include('prestamo.prestamo_multiple_panel_1')
         <!--panel-2-->
         @include('prestamo.prestamo_multiple_panel_2')
      </div> --}}

      @component('componentes.componente_carousel')
         <!--panel-1-->
         @component('componentes.componente_carousel_panel',['previo' => false, 'siguiente' => true])
            @include('muestreo.codificacion.codificacion_multipleindicios_panel_1')
         @endcomponent
         <!--panel-2-->
         @component('componentes.componente_carousel_panel',['previo' => true, 'siguiente' => false])
            @include('muestreo.codificacion.codificacion_multipleindicios_panel_2')
         @endcomponent
      @endcomponent

   </form>
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
<script src="{{asset('js/modelo/get_modelo.js')}}"></script>
<script src="{{asset('js/prestamo/prestamo_form.js')}}"></script>



   
   {{-- <script src="{{asset('js/cadenas/cadena_estado.js')}}"></script> --}}
   <script src="{{asset('js/cadenas/cadena_select.js')}}"></script>
   <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script>



@endsection
