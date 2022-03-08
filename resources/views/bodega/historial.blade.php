{{--eliminar--}}
@extends('bodega.plantilla')

@section('titulo')
   HISTORIAL
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<link rel="stylesheet" href="{{asset('plugins/viewer_js/css/viewer.css')}}">
<link rel="stylesheet" href="{{asset('css/jconfirm/jconfirm_theme.css')}}">
   {{-- <link rel="stylesheet" href="{{asset('/css/tablas')}}"> --}}
   {{-- <link rel="stylesheet" href="{{asset('css/modal/modal.css')}}"> --}}
   <style type="text/css">
      body{
         margin: 0 !important;
         padding: 0 !important;
      }
      .table-width{
         width: 230% !important;
      }
      /* table{
         width: 230% !important;
      } */
      td{
         vertical-align: top !important;
      }
      h5{
       margin: 0 !important;
         padding: 0 !important;
      }
      blockquote{
         padding: 1px 0 !important;
         color: #fff !important;
         background-color: #112046 !important;
         font-size: 13px !important;
         text-align: center;
         margin: 0 !important;
      }
      .blockquote-aviso{
         color: #000 !important;
         text-align: left;
         padding-left: 10px !important;
      }

      .fa-file-pdf-o{
         color: red;
         font-size: 20px;
      }
   </style>
@endsection

