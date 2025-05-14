-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 12:20 AM
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
-- Table structure for table `resumes`
--

CREATE TABLE `resumes` (
  `resume_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `education` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resumes`
--

INSERT INTO `resumes` (`resume_id`, `user_id`, `name`, `email`, `phone`, `address`, `skills`, `experience`, `education`) VALUES
(2, 2, 'Hashim AL Zuraiqi', 'hashim.zuraiqi@example.com', '1234567890', '123 Tech Avenue, Amman, Jordan', 'Front-end Development\r\n\r\nHTML, CSS, JavaScript, Bootstrap\r\n\r\nResponsive Design\r\n\r\nVersion Control (Git)\r\n\r\nUX/UI Design', 'Junior Front-End Developer (2024-Present): Working on designing and developing responsive websites for clients.\r\n\r\nIntern at XYZ Tech (2023): Assisted in building websites and applications, learning modern web development practices.', 'Bachelor of Computer Science (2024-Present): Princess Sumaya University for Technology\r\n\r\nHigh School Diploma (2020): Amman High School'),
(3, 4, 'dsdsdsds', 'dsdsdsds@gmail.com', 'dsdsdsds', 'dsdsd', 'sdsdsdsd', 'sdsdsdsd', 'sdsds'),
(4, 4, 'ffffffffffffffffffff', 'dsdsdsds@gmail.com', 'dsddddddddd', 'dsdsddddd', 'dddddddddddddd', 'ddddddddddddd', 'dddddddddddddd'),
(5, 2, 'firas', 'firas@gmail.com', '1233434343434343', 'fddsadasdasd', 'asdasdasdas', 'dasdasdasdas', 'dasdasdadasd'),
(6, 3, 'Khaled zalabia', 'kha20230121@std.psut.edu.jo', '12344344', 'fdfsdfsdfsd', 'fsdfsdfsdfsd', 'fsdfsdfsdfsdfsdf', 'sdfsdfsdfsdfsdf'),
(7, 5, 'Feras Daoud', 'firas.dawood445@gmail.com', '+962 7976 12245', 'Amman, Jordan', 'Soft Skills\r\n\r\nCritical Thinking\r\n\r\nProblem-Solving\r\n\r\nTeam Collaboration\r\n\r\nResearch Skills\r\n\r\nTechnical Skills\r\n\r\nSecure Coding Practices\r\n\r\nProgramming Languages: Python, C++, JavaScript, SQL\r\n\r\nOperating Systems: Windows, Linux\r\n\r\nDatabase Management: MySQL', 'Movie Recommender System\r\n\r\nDeveloped in Python using text files and dictionaries\r\n\r\nIncluded genre filtering, title search, rating/year filters, and dynamic updates\r\n\r\nLocal Company Network (Cisco Packet Tracer)\r\n\r\nDesigned VLANs, DHCP, and HTTP setup\r\n\r\nConfigured routers, switches, wireless access points\r\n\r\nImplemented ACLs for restricted inter-department access\r\n\r\nSecure Web Design &amp; Development Project\r\n\r\nTechnologies: HTML, CSS, JavaScript, PHP, MySQL\r\n\r\nFeatures: User auth, session handling, password hashing, two-factor authentication, account lockout mechanism', 'Bachelor of Cybersecurity\r\nPrincess Sumaya University for Technology\r\nAmman, Jordan\r\nExpected Graduation: 2027');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resumes`
--
ALTER TABLE `resumes`
  ADD PRIMARY KEY (`resume_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resumes`
--
ALTER TABLE `resumes`
  MODIFY `resume_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `resumes`
--
ALTER TABLE `resumes`
  ADD CONSTRAINT `resumes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
