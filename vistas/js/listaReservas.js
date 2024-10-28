$(document).ready(function () {

  // Inicializar DataTable
  var tablaReservas = $('#tablaReservas').DataTable({
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

  // Evento de click en el botón "Imprimir"
  $(document).on("click", ".btnImprimirReserva", function () {
    var idReserva = $(this).data("id");  // Obtener el idReserva del atributo data-id del botón
    if (idReserva) {
      window.open("extensiones/TCPDF-main/pdf/reserva.php?idReserva=" + idReserva, "_blank");
    } else {
      swal({
        type: "error",
        title: "Error",
        text: "No se pudo generar el comprobante de reserva.",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
      }).then((result) => {
        if (result.value) {
          window.location = "listaReservas";
        }
      });
    }
  });

});
