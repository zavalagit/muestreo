@extends('template.template')

@section('css')
{{-- <link rel="stylesheet" href="{{asset('css/cadenas/registrar.css')}}"> --}}
<link rel="stylesheet" href="{{asset('css/form/form.css')}}">

<style>
    table{
        border: 1px solid;
    }
    th{
        
    }
    td{
        border: 1px solid;
    }
</style>
@endsection

@section('title','REGISTRO MUESTREO')

@section('main')
<section>
    <div class="row" style="margin: 0 !important; line-height: 0 !important">
        <div class="col s12 m12 l12">
            <p class="right-align">
                <i class="fas fa-asterisk" style="color: tomato;"></i> <b>Campos obligatorios</b>
            </p>
            {{-- @if ( $formAccion == 'editar' )
                <p class="right-align">
                    <i class="fas fa-asterisk" style="color: green;"></i> <b>Campos que puede modificar</b>
                </p>   
            @endif --}}
        </div>
    </div>    
    <div class="row">
        <div class="col s12 m12 l12">
            <hr class="hr-4">
        </div>
    </div>        
</section>


{{-- <section id="btn-nuevo-registro" class="ocultar">
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
</section> --}}

<div class="row">
   {{-- <form class="col s12" id="form-peticion" autocomplete="off" method="POST" action="{{route('muestreos.store',['formAccion' => $formAccion, 'peticion' => isset($peticion) ? $peticion : ''])}}"> --}}
   <form class="col s12" id="form-peticion" autocomplete="off" method="POST" action="{{route('pcrs.store')}}">
        {{ csrf_field() }}   
        @include('pcr.pcr_form')
    </form>    
</div>
@endsection

@section('js')
<script src="{{asset('js/autocomplete/autocomplete.js')}}"></script>
@endsection