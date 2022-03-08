<div class="row">
   <!--titulo seccion-->
   @component('componentes.seccion_form')
     @slot('mensaje','3. DOCUMENTACIÓN ~ ')
     @slot('icono','fas fa-edit')
   @endcomponent

   @if( $formAccion == 'registrar' )
      <div class="col s12">
         @component('componentes.componente_nota')
            Valores por default en <strong>NO</strong>
         @endcomponent
      </div>
   @endif

   <!--tabla-->
   <div class="col s12">
      <table>
         <thead>
            <tr>
               <th class="th-center" width="3%">Nº</th>
               <th width="45%">MÉTODO</th>
               <th>SI</th>
               <th>NO</th>
            </tr>
         </thead>
         <tbody>
            <!--escrito-->
            <tr>
               <td class="td-contador">1</td>
               <td><b>ESCRITO</b></td>
               <td>
                  <label>
                     <input name="escrito" type="radio" id="escritoSi" {{($cadena->escrito == 'si') ? 'checked' : ''}} value="si" />
                     <span></span>
                  </label>                  
               </td>
               <td>
                  <label>
                     <input name="escrito" type="radio" id="escritoNo" {{($cadena->escrito == 'no') ? 'checked' : ''}} {{($formAccion == 'registrar') ? 'checked' : ''}} value="no" />
                     <span></span>
                  </label>                  
               </td>
            <!--fotografico-->
            <tr>
               <td class="td-contador">2</td>
               <td><b>FOTOGRÁFICO</b></td>
               <td>
                  <label>
                     <input name="fotografico" type="radio" id="fotograficoSi" {{($cadena->fotografico == 'si') ? 'checked' : ''}} value="si" />
                     <span></span>
                  </label>                  
               </td>
               <td>
                  <label>
                     <input name="fotografico" type="radio" id="fotograficoNo" {{($cadena->fotografico == 'no') ? 'checked' : ''}} {{($formAccion == 'registrar') ? 'checked' : ''}} value="no" />
                     <span></span>
                  </label>   
               </td>
            </tr>
            <!--croquis-->
            <tr>
               <td class="td-contador">3</td>
               <td><b>CROQUIS</b></td>
               <td>
                  <label>
                     <input name="croquis" type="radio" id="croquisSi" {{($cadena->croquis == 'si') ? 'checked' : ''}} value="si" />
                     <span></span>
                  </label>
               </td>
               <td>
                  <label>
                     <input name="croquis" type="radio" id="croquisNo" {{($cadena->croquis == 'no') ? 'checked' : ''}} {{($formAccion == 'registrar') ? 'checked' : ''}} value="no" />
                     <span></span>
                  </label>                  
               </td>
            </tr>
            <!--otro-->
            <tr>
               <td class="td-contador" rowspan="2">4</td>
               <td rowspan="2"><b>OTRO</b></td>
               <td>
                  <label>
                     <input name="otro" type="radio" id="otroSi" {{($cadena->otro == 'si') ? 'checked' : ''}} value="si" />
                     <span></span>
                  </label>                  
               </td>
               <td>
                  <label>
                     <input name="otro" type="radio" id="otroNo" {{($cadena->otro == 'no') ? 'checked' : ''}} {{($formAccion == 'registrar') ? 'checked' : ''}} value="no" />
                     <span></span>
                  </label>                  
               </td>
            </tr>
            <tr>
               <td colspan="2">
                  <input type="text" id="especifique" {{($cadena->otro == 'no') ? 'disabled' : ''}} {{($formAccion == 'registrar') ? 'disabled' : ''}} placeholder="---" name="especifique" value="{{$cadena->especifique}}">
                  {{-- <label for="especifique">ESPECIFIQUE</label> --}}
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