-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2013 at 02:25 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
(1, 1, '2013-04-12 01:48:04', '0'),
(1, 3, '2013-04-12 02:08:36', '0'),
(2, 3, '2013-04-12 02:09:27', '0'),
(3, 1, '2013-04-12 01:48:39', '0'),
(3, 3, '2013-04-12 02:09:03', '0'),
(4, 1, '2013-04-12 01:47:51', '2'),
(4, 2, '2013-04-12 01:58:08', '0'),
(4, 4, '2013-04-12 02:20:45', '0'),
(5, 1, '2013-04-12 01:48:19', '0'),
(5, 2, '2013-04-12 01:57:37', '2'),
(5, 3, '2013-04-12 02:08:19', '2'),
(5, 4, '2013-04-12 02:16:54', '0'),
(8, 1, '2013-04-12 01:48:55', '0'),
(8, 2, '2013-04-12 01:58:30', '0'),
(9, 3, '2013-04-12 02:09:46', '0'),
(10, 1, '2013-04-12 01:49:08', '0'),
(12, 3, '2013-04-12 02:10:04', '0'),
(13, 4, '2013-04-12 02:17:20', '0'),
(14, 2, '2013-04-12 01:58:47', '0'),
(16, 4, '2013-04-12 02:15:22', '2');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `chatbox`
--

INSERT INTO `chatbox` (`c_id`, `sender_id`, `grp_id`, `meeting_id`, `send_time`, `chat_message`) VALUES
(119, 4, 1, 1, '2013-04-12 01:53:02', 'suggest some good topics for project'),
(120, 4, 1, 1, '2013-04-12 01:53:36', 'my suggestion is acclivia');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `owner_id`, `filename`, `grp_id`, `created_on`, `pinned`) VALUES
(14, 4, '3.jpg', 1, '2013-04-12 01:51:26', 0),
(15, 5, 'happy.jpg', 2, '2013-04-12 02:03:07', 0),
(16, 5, '21st-muller.pdf', 3, '2013-04-12 02:11:17', 0),
(17, 16, 'kochspeechdetectordesign2008.pdf', 4, '2013-04-12 02:22:35', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`grp_id`, `grp_name`, `date_of_creation`, `description`) VALUES
(1, 'SEN', '0000-00-00 00:00:00', 'software engineering group'),
(2, 'Web Data Group', '0000-00-00 00:00:00', 'web crazy people should join this group'),
(3, 'Graph Theory', '0000-00-00 00:00:00', 'Rahul Muthu Sir course'),
(4, 'EHD', '0000-00-00 00:00:00', 'Prabhat Ranjan Sir course');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `group_task`
--

INSERT INTO `group_task` (`task_id`, `grp_id`, `finish_status`, `task_name`, `task_description`, `task_start_date`, `task_end_date`, `task_deadline`) VALUES
(14, 1, 0, 'Proposal', 'prepare proposal', '2013-01-15 07:35:00', '0000-00-00 00:00:00', '2013-01-19 18:30:00'),
(15, 2, 0, 'Read about different searching algorithms', 'read and tell others', '2013-04-10 12:35:00', '0000-00-00 00:00:00', '2013-04-20 08:30:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `livefiles`
--

INSERT INTO `livefiles` (`livefile_id`, `group_id`, `filename`, `random_key`, `owner_id`, `create_date`) VALUES
(14, 2, 'search', 'vxw6v4slf', 5, '2013-04-12 02:03:24');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`meeting_id`, `grp_id`, `caller_id`, `start_time`, `end_time`, `agenda`) VALUES
(1, 1, 4, '2013-01-08 11:30:00', '2013-04-12 01:53:39', 'discuss about ideas');

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
  `read_status` tinyint(1) NOT NULL,
  `receiver_delete` tinyint(4) NOT NULL DEFAULT '0',
  `sender_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`),
  KEY `sender_id` (`sender_id`,`receiver_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender_id`, `receiver_id`, `time`, `content`, `read_status`, `receiver_delete`, `sender_delete`) VALUES
