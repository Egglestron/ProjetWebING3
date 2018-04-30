-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 30 avr. 2018 à 19:01
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

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
(23, 12);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `ID_Object` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Location` varchar(32) DEFAULT NULL,
  `Status` enum('Public','Private') NOT NULL,
  PRIMARY KEY (`ID_Object`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`ID_Object`, `Date`, `Location`, `Status`) VALUES
(2, NULL, 'beaugrenelle', 'Private');

-- --------------------------------------------------------

--
-- Structure de la table `friendships`
--

DROP TABLE IF EXISTS `friendships`;
CREATE TABLE IF NOT EXISTS `friendships` (
  `ID_User1` int(11) NOT NULL,
  `ID_User2` int(11) NOT NULL,
  `Status` enum('Amis','En attente','Demande Envoyée') NOT NULL,
  PRIMARY KEY (`ID_User1`,`ID_User2`),
  KEY `ID_User2` (`ID_User2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `friendships`
--

INSERT INTO `friendships` (`ID_User1`, `ID_User2`, `Status`) VALUES
(1, 2, 'Amis');

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
  `JobDetails` text,
  `Skills` text,
  PRIMARY KEY (`ID_Object`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Structure de la table `objectposts`
--

DROP TABLE IF EXISTS `objectposts`;
CREATE TABLE IF NOT EXISTS `objectposts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_User` int(11) NOT NULL,
  `Date_Post` datetime NOT NULL,
  `Url_Media` varchar(32) DEFAULT NULL,
  `Description` text,
  PRIMARY KEY (`ID`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `objectposts`
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
(25, 1, '2025-04-04 00:00:00', NULL, 'salut');

-- --------------------------------------------------------

--
-- Structure de la table `reacts`
--

DROP TABLE IF EXISTS `reacts`;
CREATE TABLE IF NOT EXISTS `reacts` (
  `ID_User` int(11) NOT NULL,
  `ID_Object` int(11) NOT NULL,
  `Date` datetime NOT NULL,
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
  `Pseudo` varchar(8) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `ProfilePicture` varchar(32) DEFAULT NULL,
  `CoverPicture` varchar(32) DEFAULT NULL,
  `Status` enum('Admin','LambdaUser') NOT NULL,
  `Position` enum('Etudiant','Salarié') DEFAULT NULL,
  `CV` varchar(32) DEFAULT NULL,
  `Uptime` datetime NOT NULL,
  `description` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID`, `Email`, `LastName`, `FirstName`, `Pseudo`, `Password`, `ProfilePicture`, `CoverPicture`, `Status`, `Position`, `CV`, `Uptime`, `description`) VALUES
(1, 'fzfzfez', 'zefzefz', 'zefzfzfezef', 'fezf', 'fezfz', NULL, NULL, 'LambdaUser', NULL, NULL, '2018-04-24 06:12:11', NULL),
(2, 'maximePD', 'zefzefz', 'zefzfzfezef', 'fezf', 'fezfz', NULL, NULL, 'LambdaUser', NULL, NULL, '2018-04-24 06:12:11', NULL);

--
-- Contraintes pour les tables déchargées
--

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
