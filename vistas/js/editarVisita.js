$(document).on("click", ".btnEditarVisita", function() {
  var idVisita = $(this).attr("idVisita");

  var datos = new FormData();
  datos.append("idVisita", idVisita);

  $.ajax({
    url: "ajax/visitas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      // Datos de la tabla visita
      $("#editarIdVisita").val(respuesta.visita.id);
      $("#editarNombre").val(respuesta.visita.nombre);
      $("#editarApellido").val(respuesta.visita.apellido);
      $("#editarCarnet").val(respuesta.visita.carnet);

      // Datos de la tabla controlentrada
      $("#editarEntrada").val(respuesta.entrada.hora_entrada.replace(" ", "T"));
      $("#editarCantidad").val(respuesta.entrada.personas);
      $("#editarPropietario").val(respuesta.entrada.id_propietario);
    }
  });
});
