$(function(){

  //Elimina texto
  $('body').on('click',".texto-x",function(e){
    e.preventDefault();
    console.log('entra');
    var hijos = $('#div-row-textos').children('div');
    if(hijos.length > 1){
      $(this).parent().remove();
      
    }
  });
  //Agregar input del NUC
  $('#add-nuc').click(function(e){
    e.preventDefault();

      var nuc;

      nuc = 
        '<div class="input-field col s3">'+
          '<a href="" class="nuc-x"><i class="fas fa-times i-x"></i></a>'+
          '<input id="nuc" type="text" placeholder="N.U.C" class="validate" name="nucs[]">'+
        '</div>';


      $('#div-row-nucs').append(nuc);
        
  });

  //Elimina NUC
  $('body').on('click',".nuc-x",function(e){
    e.preventDefault();
    console.log('entra');
    var hijos = $('#div-row-nucs').children('div');
    if(hijos.length > 1)
      $(this).parent().remove();
  });


  
  

  

  $('#buscar-texto').keyup(
    function(){
      console.log('entrasdasd');

      var texto = $("#buscar-texto").val().length;

      console.log(texto);

      if (texto) {
        $('#listado-indicio').removeAttr('disabled');
      }
      else{
        $('#listado-indicio').attr('disabled','disabled');

        if($('input:radio[name=listado_tipo]:checked').val() == 'listado_indicio'){
          console.log('holasdddaasjjj');
          $('input[name="listado_tipo"]').prop('checked', false);
          $("#listado-cadena").prop("checked", true);
          
        }
      }
      // console.log($('input:radio[name=listado_tipo]:checked').val());
    }
  );


  $('input:radio[name=listado_tipo]').click(function(){
    if($('input:radio[name=listado_tipo]:checked').val() == 'listado_oficio'){
      $('.listado-indicio-estado').prop('disabled', true);
      $('.listado-indicio-estado').prop('checked', false);
      $('.listado-campo').prop('checked', false);
      $('.listado-campo').prop('disabled', true);
      $('.listado-archivo').prop('checked', false);
      $('.listado-archivo').prop('disabled', true); 
    }
    else if($('input:radio[name=listado_tipo]:checked').val() == 'listado_general'){
      $('.listado-indicio-estado').prop('disabled', false);
      $("#indicio-activo").prop("checked", true);
      $('.listado-campo').prop('disabled', false);
      $('.listado-archivo').prop('disabled', false);
      $("#listado-pdf").prop("checked", true);
    }
    else if($('input:radio[name=listado_tipo]:checked').val() == 'listado_folio'){
      $("#listado-excel").prop("checked", false);
      $("#listado-excel").prop("disabled", true);
      $("#listado-pdf").prop("checked", true);
    }
  });

  
  $('.listado-indicio-estado').click(function(e){
    // e.preventDefault();
    console.log('asdsasd');
    let array_estado = $('[name="indicio_estado[]"]:checked').map(function(){
      return this.value;
    }).get();
    
    if(array_estado.length == 0){
      $(this).prop("checked", true);
    }

  });

});
