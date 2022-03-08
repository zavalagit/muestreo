@switch($indicio->estado)
   @case('activo')
      <i class="fas fa-square" style="color: #76ff03;"></i>
      @break
   @case('prestamo')
      <i class="fas fa-square" style="color: #0d47a1;"></i>
      @break
   @case('baja')
      <i class="fas fa-square" style="color: #b71c1c;"></i>  
      @break
   @case('activo_baja')
      <i class="fas fa-square" style="color: #ffeb3b;"></i>
      @break
   @case('prestamo_baja')
      <i class="fas fa-square" style="color: #9c27b0;"></i>
      @break
   @default
      <i class="fas fa-square" style="color: #9e9e9e;"></i>
      @break
@endswitch