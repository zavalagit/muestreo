{{-- @extends('plantilla.template2') --}}
@extends('template.template')
<!--section - css-->
@section('css')
   <link rel="stylesheet" href="{{asset('css/entrada/columna_fija.css')}}">
   <link rel="stylesheet" href="{{asset('css/modal/modal.css')}}">
   <link rel="stylesheet" href="{{asset('css/entrada/modal_acciones.css')}}">
   <link rel="stylesheet" href="{{asset('css/entrada/modal_observacion.css')}}">
   <link rel="stylesheet" href="{{asset('css/entrada/modal_inhabilitar_cadena.css')}}">
   <link rel="stylesheet" href="{{asset('css/colores.css')}}">
   <link rel="stylesheet" href="{{asset('css/table.css')}}">
   <link rel="stylesheet" href="{{asset('/css/nav/sidenav_buscador2.css')}}">
   <link rel="stylesheet" href="{{asset('plugins/viewer_js/css/viewer.css')}}">
   <link rel="stylesheet" href="{{asset('/css/componentes/componente_consultar_acciones.css')}}">

   <style media="screen">
      #tabla-entradas{
         width: 5000px !important;
      }
   </style>
@endsection
<!--section - tittle-->
@section('title','ENTRADAS')
<!--section - header-->
@section('header')
   <div class="col l3">
      <span style="color:#fff; font-weight:bold;">Registros: {{isset($cadenas) ? $cadenas->count() : "---"}}</span>
   </div>
   <div class="col l2">
      <a href="" id="btn-guia-colores">
         <span style="color: #fff; font-weight:bold;">Guía de colores <i class="far fa-hand-pointer"></i></span>
      </a>
   </div>
   <div class="col offset-l6 l1 center-align">
      <a href="#" class="btn-sidenav-buscador-open pulse"><i class="fas fa-search" style="color: #fff;"></i></a>
   </div>
