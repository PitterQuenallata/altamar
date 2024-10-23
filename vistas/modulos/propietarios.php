<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Propietarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar Propietarios</li>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPropietario">
          Agregar Propietario
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
        <table id="" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Nro Carnet</th>
              <th>Teléfono</th>
              <th>Correo</th>
              <th>Actividad</th>
              <th>Nro Dpto</th>
              <th>Acciones</th>
            </tr> 
          </thead>
          <tbody>
            <?php
            $item = null;
            $valor = null;

            $propietarios = ControladorPropietarios::ctrMostrarPropietarios($item, $valor);

            foreach ($propietarios as $key => $value) {
              echo '<tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value["nombre"].'</td>
                      <td>'.$value["apellido"].'</td>
                      <td>'.$value["nroCarnet"].'</td>
                      <td>'.$value["telefono"].'</td>
                      <td>'.$value["correo"].'</td>
                      <td>'.$value["actividad"].'</td>
                      <td>'.$value["nroDpto"].'</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning btnEditarPropietario" idPropietario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPropietario"><i class="fa fa-pencil-alt"></i></button>
                          <button class="btn btn-danger btnEliminarPropietario" idPropietario="'.$value["id"].'"><i class="fa fa-trash-alt"></i></button>
                        </div>  
                      </td>
                    </tr>';
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
</div>
<!-- /.content-wrapper -->

<!--=====================================
MODAL AGREGAR PROPIETARIO
======================================-->
<!-- Modal Agregar Propietario -->
<div id="modalAgregarPropietario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- Cabeza del modal -->
        <div class="modal-header">
          <h5 class="modal-title">Agregar propietario</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <!-- Campo oculto para el ID del usuario que registra -->
          

          <div class="form-group">
            <!-- Entrada para el nombre -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para el apellido -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoApellido" placeholder="Ingresar apellido" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para el nro carnet -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-id-card"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoNroCarnet" placeholder="Ingresar nro carnet" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para el teléfono -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-phone"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para el correo -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
              </div>
              <input type="email" class="form-control input-lg" name="nuevoCorreo" placeholder="Ingresar correo" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para la actividad -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevaActividad" placeholder="Ingresar actividad" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para el nro dpto -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-building"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoNroDpto" placeholder="Ingresar nro dpto" required>
            </div>
          </div>
        </div>
        <input type="hidden" class="form-group" name="idusuario" value="<?php echo $_SESSION['id']; ?>">
        <!-- Pie del modal -->
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar propietario</button>
        </div>

        <?php
          // Llamada al controlador para agregar un nuevo propietario
          if (isset($_POST['nuevoNombre'])) {
              $crearPropietario = new ControladorPropietarios();
              $crearPropietario->ctrCrearPropietario();
          }
        ?>
      </form>
    </div>
  </div>
</div>


<!--=====================================
MODAL EDITAR PROPIETARIO
======================================-->
<!-- Modal Editar Propietario -->
<div id="modalEditarPropietario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- Cabeza del modal -->
        <div class="modal-header">
          <h5 class="modal-title">Editar propietario</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <!-- Campo oculto para el ID del propietario -->
          <input type="hidden" name="idPropietario" id="idPropietario">
          <input type="hidden" name="idUsuario" id="idUsuario">

          <div class="form-group">
            <!-- Entrada para el nombre -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" placeholder="Ingresar nombre" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para el apellido -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="editarApellido" id="editarApellido" placeholder="Ingresar apellido" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para el nro carnet -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-id-card"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="editarNroCarnet" id="editarNroCarnet" placeholder="Ingresar nro carnet" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para el teléfono -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-phone"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar teléfono" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para el correo -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
              </div>
              <input type="email" class="form-control input-lg" name="editarCorreo" id="editarCorreo" placeholder="Ingresar correo" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para la actividad -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="editarActividad" id="editarActividad" placeholder="Ingresar actividad" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para el nro dpto -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-building"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="editarNroDpto" id="editarNroDpto" placeholder="Ingresar nro dpto" required>
            </div>
          </div>
        </div>

        <!-- Pie del modal -->
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

        <?php
          // Llamada al controlador para editar un propietario
          if (isset($_POST['editarNombre'])) {
              $editarPropietario = new ControladorPropietarios();
              $editarPropietario->ctrEditarPropietario();
          }
        ?>
      </form>
    </div>
  </div>
</div>




<?php
  $borrarPropietario = new ControladorPropietarios();
  $borrarPropietario -> ctrBorrarPropietario();

?>
