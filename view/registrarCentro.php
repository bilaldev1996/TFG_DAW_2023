<?php include('template/navbar.php'); ?>



<main class="form-container">
    <h2 class="text-2xl font-bold mb-4"><i class="fas fa-user-plus"></i> Registro Centro Educativo</h2>
    <form class="w-full max-w-xxl shadow-lg  p-3" action="index.php?controller=CentroController&action=altaCentro" method="POST" id="formularioRegistroCentro">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
                    Nombre
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="nombre" name="nombre" type="text" placeholder="Ej: Instituto Tecnológico Superior">
                <p class="text-red-500 text-xs italic hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="direccion">
                    Dirección
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="direccion" name="direccion" type="text" placeholder="Ej: Calle 123, Colonia Centro">
                <p class="text-red-500 text-xs italic hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="telefono">
                    Teléfono
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="telefono" name="telefono" type="tel" placeholder="Ej: 55 1234 5678">
                <p class="text-red-500 text-xs italic hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                    Correo electrónico
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" name="email" placeholder="Ej: contacto@ejemplo.com">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
        </div>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
            Contraseña
        </label>
        <div class="relative">
            <input id="password" type="password" name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="password" type="password" name="password" placeholder="******************">
            <p class="text-red-500 text-xs italic mb-3 hidden absolute"></p>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <svg class="h-6 w-6 text-gray-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" onclick="togglePassword()">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd" d="M10 3C5.5 3 1.9 5.7 0 10c1.9 4.3 5.5 7 10 7s8.1-2.7 10-7c-1.9-4.3-5.5-7-10-7zm0 12a6 6 0 110-12 6 6 0 010 12z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-2 mt-12">
            <button type="submit" class="w-full px-4 py-2 bg-primario text-black font-semibold rounded  focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2">
                Registrarse
            </button>
            <p class="w-full text-sm text-center text-gray-600 ml-">¿Ya tienes una cuenta? <a href="index.php?controller=CentroController&action=accesoCentro" class="text-secundario">Inicia Sesión</a></p>
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
            text: 'Ya existe un centro con este email!',
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
            text: 'El Centro se ha registrado correctamente!',
            timer: 2000,
            showConfirmButton: false,
        });

        setTimeout(() => {
            window.location.href = 'index.php?controller=CentroController&action=accesoCentro';
        }, 2000)
    </script>
<?php
}
?>