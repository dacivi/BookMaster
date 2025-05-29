<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Helper function for asset URLs
function base_url($path = '') {
    $base_url = '/Bookmaster/';
    return $base_url . ltrim($path, '/');
}

// Helper function to send JSON responses
function sendJsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

// Carga de controladores
require_once __DIR__ . '/controllers/login_controller.php';
require_once __DIR__ . '/controllers/register_controller.php';
require_once __DIR__ . '/controllers/admin_controller.php';
require_once __DIR__ . '/controllers/books_controller.php';

$view = isset($_GET['view']) ? $_GET['view'] : 'login';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Special route for book operations
if ($view == 'admin/books') {
    $booksController = new BooksController();
    
    switch ($action) {
        case 'update':
            $booksController->update();
            break;
        case 'get':
            $booksController->get();
            break;
        case 'delete':
            $booksController->delete();
            break;
        default:
            sendJsonResponse(['success' => false, 'message' => 'Acción no válida'], 400);
    }
    exit();
}

// Regular routing
switch ($view) {
    case 'login':
        $controller = new HomeController();
        if ($action === 'login') {
            $controller->login();
        } else {
            $controller->index();
        }
        break;
    case 'register':
        $controller = new RegisterController();
        if ($action === 'register') {
            $controller->register();
        } else {
            $controller->index();
        }
        break;
    case 'admin':
        $controller = new AdminController();
        if ($action === 'dashboard') {
            $controller->dashboard();
        } else {
            $controller->dashboard(); // Changed from index() to dashboard() to ensure the dashboard always loads
        }
        break;
    
    default:
        echo "Página no encontrada.";
        break;
}
