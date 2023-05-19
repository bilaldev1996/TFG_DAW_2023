<?php include('view/template/navbarEstudiante.php'); ?>

<?php
$gestion = new Gestionar();
?>


<main class="misOfertas grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 px-40 my-10">
    <?php
    if (empty($dataToView['misOfertas'])) {
    ?>
        <div class="w-full mb-4 rounded-lg uppercase bg-info-100 px-6 py-5 text-base text-secondary-800" role="alert">
            Todavía no te has inscrito a ninguna oferta!
        </div>
        <?php
    } else {

        foreach ($dataToView['misOfertas'] as $oferta) {
            $ofertaId = $gestion->getOfertaById($oferta['idOferta']);
        ?>
            <article class="inline-block bg-primario hover:bg-secundario text-white font-bold py-2 rounded-full">
                <div class="sm:w-full bg-white rounded overflow-hidden shadow-lg">
                    <div class="px-5 py-4 h-52">
                        <div class="font-bold text-black text-md lg:text-xl mb-2 <?php if ($oferta['estadoCandidatura'] == 'Rechazado')  echo  'line-through' ?> ">
                            <?php echo $ofertaId['titulo'] ?>
                        </div>
                        <p class="text-gray-700 text-base mb-4 <?php if ($oferta['estadoCandidatura'] == 'En Proceso') {
                                                                    echo 'text-primario';
                                                                } else if ($oferta['estadoCandidatura'] == 'Rechazado') {
                                                                    echo 'text-red-700';
                                                                } else if ($oferta['estadoCandidatura'] == 'Contratado') {
                                                                    echo 'text-green-700';
                                                                } ?>">
                            <span class="font-bold">
                                <i class="far fa-handshake mr-2"></i>Estado candidatura:
                            </span>
                            <?php echo $oferta['estadoCandidatura'] ?>
                        </p>
                        <p class="text-gray-700 text-base mb-4">
                            <span class="font-bold">
                                <i class="far fa-calendar-alt mr-2"></i>Fecha Envío:
                            </span> <?php echo $oferta['fechaEnvio'] ?>
                        </p>
                        <div class="flex gap-2 text-center">
                            <a href="index.php?controller=OfertaController&action=verOferta&idOferta=<?php echo $oferta['idOferta'] ?>" class="inline-block bg-primario hover:bg-secundario text-gray-700 font-semibold py-2 px-4 rounded-md text-sm">Ver Oferta</a>
                            <?php if ($oferta['estadoCandidatura'] == 'Enviada') : ?>
                                <button onclick="retirarCandidatura(<?php echo $oferta['idOferta'] ?>)" class="inline-block bg-red-500 hover:bg-secundario text-white  py-2 px-4 rounded-md text-sm">Retirar Candidatura</button>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </article>
    <?php
        }
    }
    ?>
</main>