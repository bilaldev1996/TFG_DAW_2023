<?php include('view/template/navbarEstudiante.php'); ?>



<?php
if ($dataToView['oferta']) {
?>
    <main class="miOferta max-w-lg  mx-auto w-1/2 sm:w-full my-5 bg-white mt-10 shadow-md  md:max-w-2xl">
        <a href="#" onclick="history.go(-1); return false;" class="text-secundario absolute left-40" id="volverAtras">
            <i class="fas fa-arrow-circle-left"></i> Volver
        </a>

        <section class="p-8 oferta-container relative">
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
            <?php if ($dataToView['inscrito']) : ?>
                <div class="mt-4 flex items-center">
                    <span class="text-black font-medium mr-2">
                        <i class="fas fa-handshake"></i> Estado Candidatura:
                    </span>
                    <p class="<?= ($dataToView['inscrito']['estadoCandidatura'] == 'Rechazado' ? 'text-red-700' : ($dataToView['inscrito']['estadoCandidatura'] == 'En Proceso' ? 'text-amber-300' : ($dataToView['inscrito']['estadoCandidatura'] == 'Contratado' ? 'text-green-600' : ($dataToView['inscrito']['estadoCandidatura'] == 'Enviada' ? 'text-secundario' : 'text-gray-700')))) ?>">

                        <?php echo $dataToView['inscrito']['estadoCandidatura']; ?>
                    </p>
                </div>
            <?php endif ?>
            <?php
            $hoy = date('Y-m-d');

            if ($hoy > $dataToView['oferta']['fechaVencimiento']) {
                echo '<p class="inscrito mt-5 inline-block rounded absolute right-10 bottom-5 bg-red-500 px-6 py-2 text-sm font-medium uppercase text-white shadow-md transition duration-150 ease-in-out">Esta oferta ha expirado.</p>';
            } else
        if ($dataToView['inscrito'] == true) { ?>
                <p class="inscrito mt-5 inline-block rounded absolute right-10 bottom-5 bg-secundario px-6 py-2 text-sm font-medium uppercase text-white shadow-md transition duration-150 ease-in-out">
                    Ya estás inscrito
                </p>
            <?php
            } else {
            ?>

                <a href="index.php?controller=OfertaController&action=inscribirseOferta&idOferta=<?php echo $dataToView['oferta']['idOferta']; ?>" class="mt-5 inline-block rounded absolute right-10 bottom-5 bg-primario px-6 py-2 text-sm font-semibold uppercase text-gray-700 shadow-md transition duration-150 ease-in-out">
                    Inscribirse
                </a>
            <?php } ?>
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

<style>
    @media screen and (max-width:992px) {
        #volverAtras {
            top: 12rem;
            left: 0.5rem !important;
            font-size: 1rem;
        }
    }
</style>