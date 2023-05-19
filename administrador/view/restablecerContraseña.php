<div class="max-w-md mx-auto my-10 bg-white p-5 rounded-md shadow-sm">
    <h1 class="text-2xl font-semibold mb-5">Restablecer contraseña</h1>
    <form method="POST" action="index.php?action=cambiarContraseña" id="formRestablecer">

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Nueva Contraseña</label>
            <div class="relative">
                <input id="password" required type="password" name="password" id="password" placeholder="Ingresa tu nueva contraseña" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg class="h-6 w-6 text-gray-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" onclick="togglePassword()">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M10 3C5.5 3 1.9 5.7 0 10c1.9 4.3 5.5 7 10 7s8.1-2.7 10-7c-1.9-4.3-5.5-7-10-7zm0 12a6 6 0 110-12 6 6 0 010 12z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label for="password-confirm" class="block text-gray-700 font-semibold mb-2">Confirmar contraseña</label>
            <div class="relative">
                <input required type="password" name="password-confirm" id="password-confirm" placeholder="Confirma tu contraseña" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg class="h-6 w-6 text-gray-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" onclick="togglePasswordConfirm()">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M10 3C5.5 3 1.9 5.7 0 10c1.9 4.3 5.5 7 10 7s8.1-2.7 10-7c-1.9-4.3-5.5-7-10-7zm0 12a6 6 0 110-12 6 6 0 010 12z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Restablecer contraseña</button>
        </div>
    </form>
</div>