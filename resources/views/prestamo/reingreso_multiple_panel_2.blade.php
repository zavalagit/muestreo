<div class="row">
   @include('prestamo.reingreso_datos')

   <div class="col s12 m4 l1 offset-m8 offset-l11">
      <button type="submit" class="btn-guardar" id="btn-reingresar" style="display: inline-block !important; width:100%;" name="btn_prestamo" value="prestamo">
         {{$formAccion}}
      </button>
   </div>  
</div>