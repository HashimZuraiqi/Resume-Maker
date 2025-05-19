-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 12:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resume maker`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `phonenumber` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `birthdate`, `phonenumber`) VALUES
(1, 'has20230166', 'fdsfddsd@gamil.com', '$2y$10$u2Sf27PuRmfb8pS.oQE39OKh7sX.NGlJHQbOAjaPqgxbnm5lq6lrq', '0001-12-12', '2121212121212'),
(2, 'has2023016', 'has20230166@std.psut.edu.jo', '$2y$10$ukJeODz46/lONVKedBiEzO3m4TtWZs2yo8HKz5CZS1XDIOkkreDrC', '1222-12-12', '121212121221'),
(3, 'khaled', 'khaled@gmail.com', '$2y$10$mpRjFohJscSTGUWzTdDJJuIONX4NqU1Y4a6iXD5vpXJRaz0J6KF9q', '2005-11-11', '0792706632'),
(4, 'hashimzu25', 'hashimalzu25@gmail.com', '$2y$10$OzrKIT5GUB2xKeBmLWeyFuqh/Z86gRnDUqz/4JkaPAVDpR9KmsRjS', '1111-11-11', '0792706632'),
(5, 'firas', 'firas@psut.com', '$2y$10$O5O6WQpDDUMSIiZjtOa6c.BB1fpTSI9Gdwu0k802XxnmrfRTOYjfS', '1111-11-11', '123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
