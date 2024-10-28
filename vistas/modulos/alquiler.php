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
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-5">

          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Agregar Alquiler</h3>
                </div>

                <form id="formAgregarAlquiler" method="post">
                  <div class="card-body">
                    <!-- Selección del Propietario -->
                    <div class="form-group">
                      <!-- Selección del propietario -->
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <select class="form-control input-lg" name="idPropietarioReserva" required>
                          <option value="">Seleccionar propietario</option>
                          <?php
                          $propietarios = ControladorPropietarios::ctrMostrarPropietarios(null, null);
                          foreach ($propietarios as $propietario) {
                            echo '<option value="' . $propietario["id"] . '">'
                              . mb_strtoupper($propietario["nombre"], 'UTF-8') . ' '
                              . mb_strtoupper($propietario["apellido_paterno"], 'UTF-8') . ' '
                              . mb_strtoupper($propietario["apellido_materno"], 'UTF-8')
                              . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <!-- Selección de Fechas y Horas -->
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="fechaInicio">Fecha Inicio</label>
                        <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="horaInicio">Hora Inicio</label>
                        <input type="time" class="form-control" id="horaInicio" name="horaInicio" required>
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="fechaFinal">Fecha Final</label>
                        <input type="date" class="form-control" id="fechaFinal" name="fechaFinal" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="horaFinal">Hora Final</label>
                        <input type="time" class="form-control" id="horaFinal" name="horaFinal" required>
                      </div>
                    </div>

                    <button type="button" class="btn btn-success" id="buscarAreasDisponibles">Buscar Áreas Disponibles</button>

                    <!-- Áreas Seleccionadas -->
                    <h6 class="mt-3">Áreas Seleccionadas</h6>
                    <div class="listaAreasSeleccionadas"></div>

                    <div class="form-group text-center mt-3">
                      <label for="total">Total</label>
                      <input type="text" id="total" name="total" class="form-control text-center" readonly>
                    </div>

                    <input type="hidden" id="listaAreas" name="listaAreas">
                  </div>
                  
                  <input type="hidden" id="listaAreasSeleccionadas" name="listaAreasSeleccionadas">


                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                  </div>

                  <?php
                    // Llamada al controlador para agregar un nuevo pago de mensualidad
                    if (isset($_POST['listaAreasSeleccionadas'])) {
                      $GuardarReserva = new ControladorReservasAreaSocial();
                      $GuardarReserva->ctrGuardarReserva();
                    }
                    ?>
                </form>
              </div>
            </div>
          </div>

          <!-- Contenedor para mostrar las áreas sociales ocupadas -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Áreas Sociales Ocupadas para la Fecha</h3>
                </div>
                <div class="card-body p-0">
                  <ul class="list-group" id="listaAreasOcupadas">
                    <!-- Contenido dinámico cargado por AJAX -->
                  </ul>
                </div>
              </div>
            </div>
          </div>

        </div>




        <div class="col-md-7">
          <!-- Tabla de Áreas Sociales -->
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Áreas Sociales Disponibles</h3>
                </div>
                <div class="card-body">
                  <table id="tablaAreasDisponibles" class="table table-sm table-hover table-striped">
                    <thead>
                      <tr>
                        <th style="width:10px">#</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Aquí se llenarán los datos mediante AJAX -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>





        </div>
      </div>
    </div>
  </section>
</div>