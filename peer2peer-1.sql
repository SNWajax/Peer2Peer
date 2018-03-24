-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2018 at 06:08 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1


--
-- Database: `peer2peer`
--

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `uID` int(10) NOT NULL,
  `itemID` int(10) NOT NULL,
  `qty` int(2) NOT NULL,
  `location` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donationcatergory`
--

CREATE TABLE `donationcatergory` (
  `itemID` int(10) NOT NULL,
  `itemType` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donationclothing`
--

CREATE TABLE `donationclothing` (
  `itemID` int(10) NOT NULL,
  `name` varchar(25) NOT NULL,
  `size` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donationfood`
--

CREATE TABLE `donationfood` (
  `itemID` int(10) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donationmisc`
--

CREATE TABLE `donationmisc` (
  `itemID` int(10) NOT NULL,
  `itemName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uID` int(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `uPass` varchar(255) NOT NULL,
  `fName` varchar(25) NOT NULL,
  `lName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uID`, `email`, `uPass`, `fName`, `lName`) VALUES
(3, 'rzhang8277@bths.edu', '$2y$10$/2bsPo2gXXC4tx2txXe9E.4ZPSBeLid/mXSE8xwG8t8YChZYSZESG', 'test', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`uID`,`itemID`,`location`);

--
-- Indexes for table `donationcatergory`
--
ALTER TABLE `donationcatergory`
  ADD PRIMARY KEY (`itemID`,`itemType`);

--
-- Indexes for table `donationfood`
--
ALTER TABLE `donationfood`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `fk_users_uID` FOREIGN KEY (`uID`) REFERENCES `users` (`uID`);

