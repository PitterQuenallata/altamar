<?php

require_once "../controladores/areas_sociales.controlador.php";
require_once "../modelos/areas_sociales.modelo.php";

if (isset($_POST["idAreaSocial"]) && isset($_POST["estadoAreaSocial"])) {
    $cambiarEstado = new AjaxAreasSociales();
    $cambiarEstado -> idAreaSocial = $_POST["idAreaSocial"];
    $cambiarEstado -> estadoAreaSocial = $_POST["estadoAreaSocial"];
    $cambiarEstado -> ajaxCambiarEstadoAreaSocial();
}

class AjaxAreasSociales {

    public $idAreaSocial;
    public $estadoAreaSocial;

    public function ajaxCambiarEstadoAreaSocial() {
        $respuesta = ControladorAreasSociales::ctrCambiarEstadoAreaSocial($this->idAreaSocial, $this->estadoAreaSocial);
        if ($respuesta == "ok") {
            echo "ok";
        }
    }
}

if (isset($_POST["idAreaSocial"])) {
    $item = "id";
    $valor = $_POST["idAreaSocial"];

    $respuesta = ControladorAreasSociales::ctrMostrarAreasSociales($item, $valor);

    echo json_encode($respuesta);
}

if (isset($_POST["idAreaSocialEliminar"])) {
  $tabla = "area_social";
  $datos = $_POST["idAreaSocialEliminar"];
  
  $respuesta = ModeloAreasSociales::mdlEliminarAreaSocial($tabla, $datos);

  echo $respuesta;
}

?>
