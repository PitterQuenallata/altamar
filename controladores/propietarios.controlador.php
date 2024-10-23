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

          // Validar que los campos contienen solo letras y números
          if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoNombre"]) &&
              preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoApellido"]) &&
              preg_match('/^[0-9]+$/', $_POST["nuevoNroCarnet"]) &&
              preg_match('/^[0-9]+$/', $_POST["nuevoTelefono"])
              ) {

              $tabla = "propietario";
              $datos = array(
                  "idusuario" => $_POST["idusuario"],
                  "nombre" => $_POST["nuevoNombre"],
                  "apellido" => $_POST["nuevoApellido"],
                  "nroCarnet" => $_POST["nuevoNroCarnet"],
                  "telefono" => $_POST["nuevoTelefono"],
                  "correo" => $_POST["nuevoCorreo"],
                  "actividad" => $_POST["nuevaActividad"],
                  "nroDpto" => $_POST["nuevoNroDpto"]
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
                      title: "¡Los datos del propietario no pueden ir vacíos o llevar caracteres especiales!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                  }).then(function(result){
                      if (result.value) {
                          window.location = "propietarios";
                      }
                  });
              </script>';
              echo '<div class="alert alert-danger">Los datos del propietario no pueden ir vacíos o llevar caracteres especiales</div>';
              return;
          }
      }
  }


/*=============================================
    EDITAR PROPIETARIO
    =============================================*/
    public function ctrEditarPropietario() {
      if (isset($_POST["editarNombre"])) {

          // Validar que los campos contienen solo letras y números
          if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarNombre"]) &&
              preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarApellido"]) &&
              preg_match('/^[0-9]+$/', $_POST["editarNroCarnet"]) &&
              preg_match('/^[0-9]+$/', $_POST["editarTelefono"]) &&
              filter_var($_POST["editarCorreo"], FILTER_VALIDATE_EMAIL)) {

              $tabla = "propietario";
              $datos = array(
                  "id" => $_POST["idPropietario"],
                  "idusuario" => $_POST["idUsuario"],
                  "nombre" => $_POST["editarNombre"],
                  "apellido" => $_POST["editarApellido"],
                  "nroCarnet" => $_POST["editarNroCarnet"],
                  "telefono" => $_POST["editarTelefono"],
                  "correo" => $_POST["editarCorreo"],
                  "actividad" => $_POST["editarActividad"],
                  "nroDpto" => $_POST["editarNroDpto"]
              );

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
                      title: "¡Los datos del propietario no pueden ir vacíos o llevar caracteres especiales!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                  }).then(function(result){
                      if (result.value) {
                          window.location = "propietarios";
                      }
                  });
              </script>';
              echo '<div class="alert alert-danger">Los datos del propietario no pueden ir vacíos o llevar caracteres especiales</div>';
              return;
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
