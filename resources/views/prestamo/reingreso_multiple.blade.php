{{-- {{dd('vista')}} --}}
@extends('plantillas.plantilla_sin_menu')

@section('css')
   <link rel="stylesheet" href="{{asset('css/colores.css')}}">
   <link rel="stylesheet" href="{{asset('css/table.css')}}">
   <link rel="stylesheet" href="{{asset('css/form/form.css')}}">
   <link rel="stylesheet" href="{{asset('css/materialize/carousel_panel.css')}}">
@endsection

@section('titulo')
   REINGRESO MÚLTIPLE
@endsection
@section('seccion', 'REINGRESO MÚLTIPLE')


@section('contenido')

<div class="row">
   <form class="col s12" id="form-reingreso" action="{{route('prestamo_save',['formAccion'=>$formAccion])}}" method="POST">
      <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
      <input type="hidden" id="reingreso-tipo" name="reingreso_multiple" value="reingreso_multiple" data-reingreso-tipo="reingreso-multiple">

      @component('componentes.componente_carousel')
         <!--panel-1-->
         @component('componentes.componente_carousel_panel',['previo' => false, 'siguiente' => true])
            @include('prestamo.reingreso_multiple_panel_1')
         @endcomponent
         <!--panel-2-->
         @component('componentes.componente_carousel_panel',['previo' => true, 'siguiente' => false])
            @include('prestamo.reingreso_multiple_panel_2')
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
   <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script>
   <script src="{{asset('js/prestamo/prestamo_form.js')}}"></script>
   <script src="{{asset('js/cadenas/cadena_estado.js')}}"></script>
   <script src="{{asset('js/cadenas/cadena_select.js')}}"></script>



@endsection
