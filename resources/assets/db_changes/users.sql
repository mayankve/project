-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2018 at 03:20 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aat_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` int(15) DEFAULT NULL,
  `is_passport` int(11) DEFAULT NULL,
  `passport_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_exp_date` date DEFAULT NULL,
  `issuing_country` int(11) DEFAULT NULL,
  `country_of_Birth` int(11) DEFAULT NULL,
  `type` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `first_name`, `last_name`, `gender`, `dob`, `phone`, `is_passport`, `passport_pic`, `passport_exp_date`, `issuing_country`, `country_of_Birth`, `type`, `created_at`, `updated_at`, `is_deleted`, `remember_token`) VALUES
(1, 'Admin', 'admin@aat.com', '$2y$10$Ap86Tl3n3ykUjzpNacheF.Clf3KzZXRUGqU.mE3Cd/vP1eOxPH3dW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 2, '1', '2018-05-02 11:38:17', '2018-05-04 11:43:23', '0', '6KTneWIQsQxhlwvaYgKH7ml4yXTo2kq5uhzshjdzWjWi8kNGTy11rvchoxYH'),
(2, 'Mayank', 'mayank@aat.com', '$2y$10$uj28p7k/UTt1RD4KfqVk4.rAdr.FLPO.Z2818jcUOEuttszU.8aqe', 'mayank', 'pandey', '1', '1988-05-07', NULL, 1, '5ktYph17kN.jpg', '2018-05-31', 1, 1, '1', '2018-05-02 11:38:38', '2018-05-04 01:37:23', '0', NULL),
(3, 'Niwedita', 'niwedita@aat.com', '$2y$10$S4eBKL6rpGOREiPifZrEP.P31QnWfYe8/c6HDHFXZBuFvmKTV04G.', 'Niwedita', 'Jaysawal', '2', '1993-06-05', NULL, 1, 'HTLlC3AFul.jpg', '2018-05-25', 1, 2, '1', '2018-05-02 11:39:11', '2018-05-04 06:33:37', '0', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
