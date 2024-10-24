<?php

require_once "controladores/plantilla.controlador.php";

require_once "controladores/usuarios.controlador.php";
require_once "controladores/propietarios.controlador.php";
require_once "controladores/mensualidades.controlador.php";
require_once "controladores/areas_sociales.controlador.php";

require_once "controladores/entrada.controlador.php";
require_once "controladores/pago_mensualidades.controlador.php";
require_once "controladores/alquiler.controlador.php";

require_once "modelos/plantilla.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/propietarios.modelo.php";
require_once "modelos/mensualidades.modelo.php";
require_once "modelos/areas_sociales.modelo.php";

require_once "modelos/entrada.modelo.php";
require_once "modelos/pago_mensualidades.modelo.php";
require_once "modelos/alquiler.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();