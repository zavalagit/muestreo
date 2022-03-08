<div class="row" id="componente-consultar-acciones">
   <div class="col l12 right-align">
      {{$slot}}
      </a>  
   </div>
</div>

{{--
   css:
      <link rel="stylesheet" href="{{asset('/css/componentes/componente_consultar_acciones.css')}}">
   
   slot:
      <a href="{{route('prestamo_multiple_prueba',['prestamos' => json_encode( $prestamos->pluck('id') )])}}" target="_blank">
         <i style="color: cyan;" class="fas fa-caret-left fa-lg"></i> <i style="color: cyan;" class="fas fa-caret-left fa-lg"></i> <span>Reingresar</span>
      </a>
      <a href="{{route('prestamo_multiple_prueba',['prestamos' => json_encode( $prestamos->pluck('id') )])}}" target="_blank">
         <i style="color: greenyellow" class="fas fa-file-excel"></i> <span>Listado</span>
      </a>
--}}