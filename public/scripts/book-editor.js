// Edit book functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get all elements with edit links
    const editLinks = document.querySelectorAll('a[href*="admin/books/edit/"]');
    const modal = document.getElementById('editBookModal');
    const closeModalBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelEditBook');
    const editForm = document.getElementById('editBookForm');
    
    // Function to open the modal and load book data
    function openEditModal(bookId) {
        // Show the modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Fetch book data using AJAX
        fetch(`/Bookmaster/index.php?view=admin/books&action=get&id=${bookId}`)
            .then(response => response.json())
            .then(book => {
                // Fill the form with book data
                document.getElementById('edit-book-id').value = book.id;
                document.getElementById('edit-titulo').value = book.titulo;
                document.getElementById('edit-isbn').value = book.isbn;
                document.getElementById('edit-autor').value = book.autor;
                document.getElementById('edit-editorial').value = book.editorial;
                document.getElementById('edit-anio').value = book.anio_publicacion;
                document.getElementById('edit-categoria').value = book.categoria_id;
                document.getElementById('edit-ejemplares').value = book.cantidad_ejemplares;
                document.getElementById('edit-disponibles').value = book.disponibles;
            })
            .catch(error => {
                console.error('Error fetching book data:', error);
                alert('Error al cargar los datos del libro. Por favor, inténtelo de nuevo.');
                closeModal();
            });
    }
    
    // Function to close the modal
    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        // Reset the form
        editForm.reset();
    }
    
    // Add click event listeners to edit links
    editLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const bookId = this.getAttribute('href').split('/').pop();
            openEditModal(bookId);
        });
    });
    
    // Close modal when close button is clicked
    closeModalBtn.addEventListener('click', closeModal);
    
    // Close modal when cancel button is clicked
    cancelBtn.addEventListener('click', closeModal);
    
    // Handle form submission
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate form data
        const ejemplares = parseInt(document.getElementById('edit-ejemplares').value);
        const disponibles = parseInt(document.getElementById('edit-disponibles').value);
        
        if (disponibles > ejemplares) {
            alert('El número de ejemplares disponibles no puede ser mayor que el total de ejemplares');
            return;
        }
        
        // Submit the form using fetch API
        fetch('/Bookmaster/index.php?view=admin/books&action=update', {
            method: 'POST',
            body: new FormData(editForm)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Libro actualizado correctamente');
                closeModal();
                // Reload the page to show updated data
                window.location.reload();
            } else {
                alert('Error al actualizar el libro: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error updating book:', error);
            alert('Error al actualizar el libro. Por favor, inténtelo de nuevo.');
        });
    });
});
