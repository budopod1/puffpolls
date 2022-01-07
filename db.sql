-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.15-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for puffsuggestions
CREATE DATABASE IF NOT EXISTS `puffsuggestions` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `puffsuggestions`;

-- Dumping structure for table puffsuggestions.suggestionoptions
CREATE TABLE IF NOT EXISTS `suggestionoptions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pollid` int(11) unsigned NOT NULL DEFAULT 0,
  `option` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_suggstionoptions_suggestions` (`pollid`),
  CONSTRAINT `FK_suggstionoptions_suggestions` FOREIGN KEY (`pollid`) REFERENCES `suggestions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='This table will strore th options for the poll';

-- Dumping data for table puffsuggestions.suggestionoptions: ~15 rows (approximately)
DELETE FROM `suggestionoptions`;
/*!40000 ALTER TABLE `suggestionoptions` DISABLE KEYS */;
INSERT INTO `suggestionoptions` (`id`, `pollid`, `option`, `created_at`, `updated_at`) VALUES
	(2, 10, 'Up Vote', '2019-06-19 15:02:43', '2019-06-19 15:02:43'),
	(3, 10, 'Down Vote', '2019-06-19 15:02:43', '2019-06-19 15:02:43'),
	(4, 12, 'GOOD idea', '2019-06-20 10:19:17', '2019-06-20 11:07:01'),
	(5, 12, 'BAD idea', '2019-06-20 10:21:51', '2019-06-20 11:07:11'),
	(9, 13, 'YES', '2019-06-20 13:13:37', '2019-06-20 13:13:37'),
	(10, 13, 'NO', '2019-06-20 13:13:40', '2019-06-20 13:13:40'),
	(11, 13, 'OK', '2019-06-20 13:13:45', '2019-06-20 13:13:45'),
	(16, 16, 'Up Vote', '2019-06-21 09:52:28', '2019-06-21 09:52:28'),
	(17, 16, 'Down Vote', '2019-06-21 09:52:28', '2019-06-21 09:52:28'),
	(18, 17, 'Up Vote', '2019-06-21 09:53:01', '2019-06-21 09:53:01'),
	(19, 17, 'Down Vote', '2019-06-21 09:53:01', '2019-06-21 09:53:01'),
	(20, 18, 'Up Vote', '2019-06-21 11:03:30', '2019-06-21 11:03:30'),
	(21, 18, 'Down Vote', '2019-06-21 11:03:30', '2019-06-21 11:03:30'),
	(24, 20, 'Up Vote', '2019-06-21 11:36:34', '2019-06-21 11:36:34'),
	(25, 20, 'Down Vote', '2019-06-21 11:36:34', '2019-06-21 11:36:34');
/*!40000 ALTER TABLE `suggestionoptions` ENABLE KEYS */;

