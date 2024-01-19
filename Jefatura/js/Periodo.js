

// $(document).ready(function () {
//     const accion = "tablaPeriodo";
//     var datos = { accion: accion, }
  
//     $.ajax({
//       url: "controller/rutas.php", //Ruta
//       type: "POST",      //Metodo
//       dataType: "json",  //Tipo de dato Json
//       data: datos,
//       success: function (data) {
//         var tabla = $("#basic-1").DataTable();
//         tabla.clear().draw();    //Dibujar la tabla
//         $.each(data, function (index, value) { //Index=valores en el navegador:v
//           var statusClass = value.statusP === 'Activo' ? 'activo' : 'inactivo';
//           tabla.row.add([value.nombrePeriodo, '<span class="' + statusClass + '">' + value.StatusP + '</span>']).draw(); //Agregar otro status o equis cosa falta otra columna
//         })
//         console.log(data);
//       },
//       error: function (status) { //Verificar Errores
//         console.log(status);
//       }
//     })
//   });
  
// TODO: funcion para llenar datatable

  var tabla
$(document).ready(function () {
  accion = 'tablaPeriodo',
    tabla = $('#basic-1').DataTable({
      'aProcessing': true, // Activamos el procesamiento del datatables
      'aServerSide': true, // Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip', // Definimos los elementos del control de tabla
      'ajax': {
        url: 'controller/rutas.php',
        data: { accion: accion },
        type: 'post',

        
        error: function (e) {
          console.log(e.responseText);
          
        }
      },
      'bDestroy': true,
      'bInfo': true,
      'iDisplayLength': 5,
      'order': [[1, 'desc']],
      'language': {
        'sProcessing': 'Procesando...',
        'sLengthMenu': 'Mostrar MENU registros',
        'sZeroRecords': 'No se encontraron resultados',
        'sEmptyTable': 'Ningún dato disponible en esta tabla',
        'sInfo': '',
        'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
        'sInfoFiltered': '(filtrado de un total de MAX registros)',
        'sInfoPostFix': '',
        'sSearch': '',
        'sSearchPlaceholder': 'Buscar',
        'sUrl': '',
        'sInfoThousands': ',',
        'sLoadingRecords': 'Cargando...',
        'oPaginate': {
          'sFirst': 'Primero',
          'sLast': 'Último',
          'sNext': 'Siguiente',
          'sPrevious': 'Anterior'
        },
        'oAria': {
          'sSortAscending': ': Activar para ordenar la columna de manera ascendente',
          'sSortDescending': ': Activar para ordenar la columna de manera descendente'
        }
      }
    })
})




// abrir modal para guardar
$(document).on('click', '#btnAgregarP', function () {
  $('#modal-agregar-periodo').modal('show')
  // $('#btnEditarMT').hide()
  $('#btnGuardar').show()

  // IdInput.value=''; limpia los inputs despues de cerrado el modal
  // txtNT.value = '';
  // txthab.value = '';
  // txtSt.value = '';
   txtNE.value = '';

});




function Guardar_tecnico() {
  $('#btnGuardar').on('click', function (e) {
   
    e.preventDefault();
    Swal.fire({
      title: '¡ATENCION!',
      text: 'Se guardarán los datos del ciclo',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Guardar',
      showCloseButton: true,
    }).then((res) => {
      if (res.value) {
        const nombreP = $('#txtNE').val();
        const StatusC= $('#statusP').val();

//validar campos

const accion = 'guardarCiclo';
const data = new FormData();
data.append('nombrePeriodo', nombreP);
data.append('StatusP', StatusC);
data.append('accion', accion);

// console.log(nombre_tec);
$.ajax({
  type: 'POST',
  url: 'controller/rutas.php',
  data: data,
  contentType: false,
  processData: false,
  success: function (response) {
    if (response.includes('duplicada')) {
      // Mensaje de error
      Swal.fire({
        title: '¡Error!',
        text: response,
        icon: 'error',
        showCloseButton: true,
        timer: 5000 // Duración de 5 segundos
      });
    } else {
      // Mensaje de éxito
      Swal.fire({
        title: '¡Éxito!',
        text: response,
        icon: 'success',
        showCloseButton: true,
        timer: 5000 // Duración de 5 segundos
      }).then(() => {
        location.reload(); // Recargar la página después de mostrar el mensaje de éxito
      });
    }
  },
  error: function () {
    // Mensaje de error en caso de fallo en la solicitud AJAX
    Swal.fire({
      title: '¡Error!',
      text: 'Se produjo un error al realizar la solicitud.',
      icon: 'error',
      showCloseButton: true,
      timer: 5000 // Duración de 5 segundos
    });
  },
});
} else {
  Swal.fire({
    title: 'Información',
    text: 'Operación Cancelada',
    icon: 'error',
    showCloseButton: true,
    timer: 5000 // Duración de 5 segundos
  });
}
});
});
}


Guardar_tecnico();