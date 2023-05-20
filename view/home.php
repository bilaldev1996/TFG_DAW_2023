<?php include('template/navbar.php'); ?>

<main class="home px-40 lg:mt-10">
    <section class="container-section">
        <div class="section-info ">
            <h1>¿Estás buscando trabajo o un lugar para hacer tus prácticas?</h1>
            <p>En <span>JobsNow</span> podrás encontrar ofertas de trabajo en diferentes áreas y empresas que buscan candidatos que hayan completado un ciclo de grado medio o superior. Además, si estás buscando un lugar para realizar tus prácticas, también podemos ayudarte a encontrar la empresa adecuada para ti. Regístrate ahora y comienza a buscar tu primer empleo o prácticas.</p>
            <a href="index.php?controller=EstudianteController&action=registrarEstudiante" class="btn mt-4 text-secundario font-bold rounded">Regístrate ahora</a>
        </div>
        <img src="assets/images/contratando.jpg" alt="Imagen de empleados trabajando" class="img-fluid rounded-md">
    </section>
    <section class="features-section grid grid-cols-1  lg:grid-cols-3 gap-3">
        <article class="feature border rounded-md shadow-md p-4">
            <div class="icon">
                <i class="fas fa-search"></i>
            </div>
            <h3>Encuentra ofertas de trabajo para tu formación</h3>
            <p>Busca ofertas de trabajo en diferentes áreas y encuentra la que mejor se adapte a tu formación y habilidades.</p>
        </article>
        <article class="feature border rounded-md shadow-md p-4">
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <h3>Completa tu perfil académico y profesional</h3>
            <p>Completa tu perfil con información sobre tu formación académica y habilidades profesionales para destacar en tu búsqueda de empleo.</p>
        </article>
        <article class="feature border rounded-md shadow-md p-4">
            <div class="icon">
                <i class="fas fa-handshake"></i>
            </div>
            <h3>Contacta con empresas</h3>
            <p>Contacta directamente con empresas y presenta tu candidatura para los trabajos que te interesen.</p>
        </article>
    </section>
    <section class="container-section mt-0">
        <img src="assets/images/talento.png" alt="Imagen skills" class="img-fluid rounded-md w-full">
        <div class="section-info">
            <h1>¿Buscas talento?</h1>
            <p><span>JobsNow</span> te permite publicar ofertas de trabajo y buscar talentos en diferentes áreas. Encuentra el candidato ideal para tu empresa.</p>
            <a href="index.php?controller=EmpresaController&action=accesoEmpresa" class="btn text-secundario font-bold rounded">Publica una oferta de trabajo</a>
        </div>
    </section>
    <section class="features-section grid grid-cols-1  lg:grid-cols-3 gap-3">
        <article class="feature border rounded-md shadow-md p-4">
            <div class="icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <h3>Publica ofertas de trabajo</h3>
            <p>Publica ofertas de trabajo en nuestra plataforma para llegar a una audiencia de candidatos potenciales.</p>
        </article>
        <article class="feature border rounded-md shadow-md p-4">
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <h3>Encuentra candidatos ideales</h3>
            <p>Busca entre nuestros candidatos potenciales para encontrar a la persona perfecta para tu empresa.</p>
        </article>
        <article class="feature border rounded-md shadow-md p-4">
            <div class="icon">
                <i class="fas fa-handshake"></i>
            </div>
            <h3>Contacta con candidatos</h3>
            <p>Contacta directamente con los candidatos que te interesen para llevar a cabo entrevistas o pruebas.</p>
        </article>
    </section>
    <section class="container-section mb-10 mt-0">
        <div class="section-info">
            <h1>Fortalece tu conexión con los alumnos</h1>
            <p>Potencia tu centro educativo con <span>JobsNow</span>. Valida titulaciones de alumnos y amplía la oferta formativa. ¡Regístrate y gestiona tus ciclos formativos hoy mismo!</p>
            <a href="index.php?controller=CentroController&action=accesoCentro" class="btn text-secundario font-bold rounded">Empieza ahora</a>
        </div>
        <img src="assets/images/centroEducativo.jpg" alt="Imagen de centro educativo" class="img-fluid rounded-md w-full">
    </section>
    <!-- Back to top button -->
    <button type="button" id="volver-arriba" class="fixed bottom-5 right-5 inline-block rounded-full bg-primario p-2 uppercase text-white transition duration-150 ease-in-out">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke-width="2.5" stroke="currentColor" class="h-4 w-4">
            <path fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75" clip-rule="evenodd" />
        </svg>
    </button>


</main>

<script>
    // Get the button let
    mybutton = document.getElementById('volver-arriba');
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20) {
            mybutton.style.display =
                'block';
        } else {
            mybutton.style.display = 'none';
        }
    } // When the user
    mybutton.addEventListener('click', backToTop);

    function backToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>