<?php
// controladores/pago_mensualidades.controlador.php

class ControladorPagoMensualidades {

  /*=============================================
  CREAR PAGO MENSUALIDAD
  =============================================*/
  public function ctrCrearPagoMensualidad() {
      if (isset($_POST["nuevoMonto"])) {

          // Validar entradas
          if (preg_match('/^[0-9.]+$/', $_POST["nuevoMonto"]) &&
              preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $_POST["nuevaFecha"]) &&
              preg_match('/^[0-9]+$/', $_POST["idPropietario"]) &&
              preg_match('/^[0-9]+$/', $_POST["idUsuarioRegistro"])) {

              $tabla = "pago_mensualidad";

              $datos = array(
                  "monto" => $_POST["nuevoMonto"],
                  "fecha" => $_POST["nuevaFecha"],
                  "estado" => 1, // Estado predeterminado: Pagado
                  "id_propietario" => $_POST["idPropietario"],
                  "id_usuario" => $_POST["idUsuarioRegistro"]
              );

              $respuesta = ModeloPagoMensualidades::mdlIngresarPagoMensualidad($tabla, $datos);

              if ($respuesta == "ok") {
                  echo '<script>
                      swal({
                          type: "success",
                          title: "¡El pago de mensualidad ha sido guardado correctamente!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                      }).then(function(result){
                          if (result.value) {
                              window.location = "pagosmensual";
                          }
                      });
                  </script>';
              } else {
                  echo '<script>
                      swal({
                          type: "error",
                          title: "¡Error al guardar el pago de mensualidad!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                      }).then(function(result){
                          if (result.value) {
                              window.location = "pagosmensual";
                          }
                      });
                  </script>';
              }
          } else {
              echo '<script>
                  swal({
                      type: "error",
                      title: "¡Los datos ingresados no son válidos!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                  }).then(function(result){
                      if (result.value) {
                          window.location = "pagosmensual";
                      }
                  });
              </script>';
          }
      }
  }

  /*=============================================
  MOSTRAR PAGOS MENSUALIDADES
  =============================================*/
  static public function ctrMostrarPagosMensualidades($item, $valor) {
      $tabla = "pago_mensualidad";
      $respuesta = ModeloPagoMensualidades::mdlMostrarPagosMensualidades($tabla, $item, $valor);
      return $respuesta;
  }

      /*=============================================
    MOSTRAR PAGOS MENSUALIDADES PARA IMPRIMIR
    =============================================*/
    static public function ctrMostrarPagosMensualidadesImprimir($item, $valor) {
      $respuesta = ModeloPagoMensualidades::mdlMostrarPagosMensualidadesImprimir($item, $valor);
      return $respuesta;
  }
}
?>
