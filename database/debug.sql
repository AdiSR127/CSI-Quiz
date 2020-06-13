-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2020 at 07:10 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `debug`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `last_login`) VALUES
(1, 'adi', 'singh', '2020-04-29 21:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
`id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `correct` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `quiz_id`, `question_id`, `answer`, `correct`) VALUES
(1, 1, 1, 'A', '0'),
(2, 1, 1, 'F', '0'),
(3, 1, 1, 'L', '1'),
(4, 1, 1, 'Q', '0'),
(5, 1, 2, 'L', '1'),
(6, 1, 2, 'Q', '0'),
(7, 1, 2, 'G', '0'),
(8, 1, 2, 'H', '0'),
(9, 1, 3, 'g', '0'),
(10, 1, 3, 'a', '1'),
(11, 1, 3, 'l', '0'),
(12, 1, 3, 'c', '0');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE IF NOT EXISTS `participants` (
`id` int(250) NOT NULL,
  `username` varchar(400) DEFAULT NULL,
  `quiz_id` int(250) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `username`, `quiz_id`) VALUES
(1, 'adi', 1),
(2, 'ad3', 1),
(3, 'ad', 1),
(5, 'aditya', 1),
(6, 'saurabh', 1),
(7, 'adi1', 1),
(8, 'asp', 1),
(9, 'chinmay', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
`id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `code` varchar(9999) NOT NULL,
  `code_type` varchar(30) NOT NULL,
  `type` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_id`, `question`, `code`, `code_type`, `type`) VALUES
(1, 1, 1, 'HTM_?', '', '', 'mc'),
(2, 1, 2, 'SQ_?', '', '', 'mc'),
(3, 1, 3, 'dat_?', '', '', 'mc');

-- --------------------------------------------------------

--
-- Table structure for table `quizes`
--

CREATE TABLE IF NOT EXISTS `quizes` (
`id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(50) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `display_questions` int(11) NOT NULL,
  `time_allotted` int(11) NOT NULL,
  `set_default` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizes`
--

INSERT INTO `quizes` (`id`, `quiz_id`, `quiz_name`, `total_questions`, `display_questions`, `time_allotted`, `set_default`) VALUES
(1, 1, 'Recuriment Drive', 3, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_takers`
--

CREATE TABLE IF NOT EXISTS `quiz_takers` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `percentage` varchar(24) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `duration` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_takers`
--

INSERT INTO `quiz_takers` (`id`, `username`, `quiz_id`, `marks`, `percentage`, `date_time`, `duration`) VALUES
(1, 'adi', 1, 0, '0', '2020-04-29 21:03:03', 118),
(2, 'adi1', 1, 1, '33.333333333333', '2020-04-29 21:11:14', 25),
(3, 'asp', 1, 0, '0', '2020-04-29 21:24:13', 0),
(4, 'aditya', 1, 0, '0', '2020-04-29 21:32:41', 0),
(5, 'chinmay', 1, 3, '100', '2020-04-29 21:48:24', 428),
(6, 'ad3', 1, 1, '33.333333333333', '2020-04-29 22:03:44', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizes`
--
ALTER TABLE `quizes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_takers`
--
ALTER TABLE `quiz_takers`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
MODIFY `id` int(250) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `quizes`
--
ALTER TABLE `quizes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `quiz_takers`
--
ALTER TABLE `quiz_takers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
