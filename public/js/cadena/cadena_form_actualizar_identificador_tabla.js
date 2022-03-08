$(function(){

   $(document).on('keyup','.input-identificador',function(){
      var index = $(this).index('.input-identificador');
      $('#tabla-armas-tbody tr:eq('+index+') .indicio-identificador').empty().append( $(this).val() );
      $('#tabla-recoleccion tbody tr:eq('+index+') .indicio-identificador').empty().append( $(this).val() );
      $('#tabla-embalaje tbody tr:eq('+index+') .indicio-identificador').empty().append( $(this).val() );
   });

});