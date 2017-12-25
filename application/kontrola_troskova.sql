-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 25, 2017 at 10:30 AM
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
  `category` varchar(100) NOT NULL,
  `budget_amount` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `my_income`
--

CREATE TABLE `my_income` (
  `id_my_income` int(11) NOT NULL,
  `company` varchar(100) NOT NULL,
  `date_of_monthly_income` date NOT NULL,
  `amount_of_monthly income` int(10) NOT NULL,
  `taxes_per_year` int(2) NOT NULL,
  `job_category` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `recurring_montly_bills`
--

CREATE TABLE `recurring_montly_bills` (
  `id_montly_bills` int(11) NOT NULL,
  `recurring_date` date NOT NULL,
  `category` varchar(100) NOT NULL,
  `amount` int(10) NOT NULL,
  `description` varchar(256) NOT NULL,
  `id_user` int(11) NOT NULL
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
  `active` enum('0','1') NOT NULL,
  `reg_key` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `full_name`, `password`, `email`, `phone_number`, `location_city`, `location_country`, `active`, `reg_key`) VALUES
(10, 'Stefan Stanic', '466df5db9a7e78582bcacc7fe00f42b4a589f764', 'vts.stefan.stanic@gmail.com', '063156276', 'Subotica', 'Serbia', '1', '6d889d57c766dd95220dfbdb6093bd83'),
(11, 'Stefan Stanic', '466df5db9a7e78582bcacc7fe00f42b4a589f764', 'stefo1@live.com', '3592780632398002', 'nesto', 'nesto', '1', '84c02676b60c93f24c9a11354b7da727');

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
  MODIFY `id_budget` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `my_income`
--
ALTER TABLE `my_income`
  MODIFY `id_my_income` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recurring_montly_bills`
--
ALTER TABLE `recurring_montly_bills`
  MODIFY `id_montly_bills` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
