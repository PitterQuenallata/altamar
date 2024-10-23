<?php

class ControladorEntrada {

  // Mostrar entradas
  public static function ctrMostrarEntrada($item, $valor) {
    $tabla = "controlentrada";
    $respuesta = ModeloEntrada::mdlMostrarEntrada($tabla, $item, $valor);
    return $respuesta;
  }

    // Marcar salida
    public static function ctrMarcarSalida($tabla, $idSalida, $horaSalida) {
      $datos = array(
        "id" => $idSalida,
        "hora_salida" => $horaSalida
      );
  
      $respuesta = ModeloEntrada::mdlMarcarSalida($tabla, $datos);
      return $respuesta;
    }
}
?>
