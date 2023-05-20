<main class="flex flex-col lg:flex-row h-screen bg-gray-100">
    <?php include 'template/navbar.php' ?>

    <!-- Contenido -->
    <main class="w-full px-0 lg:px-3 mt-1">

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between">
                <h3 class="font-bold text-xl mb-3">Gestionar Ofertas</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nombre Empresa</th>
                            <th class="px-4 py-2">Título</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($dataToView)) : ?>
                            <?php foreach ($dataToView as $oferta) : ?>
                                <tr>
                                    <td class="border px-4 py-2"><?= $oferta->getNombreEmpresa() ?></td>
                                    <td class="border px-4 py-2"><?= $oferta->getTitulo() ?></td>
                                    <td class="border px-4 py-2">
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id="eliminar" onclick="confirmarEliminar(<?php echo $oferta->getIdOferta() ?>,'eliminarOferta')">Eliminar</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td class="border px-4 py-2" colspan="3">No se encontraron resultados</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </main>
</main>