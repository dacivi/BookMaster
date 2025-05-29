<?php
    class AdminController {
        public function __construct() {
            // Verificar que el usuario está autenticado y es admin
            session_start();
            if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'admin') {
                header('Location: /Bookmaster/public/index.php?view=login');
                exit();
            }
        }

        public function index() {
            $this->dashboard(); // Redirect to dashboard method for consistency
        }

        public function dashboard() {
            // Get user data from session to pass to the view if needed
            $userData = isset($_SESSION['user']) ? $_SESSION['user'] : null;
            
            // Cargar la vista del dashboard
            require_once __DIR__ . '/../views/admin/dashboard.php';
        }
    }
?>