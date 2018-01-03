-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 03, 2018 at 01:28 AM
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
(1, 500, 25);

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
(1, 'Apple Inc', '2018-01-02', 1500, 'Programmer', 25);

-- --------------------------------------------------------

--
-- Table structure for table `recurring_montly_bills`
--

CREATE TABLE `recurring_montly_bills` (
  `id_montly_bills` int(11) NOT NULL,
  `recurring_date` date NOT NULL,
  `category` enum('Phone','Internet','Electricity','Water','Gas','Mortgage','Car Payment') NOT NULL,
  `amount` int(10) NOT NULL,
  `description` varchar(256) NOT NULL,
  `id_user` int(11) NOT NULL,
  `active` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recurring_montly_bills`
--

INSERT INTO `recurring_montly_bills` (`id_montly_bills`, `recurring_date`, `category`, `amount`, `description`, `id_user`, `active`) VALUES
(1, '2018-01-18', 'Electricity', 200, 'Update', 25, '0');

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
(1, '2018-01-02', 'Phone', 200, 25),
(2, '2018-01-01', 'Internet', 200, 25),
(3, '2018-01-01', 'Electricity', 200, 25),
(4, '2018-01-01', 'Water', 200, 25),
(5, '2018-01-02', 'Mortgage', 200, 25),
(6, '2018-01-02', 'Car Payment', 200, 25),
(10, '2017-12-12', 'Phone', 50, 25),
(11, '2017-12-12', 'Internet', 100, 25),
(12, '2017-12-12', 'Car Payment', 70, 25),
(13, '2017-12-12', 'Electricity', 30, 25),
(14, '2017-12-12', 'Water', 40, 25),
(15, '2018-01-03', 'Electricity', 200, 25);

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
  `reg_key` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `full_name`, `password`, `email`, `phone_number`, `location_city`, `location_country`, `picture`, `active`, `reg_key`) VALUES
(25, 'Stefan Stantic', '466df5db9a7e78582bcacc7fe00f42b4a589f764', 'vts.stefan.stanic@gmail.com', '0631562676', 'Subotica', 'Serbia', 'viber_image1.jpg', '1', 'c86042093ad9e7822db40cd559198599');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id_budget`),
  ADD KEY `id_user` (`id_user`);

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
  ADD KEY `id_user` (`id_user`);

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
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id_budget` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `my_income`
--
ALTER TABLE `my_income`
  MODIFY `id_my_income` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `recurring_montly_bills`
--
ALTER TABLE `recurring_montly_bills`
  MODIFY `id_montly_bills` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
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
