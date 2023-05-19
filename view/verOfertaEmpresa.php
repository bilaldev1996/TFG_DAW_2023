<?php include('view/template/navbarEmpresa.php'); ?>


<?php
if ($dataToView['oferta']) {
?>
    <main class="relative w-full mx-auto lg:w-1/2  my-5 bg-white rounded-md shadow-md lg:max-w-2xl">
        <section class="p-8 oferta-container pb-0">
            <p class="block mt-1 text-3xl leading-tight font-medium text-black">
                <?php echo $dataToView['oferta']['titulo']; ?>
            </p>
            <p class="mt-2 text-gray-500 line-clamp-1">
                <?php echo $dataToView['oferta']['descripcion']; ?>
            </p>
            <div class="mt-4 flex items-center">
                <span class="text-black font-medium mr-2">
                    <i class="fas fa-user-check"></i> Requisitos:
                </span>
                <p class="text-gray-500">
                    <?php echo $dataToView['oferta']['requisitos']; ?>
                </p>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-black font-medium mr-2">
                    <i class="fas fa-euro-sign"></i> Salario:
                </span>
                <p class="text-gray-500">
                    <?php echo $dataToView['oferta']['salario']; ?>€
                </p>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-black font-medium mr-2">
                    <i class="far fa-calendar-alt"></i> Fecha de publicación:
                </span>
                <p class="text-gray-500">
                    <?php echo $dataToView['oferta']['fechaPublicacion']; ?>
                </p>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-black font-medium mr-2">
                    <i class="far fa-calendar-times"></i> Fecha de vencimiento:
                </span>
                <p class="text-gray-500">
                    <?php echo $dataToView['oferta']['fechaVencimiento']; ?>
                </p>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-black font-medium mr-2">
                    <i class="fas fa-users"></i> Número de vacantes:
                </span>
                <p class="text-gray-500">
                    <?php echo $dataToView['oferta']['num_vacantes']; ?>
                </p>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-black font-medium mr-2">
                    <i class="fas fa-user-friends"></i> Número de inscritos:
                </span>
                <p class="text-gray-500">
                    <?php echo $dataToView['oferta']['num_inscritos']; ?>
                </p>
            </div>
            <div class="flex justify-end gap-2 items-center mt-5">
                <a href="index.php?controller=EmpresaController&action=editarOferta&idOferta=<?php echo $dataToView['oferta']['idOferta']; ?>" class="inline-block rounded relative lg:right-10 lg:bottom-5 bg-primario px-6 py-2 text-sm font-semibold uppercase text-gray-700 shadow-md">
                    Editar
                </a>
                <button onclick="eliminarOferta( <?= $dataToView['oferta']['idOferta'] ?> )" class="inline-block rounded relative lg:right-10 lg:bottom-5 bg-danger-600 px-6 py-2 text-sm font-medium uppercase text-white shadow-md">
                    Eliminar
                </button>
                <?php
                if ($dataToView['oferta']['num_inscritos'] > 0) :
                ?>
                    <a href="index.php?controller=EmpresaController&action=estudiantesInscritos&idOferta=<?= $dataToView['oferta']['idOferta']; ?>" class="inline-block rounded relative lg:right-10 lg:bottom-5 bg-secundario px-6 py-2 text-sm font-medium uppercase text-white shadow-md">
                        Inscritos
                    </a>
                <?php endif ?>
            </div>
        </section>
    </main>
<?php
} else {
    echo "<div
    class='mb-4 rounded-lg bg-danger-100 px-6 py-5 text-base text-danger-700'
    role='alert'>
    No existe ninguna oferta con esta ID :  " . $_GET['idOferta'] . "
  </div>";
}
?>