<div class="row">
  <!--titulo seccion-->
  @component('componentes.seccion_form')
    @slot('mensaje','5. EMPAQUE / EMBALAJE ~ ')
    @slot('icono','fas fa-edit')
  @endcomponent

  @if( $formAccion == 'registrar' )
    <div class="col s12">
      @component('componentes.componente_nota')
        Valor por default en <strong>BOLSA</strong>
      @endcomponent
    </div>
  @endif

  <div class="col s12">
    <table id="tabla-embalaje">
      <thead>
        <tr>
          <th class="th-center" width="3%">Nº</th>
          <th width="46%">IDENTIFICADOR</th>
          <th width="18%">BOLSA</th>
          <th width="18%">CAJA</th>
          <th width="18%">RECIPIENTE</th>
        </tr>
      </thead>
      <tbody>
        @if ($formAccion == 'registrar')
          @include('cadena.cadena_form_51_fila_identificador_embalaje',[
            'indice' => 0,
            'identificador' => '---'
          ])
        @elseif( in_array($formAccion,['editar','clonar']) )
          @foreach ($cadena->indicios as $indice => $indicio)
            @include('cadena.cadena_form_51_fila_identificador_embalaje')
          @endforeach      
        @endif
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <hr class="hr-2">
  </div>
</div>