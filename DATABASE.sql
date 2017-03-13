-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-03-2017 a las 15:11:04
-- Versión del servidor: 5.5.54-cll
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--

--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_clie` int(11) NOT NULL AUTO_INCREMENT,
  `cod_bar_clie` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_clie` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nro_ident_clie` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tip_ident_clie` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `correo_clie` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `clave_clie` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `justgast_clie` tinyint(1) NOT NULL COMMENT '0: No Justifica; 1: Justifica',
  `saldo_clie` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_clie`),
  UNIQUE KEY `id_clie` (`id_clie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Clientes' AUTO_INCREMENT=84 ;

--
-- Volcado de datos para la tabla `clientes`
--
-- Volcado de datos para la tabla `clientes`

-- La justificacion se usa para las gerencias o ejecutivos que ofrecen productos de consumo a sus clientes pero no los deben pagar, de esta forma se lleva un seguimiento del consumo y el porque del mismo

INSERT INTO `clientes` (`id_clie`, `cod_bar_clie`, `nombre_clie`, `nro_ident_clie`, `tip_ident_clie`, `correo_clie`, `clave_clie`, `justgast_clie`, `saldo_clie`) VALUES
(1, '215141', 'PRUEBA CLIENTES', '215141', 'CC', 'CORREO@CORREO.COM', '9f810ebd27f4dbcf1ccc9302e5125f08', 0, 2550);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE IF NOT EXISTS `entradas` (
  `nro_entr` int(11) NOT NULL,
  `fecha_entr` date NOT NULL,
  `cod_prov_entr` int(11) NOT NULL,
  `nro_fact_entr` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `total_entr` float NOT NULL,
  `estado_entr` int(11) NOT NULL COMMENT '0: Abierta; 1: Creada; 2: Anulada',
  PRIMARY KEY (`nro_entr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entradas de Inventarios';

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`nro_entr`, `fecha_entr`, `cod_prov_entr`, `nro_fact_entr`, `total_entr`, `estado_entr`) VALUES
(3, '2016-11-17', 3, '00028', 25050, 1),
;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas_lineas`
--

CREATE TABLE IF NOT EXISTS `entradas_lineas` (
  `nro_entl` int(11) NOT NULL,
  `linea_entl` int(11) NOT NULL,
  `cod_prod_entl` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_entl` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `costo_unit_entl` float NOT NULL,
  `cant_entl` int(11) NOT NULL,
  `vlr_vta_entl` float NOT NULL,
  `total_entl` float NOT NULL,
  PRIMARY KEY (`nro_entl`,`linea_entl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Lineas Entradas';

--
-- Volcado de datos para la tabla `entradas_lineas`
--

INSERT INTO `entradas_lineas` (`nro_entl`, `linea_entl`, `cod_prod_entl`, `nombre_entl`, `costo_unit_entl`, `cant_entl`, `vlr_vta_entl`, `total_entl`) VALUES
(3, 1, '770299002', 'PASTEL POLLO\r\n', 1100, 5, 1300, 5500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_prod` int(11) NOT NULL,
  `codigo_prod` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descrip_prod` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `costo_prod` float NOT NULL,
  `saldo_prod` int(11) NOT NULL DEFAULT '0',
  `valor_prod` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_prod`),
  UNIQUE KEY `codigo_prod` (`codigo_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Productos';

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_prod`, `codigo_prod`, `descrip_prod`, `costo_prod`, `saldo_prod`, `valor_prod`) VALUES
(2, '77010148', 'CHOCOLATINA JET\r\n', 300, 23, 400),
(3, '7702007224160', 'JET WAFER CHOCOLATE\r\n', 490, 3, 700),
(4, '7702007224023', 'JET WAFER VAINILLA\r\n', 490, 2, 700),
(5, '7702007042481', 'JET WAFER TRADICION\r\n', 490, 2, 700),
(6, '7702007224139', 'JET WAFER LIMON\r\n', 490, 2, 700),
(7, '7702007224184', 'JET WAFER FRESA\r\n', 490, 3, 700),
(8, '7702007212501', 'CHOCOLATINA JUMBO\r\n', 0, 0, 1600),
(9, '7702007228502', 'MANI LA ESPECIAL MANI CON PASAS\r\n', 0, 0, 1700),
(10, '7702025100156', 'GALLETAS TOSH MIEL\r\n', 467, 0, 700),
(11, '7702025110445', 'MINI CHIPS\r\n', 542, 0, 800),
(13, '7702025136759', 'GALLETAS FESTIVAL CHOCOLATE\r\n', 467, 0, 600),
(14, '7702189012487', 'PAPAS MARGARITA NATURAL\r\n', 683, 15, 1000),
(16, '7702090016369', 'JUGO HIT FRUTAS TROPICAL\r\n', 750, 8, 1100),
(17, '7702090013016', 'JUGO HIT MORA\r\n', 750, 16, 1100),
(19, '7702535002742', 'COCACOLA 500ML\r\n', 1333, 0, 2050),
(20, '7702090031928', 'GASEOSA POSTOBON MANZANA 400ML\r\n', 1458, 0, 1800),
(21, '7702090031966', 'GASEOSA POSTOBON PEPSI 400ML\r\n', 1458, 0, 1800),
(22, '7702090031942', 'GASEOSA POSTOBON UVA 400ML\r\n', 1167, 0, 1800),
(23, '7702090031973', 'GASEOSA POSTOBON 7UP 400ML\r\n', 1458, 0, 1800),
(24, '7702090031935', 'GASEOSA POSTOBON NARANJA 400ML\r\n', 1458, 0, 1800),
(25, '7702090029826', 'TEE 500 ML\r\n', 1459, 0, 2150),
(26, '7702535002025', 'JUGO DEL VALLE 400ML\r\n', 1209, 1, 2150),
(27, '7702004013484', 'PONY MALTA 330 CM3\r\n', 1167, 4, 2000),
(28, '7702535002469', 'JUGO DEL VALLE 200ML\r\n', 0, 0, 1100),
(29, '770299001', 'PASTEL GLORIA \r\n', 920, 0, 1300),
(30, '770299002', 'PASTEL POLLO\r\n', 1100, 5, 1300),
(31, '770299003', 'PASTEL CARNE\r\n', 1100, 5, 1300),
(32, '770299004', 'EMPANADA CHILENA\r\n', 2500, 0, 3000),
(33, '770299005', 'PALOS DE QUESO\r\n', 1100, 0, 1300),
(34, '770299006', 'CROISSANT CHOCOLATE\r\n', 1100, 0, 1300),
(35, '770299007', 'CROISSANT JAMON Y QUESO\r\n', 1100, 0, 1300),
(36, '770299008', 'CORAZONES\r\n', 700, 0, 800),
(37, '770299009', 'GALLETAS DE AVENA\r\n', 0, 0, 800),
(38, '770299010', 'MANTECADA\r\n', 1000, 6, 1200),
(39, '770299011', 'CAPUCHINO\r\n', 0, 9993, 1650),
(40, '770299012', 'LATTE\r\n', 0, 1000000, 0),
(41, '770299013', 'EXPRESSO\r\n', 0, 99999918, 0),
(42, '770299014', 'CHOCOLATE\r\n', 0, 9999, 1450),
(43, '770299015', 'AROMATICA\r\n', 0, 999957, 0),
(44, '770299016', 'MILO', 0, 0, 0),
(45, '770299017', 'ROSCON', 350, 12, 450),
(46, '7707244561689', 'AGUA CIELO 620 ML', 1500, 1, 2150),
(47, '7702535001752', 'COCA COLA 600 ML', 1375, 0, 2050),
(48, '7702090013047', 'JUGO HIT 200 ML', 750, 19, 1100),
(51, '7702133862809', 'TRIDENT MENTA', 712, 0, 1000),
(52, '7702133862793', 'TRIDENT SANDIA', 739, 0, 1000),
(53, '7702133867088', 'TRIDENT FRESH', 712, 0, 1000),
(54, '7702011242570', 'BOM BOM BUM', 222, 11, 250),
(57, '7702189012456', 'PAPAS MARGARITA POLLO', 586, 6, 1000),
(59, '7702090032017', 'GASEOSA COLOMBIANA 400 ML', 1458, 0, 1800),
(61, '7707014902704', 'BIG BOM', 146, 0, 250),
(62, '7702189000262', 'PAPAS MARGARITA BBQ', 683, 11, 1000),
(64, '7702025136773', 'GALLETAS FESTIVAL FRESA', 467, 12, 600),
(65, '7701101242087', 'SALCHICHA ZENU TARRO', 2500, 2, 3000),
(66, '770299018', 'BUÑUELO', 800, 0, 1000),
(67, '7702090013061', 'JUGO HIT MANGO', 750, 6, 1100),
(68, '7702152003023', 'PAPAS SUPER RICAS POLLO', 750, 0, 1000),
(69, '7702090029819', 'MR TEA LIMON', 1375, 1, 2050),
(70, '7702133863271', 'TRIDENT TROPICAL MIX', 712, 2, 1000),
(71, '7702133862816', 'TRIDENT MORA AZUL', 712, 0, 1000),
(72, '7702133867071', 'TRIDENT HERBAL FRESH', 712, 0, 1000),
(73, '770299019', 'BUÑUELO PEQUEÑO', 600, 0, 800),
(74, '7702914133302', 'DONA RAMO', 1350, 0, 1800),
(76, '7702177016435', 'AVENA ALQUERIA', 741, 12, 1100),
(77, '7707197521037', 'AREQUIPE DE ANTAÑO', 660, 15, 900),
(78, '7702177000717', 'AVENA ALQUERIA CANELA', 600, 0, 1050),
(79, '7702177000496', 'CHOCO LECHE ALQUERIA', 803, 12, 1200),
(80, '7702914158909', 'PLATANO MADURO RAMO', 819, 7, 1200),
(81, '7702914112055', 'GALA LIMON', 975, 7, 1200),
(82, '7702914112017', 'GALA CHOCOLATE', 975, 5, 1200),
(83, '7702914112024', 'GALA VAINILLA', 975, 8, 1200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_prov` int(11) NOT NULL,
  `nit_prov` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_prov` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion_prov` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono_prov` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo_prov` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_prov`),
  UNIQUE KEY `nit_prov` (`nit_prov`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci COMMENT='Proveedores';

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_prov`, `nit_prov`, `nombre_prov`, `direccion_prov`, `telefono_prov`, `correo_prov`) VALUES
(1, '1014', 'PROVEEDOR1', 'PROVEEDOR1', 'PROVEEDOR1', 'PROVEEDOR1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recargas`
--

CREATE TABLE IF NOT EXISTS `recargas` (
  `nro_reca` int(11) NOT NULL,
  `fecha_reca` date NOT NULL,
  `id_clie_reca` int(11) NOT NULL,
  `nrofra_reca` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `valor_reca` float NOT NULL,
  `observ_reca` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `estado_reca` int(11) NOT NULL COMMENT '0: Creada; 1: Anulada',
  PRIMARY KEY (`nro_reca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Historial de Recargas';

--
-- Volcado de datos para la tabla `recargas`
--

INSERT INTO `recargas` (`nro_reca`, `fecha_reca`, `id_clie_reca`, `nrofra_reca`, `valor_reca`, `observ_reca`, `estado_reca`) VALUES
(1, '2016-11-08', 2, '', 1000, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usua` int(11) NOT NULL,
  `nro_id_usua` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_usua` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `clave_usua` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `perfil_usua` int(11) NOT NULL COMMENT '0=SuperAdmin; 1=Admin; 2=Vendedor; 3=Cajero',
  PRIMARY KEY (`id_usua`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Usuarios';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usua`, `nro_id_usua`, `nombre_usua`, `clave_usua`, `perfil_usua`) VALUES
(1, '5898', 'ADMIN', 'eecccd8ff4107946c78d42265cd474b5', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `nro_vent` int(11) NOT NULL,
  `fecha_vent` date NOT NULL,
  `cliente_vent` int(11) NOT NULL,
  `total_vent` float NOT NULL,
  `justif_vent` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `estado_vent` int(11) NOT NULL COMMENT '0: Abierta; 1: Creada; 2: Anulada',
  PRIMARY KEY (`nro_vent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Ventas de Mercancia';

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`nro_vent`, `fecha_vent`, `cliente_vent`, `total_vent`, `justif_vent`, `estado_vent`) VALUES
(1, '2016-11-04', 22, 2600, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventaslineas`
--

CREATE TABLE IF NOT EXISTS `ventaslineas` (
  `nro_venl` int(11) NOT NULL,
  `nro_lin_venl` int(11) NOT NULL,
  `cod_prod_venl` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nom_prod_venl` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `valor_unit_venl` float NOT NULL,
  `cant_venl` int(11) NOT NULL,
  `Total_venl` int(11) NOT NULL,
  PRIMARY KEY (`nro_venl`,`nro_lin_venl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='VentasLineas';

--
-- Volcado de datos para la tabla `ventaslineas`
--

INSERT INTO `ventaslineas` (`nro_venl`, `nro_lin_venl`, `cod_prod_venl`, `nom_prod_venl`, `valor_unit_venl`, `cant_venl`, `Total_venl`) VALUES
(1, 1, '770299006', 'CROISSANT CHOCOLATE\r\n', 1300, 2, 2600);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
