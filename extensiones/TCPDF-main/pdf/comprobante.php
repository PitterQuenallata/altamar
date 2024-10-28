<?php
// Incluye el archivo TCPDF y la conexión a la base de datos
require_once('../tcpdf.php');

require_once('../../../controladores/pago_mensualidades.controlador.php');
require_once('../../../modelos/conexion.php');
require_once('../../../modelos/pago_mensualidades.modelo.php');


// Obtener el idPago del parámetro GET
if (isset($_GET['idPago'])) {
    $idPago = $_GET['idPago'];

    // Consultar los detalles del pago utilizando el idPago
    $pagoDetalles = ControladorPagoMensualidades::ctrMostrarPagoPorId($idPago);

    // Si no se encuentran los detalles, mostrar error
    if (empty($pagoDetalles)) {
        die("Error: No se encontró información para el pago con ID: $idPago");
    }

    // Crear instancia de TCPDF
    class MYPDF extends TCPDF {
        public function Header() {}
        public function Footer() {}
    }

    // Crear instancia con tamaño pequeño
    $pdf = new MYPDF('P', 'mm', array(80, 120), true, 'UTF-8', false);

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Mi Sistema');
    $pdf->SetTitle('Comprobante de Pago');

    // Reducir márgenes
    $pdf->SetMargins(5, 5, 5);
    $pdf->SetAutoPageBreak(TRUE, 5);

    // Añadir página y fuente
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 10);

    // Obtener los detalles del pago
    $nombreCompleto = $pagoDetalles["nombre_completo"];
    $carnet = $pagoDetalles["carnet_propietario"];
    $fechaPeriodo = $pagoDetalles["fecha_periodo"];
    $monto = $pagoDetalles["monto_periodo"];
    $fechaCreacion = $pagoDetalles["fecha_creacion"];

    // Generar el contenido del comprobante
    $html = '
    <style>
        h1 {
            font-size: 12pt;
            font-weight: bold;
            text-align: center;
            margin-bottom: 5px;
            border-bottom: 1px solid #000;
        }
        .info-row {
            margin: 3px 0;
            font-size: 9pt;
            line-height: 1.2;
        }
        .footer {
            text-align: center;
            font-size: 8pt;
            margin-top: 5px;
            color: #000;
        }
        .dashed-line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
    </style>

    <h1>Comprobante de Pago</h1>
    <br>
    <div class="info-row">
    <strong>Propietario:</strong> ' . mb_strtoupper($nombreCompleto, 'UTF-8') . '
    </div>
    <div class="info-row">
    <strong>Carnet:</strong> ' . $carnet . '
    </div>
    <div class="info-row">
    <strong>Periodo:</strong> ' . $fechaPeriodo . '
    </div>
    <div class="info-row">
    <strong>Monto:</strong> BOB ' . number_format($monto, 2) . '
    </div>
    <div class="info-row">
    <strong>Fecha de Pago:</strong> ' . $fechaCreacion . '
    </div>

    <div class="dashed-line"></div>

    <div class="footer">
    ¡Gracias por su pago!<br>
    Este comprobante es válido como recibo de pago
    </div>
    ';

    // Escribir el HTML en el PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Mostrar el PDF en el navegador
    $pdf->Output('comprobante_pago.pdf', 'I');
} else {
    die("Error: No se ha proporcionado un ID de pago.");
}
