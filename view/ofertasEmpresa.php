<?php include('view/template/navbarEmpresa.php'); ?>


<main class="contenedorOfertas px-40 miPanelMovil my-8 relative flex flex-col">
    <a href="index.php?controller=EmpresaController&action=publicarOferta" class="inline-flex items-center text-gray-700 font-semibold px-2 py-1 bg-primario border border-transparent rounded mb-5 self-center md:self-end">
        Nueva Oferta
    </a>
    <section class="ofertas fijas grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-5 ">
        <?php if (is_array($dataToView['ofertasEmpresa']) || is_object($dataToView['ofertasEmpresa'])) {
        ?>
            <?php foreach ($dataToView['ofertasEmpresa'] as $oferta) { ?>
                <a href="index.php?controller=EmpresaController&action=verOferta&idOferta=<?= $oferta->getIdOferta(); ?>" class="inline-block bg-primario hover:bg-secundario text-white font-bold py-2 rounded-full">
                    <section class="oferta sm:w-full bg-white rounded overflow-hidden shadow-lg hover:bg-neutral-300 hover:text-white relative">
                        <div class="px-6 py-4 h-52">
                            <div class="font-bold text-black text-md lg:text-xl mb-2"><?= $oferta->getTitulo() ?></div>
                            <p class="text-gray-700 text-base mb-4"><i class="fas fa-calendar-alt"></i> Publicada: <?= $oferta->getFechaPublicacion() ?></p>
                            <p class="text-gray-700 text-base mb-4"><i class="fas fa-calendar-alt"></i> Vencimiento: <?= $oferta->getFechaVencimiento() ?></p>
                            <p class="text-gray-700 text-base mb-4"><i class="fas fa-users"></i> Inscritos: <?= $oferta->getNumInscritos() ?> </p>
                        </div>
                        <button href="index.php?controller=EmpresaController&action=verOferta&idOferta=<?= $oferta->getIdOferta() ?>" class="verOferta hidden absolute right-5 bottom-3  inline-block bg-primario hover:bg-secundario text-gray-700 font-semibold py-2 px-4 rounded-md">Ver Oferta</button>
                    </section>
                </a>
            <?php } ?>
        <?php
        } else { ?>
            <div class="w-full mb-4 rounded-lg uppercase bg-info-100 px-6 py-5 text-base text-secondary-800" role="alert">
                No hay ofertas disponibles
            </div>
        <?php } ?>
    </section>
</main>