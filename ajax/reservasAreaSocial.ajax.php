<?php
require_once "../controladores/reservasAreaSocial.controlador.php";
require_once "../modelos/reservasAreaSocial.modelo.php";

// Procesar las fechas y horas enviadas desde el front-end
if (isset($_POST['fechaInicio'], $_POST['fechaFinal'], $_POST['horaInicio'], $_POST['horaFinal'])) {
  $fechaInicio = $_POST['fechaInicio'];
  $fechaFinal = $_POST['fechaFinal'];
  $horaInicio = $_POST['horaInicio'];
  $horaFinal = $_POST['horaFinal'];
  
  // Obtener las áreas disponibles
  $areasDisponibles = ControladorReservasAreaSocial::ctrMostrarAreasDisponibles($fechaInicio, $fechaFinal, $horaInicio, $horaFinal);
  
  // Obtener las áreas ocupadas
  $areasOcupadas = ControladorReservasAreaSocial::ctrMostrarAreasOcupadas($fechaInicio, $fechaFinal, $horaInicio, $horaFinal);
  
  // Enviar ambas respuestas en formato JSON
  echo json_encode([
      'disponibles' => $areasDisponibles,
      'ocupadas' => $areasOcupadas
  ]);
}else {
    echo json_encode([]);
}
