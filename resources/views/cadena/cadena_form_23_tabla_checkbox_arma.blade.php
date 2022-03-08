<div id="row-tabla-checkbox-arma" class="row {{$formAccion == 'registrar' ? 'hide' : ($cadena->indicios->where('indicio_arma','si')->count() ? '' : 'hide')}}" >
   <div class="col s12">
     <span style="font-size: 16px;">
       <strong><b>Indique los identificadores que refieren a una arma</b></strong>
    </span>
   </div>
   <div class="col s12">
     <table>
       <thead>
        <tr>
          <th class="th-center" rowspan="2" width="3%">Nº</th>
          <th rowspan="2" width="40%">IDENTIFICADOR</th>
          <th class="th-center" colspan="2">¿ES UNA ARMA?</th>
        </tr>
        <tr>
          <th>SI</th>
          <th>NO</th>
        </tr>
       </thead>
       <tbody id="tabla-armas-tbody">
         @if ($formAccion == 'registrar')
          @include('arma.arma_fila_checkbox',[
            'indice' => 0,
          ])
          @else
          @foreach ($cadena->indicios->values() as $indice => $indicio)
            @include('arma.arma_fila_checkbox')
          @endforeach 
         @endif
       </tbody>
     </table>
   </div>
 </div>