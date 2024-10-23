<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pago de Mensualidades</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Pago de Mensualidades</li>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPago">
          Agregar Pago
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
        <table id="pagosMensuales" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre del Propietario</th>
              <th>Apellido</th>
              <th>Carnet</th>
              <th>Teléfono</th>
              <th>Monto</th>
              <th>Estado</th>
              <th>Fecha</th>
              <th>Usuario que Registró</th>
              <th>Acciones</th>
            </tr> 
          </thead>
          <tbody>
            <?php
            $item = null;
            $valor = null;

            $pagos = ControladorPagoMensualidades::ctrMostrarPagosMensualidades($item, $valor);

            foreach ($pagos as $key => $value) {
              echo '<tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value["nombre_propietario"].'</td>
                      <td>'.$value["apellido_propietario"].'</td>
                      <td>'.$value["nroCarnet"].'</td>
                      <td>'.$value["telefono"].'</td>
                      <td>'.$value["monto"].'</td>
                      <td>'.($value["estado"] == 1 ? "Pagado" : "No Pagado").'</td>
                      <td>'.$value["fecha"].'</td>
                      <td>'.$value["nombre_usuario"].'</td>
                      <td>
                        <button class="btn btn-info btnImprimirPago" idPago="'.$value["id"].'"><i class="fa fa-print"></i></button>
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
MODAL AGREGAR PAGO
======================================-->

<div id="modalAgregarPago" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- Cabeza del modal -->
        <div class="modal-header">
          <h5 class="modal-title">Agregar Pago de Mensualidad</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body">
          <!-- Campo oculto para el ID del usuario que registra -->
          <input type="hidden" name="idUsuarioRegistro" value="<?php echo $_SESSION['id']; ?>">

          <div class="form-group">
            <!-- Selección del propietario -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <select class="form-control input-lg" name="idPropietario" required>
                <option value="">Seleccionar propietario</option>
                <?php
                $propietarios = ControladorPropietarios::ctrMostrarPropietarios(null, null);
                foreach ($propietarios as $propietario) {
                  echo '<option value="'.$propietario["id"].'">'.$propietario["nombre"].' '.$propietario["apellido"].'</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para el monto -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoMonto" placeholder="Ingresar monto" required>
            </div>
          </div>

          <div class="form-group">
            <!-- Entrada para la fecha -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              </div>
              <input type="date" class="form-control input-lg" name="nuevaFecha" placeholder="Ingresar fecha" required>
            </div>
          </div>
        </div>

        <!-- Pie del modal -->
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar pago</button>
        </div>

        <?php
          // Llamada al controlador para agregar un nuevo pago de mensualidad
          if (isset($_POST['nuevoMonto'])) {
              $crearPago = new ControladorPagoMensualidades();
              $crearPago->ctrCrearPagoMensualidad();
          }
        ?>
      </form>
    </div>
  </div>
</div>

