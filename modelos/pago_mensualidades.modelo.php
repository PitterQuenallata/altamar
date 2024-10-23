<?php
// modelos/pago_mensualidades.modelo.php
require_once "conexion.php";
class ModeloPagoMensualidades {

  /*=============================================
  CREAR PAGO MENSUALIDAD
  =============================================*/
  static public function mdlIngresarPagoMensualidad($tabla, $datos) {
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(monto, fecha, estado, id_propietario, id_usuario) VALUES (:monto, :fecha, :estado, :id_propietario, :id_usuario)");

      $stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
      $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
      $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
      $stmt->bindParam(":id_propietario", $datos["id_propietario"], PDO::PARAM_INT);
      $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

      if ($stmt->execute()) {
          return "ok";
      } else {
          return "error";
      }

      $stmt = null;
  }

  /*=============================================
  MOSTRAR PAGOS MENSUALIDADES
  =============================================*/
  static public function mdlMostrarPagosMensualidades($tabla, $item, $valor) {
      if ($item != null) {
          $stmt = Conexion::conectar()->prepare("SELECT pm.*, p.nombre AS nombre_propietario, p.apellido AS apellido_propietario, p.nroCarnet, p.telefono, u.nombre AS nombre_usuario FROM $tabla pm JOIN propietario p ON pm.id_propietario = p.id JOIN usuario u ON pm.id_usuario = u.id WHERE $item = :$item");
          $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
          $stmt->execute();
          return $stmt->fetch();
      } else {
          $stmt = Conexion::conectar()->prepare("SELECT pm.*, p.nombre AS nombre_propietario, p.apellido AS apellido_propietario, p.nroCarnet, p.telefono, u.nombre AS nombre_usuario FROM $tabla pm JOIN propietario p ON pm.id_propietario = p.id JOIN usuario u ON pm.id_usuario = u.id");
          $stmt->execute();
          return $stmt->fetchAll();
      }

      $stmt = null;
  }

      /*=============================================
    MOSTRAR PAGOS MENSUALIDADES PARA IMPRIMIR
    =============================================*/
    static public function mdlMostrarPagosMensualidadesImprimir($item, $valor) {
      $stmt = Conexion::conectar()->prepare(
          "SELECT pm.id, pm.monto, pm.fecha, pm.estado, p.nombre AS nombre_propietario, p.apellido AS apellido_propietario, p.nroCarnet, p.telefono, u.nombre AS nombre_usuario 
          FROM pago_mensualidades pm
          JOIN propietario p ON pm.id_propietario = p.id
          JOIN usuario u ON pm.id_usuario = u.id
          WHERE pm.$item = :$item"
      );
      $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetch();
  }
}
?>

