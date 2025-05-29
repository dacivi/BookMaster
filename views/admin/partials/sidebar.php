<div class="w-1/6 bg-white shadow-lg p-4">
    <div class="flex items-center mb-8">
        <div class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-white mr-3">
            <i class="fas fa-user"></i>
        </div>
        <span class="font-semibold"><?= isset($_SESSION['nombre']) ? $_SESSION['nombre'] : (isset($_SESSION['user']['nombre']) ? $_SESSION['user']['nombre'] : 'Usuario') ?></span>
        <div class="ml-3 font-bold">BookMaster</div>
    </div>
    
    <div class="space-y-4">
        <div id="menu-add" class="flex items-center text-gray-600 py-2 hover:bg-gray-100 rounded-lg px-2 cursor-pointer">
            <i class="fas fa-plus mr-3"></i>
            <span>Añadir</span>
        </div>
        <div id="menu-books" class="flex items-center text-gray-600 py-2 bg-gray-100 rounded-lg px-2 cursor-pointer">
            <i class="fas fa-book mr-3"></i>
            <span>Libros</span>
        </div>
        <div id="menu-catalogs" class="flex items-center text-gray-600 py-2 hover:bg-gray-100 rounded-lg px-2 cursor-pointer">
            <i class="fas fa-list mr-3"></i>
            <span>Catálogos</span>
        </div>
    </div>
    
    <div class="absolute bottom-8 left-4 space-y-4">
        <div id="menu-logout" class="flex items-center text-gray-600 py-2 hover:bg-gray-100 rounded-lg px-2 cursor-pointer">
            <a href="/Bookmaster/views/login/logout.php" class="flex items-center">
                <i class="fas fa-sign-out-alt mr-3"></i>
                <span>Log out</span>
            </a>
        </div>
    </div>
</div>
