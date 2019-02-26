-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2019 at 09:43 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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
  `Name` text NOT NULL,
  `Type` set('S','F') NOT NULL DEFAULT 'S',
  `R1` date NOT NULL,
  `R2` date NOT NULL,
  `R3` date NOT NULL,
  `R4` date NOT NULL,
  `R5` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`CompID`, `Name`, `Type`, `R1`, `R2`, `R3`, `R4`, `R5`) VALUES
(2, 'Comp 1', 'S', '2018-08-02', '2018-08-03', '2018-08-04', '2018-08-05', '2018-12-14'),
(3, 'Comp 2', 'S', '2018-08-05', '2018-08-06', '2018-08-07', '2018-08-08', '2018-08-09'),
(4, 'Comp 3', 'S', '2018-07-31', '2018-08-01', '2018-08-02', '2018-08-03', '2018-08-04'),
(5, 'Test Competition', 'S', '2018-12-10', '2018-12-11', '2018-12-13', '2018-12-14', '2018-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `identifier` int(11) NOT NULL,
  `PassHash` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`identifier`, `PassHash`) VALUES
(1, '804f50ddbaab7f28c933a95c162d019acbf96afde56dba10e4c7dfcfe453dec4bacf5e78b1ddbdc1695a793bcb5d7d409425db4cc3370e71c4965e4ef992e8c4');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `ID` int(11) NOT NULL,
  `HouseName` tinytext NOT NULL,
  `ShortHouse` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`ID`, `HouseName`, `ShortHouse`) VALUES
(3, 'Laxton', 'Lx'),
(4, 'Bramston', 'B'),
(5, 'Laundimer', 'Ldr'),
(7, 'St Anthony', 'StA'),
(8, 'Sidney', 'S'),
(9, 'Crosby', 'C'),
(10, 'Fisher', 'F'),
(11, 'Grafton', 'G'),
(12, 'Kirkeby', 'K'),
(13, 'New House', 'N'),
(14, 'Dryden', 'D'),
(15, 'Sanderson', 'Sn'),
(16, 'Wyatt', 'W'),
(17, 'School House', 'Sc');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `UserID` int(11) NOT NULL,
  `FirstName` mediumtext NOT NULL,
  `Surname` mediumtext NOT NULL,
  `House` set('Lx','B','Ldr','StA','S','C','F','G','K','N','D','Sn','W','Sc') NOT NULL,
  `Year` set('3','4','5','L6','U6') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`UserID`, `FirstName`, `Surname`, `House`, `Year`) VALUES
(1, 'Dominic', 'Martin', 'Lx', 'U6'),
(2, 'Toby', 'Dixon Smith', 'G', 'U6'),
(3, 'George', 'Godwin-Austen', 'Ldr', '4'),
(4, 'Nathan', 'Chu', 'B', 'L6'),
(5, 'Emma', 'Bruce Gardyne', 'N', 'U6'),
(6, 'Harry', 'James', 'Lx', 'U6'),
(7, 'Test', 'Person', 'Lx', 'U6');

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
  `Type` set('S','F') NOT NULL,
  `Target` set('2','5','10','300','500','600') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`ScoreID`, `UserID`, `CompID`, `Date`, `Score`, `Type`, `Target`) VALUES
(2, 1, 0, '2018-07-26', '99', 'S', '5'),
(3, 2, 0, '2018-07-26', '98', 'S', '5'),
(4, 3, 0, '2018-07-26', '97', 'S', '5'),
(5, 4, 0, '2018-07-26', '96', 'S', '5'),
(6, 5, 0, '2018-07-26', '80', 'S', '5'),
(7, 1, 1, '2018-08-19', '88', 'S', '5'),
(8, 6, 0, '2018-10-29', '100', 'S', '10'),
(9, 6, 0, '2018-10-29', '99', 'S', '10'),
(10, 6, 0, '2018-10-29', '100', 'S', '10'),
(11, 2, 0, '2018-11-03', '99', 'S', '10'),
(12, 5, 0, '1970-01-01', '90', 'S', '5'),
(13, 7, 0, '2018-12-13', '96', '', '5');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `UserID` int(11) NOT NULL,
  `CompID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`CompID`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `CompID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `ScoreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
