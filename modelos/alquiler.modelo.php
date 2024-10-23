<?php
require_once "conexion.php";

class ModeloAlquiler {

    // Mostrar áreas disponibles
    public static function mdlMostrarAreasDisponibles($tabla, $fechaInicio, $fechaFinal) {
      $stmt = Conexion::conectar()->prepare("
          SELECT a.*
          FROM $tabla a
          LEFT JOIN detalle_alquiler da ON a.id = da.id_area
          LEFT JOIN alquiler al ON da.id_alquiler = al.id
          AND (
              (:fechaInicio BETWEEN al.fecha_inicio AND al.fecha_final) OR
              (:fechaFinal BETWEEN al.fecha_inicio AND al.fecha_final) OR
              (al.fecha_inicio BETWEEN :fechaInicio AND :fechaFinal) OR
              (al.fecha_final BETWEEN :fechaInicio AND :fechaFinal)
          )
          WHERE al.id IS NULL
      ");
      $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
      $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);

      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

      $stmt = null;
  }



    // Mostrar áreas sociales disponibles
    public static function mdlMostrarAreasSociales() {
        $stmt = Conexion::conectar()->prepare("SELECT id, descripcion, precio, estado FROM area_social");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insertar datos en la tabla alquiler y devolver el ID insertado
    public static function mdlCrearAlquiler($tabla, $datos) {
      $link = Conexion::conectar(); // Almacenar la conexión en una variable
      $stmt = $link->prepare("INSERT INTO $tabla(id_usuario, id_propietario, fecha_inicio, fecha_final, total) VALUES (:id_usuario, :id_propietario, :fecha_inicio, :fecha_final, :total)");
      $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
      $stmt->bindParam(":id_propietario", $datos["id_propietario"], PDO::PARAM_INT);
      $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
      $stmt->bindParam(":fecha_final", $datos["fecha_final"], PDO::PARAM_STR);
      $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

      if ($stmt->execute()) {
          $id = $link->lastInsertId(); // Devolver el ID insertado
          $stmt = null; // Cerrar el statement
          return $id;
      } else {
          $stmt = null; // Cerrar el statement
          return "error";
      }
  }

    // Insertar datos en la tabla detalle_alquiler
    public static function mdlCrearDetalleAlquiler($tabla, $datos) {
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_alquiler, id_area, precio) VALUES (:id_alquiler, :id_area, :precio)");
      $stmt->bindParam(":id_alquiler", $datos["id_alquiler"], PDO::PARAM_INT);
      $stmt->bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);
      $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);

      if ($stmt->execute()) {
          $stmt = null; // Cerrar el statement
          return "ok";
      } else {
          $stmt = null; // Cerrar el statement
          return "error";
      }
  }
}
?>
