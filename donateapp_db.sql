-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2022 at 06:32 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donateapp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `merchant_ref` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `payment_name` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `amount_received` varchar(255) NOT NULL,
  `checkout_url` varchar(255) NOT NULL,
  `invoice_url` varchar(255) NOT NULL,
  `msgs` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `private` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `reference`, `merchant_ref`, `customer_name`, `customer_email`, `customer_phone`, `payment_name`, `amount`, `amount_received`, `checkout_url`, `invoice_url`, `msgs`, `status`, `private`, `created_at`, `updated_at`) VALUES
(20, 'DEV-T1174062377O2C1C', 'INV97403', 'Alwi', 'ztgsk8@gmail.com', '081249397403', 'QRIS (Customizable)', '25000', '24025', 'https://tripay.co.id/checkout/DEV-T1174062377O2C1C', 'http://localhost:5555//inv/DEV-T1174062377O2C1C', 'Semangat mas', 'PAID', 'yes', '2022-10-01 09:15:45', '2022-10-02 16:31:19'),
(21, 'DEV-T1174062380TX1PV', 'INV90889', 'Arfy', 'nauf@gmail.com', '081278690889', 'QRIS (Customizable)', '200000', '197800', 'https://tripay.co.id/checkout/DEV-T1174062380TX1PV', 'http://localhost:5555//inv/DEV-T1174062380TX1PV', 'nih200k huhuy', 'PAID', 'no', '2022-10-01 10:06:29', '2022-10-02 16:27:21'),
(22, 'DEV-T1174062381NEIFU', 'INV80499', 'Pace', 'nauf@gmail.com', '081232280499', 'QRIS (Customizable)', '200000', '197800', 'https://tripay.co.id/checkout/DEV-T1174062381NEIFU', 'http://localhost:5555//inv/DEV-T1174062381NEIFU', 'main fallguys dong', 'PAID', 'no', '2022-10-01 10:06:39', '2022-10-02 16:26:30'),
(23, 'DEV-T11740623821VUA2', 'INV74362', 'Komodo', 'nauf@gmail.com', '081243074362', 'QRIS (Customizable)', '200000', '197800', 'https://tripay.co.id/checkout/DEV-T11740623821VUA2', 'http://localhost:5555//inv/DEV-T11740623821VUA2', 'a keong a keong a keong', 'PAID', 'no', '2022-10-01 10:06:52', '2022-10-02 16:27:56'),
(24, 'DEV-T11740623831FGHZ', 'INV86185', 'Ahmad', 'dasdasd@asdasd.com', '081245786185', 'QRIS (Customizable)', '200000', '197800', 'https://tripay.co.id/checkout/DEV-T11740623831FGHZ', 'http://localhost:5555//inv/DEV-T11740623831FGHZ', 'gaskeun lah', 'PAID', 'no', '2022-10-01 10:07:17', '2022-10-02 16:28:39'),
(25, 'DEV-T1174062384SRAJB', 'INV75915', 'Ahmad', 'dasdasd@asdasd.com', '081213475915', 'QRIS (Customizable)', '200000', '197800', 'https://tripay.co.id/checkout/DEV-T1174062384SRAJB', 'http://localhost:5555//inv/DEV-T1174062384SRAJB', 'Kali lagi nih', 'UNPAID', 'no', '2022-10-01 10:07:25', '2022-10-02 16:29:55'),
(26, 'DEV-T11740623859NYUA', 'INV07115', 'Jul', 'nauf@gmail.com', '081223707115', 'QRIS (Customizable)', '25000', '24025', 'https://tripay.co.id/checkout/DEV-T11740623859NYUA', 'http://localhost:5555//inv/DEV-T11740623859NYUA', 'lanjut semangat', 'PAID', 'no', '2022-10-01 10:41:26', '2022-10-02 16:30:48'),
(27, 'DEV-T1174062401QKDYB', 'INV92282', 'Arfy', 'nauf@na.com', '081271292282', 'QRIS by ShopeePay', '25000', '24075', 'https://tripay.co.id/checkout/DEV-T1174062401QKDYB', 'http://localhost:5555//inv/DEV-T1174062401QKDYB', 'Stream ngoding dong kak', 'PAID', 'no', '2022-10-01 15:45:51', '2022-10-02 16:30:18'),
(28, 'DEV-T1174062402EVYGK', 'INV14076', 'Komodo', 'ztgasa@gmail.com', '081238714076', 'QRIS', '10000', '9180', 'https://tripay.co.id/checkout/DEV-T1174062402EVYGK', 'http://localhost:5555//inv/DEV-T1174062402EVYGK', 'Oalah malah streaming', 'PAID', 'no', '2022-10-01 15:46:21', '2022-10-02 16:29:47'),
(29, 'DEV-T1174062473GD7BA', 'INV22345', 'Seseorang', 'pace@dean.com', '081294322345', 'QRIS (Customizable)', '300000', '297100', 'https://tripay.co.id/checkout/DEV-T1174062473GD7BA', 'http://localhost:5555//inv/DEV-T1174062473GD7BA', 'Buat nasi uduk', 'PAID', 'yes', '2022-10-02 15:50:24', '2022-10-02 16:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `merchant_code` varchar(255) NOT NULL,
  `merchant_api_key` varchar(255) NOT NULL,
  `merchant_private_key` varchar(255) NOT NULL,
  `endpoint` varchar(255) NOT NULL,
  `pusher_app_id` varchar(255) NOT NULL,
  `pusher_key` varchar(255) NOT NULL,
  `pusher_secret` varchar(255) NOT NULL,
  `pusher_cluster` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `merchant_code`, `merchant_api_key`, `merchant_private_key`, `endpoint`, `pusher_app_id`, `pusher_key`, `pusher_secret`, `pusher_cluster`) VALUES
(1, 'T11740', 'DEV-j0Gtd4IlF4iANSM4IwNo3lqvRpYu7O3hEPM4ZxeU', 'QAO5B-4R17j-e61Oj-pni51-grQX1', 'api-sandbox', '1421297', '47518eb50b0b7117561d', '6039144a4ab736575e49', 'ap1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `ig` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `yt` varchar(255) NOT NULL,
  `twitch` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `github` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `roles`, `fb`, `ig`, `linkedin`, `yt`, `twitch`, `twitter`, `github`, `created_at`) VALUES
(1, 'Kyaaaa', 'kyaaaa', 'demo@demo.com', '$2y$10$HKSdf05cvIYrdzbuiALWdevR6/rJ9ce86XoN1FL7buhIhSCZxvwRS', '1', '', '', '', 'https://youtube.com', '', '', 'https://github.com/naufkia', '2022-06-08 02:36:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
