<?php
    class RegisterController {
        public function index() {
            require_once __DIR__ . '/../views/login/register.php';
        }

        public function register() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];

                if ($password !== $confirm_password) {
                    echo "Las contraseñas no coinciden.";
                    return;
                }

                require_once __DIR__ . '/../models/contacto.php';
                $contacto = new Contacto();
                $result = $contacto->register($name, $email, password_hash($password, PASSWORD_DEFAULT));

                if ($result) {
                    // Redirigir al inicio de sesión o a una página de éxito
                    header('Location: /Bookmaster/index.php?view=login');
                    exit();
                } else {
                    echo "Error al registrar el usuario.";
                }
            }
        }
    }
?>