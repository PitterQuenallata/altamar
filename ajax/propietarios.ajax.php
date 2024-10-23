<?php
require_once "../controladores/propietarios.controlador.php";
require_once "../modelos/propietarios.modelo.php";

class AjaxPropietarios {

    /*=============================================
    EDITAR PROPIETARIO
    =============================================*/
    public $idPropietario;

    public function ajaxEditarPropietario() {
        $item = "id";
        $valor = $this->idPropietario;

        $respuesta = ControladorPropietarios::ctrMostrarPropietarios($item, $valor);

        echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR PROPIETARIO
=============================================*/
if (isset($_POST["idPropietario"])) {
    $editar = new AjaxPropietarios();
    $editar->idPropietario = $_POST["idPropietario"];
    $editar->ajaxEditarPropietario();
}
?>
