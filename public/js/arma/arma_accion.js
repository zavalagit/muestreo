$(function(){
    $('.btn-acciones').click(function(e){
       e.preventDefault();
       console.log('hay vamos');
       let arma_id = $(this).attr('data-arma-id');
       
       let _token = $('#meta-csrf-token').attr('content');
       $("#modal-acciones #modal-header .header-folio").empty();
       $("#modal-acciones #modal-header .header-folio").append("ID "+arma_id);
       console.log(arma_id);
       $.ajax({
          type: "post",
          url: "acciones-modal/"+arma_id,
          data: {_token:_token},
          success: function (respuesta) {
             //console.log(respuesta.arma);
             $("#modal-acciones #modal-body #modal-contenido").empty();
             $("#modal-acciones #modal-body #modal-contenido").append(respuesta);
             $('#modal-acciones').modal('open');
          },
          error: function(respuesta){
             console.log(respuesta);
          }
       });
 
       
    });
 
    //Habilitar e inhabiltar cadena
    $('body').on('click','.btn-cadena-editar',function(e){
       e.preventDefault(); 
       let _token = $('#meta-csrf-token').attr('content');
       let cadena_id = $(this).attr('data-cadena-id');
    
          $.ajax({
             type: 'post',
             url: '/cadena-editar-habilitar/'+cadena_id,
             data: {_token:_token},
             success:function(data){
                if (data.cadena_editar === 'si')
                   alertify.success('<i class="fas fa-check"></i> SE HABILITO CADENA');
                else if(data.cadena_editar === 'no')
                   alertify.error('<i class="fas fa-times"></i> SE INHABILITO CADENA');
             
                   setTimeout(function(){
                      location.reload();
                   },1000);
             }
          });
          
    });
 });