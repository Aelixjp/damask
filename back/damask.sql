-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-07-2023 a las 22:52:16
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
(3, 1, 'https://articulo.mercadolibre.com.co/MCO-1083813436-lampara-de-mesa-paladone-super-mario-question-block-con-tira-_JM', 'Lámpara De Mesa Paladone Super Mario Question Block Con Tira', 'https://http2.mlstatic.com/D_NQ_NP_909090-MCO52523077994_112022-V.webp', 529900, 3, ''),
(4, 1, 'https://articulo.mercadolibre.com.co/MCO-1083655208-azimom-led-bluetooth-16w-rgbw-luz-de-fibra-optica-kits-de-te-_JM', 'Azimom Led Bluetooth 16w Rgbw Luz De Fibra Óptica Kits De Te', 'https://http2.mlstatic.com/D_NQ_NP_709434-MCO52522811344_112022-V.webp', 498900, 3, ''),
(6, 1, 'https://articulo.mercadolibre.com.co/MCO-476221137-nintendo-switch-neon-mario-odyssey-garantia-1-ano-_JM', 'Nintendo Switch Neon  + Mario Odyssey. Garantia 1 Año', 'https://http2.mlstatic.com/D_NQ_NP_659485-MCO26271427411_112017-V.webp', 1799900, 3, ''),
(7, 1, 'https://articulo.mercadolibre.com.co/MCO-856658478-teclado-logitech-pro-x-ed-league-of-legends-lol-gx-brown-tkl-_JM', 'Teclado Logitech Pro X Ed League Of Legends Lol Gx Brown Tkl', 'https://http2.mlstatic.com/D_NQ_NP_969413-MCO49045544791_022022-V.webp', 499000, 3, ''),
(9, 1, 'https://articulo.mercadolibre.com.co/MCO-605947159-tableta-grafica-ugee-m708-10x-6-inch-compatible-android-y-pc-_JM', 'Tableta Gráfica Ugee M708 10x 6 Inch Compatible Android Y Pc', 'https://http2.mlstatic.com/D_NQ_NP_771422-MCO53548642424_012023-V.webp', 300300, 3, ''),
(10, 1, 'https://www.amazon.com/-/es/sspa/click?ie=UTF8&spc=MToyNTcyNTE3MTQ4ODEzODc1OjE2ODg0ODEwOTQ6c3BfYXRmOjMwMDAwMTM3Njc1OTEwMjo6MDo6&url=%2FHexge', 'Hexgears Teclado mecánico inalámbrico E2 2.4ghz, teclado inalámbrico de tres modos 2.4G/Bluetooth/Ti', 'https://m.media-amazon.com/images/I/71y9+xKxnXL._AC_UY218_.jpg', 478136, 1, ''),
(11, 1, 'https://www.amazon.com/-/es/sspa/click?ie=UTF8&spc=MToyMDk3NDE4MTYyNjgxMjc6MTY4ODQ5MTE5OTpzcF9tdGY6MjAwMDkzNDgzNjU0OTk4OjowOjo&url=%2FMonito', 'INNOCN Monitor para juegos de 24.5 pulgadas 165 Hz / 144 Hz 1920 x 1080P FHD 1 ms FreeSync G-Sync co', 'https://m.media-amazon.com/images/I/71xTvS5EI+L._AC_UY218_.jpg', 432401, 1, ''),
(12, 1, 'https://www.amazon.com/-/es/mec%C3%A1nico-S108-retroiluminaci%C3%B3n-Reposamu%C3%B1ecas-Interruptores/dp/B07XVCP7F5/ref=sr_1_14?keywords=Tec', 'RK ROYAL KLUDGE Teclado mecánico para juegos S108 estilo máquina de escribir retro con cable con ret', 'https://m.media-amazon.com/images/I/71i3GXz1W1L._AC_UY218_.jpg', 278489, 1, '');

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
(1, 'Brayan Steven Garcia Millan', 'admdmsk1234@hotmail.com', 'admin', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79'),
(2, 'Prueba User', 'prueba@prueba.com', 'prueba', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79'),
(3, 'OFELIA ERAZO BOLAÑOS', 'ofe.erazo2003@gmail.com', 'OFELIA', '2970ca8908e53f323c053aa87c05e92125b1a1cb45de4535e7f2070610fd3e2477126afd90b5b1e733e2d80c8e8b73d1f9f468bb59a34ae69d28801a7795c78b');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
CREATE DEFINER=`root`@`localhost` EVENT `reset_tokens` ON SCHEDULE EVERY 30 MINUTE STARTS '2023-07-04 09:29:09' ON COMPLETION PRESERVE ENABLE DO TRUNCATE email_tokens$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
