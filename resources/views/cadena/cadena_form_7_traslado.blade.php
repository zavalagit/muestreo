<div class="row">
   @component('componentes.seccion_form')
     @slot('mensaje','7. TRASLADO ~ ')
     @slot('icono','fas fa-edit')
   @endcomponent

   @if ( $formAccion == 'registrar' )
    <div class="col s12">
      @component('componentes.componente_nota')
        Valor por default en <strong>TERRESTRE</strong> <small>(VIA)</small>
      @endcomponent
    </div>
    <div class="col s12">
      @component('componentes.componente_nota')
        Valor por default en <strong>NO</strong> <small>(CONDICIONES PARA SU TRASLADO)</small>
      @endcomponent
    </div>
   @endif

   <div class="col s12">
     <table>
       <thead>
         <tr>
           {{-- <th class="th-center">Nº</th> --}}
           <th width="28%"></th>
           <th>TERRESTRE</th>
           <th>ÁEREA</th>
           <th>MARÍTIMA</th>
         </tr>
       </thead>
       <tbody>
         <tr>
           <td><b>VÍA</b> <span class="asterisco-campo-obligatorio"><strong>*</strong></span></td>
           <td>
             <label for="terrestre">
                <input type="radio" id="terrestre" {{($cadena->traslado == 'terrestre') ? 'checked' : ''}} {{($formAccion == 'registrar') ? 'checked' : ''}} name="traslado_via" value="terrestre" />
                <span></span>
             </label>
           </td>
           <td>
             <label for="aerea">
               <input type="radio" id="aerea" {{($cadena->traslado == 'aerea') ? 'checked' : ''}} name="traslado_via" value="aerea" />
                <span></span>
             </label>
           </td>
           <td>
             <label for="maritima">
               <input type="radio" id="maritima" {{($cadena->traslado == 'maritima') ? 'checked' : ''}} name="traslado_via" value="maritima" />
               <span></span>
             </label>
           </td>
         </tr>
       </tbody>
     </table>
   </div>

   <div class="col s12">
     <hr class="hr-1">
   </div>

   <div class="col s12">
     <table>
       <thead>
         <tr>
           <th width="28%"></th>
           <th width="36%">SI</th>
           <th width="36%">NO</th>
         </tr>
       </thead>
       <tbody>
         <tr>
           <td rowspan="2"><b>SE REQIEREN CONDICIONES ESPECIALES PARA SU TRASLADO <span class="asterisco-campo-obligatorio"><strong>*</strong></span></td>
           <td>
             <label for="condicionesSi">
               <input type="radio" id="condicionesSi" {{($cadena->trasladoCondiciones == 'si') ? 'checked' : ''}} name="traslado_condiciones" value="si" />
                <span></span>
             </label>
           </td>
           <td>
             <label for="condicionesNo">
               <input type="radio" id="condicionesNo" {{($cadena->trasladoCondiciones == 'no') ? 'checked' : ''}} {{($formAccion == 'registrar') ? 'checked' : ''}} name="traslado_condiciones" value="no" />
                <span></span>
             </label>
           </td>
         </tr>
         <tr>
           <td colspan="2">
             <input type="text" id="traslado_recomendaciones" {{($cadena->trasladoCondiciones == 'si') ? '' : 'disabled'}} {{($formAccion == 'registrar') ? 'disabled' : ''}} placeholder="---" name="traslado_recomendaciones" value="{{$cadena->trasladoRecomendaciones}}">
           </td>
         </tr>
       </tbody>
     </table>
   </div>
 </div>

 <div class="row">
   <div class="col s12">
     <hr class="hr-2">
   </div>
 </div> 