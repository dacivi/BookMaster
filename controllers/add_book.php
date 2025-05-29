<?php
// Include the books controller functionality
require_once __DIR__ . '/../models/contacto.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_libro'])) {
    try {
        $contacto = new Contacto();
        
        // Get form data
        $titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : '';
        $isbn = isset($_POST['isbn']) ? trim($_POST['isbn']) : '';
        $autor = isset($_POST['autor']) ? trim($_POST['autor']) : '';
        $editorial = isset($_POST['editorial']) ? trim($_POST['editorial']) : '';
        $anio = isset($_POST['anio_publicacion']) ? (int)$_POST['anio_publicacion'] : 0;
        $categoriaId = isset($_POST['categoria_id']) ? (int)$_POST['categoria_id'] : 0;
        $numeroPaginas = isset($_POST['numero_paginas']) ? (int)$_POST['numero_paginas'] : 0;
        $ejemplares = isset($_POST['cantidad_ejemplares']) ? (int)$_POST['cantidad_ejemplares'] : 0;
        
        // Validate data
        if (empty($titulo) || empty($isbn) || empty($autor) || empty($categoriaId) || $ejemplares <= 0) {
            echo json_encode(['success' => false, 'message' => 'Todos los campos obligatorios deben ser completados']);
            exit();
        }
        
        // Insert book
        $result = $contacto->insertar_libro(
            $titulo, 
            $autor, 
            $categoriaId, 
            $isbn, 
            $editorial, 
            $anio, 
            $numeroPaginas,
            $ejemplares
        );
        if ($result) {
            // Redirect to the book list page
            header('Location: /Bookmaster/index.php?view=admin&action=dashboard');
            exit();
        }
    } catch (Exception $e) {
        error_log('Error in add_book.php: ' . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Ocurrió un error inesperado']);
        exit();
    }
}
