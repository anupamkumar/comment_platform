-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2014 at 08:56 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comments_platform`
--
CREATE DATABASE IF NOT EXISTS `comments_platform` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `comments_platform`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `ct` varchar(9999) NOT NULL,
  `username` varchar(20) NOT NULL,
  `rid` int(11) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `rid` (`rid`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `ct`, `username`, `rid`) VALUES
(1, '[comment deleted]', 'anupam', 0),
(2, 'comm1', 'anupam', 0),
(3, 'comm2', 'anupam', 0),
(4, 'hello', 'kumar', 2),
(5, 'how', 'anupam', 4),
(6, 'are', 'kumar', 5),
(7, 'you', 'kumar', 2),
(8, '[comment deleted]', 'anupam', 1),
(10, '777', 'anupam', 6),
(15, 'dsalkdj', 'anupam', 2),
(16, 'dsasadsad', 'anupam', 10),
(17, 'sa', 'anupam', 4),
(18, 'dasd', 'anupam', 17),
(19, '44444', 'anupam', 0),
(20, 't1', 'anupam', 19),
(21, 't2', 'anupam', 19),
(22, 't3', 'anupam', 19),
(23, 't4', 'anupam', 19),
(24, 't5', 'anupam', 19);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `name` varchar(20) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `pwd`) VALUES
('anupam', '123'),
('kumar', '123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`name`) REFERENCES `comments` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
