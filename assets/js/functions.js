/* Ver contraseña */
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

/* Validar formulario restablecimiento contraseña */
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

/* Código para validar formulario de registroEstudiante */
function validarFormularioRegistro() {
    const formulario = document.getElementById('formularioRegistro');

    if (!formulario) {
        return;
    }

    formulario.addEventListener('submit', (event) => {
        event.preventDefault(); // prevenimos el envío del formulario

        // validamos los campos
        if (validarCampos()) {
            formulario.submit(); // Enviamos el formulario
        }
    });
}

function validarCampos() {
    const nombre = document.getElementById('nombre');
    const apellido1 = document.getElementById('apellido1');
    const apellido2 = document.getElementById('apellido2');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const telefono = document.getElementById('telefono');
    let errores = false;

    if (window.location.href.includes('registrarEstudiante')) {
        let imagen = document.getElementById('imagen');
        let curriculum = document.getElementById('curriculum');

        let extensionCV = curriculum.value
            .split('.')
            .pop()
            .toLowerCase();
        let extensionImagen = imagen.value
            .split('.')
            .pop()
            .toLowerCase();

        if (imagen.value == '') {
            campoErroneo(imagen, 'El campo "Imagen" es obligatorio.');
            errores = true;
        } else if (
            extensionImagen !== 'jpg' &&
            extensionImagen !== 'jpeg' &&
            extensionImagen !== 'png' &&
            extensionImagen !== 'gif'
        ) {
            campoErroneo(
                imagen,
                'El formato de la imagen no es válido. Debe ser JPG, JPEG, PNG o GIF.'
            );
            errores = true;
        } else {
            campoCorrecto(imagen);
        }

        if (curriculum.value == '') {
            campoErroneo(
                curriculum,
                'El campo "Curriculum" es obligatorio.'
            );
            errores = true;
        } else if (extensionCV !== 'pdf') {
            campoErroneo(
                curriculum,
                'El formato del currículum no es válido. Debe ser PDF.'
            );
        } else {
            campoCorrecto(curriculum);
        }
    }

    // Validamos el campo "Nombre"
    if (nombre.value.trim() === '') {
        campoErroneo(nombre, 'El campo "Nombre" es obligatorio.');
        errores = true;
    } else {
        campoCorrecto(nombre);
    }

    // Validamos el campo "Primer Apellido"
    if (apellido1.value.trim() === '') {
        campoErroneo(
            apellido1,
            'El campo "Primer Apellido" es obligatorio.'
        );
        errores = true;
    } else {
        campoCorrecto(apellido1);
    }

    // Validamos el campo "Segundo Apellido"
    if (apellido2.value.trim() === '') {
        campoErroneo(
            apellido2,
            'El campo "Segundo Apellido" es obligatorio.'
        );
        errores = true;
    } else {
        campoCorrecto(apellido2);
    }

    // Validamos el campo "Email"
    if (email.value.trim() === '') {
        campoErroneo(email, 'El campo "Email" es obligatorio.');
        errores = true;
    } else if (!validarEmail(email.value.trim())) {
        campoErroneo(email, 'El email no es válido.');
        errores = true;
    } else {
        campoCorrecto(email);
    }

    // Validamos el campo "Telefono"
    if (telefono.value.trim() === '') {
        campoErroneo(telefono, 'El campo "teléfono" es obligatorio.');
        errores = true;
    } else if (!validarTelefono(telefono.value.trim())) {
        campoErroneo(telefono, 'El teléfono no es válido.');
        errores = true;
    } else {
        campoCorrecto(telefono);
    }

    if (
        window.location.href.includes('registrarEstudiante') ||
        password.value.length > 0
    ) {
        // Validamos el campo "Password"
        if (password.value.trim() === '') {
            campoErroneo(
                password,
                'El campo "Contraseña" es obligatorio.'
            );
            errores = true;
        } else if (!validarPassword(password.value.trim())) {
            campoErroneo(
                password,
                'La contraseña debe tener al menos 8 caracteres y contener al menos una letra mayúscula, una letra minúscula y un número'
            );
            errores = true;
        } else {
            campoCorrecto(password);
        }
    }

    return !errores;
}
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

function validarPassword(password) {
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    return re.test(password);
}

validarFormularioRegistro();

/**
 * La función permite a los usuarios seleccionar una imagen y un archivo de curriculum y muestra los
 * nombres de archivo elegidos.
 */
function mostrarNombre() {
    const fileInputImagen = document.getElementById('imagen');
    const fileInputCv = document.getElementById('curriculum');

    const fileChosenImagen = document.querySelector('#file-chosen1');
    const fileChosenCv = document.querySelector('#file-chosen2');

    if (fileInputImagen) {
        fileInputImagen.addEventListener('change', function () {
            fileChosenImagen.textContent = this.files[0].name;
        });
    }

    if (fileInputCv) {
        fileInputCv.addEventListener('change', function () {
            fileChosenCv.textContent = this.files[0].name;
        });
    }
}

