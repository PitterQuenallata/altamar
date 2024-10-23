<?php

class ControladorVisitas
{

  // Mostrar visitas
  public static function ctrMostrarVisitas($item, $valor)
  {
    $tabla = "visita";
    $respuesta = ModeloVisitas::mdlMostrarVisitas($tabla, $item, $valor);
    return $respuesta;
  }

  // Crear visita
  public static function ctrCrearVisita()
  {
    if (isset($_POST["nuevoNombre"])) {
      $tablaVisita = "visita";
      $tablaEntrada = "controlentrada";

      $datosVisita = array(
        "nombre" => $_POST["nuevoNombre"],
        "apellido" => $_POST["nuevoApellido"],
        "carnet" => $_POST["nuevoCarnet"],
        "nroDpto" => "" // Puedes ajustar esto si es necesario
      );

      // Insertar en la tabla visita
      $idVisita = ModeloVisitas::mdlIngresarVisita($tablaVisita, $datosVisita);

      // Verificar si se obtuvo el ID de la visita
      if ($idVisita) {
        $datosEntrada = array(
          "hora_entrada" => $_POST["nuevaEntrada"],
          "personas" => $_POST["nuevaCantidad"],
          "id_visita" => $idVisita,
          "id_propietario" => $_POST["nuevoPropietario"],
          "id_usuario" => $_SESSION["id"]
        );

        // Insertar en la tabla controlentrada
        $respuestaEntrada = ModeloEntrada::mdlIngresarEntrada($tablaEntrada, $datosEntrada);

        if ($respuestaEntrada == "ok") {
          echo '<script>
          swal({
            type: "success",
            title: "¡La visita ha sido guardada correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          }).then(function(result){
            if (result.value) {
              window.location = "visitas";
            }
          });
        </script>';
        } else {
          echo "Error al insertar en la tabla controlentrada: " . $respuestaEntrada; // Depuración
          echo '<script>
          swal({
            type: "error",
            title: "¡La visita no pudo ser guardada en la tabla de entradas!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          });
        </script>';
        }
      } else {
        echo "Error al insertar en la tabla visita: " . $idVisita; // Depuración
        echo '<script>
        swal({
          type: "error",
          title: "¡La visita no pudo ser guardada en la tabla de visitas!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
        });
      </script>';
      }
    }
  }

// Editar visita
public static function ctrEditarVisita() {
  if (isset($_POST["editarNombre"])) {
    $tablaVisita = "visita";
    $tablaEntrada = "controlentrada";

    $datosVisita = array(
      "id" => $_POST["editarIdVisita"],
      "nombre" => $_POST["editarNombre"],
      "apellido" => $_POST["editarApellido"],
      "carnet" => $_POST["editarCarnet"],
      "nroDpto" => "" // Puedes ajustar esto si es necesario
    );

    $respuestaVisita = ModeloVisitas::mdlEditarVisita($tablaVisita, $datosVisita);

    if ($respuestaVisita == "ok") {
      $datosEntrada = array(
        "id" => $_POST["editarIdVisita"],
        "hora_entrada" => $_POST["editarEntrada"],
        "personas" => $_POST["editarCantidad"],
        "id_propietario" => $_POST["editarPropietario"]
      );

      $respuestaEntrada = ModeloEntrada::mdlEditarEntrada($tablaEntrada, $datosEntrada);

      if ($respuestaEntrada == "ok") {
        echo '<script>
          swal({
            type: "success",
            title: "¡La visita ha sido actualizada correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          }).then(function(result){
            if (result.value) {
              window.location = "visitas";
            }
          });
        </script>';
      } else {
        echo '<script>
          swal({
            type: "error",
            title: "¡La visita no pudo ser actualizada en la tabla de entradas!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          });
        </script>';
      }
    } else {
      echo '<script>
        swal({
          type: "error",
          title: "¡La visita no pudo ser actualizada en la tabla de visitas!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
        });
      </script>';
    }
  }
}
}
