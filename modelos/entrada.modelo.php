<?php

require_once "conexion.php";

class ModeloEntrada
{

  // Mostrar entradas
  public static function mdlMostrarEntrada($tabla, $item, $valor)
  {
    if ($item != null) {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
      $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchAll();
    } else {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
      $stmt->execute();
      return $stmt->fetchAll();
    }
    $stmt = null;
  }

  // Ingresar entrada
  public static function mdlIngresarEntrada($tabla, $datos)
  {
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (hora_entrada, personas, id_visita, id_propietario, id_usuario) VALUES (:hora_entrada, :personas, :id_visita, :id_propietario, :id_usuario)");
    $stmt->bindParam(":hora_entrada", $datos["hora_entrada"], PDO::PARAM_STR);
    $stmt->bindParam(":personas", $datos["personas"], PDO::PARAM_INT);
    $stmt->bindParam(":id_visita", $datos["id_visita"], PDO::PARAM_INT);
    $stmt->bindParam(":id_propietario", $datos["id_propietario"], PDO::PARAM_INT);
    $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

    if ($stmt->execute()) {
      return "ok";
    } else {
      return "error: " . implode(":", $stmt->errorInfo());
    }

    $stmt = null;
  }

  // Editar entrada
  public static function mdlEditarEntrada($tabla, $datos)
  {
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET hora_entrada = :hora_entrada, personas = :personas, id_propietario = :id_propietario WHERE id = :id");
    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
    $stmt->bindParam(":hora_entrada", $datos["hora_entrada"], PDO::PARAM_STR);
    $stmt->bindParam(":personas", $datos["personas"], PDO::PARAM_INT);
    $stmt->bindParam(":id_propietario", $datos["id_propietario"], PDO::PARAM_INT);

    if ($stmt->execute()) {
      return "ok";
    } else {
      return "error: " . implode(":", $stmt->errorInfo());
    }
    $stmt = null;
  }

  // Marcar salida
  public static function mdlMarcarSalida($tabla, $datos)
  {
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET hora_salida = :hora_salida WHERE id = :id");
    $stmt->bindParam(":hora_salida", $datos["hora_salida"], PDO::PARAM_STR);
    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

    if ($stmt->execute()) {
      return "ok";
    } else {
      return "error: " . implode(":", $stmt->errorInfo());
    }


    $stmt = null;
  }
}
