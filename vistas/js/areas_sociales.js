$(document).ready(function () {
  // Inicializar DataTable con la opción de destruir y configuración en español
  var tabla = $("#tablaAreasSociales").DataTable({
    destroy: true,
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });

  // Cambiar el estado del área social
  $(".tablaAreasSociales").on("click", ".btnCambiarEstado", function () {
    var idAreaSocial = $(this).attr("idAreaSocial");
    var estadoAreaSocial = $(this).attr("estadoAreaSocial");
    var row = $(this).closest("tr");

    var datos = new FormData();
    datos.append("idAreaSocial", idAreaSocial);
    datos.append("estadoAreaSocial", estadoAreaSocial);

    $.ajax({
      url: "ajax/areas_sociales.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        if (respuesta.indexOf("ok") !== -1) {
          if (estadoAreaSocial == 0) {
            $('button[idAreaSocial="' + idAreaSocial + '"]', row)
              .removeClass("btn-success")
              .addClass("btn-danger")
              .text("Inactivo");
            $('button[idAreaSocial="' + idAreaSocial + '"]', row).attr(
              "estadoAreaSocial",
              1
            );
          } else {
            $('button[idAreaSocial="' + idAreaSocial + '"]', row)
              .removeClass("btn-danger")
              .addClass("btn-success")
              .text("Activo");
            $('button[idAreaSocial="' + idAreaSocial + '"]', row).attr(
              "estadoAreaSocial",
              0
            );
          }
        }
      },
    });
  });

  // Cargar datos en el modal de edición
  $(".tablaAreasSociales").on("click", ".btnEditarAreaSocial", function () {
    var idAreaSocial = $(this).attr("idAreaSocialEditar");

    var datos = new FormData();
    datos.append("idAreaSocial", idAreaSocial);

    $.ajax({
      url: "ajax/areas_sociales.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        $("#editarDescripcion").val(respuesta["descripcion"]);
        $("#editarPrecio").val(respuesta["precio"]);
        $("#idAreaSocial").val(respuesta["id"]);
      },
    });
  });

  // Eliminar área social
  $(".tablaAreasSociales").on("click", ".btnEliminarAreaSocial", function () {
    var idAreaSocial = $(this).attr("idAreaSocialEliminar");

    swal({
      title: "¿Está seguro de borrar el área social?",
      text: "¡Si no lo está puede cancelar la acción!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, borrar área social!",
    }).then(function (result) {
      if (result.value) {
        var datos = new FormData();
        datos.append("idAreaSocialEliminar", idAreaSocial);

        $.ajax({
          url: "ajax/areas_sociales.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function (respuesta) {
            if (respuesta.indexOf("ok") !== -1) {
              swal({
                type: "success",
                title: "¡El área social ha sido eliminada correctamente!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
              }).then(function (result) {
                if (result.value) {
                  window.location = "areaSocial";
                }
              });
            }
          },
        });
      }
    });
  });
});
