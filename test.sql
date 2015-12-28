-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2015 at 12:42 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

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
  `address_2` text,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `pincode` int(11) NOT NULL,
  `phone_number` bigint(11) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `user_id`, `first_name`, `last_name`, `address_1`, `address_2`, `city`, `state`, `country`, `pincode`, `phone_number`) VALUES
(2, 1, 'Ishkaran', 'Singh', 'F5 Ganraj Heights, Sainikwadi', 'Wadgaon Sheri', 'Pune', 'Maharashtra', '', 411001, 7387045828),
(4, 1, 'Ishkaran', 'Singh', '55/2 Nanak Nagar', 'Lane 1', 'Jammu', 'Jammu and kashmir', '', 180004, 7387045828),
(5, 1, 'Ishkaran', 'Singh', 'F5 Ganraj Heights, Sainikwadi', 'Wadgaon Sheri', 'Pune', 'Maharashtra', '', 411001, 7387045828),
(6, 10, 'Ishkaran', 'Singh', 'F5 Ganraj Heights, Sainikwadi', 'Wadgaon Sheri', 'Pune', 'Maharashtra', '', 411001, 7387045828),
(7, 10, 'Ishkaran', 'Singh', 'F5 Ganraj Heights, Sainikwadi', 'Wadgaon Sheri', 'Pune', 'Maharashtra', 'Jupiter', 411001, 7387045828),
(8, 10, 'Ishkaran', 'Singh', 'F5 Ganraj Heights, Sainikwadi', 'Wadgaon Sheri', 'Pune', 'Maharashtra', 'India', 411001, 7387045828),
(9, 10, 'Ishkaran', 'Singh', 'F5 Ganraj Heights, Sainikwadi', 'Wadgaon Sheri', 'Pune', 'Maharashtra', 'India', 411001, 7387045828),
(10, 10, 'Ishkaran', 'Singh', '55/2 Nanak Nagar', 'Lane 1', 'Jammu', 'J&K', 'India', 180004, 7387045828),
(11, 1, 'Ishkaran', 'Singh', '55/2 Nanak Nagar', 'Lane 1', 'Jammu', 'J&K', 'India', 180004, 7387045828);

-- --------------------------------------------------------

--
-- Table structure for table `checkout_items`
--

