@extends('template.template')


<!--yield

  -css
  -title
  -header
  -main
  -js

-->

@section('css')
   <link rel="stylesheet" href="{{asset('css/table.css')}}">
   <link rel="stylesheet" href="{{asset('/css/nav/sidenav_buscador2.css')}}">
   <link rel="stylesheet" href="{{asset('plugins/viewer_js/css/viewer.css')}}">
   <style>
      .file-path::placeholder {
         color:#152f4a !important;
         font-weight: bold;
      }
      .btn-sidenav-buscador-open i:hover{
         color: #c09f77 !important;
      }
   </style>
@endsection

@section('title','Armas')
@section('header')
<div class="row">
   <div class="col l4" style="background-color:#c6c6c6; height:30px;">
   </div>
   <div class="col l2" style="background-color:#c09f77; height:30px;">
   </div>
   <div class="col l5" style="height:30px;">
      <span style="color:#fff; font-weight:bold;">Registros: {{isset($armas) ? $armas->count() : "---"}}</span>
   </div>
   <div class="col l1 center-align" style="height:30px;">
      <a href="#" class="btn-sidenav-buscador-open pulse"><i class="fas fa-search" style="color: #fff;"></i></a>
   </div>
</div>
@endsection
@section('main')
<!--buscador-->
@include('arma.arma_buscador')
<table>
   <thead>
      <tr>
         <th rowspan="2" width="2%">Nº</th>
         <th width="4%">FOLIO</th>
         <th rowspan="2" width="2%" class="td-top">FOTOS</th>
         <th width="3%">FECHA RECOLECCIÓN</th>
         <th width="2%">REGIÓN</th>
         <th width="4%">CLASIFICACIÓN</th>
         <th width="4%">TIPO</th>
         <th width="7%">SERIE</th>
         <th width="6%">CALIBRE</th>
         <th rowspan="2" class="td-top">DESCRIPCIÓN</th>
      </tr>
      <tr>
         <th>N.U.C.</th>
         <th>FECHA INGRESO</th>
         <th>ESTUDIO</th>
         <th>AGRUPACIÓN</th>
         <th>FABRICANTE (MARCA)</th>
         <th>MODELO</th>
         <th>PAÍS</th>
      </tr>
   </thead>
   <tbody>
      @isset($armas)
         @forelse ($armas as $i => $arma)
            <tr class="{{($i%2 == 0) ? 'tr-impar' : ''}}">
               <td rowspan="2" class="td-index">{{$i + 1}}</td>
               <td class="td-folio">{{$arma->indicio->cadena->folio_bodega}}</td>
               <td rowspan="2" class="td-center"> 
                  
                  @if ($arma->fotos->count())
                     <a
                        href=""
                        class="btn-fotos"
                        {{-- data-modelo="" --}}
                        data-arma-id="{{$arma->id}}"
                     >
                        <i class="far fa-image"></i>
                     </a>                    
                  @endif
                  
                  <a href=""
                     class="foto-form-modal"
                     {{-- data-cadena="{{$cadena}}" --}}
                     data-modelo="arma"
                     data-modelo-id="{{$arma->id}}"
                  >
                     <i class="fas fa-file-upload"></i>
                  </a>                  
               </td>
               <td>{{$arma->indicio->fecha ?? '---'}}</td>
               <td>{{$arma->indicio->cadena->fiscalia->nombre ?? '---'}}</td>
               <td>{{$arma->clasificacion}}</td>
               <td>{{$arma->tipo}}</td>
               <td>{{$arma->serie}}</td>
               <td>{{$arma->calibre}}</td>
               <td rowspan="2"><b>{{$arma->indicio->identificador}}</b>. {{$arma->indicio->descripcion}}</td>
            </tr>
            <tr class="{{($i%2 == 0) ? 'tr-impar' : ''}}">
               <td class="td-nuc">{{$arma->indicio->cadena->nuc ?? '---'}}</td>
               <td>{{$arma->indicio->cadena->entrada->fecha ?? '---'}}</td>
               {{-- <td>{{$arma->indicio->prestamos->count() ?: 'Sin estudio'}}</td> --}}
               <td>---</td>
               <td>{{$arma->agrupacion}}</td>
               <td>{{$arma->fabricante}}</td>
               <td>{{$arma->modelo}}</td>
               <td>{{$arma->pais->nombre}}</td>
            </tr>
         @empty
            <tr>
               <td colspan="10" class="td-aviso">- No hay coincidencias</td>
            </tr>
         @endforelse
      @endisset
      @empty($armas)
            <tr>
               <td colspan="10" class="td-aviso">- Realice una busqueda</td>
            </tr>
      @endempty
   </tbody>
</table>


@forelse ($armas as $arma)
   @if ($arma->fotos->count())
      <div class="row" style="display: none;">
         <div class="col s12">
            <ul id="fotos-{{$arma->id}}">
               @foreach ($arma->fotos as $i => $foto)
                  <li><img src="{{asset('storage/fotos_armas/'.$arma->id.'/'.$foto->nombre)}}" alt="Foto-{{$i}}"></li>            
               @endforeach         
            </ul>
         </div>
      </div>
   @endif
@empty
    
@endforelse


<!--foto-modal-bottom-->
<div id="modal-foto-form" class="modal bottom-sheet" style="background-color: rgba(192,159,119,0.4) !important">
   <div class="modal-content">
   </div>      
</div>
@endsection

@section('js')
<script src="{{asset('plugins/viewer_js/js/viewer.js')}}"></script>
   <script src="{{asset('plugins/viewer_js/js/jquery-viewer.js')}}"></script>
<!--sidenav buscador-->
<script src="{{asset('/js/general/sidenav_buscador.js')}}"></script>
<script src="{{asset('js/foto/foto_form.js')}}"></script>

<script>
   $(function(){

      $(document).on('click','.btn-fotos',function(e){
         e.preventDefault();
         console.log('entrasd');
         // let modelo = $(this).attr('data-modelo');
         let modelo_id = $(this).attr('data-arma-id');
         $('#fotos-'+modelo_id).viewer('show');
      });
   });

</script>
@endsection