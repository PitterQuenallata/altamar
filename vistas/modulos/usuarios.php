<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar Usuarios</li>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          Agregar Usuario
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
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Correo</th>
              <th>Usuario</th>
              <th>Rol</th>
              <th>Telefono</th>
              <th>Estado</th>
              <th>Último login</th>
              <th>Acciones</th>
            </tr> 
          </thead>
          <tbody>
            <?php
            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            foreach ($usuarios as $key => $value) {
              echo '<tr>
                      <td>'.($key+1).'</td>
                      <td>'.mb_strtoupper($value["nombre"], 'UTF-8').'</td>
                      <td>'.mb_strtoupper($value["apellido_paterno"], 'UTF-8').' '.mb_strtoupper($value["apellido_materno"], 'UTF-8').'</td>
                      <td>'.mb_strtoupper($value["correo"], 'UTF-8').'</td>
                      <td>'.$value["usuario"].'</td>
                      <td>'.$value["rol"].'</td>
                      <td>'.$value["telefono"].'</td>
                      <td>'.$value["estado"].'</td>
                      <td>'.$value["ultimo_login"].'</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil-alt"></i></button>
                          <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'"><i class="fa fa-trash-alt"></i></button>
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
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header">
          <h5 class="modal-title">Agregar usuario</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="form-group">
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombres" required style="text-transform: uppercase;" oninput="validateJS(event, 'text')">
              <div class="invalid-feedback"></div> <!-- Para mostrar los mensajes de error -->
            </div>
          </div>

          <div class="form-group">
            <!-- ENTRADA PARA EL APELLIDO -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoApellido" placeholder="Ingresar apellido paterno" required style="text-transform: uppercase;" oninput="validateJS(event, 'text')">
              <div class="invalid-feedback"></div>
            </div>
          </div>

          <div class="form-group">
            <!-- ENTRADA PARA EL APELLIDO MATERNO-->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoApellidoMaterno" placeholder="Ingresar apellido materno" required style="text-transform: uppercase;" oninput="validateJS(event, 'text')">
              <div class="invalid-feedback"></div>
            </div>
          </div>

          <div class="form-group">
            <!-- ENTRADA PARA EL USUARIO -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-key"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required oninput="validateJS(event, 'text')">
              <div class="invalid-feedback"></div>
            </div>
          </div>

          <div class="form-group">
            <!-- ENTRADA PARA LA CONTRASEÑA -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
              </div>
              <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required oninput="validateJS(event, 'password')">
              <div class="invalid-feedback"></div>
            </div>
          </div>


          <div class="form-group">
            <!-- ENTRADA PARA SELECCIONAR SU ROL -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-users"></i></span>
              </div>
              <select class="form-control input-lg" name="nuevoRol" required>
                <option value="">Seleccionar rol</option>
                <option value="administrador">Administrador</option>
                <option value="guardia">Guardia</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-phone"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar nro. celular" required onchange="validateJS(event, 'phone')">
              <div class="invalid-feedback"></div>
            </div>
          </div>

          <div class="form-group">
            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              </div>
              <input type="email" class="form-control input-lg" name="nuevoCorreo"  onchange="validateJS(event, 'email')" placeholder="Ingresar correo">
              <div class="invalid-feedback"></div>
            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar usuario</button>
        </div>

        <?php
          // Lógica para agregar un nuevo usuario
          if (isset($_POST['nuevoNombre'])) {
              $crearUsuario = new ControladorUsuarios();
              $crearUsuario->ctrCrearUsuario();
          }
        ?>
      </form>
    </div>
  </div>
</div>






<!--=====================================
MODAL EDITAR USUARIO
======================================-->
<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header">
          <h5 class="modal-title">Editar usuario</h5>
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
              <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" placeholder="Ingresar nombre" required style="text-transform: uppercase;" oninput="validateJS(event, 'text')">
              <input type="hidden" name="idUsuario" id="idUsuario">
            </div>
          </div>

          <!-- ENTRADA PARA EL APELLIDO -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="editarApellido" id="editarApellido" placeholder="Ingresar apellido paterno" required style="text-transform: uppercase;" oninput="validateJS(event, 'text')">
            </div>
          </div>

          <!-- ENTRADA PARA EL APELLIDO MATERNO -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="editarApellidoMaterno" id="editarApellidoMaterno" placeholder="Ingresar apellido materno" required style="text-transform: uppercase;" oninput="validateJS(event, 'text')">
            </div>
          </div>

          <!-- ENTRADA PARA EL USUARIO -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-key"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="editarUsuario" id="editarUsuario" placeholder="Ingresar usuario" readonly>
            </div>
          </div>

          <!-- ENTRADA PARA EL TELEFONO -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-phone"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar nro. celular" required onchange="validateJS(event, 'phone')">
            </div>
          </div>

          <!-- ENTRADA PARA EL CORREO ELECTRÓNICO -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              </div>
              <input type="email" class="form-control input-lg" name="editarCorreo" id="editarCorreo" placeholder="Ingresar correo electrónico">
            </div>
          </div>

          <!-- ENTRADA PARA SELECCIONAR SU ROL -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-users"></i></span>
              </div>
              <select class="form-control input-lg" name="editarRol" id="editarRol" required>
                <option value="">Seleccionar rol</option>
                <option value="administrador">Administrador</option>
                <option value="guardia">Guardia</option>
              </select>
            </div>
          </div>

          <!-- ENTRADA PARA SELECCIONAR ESTADO -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-toggle-on"></i></span>
              </div>
              <select class="form-control input-lg" name="editarEstado" id="editarEstado" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>

          <!-- ENTRADA PARA LA CONTRASEÑA -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
              </div>
              <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Ingresar nueva contraseña">
              <input type="hidden" name="passwordActual" id="passwordActual">
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
          // Lógica para editar un usuario
          if (isset($_POST['editarNombre'])) {
              $editarUsuario = new ControladorUsuarios();
              $editarUsuario->ctrEditarUsuario();
          }
        ?>
      </form>
    </div>
  </div>
</div>




<?php

  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();

?> 


