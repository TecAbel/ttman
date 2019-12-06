-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-12-2019 a las 00:55:42
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id10916570_grh_db`
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

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`num_actividad`, `nombre_act`, `num_usuario`) VALUES
(1, 'Revisión', 1),
(2, 'Turno especial', 2),
(3, 'Limpieza', 1),
(4, 'Servicio mensual', 1),
(5, 'servicio', 1),
(6, 'Preparativos', 1),
(7, 'Levantamiento', 1),
(8, 'Programacion', 1),
(9, 'Software', 1),
(10, 'Trueba y maquina', 10),
(11, 'TERMINAR MAQUINA 19930', 10);

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

--
-- Volcado de datos para la tabla `calculos`
--

INSERT INTO `calculos` (`num_cal`, `num_usuario`, `num_emp`, `num_actividad`, `fecha`, `hora_ent`, `hora_sal`, `horas_tra`, `descripcion`, `transporte`, `subtotal_cal`, `total_cal`) VALUES
(4, 2, 4, 2, '2019-09-17', '07:00:00', '14:00:00', 7, '', 40, 840, 880),
(12, 3, 5, 3, '2019-09-20', '10:00:00', '12:36:00', 3, 'maquina 5 y 6', 0, 240, 240),
(13, 3, 5, 5, '2019-09-19', '08:00:00', '15:00:00', 7, 'mauinas 2 y 4', 0, 560, 560),
(23, 1, 3, 4, '2019-10-04', '09:30:00', '10:30:00', 1, 'Servicio mensual de soporte y mantenimiento de equipo de cómputo - OCTUBRE', 0, 1300, 1300),
(43, 10, 7, 5, '2019-10-23', '10:00:00', '12:00:00', 2, 'Evaluar dos equipos para usar como servidor y hacerles check list', 30, 100, 130),
(44, 10, 7, 5, '2019-10-24', '10:00:00', '14:00:00', 4, 'Aprender a poner SSD y servicio completo a laptop Compaq y servicio completo a Toshiba (se puso también para reparación por calentamiento excesivo)', 40, 200, 240),
(50, 1, 1, 5, '2019-12-02', '11:20:00', '13:05:00', 2, 'Revisión semanal y atención a usuarios', 140, 140, 280);

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

--
-- Volcado de datos para la tabla `empleadores`
--

INSERT INTO `empleadores` (`num_emp`, `num_usuario`, `nombre_emp`, `nombre_emp_emp`, `correo_emp`, `tel_emp`, `num_empleado`, `rfc_emp`, `cuota`) VALUES
(1, 1, 'Carlos Sosa', 'Grupo Columbia', 'columbiacel@gmail.com', '5524004205', '', '', 70),
(2, 1, 'Alfredo Gutiérrez', '', 'ingjagm@gmail.com', '5521295126', '', '', 100),
(3, 1, 'Cristina', 'PAUEM', 'pauem753@hotmail.com', '70453051', '', '', 1300),
(4, 2, 'Carolina Cuevas', 'HGZ  La perla ', '', '', '2012050043', '', 120),
(5, 3, 'JUAN', 'EMPRESA', 'juanempresa@gmail.com', '55555555', '', '', 80),
(6, 1, 'Abelardo Aqui', 'Tecmobimex', 'tecmobimex@gmail.com', '5578444332', '', '', 120),
(7, 10, 'Carlos Sosa', 'Grupo Columbia', '', '', '', '', 50);

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
  `pase` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`num_usuario`, `correo`, `nombre_user`, `numero`, `rfc`, `pase`) VALUES
(1, 'abel1996abel@gmail.com', 'Abelardo Aqui Arroyo', '5578444332', NULL, '$2y$10$t.rzKT384BeUHoe8EdnX7.Vpr0Sct/SQvXdKOlBYsZIKelo4IuAUO'),
(2, 'dianaaragon1709@gmail.com', 'Aragón Alva Diana', '5560701087', NULL, '$2y$10$zGHqnMRn.pNSGhfQLteCBu/V7TBJ3zJFkD/CpGW4qLM6Enp809Qwu'),
(3, 'pablo@mail.com', 'Pablo Pruebas', '5555555555', NULL, '$2y$10$VHLwE/4ElEcStXRemvMD/.0JfkMCl5GTY7eCwXNQheUI6inV2JaWq'),
(9, 'abelardo96.work@gmail.com', 'Abelardo Aqui', '5578444332', NULL, '$2y$10$zj74SzbIP2iopdA/67mzeOTWz5JTX3AQ5AHn9YUFgzm.62DqT/ZQu'),
(10, 'anibalitoaqui@gmail.com', 'Jesus Anibal Aquí Arroyo', '5540833795', NULL, '$2y$10$l30cTQMewhq4eGJi5.1giOkz.LOcToRgSmXzHO1ZWlcJwklGUQYV.');

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
  MODIFY `num_actividad` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `calculos`
--
ALTER TABLE `calculos`
  MODIFY `num_cal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `empleadores`
--
ALTER TABLE `empleadores`
  MODIFY `num_emp` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `num_usuario` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
