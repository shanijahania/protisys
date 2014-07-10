# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.34)
# Database: proti
# Generation Time: 2014-07-10 14:59:49 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ps_banners
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_banners`;

CREATE TABLE `ps_banners` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `link` text,
  `description` text,
  `img` text,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ps_banners` WRITE;
/*!40000 ALTER TABLE `ps_banners` DISABLE KEYS */;

INSERT INTO `ps_banners` (`banner_id`, `title`, `link`, `description`, `img`)
VALUES
	(5,NULL,NULL,NULL,'e815e-green-iphone5c.jpg'),
	(6,NULL,NULL,NULL,'db7cc-MacBookPro.jpg');

/*!40000 ALTER TABLE `ps_banners` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_commission
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_commission`;

CREATE TABLE `ps_commission` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `ord_total` int(11) DEFAULT NULL,
  `ord_commission` int(11) DEFAULT NULL,
  `comm_status` int(1) DEFAULT '0',
  `ord_commission_persentage` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ps_commission` WRITE;
/*!40000 ALTER TABLE `ps_commission` DISABLE KEYS */;

INSERT INTO `ps_commission` (`c_id`, `ord_id`, `u_id`, `ord_total`, `ord_commission`, `comm_status`, `ord_commission_persentage`, `created_at`)
VALUES
	(1,1,14,500,75,1,'20',NULL),
	(2,2,15,180,36,0,'20',NULL),
	(3,2,14,180,27,0,'10',NULL),
	(4,4,18,180,18,1,'20','2014-06-28 13:36:54'),
	(5,5,15,500,100,0,'20','2014-07-09 22:33:48'),
	(6,5,14,500,75,0,'15','2014-07-09 22:33:48'),
	(9,7,15,500,100,0,'20','2014-07-09 23:29:20'),
	(10,7,14,500,75,0,'15','2014-07-09 23:29:20'),
	(11,8,15,1000,200,0,'20','2014-07-10 00:06:12'),
	(12,8,14,1000,150,0,'15','2014-07-10 00:06:12'),
	(13,9,15,1000,200,0,'20','2014-07-10 00:08:12'),
	(14,9,14,1000,150,0,'15','2014-07-10 00:08:12'),
	(15,12,15,1000,200,0,'20','2014-07-10 00:10:05'),
	(16,12,14,1000,150,0,'15','2014-07-10 00:10:05'),
	(17,13,15,1000,200,0,'20','2014-07-10 00:21:20'),
	(18,13,14,1000,150,0,'15','2014-07-10 00:21:20');

/*!40000 ALTER TABLE `ps_commission` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_locations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_locations`;

CREATE TABLE `ps_locations` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ps_locations` WRITE;
/*!40000 ALTER TABLE `ps_locations` DISABLE KEYS */;

