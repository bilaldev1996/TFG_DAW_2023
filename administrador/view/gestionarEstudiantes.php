<main class="flex flex-col lg:flex-row h-screen bg-gray-100">
    <?php include 'template/navbar.php' ?>

    <!-- Contenido -->
    <section class="w-full md:w-4/5 px-0 lg:px-3 mt-1">

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between">
                <h3 class="font-bold text-xl mb-3">Gestionar Estudiantes</h3>

            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Perfil</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($dataToView)) : ?>
                            <?php foreach ($dataToView as $estudiante) : ?>
                                <tr>
                                    <td class="border px-4 py-2"><?= $estudiante->getNombre() ?></td>
                                    <td class="border px-4 py-2"><?= $estudiante->getEmail() ?></td>
                                    <td class="border px-4 py-2"><?= $estudiante->getPerfil() ?></td>
                                    <td class="border px-4 py-2">
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id="eliminar" onclick="confirmarEliminar(<?php echo $estudiante->getId() ?>,'eliminarEstudiante')">Eliminar</button>
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