let id_rfc = ""; //esta sera una variable global esto se creo para actualizar docentes unicamente


// $(document).ready(function () {
//   const accion = 'BuscarCarreras'
//   var datos = { accion: accion }
//   var data

//   $.ajax({
//     url: 'controller/rutas.php',
//     type: 'POST',
//     dataType: 'json',
//     data: datos,
//     success: function (responseData) {
//       data = responseData
//       if (data.length > 0) {
//         // Si hay datos, creamos las opciones del select
//         for (var i = 0; i < data.length; i++) {
//           $('#aE').append(`<option value="${data[i].id_carrera}">${data[i].nombreCarrera}</option>`)
//         }
//       } else {
//         alert('No se encontraron registros.')
//       }
//       console.log(data)
//     },
//     error: function (status) {
//       console.log(status)
//     }
//   })
// })



function validarDocente() //Funcion para cachar el evento clic
{
  //evento cuando el usuario de click buscara el ID y ejecutara una funcion
  $("#guardarDocente").on("click", function (e) {

    e.preventDefault() //previene acciones por parte de html
    var nombreD = document.getElementById("nomb_D").value;
    var apellidoPD = document.getElementById("apaterno_D").value;
    var apellidoMD = document.getElementById("amaterno_D").value;
    var rfcD = document.getElementById("rfc_D").value;//se agrega rfc
    var nivelestuD = document.getElementById("nivelestudios_D").value;
    var estatusD = document.getElementById("status_D").value;
    var carreraD = document.getElementById("area_D").value;


    var expresion_letras = /^[a-zA-Z\u00C0-\u017F ]+$/; //Validacion solo letras (caracteres especiales, numeros)
    var expresion_rfc = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/; //Validacion RFC
    var expresion_datos_inst = /[a-z]+\./; //Validacion de nivel de estudios (letras, punto)
    var expresion_nivel_pro = /^[a-zA-Z ]+$/; //Validacion nivel del profesor
    var expresion_horas_asig = /^[0-9]+$/;
    var expresion_correo = /[a-z]+\.[a-z]+\@itsvc.edu.mx/;

    if (nombreD === "") {
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el Nombre",
        icon: "warning",
        button: true,
      });
      return false;
    } else if (!expresion_letras.test(nombreD)) {
      swal({
        title: "Verifica que el nombre del docente sea correcto",
        text: "Solo se permiten letras en el nombre del docente",
        icon: "error",
        button: true,
      });
      return false;
    } else if (apellidoPD === "") {
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el Apellido Paterno",
        icon: "warning",
        button: true,
      });
      return false;
    } else if (!expresion_letras.test(apellidoPD)) {
      swal({
        title: "Verifica que el apellido paterno del docente sea correcto",
        text: "Solo se permiten letras en el apellido paterno del docente",
        icon: "error",
        button: true,
      });
      return false;
    } else if (apellidoMD === "") {
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el Apellido Materno",
        icon: "warning",
        button: true,
      });
      return false;
    } else if (!expresion_letras.test(apellidoMD)) {
      swal({
        title: "Verifica que el apellido materno del docente sea correcto",
        text: "Solo se permiten letras en el apellido materno del docente",
        icon: "error",
        button: true,
      });
      return false;
    } else if (rfcD === "") {     //se agrego el campo rfc
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el RFC",
        icon: "warning",
        button: true,
      });
      return false;
    } else if (!expresion_rfc.test(rfcD)) {
      swal({
        title: "Verifica que el RFC del docente sea correcto",
        text: "Solo se permiten caracteres de tipo alfanumérico en este campo",
        icon: "error",
        button: true,
      });
      return false;
    }
    else if (nivelestuD === "") {
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el Nivel de Estudios",
        icon: "warning",
        button: true,
      });
      return false;
    } else if (!expresion_datos_inst.test(nivelestuD)) {
      swal({
        title: "¡Atención!",
        text: "Solo se permiten letras en el Nivel de Estudios",
        icon: "error",
        button: true,
      });
      return false;
    } else if (nivelestuD.length < 3 || nivelestuD.length > 5) {
      swal({
        title: "Alerta",
        text: "Solo se permiten de 3-5 dígitos",
        icon: "error",
        button: true,
      });
      return false;
    } 
     else if (carreraD === "") {
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el Área del Profesor",
        icon: "warning",
        button: true,
      });
      return false;
    } else if (estatusD === "") {
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el Status del Docente",
        icon: "warning",
        button: true,
      });
      return false;
    } // Esto debe de estar a fuerza porque desde aqui empezaremos con Ajax
    else {
      swal({
        title: "¡Atención!",
        text: "¿Deseas agregar a este docente?",
        icon: "info",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {   //Promesa
        if (willDelete) {

          const accion = "insertarDocente";//enciamos al switch

          const data = new FormData() //Instanciando un formulario
          data.append('nombreD', nombreD) //Agregamos elementos a los formularios
          data.append('a_paternoD', apellidoPD)
          data.append('a_maternoD', apellidoMD)
          data.append('rfc_D', rfcD)
          data.append('nivel_estudios', nivelestuD)
          data.append('statusD', estatusD)
          data.append('id_carrera', carreraD)
    
          data.append('accion', accion) //instancial el switch

          $.ajax({ //instanciando ajax
            type: 'POST',  //especificando el tipo de envio
            url: "controller/rutas.php", //donde se van a enviar los datos
            data: data, //que datos se van a enviar
            contentType: false, //si nosotros queremos especificar el tipo de contenido 
            processData: false, //si quieremos procesar los datos
            success: function (data) {
              if (data.includes("Error")) {
                swal({
                  title: '¡Error!',
                  text: "RFC Duplicado, Ingrese un RFC válido",
                  icon: 'warning',
                  button: true,
                });
              } else {
                swal({
                  title: 'Correcto',
                  text: "Docente Registrado Correctamente",
                  icon: 'success',
                  button: true,
                }).then(() => {
                  //location.reload(); // Recargar la página
                });
                // Restablecer los valores de los campos
                document.getElementById("nomb_D").value = "";
                document.getElementById("apaterno_D").value = "";
                document.getElementById("amaterno_D").value = "";
                document.getElementById("rfc_D").value = "";
                document.getElementById("nivelestudios_D").value = "";
                document.getElementById("status_D").value = "";
                document.getElementById("area_D").value = "";
              }
            }
            
          })

        }
        else {
          swal({
            title: "Información",
            text: "Operación Cancelada",
            icon: "error",
            button: true,
          });
        }
      })
    }
  })
}

