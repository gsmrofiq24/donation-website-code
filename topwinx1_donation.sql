-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2025 at 06:02 PM
-- Server version: 10.11.13-MariaDB
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `topwinx1_donation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `message` text DEFAULT NULL,
  `trx_id` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `seen` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `name`, `mobile`, `email`, `amount`, `message`, `trx_id`, `status`, `created_at`, `seen`) VALUES
(1, 'Rofiq', '01724357677', 'gsm@gmail.com', 1.00, '', 'CG13CA9HCD', 'Pending', '2025-07-01 13:18:18', 0),
(2, 'Rofiq', '01724357677', 'gsm@gmail.com', 1.00, '', 'CG13CBSJA3', 'Pending', '2025-07-01 13:53:34', 0),
(3, 'Rofiq', '01724357677', 'gsm@gmail.com', 1.00, '', 'CG19CGZB7N', 'Pending', '2025-07-01 16:15:10', 0),
(4, 'Test', '01724357677', 'gsm@gmail.com', 1.00, '', 'CG12CH2BV4', 'Pending', '2025-07-01 16:17:53', 0),
(5, 'Rofiqul ', '01724357677', 'tanhacomputer1@gmail.com', 1.00, '', 'CG18CI0OGS', 'Pending', '2025-07-01 16:53:31', 0),
(6, 'Rofiqul ', '01724357677', 'tanhacomputer1@gmail.com', 1.00, '', 'CG16CI34X6', 'Pending', '2025-07-01 16:56:56', 0),
(7, 'Rofiqul ', '01724357677', 'tanhacomputer1@gmail.com', 1.00, '', 'CG18CIBKWU', 'Approved', '2025-07-01 17:07:22', 0),
(8, 'Test', '01724357677', 'gsmrofiq9@gmail.com', 1.00, '', 'CG13CJ1KXD', 'Pending', '2025-07-01 17:45:28', 0),
(9, 'Test', '01724357677', 'gsmrofiq9@gmail.com', 1.00, '', 'CG13CJ3X6P', 'Pending', '2025-07-01 17:48:17', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
