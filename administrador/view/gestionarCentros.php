<main class="flex flex-col lg:flex-row h-screen bg-gray-100">
    <?php include 'template/navbar.php' ?>


    <!-- Contenido -->
    <section class="w-full md:w-4/5 px-0 lg:px-3 mt-1">

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between">
                <h3 class="font-bold text-xl mb-3">Gestionar Centros Educativos</h3>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-te-toggle="modal" data-te-target="#registroEstudiante" data-te-ripple-init data-te-ripple-color="light">Nuevo Centro</button>
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <?php if ($dataToView === 'email-existe') {
                    ?>
                        <div class="mb-4 rounded-lg bg-danger-100 px-6 py-5 text-base text-danger-700 mt-3" role="alert">
                            Ya existe un centro con este email
                        </div>
                    <?php
                        return;
                    } else if ($dataToView == 'centro-añadido') {

                    ?>
                        <div class="mb-4 rounded-lg bg-success-100 px-6 py-5 text-base text-success-700 mt-3" role="alert">
                            Centro añadido exitosamente
                        </div>
                    <?php
                        return;
                    } ?>
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Teléfono</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($dataToView)) : ?>
                            <?php foreach ($dataToView as $centro) : ?>
                                <tr>
                                    <td class="border px-4 py-2"><?= $centro->getNombre() ?></td>
                                    <td class="border px-4 py-2"><?= $centro->getEmail() ?></td>
                                    <td class="border px-4 py-2"><?= $centro->getTelefono() ?></td>
                                    <td class="border px-4 py-2">
                                        <button onclick="confirmarEliminar(<?php echo $centro->getIdCentro() ?>,'eliminarCentro')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td class="border px-4 py-2" colspan="4">No se encontraron resultados</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<!-- Modal para crear nuevo centro -->
<div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="registroEstudiante" tabindex="-1" aria-labelledby="registroEstudianteLabel" aria-hidden="true">
    <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-white-600">
            <div class="flex justify-end flex-shrink-0 rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="w-full max-w-xxl shadow-lg  p-3" action="index.php?controller=gestion&action=altaCentro" method="POST" id="formularioRegistroCentro">
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

                <div class="flex flex-wrap -mx-3 mb-2 mt-8">
                    <button type="submit" class="w-full px-4 py-2 bg-amber-200 text-black font-semibold rounded  focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2">
                        Crear Centro
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>