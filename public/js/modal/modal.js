$(function(){
   /*Configuracion general*/
   $('.modal').modal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      inDuration: 200, // Transition in duration
      outDuration: 200, // Transition out duration
      startingTop: '4%', // Starting top style attribute
      endingTop: '10%', // Ending top style attribute
   });
   /*cerrar modal*/
   $('body').on('click','.btn-modal-cerrar',function(e){
		e.preventDefault();
		$('.modal').modal('close');
   });
});