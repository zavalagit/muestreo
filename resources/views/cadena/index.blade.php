@extends('template.template')


@section('title','Cadena Consultar')

@section('css')
   <link rel="stylesheet" href="{{asset('css/table.css')}}">
   <link rel="stylesheet" href="{{asset('css/btn.css')}}">
   <link rel="stylesheet" href="{{asset('css/modal/modal.css')}}">
   <link rel="stylesheet" href="{{asset('css/hr.css')}}">
   <style media="screen">
      td{
         border: 1px solid #c09f77;
      }
   </style>

   <link rel="stylesheet" href="{{asset('css/js_maker.css')}}">
@endsection

@section('header')
    
@endsection

@section('main')

   {{-- <span id="span-csrf" data-csrf="{{csrf_token()}}"></span> --}}

   {{-- <section> --}}
      <div class="row">
         <form class="col s12">
            <div class="row">
               <div class="input-field col s10 offset-s1">
                  <input id="input-buscar" type="text" placeholder="Buscar por:  N.U.C., Descripción" name="buscar" value="{{old('buscar')}}">
                  <label for="input-buscar"><i class="fas fa-folder"></i> ~ N.U.C., Descripción:</label>
               </div>
               <div class="input-field col s1">
                  <button class="btn-guardar" type="submit" id="buscar-btn">
                     <i class="fas fa-search i-buscar"></i> Buscar
                  </button>
               </div>
            </div>
         </form>
      </div>
   {{-- </section> --}}


   <div class="row">
      <div class="col s12">
         <table class="highlight">
            <thead>
               <tr>
                  <th class="th-center">Nº</th>
                  <th width="7%">FOLIO BODEGA</th>
                  <th width="10%">C.I. - P.P.</th>
                  <th width="8%">IDENTIFICADOR</th>
                  <th>DESCRIPCIÓN</th>
                  <th width="8%">DOCUMENTO</th>
                  <th width="8%">ACCIONES</th>
                  {{-- @if ( !in_array(Auth::user()->unidad_id,[1,2]) )
                  <th class="th-center">ARMA(S)</th>
                  <th class="th-center">ACUSE ARMA(S)</th>
                  @endif --}}
                  {{-- <th class="th-center">ANEXO 3</th>
                  <th class="th-center">ANEXO 4</th>
                  <th class="th-center">ETIQUETA</th> --}}
                  {{-- <th class="th-center">CLONAR</th>
                  <th class="th-center">EDITAR</th> --}}
                  <!--
                  <th>MAPA</th>
                  -->
               </tr>
            </thead>
            <tbody style="background-color: #c6c6c6 !important;">
               @isset($cadenas)                  
                  @forelse ($cadenas as $i => $cadena)
                     @php $filas=$cadena->indicios->count(); @endphp
                     <tr>
                        <!--contador-->
                        <td rowspan="{{$filas}}" width="2%" class="td-index">{{$i+1}}</td>
                        <!--folio-->
                        <td rowspan="{{$filas}}" class="td-folio td-top">                           
                           <b>{{$cadena->folio_bodega ?? '----'}}<b>                    
                        </td>
                        <!--nuc-->
                        <td rowspan="{{$filas}}" class="td-nuc td-top"> <b>{{$cadena->ci_pp}}</b> </td>
                        <!--indicios-->
                        @foreach ($cadena->indicios as $indicio)
                           @if ($loop->iteration > 1)
                              <tr>    
                           @endif
                           <!--identificador-->
                           <td class="td-top"><b>{{$indicio->identificador}}</b></td>
                           <!--descripcion-->
                           <td class="td-top"><b>{{$indicio->descripcion}}</b></td>
                           
                           @if ($loop->first)
                              <!--documentos-->
                              <td rowspan="{{$filas}}" class="td-top">
                                 <!--anexo3-->
                                 <a href="" class="btn-anexo e-documento"
                                    data-cadena-id="{{$cadena->id}}"
                                    data-folio="{{$cadena->folio_bodega}}"
                                    data-nuc="{{$cadena->ci_pp}}"
                                    data-anexo-tipo="anexo-3"
                                    data-url="{{route('cadenas.pdf',['cadena'=>$cadena->id])}}" 
                                 >
                                    <i class="fas fa-file-pdf i-color"></i> <span class="i-referencia">Anexo 3</span>
                                 </a> <hr>
                                 <!--anexo4-->
                                 {{-- <a href="" class="btn-anexo e-documento" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-4">
                                    <i class="fas fa-file-pdf i-color"></i> <span class="i-referencia">Anexo 4</span>
                                 </a> <hr> --}}
                                 <!--etiqueta-->
                                 <a href="" class="btn-etiqueta e-documento"
                                    data-etiqueta-form="{{route('etiquetas.form',['cadena'=>$cadena])}}"
                                    data-form-action="{{route('etiquetas.pdf',['cadena'=>$cadena])}}"
                                 >
                                    <i class="fas fa-file-pdf i-color"></i> <span class="i-referencia">Etiqueta</span>
                                 </a> <hr>
                                 <!--acuse arma-->
                                 @if ($cadena->indicios->where('indicio_is_arma',true)->count() && $cadena->indicios->where('indicio_is_arma',true)->first()->arma()->count())                                 
                                    <a href="/arma-acuse-pdf/{{$cadena->id}}" class="e-documento" target="_blank">
                                       <i class="fas fa-file-pdf i-color"></i> <span class="i-referencia">Acuse Arma</span>
                                    </a>
                                 @endif
                              </td>
                              <!--acciones-->
                              <td rowspan="{{$filas}}" class="td-top">
                                 <!--editar-->
                                 <a href="/cadena-form/editar/{{$cadena->id}}" class="e-accion {{$cadena->editar == 'no' ? 'ocultar' : ''}}">
                                    <i class="fas fa-pen-square i-color"></i> <span class="i-referencia">Editar</span>
                                 </a> <hr class="{{$cadena->editar == 'no' ? 'ocultar' : ''}}">
                                 <!--clonar-->
                                 <a href="/cadena-form/clonar/{{$cadena->id}}" class="e-accion"><i class="fas fa-copy i-color"></i> <span class="i-referencia">Clonar</span></a> <hr>
                                 <!--editar arma-->
                                 @if ($cadena->indicios->where('indicio_is_arma',true)->count())                                 
                                    <a href="/arma-form/{{$cadena->indicios->where('indicio_is_arma',true)->first()->arma()->count() ? 'editar' : 'registrar'}}/cadena/{{$cadena->id}}" class="e-accion">
                                       <i class="fas fa-pen-square i-color"></i> <span class="i-referencia">Ediatr arma(s)</span></a>
                                    </a>
                                 @endif
                              </td>
                              <!--armas-->
                              {{-- @if ( !in_array(Auth::user()->unidad_id,[1,2]) )
                                 <!--registrar o editar arma-->
                                 <td rowspan="{{$filas}}" class="td-center">
                                    @if ($cadena->indicios->where('indicio_is_arma',true)->count())                                 
                                    <a href="/arma-form/{{$cadena->indicios->where('indicio_is_arma',true)->first()->arma()->count() ? 'editar' : 'registrar'}}/cadena/{{$cadena->id}}">
                                       <i class="fas fa-pen-square fa-lg i-dorado"></i>
                                    </a>
                                    @else
                                    ---
                                    @endif
                                 </td>
                                 <!--acuse arma-->
                                 <td rowspan="{{$filas}}" class="td-center">
                                    @if ($cadena->indicios->where('indicio_is_arma',true)->count() && $cadena->indicios->where('indicio_is_arma',true)->first()->arma()->count())                                 
                                    <a href="/arma-acuse-pdf/{{$cadena->id}}" target="_blank">
                                       <i class="fas fa-file-pdf fa-lg i-dorado"></i>
                                    </a>
                                    @else
                                    ---
                                    @endif
                                 </td>
                              @endif --}}
                              {{-- <!--anexo 3-->
                              <td rowspan="{{$filas}}" width="4%" class="td-center">
                                 <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-3">
                                    <i class="fas fa-file-pdf fa-lg i-dorado"></i>
                                 </a>
                              </td>
                              <!--anexo 4-->
                              <td rowspan="{{$filas}}" width="4%" class="td-center">
                                 <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-4">
                                    <i class="fas fa-file-pdf fa-lg i-dorado"></i>
                                 </a>
                              </td>
                              <!--etiqueta-->
                              <td rowspan="{{$filas}}" width="4%" class="td-center">
                                 <a href="" class="btn-etiqueta" data-cadena-id="{{$cadena->id}}">
                                    <i class="fas fa-file-pdf fa-lg i-dorado"></i>
                                 </a>
                              </td> --}}
                              {{-- <!--clonar-->
                              <td rowspan="{{$filas}}" width="3%" class="td-center">
                                 <a href="/cadena-form/clonar/{{$cadena->id}}">
                                    <i class="fas fa-copy fa-lg i-dorado"></i>
                                 </a>
                              </td>
                              <!--editar-->
                              <td rowspan="{{$filas}}" width="3%" class="td-center">
                                 @if ($cadena->editar === 'no')
                                    <a href="" class="a-disabled"><i class="fa fa-lock fa-lg i-dorado"></i></a>
                                 @elseif($cadena->editar === 'si')
                                    <a href="/cadena-form/editar/{{$cadena->id}}"><i class="fas fa-pen-square fa-lg i-dorado"></i></a>
                                 @endif
                              </td> --}}
                           @endif
                        @endforeach
                     </tr>
                  @empty
                     <tr>
                        <td colspan="9" class="td-aviso">No se encontraron coincidencias</td>
                     </tr>
                  @endforelse 
               @endisset
               @empty($cadenas)
                  <tr>
                     <td colspan="9" class="td-aviso">Realice una busqueda</td>
                  </tr>
               @endempty
            </tbody>
         </table>
      </div>
   </div>


<!--modal anexos-->
@include('modal.modal_anexos')

<!--modal etiqueta-->
@include('cadena.etiqueta.create')

@endsection

@section('js')
   <script src="{{asset('js/modal/modal.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/cadena/cadena_anexos_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadena/etiqueta_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/sesion_perito/buscar_maker.js')}}" ></script>

   @include('general.error_method_get')
@endsection
