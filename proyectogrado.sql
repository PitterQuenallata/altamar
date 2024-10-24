-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2024 a las 12:32:42
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
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `monto_total` decimal(10,2) NOT NULL,
  `id_propietario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_social`
--
-- Error leyendo la estructura de la tabla proyectogrado.area_social: #1932 - Table &#039;proyectogrado.area_social&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla proyectogrado.area_social: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `proyectogrado`.`area_social`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_alquiler`
--

CREATE TABLE `detalle_alquiler` (
  `id_alquiler` int(11) NOT NULL,
  `id_area_social` int(11) NOT NULL,
  `costo` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensualidad`
--

CREATE TABLE `mensualidad` (
  `id` int(11) NOT NULL,
  `mes` varchar(50) NOT NULL,
  `gestion` varchar(4) NOT NULL,
  `costo` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensualidad`
--

INSERT INTO `mensualidad` (`id`, `mes`, `gestion`, `costo`) VALUES
(2, 'Febrero', '2024', 100.00),
(3, 'Marzo', '2024', 100.00),
(4, 'Abril', '2024', 100.00),
(5, 'Mayo', '2024', 100.00),
(6, 'Junio', '2024', 100.00),
(7, 'Julio', '2024', 100.00),
(8, 'Agosto', '2024', 100.00),
(9, 'Septiembre', '2024', 100.00),
(10, 'Octubre', '2024', 100.00),
(11, 'Noviembre', '2024', 100.00),
(12, 'Diciembre', '2024', 100.00),
(13, 'Enero', '2025', 100.00),
(14, 'Febrero', '2025', 100.00),
(15, 'Marzo', '2025', 100.00),
(16, 'Abril', '2025', 100.00),
(17, 'Mayo', '2025', 100.00),
(18, 'Junio', '2025', 100.00),
(19, 'Julio', '2025', 100.00),
(20, 'Agosto', '2025', 100.00),
(21, 'Septiembre', '2025', 100.00),
(22, 'Octubre', '2025', 100.00),
(23, 'Noviembre', '2025', 100.00),
(24, 'Diciembre', '2025', 100.00),
(25, 'Enero', '2026', 100.00),
(26, 'Febrero', '2026', 100.00),
(27, 'Marzo', '2026', 100.00),
(28, 'Abril', '2026', 100.00),
(29, 'Mayo', '2026', 100.00),
(30, 'Junio', '2026', 100.00),
(31, 'Julio', '2026', 100.00),
(32, 'Agosto', '2026', 100.00),
(33, 'Septiembre', '2026', 100.00),
(34, 'Octubre', '2026', 100.00),
(35, 'Noviembre', '2026', 100.00),
(36, 'Diciembre', '2026', 100.00),
(37, 'Enero', '2027', 100.00),
(38, 'Febrero', '2027', 100.00),
(39, 'Marzo', '2027', 100.00),
(40, 'Abril', '2027', 100.00),
(41, 'Mayo', '2027', 100.00),
(42, 'Junio', '2027', 100.00),
(43, 'Julio', '2027', 100.00),
(44, 'Agosto', '2027', 100.00),
(45, 'Septiembre', '2027', 100.00),
(46, 'Octubre', '2027', 100.00),
(47, 'Noviembre', '2027', 100.00),
(48, 'Diciembre', '2027', 100.00),
(49, 'Diciembre', '2028', 700.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_mensualidad`
--

CREATE TABLE `pago_mensualidad` (
  `id` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id_propietario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_mensualidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propietario`
--

INSERT INTO `propietario` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `nroCarnet`, `telefono`, `correo`, `nroDpto`, `id_usuario`) VALUES
(51, 'juan', 'pérez', 'garcía', '20000000', '67033811', 'juan.perez@example.com', 'A101', 1);

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
(1, 'juan', 'perez', 'mamani', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', '71234567', 'juan.perez@example.com', 'administrador', 1, '2024-10-23 12:51:37');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `pago_mensualidad`
--
ALTER TABLE `pago_mensualidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propietario`
--
ALTER TABLE `propietario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
