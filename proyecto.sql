-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 03:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyecto`
--

-- --------------------------------------------------------

--
-- Table structure for table `det_pedido`
--

CREATE TABLE `det_pedido` (
  `detpedido_id` int(13) NOT NULL,
  `proc_id` int(13) NOT NULL,
  `pedido_id` int(10) NOT NULL,
  `detpedido_cantidad` int(255) NOT NULL,
  `prec_unitario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `direccion`
--

CREATE TABLE `direccion` (
  `dir_id` int(5) NOT NULL,
  `usr_id` int(5) NOT NULL,
  `calle` varchar(255) NOT NULL,
  `fracc` varchar(255) NOT NULL,
  `zipcode` int(5) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `num_tel` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `direccion`
--

INSERT INTO `direccion` (`dir_id`, `usr_id`, `calle`, `fracc`, `zipcode`, `estado`, `ciudad`, `num_tel`) VALUES
(1, 2, 'El capulin 197', 'Residencial del Parque', 20277, 'Aguascalientes', 'Aguascalientes', 4494673952);

-- --------------------------------------------------------

--
-- Table structure for table `envios`
--

CREATE TABLE `envios` (
  `envio_id` int(13) NOT NULL,
  `dir_id` int(5) NOT NULL,
  `pedido_id` int(13) NOT NULL,
  `edo_envio` varchar(255) NOT NULL,
  `envio_datefinal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `pago_id` int(13) NOT NULL,
  `usr_id` int(5) NOT NULL,
  `card_id` int(13) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `card_thought` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pagos`
--

INSERT INTO `pagos` (`pago_id`, `usr_id`, `card_id`, `card_number`, `card_thought`) VALUES
(0, 1, 0, '0000000000000000', '2030-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `pedido_id` int(13) NOT NULL,
  `usr_id` int(5) NOT NULL,
  `pago_id` int(13) NOT NULL,
  `total` bigint(255) NOT NULL,
  `pagado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`pedido_id`, `usr_id`, `pago_id`, `total`, `pagado`) VALUES
(1, 2, 0, 0, 0),
(2, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
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
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`proc_id`, `proc_name`, `proc_descrip`, `proc_desc`, `proc_price`, `cantidad`, `proc_urlimg`, `type`) VALUES
(1, 'Resident Evil 4 - Remake', 'Seis años después de la catástrofe en Raccoon City, el agente Leon S. Kennedy es enviado a rescatar a la hija del presidente, secuestrada en una apartada población europea. La historia sigue un arriesgado rescate lleno de terror, explorando la intersecció', 10, 1299, 10, 'ResidentEvil4.webp', 'Videojuegos'),
(2, 'Red Dead Redemption 2', 'Arthur Morgan y la banda de Van der Linde son forajidos buscados. Con agentes federales y los mejores cazarrecompensas pisándoles los talones, la banda deberá abrirse camino por el salvaje territorio del corazón de Estados Unidos a base de robos y peleas ', 50, 1300, 50, 'img1.2.jpeg', 'Videojuegos'),
(3, 'Minecraft', 'Explora mundos generados al azar y construye cosas increíbles, desde la más humilde de las casas hasta el más majestuoso de los castillos. Juega en el modo creativo con recursos ilimitados o extrae en las profundidades del mundo, crea armas y armaduras pa', 15, 350, 0, 'img1.3.png', 'Videojuegos'),
(4, 'Cuphead', 'Juega como Cuphead o Mugman (en modo de un jugador o cooperativo) y cruza mundos extraños, adquiere nuevas armas, aprende poderosos supermovimientos y descubre secretos ocultos mientras procuras saldar tu deuda con el diablo.', 30, 400, 5, 'img1.4.jpg', 'Videojuegos'),
(5, 'Dragon Ball: Xenoverse 2', 'Dragon Ball Xenoverse 2 es la experiencia de juego de Dragon Ball definitiva cargada de acción emocionante, batallas épicas y opciones de personalización infinitas.', 0, 340, 0, 'DragonBallX.webp', 'Videojuegos'),
(6, 'Cyberpunk 2077', 'Cyberpunk 2077 es un RPG de acción y aventura de mundo abierto ambientado en el futuro sombrío de Night City, una peligrosa megalópolis obsesionada con el poder, el glamur y las incesantes modificaciones corporales.', 0, 1500, 50, 'img1.5.jpg', 'Videojuegos'),
(7, 'Injustice 2', 'En INJUSTICE 2, los combates moldean a los héroes de DC al otorgarles equipo personalizable. Mientras Batman enfrenta el régimen de Superman, una nueva amenaza pone en peligro la Tierra, desencadenando una épica lucha por la supervivencia.', 90, 1200, 50, 'Injustice.webp', 'Videojuegos'),
(8, 'God of War: Ragnarok (Deluxe Edition Numerique)', 'Kratos y Atreus deben viajar a cada uno de los nueve reinos en búsqueda de respuestas, mientras que las fuerzas asgardianas se preparan para una batalla profetizada que terminará con el mundo.', 0, 1900, 0, 'GOW.jpeg', 'Videojuegos'),
(9, 'Control Xbox ONE Elite Black Series 2', 'Adapta fácilmente este control Elite Series 2 para Xbox ONE, con los nuevos joysticks y palancas intercambiables estas características son las que hacen de este control para Xbox ONE tan único, porque al ser adaptable, podrá cubrir las necesidades de cual', 10, 2999, 50, 'img2.4.webp', 'Accesorios'),
(10, 'Control Inalámbrico Xbox Serie S Y X Elite Series 2 Blanco', 'Diseñado para satisfacer las necesidades básicas de los jugadores competitivos de hoy en día, incluye solo los componentes que necesitas para desatar tu mejor juego. Incluye: Control, herramienta para ajustar palancas, cable de carga y guía de uso.', 0, 3000, 50, 'img2.1.webp', 'Accesorios'),
(11, 'Xbox Wireless Controller - Shock Blue', 'El control inalámbrico de Xbox en color Azul ofrece un diseño ergonómico, con superficies esculpidas y textura para mayor comodidad y precisión. Destaca por su botón de Compartir para capturar contenido, la personalización de botones con la app Accesorios', 36, 1699, 0, 'img2.3.jpg', 'Accesorios'),
(13, 'Playstation Mando Inalámbrico Ps5 Dualsense Camuflage Plateado', 'Con el innovador mando inalámbrico DualSense de PlayStation 5, podrás disfrutar de una experiencia de juego más inmersiva y profunda.', 15, 1375, 50, 'mandoPS5camuflageplateado.webp', 'Accesorios'),
(14, 'Sony Playstation 5 DualSense Wireless Controller Cosmic Red', 'Este mando combina funciones revolucionarias mientras conserva precisión, comodidad y exactitud en cada movimiento. Gracias a su ergonomía especialmente pensada para la posición de tu mano, puedes pasar horas jugando con total confort. Mayor comodidad y r', 0, 1270, 0, 'mandoPS5cosmicred.webp', 'Accesorios'),
(15, 'Control Inalámbrico PlayStation 5 DualSense Midnight Black', 'Explora nuevas fronteras de juego en tu PS5 con el Control Inalámbrico DualSense Midnight Black.', 65, 1530, 50, 'mandoPS5midnightblack.webp', 'Accesorios'),
(16, 'Convertidor de Teclado', 'El adaptador de teclado y mouse KX es un producto innovador que permite a los jugadores disfrutar de juegos FPS en diferentes dispositivos con teclado USB y mouse.', 80, 399, 3, 'ConvetidorTeclado.jpg', 'Accesorios'),
(18, 'Mortal Kombat 1', 'Descubre el nuevo universo de Mortal Kombat, creado por el Dios del Fuego Liu Kang. ¡Mortal Kombat 1 marca el comienzo de una nueva era para la icónica franquicia, con un sistema de lucha, modos de juego y Fatalities nuevos!', 0, 1200, 50, 'MK1.webp', 'Videojuegos'),
(19, 'Soporte de Nintendo Switch Zelda Tears of The Kingdom', 'Este producto combina el diseño para las lágrimas del reino, y la apariencia es muy única y utiliza material ABS de alta calidad.', 5, 499, 15, 'SoporteNSzelda.jpg', 'Accesorios'),
(20, 'Playstation Mando Inalámbrico Ps5 Dualsense Azul', 'Sony DualSense Galactic Purple - Mando Inalámbrico para PS5 Lo último en mandos inalámbricos para PlayStation está aquí. ', 5, 1239, 45, 'mandoPS5violeta.webp', 'Accesorios');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `username`, `email`, `password`, `intentos`, `pregunta`, `respuesta`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$UALFKSSAh1n8EO4TMqh1ie/N8omSOJXH0mr0a3wuYJkOSqBy2SjDO', 0, 'mascota', 'Zuriel'),
(2, 'chris', 'capimarquez23@gmail.com', '$2y$10$BTFCh2ZYyvJ.spyHmgU3gOcXQKymdu17wCLlOsqTUnR6Dz/DgNJia', 0, 'mascota', 'diego');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `det_pedido`
--
ALTER TABLE `det_pedido`
  ADD PRIMARY KEY (`detpedido_id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `proc_id` (`proc_id`);

--
-- Indexes for table `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`dir_id`),
  ADD KEY `usr_id` (`usr_id`);

--
-- Indexes for table `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`envio_id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `dir_id` (`dir_id`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`pago_id`),
  ADD KEY `usr_id` (`usr_id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedido_id`),
  ADD KEY `usr_id` (`usr_id`),
  ADD KEY `pago_id` (`pago_id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`proc_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `det_pedido`
--
ALTER TABLE `det_pedido`
  ADD CONSTRAINT `det_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`pedido_id`),
  ADD CONSTRAINT `det_pedido_ibfk_2` FOREIGN KEY (`proc_id`) REFERENCES `productos` (`proc_id`);

--
-- Constraints for table `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`);

--
-- Constraints for table `envios`
--
ALTER TABLE `envios`
  ADD CONSTRAINT `envios_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`pedido_id`),
  ADD CONSTRAINT `envios_ibfk_2` FOREIGN KEY (`dir_id`) REFERENCES `direccion` (`dir_id`);

--
-- Constraints for table `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`);

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`pago_id`) REFERENCES `pagos` (`pago_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