mostrarNombre();

/**
 * La función agrega un detector de eventos al envío de un formulario y valida una imagen antes de
 * enviar el formulario.
 */
function formularioImagen() {
    let formulario = document.getElementById('formularioImagen');

    if (formulario) {
        formulario.addEventListener('submit', () => {
            event.preventDefault();
            console.log(validarImagen());
            if (validarImagen()) {
                formulario.submit();
            }
        });
    }
}

/**
 * La función valida si un archivo de imagen cargado por el usuario está en un formato válido (JPG,
 * JPEG, PNG o GIF).
 * @returns un valor booleano, que es lo contrario de la variable "errores". Si no hay errores, la
 * función devolverá verdadero, lo que indica que la imagen es válida. Si hay errores, la función
 * devolverá falso, lo que indica que la imagen no es válida.
 */
function validarImagen() {
    let imagen = document.getElementById('imagen');
    let errores = false;

    let extensionImagen = imagen.value.split('.').pop().toLowerCase();

    if (imagen.value == '') {
        campoErroneo(imagen, 'El campo "Imagen" es obligatorio.');
        errores = true;
    } else if (
        extensionImagen !== 'jpg' &&
        extensionImagen !== 'jpeg' &&
        extensionImagen !== 'png' &&
        extensionImagen !== 'gif'
    ) {
        campoErroneo(
            imagen,
            'El formato de la imagen no es válido. Debe ser JPG, JPEG, PNG o GIF.'
        );
        errores = true;
    } else {
        campoCorrecto(imagen);
    }

    return !errores;
}

formularioImagen();

/**
 * La función solicita al usuario que confirme su decisión de eliminar su cuenta y envía una solicitud
 * al servidor para eliminarla si se confirma.
 */
async function darseBaja() {
    const url =
        'index.php?controller=EstudianteController&action=darseBajaEstudiante';

    try {
        const result = await Swal.fire({
            icon: 'info',
            title: 'Darse de Baja',
            text: 'Vas a eliminar tu cuenta permanentemente!',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#d33',
        });

        if (result.isConfirmed) {
            const response = await fetch(url);
            if (response.status === 200) {
                window.location.href =
                    'index.php?controller=EstudianteController&action=logout';
            }
        }
    } catch (error) {
        console.error('error' + error);
    }
}

/**
 * La función solicita al usuario que confirme el retiro de una solicitud de empleo y envía una
 * solicitud para eliminarla si se confirma.
 * @param  -  es un parámetro que representa el ID de una oferta. Se utiliza en la
 * URL para identificar la oferta de la que el candidato quiere retirar su candidatura.
 */
function retirarCandidatura($idOferta) {
    const url =
        'index.php?controller=EstudianteController&action=eliminarCandidatura&idOferta=' +
        $idOferta;
    Swal.fire({
        icon: 'info',
        title: 'Retirar Candidatura',
        text: '¿Estás seguro de retirar la candidaruta?',
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(url);
            location.reload();
        }
    });
}

/**
 * La función "mostrarOfertas" realiza una búsqueda utilizando la entrada del usuario y muestra los
 * resultados en la página web utilizando elementos HTML creados dinámicamente.
 * @returns La función no devuelve nada, solo define y ejecuta una serie de acciones cuando se le
 * llama.
 */
