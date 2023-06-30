-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2023 a las 18:13:52
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `articulos_guardados`
--

INSERT INTO `articulos_guardados` (`ID`, `ID_usuario`, `url`, `nombre_producto`, `imagen_producto`, `precio_producto`, `ID_pagina`, `resena_producto`) VALUES
(1, 1, 'https://articulo.mercadolibre.com.co/MCO-945004766-lampara-de-lava-luz-creativa-decorativa-volcan-de-cera-_JM', 'Lampara De Lava Luz Creativa Decorativa Volcan De Cera', 'https://http2.mlstatic.com/D_NQ_NP_961261-MCO52126323078_102022-V.webp', 104900, 3, 'Excelente la lámpara, muy bonita. El empaque venía en perfectas condiciones. Recomiendo el producto.'),
(2, 1, 'https://www.mercadolibre.com.co/tarjeta-de-memoria-adata-ausdx64guicl10-ra1-premier-con-adaptador-sd-64gb/p/MCO6172244', 'Tarjeta de memoria Adata AUSDX64GUICL10-RA1  Premier con adaptador SD 64GB', 'https://http2.mlstatic.com/D_NQ_NP_724870-MLA45731900086_042021-V.webp', 20977, 3, ''),
(3, 1, 'https://articulo.mercadolibre.com.co/MCO-1083813436-lampara-de-mesa-paladone-super-mario-question-block-con-tira-_JM', 'Lámpara De Mesa Paladone Super Mario Question Block Con Tira', 'https://http2.mlstatic.com/D_NQ_NP_909090-MCO52523077994_112022-V.webp', 529900, 3, ''),
(4, 1, 'https://articulo.mercadolibre.com.co/MCO-1083655208-azimom-led-bluetooth-16w-rgbw-luz-de-fibra-optica-kits-de-te-_JM', 'Azimom Led Bluetooth 16w Rgbw Luz De Fibra Óptica Kits De Te', 'https://http2.mlstatic.com/D_NQ_NP_709434-MCO52522811344_112022-V.webp', 498900, 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_tokens`
--

CREATE TABLE `email_tokens` (
  `ID` int(11) NOT NULL,
  `email` varchar(65) NOT NULL,
  `token` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE `paginas` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `url` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `username`, `password`) VALUES
(1, 'Brayan Steven Garcia Millan', 'admdmsk1234@hotmail.com', 'admin', 'ef3d8669399ebcfe5b0c22c91138a927daf20af7ba2af3c6990f81176a0dcede8a97a077a4b494d890c29444317505b94e08eb7561f2cd00758be25bbfdcc984'),
(2, 'Prueba User', 'prueba@prueba.com', 'prueba', '012362b4615efb6aa754fd7f72b9f276a164b63b159c26d1220d40787ebada6225e6751c855a2064a3ce0448b45ff3d9f10e8bd805ceb0f619f46eca0ef1d9b0');

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
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `email` (`email`);

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
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos_guardados`
--
ALTER TABLE `articulos_guardados`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos_guardados`
--
ALTER TABLE `articulos_guardados`
  ADD CONSTRAINT `articulos_guardados_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articulos_guardados_ibfk_2` FOREIGN KEY (`ID_pagina`) REFERENCES `paginas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `email_tokens`
--
ALTER TABLE `email_tokens`
  ADD CONSTRAINT `email_tokens_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `reset_tokens` ON SCHEDULE EVERY 30 MINUTE STARTS '2023-06-30 11:06:57' ON COMPLETION PRESERVE ENABLE DO TRUNCATE email_tokens$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
