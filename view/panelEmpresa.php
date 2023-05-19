<?php include('view/template/navbarEmpresa.php'); ?>


<main class="px-40 mt-10 relative mainPanelMovil">
    <section class="mx-auto px-4 py-8 shadow-md w-full md:w-1/2 relative mt-3 bg-white" id="infoPerfil">
        <div class="flex flex-col items-center justify-center space-y-4">
            <h2 class="text-xl font-bold text-gray-700">Perfil Empresa</h2>
            <div class="flex items-center space-x-2">
                <i class="fas fa-building text-gray-500"></i>
                <h3 class="text-lg font-medium text-gray-700"><?= $dataToView['empresa']['nombre'] ?></h3>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-map-marker-alt text-gray-500"></i>
                <address class="text-gray-700"><?= $dataToView['empresa']['direccion'] ?></address>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-info-circle text-gray-500"></i>
                <a class="text-gray-700"><?= $dataToView['empresa']['descripcion'] ?></a>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-id-card text-gray-500"></i>
                <a class="text-gray-700"><?= $dataToView['empresa']['CIF'] ?></a>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-globe text-gray-500"></i>
                <a class="text-gray-700 underline" href="https://<?= $dataToView['empresa']['sitio_web'] ?>" target="_blank"><?= $dataToView['empresa']['sitio_web'] ?></a>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-envelope text-gray-500"></i>
                <a href="mailto:<?= $dataToView['empresa']['email'] ?>" class="text-gray-700"><?= $dataToView['empresa']['email'] ?></a>
            </div>
        </div>
        <button class="editar bg-primario text-gray-700 font-semibold p-5 absolute bottom-0 right-0" onclick="toggleForm()">Editar</button>
    </section>
    <section class="form-container mt-3 w-1/3 lg:shadow-lg" id="form-container">
        <form class="w-full max-w-xxl overflow-hidden" action="index.php?controller=EmpresaController&action=actualizarPerfil" method="POST" enctype="multipart/form-data">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
                        Nombre Empresa
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 focus:outline-none focus:bg-white mb-1" id="nombre" name="nombre" type="text" value="<?= $dataToView['empresa']['nombre'] ?>">
                    <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="direccion">
                        Dirección Empresa
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-1 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="direccion" name="direccion" type="text" placeholder="Dirección de la empresa" value="<?= $dataToView['empresa']['direccion'] ?>">
                    <p class="text-red-500 text-xs italic hidden"></p>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sitioWeb">
                        Sitio Web
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-1 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="sitioWeb" name="sitioWeb" type="text" placeholder="empresasl.es" value="<?= $dataToView['empresa']['sitio_web'] ?>">
                    <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cif">
                        CIF
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-1 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="cif" type="text" name="cif" placeholder="636456789" value="<?= $dataToView['empresa']['CIF'] ?>">
                    <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-1 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" name="email" placeholder="nombreempresa@gmail.com" value="<?= $dataToView['empresa']['email'] ?>">
                    <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                        Nueva Contraseña
                    </label>
                    <div class="relative">
                        <input id="password" type="password" name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 focus:outline-none focus:bg-white focus:border-gray-500" id="password" type="password" name="password" placeholder="*************">
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
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 " for="descripcion">
                            Descripción
                        </label>
                        <div class="relative">
                            <textarea id="descripcion" name="descripcion" rows="5" cols="46" class="bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 focus:outline-none focus:bg-white focus:border-gray-500 w-full "><?= $dataToView['empresa']['descripcion'] ?></textarea>
                            <p class="text-red-500 text-xs italic mb-3 hidden absolute"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">
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