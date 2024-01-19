// llenar select periodo
$(document).ready(function () {
  const accion = 'Buscar_Periodo'
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
          $('#PeriodoDoc').append(`<option value="${data[i]}">${data[i]}</option>`)
        }
      } else {
        alert('No se encontraron registros.')
      }
      
    },
    error: function (status) {
      
    }
  })
})

// trae datos docente
$(document).ready(function() {
  // Obtener el ID del periodo seleccionado
  $('#PeriodoDoc').change(function() {
    actualizarSelectDocentes();
  });
});

$(document).ready(function() {
  // Traer datos materia
  $('#Doncentes_AE').change(function() {
    actualizarSelectMaterias();
  });
});

$(document).ready(function() {
  // Trae datos semestre
  $('#colores').change(function() {
    actualizarSelectSemestre();
  });
});

// Función para actualizar el select de docentes
function actualizarSelectDocentes() {
  var nombrePeriodo = $('#PeriodoDoc').val();

  // Realizar la petición AJAX y actualizar el select de docentes
  const accion = 'buscar_docente';
  var datos = { accion: accion, nombrePeriodo: nombrePeriodo };
  var data;

  $.ajax({
    url: 'controller/rutas.php',
    type: 'POST',
    dataType: 'json',
    data: datos,
    success: function(responseData) {
      data = responseData;
      $('#Doncentes_AE').empty();

      if (data.length > 0) {
        for (var i = 0; i < data.length; i++) {
          $('#Doncentes_AE').append(`<option value="${data[i].id_docente}">${data[i].nombreCompleto}</option>`);
        }
      } else {
        Swal.fire({
          title: 'Error',
          text: 'No se encontraron docentes relacionados con el periodo seleccionado.',
          icon: 'error',
          confirmButtonText: 'Aceptar'
        });
      }
      
      actualizarSelectMaterias(); // Actualizar el siguiente select después de obtener los docentes
    },
    error: function(status) {
      
    }
  });
}

// Función para actualizar el select de materias
function actualizarSelectMaterias() {
  var id_docente = $('#Doncentes_AE').val();
  var nombrePeriodo = $('#PeriodoDoc').val();

  // Realizar la petición AJAX y actualizar el select de materias
  const accion = 'buscar_materiaAS';
  var datos = { accion: accion, Doncentes_AE: id_docente, nombrePeriodo:nombrePeriodo };
  var data;

  $.ajax({
    url: 'controller/rutas.php',
    type: 'POST',
    dataType: 'json',
    data: datos,
    success: function(responseData) {
      if (responseData.length > 0) {
        $('#colores').empty();
        for (var i = 0; i < responseData.length; i++) {
          $('#colores').append(`<option value="${responseData[i].id_materia}">${responseData[i].nombre_mat}</option>`);
        }
      } else {
        Swal.fire({
          title: 'Error',
          text: 'No se encontró una materia relacionada.',
          icon: 'error',
          confirmButtonText: 'Aceptar'
        });
      }
      
      actualizarSelectSemestre(); // Actualizar el siguiente select después de obtener las materias
    },
    error: function(status) {
      
    }
  });
}

// Función para actualizar el select de semestre
function actualizarSelectSemestre() {
  var id_materiaImpartida = $('#colores').val();

  // Realizar la petición AJAX y actualizar el select de semestre
  const accion = 'buscar_semestre';
  var datos = { accion: accion, id_materiaImpartida: id_materiaImpartida };
  var semestre;
 
  $.ajax({
    url: 'controller/rutas.php',
    type: 'POST',
    dataType: 'json',
    data: datos,
    success: function(responseData) {
      semestre = responseData;
      $('#SemestreS').val(semestre);
      
    },
    error: function(status) {
      
    }
  });
}

// Evento click del botón para actualizar los select dependientes
$('#actualizarSelectsBtn').click(function() {
  actualizarSelects();
});

// Función para actualizar los select dependientes
function actualizarSelects() {
  actualizarSelectDocentes();
}



