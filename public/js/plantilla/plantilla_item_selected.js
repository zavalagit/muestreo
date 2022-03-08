$(function(){
      // let nombre_pagina = $('#nombre-pagina').attr('data-nombre-pagina');
      // $('#'+nombre_pagina).parent().addClass('item-selected');
      // // $('#'+nombre_pagina+' i').addClass('fa-lg');

      // if( $('#nombre-pagina').attr('data-submenu') != '' ){
      //       let submenu = $('#nombre-pagina').attr('data-submenu');
      //       $('#'+submenu).addClass('active');
      //       // $('#'+submenu+' .collapsible-header').addClass('active');
      //       $('#'+submenu+' .collapsible-header i').css('color','#152f4a');
      //       // $('#'+submenu+' .collapsible-header i').addClass('fa-pulse');
      //       $('#'+submenu+' .collapsible-body').css(
      //             {
      //             'display' : 'block',
      //             }
      //       );
      // }

      // $('.item-selected').parent().addClass(['active']);
      // $('.item-selected').parent().children('.collapsible-body').css('display','block');
      // $('.item-selected').parent().children('.collapsible-header').children('i').css('color','#c09f77');
      // $('.item-selected').parent().children('.collapsible-header').children('i').removeClass('fa-caret-down').addClass('fa-caret-up');
      
      $('.item-selected').parent().parent().parent().addClass('active');
      $('.item-selected').parent().parent().css('display','block');
      $('.item-selected').parent().parent().parent().children('.collapsible-header').children('i').css('color','#c09f77');

});