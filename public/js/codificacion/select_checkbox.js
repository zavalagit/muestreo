$(function() {
   
   $('.cadena-checkbox')
      .change(function()
         {
            let cadena_id = $(this).attr('data-id-cadena');
            console.log('data-id-cadena:' + cadena_id);

            if($(this).prop('checked')){
               $('#cadena-'+cadena_id).prop("disabled", true);
               $(".c-" + cadena_id).prop("checked", true);
               $('#cadena-'+cadena_id).prop("checked", false);
               
            }
            else{
               $(".c-" + cadena_id).prop("checked", false);
               $(".c-" + cadena_id).prop("disabled", false);
            }
         }
      );

   $('.indicio-checkbox')
      .change(function(){
            let cadena_id = $(this).attr('data-cadena-id');

            if($('.c-'+cadena_id+':checked').length == $('#cadena-'+cadena_id).attr('data-indicios-cantidad')){
               $('#cadena-'+cadena_id).prop("disabled", true);
            }
            else{
               console.log('algo no anda bien');
               $('#cadena-'+cadena_id).prop("disabled", false);
            }
         }
      );

});