<?php
require_once "../controladores/pago_mensualidades.controlador.php";
require_once "../modelos/pago_mensualidades.modelo.php";

class AjaxPagoMensualidades {

    public $idPropietario;
    public $fechaPCreado;

    public function ajaxMostrarMensualidadesPendientes() {
        $idPropietario = $this->idPropietario;
        $fechaPCreado = $this->fechaPCreado;

        // Llamar al controlador para obtener las mensualidades pendientes
        $mensualidades = ControladorPagoMensualidades::ctrMostrarMensualidadesPendientes($idPropietario, $fechaPCreado);
        
        // Devolver los datos en formato JSON
        echo json_encode($mensualidades);
    }
}

/*=============================================
MOSTRAR MENSUALIDADES PENDIENTES
=============================================*/
if (isset($_POST["idPropietario"]) && isset($_POST["fechaPCreado"])) {
    $mostrarMensualidades = new AjaxPagoMensualidades();
    $mostrarMensualidades->idPropietario = $_POST["idPropietario"];
    $mostrarMensualidades->fechaPCreado = $_POST["fechaPCreado"];
    $mostrarMensualidades->ajaxMostrarMensualidadesPendientes();
}
