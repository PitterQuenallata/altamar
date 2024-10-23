<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Visitas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar Visita</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">

      <div class="card-header">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarVisita">
          Agregar Visita
        </button>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>

      <div class="card-body">
        <table class="table table-bordered table-hover table-striped example2 tablas">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Carnet</th>
              <th>Propietario</th>
              <th>Personas</th>
              <th>Fecha y hora de Ingreso</th>
              <th>Hora de Salida</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $item = null;
            $valor = null;
            $entradas = ControladorEntrada::ctrMostrarEntrada($item, $valor);

            foreach ($entradas as $key => $ent) {
              // Obtener información de la visita
              $visita = ControladorVisitas::ctrMostrarVisitas("id", $ent["id_visita"]);
              // Obtener información del propietario
              $propietario = ControladorPropietarios::ctrMostrarPropietarios("id", $ent["id_propietario"]);
              if ($visita && $propietario) {
                $nombrePropietario = $propietario["nombre"] . ' ' . $propietario["apellido"];
                echo '<tr>
                <td>' . ($key + 1) . '</td>
                <td>' . $visita["nombre"] . '</td>
                <td>' . $visita["apellido"] . '</td>
                <td>' . $visita["carnet"] . '</td>
                <td>' . $nombrePropietario . '</td>
                <td>' . $ent["personas"] . '</td>
                <td>' . $ent["hora_entrada"] . '</td>
                <td>' . ($ent["hora_salida"] ? $ent["hora_salida"] : 'No marcada') . '</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-success marcarSalida" idSalida="' . $ent["id"] . '">Marcar Salida</button>
                    <button class="btn btn-warning btnEditarVisita" data-toggle="modal" data-target="#modalEditarVisita" idVisita="' . $ent["id"] . '">Editar</button>
                  </div>
                </td>
              </tr>';
              } else {
                echo '<tr>
                <td>' . ($key + 1) . '</td>
                <td colspan="8">Datos de la visita o propietario no disponibles</td>
              </tr>';
              }
            }
            ?>
          </tbody>
        </table>







      </div>
      <!-- /.card-body -->

    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
    <!--=====================================
  MODAL AGREGAR VISITA
  ======================================-->

  <div id="modalAgregarVisita" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
          <div class="modal-header">
            <h5 class="modal-title">Agregar Visita</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
          <div class="modal-body">
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
              </div>
            </div>
            <!-- ENTRADA PARA EL APELLIDO -->
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" class="form-control input-lg" name="nuevoApellido" placeholder="Ingresar apellido" required>
              </div>
            </div>
            <!-- ENTRADA PARA EL CARNET -->
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                </div>
                <input type="number" class="form-control input-lg" name="nuevoCarnet" placeholder="Ingresar carnet" required>
              </div>
            </div>
            <!-- ENTRADA PARA LA FECHA Y HORA DE ENTRADA -->
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="datetime-local" class="form-control input-lg" name="nuevaEntrada" required>
              </div>
            </div>
            <!-- ENTRADA PARA LA CANTIDAD DE PERSONAS -->
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-users"></i></span>
                </div>
                <input type="number" class="form-control input-lg" name="nuevaCantidad" placeholder="Cantidad de personas" required>
              </div>
            </div>
            <!-- ENTRADA PARA EL PROPIETARIO -->
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-home"></i></span>
                </div>
                <select class="form-control input-lg" name="nuevoPropietario" required>
                  <option value="">Seleccionar propietario</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $propietarios = ControladorPropietarios::ctrMostrarPropietarios($item, $valor);
                  foreach ($propietarios as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["nombre"] . ' ' . $value["apellido"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <!--=====================================
          PIE DEL MODAL
          ======================================-->
          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar visita</button>
          </div>
          <?php
          $crearVisita = new ControladorVisitas();
          $crearVisita->ctrCrearVisita();
          ?>
        </form>
      </div>
    </div>
  </div>


</div>
<!-- /.content-wrapper -->








<!--=====================================
MODAL EDITAR VISITA
======================================-->

<div id="modalEditarVisita" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header">
          <h5 class="modal-title">Editar Visita</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <!-- ENTRADA PARA EL NOMBRE -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="hidden" id="editarIdVisita" name="editarIdVisita">
              <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" required>
            </div>
          </div>
          <!-- ENTRADA PARA EL APELLIDO -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" id="editarApellido" name="editarApellido" required>
            </div>
          </div>
          <!-- ENTRADA PARA EL CARNET -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-id-card"></i></span>
              </div>
              <input type="number" class="form-control input-lg" id="editarCarnet" name="editarCarnet" required>
            </div>
          </div>
          <!-- ENTRADA PARA LA FECHA Y HORA DE ENTRADA -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              </div>
              <input type="datetime-local" class="form-control input-lg" id="editarEntrada" name="editarEntrada" required>
            </div>
          </div>
          <!-- ENTRADA PARA LA CANTIDAD DE PERSONAS -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-users"></i></span>
              </div>
              <input type="number" class="form-control input-lg" id="editarCantidad" name="editarCantidad" required>
            </div>
          </div>
          <!-- ENTRADA PARA EL PROPIETARIO -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-home"></i></span>
              </div>
              <select class="form-control input-lg" id="editarPropietario" name="editarPropietario" required>
                <option value="">Seleccionar propietario</option>
                <?php
                $item = null;
                $valor = null;
                $propietarios = ControladorPropietarios::ctrMostrarPropietarios($item, $valor);
                foreach ($propietarios as $key => $value) {
                  echo '<option value="' . $value["id"] . '">' . $value["nombre"] . ' ' . $value["apellido"] . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
        <?php
        $editarVisita = new ControladorVisitas();
        $editarVisita->ctrEditarVisita();
        ?>
      </form>
    </div>
  </div>
</div>


