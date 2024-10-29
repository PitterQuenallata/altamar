$(document).ready(function () {
// Aplicar rango de fechas y mostrar en la interfaz
$('#aplicarRango').on('click', function() {
  const fechaInicio = $('#fechaInicio').val();
  const fechaFinal = $('#fechaFinal').val();

  // Validación de fechas
  if (fechaInicio && fechaFinal) {
    // Validar que la fecha final no sea anterior a la fecha de inicio
    if (new Date(fechaFinal) < new Date(fechaInicio)) {
      alert('La fecha final no puede ser anterior a la fecha de inicio.');
      return;
    }
    
    // Actualizar el texto del rango de fechas en el reporte 4
    $('#rangoFechaReporte4').html(`${fechaInicio} a ${fechaFinal}`);
    // Actualizar el texto del rango de fechas en el reporte 7
    $('#rangoFechaReporte7').html(`${fechaInicio} a ${fechaFinal}`);
    
    // Mostrar el rango de fechas seleccionado en la sección superior
    $('#rangoSeleccionado span').text(fechaInicio + ' a ' + fechaFinal);
  } else {
    alert('Por favor, seleccione un rango de fechas completo.');
  }
});

  //1
  $(document).on("click", ".btnR1", function () {

    window.open("extensiones/TCPDF-main/pdf/r1.php?_blank");
  });
  //2
  $(document).on("click", ".btnR2", function () {
    window.open("extensiones/TCPDF-main/pdf/r2.php?_blank");
  });

  // Reporte 3: Resumen de pagos de mensualidades por propietario
  $(document).on("click", ".btnR3", function () {
    var selectedOption = $("select[name='idPropietario'] option:selected");
    var idPropietario = selectedOption.val();
    var fechaRegistro = selectedOption.data("fecha");

    if (idPropietario) {
      window.open(
        "extensiones/TCPDF-main/pdf/r3.php?id_propietario=" +
          idPropietario +
          "&fecha_registro=" +
          fechaRegistro,
        "_blank"
      );
    } else {
      alert("Por favor, selecciona un propietario.");
    }
  });

  // Reporte 4: 
    // Reporte 4: Generar PDF de lista de alquileres con detalles
    $(document).on("click", ".btnR4", function () {
      const fechaInicio = $('#fechaInicio').val();
      const fechaFinal = $('#fechaFinal').val();
  
      if (fechaInicio && fechaFinal) {
        if (new Date(fechaFinal) >= new Date(fechaInicio)) {
          window.open(
            "extensiones/TCPDF-main/pdf/r4.php?fecha_inicio=" + fechaInicio + "&fecha_final=" + fechaFinal,
            "_blank"
          );
        } else {
          alert('La fecha final no puede ser anterior a la fecha de inicio.');
        }
      } else {
        alert("Por favor, seleccione un rango de fechas completo.");
      }
    });

    // Reporte 5: Generar PDF de alquileres por propietario
  $(document).on("click", ".btnR5", function () {
    const idPropietario = $("select[name='idPropietarioR5']").val();

    if (idPropietario) {
      // Abrir el reporte en una nueva pestaña, pasando el ID del propietario
      window.open("extensiones/TCPDF-main/pdf/r5.php?id_propietario=" + idPropietario, "_blank");
    } else {
      alert("Por favor, selecciona un propietario.");
    }
  });

    //6 
    $(document).on("click", ".btnR6", function () {
      window.open("extensiones/TCPDF-main/pdf/r6.php?_blank");
    });

    //7

// Reporte 7: Generar PDF de total de ingresos en un rango de fechas
  $(document).on("click", ".btnR7", function () {
    const fechaInicio = $('#fechaInicio').val();
    const fechaFinal = $('#fechaFinal').val();

    // Validación de fechas
    if (fechaInicio && fechaFinal) {
      if (new Date(fechaFinal) >= new Date(fechaInicio)) {
        // Abrir el reporte en una nueva pestaña, pasando el rango de fechas
        window.open("extensiones/TCPDF-main/pdf/r7.php?fecha_inicio=" + fechaInicio + "&fecha_final=" + fechaFinal, "_blank");
      } else {
        alert('La fecha final no puede ser anterior a la fecha de inicio.');
      }
    } else {
      alert("Por favor, seleccione un rango de fechas completo.");
    }
  });

      //8
      $(document).on("click", ".btnR8", function () {
        window.open("extensiones/TCPDF-main/pdf/r8.php?_blank");
      });

      
      //9
      $(document).on("click", ".btnR9", function () {
        window.open("extensiones/TCPDF-main/pdf/r9.php?_blank");
      });

      
      //10
      $(document).on("click", ".btnR10", function () {
        window.open("extensiones/TCPDF-main/pdf/r10.php?_blank");
      });
});
