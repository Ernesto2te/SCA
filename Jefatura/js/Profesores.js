// TODO: funcion para llenar datatable PROFESORES

var tabla
$(document).ready(function () {
  accion = 'tablaProfes',
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
$(document).on('click', '#btnAgregarProfe', function () {
  $('#modal-agregar-profesor').modal('show');
   
  $('#txtNombreProfe').val('');
  $('#txtApellidoProfeP').val('');
  $('#Apellid_ProfeM').val('');
  $('#txtClaveProfe').val('');


});

$(document).on('click', '#btnEditarProfesor', function () {
  $('#modal-editar-profesor').modal('show');
   

});


// abrir modal rol
$(document).on('click', '#btnAgregarUsuario', function () {
  $('#modal-agregar-Usuario').modal('show');
   
  // $('#txtNombreProfe').val('');
  // $('#txtApellidoProfeP').val('');
  // $('#Apellid_ProfeM').val('');
  // $('#txtClaveProfe').val('');


});


function Guardar_Profesor() {
  $('#btnGuardarMaestro').on('click', function (e) {
   
    e.preventDefault();
    Swal.fire({
      title: '¡ATENCION!',
      text: 'Se guardarán los datos del Maestro',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Guardar',
      showCloseButton: true,
    }).then((res) => {
      if (res.value) {
        const NombreMaestro = $('#txtNombreProfe').val();
        const ApaternoMaestro = $('#txtApellidoProfeP').val();
        const AmaternoMaestro   = $('#Apellid_ProfeM').val();
        const ClaveMaestro  = $('#txtClaveProfe').val();
       


//validar campos

const accion = 'guardarProfe';
const data = new FormData();
data.append('NombreMa', NombreMaestro);
data.append('a_paternoJM', ApaternoMaestro);
data.append('a_maternoJM', AmaternoMaestro);
data.append('Clave_Maestro', ClaveMaestro);

data.append('accion', accion);

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

// Variable global para almacenar la clave original del profesor
var clave_ProfesorV = "";


    // Evento para abrir el modal de edición con los datos del profesor seleccionado
    $(document).on('click', '#btnEditarProfesor', function () {
        var $tr = $(this).closest('tr');
        var data = tabla.row($tr).data();

        var nombreMaestro = data[0];
        var aPaterno = data[1];
        var aMaterno = data[2];
        clave_ProfesorV = data[3];

        // Asignar valores al modal de edición
        $('#txtNombresEd').val(nombreMaestro);
        $('#txtApellidoEd').val(aPaterno);
        $('#txtApellidoMEd').val(aMaterno);
        $('#txtClaveED').val(clave_ProfesorV);

        // Mostrar el modal de edición
        $('#modal-editar-profesor').modal('show');
    });

    // Evento para el botón de guardar cambios en el modal

// Función para manejar la edición de un profesor
function editarProfesor() {

  $('#btnEditarR').on('click', function (e) {
    e.preventDefault();

  
    let NombreMaestro = $('#txtNombresEd').val();
    let ApaternoMaestro= $('#txtApellidoEd').val();
    let AmaternoMaestro= $('#txtApellidoMEd').val();
    let ClaveMaestro = $('#txtClaveED').val();
    let claveOriginal =  clave_ProfesorV;
    // Aquí puedes agregar tus validaciones...

    // Lógica para guardar cambios
    Swal.fire({
        title: '¡ATENCIÓN!',
        text: '¿Desea guardar los cambios realizados en el profesor?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'No, cancelar'
    }).then((res) => {
        if (res.isConfirmed) {
            const accion = 'editarProfesor';
            const datos = new FormData();
            datos.append('NombreMa', NombreMaestro);
            datos.append('a_paternoJM', ApaternoMaestro);
            datos.append('a_maternoJM', AmaternoMaestro);
            datos.append('Clave_Maestro', ClaveMaestro);
            datos.append('clave_ProfesorV', claveOriginal);
            datos.append('accion', accion);
            console.log("Datos enviados: ", Object.fromEntries(datos));

            $.ajax({
                type: 'POST',
                url: 'controller/rutas.php', 
                data: datos,
                contentType: false,
                processData: false,
                success: function (response) {
           
                    if (response.includes('Error')) {
                        Swal.fire({
                            title: 'Error',
                            text: response,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Profesor editado exitosamente',
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



// TODO llenar select 
$(document).ready(function () {
  const accion = 'Buscar_maestro';
  var datos = { accion: accion };

  $.ajax({
      url: 'controller/rutas.php',
      type: 'POST',
      dataType: 'json',
      data: datos,
      success: function (data) {
          if (data.length > 0) {
              data.forEach(function(profesor) {
                  $('#selectMaestro').append(`<option value="${profesor.id}">${profesor.nombreCompleto}</option>`);
              });
          } else {
              alert('No se encontraron registros.');
          }
      },
      error: function (jqXHR, textStatus, errorThrown) {
          console.error("Error en la petición AJAX: ", textStatus, errorThrown);
          console.log("Detalles del error: ", jqXHR.responseText);
      }
  });
});


function Guardar_Usuario() {
  $('#btnGuardarUsuarioMaestro').on('click', function (e) {
      e.preventDefault();

      Swal.fire({
          title: '¡ATENCION!',
          text: 'Se guardarán los datos del Maestro',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Guardar',
          showCloseButton: true,
      }).then((res) => {
          if (res.value) {
              const Correo = $('#txtCorreo').val();
              const Contraseña = $('#txtContraseña').val();
              const Id_Maestro = $('#selectMaestro').val(); // Capturar el ID del maestro seleccionado

              const accion = 'guardarRol';
              const data = new FormData();
              data.append('Id_Maestro', Id_Maestro); // Enviar el ID del maestro
              data.append('CorreoRol', Correo);
              data.append('ContraseñaRol', Contraseña);
              data.append('accion', accion);

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

Guardar_Profesor();
editarProfesor();
Guardar_Usuario();