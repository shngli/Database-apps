-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2011 at 05:59 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `changegame`
--

-- --------------------------------------------------------

--
-- Table structure for table `attempt`
--

CREATE TABLE IF NOT EXISTS `attempt` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `successful` varchar(128) NOT NULL,
  `time` time NOT NULL,
  `scenario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `attempt`
--

INSERT INTO `attempt` (`id`, `user_id`, `level_id`, `item_id`, `successful`, `time`, `scenario_id`) VALUES
(1, 2, 1, 4, 'succeeded', '00:00:00', 4),
(2, 2, 1, 10, 'succeeded', '00:00:00', 4),
(3, 2, 1, 7, 'succeeded', '00:00:00', 4),
(4, 2, 1, 7, 'succeeded', '00:00:00', 5),
(5, 2, 1, 11, 'succeeded', '00:00:00', 5),
(6, 2, 1, 11, 'failed', '00:00:00', 5),
(7, 2, 1, 11, 'failed', '00:00:00', 5),
(8, 2, 1, 11, 'succeeded', '00:00:00', 5),
(9, 2, 1, 7, 'succeeded', '00:00:00', 6),
(10, 2, 1, 1, 'failed', '00:00:00', 6),
(11, 2, 1, 1, 'succeeded', '00:00:00', 6),
(12, 2, 1, 8, 'failed', '00:00:00', 6),
(13, 2, 1, 8, 'stopped', '00:00:00', 6),
(14, 2, 1, 8, 'failed', '838:59:59', 6),
(15, 2, 1, 9, 'failed', '838:59:59', 6),
(16, 2, 1, 9, 'succeeded', '838:59:59', 6),
(17, 2, 1, 9, 'succeeded', '838:59:59', 7),
(18, 2, 1, 7, 'succeeded', '838:59:59', 8),
(19, 2, 1, 8, 'succeeded', '838:59:59', 8),
(20, 2, 1, 7, 'succeeded', '838:59:59', 8),
(21, 2, 1, 8, 'succeeded', '838:59:59', 8),
(22, 2, 1, 9, 'succeeded', '00:00:06', 8),
(23, 2, 1, 9, 'succeeded', '00:00:08', 8),
(24, 2, 1, 9, 'succeeded', '00:00:52', 8),
(25, 2, 1, 9, 'succeeded', '00:00:00', 8),
(26, 2, 1, 9, 'succeeded', '00:02:18', 8),
(27, 2, 1, 9, 'succeeded', '00:00:06', 8),
(28, 2, 1, 9, 'succeeded', '00:00:03', 8),
(29, 2, 1, 9, 'failed', '00:00:08', 8),
(30, 2, 1, 9, 'failed', '00:00:02', 8),
(31, 2, 1, 9, 'stopped', '00:00:02', 8),
(32, 2, 1, 9, 'succeeded', '00:00:03', 8),
(33, 2, 1, 4, 'succeeded', '00:00:06', 9),
(34, 2, 1, 7, 'succeeded', '00:00:05', 9),
(35, 2, 1, 12, 'succeeded', '00:00:05', 9),
(36, 2, 2, 1, 'succeeded', '00:00:15', 10),
(37, 2, 2, 2, 'succeeded', '00:00:10', 10),
(38, 2, 2, 6, 'succeeded', '00:00:10', 10),
(39, 2, 2, 7, 'succeeded', '00:00:13', 10),
(40, 2, 2, 9, 'failed', '00:00:09', 10),
(41, 2, 2, 9, 'failed', '00:00:18', 10),
(42, 2, 2, 9, 'succeeded', '00:00:31', 10),
(43, 2, 3, 1, 'succeeded', '00:00:13', 11),
(44, 2, 3, 2, 'succeeded', '00:00:13', 11),
(45, 2, 3, 5, 'succeeded', '00:00:16', 11),
(46, 2, 3, 7, 'succeeded', '00:00:11', 11),
(47, 2, 3, 8, 'failed', '00:00:16', 11),
(48, 2, 3, 8, 'succeeded', '00:00:35', 11),
(49, 2, 3, 9, 'succeeded', '00:00:13', 11),
(50, 2, 3, 12, 'succeeded', '00:00:18', 11),
(51, 2, 1, 1, 'failed', '00:00:14', 14),
(52, 2, 1, 1, 'stopped', '00:00:14', 14),
(53, 2, 1, 1, 'failed', '00:00:06', 15),
(54, 2, 1, 1, 'stopped', '00:00:06', 15),
(55, 2, 1, 1, 'failed', '00:00:05', 15),
(56, 2, 1, 1, 'stopped', '00:00:05', 15),
(57, 2, 1, 2, 'failed', '00:00:05', 16),
(58, 2, 1, 2, 'stopped', '00:00:05', 16),
(59, 2, 1, 1, 'failed', '00:00:03', 17),
(60, 2, 1, 1, 'stopped', '00:00:03', 17),
(61, 4, 1, 1, 'succeeded', '00:00:09', 19),
(62, 4, 1, 2, 'succeeded', '00:00:13', 19),
(63, 4, 1, 3, 'succeeded', '00:00:06', 19),
(64, 4, 1, 4, 'succeeded', '00:00:04', 19),
(65, 4, 1, 2, 'failed', '00:00:26', 20),
(66, 4, 1, 2, 'stopped', '00:00:26', 20),
(67, 4, 1, 10, 'failed', '00:01:52', 20),
(68, 4, 1, 10, 'stopped', '00:01:52', 20),
(69, 2, 1, 9, 'succeeded', '00:00:15', 21),
(70, 4, 1, 5, 'succeeded', '00:00:06', 22),
(71, 4, 1, 6, 'succeeded', '00:00:05', 22),
(72, 4, 1, 11, 'succeeded', '00:00:04', 22),
(73, 4, 2, 9, 'succeeded', '00:00:17', 23),
(74, 4, 1, 3, 'succeeded', '00:00:05', 24),
(75, 4, 1, 8, 'succeeded', '00:00:05', 25),
(76, 4, 1, 11, 'succeeded', '00:00:05', 25),
(77, 4, 1, 9, 'succeeded', '00:00:05', 25),
(78, 4, 1, 9, 'succeeded', '00:00:03', 25),
(79, 4, 1, 9, 'succeeded', '00:00:04', 25),
(80, 4, 1, 9, 'succeeded', '00:00:04', 25),
(81, 4, 1, 9, 'succeeded', '00:00:03', 25),
(82, 4, 1, 5, 'failed', '00:00:15', 25),
(83, 4, 1, 5, 'failed', '00:00:00', 25),
(84, 4, 1, 5, 'failed', '00:00:00', 25),
(85, 4, 1, 5, 'failed', '00:01:04', 25),
(86, 4, 1, 5, 'failed', '00:01:29', 25),
(87, 4, 1, 5, 'stopped', '00:01:29', 25),
(88, 4, 1, 5, 'succeeded', '00:00:05', 25),
(89, 5, 1, 9, 'succeeded', '00:00:17', 27),
(90, 5, 1, 3, 'succeeded', '00:00:19', 27),
(91, 5, 1, 2, 'succeeded', '00:00:10', 27);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `displayname` varchar(128) NOT NULL,
  `css` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `displayname`, `css`) VALUES
(1, 'gold_egg', 'Gold Egg', 'goldegg'),
(2, 'crystal_egg', 'Crystal Egg', 'crystalegg'),
(3, 'vortex_egg', 'Vortex Egg', 'vortexegg'),
(4, 'dragon_potion', 'Dragon Potion', 'dragonpotion'),
(5, 'bat_potion', 'Bat Potion', 'batpotion'),
(6, 'fox_potion', 'Fox Potion', 'foxpotion'),
(7, 'star_sand', 'Star Sand', 'starsand'),
(8, 'fairy_sand', 'Fairy Sand', 'fairysand'),
(9, 'gryphon_sand', 'Gryphon Sand', 'gryphonsand'),
(10, 'black_mushroom', 'Black Mushroom', 'blackmushroom'),
(11, 'leafy_mushroom', 'Leafy Mushroom', 'leafymushroom'),
(12, 'tree_mushroom', 'Tree Mushroom', 'treemushroom');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(128) NOT NULL,
  `startingpurse` decimal(5,2) NOT NULL,
  `itemsnumber` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level`, `startingpurse`, `itemsnumber`) VALUES
