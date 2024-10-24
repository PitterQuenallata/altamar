<?php

class ControladorAreasSociales {

    /*=============================================
    MOSTRAR ÁREAS SOCIALES
    =============================================*/
    static public function ctrMostrarAreasSociales($item, $valor) {
        $tabla = "area_social";
        $respuesta = ModeloAreasSociales::mdlMostrarAreasSociales($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    CAMBIAR ESTADO ÁREA SOCIAL
    =============================================*/
    static public function ctrCambiarEstadoAreaSocial($id, $estado) {
        $tabla = "area_social";
        $datos = array("id" => $id, "estado" => $estado);
        $respuesta = ModeloAreasSociales::mdlCambiarEstadoAreaSocial($tabla, $datos);
        return $respuesta;
    }

     /*=============================================
    CREAR ÁREA SOCIAL
    =============================================*/
    static public function ctrCrearAreaSocial() {
      if (isset($_POST["nuevaDescripcion"])) {

          // Validar los datos de entrada
          if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
              preg_match('/^[0-9.]+$/', $_POST["nuevoPrecio"])) {
              
              $tabla = "area_social";
							$precioD = $_POST["nuevoPrecio"];
              $datos = array(
                  "descripcion" => $_POST["nuevaDescripcion"],
                  "precio" => $precioD,
              );
              print_r($datos);
              $respuesta = ModeloAreasSociales::mdlIngresarAreaSocial($tabla, $datos);

              if ($respuesta == "ok") {
                  echo '<script>
                      swal({
                          type: "success",
                          title: "¡El área social ha sido guardada correctamente!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                      }).then(function(result){
                          if (result.value) {
                              window.location = "areaSocial";
                          }
                      });
                  </script>';
              }
          } else {
              echo '<script>
                  swal({
                      type: "error",
                      title: "¡La descripción no puede ir vacía o llevar caracteres especiales y el precio debe ser un número!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                  }).then(function(result){
                      if (result.value) {
                          window.location = "areaSocial";
                      }
                  });
              </script>';
          }
      }
  }


  /*=============================================
EDITAR ÁREA SOCIAL
=============================================*/
static public function ctrEditarAreaSocial() {
  if (isset($_POST["editarDescripcion"])) {

      // Validar los datos de entrada
      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
          preg_match('/^[0-9.]+$/', $_POST["editarPrecio"])) {

          $tabla = "area_social";

          $datos = array(
              "id" => $_POST["idAreaSocial"],
              "descripcion" => $_POST["editarDescripcion"],
              "precio" => $_POST["editarPrecio"]
          );

          $respuesta = ModeloAreasSociales::mdlEditarAreaSocial($tabla, $datos);

          if ($respuesta == "ok") {
              echo '<script>
                  swal({
                      type: "success",
                      title: "¡El área social ha sido actualizada correctamente!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                  }).then(function(result){
                      if (result.value) {
                          window.location = "areaSocial";
                      }
                  });
              </script>';
          }
      } else {
          echo '<script>
              swal({
                  type: "error",
                  title: "¡La descripción no puede ir vacía o llevar caracteres especiales y el precio debe ser un número!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {
                      window.location = "areaSocial";
                  }
              });
          </script>';
      }
  }
}

/*=============================================
ELIMINAR ÁREA SOCIAL
=============================================*/
static public function ctrEliminarAreaSocial() {
  if (isset($_POST["idAreaSocialEliminar"])) {
      $tabla = "area_social";
      $datos = $_POST["idAreaSocialEliminar"];
      
      $respuesta = ModeloAreasSociales::mdlEliminarAreaSocial($tabla, $datos);

      if ($respuesta == "ok") {
          echo '<script>
              swal({
                  type: "success",
                  title: "¡El área social ha sido eliminada correctamente!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {
                      window.location = "areaSocial";
                  }
              });
          </script>';
      }
  }
}

}
?>
