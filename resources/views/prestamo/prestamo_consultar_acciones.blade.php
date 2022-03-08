@isset($prestamos)
<a href="{{route('reingreso_multiple_form',['formAccion'=>'reingresar','prestamos'=>json_encode( $prestamos->pluck('id') )])}}" target="_blank">
   <i style="color: #152f4a;" class="fas fa-caret-left fa-lg"></i> <i style="color: #152f4a;" class="fas fa-caret-left fa-lg"></i> <span>Reingreso-multiple</span>
</a>
{{-- <a href="{{route('prestamo_multiple_prueba',['prestamos' => json_encode( $prestamos->pluck('id') )])}}" target="_blank">
   <i style="color: greenyellow" class="fas fa-file-excel"></i> <span>Listado</span>
</a> --}}
@endisset