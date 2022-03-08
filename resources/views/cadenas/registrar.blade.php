@if ( $formAccion == 'registrar' )
  @php $template = 'plantilla.template'; @endphp
@elseif( in_array($formAccion,['editar','clonar']) )  
  @php $template = 'plantilla.template_sin_menu'; @endphp
@endif

@extends('template.template')

{{--item menu selected--}}
{{-- ,'vista-cadena-registrar') --}}
@section('nombre_submenu','submenu-cadenas')

@section('seccion', 'REGISTRO CADENA DE CUSTODIA')

@section('titulo','REGISTRAR-CADENA')

@section('css')
<link rel="stylesheet" href="{{asset('css/cadenas/registrar.css')}}">
<link rel="stylesheet" href="{{asset('css/tablas.css')}}">
<link rel="stylesheet" href="{{asset('css/form/form.css')}}">
@endsection

@section('contenido')
<section>
  <div class="row" style="margin: 0 !important; line-height: 0 !important">
      <div class="col s12 m12 l12">
          <p class="right-align">
              <i class="fas fa-asterisk" style="color: tomato;"></i> <b>Campos obligatorios</b>
          </p>
      </div>
  </div>    
  <div class="row">
      <div class="col s12 m12 l12">
          <hr class="hr-4">
      </div>
  </div>        
</section>

  <form id="form-cadena" action="{{route('cadena_save',['formAccion' => $formAccion, 'cadena' => $cadena])}}" method="POST" autocomplete="off">
    {{ csrf_field() }}

    <!-- section ~ 1. Datos generales -->
    <section>
      @include('cadena.cadena_form_1_datos_generales')
    </section>
    <!-- section ~ 2. Identidad -->
    <section id="identidad">
      @include('cadena.cadena_form_2_identidad')
    </section>
    <!-- section ~ 3. Documentación -->
    <section>
      @include('cadena.cadena_form_3_documentacion')
    </section>
    <!-- section ~ 4. Recolección -->
    <section>
      @include('cadena.cadena_form_4_recoleccion')>
    </section>
    <!-- section ~ 5. Empaque / embalaje -->
    <section>
      @include('cadena.cadena_form_5_embalaje')
    </section>
    <!-- section ~ 6. servidores_publicos -->
    <section>
      @include('cadena.cadena_form_6_servidor_publico')
    </section>
    <!-- section ~ 7. Traslado -->
    <section>
      @include('cadena.cadena_form_7_traslado')     
    </section>

    <!-- section ~ 8. Anexo-4 -->
    <section>
      @include('cadena.cadena_form_8_anexo_4')
    </section>


    <div class="row">
      <div class="col s2 offset-s3 m2 offset-m4 l2 offset-l10">
        <button type="submit" id="btn-cadena" class="btn-guardar" name="action">
          {{$formAccion}}
        </button>
      </div>
    </div>

  </form>

@endsection

@section('js')

  <!-- 1 IDENTIDAD -->
  <script src="{{asset('js/cadena/cadena_form_2_identidad.js')}}"></script>
  
  {{-- @if(Auth::user()->unidad_id == 1 )
  <script src="{{asset('js/cadenas/1_identidad_genetica.js')}}"></script>
  @else
  <script src="{{asset('js/cadenas/1_identidad.js')}}"></script>
  @endif --}}
  <!-- 3 DOCUMENTACIÓN -->
  {{-- <script src="{{asset('js/cadenas/2_documentacion.js')}}"></script> --}}
  <script src="{{asset('js/cadena/cadena_form_3_otro_especifique.js')}}"></script>
  <!-- 3 RECOLECCIÓN -->
  <script src="{{asset('js/cadenas/3_recoleccion.js')}}"></script>
  <!-- 5 SERVIDORES PÚBLICOS -->
  <script src="{{asset('js/cadenas/5_servidores_publicos.js')}}"></script>
  <!-- 6 SERVIDORES PÚBLICOS -->
  <script src="{{asset('js/cadena/cadena_form_6_servidor_publico.js')}}"></script>
  <!-- 7 TRASLADO -->
  {{-- <script src="{{asset('js/cadenas/6_traslado.js')}}"></script> --}}
  <script src="{{asset('js/cadena/cadena_form_7_traslado_recomendaciones.js')}}"></script>
  <!--Fecha actual para los formularios type date-->
  <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script>
  <!--Registro Cadena Custodia-->
  {{-- <script src="{{asset('js/cadenas/cadena_registrar.js')}}"></script> --}}
  <script src="{{asset('js/cadena/cadena_form.js')}}"></script>

  <!--select_naturaleza-->
  {{-- <script src="{{asset('js/cadena/cadena_naturaleza.js')}}"></script> --}}
  
  <script src="{{asset('js/cadena/cadena_form_actualizar_identificador_tabla.js')}}"></script>

  <script src="{{asset('js/cadena/cadena_tabla_armas.js')}}"></script>
  <script src="{{asset('js/autocomplete/autocomplete.js')}}"></script>
@endsection