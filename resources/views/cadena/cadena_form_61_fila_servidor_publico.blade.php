<tr>
   <td class="td-contador td-indice-servidor-publico">{{$indice + 1}}</td>
   <td>{{($indice == 0) ? 'Inicia' : 'Interviniente'}}</td>
   <td>{{$sp->name ?? Auth::user()->name}}</td>
   <td>{{$sp->institucion->nombre ?? Auth::user()->institucion->nombre}}</td>
   <td>{{$sp->cargo->nombre ?? Auth::user()->cargo->nombre}}</td>
   <td>
     <input type="hidden" name="sp_id[]" value="{{$sp->id ?? Auth::user()->id}}">
     <input type="text" id="sp-{{$indice}}" placeholder="ETAPA*" name="sp_etapa[]" value="{{$sp->pivot->etapa ?? ''}}">
     <label for="sp-{{$indice}}"></label>
   </td>
   <!--td delete-->
   <td class="td-center">
      @if ( $indice == 0 )
         ---
      @else
         <a href="" class="sp-eliminar"><i class="fas fa-minus-circle"></i></a>
      @endif
   </td>
 </tr>