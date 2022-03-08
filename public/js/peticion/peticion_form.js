$(function(){

   $('.btn-peticion-etapa').click(function(){
      $('#peticion-etapa').val( $(this).val() );
   });

   $('#form-peticion').submit(function(e){
      e.preventDefault();
      console.log($(this).attr('action'));
      $.ajax({
         type: $(this).attr('method'),
         url: $(this).attr('action'),
         data: $(this).serialize(),
         success: function (respuesta) {
            console.log(respuesta);

            if (respuesta.formAccion == 'registrar') $('#form-peticion').attr('action','/peticion-save/' + respuesta.formAccion +'/'+ respuesta.peticion.id);               

            if(respuesta.formAccion == 'registrar' || respuesta.formAccion == 'continuar' ){
               if( respuesta.etapa == 'etapa_uno' )
                  etapa_uno();
               else if( respuesta.etapa == 'etapa_dos' )
                  etapa_dos();               
               else if( respuesta.etapa == 'etapa_tres' ){
                  setTimeout(function(){
                     location.href ="/peticion-consultar";
                  },2000);
                  alertify.success("DATOS DE ENTREGA ~ GUARDADO");
               }
            }
            // else if(respuesta.formAccion == 'continuar'){
            //    if( respuesta.etapa == 'etapa_dos' )
            //       etapa_dos();               
            //    else if( respuesta.etapa == 'etapa_tres' ){
            //       setTimeout(function(){
            //          location.href = document.referrer;
            //       },2000);
            //       alertify.success("DATOS DE ENTREGA ~ GUARDADO");
            //    }
            // }
            else if(respuesta.formAccion == 'clonar'){
               setTimeout(function(){
                  window.location.href = document.referrer;;
               },2000);
               alertify.success("REGISTRO CLONADO");
            }

            // $('select').formSelect();
            // $('#peticion-etapa-uno input, #peticion-etapa-uno select').readonly(true);
            
            // $('#selectid option:not(:selected)').attr('disabled',true);
            $('select').formSelect();

            console.log(respuesta.peticion);

            
         },
         error: function(respuesta){
            // $('#btn-colectivo').empty().prop("disabled",false).append('Registrar');
            // console.log(respuesta);
            let firstKey = Object.keys(respuesta.responseJSON.errors)[0];
            alertify.error(respuesta.responseJSON.errors[firstKey][0]);
         } 
      });
   });

   function etapa_uno() {
      //mensaje success
      alertify.success("DATOS DE LA PETICIÓN ~ GUARDADO");
      //show btn-registro-nuevo
      $('#btn-nuevo-registro').show('slow');
      //hide btn-peticion-etapa-uno
      $('#btn-peticion-etapa-uno').parent().hide('slow');
      //hide asteriscos de campo obligatorio
      $('.asterisco-etapa-uno').hide();
      //haciendo readonly todos los campos de la etapa-uno
      $('#peticion-etapa-uno input[type="text"]').readonly(true);
      $('#peticion-etapa-uno input[type="date"]').readonly(true);
      // $('#peticion-etapa-uno input[type="radio"]').prop('disabled',true);
      $('#peticion-etapa-uno :radio:not(:checked)').prop('disabled',true);
      $('#peticion-etapa-uno select option:not(:selected)').attr('disabled',true);
      //show section peticion-etapa-dos
      $('#peticion-etapa-dos').fadeIn(2500);
   }

   function etapa_dos() {
      //mensaje success
      alertify.success("DATOS DE ELABORACIÓN ~ GUARDADO");
      //hide btn-peticion-etapa-dos
      $('#btn-peticion-etapa-dos').parent().hide('slow');
      //hide asteriscos de campo obligatorio
      $('.asterisco-etapa-dos').hide();
      //haciendo readonly todos los campos de la etapa-dos
      $('#peticion-etapa-dos input').readonly(true);
      $('#peticion-etapa-dos select option:not(:selected)').attr('disabled',true);
      //show section peticion-etapa-tres
      $('#peticion-etapa-tres').fadeIn(2500);


   }
});