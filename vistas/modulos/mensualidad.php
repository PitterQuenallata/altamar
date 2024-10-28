<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 text-center"> <!-- Cambiado a col-sm-12 para centrar -->
          <h1>Mensualidades</h1>
        </div>
        <div class="col-sm-12"> <!-- Breadcrumb alineado a la derecha -->
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Mensualidades</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row justify-content-center"> <!-- Alinea al centro horizontalmente -->
      <div class="col-md-8"> <!-- Ajuste del ancho de la tarjeta -->
        <div class="card">
          <div class="card-header"> <!-- Centrado del botón -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarMensualidad">
              Agregar Mensualidad
            </button>
          </div>
          <div class="card-body">
            <table id="mensualidades" class="table table-sm table-hover table-striped text-center"> <!-- Centrar contenido de la tabla -->
              <thead>
                <tr>
                  <th style="width:10px">#</th>
                  <th>Mes</th>
                  <th>Gestion</th>
                  <th>Costo</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $item = null;
                $valor = null;

                $mensualidades = ControladorMensualidades::ctrMostrarMensualidades($item, $valor);

                foreach ($mensualidades as $key => $value) {
                  echo '<tr>
                          <td>' . ($key + 1) . '</td>
                          <td>' . $value["mes"] . '</td>
                          <td>' . $value["gestion"] . '</td>
                          <td>' . $value["costo"] . '</td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-warning btnEditarMensualidad" data-id="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarMensualidad">
                                <i class="fa fa-pencil-alt"></i>
                              </button>
                              <button class="btn btn-danger btnEliminarMensualidad" data-id="' . $value["id"] . '">
                                <i class="fa fa-trash-alt"></i>
                              </button>
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
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!--=====================================
MODAL AGREGAR MENSUALIDAD
======================================-->
<!-- Modal Agregar Mensualidad -->
<div id="modalAgregarMensualidad" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- Cabeza del modal -->
        <div class="modal-header">
          <h5 class="modal-title">Agregar Mensualidad</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">

          <!-- Selector de mes con ícono -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              </div>
              <select class="form-control" name="nuevoMes" required>
                <option value="">Seleccionar mes</option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
              </select>
              <div class="invalid-feedback"></div> <!-- Mensaje de error -->
            </div>
          </div>


          <!-- Selector de gestión (año) con ícono -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
              </div>
              <select class="form-control" name="nuevaGestion" required>
                <option value="">Seleccionar año</option>
                <?php
                // Generar los próximos 5 años (desde el año actual hacia adelante)
                for ($i = date('Y'); $i <= date('Y') + 5; $i++) {
                  echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>
              </select>
              <div class="invalid-feedback"></div> <!-- Mensaje de error -->
            </div>
          </div>

          <!-- Entrada para el costo con ícono -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoCosto" placeholder="Ingresar costo" required onchange="validateJS(event, 'decimal')">
              <div class="invalid-feedback"></div> <!-- Mensaje de error -->
            </div>
          </div>

        </div>

        <input type="hidden" class="form-group" name="idUsuario" value="<?php echo $_SESSION['id']; ?>">

        <!-- Pie del modal -->
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Mensualidad</button>
        </div>

        <?php
        // Llamada al controlador para agregar una nueva mensualidad
        if (isset($_POST['nuevoMes'])) {
          $crearMensualidad = new ControladorMensualidades();
          $crearMensualidad->ctrCrearMensualidad();
        }
        ?>
      </form>
    </div>
  </div>
</div>



<!--=====================================
MODAL EDITAR MENSUALIDAD
======================================-->
<!-- Modal Editar Mensualidad -->
<div id="modalEditarMensualidad" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- Cabeza del modal -->
        <div class="modal-header">
          <h5 class="modal-title">Editar Mensualidad</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">

          <!-- Campo oculto para ID de la mensualidad -->
          <input type="hidden" id="idMensualidad" name="idMensualidad">

          <!-- Selector de mes con ícono -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              </div>
              <select class="form-control" id="editarMes" name="editarMes" required>
              <option value="">Seleccionar mes</option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
              </select>
              <div class="invalid-feedback"></div> <!-- Mensaje de error -->
            </div>
          </div>

          <!-- Selector de gestión (año) con ícono -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
              </div>
              <select class="form-control" id="editarGestion" name="editarGestion" required>
                <option value="">Seleccionar año</option>
                <?php
                // Generar los próximos 5 años (desde el año actual hacia adelante)
                for ($i = date('Y'); $i <= date('Y') + 5; $i++) {
                  echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>
              </select>
              <div class="invalid-feedback"></div> <!-- Mensaje de error -->
            </div>
          </div>

          <!-- Entrada para el costo con ícono -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
              </div>
              <input type="number" class="form-control input-lg" id="editarCosto" name="editarCosto" placeholder="Ingresar costo" required onchange="validateJS(event, 'decimal')">
              <div class="invalid-feedback"></div> <!-- Mensaje de error -->
            </div>
          </div>

        </div>

        <!-- Pie del modal -->
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

        <?php
        // Llamada al controlador para editar la mensualidad
        if (isset($_POST['editarMes'])) {
          $editarMensualidad = new ControladorMensualidades();
          $editarMensualidad->ctrEditarMensualidad();
        }
        ?>
      </form>
    </div>
  </div>
</div>

<?php
$borrarMensualidad = new ControladorMensualidades();
$borrarMensualidad->ctrBorrarMensualidad();
?>