INSERT INTO `ps_locations` (`location_id`, `heading`, `meta_title`, `meta_description`, `meta_keywords`, `slug`, `content`, `created_at`, `modified_at`, `is_active`)
VALUES
	(1,'harrogate','hello world','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu interdum odio. Aliquam arcu nisl, tempus a vulputate tincidunt, hendrerit non lorem. Mauris ac imperdiet turpis, ut convallis enim. Pellentesque mollis dui eget felis pretium porttitor in non tortor. Praesent a nibh feugiat, tempus dui in, tristique diam. Aenean venenatis elementum tristique. Vestibulum vulputate eu tortor et porttitor. Morbi nec cursus odio, sit amet blandit urna. Nulla at auctor mauris, id euismod quam. Integer a gravida eros, vulputate sagittis ipsum. Vivamus ac quam nisi. Suspendisse dapibus et nulla ut tempus. Nunc posuere imperdiet sem ut vulputate. Interdum et malesuada fames ac ante ipsum primis in faucibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu interdum odio. Aliquam arcu nisl, tempus a vulputate tincidunt, hendrerit non lorem. Mauris ac imperdiet turpis, ut convallis enim. Pellentesque mollis dui eget felis pretium porttitor in n','harrogate','<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu interdum odio. Aliquam arcu nisl, tempus a vulputate tincidunt, hendrerit non lorem. Mauris ac imperdiet turpis, ut convallis enim. Pellentesque mollis dui eget felis pretium porttito<span style=\"color:#b22222;\">r in non tortor. Praesent a nibh feugiat, tempus dui in, tristique diam. Aenean venenatis elementum tristique. Vestibulum vulputate eu tortor et porttitor. Morbi nec cursus odio, sit amet blandit urna. Nulla at auctor mauris, id euismod quam. Integer a gravida eros, vulputate sagittis ipsum. Vivamus ac quam nisi. Suspendisse dapibus et nulla ut tempus. Nunc posuere imperdiet sem ut vulputate. Interdum et malesuada fames ac ante ipsum primis in faucibus.</span></p>','2014-03-24 08:57:42','2014-03-24 12:35:13',1),
	(2,'leeds','leeds','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu interdum odio. Aliquam arcu nisl, tempus a vulputate tincidunt, hendrerit non lorem. Mauris ac imperdiet turpis, ut convallis enim. Pellentesque mollis dui eget felis pretium porttitor in non tortor. Praesent a nibh feugiat, tempus dui in, tristique diam. Aenean venenatis elementum tristique. Vestibulum vulputate eu tortor et porttitor. Morbi nec cursus odio, sit amet blandit urna. Nulla at auctor mauris, id euismod quam. Integer a gravida eros, vulputate sagittis ipsum. Vivamus ac quam nisi. Suspendisse dapibus et nulla ut tempus. Nunc posuere imperdiet sem ut vulputate. Interdum et malesuada fames ac ante ipsum primis in faucibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu interdum odio. Aliquam arcu nisl, tempus a vulputate tincidunt, hendrerit non lorem. Mauris ac imperdiet turpis, ut convallis enim. Pellentesque mollis dui eget felis pretium porttitor in n','leeds','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu interdum odio. Aliquam arcu nisl, tempus a vulputate tincidunt, hendrerit non lorem. Mauris ac imperdiet turpis, ut convallis enim. Pellentesque mollis dui eget felis pretium porttitor in non tortor. Praesent a nibh feugiat, tempus dui in, tristique diam. Aenean venenatis elementum tristique. Vestibulum vulputate eu tortor et porttitor. Morbi nec cursus odio, sit amet blandit urna. Nulla at auctor mauris, id euismod quam. Integer a gravida eros, vulputate sagittis ipsum. Vivamus ac quam nisi. Suspendisse dapibus et nulla ut tempus. Nunc posuere imperdiet sem ut vulputate. Interdum et malesuada fames ac ante ipsum primis in faucibus.','2014-03-24 08:05:46','2014-03-24 08:58:10',1);

/*!40000 ALTER TABLE `ps_locations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_member_meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_member_meta`;

CREATE TABLE `ps_member_meta` (
  `meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `is_checkout` int(1) DEFAULT '0',
  `is_basic` int(1) DEFAULT '0',
  `is_advance` int(1) DEFAULT '0',
  `is_vrm` int(1) DEFAULT '0',
  `vrm_limit` int(10) DEFAULT '0',
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ps_member_meta` WRITE;
/*!40000 ALTER TABLE `ps_member_meta` DISABLE KEYS */;

INSERT INTO `ps_member_meta` (`meta_id`, `member_id`, `is_checkout`, `is_basic`, `is_advance`, `is_vrm`, `vrm_limit`)
VALUES
	(21,85,1,1,0,0,0),
	(22,80,1,1,0,1,2000),
	(23,86,1,1,0,0,0);

/*!40000 ALTER TABLE `ps_member_meta` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_modules
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_modules`;

CREATE TABLE `ps_modules` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ps_modules` WRITE;
/*!40000 ALTER TABLE `ps_modules` DISABLE KEYS */;

