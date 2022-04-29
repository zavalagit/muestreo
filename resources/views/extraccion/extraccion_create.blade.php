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
   <form class="col s12" id="form-peticion" autocomplete="off" method="POST" action="{{route('muestreos.store')}}">
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
                        <td rowspan="3">D-LG-I001 Instructivo de extracción de ADN por el método automatizado Maxwell</td>
                        <td>Lote del buffer de lisis</td>
                        <td>Lote del buffer de elucion</td>
                    </tr>
                    <tr>
                        <td> <input type="text" placeholder="Valor de lote" name="lote_buffer_lisis1"> </td>
                        <td> <input type="text" placeholder="Valor de lote" name="lote_buffer_elucion1"> </td>
                    </tr>
                    <tr>
                        <td> <input type="text" placeholder="Valor de lote" name="lote_buffer_lisis2"> </td>
                        <td> <input type="text" placeholder="Valor de lote" name="lote_buffer_elucion2"> </td>
                    </tr>
                </table>
            </div>
            <div class="col s12">
                <table>
                    <tr>
                        <td rowspan="3">
                            CUSTOM:
                            <label>
                                <input type="radio" name="custom" value="1"/>
                                <span>Aplica</span>
                            </label>
                            <label>
                                <input type="radio" name="custom" value="0"/>
                                <span>N/A</span>
                            </label>
                        </td>
                        <td>Buffer de desmineralizacion</td>
                        <td> <input type="text" placeholder="Valor de desmineralización" name="custom_buffer_desmineralizacion"> </td>
                        <td rowspan="3">
                            Bone:
                            <label>
                                <input type="radio" name="bone" value="1"/>
                                <span>Aplica</span>
                            </label>
                            <label>
                                <input type="radio" name="bone" value="0"/>
                                <span>N/A</span>
                            </label>
                        </td>
                        <td>Buffer de Lisis</td>
                        <td> <input type="text" placeholder="Valor de buffer lisis" name="bone_buffer_lisis"> </td>
                    </tr>
                    <tr>
                        <td>Proteinasa K</td>
                        <td> <input type="text" placeholder="Valor de proteinasa k" name="custom_proteinasa_k"> </td>
                        <td>Proteinasa K</td>
                        <td> <input type="text" placeholder="Valor de proteinasa k" name="bone_proteinasa_k"> </td>
                    </tr>
                    <tr>
                        <td>Thioglycerol</td>
                        <td> <input type="text" placeholder="Valor de thiglycerol" name="custom_thiglycerol"> </td>            
                        <td>DTT</td>                    
                        <td> <input type="text" placeholder="Valor de dtt" name="bone_dtt"> </td>              
                    </tr>
                </table>
            </div>

            <div class="col s12">
                <table>
                    <tr>
                        <td>TermoMixer</td>
                        <td>Temperatura</td>
                        <td>rpm</td>
                        <td>tiempo</td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="radio" name="termomixer" value="LGIH-EXT1-TX-01"/>
                                <span>LGIH-EXT1-TX-01</span>
                            </label> <br>
                            <label>
                                <input type="radio" name="termomixer" value="LGIH-EXT1-TX-02"/>
                                <span>LGIH-EXT1-TX-02</span>
                            </label> <br>
                            <label>
                                <input type="radio" name="termomixer" value="LGIH-EXT1-TX-03"/>
                                <span>LGIH-EXT1-TX-03</span>
                            </label> <br>
                            <label>
                                <input type="radio" name="termomixer" value="otro"/>
                                <span>Otro:</span>
                            </label>
                            <div class="input-field inline" style="width: 80%">
                                <input type="text" placeholder="" disabled name="termomixer_otro">
                            </div>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="temperatura" value="56"/>
                                <span>56 ºC</span>
                            </label> <br>
                            <label>
                                <input type="radio" name="temperatura" value="otro"/>
                                <span>Otro:</span>
                            </label>
                            <div class="input-field inline" style="width: 80%">
                                <input type="text" placeholder="" disabled name="temperatura_otro">
                            </div>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="rpm" value="1100"/>
                                <span>1100</span>
                            </label> <br>
                            <label>
                                <input type="radio" name="rpm" value="otro"/>
                                <span>Otro:</span>
                            </label>
                            <div class="input-field inline" style="width: 80%">
                                <input type="text" placeholder="" disabled name="rpm_otro">
                            </div>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="tiempo" value="24"/>
                                <span>24</span>
                            </label> <br>
                            <label>
                                <input type="radio" name="tiempo" value="tiempo_otro"/>
                                <span>Otro:</span>
                            </label>
                            <div class="input-field inline" style="width: 80%">
                                <input type="text" placeholder="" disabled name="tiempo_otro">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col s12">
                <table>
                    <tr>
                        <td>Fecha purificación</td>
                        <td> <input type="date" placeholder="" name="termomixer_otro"> </td>
                        <td rowspan="2">Lote del kit</td>
                        <td rowspan="2"><input type="text" placeholder=""    name="lote_kit"> </td>
                    </tr>
                    <tr>
                        <td>Hora de Inicio</td>
                        <td> <input type="time" placeholder="" name="termomixer_otro"> </td>
                    </tr>
                    <tr>
                        <td>Purificador</td>
                        <td colspan="3">Identificación del equipo</td>
                    </tr>
                    <tr>
                        <td> <input type="time" placeholder="" name="termomixer_otro"> </td>
                        <td colspan="3">valor - Identificación del equipo</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="input-field col s12">
                                <textarea id="textarea1" class="materialize-textarea"></textarea>
                                <label for="textarea1">Textarea</label>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col s12">
                <table>
                    <tr>
                        <td>Supervición</td>
                        <td>valor - Supervición</td>
                    </tr>
                </table>
            </div>

        </div>

        {{-- <div class="row {{ !in_array($formAccion,['editar','clonar']) ? 'ocultar' : ''}}"> --}}
        <div class="row">
            <div class="col s12 m12 l2 offset-l10">
                <button type="submit" class="btn-guardar">{{$formAccion}}</button>
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
