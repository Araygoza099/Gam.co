-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2023 a las 00:34:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_pedido`
--

CREATE TABLE `det_pedido` (
  `detpedido_id` int(13) NOT NULL,
  `proc_id` int(13) NOT NULL,
  `pedido_id` int(10) NOT NULL,
  `detpedido_cantidad` int(255) NOT NULL,
  `prec_unitario` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `envio_id` int(13) NOT NULL,
  `pedido_id` int(13) NOT NULL,
  `envio_dir` text NOT NULL,
  `edo_envio` varchar(255) NOT NULL,
  `envio_dateginal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `pago_id` int(13) NOT NULL,
  `usr_id` int(5) NOT NULL,
  `card_id` int(13) NOT NULL,
  `card_number` int(255) NOT NULL,
  `card_thought` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `pedido_id` int(13) NOT NULL,
  `usr_id` int(5) NOT NULL,
  `pago_id` int(13) NOT NULL,
  `pedido_date` date NOT NULL,
  `edo_pedido` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `proc_id` int(13) NOT NULL,
  `proc_name` varchar(255) NOT NULL,
  `proc_descrip` varchar(255) NOT NULL,
  `proc_desc` int(5) NOT NULL,
  `proc_price` int(10) NOT NULL,
  `cantidad` int(3) NOT NULL,
  `proc_urlimg` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`proc_id`, `proc_name`, `proc_descrip`, `proc_desc`, `proc_price`, `cantidad`, `proc_urlimg`, `type`) VALUES
(1, 'Resident Evil 4 Remake', 'Videojuego clásico remasterizado para la nuevas consolas', 10, 1800, 30, 'img1.1.jpg', 'Videojuego'),
(2, 'Red Dead Redemption 2', '', 10, 1200, 10, 'img1.2.jpeg', 'Videojuego'),
(3, 'Minecraft', 'Video juego Minecraft', 20, 700, 10, 'img1.3.png', 'Videojuego'),
(4, 'Cuphead', 'Videojuego perteneciente al género de corre y dispara, publicado por la empresa canadiense StudioMDHR', 10, 1200, 7, 'img1.4.jpg', 'Videojuego'),
(5, 'Control Xbox Series X|S', 'Mando de Xbox color Blanco', 5, 1800, 100, 'img2.1.webp', 'Accesorio'),
(6, 'Control Xbox Series X|S Camuflaje Rojo', '', 5, 1000, 10, 'img2.2.webp', 'Accesorio'),
(7, 'Control Xbox Series X|S Azul', '', 5, 1000, 10, 'img2.3.jpg', 'Accesorio'),
(8, 'Control Xbox Series X|S Negro', 'Mando de Xbox color Negro', 5, 1000, 10, 'img2.4.webp', 'Accesorio'),
(9, 'Zuriel Said Zúñiga Delgadillo', 'a', 99, 100, 1, 'profileAvatar.png', 'Videojuego');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `usr_id` int(5) NOT NULL,
  `username` varchar(75) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `intentos` int(25) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `respuesta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`usr_id`, `username`, `email`, `password`, `intentos`, `pregunta`, `respuesta`) VALUES
(0, 'admin', 'admin@gmail.com', 'password', 0, '', ''),
(1, 'chriko', 'capimarquez23@gmail.com', '$2y$10$YYYsGkvFhqlWRUMYPoaq6O2uNhAgAHXko0Cta2PvfsZ/.mT.Yfxka', 1, 'equipo', 'chivas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `det_pedido`
--
ALTER TABLE `det_pedido`
  ADD PRIMARY KEY (`detpedido_id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `proc_id` (`proc_id`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`envio_id`),
  ADD KEY `pedido_id` (`pedido_id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`pago_id`),
  ADD KEY `usr_id` (`usr_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedido_id`),
  ADD KEY `usr_id` (`usr_id`),
  ADD KEY `pago_id` (`pago_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`proc_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `det_pedido`
--
ALTER TABLE `det_pedido`
  ADD CONSTRAINT `det_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`pedido_id`),
  ADD CONSTRAINT `det_pedido_ibfk_2` FOREIGN KEY (`proc_id`) REFERENCES `productos` (`proc_id`);

--
-- Filtros para la tabla `envios`
--
ALTER TABLE `envios`
  ADD CONSTRAINT `envios_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`pedido_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
