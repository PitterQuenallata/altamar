<?php
require_once "../controladores/mensualidades.controlador.php";
require_once "../modelos/mensualidades.modelo.php";

class AjaxMensualidades {

    /*=============================================
    EDITAR MENSUALIDAD
    =============================================*/
    public $idMensualidad;

    public function ajaxEditarMensualidad() {
        $item = "id";
        $valor = $this->idMensualidad;

        $respuesta = ControladorMensualidades::ctrMostrarMensualidades($item, $valor);

        echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR MENSUALIDAD
=============================================*/
if (isset($_POST["idMensualidad"])) {
    $editar = new AjaxMensualidades();
    $editar->idMensualidad = $_POST["idMensualidad"];
    $editar->ajaxEditarMensualidad();
}
?>
