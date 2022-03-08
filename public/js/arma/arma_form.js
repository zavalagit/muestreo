$(function(){

   $('#form-arma').submit(function(e){
      e.preventDefault();
      // let form = new FormData($('#form-colectivo')[0]);
      console.log('estoy armasjs');
      console.log($(this).attr('action'));

      $.ajax({
         type: $(this).attr('method'),
         url: $(this).attr('action'),
         data: $(this).serialize(),
         success: function(respuesta) {
            console.log(respuesta);
            alertify.success("REGISTRO REALIZADO");

             //console.log($( this ).serialize());
            //console.log(respuesta.accion);
         // if(respuesta.accion == 'registrar'){
         //    //console.log(respuesta.request);
         //    $('#btn-arma').empty().append('Registrado');
         //    alertify.success("REGISTRO REALIZADO");
            
         // }
            // else if(respuesta.accion == 'editar'){
            //    $('#btn-arma').empty().append('Editado');
            //    alertify.success("REGISTRO MODIFICADO");
            //    setTimeout(function(){
            //       window.location.href =  document.referrer;
            //    },3000);
            // }
            // else if(respuesta.accion == 'clonar'){
            //    $('#btn-arma').empty().append('Clonado');
            //    alertify.success("REGISTRO CLONADO");
            //    setTimeout(function(){
            //       window.location.href =  document.referrer;
            //    },3000);
            // }
            // else if(respuesta.accion == 'validar'){
            //    $('#btn-arma').empty().append('Validado');
            //    alertify.success("REGISTRO VALIDADO");
            //    setTimeout(function(){
            //       window.location.href =  document.referrer;
            //    },3000);
            // }
            // else if(respuesta.accion == 'entregar'){
            //    $('#btn-arma').empty().append('Entregado');
            //    alertify.success("SE AGREGARON LOS DATOS DE ENTREGA");
            //    setTimeout(function(){
            //       window.location.href =  document.referrer;
            //    },3000);
            // }

            window.location.replace("/consultar-cadena?buscar="+respuesta.cadena.nuc);
         },
         error: function(respuesta){
             console.log(respuesta);
            //$('#btn-arma').empty().prop("disabled",false).append('Registrar');
            //console.log(response);
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