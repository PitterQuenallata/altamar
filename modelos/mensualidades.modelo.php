<?php
require_once "conexion.php";

class ModeloMensualidades
{

    /*=============================================
    VERIFICAR SI EXISTE MENSUALIDAD
=============================================*/
    static public function mdlVerificarMensualidadExistente($tabla, $mes, $gestion)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE mes = :mes AND gestion = :gestion");
        $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
        $stmt->bindParam(":gestion", $gestion, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(); // Retorna datos si existe o false si no
    }

    /*=============================================
      mostar mensualidades
  =============================================*/
    static public function mdlMostrarMensualidades($tabla, $item, $valor)
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

    /*=============================================
    CREAR MENSUALIDAD
    =============================================*/
    static public function mdlCrearMensualidad($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(mes, gestion, costo) VALUES (:mes, :gestion, :costo)");

        $stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
        $stmt->bindParam(":gestion", $datos["gestion"], PDO::PARAM_STR);
        $stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /*=============================================
    EDITAR MENSUALIDAD
    =============================================*/
    static public function mdlEditarMensualidad($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET mes = :mes, gestion = :gestion, costo = :costo WHERE id = :id");

        $stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
        $stmt->bindParam(":gestion", $datos["gestion"], PDO::PARAM_STR);
        $stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /*=============================================
    BORRAR MENSUALIDAD
    =============================================*/
    static public function mdlBorrarMensualidad($tabla, $datos)
    {

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
