-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Feb 15, 2025 at 01:19 AM
-- Server version: 11.6.2-MariaDB-ubu2404
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assessment_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` enum('Admin','Employee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `name`, `username`, `password`, `email`, `type`) VALUES
(1231231, 'qqq', 'qqq', '$argon2id$v=19$m=65536,t=4,p=1$SE5EYk5uYnJYam93aW9zVQ$yENod54JEqkhM/DyzeB8taFKtZQdls6IQ8OLoCZfUBA', 'qqq', 'Admin'),
(1234512, 'bbb', 'bbb', '$argon2id$v=19$m=65536,t=4,p=1$SGRkYUZmWWg3MTFzT2xxVA$8+d6/odEBa04DbPOK91+vYIK8hRHetSWSth5KuMrHkw', 'bbbb@g.com', 'Employee'),
(1234563, 'eee', 'eee', '$argon2id$v=19$m=65536,t=4,p=1$c1NNdHlOMVpHM0dYUkRMdg$8hVBlZhWfGC1PggHqLVHz+Vy8+9/gi2gOezaB+Z9+bY', 'eee', 'Employee'),
(1234567, 'aaa', 'aaa', '$argon2id$v=19$m=65536,t=4,p=1$NC96WHNHNjJoTzUveVMvRg$2moEHHF9WxaD+NOqf8seO3z7NSIkgpeVnDRVzLeP/dw', 'aaa', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `Vacation_request`
--

CREATE TABLE `Vacation_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `requester_id` int(10) UNSIGNED NOT NULL,
  `date_submitted` date NOT NULL DEFAULT current_timestamp(),
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `reason` text NOT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Vacation_request`
--

INSERT INTO `Vacation_request` (`id`, `requester_id`, `date_submitted`, `date_from`, `date_to`, `reason`, `status`) VALUES
(2, 1234512, '2025-02-14', '2025-02-21', '2025-03-04', 'aha', 'Rejected'),
(3, 1234512, '2025-02-14', '2025-02-21', '2025-03-20', 'aha', 'Approved'),
(5, 1234512, '2025-02-14', '2025-02-15', '2025-02-18', 'aaaa', 'Rejected'),
(8, 1234512, '2025-02-14', '2025-02-27', '2025-03-01', 'qq', 'Approved'),
(12, 1234563, '2025-02-15', '2025-02-16', '2025-02-18', 'w', 'Pending'),
(13, 1234512, '2025-02-15', '2025-02-21', '2025-02-25', 'q', 'Pending'),
(14, 1234512, '2025-02-15', '2025-03-06', '2025-03-08', 'r', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `Vacation_request`
--
ALTER TABLE `Vacation_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk` (`requester_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Vacation_request`
--
ALTER TABLE `Vacation_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Vacation_request`
--
ALTER TABLE `Vacation_request`
  ADD CONSTRAINT `fk` FOREIGN KEY (`requester_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
