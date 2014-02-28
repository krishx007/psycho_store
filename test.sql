-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 28, 2014 at 07:58 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `postal` int(11) NOT NULL,
  `phone_number` bigint(11) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `user_id`, `first_name`, `last_name`, `address_1`, `address_2`, `city`, `state`, `country`, `postal`, `phone_number`) VALUES
(1, 1, 'Ishkaran', 'Singh', 'F5 Ganraj Heights, Sainikwadi', 'Wadgaon Sheri', 'Pune', 'Maharashtra', '', 411001, 7387045828),
(2, 2, 'Ishkaran', 'Singh', 'F5 Ganraj Heights, Sainikwadi', 'Wadgaon Sheri', 'Pune', 'Maharashtra', '', 411001, 7387045828),
(3, 1, '', '', 'Ubisoft, Level 6, Kumar Cerebrum', 'Kalynai nagar', 'Pune', 'Maharashtra', '', 411001, 7387045828),
(4, 1, '', '', 'f5,ganraj heights', 'cdvfv', 'cdvcdv', 'cdvdfv', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('1902b73db7dd99882ab2685896c00a7a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', 1393617514, 'a:2:{s:13:"cart_contents";a:4:{s:32:"eccbf08a16d1b2819fbe45b34cb5b3f5";a:7:{s:5:"rowid";s:32:"eccbf08a16d1b2819fbe45b34cb5b3f5";s:2:"id";s:1:"2";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:18:"Can you walk dead?";s:7:"options";a:1:{s:4:"size";s:5:"small";}s:8:"subtotal";i:600;}s:32:"f196f670f9d70aa6ffd7e07a694571bc";a:7:{s:5:"rowid";s:32:"f196f670f9d70aa6ffd7e07a694571bc";s:2:"id";s:1:"3";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:16:"Get Sherlocked !";s:7:"options";a:1:{s:4:"size";s:6:"Medium";}s:8:"subtotal";i:600;}s:11:"total_items";i:2;s:10:"cart_total";i:1200;}s:2:"2s";s:32:"eccbf08a16d1b2819fbe45b34cb5b3f5";}');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `address_id`) VALUES
(1, 1, 3),
(2, 1, 3),
(3, 1, 1),
(4, 1, 3),
(5, 1, 1),
(6, 1, 3),
(7, 1, 3),
(8, 1, 3),
(9, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `order_items_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` text NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`order_items_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `size`, `count`) VALUES
(1, 1, 5, 'large', 1),
(2, 1, 1, 'small', 2),
(3, 2, 3, 'large', 1),
(4, 3, 4, 'medium', 2),
(5, 3, 3, 'large', 1),
(6, 4, 2, 'medium', 1),
(7, 5, 2, 'medium', 3),
(8, 6, 1, 'large', 1),
(9, 6, 5, 'medium', 1),
(10, 7, 4, 'small', 1),
(11, 7, 1, 'large', 1),
(12, 8, 3, 'small', 1),
(13, 8, 4, 'medium', 1),
(14, 9, 4, 'large', 1),
(15, 9, 2, 'large', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` enum('tshirt','hoodie','bag','wallet') NOT NULL DEFAULT 'tshirt',
  `product_game` text,
  `product_name` text,
  `product_desc` text NOT NULL,
  `product_image_path` char(100) DEFAULT 'images\\johnybravo.png',
  `product_price` int(11) NOT NULL DEFAULT '600',
  `product_count_small` int(11) NOT NULL DEFAULT '10',
  `product_count_medium` int(11) NOT NULL DEFAULT '20',
  `product_count_large` int(11) NOT NULL DEFAULT '20',
  `product_count_xl` int(11) NOT NULL DEFAULT '10',
  `product_qty_sold` int(11) DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_type`, `product_game`, `product_name`, `product_desc`, `product_image_path`, `product_price`, `product_count_small`, `product_count_medium`, `product_count_large`, `product_count_xl`, `product_qty_sold`) VALUES
(1, 'tshirt', 'Half Life 2', 'Coshish', '', 'images\\coshish.png', 600, 20, 20, 20, 10, 15),
(2, 'tshirt', 'Doom 3', 'Can you walk dead?', '', 'images\\walkingdead.png', 600, 20, 20, 20, 10, 7),
(3, 'tshirt', 'Half life 2', 'Get Sherlocked !', '', 'images\\sherlock.png', 600, 20, 20, 20, 10, 8),
(4, 'tshirt', 'Dead Space', 'Join the club !', '', 'images\\fightclub.png', 600, 20, 20, 20, 10, 4),
(5, 'tshirt', 'Witcher', 'Which dog are you', '', 'images\\reservoirdogs.png', 600, 20, 20, 20, 10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 'Ishkaran', '$2a$08$3emZrsG1eFlN5vN5zKBCXOpTfs9JblIeZ9QPsvsC7YotQ73iR/JwO', 'ishkaran.singh@hotmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '2014-02-28 18:02:08', '2013-12-08 15:01:08', '2014-02-28 18:02:08'),
(2, 'ishu', '$2a$08$FntmR9k6tyhcUGZ4aYPyAOh2Dxu23Bd/BbB3MemlC/PfPz/O97Sd.', 'ishkaran.fearme@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '2013-12-08 15:04:11', '2013-12-08 15:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `website`) VALUES
(1, 1, NULL, NULL),
(2, 1, NULL, NULL),
(3, 2, NULL, NULL),
(4, 1, NULL, NULL),
(5, 1, NULL, NULL),
(6, 1, NULL, NULL),
(7, 1, NULL, NULL),
(8, 2, NULL, NULL),
(9, 1, NULL, NULL),
(10, 2, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
