$(function(){

   $(document).on('submit','#form-foto',function(e){
      e.preventDefault();

      $.ajax({
         type: $(this).attr('method'),
         url: $(this).attr('action'),
         data:  new FormData(this),
         contentType: false,
         processData: false,
         beforeSend: function(){
            $('#btn-foto').empty().prop("disabled",true).append('Enviando...');
            // $('#btn-colectivo').empty().append('Enviando...');
         },
         complete:function(respuesta){
            // console.log(respuesta);
            /*
            * Se ejecuta al termino de la petición
            * */

            //spin
            
         },
         success: function (respuesta) {
            if(respuesta.status){
               alertify.success("FOTO(S) SUBIDAS");
               $('#modal-foto-form').modal('close');
               setTimeout(function(){
                  location.reload();
               },1400);
            }
         },
         error: function(respuesta){
            $('#btn-foto').empty().prop("disabled",false).append('GUARDAR');
            console.log(respuesta);
            let firstKey = Object.keys(respuesta.responseJSON.errors)[0];
            alertify.error(respuesta.responseJSON.errors[firstKey][0]);

            //aletifyjs
            // alertify.set('notifier','position', 'top-center');
            // alertify.set('notifier','delay', 4);
            // alertify.error(respuesta.responseJSON.errors[firstKey][0]);
         }
      });
   });

   $('.foto-form-modal').click(function(e){
      e.preventDefault();
      let cadena = $(this).attr('data-cadena');
      let modelo = $(this).attr('data-modelo');
      let modelo_id = $(this).attr('data-modelo-id');
      $.ajax({
         type: 'post',
         url: '/load-foto-form/'+modelo+'/'+modelo_id,
         data: {
            _token: $('#meta-csrf-token').attr('content')
         },
         success: function(view){
            console.log(view);

            $('#modal-foto-form .modal-content').empty().append(view);
            $('#modal-foto-form').modal('open');
         },
      });
   });

});