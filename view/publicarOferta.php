<?php include('view/template/navbarEmpresa.php'); ?>


<main class="form-container mt-5">
    <a href="#" onclick="history.go(-1); return false;" class="text-secundario absolute left-5 lg:left-40" id="volverAtras">
        <i class="fas fa-arrow-circle-left"></i> Volver
    </a>
    <form class="w-full max-w-xxl shadow-lg  p-3 overflow-hidden" action="index.php?controller=EmpresaController&action=publicarOfertaEmpleo" method="POST" id="formPublicarOferta">
        <h2 class="text-2xl font-bold mb-7 mt-4"><i class="fas fa-plus"></i> Publicar Oferta Empleo</h2>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-1/2 px-3 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
                    Nombre Empresa
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white mb-1" id="nombre" name="nombre" type="text" value="<?= $dataToView['nombre'] ?>" readonly>
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="titulo">
                    Título
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="titulo" name="titulo" type="text" placeholder="Desarrollador Web Junior">
                <p class="text-red-500 text-xs italic hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fechaPublicacion">
                    Fecha Publicación
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="fechaPublicacion" name="fechaPublicacion" type="date" min="<?php echo date('Y-m-d'); ?>">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fechaVencimiento">
                    Fecha Vencimiento
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="fechaVencimiento" type="date" name="fechaVencimiento" min="<?php echo date('Y-m-d'); ?>">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="salario">
                    Salario
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="salario" type="number" name="salario" placeholder="Salario">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="numVacantes">
                    Número Vacantes
                </label>
                <input id="numVacantes" type="number" min="1" name="numVacantes" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <p class="text-red-500 text-xs italic mb-3 hidden absolute"></p>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/2">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 " for="descripcion">
                        Descripción
                    </label>
                    <div class="relative">
                        <textarea id="descripcion" placeholder="¿De qué trata la oferta?" name="descripcion" rows="5" cols="35" class="bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 w-full"></textarea>
                        <p class="text-red-500 text-xs italic mb-3 hidden absolute"></p>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 " for="requisitos">
                        Requisitos
                    </label>
                    <div class="relative">
                        <textarea id="requisitos" placeholder="Requisitos de la oferta" name="requisitos" rows="5" cols="35" class="bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 w-full"></textarea>
                        <p class="text-red-500 text-xs italic mb-3 hidden absolute"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <button type="submit" class="w-full px-4 py-2 bg-primario text-black font-semibold rounded focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2">
                Publicar
            </button>
        </div>
    </form>


</main>