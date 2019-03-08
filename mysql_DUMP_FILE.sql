-- phpMyAdmin SQL Dump
-- version 3.3.10.5
-- http://www.phpmyadmin.net
--
-- ホスト: 
-- 生成時間: 
-- サーバのバージョン: 
-- PHP のバージョン: 

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: 
--
CREATE DATABASE `<YOUR_DATABASE_NAME>` DEFAULT CHARACTER SET ujis COLLATE ujis_japanese_ci;
USE `<YOUR DATABASE NAME>`;

-- --------------------------------------------------------

--
-- テーブルの構造 `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ujis AUTO_INCREMENT=10 ;

--
-- テーブルのデータをダンプしています `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `category_id`, `title`, `message`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, '', '', '2019-03-07 18:11:30', NULL),
(2, NULL, 0, '', '', '2019-03-07 18:12:12', NULL),
(3, NULL, 0, '', '', '2019-03-07 18:13:03', NULL),
(4, NULL, 0, '', '', '2019-03-07 18:19:25', NULL),
(5, NULL, 0, '', '', '2019-03-07 18:22:08', NULL),
(6, NULL, 0, '', '', '2019-03-07 18:22:08', NULL),
(7, NULL, 0, 'aa', 'aa', '2019-03-07 18:26:15', NULL),
(8, NULL, 0, 'a', 'a', '2019-03-08 13:53:37', NULL),
(9, NULL, 0, 'test', 'test', '2019-03-08 13:55:45', NULL);

