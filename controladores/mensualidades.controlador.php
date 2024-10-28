<?php
class ControladorMensualidades
{

    /*=============================================
    mostar mensualidades
=============================================*/
    public static function ctrMostrarMensualidades($item, $valor)
    {
        $tabla = "mensualidad";
        $respuesta = ModeloMensualidades::mdlMostrarMensualidades($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    CREAR MENSUALIDAD
    =============================================*/
    static public function ctrCrearMensualidad()
    {
        if (isset($_POST["nuevoMes"])) {

            // Validamos que los campos no estén vacíos y contengan datos válidos
            if (
                preg_match('/^[0-9]+$/', $_POST["nuevoMes"]) &&
                preg_match('/^[0-9]{4}$/', $_POST["nuevaGestion"]) &&
                preg_match('/^[0-9.]+$/', $_POST["nuevoCosto"])
            ) {

                $tabla = "mensualidad";
                $mes = $_POST["nuevoMes"];
                $gestion = $_POST["nuevaGestion"];

                // Verificar si ya existe el mes y la gestión en la base de datos
                $existe = ModeloMensualidades::mdlVerificarMensualidadExistente($tabla, $mes, $gestion);

                if ($existe) {
                    echo '<script>
                    swal({
                        type: "error",
                        title: "¡Ya existe una mensualidad registrada para este mes y año!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "mensualidad";
                        }
                    });
                </script>';
                    return; // Salir de la función si ya existe
                }

                // Si no existe, proceder a crear la nueva mensualidad
                $datos = array(
                    "mes" => $mes,
                    "gestion" => $gestion,
                    "costo" => $_POST["nuevoCosto"]
                );

                // Llamamos al modelo para guardar los datos
                $respuesta = ModeloMensualidades::mdlCrearMensualidad($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                    swal({
                        type: "success",
                        title: "¡La mensualidad ha sido guardada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "mensualidad";
                        }
                    });
                </script>';
                }
            } else {
                echo '<script>
                swal({
                    type: "error",
                    title: "¡Los campos no pueden ir vacíos o contener caracteres no válidos!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result) {
                    if (result.value) {
                        window.location = "mensualidad";
                    }
                });
            </script>';
            }
        }
    }



    /*=============================================
    EDITAR MENSUALIDAD
    =============================================*/
    static public function ctrEditarMensualidad()
    {

        if (isset($_POST["editarMes"])) {

            // Validamos los campos
            if (
                preg_match('/^[0-9]+$/', $_POST["editarMes"]) &&
                preg_match('/^[0-9]{4}$/', $_POST["editarGestion"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarCosto"])
            ) {

                // Datos a enviar al modelo
                $tabla = "mensualidad";

                $datos = array(
                    "id" => $_POST["idMensualidad"],
                    "mes" => $_POST["editarMes"],
                    "gestion" => $_POST["editarGestion"],
                    "costo" => $_POST["editarCosto"]
                );

                // Llamamos al modelo para actualizar los datos
                $respuesta = ModeloMensualidades::mdlEditarMensualidad($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                      swal({
                          type: "success",
                          title: "¡La mensualidad ha sido actualizada correctamente!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                      }).then(function(result) {
                          if (result.value) {
                              window.location = "mensualidad";
                          }
                      });
                  </script>';
                }
            } else {
                echo '<script>
                  swal({
                      type: "error",
                      title: "¡Los campos no pueden ir vacíos o contener caracteres no válidos!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                  }).then(function(result) {
                      if (result.value) {
                          window.location = "mensualidad";
                      }
                  });
              </script>';
            }
        }
    }

    /*=============================================
    ELIMINAR MENSUALIDAD
    =============================================*/
    public function ctrBorrarMensualidad()
    {

        if (isset($_GET["idMensualidad"])) {

            $tabla = "mensualidad";
            $datos = $_GET["idMensualidad"];

            $respuesta = ModeloMensualidades::mdlBorrarMensualidad($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                  swal({
                      type: "success",
                      title: "¡La mensualidad ha sido eliminada correctamente!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                  }).then(function(result){
                      if (result.value) {
                          window.location = "mensualidad";
                      }
                  });
              </script>';
            }
        }
    }
}