INSERT INTO `ps_modules` (`id_module`, `name`)
VALUES
	(1,'salepersons'),
	(2,'partners'),
	(3,'clients'),
	(4,'products'),
	(5,'orders');

/*!40000 ALTER TABLE `ps_modules` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_order_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_order_products`;

CREATE TABLE `ps_order_products` (
  `order_product_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) DEFAULT NULL,
  `order_id` int(10) DEFAULT NULL,
  `p_name` varchar(255) DEFAULT NULL,
  `p_price` varchar(45) DEFAULT NULL,
  `p_qty` int(16) DEFAULT NULL,
  PRIMARY KEY (`order_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ps_order_products` WRITE;
/*!40000 ALTER TABLE `ps_order_products` DISABLE KEYS */;

INSERT INTO `ps_order_products` (`order_product_id`, `product_id`, `order_id`, `p_name`, `p_price`, `p_qty`)
VALUES
	(1,2,1,'product 2','500',NULL),
	(2,1,2,'product 1','180',NULL),
	(3,1,4,'product 1','180',1),
	(4,2,5,'product 2','500',1),
	(6,2,7,'product 2','500',1),
	(7,2,8,'product 2','500',2),
	(8,2,9,'product 2','500',2),
	(9,2,10,'product 2','500',2),
	(10,2,11,'product 2','500',2),
	(11,2,12,'product 2','500',2),
	(12,2,13,'product 2','500',2);

/*!40000 ALTER TABLE `ps_order_products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_order_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_order_status`;

CREATE TABLE `ps_order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`order_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `ps_order_status` WRITE;
/*!40000 ALTER TABLE `ps_order_status` DISABLE KEYS */;

INSERT INTO `ps_order_status` (`order_status_id`, `name`)
VALUES
	(2,'Processing'),
	(3,'Shipped'),
	(7,'Canceled'),
	(5,'Complete'),
	(8,'Denied'),
	(9,'Canceled Reversal'),
	(10,'Failed'),
	(11,'Refunded'),
	(12,'Reversed'),
	(13,'Chargeback'),
	(1,'Pending'),
	(16,'Voided'),
	(15,'Processed'),
	(14,'Expired');

/*!40000 ALTER TABLE `ps_order_status` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_orders`;

CREATE TABLE `ps_orders` (
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
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `payment_type` varchar(45) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `is_checkout` int(1) DEFAULT '0',
  `total_qty` int(11) DEFAULT NULL,
  `total_commission` int(11) DEFAULT NULL,
  `shipment` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ps_orders` WRITE;
/*!40000 ALTER TABLE `ps_orders` DISABLE KEYS */;

