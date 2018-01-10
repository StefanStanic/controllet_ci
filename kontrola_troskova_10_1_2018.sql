-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 10, 2018 at 11:07 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kontrola_troskova`
--
CREATE DATABASE IF NOT EXISTS `kontrola_troskova` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `kontrola_troskova`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id_budget` int(11) NOT NULL,
  `budget_amount` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id_budget`, `budget_amount`, `id_user`) VALUES
(1, 115, 27);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `category_name`) VALUES
(6, 'Car payment'),
(2, 'Electricity'),
(5, 'Internet'),
(3, 'Mortgage'),
(4, 'Phone'),
(1, 'Water');

-- --------------------------------------------------------

--
-- Table structure for table `my_income`
--

CREATE TABLE `my_income` (
  `id_my_income` int(11) NOT NULL,
  `company` varchar(100) NOT NULL,
  `date_of_monthly_income` date NOT NULL,
  `amount_of_monthly_income` int(10) NOT NULL,
  `job_category` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `my_income`
--

INSERT INTO `my_income` (`id_my_income`, `company`, `date_of_monthly_income`, `amount_of_monthly_income`, `job_category`, `id_user`) VALUES
(1, 'Apple Inc', '2018-01-09', 200, 'Programmer', 27);

-- --------------------------------------------------------

--
-- Table structure for table `recurring_montly_bills`
--

CREATE TABLE `recurring_montly_bills` (
  `id_montly_bills` int(11) NOT NULL,
  `recurring_date` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `amount` int(10) NOT NULL,
  `description` varchar(256) NOT NULL,
  `id_user` int(11) NOT NULL,
  `active` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int(11) NOT NULL,
  `date_of_transaction` date NOT NULL,
  `category` varchar(100) NOT NULL,
  `transaction_amount` int(10) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id_transaction`, `date_of_transaction`, `category`, `transaction_amount`, `id_user`) VALUES
(1, '2018-01-09', '1', 10, 27),
(2, '2018-01-09', '1', 10, 27),
(3, '2018-01-09', '1', 10, 27),
(4, '2018-01-09', '1', 10, 27),
(5, '2018-01-09', '1', 10, 27),
(6, '2018-01-09', '3', 15, 27),
(7, '2018-01-10', '9', 20, 27);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `full_name` char(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `location_city` char(100) NOT NULL,
  `location_country` char(100) NOT NULL,
  `picture` varchar(256) DEFAULT NULL,
  `active` enum('0','1') NOT NULL,
  `reg_key` varchar(150) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `full_name`, `password`, `email`, `phone_number`, `location_city`, `location_country`, `picture`, `active`, `reg_key`, `token`) VALUES
(27, 'Stefan Stanic', '466df5db9a7e78582bcacc7fe00f42b4a589f764', 'vts.stefan.stanic@gmail.com', '0631562676', 'Subotica', 'Serbia', 'viber_image3.jpg', '1', '2ece04fce8c917cba3d2447bb5f680f6', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id_budget`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `my_income`
--
ALTER TABLE `my_income`
  ADD PRIMARY KEY (`id_my_income`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `recurring_montly_bills`
--
ALTER TABLE `recurring_montly_bills`
  ADD PRIMARY KEY (`id_montly_bills`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id_budget` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `my_income`
--
ALTER TABLE `my_income`
  MODIFY `id_my_income` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `recurring_montly_bills`
--
ALTER TABLE `recurring_montly_bills`
  MODIFY `id_montly_bills` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `my_income`
--
ALTER TABLE `my_income`
  ADD CONSTRAINT `my_income_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recurring_montly_bills`
--
ALTER TABLE `recurring_montly_bills`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recurring_montly_bills_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `monthly_reccuring_bill_check` ON SCHEDULE EVERY 1 MONTH STARTS '2018-01-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE recurring_montly_bills SET active=1$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
