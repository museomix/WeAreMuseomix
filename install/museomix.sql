-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 24 Octobre 2013 à 11:08
-- Version du serveur: 5.5.31
-- Version de PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `museomix`
--

-- --------------------------------------------------------

--
-- Structure de la table `mm_events`
--

CREATE TABLE IF NOT EXISTS `mm_events` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `event_localisation` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `event_year` year(4) DEFAULT NULL,
  `event_comment` text CHARACTER SET latin1,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `mm_participations`
--

CREATE TABLE IF NOT EXISTS `mm_participations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Structure de la table `mm_users`
--

CREATE TABLE IF NOT EXISTS `mm_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `user_url` varchar(255) DEFAULT NULL,
  `user_registered` int(11) DEFAULT NULL,
  `user_activation_key` varchar(255) DEFAULT NULL,
  `user_status` varchar(255) DEFAULT NULL,
  `user_twitteraccount` varchar(255) DEFAULT NULL,
  `user_presentation` text,
  `user_startpart` varchar(50) DEFAULT NULL,
  `user_participation` text,
  `user_image` varchar(255) DEFAULT NULL,
  `user_image_template` varchar(255) DEFAULT NULL,
  `user_lang` int(10) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
