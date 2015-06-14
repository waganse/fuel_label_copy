-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2015 at 12:21 PM
-- Server version: 5.6.12
-- PHP Version: 5.3.29

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `admin_dds`
--
CREATE DATABASE IF NOT EXISTS `admin_dds` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `admin_dds`;

-- --------------------------------------------------------

--
-- Table structure for table `labelgroups`
--

DROP TABLE IF EXISTS `labelgroups`;
CREATE TABLE IF NOT EXISTS `labelgroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `remarks` text,
  `deleted_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `labelgroups`
--

INSERT INTO `labelgroups` (`id`, `name`, `remarks`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Service', 'BU services', NULL, 1434095166, 1434183704),
(2, 'Flow', 'Creative flow', NULL, 1434095214, NULL),
(3, 'Tech', 'Technical stuff', NULL, 1434095251, NULL),
(6, 'Output', 'Output types', NULL, 1434102064, 1434183027),
(7, 'test', 'testremarks', 1434183665, 1434183663, 1434183665);

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

DROP TABLE IF EXISTS `labels`;
CREATE TABLE IF NOT EXISTS `labels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `remarks` text NOT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `name`, `group_id`, `remarks`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'srv_ec', 1, 'ECG Ichiba related services', NULL, 1434096209, 1434108769),
(2, 'srv_rb', 1, 'Books/Kobo services', NULL, 1434096249, NULL),
(4, 'srv_eng', 1, 'Energy services', NULL, 1434096295, 1434107391),
(5, 'srv_sol', 1, 'Solar services', 1434108832, 1434096312, 1434108832),
(6, 'srv_bk', 1, 'Bank service', NULL, 1434110459, NULL),
(7, 'AD', 2, 'Art direction', 1434110498, 1434110495, 1434110498);

-- --------------------------------------------------------

--
-- Table structure for table `memos`
--

DROP TABLE IF EXISTS `memos`;
CREATE TABLE IF NOT EXISTS `memos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `type` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `migration` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`type`, `name`, `migration`) VALUES
('package', 'auth', '001_auth_create_usertables'),
('package', 'auth', '002_auth_create_grouptables'),
('package', 'auth', '003_auth_create_roletables'),
('package', 'auth', '004_auth_create_permissiontables'),
('package', 'auth', '005_auth_create_authdefaults'),
('package', 'auth', '006_auth_add_authactions'),
('package', 'auth', '007_auth_add_permissionsfilter'),
('package', 'auth', '008_auth_create_providers'),
('package', 'auth', '009_auth_create_oauth2tables'),
('package', 'auth', '010_auth_fix_jointables'),
('app', 'default', '001_create_labelgroups'),
('app', 'default', '002_create_labels'),
('app', 'default', '003_create_memos');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group` int(11) NOT NULL DEFAULT '1',
  `email` varchar(255) NOT NULL,
  `last_login` varchar(25) NOT NULL,
  `login_hash` varchar(255) NOT NULL,
  `profile_fields` text NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `group`, `email`, `last_login`, `login_hash`, `profile_fields`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'mFTwQ2/AJGG7UZBkziYB2KQh4PSivuFQwh6RSBckSCQ=', 100, 'yosuke.c.sato@rakuten.com', '1434186980', '41ad8808e2bcaf8fed0527664896cf9a1885172d', 'a:0:{}', 1434084590, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_clients`
--

DROP TABLE IF EXISTS `users_clients`;
CREATE TABLE IF NOT EXISTS `users_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `client_id` varchar(32) NOT NULL DEFAULT '',
  `client_secret` varchar(32) NOT NULL DEFAULT '',
  `redirect_uri` varchar(255) NOT NULL DEFAULT '',
  `auto_approve` tinyint(1) NOT NULL DEFAULT '0',
  `autonomous` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('development','pending','approved','rejected') NOT NULL DEFAULT 'development',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `notes` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_providers`
--

DROP TABLE IF EXISTS `users_providers`;
CREATE TABLE IF NOT EXISTS `users_providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `provider` varchar(50) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `secret` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `expires` int(12) DEFAULT '0',
  `refresh_token` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_scopes`
--

DROP TABLE IF EXISTS `users_scopes`;
CREATE TABLE IF NOT EXISTS `users_scopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scope` varchar(64) NOT NULL DEFAULT '',
  `name` varchar(64) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `scope` (`scope`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_sessions`
--

DROP TABLE IF EXISTS `users_sessions`;
CREATE TABLE IF NOT EXISTS `users_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) NOT NULL DEFAULT '',
  `redirect_uri` varchar(255) NOT NULL DEFAULT '',
  `type_id` varchar(64) NOT NULL,
  `type` enum('user','auto') NOT NULL DEFAULT 'user',
  `code` text NOT NULL,
  `access_token` varchar(50) NOT NULL DEFAULT '',
  `stage` enum('request','granted') NOT NULL DEFAULT 'request',
  `first_requested` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL,
  `limited_access` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `oauth_sessions_ibfk_1` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_sessionscopes`
--

DROP TABLE IF EXISTS `users_sessionscopes`;
CREATE TABLE IF NOT EXISTS `users_sessionscopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `access_token` varchar(50) NOT NULL DEFAULT '',
  `scope` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  KEY `access_token` (`access_token`),
  KEY `scope` (`scope`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `labels`
--
ALTER TABLE `labels`
  ADD CONSTRAINT `labels_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `labelgroups` (`id`);

--
-- Constraints for table `users_sessions`
--
ALTER TABLE `users_sessions`
  ADD CONSTRAINT `oauth_sessions_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users_clients` (`client_id`) ON DELETE CASCADE;

--
-- Constraints for table `users_sessionscopes`
--
ALTER TABLE `users_sessionscopes`
  ADD CONSTRAINT `oauth_sessionscopes_ibfk_1` FOREIGN KEY (`scope`) REFERENCES `users_scopes` (`scope`),
  ADD CONSTRAINT `oauth_sessionscopes_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `users_sessions` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
