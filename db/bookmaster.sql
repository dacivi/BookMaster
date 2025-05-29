-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2025 a las 05:59:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bookmaster`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Ficción', 'Libros de narrativa imaginaria'),
(2, 'No ficción', 'Libros basados en hechos y datos reales'),
(3, 'Ciencia Ficción', 'Libros sobre futuros imaginarios, avances tecnológicos y viajes espaciales'),
(4, 'Fantasía', 'Libros con elementos mágicos o sobrenaturales'),
(5, 'Historia', 'Libros sobre eventos históricos y civilizaciones pasadas'),
(6, 'Ciencia', 'Libros sobre diversos campos científicos'),
(7, 'Biografía', 'Libros sobre la vida de personas reales'),
(8, 'Poesía', 'Colecciones de poemas y obras poéticas'),
(9, 'Drama', 'Obras teatrales y narrativas dramáticas'),
(10, 'Infantil', 'Libros para niños');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_modificaciones`
--

CREATE TABLE `historial_modificaciones` (
  `id` int(11) NOT NULL,
  `libro_id` int(11) NOT NULL,
  `campo_modificado` varchar(100) DEFAULT NULL,
  `valor_anterior` text DEFAULT NULL,
  `valor_nuevo` text DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT current_timestamp(),
  `usuario_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `editorial` varchar(255) DEFAULT NULL,
  `anio_publicacion` year(4) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `numero_paginas` int(11) DEFAULT NULL,
  `cantidad_ejemplares` int(11) NOT NULL,
  `disponibles` int(11) NOT NULL,
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_modificacion` varchar(100) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `isbn`, `titulo`, `autor`, `editorial`, `anio_publicacion`, `categoria_id`, `numero_paginas`, `cantidad_ejemplares`, `disponibles`, `fecha_modificacion`, `usuario_modificacion`, `eliminado`) VALUES
(1, '9788478884452', '1980', 'George Orwell', 'Debolsillo', '2013', 3, 352, 10, 10, '2025-05-28 21:19:55', 'admin', 0),
(2, '9788445000663', 'El Señor de los Anillos', 'J.R.R. Tolkien', 'Minotauro', '2019', 4, 1178, 8, 8, '2025-05-28 20:18:50', 'admin', 0),
(3, '9788478886296', 'Cien años de soledad', 'Gabriel García Márquez', 'Literatura Random House', '2017', 1, 496, 15, 15, '2025-05-28 20:18:50', 'admin', 0),
(4, '9788499089515', 'El origen de las especies', 'Charles Darwin', 'Austral', '2016', 6, 696, 5, 5, '2025-05-28 20:18:50', 'admin', 0),
(5, '9788408160434', 'Steve Jobs', 'Walter Isaacson', 'Debate', '2015', 7, 744, 7, 7, '2025-05-28 20:18:50', 'admin', 0),
(7, '9788467591538', 'Romeo y Julieta', 'William Shakespeare', 'Espasa', '2015', 9, 224, 10, 10, '2025-05-28 20:18:50', 'admin', 0),
(8, '9788417671686', 'La historia interminable', 'Michael Ende', 'Alfaguara', '2018', 10, 528, 6, 6, '2025-05-28 20:18:50', 'admin', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL,
  `libro_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion_prevista` date NOT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `estado` enum('activo','vencido','completado') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('admin','usuario') DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contrasena`, `rol`) VALUES
(3, 'Prueba', 'prueba@gmail.com', '$2y$10$IAtV4i8OpUvNOt9H3Z/rOOymvjPsPO6A8zt5w1WCUZc8j4VCvamf.', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `historial_modificaciones`
--
ALTER TABLE `historial_modificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `libro_id` (`libro_id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `idx_titulo` (`titulo`),
  ADD KEY `idx_autor` (`autor`),
  ADD KEY `idx_categoria_id` (`categoria_id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `libro_id` (`libro_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `historial_modificaciones`
--
ALTER TABLE `historial_modificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial_modificaciones`
--
ALTER TABLE `historial_modificaciones`
  ADD CONSTRAINT `historial_modificaciones_ibfk_1` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id`);

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
