<?php
    include 'conexion.php';
    class Contacto extends Conexion {
        public function login($email, $password) {
            // Modificar consulta para asegurar que se selecciona el campo role
            $this->sentencia = "SELECT * FROM usuarios WHERE email = '$email'";
            $result = $this->obtener_sentencia();
            
            if ($result->num_rows > 0) {
                $usuario = $result->fetch_assoc();
                // Verificar si la contraseña coincide con el hash almacenado
                if (password_verify($password, $usuario['contrasena'])) {
                    // Asegurar que el role está disponible en el array retornado
                    if (!isset($usuario['rol'])) {
                        $usuario['rol'] = 'user'; // Valor predeterminado si no existe
                    }
                    return $usuario;
                }
            }
            return false;
        }
        public function register($name, $email, $password) {
            // Verificar si el email ya está registrado
            $this->sentencia = "SELECT * FROM usuarios WHERE email = '$email'";
            $result = $this->obtener_sentencia();
            
            if ($result->num_rows > 0) {
                return false; // El email ya está registrado
            }
            
            // Insertar nuevo usuario
            $this->sentencia = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$name', '$email', '$password')";
            return $this->obtener_sentencia();
        }
        public function libros() {
            // Obtener todos los libros
            $this->sentencia = "SELECT * FROM libros";
            return $this->obtener_sentencia();
        }
        public function modificar_libro($id, $titulo, $autor, $categoria_id, $isbn, $editorial, $anio_publicacion, $cantidad_ejemplares, $disponibles = null) {
            // If disponibles is not provided, use the same as cantidad_ejemplares
            if ($disponibles === null) {
                $disponibles = $cantidad_ejemplares;
            }
            
            // Ensure disponibles doesn't exceed cantidad_ejemplares
            $disponibles = min($disponibles, $cantidad_ejemplares);
            
            // Actualizar un libro existente incluyendo disponibles
            $this->sentencia = "UPDATE libros SET 
                titulo = '$titulo', 
                autor = '$autor', 
                categoria_id = '$categoria_id', 
                isbn = '$isbn', 
                editorial = '$editorial', 
                anio_publicacion = '$anio_publicacion', 
                cantidad_ejemplares = '$cantidad_ejemplares',
                disponibles = '$disponibles',
                fecha_modificacion = NOW(),
                usuario_modificacion = 'admin'
                WHERE id = $id";
                
            return $this->obtener_sentencia();
        }
        public function obtener_categorias() {
            // Obtener todas las categorías
            $this->sentencia = "SELECT * FROM categorias ORDER BY nombre";
            return $this->obtener_sentencia();
        }
        public function obtener_libro_por_id($id) {
            // Obtener un libro por ID
            $this->sentencia = "SELECT * FROM libros WHERE id = $id";
            $resultado = $this->obtener_sentencia();
            if ($resultado && $resultado->num_rows > 0) {
                return $resultado->fetch_object();
            }
            return null;
        }
        public function eliminar_libro($id) {
            // Eliminar un libro por ID
            $this->sentencia = "DELETE FROM libros WHERE id = $id";
            return $this->obtener_sentencia();
        }
        public function insertar_libro($titulo, $autor, $categoria_id, $isbn, $editorial, $anio_publicacion, $numero_paginas, $cantidad_ejemplares) {
            // Verificar si el ISBN ya existe
            $this->sentencia = "SELECT id FROM libros WHERE isbn = '$isbn'";
            $resultado = $this->obtener_sentencia();
            
            if ($resultado && $resultado->num_rows > 0) {
                // El ISBN ya existe, retornar false o un código de error
                return false;
            }
            
            // Insertar un nuevo libro
            $this->sentencia = "INSERT INTO libros (
                isbn, 
                titulo, 
                autor, 
                editorial, 
                anio_publicacion,
                categoria_id,
                numero_paginas, 
                cantidad_ejemplares,
                disponibles,
                fecha_modificacion,
                usuario_modificacion,
                eliminado
            ) VALUES (
                '$isbn',
                '$titulo', 
                '$autor', 
                '$editorial', 
                '$anio_publicacion',
                '$categoria_id',
                '$numero_paginas',
                '$cantidad_ejemplares',
                '$cantidad_ejemplares',
                NOW(),
                'admin',
                0
            )";
            
            return $this->obtener_sentencia();
        }
        public function modificar_categoria($id, $nombre, $descripcion) {
            // Escapar valores para evitar inyección SQL
            $id = $this->conexion->real_escape_string($id);
            $nombre = $this->conexion->real_escape_string($nombre);
            $descripcion = $this->conexion->real_escape_string($descripcion);

            $this->sentencia = "UPDATE categorias SET 
                nombre = '$nombre', 
                descripcion = '$descripcion' 
                WHERE id = $id";
            return $this->obtener_sentencia();
        }
    }
?>