-- phpMyAdmin SQL Dump
-- version 
-- 
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
-- データベース: `<YOUR_DATABASE_NAME>`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ujis AUTO_INCREMENT=3 ;

--
-- テーブルのデータをダンプしています `category`
--

INSERT INTO `category` (`id`, `category_id`, `user_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'testカテゴリ', '2019-03-08 17:17:14', NULL),
(2, NULL, NULL, 'testカテゴリ', '2019-03-08 17:17:59', NULL);
