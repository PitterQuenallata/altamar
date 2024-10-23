$(document).ready(function () {
  // Capturar fechas y actualizar DataTable
  $("#fechaInicio, #fechaFinal").change(function () {
    var fechaInicio = $("#fechaInicio").val();
    var fechaFinal = $("#fechaFinal").val();

    if (fechaInicio && fechaFinal) {
      // Actualizar DataTable con las fechas seleccionadas
      $("#tablaAreasAlquiler")
        .DataTable()
        .ajax.url(
          `ajax/alquiler.ajax.php?fechaInicio=${fechaInicio}&fechaFinal=${fechaFinal}`
        )
        .load();
    }
  });

  // Destruir cualquier instancia previa de DataTable
  if ($.fn.DataTable.isDataTable("#tablaAreasAlquiler")) {
    $("#tablaAreasAlquiler").DataTable().destroy();
  }

  // Inicializar DataTable con configuración en español
  $("#tablaAreasAlquiler").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "ajax/alquiler.ajax.php",
      type: "POST",
    },
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
    columns: [
      { data: "numero" },
      { data: "descripcion" },
      { data: "precio" },
      { data: "estado" },
      { data: "acciones" },
      { data: "id", visible: false }, // Ocultar la columna id
    ],
  });

  // Manejar el evento de clic en el botón de agregar
  $("#tablaAreasAlquiler").on("click", ".btnAgregar", function () {
    var estado = $(this).closest("tr").find("td:eq(3)").text().trim();
    if (estado !== "Activo") {
      swal({
        type: "error",
        title: "¡Error!",
        text: "No se puede agregar un área inactiva.",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm: false,
      }).then((result) => {
        if (result.value) {
          window.lreload;
        }
      });
      return;
    }

    var data = {
      id: $(this).data("id"),
      descripcion: $(this).closest("tr").find("td:eq(1)").text(),
      precio: $(this).closest("tr").find("td:eq(2)").text(),
    };

    agregarAreaSocial(data);

    // Deshabilitar el botón de agregar
    $(this).attr("disabled", true);
  });

  // Manejar el evento de clic en el botón de quitar
  $(".nuevoAlquiler").on("click", ".quitarProducto", function () {
    var idProducto = $(this).attr("idProducto");
    $(this).closest(".nuevoAlquilerItem").remove();

    // Habilitar el botón de agregar en la tabla de áreas sociales
    $("#tablaAreasAlquiler")
      .find(`button[data-id='${idProducto}']`)
      .attr("disabled", false);

    // Actualizar el total del alquiler y la lista de áreas
    actualizarTotalAlquiler();
    listarAreas();
  });
});

function agregarAreaSocial(data) {
  var nuevoAlquiler = `
      <div class="row nuevoAlquilerItem" idProducto="${data.id}">
          <div class="col-6 mb-2">
              <input type="text" class="form-control nuevaDescripcionProducto" idProducto="${data.id}" name="nombreProducto[]" value="${data.descripcion}" readonly>
          </div>
          <div class="col-3 mb-2">
              <input type="text" class="form-control nuevoPrecioProducto" name="precioProducto[]" value="${data.precio}" readonly>
          </div>
          <div class="col-3 mt-1">
              <button class="btn btn-danger btn-sm quitarProducto" idProducto="${data.id}">X</button>
          </div>
      </div>
  `;

  $(".nuevoAlquiler").append(nuevoAlquiler);

  // Actualizar el total del alquiler
  actualizarTotalAlquiler();
  listarAreas(); // Actualizar la lista en tiempo real
}

// Función para actualizar el total del alquiler
function actualizarTotalAlquiler() {
  var total = 0;
  $(".nuevoPrecioProducto").each(function () {
    total += parseFloat($(this).val());
  });
  $("#total").val(total.toFixed(2));
}

// Función para listar las áreas seleccionadas en un input hidden
function listarAreas() {
  var listaAreas = [];

  $(".nuevoAlquilerItem").each(function () {
    var precio = parseFloat($(this).find(".nuevoPrecioProducto").val());
    listaAreas.push({
      id: $(this).attr("idProducto"),
      descripcion: $(this).find(".nuevaDescripcionProducto").val(),
      precio: precio,
    });
  });

  console.log(listaAreas);
  $("#listaAreas").val(JSON.stringify(listaAreas));
}
