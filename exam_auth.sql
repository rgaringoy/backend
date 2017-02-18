-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2016 at 08:40 AM
-- Server version: 5.6.30
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `exam_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(40) DEFAULT 'active',
  `confirmed` tinyint(4) DEFAULT NULL,
  `confirmation_code` text
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `status`, `confirmed`, `confirmation_code`) VALUES
(2, 'taylor@ot.com', 'f9a5082b067aedc6d73dca4893cc98f9', 'active', 1, '320b45bc3e172b835e14a322cac78608'),
(3, 'ram@gmail.com', 'f9a5082b067aedc6d73dca4893cc98f9', 'active', 1, '92d5b49be20508ac59530215870e7cdc'),
(4, 'ser@gmail.com', 'f9a5082b067aedc6d73dca4893cc98f9', 'active', 1, 'eb3e31c44445241925d754edc5c2df69'),
(5, 'at@gmail.com', 'd4d7ec09d09b25fd2fe49fbc4bb24fc2', 'active', 1, 'e0a08daea840e38bf3443cb2281d2304');

-- --------------------------------------------------------

--
-- Table structure for table `user_old_password`
--

CREATE TABLE IF NOT EXISTS `user_old_password` (
  `user_id` bigint(20) unsigned NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_old_password`
--

INSERT INTO `user_old_password` (`user_id`, `password`, `updated_at`) VALUES
(2, 'd4d7ec09d09b25fd2fe49fbc4bb24fc2', NULL),
(3, 'd4d7ec09d09b25fd2fe49fbc4bb24fc2', NULL),
(4, 'd4d7ec09d09b25fd2fe49fbc4bb24fc2', NULL),
(5, 'd4d7ec09d09b25fd2fe49fbc4bb24fc2', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_old_password`
--
ALTER TABLE `user_old_password`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;