//Empieza la funcion para buscar Docentes
const buscarDocentes = () => {
  $("#btnbuscarD").on("click", function (e) {
    e.preventDefault() //bloquea las acciones del navegador
    let buscarDocente = $("#buscardocente").val() //trea la informacion del input buscardocentesview

    if (buscarDocente == "") {
      swal({
        title: "¡Atención!",
        text: "Este campo es obligatorio",
        icon: "warning",
        button: true,
      });
      return false;
    }
    const accion = "buscarDocente"  //buscar docente, la accion que se va a ejecutar una vez a rutas.php
    $("#tabladocentes").DataTable().destroy() //Destruye la tabla actual para que pueda realizar una nueva busqueda
    fBuscarDocente(buscarDocente, accion) //llamando a al funcion de buscar la asignatura de docentes
  })
}

function fBuscarDocente(buscarDocente, accion) { //creamos una funcion reutilizable
  $.ajax({
    url: "controller/rutas.php",
    type: "POST",
    data: {
      busqueda: buscarDocente,
      accion: accion
    },
    dataType: "json",
    success: function (data) {

      $("#tabladocentes").DataTable({      //estamos ejecutando un objeto como metodo debemos darle un objeto. 
        "data": data,                    //va a recibir los datos dxe nuestro ajax :v 
        "resposnsive": true,               //es que nuestra tabla sea adapativa o se adapte a cualquier tamaño
        "columns": [                        //pintar las columnas que provienen de nuestro ajax
          {

            className: 'text-left',
            render: function (data, type, row, meta) //va a modificar la columna que 
            {
              let columnanombreD = row.nombreD + " " + row.a_paternoD + " " + row.a_maternoD //concatenar 3 datos en un input
              return columnanombreD
            }
          },

          {
            "data": "rfc_D"
          },

          {
            "data": "nivel_estudios"
          },

          {
            "data": "statusD"
          },

          {
            "data": "id_carrera"
          },

          {
            data: null,
            className: 'text-left',
            render: function (data, type, row, meta) {
              let btneditarD = '<button type="button" class="me-2 btn btn-primary btn-rounded actualizar btn-sm" style="background-color: #FB4570;" rfc="' + row.rfc_D + '" nombreD="' + row.nombreD + '" a_paterno="' + row.a_paternoD + '" a_maternoD="' + row.a_maternoD + '" nivel_estudios="' + row.nivel_estudios + '" statusD="' + row.statusD + '" id_carrera="' + row.id_carrera + '">Editar <i class="fa fa-pencil"></i></button>';
              return btneditarD  //nota revisar que todo este bien escrito
            }
          }

        ],
        drawCallback: function () //va a obetener la informacion de los items de mi tabla
        {
          $(".actualizar").on("click", function (e) { //el actualizar va arriba en el btneditar
            e.preventDefault()
            editarDocente($(this).attr("rfc"), $(this).attr("nombreD"), $(this).attr("a_paterno"), $(this).attr("a_maternoD"), $(this).attr("nivel_estudios"), $(this).attr("id_carrera"), $(this).attr("statusD"))
          })

        }
      })
    },
    error: function (e) {
      
    }
  })
}