function mostrarOfertas() {
    const inputBusqueda = document.getElementById('inputBusqueda');
    const resultadosBusqueda = document.getElementById(
        'resultadosBusqueda'
    );
    const b = (document.querySelector('.fijas').style.display =
        'none');
    const valorBusqueda = inputBusqueda.value.trim();

    /* Si se pulsa la tecla enter realizar busqueda */
    inputBusqueda.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // previene que el formulario se envíe
            mostrarOfertas();
        }
    });

    if (!valorBusqueda) {
        return;
    }

    /* Peticion fetch al archivo php */
    fetch(
        `assets/fetch/buscador-ofertas.php?valor_input=${valorBusqueda}`
    )
        .then((response) => response.json())
        .then((ofertas) => {
            resultadosBusqueda.innerHTML = '';
            if (ofertas.length > 0) {
                ofertas.forEach((oferta) => {
                    const ofertaContainer =
                        document.createElement('a');
                    ofertaContainer.href = `index.php?controller=OfertaController&action=verOferta&idOferta=${oferta.idOferta}`;
                    ofertaContainer.classList.add(
                        'oferta-link',
                        'inline-block',
                        'bg-primario',
                        'hover:bg-secundario',
                        'text-white',
                        'font-bold',
                        'py-2',
                        'rounded-full'
                    );

                    const seccionOferta =
                        document.createElement('section');
                    seccionOferta.classList.add(
                        'oferta',
                        'sm:w-full',
                        'bg-white',
                        'rounded',
                        'overflow-hidden',
                        'shadow-lg',
                        'hover:bg-neutral-300',
                        'hover:text-white',
                        'relative'
                    );

                    const contenidoOferta =
                        document.createElement('div');
                    contenidoOferta.classList.add(
                        'px-6',
                        'py-4',
                        'h-60'
                    );

                    const ofertaTitle = document.createElement('div');
                    ofertaTitle.classList.add(
                        'font-bold',
                        'text-black',
                        'text-xl',
                        'mb-2',
                        'oferta-titulo'
                    );
                    ofertaTitle.textContent = oferta.titulo;

                    const ofertaVacantes =
                        document.createElement('p');
                    ofertaVacantes.classList.add(
                        'text-gray-700',
                        'text-base',
                        'mb-4',
                        'oferta-descripcion'
                    );
                    const iconoUsuarios = document.createElement('i');
                    iconoUsuarios.classList.add('fas', 'fa-users');
                    const vacantes = document.createElement('span');
                    vacantes.textContent =
                        ' ' + oferta.num_vacantes + ' Vacantes';
                    ofertaVacantes.appendChild(iconoUsuarios);
                    ofertaVacantes.appendChild(vacantes);

                    const ofertaSalario = document.createElement('p');
                    ofertaSalario.classList.add(
                        'text-gray-700',
                        'text-base',
                        'mb-4',
                        'oferta-descripcion'
                    );
                    const iconoSalario = document.createElement('i');
                    iconoSalario.classList.add('fas', 'fa-euro-sign');
                    const salario = document.createElement('span');
                    salario.textContent = ' ' + oferta.salario;
                    ofertaSalario.appendChild(iconoSalario);
                    ofertaSalario.appendChild(salario);

                    const ofertaEmpresa = document.createElement('p');
                    ofertaEmpresa.classList.add(
                        'text-gray-700',
                        'text-base',
                        'mb-4',
                        'flex',
                        'items-center',
                        'gap-2'
                    );
                    const iconoEmpresa = document.createElement('i');
                    iconoEmpresa.classList.add('fas', 'fa-building');
                    const nombreEmpresa =
                        document.createElement('span');
                    nombreEmpresa.classList.add('oferta-empresa');
                    nombreEmpresa.textContent = oferta.nombreEmpresa;
                    ofertaEmpresa.appendChild(iconoEmpresa);
                    ofertaEmpresa.appendChild(nombreEmpresa);

                    const ofertaDate = document.createElement('p');
                    ofertaDate.classList.add(
                        'text-gray-700',
                        'text-base',
                        'mb-4',
                        'flex',
                        'items-center',
                        'gap-2'
                    );
                    const iconoOferta = document.createElement('i');
                    iconoOferta.classList.add(
                        'fas',
                        'fa-calendar-alt'
                    );
                    const fechaOferta =
                        document.createElement('span');
                    fechaOferta.classList.add('oferta-fecha');
                    fechaOferta.textContent = oferta.fechaPublicacion;
                    ofertaDate.appendChild(iconoOferta);
                    ofertaDate.appendChild(fechaOferta);

                    const ofertaInscrito =
                        document.createElement('p');
                    ofertaInscrito.classList.add(
                        'text-gray-700',
                        'text-secundario',
                        'mb-4',
                        'oferta-inscrito'
                    );
                    const ofertaInscritoIcon =
                        document.createElement('i');
                    ofertaInscritoIcon.classList.add(
                        'fas',
                        'fa-check'
                    );
                    ofertaInscrito.appendChild(ofertaInscritoIcon);
                    ofertaInscrito.innerHTML += ' Inscrito';

                    contenidoOferta.appendChild(ofertaTitle);
                    contenidoOferta.appendChild(ofertaEmpresa);
                    contenidoOferta.appendChild(ofertaSalario);
                    contenidoOferta.appendChild(ofertaDate);
                    contenidoOferta.appendChild(ofertaVacantes);
                    if (oferta.isInscrito) {
                        contenidoOferta.appendChild(ofertaInscrito);
                    }

                    const verOfertaButton =
                        document.createElement('button');
                    verOfertaButton.classList.add(
                        'verOferta',
                        'hidden',
                        'absolute',
                        'right-5',
                        'bottom-3',
                        'inline-block',
                        'bg-primario',
                        'hover:bg-secundario',
                        'text-black',
                        'font-bold',
                        'py-2',
                        'px-4',
                        'rounded-full'
                    );
                    verOfertaButton.textContent = 'Ver Oferta';

                    seccionOferta.appendChild(contenidoOferta);
                    seccionOferta.appendChild(verOfertaButton);
                    ofertaContainer.appendChild(seccionOferta);
                    resultadosBusqueda.appendChild(ofertaContainer);
                });
            } else {
                resultadosBusqueda.innerHTML =
                    '<p class="mb-4 rounded-lg bg-warning-100 px-6 py-5 text-base text-warning-800">No se encontraron ofertas para la búsqueda realizada.</p>';
            }
        })
        .catch((error) => {
            console.error(error);
            resultadosBusqueda.innerHTML =
                '<p class="mb-4 rounded-lg bg-danger-100 px-6 py-5 text-base text-warning-800">Error al realizar la búsqueda.</p>';
        });
}

