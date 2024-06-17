-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.3.0 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bdblog
CREATE DATABASE IF NOT EXISTS `bdblog` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bdblog`;

-- Volcando estructura para tabla bdblog.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `IDCAT` int NOT NULL AUTO_INCREMENT,
  `NOMBRECAT` varchar(40) NOT NULL,
  PRIMARY KEY (`IDCAT`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla bdblog.categorias: ~10 rows (aproximadamente)
DELETE FROM `categorias`;
INSERT INTO `categorias` (`IDCAT`, `NOMBRECAT`) VALUES
	(1, 'Lácteos'),
	(2, 'Carnes'),
	(24, 'Frutas y Verduras'),
	(25, 'Bebidas'),
	(30, 'Panadería'),
	(31, 'Aperitivos'),
	(32, 'Cereales'),
	(33, 'Limpieza'),
	(34, 'Higiene Personal'),
	(35, 'Congelados');

-- Volcando estructura para tabla bdblog.entradas
CREATE TABLE IF NOT EXISTS `entradas` (
  `IDENT` int NOT NULL AUTO_INCREMENT,
  `IDUSUARIO` int NOT NULL,
  `IDCATEGORIA` int NOT NULL,
  `TITULO` varchar(40) NOT NULL,
  `IMAGEN` varchar(40) NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDENT`),
  KEY `IDUSUARIO` (`IDUSUARIO`),
  KEY `IDCATEGORIA` (`IDCATEGORIA`),
  CONSTRAINT `ENTRADAS_IBFK_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuarios` (`IDUSER`) ON UPDATE CASCADE,
  CONSTRAINT `ENTRADAS_IBFK_2` FOREIGN KEY (`IDCATEGORIA`) REFERENCES `categorias` (`IDCAT`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla bdblog.entradas: ~9 rows (aproximadamente)
DELETE FROM `entradas`;
INSERT INTO `entradas` (`IDENT`, `IDUSUARIO`, `IDCATEGORIA`, `TITULO`, `IMAGEN`, `DESCRIPCION`, `FECHA`) VALUES
	(23, 1, 1, 'Leche Entera', 'leche.jpg', '<p><i><strong>Leche Entera</strong></i>, de la mejor calidad, ideal para toda la familia.</p>', '2024-03-05 23:42:09'),
	(24, 1, 2, 'Carne de Ternera', 'carne_ternera.jpg', '<p><i><strong>Carne de Ternera</strong></i> fresca y jugosa, perfecta para tus asados.</p>', '2024-03-05 23:42:44'),
	(33, 5, 34, 'Champú Anticaspa', 'champoo.jpg', '<p><i><strong>Champú Anticaspa</strong></i>, cuida tu cabello y elimina la caspa eficazmente.</p>', '2024-03-06 16:20:03'),
	(35, 2, 33, 'Detergente Líquido', 'detergente.jpg', '<p><strong>Detergente Líquido</strong>, limpia tu ropa profundamente, dejando un aroma fresco.</p>', '2024-03-06 17:41:13'),
	(40, 2, 35, 'Pizza Congelada', 'pizza.jpg', '<p><i><strong>Pizza Congelada</strong></i>, fácil de preparar y deliciosa para compartir en familia.</p>', '2024-03-06 16:13:21'),
	(52, 5, 25, 'Zumo de Naranja', 'zumo_naranja.jpg', '<p><i><strong>Zumo de Naranja</strong></i>, natural y refrescante, ideal para acompañar tus desayunos.</p>', '2024-03-05 23:43:32'),
	(53, 2, 25, 'Refresco de Cola', 'refresco_cola.jpg', '<p><strong>Refresco de Cola</strong>, la bebida clásica que todos disfrutan.</p>', '2024-03-06 16:15:51'),
	(54, 5, 32, 'Cereales Integrales', 'cereal.jpg', '<p><i><strong>Cereales Integrales</strong></i>, para un desayuno saludable y lleno de energía.</p>', '2024-03-06 17:59:47'),
	(55, 5, 24, 'Manzanas Frescas', 'manzanas.jpg', '<p><i><strong>Manzanas Frescas</strong></i>, jugosas y crujientes, perfectas para cualquier momento del día.</p>', '2024-03-06 18:03:39');

-- Volcando estructura para tabla bdblog.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `IDUSER` int NOT NULL AUTO_INCREMENT,
  `NICK` varchar(40) NOT NULL,
  `NOMBRE` varchar(40) NOT NULL,
  `APELLIDOS` varchar(40) NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `CONTRASENIA` varchar(40) NOT NULL,
  `AVATAR` varchar(50) NOT NULL,
  `ROL` varchar(40) NOT NULL,
  PRIMARY KEY (`IDUSER`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla bdblog.usuarios: ~7 rows (aproximadamente)
DELETE FROM `usuarios`;
INSERT INTO `usuarios` (`IDUSER`, `NICK`, `NOMBRE`, `APELLIDOS`, `EMAIL`, `CONTRASENIA`, `AVATAR`, `ROL`) VALUES
	(1, 'jaime', 'Jaime', 'Rodríguez', 'jaime@gmail.com', 'jaime1234', 'Perfil.jpg', 'admin'),
	(2, 'luis', 'Luis', 'Martínez', 'luis@gmail.com', 'luis1234', 'Perfil.jpg', 'user'),
	(5, 'pepe', 'Pepe', 'López', 'pepe@gmail.com', 'pepe1234', 'Wallpaper.jpg', 'admin'),
	(15, 'laura', 'Laura', 'Márquez', 'laura@gmail.com', 'laura1234', 'Fondo2.png', 'user'),
	(16, 'juanito', 'Juan', 'Pérez', 'juan@gmail.com', 'juan1234', 'Fondo4.png', 'user'),
	(17, 'admin', 'Administrador', 'Admin', 'admin@gmail.com', 'admin1234', 'Wallpaper.jpg', 'admin'),
	(18, 'maria', 'María', 'López', 'maria@gmail.com', 'maria1234', 'Fondo4.png', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
