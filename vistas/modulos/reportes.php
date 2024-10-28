<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 text-center">
          <h1>Reportes</h1>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Reportes</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <!-- Selector de rango de fechas -->
            <div class="input-group mb-3">
              <input type="date" class="form-control" id="fechaInicio" placeholder="Fecha inicio">
              <input type="date" class="form-control" id="fechaFinal" placeholder="Fecha final">
              <div class="input-group-append">
                <button class="btn btn-primary" id="aplicarRango">Aplicar Rango de Fechas</button>
              </div>
            </div>
            <p id="rangoSeleccionado" class="text-muted">Rango de Fechas: <span class="font-weight-bold">No seleccionado</span></p>
          </div>

          <div class="card-body">
            <table id="tablaReportes" class="table table-sm table-hover table-striped">
              <thead>
                <tr>
                  <th style="width:10px">#</th>
                  <th>Reporte</th>
                  <th>Datos de Entrada</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <!-- Reportes de Propietarios -->
                <tr class="table-primary">
                  <td colspan="4" class="text-left font-weight-bold">-- Reportes de Propietarios</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Listar todos los propietarios con sus datos de contacto</td>
                  <td>Ninguno</td>
                  <td><button class="btn btn-success btn-sm">Generar</button></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Lista de propietarios que tienen deudas pendientes hasta la fecha</td>
                  <td>Ninguno</td>
                  <td><button class="btn btn-success btn-sm">Generar</button></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Resumen de pagos de mensualidades por propietario</td>
                  <td>ID del propietario</td>
                  <td><button class="btn btn-success btn-sm">Generar</button></td>
                </tr>

                <!-- Reportes de alquileres y áreas sociales -->
                <tr class="table-primary">
                  <td colspan="4" class="text-left font-weight-bold">-- Reportes de Alquileres y Áreas Sociales</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Lista de alquileres realizados con detalles</td>
                  <td>Rango de fechas</td>
                  <td><button class="btn btn-success btn-sm">Generar</button></td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Disponibilidad de áreas sociales en un rango de fecha</td>
                  <td>Rango de fechas</td>
                  <td><button class="btn btn-success btn-sm">Generar</button></td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Listado de alquileres por propietario</td>
                  <td>ID del propietario</td>
                  <td><button class="btn btn-success btn-sm">Generar</button></td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Área social más alquilada</td>
                  <td>Ninguno</td>
                  <td><button class="btn btn-success btn-sm">Generar</button></td>
                </tr>

                <!-- Reportes financieros -->
                <tr class="table-primary">
                  <td colspan="4" class="text-left font-weight-bold">-- Reportes Financieros</td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>Total de ingresos por alquiler en un rango de fechas</td>
                  <td>Rango de fechas</td>
                  <td><button class="btn btn-success btn-sm">Generar</button></td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>Total de ganancias hasta la fecha de alquileres</td>
                  <td>Ninguno</td>
                  <td><button class="btn btn-success btn-sm">Generar</button></td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>Total de ganancias hasta la fecha de mensualidades</td>
                  <td>Ninguno</td>
                  <td><button class="btn btn-success btn-sm">Generar</button></td>
                </tr>
                <tr>
                  <td>11</td>
                  <td>Total de ganancias generales</td>
                  <td>Ninguno</td>
                  <td><button class="btn btn-success btn-sm">Generar</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  // JavaScript para capturar el rango de fechas y mostrarlo
  $(document).ready(function() {
    $('#aplicarRango').on('click', function() {
      const fechaInicio = $('#fechaInicio').val();
      const fechaFinal = $('#fechaFinal').val();
      
      if (fechaInicio && fechaFinal) {
        $('#rangoSeleccionado span').text(fechaInicio + ' a ' + fechaFinal);
      } else {
        alert('Por favor seleccione un rango de fechas completo.');
      }
    });
  });
</script>
