<?php include('template/navbar.php'); ?>



<main class="login-container flex shadow-lg">
    <form action="index.php?controller=EmpresaController&action=logearEmpresa" method="post">
        <h2><i class="fas fa-building"></i> Acceso Empresa</h2>
        <div class="w-full">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                Email
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" name="email" placeholder="tuempresa@gmail.com" required>
            <p class="text-red-500 text-xs italic mb-3 hidden"></p>
        </div>
        <div class="w-full">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                Contraseña
            </label>
            <div class="relative">
                <input id="password" required type="password" name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="password" type="password" name="password" placeholder="******************">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg class="h-6 w-6 text-gray-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" onclick="togglePassword()">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M10 3C5.5 3 1.9 5.7 0 10c1.9 4.3 5.5 7 10 7s8.1-2.7 10-7c-1.9-4.3-5.5-7-10-7zm0 12a6 6 0 110-12 6 6 0 010 12z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <?php

        if (isset($_SESSION['verificado'])) {
            unset($_SESSION['verificado']);
        ?>
            <p class="text-red-500 text-xs italic mb-3">Esta cuenta todavía no está verificada</p>

        <?php
        } else if ($dataToView === false) {
        ?>
            <p class="text-red-500 text-xs italic mb-3">Email o contraseña incorrectos</p>

        <?php
        }
        ?>

        <div class="flex flex-wrap items-center">
            <button type="submit" class="bg-primario w-full md:w-1/2  inline-block rounded bg-primario px-6 py-2 text-sm font-medium uppercase text-gray-700  shadow-md transition duration-150 ease-in-out">Iniciar sesión</button>
            <a href="#" class="olvido text-secundario w-full md:w-1/2 px-3 mb-6 md:mb-0 hover:underline" data-te-toggle="modal" data-te-target="#exampleModal" data-te-ripple-init data-te-ripple-color="light">¿Has olvidado tu contraseña?</a>
        </div>
        <p class="not-account">¿Todavía no tienes una cuenta?<a href="index.php?controller=EmpresaController&action=registrarEmpresa" class="text-secundario hover:underline">Crear cuenta</a></p>
    </form>
</main>

<!-- modal para enviar email recuperacion -->

<div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-white-600">
            <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                <h5 class="text-xl font-medium text-neutral-800 dark:text-black-200" id="exampleModalLabel">
                    Recuperar Contraseña
                </h5>
                <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="index.php?controller=EmpresaController&action=enviarEmail" class="relative flex-auto p-4" data-te-modal-body-ref method="post" id="formEnvioEmail">
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-bold text-gray-700 dark:text-black-300">Email</label>
                    <input type="email" name="email" id="emailRestablecer" class="w-full px-3 py-2 placeholder-gray-500 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Ingresa tu correo electrónico" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="inline-block rounded bg-gray-200 px-6 py-2 mr-2 text-sm font-medium uppercase text-gray-700 transition duration-150 ease-in-out hover:bg-gray-300 focus:bg-gray-300" data-te-modal-dismiss>
                        Cancelar
                    </button>
                    <button type="submit" class="inline-block rounded bg-primario px-6 py-2 text-sm font-medium uppercase text-gray-700 shadow-md transition duration-150 ease-in-out ">
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

<?php
if ($dataToView === 'email no-existe') {
?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No existe ninguna empresa con ese email!',
            timer: 2000,
            showConfirmButton: false,
        });
    </script>
<?php
}
?>