-- Dumping structure for table puffsuggestions.suggestions
CREATE TABLE IF NOT EXISTS `suggestions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `votenum` int(11) unsigned NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Untitled',
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No content',
  `userid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_suggestions_users` (`userid`),
  CONSTRAINT `FK_suggestions_users` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table puffsuggestions.suggestions: ~7 rows (approximately)
DELETE FROM `suggestions`;
/*!40000 ALTER TABLE `suggestions` DISABLE KEYS */;
INSERT INTO `suggestions` (`id`, `votenum`, `created_at`, `updated_at`, `title`, `content`, `userid`) VALUES
	(10, 1, '2019-06-19 15:02:43', '2019-06-21 11:45:36', 'TEST 1 that is much longer than normal', 'TEST 1', 8),
	(12, 1, '2019-06-20 09:59:10', '2019-06-21 09:54:12', 'TEST admin poll', '', 8),
	(13, 29, '2019-06-20 13:13:10', '2019-06-21 09:55:35', 'TEST admin poll 2', 'WITH CONTENT', 1),
	(16, 0, '2019-06-21 09:52:28', '2019-06-21 10:19:33', 'TEST 2', 'Test format Sort By:', 1),
	(17, 1, '2019-06-21 09:53:01', '2019-06-21 10:39:38', 'TEST 3', 'Test with Sort By: formatting more', 1),
	(18, 0, '2019-06-21 11:03:30', '2019-06-21 11:03:30', 'asdfasdfasdf TEST', '', 1),
	(20, 1, '2019-06-21 11:36:34', '2019-06-21 11:46:34', 'mmmmmmmmmmmmmmmmmmmmmmm', 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', 1);
/*!40000 ALTER TABLE `suggestions` ENABLE KEYS */;

-- Dumping structure for table puffsuggestions.suggestionvotes
CREATE TABLE IF NOT EXISTS `suggestionvotes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `optionid` int(11) unsigned NOT NULL,
  `userid` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_sggestionvotes_users` (`userid`),
  KEY `FK_suggestionvotes_suggestionoptions` (`optionid`),
  CONSTRAINT `FK_sggestionvotes_users` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_suggestionvotes_suggestionoptions` FOREIGN KEY (`optionid`) REFERENCES `suggestionoptions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='this will store votes';

-- Dumping data for table puffsuggestions.suggestionvotes: ~33 rows (approximately)
DELETE FROM `suggestionvotes`;
/*!40000 ALTER TABLE `suggestionvotes` DISABLE KEYS */;
INSERT INTO `suggestionvotes` (`id`, `optionid`, `userid`, `created_at`, `updated_at`) VALUES
	(1, 9, 1, '2019-06-20 13:44:33', '2019-06-20 13:44:33'),
	(2, 10, 1, '2019-06-20 13:54:46', '2019-06-20 13:54:46'),
	(3, 10, 1, '2019-06-20 13:55:17', '2019-06-20 13:55:17'),
	(4, 9, 1, '2019-06-20 13:57:21', '2019-06-20 13:57:21'),
	(5, 9, 1, '2019-06-20 13:57:23', '2019-06-20 13:57:23'),
	(6, 9, 1, '2019-06-20 13:57:28', '2019-06-20 13:57:28'),
	(7, 10, 1, '2019-06-20 13:57:34', '2019-06-20 13:57:34'),
	(8, 9, 1, '2019-06-20 13:57:37', '2019-06-20 13:57:37'),
	(9, 11, 1, '2019-06-20 13:57:44', '2019-06-20 13:57:44'),
	(10, 9, 1, '2019-06-20 13:58:53', '2019-06-20 13:58:53'),
	(11, 9, 1, '2019-06-20 13:58:53', '2019-06-20 13:58:53'),
	(12, 9, 1, '2019-06-20 13:58:53', '2019-06-20 13:58:53'),
	(13, 9, 1, '2019-06-20 13:58:53', '2019-06-20 13:58:53'),
	(14, 9, 1, '2019-06-20 13:58:53', '2019-06-20 13:58:53'),
	(15, 9, 1, '2019-06-20 13:58:53', '2019-06-20 13:58:53'),
	(16, 9, 1, '2019-06-20 13:58:54', '2019-06-20 13:58:54'),
	(17, 9, 1, '2019-06-20 13:58:54', '2019-06-20 13:58:54'),
	(18, 9, 1, '2019-06-20 13:58:54', '2019-06-20 13:58:54'),
	(19, 9, 1, '2019-06-20 13:58:54', '2019-06-20 13:58:54'),
	(20, 9, 1, '2019-06-20 13:58:54', '2019-06-20 13:58:54'),
	(21, 9, 1, '2019-06-20 13:58:55', '2019-06-20 13:58:55'),
	(22, 9, 1, '2019-06-20 13:58:55', '2019-06-20 13:58:55'),
	(23, 9, 1, '2019-06-20 13:58:55', '2019-06-20 13:58:55'),
	(24, 9, 1, '2019-06-20 13:58:55', '2019-06-20 13:58:55'),
	(25, 9, 1, '2019-06-20 13:58:55', '2019-06-20 13:58:55'),
	(26, 9, 1, '2019-06-20 13:58:56', '2019-06-20 13:58:56'),
	(27, 9, 1, '2019-06-20 13:58:56', '2019-06-20 13:58:56'),
	(28, 9, 1, '2019-06-20 13:58:56', '2019-06-20 13:58:56'),
	(29, 9, 1, '2019-06-20 13:58:56', '2019-06-20 13:58:56'),
	(30, 2, 1, '2019-06-21 09:44:56', '2019-06-21 09:44:56'),
	(31, 4, 1, '2019-06-21 09:45:15', '2019-06-21 09:45:15'),
	(34, 18, 1, '2019-06-21 10:39:38', '2019-06-21 10:39:38'),
	(35, 24, 1, '2019-06-21 11:46:34', '2019-06-21 11:46:34');
/*!40000 ALTER TABLE `suggestionvotes` ENABLE KEYS */;

-- Dumping structure for table puffsuggestions.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='This table is for users';

-- Dumping data for table puffsuggestions.users: ~7 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `pass`, `type`, `created_at`, `updated_at`) VALUES
	(1, 'budopod', '$2y$10$Se7AlrAAx.Nyx6D3J03j1eTaGD5rBuGXRecmz0EnBr4.tJ4/MzyP2', 'admin', '2019-06-18 11:50:48', '2019-06-19 11:43:43'),
	(2, 'testuser1', '$2y$10$Se7AlrAAx.Nyx6D3J03j1eTaGD5rBuGXRecmz0EnBr4.tJ4/MzyP2', 'user', '2019-06-18 12:45:53', '2019-06-19 11:40:25'),
	(3, 'testuser2', '$2y$10$Se7AlrAAx.Nyx6D3J03j1eTaGD5rBuGXRecmz0EnBr4.tJ4/MzyP2', 'user', '2019-06-18 12:56:06', '2019-06-19 11:40:22'),
	(4, 'testuser3', '$2y$10$Se7AlrAAx.Nyx6D3J03j1eTaGD5rBuGXRecmz0EnBr4.tJ4/MzyP2', 'user', '2019-06-18 12:58:53', '2019-06-19 11:40:19'),
	(7, 'budopod2', '$2y$10$Se7AlrAAx.Nyx6D3J03j1eTaGD5rBuGXRecmz0EnBr4.tJ4/MzyP2', 'admin', '2019-06-19 11:25:14', '2019-06-19 11:43:48'),
	(8, 'budopod3', '$2y$10$Se7AlrAAx.Nyx6D3J03j1eTaGD5rBuGXRecmz0EnBr4.tJ4/MzyP2', 'admin', '2019-06-19 11:32:32', '2019-06-19 11:43:52'),
	(9, 'budopod4', '$2y$10$.x7oLusy1vwZGOg8PqTeSO0RCIEKvhBUdtye6fT7P87X9FyWaOPCS', 'admin', '2019-06-21 12:50:45', '2019-06-21 12:57:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
