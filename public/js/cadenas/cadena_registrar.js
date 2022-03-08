$(function(){

  //Boton Registrar Cadena Custodia
  $('#btn-registrar-cadena').click(function(e){
    console.log('entrasdasd');
    e.preventDefault();
    var form = new FormData($('#form-registrar-cadena')[0]);

    $(this).attr('disabled','on');

    $.ajax({
      data: form,
      url: "/cadena-guardar",
      type: "post",
      processData: false,
      contentType: false,
    }).done(function(data){
        //console.log(data);


      if(data.satisfactorio){
        alertify.success("¡REGISTRO CON EXITO!");

        setTimeout(function(){
          if(data.arma){
            window.location.href = '/arma-form/cadena/registrar/'+data.cadena_id;
          }else{
            window.location.href = 'consultar-cadena?buscar='+data.nuc;
          }
        },2000);
      }
      else {
        //alertify.logPosition("top right");
        alertify.error(data.error[0]);
        $('#btn-registrar-cadena').removeAttr('disabled');
      }

    });//ajax
  });

});
