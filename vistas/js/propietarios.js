
$(document).ready(function() {
// Destruir cualquier instancia previa de DataTable
if ($.fn.DataTable.isDataTable('#propietarios')) {
  $('#propietarios').DataTable().destroy();
}

// Inicializar DataTable con configuración en español
$('#propietarios').DataTable({
  "language": {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst": "Primero",
      "sLast": "Último",
      "sNext": "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  }
});



// Delegar evento para Editar Propietario
$(document).on('click', '.btnEditarPropietario', function() {
  var idPropietario = $(this).data("id"); // Cambiar a data-id para obtener el ID correctamente

  // Llamada AJAX para obtener los datos del propietario y llenar el formulario en el modal
  $.ajax({
      url: "ajax/propietarios.ajax.php",
      method: "POST",
      data: { idPropietario: idPropietario },
      dataType: "json",
      success: function(respuesta) {
          console.log(respuesta); // Para ver la respuesta en la consola
          
          // Llenar el formulario en el modal con los datos obtenidos
          $("#idPropietario").val(respuesta.id);
          $("#idUsuario").val(respuesta.id_usuario); // id_usuario según la tabla
          $("#editarNombre").val(respuesta.nombre);
          $("#editarApellidoPaterno").val(respuesta.apellido_paterno); // apellido_paterno
          $("#editarApellidoMaterno").val(respuesta.apellido_materno); // apellido_materno
          $("#editarNroCarnet").val(respuesta.nroCarnet);
          $("#editarTelefono").val(respuesta.telefono);
          $("#editarCorreo").val(respuesta.correo);
          $("#editarNroDpto").val(respuesta.nroDpto);
      }
  });
});

// Delegar evento para Eliminar Propietario
$(document).on('click', '.btnEliminarPropietario', function() {
  var idPropietario = $(this).data("id"); // Cambiar a data-id para obtener el ID correctamente

  swal({
    type: "warning",
    title: "¿Está seguro de borrar el propietario?",
    text: "¡Si no lo está puede cancelar la acción!",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, borrar propietario"
  }).then((result) => {
    if (result.value) {
      // Redirigir para eliminar el propietario
      window.location = "index.php?ruta=propietarios&idPropietario=" + idPropietario;
    }
  });
});

});
