





// TODO llenar select

$(document).ready(function () {
    const accion = 'Buscar_PeriodoD'
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
      error: function (status) {
        console.log(status)
      }
    })
  })
  
  //fin select periodo
  
  function cargarDocentes() {
    $.ajax({
        url: 'controller/rutas.php',
        type: 'POST',
        dataType: 'json',
        data: { accion: 'buscar_docenteD' },
        success: function (docentes) {
            if (docentes.length > 0) {
                docentes.forEach(function (docente) {
                    $('#selectDocente').append(`<option value="${docente.id}">${docente.nombreCompleto}</option>`);
                });
            } else {
                alert('No se encontraron docentes.');
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
  }
  
  // traer materias
  $(document).ready(function () {
    const accion = 'Buscar_Materias'; // Cambia la acción a buscar materias
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
  
  
  
  // traer materias fin
  

  // function cargarArchivo () {
  //   // Validación de los campos
   

  //   for (var i = 0; i < data.length; i++) { //96
  //     var fila = data[i]

  //     // Verificar campos vacíos
  //     var SEMESTRE = "SEMESTRE";
  //     if (!fila.MATRICULA) {
  //       Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "MATRICULA".', 'error')
  //       return
  //     }
  //     if (!fila[SEMESTRE]) {
  //       Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "VALORACION NUMERICA".', 'error')
  //       return
  //     }
  //     if (!fila.FALTA_P1) {
  //       Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "OBSERVACIONES".', 'error')
  //       return
  //     }
  //     if (!fila[FALTA_P2]) {
  //       Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "TIPO DE CURSO".', 'error')
  //       return
  //     }
  //     if (!fila[FALTA_P3]) {
  //       Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error')
  //       return
  //     }
  //     if (!fila[TOTAL_FALTAS]) {
  //       Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error')
  //       return
  //     }

  //     if (!fila[CALIFICACIONP1]) {
  //       Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error')
  //       return
  //     }

  //     if (!fila[CALIFICACIONP2]) {
  //       Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error')
  //       return
  //     }

  //     if (!fila[CALIFICACIONP3]) {
  //       Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error')
  //       return
  //     }
  //     if (!fila[CALIFICACION_FINAL]) {
  //       Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error')
  //       return
  //     }

      
     


  //     //validar mas cosas aqui función test().
  //     }

  //     Swal.fire('Éxito', 'Los datos se cargaron correctamente', 'success')
      
  //   }
  















  function GuardarASE() {
    var contador = 0;
  
    // Función que se ejecuta al hacer clic en el botón de cargar
    $("#btncargarM").on("click", function (e) {
      e.preventDefault();
  
      // Obtener los valores seleccionados de los elementos select
      var Nombre_Periodo = $("#selectPeriodo option:selected").text().trim();
      var docente = $("#selectDocente option:selected").text().trim();
      var materia = $("#selectMateria option:selected").text().trim();
      var grupo = $("#selectGrupo option:selected").text().trim();
  
      var archivo = document.getElementById('file_image').files[0];
      var lector = new FileReader();
  
      lector.onload = function (e) {
        var contenido = e.target.result;
        var workbook = XLSX.read(contenido, { type: 'array' });
        var sheetName = workbook.SheetNames[0];
        var worksheet = workbook.Sheets[sheetName];
        var data = XLSX.utils.sheet_to_json(worksheet);
  
        var dataToSend = new FormData();
        dataToSend.append("nombrePeriodo", Nombre_Periodo);
        dataToSend.append("NombreMa", docente);
        dataToSend.append("NombreMat", materia);
        // dataToSend.append("Grupo", grupo);
        dataToSend.append("accion", "insertar_asignacion_Cali");
  
        var columnasRequeridas = ['MATRICULA', 'SEMESTRE', 'FALTA_P1', 'FALTA_P2', 'FALTA_P3', 'TOTAL_FALTAS', 'CALIFICACIONP1', 'CALIFICACIONP2', 'CALIFICACIONP3', 'CALIFICACION_FINAL'];
        var columnasArchivo = Object.keys(data[0]);
  
        var columnasFaltantes = columnasRequeridas.filter(columna => !columnasArchivo.includes(columna));
        if (columnasFaltantes.length > 0) {
          Swal.fire({
            title: "Error",
            text: "El archivo que subiste no contiene las columnas requeridas: " + columnasFaltantes.join(", "),
            icon: "error",
          });
          return;
        }
  
        for (var i = 0; i < data.length; i++) {
          var fila = data[i];
  
          // Verificar campos vacíos
          if (!fila.MATRICULA) {
            Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "MATRICULA".', 'error');
            return;
          }
          var SEMESTRE = "SEMESTRE";
          if (!fila[SEMESTRE]) {
            Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "VALORACION NUMERICA".', 'error');
            return;
          }
          if (!fila.FALTA_P1) {
            Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "OBSERVACIONES".', 'error');
            return;
          }
          var FALTA_P2 = "FALTA_P2";
          if (!fila[FALTA_P2]) {
            Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "TIPO DE CURSO".', 'error');
            return;
          }
          var FALTA_P3 = "FALTA_P3";
          if (!fila[FALTA_P3]) {
            Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error');
            return;
          }
          var TOTAL_FALTAS = "TOTAL_FALTAS";
          if (!fila[TOTAL_FALTAS]) {
            Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error');
            return;
          }
          var CALIFICACIONP1 = "CALIFICACIONP1";
          if (!fila[CALIFICACIONP1]) {
            Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error');
            return;
          }
          var CALIFICACIONP2 = "CALIFICACIONP2";
          if (!fila[CALIFICACIONP2]) {
            Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error');
            return;
          }
          var CALIFICACIONP3 = "CALIFICACIONP3";
          if (!fila[CALIFICACIONP3]) {
            Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error');
            return;
          }
          var CALIFICACION_FINAL = "CALIFICACION_FINAL";
          if (!fila[CALIFICACION_FINAL]) {
            Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error');
            return;
          }
  
          dataToSend.append("matricula[]", data[i].MATRICULA);
          dataToSend.append("Semestre[]", data[i].SEMESTRE);
          dataToSend.append("Faltas_P1[]", data[i].FALTA_P1);
          dataToSend.append("Faltas_P2[]", data[i].FALTA_P2);
          dataToSend.append("Faltas_P3[]", data[i].FALTA_P3);
          dataToSend.append("Faltas_FINAL[]", data[i].TOTAL_FALTAS);
          dataToSend.append("CALI_P1[]", data[i].CALIFICACIONP1);
          dataToSend.append("CALI_P2[]", data[i].CALIFICACIONP2);
          dataToSend.append("CALI_P3[]", data[i].CALIFICACIONP3);
          dataToSend.append("CALI_FINAL[]", data[i].CALIFICACION_FINAL);
        }
  
        if (Nombre_Periodo == "") {
          Swal.fire({
            title: "Todos los campos son obligatorios",
            text: "Ingrese un periodo",
            icon: "warning",
            showCancelButton: true
          });
          return false;
        }
        if (docente == "") {
          Swal.fire({
            title: "Todos los campos son obligatorios",
            text: "Seleccione un docente",
            icon: "warning",
            showCancelButton: true
          });
          return false;
        }
        if (materia == "") {
          Swal.fire({
            title: "Todos los campos son obligatorios",
            text: "Seleccione una materia",
            icon: "warning",
            showCancelButton: true
          });
          return false;
        }
        // if (grupo == "") {
        //   Swal.fire({
        //     title: "Todos los campos son obligatorios",
        //     text: "Seleccione un grupo",
        //     icon: "warning",
        //     showCancelButton: true
        //   });
        //   return false;
        // }
  
        else {
          Swal.fire({
            title: "¡Atención!",
            text: "¿Desea registrar los datos?",
            icon: "info",
            showCancelButton: true,
            showConfirmButton: true,
            dangerMode: true,
          }).then((willDelete) => {
            if (willDelete.isConfirmed) {
              $.ajax({
                url: 'controller/rutas.php',
                type: "POST",
                data: dataToSend,
                processData: false,
                contentType: false,
                beforeSend: function () {
                  Swal.fire({
                    title: "Enviando datos...",
                    text: "Por favor, espere.",
                    showConfirmButton: false,
                    allowOutsideClick: false,
                  });
                },
                success: function (respuesta) {
                  console.log('Respuesta del servidor:', respuesta);
                  if (respuesta.includes("Error")) {
                    Swal.fire({
                      title: "Error",
                      text: respuesta,
                      icon: "error",
                      showCancelButton: true,
                    });
                  } else if (respuesta !== "") {
                    Swal.fire({
                      title: 'Correcto',
                      text: 'Datos Registrados Correctamente',
                      icon: 'success',
                      showConfirmButton: true,
                    }).then((result) => {
                      if (result.isConfirmed) {
                        location.reload();
                      }
                    });
                  }
                },
                error: function (error) {
                  console.log('Error al enviar la solicitud:', error);
                  Swal.fire({
                    title: "Error",
                    text: "Ocurrió un error al enviar los datos.",
                    icon: "error",
                    showCancelButton: true,
                  });
                },
                complete: function () {
                  contador = 0;
                }
              });
            }
          });
        }
      };
  
      lector.readAsArrayBuffer(archivo);
    });
  }
  










      
  
    
  
    cargarDocentes();
    GuardarASE();
    // cargarArchivo ();