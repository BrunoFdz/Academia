-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2021 a las 16:47:38
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `academia`
--

CREATE DATABASE IF NOT EXISTS `academia`;
USE `academia`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `profesor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `profesor_id`) VALUES
(1, 'Curso de java', 12),
(2, 'Curso de ofimática', 3),
(3, 'Curso de javascript', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_alumno`
--

CREATE TABLE `curso_alumno` (
  `alumno_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso_alumno`
--

INSERT INTO `curso_alumno` (`alumno_id`, `curso_id`) VALUES
(1, 1),
(1, 3),
(5, 3),
(37, 1),
(37, 2),
(42, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `correo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellidos`, `correo`) VALUES
(1, 'Laura', 'López García', 'laura@gmail.com'),
(2, 'Pedro', 'Freire Carballeira', 'pedro@gmail.com'),
(3, 'Ana', 'Ramos Morais', 'ana@gmail.com'),
(5, 'Pepe', 'Dopico Couce', 'pepe@gmail.com'),
(12, 'Luis', 'López Remiro', 'luis@gmail.com'),
(37, 'Maria', 'Couce Freire', 'maria@gmail.com'),
(41, 'Miguel', 'Romero López', 'miguel@gmail.com'),
(42, 'Paula', 'Fernández Ramírez', 'paula@gmail.com'),
(43, 'Bruno', 'Fernández Couce', 'bruno@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo_mime` varchar(50) NOT NULL,
  `tema_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `nombre`, `tipo_mime`, `tema_id`) VALUES
(11, 'fundamentosdejava.pdf', 'application/pdf', 1),
(18, 'Outlook.txt', 'text/plain', 2),
(19, 'Lenguaje-de-programacion-JavaScript-1.pdf', 'application/pdf', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id`, `titulo`, `descripcion`, `curso_id`) VALUES
(1, 'Fundamentos de Java', 'En este curso de fundamentos de Java usted aprenderá lo siguiente:\r\nComprender los principios fundamentales de la programación orientada a objetos\r\nCrear, compilar y ejecutar un programa Java simple\r\n', 1),
(2, 'Outlook', 'Contenido CURSO: OUTLOOK 2016\r\n1 – conceptos básicos\r\n2 – personas\r\n3 – el correo electrónico\r\n4 – el calendario\r\n5 – tareas y notas\r\n6 – el diario y accesos directos', 2),
(3, 'Introducción a Javascript', '1. Características de Javascript.\r\n2. Sintaxis.\r\n3. Tipos de datos. \r\n4. Variables y operadores.\r\n5. Sentencias condicionales', 3),
(4, 'Objetos predefinidos', '1. Objetos predefinidos.\r\n2. Objetos relacionados con el navegador.\r\n3. Generación de html y ventanas.', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `password`, `rol`) VALUES
(1, 'lauralg', '$2y$10$e1Px/.x0r6HMkyFqNcB1c.jJxeyPmzH8MWQY6udiAxlOAW7Xst82m', 'alumno'),
(2, 'pedrofc', '$2y$10$9Flwa9at1iwAOBFL1SOKZO5dHylGokjKz/cYleQB4.Y0OuJHyLxFm', 'profesor'),
(3, 'anarm', '$2y$10$kLn9bRuwPhmNJLMG6rs1seBFtwx1UCkrwDeuYLGWqVfd6lWU3Bi1K', 'profesor'),
(5, 'pepedc', '$2y$10$.kCVWpmgmA4zA3VYpWGE1OIPmCTXQO1wI/2SnNm0VwllASXdmgFh.', 'alumno'),
(12, 'luislr', '$2y$10$SeWpdiVOI5oXsFJpfWrnI.uXoBIFykG1hPAc.JzTvTAvhgGb0Eio.', 'profesor'),
(37, 'mariapp', '$2y$10$kLYPeeF9rVVUq1tf2w.MKupVsUaQ9JLPHkJlhOCCxqfEkr1abNrW6', 'alumno'),
(41, 'miguelrl', '$2y$10$YxzIRx8Xi1L51Ja7jlQQIOPfNKVw3BRvCD2RAr3pyV2ZNxQo1hvP.', 'administrador'),
(42, 'paulafr', '$2y$10$ozAFOPvrAWdPIGw5owd8AOFYyIj4g0egkiQ/kwJX2EQkVAdGV/zom', 'alumno'),
(43, 'brunofc', '$2y$10$RaceVrBmuNkGEdB2yoniieAU7IQB5ugA7z/.nTCFdYRNjBQ6BXHJy', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cursos_personas1_idx` (`profesor_id`);

--
-- Indices de la tabla `curso_alumno`
--
ALTER TABLE `curso_alumno`
  ADD PRIMARY KEY (`alumno_id`,`curso_id`),
  ADD KEY `fk_personas_has_cursos_cursos1_idx` (`curso_id`),
  ADD KEY `fk_personas_has_cursos_personas1_idx` (`alumno_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recursos_temas1_idx` (`tema_id`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_temas_cursos1_idx` (`curso_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_UNIQUE` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_cursos_personas1` FOREIGN KEY (`profesor_id`) REFERENCES `personas` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `curso_alumno`
--
ALTER TABLE `curso_alumno`
  ADD CONSTRAINT `fk_personas_has_cursos_cursos1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_personas_has_cursos_personas1` FOREIGN KEY (`alumno_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD CONSTRAINT `FK_REC_TEM` FOREIGN KEY (`tema_id`) REFERENCES `temas` (`id`);

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `fk_temas_cursos1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_personas` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
