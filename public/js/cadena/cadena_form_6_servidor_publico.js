$(function(){
   /*
      --html:
         <div class="col s12">
            <div class="row">
               <div class="input-field col s12">
                  <input id="perito-hidden" type="hidden" name="id_perito">
                  <input  class="autocomplete" id="autocomplete-input" data-tabla="peritos" data-input-hidden="perito-hidden" type="text">
                  <label for="autocomplete-input">Autocomplete</label>
               </div>
            </div>
         </div>

         *contiene varios datas
            ·data-tabla -> tabla o modelo a la que se hace referencia
            ·data-input-hidden -> es el id del input donde vamos a cargar el id del modelo
            ·data-user-tipo -> en caso de que sea el modelo users podemos pasar que tipo de usuario queremos
   */

   $('body').on('keypress','input.autocomplete-servidor-publico-cadena-cuscodia',function(){
      let buscar = $(this).val();
      let tabla = $(this).attr('data-tabla');
      let input_hidden =  $(this).attr('data-input-hidden');
      console.log(input_hidden);
      let _token;
      if($('#_token').val())
         _token = $('#_token').val();
      else{
         _token = $('#meta-csrf-token').attr('content');
      }
      let url;
      let datos = {
         '_token':_token,
         'buscar':buscar,
      }
   
      if (tabla == 'peritos') {
         url =  '/get-perito';
      }
      else if (tabla == 'users'){
         url = '/get-user';
         //user_tipo
         if($(this).attr('data-user-tipo')){
            datos['user_tipo'] = $(this).attr('data-user-tipo');
         }
         //user_fiscalia
         if($(this).attr('data-user-fiscalia')){
            datos['user_fiscalia'] = $(this).attr('data-user-fiscalia');
         }
      }

      // console.log(datos);
   
  
      $.ajax({
         url: url,
         type: 'POST',
         data: datos,
         success:function(data){
            console.log(data.registros);
            let objeto_input = {}; //elementos a cargar en el input autocomplete
            let objeto_ids = {}; //ids de los elementos que se cargan en el input autocomplete, para despues obtener el id del registro seleccionado
            let clave;

            data.registros.forEach(element => {               
               clave = element.folio+' - '+element.name;
               objeto_input[clave] = null; //son los elementos a cargar en el input, el null es porque no va llevar imagen
               objeto_ids[clave] = element.id; //objeto de los ids de los elementos
            });

            /*Autocomplete*/
            $('input.autocomplete-servidor-publico-cadena-cuscodia').autocomplete({
               data: objeto_input,
               limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
               onAutocomplete: function(val) {
                  // Callback function when value is autcompleted.
                  // console.log(val);
                  // console.log( data.registros.find( user => user.id === parseInt( objeto_ids[val] ) ) );
                  let user = data.registros.find( user => user.id === parseInt( objeto_ids[val] ) );
                  tr_user(user);
                  $('input.autocomplete-servidor-publico-cadena-cuscodia').val('');
               },
               minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
            });
         }
      });
   });

   $(document).on('click','.sp-eliminar',function(e){
      e.preventDefault();
      $(this).parent().parent().remove();
      $('.td-indice-servidor-publico').each(function(indice, elemento){
         $(this).empty().append( indice + 1 );
      });
   });

   /**Funciones*/

   function tr_user(user) {
      $.ajax({
         type: "post",
         url: "/fila-tabla-servidor-publico",
         data: {
            '_token': $('#meta-csrf-token').attr('content'),
            'indice': $('#tabla-servidor-publico tbody tr').length,
            'sp_id': user.id,
         },
         // dataType: "dataType",
         success: function (vista) {
            $('#tabla-servidor-publico tbody').append(vista);
         }
      });
   }


   
});

