@component('componentes.componente_seccion_titulo')
   @slot('mensaje','1. PARAMETROS DE BUSQUEDA')
   @slot('icono','fas fa-search')
@endcomponent
<!--region-->
{{-- @if (Auth::user()->tipo == 'admin_peticiones')
<div class="col l1">
   <p class="parametro_busqueda"><span>REGIÓN:</span> {{(old('b_region') ? $fiscalias->where('id',old('b_region'))->first()->nombre : '---')}}</p>
</div>
@endif --}}
<!--fecha inicio-->
<div class="col l2">
   <p class="parametro_busqueda"><span>FECHA INICIO:</span> {{old('fecha_inicio') ? date( 'd-m-Y',strtotime( old('fecha_inicio') ) ) : $fecha_inicio }}</p>
</div>
<!--fecha termino-->
<div class="col l2">
   <p class="parametro_busqueda"><span>FECHA TERMINO:</span> {{old('fecha_termino') ? date( 'd-m-Y',strtotime( old('fecha_termino') ) ) : $fecha_fin }}</p>
</div>