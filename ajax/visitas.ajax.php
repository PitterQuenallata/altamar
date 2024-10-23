<?php

require_once "../controladores/visitas.controlador.php";
require_once "../modelos/visitas.modelo.php";
require_once "../controladores/entrada.controlador.php";
require_once "../modelos/entrada.modelo.php";
require_once "../controladores/propietarios.controlador.php";
require_once "../modelos/propietarios.modelo.php";


if (isset($_POST["idVisita"])) {
  $item = "id";
  $valor = $_POST["idVisita"];

  // Obtener datos de la visita
  $visita = ControladorVisitas::ctrMostrarVisitas($item, $valor);
  // Obtener datos de la entrada
  $entrada = ControladorEntrada::ctrMostrarEntrada($item, $valor);

  $respuesta = array(
    "visita" => $visita,
    "entrada" => $entrada[0] // Asumiendo que solo hay una entrada por visita
  );

  echo json_encode($respuesta);
}

if (isset($_POST["idSalida"])) {
  $tabla = "controlentrada";
  $idSalida = $_POST["idSalida"];
  $horaSalida = date("Y-m-d H:i:s"); // Obtener la hora actual

  $respuesta = ControladorEntrada::ctrMarcarSalida($tabla, $idSalida, $horaSalida);

  echo $respuesta;
}

?>
