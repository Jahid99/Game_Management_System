-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2017 at 09:20 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `player_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(16) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `allowed_divisions_ranks` text NOT NULL COMMENT 'This column will store the allowed divisions and ranks the users have can post/reply or not'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `allowed_divisions_ranks`) VALUES
(1, 'adminsays', '$2y$10$tytLxdERlcqZuuwVQjv7NeOMAvD9s1G5YOHqjYNYtLF96t5oSobUO', 'a:7:{i:0;s:17:\"division 1 rank 1\";i:1;s:17:\"division 1 rank 2\";i:2;s:17:\"division 1 rank 3\";i:3;s:17:\"division 4 rank 1\";i:4;s:17:\"division 4 rank 2\";i:5;s:17:\"division 8 rank 5\";i:6;s:1:\"0\";}');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cat_slug` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `cat_slug`) VALUES
(1, 'Category3', 'cat3'),
(2, 'Category2', 'cat2'),
(3, 'Category1', 'cat1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `id` int(11) NOT NULL,
  `cat` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` text,
  `slug` varchar(255) DEFAULT NULL,
  `character_name` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`id`, `cat`, `title`, `body`, `slug`, `character_name`, `date`, `userid`) VALUES
(2, 1, 'sadf', 'asdfasdf', 'asdfas', 'Jahidul Haque', '2017-09-05 16:44:17', NULL),
(3, 1, 'sdfa', 'sdfasdf', 'sdfa', 'Jahidul Haque', '2017-09-05 05:57:43', 1),
(5, 3, 'fadsasd asdfa sfas a', 'fasdfasdfasd', 'fadsasd-asdfa-sfas-a', 'Jahidul Haque', '2017-09-05 05:58:01', 1),
(6, 1, 'gd', 'fasfasf', 'gd', 'Jahidul Haque', '2017-09-05 06:23:28', 1),
(7, 1, 'adsfasd', 'fdasfasfasf asdfsf', 'adsfasd', 'Jahidul Haque', '2017-09-05 15:12:47', 1),
(9, 1, 'gd', 'dfasdfasf', 'gd7', 'Jahidul Haque', '2017-09-05 15:31:25', 1),
(10, 1, 'gd', 'sdfasfasdfdasf', 'gd9', 'Jahidul Haque', '2017-09-05 15:31:37', 1),
(11, 1, 'fasdf', 'asdfasdf', 'fasdf', 'Nas mia', '2017-09-06 13:32:43', 5),
(12, 2, 'asdfasdf', 'asdfasfasdf', 'asdfasdf', 'Nas mia', '2017-09-06 13:32:55', 5),
(13, 1, 'ZXC', 'zXCzXCzXc', 'ZXC', 'Nas mia', '2017-09-06 13:33:47', 5),
(14, 1, 'aasdfads', 'fasdfasdfasf', 'aasdfads', 'Nas mia', '2017-09-06 13:35:06', 5),
(15, 2, 'adsfasdf', 'asfasdfdasf', 'adsfasdf', 'Nas mia', '2017-09-06 13:35:45', 5),
(16, 1, 'JS ', 'fasfad asfasdf', 'JS-', 'Nas mia', '2017-09-06 13:35:55', 5),
(17, 1, 'a', 'asdfsadf', 'a', 'Nas mia', '2017-09-06 13:36:42', 5),
(18, 1, 'a', 'ADadsa', 'a17', 'Nas mia', '2017-09-06 13:36:49', 5),
(19, 1, 'dsfasdf', 'asdfasdfasf', 'dsfasdf', 'Jahidul Haque', '2017-09-06 13:43:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reply`
--

CREATE TABLE `tbl_reply` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `message` text,
  `character_name` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(16) NOT NULL,
  `username` varchar(255) NOT NULL,
  `character_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT 'upload/default_avatar.jpg',
  `password` varchar(255) NOT NULL,
  `division` int(16) NOT NULL DEFAULT '1',
  `rank` int(16) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `character_name`, `email`, `avatar`, `password`, `division`, `rank`) VALUES
(1, 'jahid99', 'Jahidul Haque', 'jahid@gmail.com', 'upload/ce325b7ea3.png', '$2y$10$WYSUS/Gs83auMgchkzSwz.maJhnjqfZf5hU6rZI0Y8iOjQmU5yNl6', 4, 1),
(2, 'pathan99', 'Pathan', 'pathan99@gmail.com', 'upload/default_avatar.jpg', '$2y$10$IJkLdHqt5MNWm8wV8UV7FOt9RBP7ZVZXeMUTcVoJJ0ECoDj/mmTfu', 2, 4),
(3, 'haque99', 'Haque', 'haque99@gmail.com', 'upload/079927be82.jpg', '$2y$10$moJZgSwrRClc2Yss5ztrQ.p0mr0TVyFVK9AtzERHmyMpaloahnvl2', 10, 5),
(4, 'naim', 'Naim', 'naim@gmail.com', 'upload/default_avatar.jpg', '$2y$10$WEwA6yRd2VxqAQ1Zzrw5DuVvaaAEoGwg7ISwvQIhnhlHEukNKaLQ2', 1, 5),
(5, 'nas99', 'Nas mia', 'nas@gmail.com', 'upload/default_avatar.jpg', '$2y$10$nHPvnc3537rZmpX7YZnLDugtbI9b8TKnxeCuxVrynT017m0d8IBTe', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cat_slug` (`cat_slug`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `par_ind` (`character_name`);

--
-- Indexes for table `tbl_reply`
--
ALTER TABLE `tbl_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `par_ind` (`character_name`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `character_name` (`character_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tbl_reply`
--
ALTER TABLE `tbl_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD CONSTRAINT `tbl_post_ibfk_1` FOREIGN KEY (`character_name`) REFERENCES `tbl_users` (`character_name`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_reply`
--
ALTER TABLE `tbl_reply`
  ADD CONSTRAINT `tbl_reply_ibfk_1` FOREIGN KEY (`character_name`) REFERENCES `tbl_users` (`character_name`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
