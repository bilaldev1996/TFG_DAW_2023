<?php include('view/template/navbarCentro.php'); ?>

<main class="px-40 mt-10 relative mainPanelMovil">
    <section class="mx-auto px-4 py-8 shadow-md w-full lg:w-1/2 relative mt-3 bg-white" id="infoPerfil">
        <div class="flex flex-col items-center justify-center space-y-4">
            <h2 class="text-xl font-bold text-gray-700">Perfil del Centro</h2>
            <div class="flex items-center space-x-2">
                <i class="fas fa-building text-gray-500"></i>
                <h3 class="text-lg font-medium text-gray-700"><?= $dataToView['centro']['nombre'] ?></h3>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-map-marker-alt text-gray-500"></i>
                <address class="text-gray-700"><?= $dataToView['centro']['direccion'] ?></address>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-envelope text-gray-500"></i>
                <a href="mailto:<?= $dataToView['centro']['email'] ?>" class="text-gray-700"><?= $dataToView['centro']['email'] ?></a>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-phone text-gray-500"></i>
                <a href="tel:<?= $dataToView['centro']['telefono'] ?>" class="text-gray-700"><?= $dataToView['centro']['telefono'] ?></a>
            </div>
        </div>
        <button class="editar bg-primario text-gray-700 font-semibold p-5 absolute bottom-0 right-0" onclick="toggleForm()">Editar</button>
    </section>
    <section class="form-container mt-3 w-1/3 lg:shadow-lg" id="form-container">
        <form class="w-full max-w-xxl" action="index.php?controller=CentroController&action=actualizarPerfil" method="POST" id="formularioRegistroCentro">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
                        Nombre
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white mb-3" id="nombre" name="nombre" type="text" placeholder="Jane" value="<?php echo $dataToView['centro']['nombre'] ?>">
                    <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="direccion">
                        Direccion
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="direccion" name="direccion" type="text" placeholder="Doe" value="<?php echo $dataToView['centro']['direccion'] ?>">
                    <p class="text-red-500 text-xs italic hidden"></p>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" name="email" placeholder="john@gmail.com" value="<?php echo $dataToView['centro']['email'] ?>">
                    <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="telefono">
                        Teléfono
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="telefono" type="tel" name="telefono" placeholder="john@gmail.com" value="<?php echo $dataToView['centro']['telefono'] ?>">
                    <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                        Nueva Contraseña
                    </label>
                    <div class="relative">
                        <input id="password" type="password" name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="******************">
                        <p class="text-red-500 text-xs italic mb-3 hidden absolute"></p>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-6 w-6 text-gray-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" onclick="togglePassword()">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M10 3C5.5 3 1.9 5.7 0 10c1.9 4.3 5.5 7 10 7s8.1-2.7 10-7c-1.9-4.3-5.5-7-10-7zm0 12a6 6 0 110-12 6 6 0 010 12z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex md:flex-wrap -mx-3 mb-2">
                <button type="submit" class="w-full px-4 py-2 bg-primario text-gray-700 font-semibold rounded shadow-lg hover:shadow-none transition-all duration-300 m-2">
                    Actualizar
                </button>
            </div>
        </form>

    </section>
</main>

<script>
    $('.editar').on('click', function() {
        $('html, body').animate({
            scrollTop: $(document).height() / 2
        }, 'slow');
    });
</script>