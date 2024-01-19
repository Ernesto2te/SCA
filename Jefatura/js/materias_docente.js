


// TODO llenar select

$(document).ready(function () {
    const accion = 'Buscar_PeriodoDC'
    var datos = { accion: accion }
    var data
  
    $.ajax({
      url: 'controller/rutas.php',
      type: 'POST',
      dataType: 'json',
      data: datos,
      success: function (responseData) {
        data = responseData
        if (data.length > 0) {
          // Si hay datos, creamos las opciones del select
          for (var i = 0; i < data.length; i++) {
            $('#selectPeriodo').append(`<option value="${data[i]}">${data[i]}</option>`)
          }
        } else {
          alert('No se encontraron registros.')
        }
        console.log(data)
      },
    })
  })
  
  //fin select periodo
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
                  $('#selectDocente').append(`<option value="${profesor.id}">${profesor.nombreCompleto}</option>`);
              });
          } else {
              alert('No se encontraron registros.');
          }
      },
  });
});
  // traer materias
  $(document).ready(function () {
    const accion = 'Buscar_MateriasDC'; // Cambia la acción a buscar materias
    var datos = { accion: accion }
    var data
  
    $.ajax({
        url: 'controller/rutas.php',
        type: 'POST',
        dataType: 'json',
        data: datos,
        success: function (responseData) {
            data = responseData
            if (data.length > 0) {
                // Si hay datos, creamos las opciones del select
                for (var i = 0; i < data.length; i++) {
                    $('#selectMateria').append(`<option value="${data[i].id_materia}">${data[i].NombreMat}</option>`);
                }
            } else {
                alert('No se encontraron materias.');
            }
            console.log(data);
        },
        error: function (status) {
            console.log(status);
        }
    });
  });
  

  //grupos
  $(document).ready(function () {
    const accion = 'Buscar_Grupo'; 
    var datos = { accion: accion };
  
    $.ajax({
        url: 'controller/rutas.php',
        type: 'POST',
        data: datos,
        dataType: 'json', // Especifica que esperamos una respuesta en formato JSON
        success: function (responseData) {
            if (responseData.length > 0) {
                for (var i = 0; i < responseData.length; i++) {
                    $('#selectGrupo').append(`<option value="${responseData[i].id_grupo}">${responseData[i].Grupo}</option>`);
                }
            } else {
                alert('No se encontraron grupos.');
            }
            console.log(responseData);
        },
        error: function (status) {
            console.log(status);
        }
    });
});



  function GuardarSeleccion() {
    $('#btnGuardarM').on('click', function (e) {
        e.preventDefault();

        Swal.fire({
            title: '¡ATENCION!',
            text: 'Se guardarán los datos seleccionados',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            showCloseButton: true,
        }).then((res) => {
            if (res.value) {
                const Nombre_Periodo = $('#selectPeriodo').val();
                const docente = $('#selectDocente').val();
                const materia = $('#selectMateria').val();
                const grupo = $('#selectGrupo').val();
       
 

                const accion = 'insertar_asignacion_DOCENTE';
                const data = new FormData();
                data.append('nombrePeriodo', Nombre_Periodo);
                data.append('NombreMa', docente);
                data.append('NombreMat', materia);
                data.append('Grupo', grupo);
                // data.append('semestre', semestre);
                data.append('accion', accion);
          
                $.ajax({
                  type: 'POST',
                  url: 'controller/rutas.php',
                  data: data,
                  contentType: false,
                  processData: false,
                  success: function (response) {
                      var jsonResponse = JSON.parse(response);

                      if (jsonResponse.status === 'duplicate_entry') {
                          // Mensaje de error por duplicado
                          Swal.fire({
                              title: '¡Error!',
                              text: jsonResponse.message,
                              icon: 'error',
                              showCloseButton: true,
                          });
                      } else if (jsonResponse.status === 'success') {
                          // Mensaje de éxito
                          Swal.fire({
                              title: '¡Éxito!',
                              text: jsonResponse.message,
                              icon: 'success',
                              showCloseButton: true,
                              timer: 5000 // Duración de 5 segundos
                          }).then(() => {
                              location.reload(); // Recargar la página después de mostrar el mensaje de éxito
                          });
                      } else {
                          // Mensaje de error general
                          Swal.fire({
                              title: '¡Error!',
                              text: 'Se produjo un error al realizar la solicitud.',
                              icon: 'error',
                              showCloseButton: true,
                              timer: 5000 // Duración de 5 segundos
                          });
                      }
                  },
                  error: function () {
                      // Mensaje de error general en caso de error de la solicitud AJAX
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
                    timer: 5000
                });
            }
        });
    });
}

GuardarSeleccion();



