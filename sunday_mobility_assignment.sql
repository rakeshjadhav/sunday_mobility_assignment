-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sunday_mobility_assignment
CREATE DATABASE IF NOT EXISTS `sunday_mobility_assignment` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sunday_mobility_assignment`;

-- Dumping structure for table sunday_mobility_assignment.access_token
CREATE TABLE IF NOT EXISTS `access_token` (
  `token_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `access_token` varchar(50) NOT NULL,
  `token_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `insert_dt` datetime DEFAULT NULL,
  `update_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`token_id`),
  KEY `FK__users` (`users_id`),
  CONSTRAINT `FK__users` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sunday_mobility_assignment.access_token: ~0 rows (approximately)
/*!40000 ALTER TABLE `access_token` DISABLE KEYS */;
INSERT INTO `access_token` (`token_id`, `users_id`, `access_token`, `token_status`, `insert_dt`, `update_dt`) VALUES
	(1, 1, '6d49713540f8ca6fbe214b05a003a26fb900b27a', 'active', '2021-07-11 18:55:14', '2021-07-11 18:55:14');
/*!40000 ALTER TABLE `access_token` ENABLE KEYS */;

-- Dumping structure for table sunday_mobility_assignment.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `insert_dt` datetime DEFAULT NULL,
  `update_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sunday_mobility_assignment.admin: ~1 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`user_id`, `name`, `username`, `password`, `role`, `is_active`, `is_deleted`, `insert_dt`, `update_dt`) VALUES
	(1, 'Admin', 'admin', '$2y$12$OklWRZTKEuRg0OjyzVEmK.WD76Y/MzAn2LMAawgdxyaTLyl743e5.', 'admin', '1', '0', '2021-07-11 19:50:26', '2021-07-11 19:50:27');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table sunday_mobility_assignment.department
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `insert_dt` datetime DEFAULT NULL,
  `update_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sunday_mobility_assignment.department: ~0 rows (approximately)
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` (`department_id`, `department_name`, `status`, `is_deleted`, `insert_dt`, `update_dt`) VALUES
	(1, 'IT', '0', '0', '2021-07-11 18:50:51', '2021-07-11 18:50:51');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;

-- Dumping structure for table sunday_mobility_assignment.users
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture_path` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL DEFAULT 0,
  `about` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `insert_dt` datetime DEFAULT NULL,
  `update_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`users_id`),
  KEY `FK_users_department` (`department_id`),
  CONSTRAINT `FK_users_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sunday_mobility_assignment.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`users_id`, `name`, `email`, `password`, `profile_picture_path`, `department_id`, `about`, `status`, `is_deleted`, `insert_dt`, `update_dt`) VALUES
	(1, 'Rahul Ramesh Jadhav', 'rahul@gmail.com', '$2y$10$3WBrq8P7V4K.uckstxic1e7oQ9OHYaDYOrIosedGvoDEftdAwU3/i', 'uploads/prof_images/Rahul_Ramesh_Jadhav.jpg', 1, 'test', '1', '0', '2021-07-11 18:50:51', '2021-07-11 18:50:51'),
	(2, 'Rakeh Ramesh Jadhav', 'rakesh@gmail.com', '$2y$10$E86947bMkpbGxPvafTWPNOUa0L9TR/1tUwUoaj4XyHZ4O8qyjwfou', 'uploads/prof_images/Rakeh_Ramesh_Jadhav.jpg', 1, 'im a softerware developer', '1', '0', '2021-07-11 18:57:13', '2021-07-11 18:57:13');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table sunday_mobility_assignment.users_hobbies
CREATE TABLE IF NOT EXISTS `users_hobbies` (
  `users_hob_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `hobbie` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `insert_dt` datetime DEFAULT NULL,
  `update_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`users_hob_id`),
  KEY `FK_users_hobbies_users` (`users_id`),
  CONSTRAINT `FK_users_hobbies_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table sunday_mobility_assignment.users_hobbies: ~0 rows (approximately)
/*!40000 ALTER TABLE `users_hobbies` DISABLE KEYS */;
INSERT INTO `users_hobbies` (`users_hob_id`, `users_id`, `hobbie`, `status`, `is_deleted`, `insert_dt`, `update_dt`) VALUES
	(1, 1, 'Decorating', '1', '0', '2021-07-11 18:50:51', '2021-07-11 18:50:51'),
	(2, 1, 'Music', '1', '0', '2021-07-11 18:50:51', '2021-07-11 18:50:51'),
	(3, 1, 'Cooking or baking', '1', '0', '2021-07-11 18:50:51', '2021-07-11 18:50:51'),
	(4, 2, 'Outdoor activities', '1', '0', '2021-07-11 18:57:13', '2021-07-11 18:57:13'),
	(5, 2, 'football', '1', '0', '2021-07-11 18:57:13', '2021-07-11 18:57:13'),
	(6, 2, 'solving puzzle', '1', '0', '2021-07-11 18:57:13', '2021-07-11 18:57:13');
/*!40000 ALTER TABLE `users_hobbies` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
