<!-- Book Categories Content - Default View -->
<div id="content-books" class="content-section">
    <!-- Book Listing Grid -->
    <div class="grid grid-cols-2 gap-4 mb-6">
        <?php
        // Include the Contacto model
        require_once __DIR__ . '/../../../models/contacto.php';
        
        // Fetch books from the database using the Contacto model
        $contacto = new Contacto();
        $result = $contacto->libros();
        $books = [];
        
        // Check if the query returned results
        if ($result && $result->num_rows > 0) {
            // Convert result to array of objects
            while ($row = $result->fetch_object()) {
                $books[] = $row;
            }
        }
        
        // Display each book
        foreach ($books as $book): 
            // Determine background color based on category
            $bgColors = ['bg-yellow-200', 'bg-purple-200', 'bg-green-200', 'bg-blue-200', 'bg-red-200', 'bg-indigo-200'];
            $colorIndex = isset($book->categoria_id) ? crc32($book->categoria_id) % count($bgColors) : 0;
            $bgColor = $bgColors[$colorIndex];
        ?>
        <!-- Book Item -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <div class="flex mb-3">
                <div class="w-16 h-16 <?= $bgColor ?> rounded-lg flex items-center justify-center mr-4">
                    <span class="font-bold text-lg"><?= substr($book->titulo, 0, 1) ?></span>
                </div>
                <div>
                    <h3 class="font-bold text-lg"><?= $book->titulo ?></h3>
                    <p class="text-gray-600 text-sm mt-1">
                        <span class="font-semibold">ISBN:</span> <?= $book->isbn ?> | 
                        <span class="font-semibold">Autor:</span> <?= $book->autor ?>
                    </p>
                    <p class="text-gray-600 text-sm mt-1">
                        <span class="font-semibold">Editorial:</span> <?= $book->editorial ?> | 
                        <span class="font-semibold">Año:</span> <?= $book->anio_publicacion ?>
                    </p>
                    <p class="text-gray-600 text-sm mt-1">
                        <span class="font-semibold">Ejemplares:</span> <?= $book->cantidad_ejemplares ?> | 
                        <span class="font-semibold">Disponibles:</span> <?= $book->disponibles ?>
                    </p>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-xs text-gray-500">Última modificación: <?= date('d/m/Y', strtotime($book->fecha_modificacion)) ?></span>
                <div class="flex space-x-2">
                    <a href="<?= base_url('admin/books/edit/' . $book->id) ?>" class="text-blue-500 hover:underline text-xs">
                        Editar
                    </a>
                    <button type="button" class="delete-book-btn text-red-500 hover:underline text-xs" data-id="<?= $book->id ?>" data-title="<?= htmlspecialchars($book->titulo) ?>">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <?php if (count($books) === 0): ?>
        <div class="col-span-2 bg-gray-100 p-4 rounded-lg text-center">
            <p>No hay libros disponibles en la base de datos.</p>
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Right sidebar with stats -->
    <div class="bg-white p-4 rounded-lg shadow-md">
        <!-- Aquí puedes agregar contenido adicional para la barra lateral derecha, si es necesario -->
    </div>
    
    <!-- Edit Book Modal -->
    <div id="editBookModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-4 overflow-y-auto max-h-screen">
            <div class="border-b px-4 py-3 flex justify-between items-center">
                <h3 class="font-bold text-lg">Editar Libro</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="editBookForm" class="p-4" method="post" action="<?= base_url('index.php?view=admin/books&action=update') ?>">
                <input type="hidden" id="edit-book-id" name="book_id">
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="edit-titulo" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                        <input type="text" id="edit-titulo" name="titulo" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label for="edit-isbn" class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                        <input type="text" id="edit-isbn" name="isbn" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label for="edit-autor" class="block text-sm font-medium text-gray-700 mb-1">Autor</label>
                        <input type="text" id="edit-autor" name="autor" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label for="edit-editorial" class="block text-sm font-medium text-gray-700 mb-1">Editorial</label>
                        <input type="text" id="edit-editorial" name="editorial" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label for="edit-anio" class="block text-sm font-medium text-gray-700 mb-1">Año de Publicación</label>
                        <input type="number" id="edit-anio" name="anio_publicacion" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label for="edit-categoria" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                        <select id="edit-categoria" name="categoria_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Seleccionar categoría</option>
                            <?php
                            // Fetch categories from database
                            $categorias_result = $contacto->obtener_categorias(); // You'll need to add this method to your model
                            if ($categorias_result && $categorias_result->num_rows > 0) {
                                while ($categoria = $categorias_result->fetch_object()) {
                                    echo "<option value='{$categoria->id}'>{$categoria->nombre}</option>";
                                }
                            } else {
                            ?>
                            <option value="1">Literatura clásica</option>
                            <option value="2">Metafísica</option>
                            <option value="3">Finanzas</option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div>
                        <label for="edit-ejemplares" class="block text-sm font-medium text-gray-700 mb-1">Ejemplares</label>
                        <input type="number" id="edit-ejemplares" name="cantidad_ejemplares" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required min="0">
                    </div>
                    
                    <div>
                        <label for="edit-disponibles" class="block text-sm font-medium text-gray-700 mb-1">Disponibles</label>
                        <input type="number" id="edit-disponibles" name="disponibles" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required min="0">
                    </div>
                </div>
                
                <div class="flex justify-end mt-4 space-x-3">
                    <button type="button" id="cancelEditBook" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div id="deleteBookModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
            <div class="border-b px-4 py-3 flex justify-between items-center">
                <h3 class="font-bold text-lg">Confirmar Eliminación</h3>
                <button id="closeDeleteModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="p-4">
                <p class="mb-4">¿Estás seguro de que deseas eliminar el libro "<span id="delete-book-title" class="font-semibold"></span>"?</p>
                <p class="text-red-500 mb-4">Esta acción no se puede deshacer.</p>
                
                <div class="flex justify-end mt-4 space-x-3">
                    <button type="button" id="cancelDeleteBook" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Cancelar
                    </button>
                    <form id="deleteBookForm" method="post" action="<?= base_url('index.php?view=admin/books&action=delete') ?>">
                        <input type="hidden" id="delete-book-id" name="book_id">
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Include the external JavaScript files -->
    <script src="<?= base_url('public/scripts/book-editor.js') ?>"></script>
    <script src="<?= base_url('public/scripts/book-delete.js') ?>"></script>
</div>
