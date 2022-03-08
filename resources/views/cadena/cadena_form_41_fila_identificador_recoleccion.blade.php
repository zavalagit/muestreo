<tr>
   <td class="td-indice-recoleccion td-contador">{{$indice + 1}}</td>
   <td class="indicio-identificador">{{$indicio->identificador ?? '---'}}</td>
   <td class="td-input-recoleccion">
      <label for="recoleccion-{{ 2 * $indice }}">
         <input type="radio" id="recoleccion-{{ 2 * $indice }}" checked name="recoleccion[{{$indice}}]" value="manual"/>
         <span></span>
      </label>
   </td>
   <td class="td-input-recoleccion">
      <label for="recoleccion-{{ (2 * $indice) + 1 }}">
         <input type="radio" id="recoleccion-{{ (2 * $indice) + 1 }}" {{isset($indicio) ? ( ($indicio->recoleccion == 'instrumental') ? 'checked' : '' ) : ''}} name="recoleccion[{{$indice}}]" value="instrumental"/>
         <span></span>
      </label>
   </td>
</tr>