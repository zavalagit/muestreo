@extends('plantilla.template_sin_menu')

@section('css')
   <link rel="stylesheet" href="{{asset('/css/tablas.css')}}">
   <link rel="stylesheet" href="{{asset('/css/block.css')}}">
   <link rel="stylesheet" href="{{asset('/css/btn.css')}}">
   <link rel="stylesheet" href="{{asset('/css/hr.css')}}">
   <link rel="stylesheet" href="{{asset('/css/colores.css')}}">
   <style media="screen">
      /*code css*/
      .ocultar{
         display: none;
      }
      input[type=number]::-webkit-inner-spin-button,
      input[type=number]::-webkit-outer-spin-button {
         -webkit-appearance: none;
         margin: 0;
      }
      input[type=number] { -moz-appearance:textfield; }
   </style>
@endsection


@section('titulo')
   Reingreso
@endsection

@section('seccion')
    REINGRESO DE CADENA CON FOLIO {{$prestamo->cadena->folio_bodega}}
@endsection

@section('contenido')

   <section>
      <div class="row" style="margin-bottom:0; line-height: 0 !important">
         <div class="col s12 m12 l12">
            @include('include.include_form_campo_obligatorio_asterisco')
            @if ( $formAccion == 'editar' )
               @include('include.include_form_campo_editar_asterisco')  
            @endif
            <!--nota-->            
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato;" class="fas fa-sticky-note"></i>
               @endslot
               @slot('mensaje')
                  Si la cantidad de indicios que reingresan es <strong>diferente</strong> a la la cantidad de indicios que se presta, debe indicar en una descripción lo que hay como resguardo disponible.
               @endslot
            @endcomponent      
         </div>
      </div>    
      <div class="row">
         <div class="col s12 m12 l12">
            <hr class="hr-4">
         </div>
      </div>        
   </section>

<div class="row">
   <form class="col s12" id="form-reingreso" action="{{route('prestamo_save',['formAccion'=>$formAccion,'prestamo'=>$prestamo])}}" method="POST">
      <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
      <input type="hidden" name="prestamos[]" value="{{$prestamo->id}}">
      <input type="hidden" id="prestamo-etapa" name="prestamo_etapa" value="reingreso">
      
      <div class="row">
         <div class="col s12 div-fieldset">
            <fieldset>
               <legend>1. Cantidad de indicios</legend>
               <table>
                  <thead>
                     <tr>                                       
                        <th>IDENTIFICADOR</th>
                        <th>DESCRIPCIÓN</th>
                        <th>( PRESTAMO ) CANTIDAD DE INDICIOS</th>
                        <th>( REINGRESO ) CANTIDAD DE INDICIOS</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($prestamo->indicios as $key => $indicio)
                        <tr>
                           @php $rowspan = isset($indicio->indicio_descripcion_disponible) ? 2 : 1; @endphp
                           <td rowspan="{{$rowspan}}" width="10%">{{$indicio->identificador}}</td>
                           <td>{{$indicio->descripcion}}</td>
                           <td rowspan="{{$rowspan}}" class="td-center" width="10%">{{$indicio->indicio_cantidad_disponible}}</td>
                           <td rowspan="{{$rowspan}}" width="10%">
                              <input type="number"
                                 class="reingreso-canitidad-indicios"
                                 data-indicio-id="{{$indicio->id}}"                            
                                 data-prestamo-cantidad-indicios="{{$indicio->pivot->prestamo_cantidad_indicios}}"
                                 data-url="{{route('reingreso_descripcion_disponible_view',['indicio'=>$indicio])}}"
                                 min="0"
                                 autofocus
                                 name="reingreso_cantidad_indicios[{{$indicio->id}}]"
                                 value="{{$indicio->pivot->prestamo_cantidad_indicios}}"
                              >
                           </td>
                        </tr>
                        @isset($indicio->indicio_descripcion_disponible)
                           <tr>
                              <td><span style="color: green;"><b>Disponible:</b></span> {{$indicio->indicio_descripcion_disponible}}</td>                           
                           </tr>                         
                        @endisset
                     @endforeach
                  </tbody>
               </table>
            </fieldset>
         </div>
      </div>
      
      @include('prestamo.reingreso_descripcion_disponible')
      <div class="row">
         <div class="col s12"><hr class="hr-2"></div>
      </div>
      
      <div class="row">
         @include('prestamo.prestamo_datos')
         <div class="col s12"><hr class="hr-2"></div>
      
         
         @include('prestamo.reingreso_datos')

         <!--Boton prestamo-->
         <div class="col s12 m4 l1 offset-m8 offset-l11">
            <button type="submit" class="btn-guardar" style="display: inline-block !important; width:100%;" name="btn_prestamo" value="prestamo">
               {{$formAccion}}
            </button>
         </div>
      </div>
   </form>
</div>

@endsection

@section('js')
   <script src="{{asset('js/prestamo/prestamo_form.js')}}"></script>
   <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script>
   <script src="{{asset('js/modelo/get_modelo.js')}}"></script>
   {{-- <script src="{{asset('js/prestamo/reingreso_save.js')}}"></script> --}}
   {{-- <script src="{{asset('js/reingreso.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/rb_cambiar.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/resguardante.js')}}"></script> --}}
   <script src="{{asset('js/prestamo/reingreso_cantidad_indicios.js')}}"></script>
   <script src="{{asset('js/modelo/input_autocomplete.js')}}"></script>
@endsection
