<?php

require_once "../controladores/pacientes.controlador.php";
require_once "../modelos/pacientes.modelo.php";

class AjaxPacientes{

	/*=============================================
	EDITAR PACIENTE
	=============================================*/	

	public $idPaciente;

	public function ajaxEditarPaciente(){

		$item = "id";
		$valor = $this->idPaciente;

		$respuesta = ControladorPacientes::ctrMostrarPacientes($item, $valor);

		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR PACIENTE
=============================================*/	

if(isset($_POST["idPaciente"])){

	$paciente = new AjaxPacientes();
	$paciente -> idPaciente = $_POST["idPaciente"];
	$paciente -> ajaxEditarPaciente();
}
