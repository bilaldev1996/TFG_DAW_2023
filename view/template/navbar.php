<header class="lg:fixed lg:w-full z-10">
    <div class="header-movil m-5 flex justify-between items-center mb-0 lg:m-0">
        <a href="index.php" class="flex items-center lg:hidden mt-2">
            <img src="assets/images/logo.png" class="h-10" alt="logo">
            <span class="ml-2 text-xl font-semibold text-secundario">JobsNow</span>
        </a>

        <div class="contenedor_barras">
            <span class=""></span>
            <span class=""></span>
            <span class=""></span>
        </div>
    </div>
    <nav class="navbar pt-20 md:pt-0">
        <a href="index.php" class="hidden lg:flex items-center">
            <img src="assets/images/logo.png" class="h-10" alt="logo">
            <span class="ml-2 text-xl font-semibold text-white">JobsNow</span>
        </a>
        <ul>
            <li><a href="index.php?controller=EstudianteController&action=accesoEstudiante" class="hover:bg-white <?php echo strpos($_SERVER['REQUEST_URI'], 'accesoEstudiante') !== false ? 'bg-white text-terciario' : ''; ?>">Estudiantes</a></li>
            <li><a href="index.php?controller=EmpresaController&action=accesoEmpresa" class="hover:bg-white <?php echo strpos($_SERVER['REQUEST_URI'], 'accesoEmpresa') !== false ? 'bg-white text-terciario' : ''; ?>">Empresas</a></li>
            <li><a href="index.php?controller=CentroController&action=accesoCentro" class="hover:bg-white <?php echo strpos($_SERVER['REQUEST_URI'], 'accesoCentro') !== false ? 'bg-white text-terciario' : ''; ?>">Centros</a></li>
        </ul>
    </nav>
</header>


<script>
    $('.contenedor_barras').on('click', function() {
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
        $('.contenedor_barras').removeClass('icono_cruz');
        $('body').toggleClass('overflow');
        $('main').toggleClass('opacidad');
    });

    $(document).mouseup(function(event) {
        let nav = $('nav');
        let contenedorBarras = $('.contenedor_barras');
        // Si se hace clic fuera del nav y el menú está visible
        if (!nav.is(event.target) && nav.has(event.target).length === 0 && !contenedorBarras.is(event.target) && contenedorBarras.has(event.target).length === 0 && $('.navbar').hasClass('menu_visible')) {
            nav.addClass('menu_oculto');
            $('.navbar').removeClass('menu_visible');
            contenedorBarras.removeClass('icono_cruz');
            $('body').toggleClass('overflow');
            $('main').toggleClass('opacidad');
            $('body').removeClass('oscuro'); // Remueve la clase 'oscuro' del body
        }
    });
</script>