@section('contenido')
   <div class="container">
      <!--anexos-->
      <div class="row">
         @component('componentes.componente_seccion_titulo')
            @slot('mensaje','1. ANEXOS ~ ')
            @slot('icono','fas fa-file-pdf')
         @endcomponent
   
         <div class="col s12">
            <table>
               <thead>
                  <tr>
                     <th>ANEXO</th>
                     <th>ANEXO 4</th>
                     <th>ETIQUETA</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     @if($cadena->user_id != NULL)
                        <td>
                           <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-3">
                              <i style="color: #c09f77;" class="fas fa-file-pdf fa-lg"></i>
                           </a>
                        </td>
                        <td>
                           <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-4">
                              <i style="color: #c09f77;" class="fas fa-file-pdf fa-lg"></i>
                           </a>
                        </td>
                        <td>
                           <a href="" class="btn-etiqueta" data-cadena-id="{{$cadena->id}}">
                              <i class="fas fa-file-pdf fa-lg i-dorado"></i>
                           </a>
                        </td>
                     @else
                        <td colspan="3">
                           <blockquote class="blockquote-aviso yellow lighten-2"><b>NO ES CADENA DE SISTEMA</b></blockquote>
                        </td>
                     @endif
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="col s12"><hr class="hr-1"></div>
      </div>
      <!--ingreso-->
      <div class="row">
         <div class="col s12">
            <table>
               <thead>
                  <tr>
                     <th>FOLIO</th>
                     <th>H. INGRESO</th>
                     <th>F. INGRESO</th>
                     <th>FOTOS</th>
                     <th>AGREGAR FOTOS</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>{{$cadena->folio_bodega}}</td>
                     <td>{{date('H:i:s',strtotime($cadena->entrada->hora))}}</td>
                     <td>{{date('d-m-Y',strtotime($cadena->entrada->fecha))}}</td>
                     <td></td>
                     <td>
                        <a href="" class="foto-form-modal" data-cadena="{{$cadena}}" data-modelo="entrada" data-modelo-id="{{$cadena->entrada->id}}"><i class="fas fa-file-upload"></i></a>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="col s12"><hr class="hr-1"></div>
      </div>
      <!--prestamos-->
      <div class="row">
         @component('componentes.componente_seccion_titulo')
            @slot('mensaje','2. PRESTAMOS ~ ')
            @slot('icono','fas fa-file-export')
         @endcomponent
   
         {{-- <div class="col s12 m12 l12">
            <a href="" style="color: #152f4a; display: block;" class="right-align foto-form-modal">
               <i class="fas fa-file-upload" style="color: #c09f77;"></i>
               <b><span> - Agregar fotos</span></b>
            </a>
         </div> --}}

         <div class="col s12">
            <table>
               <thead>
                  <tr>
                     <th rowspan="2">Nº</th>
                     <th rowspan="2">ESTADO</th>
                     <th rowspan="2">ACCIÓN</th>
                     <th rowspan="2">PDF</th>
                     <th rowspan="2">FOTOS</th>
                     {{-- <th>FOLIO</th> --}}
                     <th>H. PRESTAMO</th>
                     <th>F. PRESTAMO</th>
                     <th>RB. ENTREGA</th>
                     <th>SP. RECIBE</th>
                     <th>INDIC. PRESTAMO</th>
                  </tr>
                  <tr>
                     {{-- <th>N.U.C.</th> --}}
                     <th>H. REINGRESO</th>
                     <th>F. REINGRESO</th>
                     <th>RB. RECIBE</th>
                     <th>SP. ENTREGA</th>
                     <th>INDIC. REINGRESO</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($cadena->prestamos as $i => $prestamo)
                     <tr>
                        <td rowspan="2">{{$i+1}}</td>
                        <td rowspan="2">{{$prestamo->estado}}</td>
                        <!--accion-->
                        <td rowspan="2">
                           <!--editar-->
                           <a href="/bodega/prestamo-editar-form/{{$prestamo->id}}" target="blank"><i class="fas fa-edit"></i></a> <hr>
                        </td>
                        <!--pdf-->
                        <td rowspan="2">
                           <a href="/bodega/prestamo-pdf/{{$prestamo->id}}" target="blank"><i class="fas fa-file-pdf"></i></a>
                        </td>
                        <!--fotos-->                  
                        <td rowspan="2">
                           <a href="" style="color: #152f4a; display: block;" class="right-align foto-form-modal">
                              <i class="fas fa-file-upload"></i>
                           </a>
                        </td>
                        {{-- <td>{{$cadena->folio_bodega}}</td> --}}
                        <td>{{date('H:i:s',strtotime($prestamo->prestamo_hora))}}</td>
                        <td>{{date('d-m-Y',strtotime($prestamo->prestamo_fecha))}}</td>
                        <td>{{$prestamo->user1->name}}</td>
                        <td>{{$prestamo->perito1->nombre}}</td>
                        <td>---</td>
                     </tr>
                     <tr>
                        {{-- <td>{{$cadena->nuc}}</td> --}}
                        <td>{{date('H:i:s',strtotime($prestamo->reingreso_hora)) ?? '---'}}</td>
                        <td>{{$prestamo->reingreso_fecha}}</td>
                        <td>{{$prestamo->user2->name ?? '---'}}</td>
                        <td>{{$prestamo->perito2->nombre ?? '---'}}</td>
                        <td>---</td>
                     </tr>                      
                  @endforeach
               </tbody>
            </table>
         </div>
         <div class="col s12"><hr class="hr-1"></div>
      </div>
      <!--bajas-->
      <div class="row">
         @component('componentes.componente_seccion_titulo')
            @slot('mensaje','3. BAJAS ~ ')
            @slot('icono','fas fa-file-export')
         @endcomponent

         <div class="col s12">
            <table>
               <thead>
                  <th>Nº</th>
                  {{-- <th>NO. INDICIOS</th> --}}                  
                  <th>ACCIONES</th>
                  <th>H. BAJA</th>
                  <th>F. BAJA</th>
                  <th>DESCRIPCIÓN</th>
                  <th>RB. ENTREGA</th>
                  <th>RECIBE</th>
                  <th>IDENTIFICACIÓN</th>
                  <th>CARGO</th>
                  <th>OBSERVACIONES</th>
               </thead>
               <tbody>
                  @forelse ($cadena->bajas as $i => $bajas)
                     <tr>
                        <td>{{$i+1}}</td>
                        <!--acciones-->
                        <td>
                           <a href="/bodega/baja-form/editar/{{$cadena->id}}/{{$baja->id}}" target="blank"><i class="fas fa-pencil-alt"></i></a> <hr>
                           <a href="" class="btn-eliminar-baja" data-id="{{$baja->id}}"><i style="color:#b71c1c" class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                        <td>{{date('H:i:s',strtotime($baja->hora))}}</td>
                        <td>{{date('d-m-Y',strtotime($baja->fecha))}}</td>
                        <td style="width: 20%">
                           @foreach($baja->indicios as $key => $indicio)
                              <b>{{$indicio->identificador}} :</b>{{$indicio->descripcion}}<br>
                           @endforeach
                        </td>
                        <td>{{$baja->user->name}}</td>
                        <td>{{$baja->quien_recibe ?? "{$baja->perito->cargo->nombre} {$baja->perito->nombre}"}}</td>
                        
                     </tr>
                  @empty
                     <tr>
                        <td colspan="9">:(</td>
                     </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
      </div>
   </div>



   {{-- <div class="amber">
      <h5 class="center-align">
         <b>HISTORIAL - CADENA {{$cadena->folio_bodega}}</b>
      </h5>
   </div>

   <blockquote>
      <b>A N E X O S</b>
   </blockquote>
   <div>
      <table class="centered">
         <thead>
            <tr class="blue lighten-5">
               <th>ANEXO 3</th>
               <th>ANEXO 4</th>
               <th>ETIQUETA</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               @if($cadena->user_id != NULL)
                  <td>
                     <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-3">
                        <i style="color: #c09f77;" class="fas fa-file-pdf fa-lg"></i>
                     </a>
                  </td>
                  <td>
                     <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-4">
                        <i style="color: #c09f77;" class="fas fa-file-pdf fa-lg"></i>
                     </a>
                  </td>
                  <td>
                     <a href="" class="btn-etiqueta" data-cadena-id="{{$cadena->id}}">
                        <i class="fas fa-file-pdf fa-lg i-dorado"></i>
                     </a>
                  </td>
               @else
                  <td colspan="3">
                     <blockquote class="blockquote-aviso yellow lighten-2"><b>NO HAY REGISTRO DE ANEXOS</b></blockquote>
                  </td>
               @endif
            </tr>
         </tbody>
      </table>
   </div> --}}


   {{-- <blockquote>
      <b>INGRESO</b>
   </blockquote>

   <a href="" class="foto-form-modal" data-cadena="{{$cadena}}" data-modelo="entrada" data-modelo-id="{{$cadena->entrada->id}}"><i class="fas fa-file-upload"></i></a>

   <a
      href="{{$cadena->entrada->fotos->count() ? '' : route('foto_form',['modelo'=>'entrada','modelo_id'=>$cadena->entrada])}}"
      id="{{$cadena->entrada->fotos->count() ? 'fotos-ingreso' : ''}}"
   >
      <i class="far fa-image"></i>
   </a>
   <div class="row" style="display: none;">
      <div class="col s12">
         <ul id="images">
            @foreach ($cadena->entrada->fotos as $i => $foto)
               <li><img src="{{asset('storage/fotos_indicios/'.$cadena->folio_bodega.'/entrada//'.$cadena->entrada->id.'/'.$foto->nombre)}}" alt="Foto-{{$i}}"></li>
               
            @endforeach
            
          </ul>
      </div>
   </div> --}}
   
   
   {{-- <blockquote>
      <b>P R E S T A M O S</b>
   </blockquote>
   <div class="tabla">
      <table class="table-width">
         <thead>
            <tr class="blue lighten-5">
               <th>EDITAR</th>
               <th>ELIMINAR</th>
               <th>FOTOS</th>
               <th>FOLIO</th>
               <th>N.U.C.</th>
               <th>NO. INDICIOS</th>
               <th>HORA SALIDA</th>
               <th>FECHA SALIDA</th>
               <th>INDICIOS DEVUELTOS</th>
               <th>HORA REINGRESO</th>
               <th>FECHA REINGRESO</th>
               <th>RB PRESTA</th>
               <th>QUIEN SE LO LLEVA</th>
               <th>QUIEN ENTREGA</th>
               <th>RB RECIBE</th>
               <th>QUIEN AUTORIZA</th>
               <th>DESCRIPCIÓN</th>
               <th>PDF</th>
            </tr>
         </thead>
         <tbody>
            @if( count($cadena->prestamos) )
               @foreach($cadena->prestamos as $key => $prestamo)
                  <tr>
                     <td><a href="/bodega/prestamo-editar-form/{{$prestamo->id}}" target="blank"><i class="fas fa-pencil-alt"></i></a></td>
                     <td><a href="" class="btn-eliminar-prestamo" data-id="{{$prestamo->id}}"><i style="color:#b71c1c" class="fa fa-trash" aria-hidden="true"></i></a></td>
                     <td>
                        <a href="" target="_blank" rel="noopener noreferrer">
                           
                        </a>
                     </td>
                     <td>{{$cadena->folio_bodega}}</td>
                     <td>{{$cadena->nuc}}</td>
                     <td>{{$prestamo->prestamo_numindicios}}</td>
                     <td>{{date('H:i:s',strtotime($prestamo->prestamo_hora))}}</td>
                     <td>{{date('d-m-Y',strtotime($prestamo->prestamo_fecha))}}</td>
                     @if($prestamo->estado == 'concluso')
                        <td>{{$prestamo->reingreso_numindicios}}</td>
                        <td>{{date('H:i:s',strtotime($prestamo->reingreso_hora))}}</td>
                        <td>{{date('d-m-Y',strtotime($prestamo->reingreso_fecha))}}</td>
                     @else
                        <td>***</td>
                        <td>***</td>
                        <td>***</td>
                     @endif
                     <td>{{$prestamo->user1_id}}</td>
                     <td>{{$prestamo->perito1->nombre}}</td>
                     @if($prestamo->estado == 'concluso')
                        <td>{{$prestamo->perito2->nombre}}</td>
                        <td>{{$prestamo->user2_id}}</td>
                     @else
                        <td>***</td>
                        <td>***</td>
                     @endif
                     <td>{{$prestamo->prestamo_ordena}}</td>
                     <td style="width: 20%">
                        @foreach($prestamo->indicios as $key => $indicio)
                           <b>{{$indicio->identificador}} :</b>{{$indicio->descripcion}}<br>
                        @endforeach
                     </td>
                     <td>
                     <a href="/bodega/prestamo-pdf/{{$prestamo->id}}" target="blank"><i class="fas fa-file-pdf"></i></a>
                     </td>
                  </tr>
               @endforeach
            @else
               <tr>
                  <td colspan="17">
                     <blockquote class="blockquote-aviso yellow lighten-2"><b>NO HAY REGISTROS</b></blockquote>
                  </td>
               </tr>
            @endif
         </tbody>
      </table>
   </div> --}}

   {{-- <blockquote><b>B A J A S</b></blockquote>
   <div class="tabla">
      <table class="table-width">
         <thead>
            <tr class="blue lighten-5">
               <th>EDITAR</th>
               <th>ELIMINAR</th>
               <th>FOLIO</th>
               <th>N.U.C.</th>
               <th>NO. INDICIOS</th>
               <th>HORA SALIDA</th>
               <th>FECHA SALIDA</th>
               <th>DESCRIPCIÓN</th>
               <th>RB ENTREGA</th>
               <th>RECIBE</th>
               <th>IDENTIFICACIÓN</th>
               <th>CARGO</th>
               <th>OBSERVACIONES</th>
               <th>TIPO BAJA</th>
               <th>PDF</th>
            </tr>
         </thead>
         <tbody>
            @if( count($cadena->bajas) )
               @foreach($cadena->bajas as $key => $baja)
                  <tr>
                     <td><a href="/bodega/baja-form/editar/{{$cadena->id}}/{{$baja->id}}" target="blank"><i class="fas fa-pencil-alt"></i></a></td>
                     <td><a href="" class="btn-eliminar-baja" data-id="{{$baja->id}}"><i style="color:#b71c1c" class="fa fa-trash" aria-hidden="true"></i></a></td>
                     <td>{{$cadena->folio_bodega}}</td>
                     <td>{{$cadena->nuc}}</td>
                     <td>{{$baja->numero_indicios}}</td>
                     <td>{{date('H:i:s',strtotime($baja->hora))}}</td>
                     <td>{{date('d-m-Y',strtotime($baja->fecha))}}</td>
                     <td style="width: 20%">
                        @foreach($baja->indicios as $key => $indicio)
                           <b>{{$indicio->identificador}} :</b>{{$indicio->descripcion}}<br>
                        @endforeach
                     </td>
                     <td>{{$baja->user->name}}</td>
                     @isset($baja->quien_recibe)
                        <td>{{$baja->quien_recibe}}</td>
                        <td>{{$baja->identificacion}}</td>
                        <td>***</td>
                     @endisset
                     @empty($baja->quien_recibe)
                        <td>{{$baja->perito->nombre}}</td>
                        <td>{{$baja->perito->folio}}</td>
                        <td>{{$baja->perito->cargo->nombre}}</td>
                     @endempty
                     <td>{{$baja->observaciones}}</td>
                     <td>{{strtoupper($baja->tipo)}}</td>
                     <td>
                        <a href="/bodega/baja-pdf/{{$baja->id}}" target="blank"><i class="fas fa-file-pdf"></i></a>
                     </td>
                  </tr>
               @endforeach
            @else
               <tr>
                  <td colspan="16">
                     <blockquote class="blockquote-aviso yellow lighten-2"><b>NO HAY REGISTROS</b></blockquote>
                  </td>
               </tr>
            @endif
         </tbody>
      </table>
   </div> --}}

<!-- Modal Anexos -->
@include('modal.modal_anexos')

<!--modal etiqueta-->
@include('modal.modal_etiqueta')


   {{-- <!--MODALS-->
   <!-- Modal Anexo-3 -->
   <div id="modal-anexo3" class="modal">
      <div class="modal-content">
         <h5 class="center-align"><b>ANEXO 3</b></h5>
         <form id="form-anexo3" action="/anexo-3" target="_blank">
            <!--Contenido formulario-->
         </form>
      </div>
   </div>
   <!-- Modal Anexo-4 -->
   <div id="modal-anexo4" class="modal">
      <div class="modal-content">
         <h5 class="center-align"><b>ANEXO 4</b></h5>
         <form id="form-anexo4" action="/anexo-4" target="_blank">
            <!--Contenido formulario-->
         </form>
      </div>
   </div>
   <!-- Modal Etiqueta -->
   <div id="modal-etiqueta" class="modal">
      <div class="modal-content">
         <h5 class="center-align"><b>FORMATO DE ETIQUETADO</b></h5>
         <h5>Tipo de Etiqueta</h5>
         <form id="form-etiqueta" action="/etiqueta" target="_blank">
            <!--Contenido formulario-->
         </form>
      </div>
   </div> --}}










<!--foto-modal-bottom-->
<div id="modal-foto-form" class="modal bottom-sheet" style="background-color: rgba(192,159,119,0.4) !important">
   <div class="modal-content">
      asdasdasdasdadasdsd
   </div>      
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
   <script src="{{asset('js/prestamo_eliminar.js')}}" type="text/javascript"></script>
   <script src="{{asset('js/baja_eliminar.js')}}" type="text/javascript"></script>
   <!--ANEXOS-->
   {{-- <script type="text/javascript" src="{{asset('js/cadenas/anexo3_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/anexo4_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta.js')}}" ></script> --}}

   <script src="{{asset('js/modal/modal.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/cadenas/anexos_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta.js')}}" ></script>

   <script src="{{asset('plugins/viewer_js/js/viewer.js')}}"></script>
   <script src="{{asset('plugins/viewer_js/js/jquery-viewer.js')}}"></script>
   <script>
      $(function(){

         $(document).on('click','#fotos-ingreso',function(e){
            e.preventDefault();
            // console.log('hhhhh');
            $('#images').viewer('show');
         });
      });

   </script>

   <script src="{{asset('js/foto/foto_form.js')}}"></script>
@endsection
