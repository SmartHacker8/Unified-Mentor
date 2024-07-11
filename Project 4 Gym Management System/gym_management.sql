-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2024 at 12:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `member_id`, `amount`, `date`) VALUES
(3, 1, '100.50', '2024-07-15'),
(4, 2, '150.75', '2024-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `diet_details`
--

CREATE TABLE `diet_details` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `details` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diet_details`
--

INSERT INTO `diet_details` (`id`, `member_id`, `details`, `date`) VALUES
(1, 1, 'High protein diet', '2024-07-15'),
(2, 2, 'Low carb diet', '2024-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `fee_packages`
--

CREATE TABLE `fee_packages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fee_packages`
--

INSERT INTO `fee_packages` (`id`, `name`, `amount`) VALUES
(1, 'Standard', '50.00'),
(2, 'Premium', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `fee_package_id` int(11) DEFAULT NULL,
  `join_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `phone`, `address`, `fee_package_id`, `join_date`) VALUES
(1, 'John Doe', 'john.doe@example.com', '1234567890', '123 Main St', 1, NULL),
(2, 'Jane Smith', 'jane.smith@example.com', '9876543210', '456 Oak Ave', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `member_id`, `message`, `date`) VALUES
(1, 1, 'Reminder: Gym session tomorrow at 5 PM', '2024-07-15'),
(2, 2, 'New fitness class schedule available', '2024-07-16'),
(3, 2, 'Hii', '2024-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `supplement_store`
--

CREATE TABLE `supplement_store` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplement_store`
--

INSERT INTO `supplement_store` (`id`, `name`, `description`, `price`) VALUES
(1, 'Protein Powder', 'Whey protein powder for muscle recovery', '29.99'),
(2, 'Multivitamin Tablets', 'Daily multivitamin supplement', '19.99');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','member','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin'),
(2, 'member1@gmail.com', 'password1', 'member'),
(3, 'member2@gmail.com', 'password2', 'member'),
(4, 'user1@gmail.com', 'password1', 'user'),
(5, 'user2@gmail.com', 'password2', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `diet_details`
--
ALTER TABLE `diet_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `fee_packages`
--
ALTER TABLE `fee_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_package_id` (`fee_package_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `supplement_store`
--
ALTER TABLE `supplement_store`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `diet_details`
--
ALTER TABLE `diet_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fee_packages`
--
ALTER TABLE `fee_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplement_store`
--
ALTER TABLE `supplement_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `diet_details`
--
ALTER TABLE `diet_details`
  ADD CONSTRAINT `diet_details_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`fee_package_id`) REFERENCES `fee_packages` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
