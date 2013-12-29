-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2013 at 10:16 
-- Server version: 5.6.12
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cp-db`
--
CREATE DATABASE IF NOT EXISTS `cp-db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cp-db`;

-- --------------------------------------------------------

--
-- Table structure for table `Cursos`
--

CREATE TABLE IF NOT EXISTS `Cursos` (
  `idCurso` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `curso` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(100) DEFAULT 'image-default.jpg',
  `videoPresentacion` varchar(200) DEFAULT NULL,
  `conocimientosNecesarios` mediumtext,
  `fechaInicio` date NOT NULL,
  `Tematicas_idTematica` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`idCurso`),
  UNIQUE KEY `curso_UNIQUE` (`curso`),
  KEY `fk_Cursos_Tematicas1_idx` (`Tematicas_idTematica`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Cursos`
--

INSERT INTO `Cursos` (`idCurso`, `curso`, `descripcion`, `imagen`, `videoPresentacion`, `conocimientosNecesarios`, `fechaInicio`, `Tematicas_idTematica`) VALUES
(1, 'Programación de Aplicaciones Android', 'Los dispositivos móviles están transformando la forma en que las personas se comunican. Se han convirtiendo en el nuevo ordenador personal del siglo XXI. Android es la plataforma libre para el desarrollo de aplicaciones móviles desarrollada por Google. Esta plataforma está ampliando su rango de influencia a sistemas empotrados, tabletas o Smart TV. Este curso pretende ser una guía para introducirse en la programación en Android. Todos los conceptos son descritos por medio de ejemplos, aumentando su nivel de complejidad a medida que avanzan los módulos. A lo largo del curso se desarrolla una aplicación de ejemplo, el mítico videojuego Asteroides. Comienza con una versión sencilla, que se irá completando para que incluya, gráficos, pantalla táctil y sensores, geo-localización, multimedia, XML, SQL, Internet, servicios Web…', 'curso-android.jpg', 'PPsVy0nDOR8', 'Buen nivel de programación. Se recomienda conocimientos de algún lenguaje orientado a objetos. Especialmente si se trata de Java.', '2013-10-30', 2),
(2, 'Programación de Aplicaciones Android 2', 'Los dispositivos móviles están transformando la forma en que las personas se comunican. Se han convirtiendo en el nuevo ordenador personal del siglo XXI. Android es la plataforma libre para el desarrollo de aplicaciones móviles desarrollada por Google. Esta plataforma está ampliando su rango de influencia a sistemas empotrados, tabletas o Smart TV. Este curso pretende ser una guía para introducirse en la programación en Android. Todos los conceptos son descritos por medio de ejemplos, aumentando su nivel de complejidad a medida que avanzan los módulos. A lo largo del curso se desarrolla una aplicación de ejemplo, el mítico videojuego Asteroides. Comienza con una versión sencilla, que se irá completando para que incluya, gráficos, pantalla táctil y sensores, geo-localización, multimedia, XML, SQL, Internet, servicios Web…', 'image-default.jpg', 'PPsVy0nDOR8', 'Buen nivel de programación. Se recomienda conocimientos de algún lenguaje orientado a objetos. Especialmente si se trata de Java.', '2013-10-30', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Cursos_has_Instituciones`
--

CREATE TABLE IF NOT EXISTS `Cursos_has_Instituciones` (
  `Cursos_idCurso` smallint(5) unsigned NOT NULL,
  `Instituciones_idInstitucion` tinyint(3) unsigned NOT NULL,
  `Profesores_Usuarios_idUsuario` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`Cursos_idCurso`,`Instituciones_idInstitucion`,`Profesores_Usuarios_idUsuario`),
  KEY `fk_Cursos_has_Instituciones_Instituciones1_idx` (`Instituciones_idInstitucion`),
  KEY `fk_Cursos_has_Instituciones_Cursos1_idx` (`Cursos_idCurso`),
  KEY `fk_Cursos_has_Instituciones_Profesores1_idx` (`Profesores_Usuarios_idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Cursos_has_Instituciones`
--

INSERT INTO `Cursos_has_Instituciones` (`Cursos_idCurso`, `Instituciones_idInstitucion`, `Profesores_Usuarios_idUsuario`) VALUES
(1, 1, 1),
(1, 2, 2),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Cursos_has_Usuarios`
--

CREATE TABLE IF NOT EXISTS `Cursos_has_Usuarios` (
  `Cursos_idCurso` smallint(5) unsigned NOT NULL,
  `Usuarios_idUsuario` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`Cursos_idCurso`,`Usuarios_idUsuario`),
  KEY `fk_Cursos_has_Usuarios_Usuarios1_idx` (`Usuarios_idUsuario`),
  KEY `fk_Cursos_has_Usuarios_Cursos1_idx` (`Cursos_idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Cursos_has_Usuarios`
--

INSERT INTO `Cursos_has_Usuarios` (`Cursos_idCurso`, `Usuarios_idUsuario`) VALUES
(1, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Instituciones`
--

CREATE TABLE IF NOT EXISTS `Instituciones` (
  `idInstitucion` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `institucion` varchar(80) NOT NULL,
  `descripcionInstitucion` text,
  `webInstitucion` varchar(200) DEFAULT NULL,
  `logo` varchar(45) NOT NULL DEFAULT 'image-default.jpg',
  PRIMARY KEY (`idInstitucion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Instituciones`
--

INSERT INTO `Instituciones` (`idInstitucion`, `institucion`, `descripcionInstitucion`, `webInstitucion`, `logo`) VALUES
(1, 'Universidad Americana', NULL, NULL, 'universidad-americana.jpg'),
(2, 'Universidad Columbia', NULL, NULL, 'image-default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Instituciones_has_Profesores`
--

CREATE TABLE IF NOT EXISTS `Instituciones_has_Profesores` (
  `Instituciones_idInstitucion` tinyint(3) unsigned NOT NULL,
  `Profesores_Usuarios_idUsuario` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`Instituciones_idInstitucion`,`Profesores_Usuarios_idUsuario`),
  KEY `fk_Instituciones_has_Profesores_Profesores1_idx` (`Profesores_Usuarios_idUsuario`),
  KEY `fk_Instituciones_has_Profesores_Instituciones1_idx` (`Instituciones_idInstitucion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Modulos`
--

CREATE TABLE IF NOT EXISTS `Modulos` (
  `idModulo` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `modulo` varchar(100) NOT NULL,
  `numeroModulo` tinyint(3) unsigned NOT NULL,
  `Cursos_idCurso` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`idModulo`),
  KEY `fk_Modulos_Cursos_idx` (`Cursos_idCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Modulos`
--

INSERT INTO `Modulos` (`idModulo`, `modulo`, `numeroModulo`, `Cursos_idCurso`) VALUES
(1, 'Visión general y entorno de desarrollo', 1, 1),
(2, 'Diseño de la interfaz de usuario: Vistas y Layouts', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Profesores`
--

CREATE TABLE IF NOT EXISTS `Profesores` (
  `Usuarios_idUsuario` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`Usuarios_idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Profesores`
--

INSERT INTO `Profesores` (`Usuarios_idUsuario`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `Secciones`
--

CREATE TABLE IF NOT EXISTS `Secciones` (
  `idSeccion` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `seccion` varchar(100) NOT NULL,
  `contenido` text NOT NULL,
  `Modulos_idModulo` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`idSeccion`),
  KEY `fk_Secciones_Modulos1_idx` (`Modulos_idModulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Tematicas`
--

CREATE TABLE IF NOT EXISTS `Tematicas` (
  `idTematica` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `tematica` varchar(100) NOT NULL,
  PRIMARY KEY (`idTematica`),
  UNIQUE KEY `tematica_UNIQUE` (`tematica`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Tematicas`
--

INSERT INTO `Tematicas` (`idTematica`, `tematica`) VALUES
(1, 'Biología'),
(2, 'Ciencias Computacionales y Tecnología');

-- --------------------------------------------------------

--
-- Table structure for table `TiposUsuarios`
--

CREATE TABLE IF NOT EXISTS `TiposUsuarios` (
  `idTipoUsuario` tinyint(3) unsigned NOT NULL,
  `tipoUsuario` varchar(45) NOT NULL,
  PRIMARY KEY (`idTipoUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TiposUsuarios`
--

INSERT INTO `TiposUsuarios` (`idTipoUsuario`, `tipoUsuario`) VALUES
(1, 'Usuario'),
(2, 'Profesor');

-- --------------------------------------------------------

--
-- Table structure for table `Usuarios`
--

CREATE TABLE IF NOT EXISTS `Usuarios` (
  `idUsuario` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(200) NOT NULL,
  `correoUsuario` varchar(100) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `avatar` varchar(45) DEFAULT 'image-default.png',
  `TiposUsuarios_idTipoUsuario` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `correoUsuario_UNIQUE` (`correoUsuario`),
  KEY `fk_Usuarios_TiposUsuarios1_idx` (`TiposUsuarios_idTipoUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Usuarios`
--

INSERT INTO `Usuarios` (`idUsuario`, `nombreUsuario`, `correoUsuario`, `pass`, `avatar`, `TiposUsuarios_idTipoUsuario`) VALUES
(1, 'Getulio Valentin Sánchez', 'valentins2507@aol.com', '123', 'image-default.png', 2),
(2, 'Agustin Pio Barrios', 'agustin@hotmail.com', '123', 'image-default.png', 2),
(3, 'Marcos Valdez', 'marcosma@cat.com', '123', 'image-default.png', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cursos`
--
ALTER TABLE `Cursos`
  ADD CONSTRAINT `fk_Cursos_Tematicas1` FOREIGN KEY (`Tematicas_idTematica`) REFERENCES `Tematicas` (`idTematica`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Cursos_has_Instituciones`
--
ALTER TABLE `Cursos_has_Instituciones`
  ADD CONSTRAINT `fk_Cursos_has_Instituciones_Cursos1` FOREIGN KEY (`Cursos_idCurso`) REFERENCES `Cursos` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cursos_has_Instituciones_Instituciones1` FOREIGN KEY (`Instituciones_idInstitucion`) REFERENCES `Instituciones` (`idInstitucion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cursos_has_Instituciones_Profesores1` FOREIGN KEY (`Profesores_Usuarios_idUsuario`) REFERENCES `Profesores` (`Usuarios_idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Cursos_has_Usuarios`
--
ALTER TABLE `Cursos_has_Usuarios`
  ADD CONSTRAINT `fk_Cursos_has_Usuarios_Cursos1` FOREIGN KEY (`Cursos_idCurso`) REFERENCES `Cursos` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cursos_has_Usuarios_Usuarios1` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `Usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Instituciones_has_Profesores`
--
ALTER TABLE `Instituciones_has_Profesores`
  ADD CONSTRAINT `fk_Instituciones_has_Profesores_Instituciones1` FOREIGN KEY (`Instituciones_idInstitucion`) REFERENCES `Instituciones` (`idInstitucion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Instituciones_has_Profesores_Profesores1` FOREIGN KEY (`Profesores_Usuarios_idUsuario`) REFERENCES `Profesores` (`Usuarios_idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Modulos`
--
ALTER TABLE `Modulos`
  ADD CONSTRAINT `fk_Modulos_Cursos` FOREIGN KEY (`Cursos_idCurso`) REFERENCES `Cursos` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Profesores`
--
ALTER TABLE `Profesores`
  ADD CONSTRAINT `fk_Profesores_Usuarios1` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `Usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Secciones`
--
ALTER TABLE `Secciones`
  ADD CONSTRAINT `fk_Secciones_Modulos1` FOREIGN KEY (`Modulos_idModulo`) REFERENCES `Modulos` (`idModulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `fk_Usuarios_TiposUsuarios1` FOREIGN KEY (`TiposUsuarios_idTipoUsuario`) REFERENCES `TiposUsuarios` (`idTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
