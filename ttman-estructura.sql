-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-01-2020 a las 21:31:15
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ttman`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `num_actividad` int(8) NOT NULL,
  `nombre_act` char(30) NOT NULL,
  `num_usuario` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calculos`
--

CREATE TABLE `calculos` (
  `num_cal` int(10) NOT NULL,
  `num_usuario` int(8) NOT NULL,
  `num_emp` int(8) NOT NULL,
  `num_actividad` int(8) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora_ent` time DEFAULT NULL,
  `hora_sal` time DEFAULT NULL,
  `horas_tra` int(11) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `transporte` double DEFAULT NULL,
  `subtotal_cal` double DEFAULT NULL,
  `total_cal` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleadores`
--

CREATE TABLE `empleadores` (
  `num_emp` int(8) NOT NULL,
  `num_usuario` int(8) NOT NULL,
  `nombre_emp` char(40) NOT NULL,
  `nombre_emp_emp` varchar(50) DEFAULT NULL,
  `correo_emp` char(40) DEFAULT NULL,
  `tel_emp` char(10) DEFAULT NULL,
  `num_empleado` char(20) DEFAULT NULL,
  `rfc_emp` char(13) DEFAULT NULL,
  `cuota` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id_reporte` int(8) NOT NULL,
  `num_usuario` int(8) NOT NULL,
  `url_reporte` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `num_emp` int(8) NOT NULL,
  `reporte_detalle` json NOT NULL,
  `reporte_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `num_usuario` int(8) NOT NULL,
  `correo` char(40) NOT NULL,
  `nombre_user` char(40) NOT NULL,
  `numero` char(10) NOT NULL,
  `rfc` char(13) DEFAULT NULL,
  `clabe` char(18) DEFAULT NULL,
  `banco` char(20) DEFAULT NULL,
  `pase` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`num_actividad`),
  ADD UNIQUE KEY `num_actividad` (`num_actividad`),
  ADD KEY `act_usuarios_idx` (`num_usuario`);

--
-- Indices de la tabla `calculos`
--
ALTER TABLE `calculos`
  ADD PRIMARY KEY (`num_cal`),
  ADD UNIQUE KEY `num_cal` (`num_cal`),
  ADD KEY `num_usuario` (`num_usuario`),
  ADD KEY `num_emp` (`num_emp`),
  ADD KEY `num_actividad` (`num_actividad`);

--
-- Indices de la tabla `empleadores`
--
ALTER TABLE `empleadores`
  ADD PRIMARY KEY (`num_emp`),
  ADD UNIQUE KEY `num_emp` (`num_emp`),
  ADD KEY `num_usuario` (`num_usuario`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `num_usuario` (`num_usuario`),
  ADD KEY `id_emp` (`num_emp`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`num_usuario`),
  ADD UNIQUE KEY `num_usuario` (`num_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `num_actividad` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calculos`
--
ALTER TABLE `calculos`
  MODIFY `num_cal` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleadores`
--
ALTER TABLE `empleadores`
  MODIFY `num_emp` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_reporte` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `num_usuario` int(8) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `act_usuarios` FOREIGN KEY (`num_usuario`) REFERENCES `usuarios` (`num_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `calculos`
--
ALTER TABLE `calculos`
  ADD CONSTRAINT `calculos_ibfk_1` FOREIGN KEY (`num_usuario`) REFERENCES `usuarios` (`num_usuario`),
  ADD CONSTRAINT `calculos_ibfk_2` FOREIGN KEY (`num_emp`) REFERENCES `empleadores` (`num_emp`),
  ADD CONSTRAINT `calculos_ibfk_3` FOREIGN KEY (`num_actividad`) REFERENCES `actividades` (`num_actividad`);

--
-- Filtros para la tabla `empleadores`
--
ALTER TABLE `empleadores`
  ADD CONSTRAINT `empleadores_ibfk_1` FOREIGN KEY (`num_usuario`) REFERENCES `usuarios` (`num_usuario`);

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`num_usuario`) REFERENCES `usuarios` (`num_usuario`),
  ADD CONSTRAINT `reportes_ibfk_2` FOREIGN KEY (`num_emp`) REFERENCES `empleadores` (`num_emp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
