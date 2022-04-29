<div class="row">
   @include('muestreo.codificacion.codificacion_datos')
   
   <div class="col s12">
      <hr class="hr-main">
   </div>
   <!--Boton prestamo-->
   <div class="col s12 m4 l1 offset-m8 offset-l11">
      <button type="submit" class="btn-guardar" id="btn-prestar" style="display: inline-block !important; width:100%;" name="btn_prestamo" value="prestamo">
         {{$formAccion}}
      </button>
   </div>
   <!--Boton pdf-->
   <div class="col s12 m4 l1 offset-m8 offset-l11 ocultar">
      <a class="a-btn" id="btn-prestamo-pdf" style="display: inline-block !important; width:100%;" href="" target="_blank">
         <span>PDF</span> ~ <i class="fas fa-file-pdf"></i>
      </a>
   </div>
</div>