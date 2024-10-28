<?php

class ControladorPagoMensualidades
{
    /*=============================================
    MOSTRAR PAGO POR ID imprimir
    =============================================*/
    public static function ctrMostrarPagoPorId($idPago)
    {
        return ModeloPagoMensualidades::mdlMostrarPagoPorId($idPago);
    }

    /*=============================================
    MOSTRAR LISTA DE PAGOS DE MENSUALIDADES
    =============================================*/
    static public function ctrMostrarListaPagosMensualidades()
    {

        // Llamar al modelo para obtener la lista de pagos de mensualidades
        $respuesta = ModeloPagoMensualidades::mdlMostrarListaPagosMensualidades("propietario", "pago_mensualidad");

        // Retornar la respuesta al controlador que lo invoque
        return $respuesta;
    }

    /*=============================================
    MOSTRAR MENSUALIDADES PENDIENTES DE UN PROPIETARIO
    =============================================*/
    static public function ctrMostrarMensualidadesPendientes($idPropietario, $fechaDesde)
    {

        // Llamar al modelo para obtener las mensualidades pendientes
        $tablaMensualidades = "mensualidad"; // Nombre de la tabla de mensualidades
        $tablaPagos = "pago_mensualidad"; // Nombre de la tabla de pagos

        $respuesta = ModeloPagoMensualidades::mdlMostrarMensualidadesPendientes($tablaMensualidades, $tablaPagos, $idPropietario, $fechaDesde);

        return $respuesta;
    }

    /*=============================================
    CREAR PAGO DE MENSUALIDAD
=============================================*/
    public function ctrCrearPagoMensualidad()
    {

        if (isset($_POST["montoRecibido"])) {

            // Obtener la mensualidad seleccionada
            $idMensualidad = $_POST["idMensualidad"];
            $montoPeriodo = $_POST["montoPeriodo"]; // Este es el costo fijo de la mensualidad


            // Verificar si tiene pagos pendientes más antiguos
            $mensualidadesPendientes = ModeloPagoMensualidades::mdlMostrarMensualidadesPendientes("mensualidad", "pago_mensualidad", $_POST["idPropietario"], "1900-01-01");

            // Si hay mensualidades pendientes más antiguas, mostrar alerta
            if ($mensualidadesPendientes && $mensualidadesPendientes[0]["id"] < $idMensualidad) {
                echo '<script>
                    swal({
                        type: "warning",
                        title: "Debe pagar primero las mensualidades más antiguas",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function() {
                        // Redireccionar a la página de pagos
                        window.location.href = "pagosmensual"; // Aquí puedes cambiar la URL según sea necesario
                    });
                    </script>';
                return;
            }


            // Preparar los datos para guardar en pago_mensualidad
            $datos = array(
                "fecha_periodo" => $_POST["fechaPeriodo"],  // Se guarda la fecha del periodo
                "costo_periodo" => $montoPeriodo,  // Se guarda el costo del periodo
                "id_propietario" => $_POST["idPropietario"],
                "id_usuario" => $_SESSION["id"],  // ID del usuario que está registrando el pago
                "id_mensualidad" => $idMensualidad
            );

            // Llamar al modelo para crear el pago
            $idPago = ModeloPagoMensualidades::mdlCrearPagoMensualidad("pago_mensualidad", $datos);
            print_r($idPago);
            if ($idPago) {
                echo '<script>
                swal({
                    type: "success",
                    title: "Pago realizado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
                        window.open("extensiones/TCPDF-main/pdf/comprobante.php?idPago=' . $idPago . '", "_blank");
                        window.location = "pagosmensual";
                    }
                });
            </script>';
            } else {
                echo '<script>
                swal({
                    type: "error",
                    title: "Hubo un error al realizar el pago",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                });
            </script>';
            }
        }
    }
}
