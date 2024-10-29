<?php
require_once "conexion.php";
class reportes

{
/*=============================================
R2 MOSTRAR PROPIETARIOS CON MENSUALIDADES PENDIENTES HASTA LA FECHA
=============================================*/
static public function mdlMostrarPropietariosConMP($tablaPropietarios, $tablaMensualidades, $tablaPagosMensualidades) {
  $stmt = Conexion::conectar()->prepare(
      "SELECT 
          p.id AS id_propietario,
          CONCAT(p.nombre, ' ', p.apellido_paterno, ' ', p.apellido_materno) AS nombre_completo,
          p.nroCarnet,
          p.telefono,
          p.nroDpto,
          GROUP_CONCAT(CONCAT(m.mes, '/', m.gestion) ORDER BY m.gestion, m.mes SEPARATOR ', ') AS mensualidades_pendientes
      FROM $tablaPropietarios p
      LEFT JOIN $tablaMensualidades m ON 1=1
      LEFT JOIN $tablaPagosMensualidades pm ON p.id = pm.id_propietario AND m.id = pm.id_mensualidad
      WHERE pm.id IS NULL 
      AND (m.gestion < YEAR(CURDATE()) OR (m.gestion = YEAR(CURDATE()) AND m.mes <= MONTH(CURDATE())))
      GROUP BY p.id
      HAVING mensualidades_pendientes IS NOT NULL"
  );

  $stmt->execute();
  return $stmt->fetchAll();
}
/*=============================================
R3 MOSTRAR RESUMEN DE PAGOS Y DEUDAS PENDIENTES DE UN PROPIETARIO
=============================================*/
static public function mdlResumenPagosPorPropietario($tablaMensualidades, $tablaPagos, $tablaPropietarios, $idPropietario, $fechaDesde) {
  $anioDesde = date('Y', strtotime($fechaDesde));
  $mesDesde = date('m', strtotime($fechaDesde));

  $stmt = Conexion::conectar()->prepare(
      "SELECT 
          p.id AS id_propietario,
          CONCAT(p.nombre, ' ', p.apellido_paterno, ' ', p.apellido_materno) AS nombre_completo,
          p.nroCarnet,
          m.mes,
          m.gestion,
          IFNULL(pm.costo_periodo, 0) AS monto_pagado,
          IF(pm.id IS NULL, 'Pendiente', 'Pagado') AS estado
      FROM $tablaMensualidades m
      LEFT JOIN $tablaPagos pm ON m.id = pm.id_mensualidad AND pm.id_propietario = :idPropietario
      JOIN $tablaPropietarios p ON p.id = :idPropietario
      WHERE (m.gestion > :anioDesde 
             OR (m.gestion = :anioDesde AND m.mes >= :mesDesde))
      ORDER BY m.gestion, m.mes"
  );

  $stmt->bindParam(":idPropietario", $idPropietario, PDO::PARAM_INT);
  $stmt->bindParam(":anioDesde", $anioDesde, PDO::PARAM_INT);
  $stmt->bindParam(":mesDesde", $mesDesde, PDO::PARAM_INT);

  $stmt->execute();
  return $stmt->fetchAll();
}


/*=============================================
R4 OBTENER LISTA DE ALQUILERES REALIZADOS CON DETALLES (CON RANGO DE FECHAS)
=============================================*/
static public function mdlObtenerListaAlquileresConDetalles($tablaAlquiler, $tablaDetalleAlquiler, $tablaAreaSocial, $tablaUsuario, $fechaInicio = null, $fechaFinal = null) {
  $query = "SELECT 
              a.id AS id_alquiler,
              a.fecha_inicio,
              a.fecha_final,
              a.hora_inicio,
              a.hora_final,
              a.monto_total,
              u.nombre AS usuario_gestion,
              s.descripcion AS area_social,
              d.costo AS costo_area
          FROM 
              $tablaAlquiler a
          JOIN 
              $tablaUsuario u ON a.id_usuario = u.id
          JOIN 
              $tablaDetalleAlquiler d ON a.id = d.id_alquiler
          JOIN 
              $tablaAreaSocial s ON d.id_area_social = s.id";
  
  // Agregar condición de rango de fechas si se especifica
  if ($fechaInicio && $fechaFinal) {
      $query .= " WHERE a.fecha_inicio BETWEEN :fechaInicio AND :fechaFinal";
  }

  $query .= " ORDER BY a.id";

  $stmt = Conexion::conectar()->prepare($query);

  // Bind de fechas si están definidas
  if ($fechaInicio && $fechaFinal) {
      $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
      $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
  }

  $stmt->execute();
  return $stmt->fetchAll();
}


/*=============================================
R5 LISTADO DE ALQUILERES POR PROPIETARIO
=============================================*/
static public function mdlObtenerAlquileresPorPropietario($tablaAlquiler, $tablaDetalleAlquiler, $tablaAreaSocial, $tablaUsuario, $tablaPropietario, $idPropietario) {
  $stmt = Conexion::conectar()->prepare(
      "SELECT 
          a.id AS id_alquiler,
          a.fecha_inicio,
          a.fecha_final,
          a.hora_inicio,
          a.hora_final,
          a.monto_total,
          u.nombre AS usuario_gestion,
          s.descripcion AS area_social,
          d.costo AS costo_area,
          CONCAT(p.nombre, ' ', p.apellido_paterno, ' ', p.apellido_materno) AS nombre_propietario,
          p.nroCarnet,
          p.nroDpto,
          p.telefono
      FROM 
          $tablaAlquiler AS a
      JOIN 
          $tablaPropietario AS p ON a.id_propietario = p.id
      JOIN 
          $tablaUsuario AS u ON a.id_usuario = u.id
      JOIN 
          $tablaDetalleAlquiler AS d ON a.id = d.id_alquiler
      JOIN 
          $tablaAreaSocial AS s ON d.id_area_social = s.id
      WHERE 
          a.id_propietario = :idPropietario
      ORDER BY 
          a.id"
  );

  // Vincular el parámetro de entrada
  $stmt->bindParam(":idPropietario", $idPropietario, PDO::PARAM_INT);

  // Ejecutar la consulta
  $stmt->execute();

  // Retornar los resultados como un array
  return $stmt->fetchAll();
}


/*=============================================
R6 OBTENER LAS 10 ÁREAS SOCIALES MÁS ALQUILADAS
=============================================*/
static public function mdlObtenerAreasSocialesMasAlquiladas($tablaDetalleAlquiler, $tablaAreaSocial) {
  $stmt = Conexion::conectar()->prepare(
      "SELECT 
          s.descripcion AS area_social,
          s.precio AS precio,
          COUNT(d.id_area_social) AS veces_alquilada
      FROM 
          $tablaDetalleAlquiler AS d
      JOIN 
          $tablaAreaSocial AS s ON d.id_area_social = s.id
      GROUP BY 
          d.id_area_social
      ORDER BY 
          veces_alquilada DESC
      LIMIT 10"
  );

  // Ejecutar la consulta
  $stmt->execute();

  // Retornar los resultados como un array
  return $stmt->fetchAll();
}

/*=============================================
R7 DETALLE DE INGRESOS DE ALQUILER EN UN RANGO DE FECHAS
=============================================*/
static public function mdlObtenerIngresosDetalleAlquiler($tablaAlquiler, $fechaInicio, $fechaFinal) {
  $stmt = Conexion::conectar()->prepare(
      "SELECT 
          fecha_inicio,
          fecha_final,
          monto_total
      FROM 
          $tablaAlquiler
      WHERE 
          fecha_inicio BETWEEN :fechaInicio AND :fechaFinal"
  );

  // Vincular los parámetros de fecha
  $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
  $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);