(35, 16, 1, '2013-04-08 12:16:02', 'test 1', 1, 0, 0),
(36, 1, 16, '2013-04-12 02:21:07', 'test1 reply', 1, 1, 0),
(37, 16, 1, '2013-04-08 12:16:40', 'test2', 1, 0, 0),
(38, 1, 16, '2013-04-12 02:21:07', 'test2 reply', 1, 1, 0),
(40, 16, 1, '2013-04-08 12:24:42', 'test3', 1, 0, 0),
(41, 1, 16, '2013-04-12 02:21:06', 'test3 reply', 1, 1, 0),
(42, 16, 1, '2013-04-08 12:25:21', 'test4', 1, 0, 0),
(43, 1, 16, '2013-04-12 02:21:06', 'test4 reply', 1, 1, 0),
(44, 16, 1, '2013-04-08 12:26:14', 'test5', 1, 0, 0),
(45, 1, 16, '2013-04-12 02:21:06', 'test5 reply', 1, 1, 0),
(46, 16, 16, '2013-04-12 02:21:05', 'test 6', 1, 1, 0),
(47, 16, 1, '2013-04-10 18:53:35', 'test 6', 1, 1, 0),
(48, 1, 16, '2013-04-12 02:21:04', 'test 6 reply', 1, 1, 0),
(49, 16, 16, '2013-04-12 02:21:03', 'hi', 1, 1, 0),
(51, 16, 16, '2013-04-12 02:21:03', 'sfg', 1, 1, 0),
(52, 1, 1, '2013-04-10 17:22:31', 'sdf', 1, 1, 0),
(53, 1, 1, '2013-04-10 17:22:20', 'sdf', 1, 1, 0),
(54, 1, 5, '2013-04-12 01:56:02', 'sdfds', 1, 1, 0),
(55, 1, 7, '2013-04-11 19:43:13', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=3>Here</a>', 1, 1, 0),
(56, 1, 8, '2013-04-10 17:08:59', 'hello ', 0, 0, 0),
(57, 3, 3, '2013-04-11 19:30:04', 'lol', 1, 0, 0),
(58, 3, 7, '2013-04-11 19:43:12', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=32>Here</a>', 1, 1, 0),
(59, 7, 7, '2013-04-11 19:43:12', 'asd', 1, 1, 0),
(60, 7, 7, '2013-04-11 19:43:32', 'asdsadd', 1, 0, 0),
(61, 7, 7, '2013-04-11 14:14:22', 'asdsadd', 0, 0, 0),
(62, 7, 7, '2013-04-11 14:14:49', 'asdsadd', 0, 0, 0),
(63, 5, 1, '2013-04-11 20:30:14', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=34>Here</a>', 1, 0, 0),
(64, 1, 5, '2013-04-12 01:56:04', 'Hi,I would like to join <a href= group_page1.php?id=34>This</a> group.\r\n									 My email id is abhim.garg@gmail.com Thank you!', 1, 1, 0),
(65, 1, 5, '2013-04-12 01:56:05', 'Hi,I would like to join <a href= group_page1.php?id=34>This</a> group.\r\n									 My email id is abhim.garg@gmail.com Thank you!', 1, 1, 0),
(66, 5, 1, '2013-04-11 21:29:44', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=35>Here</a>', 0, 0, 0),
(67, 9, 6, '2013-04-12 01:35:56', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=20>Here</a>', 0, 0, 0),
(68, 9, 4, '2013-04-12 01:54:34', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=20>Here</a>', 1, 1, 0),
(69, 4, 5, '2013-04-12 01:56:08', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=21>Here</a>', 1, 0, 0),
(70, 4, 1, '2013-04-12 01:48:04', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=22>Here</a>', 0, 0, 0),
(71, 4, 5, '2013-04-12 01:56:15', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=22>Here</a>', 1, 0, 0),
(72, 4, 3, '2013-04-12 01:48:39', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=22>Here</a>', 0, 0, 0),
(73, 4, 8, '2013-04-12 01:48:55', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=22>Here</a>', 0, 0, 0),
(74, 4, 10, '2013-04-12 01:49:08', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=22>Here</a>', 0, 0, 0),
(75, 4, 5, '2013-04-12 01:56:19', 'Hi,You have been assigned a task. Please find details <a href=group_page1.php?id=22>Here</a>', 1, 0, 0),
(76, 4, 1, '2013-04-12 01:51:07', 'Hi,You have been assigned a task. Please find details <a href=group_page1.php?id=22>Here</a>', 0, 0, 0),
(77, 5, 4, '2013-04-12 01:58:08', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=23>Here</a>', 0, 0, 0),
(78, 5, 8, '2013-04-12 01:58:30', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=23>Here</a>', 0, 0, 0),
(79, 5, 14, '2013-04-12 01:58:47', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=23>Here</a>', 0, 0, 0),
(80, 5, 1, '2013-04-12 02:08:36', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=3>Here</a>', 0, 0, 0),
(81, 5, 3, '2013-04-12 02:09:03', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=3>Here</a>', 0, 0, 0),
(82, 5, 2, '2013-04-12 02:09:27', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=3>Here</a>', 0, 0, 0),
(83, 5, 9, '2013-04-12 02:09:46', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=3>Here</a>', 0, 0, 0),
(84, 5, 12, '2013-04-12 02:10:04', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=3>Here</a>', 0, 0, 0),
(85, 16, 5, '2013-04-12 02:16:54', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=4>Here</a>', 0, 0, 0),
(86, 16, 13, '2013-04-12 02:17:20', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=4>Here</a>', 0, 0, 0),
(87, 16, 4, '2013-04-12 02:20:45', 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id=4>Here</a>', 0, 0, 0);

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
(1, 14),
(5, 14);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `temp_login`
--

INSERT INTO `temp_login` (`user_id`, `primary_email`, `name`, `password`, `activation`) VALUES
(6, 'anmol.garg@hotmail.com', 'Anmol Garg', 'qwerty', 'Aye'),
(7, 'amanjain@gmail.com', 'Aman Jain', 'qwerty', 'Nye'),
(8, 'rohan.kohli@gmail.com', 'Rohan Kohli', 'qwerty', 'Yes'),
(9, 'chandrarajsolanki@yahoo.in', 'Chandraraj', '2007a0db4fe33893c99e7ac6cfa87a16', '753571f5ca57faab0b9250712944efa5'),
(10, 'meghana.jain1@gmail.com', 'meghana', '6eea9b7ef19179a06954edd0f6c05ceb', 'b1b30a2aa544de52b48b2dec0f194d36'),
(11, 'mail@arungupta.co.in', 'ArunK', 'e10adc3949ba59abbe56e057f20f883e', 'fe0ade564a4b10c57005664ed2762848'),
(12, 'lol@gmail.com', 'lol', '9cdfb439c7876e703e307864c9167a15', 'cc2fe87eac0db91899032b7cb097c4ab'),
(13, 'parul@gmail.com', 'parul', '6db9a4747b3aaff53384dcc817ba4434', '854f9ea94a6c0e1a2fe2e6be68a040ae'),
(14, 'ok@ok', 'ok', '444bcb3a3fcf8389296c49467f27e1d6', 'a5ab3229a9147062b7b50d14231491c2'),
(15, 'ok@ok', 'ok', '444bcb3a3fcf8389296c49467f27e1d6', 'a82aee340f26a53e41942cda775a6690');

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
  `dob` date NOT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `pswd` varchar(50) NOT NULL,
  `org_name` varchar(50) NOT NULL,
  `org_desg` varchar(20) NOT NULL,
  `contact` varchar(13) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `premail_id`, `image`, `about_me`, `dob`, `gender`, `pswd`, `org_name`, `org_desg`, `contact`, `date_created`) VALUES
(1, 'Abhimanyu Garg', 'abhim.garg@gmail.com', 'batman 681-00fcb.jpg', 'Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen project. Working on sen proje', '1992-12-05', 'M', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Acclivia', 'Coder, Documentation', '+918128668002', '2013-04-02 10:18:00'),
(2, 'Shalini Maiti', 'shalini.maiti@gmail.com', 'IMG_2890.JPG', 'Working on OS project', '1993-04-16', 'F', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Acclivia', 'PHP coder, Documenta', '+919879353813', '2013-04-02 10:24:03'),
(3, 'Pratik Jain', 'tunetopj@gmail.com', 'Image042.jpg', 'this is me and it will b me, so it shall always be me', '1999-07-31', 'M', '0cb2b62754dfd12b6ed0161d4b447df7', 'daiict', 'student', '7878779455', '0000-00-00 00:00:00'),
(4, 'Shikhar Gupta', 'gshikhri@gmail.com', NULL, 'Shikhar Gupta Gupta Shikhar Gupta Shikhar Gupta Shikhar Gupta Shikhar Gupta Shikhar GuptaShikhar GuptaShikhar Gupta ', '1991-04-10', 'M', '767d52cae83476f6ef61a96bc538fe3d', 'da-iict', 'student', '7878778853', '0000-00-00 00:00:00'),
(5, 'Anurag Mundra', 'anuragmundra@gmail.com', '5.jpg', NULL, '1992-01-16', 'M', 'd77d2953c546cb33e2d0bff4989f6aa2', 'chittor public shool', 'class monitor', '+91951011870', '2013-04-02 10:19:23'),
(6, 'Meghana Jain', 'meghna.jain@gmail.com', NULL, NULL, '1992-10-01', 'F', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Acclivia', 'All-rounder', '+919414737332', '2013-04-02 10:21:29'),
(7, 'Chandraraj Solanki', 'chandrarajsolanki@gmail.com', NULL, NULL, '1993-04-01', 'M', '69f82d4e2e39ba5c93fbca65920f6d04', 'Acclivia', 'PHP coder', '+919904316843', '2013-04-02 10:26:35'),
(8, 'Dhaval Trivedi', 'dhaval6244@gmail.com', 'picture002.jpg', NULL, '1993-04-12', 'M', 'a136f1cbf9f1496abc0e9e98ea6b8625', 'Acclivia', 'PHP coder, Front end', '+918141235438', '2013-04-02 10:29:21'),
(9, 'Karna Patel', 'king_k_patel@yahoo.co.in', NULL, NULL, '1992-09-20', 'M', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Acclivia', 'Front end', '+919925685767', '2013-04-02 10:31:13'),
(10, 'Chandraraj', 'chandrarajsolanki@yahoo.in', NULL, NULL, '0000-00-00', 'M', 'e91db991c57975e701c2bf874c298ee6', '', '', NULL, '2013-04-03 15:32:45'),
(11, 'meghana', 'meghana.jain1@gmail.com', NULL, ':) :)				', '0000-00-00', '', '6eea9b7ef19179a06954edd0f6c05ceb', 'jdasjdalddakdna', '', '089289890208', '2013-04-03 16:55:52'),
(12, 'ArunK', 'mail@arungupta.co.in', NULL, NULL, '0000-00-00', 'M', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, '2013-04-04 09:11:30'),
(13, 'Abhimanyu Singh', 'lol@gmail.com', NULL, '', '2000-12-31', 'M', 'e10adc3949ba59abbe56e057f20f883e', 'PDPU', 'student', '8777877787', '2013-04-04 09:15:11'),
(14, 'parul', 'parul@gmail.com', NULL, NULL, '0000-00-00', 'M', '6db9a4747b3aaff53384dcc817ba4434', '', '', NULL, '2013-04-04 19:51:41'),
(16, 'dhaval', 'ok@ok.com', 'picture006.jpg', '', '1999-12-31', NULL, '2df7e6b53c478efb673408b78ed6b58a', 'DA-IICT', 'student', '7878787878', '2013-04-06 16:57:09');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
