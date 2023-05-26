<?php include('template/navbarCentro.php'); ?>



<main class="my-10 px-40 mainPanelMovil flex flex-col">

    <section class="flex flex-col gap-2 flex-col-reverse md:flex-row lg:justify-between items-center mb-5 filtros w-full">
        <div class="flex">
            <button onclick="seleccionarTodo()" class="px-4 py-2 text-black bg-white">Seleccionar Todo</button>
            <button title="Validar Titulaciones" onclick="validar()" class="px-4 py-2 text-white bg-green-600 font-semibold validar disabled:opacity-50" disabled><i class="fas fa-check"></i></button>
        </div>
        <div class="flex relative right-0 search-container  top-0 ">
            <?php
            $titulaciones = array();
            foreach ($dataToView['ciclosCentro'] as $ciclo) {
                $nivel = $ciclo->getNivel();
                $titulacion = $ciclo->getNombreCiclo();
                if (!isset($titulaciones[$nivel])) {
                    $titulaciones[$nivel] = array();
                }
                $titulaciones[$nivel][] = $titulacion;
            }

            ?>
            <div class="relative">
                <select class="block appearance-none w-full bg-white  text-black py-3 h-12 px-4 pr-8 t focus:outline-none focus:bg-white" id="titulacion" name="titulacion">
                    <option value="">Selecciona una titulación</option>
                    <?php foreach ($titulaciones as $nivel => $titulaciones_nivel) : ?>
                        <optgroup label="<?= $nivel ?>">
                            <?php foreach ($titulaciones_nivel as $titulacion) : ?>
                                <option value="<?= $titulacion ?>"><?= $titulacion ?></option>
                            <?php endforeach ?>
                        </optgroup>
                    <?php endforeach ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9 11l-4 4-1-1 4-4-4-4 1-1 4 4 4-4 1 1-4 4 4 4-1 1-4-4z" />
                    </svg>
                </div>
            </div>
            <button type="submit" id="botonBuscar" onclick="mostrarEstudiantesPorTitulacion()"><i class="fa fa-search"></i></button>
        </div>
    </section>

    <section class="resultadosBusquedaEstudiantesTitulacion grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 fijas">
        <?php if (!$dataToView['estudiantesCentro']) {
            echo "<div class='bg-red-200 p-4 rounded-md'>No hay estudiantes con titulaciones en este centro</div>";
        } ?>
        <?php foreach ($dataToView['estudiantesCentro'] as $estudiante) : ?>
            <div class="bg-white shadow-md rounded-md overflow-hidden h-44 relative boxEstudiante <?= $estudiante['verificado'] ? 'verificado' : '' ?>" data-idEstudiante="<?= $estudiante['idEstudiante'] ?>" data-idCiclo="<?= $estudiante['idCiclo'] ?>">
                <div class=" px-6 py-4">
                    <h3 class="text-lg font-medium mb-2"><?= $estudiante['nombre'] . ' ' . $estudiante['apellido1'] . ' ' . $estudiante['apellido2'] ?></h3>
                    <p class="text-gray-600"><?= $estudiante['email'] ?></p>
                    <p class="text-gray-600"><?= $estudiante['nombreCiclo'] . ' - ' . $estudiante['anio_curso'] ?></p>
                    <p class="text-gray-600"><?= $estudiante['verificado'] == 1 ? '' : 'No verificado' ?></p>
                    <?php if ($estudiante['fecha_verificacion'] !== null) : ?>
                        <p class="text-gray-600">Verificado el <?= $estudiante['fecha_verificacion'] ?></p>
                    <?php endif ?>
                </div>

                <?php if ($estudiante['verificado'] !== 1) { ?>
                    <form action="index.php?controller=CentroController&action=validarTitulacion&idEstudiante=<?php echo $estudiante['idEstudiante'] ?>&idCiclo=<?php echo $estudiante['idCiclo'] ?>" method="post">
                        <div class="px-6 py-2 bg-primario flex justify-end gap-2 bottom-0 w-full absolute">
                            <button type="submit" class="inline-block px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-300 disabled:opacity-50 mr-2" <?= $estudiante['verificado'] == 1 ? 'disabled' : '' ?>>
                                Verificar
                            </button>
                            <button onclick="eliminarTitulacionEstudiante(event, <?php echo $estudiante['idEstudiante'] ?>,<?php echo $estudiante['idTitulacion'] ?> )" class="inline-block px-4 py-2 bg-red-600 border border-transparent  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-300 disabled:opacity-50">
                                Eliminar
                            </button>
                        </div>
                    </form>
                <?php } ?>
            </div>
        <?php endforeach; ?>
    </section>
</main>