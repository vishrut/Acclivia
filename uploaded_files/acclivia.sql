-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2013 at 08:06 PM
-- Server version: 5.5.27
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `acclivia`
--

-- --------------------------------------------------------

--
-- Table structure for table `belongs_to`
--

CREATE TABLE IF NOT EXISTS `belongs_to` (
  `user_id` int(100) NOT NULL,
  `grp_id` int(100) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`grp_id`),
  KEY `user_id` (`user_id`,`grp_id`),
  KEY `grp_id` (`grp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `belongs_to`
--

INSERT INTO `belongs_to` (`user_id`, `grp_id`, `date_added`, `role`) VALUES
(1, 5, '2013-04-12 22:13:51', '0'),
(1, 6, '2013-04-12 22:04:20', '2'),
(17, 5, '2013-04-12 21:57:31', '2'),
(17, 6, '2013-04-13 00:58:25', '0');

-- --------------------------------------------------------

--
-- Table structure for table `chatbox`
--

CREATE TABLE IF NOT EXISTS `chatbox` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `grp_id` int(11) NOT NULL,
  `meeting_id` int(100) NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chat_message` varchar(1000) NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `sender_id` (`sender_id`),
  KEY `grp_id` (`grp_id`),
  KEY `meeting_id` (`meeting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `chatbox`
--

INSERT INTO `chatbox` (`c_id`, `sender_id`, `grp_id`, `meeting_id`, `send_time`, `chat_message`) VALUES
(1, 17, 5, 2, '2013-04-12 22:25:02', 'hi'),
(2, 17, 5, 2, '2013-04-12 22:35:18', 'evry1 here?'),
(3, 1, 5, 2, '2013-04-12 22:35:34', 'yeah'),
(4, 1, 5, 2, '2013-04-12 22:36:20', 'hi'),
(5, 1, 5, 2, '2013-04-12 22:36:21', ''),
(6, 1, 5, 2, '2013-04-12 22:36:22', ''),
(7, 1, 5, 2, '2013-04-12 22:36:22', '');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(100) NOT NULL AUTO_INCREMENT,
  `owner_id` int(100) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `grp_id` int(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pinned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_id`),
  KEY `grp_id` (`grp_id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `owner_id`, `filename`, `grp_id`, `created_on`, `pinned`) VALUES
(1, 17, 'acclivia_latest.sql', 5, '2013-04-12 22:19:00', 0),
(2, 1, 'Work Distribution.xlsx', 6, '2013-04-13 00:51:10', 0),
(3, 1, 'DD modifications.txt', 6, '2013-04-13 00:54:51', 0),
(4, 1, 'DD modifications.txt', 6, '2013-04-13 00:54:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `grp_id` int(10) NOT NULL AUTO_INCREMENT,
  `grp_name` varchar(50) NOT NULL,
  `date_of_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`grp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`grp_id`, `grp_name`, `date_of_creation`, `description`) VALUES
(5, ' Vshrus Group 1', '0000-00-00 00:00:00', ' This is my first group'),
(6, 'manyus grp', '0000-00-00 00:00:00', 'manyus grp');

-- --------------------------------------------------------

--
-- Table structure for table `group_task`
--

CREATE TABLE IF NOT EXISTS `group_task` (
  `task_id` int(100) NOT NULL AUTO_INCREMENT,
  `grp_id` int(100) NOT NULL,
  `finish_status` int(11) NOT NULL DEFAULT '0',
  `task_name` varchar(50) NOT NULL,
  `task_description` varchar(500) DEFAULT NULL,
  `task_start_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `task_end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `task_deadline` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`task_id`),
  KEY `grp_id` (`grp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `group_task`
--

INSERT INTO `group_task` (`task_id`, `grp_id`, `finish_status`, `task_name`, `task_description`, `task_start_date`, `task_end_date`, `task_deadline`) VALUES
(16, 6, 0, 'mt1', 'mt1', '2013-04-04 01:00:00', '0000-00-00 00:00:00', '2013-03-26 01:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `livefiles`
--

CREATE TABLE IF NOT EXISTS `livefiles` (
  `livefile_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `filename` varchar(1000) NOT NULL,
  `random_key` varchar(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`livefile_id`),
  KEY `group_id` (`group_id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `livefiles`
--

INSERT INTO `livefiles` (`livefile_id`, `group_id`, `filename`, `random_key`, `owner_id`, `create_date`) VALUES
(15, 5, 'livfile 1', 'trruk9coc', 17, '2013-04-12 22:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE IF NOT EXISTS `meeting` (
  `meeting_id` int(100) NOT NULL AUTO_INCREMENT,
  `grp_id` int(100) NOT NULL,
  `caller_id` int(100) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `agenda` text NOT NULL,
  PRIMARY KEY (`meeting_id`),
  KEY `grp_id` (`grp_id`),
  KEY `caller_id` (`caller_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`meeting_id`, `grp_id`, `caller_id`, `start_time`, `end_time`, `agenda`) VALUES
(2, 5, 17, '2012-12-12 00:00:00', '2013-04-12 22:35:39', 'abcdef'),
(3, 6, 1, '2013-04-12 01:00:00', '0000-00-00 00:00:00', 'ma');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(100) NOT NULL,
  `receiver_id` int(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` varchar(2000) NOT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT '0',
  `receiver_delete` tinyint(4) NOT NULL DEFAULT '0',
  `sender_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`),
  KEY `sender_id` (`sender_id`,`receiver_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender_id`, `receiver_id`, `time`, `content`, `read_status`, `receiver_delete`, `sender_delete`) VALUES
(88, 17, 1, '2013-04-12 22:18:16', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=5>Here</a>', 1, 1, 0),
(89, 1, 17, '2013-04-12 22:36:03', 'Hi,I would like to join <a href= group_page1.php?id=5>This</a> group.\r\n									 My email id is abhim.garg@gmail.com Thank you!', 1, 1, 0),
(90, 17, 1, '2013-04-12 22:18:15', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=5>Here</a>', 1, 1, 0),
(91, 17, 1, '2013-04-12 22:36:41', 'kaha pe hai?', 1, 1, 0),
(92, 17, 1, '2013-04-13 00:39:57', 'Hi,I would like to join <a href= group_page1.php?id=6>This</a> group.\r\n									 My email id is vrp101@gmail.com Thank you!', 1, 0, 0),
(93, 1, 17, '2013-04-13 01:01:22', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=6>Here</a>', 1, 1, 0),
(94, 1, 17, '2013-04-13 01:01:22', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=6>Here</a>', 1, 1, 0),
(95, 1, 17, '2013-04-13 01:01:21', 'Hi,You have been assigned a task. Please find details <a href=group_page1.php?id=6>Here</a>', 1, 1, 0),
(96, 17, 17, '2013-04-13 01:01:21', 'hi', 1, 1, 0),
(97, 17, 17, '2013-04-13 01:01:20', 'hi', 1, 1, 0),
(98, 17, 17, '2013-04-13 01:01:20', 'hi', 1, 1, 0),
(99, 17, 1, '2013-04-12 19:31:34', 'hi', 0, 0, 0),
(100, 17, 1, '2013-04-13 01:22:36', 'hi', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `performs`
--

CREATE TABLE IF NOT EXISTS `performs` (
  `user_id` int(100) NOT NULL,
  `task_id` int(100) NOT NULL,
  PRIMARY KEY (`user_id`,`task_id`),
  KEY `task_id` (`task_id`),
  KEY `user_id` (`user_id`,`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `performs`
--

INSERT INTO `performs` (`user_id`, `task_id`) VALUES
(17, 16);

-- --------------------------------------------------------

--
-- Table structure for table `pinned_file`
--

CREATE TABLE IF NOT EXISTS `pinned_file` (
  `user_id` int(10) NOT NULL,
  `file_id` int(10) NOT NULL,
  `pinned` tinyint(1) NOT NULL DEFAULT '0',
  `grp_id` int(10) NOT NULL,
  `pin_id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`pin_id`),
  KEY `user_id` (`user_id`,`file_id`),
  KEY `file_id` (`file_id`),
  KEY `grp_id` (`grp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `pinned_file`
--


-- --------------------------------------------------------

--
-- Table structure for table `pinned_groups`
--

CREATE TABLE IF NOT EXISTS `pinned_groups` (
  `pin_id` int(10) NOT NULL AUTO_INCREMENT,
  `grp_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`pin_id`),
  KEY `grp_id` (`grp_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pinned_groups`
--

INSERT INTO `pinned_groups` (`pin_id`, `grp_id`, `user_id`) VALUES
(4, 5, 17),
(6, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_login`
--

CREATE TABLE IF NOT EXISTS `temp_login` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `primary_email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `activation` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL DEFAULT 'Male',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `temp_login`
--

INSERT INTO `temp_login` (`user_id`, `primary_email`, `name`, `password`, `activation`, `gender`) VALUES
(16, 'vrp101@gmail.com', 'Vishrut', 'e80b5017098950fc58aad83c8c14978e', 'b5a8cf1010ca2d596efe734dd35e9568', 'Male'),
(17, 'vishrut103@gmail.com', 'Patel', 'e80b5017098950fc58aad83c8c14978e', '37c3dd4a598ba77258727cdad3c1fe07', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `premail_id` varchar(50) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `about_me` varchar(500) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT 'Male',
  `pswd` varchar(50) NOT NULL,
  `org_name` varchar(50) DEFAULT NULL,
  `org_desg` varchar(20) DEFAULT NULL,
  `contact` varchar(13) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `premail_id`, `image`, `about_me`, `dob`, `gender`, `pswd`, `org_name`, `org_desg`, `contact`, `date_created`) VALUES
(1, 'Abhimanyu Garg', 'abhim.garg@gmail.com', 'batman 681-00fcb.jpg', 'Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen proje', '2001-01-31', 'M', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Acclivia', 'Coder, Documentation', '8128668002', '2013-04-02 15:48:00'),
(2, 'Shalini Maiti', 'shalini.maiti@gmail.com', 'IMG_2890.JPG', 'Working on OS project', '1993-04-16', 'F', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Acclivia', 'PHP coder, Documenta', '+919879353813', '2013-04-02 15:54:03'),
(3, 'Pratik Jain', 'tunetopj@gmail.com', 'Image042.jpg', 'this is me and it will b me, so it shall always be me', '1999-07-31', 'M', '0cb2b62754dfd12b6ed0161d4b447df7', 'daiict', 'student', '7878779455', '0000-00-00 00:00:00'),
(4, 'Shikhar Gupta', 'gshikhri@gmail.com', NULL, 'Shikhar Gupta Gupta Shikhar Gupta Shikhar Gupta Shikhar Gupta Shikhar Gupta Shikhar GuptaShikhar GuptaShikhar Gupta ', '1991-04-10', 'M', '767d52cae83476f6ef61a96bc538fe3d', 'da-iict', 'student', '7878778853', '0000-00-00 00:00:00'),
(5, 'Anurag Mundra', 'anuragmundra@gmail.com', '5.jpg', NULL, '1992-01-16', 'M', 'd77d2953c546cb33e2d0bff4989f6aa2', 'chittor public shool', 'class monitor', '+91951011870', '2013-04-02 15:49:23'),
(6, 'Meghana Jain', 'meghna.jain@gmail.com', NULL, NULL, '1992-10-01', 'F', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Acclivia', 'All-rounder', '+919414737332', '2013-04-02 15:51:29'),
(7, 'Chandraraj Solanki', 'chandrarajsolanki@gmail.com', NULL, NULL, '1993-04-01', 'M', '69f82d4e2e39ba5c93fbca65920f6d04', 'Acclivia', 'PHP coder', '+919904316843', '2013-04-02 15:56:35'),
(8, 'Dhaval Trivedi', 'dhaval6244@gmail.com', 'picture002.jpg', NULL, '1993-04-12', 'M', 'a136f1cbf9f1496abc0e9e98ea6b8625', 'Acclivia', 'PHP coder, Front end', '+918141235438', '2013-04-02 15:59:21'),
(9, 'Karna Patel', 'king_k_patel@yahoo.co.in', NULL, NULL, '1992-09-20', 'M', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Acclivia', 'Front end', '+919925685767', '2013-04-02 16:01:13'),
(10, 'Chandraraj', 'chandrarajsolanki@yahoo.in', NULL, NULL, '0000-00-00', 'M', 'e91db991c57975e701c2bf874c298ee6', '', '', NULL, '2013-04-03 21:02:45'),
(11, 'meghana', 'meghana.jain1@gmail.com', NULL, ':) :)				', '0000-00-00', '', '6eea9b7ef19179a06954edd0f6c05ceb', 'jdasjdalddakdna', '', '089289890208', '2013-04-03 22:25:52'),
(12, 'ArunK', 'mail@arungupta.co.in', NULL, NULL, '0000-00-00', 'M', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, '2013-04-04 14:41:30'),
(13, 'Abhimanyu Singh', 'lol@gmail.com', NULL, '', '2000-12-31', 'M', 'e10adc3949ba59abbe56e057f20f883e', 'PDPU', 'student', '8777877787', '2013-04-04 14:45:11'),
(14, 'parul', 'parul@gmail.com', NULL, NULL, '0000-00-00', 'M', '6db9a4747b3aaff53384dcc817ba4434', '', '', NULL, '2013-04-05 01:21:41'),
(16, 'dhaval', 'ok@ok.com', 'picture006.jpg', '', '1999-12-31', NULL, '2df7e6b53c478efb673408b78ed6b58a', 'DA-IICT', 'student', '7878787878', '2013-04-06 22:27:09'),
(17, 'Vishrut', 'vrp101@gmail.com', 'ERD.png', NULL, NULL, 'Male', 'e80b5017098950fc58aad83c8c14978e', NULL, NULL, NULL, '2013-04-12 21:55:57'),
(18, 'Patel', 'vishrut103@gmail.com', NULL, NULL, NULL, 'M', 'e80b5017098950fc58aad83c8c14978e', NULL, NULL, NULL, '2013-04-13 01:31:57');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `belongs_to`
--
ALTER TABLE `belongs_to`
  ADD CONSTRAINT `belongs_to_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `belongs_to_ibfk_2` FOREIGN KEY (`grp_id`) REFERENCES `groups` (`grp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chatbox`
--
ALTER TABLE `chatbox`
  ADD CONSTRAINT `chatbox_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chatbox_ibfk_2` FOREIGN KEY (`grp_id`) REFERENCES `groups` (`grp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chatbox_ibfk_3` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`meeting_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`grp_id`) REFERENCES `groups` (`grp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `files_ibfk_3` FOREIGN KEY (`owner_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_task`
--
ALTER TABLE `group_task`
  ADD CONSTRAINT `group_task_ibfk_1` FOREIGN KEY (`grp_id`) REFERENCES `groups` (`grp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `livefiles`
--
ALTER TABLE `livefiles`
  ADD CONSTRAINT `livefiles_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`grp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `livefiles_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `meeting_ibfk_1` FOREIGN KEY (`grp_id`) REFERENCES `groups` (`grp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_ibfk_2` FOREIGN KEY (`caller_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `performs`
--
ALTER TABLE `performs`
  ADD CONSTRAINT `performs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `performs_ibfk_4` FOREIGN KEY (`task_id`) REFERENCES `group_task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pinned_file`
--
ALTER TABLE `pinned_file`
  ADD CONSTRAINT `pinned_file_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pinned_file_ibfk_3` FOREIGN KEY (`grp_id`) REFERENCES `groups` (`grp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pinned_file_ibfk_4` FOREIGN KEY (`file_id`) REFERENCES `livefiles` (`livefile_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pinned_groups`
--
ALTER TABLE `pinned_groups`
  ADD CONSTRAINT `pinned_groups_ibfk_1` FOREIGN KEY (`grp_id`) REFERENCES `groups` (`grp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pinned_groups_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
