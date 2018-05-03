-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 03 mai 2018 à 22:14
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `socialmedia`
--

-- --------------------------------------------------------

--
-- Structure de la table `chatgroups`
--

DROP TABLE IF EXISTS `chatgroups`;
CREATE TABLE IF NOT EXISTS `chatgroups` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_User` int(11) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Notif` enum('viewed','new') NOT NULL DEFAULT 'viewed',
  PRIMARY KEY (`ID`,`ID_User`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chatgroups`
--

INSERT INTO `chatgroups` (`ID`, `ID_User`, `Name`, `Notif`) VALUES
(28, 2, 'Arthur Prat', 'viewed'),
(28, 6, 'Maxime Maxime', 'viewed');

-- --------------------------------------------------------

--
-- Structure de la table `chatmessages`
--

DROP TABLE IF EXISTS `chatmessages`;
CREATE TABLE IF NOT EXISTS `chatmessages` (
  `ID_Conv` int(11) NOT NULL,
  `ID_Post` int(11) NOT NULL,
  KEY `ID_Conv` (`ID_Conv`),
  KEY `ID_Post` (`ID_Post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chatmessages`
--

INSERT INTO `chatmessages` (`ID_Conv`, `ID_Post`) VALUES
(28, 239),
(28, 240),
(28, 241),
(28, 242);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `ID_Object` int(11) NOT NULL,
  `ID_Post` int(11) NOT NULL,
  PRIMARY KEY (`ID_Object`),
  KEY `ID_Post` (`ID_Post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`ID_Object`, `ID_Post`) VALUES
(13, 3),
(24, 8),
(25, 8),
(40, 35),
(64, 35),
(167, 35),
(180, 35),
(181, 35),
(69, 68),
(164, 68),
(165, 68),
(166, 68),
(168, 68),
(169, 68),
(170, 68),
(171, 68),
(172, 68),
(182, 68),
(183, 68);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `ID_Object` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Location` varchar(32) DEFAULT NULL,
  `Status` enum('Public','Private','Friends Only','Network') NOT NULL DEFAULT 'Public',
  PRIMARY KEY (`ID_Object`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`ID_Object`, `Date`, `Location`, `Status`) VALUES
(2, NULL, 'beaugrenelle', 'Private'),
(26, NULL, NULL, 'Public'),
(34, NULL, NULL, 'Public'),
(35, NULL, NULL, 'Public'),
(37, NULL, NULL, 'Public'),
(38, NULL, NULL, 'Public'),
(39, NULL, NULL, 'Public'),
(41, NULL, NULL, 'Public'),
(42, NULL, NULL, 'Public'),
(63, NULL, NULL, 'Public'),
(65, NULL, NULL, 'Public'),
(66, NULL, NULL, 'Public'),
(67, NULL, NULL, 'Public'),
(68, NULL, NULL, 'Public'),
(221, NULL, NULL, 'Public'),
(222, NULL, NULL, 'Public');

-- --------------------------------------------------------

--
-- Structure de la table `friendships`
--

DROP TABLE IF EXISTS `friendships`;
CREATE TABLE IF NOT EXISTS `friendships` (
  `ID_User1` int(11) NOT NULL,
  `ID_User2` int(11) NOT NULL,
  `Status` enum('Accepted','Request sent','Waiting') NOT NULL,
  `Relationship` enum('Pro','Friend') NOT NULL,
  PRIMARY KEY (`ID_User1`,`ID_User2`),
  KEY `ID_User2` (`ID_User2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `friendships`
--

INSERT INTO `friendships` (`ID_User1`, `ID_User2`, `Status`, `Relationship`) VALUES
(1, 2, 'Accepted', 'Pro'),
(1, 4, 'Waiting', 'Friend'),
(1, 6, 'Accepted', 'Friend'),
(2, 1, 'Request sent', 'Friend'),
(2, 4, 'Accepted', 'Pro'),
(2, 6, 'Accepted', 'Friend'),
(4, 1, 'Accepted', 'Friend'),
(4, 2, 'Accepted', 'Friend'),
(4, 6, 'Accepted', 'Friend'),
(6, 1, 'Accepted', 'Friend'),
(6, 2, 'Accepted', 'Friend'),
(6, 4, 'Accepted', 'Friend');

-- --------------------------------------------------------

--
-- Structure de la table `joboffers`
--