function cargarArchivo () {
    // Validación de los campos
    for (var i = 0; i < data.length; i++) {
      var fila = data[i]

      // Verificar campos vacíos
      if (!fila.MATRICULA) {
        Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "MATRICULA".', 'error')
        return
      }
      if (!fila['VALORACION NUMERICA']) {
        Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "VALORACION NUMERICA".', 'error')
        return
      }
      if (!fila.OBSERVACIONES) {
        Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "OBSERVACIONES".', 'error')
        return
      }
      if (!fila['TIPO DE CURSO']) {
        Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "TIPO DE CURSO".', 'error')
        return
      }
      if (!fila['NIVEL DE DESEMPEÑO']) {
        Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un campo vacío en "NIVEL DE DESEMPEÑO".', 'error')
        return
      }

      // Validar formato de Tipo de curso
      if (!/^[NRGE]$/.test(fila['TIPO DE CURSO'])) {
        Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un tipo de curso no válido en "TIPO DE CURSO". Solo se permiten las letras N, R y G. ERROR:' + fila['TIPO DE CURSO'], 'error')
        return
      }
      // Validar valoración numérica
      if (!/^\d{1,2}$|^100$/.test(fila['VALORACION NUMERICA'])) {
        Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene una valoración numérica no válida en "VALORACION NUMERICA": ' + fila['VALORACION NUMERICA'], 'error')
        return
      }

      // Validar formato de matrícula
      if (!/^(\d{2})VC(\d{4})$/.test(fila.MATRICULA)) {
        Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene una matrícula no válida en "MATRICULA". Verifica que tenga el formato permitido: 00VC0000', 'error')
        return
      }

      // Validar formato de observaciones
      if (!/^(EP|ES|NA)$/.test(fila.OBSERVACIONES)) {
        Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene una observación no válida en "OBSERVACIONES". Solo se permiten las palabras EP, ES y NA  ERROR:' + fila['OBSERVACIONES'], 'error')
        return
      }

      // Validar formato de Nivel de Desempeño
      if (!/^(EXCELENTE|NOTABLE|BUENO|SUFICIENTE|INSUFICIENTE)$/.test(fila['NIVEL DE DESEMPEÑO'])) {
        Swal.fire('Error', 'La fila ' + (i + 1) + ' contiene un nivel de desempeño no válido en "NIVEL DE DESEMPEÑO". Solo se permiten las palabras EXCELENTE, NOTABLE, BUENO, SUFICIENTE e INSUFICIENTE. ERROR:' + fila['NIVEL DE DESEMPEÑO'], 'error')
        return
      }
      // Validar relacion entre desempeño y valoracion numerica
      var nivelDesempeno = ''

      var valoracionNumerica = parseInt(fila['VALORACION NUMERICA'])
      if (valoracionNumerica >= 95) {

        nivelDesempeno = 'EXCELENTE'
      } else if (valoracionNumerica >= 85 && valoracionNumerica <= 94) {
        nivelDesempeno = 'NOTABLE'

      } else if (valoracionNumerica >= 75 && valoracionNumerica <= 84) {
        nivelDesempeno = 'BUENO'

      } else if (valoracionNumerica >= 70 && valoracionNumerica <= 74) {
        nivelDesempeno = 'SUFICIENTE'

      } else {
        nivelDesempeno = 'INSUFICIENTE'
      } 

      if (fila['NIVEL DE DESEMPEÑO'] !== nivelDesempeno) {
        Swal.fire('Error', 'La fila ' + (i + 1) + ' tiene un valor de "NIVEL DE DESEMPEÑO" incorrecto. Debería ser ' + nivelDesempeno + '.', 'error')
        return




      //validar mas cosas aqui función test().
      }

      Swal.fire('Éxito', 'Los datos se cargaron correctamente', 'success')
      
    }
  }
// }

