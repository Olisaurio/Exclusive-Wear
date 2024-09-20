-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-08-2024 a las 17:38:53
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
-- Base de datos: `exclusive-wear`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_carrito`
--

CREATE TABLE `articulos_carrito` (
  `Id` int(11) NOT NULL,
  `Id_Carrito` int(11) NOT NULL,
  `Id_Producto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_ordenes`
--

CREATE TABLE `articulos_ordenes` (
  `Id` int(11) NOT NULL,
  `Id_Ordenes` int(11) NOT NULL,
  `Id_Producto2` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `Id` int(11) NOT NULL,
  `Id_Usuario2` int(11) NOT NULL,
  `Creado_En` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `Id` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Precio_Total` decimal(65,0) NOT NULL,
  `Creado_En` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id` int(11) NOT NULL,
  `Nombre` int(250) NOT NULL,
  `Descripcion` int(250) NOT NULL,
  `Precio` decimal(60,0) NOT NULL,
  `Existencias` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `NombreUsuario` varchar(30) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Email` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos_carrito`
--
ALTER TABLE `articulos_carrito`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Carrito` (`Id_Carrito`,`Id_Producto`),
  ADD KEY `Id_Producto` (`Id_Producto`);

--
-- Indices de la tabla `articulos_ordenes`
--
ALTER TABLE `articulos_ordenes`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Ordenes` (`Id_Ordenes`,`Id_Producto2`),
  ADD KEY `Id_Producto2` (`Id_Producto2`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Usuario2` (`Id_Usuario2`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos_carrito`
--
ALTER TABLE `articulos_carrito`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `articulos_ordenes`
--
ALTER TABLE `articulos_ordenes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos_carrito`
--
ALTER TABLE `articulos_carrito`
  ADD CONSTRAINT `articulos_carrito_ibfk_1` FOREIGN KEY (`Id_Carrito`) REFERENCES `carrito` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articulos_carrito_ibfk_2` FOREIGN KEY (`Id_Producto`) REFERENCES `productos` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulos_ordenes`
--
ALTER TABLE `articulos_ordenes`
  ADD CONSTRAINT `articulos_ordenes_ibfk_1` FOREIGN KEY (`Id_Producto2`) REFERENCES `productos` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articulos_ordenes_ibfk_2` FOREIGN KEY (`Id_Ordenes`) REFERENCES `ordenes` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`Id_Usuario2`) REFERENCES `usuarios` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `ordenes_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
