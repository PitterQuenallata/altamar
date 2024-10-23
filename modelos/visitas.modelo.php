<?php

require_once "conexion.php";

class ModeloVisitas
{

  // Mostrar visitas
  public static function mdlMostrarVisitas($tabla, $item, $valor)
  {
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

  // Ingresar visita
  public static function mdlIngresarVisita($tabla, $datos)
  {
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, apellido, carnet, nroDpto) VALUES (:nombre, :apellido, :carnet, :nroDpto)");
    $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
    $stmt->bindParam(":carnet", $datos["carnet"], PDO::PARAM_INT);
    $stmt->bindParam(":nroDpto", $datos["nroDpto"], PDO::PARAM_STR);

    if ($stmt->execute()) {
      // Obtener el último ID insertado manualmente
      $stmt = Conexion::conectar()->prepare("SELECT id FROM $tabla ORDER BY id DESC LIMIT 1");
      $stmt->execute();
      $lastId = $stmt->fetch(PDO::FETCH_ASSOC);
      return $lastId['id'];
    } else {
      return false;
    }
    $stmt = null;
  }

  // Editar visita
  public static function mdlEditarVisita($tabla, $datos)
  {
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido = :apellido, carnet = :carnet, nroDpto = :nroDpto WHERE id = :id");
    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
    $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
    $stmt->bindParam(":carnet", $datos["carnet"], PDO::PARAM_INT);
    $stmt->bindParam(":nroDpto", $datos["nroDpto"], PDO::PARAM_STR);

    if ($stmt->execute()) {
      return "ok";
    } else {
      return "error: " . implode(":", $stmt->errorInfo());
    }

    $stmt = null;
  }
}
