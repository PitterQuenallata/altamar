// vistas/js/pago_mensualidades.js

$(document).ready(function () {
  // Destruir cualquier instancia previa de DataTable
  if ($.fn.DataTable.isDataTable("#pagosMensuales")) {
    $("#pagosMensuales").DataTable().destroy();
  }

  // Inicializar DataTable con configuración en español
  $("#pagosMensuales").DataTable({
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

  // // Imprimir Pago
  // $(".btnImprimirPago").on("click", function() {
  //   var idPago = $(this).attr("idPago");

  //   // Redirigir a la página de impresión (aquí se asume que tienes una página o método para generar la impresión)
  //   window.open("extensiones/TCPDF-main/pdf/recibo.php?codigo=" + idPago, "_blank");
  // });
  // Array con los nombres de los meses
  var meses = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
  ];

  // Evento para mostrar el ID del propietario seleccionado
  $('select[name="idPropietario"]').on("change", function () {
    var idPropietario = $(this).val(); // Obtener el ID del propietario seleccionado
    var fechaPCreado = $(this).find(":selected").data("fecha"); // Obtener la fecha de creación del propietario

    console.log("ID del propietario seleccionado: " + idPropietario); // Mostrar el ID en la consola
    console.log("Fecha de creación del propietario: " + fechaPCreado); // Mostrar la fecha en la consola

    // Enviar los datos al AJAX para obtener las mensualidades pendientes
    $.ajax({
      url: "ajax/pago_mensualidad.ajax.php",
      method: "POST",
      data: { idPropietario: idPropietario, fechaPCreado: fechaPCreado },
      dataType: "json",
      success: function (respuesta) {
        // Limpiar el select de mensualidades
        $("#mensualidadesPendientes").html(
          '<option value="">Seleccione periodo mensual a pagar</option>'
        );

        // Llenar con los datos obtenidos
        $.each(respuesta, function (index, mensualidad) {
          var mesNombre = meses[mensualidad.mes - 1]; // Convertir número de mes a nombre
          var fechaPeriodo =
            mensualidad.gestion + "-" + ("0" + mensualidad.mes).slice(-2); // Formato: 2024-04

          // Añadir opción al select
          $("#mensualidadesPendientes").append(
            '<option value="' +
              mensualidad.id +
              '" data-costo="' +
              mensualidad.costo +
              '" data-fecha-periodo="' +
              fechaPeriodo +
              '">' +
              mesNombre +
              " - " +
              mensualidad.gestion +
              "</option>"
          );
        });
      },
    });
  });

  // Evento para seleccionar el periodo de mensualidad
  $('select[name="idMensualidad"]').on("change", function () {
    var selectedOption = $(this).find("option:selected");

    // Obtener los datos de la opción seleccionada
    var costo = selectedOption.data("costo"); // Costo de la mensualidad
    var fechaPeriodo = selectedOption.data("fecha-periodo"); // Fecha del periodo

    // Llenar el campo con el monto del periodo seleccionado
    $('input[name="montoPeriodo"]').val(costo); // Mostrar el costo en el input correspondiente
    $('input[name="fechaPeriodo"]').val(fechaPeriodo); // Rellenar el input hidden con la fecha del periodo

    // Mostrar en consola para ver los valores
    console.log("Fecha del periodo seleccionado:", fechaPeriodo);
    console.log("Costo del periodo seleccionado:", costo);
  });

  // Evento para calcular el cambio
  $('input[name="montoRecibido"]').on("input", function () {
    var montoRecibido = parseFloat($(this).val()); // Obtener el monto recibido
    var montoPeriodo = parseFloat($('input[name="montoPeriodo"]').val()); // Obtener el costo del periodo

    if (montoRecibido >= montoPeriodo) {
      var cambio = montoRecibido - montoPeriodo; // Calcular el cambio
      $('input[name="montoCambio"]').val(cambio.toFixed(2)); // Mostrar el cambio
    } else {
      $('input[name="montoCambio"]').val(0); // Si el monto recibido es menor, no hay cambio
    }
  });


  $(document).on("click", ".btnImprimirPago", function() {
    var idPago = $(this).attr("idPago");
    window.open("extensiones/TCPDF-main/pdf/comprobante.php?idPago=" + idPago, "_blank");
});


});
