-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-08-2021 a las 17:53:45
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `correas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion`
--

CREATE TABLE `administracion` (
  `Id` int(11) NOT NULL,
  `Nombre_completo` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `forgot_pass_identity` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `tipo` varchar(10) NOT NULL DEFAULT 'Trabajador',
  `foto` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administracion`
--

INSERT INTO `administracion` (`Id`, `Nombre_completo`, `Email`, `Password`, `phone`, `forgot_pass_identity`, `created`, `tipo`, `foto`, `estado`) VALUES
(1, 'Juan Carlos Blanco Arriaga', 'bjuan5232@gmail.com', '$2y$10$ZA6KA4L7yI8xDJ1BdThR9u467muRXSecMPSn7YUwDYBpHivRYu.R.', '4411010082', NULL, '0000-00-00 00:00:00', 'Master', 'JuanCBA.jpg', 'ALTA'),
(2, 'Maximiliano Trejo', 'trabajador@gmail.com', '$2y$10$rc8E7tQ1Dzy6CuzRCh/ebOOr0RIcb2sqNh4DKVlSJjSw8pM6HZMVa', '4411010082', NULL, '2021-06-10 23:39:10', 'Trabajador', 'descarga.jpg', 'ALTA'),
(3, 'Pedro', 'trabajador-2@gmail.com', '$2y$10$QRnS1UVxbeNrv1F3U7h1g.hYxvzkQVkv5WyMnlRexshSfr7tDmmQO', '4411010082', NULL, '2021-06-22 17:07:19', 'Trabajador', 'taller-2.jpg', 'ALTA'),
(4, 'Efrain Otero ', 'efrainoc.tij18@utsjr.edu.mx', '$2y$10$46xOi3NzF9FoYvvDEtfOEO8Fj1ixG9wtPaTb0XeecwVnDfQf7lLZy', '4411010082', NULL, '2021-06-23 01:29:14', 'Trabajador', 'taller-2.jpg', 'ALTA'),
(5, 'Lorena Lopez', 'bjuan5232@gmail.com', '$2y$10$T4JVhM4mQXt1vt71OcTwnuFlhIZocLjBAKVabZaeBpOlUnUXqe7k6', '4411010082', NULL, '2021-07-19 15:56:16', 'Trabajador', 'zdfv.png', 'ALTA'),
(6, 'Manuel Urtado', 'Manuel@gmail.com', '$2y$10$k3IqXOapN4KYtnYo/dCGAu20hZ.8MeexMfCnm3VYblMs32qlFxFXy', '4411010082', NULL, '2021-08-04 11:35:44', 'Trabajador', '200_d.gif', 'ALTA'),
(7, 'New user', 'User@gmal.com', '$2y$10$V0xh4OEPsvoIZXTMjPrKpe1ZfAzGJxLnacdh6mluqAlEZ970kY4wy', '4411010082', NULL, '2021-08-04 11:59:45', 'Trabajador', NULL, 'BAJA'),
(8, 'usuario12', 'user@gmail.com', '$2y$10$sZc76/7mVFGytfwocKfijedjVoi6ZWrBzAPdCy6PuDvCJdsorh1e6', '4411010082', NULL, '2021-08-04 12:05:16', 'Trabajador', NULL, 'ALTA'),
(9, 'new user test case', 'user7@gmail.com', '$2y$10$fLdfrOAOmYPvCRIHLhzyjOTcF3gvV.WZ6Aeo2s582F.rwv.Hk6Fdy', '4411010082', NULL, '2021-08-06 12:37:54', 'Master', NULL, 'BAJA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `Id` int(11) NOT NULL,
  `Id_servicio` int(11) NOT NULL,
  `Dia` datetime NOT NULL,
  `Nombre_cliente` varchar(300) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `registro` datetime NOT NULL,
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apeido_paterno` varchar(50) DEFAULT NULL,
  `Apeido_materno` varchar(50) DEFAULT NULL,
  `Telefono` varchar(10) DEFAULT NULL,
  `Pais` varchar(30) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Municipio` varchar(50) DEFAULT NULL,
  `Codigo_postal` varchar(10) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `puntos` int(11) NOT NULL,
  `foto` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`registro`, `Id`, `Nombre`, `Apeido_paterno`, `Apeido_materno`, `Telefono`, `Pais`, `Estado`, `Municipio`, `Codigo_postal`, `Email`, `puntos`, `foto`) VALUES
('2021-07-31 19:12:46', 7, 'Juan', 'Blanco', 'Arriaga', '4411010082', 'México', 'QRO', 'Pinal', '76315', 'Correa@gmail.com', 0, 'JuanCBA.jpg'),
('2021-07-31 19:35:13', 8, 'Frank', NULL, 'Perez', '46998668', 'USA', 'California', 'Dango', '58764', 'Frank@gmail.com', 0, '58764'),
('2021-07-31 19:38:44', 9, 'Fernanda', 'Rojo', 'Urtado', '4411010082', 'Mexico', 'QRO', 'Pinal', '76315', 'Fernanda@lkjnhsovk', 0, 'Juan-01.png'),
('2021-08-03 19:20:12', 10, 'new', 'defklme', 'j', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Actualizacion_cliente'),
('2021-08-04 00:00:49', 11, 'Juanc', 'b', 'q', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Juanc'),
('2021-08-04 11:50:20', 12, 'Cliente', 'De', 'Prueba', '4411010082', 'méxico', 'QRO', 'Jalpan de Serra', NULL, 'cliente@gmail.com', 0, '200_d.gif');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `Id` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Nombre_log` varchar(255) NOT NULL,
  `Tipo` varchar(255) NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`Id`, `Fecha`, `Nombre_log`, `Tipo`, `Ubicacion`, `Descripcion`) VALUES
