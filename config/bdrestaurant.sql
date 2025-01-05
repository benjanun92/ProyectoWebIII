-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2024 a las 16:28:44
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
-- Base de datos: `bdrestaurant`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camarero`
--

CREATE TABLE `camarero` (
  `idcamarero` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `salario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camarero`
--

INSERT INTO `camarero` (`idcamarero`, `nombre`, `apellido_paterno`, `apellido_materno`, `telefono`, `salario`) VALUES
(1, 'Luis', 'García', 'Pérez', '555111222', 1500.00),
(2, 'Sofia', 'Martínez', 'Gómez', '555222333', 1600.00),
(3, 'Carlos', 'Hernández', 'Díaz', '555333444', 1450.00),
(4, 'Patricia', 'López', 'Ruiz', '555444555', 1550.00),
(5, 'Roberto', 'González', 'Torres', '55555566444', 1700.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` char(1) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `genero`, `telefono`, `direccion`) VALUES
(1, 'Juan', 'Pérez', 'González', '1985-05-14', 'M', '555123456', 'Calle Ficticia 123'),
(2, 'Ana', 'López', 'Martínez', '1990-07-22', 'F', '555987654', 'Avenida Libertad 456'),
(3, 'Carlos', 'Mendoza', 'Ramírez', '1982-11-09', 'M', '555321654', 'Calle Real 789'),
(4, 'María', 'Gómez', 'Hernández', '1995-03-11', 'F', '555654987', 'Calle Nueva 321');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `iddetalle` int(11) NOT NULL,
  `idpedido` int(11) DEFAULT NULL,
  `idmenu` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precioTotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`iddetalle`, `idpedido`, `idmenu`, `cantidad`, `precioTotal`) VALUES
(1, 1, 1, 2, 8.99),
(2, 1, 4, 1, 4.50),
(4, 3, 3, 1, 10.99),
(7, 4, 5, 4, 3.00),
(8, 6, 4, 5, 15.00),
(9, 6, 2, 5, 50.00),
(10, 6, 2, 6, 38.94),
(12, 1, 1, 5, 15.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idfactura` int(11) NOT NULL,
  `idpedido` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido_paterno` varchar(100) DEFAULT NULL,
  `apellido_materno` varchar(100) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idfactura`, `idpedido`, `nombre`, `apellido_paterno`, `apellido_materno`, `total`, `fecha`) VALUES
(1, 101, 'Juan', 'Pérez', 'González', 150.00, '2024-11-30'),
(2, 102, 'María', 'López', 'Ramírez', 200.50, '2024-11-29'),
(3, 103, 'Carlos', 'Sánchez', 'Torres', 180.75, '2024-11-28'),
(4, 104, 'Ana', 'Martínez', 'Castro', 220.00, '2024-11-05'),
(5, 3, 'Carlos', 'Mendoza', 'Ramírez', 10.99, '2024-12-12'),
(6, 1, 'Juan', 'Pérez', 'González', 28.49, '2024-12-02'),
(7, 2, 'Ana', 'López', 'Martínez', 6.49, '2024-12-03'),
(8, 7, 'Ana', 'López', 'Martínez', 17.98, '2024-12-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `idmenu` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idmenu`, `nombre`, `descripcion`, `precio`, `categoria`) VALUES
(1, 'Pizza Margarita', 'Pizza con salsa de tomate, mozzarella y albahaca', 8.99, 'Plato Principal'),
(2, 'Ensalada César', 'Lechuga, pollo, queso parmesano y aderezo César', 6.49, 'Entrada'),
(3, 'Spaghetti Bolognesa', 'Espaguetis con salsa boloñesa casera', 10.99, 'Plato Principal'),
(4, 'Tarta de Chocolate', 'Tarta de chocolate con base de galleta', 4.50, 'Postre'),
(5, 'Agua Mineral', 'Botella de agua mineral de 500 ml', 1.50, 'Bebida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `idmesa` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`idmesa`, `numero`, `capacidad`, `estado`) VALUES
(1, 1, 4, 'Disponible'),
(2, 2, 2, 'Ocupada'),
(3, 3, 6, 'Disponible'),
(4, 4, 4, 'Ocupada'),
(5, 5, 2, 'Ocupado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` int(11) NOT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `idmesa` int(11) DEFAULT NULL,
  `idcamarero` int(11) DEFAULT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `idcliente`, `idmesa`, `idcamarero`, `estado`) VALUES
(1, 1, 1, 2, 'Pendiente'),
(3, 3, 3, 1, 'Entregado'),
(4, 4, 2, 4, 'Pendiente'),
(6, 3, 1, 1, 'Listo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `paterno` varchar(50) NOT NULL,
  `materno` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `paterno`, `materno`, `nombre`, `cargo`, `user`, `password`) VALUES
(1, 'Pérez', 'González', 'Juan', 'Gerente', 'juanperez', 'password123'),
(2, 'López', 'Martínez', 'Ana', 'Secretaria', 'analopez', 'password456'),
(3, 'Ramírez', 'Hernández', 'Carlos', 'Desarrollador', 'carlosramirez', 'password789'),
(4, 'Sánchez', 'Torres', 'Marta', 'Analista', 'martasantos', 'password321'),
(6, 'perez', 'perez', 'pepito', 'admin', 'pepito', '123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camarero`
--
ALTER TABLE `camarero`
  ADD PRIMARY KEY (`idcamarero`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`iddetalle`),
  ADD KEY `idpedido` (`idpedido`),
  ADD KEY `idmenu` (`idmenu`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfactura`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`idmesa`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `idcliente` (`idcliente`),
  ADD KEY `idmesa` (`idmesa`),
  ADD KEY `idcamarero` (`idcamarero`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `camarero`
--
ALTER TABLE `camarero`
  MODIFY `idcamarero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `iddetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`),
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`idmesa`) REFERENCES `mesa` (`idmesa`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`idcamarero`) REFERENCES `camarero` (`idcamarero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
