<?php

require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";


class AjaxServicios
{
    /*=============================================
    EDITAR SERVICIO
    =============================================*/

    public $idServicio;

    public function ajaxEditarServicio()
    {

        $item = "id";
        $valor = $this->idServicio;

        $respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);

        echo json_encode($respuesta);
    }
        /*=============================================
        ACTIVAR SERVICIO
        =============================================*/

    public $activarServicio;
    public $activarId;

    public function ajaxActivarServicio()
    {

        $tabla = "servicio";

        $item1 = "estado";
        $valor1 = $this->activarServicio;

        $item2 = "idServicio";
        $valor2 = $this->activarId;

        $respuesta = ModeloServicios::mdlActualizarServicio($tabla, $item1, $valor1, $item2, $valor2);
    }
}
/*=============================================
EDITAR SERVICIOS
=============================================*/
if (isset($_POST["idServicio"])) {

    $editarServicio = new AjaxServicios();
    $editarServicio->idServicio = $_POST["idServicio"];
    $editarServicio->ajaxEditarServicio();
}
/*=============================================
ACTIVAR SERVICIO
=============================================*/

if (isset($_POST["activarServicio"])) {

    $activarServicio = new AjaxServicios();
    $activarServicio->activarServicio = $_POST["activarServicio"];
    $activarServicio->activarId = $_POST["activarId"];
    $activarServicio->ajaxActivarServicio();
}
