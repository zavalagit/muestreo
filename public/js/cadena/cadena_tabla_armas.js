$(function () {
   
   // $('#add-desc').click(function(e){
   //    e.preventDefault();

   //    let _token = $('#meta-csrf-token').attr('content');

   //    $.ajax({
   //       type: "post",
   //       url: "/fila-tabla-armas",
   //       data: {
   //          '_token': _token,
   //          'indice':$('.div-indicio').length,
   //          'identificador':$('.div-indicio:last input[name="identificador[]"]').val()
   //       },
   //       // dataType: "dataType",
   //       success: function (vista) {
   //          console.log(vista);
   //          $('#tabla-armas-tbody').append(vista);
   //       }
   //    });
   // });

   $('.cadena-arma').click(function(){
      console.log($(this).val());
      if( $(this).val() == 'si' ){
         $('#row-tabla-checkbox-arma').removeClass('hide');
      }else{
         $('#row-tabla-checkbox-arma').addClass('hide');
      }
   });

})