-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2020 a las 06:05:03
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_sistema`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE PROCEDURE `addproduct` (IN `nameProd` VARCHAR(100), IN `cat` INT, IN `warehouse` INT, IN `code` DOUBLE(12,2), IN `profit` DOUBLE(12,2), IN `cost_price` DOUBLE(12,2), IN `others` DOUBLE(12,2), IN `sale_price` DOUBLE(12,2), IN `descr` VARCHAR(255), IN `stock` INT, IN `locImg` VARCHAR(255))  INSERT into articulo(
nombre,
idcategoria,
idwarehouse,
codigo,
profit,
precio_costo,
others,
precio_venta,
descripcion,
stock,
imagen
)
VALUES(
nameProd,
cat,
warehouse,
code,
profit,
cost_price,
others,
sale_price,
descr,
stock,
locImg
)$$

CREATE PROCEDURE `deleteimg` (IN `idimg` INT)  DELETE FROM photo WHERE idphoto = idimg$$

CREATE PROCEDURE `deleteProduct` (IN `idProd` INT)  DELETE FROM articulo WHERE idarticulo = idProd$$

CREATE PROCEDURE `GuardarImagen` (IN `Idarticulo` INT, IN `Photo` VARCHAR(100))  BEGIN
	 INSERT INTO photo (idarticulo, imagen) VALUES (Idarticulo, Photo);
END$$

CREATE PROCEDURE `update_product` (IN `id` INT, IN `name` VARCHAR(255), IN `category` INT, IN `warehouse` INT, IN `code` VARCHAR(255), IN `Profit` DOUBLE(12,2), IN `cost_price` DOUBLE(12,2), IN `Others` DOUBLE(12,2), IN `sale_price` DOUBLE(12,2), IN `Stock` INT, IN `descr` VARCHAR(255), IN `locPhoto` VARCHAR(255))  UPDATE articulo set 
nombre=name,
idcategoria=category,
idwarehouse = warehouse,
codigo = code,
profit = Profit,
precio_costo = cost_price,
others = Others,  
precio_venta = sale_price, 
stock = Stock, 
descripcion = descr,
imagen=locPhoto 
WHERE idarticulo = id$$

DELIMITER ;

