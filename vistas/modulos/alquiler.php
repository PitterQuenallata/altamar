<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Alquilar Áreas Sociales</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Alquilar Áreas Sociales</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Agregar Alquiler</h3>
            </div>
            <form id="formAgregarAlquiler" method="post">
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $_SESSION['nombre']; ?>" readonly>
                    <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $_SESSION['id']; ?>">
                  </div>
                  <div class="form-group col-md-8">
                    <label for="agregarPropietario">Propietario</label>
                    <div class="input-group">
                      <select class="custom-select rounded-0" id="agregarPropietario" name="agregarPropietario" required>
                        <?php
                        // Incluir el controlador de propietarios
                        require_once "controladores/propietarios.controlador.php";
                        // Obtener la lista de propietarios
                        $propietarios = ControladorPropietarios::ctrMostrarPropietarios(null, null);
                        foreach ($propietarios as $propietario) {
                          echo '<option value="' . $propietario["id"] . '">' . $propietario["nombre"] . " " . $propietario['apellido'] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="fechaInicio">Fecha Inicio</label>
                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="fechaFinal">Fecha Final</label>
                    <input type="date" class="form-control" id="fechaFinal" name="fechaFinal" required>
                  </div>
                </div>

                <h6>AREAS SOCIALES</h6>
                <div class="nuevoAlquiler"></div>

                <div class="form-group text-center">
                  <label for="total">Total</label>
                  <input type="text" id="total" name="total" class="form-control text-center" readonly>
                </div>
              </div>
              <input type="hidden" id="listaAreas" name="listaAreas">

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Agregar</button>
              </div>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if (isset($_POST['listaAreas'])) {
                $guardarAlquiler = new ControladorAlquiler();
                $guardarAlquiler->ctrCrearAlquiler();
              }
            }
            ?>
          </div>
        </div>
        <div class="col-md-7">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarAreaSocial">
                Agregar Área Social
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
              <table id="tablaAreasAlquiler" class="table table-bordered table-hover table-striped tablaAreasAlquiler">
                <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Aquí se llenarán los datos mediante AJAX -->
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!--=====================================
MODAL AGREGAR ÁREA SOCIAL
======================================-->

<div id="modalAgregarAreaSocial" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header">
          <h5 class="modal-title">Agregar Área Social</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="form-group">
            <!-- ENTRADA PARA LA DESCRIPCIÓN -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-building"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>
            </div>
          </div>
          <div class="form-group">
            <!-- ENTRADA PARA EL PRECIO -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
              </div>
              <input type="number" class="form-control input-lg" name="nuevoPrecio" step="0.01" placeholder="Ingresar precio" required>
            </div>
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar área social</button>
        </div>

        <?php
        $crearAreaSocial = new ControladorAreasSociales();
        $crearAreaSocial->ctrCrearAreaSocial();
        ?>

      </form>
    </div>
  </div>
</div>