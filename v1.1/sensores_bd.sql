-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-06-2023 a las 21:16:57
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sensores_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dato_mst`
--

DROP TABLE IF EXISTS `dato_mst`;
CREATE TABLE IF NOT EXISTS `dato_mst` (
  `dato_id` int NOT NULL AUTO_INCREMENT COMMENT 'Id del dato',
  `dato_val` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Valor que recoge el sensor.',
  `dato_tpo` timestamp NOT NULL COMMENT 'Tiempo de captura.',
  `dato_disp_id` int NOT NULL COMMENT 'Id del dispositivo en el que fue capturado.',
  PRIMARY KEY (`dato_id`),
  KEY `dato_mst_ibfk_1` (`dato_disp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21523 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disp_det`
--

DROP TABLE IF EXISTS `disp_det`;
CREATE TABLE IF NOT EXISTS `disp_det` (
  `disp_pto` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Puerto del dispositivo',
  `disp_pl_id` int NOT NULL COMMENT 'Placa a la que pertenece',
  `disp_disp_id` int NOT NULL COMMENT 'Dispositivo al que se le asigna el puerto',
  KEY `disp_det_ibfk_1` (`disp_disp_id`),
  KEY `disp_det_ibfk_2` (`disp_pl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `disp_det`
--

INSERT INTO `disp_det` (`disp_pto`, `disp_pl_id`, `disp_disp_id`) VALUES
('A0', 21, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disp_mst`
--

DROP TABLE IF EXISTS `disp_mst`;
CREATE TABLE IF NOT EXISTS `disp_mst` (
  `disp_id` int NOT NULL AUTO_INCREMENT COMMENT 'Id del dispositivo.',
  `disp_nom` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre del dispositivo.',
  `disp_dum_id` int NOT NULL COMMENT 'Unidad del dispositivo.',
  `disp_pl_id` int NOT NULL COMMENT 'Id de placa a la que pertenece el dispositivo.',
  `disp_disp_tipo_id` int NOT NULL COMMENT 'Id del tipo de dispositivo.',
  `disp_prod_id` int NOT NULL COMMENT 'Id del producto al que pertenece.',
  PRIMARY KEY (`disp_id`),
  KEY `disp_dum_id` (`disp_dum_id`),
  KEY `disp_mst_ibfk_3` (`disp_pl_id`),
  KEY `disp_mst_ibfk_4` (`disp_prod_id`),
  KEY `disp_mst_ibfk_5` (`disp_disp_tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `disp_mst`
--

INSERT INTO `disp_mst` (`disp_id`, `disp_nom`, `disp_dum_id`, `disp_pl_id`, `disp_disp_tipo_id`, `disp_prod_id`) VALUES
(24, 'Luz', 2, 21, 2, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disp_tipo_mst`
--

DROP TABLE IF EXISTS `disp_tipo_mst`;
CREATE TABLE IF NOT EXISTS `disp_tipo_mst` (
  `disp_tipo_id` int NOT NULL AUTO_INCREMENT COMMENT 'Id del tipo de dispositivo.',
  `disp_tipo_nom` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre del tipo de dispositivo.',
  `disp_tipo_desc` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Descripcion breve del dispositivo.',
  PRIMARY KEY (`disp_tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `disp_tipo_mst`
--

INSERT INTO `disp_tipo_mst` (`disp_tipo_id`, `disp_tipo_nom`, `disp_tipo_desc`) VALUES
(1, 'prueba', 'prueba'),
(2, 'Sensor', 'Detectan y responden a algún tipo de información del entorno físico. '),
(3, 'Actuador', 'Ayudan a realizar movimientos físicos convirtiendo la energía, por lo general, eléctrica, neumática o hidráulica, en fuerza mecánica.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dum_mst`
--

DROP TABLE IF EXISTS `dum_mst`;
CREATE TABLE IF NOT EXISTS `dum_mst` (
  `dum_id` int NOT NULL AUTO_INCREMENT,
  `dum_nom` varchar(75) NOT NULL,
  `dum_sigl` varchar(10) NOT NULL,
  PRIMARY KEY (`dum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `dum_mst`
--

INSERT INTO `dum_mst` (`dum_id`, `dum_nom`, `dum_sigl`) VALUES
(1, 'prueba', 'prueba'),
(2, 'Luz', '%'),
(3, 'Presencia', '*');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esp_det`
--

DROP TABLE IF EXISTS `esp_det`;
CREATE TABLE IF NOT EXISTS `esp_det` (
  `esp_id_` int NOT NULL AUTO_INCREMENT COMMENT 'Id externo',
  `esp_esp_id` int NOT NULL COMMENT 'Id del espacio',
  `esp_usr_id` int NOT NULL COMMENT 'Id del usuario al que se le asigno el espacio.',
  `esp_usrol_id` int NOT NULL COMMENT 'Rol del usuario',
  PRIMARY KEY (`esp_id_`),
  KEY `esp_esp_id` (`esp_esp_id`),
  KEY `esp_usr_id` (`esp_usr_id`),
  KEY `esp_det_ibfk_2` (`esp_usrol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `esp_det`
--

INSERT INTO `esp_det` (`esp_id_`, `esp_esp_id`, `esp_usr_id`, `esp_usrol_id`) VALUES
(73, 121, 2, 2),
(74, 121, 12, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esp_mst`
--

DROP TABLE IF EXISTS `esp_mst`;
CREATE TABLE IF NOT EXISTS `esp_mst` (
  `esp_id` int NOT NULL AUTO_INCREMENT COMMENT 'Id del espacio.',
  `esp_nom` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre del espacio.',
  `esp_desc` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Descripcion del espacio.',
  `esp_area` float NOT NULL COMMENT 'Área del espacio',
  `esp_geo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Ubicación geográfica ',
  `esp_esp_tipo_id` int NOT NULL COMMENT 'Id del tipo de espacio',
  `esp_crea` int NOT NULL COMMENT 'El usuario quien creo el espacio, esto con el fin de que unicamente el lo elimina.',
  PRIMARY KEY (`esp_id`),
  KEY `esp_esp_tipo_id` (`esp_esp_tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `esp_mst`
--

INSERT INTO `esp_mst` (`esp_id`, `esp_nom`, `esp_desc`, `esp_area`, `esp_geo`, `esp_esp_tipo_id`, `esp_crea`) VALUES
(121, 'Edificio Innovación', 'Edificio Innovación', 1, 'Pachuca (Prueba)', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esp_tipo_mst`
--

DROP TABLE IF EXISTS `esp_tipo_mst`;
CREATE TABLE IF NOT EXISTS `esp_tipo_mst` (
  `esp_tipo_id` int NOT NULL AUTO_INCREMENT COMMENT 'Id del tipo de espacio.',
  `esp_tipo_nom` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre del tipo de espacio.',
  `esp_tipo_desc` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Descripción breve del tipo de espacio.',
  PRIMARY KEY (`esp_tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `esp_tipo_mst`
--

INSERT INTO `esp_tipo_mst` (`esp_tipo_id`, `esp_tipo_nom`, `esp_tipo_desc`) VALUES
(1, 'Prueba', 'Prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pl_mst`
--

DROP TABLE IF EXISTS `pl_mst`;
CREATE TABLE IF NOT EXISTS `pl_mst` (
  `pl_id` int NOT NULL AUTO_INCREMENT COMMENT 'Id de placa.',
  `pl_nom` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre de la placa.',
  `pl_desc` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Descripción breve de la placa.',
  `pl_ip` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Dirección ip',
  `pl_prod_id` int NOT NULL COMMENT 'Producto al que pertenece.',
  PRIMARY KEY (`pl_id`),
  KEY `pl_mst_ibfk_1` (`pl_prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pl_mst`
--

INSERT INTO `pl_mst` (`pl_id`, `pl_nom`, `pl_desc`, `pl_ip`, `pl_prod_id`) VALUES
(21, 'ESP8266', 'ESP8266', '10.10.100.146', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prod_mst`
--

DROP TABLE IF EXISTS `prod_mst`;
CREATE TABLE IF NOT EXISTS `prod_mst` (
  `prod_id` int NOT NULL AUTO_INCREMENT,
  `prod_nom` varchar(75) NOT NULL,
  `prod_desc` varchar(300) NOT NULL,
  `prod_sec_id` int NOT NULL,
  PRIMARY KEY (`prod_id`),
  KEY `prod_mst_ibfk_1` (`prod_sec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `prod_mst`
--

INSERT INTO `prod_mst` (`prod_id`, `prod_nom`, `prod_desc`, `prod_sec_id`) VALUES
(22, 'Producto (Prueba)', 'Producto (Prueba)', 19),
(23, 'violetas', 'Violetas', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sec_mst`
--

DROP TABLE IF EXISTS `sec_mst`;
CREATE TABLE IF NOT EXISTS `sec_mst` (
  `sec_id` int NOT NULL AUTO_INCREMENT,
  `sec_nom` varchar(75) NOT NULL,
  `sec_desc` varchar(300) NOT NULL,
  `sec_esp_id` int NOT NULL,
  PRIMARY KEY (`sec_id`),
  KEY `sec_mst_ibfk_1` (`sec_esp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sec_mst`
--

INSERT INTO `sec_mst` (`sec_id`, `sec_nom`, `sec_desc`, `sec_esp_id`) VALUES
(19, 'Intellivation Techologies', 'Intellivation Techologies', 121),
(20, 'Colegio del Estado de Hidalgo', 'Colegio del Estado de Hidalgo', 121);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usrol_mst`
--

DROP TABLE IF EXISTS `usrol_mst`;
CREATE TABLE IF NOT EXISTS `usrol_mst` (
  `usrol_id` int NOT NULL AUTO_INCREMENT COMMENT 'Id de rol de usuarios.',
  `usrol_nom` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre del rol.',
  `usrol_desc` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Descripción del rol.',
  `usrol_gral_lec` int NOT NULL COMMENT 'Lectura de manera general.',
  `usrol_gral_esc` int NOT NULL COMMENT 'Escritura de manera general.',
  `usrol_esp_lec` int NOT NULL COMMENT 'Lectura de los espacios.',
  `usrol_esp_esc` int NOT NULL COMMENT 'Lectura de los espacios.',
  `usrol_sec_lec` int NOT NULL COMMENT 'Lectura de los secciones.',
  `usrol_sec_esc` int NOT NULL COMMENT 'Escritura de las secciones.',
  `usrol_prod_lec` int NOT NULL COMMENT 'Lectura de productos',
  `usrol_prod_esc` int NOT NULL COMMENT 'Escritura de productos',
  `usrol_disp_lec` int NOT NULL COMMENT 'Lectura de los dispositivos.',
  `usrol_disp_esc` int NOT NULL COMMENT 'Escritura de los dispositivos.',
  PRIMARY KEY (`usrol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usrol_mst`
--

INSERT INTO `usrol_mst` (`usrol_id`, `usrol_nom`, `usrol_desc`, `usrol_gral_lec`, `usrol_gral_esc`, `usrol_esp_lec`, `usrol_esp_esc`, `usrol_sec_lec`, `usrol_sec_esc`, `usrol_prod_lec`, `usrol_prod_esc`, `usrol_disp_lec`, `usrol_disp_esc`) VALUES
(1, 'Sistemas', 'Administra usuarios con rol de administrador', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'Administrador', 'Todos los privilegios', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 'Secciones y Productos', 'Puede agregar, modificar, visualizar secciones y productos, dispositivos, monitorear.', 0, 0, 0, 0, 1, 1, 1, 1, 0, 0),
(5, 'Usuario', 'Unicamente puede visualizar el monitoreo de secciones', 0, 0, 1, 0, 1, 0, 1, 0, 0, 0),
(8, 'Dispositivos', 'Dispositivos', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1),
(9, 'Hackers', 'Hackers', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr_det`
--

DROP TABLE IF EXISTS `usr_det`;
CREATE TABLE IF NOT EXISTS `usr_det` (
  `usr_usr_id` int NOT NULL COMMENT 'Id del usuario',
  `usr_admin` int NOT NULL COMMENT 'Administrador de la plataforma',
  KEY `usr_usr_id` (`usr_usr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usr_det`
--

INSERT INTO `usr_det` (`usr_usr_id`, `usr_admin`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr_mst`
--

DROP TABLE IF EXISTS `usr_mst`;
CREATE TABLE IF NOT EXISTS `usr_mst` (
  `usr_id` int NOT NULL AUTO_INCREMENT COMMENT 'Id de control de usuario.',
  `usr_usu` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Id de usuario.',
  `usr_nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre del usuario.',
  `usr_con` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Clave de acceso.',
  `usr_sistema` int NOT NULL COMMENT 'Determina si es administrador de sistemas por defecto. S = 1: N = 0',
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usr_mst`
--

INSERT INTO `usr_mst` (`usr_id`, `usr_usu`, `usr_nom`, `usr_con`, `usr_sistema`) VALUES
(1, 'admin', 'Administrador de sistemas', '$2y$10$85zvkq4ZLXJTKwjG8gFDU.IrRRHLlFaiOImto39evj1jvvTzA2z46', 1),
(2, 'migrzam7', 'Miguel Ruiz Zamora', '$2y$10$2QxcWuRRByu2RyUP/kC2oOjixfB4J27Db5Ybx1tBbbXRk0N28IgS.', 0),
(12, 'sarai', 'Sarai Mendoza Martin', '$2y$10$J8tloK2o1rtePgDWpPyRBurQomTy8mthjPQrA2nDT3Fkl3UG2aw0G', 0),
(13, 'asanchez', 'Diana Alejandra Sánchez Angeles', '$2y$10$dRNHd6AXWqUhCvuPog2w2eXmYNWsolOn6299LUZHATUVNDuWtnejG', 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dato_mst`
--
ALTER TABLE `dato_mst`
  ADD CONSTRAINT `dato_mst_ibfk_1` FOREIGN KEY (`dato_disp_id`) REFERENCES `disp_mst` (`disp_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `disp_det`
--
ALTER TABLE `disp_det`
  ADD CONSTRAINT `disp_det_ibfk_1` FOREIGN KEY (`disp_disp_id`) REFERENCES `disp_mst` (`disp_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `disp_det_ibfk_2` FOREIGN KEY (`disp_pl_id`) REFERENCES `pl_mst` (`pl_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `disp_mst`
--
ALTER TABLE `disp_mst`
  ADD CONSTRAINT `disp_mst_ibfk_2` FOREIGN KEY (`disp_dum_id`) REFERENCES `dum_mst` (`dum_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `disp_mst_ibfk_3` FOREIGN KEY (`disp_pl_id`) REFERENCES `pl_mst` (`pl_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `disp_mst_ibfk_4` FOREIGN KEY (`disp_prod_id`) REFERENCES `prod_mst` (`prod_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `disp_mst_ibfk_5` FOREIGN KEY (`disp_disp_tipo_id`) REFERENCES `disp_tipo_mst` (`disp_tipo_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `esp_det`
--
ALTER TABLE `esp_det`
  ADD CONSTRAINT `esp_det_ibfk_1` FOREIGN KEY (`esp_esp_id`) REFERENCES `esp_mst` (`esp_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `esp_det_ibfk_2` FOREIGN KEY (`esp_usrol_id`) REFERENCES `usrol_mst` (`usrol_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `esp_det_ibfk_3` FOREIGN KEY (`esp_usr_id`) REFERENCES `usr_mst` (`usr_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `esp_mst`
--
ALTER TABLE `esp_mst`
  ADD CONSTRAINT `esp_mst_ibfk_1` FOREIGN KEY (`esp_esp_tipo_id`) REFERENCES `esp_tipo_mst` (`esp_tipo_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `pl_mst`
--
ALTER TABLE `pl_mst`
  ADD CONSTRAINT `pl_mst_ibfk_1` FOREIGN KEY (`pl_prod_id`) REFERENCES `prod_mst` (`prod_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `prod_mst`
--
ALTER TABLE `prod_mst`
  ADD CONSTRAINT `prod_mst_ibfk_1` FOREIGN KEY (`prod_sec_id`) REFERENCES `sec_mst` (`sec_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `sec_mst`
--
ALTER TABLE `sec_mst`
  ADD CONSTRAINT `sec_mst_ibfk_1` FOREIGN KEY (`sec_esp_id`) REFERENCES `esp_mst` (`esp_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `usr_det`
--
ALTER TABLE `usr_det`
  ADD CONSTRAINT `usr_det_ibfk_1` FOREIGN KEY (`usr_usr_id`) REFERENCES `usr_mst` (`usr_id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
