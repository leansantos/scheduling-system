-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2015 at 04:21 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `scheduling_system`
--
CREATE DATABASE IF NOT EXISTS `scheduling_system` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `scheduling_system`;

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `block_id` int(8) NOT NULL AUTO_INCREMENT,
  `block_name` varchar(50) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`block_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`block_id`, `block_name`, `time_created`) VALUES
(1, 'BSIT-1', '2014-12-30 15:54:59'),
(2, 'BSIT-2', '2014-12-30 15:54:59'),
(3, 'BSIT-3', '2014-12-30 15:55:35'),
(4, 'BSIT-4', '2014-12-30 15:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
  `instructor_id` int(8) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(25) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `subj_taken` text NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`instructor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructor_id`, `fname`, `mname`, `lname`, `department`, `subj_taken`, `time_created`) VALUES
(4, 'Maynardo', 'S', 'De Ruedo', 'CBA', '', '2014-12-26 15:46:31'),
(12, 'Ron', 'D', 'Vistan', 'CITE', 'EN 1', '2015-01-22 17:38:21'),
(13, 'Jasper Clark', 'G', 'Rueca', 'CITE', '', '2015-01-29 17:55:20'),
(14, 'Lester Anthony', 'E', 'Santos', 'CBA', '', '2015-02-01 16:21:31'),
(15, 'Berting', 'X', 'Turling', 'CHM', '', '2015-02-02 18:11:23'),
(16, 'ddd', 's', 'ddd', 'CAMS', '', '2015-02-02 18:29:17'),
(17, 'Ramil', 'Q', 'Roxas', 'CITE', 'IT 1 / IT 2', '2015-02-05 16:01:36'),
(18, 'chm', 'c', 'CHM', 'CHM', '', '2015-02-08 04:44:39'),
(19, 'cams', 'c', 'CAMS', 'CAMS', '', '2015-02-09 08:55:12'),
(20, 'CO', 'C', 'COED', 'CoEd', '', '2015-02-14 15:03:26'),
(21, 'ssssssssssss', 'w', 'aaaaaaaaaa', 'CITE', 'MA 1 / MA 5', '2015-02-26 15:20:57'),
(22, 'dgggg', 'r', 'ggggg', 'CoEd', 'v', '2015-02-27 06:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(8) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(50) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `campus` varchar(50) NOT NULL,
  `building` varchar(50) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `room_type`, `campus`, `building`, `time_created`) VALUES
(3, 'MC 201', 'Lecture', 'Barasoain Campus', 'Barasoain Building', '2015-01-22 16:32:48'),
(4, 'MC 101', 'Lecture', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:20:12'),
(6, 'MC 202', 'Lecture', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:21:06'),
(7, 'MC 202(A)', 'Lecture', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:22:11'),
(8, 'MC 202(B)', 'Lecture', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:22:28'),
(9, 'MC 205', 'Lecture', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:22:51'),
(10, 'MC 206', 'Lecture', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:23:04'),
(11, 'MC 201', 'Lecture', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:23:29'),
(12, 'MC 208', 'Lecture', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:23:41'),
(13, 'SH 112', 'Lecture', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:24:09'),
(14, 'Phy Lab', 'Laboratory', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:25:02'),
(15, 'SJ 201', 'Lecture', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:25:18'),
(16, 'COMP LAB1', 'Laboratory', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:25:54'),
(17, 'COMP LAB2', 'Laboratory', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:26:08'),
(18, 'ENGR LAB', 'Laboratory', 'Barasoain Campus', 'Barasoain Building', '2015-01-25 18:26:34'),
(19, 'MR 201', 'Lecture', 'Catmon Campus', 'HRM/ Mo. Rita/ Sto. Nino Building', '2015-01-25 18:27:45'),
(20, 'MR 202', 'Lecture', 'Catmon Campus', 'HRM/ Mo. Rita/ Sto. Nino Building', '2015-01-25 18:28:22'),
(22, 'MICRO LAB', 'Laboratory', 'Catmon Campus', 'HRM/ Mo. Rita/ Sto. Nino Building', '2015-01-25 18:29:11'),
(23, 'HRM LAB1', 'Laboratory', 'Catmon Campus', 'HRM/ Mo. Rita/ Sto. Nino Building', '2015-01-25 18:29:39'),
(24, 'HRM LAB2', 'Laboratory', 'Catmon Campus', 'HRM/ Mo. Rita/ Sto. Nino Building', '2015-01-25 18:29:55'),
(25, 'C-301', 'Lecture', 'Catmon Campus', 'Admin Building', '2015-01-25 18:31:18'),
(26, 'CC LAB BED', 'Laboratory', 'Catmon Campus', 'Admin Building', '2015-01-25 18:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `subj_no` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `subjects` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  `professor` varchar(50) NOT NULL,
  `days` varchar(50) NOT NULL,
  `optional_day` varchar(50) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `units` int(11) NOT NULL,
  `hours` int(8) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `course` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `start_year` year(4) NOT NULL,
  `end_year` year(4) NOT NULL,
  PRIMARY KEY (`subj_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`subj_no`, `subjects`, `room`, `professor`, `days`, `optional_day`, `time_start`, `time_end`, `units`, `hours`, `time_created`, `course`, `semester`, `start_year`, `end_year`) VALUES
