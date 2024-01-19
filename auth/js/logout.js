// Función para cerrar sesión
function cerrarSesion() {
    // Mostrar mensaje de "Cerrando sesión"
    Swal.fire({
        title: 'Cerrando sesión',
        showConfirmButton: false,
        allowOutsideClick: false,
        timer: 2000,
        onBeforeOpen: () => {
            Swal.showLoading();
        }
    });

    // Eliminar el estado de inicio de sesión del almacenamiento local
    localStorage.removeItem('sesionIniciada');

    // Redireccionar a la página de inicio de sesión después de 2 segundos
    setTimeout(() => {
        window.location.href = '../login.php';
    }, 2000);
}

// Evento click para el botón de cerrar sesión
const cerrarSesionBtn = document.querySelector('#cerrarSesionBtn');
if (cerrarSesionBtn) {
    cerrarSesionBtn.addEventListener('click', cerrarSesion);
}

// Verificar si el usuario ha iniciado sesión mediante el almacenamiento local
window.addEventListener('DOMContentLoaded', () => {
    if (!localStorage.getItem('sesionIniciada')) {
        // El usuario no ha iniciado sesión, redireccionar al formulario de inicio de sesión
        window.location.href = '../login.php'; // Reemplaza 'login.php' con la ruta correcta de la página de inicio de sesión
    }
});
