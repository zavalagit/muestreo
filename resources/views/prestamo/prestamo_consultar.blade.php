@extends('template.template')
@section('titulo','Prestamos')
@section('css')
<link rel="stylesheet" href="{{asset('css/modal/modal.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/prestamo/prestamos_columna_fija.css')}}"> --}}
<link rel="stylesheet" href="{{asset('css/colores.css')}}">
<link rel="stylesheet" href="{{asset('css/table.css')}}">
<link rel="stylesheet" href="{{asset('/css/nav/sidenav_buscador.css')}}">
<link rel="stylesheet" href="{{asset('/css/componentes/componente_consultar_acciones.css')}}">

   <style media="screen">
   
   table{
       width: 3000px !important;
   }
   .tabla{
      margin: 0 !important;
      padding: 0 !important;
   }
   td{
      vertical-align: top !important;
   }
   .center{
      text-align: center;
   }


   .i-editar{
      color: #394049;
   }
   .i-editar:hover{
      color: #c09f77;
   }

   .i-pdf-prestamo{
      color: #394049;
   }
   .i-pdf-prestamo:hover{
      color: red;
   }
   .i-prestamo-reingreso{
      color: #394049;
   }
   .i-prestamo-reingreso:hover{
      color: #c09f77;
   }

   </style>
@endsection



@section('seccion', 'PRESTAMOS')

@section('header')
   <div class="col l3">
      <span style="color:#fff; font-weight:bold;">Registros: {{isset($prestamos) ? $prestamos->count() : "---"}}</span>
   </div>
   <div class="col offset-l8 l1 center-align">
      <a href="#" class="btn-sidenav-buscador-open pulse" ><i class="fas fa-search" style="color: #fff; margin-right: 15px;"></i></a>
   </div>
@endsection

@section('main')
<!--consultar_acciones-->
@component('componentes.componente_consultar_acciones')
   @include('prestamo.prestamo_consultar_acciones')
@endcomponent
      
