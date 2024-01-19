
function updateDateTime() {
    const dateTimeElement = document.getElementById('current-date-time');
    const currentDate = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = currentDate.toLocaleDateString('es-ES', options);

    // Ajusta las opciones para mostrar la hora en formato de 12 horas con AM/PM
    const timeOptions = { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true };
    const formattedTime = currentDate.toLocaleTimeString('es-ES', timeOptions);

    const dateTimeString = formattedDate + ' ' + formattedTime;
    dateTimeElement.textContent = dateTimeString;
}

// Llama a la función para actualizar la fecha en el momento de carga de la página
updateDateTime();

// Actualiza la fecha cada segundo (1000 milisegundos)
setInterval(updateDateTime, 1000);

