<?php

require_once "conexion.php";

class ModeloReservasAreaSocial
{

  /*=============================================
  MOSTRAR RESERVAS
  =============================================*/
  public static function mdlMostrarReservas($tabla, $tablaDetalle) {

    $stmt = Conexion::conectar()->prepare("
      SELECT a.id AS id_alquiler, 
             CONCAT(p.nombre, ' ', p.apellido_paterno, ' ', p.apellido_materno) AS nombre_completo,
             p.nroCarnet, 
             asoc.descripcion AS descripcion_area,
             a.fecha_inicio, a.fecha_final, 
             a.hora_inicio, a.hora_final, 
             SUM(da.costo) AS costo_total
      FROM $tabla a
      JOIN detalle_alquiler da ON a.id = da.id_alquiler
      JOIN area_social asoc ON da.id_area_social = asoc.id
      JOIN propietario p ON a.id_propietario = p.id
      GROUP BY a.id
    ");

    $stmt->execute();
    return $stmt->fetchAll();
  }

  /*=============================================
    MOSTRAR ÁREAS DISPONIBLES
    =============================================*/
  static public function mdlMostrarAreasDisponibles($tablaAlquiler, $tablaDetalleAlquiler, $tablaAreaSocial, $fechaInicio, $horaInicio, $fechaFinal, $horaFinal)
  {

    // Consulta para encontrar las áreas que NO están alquiladas en el rango de fecha/hora
    $stmt = Conexion::conectar()->prepare(
      "SELECT a.*
           FROM $tablaAreaSocial AS a
           WHERE a.id NOT IN (
               SELECT da.id_area_social
               FROM $tablaDetalleAlquiler AS da
               JOIN $tablaAlquiler AS alq ON da.id_alquiler = alq.id
               WHERE 
                   (alq.fecha_inicio = :fechaInicio OR alq.fecha_final = :fechaFinal)
               AND (
                   (alq.hora_inicio <= :horaFinal AND alq.hora_final >= :horaInicio)
                   OR (alq.hora_inicio BETWEEN :horaInicio AND :horaFinal)
                   OR (alq.hora_final BETWEEN :horaInicio AND :horaFinal)
               )
           ) 
           AND a.estado = 1"
    );

    // Bind de parámetros
    $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
    $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
    $stmt->bindParam(":horaInicio", $horaInicio, PDO::PARAM_STR);
    $stmt->bindParam(":horaFinal", $horaFinal, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetchAll();
  }

  /*=============================================
  MOSTRAR HORAS OCUPADAS DE UN ÁREA SOCIAL
  =============================================*/
  static public function mdlMostrarAreasOcupadas($tablaAlquiler, $tablaDetalleAlquiler, $tablaAreaSocial, $fechaInicio, $fechaFinal, $horaInicio, $horaFinal)
  {
    $stmt = Conexion::conectar()->prepare(
      "SELECT a.id, a.descripcion, al.fecha_inicio, al.fecha_final, al.hora_inicio, al.hora_final 
         FROM $tablaAlquiler AS al
         INNER JOIN $tablaDetalleAlquiler AS da ON al.id = da.id_alquiler
         INNER JOIN $tablaAreaSocial AS a ON da.id_area_social = a.id
         WHERE (al.fecha_inicio <= :fechaFinal AND al.fecha_final >= :fechaInicio)
           AND (al.hora_inicio <= :horaFinal AND al.hora_final >= :horaInicio)"
    );

    $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
    $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
    $stmt->bindParam(":horaInicio", $horaInicio, PDO::PARAM_STR);
    $stmt->bindParam(":horaFinal", $horaFinal, PDO::PARAM_STR);

    $stmt->execute();
    return $stmt->fetchAll();
  }

  /*=============================================
CREAR RESERVA
=============================================*/
  static public function mdlCrearReserva($tabla, $datos)
  {

    // Crear una instancia de conexión
    $conexion = Conexion::conectar();

    // Prepara la consulta de inserción
    $stmt = $conexion->prepare("INSERT INTO $tabla (fecha_inicio, hora_inicio, fecha_final, hora_final, monto_total, id_propietario, id_usuario) 
                              VALUES (:fecha_inicio, :hora_inicio, :fecha_final, :hora_final, :monto_total, :id_propietario, :id_usuario)");

    // Bind de parámetros
    $stmt->bindParam(":fecha_inicio", $datos['fecha_inicio'], PDO::PARAM_STR);
    $stmt->bindParam(":hora_inicio", $datos['hora_inicio'], PDO::PARAM_STR);
    $stmt->bindParam(":fecha_final", $datos['fecha_final'], PDO::PARAM_STR);
    $stmt->bindParam(":hora_final", $datos['hora_final'], PDO::PARAM_STR);
    $stmt->bindParam(":monto_total", $datos['monto_total'], PDO::PARAM_STR);
    $stmt->bindParam(":id_propietario", $datos['id_propietario'], PDO::PARAM_INT);
    $stmt->bindParam(":id_usuario", $datos['id_usuario'], PDO::PARAM_INT);

    // Intentar ejecutar la consulta
    if ($stmt->execute()) {
      // Devolver el último ID insertado si la ejecución fue exitosa
      return $conexion->lastInsertId();  // Usa la misma conexión para obtener el lastInsertId()
    } else {
      return "error";  // En caso de error, devolver "error"
    }

    // Cerrar el statement
    $stmt = null;
  }



/*=============================================
GUARDAR DETALLE DE RESERVA
=============================================*/
static public function mdlGuardarDetalleReserva($tabla, $datos) {

  // Verificar si ya existe esa combinación de id_alquiler e id_area_social
  $stmt = Conexion::conectar()->prepare(
      "SELECT COUNT(*) FROM $tabla WHERE id_alquiler = :id_alquiler AND id_area_social = :id_area_social"
  );

  $stmt->bindParam(":id_alquiler", $datos['id_alquiler'], PDO::PARAM_INT);
  $stmt->bindParam(":id_area_social", $datos['id_area_social'], PDO::PARAM_INT);

  $stmt->execute();

  if ($stmt->fetchColumn() == 0) {
      // Solo insertar si no existe
      $stmt = Conexion::conectar()->prepare(
          "INSERT INTO $tabla (id_alquiler, id_area_social, costo) VALUES (:id_alquiler, :id_area_social, :costo)"
      );

      $stmt->bindParam(":id_alquiler", $datos['id_alquiler'], PDO::PARAM_INT);
      $stmt->bindParam(":id_area_social", $datos['id_area_social'], PDO::PARAM_INT);
      $stmt->bindParam(":costo", $datos['costo'], PDO::PARAM_STR);

      if ($stmt->execute()) {
          return "ok";
      } else {
          return "error";
      }
  } else {
      // Si ya existe, no hacer nada
      return "duplicado";
  }

  $stmt = null;
}


  /*=============================================
    VERIFICAR SI ÁREA SOCIAL ESTÁ OCUPADA
=============================================*/
  static public function mdlVerificarAreaOcupada($tablaAlquiler, $tablaDetalle, $idAreaSocial, $fechaInicio, $horaInicio, $fechaFinal, $horaFinal)
  {

    $stmt = Conexion::conectar()->prepare(
      "SELECT * 
       FROM $tablaAlquiler AS a
       INNER JOIN $tablaDetalle AS d ON a.id = d.id_alquiler
       WHERE d.id_area_social = :id_area_social
       AND (
           (a.fecha_inicio = :fecha_inicio AND a.hora_inicio <= :hora_final AND a.hora_final >= :hora_inicio)
           OR
           (a.fecha_final = :fecha_final AND a.hora_inicio <= :hora_final AND a.hora_final >= :hora_inicio)
           OR
           (a.fecha_inicio < :fecha_inicio AND a.fecha_final > :fecha_final)
       )"
    );

    $stmt->bindParam(":id_area_social", $idAreaSocial, PDO::PARAM_INT);
    $stmt->bindParam(":fecha_inicio", $fechaInicio, PDO::PARAM_STR);
    $stmt->bindParam(":hora_inicio", $horaInicio, PDO::PARAM_STR);
    $stmt->bindParam(":fecha_final", $fechaFinal, PDO::PARAM_STR);
    $stmt->bindParam(":hora_final", $horaFinal, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetch();  // Retorna true si encuentra alguna coincidencia, false si está disponible
  }

  /*=============================================
    MOSTRAR RESERVA POR ID
    =============================================*/
  static public function mdlMostrarReservaPorId($tabla, $idReserva)
  {
    $stmt = Conexion::conectar()->prepare(
      "SELECT 
              CONCAT(p.nombre, ' ', p.apellido_paterno, ' ', p.apellido_materno) AS nombre_completo,
              p.nroCarnet AS carnet_propietario,
              a.fecha_inicio, 
              a.hora_inicio, 
              a.fecha_final, 
              a.hora_final, 
              a.monto_total
          FROM $tabla a
          JOIN propietario p ON a.id_propietario = p.id
          WHERE a.id = :idReserva"
    );

    $stmt->bindParam(":idReserva", $idReserva, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetch();
  }

  /*=============================================
  MOSTRAR DETALLE DE RESERVA POR ID
  =============================================*/
  static public function mdlMostrarDetalleReservaPorId($tabla, $idReserva)
  {
    $stmt = Conexion::conectar()->prepare(
      "SELECT 
              d.id_area_social, 
              d.costo, 
              a.descripcion
          FROM $tabla d
          JOIN area_social a ON d.id_area_social = a.id
          WHERE d.id_alquiler = :idReserva"
    );

    $stmt->bindParam(":idReserva", $idReserva, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll();
  }
}
