<?php
class BooksController {
    private $contacto;
    
    public function __construct() {
        // Verify user is logged in and is admin
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'admin') {
            sendJsonResponse(['success' => false, 'message' => 'No autorizado'], 401);
            exit();
        }
        
        // Initialize the Contacto model
        require_once __DIR__ . '/../models/contacto.php';
        $this->contacto = new Contacto();
    }
    
    // Nuevo método para agregar libros
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            sendJsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
            exit();
        }
        
        try {
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
                sendJsonResponse(['success' => false, 'message' => 'Todos los campos obligatorios deben ser completados'], 400);
                exit();
            }
            
            // Insert book
            $result = $this->contacto->insertar_libro(
                $titulo, 
                $autor, 
                $categoriaId, 
                $isbn, 
                $editorial, 
                $anio, 
                $numeroPaginas,
                $ejemplares
            );
            
            if ($result === false) {
                // ISBN duplicado o error al insertar
                sendJsonResponse(['success' => false, 'message' => 'Error: El ISBN ingresado ya existe en la base de datos'], 400);
            } else if ($result) {
                // Return success message
                sendJsonResponse(['success' => true, 'message' => 'Libro añadido correctamente']);
            } else {
                // Return error message
                sendJsonResponse(['success' => false, 'message' => 'Error al añadir el libro'], 500);
            }
        } catch (Exception $e) {
            error_log('Error in BooksController::add: ' . $e->getMessage());
            sendJsonResponse(['success' => false, 'message' => 'Error interno: ' . $e->getMessage()], 500);
        }
    }
    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            sendJsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
            exit();
        }
        
        // Get form data
        $bookId = isset($_POST['book_id']) ? (int)$_POST['book_id'] : 0;
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
        $isbn = isset($_POST['isbn']) ? $_POST['isbn'] : '';
        $autor = isset($_POST['autor']) ? $_POST['autor'] : '';
        $editorial = isset($_POST['editorial']) ? $_POST['editorial'] : '';
        $anio = isset($_POST['anio_publicacion']) ? (int)$_POST['anio_publicacion'] : 0;
        $categoriaId = isset($_POST['categoria_id']) ? (int)$_POST['categoria_id'] : 0;
        $ejemplares = isset($_POST['cantidad_ejemplares']) ? (int)$_POST['cantidad_ejemplares'] : 0;
        $disponibles = isset($_POST['disponibles']) ? (int)$_POST['disponibles'] : 0;
        
        // Validate data
        if (empty($bookId) || empty($titulo) || empty($isbn) || empty($autor) || empty($categoriaId)) {
            sendJsonResponse(['success' => false, 'message' => 'Todos los campos obligatorios deben ser completados'], 400);
            exit();
        }
        
        if ($disponibles > $ejemplares) {
            sendJsonResponse([
                'success' => false, 
                'message' => 'El número de ejemplares disponibles no puede ser mayor que el total de ejemplares'
            ], 400);
            exit();
        }
        
        // Update book
        $result = $this->contacto->modificar_libro(
            $bookId, 
            $titulo, 
            $autor, 
            $categoriaId, 
            $isbn, 
            $editorial, 
            $anio, 
            $ejemplares,
            $disponibles
        );
        
        if ($result) {
            sendJsonResponse(['success' => true, 'message' => 'Libro actualizado correctamente']);
        } else {
            sendJsonResponse(['success' => false, 'message' => 'Error al actualizar el libro'], 500);
        }
    }
    
    public function get() {
        if (!isset($_GET['id'])) {
            sendJsonResponse(['success' => false, 'message' => 'ID de libro no proporcionado'], 400);
            exit();
        }
        
        $bookId = (int)$_GET['id'];
        $book = $this->contacto->obtener_libro_por_id($bookId);
        
        if ($book) {
            sendJsonResponse($book);
        } else {
            sendJsonResponse(['success' => false, 'message' => 'Libro no encontrado'], 404);
        }
    }
    
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            sendJsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
            exit();
        }
        
        if (!isset($_POST['book_id'])) {
            sendJsonResponse(['success' => false, 'message' => 'ID de libro no proporcionado'], 400);
            exit();
        }
        
        $bookId = (int)$_POST['book_id'];
        
        // Validate book exists
        $book = $this->contacto->obtener_libro_por_id($bookId);
        if (!$book) {
            sendJsonResponse(['success' => false, 'message' => 'Libro no encontrado'], 404);
            exit();
        }
        
        // Delete the book
        $result = $this->contacto->eliminar_libro($bookId);
        
        if ($result) {
            sendJsonResponse(['success' => true, 'message' => 'Libro eliminado correctamente']);
        } else {
            sendJsonResponse(['success' => false, 'message' => 'Error al eliminar el libro'], 500);
        }
    }
}
?>
