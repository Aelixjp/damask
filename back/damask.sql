-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2023 a las 07:15:26
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `damask`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_guardados`
--

CREATE TABLE `articulos_guardados` (
  `ID` int(11) NOT NULL,
  `ID_usuario` int(11) NOT NULL,
  `url` varchar(140) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `imagen_producto` varchar(150) NOT NULL,
  `precio_producto` bigint(20) NOT NULL DEFAULT 0,
  `ID_pagina` int(11) NOT NULL,
  `resena_producto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `articulos_guardados`
--

INSERT INTO `articulos_guardados` (`ID`, `ID_usuario`, `url`, `nombre_producto`, `imagen_producto`, `precio_producto`, `ID_pagina`, `resena_producto`) VALUES
(1, 1, 'https://articulo.mercadolibre.com.co/MCO-945004766-lampara-de-lava-luz-creativa-decorativa-volcan-de-cera-_JM', 'Lampara De Lava Luz Creativa Decorativa Volcan De Cera', 'https://http2.mlstatic.com/D_NQ_NP_961261-MCO52126323078_102022-V.webp', 104900, 3, 'Excelente la lámpara, muy bonita. El empaque venía en perfectas condiciones. Recomiendo el producto.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_tokens`
--

CREATE TABLE `email_tokens` (
  `ID` int(11) NOT NULL,
  `token` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE `paginas` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `url` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paginas`
--

INSERT INTO `paginas` (`ID`, `nombre`, `url`, `status`) VALUES
(1, 'Amazon', 'https://www.amazon.com', 1),
(2, 'Aliexpress', 'https://best.aliexpress.com', 1),
(3, 'Mercadolibre', 'https://www.mercadolibre.com.co', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(65) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(130) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `username`, `password`) VALUES
(1, 'Brayan Steven Garcia Millan', '', 'admin', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos_guardados`
--
ALTER TABLE `articulos_guardados`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_usuario` (`ID_usuario`),
  ADD KEY `id_pagina` (`ID_pagina`);

--
-- Indices de la tabla `email_tokens`
--
ALTER TABLE `email_tokens`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos_guardados`
--
ALTER TABLE `articulos_guardados`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `email_tokens`
--
ALTER TABLE `email_tokens`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paginas`
--
ALTER TABLE `paginas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos_guardados`
--
ALTER TABLE `articulos_guardados`
  ADD CONSTRAINT `articulos_guardados_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articulos_guardados_ibfk_2` FOREIGN KEY (`ID_pagina`) REFERENCES `paginas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
