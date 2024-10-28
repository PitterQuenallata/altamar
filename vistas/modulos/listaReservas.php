<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Lista Reservas de Área Social</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Lista de Reservas</li>
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
        <a href="alquiler" class="btn btn-primary">
          Agregar Reserva
        </a>
      </div>


      <div class="card-body">
        <table id="reservas" class="table table-sm table-hover table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre del Propietario</th>
              <th>Carnet</th>
              <th>Área Social</th>
              <th>Fecha de Inicio</th>
              <th>Fecha de Fin</th>
              <th>Hora de Inicio</th>
              <th>Hora de Fin</th>
              <th>Costo</th>
              <th>Imprimir</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $reservas = ControladorReservasAreaSocial::ctrMostrarReservas();

            foreach ($reservas as $key => $reserva) {
              echo '<tr>
                      <td>' . ($key + 1) . '</td>
                      <td>' . mb_strtoupper($reserva["nombre_completo"], 'UTF-8') . '</td>
                      <td>' . $reserva["nroCarnet"] . '</td>
                      <td>' . $reserva["descripcion_area"] . '</td>
                      <td>' . $reserva["fecha_inicio"] . '</td>
                      <td>' . $reserva["fecha_final"] . '</td>
                      <td>' . $reserva["hora_inicio"] . '</td>
                      <td>' . $reserva["hora_final"] . '</td>
                      <td>' . number_format($reserva["costo_total"], 2) . '</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-info btn-sm btnImprimirReserva" data-id="' . $reserva["id_alquiler"] . '">
                            <i class="fa fa-print"></i>
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
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>