  // Ejecutar la consulta
  $stmt->execute();

  // Retornar los resultados como un array
  return $stmt->fetchAll();
}


/*=============================================
R8 DETALLE DE GANANCIAS DE ALQUILERES HASTA LA FECHA ACTUAL
=============================================*/
static public function mdlObtenerGananciasAlquilerHastaHoy($tablaAlquiler) {
  $stmt = Conexion::conectar()->prepare(
      "SELECT 
          fecha_inicio,
          fecha_final,
          monto_total
      FROM 
          $tablaAlquiler
      WHERE 
          fecha_inicio <= CURDATE()"
  );

  // Ejecutar la consulta
  $stmt->execute();

  // Retornar los resultados como un array
  return $stmt->fetchAll();
}
/*=============================================
R9 DETALLE DE GANANCIAS DE MENSUALIDADES HASTA LA FECHA ACTUAL
=============================================*/
static public function mdlObtenerGananciasMensualidadesHastaHoy($tablaPagos) {
  $stmt = Conexion::conectar()->prepare(
      "SELECT 
          fecha_periodo,
          costo_periodo
      FROM 
          $tablaPagos
      WHERE 
          fecha_periodo <= CURDATE()"
  );

  // Ejecutar la consulta
  $stmt->execute();

  // Retornar los resultados como un array
  return $stmt->fetchAll();
}

/*=============================================
R10 TOTAL DE GANANCIAS GENERALES HASTA LA FECHA ACTUAL
=============================================*/
static public function mdlObtenerGananciasGeneralesHastaHoy($tablaAlquiler, $tablaPagos) {
  // Obtener ingresos de alquileres
  $stmtAlquileres = Conexion::conectar()->prepare(
      "SELECT 
          fecha_inicio AS fecha,
          monto_total AS monto,
          'Alquiler' AS tipo
      FROM 
          $tablaAlquiler
      WHERE 
          fecha_inicio <= CURDATE()"
  );
  $stmtAlquileres->execute();
  $ingresosAlquileres = $stmtAlquileres->fetchAll();

  // Obtener ingresos de mensualidades
  $stmtMensualidades = Conexion::conectar()->prepare(
      "SELECT 
          fecha_periodo AS fecha,
          costo_periodo AS monto,
          'Mensualidad' AS tipo
      FROM 
          $tablaPagos
      WHERE 
          fecha_periodo <= CURDATE()"
  );
  $stmtMensualidades->execute();
  $ingresosMensualidades = $stmtMensualidades->fetchAll();

  // Combinar los resultados de ambos tipos de ingresos
  return array_merge($ingresosAlquileres, $ingresosMensualidades);
}

}
