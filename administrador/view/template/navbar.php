<!-- Navegacion -->
<nav class="flex flex-col flex-shrink-0 w-full lg:w-64 bg-white shadow">
    <div class="flex items-center justify-center h-20 bg-gray-200 border-b">
        <a href="index.php" class="flex items-center">
            <img src="../assets/images/logo.png" alt="logo" class="w-14 h-14">
            <span class="ml-2 text-xl font-semibold text-secundario">JobsNow</span>
        </a>
    </div>
    <div class="flex flex-col flex-1 bg-white p-4 overflow-y-auto">
        <a href="index.php?action=gestionarEstudiantes" class="px-4 py-2 mb-2 text-center text-xl lg:text-left lg:text-sm font-semibold  hover:bg-blue-500 hover:text-white text-gray-700 <?php echo strpos($_SERVER['REQUEST_URI'], 'Estudiante') !== false ? 'bg-blue-500 text-white' : 'bg-gray-200 '; ?> rounded-lg"><i class="fas fa-user-graduate mr-2"></i>Estudiantes</a>

        <a href="index.php?action=gestionarEmpresas" class="px-4 py-2 mb-2  text-center text-xl lg:text-left lg:text-sm font-semibold  hover:bg-blue-500 hover:text-white text-gray-700 bg-gray-200 rounded-md <?php echo strpos($_SERVER['REQUEST_URI'], 'Empresa') !== false ? 'bg-blue-500 text-white' : 'bg-gray-200 '; ?>"><i class="fas fa-building mr-2"></i>Empresas</a>

        <a href="index.php?action=gestionarCentros" class="px-4 py-2 mb-2 text-center text-xl lg:text-left lg:text-sm font-semibold  hover:bg-blue-500 hover:text-white text-gray-700 bg-gray-200 rounded-md <?php echo strpos($_SERVER['REQUEST_URI'], 'Centro') !== false ? 'bg-blue-500 text-white' : 'bg-gray-200 '; ?>"><i class="fas fa-school mr-2"></i>Centros Educativos</a>

        <a href="index.php?action=gestionarOfertas" class="px-4 py-2 mb-2 text-center text-xl lg:text-left lg:text-sm font-semibold  hover:bg-blue-500 hover:text-white text-gray-700 bg-gray-200 rounded-md <?php echo strpos($_SERVER['REQUEST_URI'], 'Oferta') !== false ? 'bg-blue-500 text-white' : 'bg-gray-200 '; ?>"><i class="fas fa-briefcase mr-2"></i>Ofertas de Trabajo</a>



        <div class="mt-auto flex flex-col">
            <a href="/index.php" class="px-4 py-2 mb-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-md w-44">Visitar Aplicación <i class="fas fa-globe"></i>
            </a>
            <a href="index.php?action=logout" class="px-4 py-2 mb-2 text-sm font-semibold text-white-700 bg-red-400 rounded-md hover:bg-red-600 hover:text-white w-44">
                Cerrar Sesión
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1" stroke="currentColor" class="w-5 h-5 inline-block ml-1">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                </svg>
            </a>
        </div>
    </div>
</nav>

<?php
/* Este código verifica si el usuario ha iniciado sesión como administrador. Si el usuario no ha
iniciado sesión o no es administrador, lo redirigirá a la página de inicio de sesión de la sección
de administración del sitio web. */
if (!isset($_SESSION['admin']) || $_SESSION['admin'] === false) {
    header('Location: /tfg_daw/administrador');
    exit();
}
?>