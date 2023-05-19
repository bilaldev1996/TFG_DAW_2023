<?php include('view/template/navbarEmpresa.php'); ?>



<main class="px-40 mainPanelMovil lg:mt-10">
    <a href="#" onclick="history.go(-1); return false;" class="text-secundario absolute left-5 lg:left-40" id="volverAtras">
        <i class="fas fa-arrow-circle-left"></i> Volver
    </a>
    <h2 class="text-md lg:text-3xl font-bold text-secundario my-4 text-center">Puesto: <?= $dataToView['oferta']->getTitulo() ?></h2>

    <ul class="mb-5 flex list-none flex-col flex-wrap border-b-0 pl-0 md:flex-row " role="tablist" data-te-nav-ref>
        <li role="presentation" class="border">
            <a href="#tabs-inscritos" class=" block border-x-0 border-t-0 border-b-2 border-transparent px-7 pt-4 pb-3.5 text-xs font-medium uppercase text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent  dark:text-neutral-400  dark:data-[te-nav-active]:bg-neutral-300 dark:data-[te-nav-active]:text-white" data-te-toggle="pill" data-te-target="#tabs-inscritos" data-te-nav-active role="tab" aria-controls="tabs-inscritos" aria-selected="true">Inscritos <?php if ($dataToView['estudiantesInscritos']) :  ?>
                    <span class='bg-black rounded-full px-2 py-1 ml-2 text-xs font-bold text-white'><?= count($dataToView['estudiantesInscritos']) ?></span>
                <?php endif ?>
            </a>
        </li>
        <li role="presentation" class="border">
            <a href="#tabs-proceso" class=" block border-x-0 border-t-0 border-b-2 border-transparent px-7 pt-4 pb-3.5 text-xs font-medium uppercase text-neutral-500 hover:isolate hover:border-transparent hover:bg-amber-100 focus:isolate focus:border-transparent dark:data-[te-nav-active]:bg-amber-300 dark:data-[te-nav-active]:text-white " data-te-toggle="pill" data-te-target="#tabs-proceso" role="tab" aria-controls="tabs-proceso" aria-selected="false">En Proceso <?php if ($dataToView['estudiantesProceso']) :  ?>
                    <span class='bg-amber-600 rounded-full px-2 py-1 ml-2 text-xs font-bold text-white'><?= count($dataToView['estudiantesProceso']) ?></span>
                <?php endif ?>
            </a>
        </li>
        <li role="presentation" class="border">
            <a href="#tabs-contratados" class=" block border-x-0 border-t-0 border-b-2 border-transparent px-7 pt-4 pb-3.5 text-xs font-medium uppercase text-neutral-500 hover:isolate hover:border-transparent hover:bg-green-100 focus:isolate focus:border-transparent dark:data-[te-nav-active]:bg-green-300 dark:data-[te-nav-active]:text-white" data-te-toggle="pill" data-te-target="#tabs-contratados" role="tab" aria-controls="tabs-contratados" aria-selected="false">Contratados
                <?php if ($dataToView['estudiantesContratados']) :  ?>
                    <span class='bg-green-600 rounded-full px-2 py-1 ml-2 text-xs font-bold text-white'><?= count($dataToView['estudiantesContratados']) ?></span>
                <?php endif ?>
            </a>

        </li>
        <li role="presentation" class="border">
            <a href="#tabs-descartados" class=" block border-x-0 border-t-0 border-b-2 border-transparent px-7 pt-4 pb-3.5 text-xs font-medium uppercase text-neutral-500 hover:isolate hover:border-transparent hover:bg-red-100 focus:isolate focus:border-transparent dark:data-[te-nav-active]:bg-red-300 dark:data-[te-nav-active]:text-white" data-te-toggle="pill" data-te-target="#tabs-descartados" role="tab" aria-controls="tabs-descartados" aria-selected="false">Descartados
                <?php if ($dataToView['estudiantesRechazados']) :  ?>
                    <span class='bg-red-600 rounded-full px-2 py-1 ml-2 text-xs font-bold text-white'><?= count($dataToView['estudiantesRechazados']) ?></span>
                <?php endif ?>
            </a>
        </li>

    </ul>
    <div class="hidden opacity-0 opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block overflow-x-auto" id="tabs-inscritos" role="tabpanel" aria-labelledby="tabs-inscritos-tab" data-te-tab-active>
        <?php if (is_array($dataToView['estudiantesInscritos']) || is_object($dataToView['estudiantesInscritos'])) { ?>
            <table class="table-auto border">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Nombre completo</th>
                        <th class="px-4 py-2 border">Teléfono</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Enviada</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($dataToView['estudiantesInscritos'] as $estudiante) :
                    ?>

                        <tr>
                            <td class="border px-4 py-2 text-sm"><?= $estudiante->getNombre() ?> <?= $estudiante->getApellido1() ?> <?= $estudiante->getApellido2() ?></td>
                            <td class="border px-4 py-2 text-sm"><?= $estudiante->getTelefono() ?></td>
                            <td class="border px-4 py-2 text-sm"><?= $estudiante->getEmail() ?></td>
                            <td class="border px-4 py-2 text-sm"><?= implode($dataToView['fechaEnvio'][$i]) ?></td>
                            <td class="border px-4 py-2 text-sm">
                                <a href="#" class="text-indigo-500 hover:text-indigo-600 mr-2" data-te-toggle="modal" data-te-target="#verCurriculum<?= $estudiante->getId() ?>" data-te-ripple-color="light">
                                    <i class="fas fa-eye mr-2"></i>Ver curriculum
                                </a>
                                <a href="index.php?controller=EmpresaController&action=contratarEstudiante&idEstudiante=<?= $estudiante->getId() ?>&idOferta=<?= $dataToView['oferta']->getIdOferta() ?>" class="text-green-500 hover:text-green-600 mr-2">
                                    <i class="fas fa-check mr-2"></i>Contratar
                                </a>
                                <a href="index.php?controller=EmpresaController&action=descartarEstudiante&idEstudiante=<?= $estudiante->getId() ?>&idOferta=<?= $dataToView['oferta']->getIdOferta() ?>" class="text-red-500 hover:text-red-600 mr-2">
                                    <i class="fas fa-times mr-2"></i>Descartar
                                </a>
                                <a href="index.php?controller=EmpresaController&action=procesoEstudiante&idEstudiante=<?= $estudiante->getId() ?>&idOferta=<?= $dataToView['oferta']->getIdOferta() ?>" class="text-amber-500 hover:text-amber-600">
                                    <i class="fas fa-spinner  mr-2"></i>En Proceso
                                </a>

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
                            </td>
                        </tr>
                    <?php
                        $i++;
                    endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div>
                No tienes estudiantes inscritos
            </div>
        <?php } ?>
    </div>
    <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block overflow-x-auto" id="tabs-proceso" role="tabpanel" aria-labelledby="tabs-profile-tab">
        <?php if (is_array($dataToView['estudiantesProceso']) || is_object($dataToView['estudiantesProceso'])) { ?>

            <table class="table-auto border">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Nombre completo</th>
                        <th class="px-4 py-2 border">Teléfono</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Enviada</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($dataToView['estudiantesProceso'] as $estudiante) :
                    ?>

                        <tr>
                            <td class="border px-4 py-2 text-sm"><?= $estudiante->getNombre() ?> <?= $estudiante->getApellido1() ?> <?= $estudiante->getApellido2() ?></td>
                            <td class="border px-4 py-2 text-sm"><?= $estudiante->getTelefono() ?></td>
                            <td class="border px-4 py-2 text-sm"><?= $estudiante->getEmail() ?></td>
                            <td class="border px-4 py-2 text-sm "><?= implode($dataToView['fechaEnvio'][$i]) ?></td>
                            <td class="border px-4 py-2 text-sm">
                                <a href="#" class="text-indigo-500 hover:text-indigo-600 mr-2" data-te-toggle="modal" data-te-target="#verCurriculumProceso<?= $estudiante->getId() ?>" data-te-ripple-color="light">
                                    <i class="fas fa-eye mr-2"></i>Ver curriculum
                                </a>
                                <a href="index.php?controller=EmpresaController&action=contratarEstudiante&idEstudiante=<?= $estudiante->getId() ?>&idOferta=<?= $dataToView['oferta']->getIdOferta() ?>" class="text-green-500 hover:text-green-600 mr-2">
                                    <i class="fas fa-check mr-2"></i>Contratar
                                </a>
                                <a href="index.php?controller=EmpresaController&action=descartarEstudiante&idEstudiante=<?= $estudiante->getId() ?>&idOferta=<?= $dataToView['oferta']->getIdOferta() ?>" class="text-red-500 hover:text-red-600 mr-2">
                                    <i class="fas fa-times mr-2"></i>Descartar
                                </a>
                                <a href="index.php?controller=EmpresaController&action=procesoEstudiante&idEstudiante=<?= $estudiante->getId() ?>&idOferta=<?= $dataToView['oferta']->getIdOferta() ?>" class="text-amber-500 hover:text-amber-600">
                                    <i class="fas fa-spinner  mr-2"></i>En Proceso
                                </a>

                                <!-- Modal curriculum -->
                                <div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="verCurriculumProceso<?= $estudiante->getId() ?>" tabindex="-1" aria-labelledby="verCurriculumProcesoLabel" aria-hidden="true">
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
                            </td>
                        </tr>
                    <?php
                        $i++;
                    endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div>
                No tienes estudiantes en proceso
            </div>
        <?php } ?>
    </div>
    <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block overflow-x-auto" id="tabs-contratados" role="tabpanel" aria-labelledby="tabs-profile-tab">
        <?php if (is_array($dataToView['estudiantesContratados']) || is_object($dataToView['estudiantesContratados'])) { ?>
            <table class="table-auto border">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Nombre completo</th>
                        <th class="px-4 py-2 border">Teléfono</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Enviada</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($dataToView['estudiantesContratados'] as $estudiante) :
                    ?>

                        <tr>
                            <td class="border px-4 py-2 text-sm"><?= $estudiante->getNombre() ?> <?= $estudiante->getApellido1() ?> <?= $estudiante->getApellido2() ?></td>
                            <td class="border px-4 py-2 text-sm"><?= $estudiante->getTelefono() ?></td>
                            <td class="border px-4 py-2 text-sm"><?= $estudiante->getEmail() ?></td>
                            <td class="border px-4 py-2 text-sm"><?= implode($dataToView['fechaEnvio'][$i]) ?></td>
                            <td class="border px-4 py-2 text-sm">
                                <a href="#" class="text-indigo-500 hover:text-indigo-600 mr-2" data-te-toggle="modal" data-te-target="#verCurriculumContratados<?= $estudiante->getId() ?>" data-te-ripple-color="light">
                                    <i class="fas fa-eye mr-2"></i>Ver curriculum
                                </a>
                                <a href="index.php?controller=EmpresaController&action=contratarEstudiante&idEstudiante=<?= $estudiante->getId() ?>&idOferta=<?= $dataToView['oferta']->getIdOferta() ?>" class="text-green-500 hover:text-green-600 mr-2">
                                    <i class="fas fa-check mr-2"></i>Contratar
                                </a>
                                <a href="index.php?controller=EmpresaController&action=descartarEstudiante&idEstudiante=<?= $estudiante->getId() ?>&idOferta=<?= $dataToView['oferta']->getIdOferta() ?>" class="text-red-500 hover:text-red-600 mr-2">
                                    <i class="fas fa-times mr-2"></i>Descartar
                                </a>
                                <a href="index.php?controller=EmpresaController&action=procesoEstudiante&idEstudiante=<?= $estudiante->getId() ?>&idOferta=<?= $dataToView['oferta']->getIdOferta() ?>" class="text-amber-500 hover:text-amber-600">
                                    <i class="fas fa-spinner  mr-2"></i>En Proceso
                                </a>

                                <!-- Modal curriculum -->
                                <div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="verCurriculumContratados<?= $estudiante->getId() ?>" tabindex="-1" aria-labelledby="verCurriculumContratadosLabel" aria-hidden="true">
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
                            </td>
                        </tr>
                    <?php
                        $i++;
                    endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div>
                No tienes estudiantes contratados
            </div>
        <?php } ?>
    </div>
    <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block overflow-x-auto" id="tabs-descartados" role="tabpanel" aria-labelledby="tabs-profile-tab">
        <?php if (is_array($dataToView['estudiantesRechazados']) || is_object($dataToView['estudiantesRechazados'])) { ?>
            <table class="table-auto border">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Nombre completo</th>
                        <th class="px-4 py-2 border">Teléfono</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Enviada</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($dataToView['estudiantesRechazados'] as $estudiante) :
                    ?>

                        <tr>
                            <td class="border px-4 py-2 text-sm"><?= $estudiante->getNombre() ?> <?= $estudiante->getApellido1() ?> <?= $estudiante->getApellido2() ?></td>
                            <td class="border px-4 py-2 text-sm"><?= $estudiante->getTelefono() ?></td>
                            <td class="border px-4 py-2 text-sm"><?= $estudiante->getEmail() ?></td>
                            <td class="border px-4 py-2 text-sm"><?= implode($dataToView['fechaEnvio'][$i]) ?></td>
                            <td class="border px-4 py-2 text-sm">
                                <a href="#" class="text-indigo-500 hover:text-indigo-600 mr-2" data-te-toggle="modal" data-te-target="#verCurriculumRechazados<?= $estudiante->getId() ?>" data-te-ripple-color="light">
                                    <i class="fas fa-eye mr-2"></i>Ver curriculum
                                </a>
                                <a href="index.php?controller=EmpresaController&action=contratarEstudiante&idEstudiante=<?= $estudiante->getId() ?>&idOferta=<?= $dataToView['oferta']->getIdOferta() ?>" class="text-green-500 hover:text-green-600 mr-2">
                                    <i class="fas fa-check mr-2"></i>Contratar
                                </a>
                                <a href="index.php?controller=EmpresaController&action=descartarEstudiante&idEstudiante=<?= $estudiante->getId() ?>&idOferta=<?= $dataToView['oferta']->getIdOferta() ?>" class="text-red-500 hover:text-red-600 mr-2">
                                    <i class="fas fa-times mr-2"></i>Descartar
                                </a>
                                <a href="index.php?controller=EmpresaController&action=procesoEstudiante&idEstudiante=<?= $estudiante->getId() ?>&idOferta=<?= $dataToView['oferta']->getIdOferta() ?>" class="text-amber-500 hover:text-amber-600">
                                    <i class="fas fa-spinner  mr-2"></i>En Proceso
                                </a>

                                <!-- Modal curriculum -->
                                <div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="verCurriculumRechazados<?= $estudiante->getId() ?>" tabindex="-1" aria-labelledby="verCurriculumRechazadosLabel" aria-hidden="true">
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
                            </td>
                        </tr>
                    <?php
                        $i++;
                    endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div>
                No tienes estudiantes descartados
            </div>
        <?php } ?>

    </div>

</main>