CREATE TABLE IF NOT EXISTS `checkout_items` (
  `txn_id` varchar(20) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkout_items`
--

INSERT INTO `checkout_items` (`txn_id`, `product_id`, `count`, `size`) VALUES
('7c8ccbd12e', 11, 1, 'Small'),
('7c8ccbd12e', 10, 1, 'Small'),
('3258de05cb', 11, 1, 'Small'),
('3258de05cb', 10, 1, 'Small'),
('6bf60f5c4b', 11, 1, 'Small'),
('6bf60f5c4b', 10, 1, 'Small'),
('14e8fb0bef', 11, 1, 'Small'),
('14e8fb0bef', 10, 1, 'Small'),
('f878e4789b', 11, 1, 'Small'),
('f878e4789b', 10, 1, 'Small'),
('011ccf27be', 11, 1, 'Small'),
('011ccf27be', 10, 1, 'Small'),
('a14e3f2801', 11, 1, 'Small'),
('a14e3f2801', 10, 1, 'Small'),
('cd1be9ce1f', 12, 1, 'Medium'),
('7b810da9e4', 12, 1, 'Medium'),
('4b761c0035', 12, 1, 'Medium'),
('89045fabe1', 12, 1, 'Medium'),
('33027ec787', 12, 1, 'Medium'),
('039dad753f', 12, 1, 'Medium'),
('c16593e28d', 12, 1, 'Medium'),
('066170d16f', 12, 1, 'Medium'),
('9e71315114', 12, 1, 'Medium'),
('2a36f69b3a', 12, 1, 'Medium'),
('ff9f0fe3fe', 13, 1, 'Small'),
('cfd458c8c1', 13, 1, 'Small'),
('cf91cf8ac0', 13, 1, 'Small'),
('d9943e5e29', 13, 1, 'Small'),
('4c3692a4f2', 13, 1, 'Small'),
('11fcb7d231', 13, 1, 'Small'),
('09af5bfc48', 13, 1, 'Small'),
('1caf56b50f', 13, 1, 'Small'),
('df2fd21227', 13, 1, 'Small'),
('efe64ee780', 13, 1, 'Small'),
('2b620ccdd3', 13, 1, 'Small'),
('0790069387', 13, 1, 'Small'),
('a1582365c7', 13, 1, 'Small'),
('4ffeea3736', 13, 1, 'Small'),
('616f2d35f2', 13, 1, 'Small'),
('a8425a7a03', 13, 1, 'Small'),
('4e4e45614b', 13, 1, 'Small'),
('c8d701cd10', 13, 1, 'Small'),
('856babf7ab', 13, 1, 'Small'),
('e28c6d4357', 13, 1, 'Small'),
('f125d080f0', 13, 1, 'Small'),
('d3986857f3', 13, 1, 'Small'),
('091869f96b', 13, 1, 'Small'),
('37b34257d2', 13, 1, 'Small'),
('00a2052bbd', 13, 1, 'Small'),
('6abc9115a0', 13, 1, 'Small'),
('69320d4966', 13, 1, 'Small'),
('1418640126', 11, 1, 'Small'),
('548eba5f', 13, 2, 'Small'),
('54ca77a0', 4, 1, 'Small'),
('54cd432f', 14, 3, 'Small');

-- --------------------------------------------------------

--
-- Table structure for table `checkout_orders`
--

CREATE TABLE IF NOT EXISTS `checkout_orders` (
  `txn_id` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` int(11) DEFAULT NULL,
  `state` enum('open','locked') NOT NULL DEFAULT 'open',
  UNIQUE KEY `txn_id` (`txn_id`),
  UNIQUE KEY `txn_id_2` (`txn_id`),
  UNIQUE KEY `txn_id_3` (`txn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkout_orders`
--

INSERT INTO `checkout_orders` (`txn_id`, `user_id`, `address_id`, `date_created`, `amount`, `state`) VALUES
('7c8ccbd12e', 1, 5, '2014-12-09 20:48:50', 1200, 'locked'),
('3258de05cb', 1, 5, '2014-12-09 20:51:13', 1200, 'locked'),
('6bf60f5c4b', 1, 5, '2014-12-09 20:54:15', 1200, 'locked'),
('14e8fb0bef', 1, 5, '2014-12-09 20:54:48', 1200, 'locked'),
('f878e4789b', 1, 5, '2014-12-09 21:07:26', 1200, 'locked'),
('011ccf27be', 1, 5, '2014-12-09 21:13:26', 1200, 'locked'),
('a14e3f2801', 1, 5, '2014-12-09 21:16:44', 1200, 'locked'),
('cd1be9ce1f', 1, 5, '2014-12-09 21:18:11', 600, 'locked'),
('7b810da9e4', 1, 5, '2014-12-09 21:19:57', 600, 'locked'),
('4b761c0035', 1, 5, '2014-12-09 21:20:57', 600, 'locked'),
('89045fabe1', 1, 5, '2014-12-09 21:22:10', 600, 'locked'),
('33027ec787', 1, 5, '2014-12-09 21:22:34', 600, 'locked'),
('039dad753f', 1, 5, '2014-12-09 21:23:39', 600, 'locked'),
('c16593e28d', 1, 5, '2014-12-09 22:25:41', 600, 'locked'),
('066170d16f', 1, 5, '2014-12-10 17:54:06', 600, 'locked'),
('9e71315114', 1, 5, '2014-12-10 17:56:01', 450, 'locked'),
('2a36f69b3a', 1, 5, '2014-12-10 17:56:21', 450, 'locked'),
('ff9f0fe3fe', 1, 5, '2014-12-13 10:09:40', 600, 'locked'),
('cfd458c8c1', 1, 5, '2014-12-13 11:18:38', 600, 'locked'),
('cf91cf8ac0', 1, 5, '2014-12-14 15:16:36', 600, 'locked'),
('d9943e5e29', 1, 5, '2014-12-14 15:17:01', 600, 'locked'),
('4c3692a4f2', 1, 5, '2014-12-14 15:17:40', 600, 'locked'),
('11fcb7d231', 1, 5, '2014-12-14 15:19:25', 600, 'locked'),
('09af5bfc48', 1, 5, '2014-12-14 15:20:26', 600, 'locked'),
('1caf56b50f', 1, 5, '2014-12-14 15:20:43', 600, 'locked'),
('df2fd21227', 1, 5, '2014-12-14 15:21:48', 600, 'locked'),
('efe64ee780', 1, 5, '2014-12-14 15:23:53', 600, 'locked'),
('2b620ccdd3', 1, 5, '2014-12-14 15:25:01', 600, 'locked'),
('0790069387', 1, 5, '2014-12-14 15:25:17', 600, 'locked'),
('a1582365c7', 1, 5, '2014-12-14 15:26:16', 600, 'locked'),
('4ffeea3736', 1, 5, '2014-12-14 15:26:47', 600, 'locked'),
('616f2d35f2', 1, 5, '2014-12-14 15:27:47', 600, 'locked'),
('a8425a7a03', 1, 5, '2014-12-14 15:28:54', 600, 'locked'),
('4e4e45614b', 1, 5, '2014-12-14 15:30:53', 600, 'locked'),
('c8d701cd10', 1, 5, '2014-12-14 15:31:16', 600, 'locked'),
('856babf7ab', 1, 5, '2014-12-14 15:31:49', 600, 'locked'),
('e28c6d4357', 1, 5, '2014-12-14 15:34:52', 600, 'locked'),
('f125d080f0', 1, 5, '2014-12-14 15:35:17', 600, 'locked'),
('d3986857f3', 1, 5, '2014-12-14 16:21:47', 600, 'locked'),
('091869f96b', 1, 5, '2014-12-14 16:29:03', 600, 'locked'),
('37b34257d2', 1, 5, '2014-12-14 16:29:21', 600, 'locked'),
('00a2052bbd', 1, 5, '2014-12-14 16:30:46', 600, 'locked'),
('6abc9115a0', 1, 5, '2014-12-14 16:31:29', 600, 'locked'),
('69320d4966', 1, 5, '2014-12-14 16:37:04', 600, 'locked'),
('548eba5f', 10, 10, '2014-12-15 10:39:27', 900, 'locked'),
('548EBAFE', NULL, NULL, '2014-12-15 10:42:06', 600, 'open'),
('54ca77a0', 10, 9, '2015-01-29 18:10:40', 600, 'locked'),
('54cd432f', 10, 8, '2015-01-31 21:03:43', 1797, 'locked');

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
('0461322dcdb96935867b185cafdfd707', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1419433350, 'a:7:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:6:{i:0;a:14:{s:10:"product_id";s:1:"3";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half life 2";s:12:"product_name";s:16:"Get Sherlocked !";s:11:"product_url";s:40:"half life 2 gaming tshirt sherlock india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:19:"images/sherlock.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:1:"9";s:16:"product_qty_sold";s:1:"9";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:1;a:14:{s:10:"product_id";s:1:"8";s:12:"product_type";s:6:"Hoodie";s:12:"product_game";s:4:"Wolf";s:12:"product_name";s:7:"RedWolf";s:11:"product_url";s:24:"wolf gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/wolf.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"18";s:19:"product_count_large";s:2:"18";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"4";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:2;a:14:{s:10:"product_id";s:1:"4";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:10:"Dead Space";s:12:"product_name";s:15:"Join the club !";s:11:"product_url";s:35:"dead space gaming tshirt club india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:20:"images/fightclub.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"17";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"7";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:3;a:14:{s:10:"product_id";s:1:"6";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half Life 2";s:12:"product_name";s:13:"Bahadur Bille";s:11:"product_url";s:45:"half life 2 bahadur bille gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:19:"images/swatkats.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"8";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"19";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"3";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:4;a:14:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"0";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"11";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:5;a:14:{s:10:"product_id";s:2:"11";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:6:"Bender";s:11:"product_url";s:39:"breaking bad gaming bender tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:17:"images/bender.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"6";s:20:"product_count_medium";s:2:"17";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:1:"6";s:16:"product_qty_sold";s:2:"11";s:12:"product_date";s:19:"2014-12-09 01:13:46";}}s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"d9f677a778138da19fbf069dfe2bf1f4";a:7:{s:5:"rowid";s:32:"d9f677a778138da19fbf069dfe2bf1f4";s:2:"id";s:2:"13";s:3:"qty";s:1:"2";s:5:"price";s:3:"600";s:4:"name";s:20:"Heisenberg Principal";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:1200;}s:11:"total_items";i:2;s:10:"cart_total";i:1200;s:11:"final_price";i:1200;}s:6:"txn_id";s:8:"548eba5f";s:7:"user_id";s:2:"10";s:8:"username";s:8:"Ishkaran";s:6:"status";s:1:"1";}'),
('121ad889017135d5813554870bc8b58e', '127.0.0.1', 'Opera/9.80 (Windows NT 6.1; U; Opera Next; en) Presto/2.8.131 Version/11.50', 1411336267, 'a:3:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:1:{i:13;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}}s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"d9f677a778138da19fbf069dfe2bf1f4";a:7:{s:5:"rowid";s:32:"d9f677a778138da19fbf069dfe2bf1f4";s:2:"id";s:2:"13";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:20:"Heisenberg Principal";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";i:600;}}'),
('141657d9040ce0621b34d80647cd1769', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.103 Safari/537.36', 1410266577, 'a:5:{s:9:"user_data";s:0:"";s:13:"cart_contents";a:3:{s:32:"8a49cb4152fad329729e88ebe345908a";a:7:{s:5:"rowid";s:32:"8a49cb4152fad329729e88ebe345908a";s:2:"id";s:2:"12";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:4:"Goku";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;}s:7:"user_id";s:1:"1";s:8:"username";s:8:"Ishkaran";s:6:"status";s:1:"1";}'),
('1b611c92d318b8b2ac51832b972bd839', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36', 1422646201, 'a:5:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"10";s:8:"username";s:8:"Ishkaran";s:6:"status";s:1:"1";s:13:"cart_contents";a:4:{s:8:"discount";i:0;s:11:"total_items";i:0;s:10:"cart_total";i:0;s:11:"final_price";i:0;}}'),
('2e6fe2bc2e92c6f785bb4821cee14a18', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36', 1401643720, 'a:1:{s:13:"cart_contents";a:3:{s:32:"1da854bf7e353eb8caf143e63e8ef932";a:7:{s:5:"rowid";s:32:"1da854bf7e353eb8caf143e63e8ef932";s:2:"id";s:1:"5";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:17:"Which dog are you";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;}}'),
('43d442ea1e4c1d6cff147a0d7dcedf7d', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36', 1422657935, 'a:4:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"10";s:8:"username";s:8:"Ishkaran";s:6:"status";s:1:"1";}'),
('503e3abb494a9333445274ca6972c2f4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', 1418153681, 'a:1:{s:15:"recently_viewed";a:1:{i:13;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}}}'),
('51c98f0806e6bbe52671a73b68af8d40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', 1418255426, 'a:8:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:6:{i:0;a:13:{s:10:"product_id";s:1:"7";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Harry Potter";s:12:"product_name";s:17:"Catch that Snitch";s:11:"product_url";s:39:"harry potter gaming tshirt india snitch";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:22:"images/harrypotter.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:1:"8";s:16:"product_qty_sold";s:1:"3";}i:1;a:13:{s:10:"product_id";s:2:"11";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:6:"Bender";s:11:"product_url";s:39:"breaking bad gaming bender tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:17:"images/bender.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:1:"7";s:16:"product_qty_sold";s:1:"3";}i:2;a:13:{s:10:"product_id";s:2:"10";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:11:"Golden moth";s:11:"product_url";s:36:"breaking bad tshirt goldenmoth india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/goldenmoth.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"17";s:16:"product_count_xl";s:1:"8";s:16:"product_qty_sold";s:1:"5";}i:3;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"6";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"4";}i:4;a:13:{s:10:"product_id";s:1:"2";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:6:"Doom 3";s:12:"product_name";s:18:"Can you walk dead?";s:11:"product_url";s:39:"doom 3 gaming tshirt walking dead india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:22:"images/walkingdead.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"15";s:16:"product_count_xl";s:1:"8";s:16:"product_qty_sold";s:2:"25";}i:5;a:14:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"0";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"11";s:12:"product_date";s:19:"2014-12-09 01:13:46";}}s:7:"user_id";s:1:"1";s:8:"username";s:8:"AsS^Ss!n";s:6:"status";s:1:"1";s:6:"txn_id";s:10:"2a36f69b3a";s:13:"cart_contents";a:5:{s:8:"discount";s:2:"25";s:32:"e643b8f40655342a5ed2f3259dd8fc73";a:7:{s:5:"rowid";s:32:"e643b8f40655342a5ed2f3259dd8fc73";s:2:"id";s:2:"12";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:4:"Goku";s:7:"options";a:1:{s:4:"Size";s:6:"Medium";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";d:450;}s:21:"flash:old:ok_to_order";b:1;}'),
('5594c7fe5efd45ac6a54d883e6050cd2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1411420261, 'a:6:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:6:{i:0;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:1;a:13:{s:10:"product_id";s:1:"5";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:7:"Witcher";s:12:"product_name";s:17:"Which dog are you";s:11:"product_url";s:31:"witcher gaming tshirt dog india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:24:"images/reservoirdogs.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"12";}i:2;a:13:{s:10:"product_id";s:1:"6";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half Life 2";s:12:"product_name";s:13:"Bahadur Bille";s:11:"product_url";s:45:"half life 2 bahadur bille gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:19:"images/swatkats.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:3;a:13:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"2";}i:4;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"1";}i:8;a:13:{s:10:"product_id";s:1:"8";s:12:"product_type";s:6:"Hoodie";s:12:"product_game";s:4:"Wolf";s:12:"product_name";s:7:"RedWolf";s:11:"product_url";s:24:"wolf gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/wolf.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}}s:7:"user_id";s:0:"";s:8:"username";s:0:"";s:6:"status";s:0:"";s:13:"cart_contents";a:4:{s:8:"discount";i:0;s:11:"total_items";i:0;s:10:"cart_total";i:0;s:11:"final_price";i:0;}}'),
('5aef24f05029511836ceea96552f113c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1411056604, 'a:8:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:6:{i:0;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:1;a:13:{s:10:"product_id";s:1:"8";s:12:"product_type";s:6:"Hoodie";s:12:"product_game";s:4:"Wolf";s:12:"product_name";s:7:"RedWolf";s:11:"product_url";s:24:"wolf gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/wolf.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:2;a:13:{s:10:"product_id";s:2:"10";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:11:"Golden moth";s:11:"product_url";s:36:"breaking bad tshirt goldenmoth india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/goldenmoth.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:3;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:4;a:13:{s:10:"product_id";s:2:"11";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:6:"Bender";s:11:"product_url";s:39:"breaking bad gaming bender tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:17:"images/bender.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:12;a:13:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"2";}}s:7:"user_id";s:1:"1";s:8:"username";s:8:"AsS^Ss!n";s:6:"status";s:1:"1";s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"bbcc2205eedd2a5a8dfb2a64c45fcac7";a:7:{s:5:"rowid";s:32:"bbcc2205eedd2a5a8dfb2a64c45fcac7";s:2:"id";s:1:"2";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:18:"Can you walk dead?";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";i:600;}s:20:"checkout_in_progress";s:4:"TRUE";s:16:"shipping_address";a:11:{s:10:"address_id";s:1:"5";s:7:"user_id";s:1:"1";s:10:"first_name";s:8:"Ishkaran";s:9:"last_name";s:5:"Singh";s:9:"address_1";s:29:"F5 Ganraj Heights, Sainikwadi";s:9:"address_2";s:13:"Wadgaon Sheri";s:4:"city";s:4:"Pune";s:5:"state";s:11:"Maharashtra";s:7:"country";s:0:"";s:7:"pincode";s:6:"411001";s:12:"phone_number";s:10:"7387045828";}}'),
('620c7874b46eb60b51bbf66cf33f5807', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.104 Safari/537.36', 1414064685, 'a:3:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:1:{i:12;a:13:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"2";}}s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"8a49cb4152fad329729e88ebe345908a";a:7:{s:5:"rowid";s:32:"8a49cb4152fad329729e88ebe345908a";s:2:"id";s:2:"12";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:4:"Goku";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";i:600;}}'),
('6215cf6bb36c17aa67690a608b9b40e9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', 1404841619, 'a:1:{s:13:"cart_contents";a:3:{s:32:"d9f677a778138da19fbf069dfe2bf1f4";a:7:{s:5:"rowid";s:32:"d9f677a778138da19fbf069dfe2bf1f4";s:2:"id";s:2:"13";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:20:"Heisenberg Principal";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;}}'),
('64c54633a39f0fb1776455a11c8f6db4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1411335077, 'a:2:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:6:{i:13;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:1;a:13:{s:10:"product_id";s:1:"1";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half Life 2";s:12:"product_name";s:7:"Coshish";s:11:"product_url";s:32:"half life 2 tshirt coshish india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:18:"images/coshish.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"15";}i:2;a:13:{s:10:"product_id";s:1:"2";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:6:"Doom 3";s:12:"product_name";s:18:"Can you walk dead?";s:11:"product_url";s:39:"doom 3 gaming tshirt walking dead india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:22:"images/walkingdead.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"19";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"8";}i:3;a:13:{s:10:"product_id";s:1:"3";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half life 2";s:12:"product_name";s:16:"Get Sherlocked !";s:11:"product_url";s:40:"half life 2 gaming tshirt sherlock india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:19:"images/sherlock.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"8";}i:4;a:13:{s:10:"product_id";s:1:"4";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:10:"Dead Space";s:12:"product_name";s:15:"Join the club !";s:11:"product_url";s:35:"dead space gaming tshirt club india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:20:"images/fightclub.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"4";}i:12;a:13:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"2";}}}'),
('658f7c6000594fc021e6367c4c03a603', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.104 Safari/537.36', 1414063391, 'a:2:{s:15:"recently_viewed";a:5:{i:0;a:13:{s:10:"product_id";s:1:"8";s:12:"product_type";s:6:"Hoodie";s:12:"product_game";s:4:"Wolf";s:12:"product_name";s:7:"RedWolf";s:11:"product_url";s:24:"wolf gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/wolf.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"19";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"1";}i:1;a:13:{s:10:"product_id";s:2:"10";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:11:"Golden moth";s:11:"product_url";s:36:"breaking bad tshirt goldenmoth india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/goldenmoth.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:2;a:13:{s:10:"product_id";s:1:"2";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:6:"Doom 3";s:12:"product_name";s:18:"Can you walk dead?";s:11:"product_url";s:39:"doom 3 gaming tshirt walking dead india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:22:"images/walkingdead.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"19";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"8";}i:3;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"1";}i:4;a:13:{s:10:"product_id";s:1:"1";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half Life 2";s:12:"product_name";s:7:"Coshish";s:11:"product_url";s:32:"half life 2 tshirt coshish india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:18:"images/coshish.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"15";}}s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"7a7147eef9216e1a9311914f3ab480c8";a:7:{s:5:"rowid";s:32:"7a7147eef9216e1a9311914f3ab480c8";s:2:"id";s:1:"8";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:7:"RedWolf";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";i:600;}}'),
('67c3faf297e0c1e86b00d05dcdd565bf', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.103 Safari/537.36', 1410471632, 'a:5:{s:9:"user_data";s:0:"";s:13:"cart_contents";a:5:{s:8:"discount";s:2:"25";s:32:"bbcc2205eedd2a5a8dfb2a64c45fcac7";a:7:{s:5:"rowid";s:32:"bbcc2205eedd2a5a8dfb2a64c45fcac7";s:2:"id";s:1:"2";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:18:"Can you walk dead?";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";d:450;}s:7:"user_id";s:1:"1";s:8:"username";s:8:"AsS^Ss!n";s:6:"status";s:1:"1";}'),
('6b8b839fa18297fe7994b09af05bd88f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', 1404841619, ''),
('711931678cb8d7ac509847b1f41dc6df', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.103 Safari/537.36', 1410375632, ''),
('7fb300a2dfd4b8070804c4f24938837f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36', 1401036140, ''),
('82fb210183677d464a175c888e0209d0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1416341775, ''),
('8d822692f954e3d58439881a23d8ad31', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1411335607, 'a:2:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:4:{i:13;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:8;a:13:{s:10:"product_id";s:1:"8";s:12:"product_type";s:6:"Hoodie";s:12:"product_game";s:4:"Wolf";s:12:"product_name";s:7:"RedWolf";s:11:"product_url";s:24:"wolf gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/wolf.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:12;a:13:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"2";}i:2;a:13:{s:10:"product_id";s:1:"2";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:6:"Doom 3";s:12:"product_name";s:18:"Can you walk dead?";s:11:"product_url";s:39:"doom 3 gaming tshirt walking dead india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:22:"images/walkingdead.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"19";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"8";}}}'),
('8febb777dbe996d2efa0c92f8fc30d68', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1411335407, 'a:2:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:2:{i:13;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:1;a:13:{s:10:"product_id";s:1:"1";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half Life 2";s:12:"product_name";s:7:"Coshish";s:11:"product_url";s:32:"half life 2 tshirt coshish india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:18:"images/coshish.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"15";}}}'),
('985094c81ed729396d3512347ae5afdd', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1411336494, 'a:2:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:3:{i:12;a:13:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"2";}i:1;a:13:{s:10:"product_id";s:1:"1";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half Life 2";s:12:"product_name";s:7:"Coshish";s:11:"product_url";s:32:"half life 2 tshirt coshish india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:18:"images/coshish.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"15";}i:8;a:13:{s:10:"product_id";s:1:"8";s:12:"product_type";s:6:"Hoodie";s:12:"product_game";s:4:"Wolf";s:12:"product_name";s:7:"RedWolf";s:11:"product_url";s:24:"wolf gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/wolf.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}}}'),
('9a3d965e2c1444ce03b7263c9ecaf5ea', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', 1417888044, 'a:4:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:1:{i:0;a:13:{s:10:"product_id";s:2:"11";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:6:"Bender";s:11:"product_url";s:39:"breaking bad gaming bender tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:17:"images/bender.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}}s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"2e9d3e9bb7c80f82efa1f57335049190";a:7:{s:5:"rowid";s:32:"2e9d3e9bb7c80f82efa1f57335049190";s:2:"id";s:2:"11";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:6:"Bender";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";i:600;}s:6:"txn_id";s:10:"ea296ad105";}'),
('9e4c1905f4c274ae65bad0e56fb6bafb', '127.0.0.1', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_3; en-us; Silk/1.0.141.16-Gen4_11004310) AppleWebkit/533.16 (KHTML, like ', 1414063594, ''),
('9ff0963106d7fef5db9f448c756886b1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1411077447, 'a:6:{s:9:"user_data";s:0:"";s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"60c80d25a22696cbd25785ba29e174cc";a:7:{s:5:"rowid";s:32:"60c80d25a22696cbd25785ba29e174cc";s:2:"id";s:1:"3";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:16:"Get Sherlocked !";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";i:600;}s:7:"user_id";s:0:"";s:8:"username";s:0:"";s:6:"status";s:0:"";s:15:"recently_viewed";a:6:{i:0;a:13:{s:10:"product_id";s:1:"5";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:7:"Witcher";s:12:"product_name";s:17:"Which dog are you";s:11:"product_url";s:31:"witcher gaming tshirt dog india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:24:"images/reservoirdogs.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"12";}i:1;a:13:{s:10:"product_id";s:2:"11";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:6:"Bender";s:11:"product_url";s:39:"breaking bad gaming bender tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:17:"images/bender.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:2;a:13:{s:10:"product_id";s:1:"8";s:12:"product_type";s:6:"Hoodie";s:12:"product_game";s:4:"Wolf";s:12:"product_name";s:7:"RedWolf";s:11:"product_url";s:24:"wolf gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/wolf.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:3;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:4;a:13:{s:10:"product_id";s:2:"11";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:6:"Bender";s:11:"product_url";s:39:"breaking bad gaming bender tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:17:"images/bender.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:7;a:13:{s:10:"product_id";s:1:"7";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Harry Potter";s:12:"product_name";s:17:"Catch that Snitch";s:11:"product_url";s:39:"harry potter gaming tshirt india snitch";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:22:"images/harrypotter.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}}}'),
('a1e7900c45e16dfaada08fd962bf9275', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.94 Safari/537.36', 1422792164, 'a:5:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"10";s:8:"username";s:8:"Ishkaran";s:6:"status";s:1:"1";s:15:"recently_viewed";a:6:{i:0;a:14:{s:10:"product_id";s:1:"8";s:12:"product_type";s:6:"Hoodie";s:12:"product_game";s:4:"Wolf";s:12:"product_name";s:7:"RedWolf";s:11:"product_url";s:24:"wolf gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/wolf.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"18";s:19:"product_count_large";s:2:"18";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"4";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:1;a:14:{s:10:"product_id";s:2:"10";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:11:"Golden moth";s:11:"product_url";s:36:"breaking bad tshirt goldenmoth india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/goldenmoth.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"8";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"17";s:16:"product_count_xl";s:1:"8";s:16:"product_qty_sold";s:1:"7";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:2;a:14:{s:10:"product_id";s:2:"11";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:6:"Bender";s:11:"product_url";s:39:"breaking bad gaming bender tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:17:"images/bender.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"6";s:20:"product_count_medium";s:2:"17";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:1:"6";s:16:"product_qty_sold";s:2:"11";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:3;a:14:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"0";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"11";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:4;a:14:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"2";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:1:"8";s:16:"product_qty_sold";s:2:"10";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:5;a:14:{s:10:"product_id";s:2:"14";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:6:"Doom 3";s:12:"product_name";s:42:"Wholly fuck the Doom Moster Is Coming Near";s:11:"product_url";s:25:"doom3 gaming tshirt india";s:12:"product_desc";s:193:"Be prepared the monster of the mosters, DOOM is coming near and so is the end along with it.\r\nPay your tribute to one of the scariest and best fps ever created and yeah to John Carmack as well.";s:18:"product_image_path";s:21:"images/goldenmoth.png";s:13:"product_price";s:3:"599";s:19:"product_count_small";s:2:"17";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"20";s:16:"product_qty_sold";s:1:"3";s:12:"product_date";s:19:"2015-02-01 02:32:14";}}}'),
('a3f253e9790767629638e2573fbc1e1e', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3', 1410972883, ''),
('a8ca5d98e12537f9a984a1cd3b635f65', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.131 Safari/537.36', 1401024197, ''),
('ac48929385624d920c70989b2a11351a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1411335448, 'a:2:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:3:{i:13;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:11;a:13:{s:10:"product_id";s:2:"11";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:6:"Bender";s:11:"product_url";s:39:"breaking bad gaming bender tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:17:"images/bender.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:12;a:13:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"2";}}}'),
('ad8d10dc5097766ad0b9ee3a12cf59c8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', 1417815344, 'a:7:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:6:{i:0;a:13:{s:10:"product_id";s:1:"4";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:10:"Dead Space";s:12:"product_name";s:15:"Join the club !";s:11:"product_url";s:35:"dead space gaming tshirt club india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:20:"images/fightclub.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"19";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"5";}i:1;a:13:{s:10:"product_id";s:1:"5";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:7:"Witcher";s:12:"product_name";s:17:"Which dog are you";s:11:"product_url";s:31:"witcher gaming tshirt dog india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:24:"images/reservoirdogs.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"19";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"13";}i:2;a:13:{s:10:"product_id";s:1:"6";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half Life 2";s:12:"product_name";s:13:"Bahadur Bille";s:11:"product_url";s:45:"half life 2 bahadur bille gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:19:"images/swatkats.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"19";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"2";}i:3;a:13:{s:10:"product_id";s:1:"7";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Harry Potter";s:12:"product_name";s:17:"Catch that Snitch";s:11:"product_url";s:39:"harry potter gaming tshirt india snitch";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:22:"images/harrypotter.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:4;a:13:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"4";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"7";}i:5;a:13:{s:10:"product_id";s:2:"11";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:6:"Bender";s:11:"product_url";s:39:"breaking bad gaming bender tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:17:"images/bender.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}}s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"8a49cb4152fad329729e88ebe345908a";a:7:{s:5:"rowid";s:32:"8a49cb4152fad329729e88ebe345908a";s:2:"id";s:2:"12";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:4:"Goku";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";i:600;}s:7:"user_id";s:2:"10";s:8:"username";s:8:"Ishkaran";s:6:"status";s:1:"1";s:6:"txn_id";s:10:"68d2cea872";}');
INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('b2063c8a53e1e3ec72146ef9a1d13f52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1416519214, 'a:7:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:6:{i:0;a:13:{s:10:"product_id";s:1:"7";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Harry Potter";s:12:"product_name";s:17:"Catch that Snitch";s:11:"product_url";s:39:"harry potter gaming tshirt india snitch";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:22:"images/harrypotter.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:1;a:13:{s:10:"product_id";s:2:"10";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:11:"Golden moth";s:11:"product_url";s:36:"breaking bad tshirt goldenmoth india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/goldenmoth.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:2;a:13:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"2";}i:3;a:13:{s:10:"product_id";s:1:"1";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half Life 2";s:12:"product_name";s:7:"Coshish";s:11:"product_url";s:32:"half life 2 tshirt coshish india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:18:"images/coshish.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"15";}i:4;a:13:{s:10:"product_id";s:1:"3";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half life 2";s:12:"product_name";s:16:"Get Sherlocked !";s:11:"product_url";s:40:"half life 2 gaming tshirt sherlock india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:19:"images/sherlock.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:1:"9";s:16:"product_qty_sold";s:1:"9";}i:5;a:13:{s:10:"product_id";s:1:"4";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:10:"Dead Space";s:12:"product_name";s:15:"Join the club !";s:11:"product_url";s:35:"dead space gaming tshirt club india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:20:"images/fightclub.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"4";}}s:7:"user_id";s:2:"10";s:8:"username";s:8:"Ishkaran";s:6:"status";s:1:"1";s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"786cc1ce2b8dd6de9be8cc9d024f683c";a:7:{s:5:"rowid";s:32:"786cc1ce2b8dd6de9be8cc9d024f683c";s:2:"id";s:1:"4";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:15:"Join the club !";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";i:600;}s:16:"shipping_address";a:11:{s:10:"address_id";s:1:"6";s:7:"user_id";s:2:"10";s:10:"first_name";s:8:"Ishkaran";s:9:"last_name";s:5:"Singh";s:9:"address_1";s:29:"F5 Ganraj Heights, Sainikwadi";s:9:"address_2";s:13:"Wadgaon Sheri";s:4:"city";s:4:"Pune";s:5:"state";s:11:"Maharashtra";s:7:"country";s:0:"";s:7:"pincode";s:6:"411001";s:12:"phone_number";s:10:"7387045828";}}'),
('b7e1d6615d72c81cb67d1375080a904d', '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0)', 1411335690, ''),
('beadeac4d870425b447e9d56d8aaa403', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1418640117, 'a:4:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:1:{i:0;a:14:{s:10:"product_id";s:2:"11";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:6:"Bender";s:11:"product_url";s:39:"breaking bad gaming bender tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:17:"images/bender.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"6";s:20:"product_count_medium";s:2:"17";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:1:"6";s:16:"product_qty_sold";s:2:"11";s:12:"product_date";s:19:"2014-12-09 01:13:46";}}s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"2e9d3e9bb7c80f82efa1f57335049190";a:7:{s:5:"rowid";s:32:"2e9d3e9bb7c80f82efa1f57335049190";s:2:"id";s:2:"11";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:6:"Bender";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";i:600;}s:6:"txn_id";i:1418640126;}'),
('c0401524ce86e0394795fbfe7ef0685c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', 1403431894, ''),
('c7b4ba13d5f514ae5eb3d3fa9443fd32', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.94 Safari/537.36', 1422743175, 'a:5:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"10";s:8:"username";s:8:"Ishkaran";s:6:"status";s:1:"1";s:15:"recently_viewed";a:4:{i:0;a:14:{s:10:"product_id";s:1:"4";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:10:"Dead Space";s:12:"product_name";s:15:"Join the club !";s:11:"product_url";s:35:"dead space gaming tshirt club india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:20:"images/fightclub.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"17";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"7";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:1;a:14:{s:10:"product_id";s:2:"10";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:11:"Golden moth";s:11:"product_url";s:36:"breaking bad tshirt goldenmoth india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/goldenmoth.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"8";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"17";s:16:"product_count_xl";s:1:"8";s:16:"product_qty_sold";s:1:"7";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:2;a:14:{s:10:"product_id";s:2:"14";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:6:"Doom 3";s:12:"product_name";s:15:"The End Is Near";s:11:"product_url";s:25:"doom3 gaming tshirt india";s:12:"product_desc";s:193:"Be prepared the monster of the mosters, DOOM is coming near and so is the end along with it.\r\nPay your tribute to one of the scariest and best fps ever created and yeah to John Carmack as well.";s:18:"product_image_path";s:21:"images/goldenmoth.png";s:13:"product_price";s:3:"599";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"20";s:16:"product_qty_sold";s:1:"0";s:12:"product_date";s:19:"2015-02-01 02:32:14";}i:3;a:14:{s:10:"product_id";s:1:"6";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half Life 2";s:12:"product_name";s:13:"Bahadur Bille";s:11:"product_url";s:45:"half life 2 bahadur bille gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:19:"images/swatkats.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"8";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"19";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"3";s:12:"product_date";s:19:"2014-12-09 01:13:46";}}}'),
('d613df39cdfc7750734834d61a23f359', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36', 1401045684, 'a:1:{s:13:"cart_contents";a:3:{s:32:"8a49cb4152fad329729e88ebe345908a";a:7:{s:5:"rowid";s:32:"8a49cb4152fad329729e88ebe345908a";s:2:"id";s:2:"12";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:4:"Goku";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;}}'),
('d9332946d18d7c26f31f1b0e76ff21ef', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36', 1422645695, 'a:7:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:6:{i:0;a:14:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"2";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:1:"8";s:16:"product_qty_sold";s:2:"10";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:1;a:14:{s:10:"product_id";s:1:"1";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half Life 2";s:12:"product_name";s:7:"Coshish";s:11:"product_url";s:32:"half life 2 tshirt coshish india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:18:"images/coshish.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"17";s:20:"product_count_medium";s:1:"9";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"29";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:2;a:14:{s:10:"product_id";s:1:"2";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:6:"Doom 3";s:12:"product_name";s:18:"Can you walk dead?";s:11:"product_url";s:39:"doom 3 gaming tshirt walking dead india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:22:"images/walkingdead.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"15";s:16:"product_count_xl";s:1:"8";s:16:"product_qty_sold";s:2:"26";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:3;a:14:{s:10:"product_id";s:1:"3";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half life 2";s:12:"product_name";s:16:"Get Sherlocked !";s:11:"product_url";s:40:"half life 2 gaming tshirt sherlock india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:19:"images/sherlock.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:1:"9";s:16:"product_qty_sold";s:1:"9";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:4;a:14:{s:10:"product_id";s:1:"4";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:10:"Dead Space";s:12:"product_name";s:15:"Join the club !";s:11:"product_url";s:35:"dead space gaming tshirt club india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:20:"images/fightclub.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"17";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"7";s:12:"product_date";s:19:"2014-12-09 01:13:46";}i:5;a:14:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"0";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"11";s:12:"product_date";s:19:"2014-12-09 01:13:46";}}s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"786cc1ce2b8dd6de9be8cc9d024f683c";a:7:{s:5:"rowid";s:32:"786cc1ce2b8dd6de9be8cc9d024f683c";s:2:"id";s:1:"4";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:15:"Join the club !";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";i:600;}s:6:"txn_id";s:8:"54ca77a0";s:7:"user_id";s:0:"";s:8:"username";s:0:"";s:6:"status";s:0:"";}'),
('dd6b125da5070b065e2d9a249fbb0a92', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1411332249, 'a:6:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:6:{i:0;a:13:{s:10:"product_id";s:1:"8";s:12:"product_type";s:6:"Hoodie";s:12:"product_game";s:4:"Wolf";s:12:"product_name";s:7:"RedWolf";s:11:"product_url";s:24:"wolf gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/wolf.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:1;a:13:{s:10:"product_id";s:2:"10";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:11:"Golden moth";s:11:"product_url";s:36:"breaking bad tshirt goldenmoth india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/goldenmoth.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:2;a:13:{s:10:"product_id";s:1:"7";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Harry Potter";s:12:"product_name";s:17:"Catch that Snitch";s:11:"product_url";s:39:"harry potter gaming tshirt india snitch";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:22:"images/harrypotter.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:3;a:13:{s:10:"product_id";s:1:"8";s:12:"product_type";s:6:"Hoodie";s:12:"product_game";s:4:"Wolf";s:12:"product_name";s:7:"RedWolf";s:11:"product_url";s:24:"wolf gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/wolf.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:4;a:13:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"2";}i:13;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}}s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"8a49cb4152fad329729e88ebe345908a";a:7:{s:5:"rowid";s:32:"8a49cb4152fad329729e88ebe345908a";s:2:"id";s:2:"12";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:4:"Goku";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";i:600;}s:7:"user_id";s:0:"";s:8:"username";s:0:"";s:6:"status";s:0:"";}'),
('edfe731cbd736c6beab3f9ca642746de', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1411333202, 'a:2:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:1:{i:13;a:13:{s:10:"product_id";s:2:"13";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Breaking Bad";s:12:"product_name";s:20:"Heisenberg Principal";s:11:"product_url";s:43:"breaking bad gaming tshirt heisneberg india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:21:"images/heisenberg.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}}}'),
('f2cce0ea0c1746d1abfb6cfd922f3641', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', 1417866979, 'a:7:{s:9:"user_data";s:0:"";s:15:"recently_viewed";a:6:{i:0;a:13:{s:10:"product_id";s:1:"5";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:7:"Witcher";s:12:"product_name";s:17:"Which dog are you";s:11:"product_url";s:31:"witcher gaming tshirt dog india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:24:"images/reservoirdogs.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"19";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:2:"13";}i:1;a:13:{s:10:"product_id";s:1:"3";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half life 2";s:12:"product_name";s:16:"Get Sherlocked !";s:11:"product_url";s:40:"half life 2 gaming tshirt sherlock india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:19:"images/sherlock.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"20";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:1:"9";s:16:"product_qty_sold";s:1:"9";}i:2;a:13:{s:10:"product_id";s:1:"4";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:10:"Dead Space";s:12:"product_name";s:15:"Join the club !";s:11:"product_url";s:35:"dead space gaming tshirt club india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:20:"images/fightclub.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"19";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"5";}i:3;a:13:{s:10:"product_id";s:1:"7";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:12:"Harry Potter";s:12:"product_name";s:17:"Catch that Snitch";s:11:"product_url";s:39:"harry potter gaming tshirt india snitch";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:22:"images/harrypotter.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:2:"10";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"0";}i:4;a:13:{s:10:"product_id";s:1:"6";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:11:"Half Life 2";s:12:"product_name";s:13:"Bahadur Bille";s:11:"product_url";s:45:"half life 2 bahadur bille gaming tshirt india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:19:"images/swatkats.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"9";s:20:"product_count_medium";s:2:"20";s:19:"product_count_large";s:2:"19";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"2";}i:5;a:13:{s:10:"product_id";s:2:"12";s:12:"product_type";s:6:"Tshirt";s:12:"product_game";s:13:"Dragon ball z";s:12:"product_name";s:4:"Goku";s:11:"product_url";s:38:"dragon ball z gaming tshirt goku india";s:12:"product_desc";s:0:"";s:18:"product_image_path";s:15:"images/goku.png";s:13:"product_price";s:3:"600";s:19:"product_count_small";s:1:"2";s:20:"product_count_medium";s:2:"19";s:19:"product_count_large";s:2:"20";s:16:"product_count_xl";s:2:"10";s:16:"product_qty_sold";s:1:"9";}}s:7:"user_id";s:2:"10";s:8:"username";s:8:"Ishkaran";s:6:"status";s:1:"1";s:13:"cart_contents";a:5:{s:8:"discount";i:0;s:32:"60c80d25a22696cbd25785ba29e174cc";a:7:{s:5:"rowid";s:32:"60c80d25a22696cbd25785ba29e174cc";s:2:"id";s:1:"3";s:3:"qty";s:1:"1";s:5:"price";s:3:"600";s:4:"name";s:16:"Get Sherlocked !";s:7:"options";a:1:{s:4:"Size";s:5:"Small";}s:8:"subtotal";i:600;}s:11:"total_items";i:1;s:10:"cart_total";i:600;s:11:"final_price";i:600;}s:6:"txn_id";s:10:"4e5078f46e";}');

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupons`
--

CREATE TABLE IF NOT EXISTS `discount_coupons` (
  `coupon` varchar(20) NOT NULL,
  `how_much` int(11) NOT NULL,
  `expiry` date NOT NULL,
  UNIQUE KEY `coupon` (`coupon`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount_coupons`
--

INSERT INTO `discount_coupons` (`coupon`, `how_much`, `expiry`) VALUES
('LAUNCH_TEST', 10, '2014-12-19'),
('psycho_gamer', 25, '2014-12-19');

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
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `email` varchar(128) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`email`, `time`) VALUES
('ishkaran.fearme@gmail.com', '2014-12-07 14:56:21'),
('ishkaran.singh@hotmail.com', '2014-05-11 14:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_amount` int(11) NOT NULL,
  `payment_mode` enum('cod','online') NOT NULL,
  `order_status` enum('pending','shipped','returned','') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `txn_id`, `user_id`, `address_id`, `date_created`, `date_modified`, `order_amount`, `payment_mode`, `order_status`) VALUES
(1, '1e8cd7bb9f', 1, 4, '2014-12-08 18:25:29', '2014-12-08 18:25:29', 600, 'online', 'pending'),
(2, '7ec086a0f6', 1, 5, '2014-12-08 19:54:13', '2014-12-08 19:54:13', 450, 'online', 'pending'),
(3, 'b79ccf732b', 1, 2, '2014-12-08 19:57:00', '2014-12-08 19:57:00', 900, 'online', 'pending'),
(4, '5d9f4fc982', 1, 5, '2014-12-09 21:17:43', '2014-12-09 21:17:43', 1200, 'cod', 'returned'),
(5, '54cd439e', 10, 10, '2015-01-31 21:05:41', '2015-01-31 21:05:41', 1797, 'cod', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `order_items_id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` text NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`order_items_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `txn_id`, `product_id`, `size`, `count`) VALUES
(1, '1e8cd7bb9f', 2, 'Medium', 1),
(2, '7ec086a0f6', 11, 'XL', 1),
(3, 'b79ccf732b', 13, 'XL', 2),
(4, '5d9f4fc982', 11, 'Small', 1),
(5, '5d9f4fc982', 10, 'Small', 1),
(6, '54cd439e', 14, 'Small', 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` enum('Tshirt','Hoodie','','') NOT NULL DEFAULT 'Tshirt',
  `product_game` text,
  `product_name` text,
  `product_url` varchar(128) DEFAULT NULL,
  `product_desc` text NOT NULL,
  `product_image_path` char(100) DEFAULT 'images\\johnybravo.png',
  `product_price` int(11) NOT NULL DEFAULT '600',
  `product_count_small` int(11) NOT NULL DEFAULT '10',
  `product_count_medium` int(11) NOT NULL DEFAULT '20',
  `product_count_large` int(11) NOT NULL DEFAULT '20',
  `product_count_xl` int(11) NOT NULL DEFAULT '10',
  `product_qty_sold` int(11) DEFAULT '0',
  `product_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_type`, `product_game`, `product_name`, `product_url`, `product_desc`, `product_image_path`, `product_price`, `product_count_small`, `product_count_medium`, `product_count_large`, `product_count_xl`, `product_qty_sold`, `product_date`) VALUES
(1, 'Tshirt', 'Half Life 2', 'Coshish', 'half life 2 tshirt coshish india', '', 'images/coshish.png', 600, 17, 9, 20, 10, 29, '2014-12-08 19:43:46'),
(2, 'Tshirt', 'Doom 3', 'Can you walk dead?', 'doom 3 gaming tshirt walking dead india', '', 'images/walkingdead.png', 600, 9, 19, 15, 8, 26, '2014-12-08 19:43:46'),
(3, 'Tshirt', 'Half life 2', 'Get Sherlocked !', 'half life 2 gaming tshirt sherlock india', '', 'images/sherlock.png', 600, 20, 20, 20, 9, 9, '2014-12-08 19:43:46'),
(4, 'Tshirt', 'Dead Space', 'Join the club !', 'dead space gaming tshirt club india', 'This is Sparta', 'images/fightclub.png', 600, 17, 20, 20, 10, 7, '2014-12-08 19:43:46'),
(5, 'Tshirt', 'Witcher', 'Which dog are you', 'witcher gaming tshirt dog india', '', 'images/reservoirdogs.png', 600, 18, 16, 20, 10, 18, '2014-12-08 19:43:46'),
(6, 'Tshirt', 'Half Life 2', 'Bahadur Bille', 'half life 2 bahadur bille gaming tshirt india', '', 'images/swatkats.png', 600, 8, 20, 19, 10, 3, '2014-12-08 19:43:46'),
(7, 'Tshirt', 'Harry Potter', 'Catch that Snitch', 'harry potter gaming tshirt india snitch', '', 'images/harrypotter.png', 600, 9, 20, 13, 8, 10, '2014-12-08 19:43:46'),
(8, 'Hoodie', 'Wolf', 'RedWolf', 'wolf gaming tshirt india', '', 'images/wolf.png', 600, 10, 18, 18, 10, 4, '2014-12-08 19:43:46'),
(10, 'Tshirt', 'Breaking Bad', 'Golden moth', 'breaking bad tshirt goldenmoth india', '', 'images/goldenmoth.png', 600, 8, 20, 17, 8, 7, '2014-12-08 19:43:46'),
(11, 'Tshirt', 'Breaking Bad', 'Bender', 'breaking bad gaming bender tshirt india', '', 'images/bender.png', 600, 6, 17, 20, 6, 11, '2014-12-08 19:43:46'),
(12, 'Tshirt', 'Dragon ball z', 'Goku', 'dragon ball z gaming tshirt goku india', '', 'images/goku.png', 600, 0, 19, 20, 10, 11, '2014-12-08 19:43:46'),
(13, 'Tshirt', 'Breaking Bad', 'Heisenberg Principal', 'breaking bad gaming tshirt heisneberg india', '', 'images/heisenberg.png', 600, 2, 20, 20, 8, 10, '2014-12-08 19:43:46'),
(14, 'Tshirt', 'Doom 3', 'Doom Moster Is Near', 'doom3 gaming tshirt india', 'Be prepared the monster of the mosters, DOOM is coming near and so is the end along with it.\r\nPay your tribute to one of the scariest and best fps ever created and yeah to John Carmack as well.', 'images/goldenmoth.png', 599, 17, 20, 20, 20, 3, '2015-01-31 21:02:14');

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
  `points` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`, `points`) VALUES
(1, 'AsS^Ss!n', '$2a$08$8N3uzWBmnNCzmkxigbZ9i.TSccdoBm6/k7Z3EwmKmBvrAHo9pRo3m', 'ishkaran.singh@hotmail.com', 1, 0, NULL, NULL, NULL, NULL, 'd91f45774ab50923cb91dd50331358ab', '127.0.0.1', '2014-12-17 20:28:44', '2014-09-10 15:26:08', '2014-12-17 20:28:44', 390),
(2, '', '$2a$08$EfsCQxpbRbwCKYt7.Zv1lursNDJSd0/R5c1sHIxsGX7Q28/46b69i', 'ishkaran@psychostore.in', 0, 0, NULL, NULL, NULL, NULL, '80b00f658648e9e307bbbfdb56737e10', '127.0.0.1', '0000-00-00 00:00:00', '2014-09-10 15:32:46', '2014-09-22 14:33:54', NULL),
(9, 'Ishkaran', '$2a$08$L6dgnxzhKD3mAM0NZiXdq./eT69YXtQECH1zfl0G554bVU3VsoEbi', 'ishkaran.assassin@gmail.com', 1, 0, NULL, 'f92f735d8727e88045683bcdfea552e5', '2014-09-19 11:48:40', NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '2014-09-10 21:20:23', '2014-09-19 11:48:40', NULL),
(10, 'Ishkaran', '$2a$08$EfsCQxpbRbwCKYt7.Zv1lursNDJSd0/R5c1sHIxsGX7Q28/46b69i', 'ishkaran.fearme@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2015-01-31 22:26:39', '2014-09-10 21:47:20', '2015-01-31 22:26:39', 180);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=20 ;

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
(10, 2, NULL, NULL),
(11, 4, NULL, NULL),
(12, 3, NULL, NULL),
(13, 4, NULL, NULL),
(14, 5, NULL, NULL),
(15, 6, NULL, NULL),
(16, 7, NULL, NULL),
(17, 8, NULL, NULL),
(18, 9, NULL, NULL),
(19, 10, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
