<?php include('view/template/navbarEstudiante.php'); ?>



<main class="contenedorOfertas px-40 my-8 relative">
    <div class="search-container">
        <input type="text" id="inputBusqueda" placeholder="Buscar..." list="ofertas-lista">
        <button type="submit" id="botonBuscar" onclick="mostrarOfertas()"><i class="fa fa-search"></i></button>
    </div>

    <datalist id="ofertas-lista">
        <?php
        $ofertasMostradas = array();
        foreach ($dataToView['ofertas'] as $oferta) {
            $titulo = $oferta->getTitulo();
            if (!in_array($titulo, $ofertasMostradas)) {
                echo '<option value="' . $titulo . '">';
                $ofertasMostradas[] = $titulo;
            }
        }
        ?>
    </datalist>

    <div id="resultadosBusqueda" class="ofertas grid gap-2 2xl:grid-cols-3 mt-16">
        <!-- Resultados de la busqueda -->
    </div>
    <section class="ofertas fijas grid 2xl:grid-cols-3 gap-5 ">
        <?php if ($dataToView['ofertas']) {
        ?>
            <?php foreach ($dataToView['ofertas'] as $oferta) { ?>
                <a href="index.php?controller=OfertaController&action=verOferta&idOferta=<?= $oferta->getIdOferta(); ?>" class="inline-block bg-primario hover:bg-secundario text-white font-bold py-2 rounded-full">
                    <section class="oferta sm:w-full bg-white rounded overflow-hidden shadow-lg hover:bg-neutral-300 hover:text-white relative">
                        <div class="px-6 py-4 h-60">
                            <div class="font-bold text-black text-md lg:text-xl mb-2"><?= $oferta->getTitulo() ?></div>
                            <p class="text-gray-700 text-base mb-4"><i class="fas fa-building"></i> <?= $oferta->getNombreEmpresa() ?></p>
                            <p class="text-gray-700 text-base mb-4"> <i class="fas fa-euro-sign"></i> <?= $oferta->getSalario() ?></p>
                            <p class="text-gray-700 text-base mb-4"><i class="fas fa-calendar-alt"></i> <?= $oferta->getFechaPublicacion() ?></p>
                            <p class="text-gray-700 text-base mb-4"><i class="fas fa-users"></i> <?= $oferta->getNumVacantes() ?> vacantes</p>

                            <?php if (in_array($oferta->getIdOferta(), $dataToView['ids'])) { ?>
                                <p class="text-gray-700 text-secundario mb-4"><i class="fas fa-check"></i> Inscrito</p>
                            <?php } ?>
                        </div>
                        <button href="index.php?controller=OfertaController&action=verOferta&idOferta=<?= $oferta->getIdOferta() ?>" class="verOferta hidden absolute right-5 bottom-3  inline-block bg-primario hover:bg-secundario text-black font-bold py-2 px-4 rounded-md">Ver Oferta</button>
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