/**
 * La función alterna la visibilidad del de formulario y ajusta el margen de un elemento
 * de información de perfil.
 */
function toggleForm() {
    const formContainer = document.getElementById('form-container');
    const infoPerfil = document.getElementById('infoPerfil');

    formContainer.classList.toggle('active');
    infoPerfil.classList.toggle('mover-izquierda');
    //window.scrollTo(0, document.body.scrollHeight);
}

/**
 * Esta función solicita al usuario que confirme la eliminación de un ciclo y luego envía una solicitud
 * para eliminarlo del servidor.
 * @param idCiclo - El ID del ciclo que debe eliminarse.
 */
async function eliminarCiclo(idCiclo) {
    const url =
        'index.php?controller=CentroController&action=eliminarCiclo&idCiclo=' +
        idCiclo;

    const result = await Swal.fire({
        icon: 'info',
        title: 'Eliminar Ciclo',
        text: 'Vas a eliminar este ciclo permanentemente!',
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6588bb',
    });

    if (result.isConfirmed) {
        fetch(url);
        location.reload();
    }
}
/**
 * La función solicita al usuario que confirme la eliminación del título de un estudiante y luego envía
 * una solicitud al servidor para eliminarlo.
 * @param event - El objeto de evento que activó la función (por ejemplo, un evento de clic).
 * @param idEstudiante - El ID del estudiante cuya calificación se está eliminando.
 * @param idTitulacion - El ID de la titulación que se desea eliminar.
 */
function eliminarTitulacionEstudiante(
    event,
    idEstudiante,
    idTitulacion
) {
    event.preventDefault();

    const url =
        'index.php?controller=CentroController&action=eliminarTitulacionEstudiante&idTitulacion=' +
        idTitulacion +
        '&idEstudiante=' +
        idEstudiante;

    Swal.fire({
        icon: 'info',
        title: 'Eliminar Titulación',
        text: '¿Estás seguro de eliminar esta titulación a este alumno?',
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6588bb',
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(url);
            location.reload();
        }
    });
}

/**
 * La función comprueba si se completaron ciertos campos y habilita o deshabilita un botón en
 * consecuencia.
 */
function verificarCampos() {
    const nivelSelect = document.getElementById('nivelCiclo');
    const cicloSelect = document.getElementById('cicloCentro');
    const anioSelect = document.getElementById('anioCursoCiclo');
    const centroSelect = document.getElementById('centroCiclo');
    const boton = document.getElementById('añadirTitulacion');

    if (
        nivelSelect.value !== '' &&
        cicloSelect.value !== '' &&
        anioSelect.value !== '' &&
        centroSelect.value !== ''
    ) {
        boton.disabled = false;
    } else {
        boton.disabled = true;
    }
}

/**
 * La función agrega detectores de eventos para seleccionar elementos y obtiene datos para completar un
 * elemento de selección en función de la selección del usuario.
 */
function añadirCiclosSelect() {
    const nivelSelect = document.getElementById('nivelCiclo');
    const cicloSelect = document.getElementById('cicloCentro');
    const anioSelect = document.getElementById('anioCursoCiclo');
    const centroSelect = document.getElementById('centroCiclo');
    const boton = document.getElementById('añadirTitulacion');

    if (cicloSelect && centroSelect && botonCurso) {
        cicloSelect.disabled = true;
        anioSelect.disabled = true;
        centroSelect.disabled = true;
        boton.disabled = true;

        nivelSelect.addEventListener('change', () => {
            centroSelect.disabled = false;
        });

        centroSelect.addEventListener('change', function () {
            const nivel = nivelSelect.value;

            fetch(
                'assets/fetch/obtener-ciclos-por-nivel-y-centro.php',
                {
                    method: 'POST',
                    headers: {
                        'Content-Type':
                            'application/x-www-form-urlencoded',
                    },
                    body:
                        'nivel=' +
                        nivelSelect.value +
                        '&centro=' +
                        centroSelect.value,
                }
            )
                .then((response) => response.json())
                .then((data) => {
                    // Limpiar el select de los ciclos formativos
                    cicloSelect.innerHTML =
                        '<option value="">Seleccione un ciclo formativo</option>';

                    // Agregar las opciones de los ciclos formativos obtenidos
                    data.forEach((ciclo) => {
                        const option =
                            document.createElement('option');
                        option.value = ciclo.id;
                        option.text = ciclo.nombre;
                        cicloSelect.add(option);
                    });
                    cicloSelect.disabled = false;
                    verificarCampos();
                });
        });

        cicloSelect.addEventListener('change', function () {
            anioSelect.disabled = false;
        });

        anioSelect.addEventListener('change', function () {
            verificarCampos();
        });
    }
}

