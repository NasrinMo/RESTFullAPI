-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 07:10 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `all_libraries`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(6) NOT NULL,
  `id_user` int(6) NOT NULL,
  `id_library_book` int(6) NOT NULL,
  `status` varchar(10) NOT NULL,
  `appointmentDate` datetime DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `id_user`, `id_library_book`, `status`, `appointmentDate`, `update_at`, `create_at`) VALUES
(12, 2, 2, 'reserved', '2020-10-21 11:00:00', '2020-10-22 20:07:04', '2020-09-30 17:05:49'),
(16, 2, 3, 'reserved', '2020-11-18 09:48:00', '2020-10-14 20:13:48', '2020-09-30 20:07:27'),
(24, 1, 2, 'reserved', '2020-10-26 15:27:00', '2020-10-22 18:48:44', '2020-10-18 19:22:31'),
(25, 1, 3, 'reserved', '2020-10-26 15:24:00', '2020-10-18 19:24:48', '2020-10-18 19:24:48'),
(26, 1, 6, 'reserved', '2020-10-28 15:25:00', '2020-10-18 19:25:21', '2020-10-18 19:25:21'),
(27, 1, 6, 'reserved', '2020-10-29 09:32:00', '2020-10-18 19:32:52', '2020-10-18 19:32:52'),
(29, 1, 7, 'reserved', '2020-10-28 15:38:00', '2020-10-18 19:39:07', '2020-10-18 19:39:07'),
(30, 1, 6, 'reserved', '2020-10-27 12:44:00', '2020-10-18 19:40:06', '2020-10-18 19:40:06'),
(32, 1, 5, 'reserved', '2020-10-21 11:00:00', '2020-10-22 18:52:30', '2020-10-18 19:41:22'),
(34, 1, 6, 'reserved', '2020-10-23 09:43:00', '2020-10-18 19:43:16', '2020-10-18 19:43:16'),
(40, 1, 1, 'reserved', '2020-10-21 10:39:00', '2020-10-22 19:27:42', '2020-10-20 20:29:56'),
(47, 1, 3, 'reserved', '2020-09-15 09:41:00', '2020-10-20 22:49:50', '2020-10-20 22:42:03'),
(53, 1, 3, 'reserved', '2020-10-21 08:23:00', '2020-10-21 20:23:52', '2020-10-21 20:23:52'),
(58, 1, 7, 'reserved', '2020-10-21 11:08:00', '2020-10-22 19:26:32', '2020-10-22 18:52:54'),
(59, 1, 6, 'reserved', '2020-10-21 10:40:00', '2020-10-22 19:28:20', '2020-10-22 19:28:20'),
(60, 2, 3, 'reserved', '2020-09-15 10:50:00', '2020-10-22 19:31:09', '2020-10-22 19:31:09'),
(61, 2, 5, 'reserved', '2020-10-22 11:05:00', '2020-10-22 20:13:25', '2020-10-22 20:13:25'),
(62, 2, 6, 'reserved', '2020-10-22 11:20:00', '2020-10-22 20:20:03', '2020-10-22 20:14:23'),
(63, 2, 1, 'reserved', '2020-10-22 11:30:00', '2020-10-22 20:23:33', '2020-10-22 20:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(6) NOT NULL,
  `title` varchar(255) NOT NULL,
  `writer` varchar(255) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `writer`, `update_at`, `create_at`) VALUES
