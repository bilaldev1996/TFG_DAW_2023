<?php include('template/navbar.php'); ?>



<main class="form-container shadow-lg px-4 z-1">
    <form class="w-full max-w-xxl" action="index.php?controller=EstudianteController&action=altaEstudiante" method="POST" enctype="multipart/form-data" id="formularioRegistro">
        <h2 class="text-2xl font-bold mb-7 mt-4"><i class="fas fa-user-plus"></i> Registro Estudiante</h2>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="nombre">
                    Nombre <span class="text-red">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 focus:outline-none focus:bg-white mb-3" id="nombre" name="nombre" type="text" placeholder="Jane">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="apellido1">
                    Primer Apellido <span class="text-red">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="apellido1" name="apellido1" type="text" placeholder="Doe">
                <p class="text-red-500 text-xs italic hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="apellido2">
                    Segundo Apellido <span class="text-red">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="apellido2" name="apellido2" type="text" placeholder="Doe">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="email">
                    Email <span class="text-red">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" name="email" placeholder="john@gmail.com">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full px-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="telefono">
                    Teléfono <span class="text-red">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="telefono" type="tel" name="telefono" placeholder="636456789">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full px-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="password">
                    Contraseña <span class="text-red">*</span>
                </label>
                <div class="relative">
                    <input id="password" type="password" name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 focus:outline-none focus:bg-white focus:border-gray-500" id="password" type="password" name="password" placeholder="******************">
                    <p class="text-red-500 text-xs italic mb-3 hidden relative"></p>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="h-6 w-6 text-gray-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" onclick="togglePassword()">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M10 3C5.5 3 1.9 5.7 0 10c1.9 4.3 5.5 7 10 7s8.1-2.7 10-7c-1.9-4.3-5.5-7-10-7zm0 12a6 6 0 110-12 6 6 0 010 12z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="perfil">
                    Perfil <span class="text-red">*</span>
                </label>
                <div class="relative mb-3">
                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded focus:outline-none focus:bg-white focus:border-gray-500" id="perfil" name="perfil">
                        <option value="Público">Público</option>
                        <option value="Privado">Privado</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="estado">
                    Estado <span class="text-red">*</span>
                </label>
                <div class="relative">
                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded focus:outline-none focus:bg-white focus:border-gray-500" id="estado" name="estado">
                        <option value="Buscando Trabajo">Buscando trabajo</option>
                        <option value="Buscando Prácticas">Buscando prácticas</option>
                        <option value="Estudiando">Estudiando</option>
                        <option value="En Prácticas">En prácticas</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <fieldset class="flex flex-wrap  mb-2 border mx-3">
            <legend class="block uppercase text-gray-700 text-xs font-bold mb-2">Redes Sociales</legend>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="linkedin">Linkedin</label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="linkedin" name="linkedin" type="text" placeholder="Ingresa su perfil de Linkedin">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="instagram">Instagram</label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="instagram" type="text" name="instagram" placeholder="Ingresa su perfil de Instagram">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="facebook">Facebook</label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="facebook" type="text" name="facebook" placeholder="Ingresa su perfil de Facebook">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="github">Github</label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="github" type="text" name="github" placeholder="Ingresa su perfil de github">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
        </fieldset>

        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/2 px-3">
                <label for="imagen" class="block text-gray-700 font-bold mb-2">Imagen de perfil <span class="text-red">*</span></label>
                <div class="flex flex-col items-center justify-center bg-grey-lighter">
                    <label class="w-40 text-center flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg uppercase border border-blue cursor-pointer hover:bg-blue ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>

                        <span class="mt-2 text-base leading-normal">Adjunta una Imagen</span>
                        <input type='file' class="hidden" name="imagen" accept="image/*" id="imagen" />
                        <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                    </label>
                    <span class="ml-2" id="file-chosen1"></span>
                </div>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label for="imagen" class="block text-gray-700 font-bold mb-2">Curriculum <span class="text-red">*</span></label>
                <div class="flex flex-col items-center justify-center bg-grey-lighter">
                    <label class="w-40 text-center flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg uppercase border border-blue cursor-pointer hover:bg-blue ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>

                        <span class="mt-2 text-base leading-normal w-20">Adjunta un CV</span>
                        <input type='file' class="hidden" name="curriculum" id="curriculum" accept=".pdf" />
                        <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                    </label>
                    <span class="ml-2" id="file-chosen2"></span>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <button type="submit" class="w-full px-4 py-2 bg-primario text-gray-700 font-semibold rounded  focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2">
                Registrarse
            </button>
            <p class="w-full text-sm text-center text-gray-600 ml-">¿Ya tienes una cuenta? <a href="index.php?controller=EstudianteController&action=accesoEstudiante" class="text-secundario hover:underline">Inicia Sesión</a></p>
        </div>
    </form>


</main>

<?php
if ($dataToView === 'email existe') {
?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Ya existe una cuenta con este email!',
            timer: 2000,
            showConfirmButton: false,
        });
    </script>
<?php
}
?>

<?php
if ($dataToView === 'registrado') {
?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Registrado',
            text: 'El usuario se ha registrado correctamente!',
            timer: 2000,
            showConfirmButton: false,
        });

        setTimeout(() => {
            window.location.href = 'index.php?controller=EstudianteController&action=accesoEstudiante';
        }, 2000)
    </script>
<?php
}
?>