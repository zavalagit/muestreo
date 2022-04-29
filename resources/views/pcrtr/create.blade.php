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

@section('header')
    
@endsection

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
   <form class="col s12" id="form-peticion" autocomplete="off" method="POST" action="{{route('pcrtrs.store')}}">
        {{ csrf_field() }}   

        <div class="row">

            <!--fecha-->
            <div class="input-field col l2">
                <input type="date" id="fecha" class="center-align" name="fecha">
                <label class="active" for="fecha"><i class="fas fa-calendar-alt"></i> ~ FECHA</label>
            </div>
            <!--hora-->
            <div class="input-field col l2">
                <input type="time" id="hora" class="center-align" name="hora">
                <label class="active" for="hora"><i class="fas fa-calendar-alt"></i> ~ Hora</label>
            </div>

            
            <div class="col s12">
                <table>
                    <tr>
                        <td>Biomeck 400</td>
                        <td>
                            <div>
                                <label>
                                    <input type="radio" name="biomek_400" value="1"/>
                                    <span>Si</span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <label>
                                    <input type="radio" name="biomek_400" value="0"/>
                                    <span>No</span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <label>
                                    <input type="radio" name="biomek_400"/>
                                    <span>NA</span>
                                </label>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col s12">
                <table>
                    <tr>
                        <td>Equipo</td>
                        <td colspan="2">
                            <select name="equipo_id">
                                <option value="" disabled selected>Seleccione un Equipo</option>
                                @foreach ($equipos->sortBy('nombre')->values() as $i => $equipo)
                                    <option value="{{$equipo->id}}">{{$i+1}}. {{$equipo->nombre}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <div class="input-field">
                                <input type="text" id="curva-estandar" name="curva_estandar">
                                <label for="curva-estandar">Curva estándar</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2">Lote del Kit Power Quant</td>
                        <td rowspan="2">
                            <div class="input-field">
                                <input type="text" id="lote-kit-power-quant" name="lote_kit_power_quant">
                                <label for="lote-kit-power-quant">Lote Kit Power Quant</label>
                            </div>
                        </td>
                        <td>Fecha de elaboración</td>
                        <td>
                            <div class="input-field">
                                <input type="date" id="fecha_elaboracion" name="fecha_elaboracion">                               
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Perito que realiza</td>
                        <td>Valor-perito realiza</td>
                    </tr>
                    <tr>
                        <td>r2</td>
                        <td>
                            <div class="input-field">
                                <input type="text" id="r2" name="r2">
                                <label for="r2">r2</label>
                            </div>
                        </td>
                        <!--eficiencia-->
                        <td>Eficiencia</td>
                        <td>
                            <div class="input-field">
                                <input type="text" id="eficiencia" name="eficiencia">
                                <label for="eficiencia">Eficiencia</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="input-field">
                                <textarea id="observaciones" class="materialize-textarea" name="observaciones"></textarea>
                                <label for="observaciones">Observaciones</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Supervición</td>
                        <td colspan="3">valor - Supervición</td>
                    </tr>
                </table>
            </div>

        </div>

        {{-- <div class="row {{ !in_array($formAccion,['editar','clonar']) ? 'ocultar' : ''}}"> --}}
        <div class="row">
            <div class="col s12 m12 l2 offset-l10">
                <button type="submit" class="btn-guardar">Guardar</button>
            </div>
        </div>
    </form>
        
</div>
@endsection

@section('js')


{{-- @if ( (Auth::user()->unidad_id == 1) && (Auth::user()->fiscalia_id == 4) )
<script src="{{asset('js/peticiones/peticion_registrar_quimica.js')}}"></script>
@else
@endif --}}
{{-- <script src="{{asset('js/peticion/peticion_form.js')}}"></script>
<script src="{{asset('js/peticion/peticion_editar.js')}}"></script>
<script src="{{asset('js/peticion/peticion_necropsia.js')}}"></script>
<script src="{{asset('js/especialidad/especialidad_form_select_options.js')}}"></script>
<script src="{{asset('js/solicitud/solicitud_form_select_options.js')}}"></script>
<script src="{{asset('js/necropsia/necropsia_form_select_options.js')}}"></script>
<script src="{{asset('js/unidad/unidad_form_select_options.js')}}"></script> --}}


{{-- <script src="{{asset('js/peticiones/petadscripcion.js')}}"></script> --}}
{{-- <script src="{{asset('js/peticiones/peticion_necropsia.js')}}"></script> --}}
{{-- <script src="{{asset('js/peticiones/peticion_necropsia_dictamen.js')}}"></script> --}}
{{-- <script src="{{asset('js/peticiones/peticion_necropsia_fecha.js')}}"></script> --}}
{{-- <script src="{{asset('js/servidores_publicos/servidor_publico_agregar.js')}}"></script> --}}


<script src="{{asset('js/autocomplete/autocomplete.js')}}"></script>


{{-- @isset($peticion)
<script src="{{asset('js/peticiones/peticion_etapas.js')}}"></script>
@endisset --}}
@endsection