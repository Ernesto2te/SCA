$(document).ready(function(){
  var miContenedor = document.getElementById("tabla");

  // Ocultar el contenedor
  miContenedor.style.display = "none";

  $("#buscarM").on('click', function(e) {
    var table = $('#cargastable').DataTable();
    table.destroy();

    e.preventDefault();
    let matricula = $("#buscartxt").val();
    if (matricula == '') {
      swal({
        title: '¡Atención!',
        text: 'Este campo es obligatorio',
        icon: 'warning',
        button: true,
      });
      return false;
    }
    else{
  getboleta(matricula)
    }
   
  });
  
})



const getboleta  = async(matricula) =>{
  var miContenedor = document.getElementById("tabla");

  // Ocultar el contenedor
  miContenedor.style.display = "";

  $('#cargastable').DataTable({
      "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      }
  });
  var datos = {
      accion: "GETcargas",
      matricula: matricula,
  };
  $.ajax({
      url: "controller/rutas1.php",
      type: "POST",
      dataType: "json",
      data: datos, // Enviar el dato en la petición
      success: function (response) {
        console.log(response)
          cargas = response.cargas
          servidor = response.server
          var tablaMaterias = $('#cargastable').DataTable();
          tablaMaterias.clear().draw();
          $.each(cargas, function (index, value) {
              tablaMaterias.row.add([
                  value.Nombres + ' ' + value.a_paternoA + ' ' + value.a_maternoA,
                  value.matricula,
                  value.nombrePeriodo,
                  '<a href="http://' + servidor + '/SCA/pdfMVC/?uid=' + value.matricula + ' &token=' + value.nombrePeriodo + ' " target="_blank" style="color: #f00f0f;">PDF <i class="icon-file"></i></a>',
//CUANDO SE MONTE EN EL SERVIDOR COMENTAR LA DE ARRIBA Y PONER LA DE ABAJO 
                  //'<a href="http:// ' + servidor + '/pdfMVC/?uid=' + value.matricula + ' &token=' + value.nombrePeriodo + ' " target="_blank" style="color: #f00f0f;">PDF <i class="icon-file"></i></a>',

                ]).draw();
             
          });
      },
      error: function (xhr, status, error) {

      }
  });

};

