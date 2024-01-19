const loginForm = document.querySelector('#loginForm');

loginForm.addEventListener('submit', async (e) => {
  e.preventDefault();

  const email = document.querySelector('#email').value;
  const password = document.querySelector('#password').value;
  const accion = "AUTH";

  $.post('auth/controller/rutas.php', { auth: email, key: password, accion: 'AUTH' })
    .done((resp) => {
      // console.log("Respuesta del servidor:", resp);
      try {
        // Intenta parsear la respuesta y maneja el error si no es un JSON válido
        const array = JSON.parse(resp);

        if (array.found == true) {
          const nombreCompleto = array.NombreMa + ' ' + array.a_paternoJM + ' ' + array.a_maternoJM;
    

          Swal.fire({
            title: '¡Bienvenido Maestro!',
            html: `<p style="color: #008000;">Usuario: ${nombreCompleto}</p>`,
       
            icon: 'success',
            timer: 2000,
            closeOnClickOutside: false,
            closeOnEsc: false,
          }).then(() => {
            // Guardar el estado de inicio de sesión en el almacenamiento local
            localStorage.setItem('sesionIniciada', 'true');

            // Redirigir a la página con el nombre de usuario como parámetro en la URL
            window.location.href = `Jefatura/index.php?nombre=${encodeURIComponent(nombreCompleto)}`;
          });
        } else {
          Swal.fire('Error', array.msg, 'error');
        }
      } catch (e) {
        // Si la respuesta no es JSON válido, muestra un mensaje de error
        console.error("Error al parsear la respuesta JSON: ", e);
        Swal.fire('Error', 'La respuesta del servidor no es válida', 'error');
      }
    })
    .fail(() => {
      // Maneja el error si la petición AJAX falla
      Swal.fire('Error', 'Ocurrió un error en el servidor', 'error');
    });
});
