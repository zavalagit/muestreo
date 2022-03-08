<div class="row">
   <div class="col s12" style="margin-bottom: 10px;">
      @component('componentes.componente_nota_2')
         @slot('icono')
            <i style="color: green;" class="fas fa-check-square"></i>
         @endslot
         @slot('mensaje')
            <strong><u>Seleccione</u></strong> las <strong>Cadenas y/o Indicios</strong> que van a ser parte del prestamo.
         @endslot
      @endcomponent
   </div>
   
   <div class="col s12 div-fieldset">
      <fieldset>
         <legend>1. Selección de "Prestamos" a reingresar</legend>
         <table>
            <thead>
               <tr>
                  <th width="2%">Nº</th>
                  <th width="4%">SELECCIONAR</th>
                  <th width="5%">FOLIO</th>
                  {{-- <th>ESTADO</th> --}}
                  <th width="8%">N.U.C.</th>
                  <th>RESGUARDANTE</th>
                  <th>IDENTIFICADOR</th>
                  <th>DESCRIPCIÓN</th>
               </tr>
            </thead>
            <tbody>
               @forelse ($prestamos->values() as $key => $prestamo)
                  <tr>
                     <!--contador-->
                     <td rowspan="{{$prestamo->indicios->count()}}" class="td-index">{{$key+1}}</td>
                     <!--seleccionar-->
                     <td rowspan="{{$prestamo->indicios->count()}}">
                        <input type="checkbox" class="filled-in cadena-checkbox" id="prestamo-{{$prestamo->id}}" {{--disabled--}}{{($prestamo->estado == 'activo') ? '' : 'disabled'}} name="prestamos[]" value="{{$prestamo->id}}"/>
                        <label for="prestamo-{{$prestamo->id}}"></label>
                     </td>
                     <!--folio-->
                     <td rowspan="{{$prestamo->indicios->count()}}" class="td-folio"><b>{{$prestamo->cadena->folio_bodega}}</b></td>
                     <!--estado-->
                     {{-- <td rowspan="{{$prestamo->indicios->count()}}" style="width: 4%;">{{$prestamo->estado}}</td> --}}
                     <!--nuc-->
                     <td rowspan="{{$prestamo->indicios->count()}}" class="td-nuc">{{$prestamo->cadena->nuc}}</td>
                     <!--resguardante-->
                     <td rowspan="{{$prestamo->indicios->count()}}" width="10%">{{$prestamo->perito1->nombre}}</td>
                     <!--descripcion-->
                     @foreach ($prestamo->indicios as $indicio)
                        @if ($loop->iteration > 1)
                           <tr>    
                        @endif
                              <td width="6%" style="border: 1px solid #c09f77; border-left: 1px solid #c09f77;">{{$indicio->identificador}}</td>
                              <td style="text-align:justify; border: 1px solid #c09f77;">{{$indicio->descripcion}}</td>
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
      </fieldset>
   </div>
</div>