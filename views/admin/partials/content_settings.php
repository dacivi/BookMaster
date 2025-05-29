<!-- Settings Content -->
<div id="content-settings" class="content-section hidden">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Configuración</h2>
        <form action="#" method="post" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Nombre de usuario</label>
                <input type="text" id="username" name="username" value="<?= isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input type="email" id="email" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña actual</label>
                <input type="password" id="current_password" name="current_password" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Nueva contraseña</label>
                <input type="password" id="new_password" name="new_password" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>
</div>
