



var tabla
$(document).ready(function () {
  accion = 'tablaAlumnos',
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
$(document).on('click', '#btnAgregarAl', function () {
    $('#modal-agregar-alumno').modal('show')

  
    // IdInput.value=''; limpia los inputs despues de cerrado el modal
    // txtNT.value = '';
    // txthab.value = '';
    // txtSt.value = '';
   
  
  });
  






//TODO: GUARDAR ALUMNOS


function Guardar_Alumno() {
  $('#btnGuardaR').on('click', function (e) {
   
    e.preventDefault();
    Swal.fire({
      title: '¡ATENCION!',
      text: 'Se guardarán los datos del alumno',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Guardar',
      showCloseButton: true,
    }).then((res) => {
      if (res.value) {
        const NombreAlumno = $('#txtNombres').val();
        const MatriculaAlumno = $('#txtMatricula').val();
        const aPaterno  = $('#txtAPaterno').val();
        const aMaterno = $('#txtAMaterno').val();
        const Grupo = $('#GrupoA').val();


//validar campos

const accion = 'guardarAlumno';
const data = new FormData();
data.append('Nombres', NombreAlumno);
data.append('matricula', MatriculaAlumno );
data.append('a_paternoA', aPaterno);
data.append('a_maternoA', aMaterno);
data.append('Grupo', Grupo);

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


var  matricula_alumV = "";
$(document).on('click', '#EditarAlumnos', function () {
  var $tr = $(this).closest('tr');
  var data = tabla.row($tr).data();

  var nombre =  data [1];
  matricula_alumV = data [0];
  var apaterno = data [2];
  var amaterno = data [3];
  var grupoHtml = data [4];
  var grupo = "";
  if (/<[a-z][\s\S]*>/i.test(grupoHtml)) { // Verifica si grupoHtml parece ser un HTML
      grupo = $(grupoHtml).text();
  } else {
      grupo = grupoHtml; // Si no, asume que ya es texto
  }



  $('#txtNombresE').val(nombre);
  $('#txtMatriculaE').val( matricula_alumV);
  $('#txtAPaternoE').val(apaterno);
  $('#txtAMaternoE').val(amaterno);
  $('#GrupoAE').val(grupo).trigger('change');

  $('#modal-Editar-alumno').modal('show');
  // Para el status

});





function Editar_Alumno() {
  $('#btnEditarR').on('click', function (e) {
    e.preventDefault();
    let NombreAlumno = $('#txtNombresE').val();
    let MatriculaAlumno = $('#txtMatriculaE').val();
     let aPaterno = $('#txtAPaternoE').val();
    let aMaterno= $('#txtAMaternoE').val();
    let Grupo  = $('#GrupoAE').val();
    let MatriculatOriginal = matricula_alumV;//
  
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
        datos.append('Nombres', NombreAlumno);
        datos.append('matricula', MatriculaAlumno );
        datos.append('matricula_alumV', MatriculatOriginal);//
        datos.append('a_paternoA', aPaterno);
        datos.append('a_maternoA', aMaterno);
        datos.append('Grupo', Grupo );
        datos.append('accion', 'editarAlumno');
  
        $.ajax({
          type: 'POST',
          url: 'controller/rutas.php',
          data: datos,
          contentType: false,
          processData: false,
          success: function (response) {
            console.log(response);
            if (response.includes('matricula duplicada')) {
              Swal.fire({
                title: 'Error',
                text: 'matricula duplicada',
                icon: 'error',
                confirmButtonText: 'OK'
              });
            } else if (response.includes('Error al editar al alumno.')) {
              Swal.fire({
                title: 'Error',
                text: response,
                icon: 'error',
                confirmButtonText: 'OK'
              });
            } else {
              Swal.fire({
                title: 'Éxito',
                text: 'Alumno editado exitosamente',
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
  







Guardar_Alumno();
Editar_Alumno();