-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-12-2020 a las 07:41:51
-- Versión del servidor: 5.6.41-84.1
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `thinknce_eventos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enigmas`
--

CREATE TABLE `enigmas` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `id_enigma` int(11) NOT NULL,
  `initial_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `puntos` int(11) NOT NULL,
  `complete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `enigmas`
--

INSERT INTO `enigmas` (`id`, `id_user`, `name`, `id_enigma`, `initial_date`, `puntos`, `complete`) VALUES
(325, 88, 'dsaddasddasd', 260, '2020-12-18 16:03:03', 0, 1),
(326, 89, 'gustavomarra', 260, '2020-12-18 16:24:26', 0, 1),
(327, 89, 'gustavomarra', 259, '2020-12-18 16:24:41', 0, 1),
(328, 89, 'gustavomarra', 258, '2020-12-18 13:25:47', 760, 1),
(329, 89, 'gustavomarra', 257, '2020-12-18 13:26:02', 1660, 1),
(330, 89, 'gustavomarra', 246, '2020-12-18 13:26:29', 1500, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_time`
--

CREATE TABLE `users_time` (
  `id` int(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  `game_time` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users_time`
--

INSERT INTO `users_time` (`id`, `id_user`, `game_time`, `date`) VALUES
(67, 50, '31:31:60', '2020-12-16 17:49:32'),
(68, 39, '37:32:17', '2020-12-16 17:56:26'),
(69, 39, '37:57:23', '2020-12-16 17:56:56'),
(70, 39, '38:31:43', '2020-12-16 17:57:23'),
(71, 39, '38:51:30', '2020-12-16 17:57:46'),
(72, 42, '44:31:66', '2020-12-16 18:03:00'),
(73, 37, '48:41:26', '2020-12-16 18:03:19'),
(74, 41, '47:14:13', '2020-12-16 18:03:46'),
(75, 51, '44:29:36', '2020-12-16 18:04:05'),
(76, 38, '46:48:45', '2020-12-16 18:04:20'),
(77, 71, '46:07:40', '2020-12-16 18:06:05'),
(78, 70, '51:55:92', '2020-12-16 18:06:47'),
(79, 45, '48:34:02', '2020-12-16 18:07:06'),
(80, 40, '54:34:70', '2020-12-16 18:09:00'),
(81, 48, '50:29:58', '2020-12-16 18:11:28'),
(82, 34, '57:27:65', '2020-12-16 18:11:47'),
(84, 47, '53:51:49', '2020-12-16 18:13:23'),
(90, 37, '40:06:49', '2020-12-17 09:59:27'),
(91, 37, '40:13:55', '2020-12-17 09:59:29'),
(92, 37, '40:48:22', '2020-12-17 10:00:16'),
(93, 35, '41:36:47', '2020-12-17 10:03:01'),
(94, 38, '42:33:46', '2020-12-17 10:03:21'),
(95, 35, '43:52:55', '2020-12-17 10:06:04'),
(96, 34, '51:19:40', '2020-12-17 10:11:02'),
(97, 36, '40:28:64', '2020-12-17 10:12:54'),
(98, 34, '45:07:51', '2020-12-17 10:14:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelta_al_mundo`
--

CREATE TABLE `vuelta_al_mundo` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_posta` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `complete` tinyint(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vuelta_al_mundo`
--

INSERT INTO `vuelta_al_mundo` (`id`, `id_user`, `id_posta`, `days`, `money`, `complete`, `date`) VALUES
(3, 1, 70, 5, 12, 0, '2020-11-13 12:02:58'),
(4, 1, 76, 8, 50, 0, '2020-11-13 12:03:05'),
(5, 12, 70, 5, 12, 0, '2020-11-13 12:43:01'),
(6, 1, 104, 0, 0, 0, '2020-11-24 11:58:01'),
(7, 13, 70, 5, 12, 0, '2020-11-28 16:56:45'),
(8, 13, 76, 8, 50, 0, '2020-11-28 16:56:55'),
(9, 1, 111, 0, 0, 0, '2020-11-28 16:57:16'),
(10, 13, 111, 0, 0, 0, '2020-11-28 18:49:38'),
(11, 13, 104, 22, 1, 0, '2020-11-28 18:59:01'),
(12, 12, 104, 22, 1, 0, '2020-11-28 20:31:06'),
(13, 1, 143, 0, 0, 0, '2020-12-07 20:59:16'),
(14, 1, 110, 13, 350, 0, '2020-12-07 22:57:29'),
(15, 1, 120, 1, 550, 0, '2020-12-07 22:57:53'),
(16, 1, 122, 2, 4000, 0, '2020-12-07 22:58:22'),
(17, 1, 124, 13, 600, 0, '2020-12-07 22:58:53'),
(18, 1, 126, 6, 700, 0, '2020-12-07 22:59:38'),
(19, 1, 128, 22, 0, 0, '2020-12-07 23:00:13'),
(20, 1, 132, 2, 600, 0, '2020-12-07 23:00:24'),
(21, 1, 133, 2, 0, 0, '2020-12-07 23:00:41'),
(22, 1, 135, 3, 400, 0, '2020-12-07 23:00:50'),
(23, 1, 138, 3, 0, 0, '2020-12-07 23:01:32'),
(24, 1, 139, 0, 0, 0, '2020-12-07 23:02:09'),
(25, 1, 141, 0, 0, 0, '2020-12-07 23:02:54'),
(26, 1, 142, 0, 0, 0, '2020-12-07 23:03:16'),
(27, 1, 131, 2, 900, 0, '2020-12-08 09:15:03'),
(28, 1, 130, 2, 900, 0, '2020-12-08 12:26:37'),
(29, 1, 134, 2, 0, 0, '2020-12-09 08:15:42'),
(30, 1, 136, 3, 800, 0, '2020-12-09 08:48:22'),
(31, 12, 143, 0, 0, 0, '2020-12-09 10:50:08'),
(32, 34, 143, 0, 0, 0, '2020-12-09 10:52:25'),
(33, 34, 70, 1, 0, 0, '2020-12-09 10:55:12'),
(34, 35, 143, 0, 0, 0, '2020-12-09 10:58:07'),
(35, 35, 70, 0, 0, 0, '2020-12-09 10:58:13'),
(36, 35, 104, 7, 400, 0, '2020-12-09 10:59:32'),
(37, 35, 110, 13, 350, 0, '2020-12-09 11:01:33'),
(38, 35, 120, 1, 550, 0, '2020-12-09 11:06:42'),
(39, 35, 122, 2, 4000, 0, '2020-12-09 11:14:36'),
(40, 35, 124, 13, 600, 0, '2020-12-09 11:19:34'),
(41, 35, 127, 6, 1700, 0, '2020-12-09 11:21:59'),
(42, 1, 127, 6, 1700, 0, '2020-12-09 11:22:03'),
(43, 35, 129, 0, 300, 0, '2020-12-09 11:23:41'),
(44, 1, 129, 0, 300, 0, '2020-12-09 11:23:42'),
(45, 35, 132, 2, 600, 0, '2020-12-09 11:26:13'),
(46, 35, 133, 2, 0, 0, '2020-12-09 11:31:38'),
(47, 35, 135, 3, 400, 0, '2020-12-09 11:38:21'),
(48, 35, 138, 3, 0, 0, '2020-12-09 11:51:08'),
(49, 35, 139, 0, 0, 0, '2020-12-09 11:56:29'),
(50, 35, 141, 0, 0, 0, '2020-12-09 12:01:59'),
(51, 35, 142, 0, 0, 0, '2020-12-09 12:05:13'),
(52, 1, 190, 0, 0, 0, '2020-12-09 14:53:04'),
(53, 1, 140, 0, 0, 0, '2020-12-09 20:29:14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `enigmas`
--
ALTER TABLE `enigmas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_time`
--
ALTER TABLE `users_time`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `vuelta_al_mundo`
--
ALTER TABLE `vuelta_al_mundo`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `enigmas`
--
ALTER TABLE `enigmas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT de la tabla `users_time`
--
ALTER TABLE `users_time`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `vuelta_al_mundo`
--
ALTER TABLE `vuelta_al_mundo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
