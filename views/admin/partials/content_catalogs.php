<?php
require_once __DIR__ . '/../../../models/contacto.php';
$contacto = new Contacto();
$categorias = $contacto->obtener_categorias();
?>
<!-- Catalogs Content -->
<div id="content-catalogs" class="content-section hidden">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Catálogos Disponibles</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if ($categorias && $categorias->num_rows > 0): ?>
                        <?php while ($categoria = $categorias->fetch_assoc()): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($categoria['nombre']); ?></td>
                                <td class="px-6 py-4"><?php echo htmlspecialchars($categoria['descripcion'] ?? 'Sin descripción'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3" onclick="openEditModal('<?php echo $categoria['id']; ?>', '<?php echo htmlspecialchars($categoria['nombre']); ?>', '<?php echo htmlspecialchars($categoria['descripcion'] ?? ''); ?>')">Editar</a>
                                    <a href="/Bookmaster/index.php?view=admin&action=delete_category&id=<?php echo $categoria['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center">No hay categorías disponibles</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para editar categoría -->
<div id="editModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Editar Categoría</h2>
            <form id="editCategoryForm" method="POST" action="/Bookmaster/index.php?view=admin&action=update_category">
                <input type="hidden" id="editCategoryId" name="id">
                <div class="mb-4">
                    <label for="editCategoryName" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" id="editCategoryName" name="nombre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="editCategoryDescription" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea id="editCategoryDescription" name="descripcion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2" onclick="closeEditModal()">Cancelar</button>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(id, nombre, descripcion) {
        document.getElementById('editCategoryId').value = id;
        document.getElementById('editCategoryName').value = nombre;
        document.getElementById('editCategoryDescription').value = descripcion;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
