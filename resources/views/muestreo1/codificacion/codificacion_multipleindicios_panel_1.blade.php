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
      <fieldset class="">
         <legend>1. Selección de Cadenas y/o indicios</legend>
         <table>
            <thead>
               <tr>
                  <th width="2%" clas="th-center">Nº</th>
                  <th width="6%">SELECCIONAR CADENA</th>
                  <th width="7%">FOLIO</th>
                  <th width="8%">CI-PP</th>
                  {{-- <th width="4%">CADENA ESTADO</th> --}}
                  <th width="10%">NATURALEZA</th>
                  <th width="6%">SELECCIONAR INDICIO</th>
                  <th width="4%">INDICIO ESTADO</th>
                  <th width="8%">IDENTIFICADOR</th>
                  <th>DESCRIPCIÓN</th>
               </tr>
            </thead>
            <tbody>
               @isset($cadenas)
                  @forelse ($cadenas as $i => $cadena)
                     <tr>
                        <!--index-->
                        <td rowspan="{{ $cadena->indicios->count() }}" class="td-index">{{ $i + 1 }}
                        </td>
                        <!--seleccionar-->
                        <td rowspan="{{ $cadena->indicios->count() }}">
                           {{-- <input type="checkbox" class="filled-in cadena-checkbox" id="cadena-{{$cadena->id}}" {{( (
                              $cadena->indicios->count() ) == ( $cadena->indicios->where('estado','activo')->count() ) ) ?
                           'checked' : 'disabled'}} data-id-cadena="{{$cadena->id}}"
                           data-indicios-cantidad="{{$cadena->indicios->count()}}" name="cadenas[]" value="{{$cadena->id}}"/>
                           --}}
                           <input type="checkbox" id="cadena-{{ $cadena->id }}" class="filled-in cadena-checkbox" {{
                              $cadena->indicios->count() != $cadena->indicios->where('estado', 'activo')->count() ? 'disabled'
                           : '' }}
                           data-id-cadena="{{ $cadena->id }}"
                           data-indicios-cantidad="{{ $cadena->indicios->count() }}" name="cadenas[]"
                           value="{{ $cadena->id }}" />
                           <label for="cadena-{{ $cadena->id }}"></label>
                        </td>
                        <!--folio-->
                        <td rowspan="{{ $cadena->indicios->count() }}" class="td-folio">
                           {{ $cadena->folio_bodega }}</td>
                        <!--nuc-->
                        <td rowspan="{{ $cadena->indicios->count() }}" class="td-nuc">
                           {{ $cadena->nuc }}
                        </td>
                        <!--estado-->
                        {{-- <td rowspan="{{$cadena->indicios->count()}}">
                           @include('entrada.entrada_estado')
                        </td> --}}
                        <!--naturleza-->
                        <td rowspan="{{ $cadena->indicios->count() }}">
                           {{ $cadena->naturaleza->nombre ?? '---' }}
                        </td>
                        <!--descripcion-->
                        @foreach ($cadena->indicios as $indicio)
                        @if ($loop->iteration > 1)
                           <tr>
                        @endif
                        <td>
                           <input type="checkbox" class="filled-in indicio-checkbox {{ str_contains($indicio->estado, 'activo')
                                    ? " c-{$cadena->id}"
                           : '' }}"
                           id="indicio-{{ $indicio->id }}" data-cadena-id={{ $cadena->id }} {{-- checked --}}
                           {{-- {{($indicio->estado == 'activo') ? "checked" : ""}} --}} {{-- disabled --}} {{-- {{( (
                           $cadena->indicios->count() ) == ( $cadena->indicios->where('estado','activo')->count() ) ) ?
                           'disabled' : ''}} --}} {{-- {{($indicio->estado != 'activo') ? 'disabled' :
                           "data-cadena-id=$cadena->id"}} --}}
                           {{ !str_contains($indicio->estado, 'activo') ? 'disabled' : '' }} name="indicios[]"
                           value="{{ $indicio->id }}" />
                           <label for="indicio-{{ $indicio->id }}">
                        </td>
                        <td>@include('indicio.indicio_estado')</td>
                        <td>{{ $indicio->identificador }}</td>
                        <td>{{ $indicio->descripcion }}</td>
                     </tr>
                  @endforeach
               @empty
                  <tr>
                     <td colspan="11" class="td-aviso">No hay registros</td>
                  </tr>
               @endforelse
               @endisset
               @empty($cadenas)
                   
               @endempty
               
            </tbody>
         </table>
      </fieldset>
   </div>
</div>