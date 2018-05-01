-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 01, 2018 at 01:55 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialmedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `ID_Object` int(11) NOT NULL,
  `ID_Post` int(11) NOT NULL,
  PRIMARY KEY (`ID_Object`),
  KEY `ID_Post` (`ID_Post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID_Object`, `ID_Post`) VALUES
(13, 3),
(24, 8),
(25, 8),
(23, 12);

-- --------------------------------------------------------

--
-- Table structure for table `events`
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
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID_Object`, `Date`, `Location`, `Status`) VALUES
(2, NULL, 'beaugrenelle', 'Private'),
(20, NULL, 'boulbi', 'Public'),
(21, '2018-05-03', NULL, 'Public'),
(26, NULL, NULL, 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
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
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`ID_User1`, `ID_User2`, `Status`, `Relationship`) VALUES
(1, 2, 'Accepted', 'Pro'),
(1, 4, 'Waiting', 'Friend'),
(2, 1, 'Request sent', 'Friend'),
(2, 4, 'Accepted', 'Pro'),
(4, 1, 'Accepted', 'Friend'),
(4, 2, 'Accepted', 'Friend');

-- --------------------------------------------------------

--
-- Table structure for table `joboffers`
--

DROP TABLE IF EXISTS `joboffers`;
CREATE TABLE IF NOT EXISTS `joboffers` (
  `ID_Object` int(11) NOT NULL,
  `JobLocation` varchar(32) NOT NULL,
  `Company` varchar(32) NOT NULL,
  `Title` varchar(240) NOT NULL,
  `JobDescription` text,
  `Length` decimal(4,1) DEFAULT '0.0',
  `Skills` text,
  `Area` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID_Object`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobreacts`
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
-- Table structure for table `jobrequests`
--

DROP TABLE IF EXISTS `jobrequests`;
CREATE TABLE IF NOT EXISTS `jobrequests` (
  `ID_Object` int(11) NOT NULL,
  `Length` decimal(4,1) DEFAULT '0.0' COMMENT 'en mois',
  `Area` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID_Object`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobrequests`
--

INSERT INTO `jobrequests` (`ID_Object`, `Length`, `Area`) VALUES
(21, '6.4', 'commerce');

-- --------------------------------------------------------

--
-- Table structure for table `objectposts`
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `objectposts`
--

INSERT INTO `objectposts` (`ID`, `ID_User`, `Date_Post`, `Url_Media`, `Description`) VALUES
(2, 2, '2018-04-11 05:09:08', NULL, 'je suis pd'),
(3, 1, '2018-04-18 04:00:00', NULL, 'je savais que t\'etais pd'),
(4, 2, '2018-04-04 00:00:00', NULL, NULL),
(5, 1, '2018-04-27 00:00:00', NULL, NULL),
(6, 2, '2018-04-04 00:00:00', NULL, NULL),
(7, 2, '2018-04-04 00:00:00', NULL, NULL),
(8, 2, '2018-04-04 00:00:00', NULL, NULL),
(9, 2, '2018-04-04 00:00:00', NULL, NULL),
(10, 2, '2018-04-04 00:00:00', NULL, NULL),
(11, 2, '2018-04-04 00:00:00', NULL, NULL),
(12, 2, '2018-04-04 00:00:00', NULL, NULL),
(13, 2, '2018-04-04 00:00:00', NULL, NULL),
(20, 1, '2022-04-04 00:00:00', NULL, 'salut'),
(21, 1, '2022-04-04 00:00:00', NULL, 'salut'),
(22, 1, '2022-04-04 00:00:00', NULL, 'salut'),
(23, 1, '2022-04-04 00:00:00', NULL, 'salut'),
(24, 1, '2025-04-04 00:00:00', NULL, 'salut'),
(25, 1, '2025-04-04 00:00:00', NULL, 'salut'),
(26, 4, '2018-05-01 11:04:08', NULL, 'yo bb');

-- --------------------------------------------------------

--
-- Table structure for table `reacts`
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
-- Table structure for table `shares`
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
-- Table structure for table `users`
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
  `Status` enum('Admin','LambdaUser') NOT NULL,
  `Position` enum('Etudiant','Salarié') DEFAULT NULL,
  `CV` varchar(32) DEFAULT NULL,
  `Uptime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Email`, `LastName`, `FirstName`, `Pseudo`, `PasswordHash`, `ProfilePicture`, `CoverPicture`, `Status`, `Position`, `CV`, `Uptime`, `description`) VALUES
(1, 'fzfzfez', 'zefzefz', 'zefzfzfezef', 'fezf', 'fezfz', NULL, NULL, 'LambdaUser', NULL, NULL, '2018-04-24 06:12:11', NULL),
(2, 'maximemichelpc@gmail.com', 'Maxime', 'Maxime', 'Egglestron', 'maxmic', NULL, NULL, 'LambdaUser', NULL, NULL, '2018-04-24 06:12:11', NULL),
(4, 'sam@bb', 'caddeo', 'sam', 'sami', 'fezef', NULL, NULL, 'LambdaUser', NULL, NULL, '2018-05-01 10:52:50', NULL),
(5, 'maxime.michel@edu.ece.fr', 'MICHEL', 'Maxime', NULL, '$2y$10$COhGj5KWn2sN7MSt3KSJau/uFfwnJTXcYa0BtfP2B0f2DsMKSLBoy', NULL, NULL, 'Admin', NULL, NULL, '2018-05-01 15:45:02', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_IdObject` FOREIGN KEY (`ID_Object`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`ID_Post`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`ID_Object`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `friendships`
--
ALTER TABLE `friendships`
  ADD CONSTRAINT `friendships_ibfk_1` FOREIGN KEY (`ID_User1`) REFERENCES `users` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `friendships_ibfk_2` FOREIGN KEY (`ID_User2`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `joboffers`
--
ALTER TABLE `joboffers`
  ADD CONSTRAINT `joboffers_ibfk_1` FOREIGN KEY (`ID_Object`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `jobreacts`
--
ALTER TABLE `jobreacts`
  ADD CONSTRAINT `jobreacts_ibfk_1` FOREIGN KEY (`ID_Offer`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobreacts_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `jobrequests`
--
ALTER TABLE `jobrequests`
  ADD CONSTRAINT `jobrequests_ibfk_1` FOREIGN KEY (`ID_Object`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `objectposts`
--
ALTER TABLE `objectposts`
  ADD CONSTRAINT `objectposts_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `reacts`
--
ALTER TABLE `reacts`
  ADD CONSTRAINT `reacts_ibfk_1` FOREIGN KEY (`ID_Object`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `reacts_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `shares_ibfk_2` FOREIGN KEY (`ID_Object`) REFERENCES `objectposts` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
