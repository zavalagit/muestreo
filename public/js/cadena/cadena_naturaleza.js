$(function(){

   $("#select-cadena-naturaleza").change(function(e) { 
      e.preventDefault();
      //para ver si el valor de la naturaleza es 1 o 2, que corresponde a las armas
      if ( ['1','2'].includes( $(this).val() ) ) {
         $('#row-tabla-checkbox-arma').removeClass('hide');
      }else{
         $('#row-tabla-checkbox-arma').addClass('hide');
      }
   });

});