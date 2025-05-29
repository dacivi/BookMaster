// Book deletion functionality
document.addEventListener('DOMContentLoaded', function() {
    // Delete modal elements
    const deleteModal = document.getElementById('deleteBookModal');
    const deleteButtons = document.querySelectorAll('.delete-book-btn');
    const closeDeleteModalBtn = document.getElementById('closeDeleteModal');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBook');
    const deleteBookTitle = document.getElementById('delete-book-title');
    const deleteBookId = document.getElementById('delete-book-id');
    const deleteForm = document.getElementById('deleteBookForm');
    
    // Open delete confirmation modal
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const bookId = this.getAttribute('data-id');
            const bookTitle = this.getAttribute('data-title');
            
            deleteBookId.value = bookId;
            deleteBookTitle.textContent = bookTitle;
            
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
        });
    });
    
    // Close delete modal
    function closeDeleteModal() {
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex');
    }
    
    closeDeleteModalBtn.addEventListener('click', closeDeleteModal);
    cancelDeleteBtn.addEventListener('click', closeDeleteModal);
    
    // Handle form submission with AJAX
    deleteForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const bookId = deleteBookId.value;
        
        // Submit the form using fetch API
        fetch('/Bookmaster/index.php?view=admin/books&action=delete', {
            method: 'POST',
            body: new FormData(deleteForm)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Libro eliminado correctamente');
                closeDeleteModal();
                // Reload the page to refresh the book list
                window.location.reload();
            } else {
                alert('Error al eliminar el libro: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error deleting book:', error);
            alert('Error al eliminar el libro. Por favor, inténtelo de nuevo.');
        });
    });
});
