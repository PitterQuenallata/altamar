<?php
class ControladorAlquiler
{
  public static function ctrMostrarAreasDisponibles($fechaInicio, $fechaFinal) {
    $tabla = "area_social";
    $respuesta = ModeloAlquiler::mdlMostrarAreasDisponibles($tabla, $fechaInicio, $fechaFinal);
    return $respuesta;
}

  /*=============================================
    MOSTRAR ÁREAS SOCIALES
    =============================================*/
  public static function ctrMostrarAreasSociales()
  {
    return ModeloAlquiler::mdlMostrarAreasSociales();
  }
/*=============================================
    Crear alquiler de ÁREAS SOCIALES
    =============================================*/
    public function ctrCrearAlquiler() {
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (isset($_POST['listaAreas']) && isset($_POST['total'])) {
              $idUsuario = $_POST['idUsuario'];
              $idPropietario = $_POST['agregarPropietario'];
              $fechaInicio = $_POST['fechaInicio'];
              $fechaFinal = $_POST['fechaFinal'];
              $total = $_POST['total'];
              $listaAreas = json_decode($_POST['listaAreas'], true);

              $tabla = "alquiler";

              $datos = array(
                  "id_usuario" => $idUsuario,
                  "id_propietario" => $idPropietario,
                  "fecha_inicio" => $fechaInicio,
                  "fecha_final" => $fechaFinal,
                  "total" => $total
              );

              $idAlquiler = ModeloAlquiler::mdlCrearAlquiler($tabla, $datos);

              if ($idAlquiler != "error") {
                  foreach ($listaAreas as $key => $value) {
                      if (isset($value['id']) && isset($value['precio'])) {
                          $tablaDetalle = "detalle_alquiler";

                          $datosDetalle = array(
                              "id_alquiler" => $idAlquiler,
                              "id_area" => $value['id'],
                              "precio" => $value['precio']
                          );

                          var_dump($datosDetalle); // Depuración
                          $respuestaDetalle = ModeloAlquiler::mdlCrearDetalleAlquiler($tablaDetalle, $datosDetalle);

                          if ($respuestaDetalle == "error") {
                              echo '<script>
                                  swal({
                                      type: "error",
                                      title: "¡Error al guardar los detalles del alquiler!",
                                      showConfirmButton: true,
                                      confirmButtonText: "Cerrar",
                                      closeOnConfirm: false
                                  }).then((result) => {
                                      if (result.value) {
                                          window.location = "alquiler";
                                      }
                                  });
                              </script>';
                              return;
                          }
                      } else {
                          echo '<script>
                              swal({
                                  type: "error",
                                  title: "¡Datos incompletos en la lista de áreas!",
                                  showConfirmButton: true,
                                  confirmButtonText: "Cerrar",
                                  closeOnConfirm: false
                              }).then((result) => {
                                  if (result.value) {
                                      window.location = "alquiler";
                                  }
                              });
                          </script>';
                          return;
                      }
                  }

                  echo '<script>
                      swal({
                          type: "success",
                          title: "¡El alquiler ha sido guardado correctamente!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar",
                          closeOnConfirm: false
                      }).then((result) => {
                          if (result.value) {
                              window.location = "alquiler";
                          }
                      });
                  </script>';
              } else {
                  echo '<script>
                      swal({
                          type: "error",
                          title: "¡Error al guardar el alquiler!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar",
                          closeOnConfirm: false
                      }).then((result) => {
                          if (result.value) {
                              window.location = "alquiler";
                          }
                      });
                  </script>';
              }
          }
      }
  }
}
