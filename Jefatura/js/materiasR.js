// TODO: funcion para llenar datatable MATERIAS

var tabla
$(document).ready(function () {
  accion = 'tablaMaterias',
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
$(document).on('click', '#btnAgregarM', function () {
  $('#modal-agregar-reticula').modal('show');
 
  $('#btnGuardarR').show();

  // Limpiar los inputs del modal de agregar
  $('#txtMateriaAgregar').val('');
  $('#txtClaveMAgregar').val('');
});

  
  
  // // abrir modal para editar
  // $(document).on('click', '#EditarMaterias', function () {
  //     $('#modal-editar-reticula').modal('show')
  
    
  //     // IdInput.value=''; limpia los inputs despues de cerrado el modal
   
  //     txtClaveM.value = '';
    
  //   });
  
    

    function Guardar_Materia() {
      $('#btnGuardaR').on('click', function (e) {
       
        e.preventDefault();
        Swal.fire({
          title: '¡ATENCION!',
          text: 'Se guardarán los datos de la materia',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Guardar',
          showCloseButton: true,
        }).then((res) => {
          if (res.value) {
            const NombreMaterias = $('#txtMateriaAgregar').val();
         
    
    const accion = 'guardarMateria';
    const data = new FormData();
    data.append('NombreMat', NombreMaterias);
    data.append('ClaveMat', ClaveMaterias );
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
    



var clave_matv = "";

$(document).on('click', '.editar-materia', function () {
  var $tr = $(this).closest('tr');
  var data = tabla.row($tr).data();
  

  var nombreMateria = data[0];
  clave_matv = data[1];

  // Asignar valores al modal de edición
  $('#txtMateriaEditar').val(nombreMateria);
  $('#txtClaveMEditar').val( clave_matv );
  // $('#btnEditarR').data('id', idMateria); // Guarda el ID en el botón de editar del modal

  // Mostrar el modal de edición
  $('#modal-editar-reticula').modal('show');
});


// function Editar_materia() {
//   $('#btnEditarR').on('click', function (e) {
//     e.preventDefault();

//     let NombreMaterias = $('#txtMateria').val();
//     let ClaveMaterias = $('#txtNE').val();

//     // Agrega aquí las validaciones necesarias...

//     Swal.fire({
//       title: '¡ATENCIÓN!',
//       text: '¿Desea guardar los cambios realizados?',
//       icon: 'warning',
//       showCancelButton: true,
//       confirmButtonText: 'Sí, guardar',
//       cancelButtonText: 'No, cancelar'
//     }).then((res) => {
//       if (res.isConfirmed) {
//         const accion = 'editarMateria';
//         const datos = new FormData();
//         datos.append('nombre_mat', NombreMaterias);     
//         datos.append('clave_mat', ClaveMaterias);
//         datos.append('clave_matv', clave_matv);
//         datos.append('accion', accion);

//         $.ajax({
//           type: 'POST',
//           url: 'controller/rutas.php',
//           data: datos,
//           contentType: false,
//           processData: false,
//           success: function (response) {
//             console.log(response);
//             if (response.includes('Clave duplicada')) {
//               Swal.fire({
//                 title: 'Error',
//                 text: 'Clave duplicada',
//                 icon: 'error',
//                 confirmButtonText: 'OK'
//               });
//             } else if (response.includes('Error al editar la materia.')) {
//               Swal.fire({
//                 title: 'Error',
//                 text: response,
//                 icon: 'error',
//                 confirmButtonText: 'OK'
//               });
//             } else {
//               Swal.fire({
//                 title: 'Éxito',
//                 text: 'Materia editada exitosamente',
//                 icon: 'success',
//                 confirmButtonText: 'OK'
//               }).then(() => {
//                 location.reload();
//               });
//             }
//           }
//         });
//       }
//     });
//   });
// }

function Editar_materia() {
$('#btnEditarR').on('click', function (e) {
  e.preventDefault();
  let nombreMateria = $('#txtMateriaEditar').val();
  let claveMat = $('#txtClaveMEditar').val();
  let claveMatOriginal = clave_matv;

  // Agrega validaciones si es necesario...

  Swal.fire({
    title: '¡ATENCIÓN!',
      text: '¿Desea guardar los cambios realizados?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, guardar',
      cancelButtonText: 'No, cancelar'
    
  }).then((res) => {
    if (res.isConfirmed) {
      let datos = new FormData();
      datos.append('NombreMat', nombreMateria);
      datos.append('ClaveMat', claveMat);
      datos.append('clave_matv', claveMatOriginal);
      datos.append('accion', 'editarMateria');

      $.ajax({
        type: 'POST',
        url: 'controller/rutas.php',
        data: datos,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(response);
          if (response.includes('Clave duplicada')) {
            Swal.fire({
              title: 'Error',
              text: 'Clave duplicada',
              icon: 'error',
              confirmButtonText: 'OK'
            });
          } else if (response.includes('Error al editar la materia.')) {
            Swal.fire({
              title: 'Error',
              text: response,
              icon: 'error',
              confirmButtonText: 'OK'
            });
          } else {
            Swal.fire({
              title: 'Éxito',
              text: 'Materia editada exitosamente',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              location.reload();
            });
          }
        }
      });
    }
  });
});

}





  
    Guardar_Materia();
    Editar_materia();