-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2012 at 01:44 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xyz`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `orderno` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `baddress` varchar(200) NOT NULL,
  `saddress` varchar(200) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `orderno`, `uid`, `pid`, `quantity`, `baddress`, `saddress`, `payment`, `status`, `timestamp`) VALUES
(17, '2US0', 2, 4, 1, 'No.23,aaa hbbk, kjkj', 'No.23,aaa hbbk, kjkj', 'Credit Card', 'Shipped', '2012-10-07 13:40:11'),
(18, '2US0', 2, 5, 1, 'No.23,aaa hbbk, kjkj', 'No.23,aaa hbbk, kjkj', 'Credit Card', 'Shipped', '2012-10-07 13:40:11'),
(19, '2US2', 2, 5, 1, 'No.23,aaa hbbk, kjkj', 'No.23,aaa hbbk, kjkj', 'Cash', 'Shipped', '2012-10-07 13:43:47'),
(20, '2US2', 2, 6, 1, 'No.23,aaa hbbk, kjkj', 'No.23,aaa hbbk, kjkj', 'Cash', 'Shipped', '2012-10-07 13:43:47'),
(21, '3US4', 3, 5, 2, 'No.24,hvjhvhj, jbkjj', 'No.24,hvjhvhj, jbkjj', 'Debit Card', 'Shipped', '2012-10-07 13:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `thumburl` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `pname`, `description`, `category`, `price`, `stock`, `thumburl`, `timestamp`) VALUES
(4, 'Lenovo Laptops', 'HDD:500GB, DDR3:4GB', 'Computers', 47000, 100, 'images/product/061.jpg', '2012-10-06 04:20:07'),
(5, 'Heratin doll', 'Teddy with  heart', 'Toys', 470, 200, 'images/product/071.jpg', '2012-10-06 04:21:33'),
(6, 'Hammer', 'Hammer kit', 'Home Accessories', 4700, 300, 'images/product/011.jpg', '2012-10-07 08:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `mobile`, `password`, `type`, `timestamp`) VALUES
(1, 'Admin', 'admin', 0, 'password', 'A', '2012-10-05 17:31:21'),
(2, 'User1', 'user1@tcs.com', 2147483647, 'password', 'C', '2012-10-05 19:20:31'),
(3, 'User2', 'user2@tcs.com', 88888888, 'password', 'C', '2012-10-07 13:18:19');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
