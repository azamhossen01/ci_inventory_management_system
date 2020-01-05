-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2020 at 03:58 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_inventory_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2,
  `user_status` int(11) NOT NULL DEFAULT 1,
  `user_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `user_status`, `user_date`) VALUES
(1, 'Admin Khan', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '2020-01-04 01:09:43'),
(2, 'Azam Khan', 'azam@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 1, '2020-01-04 01:56:59'),
(3, 'Jamal Khan', 'jamal@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 1, '2020-01-04 17:00:23'),
(4, 'Kamal Khan', 'kamal@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 1, '2020-01-04 17:01:11'),
(5, 'Mamun Khan', 'mamun@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 0, '2020-01-04 17:01:42'),
(6, 'Ramzan Ali', 'ramzan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 1, '2020-01-04 17:04:18'),
(7, 'Salman Khan', 'salman@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 1, '2020-01-04 17:05:02'),
(8, 'Kamal Khan', 'kamal@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 2, 1, '2020-01-04 17:41:52'),
(9, 'Ismam Hasan', 'ismam@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 2, 1, '2020-01-04 17:43:07'),
(10, 'Masum Khan', 'masum@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 2, 1, '2020-01-04 17:49:31'),
(11, 'Safayet Kabir', 'safayet@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 2, 1, '2020-01-04 17:50:06'),
(12, 'Maria Khan', 'maria@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 2, 1, '2020-01-05 01:49:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
