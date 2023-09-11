-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 12:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate_details`
--

CREATE TABLE `candidate_details` (
  `id` int(11) NOT NULL,
  `election_id` int(11) DEFAULT NULL,
  `candidate_name` varchar(255) NOT NULL,
  `candidate_details` text DEFAULT NULL,
  `candidate_photo` text DEFAULT NULL,
  `inserted_by` varchar(255) DEFAULT NULL,
  `inserted_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidate_details`
--

INSERT INTO `candidate_details` (`id`, `election_id`, `candidate_name`, `candidate_details`, `candidate_photo`, `inserted_by`, `inserted_on`) VALUES
(15, 7, 'xyz', 'classess', 'Images/candidate_photo/1058448415_1036221070ITech.png', 'tt', '2023-09-10'),
(18, 12, 'asf', 'mansdb', 'Images/candidate_photo/photo.jpg', 'tt', '2023-09-11');

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `id` int(11) NOT NULL,
  `election_topic` varchar(255) DEFAULT NULL,
  `no_of_candidates` int(11) DEFAULT NULL,
  `starting_date` date DEFAULT NULL,
  `ending_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `inserted_by` varchar(255) NOT NULL,
  `insertd_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `election_topic`, `no_of_candidates`, `starting_date`, `ending_date`, `status`, `inserted_by`, `insertd_on`) VALUES
(7, 'abc', 1, '2023-09-09', '2023-09-11', 'Expired', 'tt', '2023-09-10'),
(8, 'New Election', 22, '2023-09-12', '2023-09-17', 'Expired', 'tt', '2023-09-10'),
(12, 'volunteer', 2, '2023-09-11', '2023-09-14', 'Active', 'tt', '2023-09-11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `contact` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `contact`, `password`, `user_role`) VALUES
(1, 'abc', '111', '12', '12'),
(2, '222', '22', '22', 'voter'),
(3, '444', '11', '11', 'voter'),
(4, 'sc', '455', '32', 'voter'),
(5, 'ab', '222', '66', 'voter'),
(6, 'aa', '125', '7b52009b64f', 'voter'),
(7, 'tt', '0333', 'bd307a3ec32', 'voter'),
(8, 'ds', '0312', 'b1d5781111d', 'voter'),
(9, 'cc', '11', '17ba0791499db908433b80f37c5fbc89b870084b', 'voter'),
(10, 'tt', '00', 'fb96549631c835eb239cd614cc6b5cb7d295121a', 'Admin'),
(11, 'aaa', '124', '12c6fc06c99a462375eeb3f43dfd832b08ca9e17', 'voter'),
(12, 'www', '111', '17ba0791499db908433b80f37c5fbc89b870084b', 'voter'),
(13, 'sss', '4444', '98fbc42faedc02492397cb5962ea3a3ffc0a9243', 'voter'),
(14, '888', '88', 'b37f6ddcefad7e8657837d3177f9ef2462f98acf', 'voter'),
(15, 'sss', '1', '356a192b7913b04c54574d18c28d46e6395428ab', 'voter');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id` int(11) NOT NULL,
  `election_id` int(11) DEFAULT NULL,
  `voters_id` int(11) DEFAULT NULL,
  `candidate_id` int(11) NOT NULL,
  `vote_date` date DEFAULT NULL,
  `vote_timing` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`id`, `election_id`, `voters_id`, `candidate_id`, `vote_date`, `vote_timing`) VALUES
(2, 2, 11, 10, '2023-09-10', '09:23:52'),
(3, 2, 11, 10, '2023-09-10', '09:50:07'),
(4, 7, 1, 13, '2023-09-10', '10:10:22'),
(5, 7, 13, 14, '2023-09-10', '10:10:59'),
(6, 7, 14, 15, '2023-09-10', '10:13:11'),
(7, 12, 15, 18, '2023-09-11', '06:29:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate_details`
--
ALTER TABLE `candidate_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate_details`
--
ALTER TABLE `candidate_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
