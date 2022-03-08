$(function(){

    $('#btn-ubicacion-agregar').click(function(e){
        e.preventDefault();

        var form =  new FormData($('#form-ubicacion-agregar')[0]);
        
        $(this).attr('disabled','on');
       
        $.ajax({
            data: form,
            url: "/ubicacion-agregar",
            type: "post",
            processData: false,
            contentType: false,
          }).done(function(data){
            console.log(data);
      
      
            if(data.satisfactorio){
              //alertify.logPosition("top right");
              alertify.success("¡SE CREO NUEVO LUGAR!");
              //alertify.success("Espere un momento.");
              setTimeout(function(){
                location.reload();
              },2000);
            }
            else {
              //alertify.logPosition("top right");
              alertify.error(data.error[0]);
              $('#btn-ubicacion-agregar').removeAttr('disabled');
            }
        });//ajax
        
    });

});