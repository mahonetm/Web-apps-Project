-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2015 at 04:39 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wood_working`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_fname` varchar(30) NOT NULL,
  `customer_lname` varchar(30) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_token` varchar(32) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customer_email` (`customer_email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_fname`, `customer_lname`, `customer_email`, `customer_phone`, `customer_token`, `username`) VALUES
(13, 'Luke', 'Skywalker', 'l.sky@force.com', '4513237894', '920688bd88d6a1ba0e177f17bdf6dddd', 'lskywalker');


-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(11) NOT NULL,
  `product_id` varchar(11) NOT NULL,
  `quantity` varchar(3) NOT NULL DEFAULT '1',
  `material_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `customer_id`, `product_id`, `quantity`, `material_type`) VALUES
(2, '15', '1', '10', '0'),
(3, '15', '1', '10', '0'),
(4, '15', '2', '10', '0'),
(5, '15', '3', '10', '0'),
(6, '15', '1', '1', '0'),
(7, '15', '1', '15', '0'),
(8, '15', '4', '15', 'bamboo'),
(9, '15', '2', '15', 'Zebra'),
(10, '15', '2', '2', 'Cherry'),
(11, '15', '3', '5', 'Walnut'),
(12, '15', '6', '1', 'Cherry'),
(13, '15', '1', '1', ''),
(14, '15', '2', '1', ''),
(15, '15', '2', '1', 'Zebra wood'),
(16, '15', '5', '1', 'Cherry'),
(17, '14', '2', '1', 'Bamboo'),
(18, '14', '6', '10', 'Oak'),
(19, '26', '5', '1', 'Walnut'),
(20, '27', '5', '3', 'Walnut');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(30) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `material_name` varchar(30) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_type`, `price`, `material_name`) VALUES
(1, 'Ice Cream Scoop', 'niche', '50.00', 'Bamboo/Zebra Wood/Cherry'),
(2, 'Pen', 'niche', '30.00', 'Bamboo/Zebra Wood/Cherry'),
(3, 'Music Box', 'niche', '100.00', 'Cherry/Walnut/Oak/Pine'),
(4, 'Tree Trunk Clock', 'niche', '150.00', 'Walnut/Pine'),
(5, 'Mirror (frame only)', 'niche', '150.00', 'Cherry/Walnut/Oak/Pine'),
(6, 'Bedside Table', 'Table', '200.00', 'Cherry/Walnut/Oak/Pine');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
