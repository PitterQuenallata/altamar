<?php

require_once "conexion.php";

class ModeloPropietarios {

/*=============================================
    MOSTRAR PROPIETARIO
=============================================*/
static public function mdlMostrarPropietarios($tabla, $item, $valor) {
  if ($item != null) {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
      $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
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
    INGRESAR PROPIETARIO
=============================================*/
static public function mdlIngresarPropietario($tabla, $datos) {
  $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_usuario, nombre, apellido_paterno, apellido_materno, nroCarnet, telefono, correo, nroDpto) 
  VALUES (:id_usuario, :nombre, :apellido_paterno, :apellido_materno, :nroCarnet, :telefono, :correo, :nroDpto)");

  $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
  $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
  $stmt->bindParam(":apellido_paterno", $datos["apellido_paterno"], PDO::PARAM_STR);
  $stmt->bindParam(":apellido_materno", $datos["apellido_materno"], PDO::PARAM_STR);
  $stmt->bindParam(":nroCarnet", $datos["nroCarnet"], PDO::PARAM_STR);  // Cambiado a STR, según la tabla.
  $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);    // Cambiado a STR, según la tabla.
  $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
  $stmt->bindParam(":nroDpto", $datos["nroDpto"], PDO::PARAM_STR);

  if ($stmt->execute()) {
      return "ok";
  } else {
      return "error";
  }

  $stmt = null;
}



/*=============================================
    EDITAR PROPIETARIO
=============================================*/
static public function mdlEditarPropietario($tabla, $datos) {
  $stmt = Conexion::conectar()->prepare("UPDATE $tabla 
      SET id_usuario = :id_usuario, 
          nombre = :nombre, 
          apellido_paterno = :apellido_paterno, 
          apellido_materno = :apellido_materno, 
          nroCarnet = :nroCarnet, 
          telefono = :telefono, 
          correo = :correo, 
          nroDpto = :nroDpto 
      WHERE id = :id");

  $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
  $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
  $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
  $stmt->bindParam(":apellido_paterno", $datos["apellido_paterno"], PDO::PARAM_STR);
  $stmt->bindParam(":apellido_materno", $datos["apellido_materno"], PDO::PARAM_STR);
  $stmt->bindParam(":nroCarnet", $datos["nroCarnet"], PDO::PARAM_STR); // Es varchar, se cambia a STR
  $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);   // Es varchar, se cambia a STR
  $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
  $stmt->bindParam(":nroDpto", $datos["nroDpto"], PDO::PARAM_STR);

  if ($stmt->execute()) {
      return "ok";
  } else {
      return "error";
  }

  $stmt = null;
}


      /*=============================================
    BORRAR PROPIETARIO
    =============================================*/
    static public function mdlBorrarPropietario($tabla, $datos) {
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
?>
