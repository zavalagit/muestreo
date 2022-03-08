$(function(){

   $('#form-cadena').submit(function(e){
      e.preventDefault();
      $.ajax({
         type: $(this).attr('method'),
         url: $(this).attr('action'),
         data: $(this).serialize(),
         beforeSend: function(){
            $('#btn-cadena').empty().prop("disabled",true).append('Enviando...');
         },
         complete:function(respuesta){
            // console.log(respuesta);
            /*
            * Se ejecuta al termino de la petición
            * */

            //spin
            
         },
         success: function(respuesta) {
               console.log(respuesta);
               $('#btn-cadena').empty().append('Registrado');
               alertify.success("REGISTRO REALIZADO");
               setTimeout(function(){
                  // location.reload();
                  if (respuesta.request.cadena_arma == 'si') {
                     window.location.replace("/arma-form/registrar/cadena/"+respuesta.cadena.id);                     
                  } else {
                     window.location.replace("/consultar-cadena?buscar="+respuesta.cadena.nuc);               
                  }
               },3000);

               $('#btn-cadena').empty().prop("disabled",false).append('Registrar');
         },
         error: function(respuesta){
            $('#btn-cadena').empty().prop("disabled",false).append('Registrar');
            // console.log(response);
            let firstKey = Object.keys(respuesta.responseJSON.errors)[0];
            alertify.error(respuesta.responseJSON.errors[firstKey][0]);

            //aletifyjs
            // alertify.set('notifier','position', 'top-center');
            // alertify.set('notifier','delay', 4);
            // alertify.error(respuesta.responseJSON.errors[firstKey][0]);
         }
      });
   });

});