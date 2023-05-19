<?php include('view/template/navbarCentro.php'); ?>

<main class="my-5 px-40 mainPanelMovil">
    <?php

    $gestionar = new Gestionar();

    if (isset($_GET['idCiclo'])) $ciclo = $gestionar->getCicloById($_GET['idCiclo']);

    if (!isset($_GET['idCiclo']) || $ciclo == false) {
    ?>

        <section class="flex justify-between mb-4 flex-col-reverse md:flex-row">
            <div class="leyenda flex gap-2 ">
                <div class="flex gap-2">
                    <div class="bg-blue-100 w-5 h-5"></div>
                    <p>Grado Básico</p>
                </div>
                <div class="flex gap-2">
                    <div class="bg-green-100 w-5 h-5"></div>
                    <p>Grado Medio</p>
                </div>
                <div class="flex gap-2">
                    <div class="bg-yellow-100 w-5 h-5"></div>
                    <p>Grado Superior</p>
                </div>
            </div>
            <a href="index.php?controller=CentroController&action=añadirCiclos" class="inline-flex items-center text-gray-700 font-semibold  px-2 py-1 bg-primario border border-transparent rounded self-end mb-4 md:mb-0">
                Nuevo Ciclo
            </a>
        </section>
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php if ($dataToView['misCiclos']) foreach ($dataToView['misCiclos'] as $ciclo) {
                $nivel = $ciclo->getNivel();
                $nivelClass = "";
                if ($nivel == "Grado Básico") {
                    $nivelClass = "bg-blue-100";
                } elseif ($nivel == "Grado Medio") {
                    $nivelClass = "bg-green-100";
                } elseif ($nivel == "Grado Superior") {
                    $nivelClass = "bg-yellow-100";
                }
            ?>

                <article class="shadow-md p-4 rounded-md bg-white <?= $nivelClass; ?>">
                    <h1 class="text-l font-semibold"><?= $ciclo->getNombreCiclo(); ?></h1>
                    <p class="text-gray-600"><?= $nivel; ?></p>
                    <p class="text-gray-600 capitalize"><?= $ciclo->getFamilia(); ?></p>
                    <div class="mt-4 justify-end flex gap-2">
                        <a href="index.php?controller=CentroController&amp;action=misCiclos&amp;idCiclo=<?= $ciclo->getIdCiclo(); ?>" class="inline-flex items-center text-white text-sm px-2 py-1 bg-secundario border border-transparent rounded">
                            Editar
                        </a>
                        <button onclick="eliminarCiclo(<?= $ciclo->getIdCiclo(); ?>)" id="eliminarCiclo" class="inline-flex items-center text-white text-sm px-2 py-1 bg-red-600 border rounded border-transparent">
                            Eliminar
                        </button>
                    </div>
                </article>
            <?php } ?>
        </section>


    <?php } else { ?>

        <form class="w-full lg:mx-auto lg:w-2/3 lg:shadow-lg p-5 mt-10" id="editarCiclo" action="index.php?controller=CentroController&action=editarCiclo" method="POST">
            <h2 class="text-2xl font-bold mb-4"><i class="fas fa-edit"></i> Actualizar Ciclo</h2>
            <input type="hidden" value="<?= $ciclo->getIdCiclo() ?>" name="idCiclo">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
                        Nombre Ciclo
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white mb-3" id="nombre" name="nombre" type="text" value="<?= $ciclo->getNombreCiclo(); ?>" required>
                    <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nivel">
                        Nivel
                    </label>
                    <div class="relative mb-3">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="nivel" name="nivel">
                            <option value="Grado Básico" <?php if ($ciclo->getNivel() == 'Grado Básico') echo ' selected'; ?>>Grado Básico</option>
                            <option value="Grado Medio" <?php if ($ciclo->getNivel() == 'Grado Medio') echo ' selected'; ?>>Grado Medio</option>
                            <option value="Grado Superior" <?php if ($ciclo->getNivel() == 'Grado Superior') echo ' selected'; ?>>Grado Superior</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="familia">
                        Familia
                    </label>
                    <div class="relative mb-3">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="familia" name="familia">
                            <option value="servicios socioculturales" <?php if ($ciclo->getFamilia() == 'servicios socioculturales') echo ' selected'; ?>>Servicios
                                Socioculturales
                                y a la Comunidad</option>

                            <option value="electricidad y electrónica" <?php if ($ciclo->getFamilia() == 'electricidad y electrónica') echo ' selected'; ?>>Electricidad y
                                Electrónica </option>
                            <option value="hosterleria y turismo" <?php if ($ciclo->getFamilia() == 'hosterleria y turismo') echo ' selected'; ?>>Hostelería y Turismo</option>
                            <option value="industrias alimentarias" <?php if ($ciclo->getFamilia() == 'industrias alimentarias') echo ' selected'; ?>>Industrias Alimentarias</option>
                            <option value="transporte y mantenimiento de vehículos" <?php if ($ciclo->getFamilia() == 'transporte y mantenimiento de vehículos') echo ' selected'; ?>>Transporte y
                                Mantenimiento de
                                Vehículos</option>
                            <option value="Sanidad" <?php if ($ciclo->getFamilia() == 'sanidad') echo ' selected'; ?>>Sanidad</option>
                            <option value="comunicación gráfica y audiovisual" <?php if ($ciclo->getFamilia() == 'comunicación gráfica y audiovisual') echo ' selected'; ?>>Comunicación
                                Gráfica y
                                Audiovisual</option>
                            <option value="Agraria" <?php if ($ciclo->getFamilia() == 'agraria') echo ' selected'; ?>>Agraria</option>
                            <option value="imagen y sonido" <?php if ($ciclo->getFamilia() == 'imagen y sonido') echo ' selected'; ?>>Imagen y Sonido</option>
                            <option value="edificación y obra civil" <?php if ($ciclo->getFamilia() == 'edificación y obra civill') echo ' selected'; ?>>Edificación y Obra Civil</option>
                            <option value="energía y agua" <?php if ($ciclo->getFamilia() == 'energía y agua') echo ' selected'; ?>>Energía y Agua</option>
                            <option value="instalación y mantenimiento" <?php if ($ciclo->getFamilia() == 'instalación y mantenimiento') echo ' selected'; ?>>Instalación y Mantenimiento</option>
                            <option value="textil,confección y piel" <?php if ($ciclo->getFamilia() == 'textil,confección y piel') echo ' selected'; ?>>Textil, Confección y Piel</option>
                            <option value="informática y comunicaciones" <?php if ($ciclo->getFamilia() == 'informática y comunicaciones') echo ' selected'; ?>>Informática y
                                Comunicaciones</option>
                            <option value="comercio y marketing" <?php if ($ciclo->getFamilia() == 'comercio y marketing') echo ' selected'; ?>>Comercio y
                                Marketing</option>
                            <option value="administración" <?php if ($ciclo->getFamilia() == 'administración') echo ' selected'; ?>>Administración y
                                Gestión</option>
                            <option value="mantenimiento y servicios a la producción" <?php if ($ciclo->getFamilia() == 'mantenimiento y servicios a la produccion') echo ' selected'; ?>>Mantenimiento y
                                Servicios a la
                                Producción</option>
                            <option value="actividades físicas y deportivas" <?php if ($ciclo->getFamilia() == 'actividades físicas y deportivas') echo ' selected'; ?>>Actividades Físicas
                                y Deportivas</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex -mx-3 mb-2 flex-wrap lg:flex-nowrap">
                <button type="submit" class="w-full px-4 py-2 bg-primario text-black font-semibold rounded  focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2">
                    Actualizar Ciclo
                </button>
                <a href="index.php?controller=CentroController&action=misCiclos" class="w-full px-4 py-2 bg-secundario text-white text-center font-semibold rounded  focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2">
                    Volver atrás
                </a>
            </div>
        </form>
    <?php } ?>
</main>