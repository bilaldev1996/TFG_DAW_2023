<?php include('template/navbar.php'); ?>


<main class="form-container shadow-lg px-4">
    <form class="w-full max-w-xxl" action="index.php?controller=EmpresaController&action=altaEmpresa" method="POST" enctype="multipart/form-data" id="formRegistroEmpresa">
        <h2 class="text-2xl font-bold mb-7 mt-4"><i class="fas fa-user-plus"></i> Registro Empresa</h2>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
                    Nombre Empresa <span class="text-red">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 focus:outline-none focus:bg-white mb-1" id="nombre" name="nombre" type="text" placeholder="Empresa S.L.">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="direccion">
                    Dirección Empresa <span class="text-red">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-1 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="direccion" name="direccion" type="text" placeholder="Dirección de la empresa">
                <p class="text-red-500 text-xs italic hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sitioWeb">
                    Sitio Web <span class="text-red">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-1 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="sitioWeb" name="sitioWeb" type="text" placeholder="empresasl.es">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cif">
                    CIF <span class="text-red">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-1 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="cif" type="text" name="cif" placeholder="P24416098">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                    Email <span class="text-red">*</span>
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-1 px-4 focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" name="email" placeholder="nombreempresa@gmail.com">
                <p class="text-red-500 text-xs italic mb-3 hidden"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                    Contraseña <span class="text-red">*</span>
                </label>
                <div class="relative">
                    <input id="password" type="password" name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 focus:outline-none focus:bg-white focus:border-gray-500" id="password" type="password" name="password" placeholder="******************">
                    <p class="text-red-500 text-xs italic mb-3 hidden relative"></p>
                    <div class="absolute  right-0 pr-3 flex top-4">
                        <svg class="h-6 w-6 text-gray-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" onclick="togglePassword()">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M10 3C5.5 3 1.9 5.7 0 10c1.9 4.3 5.5 7 10 7s8.1-2.7 10-7c-1.9-4.3-5.5-7-10-7zm0 12a6 6 0 110-12 6 6 0 010 12z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/2">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 " for="descripcion">
                        Descripción <span class="text-red">*</span>
                    </label>
                    <div class="relative">
                        <textarea id="descripcion" placeholder="¿A qué se dedica la empresa?" name="descripcion" rows="5" cols="34" class="bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 focus:outline-none focus:bg-white focus:border-gray-500 w-full"></textarea>
                        <p class="text-red-500 text-xs italic mb-3 hidden relative"></p>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="imagen" class="block text-gray-700 text-xs font-bold mb-2">LOGO EMPRESA <span class="text-red">*</span></label>
                <div class="flex flex-col items-center justify-center bg-grey-lighter">
                    <label class="w-40 text-center flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>

                        <span class="mt-2 text-base leading-normal">Adjunta un logo</span>
                        <input type='file' class="hidden" name="imagen" accept="image/*" id="logo" />
                        <p class="text-red-500 text-xs italic mb-3 hidden"></p>
                    </label>
                    <span class="ml-2" id="file-chosen1"></span>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <button type="submit" class="w-full px-4 py-2 bg-primario text-gray-700 font-semibold rounded  focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2">
                Registrarse
            </button>
            <p class="w-full text-sm text-center text-gray-600 ml-">¿Ya tienes una cuenta? <a href="index.php?controller=EmpresaController&action=accesoEmpresa" class="text-secundario hover:underline">Inicia Sesión</a></p>
        </div>
    </form>


</main>

<?php
if ($dataToView === 'email existe') {
?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Ya existe una empresa con este email!',
            timer: 2000,
            showConfirmButton: false,
        });
    </script>
<?php
}
?>

<?php
if ($dataToView === 'registrado') {
?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Registrado',
            text: 'La empresa se ha registrado correctamente, recibirás un email cuando su cuenta sea validada',
            showConfirmButton: true,
        })
    </script>
<?php
}
?>

<?php
if ($dataToView === 'enviado') {
?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Enviado',
            text: 'El correo ha sido enviado correctamente!',
            timer: 2000,
            showConfirmButton: false,
        });
    </script>
<?php
}
?>