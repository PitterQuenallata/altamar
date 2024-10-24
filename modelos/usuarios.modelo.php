<?php

require_once "conexion.php";

class ModeloUsuarios{

/*=============================================
    MOSTRAR USUARIOS
    =============================================*/

    static public function mdlMostrarUsuarios($tabla, $item, $valor) {

			if ($item != null) {

					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
					$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
					$stmt->execute();

					return $stmt->fetch();

			} else {

					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
					$stmt->execute();

					return $stmt->fetchAll();

			}

			$stmt = null;

	}
   /*=============================================
    INGRESAR USUARIO
    =============================================*/
    static public function mdlIngresarUsuario($tabla, $datos) {
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, apellido_paterno, apellido_materno, usuario, password, rol, telefono, correo, estado) VALUES (:nombre, :apellido_paterno, :apellido_materno, :usuario, :password, :rol, :telefono, :correo, :estado)");

			$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":apellido_paterno", $datos["apellido_paterno"], PDO::PARAM_STR);
			$stmt->bindParam(":apellido_materno", $datos["apellido_materno"], PDO::PARAM_STR);
			$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
			$stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
			$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
			$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

			if ($stmt->execute()) {
					return "ok";
			} else {
					return "error";
			}

			$stmt = null;
	}

/*=============================================
EDITAR USUARIO
=============================================*/
static public function mdlEditarUsuario($tabla, $datos) {
	$stmt = Conexion::conectar()->prepare("UPDATE $tabla 
			SET nombre = :nombre, 
					apellido_paterno = :apellido_paterno, 
					apellido_materno = :apellido_materno, 
					usuario = :usuario, 
					password = :password, 
					rol = :rol, 
					telefono = :telefono, 
					correo = :correo, 
					estado = :estado 
			WHERE id = :id");

	$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
	$stmt->bindParam(":apellido_paterno", $datos["apellido_paterno"], PDO::PARAM_STR);
	$stmt->bindParam(":apellido_materno", $datos["apellido_materno"], PDO::PARAM_STR); // Nuevo campo agregado
	$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
	$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
	$stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
	$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
	$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR); // Nuevo campo agregado
	$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
	$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

	if ($stmt->execute()) {
			return "ok";
	} else {
			return "error";
	}

	$stmt = null;
}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/
	public static function mdlEliminarUsuario($tabla, $datos) {
    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
    $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return "ok";
    } else {
        return "error";
    }

    $stmt = null;
}


}