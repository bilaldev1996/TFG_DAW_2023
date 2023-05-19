<header class="flex justify-between bg-secundario items-center px-40 navbarContainer">
    <div class="header-movil">
        <a href="index.php" class="flex items-center">
            <img src="assets/images/logo.png" class="h-10" alt="logo">
            <span class="ml-2 text-xl font-semibold text-secundario">JobsNow</span>
        </a>
        <div class="boton-hamburguesa">
            <span class=""></span>
            <span class=""></span>
            <span class=""></span>
        </div>
    </div>
    <nav class="flex navbar navbarCentro pt-28 md:pt-0">
        <ul class="flex">
            <li>
                <a href="index.php?controller=CentroController&action=panelCentro" class="hover:bg-white <?php echo (strpos($_SERVER['REQUEST_URI'], 'panelCentro') !== false || strpos($_SERVER['REQUEST_URI'], 'accesoCentro') !== false || strpos($_SERVER['REQUEST_URI'], 'actualizarPerfil') !== false || strpos($_SERVER['REQUEST_URI'], 'logearCentro') !== false) ? 'bg-white text-terciario' : ''; ?>">Mi Perfil</a>
            </li>
            <li>
                <a href="index.php?controller=CentroController&action=validarTitulaciones" class="hover:bg-white <?php echo strpos($_SERVER['REQUEST_URI'], 'validar') !== false ? 'bg-white text-terciario' : ''; ?>">Validar Titulaciones</a>
            </li>
            <li>
                <a href="index.php?controller=CentroController&action=misCiclos" class="hover:bg-white <?php echo strpos($_SERVER['REQUEST_URI'], 'misCiclos') !== false ? 'bg-white text-terciario' : ''; ?>">Mis Ciclos</a>
            </li>
            <a href="index.php?controller=CentroController&action=logout" class="flex items-center justify-center bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 self-center md:self-auto mt-5 md:mt-0">
                <span>Cerrar Sesión</span>
                <i class="fas fa-sign-out-alt ml-2"></i>
            </a>
        </ul>

    </nav>
</header>

<script>
    /* boton menu hamburguesa */

    $('.boton-hamburguesa').on('click', function() {
        $(this).toggleClass('icono_cruz');
        $('.navbar').toggleClass('menu_visible');
        $('nav').removeClass('menu_oculto');
        $('body').toggleClass('overflow');
        $('main').toggleClass('opacidad');
    });

    /* al hacer click en algún enlace */
    $('nav').on('click', function() {
        $(this).addClass('menu_oculto');
        $('.navbar').removeClass('menu_visible');
        $('.boton-hamburguesa').removeClass('icono_cruz');
    });

    $(document).mouseup(function(event) {
        let nav = $('nav');
        let botonHamburguesa = $('.boton-hamburguesa');
        // Si se hace clic fuera del nav y el menú está visible
        if (!nav.is(event.target) && nav.has(event.target).length === 0 && !botonHamburguesa.is(event.target) && botonHamburguesa.has(event.target).length === 0 && $('.navbar').hasClass('menu_visible')) {
            nav.addClass('menu_oculto');
            $('.navbar').removeClass('menu_visible');
            botonHamburguesa.removeClass('icono_cruz');
            $('body').toggleClass('overflow');
            $('main').toggleClass('opacidad');
            $('body').removeClass('oscuro'); // Remueve la clase 'oscuro' del body
        }
    });
</script>