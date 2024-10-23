/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarServicio", function(){

	var idServicio = $(this).attr("idServicio");

	var datos = new FormData();
	datos.append("idServicio", idServicio);

	$.ajax({
		url: "ajax/servicios.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
            $("#IdServicio").val(respuesta["id"]);
     		$("#editarNombreServicio").val(respuesta["nombre"]);
			$("#editarPrecio").val(respuesta["precio"]);
     		

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarServicio", function(){

	 var idServicio = $(this).attr("idServicio");

	 swal({
	 	title: '¿Está seguro de borrar la servicio?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar servicio!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=servicios&idServicio="+idServicio;

	 	}

	 })

})