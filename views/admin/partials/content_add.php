<!-- Add Book Form -->
<div id="content-add" class="content-section hidden">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Añadir Nuevo Libro</h2>

        <form id="add-book-form" class="space-y-4" method="POST" action="/Bookmaster/controllers/add_book.php">
            <div>
                <label for="isbn" class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                <input type="text" id="isbn" name="isbn" maxlength="13" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                <input type="text" id="titulo" name="titulo" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="autor" class="block text-sm font-medium text-gray-700 mb-1">Autor</label>
                <input type="text" id="autor" name="autor" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="editorial" class="block text-sm font-medium text-gray-700 mb-1">Editorial</label>
                <input type="text" id="editorial" name="editorial" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="anio_publicacion" class="block text-sm font-medium text-gray-700 mb-1">Año de Publicación</label>
                <input type="number" id="anio_publicacion" name="anio_publicacion" min="1900" max="<?php echo date('Y'); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                <select id="categoria_id" name="categoria_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Seleccionar categoría</option>
                    <?php
                    // Cargar categorías desde la base de datos
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/Bookmaster/models/contacto.php');
                    $contactoModel = new Contacto();
                    $categorias = $contactoModel->obtener_categorias();
                    
                    if ($categorias && $categorias->num_rows > 0) {
                        while ($categoria = $categorias->fetch_assoc()) {
                            echo "<option value=\"{$categoria['id']}\">{$categoria['nombre']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="numero_paginas" class="block text-sm font-medium text-gray-700 mb-1">Número de Páginas</label>
                <input type="number" id="numero_paginas" name="numero_paginas" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="cantidad_ejemplares" class="block text-sm font-medium text-gray-700 mb-1">Cantidad de Ejemplares</label>
                <input type="number" id="cantidad_ejemplares" name="cantidad_ejemplares" min="1" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="flex justify-end">
                <button type="submit" name="guardar_libro" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>