(1, 'victory', 'jack landon', '2020-09-23 23:59:37', '2020-09-23 23:59:37'),
(2, 'sql', 'victor hogo', '2020-09-24 00:00:31', '2020-09-24 00:00:31'),
(3, 'me before you', 'hasti mahdavi', '2020-09-24 00:01:28', '2020-09-24 00:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `libraries`
--

CREATE TABLE `libraries` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `libraries`
--

INSERT INTO `libraries` (`id`, `name`, `address`, `update_at`, `create_at`) VALUES
(1, 'spring', 'montreal', '2020-09-24 00:00:48', '2020-09-24 00:00:48'),
(2, 'kosar', 'toronto', '2020-09-24 00:01:00', '2020-09-24 00:01:00'),
(3, 'shahab', 'vancouver', '2020-10-12 20:07:04', '2020-10-12 20:07:04'),
(4, 'melli', 'new yourk', '2020-10-12 20:07:31', '2020-10-12 20:07:31'),
(5, 'tara', 'london', '2020-10-12 20:07:54', '2020-10-12 20:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `library_book`
--

CREATE TABLE `library_book` (
  `id` int(6) NOT NULL,
  `id_library` int(6) NOT NULL,
  `id_book` int(6) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `library_book`
--

INSERT INTO `library_book` (`id`, `id_library`, `id_book`, `update_at`, `create_at`) VALUES
(1, 2, 3, '2020-09-24 00:01:47', '2020-09-24 00:01:47'),
(2, 2, 2, '2020-09-24 00:01:47', '2020-09-24 00:01:47'),
(3, 1, 1, '2020-09-24 00:02:00', '2020-09-24 00:02:00'),
(5, 1, 2, '2020-10-09 21:54:30', '2020-10-09 21:54:30'),
(6, 4, 3, '2020-10-12 20:08:42', '2020-10-12 20:08:42'),
(7, 4, 2, '2020-10-12 20:08:52', '2020-10-12 20:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `library_patern`
--

CREATE TABLE `library_patern` (
  `id` int(6) NOT NULL,
  `id_library` int(6) NOT NULL,
  `id_pattern` int(6) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `library_patern`
--

INSERT INTO `library_patern` (`id`, `id_library`, `id_pattern`, `update_at`, `create_at`) VALUES
(2, 2, 1, '2020-09-24 00:04:02', '2020-09-24 00:04:02'),
(3, 1, 1, '2020-09-24 00:04:11', '2020-09-24 00:04:11'),
(4, 4, 1, '2020-10-14 22:15:12', '2020-10-14 22:15:12'),
(5, 3, 1, '2020-10-18 19:18:15', '2020-10-18 19:18:15'),
(6, 5, 1, '2020-10-18 19:18:23', '2020-10-18 19:18:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `tokenAccess` varchar(32) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `tokenAccess`, `update_at`, `create_at`) VALUES
(1, 'nasrin', 'mohamadi', 'nasrin.mohamadii@yahoo.com', '123', '15c542d74b15ad0364f6c44d390a0b7f', '2020-11-01 01:12:55', '2020-09-24 00:04:42'),
(2, 'ramin', 'jormoze', 'ramin.jorboze@gmail.com', '123', NULL, '2020-10-22 20:23:43', '2020-09-24 22:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `workpattern`
--

CREATE TABLE `workpattern` (
  `id` int(6) NOT NULL,
  `pattern` text,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workpattern`
--

INSERT INTO `workpattern` (`id`, `pattern`, `update_at`, `create_at`) VALUES
(1, '{\"Monday\":\"08:00-16:00\",\"Tuesday\":\"08:00-16:00\",\"Wednesday\":\"08:00-16:00\",\"Thursday\":\"08:00-16:00\",\"Friday\":\"08:00-13:00\",\"Saturday\":\"close\",\"Sunday\":\"close\"}', '2020-09-29 21:13:37', '2020-09-24 00:03:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`,`id_user`,`id_library_book`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_library_book` (`id_library_book`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `libraries`
--
ALTER TABLE `libraries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library_book`
--
ALTER TABLE `library_book`
  ADD PRIMARY KEY (`id`,`id_library`,`id_book`),
  ADD KEY `id_library` (`id_library`),
  ADD KEY `id_book` (`id_book`);

--
-- Indexes for table `library_patern`
--
ALTER TABLE `library_patern`
  ADD PRIMARY KEY (`id`,`id_library`,`id_pattern`),
  ADD KEY `id_library` (`id_library`),
  ADD KEY `id_patern` (`id_pattern`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workpattern`
--
ALTER TABLE `workpattern`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `libraries`
--
ALTER TABLE `libraries`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `library_book`
--
ALTER TABLE `library_book`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `library_patern`
--
ALTER TABLE `library_patern`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `workpattern`
--
ALTER TABLE `workpattern`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`id_library_book`) REFERENCES `library_book` (`id`);

--
-- Constraints for table `library_book`
--
ALTER TABLE `library_book`
  ADD CONSTRAINT `library_book_ibfk_1` FOREIGN KEY (`id_library`) REFERENCES `libraries` (`id`),
  ADD CONSTRAINT `library_book_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`);

--
-- Constraints for table `library_patern`
--
ALTER TABLE `library_patern`
  ADD CONSTRAINT `library_patern_ibfk_1` FOREIGN KEY (`id_library`) REFERENCES `libraries` (`id`),
  ADD CONSTRAINT `library_patern_ibfk_2` FOREIGN KEY (`id_pattern`) REFERENCES `workpattern` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
