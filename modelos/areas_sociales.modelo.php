<?php

require_once "conexion.php";

class ModeloAreasSociales {

    /*=============================================
    MOSTRAR ÁREAS SOCIALES
    =============================================*/
    static public function mdlMostrarAreasSociales($tabla, $item, $valor) {
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
    }

    /*=============================================
    CAMBIAR ESTADO ÁREA SOCIAL
    =============================================*/
    static public function mdlCambiarEstadoAreaSocial($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");
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
    INGRESAR ÁREA SOCIAL
    =============================================*/
    static public function mdlIngresarAreaSocial($tabla, $datos) {
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, precio) VALUES (:descripcion, :precio)");

      $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
      $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);

      if ($stmt->execute()) {
          return "ok";
      } else {
          return "error";
      }

      $stmt = null;
  }

  /*=============================================
EDITAR ÁREA SOCIAL
=============================================*/
static public function mdlEditarAreaSocial($tabla, $datos) {
  $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, precio = :precio WHERE id = :id");

  $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
  $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
  $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

  if ($stmt->execute()) {
      return "ok";
  } else {
      return "error";
  }

  $stmt = null;
}

/*=============================================
ELIMINAR ÁREA SOCIAL
=============================================*/
static public function mdlEliminarAreaSocial($tabla, $datos) {
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
