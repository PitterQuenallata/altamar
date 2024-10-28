$(document).ready(function () {

  // Inicializar DataTable
  var tablaAreasDisponibles = $('#tablaAreasDisponibles').DataTable({
      "deferRender": true,
      "retrieve": true,
      "processing": true,
      "language": {
          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar:",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
          }
      }
  });

  // Lista para almacenar las áreas seleccionadas
  let areasSeleccionadas = [];

  // Función para actualizar el input hidden
  function actualizarInputHidden() {
      $('#listaAreasSeleccionadas').val(JSON.stringify(areasSeleccionadas));
  }

  // Evento para añadir área al hacer clic en el botón "Añadir"
  $(document).on("click", ".btnAgregarArea", function () {
      const id = $(this).data("id");
      const descripcion = $(this).closest("tr").find("td:eq(1)").text();
      const precio = $(this).closest("tr").find("td:eq(2)").text();

      const area = {
          id: id,
          descripcion: descripcion,
          precio: precio
      };

      // Agregar área a la lista de seleccionadas
      areasSeleccionadas.push(area);

      // Actualizar input hidden
      actualizarInputHidden();

      // Mostrar área en el formulario
      $(".listaAreasSeleccionadas").append(
          '<div class="area-item" data-id="' + id + '">' +
          '<span>' + descripcion + ' - BOB ' + precio + '</span> ' +
          '<button type="button" class="btn btn-danger btnQuitarArea" data-id="' + id + '">Quitar</button>' +
          '</div>'
      );

      // Actualizar el total después de añadir
      actualizarTotal();
  });

  // Evento para quitar área del formulario
  $(document).on("click", ".btnQuitarArea", function () {
      const id = $(this).data("id");

      // Eliminar área de la lista seleccionada
      areasSeleccionadas = areasSeleccionadas.filter(area => area.id !== id);

      // Actualizar input hidden
      actualizarInputHidden();

      // Eliminar área del DOM
      $(this).closest(".area-item").remove();

      // Actualizar el total después de quitar
      actualizarTotal();
  });

  // Función para actualizar el total
  function actualizarTotal() {
      var total = areasSeleccionadas.reduce((sum, area) => sum + parseFloat(area.precio), 0);
      $('#total').val(total.toFixed(2));
  }

  // Evento de click en el botón de buscar áreas disponibles
  $('#buscarAreasDisponibles').on("click", function () {

      // Capturar valores seleccionados
      var fechaInicio = $('input[name="fechaInicio"]').val();
      var horaInicio = $('input[name="horaInicio"]').val();
      var fechaFinal = $('input[name="fechaFinal"]').val();
      var horaFinal = $('input[name="horaFinal"]').val();

      // Verificar si todos los campos necesarios están seleccionados
      if (fechaInicio && horaInicio && fechaFinal && horaFinal) {

          // Enviar datos mediante AJAX a reservasAreaSocial.ajax.php
          $.ajax({
              url: "ajax/reservasAreaSocial.ajax.php",
              method: "POST",
              data: {
                  fechaInicio: fechaInicio,
                  horaInicio: horaInicio,
                  fechaFinal: fechaFinal,
                  horaFinal: horaFinal
              },
              dataType: "json",
              success: function (respuesta) {
                  console.log(respuesta);

                  // Limpiar las tablas de áreas disponibles y ocupadas
                  tablaAreasDisponibles.clear().draw();
                  $("#listaAreasOcupadas").empty();

                  // Agregar áreas disponibles
                  respuesta.disponibles.forEach(function (area, index) {
                      tablaAreasDisponibles.row.add([
                          index + 1, // contador dinámico
                          area.descripcion,
                          area.precio,
                          '<button class="btn btn-primary btnAgregarArea" data-id="' + area.id + '">Añadir</button>'
                      ]).draw(false);
                  });

                  // Agregar áreas ocupadas en una lista
                  if (respuesta.ocupadas.length > 0) {
                      respuesta.ocupadas.forEach(function (area) {
                          $("#listaAreasOcupadas").append(
                              '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                              '<span><strong>' + area.descripcion + '</strong> (' + area.hora_inicio + ' - ' + area.hora_final + ')</span>' +
                              '<span class="badge badge-danger">Ocupado</span>' +
                              '</li>'
                          );
                      });
                  } else {
                      $("#listaAreasOcupadas").append(
                          '<li class="list-group-item">No hay áreas ocupadas para esta fecha</li>'
                      );
                  }
              },
              error: function () {
                  swal({
                      type: "error",
                      title: "Error",
                      text: "Ocurrió un problema al buscar las áreas.",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                  });
              }
          });
      } else {
          // Alerta si algún campo está vacío
          swal({
              type: "warning",
              title: "Faltan campos",
              text: "Por favor, complete todas las fechas y horas antes de buscar.",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
          });
      }
  });

});
