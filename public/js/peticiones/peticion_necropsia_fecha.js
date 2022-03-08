$(function(){

   $('#solicitud-select').change(
      function(){
         console.log('entrasdasdasdasd');
         let solicitud_id = $(this).val();
         
         // if( (solicitud_id == 61) || (solicitud_id == 62) ){
         //    $('#peticion-etapa-dos div').removeClass('l4').addClass('l3')
         //    $('#fecha-necropsia').parent().removeClass('hide');
         // }
         // else{
         //    $('#peticion-etapa-dos div').removeClass('l3').addClass('l4')
         //    $('#fecha-necropsia').parent().addClass('hide');
         // }
      }
   );
   
});