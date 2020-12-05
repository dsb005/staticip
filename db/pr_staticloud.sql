-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `devices`;
CREATE TABLE `devices` (
  `dID` int(11) NOT NULL AUTO_INCREMENT,
  `uID` int(11) NOT NULL,
  `dType` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `dName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`dID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `iplog`;
CREATE TABLE `iplog` (
  `iID` int(11) NOT NULL AUTO_INCREMENT,
  `iIp` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `iPort` int(11) NOT NULL,
  `dID` int(11) NOT NULL,
  `iDate` date NOT NULL,
  PRIMARY KEY (`iID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uID` int(11) NOT NULL AUTO_INCREMENT,
  `uEmail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `uPassword` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- 2020-11-08 22:07:06

