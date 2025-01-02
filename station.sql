-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2025 a las 22:21:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `station`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `board`
--

CREATE TABLE `board` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `board`
--

INSERT INTO `board` (`id`, `Name`, `id_user`) VALUES
(6, 'Mi Nuevo Board', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulas`
--

CREATE TABLE `formulas` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `formula` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parameter`
--

CREATE TABLE `parameter` (
  `id` int(11) NOT NULL,
  `id_station` int(11) NOT NULL,
  `id_sensor` int(11) NOT NULL,
  `measurement` int(11) NOT NULL,
  `dataTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `Name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensor`
--

CREATE TABLE `sensor` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `unit_measurement` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sensor`
--

INSERT INTO `sensor` (`id`, `Name`, `unit_measurement`) VALUES
(1, 'COR1', 'Amperio'),
(2, 'COR2', 'Amperio'),
(3, 'COR3', 'Amperio'),
(4, 'COR4\r\n', 'Amperio'),
(5, 'COR5\r\n', 'Amperio'),
(6, 'COR6\r\n', 'Amperio'),
(7, 'VOL1', 'Voltios'),
(8, 'VOL2\r\n', 'Voltios'),
(9, 'VOL3', 'Voltios'),
(10, 'VOL4', 'Voltios'),
(11, 'RPM1', 'revoluciones por minuto'),
(12, 'RPM2', 'revoluciones por minuto'),
(13, 'RPM3', 'revoluciones por minuto'),
(14, 'VEL1', 'Metros sobre segundo'),
(15, 'VEL2', 'Metros sobre segundo'),
(16, 'DIR1', 'Dirección del viento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensor_variable`
--

CREATE TABLE `sensor_variable` (
  `id` int(11) NOT NULL,
  `id_table` int(11) NOT NULL,
  `id_sensor` int(11) NOT NULL,
  `id_station` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sensor_variable`
--

INSERT INTO `sensor_variable` (`id`, `id_table`, `id_sensor`, `id_station`) VALUES
(4, 3, 1, 2),
(5, 3, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `location` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `station`
--

INSERT INTO `station` (`id`, `Name`, `Description`, `location`, `id_user`) VALUES
(2, 'Santa marta', 'Santa marta', 'Santa marta', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `station_board`
--

CREATE TABLE `station_board` (
  `id` int(11) NOT NULL,
  `id_board` int(11) NOT NULL,
  `id_station` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `station_board`
--

INSERT INTO `station_board` (`id`, `id_board`, `id_station`) VALUES
(6, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `id_board` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tables`
--

INSERT INTO `tables` (`id`, `name`, `id_board`) VALUES
(3, 'tabla', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `Name`, `Email`, `Password`, `id_role`) VALUES
(4, 'ejemplo', 'ejemplo@example.com', '$2y$10$a.KRoDWfTDndRd5iofKjvusa4dk/ZijezbKBqF7ZM56fvFJyCc9Vi', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `formulas`
--
ALTER TABLE `formulas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_station` (`id_station`),
  ADD KEY `id_sensor` (`id_sensor`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sensor_variable`
--
ALTER TABLE `sensor_variable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_table` (`id_table`),
  ADD KEY `id_sensor` (`id_sensor`),
  ADD KEY `id_station` (`id_station`);

--
-- Indices de la tabla `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `station_board`
--
ALTER TABLE `station_board`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_board` (`id_board`),
  ADD KEY `id_station` (`id_station`);

--
-- Indices de la tabla `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_board` (`id_board`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `board`
--
ALTER TABLE `board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `formulas`
--
ALTER TABLE `formulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parameter`
--
ALTER TABLE `parameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sensor`
--
ALTER TABLE `sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `sensor_variable`
--
ALTER TABLE `sensor_variable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `station_board`
--
ALTER TABLE `station_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `board`
--
ALTER TABLE `board`
  ADD CONSTRAINT `board_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `parameter`
--
ALTER TABLE `parameter`
  ADD CONSTRAINT `Parameter_ibfk_1` FOREIGN KEY (`id_station`) REFERENCES `station` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Parameter_ibfk_2` FOREIGN KEY (`id_sensor`) REFERENCES `sensor` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sensor_variable`
--
ALTER TABLE `sensor_variable`
  ADD CONSTRAINT `sensor_variable_ibfk_1` FOREIGN KEY (`id_station`) REFERENCES `station` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `sensor_variable_ibfk_2` FOREIGN KEY (`id_table`) REFERENCES `tables` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `sensor_variable_ibfk_3` FOREIGN KEY (`id_sensor`) REFERENCES `sensor` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `station`
--
ALTER TABLE `station`
  ADD CONSTRAINT `Station_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `station_board`
--
ALTER TABLE `station_board`
  ADD CONSTRAINT `station_board_ibfk_1` FOREIGN KEY (`id_board`) REFERENCES `board` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `station_board_ibfk_2` FOREIGN KEY (`id_station`) REFERENCES `station` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `Table_ibfk_1` FOREIGN KEY (`id_board`) REFERENCES `board` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
