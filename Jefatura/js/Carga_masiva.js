



function GuardarMasiva() {
  $("#btncargarM").on("click", function (e) {
      var archivo = document.getElementById('file_image').files[0];
      var lector = new FileReader();

      // Validar si se seleccionó un archivo
      if (!archivo) {
          Swal.fire({
              title: "Error",
              text: "Debe seleccionar un archivo.",
              icon: "error",
          });
          return;
      }

      lector.onload = function (e) {
          var contenido = e.target.result;
          var workbook = XLSX.read(contenido, { type: 'array' });
          var sheetName = workbook.SheetNames[0];
          var worksheet = workbook.Sheets[sheetName];
          var data = XLSX.utils.sheet_to_json(worksheet);

          // Validaciones aquí...
          var valido = true; // Variable para controlar si el archivo es válido

          for (var i = 1; i < data.length; i++) {
            var fila = data[i];
    
            // Validaciones
    
            if (!fila['APELLIDO PATERNO']) {
              Swal.fire('Error', 'La fila ' + (i + 2) + ' contiene un campo vacío en "APELLIDO PATERNO".', 'error');
              valido = false; // Marcar como inválido
              break; // Salir del ciclo
            }
    
            if (!fila['APELLIDO MATERNO']) {
              Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "APELLIDO MATERNO".', 'error');
              valido = false; // Marcar como inválido
              break; // Salir del ciclo
            }
    
            if (!fila['NOMBRE(S)']) {
              Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NOMBRE(S)".', 'error');
              valido = false; // Marcar como inválido
              break; // Salir del ciclo
            }
    
            if (!fila.MATRICULA) {
              Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "MATRICULA".', 'error');
              valido = false; // Marcar como inválido
              break; // Salir del ciclo
            }

            if (!fila.CURP) {
                Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "CURP".', 'error');
                valido = false; // Marcar como inválido
                break; // Salir del ciclo
              }
              if (!fila.DOMICILIO) {
                Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "DOMICILIO".', 'error');
                valido = false; // Marcar como inválido
                break; // Salir del ciclo
              }
              if (!fila.FECHAINGRESO) {
                Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "FECHAINGRESO".', 'error');
                valido = false; // Marcar como inválido
                break; // Salir del ciclo
              }
              if (!fila.GRUPO) {
                Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "GRUPO".', 'error');
                valido = false; // Marcar como inválido
                break; // Salir del ciclo
              }
              if (!fila.ESTADOALUMNO) {
                Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "ESTADOALUMNO".', 'error');
                valido = false; // Marcar como inválido
                break; // Salir del ciclo
              }
    
            // // Validar formato de matrícula
            // if (!/^(B|C)?\d{2}[A-Z]{2}\d{4}$/.test(fila.MATRICULA)) {
            //   Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un formato de matrícula no válido en "MATRICULA".', 'error');
            //   valido = false; // Marcar como inválido
            //   break; // Salir del ciclo
            // }
    
    
    
          }
          // Validar si hay elementos vacíos en el archivo Excel
          if (data.length === 0) {
            Swal.fire({
              title: "Error",
              text: "El archivo Excel está vacío.",
              icon: "error",
              showCancelButton: true,
            });
            return;
          } 
            
          // Si no es válido, retorna
          else if (!valido) {
              Swal.fire({
                  title: "Error",
                  text: "El archivo que subiste es incorrecto.",
                  icon: "error",
              });
              return;
          }

          // Confirmación para registrar los datos
          Swal.fire({
              title: "¡Atención!",
              text: "¿Desea registrar los datos del archivo Excel?",
              icon: "info",
              showCancelButton: true,
              showConfirmButton: true,
              dangerMode: true,
          }).then((willDelete) => {
              if (willDelete.isConfirmed) {
                  enviarDatos(data);
              } else {
                  Swal.fire({
                      title: "Información",
                      text: 'Operación cancelada',
                      icon: "info",
                  });
              }
          });
      };

      lector.readAsArrayBuffer(archivo);
  });
}

// Función para enviar datos al servidor
function enviarDatos(data) {
  const accion = "insertar_carga_masiva";
  const dataToSend = new FormData();

  data.forEach(function (fila) {
      dataToSend.append('a_paternoA[]', fila['APELLIDO PATERNO']);
      dataToSend.append('a_maternoA[]', fila['APELLIDO MATERNO']);
      dataToSend.append('Nombres[]', fila['NOMBRE(S)']);
      dataToSend.append('matricula[]', fila.MATRICULA);
      dataToSend.append('Curp[]', fila.CURP);
      dataToSend.append('Domicilio[]', fila.DOMICILIO);
      dataToSend.append('fechaingreso[]', fila.FECHAINGRESO);
      dataToSend.append('estadoAlumno[]', fila.ESTADOALUMNO);
      dataToSend.append('Grupo[]', fila.GRUPO);
  });
  dataToSend.append('accion', accion);

  $.ajax({
      type: 'POST',
      url: "controller/rutas.php",
      data: dataToSend,
      contentType: false,
      processData: false,
      success: function (response) {
          console.log('Respuesta del servidor:', response);
          if (response.includes("Error")) {
              Swal.fire({
                  title: "Error",
                  text: response,
                  icon: "error",
              });
          } else {
              Swal.fire({
                  title: 'Correcto',
                  text: 'Datos Registrados Correctamente',
                  icon: 'success',
              }).then((result) => {
                  if (result.isConfirmed) {
                      location.reload();
                  }
              });
          }
      },
      error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr.status);
          console.log(thrownError);
          console.log(ajaxOptions);
      }
  });
}

GuardarMasiva();
