-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2015 a las 22:18:32
-- Versión del servidor: 5.5.36
-- Versión de PHP: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `foro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categorias` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `titulo_categoria` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_categorias`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categorias`, `titulo_categoria`) VALUES
(1, 'Food Items'),
(2, 'Games'),
(3, 'Lenguajes de Programacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `replies`
--

CREATE TABLE IF NOT EXISTS `replies` (
  `id_reply` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `id_categorias` int(3) unsigned NOT NULL,
  `id_subcat` int(3) unsigned NOT NULL,
  `id_topico` int(3) unsigned NOT NULL,
  `autor` varchar(16) NOT NULL,
  `comentario` text NOT NULL,
  `fecha_posteo` date NOT NULL,
  PRIMARY KEY (`id_reply`),
  KEY `id_categorias` (`id_categorias`,`id_subcat`,`id_topico`),
  KEY `id_subcat` (`id_subcat`),
  KEY `id_topico` (`id_topico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id_subcat` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(3) unsigned NOT NULL,
  `subcategoria_titulo` varchar(128) DEFAULT NULL,
  `subcategoria_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_subcat`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id_subcat`, `parent_id`, `subcategoria_titulo`, `subcategoria_desc`) VALUES
(1, 1, 'Comida China', 'pollo mongoliano'),
(2, 1, 'Comida Italiana', 'lasaña, canelones, pasta, pizza'),
(3, 1, 'Comida Japonesa', 'sushi envuelto en tempura, palta, queso crema'),
(4, 2, 'Starcraft 2', 'juego para nerds'),
(5, 2, 'League of Leyends', 'juego para personas aun mas nerds'),
(6, 3, 'PHP', 'PHP: Hypertext Preprocessor'),
(7, 3, 'HTML5', 'HyperText Markup Language');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topicos`
--

CREATE TABLE IF NOT EXISTS `topicos` (
  `id_topico` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `id_categoria` int(3) unsigned NOT NULL,
  `id_subcategoria` int(3) unsigned NOT NULL,
  `autor` varchar(16) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `contenido` text NOT NULL,
  `fecha_posteo` date NOT NULL,
  `vistas` int(5) unsigned NOT NULL,
  `replies` int(3) unsigned NOT NULL,
  PRIMARY KEY (`id_topico`),
  KEY `categoria_id` (`id_categoria`,`id_subcategoria`),
  KEY `id_subcat` (`id_subcategoria`),
  KEY `id_categorias` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `topicos`
--

INSERT INTO `topicos` (`id_topico`, `id_categoria`, `id_subcategoria`, `autor`, `titulo`, `contenido`, `fecha_posteo`, `vistas`, `replies`) VALUES
(1, 1, 1, 'usuario1', 'test de topico 1', 'test de contenido', '2015-12-02', 0, 0),
(2, 1, 1, 'usuario1', 'test de topico 2', 'test de contenido numero 2', '2015-12-02', 0, 0),
(3, 1, 1, 'usuario1', 'test de topico 3', 'ultimo test de contenido', '2015-12-02', 3, 0),
(4, 1, 2, 'usuario1', 'prueba1', 'sadasdasd', '2015-12-02', 0, 0),
(5, 1, 2, 'usuario1', 'asdasd', 'asdasd', '2015-12-10', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuarios` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(16) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_usuarios`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre_usuario`, `password`) VALUES
(1, 'usuario2', '12334'),
(2, 'usuario1', '1234');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_3` FOREIGN KEY (`id_topico`) REFERENCES `topicos` (`id_topico`),
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`id_categorias`) REFERENCES `categorias` (`id_categorias`),
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`id_subcat`) REFERENCES `subcategorias` (`id_subcat`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categorias` (`id_categorias`);

--
-- Filtros para la tabla `topicos`
--
ALTER TABLE `topicos`
  ADD CONSTRAINT `topicos_ibfk_2` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id_subcat`),
  ADD CONSTRAINT `topicos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categorias`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
