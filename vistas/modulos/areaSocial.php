<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Áreas Sociales</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar Áreas Sociales</li>
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
        <table id="tablaAreasSociales" class="table table-bordered table-hover table-striped tablaAreasSociales">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Estado</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr> 
          </thead>
          <tbody>
            <?php
            $item = null;
            $valor = null;

            $areasSociales = ControladorAreasSociales::ctrMostrarAreasSociales($item, $valor);

            foreach ($areasSociales as $key => $value) {
              echo '<tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value["descripcion"].'</td>
                      <td>'.$value["precio"].'</td>';

              if ($value["estado"] == 0) {
                  echo '<td><button class="btn btn-danger btn-xs btnCambiarEstado" idAreaSocial="'.$value["id"].'" estadoAreaSocial="1">Inactivo</button></td>';
              } else {
                  echo '<td><button class="btn btn-success btn-xs btnCambiarEstado" idAreaSocial="'.$value["id"].'" estadoAreaSocial="0">Activo</button></td>';
              }

              echo '<td>'.$value["fecha"].'</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarAreaSocial" idAreaSocialEditar="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarAreaSocial"><i class="fa fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btnEliminarAreaSocial" idAreaSocialEliminar="'.$value["id"].'"><i class="fa fa-trash-alt"></i></button>
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
          $crearAreaSocial -> ctrCrearAreaSocial();
        ?>

      </form>
    </div>
  </div>
</div>


<!--=====================================
MODAL EDITAR ÁREA SOCIAL
======================================-->

<div id="modalEditarAreaSocial" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header">
          <h5 class="modal-title">Editar Área Social</h5>
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
              <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>
              <input type="hidden" id="idAreaSocial" name="idAreaSocial">
            </div>
          </div>
          <div class="form-group">
            <!-- ENTRADA PARA EL PRECIO -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
              </div>
              <input type="number" class="form-control input-lg" name="editarPrecio" id="editarPrecio" step="0.01" required>
            </div>
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

        <?php
          $editarAreaSocial = new ControladorAreasSociales();
          $editarAreaSocial -> ctrEditarAreaSocial();
        ?>

      </form>
    </div>
  </div>
</div>
