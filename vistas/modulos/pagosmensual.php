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
        <table id="pagosMensuales" class="table table-sm table-hover table-striped">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre del Propietario</th>
              <th>Carnet</th>
              <th>Periodo</th>
              <th>Monto</th>
              <th>Fecha</th>
              <th>Imprimir</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $listaPagosMensualidades = ControladorPagoMensualidades::ctrMostrarListaPagosMensualidades();

            $contador = 1; // Iniciar contador

            foreach ($listaPagosMensualidades as $pago) {
              echo '<tr>
                <td>' . $contador . '</td>
                <td>' .  mb_strtoupper($pago["nombre_completo"], 'UTF-8') . '</td>
                <td>' . $pago["carnet_propietario"] . '</td>
                <td>' . $pago["fecha_periodo"] . '</td>
                <td>' . $pago["monto_periodo"] . '</td>
                <td>' . $pago["fecha_creacion"] . '</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-info btn-sm btnImprimirPago" idPago="' . $pago["id"] . '"><i class="fa fa-print"></i></button>
                  </div>
                </td>
              </tr>';
              $contador++; // Incrementar el contador en cada iteración
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
                  echo '<option value="' . $propietario["id"] . '" data-fecha="' . $propietario["fecha"] . '">'
                    . mb_strtoupper($propietario["nombre"], 'UTF-8') . ' '
                    . mb_strtoupper($propietario["apellido_paterno"], 'UTF-8') . ' '
                    . mb_strtoupper($propietario["apellido_materno"], 'UTF-8')
                    . '</option>';
                }
                ?>
              </select>

            </div>
          </div>

          <div class="form-group">
            <!-- Selección del mensualidad -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
              </div>
              <select class="form-control input-lg" id="mensualidadesPendientes" name="idMensualidad" required>
                <option value="">Seleccione un propietario </option>
              </select>
            </div>
          </div>

          <!-- Campos ocultos para fecha y costo del periodo -->
          <input type="hidden" name="fechaPeriodo" value=""> <!-- Se rellenará con el formato '2024-04' -->
          <input type="hidden" name="costoPeriodo" value=""> <!-- Se rellenará con el costo de la mensualidad -->



          <div class="form-group">
            <!-- Entrada para el monto en base al periodo seleccionado -->
            <label for="">Costo mensual</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
              </div>
              <input type="number" class="form-control input-lg" name="montoPeriodo" placeholder="Monto del periodo" required readonly>
            </div>
          </div>

          <div class="form-group">
            <!-- Monto dado del cliente -->
            <label for="">Monto recibido</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
              </div>
              <input type="number" class="form-control input-lg" name="montoRecibido" placeholder="Monto recibido" required onchange="validateJS(event, 'decimal')">
              <div class="invalid-feedback"></div> <!-- Mensaje de error -->
            </div>
          </div>

          <div class="form-group">
            <!-- Monto de cambio o vuelto para el cliente -->
            <label for="">Cambio</label>
            <div class="input-group">

              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
              </div>
              <input type="number" class="form-control input-lg" name="montoCambio" placeholder="Monto de cambio" required readonly>
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
        if (isset($_POST['montoRecibido'])) {
          $crearPago = new ControladorPagoMensualidades();
          $crearPago->ctrCrearPagoMensualidad();
        }
        ?>
      </form>
    </div>
  </div>
</div>