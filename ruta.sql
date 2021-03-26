-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2021 a las 18:33:38
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemcont_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE IF NOT EXISTS `ruta` (
  `IDRUTA` int(11) NOT NULL,
  `DESCRIPCION` varchar(60) NOT NULL,
  `FECHASISTEMA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CODIGOUNICO` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`IDRUTA`, `DESCRIPCION`, `FECHASISTEMA`, `CODIGOUNICO`) VALUES
(1, 'REYES', '2021-03-16 00:00:00', '-'),
(2, 'RURRE', '2021-03-16 00:00:00', '-'),
(3, 'YUCUMO', '2021-03-16 00:00:00', '-'),
(4, 'QUIQUIVEY', '2021-03-16 00:00:00', '-'),
(5, 'SILLAR', '2021-03-16 00:00:00', '-'),
(6, 'CASCADA', '2021-03-16 00:00:00', '-'),
(7, 'INICUA', '2021-03-16 00:00:00', '-'),
(8, 'CARAL', '2021-03-16 00:00:00', '-'),
(9, 'SAN BORJA', '2021-03-16 00:00:00', '-'),
(10, 'TRINIDAD', '2021-03-16 00:00:00', '-'),
(11, 'GUAYARA', '2021-03-16 00:00:00', '-'),
(12, 'REBERALTA', '2021-03-16 00:00:00', '-'),
(13, 'TRIANGULO', '2021-03-16 00:00:00', '-'),
(14, 'AUSTRALIA', '2021-03-16 00:00:00', '-'),
(15, 'PUERTO YATA', '2021-03-16 00:00:00', '-'),
(16, 'SANTA ROSA', '2021-03-16 00:00:00', '-'),
(17, 'COBIJA', '2021-03-16 00:00:00', '-'),
(18, 'PORVENIR', '2021-03-16 00:00:00', '-'),
(19, 'PTO RICO', '2021-03-16 00:00:00', '-'),
(20, 'PTO CENA', '2021-03-16 00:00:00', '-'),
(21, 'PTO PEÑA', '2021-03-16 00:00:00', '-'),
(22, 'IXIAMAS', '2021-03-16 00:00:00', '-'),
(23, 'TUMUPASA', '2021-03-16 00:00:00', '-'),
(24, 'SAN BUENA', '2021-03-16 00:00:00', '-');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`IDRUTA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `IDRUTA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
