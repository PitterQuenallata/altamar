// vistas/js/pago_mensualidades.js

$(document).ready(function() {
  // Destruir cualquier instancia previa de DataTable
  if ($.fn.DataTable.isDataTable('#pagosMensuales')) {
    $('#pagosMensuales').DataTable().destroy();
  }

  // Inicializar DataTable con configuración en español
  $('#pagosMensuales').DataTable({
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

  // Imprimir Pago
  $(".btnImprimirPago").on("click", function() {
    var idPago = $(this).attr("idPago");

    // Redirigir a la página de impresión (aquí se asume que tienes una página o método para generar la impresión)
    window.open("extensiones/TCPDF-main/pdf/recibo.php?codigo=" + idPago, "_blank");
  });
});