INSERT INTO `ps_orders` (`order_id`, `first_name`, `surname`, `email`, `phone`, `postcode`, `address`, `created_at`, `modified_at`, `is_active`, `status`, `user_id`, `client_id`, `payment_type`, `total_amount`, `is_checkout`, `total_qty`, `total_commission`, `shipment`)
VALUES
	(1,'aftab','khan','aftabkhan@admin.com','(333) 333-3333','asdfas55','kjsdflasjdflajsdfj adfjla dads fja fdl','2014-06-18 22:25:54','2014-06-18 22:25:54',1,'Pending',14,17,'paypal',1000,2,2,350,NULL),
	(2,'aftab','khan','aftabkhan@gmail.com','(123) 456-7895','54000','lahore','2014-06-18 23:02:39','2014-06-18 23:02:39',1,'Pending',15,16,'paypal',1000,0,2,350,NULL),
	(3,'test ','order','shanijahania@gmail.com','878878787','98788','dsa,mf sdaf asldkjf alksdjf','2014-06-28 13:36:11','2014-06-28 13:36:11',1,'Pending',18,0,'paypal',1000,0,2,350,NULL),
	(4,'test ','order','shanijahania@gmail.com','878878787','98788','dsa,mf sdaf asldkjf alksdjf','2014-06-28 13:36:54','2014-06-28 13:36:54',1,'Pending',18,0,'paypal',1000,0,2,350,NULL),
	(5,'aftab','khan','aftabkhan@gmail.com','(123) 456-7895','54000','lahore','2014-07-09 22:33:48','2014-07-09 22:33:48',1,'Pending',15,16,'paypal',1000,0,2,350,NULL),
	(7,'shani','jahania','shanijahania@gmail.com','03006884808','78HHYT','THIS IS TEST ADDRESS','2014-07-09 23:29:20','2014-07-09 23:29:20',1,'Pending',15,0,'paypal',1000,0,2,350,NULL),
	(8,'shani','jahania','shanijahania@gmail.com','03006884808','78HHYT','THIS IS TEST ADDRESS','2014-07-10 00:06:12','2014-07-10 00:06:12',1,'Pending',15,0,'paypal',1000,0,2,350,0),
	(9,'shani','jahania','shanijahania@gmail.com','03006884808','78HHYT','THIS IS TEST ADDRESS','2014-07-10 00:08:12','2014-07-10 00:08:12',1,'Pending',15,0,'paypal',1000,0,2,350,0),
	(10,'shani','jahania','shanijahania@gmail.com','03006884808','78HHYT','THIS IS TEST ADDRESS','2014-07-10 00:08:53','2014-07-10 00:08:53',1,'Pending',15,0,'paypal',1000,1,2,350,NULL),
	(11,'shani','jahania','shanijahania@gmail.com','03006884808','78HHYT','THIS IS TEST ADDRESS','2014-07-10 00:09:18','2014-07-10 00:09:18',1,'Pending',15,0,'paypal',1000,1,2,350,NULL),
	(12,'shani','jahania','shanijahania@gmail.com','03006884808','78HHYT','THIS IS TEST ADDRESS','2014-07-10 00:10:05','2014-07-10 00:10:05',1,'Pending',15,0,'cash',1000,1,2,350,0),
	(13,'shani','jahania','shanijahania@gmail.com','03006884808','78HHYT','THIS IS TEST ADDRESS','2014-07-10 00:21:20','2014-07-10 00:21:20',1,'Pending',15,0,'cash',1000,1,2,350,0);

/*!40000 ALTER TABLE `ps_orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_payments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_payments`;

CREATE TABLE `ps_payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT '0',
  `currency` varchar(12) DEFAULT 'CHF',
  `checkout_status` varchar(127) DEFAULT NULL,
  `status_change` varchar(127) DEFAULT NULL,
  `payer_id` varchar(127) DEFAULT NULL,
  `transaction_id` varchar(127) DEFAULT NULL,
  `ACK` varchar(127) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `ps_payments` WRITE;
/*!40000 ALTER TABLE `ps_payments` DISABLE KEYS */;

