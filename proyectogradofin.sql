-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2024 a las 16:02:21
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
-- Base de datos: `proyectogrado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquiler`
--

CREATE TABLE `alquiler` (
  `id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `monto_total` decimal(10,2) NOT NULL,
  `id_propietario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alquiler`
--

INSERT INTO `alquiler` (`id`, `fecha_inicio`, `fecha_final`, `hora_inicio`, `hora_final`, `monto_total`, `id_propietario`, `id_usuario`) VALUES
(1, '2024-10-25', '2024-10-25', '09:00:00', '16:00:00', 680.00, 51, 1),
(3, '2024-10-25', '2024-10-25', '12:37:00', '13:40:00', 210.00, 63, 1),
(5, '2024-10-26', '2024-10-26', '12:51:00', '16:54:00', 600.00, 51, 1),
(6, '2024-10-26', '2024-10-26', '08:00:00', '12:00:00', 70.00, 63, 1),
(7, '2024-10-25', '2024-10-25', '03:17:00', '15:17:00', 70.00, 51, 1),
(8, '2024-10-25', '2024-10-25', '03:18:00', '15:18:00', 50.00, 63, 1),
(9, '2024-10-25', '2024-10-25', '15:58:00', '18:01:00', 60.00, 63, 1),
(10, '2024-10-25', '2024-10-25', '04:04:00', '16:04:00', 40.00, 63, 1),
(11, '2024-10-26', '2024-10-26', '04:07:00', '16:07:00', 200.00, 63, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_social`
--

CREATE TABLE `area_social` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `fecha` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area_social`
--

INSERT INTO `area_social` (`id`, `descripcion`, `precio`, `estado`, `fecha`) VALUES
(1, 'Salon de Eventos', 500.00, 1, '2024-10-24'),
(3, 'Gimnasio', 100.00, 1, '2024-10-24'),
(4, 'Terraza', 80.00, 1, '2024-10-24'),
(5, 'Cancha de Tenis', 120.00, 1, '2024-10-24'),
(6, 'Barbacoa', 90.00, 1, '2024-10-24'),
(7, 'Sala de Juegos', 70.00, 1, '2024-10-24'),
(8, 'Cafetería', 50.00, 1, '2024-10-24'),
(9, 'Parque Infantil', 40.00, 1, '2024-10-24'),
(10, 'Salón de Lectura', 30.00, 1, '2024-10-24'),
(11, 'Auditorio', 60.00, 1, '2024-10-24'),
(12, 'Salón de Reuniones', 110.00, 1, '2024-10-24'),
(13, 'Estudio de Danza', 75.00, 1, '2024-10-24'),
(14, 'Cine', 160.00, 1, '2024-10-24'),
(15, 'Pista de Correr', 95.00, 1, '2024-10-24'),
(16, 'Zona de BBQ', 85.00, 1, '2024-10-24'),
(17, 'Salón de Arte', 55.00, 1, '2024-10-24'),
(18, 'Clínica de Mascotas', 45.00, 1, '2024-10-24'),
(19, 'Sala de Conferencias', 130.00, 1, '2024-10-24'),
(20, 'Spa', 140.00, 1, '2024-10-24'),
(21, 'Pabellón Deportivo', 135.00, 1, '2024-10-24'),
(22, 'Salón de Yoga', 110.00, 1, '2024-10-24'),
(23, 'Terraza de Juegos', 65.00, 1, '2024-10-24'),
(24, 'Salón de Música', 120.00, 1, '2024-10-24'),
(25, 'Zona de Estudio', 50.00, 1, '2024-10-24'),
(26, 'Sala de Tecnología', 100.00, 1, '2024-10-24'),
(27, 'Pabellón de Arte', 90.00, 1, '2024-10-24'),
(28, 'Área de Relajación', 80.00, 1, '2024-10-24'),
(29, 'Salón de Adultos', 70.00, 1, '2024-10-24'),
(30, 'Cafetería al Aire Libre', 60.00, 1, '2024-10-24'),
(31, 'Mini Golf', 120.00, 1, '2024-10-24'),
(32, 'Salón de Reciclaje', 40.00, 1, '2024-10-24'),
(33, 'Jardín Botánico', 150.00, 1, '2024-10-24'),
(34, 'Salón de Cuidado Infantil', 30.00, 1, '2024-10-24'),
(35, 'Centro de Yoga', 55.00, 1, '2024-10-24'),
(36, 'Salón de Cultura', 75.00, 1, '2024-10-24'),
(37, 'Zona de Juego de Mesa', 50.00, 1, '2024-10-24'),
(38, 'Salón de Tecnología', 100.00, 1, '2024-10-24'),
(39, 'Área de Descanso', 90.00, 1, '2024-10-24'),
(40, 'Cine al Aire Libre', 160.00, 1, '2024-10-24'),
(41, 'Centro de Entrenamiento', 130.00, 1, '2024-10-24'),
(42, 'Zona de Meditación', 70.00, 1, '2024-10-24'),
(43, 'Salón de Fiesta', 150.00, 1, '2024-10-24'),
(44, 'Jardín de Eventos', 140.00, 1, '2024-10-24'),
(45, 'Salón de Presentaciones', 110.00, 1, '2024-10-24'),
(46, 'Terraza de Relajación', 80.00, 1, '2024-10-24'),
(47, 'Área de Juego Infantil', 40.00, 1, '2024-10-24'),
(48, 'Salón de Reuniones Pequeñas', 60.00, 1, '2024-10-24'),
(49, 'Sala de Convivencia', 90.00, 1, '2024-10-24'),
(50, 'Gimnasio al Aire Libre', 100.00, 1, '2024-10-24'),
(51, 'Salón de Manualidades', 30.00, 1, '2024-10-24'),
(52, 'Zona de Aventura', 120.00, 1, '2024-10-24'),
(54, 'Salon de area infantil', 70.00, 1, '2024-10-24'),
(106, 'Piscina', 70.00, 1, '2024-10-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_alquiler`
--

CREATE TABLE `detalle_alquiler` (
  `id_alquiler` int(11) NOT NULL,
  `id_area_social` int(11) NOT NULL,
  `costo` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_alquiler`
--

INSERT INTO `detalle_alquiler` (`id_alquiler`, `id_area_social`, `costo`) VALUES
(1, 1, 500.00),
(1, 3, 100.00),
(1, 4, 80.00),
(3, 5, 120.00),
(3, 6, 90.00),
(5, 1, 500.00),
(5, 3, 100.00),
(6, 7, 70.00),
(7, 7, 70.00),
(8, 8, 50.00),
(9, 10, 30.00),
(10, 9, 40.00),
(11, 4, 80.00),
(11, 5, 120.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensualidad`
--

CREATE TABLE `mensualidad` (
  `id` int(11) NOT NULL,
  `mes` int(2) DEFAULT NULL,
  `gestion` int(4) NOT NULL,
  `costo` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensualidad`
--

INSERT INTO `mensualidad` (`id`, `mes`, `gestion`, `costo`) VALUES
(1, 1, 2024, 200.00),
(2, 2, 2024, 100.00),
(3, 3, 2024, 100.00),
(4, 4, 2024, 100.00),
(5, 5, 2024, 100.00),
(6, 6, 2024, 100.00),
(7, 7, 2024, 100.00),
(8, 8, 2024, 100.00),
(9, 9, 2024, 100.00),
(10, 10, 2024, 100.00),
(11, 11, 2024, 100.00),
(12, 12, 2024, 100.00),
(13, 1, 2025, 100.00),
(14, 2, 2025, 100.00),
(15, 3, 2025, 100.00),
(16, 4, 2025, 100.00),
(17, 5, 2025, 100.00),
(18, 6, 2025, 100.00),
(19, 7, 2025, 100.00),
(20, 8, 2025, 100.00),
(21, 9, 2025, 100.00),
(22, 10, 2025, 100.00),
(23, 11, 2025, 100.00),
(24, 12, 2025, 100.00),
(50, 1, 2026, 500.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_mensualidad`
--

CREATE TABLE `pago_mensualidad` (
  `id` int(11) NOT NULL,
  `fecha_periodo` varchar(25) NOT NULL,
  `costo_periodo` decimal(8,2) NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp(),
  `id_propietario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_mensualidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago_mensualidad`
--

INSERT INTO `pago_mensualidad` (`id`, `fecha_periodo`, `costo_periodo`, `fecha_creacion`, `id_propietario`, `id_usuario`, `id_mensualidad`) VALUES
(3, '2024-02', 100.00, '2024-10-24', 51, 1, 2),
(4, '2024-03', 100.00, '2024-10-24', 51, 1, 3),
(5, '2024-04', 100.00, '2024-10-24', 51, 1, 4),
(6, '2024-05', 100.00, '2024-10-24', 51, 1, 5),
(7, '2024-06', 100.00, '2024-10-24', 51, 1, 6),
(8, '2024-07', 100.00, '2024-10-24', 51, 1, 7),
(11, '2024-08', 100.00, '2024-10-24', 51, 1, 8),
(12, '2024-09', 100.00, '2024-10-24', 51, 1, 9),
(13, '2024-10', 100.00, '2024-10-24', 51, 1, 10),
(14, '2024-11', 100.00, '2024-10-24', 51, 1, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietario`
--

CREATE TABLE `propietario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `nroCarnet` varchar(20) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `nroDpto` varchar(10) NOT NULL,
  `fecha` date DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propietario`
--

INSERT INTO `propietario` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `nroCarnet`, `telefono`, `correo`, `nroDpto`, `fecha`, `id_usuario`) VALUES
(51, 'juan', 'pérez', 'garcía', '20000000', '67033811', 'juan.perez@example.com', 'A101', '2024-02-01', 1),
(63, 'juan enrique', 'jeke', 'astian', '123441', '70984905', 'al@gmail.com', 'a205', '2024-07-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `rol` text NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `ultimo_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `usuario`, `password`, `telefono`, `correo`, `rol`, `estado`, `ultimo_login`) VALUES
(1, 'juan', 'perez', 'mamani', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', '71234567', 'juan.perez@example.com', 'administrador', 1, '2024-10-24 14:10:36'),
(52, 'carlos', 'ramirez', 'chquimia', 'fchiquimia', '$2a$07$asxx54ahjppf45sd87a5auHGHfBfKUcMRHMdLSNaVFyWh6MmTFrDG', '70984905', 'al@gmail.com', 'guardia', 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_propietario` (`id_propietario`);

--
-- Indices de la tabla `area_social`
--
ALTER TABLE `area_social`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_alquiler`
--
ALTER TABLE `detalle_alquiler`
  ADD PRIMARY KEY (`id_alquiler`,`id_area_social`),
  ADD KEY `id_area_social` (`id_area_social`);

--
-- Indices de la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pago_mensualidad`
--
ALTER TABLE `pago_mensualidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_propietario` (`id_propietario`),
  ADD KEY `id_mensualidad` (`id_mensualidad`);

--
-- Indices de la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `area_social`
--
ALTER TABLE `area_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT de la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `pago_mensualidad`
--
ALTER TABLE `pago_mensualidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `propietario`
--
ALTER TABLE `propietario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD CONSTRAINT `alquiler_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `alquiler_ibfk_2` FOREIGN KEY (`id_propietario`) REFERENCES `propietario` (`id`);

--
-- Filtros para la tabla `detalle_alquiler`
--
ALTER TABLE `detalle_alquiler`
  ADD CONSTRAINT `detalle_alquiler_ibfk_1` FOREIGN KEY (`id_alquiler`) REFERENCES `alquiler` (`id`),
  ADD CONSTRAINT `detalle_alquiler_ibfk_2` FOREIGN KEY (`id_area_social`) REFERENCES `area_social` (`id`);

--
-- Filtros para la tabla `pago_mensualidad`
--
ALTER TABLE `pago_mensualidad`
  ADD CONSTRAINT `pago_mensualidad_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `pago_mensualidad_ibfk_2` FOREIGN KEY (`id_propietario`) REFERENCES `propietario` (`id`),
  ADD CONSTRAINT `pago_mensualidad_ibfk_3` FOREIGN KEY (`id_mensualidad`) REFERENCES `mensualidad` (`id`);

--
-- Filtros para la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD CONSTRAINT `propietario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
