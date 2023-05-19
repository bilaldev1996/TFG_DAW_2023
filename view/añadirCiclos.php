<?php include('view/template/navbarCentro.php'); ?>

<?php if ($dataToView === 'ciclo-añadido') {
?>
    <div class="mb-4 rounded-lg bg-success-100 px-6 py-5 text-base text-success-700" role="alert">
        El ciclo se ha añadido correctamente
    </div>
<?php
} ?>

<main class="form-container w-full md:w-1/2 shadow-lg mainPanelMovil mt-0 lg:mt-16">
    <h2 class="text-2xl font-bold mb-4"><i class="fas fa-plus"></i> Nuevo Ciclo</h2>
    <form class="w-full max-w-xxl" action="index.php?controller=CentroController&action=añadirCiclo" method="POST">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
                    Nombre Ciclo
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white mb-3" id="nombre" name="nombre" type="text" placeholder="Nombre del ciclo" required>
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
                        <option value="Grado Básico">Grado Básico</option>
                        <option value="Grado Medio">Grado Medio</option>
                        <option value="Grado Superior">Grado Superior</option>
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
                        <option value="servicios socioculturales">Servicios
                            Socioculturales
                            y a la Comunidad</option>

                        <option value="electricidad y electrónica">Electricidad y
                            Electrónica </option>
                        <option value="hosterleria y turismo">Hostelería y Turismo</option>
                        <option value="hosterleria y turismo">Imagen Personal</option>
                        <option value="industrias alimentarias">Industrias Alimentarias</option>
                        <option value="transporte y mantenimiento de vehículos">Transporte y
                            Mantenimiento de
                            Vehículos</option>
                        <option value="Sanidad">Sanidad</option>
                        <option value="comunicación gráfica y audiovisual">Comunicación
                            Gráfica y
                            Audiovisual</option>
                        <option value="Agraria">Agraria</option>
                        <option value="imagen y sonido">Imagen y Sonido</option>
                        <option value="edificación y obra civil">Edificación y Obra Civil</option>
                        <option value="energía y agua">Energía y Agua</option>
                        <option value="instalación y mantenimiento">Instalación y Mantenimiento</option>
                        <option value="textil,confección y piel">Textil, Confección y Piel</option>
                        <option value="informática y comunicaciones">Informática y
                            Comunicaciones</option>
                        <option value="comercio y marketing">Comercio y
                            Marketing</option>
                        <option value="administración">Administración y
                            Gestión</option>
                        <option value="mantenimiento y servicios a la producción">Mantenimiento y
                            Servicios a la
                            Producción</option>
                        <option value="actividades físicas y deportivas">Actividades Físicas
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
        <div class="flex flex-wrap -mx-3 mb-2">
            <button type="submit" class="w-full px-4 py-2 bg-primario text-secundario font-semibold rounded  focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2">
                Añadir Ciclo
            </button>
        </div>
    </form>


</main>