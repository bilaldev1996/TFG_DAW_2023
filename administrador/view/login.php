<div class="flex flex-col items-center justify-center h-screen">

    <div class="w-full max-w-md ">
        <img src="../assets/images/logo.png" class="h-24 mx-auto mb-5" alt="logo">

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="text-2xl text-gray-800 mb-6 text-center font-bold">Iniciar Sesión</h1>
            <form action="index.php?action=logearAdmin" method="post">
                <div class="mb-4">
                    <!-- Campo de correo electrónico -->
                    <label for="email" class="block font-bold text-sm text-gray-700 mb-2">Email</label>
                    <input id="email" required type="email" name="email" placeholder="Ingresa tu correo electrónico" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-1">
                    <!-- Campo de contraseña -->
                    <label for="password" class="block font-bold text-sm text-gray-700 mb-2 mt-4">Contraseña</label>
                    <div class="relative">
                        <input id="password" required type="password" name="password" placeholder="Ingresa tu contraseña" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-6 w-6 text-gray-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" onclick="togglePassword()">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M10 3C5.5 3 1.9 5.7 0 10c1.9 4.3 5.5 7 10 7s8.1-2.7 10-7c-1.9-4.3-5.5-7-10-7zm0 12a6 6 0 110-12 6 6 0 010 12z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
                <?php
                if ($dataToView === false) {
                ?>
                    <p class="text-red-600 mb-2">Email o contraseña incorrectos.</p>
                <?php
                }
                ?>
                <div class="flex flex-wrap items-center justify-between mt-3">
                    <button class="bg-amber-200 hover:bg-amber-300 text-gray-700 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="iniciar">
                        Iniciar Sesión
                    </button>
                    <a href="#" class="olvido inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" id="olvido-contraseña" data-te-toggle="modal" data-te-target="#exampleModal" data-te-ripple-init data-te-ripple-color="light">
                        ¿Has olvidado la contraseña?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- modal para enviar email recuperacion -->

<div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-white-600">
            <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-black-200" id="exampleModalLabel">
                    Recuperar Contraseña
                </h5>
                <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="index.php?action=enviarEmail" class="relative flex-auto p-4" data-te-modal-body-ref method="post" id="formEnvioEmail">
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-bold text-gray-700 dark:text-black-300">Email</label>
                    <input type="email" name="email" id="emailRestablecer" class="w-full px-3 py-2 placeholder-gray-500 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Ingresa tu correo electrónico" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="inline-block rounded bg-gray-200 px-6 py-2 mr-2 text-sm font-medium uppercase leading-normal text-gray-700 transition duration-150 ease-in-out hover:bg-gray-300 focus:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50" data-te-modal-dismiss>
                        Cancelar
                    </button>
                    <button type="submit" class="inline-block rounded bg-blue-500 px-6 py-2 text-sm font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-600 focus:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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

<?php
if ($dataToView === 'contraseña cambiada') {
?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Contraseña cambiada',
            text: 'Contraseña modificada exitosamente. ¡Ya puedes iniciar sesión!!',
            timer: 2000,
            showConfirmButton: false,
        });
    </script>
<?php
}
?>