añadirCiclosSelect();

/* Rellenar los selects correpondientes dependiendo de la elección del usuario, realizando una consulta AJAXA que devuelve los ciclos */
function añadirCursoActual() {
    const nivelSelect = document.getElementById('nivelSeleccionado');
    const centroSelect = document.getElementById('centro');
    const cicloSelect = document.getElementById('cicloSeleccionado');
    const botonCurso = document.getElementById('añadirCurso');

    if (!cicloSelect && !centroSelect && !botonCurso) return;

    centroSelect.disabled = true;
    cicloSelect.disabled = true;
    botonCurso.disabled = true;

    centroSelect.addEventListener('change', function () {
        if (centroSelect.value !== '') {
            // Si ambos selects están completados, hacer la solicitud AJAX
            fetch(
                'assets/fetch/obtener-ciclos-por-nivel-y-centro.php',
                {
                    method: 'POST',
                    headers: {
                        'Content-Type':
                            'application/x-www-form-urlencoded',
                    },
                    body:
                        'nivel=' +
                        nivelSelect.value +
                        '&centro=' +
                        centroSelect.value,
                }
            )
                .then((response) => response.json())
                .then((data) => {
                    // Limpiar el select de los ciclos formativos
                    cicloSelect.innerHTML =
                        '<option value="">Seleccione un ciclo formativo</option>';

                    // Agregar las opciones de los ciclos formativos obtenidos
                    data.forEach((ciclo) => {
                        const option =
                            document.createElement('option');
                        option.value = ciclo.id;
                        option.text = ciclo.nombre;
                        cicloSelect.add(option);
                    });
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    });
    nivelSelect.addEventListener('change', function () {
        centroSelect.disabled = false;
    });

    centroSelect.addEventListener('change', function () {
        cicloSelect.disabled = false;
    });

    cicloSelect.addEventListener('change', function () {
        botonCurso.disabled = false;
    });
}

añadirCursoActual();

/* Seccion empresa */
/**
 * Esta función valida un formulario de registro para una empresa y evita el envío si los campos no son
 * válidos.
 *  Solo agrega un detector de eventos al formulario con id
 * "formRegistroEmpresa" y evita su comportamiento predeterminado cuando se envía. Si la función
 * "validarCamposRegistroEmpresa()" devuelve verdadero, entonces se envía el formulario.
 */
function validarFormularioRegistroEmpresa() {
    const formulario = document.getElementById('formRegistroEmpresa');

    if (!formulario) {
        return;
    }

    formulario.addEventListener('submit', () => {
        event.preventDefault();

        if (validarCamposRegistroEmpresa()) {
            formulario.submit();
        }
    });
}
/**
 * Esta función valida los campos de entrada para registrar una empresa y devuelve verdadero si todos
 * los campos son válidos.
 * @returns un valor booleano, que es verdadero si todos los campos obligatorios se completaron
 * correctamente y falso si hay algún error.
 */
function validarCamposRegistroEmpresa() {
    const nombre = document.getElementById('nombre');
    const direccion = document.getElementById('direccion');
    const sitioWeb = document.getElementById('sitioWeb');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const cif = document.getElementById('cif');
    const descripcion = document.getElementById('descripcion');
    const logo = document.getElementById('logo');
    let errores = false;

    let extensionImagen = logo.value.split('.').pop().toLowerCase();

    if (nombre.value.trim() === '') {
        campoErroneo(nombre, 'El campo "Nombre" es obligatorio.');
        errores = true;
    } else {
        campoCorrecto(nombre);
    }

    if (cif.value.trim() === '') {
        campoErroneo(cif, 'El campo "CIF" es obligatorio.');
        errores = true;
    } else if (!validarCif(cif.value.trim())) {
        campoErroneo(cif, 'El CIF no es válido.');
        errores = true;
    } else {
        campoCorrecto(cif);
    }

    if (descripcion.value.trim() === '') {
        campoErroneo(
            descripcion,
            'El campo "Descripción" es obligatorio.'
        );
        errores = true;
    } else {
        campoCorrecto(descripcion);
    }

    if (sitioWeb.value.trim() === '') {
        campoErroneo(
            sitioWeb,
            'El campo "Sitio Web" es obligatorio.'
        );
        errores = true;
    } else {
        campoCorrecto(sitioWeb);
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
            'La contraseña debe tener al menos 8 caracteres y contener al menos una letra mayúscula, una letra minúscula y un número.'
        );
        errores = true;
    } else {
        campoCorrecto(password);
    }

    if (logo.value == '') {
        campoErroneo(logo, 'El campo "LOGO" es obligatorio.');
        errores = true;
    } else if (
        extensionImagen !== 'jpg' &&
        extensionImagen !== 'jpeg' &&
        extensionImagen !== 'png' &&
        extensionImagen !== 'gif'
    ) {
        campoErroneo(
            logo,
            'El formato del logo no es válido. Debe ser JPG, JPEG, PNG o GIF.'
        );
        errores = true;
    } else {
        campoCorrecto(logo);
    }

    return !errores;
}

validarFormularioRegistroEmpresa();

/**
 * La función valida si una cadena dada coincide con el formato de un CIF español (código de
 * identificación fiscal).
 * @param cif - El parámetro "cif" es una cadena que representa un número de identificación fiscal
 * español para empresas y organizaciones.
 * @returns La función `validarCif` devuelve un valor booleano (`verdadero` o `falso`) dependiendo de
 * si la entrada `cif` coincide con el patrón de expresión regular definido en la función.
 */
function validarCif(cif) {
    const re = /^[A-HJNP-SUW][0-9]{8}$/;
    return re.test(cif);
}

/* Seccion empresa */
/**
 * Esta función valida los campos de un formulario antes de enviarlo.
 * Solo contiene un detector de eventos que evita el comportamiento de
 * envío de formulario predeterminado y llama a otra función llamada "validarCamposOferta" para validar
 * los campos del formulario antes de enviar el formulario.
 */
function validarCamposPublicarOferta() {
    const formulario = document.getElementById('formPublicarOferta');

    if (!formulario) {
        return;
    }

    formulario.addEventListener('submit', () => {
        event.preventDefault();

        if (validarCamposOferta()) {
            formulario.submit();
        }
    });
}
/**
 * La función valida si todos los campos obligatorios en un formulario de oferta de trabajo se
 * completaron correctamente.
 * @returns un valor booleano, que es verdadero si todos los campos obligatorios se han completado
 * correctamente y falso si hay algún error.
 */
function validarCamposOferta() {
    const titulo = document.getElementById('titulo');
    const salario = document.getElementById('salario');
    const fechaPublicacion = document.getElementById(
        'fechaPublicacion'
    );
    const fechaVencimiento = document.getElementById(
        'fechaVencimiento'
    );
    const requisitos = document.getElementById('requisitos');
    const descripcion = document.getElementById('descripcion');
    const numVacantes = document.getElementById('numVacantes');
    let errores = false;

    if (titulo.value.trim() === '') {
        campoErroneo(titulo, 'El campo "Titulo" es obligatorio.');
        errores = true;
    } else {
        campoCorrecto(titulo);
    }

    if (fechaPublicacion.value.trim() === '') {
        campoErroneo(
            fechaPublicacion,
            'El campo "Fecha Publicación" es obligatorio.'
        );
        errores = true;
    } else {
        campoCorrecto(fechaPublicacion);
    }

    if (fechaVencimiento.value.trim() === '') {
        campoErroneo(
            fechaVencimiento,
            'El campo "Fecha Vencimiento" es obligatorio.'
        );
        errores = true;
    } else {
        campoCorrecto(fechaVencimiento);
    }

    if (descripcion.value.trim() === '') {
        campoErroneo(
            descripcion,
            'El campo "Descripción" es obligatorio.'
        );
        errores = true;
    } else {
        campoCorrecto(descripcion);
    }

    if (requisitos.value.trim() === '') {
        campoErroneo(
            requisitos,
            'El campo "Requisitos" es obligatorio.'
        );
        errores = true;
    } else {
        campoCorrecto(requisitos);
    }

    if (salario.value.trim() === '') {
        campoErroneo(salario, 'El campo "Salario" es obligatorio.');
        errores = true;
    } else {
        campoCorrecto(salario);
    }

    if (numVacantes.value.trim() === '') {
        campoErroneo(
            numVacantes,
            'El campo "Número Vacantes" es obligatorio.'
        );
        errores = true;
    } else {
        campoCorrecto(numVacantes);
    }

    return !errores;
}

/**
 * La función valida que la fecha de publicación no sea posterior a la fecha de caducidad y viceversa.
 */
function validarCamposFechas() {
    const fechaPublicacion = document.getElementById(
        'fechaPublicacion'
    );
    const fechaVencimiento = document.getElementById(
        'fechaVencimiento'
    );

    if (fechaPublicacion !== null && fechaVencimiento !== null) {
        // Validar que la fecha de publicación no sea posterior a la fecha de vencimiento
        fechaPublicacion.addEventListener('change', () => {
            if (
                new Date(fechaPublicacion.value) >
                new Date(fechaVencimiento.value)
            ) {
                campoErroneo(
                    fechaPublicacion,
                    'La fecha de publicación no puede ser posterior a la fecha de vencimiento'
                );
                fechaPublicacion.value = '';
            }
        });

        // Validar que la fecha de vencimiento no sea anterior a la fecha de publicación
        fechaVencimiento.addEventListener('change', () => {
            if (
                new Date(fechaVencimiento.value) <
                new Date(fechaPublicacion.value)
            ) {
                campoErroneo(
                    fechaVencimiento,
                    'La fecha de vencimiento no puede ser anterior a la fecha de publicación'
                );
                fechaVencimiento.value = '';
            }
        });
    }
}

validarCamposFechas();

validarCamposPublicarOferta();

/**
 * La función solicita al usuario que confirme la eliminación de una oferta y luego envía una solicitud
 * para eliminarla antes de redirigir a la página de ofertas de la empresa.
 * @param idOferta - El ID de la oferta que debe eliminarse.
 */
function eliminarOferta(idOferta) {
    const url =
        'index.php?controller=EmpresaController&action=eliminarOferta&idOferta=' +
        idOferta;
    Swal.fire({
        icon: 'info',
        title: 'Eliminar Oferta',
        text: 'Vas a eliminar esta oferta definitivamente',
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(url);
            window.location.href =
                'index.php?controller=EmpresaController&action=ofertasEmpresa';
        }
    });
}

/**
 * La función solicita al usuario que confirme la eliminación permanente de su cuenta y envía una
 * solicitud al servidor para eliminar la cuenta si se confirma.
 */
async function eliminarCuenta() {
    const url =
        'index.php?controller=EmpresaController&action=eliminarCuenta';

    try {
        const result = await Swal.fire({
            icon: 'info',
            title: 'Eliminar Cuenta',
            text: 'Vas a eliminar tu cuenta permanentemente!',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#d33',
        });

        if (result.isConfirmed) {
            const response = await fetch(url);
            if (response.status === 200) {
                window.location.href =
                    'index.php?controller=EmpresaController&action=logout';
            }
        }
    } catch (error) {
        console.error('error' + error);
    }
}

/**
 * La función obtiene y muestra una lista de estudiantes según su título y estado de verificación.
 */
function mostrarEstudiantes() {
    const titulacion = document.getElementById('titulacion').value;
    const resultadosBusqueda = document.getElementById(
        'resultadosBusquedaEstudiantes'
    );

    const verificado = document.getElementById('verificado');
    let valor = verificado.checked;

    if (valor == false) {
        valor = 0;
    } else {
        valor = 1;
    }

    // ocultar ofertas que aparecen por defecto
    document.querySelector('.fijas').style.display = 'none';

    fetch(
        `assets/fetch/estudiantes-por-titulacion.php?titulacion=${titulacion}&verificado=${valor}`
    )
        .then((response) => response.json())
        .then((data) => {
            if (data.length > 0) {
                let estudiantes = '';
                data.forEach((estudiante) => {
                    estudiantes += `
                    <section class="oferta sm:w-full bg-white rounded overflow-hidden shadow-lg relative flex flex-col">
                        <article class="px-6 py-4 h-46 flex flex-col items-center">
                                <img src="assets/images/Estudiante/${estudiante.imagen}" class="rounded-full h-20 w-20 mb-4 ">
                                <p class="font-bold text-black text-xl mb-2">${estudiante.nombre} ${estudiante.apellido1} ${estudiante.apellido2}</p>
                                <p class="text-gray-700 text-base mb-4"><i class="fas fa-envelope"></i> <a href="mailto:${estudiante.email}" class="text-secundario hover:underline">${estudiante.email}</a></p>
                                <p class="text-gray-700 text-base mb-4"><i class="fas fa-phone"></i> <a href="tel:${estudiante.telefono}" class="text-secundario hover:underline">${estudiante.telefono}</a></p>
                                <p class="text-gray-700 text-base mb-4"><i class="fas fa-check-circle"></i> <span class="font-bold">${estudiante.estado}</span></p>
                            </article>
                            <button class="relative self-center m-2 inline-block bg-primario hover:bg-secundario text-secundario font-bold py-2 px-4 rounded-full" data-te-toggle="modal" data-te-target="#verCurriculum${estudiante.idEstudiante}" data-te-ripple-init data-te-ripple-color="light"><i class="fas fa-eye mr-2"></i> Ver Curriculum</button>
                            <!-- Modal curriculum -->
                            <div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="verCurriculum${estudiante.idEstudiante}" tabindex="-1" aria-labelledby="verCurriculumLabel" aria-hidden="true">
                                <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
                                    <div class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-white-600">
                                        <div class="flex justify-end flex-shrink-0 rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                            <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div>
                                            <embed class="w-full max-w-screen-md h-screen" src="assets/cvs/${estudiante.curriculum}" type="application/pdf" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>`;
                });
                resultadosBusqueda.innerHTML = estudiantes;
            } else {
                resultadosBusqueda.innerHTML =
                    '<p class="mb-4 rounded-lg bg-warning-100 px-6 py-5 text-base text-warning-800">No se encontraron estudiantes para la búsqueda realizada o no tienen la titulación verficada.</p>';
            }
        });
}
/**
 * La función selecciona todos los elementos con la clase "boxEstudiante" y alterna una clase de borde
 * sobre ellos, y habilita un botón de validación si al menos un elemento tiene la clase de borde.
 */
function seleccionarTodo() {
    const boxEstudiante = document.querySelectorAll('.boxEstudiante');
    const botonValidar = document.querySelector('.validar');

    boxEstudiante.forEach((box) => {
        if (!box.classList.contains('verificado')) {
            box.classList.toggle('border');
            box.classList.toggle('border-indigo-500');
        }
    });

    const algunoSeleccionado = Array.from(boxEstudiante).some((box) =>
        box.classList.contains('border')
    );

    botonValidar.disabled = !algunoSeleccionado;
}

/**
 * La función valida las calificaciones de los estudiantes seleccionados y envía una solicitud al
 * servidor.
 */
function validar() {
    // Obtener los elementos seleccionados
    const elementosSeleccionados = document.querySelectorAll(
        '.border-indigo-500'
    );

    var idsEstudiantes = [];
    var idsCiclos = [];

    elementosSeleccionados.forEach(function (elemento) {
        idsEstudiantes.push(elemento.dataset.idestudiante);
        idsCiclos.push(elemento.dataset.idciclo);
    });

    fetch(
        'index.php?controller=CentroController&action=validarTitulacionesEstudiantes',
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                estudiantes: idsEstudiantes,
                ciclos: idsCiclos,
            }),
        }
    )
        .then(function (response) {
            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'La solicitud se ha enviado correctamente.',
                }).then(() => {
                    // Recargar la página
                    location.reload();
                });
            } else {
                console.log('Error al enviar la solicitud');
            }
        })
        .catch(function (error) {
            console.log('Error:', error);
        });
}

