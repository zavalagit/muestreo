$(function(){

   //Agrega nueva descripcion
   $(document).on('click','#add-desc',function(e){
      e.preventDefault();

      $.ajax({
         type: "post",
         url: "/form-indicio",
         data: {'_token': $('#meta-csrf-token').attr('content')},
         success: function (vista) {
            $('.div-indicio:last').after(vista);
            $('.div-indicio-indice:last').empty().append( div_indicio_length() );
            //agregando fila a tabla armas
            add_fila_tabla_checkbox( $('.div-indicio:last input[name="identificador[]"]').val() );
            //agregando fila a tabla recoleccion
            add_fila_tabla_recoleccion( $('.div-indicio:last input[name="identificador[]"]').val() );
            //agregando fila a tabla embalaje
            add_fila_tabla_embalaje( $('.div-indicio:last input[name="identificador[]"]').val() );
            //quitando hide al btn eliminar
            remmove_hide_delete_indicio();
         }
      });
   });
   
   //Elimina una descripcion
   $(document).on('click',".x-desc",function(e){
      e.preventDefault();

      let index = $(this).index('.x-desc');
      if( $('.div-indicio').length > 1 ){
         //eliminando div de descripcion de indicios
         $('.div-indicio:eq('+index+')').remove();
         //acomodando el numero de indice en div de descripcion de indicios
         $('.div-indicio-indice').each(function(indice, elemento){
            $(this).empty().append( indice + 1 );
         });
         //eliminando fila correspondiente al indicio eliminado en tablas
         $('#tabla-armas-tbody tr:eq('+index+')').remove();
         $('#tabla-recoleccion tbody tr:eq('+index+')').remove();
         $('#tabla-embalaje tbody tr:eq('+index+')').remove();
         //acomodando indice en tablas
         $('.td-indice-armas').each(function(indice, elemento){
            $(this).empty().append( indice + 1 );
         });
         $('.td-indice-recoleccion').each(function(indice, elemento){
            $(this).empty().append( indice + 1 );
         });
         $('.td-indice-embalaje').each(function(indice, elemento){
            $(this).empty().append( indice + 1);
         });
         //acomando atributos de las tablas
         $('#tabla-recoleccion tbody tr').each(function(i,tr){
            $('.td-input-recoleccion',this).each(function(j,td){
               $('input',this).removeAttr('id').attr('id','recoleccion-'+(2*i+j));
               $('label',this).removeAttr('for').attr('for','recoleccion-'+(2*i+j));
               $('input',this).removeAttr('name').attr('name','recoleccion['+i+']');
            });
         });
         $('#tabla-embalaje tbody tr').each(function(i,tr){
            $('.td-input-embalaje',this).each(function(j,td){
               $('input',this).removeAttr('id').attr('id','embalaje-'+(3*i+j));
               $('label',this).removeAttr('for').attr('for','embalaje-'+(3*i+j));
               $('input',this).removeAttr('name').attr('name','embalaje['+i+']');
            });
         });
         $('#row-tabla-checkbox-arma tbody tr').each(function(i,tr){
            $('.td-input-arma',this).each(function(j,td){
               $('input',this).removeAttr('id').attr('id','indicio-arma-'+(2*i+j));
               $('label',this).removeAttr('for').attr('for','indicio-arma-'+(2*i+j));
               $('input',this).removeAttr('name').attr('name','indicio_arma['+i+']');
            });           
         });
         
         //si la cantidad de "div de descripcion" es iguala 1 escondemos el boton de eliminar
         if ( $('.x-desc').length == 1 ) {
            $('.x-desc').addClass('hide');
         }
      }
   });

   //Clonar indicio
   $(document).on('click',".clonar-indicio",function(e){
      e.preventDefault();
      let index = $(this).index('.clonar-indicio');
      $('.div-indicio:last').after( $('.div-indicio:eq('+index+')').clone() );
      $('.div-indicio-indice:last').empty().append( div_indicio_length() );
      remmove_hide_delete_indicio();

      add_fila_tabla_checkbox( $('.div-indicio:eq('+index+') input[name="identificador[]"]').val() );
      add_fila_tabla_recoleccion( $('.div-indicio:eq('+index+') input[name="identificador[]"]').val() );
      add_fila_tabla_embalaje( $('.div-indicio:eq('+index+') input[name="identificador[]"]').val() );
   });


   /** 
    * funciones  
    */

   function div_indicio_length() {
      return $('.div-indicio').length;
   }
   function remmove_hide_delete_indicio(){
      $('.x-desc').removeClass('hide');
   }
   function add_fila_tabla_checkbox(identificador) {
      $.ajax({
         type: "post",
         url: "/fila-tabla-armas",
         data: {
            '_token': $('#meta-csrf-token').attr('content'),
            'indice':$('.div-indicio').length - 1,
            'identificador': identificador
         },
         // dataType: "dataType",
         success: function (vista) {
            $('#tabla-armas-tbody').append(vista);
         }
      });
   }
   function add_fila_tabla_recoleccion(identificador) {
      $.ajax({
         type: "post",
         url: "/fila-tabla-recoleccion",
         data: {
            '_token': $('#meta-csrf-token').attr('content'),
            'indice':$('.div-indicio').length - 1,
            'identificador': identificador
         },
         // dataType: "dataType",
         success: function (vista) {
            $('#tabla-recoleccion tbody').append(vista);
         }
      });
   }
   function add_fila_tabla_embalaje(identificador) {
      $.ajax({
         type: "post",
         url: "/fila-tabla-embalaje",
         data: {
            '_token': $('#meta-csrf-token').attr('content'),
            'indice':$('.div-indicio').length - 1,
            'identificador': identificador
         },
         // dataType: "dataType",
         success: function (vista) {
            console.log(vista);
            $('#tabla-embalaje tbody').append(vista);
         }
      });
   }

});