INSERT INTO `ps_payments` (`id`, `order_id`, `token`, `amount`, `currency`, `checkout_status`, `status_change`, `payer_id`, `transaction_id`, `ACK`, `created_at`, `updated_at`, `status`)
VALUES
	(1,NULL,'EC-66D96171YJ094415U',80,'CHF',NULL,NULL,NULL,NULL,'Success','2014-07-10 17:55:48','2014-07-10 17:55:48',1),
	(2,NULL,'EC-3SJ76425T23939356',80,'CHF',NULL,NULL,NULL,NULL,'Success','2014-07-10 17:57:47','2014-07-10 17:57:47',2),
	(3,NULL,'EC-3SJ76425T23939356',80,'CHF','PaymentActionNotInitiated','2014-07-10T12:58:38Z','682VPLA6VSXPE','7L252435WG902052Y','Success','2014-07-10 17:57:47','2014-07-10 17:58:43',2),
	(4,NULL,'EC-3SJ76425T23939356',80,'CHF','PaymentActionNotInitiated','2014-07-10T12:58:38Z','682VPLA6VSXPE','7L252435WG902052Y','Success','2014-07-10 17:57:47','2014-07-10 17:58:43',1),
	(5,NULL,'EC-97H13845XP805661N',1000,'USD',NULL,NULL,NULL,NULL,'Success','2014-07-10 18:36:51','2014-07-10 18:36:51',1),
	(6,NULL,'EC-30589185BM9021613',1000,'USD',NULL,NULL,NULL,NULL,'Success','2014-07-10 18:37:12','2014-07-10 18:37:12',1),
	(7,NULL,'EC-94801361V1590894M',1000,'USD',NULL,NULL,NULL,NULL,'Success','2014-07-10 19:07:02','2014-07-10 19:07:02',1),
	(8,NULL,'EC-8SX55385A2928521T',1000,'USD',NULL,NULL,NULL,NULL,'Success','2014-07-10 19:09:58','2014-07-10 19:09:58',1),
	(9,NULL,'EC-3S23827261828211C',110,'CHF',NULL,NULL,NULL,NULL,'Success','2014-07-10 19:17:37','2014-07-10 19:17:37',1),
	(10,NULL,'EC-51558057BD414010R',110,'CHF',NULL,NULL,NULL,NULL,'Success','2014-07-10 19:18:27','2014-07-10 19:18:27',2),
	(11,0,'EC-51558057BD414010R',110,'CHF','PaymentActionNotInitiated','2014-07-10T14:19:04Z','682VPLA6VSXPE','3H0451764M507684S','Success','2014-07-10 19:18:27','2014-07-10 19:19:09',2),
	(12,0,'EC-51558057BD414010R',110,'CHF','PaymentActionNotInitiated','2014-07-10T14:19:04Z','682VPLA6VSXPE','3H0451764M507684S','Success','2014-07-10 19:18:27','2014-07-10 19:19:09',1);

/*!40000 ALTER TABLE `ps_payments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_permissions`;

CREATE TABLE `ps_permissions` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ps_permissions` WRITE;
/*!40000 ALTER TABLE `ps_permissions` DISABLE KEYS */;

INSERT INTO `ps_permissions` (`id_permission`, `add`, `edit`, `delete`, `view`, `modules_id`, `users_id`)
VALUES
	(1,1,1,1,1,2,14),
	(2,1,1,1,1,3,14),
	(3,1,1,1,1,5,14),
	(4,1,1,1,1,3,15),
	(5,1,1,1,1,5,15),
	(6,1,0,0,0,5,16),
	(7,1,0,0,0,5,17),
	(8,1,1,1,1,2,18),
	(9,1,1,1,1,3,18),
	(10,1,1,1,1,5,18);

/*!40000 ALTER TABLE `ps_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_products`;

CREATE TABLE `ps_products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_price` varchar(50) NOT NULL DEFAULT '0.0',
  `product_location` varchar(255) DEFAULT NULL,
  `product_stock` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ps_products` WRITE;
/*!40000 ALTER TABLE `ps_products` DISABLE KEYS */;

INSERT INTO `ps_products` (`product_id`, `product_name`, `product_desc`, `product_price`, `product_location`, `product_stock`, `created_at`, `modified_at`, `is_active`)
VALUES
	(1,'product 1','this is test product for testing','180','ecuador','198','2014-05-26 22:37:13','2014-06-20 01:11:55',1),
	(2,'product 2','this is the second product of the system','500','usa','290','2014-06-17 23:40:41','2014-06-20 01:12:06',1);

/*!40000 ALTER TABLE `ps_products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_services`;

CREATE TABLE `ps_services` (
  `service_id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table ps_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_settings`;

CREATE TABLE `ps_settings` (
  `id_settings` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `meta_key` varchar(45) DEFAULT NULL,
  `meta_value` text,
  PRIMARY KEY (`id_settings`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ps_settings` WRITE;
/*!40000 ALTER TABLE `ps_settings` DISABLE KEYS */;

