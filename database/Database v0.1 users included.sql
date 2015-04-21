-- --------------------------------------------------------
-- Host:                         localhost
-- Server versie:                5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Versie:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Databasestructuur van codesnippet wordt geschreven
CREATE DATABASE IF NOT EXISTS `codesnippet` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `codesnippet`;


-- Structuur van  tabel codesnippet.comment wordt geschreven
CREATE TABLE IF NOT EXISTS `comment` (
  `Comment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Snippet_ID` int(11) NOT NULL DEFAULT '0',
  `Comment_top_ID` int(11) DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Comment_text` text,
  `Comment_date` date DEFAULT NULL,
  PRIMARY KEY (`Comment_ID`),
  KEY `to user comment` (`User_ID`),
  CONSTRAINT `to user comment` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel codesnippet.comment: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


-- Structuur van  tabel codesnippet.framework wordt geschreven
CREATE TABLE IF NOT EXISTS `framework` (
  `Framework_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lang_ID` int(11) NOT NULL,
  `Framework_name` text NOT NULL,
  PRIMARY KEY (`Framework_ID`),
  UNIQUE KEY `Framework_ID_Lang_ID` (`Framework_ID`,`Lang_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel codesnippet.framework: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `framework` DISABLE KEYS */;
/*!40000 ALTER TABLE `framework` ENABLE KEYS */;


-- Structuur van  tabel codesnippet.prog_lang wordt geschreven
CREATE TABLE IF NOT EXISTS `prog_lang` (
  `language_ID` int(11) NOT NULL AUTO_INCREMENT,
  `language_name` text NOT NULL,
  PRIMARY KEY (`language_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel codesnippet.prog_lang: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `prog_lang` DISABLE KEYS */;
/*!40000 ALTER TABLE `prog_lang` ENABLE KEYS */;


-- Structuur van  tabel codesnippet.snippet wordt geschreven
CREATE TABLE IF NOT EXISTS `snippet` (
  `Snippet_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Snippet_title` longtext NOT NULL,
  `Snippet_code` longtext NOT NULL,
  `Snippet_description` longtext NOT NULL,
  `Snippet_lang` int(11) NOT NULL,
  `Snippet_framework` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Snippet_date` date NOT NULL,
  `Snippet_change_date` date NOT NULL,
  `Snippet_views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Snippet_ID`),
  KEY `to user snippet` (`User_ID`),
  KEY `to language` (`Snippet_lang`),
  KEY `to framework` (`Snippet_framework`),
  CONSTRAINT `to framework` FOREIGN KEY (`Snippet_framework`) REFERENCES `framework` (`Framework_ID`),
  CONSTRAINT `to language` FOREIGN KEY (`Snippet_lang`) REFERENCES `prog_lang` (`language_ID`),
  CONSTRAINT `to user snippet` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel codesnippet.snippet: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `snippet` DISABLE KEYS */;
/*!40000 ALTER TABLE `snippet` ENABLE KEYS */;


-- Structuur van  tabel codesnippet.user wordt geschreven
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Kolom 2` int(11) NOT NULL DEFAULT '0',
  `Register_date` date NOT NULL DEFAULT '0000-00-00',
  `Last_online` date DEFAULT '0000-00-00',
  `First_name` varchar(50) NOT NULL,
  `Last_name` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Birthday` date DEFAULT NULL,
  `Profession` varchar(50) DEFAULT NULL,
  `Profile_picture` blob,
  `Votes` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Username_Email` (`Username`,`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel codesnippet.user: ~4 rows (ongeveer)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`ID`, `Kolom 2`, `Register_date`, `Last_online`, `First_name`, `Last_name`, `Username`, `Password`, `Email`, `Birthday`, `Profession`, `Profile_picture`, `Votes`) VALUES
	(1, 0, '2015-04-21', '0000-00-00', 'Henri', 'Arends', 'FalingDutchman', 'Welkom01', 'henri.arends@student.stenden.com', '1992-07-13', 'Student/Programmer', NULL, NULL),
	(2, 0, '2015-05-21', '0000-00-00', 'Leroy', 'Rocks', 'Lery', 'Welkom01', 'leroy.rocks@student.stenden.com', '1991-10-10', 'Student/Programmer', NULL, NULL),
	(3, 0, '2015-04-21', '0000-00-00', 'Roseline', 'Bruins', 'RoosB', 'Welkom01', 'roseline.bruins@student.stenden.com', '1989-07-23', 'Student/Programmer', NULL, NULL),
	(4, 0, '0000-00-00', '0000-00-00', 'Danny', 'van der Jagt', 'Danny', 'Welkom01', 'danny.van.der.jagt@student.stenden.com', '1993-03-15', 'Student/Programmer', NULL, NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Structuur van  tabel codesnippet.vote_comment wordt geschreven
CREATE TABLE IF NOT EXISTS `vote_comment` (
  `Vote_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Vote_user_ID` int(11) NOT NULL,
  `Comment_ID` int(11) NOT NULL,
  `Vote_type` binary(1) NOT NULL,
  PRIMARY KEY (`Vote_ID`),
  UNIQUE KEY `User_ID_Comment_ID` (`User_ID`,`Comment_ID`,`Vote_user_ID`),
  KEY `vote comment to user vote` (`Vote_user_ID`),
  KEY `vote comment to comment` (`Comment_ID`),
  CONSTRAINT `vote comment to comment` FOREIGN KEY (`Comment_ID`) REFERENCES `comment` (`Comment_ID`),
  CONSTRAINT `vote comment to user receiver` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`),
  CONSTRAINT `vote comment to user vote` FOREIGN KEY (`Vote_user_ID`) REFERENCES `user` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel codesnippet.vote_comment: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `vote_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `vote_comment` ENABLE KEYS */;


-- Structuur van  tabel codesnippet.vote_snippet wordt geschreven
CREATE TABLE IF NOT EXISTS `vote_snippet` (
  `Vote_ID` int(11) NOT NULL,
  `Vote_user_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Vote_type` binary(1) NOT NULL,
  `Snippet_ID` int(11) NOT NULL,
  PRIMARY KEY (`Vote_ID`),
  UNIQUE KEY `User_ID_Snippet_ID` (`User_ID`,`Snippet_ID`,`Vote_user_ID`),
  KEY `to user vote snippet` (`Vote_user_ID`),
  KEY `to snippet vote` (`Snippet_ID`),
  CONSTRAINT `to snippet vote` FOREIGN KEY (`Snippet_ID`) REFERENCES `snippet` (`Snippet_ID`),
  CONSTRAINT `to user receiver snippet` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`),
  CONSTRAINT `to user vote snippet` FOREIGN KEY (`Vote_user_ID`) REFERENCES `user` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel codesnippet.vote_snippet: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `vote_snippet` DISABLE KEYS */;
/*!40000 ALTER TABLE `vote_snippet` ENABLE KEYS */;


-- Structuur van  tabel codesnippet.vote_user wordt geschreven
CREATE TABLE IF NOT EXISTS `vote_user` (
  `User_ID` int(11) NOT NULL,
  `Vote_user_ID` int(11) NOT NULL,
  `Vote_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vote_type` binary(1) NOT NULL,
  PRIMARY KEY (`Vote_ID`),
  UNIQUE KEY `User_ID_Vote_user_ID` (`User_ID`,`Vote_user_ID`),
  KEY `to user vote user` (`Vote_user_ID`),
  CONSTRAINT `to user receiver user` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`),
  CONSTRAINT `to user vote user` FOREIGN KEY (`Vote_user_ID`) REFERENCES `user` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User_ID = The user that is being voted on\r\nVote_user_ID = The user that votes\r\nVote_ID = The ID of the vote';

-- Dumpen data van tabel codesnippet.vote_user: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `vote_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `vote_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
