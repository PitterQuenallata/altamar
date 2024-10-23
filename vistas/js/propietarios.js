// vistas/js/propietarios.js

$(document).ready(function() {
  // Editar Propietario
  $(".btnEditarPropietario").click(function() {
    var idPropietario = $(this).attr("idPropietario");

    // Llamada AJAX para obtener los datos del propietario y llenar el formulario en el modal
    $.ajax({
      url: "ajax/propietarios.ajax.php",
      method: "POST",
      data: { idPropietario: idPropietario },
      dataType: "json",
      success: function(respuesta) {
        // Llenar el formulario en el modal con los datos obtenidos
        $("#idPropietario").val(respuesta.id);
        $("#idUsuario").val(respuesta.idusuario);
        $("#editarNombre").val(respuesta.nombre);
        $("#editarApellido").val(respuesta.apellido);
        $("#editarNroCarnet").val(respuesta.nroCarnet);
        $("#editarTelefono").val(respuesta.telefono);
        $("#editarCorreo").val(respuesta.correo);
        $("#editarActividad").val(respuesta.actividad);
        $("#editarNroDpto").val(respuesta.nroDpto);
      }
    });
  });

  // Eliminar Propietario
  $(".btnEliminarPropietario").click(function() {
    var idPropietario = $(this).attr("idPropietario");

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
        window.location = "index.php?ruta=propietarios&idPropietario=" + idPropietario;
      }
    });
  });
});