function editarDocente(rfc_D, nombredocente, apellido_paterno, apellido_materno, nivel_estudios, id_carrera, status ) {
  $("#ActualizarDocente").modal("show")  //ejecutar el modal al ejecutar la funcion

  $("#actualizarnomD").val(nombredocente)
  $("#apE").val(apellido_paterno)
  $("#amE").val(apellido_materno)
  $("#neE").val(nivel_estudios)
  $("#aE").val(id_carrera)
  $("#status").val(status)

  id_rfc = rfc_D


} 

function enviarDocente() //le ponemos como querramos
{
  $("#enviared").on("click", function (e) {
    e.preventDefault(); //para que el navegador no modifque 


    let nomb_D = $("#actualizarnomD").val();
    let apaterno_D = $("#apE").val();
    let amaterno_D = $("#amE").val();
    let nivelestudios_D = $("#neE").val();
    let id_carrera = $("#aE").val(); // Cambiar el nombre de la variable a "idCarrera"
    let status_D = $("#status").val();

    //Expresiones regulares
    var expresion_letras = /^[a-zA-Z\u00C0-\u017F ]+$/; //Validacion solo letras (caracteres especiales, numeros)
    var expresion_rfc = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/; //Validacion RFC
    var expresion_datos_inst = /[a-z]+\./; //Validacion de nivel de estudios (letras, punto)
    var expresion_nivel_pro = /^[a-zA-Z ]+$/; //Validacion nivel del profesor
    var expresion_horas_asig = /^[0-9]+$/;
    var expresion_correo = /[a-z]+\.[a-z]+\@itsvc.edu.mx/;
    var expresion_pass = /17+[A-Z]{2}\d{4}/;
    //var expresion_area = /^[a-zA-ZÀ-ÿ\s]+$/;

    //validaciones
    if (nomb_D === "") {
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el Nombre",
        icon: "warning",
        button: true,
      });
      return false;
    } else if (!expresion_letras.test(nomb_D)) {
      swal({
        title: "Verifica que el nombre del docente sea correcto",
        text: "Solo se permiten letras en el nombre del docente",
        icon: "error",
        button: true,
      });
      return false;
    } else if (apaterno_D === "") {
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el Apellido Paterno",
        icon: "warning",
        button: true,
      });
      return false;
    } else if (!expresion_letras.test(apaterno_D)) {
      swal({
        title: "Verifica que el apellido paterno del docente sea correcto",
        text: "Solo se permiten letras en el apellido paterno del docente",
        icon: "error",
        button: true,
      });
      return false;
    }
    else if (amaterno_D === "") {
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el Apellido Materno",
        icon: "warning",
        button: true,
      });
      return false;
    } else if (!expresion_letras.test(amaterno_D)) {
      swal({
        title: "Verifica que el apellido materno del docente sea correcto",
        text: "Solo se permiten letras en el apellido materno del docente",
        icon: "error",
        button: true,
      });
      return false;
    }
    else if (nivelestudios_D === "") {
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el Nivel de Estudios",
        icon: "warning",
        button: true,
      });
      return false;
    } else if (!expresion_datos_inst.test(nivelestudios_D)) {
      swal({
        title: "¡Atención!",
        text: "Solo se permiten letras en el Nivel de estudios",
        icon: "error",
        button: true,
      });
      return false;
    }
    else if (id_carrera === "") {
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el Área del Profesor",
        icon: "warning",
        button: true,
      });
      return false;
    // } else if (!expresion_area.test(id_carrera)) {
    //   swal({
    //     title: "Verifica que el área del docente sea correcto",
    //     text: "Solo se permiten letras en el área del docente",
    //     icon: "error",
    //     button: true,
    //   });
    //   return false;
    // } else if (status_D === "") {
      swal({
        title: "Todos los campos son obligatorios",
        text: "Ingresa el Status del Docente",
        icon: "warning",
        button: true,
      });
      return false;
    } else if (!expresion_letras.test(status_D)) {
      swal({
        title: "Verifica que el status del docente sea correcto",
        text: "Solo se permiten letras en el status del docente",
        icon: "error",
        button: true,
      });
      return false;
    }
    else {
      swal({
        title: "¡Atención!",
        text: "¿Deseas actualizar a este docente?",
        icon: "info",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          //enviar datos
          const accion = "actualizarDocente"

          const data = new FormData()
          data.append('nombreD', nomb_D);
          data.append('a_paternoD', apaterno_D);
          data.append('a_maternoD', amaterno_D);
          data.append('nivel_estudios', nivelestudios_D);
          data.append('id_carrera', id_carrera);
          data.append('statusD', status_D);
          data.append('rfc_D', id_rfc);
          data.append('accion', accion)
          console.log(id_rfc);
          console.log(id_carrera);
          console.log(data);

          $.ajax({
            type: 'POST',
            url: "controller/rutas.php",
            data: data,
            contentType: false,
            processData: false,
            success: function (data) {
              console.log(data);
              if (data != "") {
                swal({
                  title: "Perfecto",
                  text: `Docente Actualizado Correctamente`,
                  icon: "success",
                  button : true,
                  closeOnClickOutside: false,
                  // timer: 2000
                })
                  $("#ActualizarDocente").modal("hide") //va a ocultar o cerrar el modal
                  $("#tabladocentes").DataTable().destroy() //Destruye la tabla actual para que pueda realizar una nueva busqueda
                  fBuscarDocente(nomb_D,'buscarDocente') //Actualiza la tabla sin necidad de recargar
              }
            }
          })
        }
        else {
          swal({
            title: "¡Error!",
            text: "El docente no pudo ser actualizado",
            icon: "error",
            closeOnClickOutside: false,
            //timer: 2000
          })
        }
      })
    }
  })
}

enviarDocente()
validarDocente()
buscarDocentes()