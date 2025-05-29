# 📚 Proyecto de Biblioteca Web de Flor Carmona y Daniel Cruz

Este es un proyecto web básico desarrollado en PHP para gestionar libros y usuarios. Incluye funcionalidades como inicio de sesión, adición de libros y actualizacion de información. Pensado como una plataforma de gestión sencilla para una biblioteca digital.

## 🎯 Objetivos

El objetivo del proyecto es proporcionar una base funcional de un sistema web que permita:

- Añadir libros a un catálogo.
- Iniciar sesión con autenticación básica.
- Editar información.
- Eliminar información.

### ✅ Requisitos previos a la instalación

Antes de instalar este proyecto, asegúrate de tener lo siguiente:

- PHP >= 7.4
- Servidor local como **XAMPP**, **WAMP**, **MAMP** o **Laragon**
- Navegador web moderno
- (Opcional) Editor de código como VSCode

### 🔧 Instrucciones

1. Clona o descarga este repositorio en tu máquina local.

2. Copia la carpeta del proyecto dentro del directorio `htdocs` (si usas XAMPP) o el equivalente en tu servidor local.

3. Inicia el servidor Apache desde tu panel de control.

4. Abre tu navegador y visita: http://localhost/bookmaster/



### Estructura de archivos


📁 BookMaster/
├── controllers/                 # Controladores del sistema
│   ├── add_book.php            # Lógica para agregar libros
│   ├── admin_controller.php    # Controlador para funciones de administrador
│   ├── books_controller.php    # Controlador de libros (listar, editar, eliminar)
│   ├── login_controller.php    # Manejo de inicio de sesión
│   └── register_controller.php # Manejo de registro de usuarios
│
├── db/
│   └── bookmaster.sql          # Script SQL para crear la base de datos
│
├── models/                     # Archivos relacionados con la base de datos
│   ├── conexion.php            # Conexión a la base de datos
│   └── contacto.php            # Modelo de contacto (posiblemente envía correos o guarda mensajes)
│
├── public/
│   ├── images/
│   │   ├── fondo.jpg           # Imagen de fondo
│   │   └── img_libros/         # Carpeta para imágenes de libros
│   │
│   └── scripts/
│       ├── book-delete.js      # Script para eliminar libros
│       └── book-editor.js      # Script para editar libros
│
├── views/                      # Vistas del sistema
│   ├── admin/
│   │   ├── partials/           # Partes reutilizables (ej. header, sidebar)
│   │   └── dashboard.php       # Panel principal de administración
│   │
│   └── login/                  # Vistas del login (archivos no visibles pero probable)
│
└── index.php                   # Entrada principal del sistema

