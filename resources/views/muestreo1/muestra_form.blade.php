@extends('template.template')

@section('css')
<link rel="stylesheet" href="{{asset('css/cadenas/registrar.css')}}">
<link rel="stylesheet" href="{{asset('css/form/form.css')}}">
@endsection

@section('title','REGISTRO MUESTRA')

@section('main')
<section>
    <div class="row" style="margin: 0 !important; line-height: 0 !important">
        <div class="col s12 m12 l12">
            <p class="right-align">
                <i class="fas fa-asterisk" style="color: tomato;"></i> <b>Campos obligatorios</b>
            </p>
            @if ( $formAccion == 'editar' )
                <p class="right-align">
                    <i class="fas fa-asterisk" style="color: green;"></i> <b>Campos que puede modificar</b>
                </p>   
            @endif
        </div>
    </div>    
    <div class="row">
        <div class="col s12 m12 l12">
            <hr class="hr-4">
        </div>
    </div>        
</section>

@section('header')
    
@endsection

<section id="btn-nuevo-registro" class="ocultar">
    <div class="row">
        <div class="col s12 m12 l11">
            <p class="right-align" style="color: tomato;"><b>Si desea realizar un <u>nuevo registro</u> de clic en el boton</b></p>
        </div>
        <div class="col s12 m12 l1">                    
            <a href="{{route('peticion_form',['formAccion' => 'registrar'])}}" class="btn-guardar">N. REGISTRO</a>
        </div>
        <div class="col s12">
            <hr class="hr-2">
        </div>
    </div>
</section>


   <form class="col s12" id="form-peticion" autocomplete="off" method="POST" action="">
        {{ csrf_field() }}   

        <input type="hidden" id="peticion-etapa" name="peticion_etapa" value="">

        <!--1ra etapa-->
        <section id="peticion-etapa-uno">
            @include('muestreo.datos_muestra')
        </section>
        
        

        <div class="row {{ !in_array($formAccion,['editar','clonar']) ? 'ocultar' : ''}}">
            <div class="col s12 m12 l2 offset-l10">
                <button type="submit" class="btn-guardar">{{$formAccion}}</button>
            </div>
        </div>
    </form>
        
</div>



<!--Modal Servidor Público-->
<div id="modal-sp" class="modal">
    <div class="modal-content modal-contenido-sp">
       <h4>Modal Header</h4>
       <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
       <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
 </div>
@endsection

@section('js')


{{-- @if ( (Auth::user()->unidad_id == 1) && (Auth::user()->fiscalia_id == 4) )
<script src="{{asset('js/peticiones/peticion_registrar_quimica.js')}}"></script>
@else
@endif --}}
<script src="{{asset('js/peticion/peticion_form.js')}}"></script>
<script src="{{asset('js/peticion/peticion_editar.js')}}"></script>
<script src="{{asset('js/peticion/peticion_necropsia.js')}}"></script>
<script src="{{asset('js/especialidad/especialidad_form_select_options.js')}}"></script>
<script src="{{asset('js/solicitud/solicitud_form_select_options.js')}}"></script>
<script src="{{asset('js/necropsia/necropsia_form_select_options.js')}}"></script>
<script src="{{asset('js/unidad/unidad_form_select_options.js')}}"></script>


<script src="{{asset('js/peticiones/petadscripcion.js')}}"></script>
{{-- <script src="{{asset('js/peticiones/peticion_necropsia.js')}}"></script> --}}
{{-- <script src="{{asset('js/peticiones/peticion_necropsia_dictamen.js')}}"></script> --}}
{{-- <script src="{{asset('js/peticiones/peticion_necropsia_fecha.js')}}"></script> --}}
{{-- <script src="{{asset('js/servidores_publicos/servidor_publico_agregar.js')}}"></script> --}}


<script src="{{asset('js/autocomplete/autocomplete.js')}}"></script>


{{-- @isset($peticion)
<script src="{{asset('js/peticiones/peticion_etapas.js')}}"></script>
@endisset --}}
@endsection
