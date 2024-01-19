const signupForm = document.querySelector('#signupForm');

signupForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const name = document.querySelector('#name').value;
    const email = document.querySelector('#email').value;
    const password = document.querySelector('#password').value;

    const Users = JSON.parse(localStorage.getItem('users')) || [];
    const isUserRegistered = Users.find(user => user.email === email);

    if (isUserRegistered) {
        swal('Error', 'El usuario ya está registrado', 'error');
    } else {
        Users.push({ name: name, email: email, password: password });
        localStorage.setItem('users', JSON.stringify(Users));
        swal('Registro Exitoso', '¡El registro se realizó correctamente!', 'success')
            .then(() => {
                window.location.href = 'login.php';
            });
    }
});
