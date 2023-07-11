-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 01:10 PM
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
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `staff_id` varchar(50) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `days_requested` int(2) NOT NULL,
  `date_applied` date NOT NULL,
  `leave_status` varchar(30) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`staff_id`, `leave_type`, `start_date`, `end_date`, `days_requested`, `date_applied`, `leave_status`) VALUES
('walidikowero@gmail.com', 'Newest', '2023-07-05', '2023-07-12', 1, '2023-07-11', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `leave_statistics`
--

CREATE TABLE `leave_statistics` (
  `staff_id` varchar(50) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `maximum_leaves` int(2) NOT NULL,
  `leaves_taken` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_statistics`
--

INSERT INTO `leave_statistics` (`staff_id`, `leave_type`, `maximum_leaves`, `leaves_taken`) VALUES
('abuyako@gmail.com', 'New', 10, 0),
('abuyako@gmail.com', 'Newest', 15, 0),
('abuyako@gmail.com', 'Sick Leave', 10, 0),
('abuyako@gmail.com', 'Weekend Leave', 10, 0),
('walidikowero@gmail.com', 'New', 10, 0),
('walidikowero@gmail.com', 'Newest', 15, 0),
('walidikowero@gmail.com', 'Sick Leave', 10, 0),
('walidikowero@gmail.com', 'Weekend Leave', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `leave_type` varchar(50) NOT NULL,
  `no_of_days` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`leave_type`, `no_of_days`) VALUES
('New', 10),
('Newest', 15),
('Sick Leave', 10),
('Weekend Leave', 10);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `password`, `user_type`) VALUES
('abuyako@gmail.com', 'abuu', 'PC'),
('admin@gmail.com', 'pass', 'admin'),
('walidikowero@gmail.com', 'walidi', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `first_name`, `middle_name`, `last_name`) VALUES
('abuyako@gmail.com', 'abubakari', 'yasini', 'kowero'),
('walidikowero@gmail.com', 'waliki', 'waziri', 'kowero');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`staff_id`,`start_date`,`end_date`);

--
-- Indexes for table `leave_statistics`
--
ALTER TABLE `leave_statistics`
  ADD PRIMARY KEY (`staff_id`,`leave_type`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`leave_type`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`,`user_type`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
