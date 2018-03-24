-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2018 at 08:28 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1


--
-- Database: `peer2peer`
--

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--
drop table `donation`;
CREATE TABLE `donation` (
  `uID` int(10) NOT NULL,
  `itemID` int(10) NOT NULL,
  `qty` int(2) NOT NULL,
  `Lng` decimal(18,15) NOT NULL,
  `Lat` decimal(18,15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`uID`, `itemID`, `qty`, `Lng`, `Lat`) VALUES
(3, 1, 1, '-73.985763608459480', '40.695472586567580');

-- --------------------------------------------------------

--
-- Table structure for table `donationcatergory`
--
drop table `donationcatergory`;
CREATE TABLE `donationcatergory` (
  `itemID` int(10) NOT NULL,
  `itemType` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donationcatergory`
--

INSERT INTO `donationcatergory` (`itemID`, `itemType`) VALUES
(1, 'Misc'),
(2, 'Misc'),
(3, 'Misc'),
(4, 'Misc'),
(5, 'Clothing'),
(6, 'Clothing'),
(7, 'Clothing'),
(8, 'Clothing'),
(9, 'Clothing'),
(10, 'Clothing'),
(11, 'Food'),
(12, 'Food'),
(13, 'Food'),
(14, 'Food'),
(15, 'Food');

-- --------------------------------------------------------

--
-- Table structure for table `donationclothing`
--
drop table `donationclothing`;
CREATE TABLE `donationclothing` (
  `itemID` int(10) NOT NULL,
  `name` varchar(25) NOT NULL,
  `size` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donationclothing`
--

INSERT INTO `donationclothing` (`itemID`, `name`, `size`) VALUES
(5, 'T-Shirt', 'Small'),
(6, 'T-Shirt', 'Medium'),
(7, 'T-Shirt', 'Large'),
(8, 'T-Shirt', 'XL'),
(9, 'T-Shirt', 'XXL'),
(10, 'T-Shirt', 'X-Small');

-- --------------------------------------------------------

--
-- Table structure for table `donationfood`
--
drop table `donationfood`;
CREATE TABLE `donationfood` (
  `itemID` int(10) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donationfood`
--

INSERT INTO `donationfood` (`itemID`, `name`) VALUES
(11, 'Fruits'),
(12, 'Vegetables'),
(13, 'Hot Food'),
(14, 'Cold Food'),
(15, 'Water');

-- --------------------------------------------------------

--
-- Table structure for table `donationmisc`
--
drop table `donationmisc`;
CREATE TABLE `donationmisc` (
  `itemID` int(10) NOT NULL,
  `itemName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donationmisc`
--

INSERT INTO `donationmisc` (`itemID`, `itemName`) VALUES
(1, 'Candles'),
(2, 'Toothbrush'),
(3, 'Matches'),
(4, 'Flashlight');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
drop table `users`;
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
  ADD PRIMARY KEY (`uID`,`itemID`),
  ADD KEY `fk_donation_donation_itemID` (`itemID`);

--
-- Indexes for table `donationcatergory`
--
ALTER TABLE `donationcatergory`
  ADD PRIMARY KEY (`itemID`,`itemType`);

--
-- Indexes for table `donationclothing`
--
ALTER TABLE `donationclothing`
  ADD KEY `fk_donation_ItemID_Clothing` (`itemID`);

--
-- Indexes for table `donationfood`
--
ALTER TABLE `donationfood`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `donationmisc`
--
ALTER TABLE `donationmisc`
  ADD KEY `fk_donation_ItemID_Misc` (`itemID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donationcatergory`
--
ALTER TABLE `donationcatergory`
  MODIFY `itemID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
  ADD CONSTRAINT `fk_donation_donation_itemID` FOREIGN KEY (`itemID`) REFERENCES `donationcatergory` (`itemID`),
  ADD CONSTRAINT `fk_users_uID` FOREIGN KEY (`uID`) REFERENCES `users` (`uID`);

--
-- Constraints for table `donationclothing`
--
ALTER TABLE `donationclothing`
  ADD CONSTRAINT `fk_donation_ItemID_Clothing` FOREIGN KEY (`itemID`) REFERENCES `donationcatergory` (`itemID`);

--
-- Constraints for table `donationfood`
--
ALTER TABLE `donationfood`
  ADD CONSTRAINT `fk_donation_ItemID_Food` FOREIGN KEY (`itemID`) REFERENCES `donationcatergory` (`itemID`);

--
-- Constraints for table `donationmisc`
--
ALTER TABLE `donationmisc`
  ADD CONSTRAINT `fk_donation_ItemID_Misc` FOREIGN KEY (`itemID`) REFERENCES `donationcatergory` (`itemID`);

