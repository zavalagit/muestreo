<div class="row">
  <!--titulo seccion-->
  @component('componentes.seccion_form')
    @slot('mensaje','4. RECOLECCIÓN ~ ')
    @slot('icono','fas fa-edit')
  @endcomponent

  @if( $formAccion == 'registrar' )
    <div class="col s12">
      @component('componentes.componente_nota')
        Valor por default en <strong>MANUAL</strong>
      @endcomponent
    </div>
  @endif

  <div class="col s12">
    <table id="tabla-recoleccion">
      <thead>
        <tr>
          <th class="th-center" width="3%">Nº</th>
          <th width="47%">IDENTIFICADOR</th>
          <th width="25%">MANUAL</th>
          <th width="25%">INSTRUMENTAL</th>
        </tr>
      </thead>
      <tbody>
        @if ( $formAccion == 'registrar' )
          @include('cadena.cadena_form_41_fila_identificador_recoleccion',[
            'indice' => 0,
            'identificador' => '---'
          ])
        @elseif( in_array($formAccion,['editar','clonar']) )
          @foreach ($cadena->indicios->values() as $indice => $indicio)
            @include('cadena.cadena_form_41_fila_identificador_recoleccion')
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
</div