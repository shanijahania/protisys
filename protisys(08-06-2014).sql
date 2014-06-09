-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2014 at 03:57 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `protisys`
--

-- --------------------------------------------------------

--
-- Table structure for table `ps_banners`
--

CREATE TABLE IF NOT EXISTS `ps_banners` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `link` text,
  `description` text,
  `img` text,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ps_banners`
--

INSERT INTO `ps_banners` (`banner_id`, `title`, `link`, `description`, `img`) VALUES
(5, NULL, NULL, NULL, 'e815e-green-iphone5c.jpg'),
(6, NULL, NULL, NULL, 'db7cc-MacBookPro.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ps_commission`
--

CREATE TABLE IF NOT EXISTS `ps_commission` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `ord_total` int(11) DEFAULT NULL,
  `ord_commission` int(11) DEFAULT NULL,
  `ord_commission_persentage` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ps_commission`
--

INSERT INTO `ps_commission` (`c_id`, `ord_id`, `u_id`, `ord_total`, `ord_commission`, `ord_commission_persentage`) VALUES
(1, 1, 0, 15, 14, NULL),
(2, 25, 15, 180, 36, '20'),
(3, 25, 14, 180, 18, '10');

-- --------------------------------------------------------

--
-- Table structure for table `ps_locations`
--

CREATE TABLE IF NOT EXISTS `ps_locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` tinytext,
  `slug` varchar(255) DEFAULT NULL,
  `content` text,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ps_locations`
--