INSERT INTO `ps_settings` (`id_settings`, `group_id`, `meta_key`, `meta_value`)
VALUES
	(592,1,'logo','logo_1400965756.jpg'),
	(593,1,'id','1'),
	(594,1,'title','Tyres | Winter Tyres | Fleet Services | Servicing | MOT | Brakes |    Exhausts | Alignment from Point S - The Leading Independent Tyre and     Car Service Dealer Network in Europe.'),
	(595,1,'email','admin@point-s.com'),
	(596,1,'tag',''),
	(597,1,'keywords','keywords, hello world, social media, lifestyle, fashion'),
	(598,1,'description','This is meta description'),
	(599,1,'modified_at','2014-05-24 23:09:16'),
	(600,1,'edit_post','0'),
	(601,1,'delete_post','0'),
	(602,1,'edit_comment','0'),
	(603,1,'delete_comment','0');

/*!40000 ALTER TABLE `ps_settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_showrooms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_showrooms`;

CREATE TABLE `ps_showrooms` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ps_showrooms` WRITE;
/*!40000 ALTER TABLE `ps_showrooms` DISABLE KEYS */;

INSERT INTO `ps_showrooms` (`showroom_id`, `user_id`, `name`, `description`, `address`, `postcode`, `phone`, `timings_1`, `timings_2`, `created_at`, `modified_at`, `is_active`)
VALUES
	(2,80,'Alba Tyres Ltd','Alba Tyres Auto Centres in Leeds LS6, LS12 & LS18, Bradford and Ilkley specialise in the fast fitting of Tyres, Exhausts and Brakes either by appointment or while you wait.\r\n\r\nWe offer a full range of services throughout our six locations across West Yorkshire for your vehicle including MOTs and Servicing.','100 Gelderd Road\r\nArmley\r\nLeeds\r\nLS12 6BY','LS12 6BY','0113 2444462','MONDAY - FRIDAY 08:30 - 18:00 \r\nSATURDAY 08:30 - 16:00',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(3,80,'Alba Tyres Ltd','Alba Tyres Auto Centres in Leeds LS6, LS12 & LS18, Bradford and Ilkley specialise in the fast fitting of Tyres, Exhausts and Brakes either by appointment or while you wait.\r\n\r\nWe offer a full range of services throughout our six locations across West Yorkshire for your vehicle including MOTs and Servicing.','100 Gelderd Road\r\nArmley\r\nLeeds\r\nLS12 6BY','LS12 6BY','0113 2444462','MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(4,80,'Link Tyres Sales Ltd','Established in 1981, we have many years experience within the automotive industry and are dedicated to offering our customers the best possible service at a reasonable price.','Unit 1, Low Mill Lane\r\nRavensthorpe Industrial Estate\r\nFir Cottage\r\nWF13 3LX','WF13 3LX','01924 497772','Opening Times:\r\n\r\nMONDAY - FRIDAY 08:30 - 17:30 SATURDAY 08:30 - 12:30',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(5,80,'Alba Tyres Ltd','','Unit 5 Lister Hill\r\nHorsforth\r\nLeeds\r\nLS18 5AZ','LS12 6BY','0113 2444462','MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(6,85,'Alba Tyres Ltd','','729 Leeds Road\r\n\r\nBradford\r\nBD3 8BZ','BD3 8BZ','01274 666726','MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(7,85,'Alba Tyres Ltd','','Little Lane\r\nIlkley\r\nLeeds\r\nLS29 8HZ','LS29 8HZ','01943 600028','MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(8,85,'Alba Tyres Ltd','','Unit 5 Lister Hill\r\nHorsforth\r\nLeeds\r\nLS18 5AZ','LS18 5AZ','0113 2818881','MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(9,85,'Alba Tyres Ltd','','729 Leeds Road\r\n\r\nBradford\r\nBD3 8BZ','BD3 8BZ','01274 666726','MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(10,85,'Alba Tyres Ltd','','43 Headingley Lane\r\nHeadingley\r\nLeeds\r\nLS6 1DP','LS6 1DP','0113 2751974','MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(11,86,'Alba Tyres Ltd','','100 Gelderd Road\r\nArmley\r\nLeeds\r\nLS12 6BY','LS12 6BY','0113 2444462','MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(12,86,'Pellon Tyres','','Pellon Lane\r\n\r\nHalifax\r\nHX1 4PZ','HX1 4PZ','01422 351314','MONDAY - FRIDAY 08:30 - 17:30 SATURDAY 08:30 - 13:00',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(13,86,'Alba Tyres Ltd','','Unit 5 Lister Hill\r\nHorsforth\r\nLeeds\r\nLS18 5AZ','LS18 5AZ','0113 2818881','MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(14,86,'Alba Tyres Ltd','','43 Headingley Lane\r\nHeadingley\r\nLeeds\r\nLS6 1DP','LS6 1DP','0113 2751974','MONDAY - FRIDAY 08:30 - 18:00 SATURDAY 08:30 - 16:00',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),
	(15,86,'Alba tyres','sdf asdlk fjasdlkfj las;dkjf ladskj falsdkjf laskdjf ajsdhf kaljsdhf','fasdlkfsdkjfasldkj fasdlkjf alsdkj fl;aksdjf ;alsdjf','547 21d','2121212121','12:45 - 24:00','','2014-04-01 12:33:47','2014-04-03 07:29:24',1);

/*!40000 ALTER TABLE `ps_showrooms` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ps_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ps_users`;

CREATE TABLE `ps_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `notes` text,
  `commission_per` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `access` varchar(45) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `is_active` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ps_users` WRITE;
/*!40000 ALTER TABLE `ps_users` DISABLE KEYS */;

INSERT INTO `ps_users` (`user_id`, `name`, `surname`, `username`, `password`, `email`, `mobile`, `address`, `postcode`, `gender`, `avatar`, `notes`, `commission_per`, `created_at`, `modified_at`, `access`, `parent_id`, `is_active`)
VALUES
	(1,'admin','admin','admin','d033e22ae348aeb5660fc2140aec35850c4da997','admin@admin.com',NULL,NULL,NULL,0,NULL,NULL,NULL,'2014-05-24 00:00:00','2014-05-24 00:00:00','super_admin',0,1),
	(14,'saleperson','user','saleperson@admin.com','f865b53623b121fd34ee5426c792e5c33af8c227','saleperson@admin.com','(123) 456-7899','lahore','54000',0,'saleperson_1404660562.jpg','this is the notes section',15,'2014-06-08 00:53:41','2014-07-06 20:29:22','salesperson',1,1),
	(15,'partner','user','partner@admin.com','f865b53623b121fd34ee5426c792e5c33af8c227','partner@admin.com','(123) 456-7895','lahore','54000',0,NULL,'',20,'2014-06-08 00:55:45','2014-07-09 22:15:42','partners',14,1),
	(16,'aftab','khan','aftabkhan@gmail.com','38d199fbfc923de7014d3f00e2a27192b111a085','aftabkhan@gmail.com','(123) 456-7895','lahore','54000',0,NULL,NULL,NULL,'2014-06-08 00:59:41','2014-06-08 00:59:41','clients',15,1),
	(17,'aftab','khan','aftabkhan','38d199fbfc923de7014d3f00e2a27192b111a085','aftabkhan@admin.com','(333) 333-3333','kjsdflasjdflajsdfj adfjla dads fja fdl','asdfas55',0,NULL,'this is the first client',0,'2014-06-18 22:21:11','2014-06-18 22:21:11','clients',14,1),
	(18,'shani','jahania','shanijahania','f865b53623b121fd34ee5426c792e5c33af8c227','shanijahania@gmail.com','(999) 898-0890','this is test address','98989898',0,NULL,'this is test note',10,'2014-06-28 13:34:46','2014-06-28 13:34:46','salesperson',1,1);

/*!40000 ALTER TABLE `ps_users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
