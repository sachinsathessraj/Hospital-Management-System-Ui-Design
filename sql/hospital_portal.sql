-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 09, 2024 at 06:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `bedbookings`
--

CREATE TABLE `bedbookings` (
  `booking_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `bed_id` int(11) DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bedbookings`
--

INSERT INTO `bedbookings` (`booking_id`, `patient_id`, `bed_id`, `booking_date`) VALUES
(3, 3, 3, '2024-10-07 13:49:06'),
(4, 3, 3, '2024-10-07 13:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `bedsavailability`
--

CREATE TABLE `bedsavailability` (
  `bed_id` int(11) NOT NULL,
  `ward_name` varchar(100) DEFAULT NULL,
  `room_number` varchar(50) DEFAULT NULL,
  `total_beds` int(11) NOT NULL,
  `available_beds` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bedsavailability`
--

INSERT INTO `bedsavailability` (`bed_id`, `ward_name`, `room_number`, `total_beds`, `available_beds`) VALUES
(3, '01', '02', 10, 7),
(4, '02', '03', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `operationtheatre`
--

CREATE TABLE `operationtheatre` (
  `theatre_id` int(11) NOT NULL,
  `theatre_name` varchar(255) DEFAULT NULL,
  `available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operationtheatre`
--

INSERT INTO `operationtheatre` (`theatre_id`, `theatre_name`, `available`) VALUES
(8, '002', 0);

-- --------------------------------------------------------

--
-- Table structure for table `operationtheatrebookings`
--

CREATE TABLE `operationtheatrebookings` (
  `booking_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `theatre_id` int(11) DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testresults`
--

CREATE TABLE `testresults` (
  `test_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `test_name` varchar(255) DEFAULT NULL,
  `test_value` varchar(255) DEFAULT NULL,
  `treatment_type` varchar(255) DEFAULT NULL,
  `test_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testresults`
--

INSERT INTO `testresults` (`test_id`, `patient_id`, `test_name`, `test_value`, `treatment_type`, `test_date`) VALUES
(1, 1, 'Complete Blood Count (CBC)', '50', 'Surgery', '2024-10-07'),
(2, 1, 'Complete Blood Count (CBC)', 'Low', 'Surgery', '2024-10-07'),
(3, 1, 'CBC with Absolute Counts', 'High', 'Cardiology', '2024-10-07'),
(4, 1, 'Complete Blood Count (CBC)', 'Low', 'Surgery', '2024-10-07'),
(5, 3, 'Complete Blood Count (CBC)', 'Low', 'Surgery', '2024-10-08'),
(6, 3, 'Complete Blood Count (CBC)', 'Low', 'Surgery', '2024-10-08'),
(7, 6, 'Complete Blood Count (CBC)', 'Normal', 'Cardiology', '2024-10-08'),
(8, 6, 'Complete Blood Count (CBC)', 'Low', 'Surgery', '2024-10-08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('patient','staff') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'nimal', 'nimalnadeson42@gmail.com', '$2y$10$h4nO0E3VFKDVe7bfvKZ6IOJPDZmgRZCxHtEta9EX.tC7m3cBYjYuC', 'patient', '2024-10-06 12:09:53'),
(2, 'lenin', 'lenin42@gmail.com', '$2y$10$Vv6CarCs6UgiH/5cKScqrOP.xuk6OdAnobEV.WVGWZj.zRtBZ3EJ2', 'staff', '2024-10-06 12:10:09'),
(3, 'sachin', 'sachin@gmail.com', '$2y$10$wvd4Bv2YWzn/QpkxE2yXa.zPzYYE1I6UtmdypzQ1nJoyV91GibbJq', 'patient', '2024-10-07 13:47:54'),
(4, 'ask', 'sachin@gmail.com', '$2y$10$QiL8HGzCXCQxOGTqZk/5xOecLI4Af2QPtL8RCKhNWApHiSTTCCwyu', 'staff', '2024-10-07 13:50:31'),
(5, 'hanujan', 'hanujan@gmail.com', '$2y$10$okEnkHoWoWd74PuvJn80Fe/vAKahlGKgiP7P/BFEtFVS8viVRI9W2', 'staff', '2024-10-08 18:59:20'),
(6, 'satheesrajsachin', 'satheesrajsachin111@gmail.com', '$2y$10$EW6UCzGAaHm8qtJqksRO9.kSReccOP7br51IsOsZR4fq7Yybjcj5m', 'patient', '2024-10-08 19:04:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bedbookings`
--
ALTER TABLE `bedbookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `bed_id` (`bed_id`);

--
-- Indexes for table `bedsavailability`
--
ALTER TABLE `bedsavailability`
  ADD PRIMARY KEY (`bed_id`);

--
-- Indexes for table `operationtheatre`
--
ALTER TABLE `operationtheatre`
  ADD PRIMARY KEY (`theatre_id`);

--
-- Indexes for table `operationtheatrebookings`
--
ALTER TABLE `operationtheatrebookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `theatre_id` (`theatre_id`);

--
-- Indexes for table `testresults`
--
ALTER TABLE `testresults`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `patient_id` (`patient_id`);

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
-- AUTO_INCREMENT for table `bedbookings`
--
ALTER TABLE `bedbookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bedsavailability`
--
ALTER TABLE `bedsavailability`
  MODIFY `bed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `operationtheatre`
--
ALTER TABLE `operationtheatre`
  MODIFY `theatre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `operationtheatrebookings`
--
ALTER TABLE `operationtheatrebookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testresults`
--
ALTER TABLE `testresults`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bedbookings`
--
ALTER TABLE `bedbookings`
  ADD CONSTRAINT `bedbookings_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bedbookings_ibfk_2` FOREIGN KEY (`bed_id`) REFERENCES `bedsavailability` (`bed_id`) ON DELETE CASCADE;

--
-- Constraints for table `operationtheatrebookings`
--
ALTER TABLE `operationtheatrebookings`
  ADD CONSTRAINT `operationtheatrebookings_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `operationtheatrebookings_ibfk_2` FOREIGN KEY (`theatre_id`) REFERENCES `operationtheatre` (`theatre_id`) ON DELETE CASCADE;

--
-- Constraints for table `testresults`
--
ALTER TABLE `testresults`
  ADD CONSTRAINT `testresults_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