(1, 'easy', 20.00, 3),
(2, 'medium', 30.00, 5),
(3, 'hard', 40.00, 7);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE IF NOT EXISTS `price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `item_id`, `level_id`, `price`) VALUES
(1, 1, 1, 3.00),
(2, 1, 2, 3.40),
(3, 1, 3, 3.47),
(4, 2, 1, 4.00),
(5, 2, 2, 4.30),
(6, 2, 3, 4.31),
(7, 3, 1, 5.00),
(8, 3, 2, 5.80),
(9, 3, 3, 5.87),
(10, 4, 1, 4.00),
(11, 4, 2, 4.70),
(12, 4, 3, 4.76),
(13, 5, 1, 3.00),
(14, 5, 2, 3.60),
(15, 5, 3, 3.69),
(16, 6, 1, 2.00),
(17, 6, 2, 2.10),
(18, 6, 3, 2.15),
(19, 7, 1, 3.00),
(20, 7, 2, 3.30),
(21, 7, 3, 3.32),
(22, 8, 1, 2.00),
(23, 8, 2, 2.80),
(24, 8, 3, 2.83),
(25, 9, 1, 1.00),
(26, 9, 2, 1.60),
(27, 9, 3, 1.64),
(28, 10, 1, 2.00),
(29, 10, 2, 2.50),
(30, 10, 3, 2.56),
(31, 11, 1, 1.00),
(32, 11, 2, 1.90),
(33, 11, 3, 1.97),
(34, 12, 1, 1.00),
(35, 12, 2, 0.90),
(36, 12, 3, 0.92);

-- --------------------------------------------------------

--
-- Table structure for table `scenario`
--

CREATE TABLE IF NOT EXISTS `scenario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `starttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `scenario`
--

INSERT INTO `scenario` (`id`, `user_id`, `level_id`, `starttime`) VALUES
(1, 2, 1, '2011-12-15 02:38:46'),
(2, 2, 1, '2011-12-15 02:40:42'),
(3, 2, 1, '2011-12-15 03:25:14'),
(4, 2, 1, '2011-12-15 03:27:53'),
(5, 2, 1, '2011-12-15 03:39:20'),
(6, 2, 1, '2011-12-15 03:48:50'),
(7, 2, 1, '2011-12-15 04:21:39'),
(8, 2, 1, '2011-12-15 04:24:02'),
(9, 2, 1, '2011-12-15 04:59:08'),
(10, 2, 2, '2011-12-15 04:59:44'),
(11, 2, 3, '2011-12-15 05:01:34'),
(12, 4, 1, '2011-12-15 08:22:05'),
(13, 2, 1, '2011-12-15 08:36:29'),
(14, 2, 1, '2011-12-15 08:37:47'),
(15, 2, 1, '2011-12-15 08:44:51'),
(16, 2, 1, '2011-12-15 08:47:50'),
(17, 2, 1, '2011-12-15 08:49:15'),
(18, 2, 1, '2011-12-15 09:07:54'),
(19, 4, 1, '2011-12-15 09:08:32'),
(20, 4, 1, '2011-12-15 09:21:23'),
(21, 2, 1, '2011-12-15 09:50:12'),
(22, 4, 1, '2011-12-15 09:55:45'),
(23, 4, 2, '2011-12-15 09:58:54'),
(24, 4, 1, '2011-12-15 10:59:38'),
(25, 4, 1, '2011-12-15 11:23:57'),
(26, 4, 1, '2011-12-15 11:47:28'),
(27, 5, 1, '2011-12-15 11:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `type` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'amy', 'testera', 'test', 'admin'),
(2, 'bob', 'testerb', 'test', 'student'),
(3, 'cynthia', 'testerc', 'test', 'admin'),
(4, 'dimitry', 'testerd', 'test', 'student'),
(5, 'Rachael', 'rae', 'fox', 'student');
