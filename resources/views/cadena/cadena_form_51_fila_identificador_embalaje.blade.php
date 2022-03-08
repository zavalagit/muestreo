<tr>
   <td class="td-indice-embalaje td-contador">{{$indice + 1}}</td>
   <td class="indicio-identificador">{{$indicio->identificador ?? '---'}}</td>
   <td class="td-input-embalaje">
      <label for="embalaje-{{ 3 * $indice }}">
         <input type="radio" id="embalaje-{{ 3 * $indice }}" checked name="embalaje[{{$indice}}]" value="bolsa"/>
         <span></span>
      </label>
   </td>
   <td class="td-input-embalaje">
      <label for="embalaje-{{ (3 * $indice) + 1 }}">
         <input type="radio" id="embalaje-{{ (3 * $indice) + 1 }}" {{isset($indicio) ? ( ($indicio->embalaje == 'caja') ? 'checked' : '' ) : ''}} name="embalaje[{{$indice}}]" value="caja"/>
         <span></span>
      </label>
   </td>
   <td class="td-input-embalaje">
      <label for="embalaje-{{ (3 * $indice) + 2 }}">
         <input type="radio" id="embalaje-{{ (3 * $indice) + 2 }}" {{isset($indicio) ? ( ($indicio->embalaje == 'recipiente') ? 'checked' : '' ) : ''}} name="embalaje[{{$indice}}]" value="recipiente"/>
         <span></span>
      </label>
   </td>
</tr>