INSERT INTO `ps_locations` (`location_id`, `heading`, `meta_title`, `meta_description`, `meta_keywords`, `slug`, `content`, `created_at`, `modified_at`, `is_active`) VALUES
(1, 'harrogate', 'hello world', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu interdum odio. Aliquam arcu nisl, tempus a vulputate tincidunt, hendrerit non lorem. Mauris ac imperdiet turpis, ut convallis enim. Pellentesque mollis dui eget felis pretium porttitor in non tortor. Praesent a nibh feugiat, tempus dui in, tristique diam. Aenean venenatis elementum tristique. Vestibulum vulputate eu tortor et porttitor. Morbi nec cursus odio, sit amet blandit urna. Nulla at auctor mauris, id euismod quam. Integer a gravida eros, vulputate sagittis ipsum. Vivamus ac quam nisi. Suspendisse dapibus et nulla ut tempus. Nunc posuere imperdiet sem ut vulputate. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu interdum odio. Aliquam arcu nisl, tempus a vulputate tincidunt, hendrerit non lorem. Mauris ac imperdiet turpis, ut convallis enim. Pellentesque mollis dui eget felis pretium porttitor in n', 'harrogate', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu interdum odio. Aliquam arcu nisl, tempus a vulputate tincidunt, hendrerit non lorem. Mauris ac imperdiet turpis, ut convallis enim. Pellentesque mollis dui eget felis pretium porttito<span style="color:#b22222;">r in non tortor. Praesent a nibh feugiat, tempus dui in, tristique diam. Aenean venenatis elementum tristique. Vestibulum vulputate eu tortor et porttitor. Morbi nec cursus odio, sit amet blandit urna. Nulla at auctor mauris, id euismod quam. Integer a gravida eros, vulputate sagittis ipsum. Vivamus ac quam nisi. Suspendisse dapibus et nulla ut tempus. Nunc posuere imperdiet sem ut vulputate. Interdum et malesuada fames ac ante ipsum primis in faucibus.</span></p>', '2014-03-24 08:57:42', '2014-03-24 12:35:13', 1),
(2, 'leeds', 'leeds', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu interdum odio. Aliquam arcu nisl, tempus a vulputate tincidunt, hendrerit non lorem. Mauris ac imperdiet turpis, ut convallis enim. Pellentesque mollis dui eget felis pretium porttitor in non tortor. Praesent a nibh feugiat, tempus dui in, tristique diam. Aenean venenatis elementum tristique. Vestibulum vulputate eu tortor et porttitor. Morbi nec cursus odio, sit amet blandit urna. Nulla at auctor mauris, id euismod quam. Integer a gravida eros, vulputate sagittis ipsum. Vivamus ac quam nisi. Suspendisse dapibus et nulla ut tempus. Nunc posuere imperdiet sem ut vulputate. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu interdum odio. Aliquam arcu nisl, tempus a vulputate tincidunt, hendrerit non lorem. Mauris ac imperdiet turpis, ut convallis enim. Pellentesque mollis dui eget felis pretium porttitor in n', 'leeds', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu interdum odio. Aliquam arcu nisl, tempus a vulputate tincidunt, hendrerit non lorem. Mauris ac imperdiet turpis, ut convallis enim. Pellentesque mollis dui eget felis pretium porttitor in non tortor. Praesent a nibh feugiat, tempus dui in, tristique diam. Aenean venenatis elementum tristique. Vestibulum vulputate eu tortor et porttitor. Morbi nec cursus odio, sit amet blandit urna. Nulla at auctor mauris, id euismod quam. Integer a gravida eros, vulputate sagittis ipsum. Vivamus ac quam nisi. Suspendisse dapibus et nulla ut tempus. Nunc posuere imperdiet sem ut vulputate. Interdum et malesuada fames ac ante ipsum primis in faucibus.', '2014-03-24 08:05:46', '2014-03-24 08:58:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ps_member_meta`
--

CREATE TABLE IF NOT EXISTS `ps_member_meta` (
  `meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `is_checkout` int(1) DEFAULT '0',
  `is_basic` int(1) DEFAULT '0',
  `is_advance` int(1) DEFAULT '0',
  `is_vrm` int(1) DEFAULT '0',
  `vrm_limit` int(10) DEFAULT '0',
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `ps_member_meta`
--

INSERT INTO `ps_member_meta` (`meta_id`, `member_id`, `is_checkout`, `is_basic`, `is_advance`, `is_vrm`, `vrm_limit`) VALUES
(21, 85, 1, 1, 0, 0, 0),
(22, 80, 1, 1, 0, 1, 2000),
(23, 86, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ps_modules`
--

CREATE TABLE IF NOT EXISTS `ps_modules` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_module`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ps_modules`
--

INSERT INTO `ps_modules` (`id_module`, `name`) VALUES
(1, 'salepersons'),
(2, 'partners'),
(3, 'clients'),
(4, 'products'),
(5, 'orders');

-- --------------------------------------------------------

--
-- Table structure for table `ps_orders`
--

CREATE TABLE IF NOT EXISTS `ps_orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `postcode` varchar(45) DEFAULT NULL,
  `address` text,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `ps_orders`
--

INSERT INTO `ps_orders` (`order_id`, `first_name`, `surname`, `email`, `phone`, `postcode`, `address`, `created_at`, `modified_at`, `is_active`, `status`) VALUES
(1, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-08 03:03:09', '2014-06-08 03:03:09', 1, 'Pending'),
(2, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:01:58', '2014-06-09 03:01:58', 1, 'Pending'),
(3, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:06:58', '2014-06-09 03:06:58', 1, 'Pending'),
(4, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:09:30', '2014-06-09 03:09:30', 1, 'Pending'),
(5, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:10:04', '2014-06-09 03:10:04', 1, 'Pending'),
(6, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:10:29', '2014-06-09 03:10:29', 1, 'Pending'),
(7, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:10:57', '2014-06-09 03:10:57', 1, 'Pending'),
(8, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:11:14', '2014-06-09 03:11:14', 1, 'Pending'),
(9, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:13:45', '2014-06-09 03:13:45', 1, 'Pending'),
(10, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:14:15', '2014-06-09 03:14:15', 1, 'Pending'),
(11, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:14:50', '2014-06-09 03:14:50', 1, 'Pending'),
(12, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:23:31', '2014-06-09 03:23:31', 1, 'Pending'),
(13, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:24:09', '2014-06-09 03:24:09', 1, 'Pending'),
(14, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:24:43', '2014-06-09 03:24:43', 1, 'Pending'),
(15, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:25:20', '2014-06-09 03:25:20', 1, 'Pending'),
(16, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:25:59', '2014-06-09 03:25:59', 1, 'Pending'),
(17, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:26:22', '2014-06-09 03:26:22', 1, 'Pending'),
(18, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:27:47', '2014-06-09 03:27:47', 1, 'Pending'),
(19, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:27:49', '2014-06-09 03:27:49', 1, 'Pending'),
(20, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:30:29', '2014-06-09 03:30:29', 1, 'Pending'),
(21, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:30:53', '2014-06-09 03:30:53', 1, 'Pending'),
(22, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:31:38', '2014-06-09 03:31:38', 1, 'Pending'),
(23, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:31:53', '2014-06-09 03:31:53', 1, 'Pending'),
(24, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:32:32', '2014-06-09 03:32:32', 1, 'Pending'),
(25, 'aftab', 'khan', 'aftabkhan@gmail.com', '(123) 456-7895', '54000', 'lahore', '2014-06-09 03:33:16', '2014-06-09 03:33:16', 1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `ps_order_products`
--

CREATE TABLE IF NOT EXISTS `ps_order_products` (
  `order_product_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) DEFAULT NULL,
  `order_id` int(10) DEFAULT NULL,
  `p_name` varchar(255) DEFAULT NULL,
  `p_price` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`order_product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `ps_order_products`
--

INSERT INTO `ps_order_products` (`order_product_id`, `product_id`, `order_id`, `p_name`, `p_price`) VALUES
(1, 1, 13, 'product 1', NULL),
(2, 1, 1, 'product 1', '180'),
(3, 1, 1, 'product 1', '180'),
(4, 1, 1, 'product 1', '180'),
(5, 1, 2, 'product 1', '180'),
(6, 1, 3, 'product 1', '180'),
(7, 1, 4, 'product 1', '180'),
(8, 1, 5, 'product 1', '180'),
(9, 1, 6, 'product 1', '180'),
(10, 1, 7, 'product 1', '180'),
(11, 1, 8, 'product 1', '180'),
(12, 1, 9, 'product 1', '180'),
(13, 1, 10, 'product 1', '180'),
(14, 1, 11, 'product 1', '180'),
(15, 1, 12, 'product 1', '180'),
(16, 1, 13, 'product 1', '180'),
(17, 1, 14, 'product 1', '180'),
(18, 1, 15, 'product 1', '180'),
(19, 1, 16, 'product 1', '180'),
(20, 1, 17, 'product 1', '180'),
(21, 1, 18, 'product 1', '180'),
(22, 1, 19, 'product 1', '180'),
(23, 1, 20, 'product 1', '180'),
(24, 1, 21, 'product 1', '180'),
(25, 1, 22, 'product 1', '180'),
(26, 1, 23, 'product 1', '180'),
(27, 1, 24, 'product 1', '180'),
(28, 1, 25, 'product 1', '180');

-- --------------------------------------------------------

--
-- Table structure for table `ps_order_status`
--

CREATE TABLE IF NOT EXISTS `ps_order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`order_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `ps_order_status`
--

INSERT INTO `ps_order_status` (`order_status_id`, `name`) VALUES
(2, 'Processing'),
(3, 'Shipped'),
(7, 'Canceled'),
(5, 'Complete'),
(8, 'Denied'),
(9, 'Canceled Reversal'),
(10, 'Failed'),
(11, 'Refunded'),
(12, 'Reversed'),
(13, 'Chargeback'),
(1, 'Pending'),
(16, 'Voided'),
(15, 'Processed'),
(14, 'Expired');

-- --------------------------------------------------------

--
-- Table structure for table `ps_permissions`
--

CREATE TABLE IF NOT EXISTS `ps_permissions` (
  `id_permission` int(11) NOT NULL AUTO_INCREMENT,
  `add` int(11) DEFAULT '0',
  `edit` int(11) DEFAULT '0',
  `delete` int(11) DEFAULT '0',
  `view` int(11) DEFAULT '0',
  `modules_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id_permission`,`modules_id`,`users_id`),
  KEY `fk_permissions_modules1_idx` (`modules_id`),
  KEY `fk_permissions_users1_idx` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ps_permissions`
--

INSERT INTO `ps_permissions` (`id_permission`, `add`, `edit`, `delete`, `view`, `modules_id`, `users_id`) VALUES
(1, 1, 1, 1, 1, 2, 14),
(2, 1, 1, 1, 1, 3, 14),
(3, 1, 1, 1, 1, 5, 14),
(4, 1, 1, 1, 1, 3, 15),
(5, 1, 1, 1, 1, 5, 15),
(6, 1, 0, 0, 0, 5, 16);

-- --------------------------------------------------------

--
-- Table structure for table `ps_products`
--

CREATE TABLE IF NOT EXISTS `ps_products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_price` varchar(50) NOT NULL DEFAULT '0.0',
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ps_products`
--

INSERT INTO `ps_products` (`product_id`, `product_name`, `product_desc`, `product_price`, `created_at`, `modified_at`, `is_active`) VALUES
(1, 'product 1', 'this is test product for testing', '180', '2014-05-26 22:37:13', '2014-05-26 22:50:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ps_services`
--

CREATE TABLE IF NOT EXISTS `ps_services` (
  `service_id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ps_settings`
--

CREATE TABLE IF NOT EXISTS `ps_settings` (
  `id_settings` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `meta_key` varchar(45) DEFAULT NULL,
  `meta_value` text,
  PRIMARY KEY (`id_settings`,`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=604 ;

--
-- Dumping data for table `ps_settings`
--

INSERT INTO `ps_settings` (`id_settings`, `group_id`, `meta_key`, `meta_value`) VALUES
(592, 1, 'logo', 'logo_1400965756.jpg'),
(593, 1, 'id', '1'),
(594, 1, 'title', 'Tyres | Winter Tyres | Fleet Services | Servicing | MOT | Brakes |    Exhausts | Alignment from Point S - The Leading Independent Tyre and     Car Service Dealer Network in Europe.'),
(595, 1, 'email', 'admin@point-s.com'),
(596, 1, 'tag', ''),
(597, 1, 'keywords', 'keywords, hello world, social media, lifestyle, fashion'),
(598, 1, 'description', 'This is meta description'),
(599, 1, 'modified_at', '2014-05-24 23:09:16'),
(600, 1, 'edit_post', '0'),
(601, 1, 'delete_post', '0'),
(602, 1, 'edit_comment', '0'),
(603, 1, 'delete_comment', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ps_showrooms`
--

CREATE TABLE IF NOT EXISTS `ps_showrooms` (
  `showroom_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `address` text,
  `postcode` varchar(45) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `timings_1` varchar(255) DEFAULT NULL,
  `timings_2` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`showroom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `ps_showrooms`
--

INSERT INTO `ps_showrooms` (`showroom_id`, `user_id`, `name`, `description`, `address`, `postcode`, `phone`, `timings_1`, `timings_2`, `created_at`, `modified_at`, `is_active`) VALUES
(2, 80, 'Alba Tyres Ltd', 'Alba Tyres Auto Centres in Leeds LS6, LS12 & LS18, Bradford and Ilkley specialise in the fast fitting of Tyres, Exhausts and Brakes either by appointment or while you wait.\r\n\r\nWe offer a full range of services throughout our six locations across West Yorkshire for your vehicle including MOTs and Servicing.', '100 Gelderd Road\r\nArmley\r\nLeeds\r\nLS12 6BY', 'LS12 6BY', '0113 2444462', 'MONDAY - FRIDAY 08:30 - 18:00 \r\nSATURDAY 08:30 - 16:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 80, 'Alba Tyres Ltd', 'Alba Tyres Auto Centres in Leeds LS6, LS12 & LS18, Bradford and Ilkley specialise in the fast fitting of Tyres, Exhausts and Brakes either by appointment or while you wait.\r\n\r\nWe offer a full range of services throughout our six locations across West Yorkshire for your vehicle including MOTs and Servicing.', '100 Gelderd Road\r\nArmley\r\nLeeds\r\nLS12 6BY', 'LS12 6BY', '0113 2444462', 'MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 80, 'Link Tyres Sales Ltd', 'Established in 1981, we have many years experience within the automotive industry and are dedicated to offering our customers the best possible service at a reasonable price.', 'Unit 1, Low Mill Lane\r\nRavensthorpe Industrial Estate\r\nFir Cottage\r\nWF13 3LX', 'WF13 3LX', '01924 497772', 'Opening Times:\r\n\r\nMONDAY - FRIDAY 08:30 - 17:30 SATURDAY 08:30 - 12:30', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 80, 'Alba Tyres Ltd', '', 'Unit 5 Lister Hill\r\nHorsforth\r\nLeeds\r\nLS18 5AZ', 'LS12 6BY', '0113 2444462', 'MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(6, 85, 'Alba Tyres Ltd', '', '729 Leeds Road\r\n\r\nBradford\r\nBD3 8BZ', 'BD3 8BZ', '01274 666726', 'MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(7, 85, 'Alba Tyres Ltd', '', 'Little Lane\r\nIlkley\r\nLeeds\r\nLS29 8HZ', 'LS29 8HZ', '01943 600028', 'MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(8, 85, 'Alba Tyres Ltd', '', 'Unit 5 Lister Hill\r\nHorsforth\r\nLeeds\r\nLS18 5AZ', 'LS18 5AZ', '0113 2818881', 'MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(9, 85, 'Alba Tyres Ltd', '', '729 Leeds Road\r\n\r\nBradford\r\nBD3 8BZ', 'BD3 8BZ', '01274 666726', 'MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(10, 85, 'Alba Tyres Ltd', '', '43 Headingley Lane\r\nHeadingley\r\nLeeds\r\nLS6 1DP', 'LS6 1DP', '0113 2751974', 'MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(11, 86, 'Alba Tyres Ltd', '', '100 Gelderd Road\r\nArmley\r\nLeeds\r\nLS12 6BY', 'LS12 6BY', '0113 2444462', 'MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(12, 86, 'Pellon Tyres', '', 'Pellon Lane\r\n\r\nHalifax\r\nHX1 4PZ', 'HX1 4PZ', '01422 351314', 'MONDAY - FRIDAY 08:30 - 17:30 SATURDAY 08:30 - 13:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(13, 86, 'Alba Tyres Ltd', '', 'Unit 5 Lister Hill\r\nHorsforth\r\nLeeds\r\nLS18 5AZ', 'LS18 5AZ', '0113 2818881', 'MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(14, 86, 'Alba Tyres Ltd', '', '43 Headingley Lane\r\nHeadingley\r\nLeeds\r\nLS6 1DP', 'LS6 1DP', '0113 2751974', 'MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(15, 86, 'Alba tyres', 'sdf asdlk fjasdlkfj las;dkjf ladskj falsdkjf laskdjf ajsdhf kaljsdhf', 'fasdlkfsdkjfasldkj fasdlkjf alsdkj fl;aksdjf ;alsdjf', '547 21d', '2121212121', '12:45 - 24:00', '', '2014-04-01 12:33:47', '2014-04-03 07:29:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ps_users`
--

CREATE TABLE IF NOT EXISTS `ps_users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `access` varchar(45) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `is_active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `ps_users`
--

INSERT INTO `ps_users` (`id_users`, `name`, `surname`, `username`, `password`, `email`, `mobile`, `address`, `postcode`, `gender`, `created_at`, `modified_at`, `access`, `parent_id`, `is_active`) VALUES
(1, 'admin', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', NULL, NULL, NULL, 0, '2014-05-24 00:00:00', '2014-05-24 00:00:00', 'super_admin', 0, 1),
(14, 'saleperson', 'user', 'saleperson@admin.com', 'a4d4f214875c03340efe0589ad49fdc29c9556ba', 'saleperson@admin.com', '(123) 456-7899', 'lahore', '54000', 0, '2014-06-08 00:53:41', '2014-06-08 00:53:41', 'salesperson', 1, 1),
(15, 'partner', 'user', 'partner@admin.com', '3624db883007efa198232b3aa774a54360ed3f26', 'partner@admin.com', '(123) 456-7895', 'lahore', '54000', 0, '2014-06-08 00:55:45', '2014-06-08 00:55:45', 'partners', 14, 1),
(16, 'aftab', 'khan', 'aftabkhan@gmail.com', '38d199fbfc923de7014d3f00e2a27192b111a085', 'aftabkhan@gmail.com', '(123) 456-7895', 'lahore', '54000', 0, '2014-06-08 00:59:41', '2014-06-08 00:59:41', 'clients', 15, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
