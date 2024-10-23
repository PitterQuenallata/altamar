// vistas/js/usuarios.js

$(document).ready(function() {
  // Editar Usuario
  $(".btnEditarUsuario").click(function() {
    var idUsuario = $(this).attr("idUsuario");

    // Aquí puedes hacer una llamada AJAX para obtener los datos del usuario y llenar el formulario en el modal
    $.ajax({
      url: "ajax/usuarios.ajax.php",
      method: "POST",
      data: { idUsuario: idUsuario },
      dataType: "json",
      success: function(respuesta) {
        // Llenar el formulario en el modal con los datos obtenidos
        $("#editarNombre").val(respuesta.nombre);
        $("#editarApellido").val(respuesta.apellido);
        $("#editarUsuario").val(respuesta.usuario);
        $("#editarTelefono").val(respuesta.telefono);
        $("#editarRol").val(respuesta.rol);
        $("#editarEstado").val(respuesta.estado);
        $("#idUsuario").val(respuesta.id);
        $("#passwordActual").val(respuesta.password);
      }
    });
  });

  // Eliminar Usuario
  $(".btnEliminarUsuario").click(function() {
    var idUsuario = $(this).attr("idUsuario");

    swal({
      type: "warning",
      title: "¿Está seguro de borrar el usuario?",
      text: "¡Si no lo está puede cancelar la acción!",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí, borrar usuario"
    }).then((result) => {
      if (result.value) {
        window.location = "index.php?ruta=usuarios&idUsuario=" + idUsuario;
      }
    });
  });
});
