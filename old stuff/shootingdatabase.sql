-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2018 at 02:28 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shootingdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `CompID` int(11) NOT NULL,
  `Name` text COLLATE latin1_general_cs NOT NULL,
  `Type` set('S','F') COLLATE latin1_general_cs NOT NULL DEFAULT 'S',
  `R1` date NOT NULL,
  `R2` date NOT NULL,
  `R3` date NOT NULL,
  `R4` date NOT NULL,
  `R5` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`CompID`, `Name`, `Type`, `R1`, `R2`, `R3`, `R4`, `R5`) VALUES
(2, 'Comp 1', 'S', '2018-08-02', '2018-08-03', '2018-08-04', '2018-08-05', '2018-08-06'),
(3, 'Comp 2', 'S', '2018-08-05', '2018-08-06', '2018-08-07', '2018-08-08', '2018-08-09'),
(4, 'Comp 3', 'S', '2018-07-31', '2018-08-01', '2018-08-02', '2018-08-03', '2018-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `UserID` int(11) NOT NULL,
  `FirstName` text COLLATE latin1_general_cs NOT NULL,
  `Surname` text COLLATE latin1_general_cs NOT NULL,
  `House` set('Lx','B','Ldr','StA','S','C','F','G','K','N','D','Sn','W','Sc') COLLATE latin1_general_cs NOT NULL,
  `Year` set('3','4','5','L6','U6') COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`UserID`, `FirstName`, `Surname`, `House`, `Year`) VALUES
(1, 'Dominic', 'Martin', 'Lx', 'U6'),
(2, 'Toby', 'Dixon Smith', 'G', 'U6'),
(3, 'George', 'Godwin-Austen', 'Ldr', '4'),
(4, 'Nathan', 'Chu', 'B', 'L6'),
(5, 'Emma', 'Bruce Gardyne', 'N', 'U6');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `ScoreID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CompID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Score` decimal(10,0) NOT NULL,
  `Type` set('S','F') COLLATE latin1_general_cs NOT NULL,
  `Target` set('2','5','10','300','500','600') COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`ScoreID`, `UserID`, `CompID`, `Date`, `Score`, `Type`, `Target`) VALUES
(2, 1, 0, '2018-07-26', '99', 'S', '5'),
(3, 2, 0, '2018-07-26', '98', 'S', '5'),
(4, 3, 0, '2018-07-26', '97', 'S', '5'),
(5, 4, 0, '2018-07-26', '96', 'S', '5'),
(6, 5, 0, '2018-07-26', '80', 'S', '5'),
(7, 1, 1, '2018-08-19', '88', 'S', '5');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `UserID` int(11) NOT NULL,
  `CompID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`CompID`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`ScoreID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `CompID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `ScoreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
