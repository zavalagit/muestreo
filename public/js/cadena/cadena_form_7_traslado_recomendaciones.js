$(function(){
	
   //Disabled recomendaciones traslado
   $('#condicionesSi').click(function(){
      $('#traslado_recomendaciones').removeAttr('disabled').attr('placeholder','Recomendaciones');
   });
   $('#condicionesNo').click(function(){
      $('#traslado_recomendaciones').val('').attr('disabled','true').attr('placeholder','---');
   });
 
 })