@endsection
<!--section - main-->
@section('main')
   @component('componentes.componente_consultar_acciones')
   <a href="{{route('prestamo_multiple_form',['formAccion'=>'prestar','cadenas'=>json_encode( $cadenas->pluck('id') )])}}" target="_blank">
      <i style="color: #152f4a;" class="fas fa-caret-right fa-lg"></i> <i style="color: #152f4a;" class="fas fa-caret-right fa-lg"></i> <span>Prestamo-multiple</span>
   </a>
   {{-- <a href="{{route('prestamo_multiple_prueba',['prestamos' => json_encode( $prestamos->pluck('id') )])}}" target="_blank">
      <i style="color: greenyellow" class="fas fa-file-excel"></i> <span>Listado</span>
   </a> --}}
   @endcomponent

   <div class="div-table-scroll">
      <table id="tabla-entradas" class="highlight">
         <thead>
            <tr>
               <th class="sticky-1 th-center">Nº</th>
               <th class="sticky-2 th-center">ACCIÓN</th>
               <th class="sticky-3">FOLIO</th>
               <th>ESTADO</th>
               <th>N.U.C.</th>
               @if (Auth::user()->tipo == 'administrador')
               <th>ID CADENA</th>
               <th>REGIÓN</th>
               <th>SISTEMA</th>
               <th>S. P. REALIZA</th>
               @endif
               <th>HORA</th>
               <th>FECHA</th>
               <th>NATURALEZA</th>
               <th>ENTREGA</th>
               <th>RECIBE</th>
               <th>INDICIO_ID</th>
               <th>ESTADO DEL INDICIO</th>
               <th>IDENTIFICADOR</th>
               <th>DESCRIPCIÓN</th>
               <th>CANTIDAD I/E</th>
               <th>RESGUARDO</th>
            </tr>
         </thead>
         <tbody>
            @php $n = 1; @endphp
            @forelse ($cadenas as $key => $cadena)
               <!--contador-->
               <td rowspan="{{$cadena->indicios->count()}}" class="sticky-1 td-index"><b>{{$n++}}</b></td>
               <!--acción-->
               <td rowspan="{{$cadena->indicios->count()}}" class="sticky-2 td-center">
                  <a href="" class="btn-acciones" data-cadena-folio="{{$cadena->folio_bodega}}" data-cadena-id="{{$cadena->id}}">
                     <i style="color: #152f4a;" class="fas fa-ellipsis-h fa-lg"></i>
                  </a>
               </td>
               <!--folio-->
               @isset($cadena->entrada)
                  <td rowspan="{{$cadena->indicios->count()}}" class="sticky-3"><b>{{$cadena->folio_bodega}}</b></td> 
               @endisset
               @empty($cadena->entrada)
                  <td rowspan="{{$cadena->indicios->count()}}" class="sticky-3"><b>---</b></td> 
               @endempty
               <!--estado-->
               <td rowspan="{{$cadena->indicios->count()}}" style="width: 150px; background-color:#394049;">
                  @include('entrada.entrada_estado')
               </td>
               <!--nuc-->
               <td rowspan="{{$cadena->indicios->count()}}" width="300px" style="background-color: #394049;color: #c6c6c6 !important;"><b>{{$cadena->nuc}}</b></td>
               <!--campos de admistrador-->
               @if (Auth::user()->tipo == 'administrador')
               <td rowspan="{{$cadena->indicios->count()}}" width="120px">{{$cadena->id}}</td>
               <td rowspan="{{$cadena->indicios->count()}}" width="150px">{{$cadena->fiscalia->nombre}}</td>
               <td rowspan="{{$cadena->indicios->count()}}" width="80px">{{ ( isset($cadena->user_id) ) ? 'Si' : 'No'}}</td>
               <td rowspan="{{$cadena->indicios->count()}}" width="400px">{{ ( isset($cadena->user_id) ) ? "{$cadena->user->name}" : '---'}}</td>
               @endif
               <!--datos entrada-->
               @isset($cadena->entrada)
                  <!--hora-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="120px">{{date('H:i:s',strtotime($cadena->entrada->hora))}}</td>
                  <!--fecha-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="120px">{{date('d-m-Y',strtotime($cadena->entrada->fecha))}}</td>
                  <!--naturaleza-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="200px">{{$cadena->entrada->naturaleza->nombre}}</td>
                  <!--perito entrega-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="400px">{{$cadena->entrada->perito->nombre}}</td>
                  <!--rb recibe-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="400px">{{$cadena->entrada->user->name}}</td>
               @endisset
               @empty($cadena->entrada)
                  <!--hora-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="120px">---</td>
                  <!--fecha-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="120px">---</td>
                  <!--naturaleza-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="200px">---</td>
                  <!--perito entrega-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="400px">---</td>
                  <!--rb recibe-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="400px">---</td>
               @endempty
               <!--indicios-->
               @foreach ($cadena->indicios as $indicio)
                     @if ($loop->iteration > 1)
                        <tr>    
                     @endif
                        <!--indicio_id-->
                        <td style="border: 1px solid #c09f77; border-left: 1px solid #c09f77;">{{$indicio->id}}</td>
                        <!--indicio_estado-->
                        <td style="border: 1px solid #c09f77; border-left: 1px solid #c09f77;"> @include('indicio.indicio_estado') </td>
                        <!--indicio_identificador-->
                        <td width="200px" style="border: 1px solid #c09f77; border-left: 1px solid #c09f77;">{{$indicio->identificador}}</td>
                        <!--indicio_descripción-->
                        <td style="text-align:justify; border: 1px solid #c09f77;">{{$indicio->descripcion}}</td>
                        <!--indicio_cantidad_indicios-->
                        <td class="td-center" width="130px">{{$indicio->numero_indicios}}</td>
                        <td width="500px" style="padding-left: 5px !important;">
                           @isset($indicio->ubicacion_id)
                              {{$indicio->ubicacion->nombre}}
                           @endisset
                           @empty($indicio->ubicacion_id)
                              No hay ubicación
                           @endempty
                        </td>
                  </tr>
               @endforeach
            @empty
               <tr>
                  <td colspan="11">
                     <blockquote class="yellow lighten-2">No hay registros</blockquote>
                  </td>
               </tr> 
            @endforelse
         </tbody>
      </table>
   </div>

