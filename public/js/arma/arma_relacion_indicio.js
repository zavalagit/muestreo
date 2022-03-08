$(function(){
    $('.btn-relacion-indicio').click(function(e){
       e.preventDefault();
       console.log('hay vamos');
       let relacion_indicio_id = $(this).attr('data-relacion-arma-id');
       let estado = $(this).attr('data-indicio-estado');
       
       let _token = $('#meta-csrf-token').attr('content');
       $("#modal-indicio #modal-header .header-folio").empty();
       $("#modal-indicio #modal-header .header-folio").append(estado);
       //console.log(depuracion_id);
       $.ajax({
          type: "post",
          url: "acciones-modal-relacion/"+relacion_indicio_id,
          data: {_token:_token},
          success: function (respuesta) {
             console.log('bien');
             $("#modal-indicio #modal-body #modal-contenido").empty();
             $("#modal-indicio #modal-body #modal-contenido").append(respuesta);
             $('#modal-indicio').modal('open');
          },
          error: function(respuesta){
             console.log(respuesta);
          }
       });
 
       
    });
 
    
 });