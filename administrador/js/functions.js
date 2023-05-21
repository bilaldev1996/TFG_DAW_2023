/**
 * La función alterna la visibilidad de un campo de entrada de contraseña.
 */
function togglePassword() {
    let passwordInput = document.getElementById('password');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
}

function togglePasswordConfirm() {
    let passwordInput = document.getElementById('password-confirm');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
}

/**
 * Esta función valida la entrada de un correo electrónico y muestra un mensaje de error si el correo
 * electrónico es incorrecto.
 */
function validarEmail() {
    const form = document.getElementById('formEnvioEmail');

    if (form !== null) {
        form.addEventListener('submit', () => {
            event.preventDefault();
            let email = document.getElementById(
                'emailRestablecer'
            ).value;
            console.log(email);

            if (email != 'bilalmessaoui96@gmail.com') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El email es incorrecto!',
                    timer: 2000,
                    showConfirmButton: false,
                });

                return;
            }

            form.submit();
        });
    }
}

validarEmail();

/**
 * Esta función valida si dos contraseñas coinciden y muestra un mensaje de error si no lo hacen.
 */
function validarContraseñas() {
    let form = document.getElementById('formRestablecer');

    if (form !== null) {
        form.addEventListener('submit', () => {
            event.preventDefault();

            let pass1 = document.getElementById('password').value;
            let pass2 = document.getElementById(
                'password-confirm'
            ).value;
            if (pass1 != pass2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Las contraseña no coinciden!',
                    timer: 2000,
                    showConfirmButton: false,
                });
                return;
            }

            form.submit();
        });
    }
}

validarContraseñas();

/**
 * La función confirma si el usuario desea eliminar un registro y envía una solicitud al servidor para
 * eliminarlo si se confirma.
 * @param id - El ID del registro que el usuario desea eliminar.
 * @param accion - La acción que se realizará cuando el usuario confirme la eliminación. Se pasa como
 * un parámetro en la URL.
 */
function confirmarEliminar(id, accion) {
    const url = `index.php?action=${accion}&id=${id}`;

    Swal.fire({
        icon: 'info',
        title: 'Eliminar',
        text: '¿Estás seguro de que quieres eliminar este registro?',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(url);
            location.reload();
        }
    });
}

/* JS SECCION CENTROS */
/**
 * Esta función valida un formulario de registro para un centro y evita el envío si los campos no son
 * válidos.
 */
function ValidarFormularioRegistroCentro() {
    const formulario = document.getElementById(
        'formularioRegistroCentro'
    );

    if (!formulario) {
        return;
    }

    formulario.addEventListener('submit', () => {
        event.preventDefault();

        if (validarCamposRegistroCentro()) {
            formulario.submit();
        }
    });
}
/**
 * Esta función valida los campos de entrada para dar de alta un centro y devuelve verdadero si no hay
 * errores.
 * @returns un valor booleano, que es verdadero si todos los campos obligatorios se completaron
 * correctamente y falso si hay algún error.
 */
function validarCamposRegistroCentro() {
    const nombre = document.getElementById('nombre');
    const direccion = document.getElementById('direccion');
    const telefono = document.getElementById('telefono');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    let errores = false;

    if (nombre.value.trim() === '') {
        campoErroneo(nombre, 'El campo "Nombre" es obligatorio.');
        errores = true;
    } else {
        campoCorrecto(nombre);
    }

    if (telefono.value.trim() === '') {
        campoErroneo(telefono, 'El campo "Teléfono" es obligatorio.');
        errores = true;
    } else {
        campoCorrecto(telefono);
    }

    if (direccion.value.trim() === '') {
        campoErroneo(
            direccion,
            'El campo "Dirección" es obligatorio.'
        );
        errores = true;
    } else {
        campoCorrecto(direccion);
    }

    if (email.value.trim() === '') {
        campoErroneo(email, 'El campo "Email" es obligatorio.');
        errores = true;
    } else if (!validarEmail(email.value.trim())) {
        campoErroneo(email, 'El email no es válido.');
        errores = true;
    } else {
        campoCorrecto(email);
    }

    if (password.value.trim() === '') {
        campoErroneo(
            password,
            'El campo "Contraseña" es obligatorio.'
        );
        errores = true;
    } else if (!validarPassword(password.value.trim())) {
        campoErroneo(
            password,
            'La contraseña debe tener al menos 8 caracteres y contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.'
        );
        errores = true;
    } else {
        campoCorrecto(password);
    }

    return !errores;
}

ValidarFormularioRegistroCentro();

/**
 * La función agrega un mensaje de error y un borde rojo a un campo de formulario.
 * campo - El parámetro campo es una referencia a un elemento de entrada HTML que tiene un error
 * o un valor no válido.
 *  mensaje - El mensaje de error que se mostrará al usuario cuando la entrada en el campo sea
 * incorrecta o no válida.
 */

function campoErroneo(campo, mensaje) {
    const grupo = campo.parentNode;
    const mensajeError = grupo.querySelector('.text-red-500');

    campo.classList.add('border-red-500');
    mensajeError.textContent = mensaje;
    mensajeError.classList.remove('hidden');
}

/**
 * La función actualiza el estilo de un campo de formulario para indicar que es correcto y oculta los
 * mensajes de error asociados con él.
 *  campo - El campo de entrada que necesita ser validado y corregido.
 */
function campoCorrecto(campo) {
    const grupo = campo.parentNode;
    const mensajeError = grupo.querySelector('.text-red-500');

    campo.classList.remove('border-red-500');
    campo.classList.add('border-green-500');
    mensajeError.classList.add('hidden');
}

/**
 * La función valida si un número de teléfono tiene exactamente 9 dígitos.
 * @param telefono - telefono es un parámetro de la función "validarTelefono". Representa un número de
 * teléfono que se validará mediante una expresión regular.
 * @returns un valor booleano (verdadero o falso) dependiendo de si el parámetro de entrada "telefono"
 * coincide o no con la expresión regular /^\d{9}$/.
 */
function validarTelefono(telefono) {
    const re = /^\d{9}$/;
    return re.test(telefono);
}

/**
 * La función valida si una dirección de correo electrónico tiene el formato correcto.
 * @param email - El parámetro de correo electrónico es una cadena que representa una dirección de
 * correo electrónico que debe validarse.
 * @returns La función `validarEmail` devuelve un valor booleano que indica si la entrada `email` es
 * una dirección de correo electrónico válida o no.
 */
function validarEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}
/**
 * La función valida si una contraseña cumple con ciertos criterios.
 * @param password - El parámetro de entrada para la función `validarPassword()`. Es la cadena de
 * contraseña que necesita ser validada.
 * @returns La función `validarPassword` devuelve un valor booleano que indica si el parámetro
 * `password` cumple con los criterios especificados para una contraseña segura.
 */

function validarPassword(password) {
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    return re.test(password);
}
