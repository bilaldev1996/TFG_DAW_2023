<?php include('view/template/navbarEmpresa.php'); ?>

<main class="contenedorOfertas px-40 my-8 relative">

    <div class="switchVerificacion">
        <input class="mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]" type="checkbox" role="switch" id="verificado" />
        <label class="inline-block pl-[0.15rem] hover:cursor-pointer" for="verificado">Titulación Verificada</label>
    </div>
    <div class="search-container">

        <?php
        $titulaciones = array();
        foreach ($dataToView['ciclosFormativos'] as $ciclo) {
            $nivel = $ciclo->getNivel();
            $titulacion = $ciclo->getNombreCiclo();
            if (!isset($titulaciones[$nivel])) {
                $titulaciones[$nivel] = array();
            }
            $titulaciones[$nivel][] = $titulacion;
        }

        ?>
        <div class="relative">
            <select class="block appearance-none w-full bg-white text-black py-3 h-12 px-4 pr-8 t focus:outline-none focus:bg-white" id="titulacion" name="titulacion">
                <option value="">Selecciona una titulación</option>
                <?php foreach ($titulaciones as $nivel => $titulaciones_nivel) : ?>
                    <optgroup label="<?= $nivel ?>">
                        <?php foreach ($titulaciones_nivel as $titulacion) : ?>
                            <option value="<?= $titulacion ?>"><?= $titulacion ?></option>
                        <?php endforeach ?>
                    </optgroup>
                <?php endforeach ?>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-black">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9 11l-4 4-1-1 4-4-4-4 1-1 4 4 4-4 1 1-4 4 4 4-1 1-4-4z" />
                </svg>
            </div>
        </div>
        <button type="submit" id="botonBuscar" onclick="mostrarEstudiantes()"><i class="fa fa-search"></i></button>
    </div>


    <div id="resultadosBusquedaEstudiantes" class="ofertas gridEstudiantes gap-2 mt-16 2xl:grid-cols-3">
        <!-- Resultados de la busqueda -->
    </div>
    <section class="ofertas fijas gridEstudiantes gap-5 2xl:grid-cols-3">
        <?php if ($dataToView['estudiantes']) {
        ?>
            <?php
            foreach ($dataToView['estudiantes']  as $estudiante) { ?>
                <section class="oferta sm:w-full bg-white rounded overflow-hidden shadow-lg relative flex flex-col">
                    <article class="px-6 py-4 h-46 flex flex-col items-center">
                        <img src="assets/images/Estudiante/<?= $estudiante->getImagen() ?>" class="rounded-full h-20 w-20 mb-4 ">
                        <p class="font-bold text-black text-xl mb-2"><?= $estudiante->getNombre() ?> <?= $estudiante->getApellido1() ?> <?= $estudiante->getApellido2() ?></p>
                        <p class="text-gray-700 text-base mb-4"><i class="fas fa-envelope"></i> <a href="mailto:<?= $estudiante->getEmail() ?>" class="text-secundario hover:underline"><?= $estudiante->getEmail() ?></a></p>

                        <p class="text-gray-700 text-base mb-4"><i class="fas fa-phone"></i> <a href="tel:<?= $estudiante->getTelefono() ?>" class="text-secundario hover:underline"><?= $estudiante->getTelefono() ?></a></p>

                        <p class="text-gray-700 text-base mb-4"><i class="fas fa-check-circle"></i> <span class="font-bold"><?= $estudiante->getEstado() ?></span></p>
                        <a class="inline-block rounded  pb-2 uppercase text-gray-700 font-bold transition duration-150 ease-in-out" data-te-collapse-init data-te-ripple-init data-te-ripple-color="light" href="#collapseExample<?= $estudiante->getId() ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?= $estudiante->getId() ?>"><i class="fas fa-graduation-cap"></i>
                            <span class="underline">Titulaciones</span>
                        </a>

                        <div class="!visible hidden" id="collapseExample<?= $estudiante->getId() ?>" data-te-collapse-item>
                            <ul class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 dark:text-neutral-50 flex flex-col items-start gap-2">
                                <?php if ($estudiante->getTitulacionesEstudiante($estudiante->getId())) { ?>
                                    <?php foreach ($estudiante->getTitulacionesEstudiante($estudiante->getId()) as $titulacion) : ?>
                                        <li class="flex flex-row-reverse">
                                            <p><?= $titulacion['nombreCiclo'] ?></p>
                                            <?php if ($titulacion['verificado'] === 0) : ?>
                                                <svg viewBox="0 0 20 20" class="w-5 h-5 text-red-600" title="No verificado">
                                                    <path d="M4 4 L16 16 M4 16 L16 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                                </svg>
                                            <?php else : ?>
                                                <svg viewBox="0 0 20 20" class="fill-current h-5 w-5 mr-2 text-green-700" title="Verificado">
                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                </svg>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach ?>
                                <?php } else {
                                    echo "<p>No tiene ninguna titulación</p>";
                                } ?>

                            </ul>
                        </div>
                        <div class="">
                            <?php foreach ($estudiante->redesSocialesEstudiante($estudiante->getId()) as $red) : ?>
                                <?php if ($red['nombre_red'] == 'Linkedin') : ?>
                                    <a href="<?= $red['enlace_red'] ?>" class="text-xl" target="_blank"><i class="fab fa-linkedin text-l" style="color: #0077b5;"></i></a>
                                <?php elseif ($red['nombre_red'] == 'Instagram') : ?>
                                    <a href="<?= $red['enlace_red'] ?>" class="text-xl" target="_blank"><i class="fab fa-instagram text-l" style="color: #e1306c;"></i></a>
                                <?php elseif ($red['nombre_red'] == 'Facebook') :  ?>
                                    <a href="<?= $red['enlace_red'] ?>" class="text-xl" target="_blank"><i class="fab fa-facebook text-l" style="color: #1877f2;"></i></a>
                                <?php else : ?>
                                    <a href="<?= $red['enlace_red'] ?>" class="text-xl" target="_blank"><i class="fab fa-github text-l" style="color: #333;"></i></a>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </div>
                    </article>

                    <button class="relative self-center m-2 inline-block bg-primario hover:bg-secundario text-gray-700 font-semibold py-2 px-4 rounded-full" data-te-toggle="modal" data-te-target="#verCurriculum<?= $estudiante->getId() ?>" data-te-ripple-init data-te-ripple-color="light"><i class="fas fa-eye mr-2"></i> Ver Curriculum</button>
                    <!-- Modal curriculum -->
                    <div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="verCurriculum<?= $estudiante->getId() ?>" tabindex="-1" aria-labelledby="verCurriculumLabel" aria-hidden="true">
                        <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
                            <div class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-white-600">
                                <div class="flex justify-end flex-shrink-0 rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                    <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div>
                                    <embed class="w-full max-w-screen-md h-screen" src="assets/cvs/<?= $estudiante->getCurriculum() ?>" type="application/pdf" />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php
            } ?>
        <?php
        } else { ?>
            <div class="w-full mb-4 rounded-lg uppercase bg-info-100 px-6 py-5 text-base text-secondary-800" role="alert">
                No hay estudiantes disponibles
            </div>
        <?php } ?>
    </section>
</main>