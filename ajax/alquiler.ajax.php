<?php
require_once "../controladores/alquiler.controlador.php";
require_once "../modelos/alquiler.modelo.php";



class AjaxAlquiler
{

  public function ajaxMostrarAreasSociales()
  {

    // Capturar rutas de la URL limpiando las queries
    $routesArray = explode("/", $_SERVER["REQUEST_URI"]);
    array_shift($routesArray);
    foreach ($routesArray as $key => $value) {
      $routesArray[$key] = explode("?", $value)[0];
    }

    // $fechaInicio = isset($_GET['fechaInicio']) ? $_GET['fechaInicio'] : null;
    // $fechaFinal = isset($_GET['fechaFinal']) ? $_GET['fechaFinal'] : null;

    // public static function mdlMostrarAreasSociales() {
    

    // $respuesta = ControladorAlquiler::ctrMostrarAreasDisponibles($fechaInicio, $fechaFinal);
    
    $respuesta = ModeloAlquiler::mdlMostrarAreasSociales();

    $data = array();

    foreach ($respuesta as $key => $area) {
      $estado = $area["estado"] == 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>';
      $acciones = '<button class="btn btn-primary btnAgregar" data-id="' . $area["id"] . '">Agregar</button>';
      $data[] = array(
        "numero" => $key + 1,
        "id" => $area["id"],
        "descripcion" => $area["descripcion"],
        "precio" => $area["precio"],
        "estado" => $estado,
        "acciones" => $acciones
      );
    }

    echo json_encode(array("data" => $data));
  }
}

// Crear una instancia de la clase y llamar al método para procesar la solicitud AJAX
$ajax = new AjaxAlquiler();
$ajax->ajaxMostrarAreasSociales();