(0001, '1', '', '', 'MON', 'THUR', '07:30:00', '09:00:00', 3, 3, '2015-02-23 16:21:09', 'BSIT-1', '1st semester', 2015, 2016),
(0002, '10', '4', '12', 'MON', 'THUR', '07:30:00', '09:00:00', 3, 5, '2015-02-23 16:21:46', 'BSIT-2', '1st semester', 2015, 2016),
(0003, '4', '', '', 'MON', 'SAT', '07:30:00', '09:00:00', 3, 3, '2015-02-23 16:22:34', 'BSIT-4', '1st semester', 2015, 2016),
(0004, '8', '', '', 'MON', 'THUR', '07:30:00', '09:00:00', 3, 5, '2015-02-27 06:36:06', 'BSE-1', '1st semester', 2015, 2016),
(0005, '4', '', '', 'MON', 'THUR', '09:15:00', '10:45:00', 3, 3, '2015-02-27 16:00:20', 'BSIT-1', '1st semester', 2015, 2016),
(0006, '12', '3', '4', 'MON', 'THUR', '07:30:00', '09:00:00', 3, 3, '2015-03-02 07:12:10', 'BSAcT-1', '1st semester', 2015, 2016),
(0007, '1', '', '4', 'MON', 'THUR', '09:15:00', '11:15:00', 3, 3, '2015-03-02 07:13:51', 'BSAcT-1', '1st semester', 2015, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(8) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(25) NOT NULL,
  `descriptive_title` varchar(150) NOT NULL,
  `lecture_unit` int(2) NOT NULL,
  `laboratory_unit` int(2) NOT NULL,
  `total_unit` int(2) NOT NULL,
  `pre_req` varchar(25) NOT NULL,
  `total_hours` int(5) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `course_code`, `descriptive_title`, `lecture_unit`, `laboratory_unit`, `total_unit`, `pre_req`, `total_hours`, `time_created`) VALUES
(1, 'IS 1', 'Fundamentals of System/Information Management', 3, 0, 3, 'none', 3, '2015-01-17 16:47:34'),
(4, 'MA 5', 'Trigonometry', 3, 0, 3, 'MA 1', 3, '2015-01-17 17:45:53'),
(5, 'PHY 1', 'College Physics', 3, 1, 4, 'MA 1/MA 5', 6, '2015-01-17 17:47:50'),
(8, 'IS 2', 'Fundamentals of Programming, Data, File and Object Structures', 2, 1, 3, 'none', 5, '2015-01-17 18:04:53'),
(10, 'IS 3', 'Personal Productivity using IS', 2, 1, 3, 'none', 5, '2015-01-17 18:31:33'),
(11, 'TH 2', 'Christology', 3, 0, 3, 'none', 3, '2015-01-17 19:14:14'),
(12, 'ACCT 2', 'Accounting and Financials 2', 3, 0, 3, 'ACCT 1', 3, '2015-01-17 19:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `type`, `description`) VALUES
(1, 'admin', 'admin', 'admin', 'Administrator'),
(2, 'cite', 'cite123', 'cite', 'College of Information Technology and Engineering'),
(3, 'cba', 'cba123', 'cba', 'College of Business Administration'),
(4, 'registrar', 'reg123', 'registrar', 'Registrar Department'),
(5, 'chm', 'chm123', 'chm', 'College of Hospitality Management'),
(6, 'cla', 'cla123', 'cla', 'College of Liberal Arts'),
(7, 'coed', 'coed123', 'coed', 'College of Education'),
(8, 'cams', 'cams123', 'cams', 'College of Allied Medical Sciences'),
(13, 'lestersantos13', '123456', 'admin', 'sdfsdfdsfdfdfdfdfdf');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
