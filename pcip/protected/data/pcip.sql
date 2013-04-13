-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2013 at 04:32 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pcip`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_layer`
--

CREATE TABLE IF NOT EXISTS `tbl_layer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `tag` varchar(128) NOT NULL,
  `desc` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_layer`
--

INSERT INTO `tbl_layer` (`id`, `name`, `tag`, `desc`) VALUES
(1, 'Election2008', 'Candidates', 'asdfsadf'),
(2, 'Elec2013', 'Candidates', ''),
(3, 'Election2008', 'Winner', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `type` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `type`) VALUES
(1, 'haris', 'pass', 'haris.sarwar@gmail.com', ''),
(2, 'admin', 'pass', 'haris.sarwar@gmail.com', 'admin'),
(3, 'demo', 'demo', 'demo@gmail.com', 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_data`
--

CREATE TABLE IF NOT EXISTS `tbl_user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `seat` varchar(32) NOT NULL,
  `layer` varchar(32) NOT NULL,
  `tag` varchar(128) NOT NULL,
  `value` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `tbl_user_data`
--

INSERT INTO `tbl_user_data` (`id`, `user_id`, `seat`, `layer`, `tag`, `value`) VALUES
(1, 1, 'na1', 'Election2008', 'Candidates', 'first value entered'),
(2, 1, 'na240', 'Election2008', 'Candidates', 'shebaz sharif'),
(27, 1, 'na242', 'Election2008', 'Candidates', 'g'),
(4, 1, 'na256', 'Elec2013', 'Candidates', 'imran khan'),
(5, 1, 'na256', 'Elec2013', 'Candidates', 'test1'),
(6, 1, 'na250', 'Elec2013', 'Candidates', 'asfsads'),
(25, 1, 'na242', 'Election2008', 'Candidates', 'd'),
(26, 1, 'na242', 'Election2008', 'Candidates', 'e'),
(10, 1, 'na255', 'Elec2013', 'Candidates', '222'),
(11, 1, 'na255', 'Elec2013', 'Candidates', '333'),
(12, 1, 'na255', 'Elec2013', 'Candidates', '555'),
(13, 1, 'na255', 'Elec2013', 'Candidates', '888'),
(23, 1, 'na242', 'Election2008', 'Candidates', 'a'),
(15, 1, 'na255', 'Elec2013', 'Candidates', '9999'),
(24, 1, 'na242', 'Election2008', 'Candidates', 's'),
(17, 1, 'na255', 'Elec2013', 'Candidates', 'qwerqwe'),
(22, 1, 'na247', 'Elec2013', 'Candidates', 'sssss'),
(21, 1, 'na247', 'Elec2013', 'Candidates', 'asdfasd'),
(20, 1, 'na255', 'Elec2013', 'Candidates', 'ghjkghjk'),
(28, 1, 'na242', 'Election2008', 'Candidates', 'w'),
(29, 1, 'na242', 'Election2008', 'Candidates', 'q'),
(30, 1, 'na242', 'Election2008', 'Candidates', 'g'),
(31, 1, 'na242', 'Election2008', 'Candidates', 'qqqq'),
(32, 1, 'na242', 'Election2008', 'Candidates', 'xcv'),
(33, 1, 'na242', 'Election2008', 'Candidates', '2323'),
(34, 1, 'na242', 'Election2008', 'Candidates', '56756'),
(35, 1, 'na242', 'Election2008', 'Candidates', 'zxcv'),
(36, 1, 'na242', 'Election2008', 'Candidates', 'vbnmvb'),
(37, 1, 'na242', 'Election2008', 'Candidates', 'dfgh'),
(39, 1, 'na252', 'Elec2013', 'Candidates', 'ddddd');
