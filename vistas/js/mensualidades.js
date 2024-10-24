$(document).ready(function() {
  // Destruir cualquier instancia previa de DataTable
  if ($.fn.DataTable.isDataTable('#mensualidades')) {
    $('#mensualidades').DataTable().destroy();
  }

  // Inicializar DataTable con configuración en español
  $('#mensualidades').DataTable({
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  });

    // // Inicializar Select2 en los campos de mes y gestión
    // $('select[name="nuevoMes"]').select2({
    //   placeholder: "Seleccionar mes",
    //   allowClear: true
    // });
  
    // $('select[name="nuevaGestion"]').select2({
    //   placeholder: "Seleccionar año",
    //   allowClear: true
    // });


// Delegar el evento click para el botón de editar
$(document).on('click', '.btnEditarMensualidad', function() {
  var idMensualidad = $(this).data("id"); // Usar el data-id del botón

  // Llamada AJAX para obtener los datos de la mensualidad
  $.ajax({
    url: "ajax/mensualidades.ajax.php",
    method: "POST",
    data: { idMensualidad: idMensualidad },
    dataType: "json",
    success: function(respuesta) {
      // Llenar el formulario en el modal con los datos obtenidos
      $("#idMensualidad").val(respuesta.id);
      $("#editarMes").val(respuesta.mes);
      $("#editarGestion").val(respuesta.gestion);
      $("#editarCosto").val(respuesta.costo);
    }
  });
});


//eliminar
$(document).on('click', '.btnEliminarMensualidad', function() {
  var idMensualidad = $(this).data("id"); // Obtener el ID de la mensualidad
  console.log(idMensualidad);
  // Mostrar confirmación con SweetAlert
  swal({
    type: "warning",
    title: "¿Está seguro de borrar la mensualidad?",
    text: "¡Si no lo está puede cancelar la acción!",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, borrar mensualidad",
    cancelButtonText: "Cancelar"
  }).then((result) => {
    if (result.value) {
      // Redirigir para eliminar la mensualidad
      window.location = "index.php?ruta=mensualidad&idMensualidad=" + idMensualidad;
    }
  });
});



});