<!--Modal acciones-->
<div id="modal-acciones" class="modal">
   <div class="modal-cerrar right-align">
      <a href="#" class="btn-modal-cerrar"><i class="fas fa-window-close fa-lg" style="color:#d50000"></i></a>
   </div>
   <div class="row">
      <div id="modal-header" class="col s12 modal-acciones-header">
         <p class="header-titulo header-folio"></p>
         <p class="header-titulo">Acciones</p>
      </div>
   </div>
   <div id="modal-body" class="row modal-acciones-body"> 
      {{-- <div style="width: 98%; padding-top: 10px; padding-bottom: 5px;" class="right-align">
         <i style="color: #394049;" class="fas fa-hammer fa-flip-horizontal fa-2x"></i>
      </div> --}}
      <div id="modal-contenido" class="row" style="padding:10px 0 !important;">

      </div>
   </div>
   <div id="modal-footer" class="modal-acciones-footer">
      {{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a> --}}
   </div>
</div>
<!--Modal inhabilitar-cadena-->
<div id="modal-inhabilitar" class="modal">
   <div class="modal-cerrar right-align">
      <a href="#" class="btn-modal-cerrar"><i class="fas fa-window-close fa-lg" style="color:#d50000"></i></a>
   </div>
   <div class="row">
      <div id="modal-header" class="col s12 modal-inhabilitar-header">
         <p class="header-titulo header-folio"></p>
         <p class="header-titulo">Inhabilitar cadena</p>
      </div>
   </div>
   <div id="modal-body" class="row modal-inhabilitar-body">
      <div style="width: 98%;" class="right-align">
         <i style="color: #394049;" class="fas fa-pen-square fa-2x"></i>
      </div>
      <div id="modal-contenido" class="row" style="margin-bottom:10px !important;">

      </div>
   </div>
   <div id="modal-footer" class="modal-inhabilitar-footer">
      {{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a> --}}
   </div>
</div>
<!--Modal observación-->
<div id="modal-observacion" class="modal">
   <div class="modal-cerrar right-align">
      <a href="#" class="btn-modal-cerrar"><i class="fas fa-window-close fa-lg" style="color:#d50000"></i></a>
   </div>
   <div class="row">
      <div id="modal-header" class="col s12 modal-observacion-header">
         <p class="header-titulo header-folio"></p>
         <p class="header-titulo">Observación - Nota</p>
      </div>
   </div>
   <div id="modal-body" class="row modal-observacion-body">
      <div style="width: 98%;" class="right-align">
         <i style="color: #394049;" class="fas fa-sticky-note fa-2x"></i>
      </div>
      <div id="modal-contenido">
         <!--observacion o nota-->
      </div>
   </div>
   <div id="modal-footer" class="modal-observacion-footer">
      {{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a> --}}
   </div>
</div>

<!--buscador-->
@include('bodega.entradas_buscador')
<!--guia_colores-->
<div class="row" style="display: none;">
   <div class="col s12">
      <ul id="imagen-guia-colores">
         <li><img src="{{asset('imagenes/imagen_guia_colores.png')}}" alt="Imagen-guia-colores"></li>         
      </ul>
   </div>
</div>

@endsection

@section('js')
<script src="{{asset('js/busqueda.js')}}"></script>
<script src="{{asset('js/modal/modal.js')}}"></script>
<script src="{{asset('js/cadenas/cadena_accion.js')}}"></script>
<script src="{{asset('js/cadenas/cadena_estado.js')}}"></script>
<script src="{{asset('js/cadenas/cadena_inhabilitar.js')}}"></script>
<script src="{{asset('js/cadenas/cadena_reset.js')}}"></script>
<script src="{{asset('js/cadenas/cadena_observacion.js')}}"></script>
<script src="{{asset('js/prestamo/prestamo_multiple_blank.js')}}"></script>
<script src="{{asset('/js/general/sidenav_buscador.js')}}"></script>

<script src="{{asset('plugins/viewer_js/js/viewer.js')}}"></script>
<script src="{{asset('plugins/viewer_js/js/jquery-viewer.js')}}"></script>

   <script>
      var texto = $('#buscar-texto').val();
       if(texto != ''){
         console.log('entro:' + texto);
         $('td').mark(texto,{
         "separateWordSearch": false,
         });
      }
   </script>

   <script>
      $('#btn-guia-colores').click(function(e){
         e.preventDefault();
         console.log('guia-colores');
         $('#imagen-guia-colores').viewer('show');
      });
   </script>
@endsection