(113, '2021-06-15 16:43:42', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(114, '2021-06-15 16:54:06', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(115, '2021-06-16 00:43:11', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/mi-perfil.php', 'Registro de ::'),
(116, '2021-06-16 00:44:54', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/mi-perfil.php?new=user', 'Registro de ::'),
(117, '2021-06-16 00:52:24', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/mi-perfil.php?new=user', 'Registro de ::'),
(118, '2021-06-16 01:55:38', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(119, '2021-06-16 01:57:30', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(120, '2021-06-16 02:01:28', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(121, '2021-06-16 02:01:32', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(122, '2021-06-16 02:02:49', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(123, '2021-06-16 02:02:54', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(124, '2021-06-16 02:05:27', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(125, '2021-06-16 02:05:37', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(126, '2021-06-16 02:08:21', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(127, '2021-06-16 02:08:26', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(128, '2021-06-16 02:09:33', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(129, '2021-06-16 02:14:07', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(130, '2021-06-16 02:17:45', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(131, '2021-06-16 02:17:50', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(132, '2021-06-16 02:20:07', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(133, '2021-06-16 02:20:12', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(134, '2021-06-16 02:22:19', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(135, '2021-06-16 02:22:25', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(136, '2021-06-16 02:22:40', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(137, '2021-06-16 02:22:49', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(138, '2021-06-16 02:23:06', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(139, '2021-06-16 02:23:11', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(140, '2021-06-16 02:25:12', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(141, '2021-06-16 02:30:20', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(142, '2021-06-16 02:30:54', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(143, '2021-06-16 02:31:06', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(144, '2021-06-16 02:31:58', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(145, '2021-06-16 02:32:22', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(146, '2021-06-16 17:59:43', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(147, '2021-06-16 18:00:10', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(148, '2021-06-16 22:05:35', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(149, '2021-06-18 18:33:12', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(150, '2021-06-18 18:33:34', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(151, '2021-06-18 18:33:48', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(152, '2021-06-18 18:34:00', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(153, '2021-06-18 18:34:11', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(154, '2021-06-18 18:34:20', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(155, '2021-06-18 18:34:31', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(156, '2021-06-18 19:15:26', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(157, '2021-06-18 19:30:17', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(158, '2021-06-18 19:31:54', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(159, '2021-06-18 19:36:45', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(160, '2021-06-18 19:37:04', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(161, '2021-06-18 19:40:10', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(162, '2021-06-18 19:41:23', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(163, '2021-06-18 19:41:51', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(164, '2021-06-18 19:43:31', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(165, '2021-06-18 22:39:40', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(166, '2021-06-18 22:48:27', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(167, '2021-06-18 23:06:54', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(168, '2021-06-18 23:07:06', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(169, '2021-06-18 23:25:15', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(170, '2021-06-18 23:25:24', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(171, '2021-06-21 16:25:23', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(172, '2021-06-21 16:25:28', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(173, '2021-06-22 17:07:19', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/mi-perfil.php?id=Mg==', 'Registro de ::'),
(174, '2021-06-22 17:53:42', 'loginlog', 'sistema', '192.168.0.100-DESKTOP-P63HEK3-URL-192.168.0.103/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(175, '2021-06-22 22:02:56', 'loginlog', 'sistema', '192.168.0.100-DESKTOP-P63HEK3-URL-192.168.0.103/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(176, '2021-06-22 22:06:51', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(177, '2021-06-22 22:14:02', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(178, '2021-06-22 22:14:07', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(179, '2021-06-22 22:14:12', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(180, '2021-06-22 22:14:17', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(181, '2021-06-22 22:25:13', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(182, '2021-06-22 22:25:18', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(183, '2021-06-22 22:53:25', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(184, '2021-06-22 22:53:30', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(185, '2021-06-22 22:53:50', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(186, '2021-06-22 22:54:08', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-trabajador@gmail.com'),
(187, '2021-06-22 23:12:44', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(188, '2021-06-22 23:12:51', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(189, '2021-06-22 23:48:32', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(190, '2021-06-22 23:48:36', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(191, '2021-06-23 00:09:10', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(192, '2021-06-23 00:09:25', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-trabajador@gmail.com'),
(193, '2021-06-23 00:23:13', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(194, '2021-06-23 00:23:24', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(195, '2021-06-23 00:23:27', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(196, '2021-06-23 00:23:44', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador-2@gmail.com'),
(197, '2021-06-23 00:24:26', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(198, '2021-06-23 00:24:31', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(199, '2021-06-23 00:50:33', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(200, '2021-06-23 00:50:42', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(201, '2021-06-23 00:51:01', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(202, '2021-06-23 00:52:57', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(203, '2021-06-23 00:54:13', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-trabajador-2@gmail.com'),
(204, '2021-06-23 01:02:12', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(205, '2021-06-23 01:02:19', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador-2@gmail.com'),
(206, '2021-06-23 01:08:31', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(207, '2021-06-23 01:08:57', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-trabajador@gmail.com'),
(208, '2021-06-23 01:10:05', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(209, '2021-06-23 01:10:10', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(210, '2021-06-23 01:12:20', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(211, '2021-06-23 01:12:26', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(212, '2021-06-23 01:12:58', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(213, '2021-06-23 01:13:09', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(214, '2021-06-23 01:17:19', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(215, '2021-06-23 01:17:34', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(216, '2021-06-23 01:18:18', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(217, '2021-06-23 01:19:17', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(218, '2021-06-23 01:29:14', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/mi-perfil.php?resultado=Actualizacion-correcta', 'Registro de ::'),
(219, '2021-06-23 01:37:52', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(220, '2021-06-23 01:38:41', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(221, '2021-06-23 12:41:55', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(222, '2021-06-23 13:59:48', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(223, '2021-06-23 14:00:00', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(224, '2021-06-23 14:00:20', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(225, '2021-06-23 14:00:32', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(226, '2021-06-23 14:00:54', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(227, '2021-06-23 14:00:58', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(228, '2021-06-23 14:08:10', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(229, '2021-06-23 14:08:14', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(230, '2021-06-23 14:18:06', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(231, '2021-06-23 14:18:15', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(232, '2021-06-23 14:26:29', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(233, '2021-06-23 14:26:34', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(234, '2021-06-23 14:55:47', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(235, '2021-06-23 14:55:57', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(236, '2021-06-23 20:37:35', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(237, '2021-06-23 21:27:53', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(238, '2021-06-23 21:28:03', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(239, '2021-06-24 00:21:17', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(240, '2021-06-24 00:22:07', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(241, '2021-06-24 00:24:31', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(242, '2021-06-24 00:25:01', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(243, '2021-06-24 00:26:45', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(244, '2021-06-24 00:26:56', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(245, '2021-06-24 00:26:59', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(246, '2021-06-24 00:28:12', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(247, '2021-06-28 16:30:44', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(248, '2021-06-28 16:31:25', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(249, '2021-06-28 16:45:02', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(250, '2021-06-28 16:45:14', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(251, '2021-06-28 16:47:48', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(252, '2021-06-28 16:48:11', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(253, '2021-06-28 16:48:34', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(254, '2021-06-28 16:48:39', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(255, '2021-06-28 16:50:11', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(256, '2021-06-28 16:50:16', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(257, '2021-06-28 17:30:57', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(258, '2021-06-28 23:12:27', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(259, '2021-06-28 23:19:32', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(260, '2021-07-07 15:59:41', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(261, '2021-07-07 16:00:56', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(262, '2021-07-07 16:00:59', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(263, '2021-07-10 20:00:19', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(264, '2021-07-10 21:47:52', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(265, '2021-07-14 00:38:12', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(266, '2021-07-14 00:38:23', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(267, '2021-07-14 01:32:15', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(268, '2021-07-14 18:24:25', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(269, '2021-07-14 18:25:00', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(270, '2021-07-14 18:26:11', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(271, '2021-07-14 18:26:17', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(272, '2021-07-14 18:26:21', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(273, '2021-07-14 18:26:25', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(274, '2021-07-14 18:46:25', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(275, '2021-07-14 18:46:47', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(276, '2021-07-14 18:49:03', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(277, '2021-07-14 18:54:37', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(278, '2021-07-14 18:56:30', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(279, '2021-07-14 19:00:44', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(280, '2021-07-14 19:23:34', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(281, '2021-07-14 19:24:17', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(282, '2021-07-14 19:24:40', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(283, '2021-07-14 19:25:22', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(284, '2021-07-14 21:43:17', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(285, '2021-07-14 21:43:51', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(286, '2021-07-14 21:48:52', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(287, '2021-07-14 22:11:38', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(288, '2021-07-15 22:00:35', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(289, '2021-07-15 22:17:39', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(290, '2021-07-15 22:18:57', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-Juan Carlos Blanco Arriaga'),
(291, '2021-07-15 22:48:42', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(292, '2021-07-15 23:04:18', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(293, '2021-07-18 19:46:56', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-Juan Carlos Blanco Arriaga'),
(294, '2021-07-18 19:52:27', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(295, '2021-07-18 20:00:14', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(296, '2021-07-18 20:00:22', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(297, '2021-07-18 20:00:25', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(298, '2021-07-18 20:17:23', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(299, '2021-07-19 15:35:41', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(300, '2021-07-19 15:37:31', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/error.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(301, '2021-07-19 15:45:35', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(302, '2021-07-19 15:45:54', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(303, '2021-07-19 15:45:57', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(304, '2021-07-19 15:46:01', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-trabajador@gmail.com'),
(305, '2021-07-19 15:55:11', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(306, '2021-07-19 15:55:18', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(307, '2021-07-19 15:56:16', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/mi-perfil.php', 'Registro de ::'),
(308, '2021-07-19 15:56:36', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(309, '2021-07-19 15:56:45', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-Lorena Lopez'),
(310, '2021-07-19 16:05:11', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(311, '2021-07-19 16:06:34', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(312, '2021-07-19 16:15:24', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(313, '2021-07-19 19:13:07', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(314, '2021-07-20 01:34:24', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/productos.php?resultado=Actualizacion-correcta', 'Registro de producto::Producto red'),
(315, '2021-07-23 16:57:01', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(316, '2021-07-23 16:57:29', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(317, '2021-07-23 16:57:51', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-Lorena Lopez'),
(318, '2021-07-23 16:57:55', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(319, '2021-07-23 16:58:02', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(320, '2021-07-23 18:45:21', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(321, '2021-07-23 18:45:50', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(322, '2021-07-23 18:46:16', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(323, '2021-07-23 18:46:24', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-efrainoc.tij18@utsjr.edu.mx'),
(324, '2021-07-23 18:58:28', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(325, '2021-07-27 21:33:35', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(326, '2021-07-27 22:35:28', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(327, '2021-07-27 22:36:27', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(328, '2021-07-27 22:36:45', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(329, '2021-07-27 22:36:56', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-efrainoc.tij18@utsjr.edu.mx'),
(330, '2021-07-31 10:34:43', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/productos.php', 'Registro de producto::Producto con puntos'),
(331, '2021-07-31 11:26:05', 'loginlog', 'sistema', '192.168.0.101-DESKTOP-P63HEK3-URL-192.168.0.106/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(332, '2021-07-31 11:48:00', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(333, '2021-07-31 13:06:48', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/clientes.php', 'Registro de registro_Clientes::Nombre'),
(334, '2021-07-31 16:42:16', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/clientes.php', 'Registro de registro_Clientes::Teresa'),
(335, '2021-07-31 19:12:46', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/clientes.php', 'Registro de registro_Clientes::'),
(336, '2021-07-31 19:35:13', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/clientes.php', 'Registro de registro_Clientes::'),
(337, '2021-07-31 19:38:44', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/clientes.php', 'Registro de registro_Clientes::'),
(338, '2021-08-03 01:17:55', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(339, '2021-08-03 01:18:03', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(340, '2021-08-03 01:18:45', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(341, '2021-08-03 01:18:50', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(342, '2021-08-03 01:51:28', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(343, '2021-08-03 12:32:42', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(344, '2021-08-03 12:32:57', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(345, '2021-08-03 18:58:26', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(346, '2021-08-03 19:20:12', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/clientes.php', 'Registro de registro_Clientes::'),
(347, '2021-08-04 00:00:49', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/clientes.php', 'Registro de registro_Clientes::'),
(348, '2021-08-04 11:33:53', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(349, '2021-08-04 11:35:44', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/mi-perfil.php?new=user', 'Registro de ::'),
(350, '2021-08-04 11:36:43', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(351, '2021-08-04 11:37:27', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(352, '2021-08-04 11:38:16', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(353, '2021-08-04 11:38:45', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(354, '2021-08-04 11:41:50', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/productos.php', 'Registro de producto::Producto new'),
(355, '2021-08-04 11:50:20', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/clientes.php', 'Registro de registro_Clientes::'),
(356, '2021-08-04 11:53:33', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(357, '2021-08-04 11:53:50', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(358, '2021-08-04 11:55:54', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(359, '2021-08-04 11:58:37', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(360, '2021-08-04 11:59:45', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/mi-perfil.php', 'Registro de ::'),
(361, '2021-08-04 12:01:05', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(362, '2021-08-04 12:01:34', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(363, '2021-08-04 12:04:28', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(364, '2021-08-04 12:05:16', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/mi-perfil.php', 'Registro de ::'),
(365, '2021-08-04 12:06:13', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(366, '2021-08-05 19:17:06', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(367, '2021-08-06 12:24:37', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(368, '2021-08-06 12:25:18', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/productos.php', 'Registro de producto::Test de registro'),
(369, '2021-08-06 12:36:42', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(370, '2021-08-06 12:37:54', 'createlog', 'servidor', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/mi-perfil.php', 'Registro de ::'),
(371, '2021-08-06 12:38:38', 'close-User', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/delete_SESSION.PHP', 'Secion serrada-DESKTOP-P63HEK3'),
(372, '2021-08-06 12:39:25', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(373, '2021-08-07 22:38:24', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(374, '2021-08-08 10:47:45', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicios-correa-v2/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com'),
(375, '2021-08-09 22:04:27', 'loginlog', 'sistema', '::1-DESKTOP-P63HEK3-URL-localhost/autoservicio-correa/admin/index.php', 'Acceso al sistema-bjuan5232@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Apeido` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Ubicacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `Nombre`, `Apeido`, `Email`, `Ubicacion`) VALUES
(34, 'Juan Carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'Landa de matamoros'),
(35, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(36, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(37, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(38, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(39, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(40, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(41, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(42, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(43, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(44, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(45, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(46, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(47, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(48, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(49, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(50, 'Juan Carlos', 'Blanco Arriaga', 'br@gmail.com', 'Pinal de Amoles'),
(51, 'Juan ', 'Blanco', 'juanc970706@gmail.com', 'otro'),
(52, 'Juan ', 'Blanco', 'juanc970706@gmail.com', 'otro'),
(53, 'uan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'otro'),
(54, 'uan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'otro'),
(55, 'uan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'otro'),
(56, 'uan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'otro'),
(57, 'Juan carlos', 'Blanco', 'bjuan5232@gmail.com', 'otro'),
(58, 'uan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'otro'),
(59, 'uan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'otro'),
(60, 'uan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'otro'),
(61, 'uan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'otro'),
(62, 'Juan carlos', 'Blanco', 'bjuan5232@gmail.com', NULL),
(63, 'Juan carlos', 'Blanco', 'bjuan5232@gmail.com', NULL),
(64, 'Juan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', NULL),
(65, 'Juan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', NULL),
(66, 'Juan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', NULL),
(67, 'Juan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'otro'),
(68, 'Juan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'Higuerillas'),
(69, 'Juan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'Higuerillas'),
(70, 'Juan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', 'Higuerillas'),
(71, 'Juan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', NULL),
(72, 'Juan carlos', 'Blanco Arriaga', 'bjuan5232@gmail.com', NULL),
(73, 'Juan ', 'Blanco Arriaga', 'br@gmail.com', NULL),
(74, 'Juan Carlos', 'Jalpan de serra', 'bjuan5232@gmail.com', 'Jalpan de serra'),
(75, 'Juan carlos', 'Arriaga', 'br@gmail.com', 'Higuerillas'),
(76, 'Juan carlos', 'Arriaga', 'br@gmail.com', 'Higuerillas'),
(77, 'Juan carlos', 'Arriaga', 'br@gmail.com', 'Higuerillas'),
(78, 'Juan Carlos', 'Blanco Arriaga', 'jblancoatics@gmail.com', 'Pinal de Amoles'),
(79, 'Juan Carlos', 'Blanco Arriaga', 'jblancoatics@gmail.com', 'Pinal de Amoles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_servicios`
--

CREATE TABLE `productos_servicios` (
  `Id` int(11) NOT NULL,
  `Codigo` varchar(255) DEFAULT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Precio` double DEFAULT NULL,
  `Stock` double DEFAULT NULL,
  `Stock_max` double DEFAULT NULL,
  `Stock_min` double DEFAULT NULL,
  `Codigo_proveedor` varchar(17) DEFAULT NULL,
  `Descripcion_corta` varchar(300) DEFAULT NULL,
  `Descripcion_larga` varchar(7000) DEFAULT NULL,
  `Duracion_minima` int(11) DEFAULT NULL,
  `Imagen` varchar(255) NOT NULL,
  `Tipo` varchar(255) DEFAULT NULL,
  `puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos_servicios`
--

INSERT INTO `productos_servicios` (`Id`, `Codigo`, `Nombre`, `Precio`, `Stock`, `Stock_max`, `Stock_min`, `Codigo_proveedor`, `Descripcion_corta`, `Descripcion_larga`, `Duracion_minima`, `Imagen`, `Tipo`, `puntos`) VALUES
(24, '1234567891', 'Bujía', 75, 56, 41, 55, '001', 'Solo en establecimiento', NULL, NULL, 'D_NQ_NP_902146-MCO31035445331_062019-V.jpg', 'producto', 8),
(28, 'vrer', 'Producto', 515, 9, 15, 10, '0001', 'Solo en establecimiento', NULL, NULL, 'Logo.png', 'producto', 0),
(38, 'NULL', 'Test De registro de servicios', 51, 0, 0, 0, 'NULL', 'Este servicio es un Tescase', 'cdcvdvedvvdevev e  jb kbo bu hiu bib iyg iyiu iu hu ho uhiouh iuhouhou houh ouhou hui iu hiuhoi h', 5, 'hqdefault.jpg', 'Servicio', 0),
(39, '0001', 'Aceite mobil 1L', 92, 1, 20, 2, '4587', 'Solo en establecimiento', NULL, NULL, 'mobil-super-1000-20w50-1l.jpg', 'producto', 0),
(40, '001', 'producto354', 45, 1, 10, 1, '0001', 'Registro para testear al software', NULL, NULL, 'dibujos-de-corazones-con-lapiz.jpg', 'producto', 0),
(43, '05959562', 'producto 365', 89, 8, 16, 8, '001', NULL, NULL, NULL, 'descarga.jpg', 'producto', 0),
(44, '0001', 'Producto red', 256, 1, 35, 10, '4587', NULL, NULL, NULL, 'WhatsApp Image 2021-04-19 at 20.50.27.jpeg', 'producto', 0),
(45, '7485245', 'Producto con puntos', 45, 45, 60, 10, '5892', NULL, NULL, NULL, 'd8nzq34-c836f98e-e8aa-4855-8d13-805765e1dd57.jpg', 'producto', 2),
(46, '723586900', 'Producto new', 78, 9, 10, 1, '2548', 'Este producto se cargo en la prueba de funcionamiento', NULL, NULL, '200_d.gif', 'producto', 1),
(47, 'NULL', 'Servicio de Prueba ', 579.9, 0, 0, 0, 'NULL', 'Servicio cargado para la prueba de funcionamiento', 'Este servicio no tenia una descripción\r\n*Se actualizo su descripción ', 120, '200_d.gif', 'Servicio', 0),
(48, '001', 'Test de registro', 45, 1, 10, 1, '001', 'Registro para testear al software', NULL, NULL, '200_d.gif', 'producto', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitio_web`
--

CREATE TABLE `sitio_web` (
  `Banner_1` varchar(255) DEFAULT NULL,
  `Banner_2` varchar(255) DEFAULT NULL,
  `Banner_3` varchar(255) DEFAULT NULL,
  `Ubicacion` varchar(255) DEFAULT NULL,
  `Horario_atencion` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Nombre_Empresa` varchar(255) DEFAULT NULL,
  `Logo` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `whatsap` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sitio_web`
--

INSERT INTO `sitio_web` (`Banner_1`, `Banner_2`, `Banner_3`, `Ubicacion`, `Horario_atencion`, `Email`, `Nombre_Empresa`, `Logo`, `facebook`, `whatsap`, `id`) VALUES
('Banner-1banner-4.jpg', 'Banner-2banner-2.jpg', 'Banner-3banner-3.jpg', 'Jalpan de Serra,QRO', 'De 08:00 - 20:00', 'Correa@gmail.com', 'Autocervicios Correa', 'Logotipo-02-02.png', 'http://localhost/autoservicio-correa/admin/siteupdate.php', '4411010082', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tips`
--

CREATE TABLE `tips` (
  `Id` int(11) NOT NULL,
  `Tip` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tips`
--

INSERT INTO `tips` (`Id`, `Tip`) VALUES
(16, 'En temporada de lluvias procura no usar llantas lizas'),
(17, 'Registro de un nuevo tip de prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `Id` bigint(30) NOT NULL,
  `Id_producto_servicio` int(11) DEFAULT NULL,
  `Precio_unitario` double DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Id_cliente` int(11) DEFAULT NULL,
  `Factura` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administracion`
--
ALTER TABLE `administracion`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_productos` (`Id_servicio`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_servicios`
--
ALTER TABLE `productos_servicios`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `sitio_web`
--
ALTER TABLE `sitio_web`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_cliente` (`Id_cliente`),
  ADD KEY `fk_producto` (`Id_producto_servicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administracion`
--
ALTER TABLE `administracion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;
--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT de la tabla `productos_servicios`
--
ALTER TABLE `productos_servicios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `sitio_web`
--
ALTER TABLE `sitio_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tips`
--
ALTER TABLE `tips`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `Id` bigint(30) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_productos` FOREIGN KEY (`Id_servicio`) REFERENCES `productos_servicios` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`Id_cliente`) REFERENCES `clientes` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`Id_producto_servicio`) REFERENCES `productos_servicios` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
