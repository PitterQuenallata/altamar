<?php

require_once "conexion.php";

class ModeloPropietarios {

  // Mostrar propietarios
  public static function mdlMostrarPropietarios($tabla, $item, $valor) {
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
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idusuario, nombre, apellido, nroCarnet, telefono, correo, actividad, nroDpto) VALUES (:idusuario, :nombre, :apellido, :nroCarnet, :telefono, :correo, :actividad, :nroDpto)");

      $stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_INT);
      $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
      $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
      $stmt->bindParam(":nroCarnet", $datos["nroCarnet"], PDO::PARAM_INT);
      $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_INT);
      $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
      $stmt->bindParam(":actividad", $datos["actividad"], PDO::PARAM_STR);
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
      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idusuario = :idusuario, nombre = :nombre, apellido = :apellido, nroCarnet = :nroCarnet, telefono = :telefono, correo = :correo, actividad = :actividad, nroDpto = :nroDpto WHERE id = :id");

      $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
      $stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_INT);
      $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
      $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
      $stmt->bindParam(":nroCarnet", $datos["nroCarnet"], PDO::PARAM_INT);
      $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_INT);
      $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
      $stmt->bindParam(":actividad", $datos["actividad"], PDO::PARAM_STR);
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
