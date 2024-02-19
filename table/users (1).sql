-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 09:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `awc_res_1`
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', NULL, '$2y$10$zEtu.lHZKPiP/K0j5AiTX.MNpsU0fWihi7093saP8bEUkQiFTa.iq', NULL, '2023-10-05 12:43:57', '2023-10-06 08:11:23', NULL),
(2, 'Mostak Ahmed', 'mostak@gmail.com', 'Admin', NULL, '$2y$10$zEtu.lHZKPiP/K0j5AiTX.MNpsU0fWihi7093saP8bEUkQiFTa.iq', NULL, '2023-10-05 12:45:32', '2023-10-14 10:36:10', NULL),
(3, 'User', 'user2@gmail.com', 'user2', NULL, '$2y$10$J6pKq9NNOeq1wXSgU85mPu8cyo0o1783mXXdy2kcTLLYynUpZ.Hry', NULL, '2023-10-06 08:25:47', '2023-10-19 09:38:38', NULL),
(5, 'ser1', 'user1@gmail.com', '', NULL, '$2y$10$qTDb3fxhL3a6CSDh1nGAWuUgw.ctzdnQcxDw/6r/I6WQAtPlqBsLy', NULL, '2023-10-13 10:19:50', '2023-10-13 10:19:50', NULL),
(6, 'Hasan Mahmud', 'hasan@gmail.com', '', NULL, '$2y$10$/Z0na8kJSavDbgqGU3/sveAgQjNCCIDI0Xrj0p.bqlLpwHLIx2yEa', NULL, '2023-10-14 05:06:35', '2023-10-14 05:06:35', NULL),
(7, 'User Customer 03', 'user3@gmail.com', 'user3', NULL, '$2y$10$BWshUWtYx8MYOXhNAKYq6..lAa3tq/9xVtgjR7LlgWaksK3/QxW02', NULL, '2023-10-14 05:09:13', '2023-10-16 09:53:58', NULL),
(8, 'User Customer 04', 'user4@gmail.com', 'user4', NULL, '$2y$10$ODpYSL/eXy3eNDYVsU1yq.QRmE1vkFHMgTI84VNfO5k5YGM1YGaSO', NULL, '2023-10-14 05:39:43', '2023-10-16 09:53:44', NULL),
(9, 'User Customer 05', 'user5@gmail.com', 'User5', NULL, '$2y$10$rgG71SrT9UiBEtqoW43LL.vzH/EH6mwttBb7pQT/aXolnXyKxnMPi', NULL, '2023-10-14 06:04:27', '2023-10-17 16:41:11', NULL),
(10, 'User 7', 'user7@gmail.com', 'user7', NULL, '$2y$10$n99CMQEFzwH1.ZAT4Vy25uBbcS5.DNGLL4JY0KOK0ujxLd3XJl33m', NULL, '2023-10-19 10:47:56', '2023-10-19 10:47:56', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
