$(document).ready(function () {
  
  // Obtener la fecha de hoy en formato YYYY-MM-DD
  var today = new Date().toISOString().split('T')[0];
  
  // Establecer la fecha mínima en los campos de fecha para que no se puedan seleccionar fechas pasadas
  $('input[name="fechaInicio"], input[name="fechaFinal"]').attr('min', today);

  // Validaciones de fechas y horas
  $('input[name="fechaInicio"], input[name="horaInicio"], input[name="fechaFinal"], input[name="horaFinal"]').on("change", function () {

    var fechaInicio = $('input[name="fechaInicio"]').val();
    var horaInicio = $('input[name="horaInicio"]').val();
    var fechaFinal = $('input[name="fechaFinal"]').val();
    var horaFinal = $('input[name="horaFinal"]').val();

    if (fechaInicio && horaInicio && fechaFinal && horaFinal) {
      
      var fechaInicioObj = new Date(fechaInicio + ' ' + horaInicio);
      var fechaFinalObj = new Date(fechaFinal + ' ' + horaFinal);

      if (fechaFinalObj < fechaInicioObj) {
        swal({
          type: "warning",
          title: "Fecha/hora no válidas",
          text: "La fecha y hora de finalización no pueden ser anteriores a la fecha y hora de inicio.",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
        });
        $('#buscarAreasDisponibles').prop('disabled', true); // Deshabilitar botón
        return;
      }

      if (fechaInicio === fechaFinal && horaFinal <= horaInicio) {
        swal({
          type: "warning",
          title: "Hora no válida",
          text: "La hora de finalización debe ser mayor a la hora de inicio en el mismo día.",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
        });
        $('#buscarAreasDisponibles').prop('disabled', true); // Deshabilitar botón
        return;
      }

      // Si todo es válido, habilitar el botón
      $('#buscarAreasDisponibles').prop('disabled', false);
    }
  });

});
