<div class="row">
   {{-- @component('componentes.componente_seccion_titulo')
      @slot('mensaje','1.1. DESCRIPCIÓN BAJA PARCIAL')
      @slot('icono','fas fa-check-square')
   @endcomponent --}}

   <div id="tabla-reingreso-descripcion-disponible" class="col s12 div-fieldset ocultar">
      <fieldset class="fieldset-subseccion">
         <legend>1.1. Descripcion disponible</legend>
         <table>
            <thead>
               <tr>
                  <th class="th-center">IDENTIFICADOR</th>
                  <th>DESCRIPCIÓN DISPONIBLE</th>
               </tr>
            </thead>
            <tbody>
               {{-- @if ($formAccion == 'editar')
                  @if ($baja->indicios->contains('pivot.baja_tipo','parcial'))
                     @foreach ($baja->indicios()->wherePivot('baja_tipo','parcial')->get() as $indicio)
                        @include('baja.baja_parcial.baja_parcial_view_tr')
                     @endforeach
                  @endif
               @endif --}}
            </tbody>
         </table>
      </fieldset>
   </div>
</div>