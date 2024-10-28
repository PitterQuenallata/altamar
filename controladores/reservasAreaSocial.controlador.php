<?php

class ControladorReservasAreaSocial
{

   /*=============================================
  MOSTRAR RESERVAS
  =============================================*/
  public static function ctrMostrarReservas() {

    $tabla = "alquiler";
    $tablaDetalle = "detalle_alquiler";
    $respuesta = ModeloReservasAreaSocial::mdlMostrarReservas($tabla, $tablaDetalle);

    return $respuesta;
  }
  /*=============================================
    MOSTRAR ÁREAS DISPONIBLES
    =============================================*/
  static public function ctrMostrarAreasDisponibles($fechaInicio, $horaInicio, $fechaFinal, $horaFinal)
  {

    $tablaAlquiler = "alquiler";
    $tablaDetalleAlquiler = "detalle_alquiler";
    $tablaAreaSocial = "area_social";

    // Llamamos al modelo para obtener las áreas disponibles
    $respuesta = ModeloReservasAreaSocial::mdlMostrarAreasDisponibles($tablaAlquiler, $tablaDetalleAlquiler, $tablaAreaSocial, $fechaInicio, $horaInicio, $fechaFinal, $horaFinal);

    return $respuesta;
  }

  /*=============================================
    MOSTRAR AREAS OCUPADAS
    =============================================*/
  static public function ctrMostrarAreasOcupadas($fechaInicio, $fechaFinal, $horaInicio, $horaFinal)
  {

    $tablaAlquiler = "alquiler";
    $tablaDetalleAlquiler = "detalle_alquiler";
    $tablaAreaSocial = "area_social";

    $respuesta = ModeloReservasAreaSocial::mdlMostrarAreasOcupadas(
      $tablaAlquiler,
      $tablaDetalleAlquiler,
      $tablaAreaSocial,
      $fechaInicio,
      $fechaFinal,
      $horaInicio,
      $horaFinal
    );

    return $respuesta;
  }


/*=============================================
    GUARDAR RESERVA
=============================================*/
public function ctrGuardarReserva() {

  if (isset($_POST['listaAreasSeleccionadas']) && isset($_POST['fechaInicio']) && isset($_POST['horaInicio']) && isset($_POST['fechaFinal']) && isset($_POST['horaFinal']) && isset($_POST['idPropietarioReserva'])) {

      // Decodificar la lista de áreas seleccionadas desde el input hidden
      $areasSeleccionadas = json_decode($_POST['listaAreasSeleccionadas'], true);

      // Datos de la reserva
      $fechaInicio = $_POST['fechaInicio'];
      $horaInicio = $_POST['horaInicio'];
      $fechaFinal = $_POST['fechaFinal'];
      $horaFinal = $_POST['horaFinal'];
      $idPropietario = $_POST['idPropietarioReserva'];
      $idUsuario = $_SESSION['id'];
      $montoTotal = array_sum(array_column($areasSeleccionadas, 'precio'));

      // Verificar disponibilidad de cada área seleccionada
      foreach ($areasSeleccionadas as $area) {
          $areaOcupada = ModeloReservasAreaSocial::mdlVerificarAreaOcupada('alquiler', 'detalle_alquiler', $area['id'], $fechaInicio, $horaInicio, $fechaFinal, $horaFinal);
          if ($areaOcupada) {
              echo '<script>
                  swal({
                      type: "warning",
                      title: "¡Área social ocupada!",
                      text: "La ' . $area['descripcion'] . ' ya está ocupada en este horario.",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                  }).then((result) => {
                      if (result.value) {
                          window.location = "alquiler";
                      }
                    });
              </script>';
              return;  // Detener ejecución si se encuentra un área ocupada
          }
      }

      // Datos a enviar al modelo para guardar la reserva en la tabla `alquiler`
      $datosReserva = array(
          'fecha_inicio' => $fechaInicio,
          'hora_inicio' => $horaInicio,
          'fecha_final' => $fechaFinal,
          'hora_final' => $horaFinal,
          'monto_total' => $montoTotal,
          'id_propietario' => $idPropietario,
          'id_usuario' => $idUsuario
      );

      // Llamada al modelo para crear la reserva
      $idReserva = ModeloReservasAreaSocial::mdlCrearReserva('alquiler', $datosReserva);

      if ($idReserva) {
          // Guardar cada detalle de área seleccionada
          foreach ($areasSeleccionadas as $area) {
              $datosDetalle = array(
                  'id_alquiler' => $idReserva,
                  'id_area_social' => $area['id'],
                  'costo' => $area['precio']
              );
              ModeloReservasAreaSocial::mdlGuardarDetalleReserva('detalle_alquiler', $datosDetalle);
          }

          echo '<script>
              swal({
                  type: "success",
                  title: "¡La reserva ha sido guardada correctamente!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
              }).then((result) => {
                  if (result.value) {
                    window.open("extensiones/TCPDF-main/pdf/reserva.php?idReserva=' . $idReserva . '", "_blank");
                    window.location = "alquiler";
                  }
              });
          </script>';

      } else {
          echo '<script>
              swal({
                  type: "error",
                  title: "¡Error al guardar la reserva!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
              });
          </script>';
      }
  }
}

/*=============================================
    MOSTRAR RESERVA POR ID
    =============================================*/
    static public function ctrMostrarReservaPorId($idReserva) {
      $tabla = "alquiler";
      return ModeloReservasAreaSocial::mdlMostrarReservaPorId($tabla, $idReserva);
  }

  /*=============================================
  MOSTRAR DETALLE DE RESERVA POR ID
  =============================================*/
  static public function ctrMostrarDetalleReservaPorId($idReserva) {
      $tabla = "detalle_alquiler";
      return ModeloReservasAreaSocial::mdlMostrarDetalleReservaPorId($tabla, $idReserva);
  }

}
