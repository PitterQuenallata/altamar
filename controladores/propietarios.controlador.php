<?php

class ControladorPropietarios {

  // Mostrar propietarios
  public static function ctrMostrarPropietarios($item, $valor) {
    $tabla = "propietario";
    $respuesta = ModeloPropietarios::mdlMostrarPropietarios($tabla, $item, $valor);
    return $respuesta;
  }


/*=============================================
    CREAR PROPIETARIO
=============================================*/
public function ctrCrearPropietario() {
    if (isset($_POST["nuevoNombre"])) {

        // Primero, verificar si el nroCarnet ya está registrado
        $tabla = "propietario";
        $item = "nroCarnet";
        $valor = $_POST["nuevoNroCarnet"];

        $propietarioExistente = ModeloPropietarios::mdlMostrarPropietarios($tabla, $item, $valor);

        if ($propietarioExistente) {
            // Si se encuentra un propietario con el mismo nroCarnet, mostrar una alerta
            echo '<script>
                    swal({
                        type: "error",
                        title: "¡El propietario ya está registrado con este número de carnet!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "propietarios";
                        }
                    });
                </script>';
            return; // Salir del método si el nroCarnet ya existe
        }

        // Validar que los campos contienen solo letras, espacios, y números donde corresponda
        if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellidoPaterno"]) &&
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellidoMaterno"]) &&
            preg_match('/^[0-9]+$/', $_POST["nuevoNroCarnet"]) &&
            preg_match('/^[0-9]+$/', $_POST["nuevoTelefono"])
        ) {
            // Convertir los nombres y apellidos a minúsculas, preservando los caracteres especiales
            $nombre = mb_strtolower($_POST["nuevoNombre"], 'UTF-8');
            $apellidoPaterno = mb_strtolower($_POST["nuevoApellidoPaterno"], 'UTF-8');
            $apellidoMaterno = mb_strtolower($_POST["nuevoApellidoMaterno"], 'UTF-8');

            $datos = array(
                "id_usuario" => $_POST["idUsuario"],
                "nombre" => $nombre,
                "apellido_paterno" => $apellidoPaterno,
                "apellido_materno" => $apellidoMaterno,
                "nroCarnet" => $_POST["nuevoNroCarnet"],
                "telefono" => $_POST["nuevoTelefono"],
                "correo" => $_POST["nuevoCorreo"],
                "nroDpto" => $_POST["nuevoNroDpto"],
            );

            $respuesta = ModeloPropietarios::mdlIngresarPropietario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡El propietario ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "propietarios";
                        }
                    });
                </script>';
            }
        } else {
            echo '<script>
                swal({
                    type: "error",
                    title: "¡Los datos del propietario no pueden ir vacíos o llevar caracteres especiales inválidos!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
                        window.location = "propietarios";
                    }
                });
            </script>';
            echo '<div class="alert alert-danger">Los datos del propietario no pueden ir vacíos o llevar caracteres especiales inválidos</div>';
            return;
        }
    }
}




/*=============================================
    EDITAR PROPIETARIO
=============================================*/
public function ctrEditarPropietario() {
    if (isset($_POST["editarNombre"])) {

        // Validar que los campos contienen solo letras, espacios, y números donde corresponda
        if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidoPaterno"]) &&
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidoMaterno"]) &&
            preg_match('/^[0-9]+$/', $_POST["editarNroCarnet"]) &&
            preg_match('/^[0-9]+$/', $_POST["editarTelefono"])
        ) {
            // Convertir los nombres y apellidos a minúsculas, preservando los caracteres especiales
            $nombre = mb_strtolower($_POST["editarNombre"], 'UTF-8');
            $apellidoPaterno = mb_strtolower($_POST["editarApellidoPaterno"], 'UTF-8');
            $apellidoMaterno = mb_strtolower($_POST["editarApellidoMaterno"], 'UTF-8');

            $tabla = "propietario";
            $datos = array(
                "id_usuario" => $_POST["idUsuario"],
                "id" => $_POST["idPropietario"],
                "nombre" => $nombre,
                "apellido_paterno" => $apellidoPaterno,
                "apellido_materno" => $apellidoMaterno,
                "nroCarnet" => $_POST["editarNroCarnet"],
                "telefono" => $_POST["editarTelefono"],
                "correo" => $_POST["editarCorreo"],
                "nroDpto" => $_POST["editarNroDpto"]
            );
            //print_r($datos);

            $respuesta = ModeloPropietarios::mdlEditarPropietario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡El propietario ha sido editado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "propietarios";
                        }
                    });
                </script>';
            }
        } else {
            echo '<script>
                swal({
                    type: "error",
                    title: "¡Los datos del propietario no pueden ir vacíos o llevar caracteres especiales inválidos!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
                        window.location = "propietarios";
                    }
                });
            </script>';
        }
    }
}


      /*=============================================
    ELIMINAR PROPIETARIO
    =============================================*/
    public function ctrBorrarPropietario() {
      if (isset($_GET["idPropietario"])) {
          $tabla = "propietario";
          $datos = $_GET["idPropietario"];

          $respuesta = ModeloPropietarios::mdlBorrarPropietario($tabla, $datos);

          if ($respuesta == "ok") {
              echo '<script>
                  swal({
                      type: "success",
                      title: "¡El propietario ha sido eliminado correctamente!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                  }).then(function(result){
                      if (result.value) {
                          window.location = "propietarios";
                      }
                  });
              </script>';
          }
      }
  }
}
?>
