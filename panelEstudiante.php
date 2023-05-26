<?php include('view/template/navbarEstudiante.php'); ?>


<main class="px-40 mainPanelMovil">

    <?php if ($dataToView['estudiante']['perfil'] === 'Privado' && !isset($_SESSION['toast_shown'])) : ?>
        <div class="pointer-events-auto mx-auto hidden mt-5 w-full rounded-lg bg-white bg-clip-padding text-sm shadow-lg shadow-black/5 data-[te-toast-show]:block data-[te-toast-hide]:hidden" id="static-example" role="alert" aria-live="assertive" aria-atomic="true" data-te-autohide="false" data-te-toast-init data-te-toast-show>
            <div class="flex items-center justify-between rounded-t-lg border-b-2 border-neutral-100 border-opacity-100 bg-white bg-clip-padding px-4 pb-2 pt-2.5">
                <p class="font-bold text-gray-700">
                    Perfil
                </p>
                <div class="flex items-center">
                    <button type="button" class="ml-2 box-content rounded-none border-none opacity-80 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-toast-dismiss aria-label="Close">
                        <span class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&.disabled]:pointer-events-none [&.disabled]:select-none [&.disabled]:opacity-25">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
            <div class="break-words rounded-b-lg bg-white px-4 py-4 text-gray-700">
                Su perfil está configurado como privado. La visibilidad de su currículum está restringida a las empresas.
            </div>
        </div>
        <?php $_SESSION['toast_shown'] = true; ?>
    <?php endif ?>



    <ul class="mb-5 flex list-none flex-col flex-wrap border-b-0 pl-0 md:flex-row" role="tablist" data-te-nav-ref>
        <li role="presentation">
            <a href="#tabs-home" class="my-2 block border-x-0 border-t-0 border-b-2 border-transparent px-7 pt-4 pb-3.5 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-indigo-600 data-[te-nav-active]:text-secundario dark:text-neutral-400  dark:data-[te-nav-active]:border-indigo-600 dark:data-[te-nav-active]:text-secundario" data-te-toggle="pill" data-te-target="#tabs-home" data-te-nav-active role="tab" aria-controls="tabs-home" aria-selected="true">Información de Cuenta</a>
        </li>
        <li role="presentation">
            <a href="#tabs-contact" class="my-2 block border-x-0 border-t-0 border-b-2 border-transparent px-7 pt-4 pb-3.5 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-indigo-600 data-[te-nav-active]:text-secundario dark:text-neutral-400  dark:data-[te-nav-active]:border-indigo-600 dark:data-[te-nav-active]:text-secundario" data-te-toggle="pill" data-te-target="#tabs-contact" role="tab" aria-controls="tabs-contact" aria-selected="false">Educación</a>
        </li>
        <li role="presentation">
            <a href="#tabs-messages" class="my-2 block border-x-0 border-t-0 border-b-2 border-transparent px-7 pt-4 pb-3.5 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400  dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400" data-te-toggle="pill" data-te-target="#tabs-messages" role="tab" aria-controls="tabs-messages" aria-selected="false">CV</a>
        </li>
    </ul>


    <section class="mb-6 relative">
        <!-- Tab informacion personal -->
        <article class="hidden opacity-0 opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block" id="tabs-home" role="tabpanel" aria-labelledby="tabs-home-tab" data-te-tab-active>

            <div class="tarjeta">
                <div class="mx-auto mt-10 front w-full">
                    <div class="mx-auto bg-white rounded-xl shadow-md overflow-hidden w-full md:w-1/2 bg-white">
                        <div class="p-6 w-full relative">
                            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold"><?= $dataToView['estudiante']['perfil'] ?></div>
                            <p class="capitalize block mt-1 text-lg leading-tight font-medium text-black "><?= $dataToView['estudiante']['nombre'] ?> <?= $dataToView['estudiante']['apellido1'] ?> <?= $dataToView['estudiante']['apellido2'] ?></p>
                            <p class="mt-2 text-gray-500"><?= $dataToView['estudiante']['email'] ?></p>
                            <p class="mt-2 text-gray-500"><?= $dataToView['estudiante']['estado'] ?></p>
                            <p class="mt-2 text-gray-500"><?= $dataToView['estudiante']['telefono'] ?></p>
                            <div class="mt-3">
                                <?php foreach ($dataToView['redesSociales'] as $red) : ?>
                                    <?php if ($red['nombre_red'] == 'Linkedin') : ?>
                                        <a href="<?= $red['enlace_red'] ?>" title="linkedin" class="text-xl" target="_blank"><i class="fab fa-linkedin text-l" style="color: #0077b5;"></i></a>
                                    <?php elseif ($red['nombre_red'] == 'Instagram') : ?>
                                        <a href="<?= $red['enlace_red'] ?>" title="instagram" class="text-xl" target="_blank"><i class="fab fa-instagram text-l" style="color: #e1306c;"></i></a>
                                    <?php elseif ($red['nombre_red'] == 'Facebook') :  ?>
                                        <a href="<?= $red['enlace_red'] ?>" title="facebook" class="text-xl" target="_blank"><i class="fab fa-facebook text-l" style="color: #1877f2;"></i></a>
                                    <?php else : ?>
                                        <a href="<?= $red['enlace_red'] ?>" title="github" class="text-xl" target="_blank"><i class="fab fa-github text-l" style="color: #333;"></i></a>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="mt-4">
                                <a href="assets/cvs/<?php echo $dataToView['estudiante']['curriculum'] ?>" download class="text-indigo-500 hover:text-indigo-600">
                                    <i class="fas fa-download mr-2"></i>Descargar curriculum
                                </a>
                            </div>
                            <button class="editar bg-primario text-gray-700  font-semibold  p-5 absolute bottom-0 right-0">Editar</button>
                        </div>
                    </div>
                </div>
                <div class="form-container mt-0 back lg:shadow-lg">
                    <form class="w-full max-w-xxl" action="index.php?controller=EstudianteController&action=actualizarPerfil" method="POST" id="formularioRegistro">
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
                                    Nombre
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white mb-3" id="nombre" name="nombre" type="text" placeholder="Jane" value="<?php echo $dataToView['estudiante']['nombre'] ?>">
                                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="apellido1">
                                    Primer Apellido
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="apellido1" name="apellido1" type="text" placeholder="Doe" value="<?php echo $dataToView['estudiante']['apellido1'] ?>">
                                <p class="text-red-500 text-xs italic hidden"></p>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="apellido2">
                                    Segundo Apellido
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="apellido2" name="apellido2" type="text" placeholder="Doe" value="<?php echo $dataToView['estudiante']['apellido2'] ?>">
                                <p class=" text-red-500 text-xs italic mb-3 hidden"></p>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                                    Email
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" name="email" placeholder="john@gmail.com" value="<?php echo $dataToView['estudiante']['email'] ?>">
                                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="telefono">
                                    Teléfono
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="telefono" type="tel" name="telefono" placeholder="636456789" value="<?php echo $dataToView['estudiante']['telefono'] ?>">
                                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                                    Nueva Contraseña <span class="text-gray-400 font-normal lowercase">(Dejar en blanco si no deseas cambiarla)</span>
                                </label>
                                <div class="relative">
                                    <input id="password" type="password" name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="******************">
                                    <p class="text-red-500 text-xs italic mb-3 hidden absolute"></p>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg class="h-6 w-6 text-gray-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" onclick="togglePassword()">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M10 3C5.5 3 1.9 5.7 0 10c1.9 4.3 5.5 7 10 7s8.1-2.7 10-7c-1.9-4.3-5.5-7-10-7zm0 12a6 6 0 110-12 6 6 0 010 12z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <fieldset class="flex flex-wrap  mb-8 border mx-3">
                            <legend class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Redes Sociales</legend>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="linkedin">Linkedin</label>
                                <?php $linkedin = ''; ?>
                                <?php foreach ($dataToView['redesSociales'] as $red) : ?>
                                    <?php if ($red['nombre_red'] == 'Linkedin') {
                                        $linkedin = $red['enlace_red'];
                                        break;
                                    } ?>
                                <?php endforeach; ?>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="linkedin" name="linkedin" type="text" placeholder="Ingresa su perfil de Linkedin" value="<?php echo $linkedin; ?>">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="instagram">Instagram</label>
                                <?php $instagram = ''; ?>
                                <?php foreach ($dataToView['redesSociales'] as $red) : ?>
                                    <?php if ($red['nombre_red'] == 'Instagram') {
                                        $instagram = $red['enlace_red'];
                                        break;
                                    } ?>
                                <?php endforeach; ?>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="instagram" type="text" name="instagram" placeholder="Ingresa su perfil de Instagram" value="<?php echo $instagram; ?>">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="facebook">Facebook</label>
                                <?php $facebook = ''; ?>
                                <?php foreach ($dataToView['redesSociales'] as $red) : ?>
                                    <?php if ($red['nombre_red'] == 'Facebook') {
                                        $facebook = $red['enlace_red'];
                                        break;
                                    } ?>
                                <?php endforeach; ?>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="facebook" type="text" name="facebook" placeholder="Ingresa su perfil de Facebook" value="<?php echo $facebook; ?>">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="facebook">Github</label>
                                <?php $github = ''; ?>
                                <?php foreach ($dataToView['redesSociales'] as $red) : ?>
                                    <?php if ($red['nombre_red'] == 'Github') {
                                        $github = $red['enlace_red'];
                                        break;
                                    } ?>
                                <?php endforeach; ?>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="github" type="text" name="github" placeholder="Ingresa su perfil de Github" value="<?php echo $github; ?>">
                            </div>
                        </fieldset>

                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="perfil">
                                    Perfil
                                </label>
                                <div class="relative mb-3">
                                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="perfil" name="perfil">
                                        <option value="Público" <?php if ($dataToView['estudiante']['perfil'] == 'Público') echo 'selected' ?>>Público</option>
                                        <option value="Privado" <?php if ($dataToView['estudiante']['perfil'] == 'Privado') echo 'selected' ?>>Privado</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="estado">
                                    Estado
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="estado" name="estado">
                                        <option value="Buscando Trabajo" <?php if ($dataToView['estudiante']['estado'] == 'Buscando Trabajo') echo ' selected'; ?>>Buscando trabajo</option>
                                        <option value="Buscando Prácticas" <?php if ($dataToView['estudiante']['estado'] == 'Buscando Prácticas') echo ' selected'; ?>>Buscando prácticas</option>

                                        <option value="Estudiando" <?php if ($dataToView['estudiante']['estado'] == 'Estudiando') echo ' selected'; ?>>Estudiando</option>
                                        <option value="En Prácticas" <?php if ($dataToView['estudiante']['estado'] == 'En Prácticas') echo ' selected'; ?>>En prácticas</option>
                                    </select>

                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap md:flex-nowrap -mx-3 mb-2">
                            <button type="submit" class="w-full px-4 py-2 bg-primario text-gray-700  font-semibold rounded shadow-lg hover:shadow-none transition-all duration-300 m-2">
                                Actualizar
                            </button>
                            <a id="btnAtras" class="w-full px-4 py-2 bg-secundario text-white font-semibold rounded shadow-lg hover:shadow-none transition-all duration-300 m-2 cancelar text-center cursor-pointer">Volver atrás</a>
                        </div>
                    </form>

                </div>
            </div>
        </article>

        <!-- Tab curriculum -->
        <article class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block" id="tabs-messages" role="tabpanel" aria-labelledby="tabs-profile-tab">
            <div class="flex flex-col gap-5 items-center">
                <embed class="w-full max-w-screen-md lg:h-screen" src="assets/cvs/<?php echo $dataToView['estudiante']['curriculum'] ?>" type="application/pdf" />
                <form action="index.php?controller=EstudianteController&action=cambiarCurriculum" class="w-full max-w-screen-md mx-auto flex flex-col gap-4 items-center" method="POST" enctype="multipart/form-data">
                    <label class="w-full text-center flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mb-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                        <span class="mt-2 text-base" id="file-chosen2">Haz clic para cambiar tu CV</span>
                        <input type='file' class="hidden" name="curriculum" id="curriculum" accept=".pdf" />
                        <p class="text-red-500 text-xs italic mt-3 hidden"></p>
                    </label>
                    <button type="submit" class="w-full px-4 py-2 bg-primario text-gray-700 font-semibold  rounded shadow-lg hover:shadow-none transition-all duration-300">
                        Cambiar CV
                    </button>
                </form>
            </div>
        </article>

        <!-- Tab titulaciones -->
        <article class="hidden lg:px-6 opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block" id="tabs-contact" role="tabpanel" aria-labelledby="tabs-contact-tab">
            <button class="inline-block rounded bg-secundario text-white px-6 py-2 text-sm font-medium uppercase text-black shadow-md transition duration-150 ease-in-out -2 focus:ring-blue-600 focus:ring-opacity-50" data-te-toggle="modal" data-te-target="#cicloActual" data-te-ripple-init data-te-ripple-color="light" id="botonCurso">Añadir Curso Actual</button>
            <div class="py-8 shadow-lg p-5 border-2 w-full lg:w-2/3  bg-white">
                <form class="mb-6 pb-3 relative" method="post" action="index.php?controller=EstudianteController&action=añadirTitulacion">

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between space-y-2 sm:space-y-0 space-x-0 sm:space-x-2 my-2">
                        <div class="w-full ">
                            <label class="block font-medium text-gray-700" for="nivel">
                                Nivel
                            </label>
                            <select class="form-select mt-1 block w-full p-3" id="nivelCiclo" name="nivel">
                                <option value="">Seleccione un Nivel</option>
                                <option value="Grado Básico">Grado Básico</option>
                                <option value="Grado Medio">Grado Medio</option>
                                <option value="Grado Superior">Grado Superior</option>
                            </select>
                        </div>
                        <div class="w-full ">
                            <label class="block font-medium text-gray-700" for="centro">
                                Centro Educativo
                            </label>
                            <select class="form-select mt-1 block w-full p-3" id="centroCiclo" name="centro">
                                <option value=''>Seleccione un centro</option>
                                <?php
                                foreach ($dataToView['centros'] as $centro) : ?>
                                    <option value="<?php echo $centro->getIdCentro() ?>"><?php echo $centro->getNombre() ?></option>
                                <?php
                                endforeach
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between space-y-2 sm:space-y-0 space-x-0 sm:space-x-2 my-2">


                        <div class="w-full ">
                            <label class="block font-medium text-gray-700" for="ciclo">
                                Ciclo Formativo
                            </label>
                            <select class="form-select mt-1 block w-full p-3" id="cicloCentro" name="ciclo">
                                <option value="">Seleccione un ciclo formativo</option>
                            </select>
                        </div>
                        <div class="w-full ">
                            <label class="block font-medium text-gray-700" for="anioCurso">
                                Año Obtención
                            </label>
                            <select class="form-select mt-1 block w-full p-3" id="anioCursoCiclo" name="anioCurso">
                                <option value="0" selected disabled>Selecciona un año</option>
                                <?php
                                $anioActual = date('Y');
                                for ($i = 2014; $i <= $anioActual; $i++) {
                                    echo "<option value='$i/" . ($i + 1) . "' >$i/" . ($i + 1) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" id="añadirTitulacion" class="mt-5 inline-block rounded bg-primario px-6 py-2 font-semibold  text-gray-700  shadow-md transition duration-150 ease-in-out -2 cursor-pointer">
                        Añadir Titulación
                    </button>
                </form>

            </div>
            <div class="shadow-lg p-2 border-2 w-full lg:w-1/3 relative lg:absolute right-0 top-0  bg-white">
                <h1 class="text-xl text-secundariotext-xl text-secundario text-center py-3">Mis titulaciones</h1>

                <ol class="misTitulaciones">
                    <?php if ($dataToView['misTitulaciones']) {
                    ?>
                        <?php foreach ($dataToView['misTitulaciones'] as $titulacion) : ?>
                            <?php
                            $nombreCiclo = $titulacion['nombreCiclo'];
                            $anioCurso = $titulacion['anio_curso'];
                            $verificado = $titulacion['verificado'];
                            $fechaVerificacion = $titulacion['fecha_verificacion'];
                            $nivel = $titulacion['nivel'];
                            ?>
                            <li class="flex items-center flex-row-reverse gap-2 my-2">
                                <span class="text-sm">
                                    <?php
                                    if ($nivel == 'Grado Medio') {
                                        echo "(GM)";
                                    } else {
                                        echo "(GS)";
                                    }
                                    ?>
                                    <?= $nombreCiclo . " (" . $anioCurso . ")" ?>
                                </span>
                                <?php if ($verificado === 0) : ?>
                                    <svg viewBox="0 0 20 20" class="w-5 h-5 text-red-600" title="No verificado">
                                        <path d="M4 4 L16 16 M4 16 L16 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                <?php else : ?>
                                    <svg viewBox="0 0 20 20" class="fill-current h-5 w-5 mr-2 text-green-700" title="Verificado">
                                        <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                    </svg>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    <?php
                    } else {
                    ?>
                        <p>No tienes ninguna titulación</p>
                    <?php
                    } ?>
                </ol>
                <?php if ($dataToView['cicloCursando']) : ?>
                    <h1 class="text-xl text-secundariotext-xl text-secundario text-center">Cursando</h1>
                    <span class="text-md lg:text-sm">
                        <?php
                        if ($dataToView['cicloCursando']['nivel'] == 'Grado Medio') {
                            echo "(GM)";
                        } else {
                            echo "(GS)";
                        }
                        ?>
                        <?= $dataToView['cicloCursando']['nombreCiclo'] ?>
                    </span>
                    <a href="index.php?controller=EstudianteController&action=añadirTitulacion&idCiclo=<?= $dataToView['cicloCursando']['idCiclo'] ?>" class="text-white text-green-700 underline rounded-md inline-block" title="Marcar Titulación completada">Completado</a>
                <?php endif ?>
            </div>
        </article>


</main>
<script>
    /* Girar tarjeta de perfil del estudiante y mostrar el formulario para actualizar perfil que se encuentra detrás. */
    $(document).ready(function() {
        $('.editar').click(function() {
            $('.tarjeta').toggleClass('girada');
        });

        $('.cancelar').click(function() {
            $('.tarjeta').toggleClass('girada');
        });

    });
</script>

<!-- Modal para añadir curso actual -->
<div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="cicloActual" tabindex="-1" aria-labelledby="cicloActualLabel" aria-hidden="true">
    <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-white-600">
            <div class="flex justify-end flex-shrink-0 rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="index.php?controller=EstudianteController&action=añadirCurso" class="flex flex-col gap-2 mt-2 items-center p-4" method="POST">
                <div class="w-full ">
                    <label class="block font-medium text-gray-700" for="nivel">
                        Nivel
                    </label>
                    <select class="form-select mt-1 block w-full p-3" id="nivelSeleccionado" name="nivel">
                        <option value="">Seleccione un Nivel</option>
                        <option value="Grado Básico">Grado Básico</option>
                        <option value="Grado Medio">Grado Medio</option>
                        <option value="Grado Superior">Grado Superior</option>
                    </select>
                </div>
                <div class="w-full ">
                    <label class="block font-medium text-gray-700" for="centro">
                        Centro Educativo
                    </label>
                    <select class="form-select mt-1 block w-full p-3" id="centro" name="centro">
                        <option value=''>Seleccione un centro</option>
                        <?php
                        foreach ($dataToView['centros'] as $centro) : ?>
                            <option value="<?php echo $centro->getIdCentro() ?>"><?php echo $centro->getNombre() ?></option>
                        <?php
                        endforeach
                        ?>
                    </select>
                </div>
                <div class="w-full ">
                    <label class="block font-medium text-gray-700" for="ciclo">
                        Ciclo Formativo
                    </label>
                    <select class="form-select mt-1 block w-full p-3" id="cicloSeleccionado" name="ciclo">
                        <option value="">Seleccione un ciclo formativo</option>
                    </select>
                </div>
                <button type="submit" id="añadirCurso" class="cursor-pointer w-50 m-auto px-4 py-2 mb-4 bg-primario text-gray-700  font-semibold rounded  shadow-lg hover:shadow-none transition-all duration-300 m-2">
                    Añadir Curso
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const btnAtras = document.getElementById("btnAtras");

    btnAtras.addEventListener("click", function() {
        window.scrollTo(0, 0);
    });
</script>