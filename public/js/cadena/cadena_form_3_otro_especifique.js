$(function(){

   $('#otroSi').click(function(){
      $('#especifique').removeAttr('disabled').attr('placeholder','Especifique');
   });
   $('#otroNo').click(function(){
      $('#especifique').val('').attr('disabled','true').attr('placeholder','---');
   });

});