<div class="div-table-scroll"  >
   <table>
      <thead>
         <tr>
            <th rowspan="2" width="1.5%" class="th-center">Nº</th>
            <th width="5%">FOLIO</th>
            {{-- <th class="sticky-3">N.U.C.</th> --}}
            <th rowspan="2" width="4%">ESTADO</th>
            <th rowspan="2" class="th-center" width="2%">PDF</th>
            <th rowspan="2" width="4%">ACCIONES</th>
            <th width="4.5%">I/E PRESTAMO</th>
            <th width="4.5%">H. PRESTAMO</th>
            <th width="4.5%">F. PRESTAMO</th>
            <th width="7.5%">R. B. ENTREGA</th>
            <th width="7.5%">RESGUARDANTE RECIBE</th>
            <th rowspan="2" width="4.5%">AUTORIZA</th>
            <th rowspan="2">DESCRIPCIÓN</th>
         </tr>
         <tr>
            <th>N.U.C.</th>
            <th>I/E REINGRESO</th>
            <th>H. REINGRESO</th>
            <th>F. REINGRESO</th>
            <th>R. B. RECIBE</th>
            <th>RESGUARDANTE ENTREGA</th>
         </tr>
      </thead>
      <tbody>
         @isset ($prestamos)
            @forelse ($prestamos->values() as $i => $prestamo)
               <tr class="{{($i%2 == 0) ? 'tr-impar' : ''}}">
                  <!--numero consecutivo-->
                  <td rowspan="2" class="td-index">{{$i+1}}</td>
                  <!--folio-->
                  <td class="td-folio">{{$prestamo->cadena->folio_bodega}}</td>
                  <!--estado-->
                  <td rowspan="2" class="td-destacar">
                     <b><i style="color: {{$prestamo->estado == 'activo' ? 'yellowgreen;' : 'red;'}}" class="fas fa-square"></i> {{strtoupper($prestamo->estado)}}</b>
                  </td> 
                  <!--pdf-->
                  <td rowspan="2" class="td-center td-destacar">
                     <a href="/bodega/prestamo-pdf/{{$prestamo->id}}" target="_blank">
                        <i class="fas fa-file-pdf fa-lg i-pdf-prestamo"></i>
                     </a>
                  </td>
                  <!--acciones-->
                  <td rowspan="2" class="td-destacar">
                     <!--reingresar-->
                     <a href="/bodega/prestamo-form/reingresar/{{$prestamo->cadena_id}}/{{$prestamo->id}}" class="{{$prestamo->estado == 'concluso' ? 'hide' : ''}}" target="_blank">
                        <i class="fas fa-arrow-alt-circle-right fa-lg i-prestamo-reingreso"></i> <span class="i-referencia">Reingresar</span>
                     </a> <hr class="{{$prestamo->estado == 'concluso' ? 'hide' : ''}}">
                     <!--editar-->
                     <a href="/bodega/prestamo-form/editar/{{$prestamo->cadena_id}}/{{$prestamo->id}}" target="_blank">
                        <i class="fas fa-pen-square fa-lg i-editar"></i> <span class="i-referencia">Editar</span>
                     </a> <hr>
                  </td>
                  <!--i/e prestamo-->
                  <td>{{$prestamo->prestamo_numindicios}}</td>
                  <!--hora prestamo-->
                  <td>{{date('H:i:s',strtotime($prestamo->prestamo_hora))}}</td>
                  <!--fecha prestamo-->
                  <td>{{date('d-m-Y',strtotime($prestamo->prestamo_fecha))}}</td>
                  <!--r. b.  entrega-->
                  <td>{{$prestamo->user1->name}}</td>
                  <!--resguardante recibe-->
                  <td>{{$prestamo->perito1->nombre}}</td>
                  <!--autoriza-->
                  <td rowspan="2">{{$prestamo->prestamo_ordena}}</td>                                                
                  <!--DESCRIPCIÓN INDICIOS-->
                  <td rowspan="2" style="width: 35%">
                     @foreach ($prestamo->indicios as $key => $indicio)
                        <b>{{$indicio->identificador}}:</b>{{$indicio->descripcion}}<br>
                     @endforeach
                  </td>
               </tr>
               <tr class="{{($i%2 == 0) ? 'tr-impar' : ''}}">
                  <!--nuc-->
                  <td class="td-nuc">{{$prestamo->cadena->nuc}}</td>
                  <!--i/e reingreso-->
                  <td>{{$prestamo->reingreso_numindicios ?? '---'}}</td>
                  <!--hora reingreso-->
                  <td>{{isset($prestamo->reingreso_hora) ? date('H:i:s',strtotime($prestamo->reingreso_hora)) : '---'}}</td>
                  <!--fecha reingreso-->
                  <td>{{isset($prestamo->reingreso_fecha) ? date('d-m-Y',strtotime($prestamo->reingreso_fecha)) : '---'}}</td>
                  <!--r. b.  entrega-->
                  <td>{{$prestamo->user2->name ?? '---'}}</td>
                  <!--resguardante recibe-->
                  <td>{{$prestamo->perito2->nombre ?? '---'}}</td>
               </tr>
            @empty
               <tr>
                  <td colspan="12" class="td-aviso">- No hay resultados</td>
               </tr>
            @endforelse
         @endisset
         @empty($prestamos)
            <tr>
               <td colspan="12" class="td-aviso">- Realice una busqueda</td>
            </tr>
         @endempty
   
      </tbody>
   </table>
</div>

<!--buscador-->
@include('prestamo.prestamo_buscador')

@endsection

@section('js')
   <script src="{{asset('js/modal/modal.js')}}"></script>
   <script src="{{asset('js/modelo/get_modelo.js')}}"></script>
   <script src="{{asset('/js/general/sidenav_buscador.js')}}"></script>
<script>
   var texto = $('#buscar-texto').val();
    if(texto != ''){
      console.log('entro:' + texto);
      $('td').mark(texto,{
      "separateWordSearch": false,
      });
   }

   $('#reingreso-multiple').click(function(){
         if ( $(this).prop('checked') ){
            $('#btn-buscar').attr('formtarget','_blank');
         }
         else{
            $('#btn-buscar').removeAttr('formtarget');
         }
      });
</script>
@endsection
