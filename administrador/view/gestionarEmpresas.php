<main class="flex flex-col lg:flex-row h-screen bg-gray-100">
    <?php include 'template/navbar.php' ?>

    <!-- Contenido -->
    <section class="w-full  px-0 lg:px-3 mt-1">

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between">
                <h3 class="font-bold text-xl mb-3">Gestionar Empresas</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">CIF</th>
                            <th class="px-4 py-2">Verificada</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($dataToView)) : ?>
                            <?php foreach ($dataToView as $empresa) : ?>
                                <tr>
                                    <td class="border px-4 py-2"><?= $empresa->getNombre() ?></td>
                                    <td class="border px-4 py-2"><?= $empresa->getEmail() ?></td>
                                    <td class="border px-4 py-2"><?= $empresa->getCIF() ?></td>
                                    <?php if ($empresa->getVerificado() == 1) : ?>
                                        <td class="border px-4 py-2">Sí</td>
                                    <?php else : ?>
                                        <td class="border px-4 py-2">No</td>
                                    <?php endif ?>

                                    <td class="border px-4 py-2">
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="confirmarEliminar(<?php echo $empresa->getIdEmpresa() ?>,'eliminarEmpresa')">Eliminar</button>
                                        <?php if ($empresa->getVerificado() == 0) : ?>
                                            <a href="index.php?controller=gestion&action=verificarEmpresa&idEmpresa=<?= $empresa->getIdEmpresa() ?>&email=<?= $empresa->getEmail() ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Verificar</a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td class="border px-4 py-2" colspan="4">No se encontraron resultados</td>952349790
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>