function GuardarASE() {
  var contador = 0;

  $("#btncargar").on("click", function (e) {
    contador++;
    

    var periodo = $("#PeriodoDoc option:selected").text().trim();
    var materia = $("#colores option:selected").text().trim();
    var docente = $("#Doncentes_AE option:selected").text().trim();
    var semestre = $('#SemestreS').val().trim();

    var archivo = document.getElementById('file_image').files[0];
    var lector = new FileReader();

    lector.onload = function (e) {
      var contenido = e.target.result;
      var workbook = XLSX.read(contenido, { type: 'array' });
      var sheetName = workbook.SheetNames[0];
      var worksheet = workbook.Sheets[sheetName];
      var data = XLSX.utils.sheet_to_json(worksheet);

      var dataToSend = new FormData();
      dataToSend.append('nombrePeriodo', periodo);
      dataToSend.append('nombreD', docente);
      dataToSend.append('nombre_mat', materia);
      dataToSend.append('semestreM', semestre);
      dataToSend.append('accion', 'insertar_asignacion_estudiante');

      // Verificar si el archivo contiene las columnas requeridas
      var columnasRequeridas = ['MATRICULA', 'VALORACION NUMERICA', 'OBSERVACIONES', 'TIPO DE CURSO', 'NIVEL DE DESEMPENO'];
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

        // Validaciones...
        if (!fila.MATRICULA) {
          Swal.fire('Error', 'La fila ' + (i + 2) + ' contiene un campo vacío en "MATRICULA".', 'error');
          return;
        }
        var valoracionNumerica = fila['VALORACION NUMERICA'];
        if (valoracionNumerica === undefined || valoracionNumerica === null || valoracionNumerica === '') {
          Swal.fire('Error', 'La fila ' + (i + 2) + ' contiene un campo vacío en "VALORACION NUMERICA".', 'error');
          return;
        }

        valoracionNumerica = parseInt(valoracionNumerica);
        if (isNaN(valoracionNumerica) || valoracionNumerica < 0 || valoracionNumerica > 100) {
          Swal.fire('Error', 'La fila ' + (i + 2) + ' contiene un valor no válido en "VALORACION NUMERICA". Debe ser un número del 0 al 100.', 'error');
          return;
        }

        if (!fila.OBSERVACIONES) {
          Swal.fire('Error', 'La fila ' + (i + 2) + ' contiene un campo vacío en "OBSERVACIONES".', 'error');
          return;
        }
        if (!fila['TIPO DE CURSO']) {
          Swal.fire('Error', 'La fila ' + (i + 2) + ' contiene un campo vacío en "TIPO DE CURSO".', 'error');
          return;
        }
        if (!fila['NIVEL DE DESEMPENO']) {
          Swal.fire('Error', 'La fila ' + (i + 2) + ' contiene un campo vacío en "NIVEL DE DESEMPENO".', 'error');
          return;
        }

        // Validar formato de Tipo de curso
        if (!/^[NRGE]$/.test(fila['TIPO DE CURSO'])) {
          Swal.fire('Error', 'La fila ' + (i + 2) + ' contiene un tipo de curso no válido en "TIPO DE CURSO". Solo se permiten las letras N, R y G. ERROR:' + fila['TIPO DE CURSO'], 'error');
          return;
        }
        // Validar valoración numérica
        if (!/^\d{1,2}$|^100$/.test(fila['VALORACION NUMERICA'])) {
          Swal.fire('Error', 'La fila ' + (i + 2) + ' contiene una valoración numérica no válida en "VALORACION NUMERICA": ' + fila['VALORACION NUMERICA'], 'error');
          return;
        }

        // Validar formato de matrícula
        if (!/^(\d{2})VC(\d{4})$/.test(fila.MATRICULA)) {
          Swal.fire('Error', 'La fila ' + (i + 2) + ' contiene una matrícula no válida en "MATRICULA". Verifica que tenga el formato permitido: 00VC0000', 'error');
          return;
        }

        // Validar formato de observaciones
        if (!/^(EP|ES|NA)$/.test(fila.OBSERVACIONES)) {
          Swal.fire('Error', 'La fila ' + (i + 2) + ' contiene una observación no válida en "OBSERVACIONES". Solo se permiten las palabras EP, ES y NA  ERROR:' + fila['OBSERVACIONES'], 'error');
          return;
        }

        // Validar formato de Nivel de Desempeño
        if (!/^(EXCELENTE|NOTABLE|BUENO|SUFICIENTE|INSUFICIENTE)$/.test(fila['NIVEL DE DESEMPENO'])) {
          Swal.fire('Error', 'La fila ' + (i + 2) + ' contiene un nivel de desempeño no válido en "NIVEL DE DESEMPEÑO". Solo se permiten las palabras EXCELENTE, NOTABLE, BUENO, SUFICIENTE e INSUFICIENTE. ERROR:' + fila['NIVEL DE DESEMPENO'], 'error');
          return;
        }

        // Validar relación entre desempeño y valoración numérica
        var nivelDesempeno = '';
        var valoracionNumerica = parseInt(fila['VALORACION NUMERICA']);

        if (valoracionNumerica >= 95) {
          nivelDesempeno = 'EXCELENTE';
        } else if (valoracionNumerica >= 85 && valoracionNumerica <= 94) {
          nivelDesempeno = 'NOTABLE';
        } else if (valoracionNumerica >= 75 && valoracionNumerica <= 84) {
          nivelDesempeno = 'BUENO';
        } else if (valoracionNumerica >= 70 && valoracionNumerica <= 74) {
          nivelDesempeno = 'SUFICIENTE';
        } else {
          nivelDesempeno = 'INSUFICIENTE';
        }

        if (fila['NIVEL DE DESEMPENO'] !== nivelDesempeno) {
          Swal.fire('Error', 'La fila ' + (i + 2) + ' tiene un valor de "NIVEL DE DESEMPENO" incorrecto. Debería ser ' + nivelDesempeno + '.', 'error');
          return;
        }

        // Agregar datos al formulario
        dataToSend.append('matriculaE[]', fila.MATRICULA);
        dataToSend.append('valoracionN[]', fila['VALORACION NUMERICA']);
        dataToSend.append('observaciones[]', fila.OBSERVACIONES);
        dataToSend.append('tipoCurso[]', fila['TIPO DE CURSO']);
        dataToSend.append('nivelDesempeno[]', fila['NIVEL DE DESEMPENO']);
      }

      if (materia == "") {
        Swal.fire({
          title: "Todos los campos son obligatorios",
          text: "Ingrese una materia",
          icon: "warning",
          showCancelButton: true,
        });
        return false;
      } else {
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
                  })
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



GuardarASE();
cargarArchivo () ;