-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2018 at 05:11 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tim`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `login`
-- (See below for the actual view)
--
CREATE TABLE `login` (
`userID` int(10)
,`username` varchar(100)
,`password` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `firstname`, `lastname`, `middlename`, `phonenumber`, `email`) VALUES
(1, 'test101', 'test101', 'test1', 'test1', 'test1', '213456', 'test1@test.com'),
(2, 'test102', '654409aab4d309a66d4bc7c494b199a5', 'test2', 'test2', 'test2', '56763663', 'test2@test.com');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `AFTER_users_INSERT` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO users_audit
    SET action = 'added',
        userID = NEW.userID,
        firstname = NEW.firstname,
        lastname = NEW.lastname,
        middlename = NEW.middlename,
        phonenumber = NEW.phonenumber,
        email = NEW.email,
        username = NEW.username,
        password = NEW.password,
        modified = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users_audit`
--

CREATE TABLE `users_audit` (
  `userID` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `action` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_audit`
--

INSERT INTO `users_audit` (`userID`, `username`, `password`, `firstname`, `lastname`, `middlename`, `phonenumber`, `email`, `modified`, `action`) VALUES
(1, 'test101', 'test101', 'test1', 'test1', 'test1', '213456', 'test1@test.com', '2018-03-21 07:50:38', 'added'),
(2, 'test102', '654409aab4d309a66d4bc7c494b199a5', 'test2', 'test2', 'test2', '56763663', 'test2@test.com', '2018-03-21 08:17:53', 'added');

-- --------------------------------------------------------

--
-- Structure for view `login`
--
DROP TABLE IF EXISTS `login`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `login`  AS  select `users`.`userID` AS `userID`,`users`.`username` AS `username`,`users`.`password` AS `password` from `users` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `users_audit`
--
ALTER TABLE `users_audit`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_audit`
--
ALTER TABLE `users_audit`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