DROP TABLE IF EXISTS `joboffers`;
CREATE TABLE IF NOT EXISTS `joboffers` (
  `ID_Object` int(11) NOT NULL,
  `JobLocation` varchar(32) NOT NULL,
  `Company` varchar(32) NOT NULL,
  `Title` varchar(240) NOT NULL,
  `JobDescription` text,
  `Length` int(4) DEFAULT '0',
  `Skills` text,
  `Area` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID_Object`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `joboffers`
--

INSERT INTO `joboffers` (`ID_Object`, `JobLocation`, `Company`, `Title`, `JobDescription`, `Length`, `Skills`, `Area`) VALUES
(214, 'jj', 'jj', 'jj', 'jj', 2, 'jj', 'jj'),
(215, 'erger', 'ergerg', 'erger', 'erger', 5, 'regerg', 'erg');

-- --------------------------------------------------------

--
-- Structure de la table `jobreacts`
--

DROP TABLE IF EXISTS `jobreacts`;
CREATE TABLE IF NOT EXISTS `jobreacts` (
  `ID_Offer` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  PRIMARY KEY (`ID_Offer`,`ID_User`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jobrequests`
--

DROP TABLE IF EXISTS `jobrequests`;
CREATE TABLE IF NOT EXISTS `jobrequests` (
  `ID_Object` int(11) NOT NULL,
  `Length` decimal(4,1) DEFAULT '0.0' COMMENT 'en mois',
  `Area` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID_Object`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `objectposts`
--

DROP TABLE IF EXISTS `objectposts`;
CREATE TABLE IF NOT EXISTS `objectposts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_User` int(11) NOT NULL,
  `Date_Post` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Url_Media` varchar(32) DEFAULT NULL,
  `Description` text,
  PRIMARY KEY (`ID`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `objectposts`
--

INSERT INTO `objectposts` (`ID`, `ID_User`, `Date_Post`, `Url_Media`, `Description`) VALUES
(2, 2, '2018-04-11 05:09:08', NULL, 'je suis pd'),
(3, 1, '2018-04-18 04:00:00', NULL, 'je savais que t\'etais pd'),
(4, 2, '2018-04-04 00:00:00', NULL, NULL),
(5, 1, '2018-04-27 00:00:00', NULL, NULL),
(6, 2, '2018-04-04 00:00:00', 'uploads/user6/post67.png', NULL),
(7, 2, '2018-04-04 00:00:00', NULL, NULL),
(8, 2, '2018-04-04 00:00:00', NULL, NULL),
(9, 2, '2018-04-04 00:00:00', NULL, NULL),
(10, 2, '2018-04-04 00:00:00', NULL, NULL),
(11, 2, '2018-04-04 00:00:00', NULL, NULL),
(13, 2, '2018-04-04 00:00:00', NULL, NULL),
(24, 1, '2025-04-04 00:00:00', NULL, 'salut'),
(25, 1, '2025-04-04 00:00:00', NULL, 'salut'),
(26, 4, '2018-05-01 11:04:08', NULL, 'yo bb'),
(27, 6, '2018-05-01 17:54:17', NULL, NULL),
(28, 6, '2018-05-01 18:02:03', NULL, NULL),
(29, 6, '2018-05-01 18:05:43', NULL, 'yooo'),
(32, 6, '2018-05-01 18:35:18', NULL, 'Maxime est gay'),
(33, 6, '2018-05-01 18:40:17', NULL, 'Maxime est gay'),
(34, 6, '2018-05-01 18:45:00', NULL, 'Maxime est gay'),
(35, 6, '2019-05-01 18:46:41', NULL, 'Maxime est beau'),
(36, 6, '2018-05-01 18:48:49', NULL, 'Sam est moche'),
(37, 6, '2018-05-01 18:49:15', NULL, 'Sam est moche'),
(38, 6, '2018-05-01 18:59:52', NULL, 'Sam est moche'),
(39, 6, '2018-05-01 19:01:22', NULL, 'Sam est pas con'),
(40, 6, '2018-05-02 21:49:51', NULL, 'rgerg'),
(41, 6, '2018-05-02 22:00:01', NULL, ''),
(42, 6, '2018-05-02 22:01:26', NULL, 's'),
(43, 6, '2018-05-02 22:07:47', NULL, ''),
(44, 6, '2018-05-02 22:10:13', NULL, ''),
(45, 6, '2018-05-02 22:10:41', NULL, ''),
(46, 6, '2018-05-02 22:13:18', NULL, NULL),
(47, 6, '2018-05-02 22:13:55', NULL, NULL),
(48, 6, '2018-05-02 22:14:21', NULL, NULL),
(49, 6, '2018-05-02 22:26:28', NULL, 'ss'),
(50, 6, '2018-05-02 22:27:08', NULL, 'ss'),
(51, 6, '2018-05-02 22:32:56', NULL, 'ss'),
(52, 6, '2018-05-02 22:35:54', NULL, ''),
(53, 6, '2018-05-02 22:36:15', NULL, 'ssda'),
(54, 6, '2018-05-02 22:43:07', NULL, NULL),
(55, 6, '2018-05-02 22:44:20', NULL, NULL),
(56, 6, '2018-05-02 22:45:31', NULL, NULL),
(57, 6, '2018-05-02 22:46:13', NULL, NULL),
(58, 6, '2018-05-02 22:47:18', NULL, NULL),
(59, 6, '2018-05-02 22:52:24', NULL, ''),
(60, 6, '2018-05-02 23:16:50', NULL, 'test'),
(61, 6, '2018-05-02 23:18:45', NULL, 'frieb'),
(62, 6, '2018-05-03 00:12:14', NULL, 'sds'),
(63, 6, '2018-05-03 00:12:31', NULL, 'qfs'),
(64, 6, '2018-05-03 00:19:03', NULL, 'qsd'),
(65, 6, '2018-05-03 00:23:18', NULL, 'test image'),
(66, 6, '2018-05-03 00:25:00', NULL, 'test2'),
(67, 6, '2018-05-03 00:26:39', NULL, 'test 3'),
(68, 6, '2018-05-03 00:29:45', 'uploads/user6/post68.png', 'test 4'),
(69, 6, '2018-05-03 00:30:58', NULL, 'super boulot'),
(70, 6, '2018-05-03 00:48:54', NULL, 'fer'),
(71, 6, '2018-05-03 00:48:54', NULL, NULL),
(72, 6, '2018-05-03 00:48:54', NULL, NULL),
(73, 6, '2018-05-03 00:48:54', NULL, NULL),
(74, 6, '2018-05-03 00:48:54', NULL, NULL),
(75, 6, '2018-05-03 00:48:54', NULL, NULL),
(76, 6, '2018-05-03 00:48:54', NULL, NULL),
(77, 6, '2018-05-03 00:48:54', NULL, NULL),
(78, 6, '2018-05-03 00:48:54', NULL, NULL),
(79, 6, '2018-05-03 00:48:54', NULL, NULL),
(80, 6, '2018-05-03 00:48:54', NULL, NULL),
(81, 6, '2018-05-03 00:48:54', NULL, NULL),
(82, 6, '2018-05-03 00:48:54', NULL, NULL),
(83, 6, '2018-05-03 00:48:54', NULL, NULL),
(84, 6, '2018-05-03 00:48:54', NULL, NULL),
(85, 6, '2018-05-03 00:48:54', NULL, NULL),
(86, 6, '2018-05-03 00:48:55', NULL, NULL),
(87, 6, '2018-05-03 00:48:55', NULL, NULL),
(88, 6, '2018-05-03 00:48:55', NULL, NULL),
(89, 6, '2018-05-03 00:48:55', NULL, NULL),
(90, 6, '2018-05-03 00:48:55', NULL, NULL),
(91, 6, '2018-05-03 00:48:55', NULL, NULL),
(92, 6, '2018-05-03 00:48:55', NULL, NULL),
(93, 6, '2018-05-03 00:48:55', NULL, NULL),
(94, 6, '2018-05-03 00:48:55', NULL, NULL),
(95, 6, '2018-05-03 00:48:55', NULL, NULL),
(96, 6, '2018-05-03 00:48:55', NULL, NULL),
(97, 6, '2018-05-03 00:48:55', NULL, NULL),
(98, 6, '2018-05-03 00:48:55', NULL, NULL),
(99, 6, '2018-05-03 00:48:55', NULL, NULL),
(100, 6, '2018-05-03 00:48:55', NULL, NULL),
(101, 6, '2018-05-03 00:48:55', NULL, NULL),
(102, 6, '2018-05-03 00:48:55', NULL, NULL),
(103, 6, '2018-05-03 00:48:55', NULL, NULL),
(104, 6, '2018-05-03 00:48:55', NULL, NULL),
(105, 6, '2018-05-03 00:48:55', NULL, NULL),
(106, 6, '2018-05-03 00:48:55', NULL, NULL),
(107, 6, '2018-05-03 00:48:55', NULL, NULL),
(108, 6, '2018-05-03 00:48:55', NULL, NULL),
(109, 6, '2018-05-03 00:48:55', NULL, NULL),
(110, 6, '2018-05-03 00:48:55', NULL, NULL),
(111, 6, '2018-05-03 00:48:56', NULL, NULL),
(112, 6, '2018-05-03 00:48:56', NULL, NULL),
(113, 6, '2018-05-03 00:48:56', NULL, NULL),
(114, 6, '2018-05-03 00:48:56', NULL, NULL),
(115, 6, '2018-05-03 00:48:56', NULL, NULL),
(116, 6, '2018-05-03 00:48:56', NULL, NULL),
(117, 6, '2018-05-03 00:48:56', NULL, NULL),
(118, 6, '2018-05-03 00:48:56', NULL, NULL),
(119, 6, '2018-05-03 00:48:56', NULL, NULL),
(120, 6, '2018-05-03 00:48:56', NULL, NULL),
(121, 6, '2018-05-03 00:48:56', NULL, NULL),
(122, 6, '2018-05-03 00:48:56', NULL, NULL),
(123, 6, '2018-05-03 00:48:56', NULL, NULL),
(124, 6, '2018-05-03 00:48:56', NULL, NULL),
(125, 6, '2018-05-03 00:48:56', NULL, NULL),
(126, 6, '2018-05-03 00:48:56', NULL, NULL),
(127, 6, '2018-05-03 00:48:56', NULL, NULL),
(128, 6, '2018-05-03 00:48:56', NULL, NULL),
(129, 6, '2018-05-03 00:48:56', NULL, NULL),
(130, 6, '2018-05-03 00:48:56', NULL, NULL),
(131, 6, '2018-05-03 00:48:56', NULL, NULL),
(132, 6, '2018-05-03 00:48:56', NULL, NULL),
(133, 6, '2018-05-03 00:48:57', NULL, NULL),
(134, 6, '2018-05-03 00:48:57', NULL, NULL),
(135, 6, '2018-05-03 00:48:57', NULL, NULL),
(136, 6, '2018-05-03 00:48:57', NULL, NULL),
(137, 6, '2018-05-03 00:48:57', NULL, NULL),
(138, 6, '2018-05-03 00:48:57', NULL, NULL),
(139, 6, '2018-05-03 00:48:57', NULL, NULL),
(140, 6, '2018-05-03 00:48:57', NULL, NULL),
(141, 6, '2018-05-03 00:48:57', NULL, NULL),
(142, 6, '2018-05-03 00:48:57', NULL, NULL),
(143, 6, '2018-05-03 00:48:57', NULL, NULL),
(144, 6, '2018-05-03 00:48:57', NULL, NULL),
(145, 6, '2018-05-03 00:48:57', NULL, NULL),
(146, 6, '2018-05-03 00:48:57', NULL, NULL),
(147, 6, '2018-05-03 00:48:57', NULL, NULL),
(148, 6, '2018-05-03 00:48:57', NULL, NULL),
(149, 6, '2018-05-03 00:48:57', NULL, NULL),
(150, 6, '2018-05-03 00:48:57', NULL, NULL),
(151, 6, '2018-05-03 00:48:57', NULL, NULL),
(152, 6, '2018-05-03 00:48:57', NULL, NULL),
(153, 6, '2018-05-03 00:48:57', NULL, NULL),
(154, 6, '2018-05-03 00:48:58', NULL, NULL),
(155, 6, '2018-05-03 00:48:58', NULL, NULL),
(156, 6, '2018-05-03 00:48:58', NULL, NULL),
(157, 6, '2018-05-03 00:48:58', NULL, NULL),
(158, 6, '2018-05-03 00:48:58', NULL, NULL),
(159, 6, '2018-05-03 00:48:58', NULL, NULL),
(160, 6, '2018-05-03 00:48:58', NULL, NULL),
(161, 6, '2018-05-03 00:48:58', NULL, NULL),
(162, 6, '2018-05-03 00:48:58', NULL, NULL),
(163, 6, '2018-05-03 00:48:58', NULL, NULL),
(164, 6, '2018-05-03 00:52:45', NULL, 'st'),
(165, 6, '2018-05-03 00:53:34', NULL, 'ezgtr'),
(166, 6, '2018-05-03 00:56:11', NULL, 'zea'),
(167, 6, '2018-05-03 01:09:17', NULL, 'zef'),
(168, 6, '2018-05-03 01:09:26', NULL, 'cz'),
(169, 6, '2018-05-03 01:23:29', NULL, 'cdsc'),
(170, 6, '2018-05-03 01:26:52', NULL, 'cdsv'),
(171, 6, '2018-05-03 01:27:23', NULL, 'ezfze'),
(172, 6, '2018-05-03 01:29:15', NULL, 'fezf'),
(173, 6, '2018-05-03 01:33:06', NULL, NULL),
(174, 6, '2018-05-03 01:33:36', NULL, NULL),
(175, 6, '2018-05-03 01:34:06', NULL, NULL),
(176, 6, '2018-05-03 01:34:08', NULL, NULL),
(177, 6, '2018-05-03 01:34:11', NULL, 'daz'),
(178, 6, '2018-05-03 01:34:19', NULL, 'daz'),
(179, 6, '2018-05-03 01:34:50', NULL, NULL),
(180, 6, '2018-05-03 01:35:07', NULL, 'faef'),
(181, 6, '2018-05-03 01:35:12', NULL, 'faef'),
(182, 6, '2018-05-03 01:35:21', NULL, 'cqs'),
(183, 6, '2018-05-03 01:35:26', NULL, 'cqs'),
(213, 6, '2018-05-03 11:28:08', NULL, NULL),
(214, 6, '2018-05-03 11:58:58', NULL, NULL),
(215, 6, '2018-05-03 12:05:25', NULL, NULL),
(216, 6, '2018-05-03 12:09:31', NULL, ''),
(217, 6, '2018-05-03 12:10:44', NULL, ''),
(218, 6, '2018-05-03 12:11:04', NULL, ''),
(219, 6, '2018-05-03 12:14:52', NULL, ''),
(220, 6, '2018-05-03 12:16:17', NULL, 'jpg'),
(221, 6, '2018-05-03 12:17:31', 'uploads/user6/post221.jpg', 'test jpg'),
(222, 6, '2018-05-03 12:19:47', NULL, NULL),
(223, 5, '2018-05-03 15:28:54', NULL, 'salut'),
(224, 5, '2018-05-03 15:28:55', NULL, 'ca va'),
(225, 6, '2018-05-03 16:20:03', NULL, 'ca va et toi?'),
(226, 6, '2018-05-03 16:31:44', NULL, 'bien'),
(227, 6, '2018-05-03 16:32:05', NULL, 'bien et toi'),
(228, 6, '2018-05-03 17:41:37', NULL, 'yep'),
(229, 6, '2018-05-03 18:24:31', NULL, 'salut'),
(230, 6, '2018-05-03 18:28:17', NULL, 'salut'),
(231, 6, '2018-05-03 18:31:13', NULL, 'yo'),
(232, 6, '2018-05-03 18:32:51', NULL, 'yo'),
(233, 6, '2018-05-03 18:33:32', NULL, 'yo'),
(234, 6, '2018-05-03 18:34:21', NULL, 'yo'),
(235, 6, '2018-05-03 18:34:29', NULL, 'yo'),
(236, 6, '2018-05-03 20:07:35', NULL, 'yo'),
(237, 6, '2018-05-03 20:08:11', NULL, 'yy'),
(238, 6, '2018-05-03 20:08:39', NULL, 'salut'),
(239, 6, '2018-05-03 20:10:03', NULL, 'yo'),
(240, 6, '2018-05-03 20:12:49', NULL, 'ca va?'),
(241, 6, '2018-05-03 21:31:03', NULL, 'oui et toi?'),
(242, 6, '2018-05-03 23:21:07', NULL, 'Allo?');

-- --------------------------------------------------------

--
-- Structure de la table `reacts`
--

DROP TABLE IF EXISTS `reacts`;
CREATE TABLE IF NOT EXISTS `reacts` (
  `ID_User` int(11) NOT NULL,
  `ID_Object` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_User`,`ID_Object`),
  KEY `ID_Object` (`ID_Object`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `shares`
--

DROP TABLE IF EXISTS `shares`;
CREATE TABLE IF NOT EXISTS `shares` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_User` int(11) NOT NULL,
  `ID_Object` int(11) NOT NULL,
  `Title` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_User` (`ID_User`),
  KEY `ID_Object` (`ID_Object`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(32) NOT NULL,
  `LastName` varchar(32) NOT NULL,
  `FirstName` varchar(32) NOT NULL,
  `Pseudo` varchar(20) DEFAULT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `ProfilePicture` varchar(32) DEFAULT NULL,
  `CoverPicture` varchar(32) DEFAULT NULL,
  `Status` enum('Admin','LambdaUser') NOT NULL DEFAULT 'LambdaUser',
  `Position` enum('Etudiant','Salarié') DEFAULT NULL,
  `CV` varchar(32) DEFAULT NULL,
  `Uptime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID`, `Email`, `LastName`, `FirstName`, `Pseudo`, `PasswordHash`, `ProfilePicture`, `CoverPicture`, `Status`, `Position`, `CV`, `Uptime`, `description`) VALUES
(1, 'fzfzfez', 'zefzefz', 'zefzfzfezef', 'fezf', 'fezfz', NULL, NULL, 'LambdaUser', NULL, NULL, '2018-04-24 06:12:11', NULL),
(2, 'maximemichelpc@gmail.com', 'Maxime', 'Maxime', 'Egglestron', 'maxmic', NULL, NULL, 'LambdaUser', NULL, NULL, '2018-04-24 06:12:11', NULL),
(4, 'sam@bb', 'caddeo', 'sam', 'sami', 'fezef', NULL, NULL, 'LambdaUser', NULL, NULL, '2018-05-01 10:52:50', NULL),
(5, 'maxime.michel@edu.ece.fr', 'MICHEL', 'Maxime', NULL, '$2y$10$COhGj5KWn2sN7MSt3KSJau/uFfwnJTXcYa0BtfP2B0f2DsMKSLBoy', NULL, NULL, 'Admin', NULL, NULL, '2018-05-01 15:45:02', NULL),
(6, 'arthur.prat@edu.ece.fr', 'Prat', 'Arthur', NULL, '$2y$10$TFQEsmB57rkwEquH2lJq4.Ua76h0mLn795osGjbCSE5ap.M/mXJJu', NULL, NULL, 'Admin', NULL, NULL, '2018-05-01 17:14:46', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chatgroups`
--
ALTER TABLE `chatgroups`
  ADD CONSTRAINT `chatgroups_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `chatmessages`
--
ALTER TABLE `chatmessages`
  ADD CONSTRAINT `chatmessages_ibfk_1` FOREIGN KEY (`ID_Conv`) REFERENCES `chatgroups` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `chatmessages_ibfk_2` FOREIGN KEY (`ID_Post`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_IdObject` FOREIGN KEY (`ID_Object`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`ID_Post`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`ID_Object`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `friendships`
--
ALTER TABLE `friendships`
  ADD CONSTRAINT `friendships_ibfk_1` FOREIGN KEY (`ID_User1`) REFERENCES `users` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `friendships_ibfk_2` FOREIGN KEY (`ID_User2`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `joboffers`
--
ALTER TABLE `joboffers`
  ADD CONSTRAINT `joboffers_ibfk_1` FOREIGN KEY (`ID_Object`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `jobreacts`
--
ALTER TABLE `jobreacts`
  ADD CONSTRAINT `jobreacts_ibfk_1` FOREIGN KEY (`ID_Offer`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobreacts_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `jobrequests`
--
ALTER TABLE `jobrequests`
  ADD CONSTRAINT `jobrequests_ibfk_1` FOREIGN KEY (`ID_Object`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `objectposts`
--
ALTER TABLE `objectposts`
  ADD CONSTRAINT `objectposts_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reacts`
--
ALTER TABLE `reacts`
  ADD CONSTRAINT `reacts_ibfk_1` FOREIGN KEY (`ID_Object`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `reacts_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `shares_ibfk_2` FOREIGN KEY (`ID_Object`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
