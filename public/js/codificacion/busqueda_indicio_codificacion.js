$(function(){

	$('#btn-buscar').click(function(e){
		e.preventDefault();
		var form = new FormData($('#form-codificacion-busqueda')[0]);
		//var form = $("#form-codificacion-busqueda").serialize();

		console.log(form);
		
	});

});
