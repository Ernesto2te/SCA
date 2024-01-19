


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
      error: function (xhr, status, error) {
        console.error("Error en la solicitud AJAX:", xhr.status, xhr.responseText, error);
      }
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
      error: function (jqXHR, textStatus, errorThrown) {
          console.error("Error en la petición AJAX: ", textStatus, errorThrown);
          console.log("Detalles del error: ", jqXHR.responseText);
      }
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
  

  // function GuardarASD() {
  //   var contador = 0;
  //   var periodo;
  
  //   $("#btnGuardarM").on("click", function (e) {
  //     contador++;
      
  
  //     periodo = $("#selectPeriodo option:selected").text().trim();
  //     var materia = $("#selectMateria option:selected").text().trim();
  //     var docente = $("#selectDocente option:selected").text().trim();
  //     var semestre = $('#SemestreS').val().trim();
  //     var grupo = $('#selectGrupo').val().trim();
  
  
  
  //       var dataToSend = new FormData();
  //       dataToSend.append('nombrePeriodo', periodo);
  //       dataToSend.append('nombreD', docente);
  //       dataToSend.append('nombre_mat', materia);
  //       dataToSend.append('semestreM', semestre);
  //       dataToSend.append('Grupo', grupo);
  //       dataToSend.append('accion', 'insertar_asignacion_DOCENTE');
  
     
  //       })
  
  //       if (periodo == "") { //116
  //         Swal.fire({
  //           title: "Todos los campos son obligatorios",
  //           text: "Ingrese una materia",
  //           icon: "warning",
  //           showCancelButton: true,
  //         });
  //         return false;
  //       } else {
  //         Swal.fire({
  //           title: "¡Atención!",
  //           text: "¿Desea registrar los datos?",
  //           icon: "info",
  //           showCancelButton: true,
  //           showConfirmButton: true,
  //           dangerMode: true,
  //         }).then((willDelete) => {
  //           if (willDelete.isConfirmed) {
  //             $.ajax({
  //               url: 'controller/rutas.php',
  //               type: "POST",
  //               data: dataToSend,
  //               processData: false,
  //               contentType: false,
  //               beforeSend: function () {
  //                 Swal.fire({
  //                   title: "Enviando datos...",
  //                   text: "Por favor, espere.",
  //                   showConfirmButton: false,
  //                   allowOutsideClick: false,
  //                 });
  //               },
  //               success: function (respuesta) {
  //                 console.log('Respuesta del servidor:', respuesta);
  //                 if (respuesta.includes("Error")) {
  //                   Swal.fire({
  //                     title: "Error",
  //                     text: respuesta,
  //                     icon: "error",
  //                     showCancelButton: true,
  //                   })
  //                 } else if (respuesta !== "") {
  //                   Swal.fire({
  //                     title: 'Correcto',
  //                     text: 'Datos Registrados Correctamente',
  //                     icon: 'success',
  //                     showConfirmButton: true,
  //                   }).then((result) => {
  //                     if (result.isConfirmed) {
  //                       location.reload();
  //                     }
  //                   });
  //                 }
  //               },
  //               error: function (error) {
  //                 Swal.fire({
  //                   title: "Error",
  //                   text: "Ocurrió un error al enviar los datos.",
  //                   icon: "error",
  //                   showCancelButton: true,
  //                 });
  //               },
  //               complete: function () {
  //                 contador = 0;
  //               }
  //             });
  //           }
  //         });
  //       }
  //     };
  
     
 




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
                      console.log(response)
                      // if (response.includes('duplicada')) {
                      //   // Mensaje de error
                      //   Swal.fire({
                      //     title: '¡Error!',
                      //     text: response,
                      //     icon: 'error',
                      //     showCloseButton: true,
                      //     timer: 5000 // Duración de 5 segundos
                      //   });
                      // } else {
                      //   // Mensaje de éxito
                      //   Swal.fire({
                      //     title: '¡Éxito!',
                      //     text: response,
                      //     icon: 'success',
                      //     showCloseButton: true,
                      //     timer: 5000 // Duración de 5 segundos
                      //   }).then(() => {
                      //     location.reload(); // Recargar la página después de mostrar el mensaje de éxito
                      //   });
                      // }
                    },
                    error: function () {
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



