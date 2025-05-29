<?php
class HomeController {
    public function index() {
        require_once __DIR__ . '/../views/login/login.php';
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            require_once __DIR__ . '/../models/contacto.php';
            $contacto = new Contacto();
            $user = $contacto->login($email, $password);

            if ($user) {
                // Iniciar sesión
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['nombre'] = $user['nombre']; // Store the user's name separately
                
                // Redirigir según el rol del usuario
                if ($user['rol'] === 'admin') {
                    header('Location: /Bookmaster/index.php?view=admin&action=dashboard');
                } else {
                    header('Location: /Bookmaster/index.php?view=login');
                }
                exit();
            } else {
                // Manejo de error de inicio de sesión
                echo "Credenciales incorrectas.";
            }
        }
    }
}
