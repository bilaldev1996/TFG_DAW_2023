<header class="flex justify-between bg-secundario items-center px-40 navbarContainer ">
    <a href="index.php" class="flex header-movil items-center">
        <img src="assets/images/logo.png" class="h-10" alt="logo">
        <span class="ml-2 text-xl font-semibold">JobsNow</span>
    </a>
    <nav>
        <ul class="flex px-2  enlacesNavegacion">
            <li><a href="index.php?controller=EstudianteController&action=panelEstudiante" class="hover:bg-white <?php echo (strpos($_SERVER['REQUEST_URI'], 'panelEstudiante') !== false || strpos($_SERVER['REQUEST_URI'], 'accesoEstudiante') !== false || strpos($_SERVER['REQUEST_URI'], 'actualizarPerfil') !== false || strpos($_SERVER['REQUEST_URI'], 'logearEstudiante') !== false) ? 'bg-white text-terciario' : ''; ?>">Mi Perfil</a></li>

            <li><a href="index.php?controller=OfertaController&action=verOfertas" class="hover:bg-white <?php echo strpos($_SERVER['REQUEST_URI'], 'verOferta') !== false ? 'bg-white text-terciario' : ''; ?>">Ofertas</a></li>
            <li><a href="index.php?controller=EstudianteController&action=misOfertas" class="hover:bg-white <?php echo strpos($_SERVER['REQUEST_URI'], 'misOfertas') !== false ? 'bg-white text-terciario' : ''; ?>">Mis Ofertas</a></li>
        </ul>
    </nav>
    <div class="relative flex items-center">
        <div class="relative" data-te-dropdown-ref>
            <a class="hidden-arrow flex items-center whitespace-nowrap transition duration-150 ease-in-out motion-reduce:transition-none" href="#" id="dropdownMenuButton2" role="button" data-te-dropdown-toggle-ref aria-expanded="false">
                <img src="assets/images/Estudiante/<?php
                                                    echo isset($dataToView['imagen']) ?  $dataToView['imagen'] : $dataToView['estudiante']['imagen'];

                                                    ?>" class="rounded-full img-perfil w-10 h-10" alt="imagen perfil" loading="lazy" />
                <i class="fa fa-angle-down ml-2"></i>
            </a>
            <ul class="absolute left-auto right-0 z-[1000] float-left m-0 mt-1 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block" aria-labelledby="dropdownMenuButton2" data-te-dropdown-menu-ref>

                <li>
                    <a href="#" class="block w-full whitespace-nowrap bg-transparent py-2 px-4 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30" data-te-toggle="modal" data-te-target="#exampleModal" data-te-ripple-init data-te-ripple-color="light">Cambiar Imagen</a>
                </li>
                <li>
                    <a href="#" class="block w-full whitespace-nowrap bg-transparent py-2 px-4 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30" onclick="darseBaja()">Darse Baja</a>
                </li>
                <li>
                    <a class="block w-full whitespace-nowrap bg-transparent py-2 px-4 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30" href="index.php?controller=EstudianteController&action=logout" data-te-dropdown-item-ref>Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- Modal para cambiar imagen -->
<div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-white-600">
            <div class="flex justify-end flex-shrink-0 rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="index.php?controller=EstudianteController&action=cambiarImagen" class="flex flex-col gap-2 mt-2 items-center" method="POST" enctype="multipart/form-data" id="formularioImagen">
                <img class="w-40 h-40 rounded-full m-auto" src="assets/images/Estudiante/<?php echo $dataToView['estudiante']['imagen'] ?>" alt="imagen perfil">
                <label class="w-40 text-center flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>

                    <span class="mt-2 text-base leading-normal">Adjunta una Imagen</span>
                    <input type='file' class="hidden" name="imagen" accept="image/*" id="imagen" />
                    <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                </label>
                <span class="ml-2" id="file-chosen1"></span>
                <button type="submit" class="w-50 m-auto px-4 py-2 mb-4 bg-primario text-secundario font-semibold rounded  focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2">
                    Cambiar imagen
                </button>
            </form>
        </div>
    </div>
</div>


<!-- nav movil -->
<nav class="navbarMovil">
    <ul>
        <li><a href="index.php?controller=EstudianteController&action=panelEstudiante" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'panelEstudiante') !== false ? 'bg-white text-terciario' : 'bg-secundario'; ?>"><i class="fas fa-user"></i> Mi perfil</a></li>
        <li><a href="index.php?controller=OfertaController&action=verOfertas" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'verOfertas') !== false ? 'bg-white text-terciario' : 'bg-secundario'; ?>"><i class="fas fa-briefcase"></i> Ofertas</a></li>
        <li><a href="index.php?controller=EstudianteController&action=misOfertas" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'misOfertas') !== false ? 'bg-white text-terciario' : 'bg-secundario'; ?>"><i class="fas fa-file-alt"></i> Mis Ofertas</a></li>

    </ul>
</nav>