/**
 * La función obtiene y muestra una lista de estudiantes según su titulación.
 */
function mostrarEstudiantesPorTitulacion() {
    const titulacion = document.getElementById('titulacion').value;
    const resultadosBusqueda = document.querySelector(
        '.resultadosBusquedaEstudiantesTitulacion'
    );

    // ocultar ofertas que aparecen por defecto
    document.querySelector('.fijas').style.display = 'none';

    fetch(
        `assets/fetch/titulacionesEstudiante.php?titulacion=${titulacion}`
    )
        .then((response) => response.json())
        .then((data) => {
            if (data.length > 0) {
                let estudiantes = '';
                data.forEach((estudiante) => {
                    estudiantes += `
                    <div class="bg-white shadow-md rounded-md overflow-hidden h-44 relative boxEstudiante ${
                        estudiante.verificado ? 'verificado' : ''
                    }">
                        <div class="px-6 py-4">
                            <h3 class="text-lg font-medium mb-2">${
                                estudiante.nombre
                            } ${estudiante.apellido1} ${
                        estudiante.apellido2
                    }</h3>
                            <p class="text-gray-600">${
                                estudiante.email
                            }</p>
                            <p class="text-gray-600">${
                                estudiante.nombreCiclo
                            } - ${estudiante.anio_curso}</p>
                            <p class="text-gray-600"><?= $estudiante['verificado'] == 1 ? '' : 'No verificado' ?></p>
                            <p class="text-gray-600">${
                                estudiante.verificado == 1
                                    ? ''
                                    : 'No Verificado'
                            }</p>
                            ${
                                estudiante.fecha_verificacion
                                    ? `<p class="text-gray-600">Verificado el ${estudiante.fecha_verificacion}</p>`
                                    : ''
                            }
                        </div>
                            ${
                                estudiante.verificado == 0
                                    ? `<form action="index.php?controller=CentroController&action=validarTitulacion&idEstudiante=${
                                          estudiante.idEstudiante
                                      }&idCiclo=${
                                          estudiante.idCiclo
                                      }" method="post">
                                <div class="px-6 py-2 bg-primario flex justify-end gap-2 bottom-0 w-full absolute">
                                    <button type="submit" class="inline-block px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-300 disabled:opacity-50 mr-2" <?= ${
                                        estudiante.verificado == 1
                                            ? 'disabled'
                                            : ''
                                    }>
                                        Verificar
                                    </button>
                                    <button onclick="eliminarTitulacionEstudiante(event, ${
                                        estudiante.idEstudiante
                                    },${
                                          estudiante.idTitulacion
                                      } )" class="inline-block px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-300 disabled:opacity-50">
                                        Eliminar
                                    </button>
                                </div>
                            </form>`
                                    : ''
                            }
                            
                        <?php } ?>
                    </div>
                    `;
                });
                resultadosBusqueda.innerHTML = estudiantes;
            } else {
                resultadosBusqueda.innerHTML =
                    '<p class="mb-4 rounded-lg bg-warning-100 px-6 py-5 text-base text-warning-800">No se encontraron estudiantes para la búsqueda realizada.</p>';
            }
        });
}
