<?php

class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

			   	$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuario";
				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

					if($respuesta["estado"] == 1){

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["apellido_paterno"] = $respuesta["apellido_paterno"];

						/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

						date_default_timezone_set('America/Bogota');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id";
						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						if($ultimoLogin == "ok"){

							echo '<script>

								window.location = "inicio";

							</script>';

						}				
						
					}else{

						echo '<br>
							<div class="alert alert-danger">El usuario aún no está activado</div>';

					}		

				}else{

					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

				}

			}	

		}

	}



    /*=============================================
    MOSTRAR USUARIOS
    =============================================*/

    static public function ctrMostrarUsuarios($item, $valor) {

			$tabla = "usuario";

			$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

			return $respuesta;

	}

/*=============================================
    CREAR USUARIO
    =============================================*/
		public function ctrCrearUsuario() {
			if (isset($_POST["nuevoNombre"])) {
	
					// Validar que los campos contienen solo letras y números
					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoNombre"]) &&
							preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoApellido"]) &&
							preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoApellidoMaterno"]) &&
							preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
							preg_match('/^[0-9]+$/', $_POST["nuevoTelefono"])) {
	
							// Validar no repetir usuario
							$item = "usuario";
							$valor = $_POST["nuevoUsuario"];
	
							$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
							print_r($respuesta);
							if ($respuesta) {
									echo '<script>
											swal({
													type: "error",
													title: "¡El usuario ya existe en la base de datos!",
													showConfirmButton: true,
													confirmButtonText: "Cerrar"
											}).then(function(result){
													if (result.value) {
															window.location = "usuarios";
													}
											});
									</script>';
									echo '<div class="alert alert-danger">El usuario ya existe en la base de datos</div>';
									return;
							}
	
							// Encriptar la contraseña
							$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
	
							$tabla = "usuario";
							$datos = array(
									"nombre" => $_POST["nuevoNombre"],
									"apellido_paterno" => $_POST["nuevoApellido"],
									"apellido_materno" => $_POST["nuevoApellidoMaterno"],
									"usuario" => $_POST["nuevoUsuario"],
									"password" => $encriptar,
									"rol" => $_POST["nuevoRol"],
									"telefono" => $_POST["nuevoTelefono"],
									"estado" => 1 // Por defecto, el estado es activo
							);
							print_r($datos);
							$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
	
							if ($respuesta == "ok") {
									echo '<script>
											swal({
													type: "success",
													title: "¡El usuario ha sido guardado correctamente!",
													showConfirmButton: true,
													confirmButtonText: "Cerrar"
											}).then(function(result){
													if (result.value) {
															window.location = "usuarios";
													}
											});
									</script>';
							}
					} else {
							echo '<script>
									swal({
											type: "error",
											title: "¡Los datos del usuario no pueden ir vacíos o llevar caracteres especiales!",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"
									}).then(function(result){
											if (result.value) {
													window.location = "usuarios";
											}
									});
							</script>';
							echo '<div class="alert alert-danger">Los datos del usuario no pueden ir vacíos o llevar caracteres especiales</div>';
							return;
					}
			}
	}
	

/*=============================================
    EDITAR USUARIO
    =============================================*/
    public function ctrEditarUsuario() {
			if (isset($_POST["editarNombre"])) {

					// Validar que los campos contienen solo letras y números
					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarNombre"]) &&
							preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarApellido"]) &&
							preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarUsuario"]) &&
							preg_match('/^[0-9]+$/', $_POST["editarTelefono"])) {

							// Verificar si la contraseña cambia
							if ($_POST["editarPassword"] != "") {
									$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
							} else {
									$encriptar = $_POST["passwordActual"];
							}

							$tabla = "usuario";
							$datos = array(
									"id" => $_POST["idUsuario"],
									"nombre" => $_POST["editarNombre"],
									"apellido" => $_POST["editarApellido"],
									"usuario" => $_POST["editarUsuario"],
									"password" => $encriptar,
									"rol" => $_POST["editarRol"],
									"telefono" => $_POST["editarTelefono"],
									"estado" => $_POST["editarEstado"]
							);

							$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

							if ($respuesta == "ok") {
									echo '<script>
											swal({
													type: "success",
													title: "¡El usuario ha sido editado correctamente!",
													showConfirmButton: true,
													confirmButtonText: "Cerrar"
											}).then(function(result){
													if (result.value) {
															window.location = "usuarios";
													}
											});
									</script>';
							}
					} else {
							echo '<script>
									swal({
											type: "error",
											title: "¡Los datos del usuario no pueden ir vacíos o llevar caracteres especiales!",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"
									}).then(function(result){
											if (result.value) {
													window.location = "usuarios";
											}
									});
							</script>';
							echo '<div class="alert alert-danger">Los datos del usuario no pueden ir vacíos o llevar caracteres especiales</div>';
							return;
					}
			}
	}


	/*=============================================
	BORRAR USUARIO
	=============================================*/

	public function ctrBorrarUsuario() {
    if (isset($_GET["idUsuario"])) {
        $tabla = "usuario";
        $datos = $_GET["idUsuario"];

        $respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla, $datos);

        if ($respuesta == "ok") {
            echo '<script>
                swal({
                    type: "success",
                    title: "¡El usuario ha sido eliminado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
                        window.location = "usuarios";
                    }
                });
            </script>';
        }
    }
}



}
	


