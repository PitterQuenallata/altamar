<?php
// modelos/pago_mensualidades.modelo.php
require_once "conexion.php";
class ModeloPagoMensualidades
{
    /*=============================================
    mostrar pago por id imprimir
    =============================================*/
    public static function mdlMostrarPagoPorId($idPago) {
        $stmt = Conexion::conectar()->prepare(
            "SELECT 
                pm.id, 
                CONCAT(p.nombre, ' ', p.apellido_paterno, ' ', p.apellido_materno) AS nombre_completo, 
                p.nroCarnet AS carnet_propietario, 
                pm.fecha_periodo, 
                pm.costo_periodo AS monto_periodo, 
                pm.fecha_creacion 
            FROM pago_mensualidad pm 
            JOIN propietario p ON pm.id_propietario = p.id
            WHERE pm.id = :idPago"
        );
        
        $stmt->bindParam(":idPago", $idPago, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    /*=============================================
    MOSTRAR MENSUALIDADES PENDIENTES DE UN PROPIETARIO
    =============================================*/
    static public function mdlMostrarMensualidadesPendientes($tablaMensualidades, $tablaPagos, $idPropietario, $fechaDesde)
    {

        // Dividir la fecha en año y mes para las comparaciones
        $anioDesde = date('Y', strtotime($fechaDesde));
        $mesDesde = date('m', strtotime($fechaDesde));

        $stmt = Conexion::conectar()->prepare(
            "SELECT m.*
             FROM $tablaMensualidades AS m
             LEFT JOIN $tablaPagos AS pm 
                ON m.id = pm.id_mensualidad AND pm.id_propietario = :idPropietario
             WHERE pm.id_mensualidad IS NULL
               AND (m.gestion > :anioDesde 
               OR (m.gestion = :anioDesde AND m.mes >= :mesDesde))"
        );

        // Bind de parámetros
        $stmt->bindParam(":idPropietario", $idPropietario, PDO::PARAM_INT);
        $stmt->bindParam(":anioDesde", $anioDesde, PDO::PARAM_INT);
        $stmt->bindParam(":mesDesde", $mesDesde, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Retornar resultados como un array
        return $stmt->fetchAll();
    }

    /*=============================================
    CREAR PAGO DE MENSUALIDAD
=============================================*/
static public function mdlCrearPagoMensualidad($tabla, $datos)
{
    // Crear una instancia de conexión
    $conexion = Conexion::conectar();

    // Prepara la consulta
    $stmt = $conexion->prepare("INSERT INTO $tabla (fecha_periodo, costo_periodo, id_propietario, id_mensualidad, id_usuario) 
                                VALUES (:fecha_periodo, :costo_periodo, :id_propietario, :id_mensualidad, :id_usuario)");

    // Bind de parámetros
    $stmt->bindParam(":fecha_periodo", $datos["fecha_periodo"], PDO::PARAM_STR);
    $stmt->bindParam(":costo_periodo", $datos["costo_periodo"], PDO::PARAM_STR);
    $stmt->bindParam(":id_propietario", $datos["id_propietario"], PDO::PARAM_INT);
    $stmt->bindParam(":id_mensualidad", $datos["id_mensualidad"], PDO::PARAM_INT);
    $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);

    // Intentar ejecutar la consulta
    if ($stmt->execute()) {
        // Si la inserción fue exitosa, devolver el último ID insertado
        return $conexion->lastInsertId();  // Asegurarse de usar la misma conexión para lastInsertId()
    } else {
        return "error";  // En caso de error, devolver "error"
    }

    // Cerrar la conexión
    $stmt = null;
}
/*=============================================
MOSTRAR LISTA DE PAGOS DE MENSUALIDADES
=============================================*/
static public function mdlMostrarListaPagosMensualidades($tablaPropietarios, $tablaPagosMensualidades)
{
    // Prepara la consulta SQL con las uniones necesarias, incluyendo el id de pago_mensualidad
    $stmt = Conexion::conectar()->prepare(
        "SELECT 
            pm.id AS id,  -- Asegurarse de seleccionar el id del pago_mensualidad
            CONCAT(p.nombre, ' ', p.apellido_paterno, ' ', p.apellido_materno) AS nombre_completo, 
            p.nroCarnet AS carnet_propietario, 
            pm.fecha_periodo, 
            pm.costo_periodo AS monto_periodo, 
            pm.fecha_creacion 
        FROM $tablaPropietarios p 
        JOIN $tablaPagosMensualidades pm 
        ON p.id = pm.id_propietario"
    );

    // Ejecutar la consulta
    $stmt->execute();

    // Retornar los resultados como un array
    return $stmt->fetchAll();
}

}
