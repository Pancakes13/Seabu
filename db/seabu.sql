-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2018 at 11:40 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seabu`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `pass` text NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_no` varchar(11) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `username`, `first_name`, `last_name`, `middle_name`, `pass`, `email`, `contact_no`, `birthdate`, `isDeleted`) VALUES
(1, 'neily', 'neil', 'llenes', 'diaz', '123', 'nllenes@gmail.com', '09111111111', '1997-11-13', 0),
(2, 'sammyj', 'Samuel', 'Jones', 'James', '123', 'samjones@gmail.com', '09991234567', '1990-09-13', 0),
(3, 'sadfsad', 'sadfsadf', 'sdafsad', 'sadfasdf', '123', 'sdafsf@gmail.com', 'kejfwlf', '1111-11-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_log`
--

CREATE TABLE `employee_log` (
  `employee_log_id` int(11) NOT NULL,
  `action` enum('Create','Update','Delete','') NOT NULL,
  `log_description` varchar(254) NOT NULL,
  `log_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` int(11) DEFAULT NULL,
  `performed_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_log`
--

INSERT INTO `employee_log` (`employee_log_id`, `action`, `log_description`, `log_timestamp`, `employee_id`, `performed_by`) VALUES
(1, 'Create', 'Employee was Created', '2018-09-24 22:32:01', 1, 1),
(2, 'Create', 'Employee was Created', '2018-09-24 22:37:53', 1, 1),
(3, 'Delete', 'Employee was deleted', '2018-09-24 22:40:12', 3, 1),
(4, 'Update', 'Employee was manually updated', '2018-09-25 22:59:29', 2, 1),
(5, 'Update', 'Employee was manually updated', '2018-09-25 23:01:43', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` float NOT NULL,
  `expense_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `name`, `description`, `price`, `expense_timestamp`, `employee_id`) VALUES
(3, 'Electricity Bill', 'Paid Electricity Bill for September 2018', 8750, '2018-09-23 18:46:21', 1),
(4, 'Water Bill', 'Paid water bill for the month', 3420, '2018-09-23 19:04:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `name`, `price`, `qty`, `isDeleted`) VALUES
(1, 'Cheezy Scallop', 175, 0, 0),
(2, '', 0, 0, 1),
(3, 'Lobster', 175, 0, 0),
(4, 'Shrimp', 150, 0, 0),
(5, 'Calamares', 230, 0, 0),
(6, 'Foods', 112, 0, 0),
(7, 'fsdjfsldkf', 111, 0, 1),
(8, 'sadfsad', 111, 0, 1),
(9, 'sadfds', 111, 0, 1),
(10, 'faa', 12, 0, 1),
(11, 'bn', 222, 0, 1),
(12, 'lumpia', 300, 0, 0),
(13, 'Lechon', 250, 0, 0),
(14, 'aaa', 111, 0, 1),
(15, 'bb', 111, 0, 1),
(16, 'ccc', 222, 0, 1),
(17, 'abc', 123, 0, 1),
(18, 'aaaa', 123, 0, 1),
(19, 'aa', 22, 0, 1),
(20, 'a', 1, 0, 1),
(21, 'a', 1, 0, 1),
(22, 'aaaa', 11111, 0, 1),
(23, '11111', 55555, 0, 1),
(24, 'a', 123, 0, 1),
(25, 'a', 123, 0, 1),
(26, 'a', 54321, 0, 1),
(27, 'zoo', 200, 0, 1),
(28, 'zoo', 200, 0, 1),
(29, 'zoo', 199, 0, 1),
(30, 'zoo', 199, 0, 1),
(31, '123', 123, 0, 1),
(32, 'Yummy food', 120, 0, 1),
(33, 'Fried Chicken (4 pc)', 280, 5, 0),
(34, 'Nachos', 234, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_line`
--

CREATE TABLE `item_line` (
  `item_line_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `item_line_type` enum('local','honestbee') NOT NULL,
  `stock_transaction_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_line`
--

INSERT INTO `item_line` (`item_line_id`, `price`, `qty`, `item_line_type`, `stock_transaction_id`, `item_id`) VALUES
(13, 175, 4, 'local', 13, 1),
(14, 280, 5, 'local', 13, 33),
(15, 175, 5, 'local', 14, 1),
(16, 175, 3, 'local', 14, 3),
(17, 112, 2, 'local', 14, 6),
(18, 175, 2, 'local', 15, 1),
(19, 175, 2, 'honestbee', 16, 1),
(20, 150, 1, 'local', 16, 4),
(21, 230, 1, 'local', 16, 5),
(22, 112, 1, 'local', 16, 6),
(23, 234, 1, 'local', 16, 34),
(26, 150, 1, 'local', 18, 4),
(27, 112, 2, 'honestbee', 18, 6),
(35, 175, 2, 'honestbee', 22, 1),
(36, 150, 1, 'local', 22, 4),
(37, 300, 1, 'honestbee', 22, 12),
(38, 280, 1, 'honestbee', 22, 33),
(39, 234, 1, 'local', 22, 34);

-- --------------------------------------------------------

--
-- Table structure for table `item_log`
--

CREATE TABLE `item_log` (
  `item_log_id` int(11) NOT NULL,
  `log_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_action` enum('Create','Update','Delete') NOT NULL,
  `log_description` varchar(254) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_log`
--

INSERT INTO `item_log` (`item_log_id`, `log_timestamp`, `log_action`, `log_description`, `employee_id`, `item_id`) VALUES
(3, '2018-09-16 21:22:13', 'Delete', '', 1, 17),
(5, '2018-09-16 21:27:17', 'Delete', '', 1, 31),
(6, '2018-09-22 16:37:40', 'Delete', NULL, 1, 23),
(7, '2018-09-22 16:37:44', 'Delete', NULL, 1, 26),
(8, '2018-09-22 16:37:50', 'Delete', NULL, 1, 7),
(9, '2018-09-22 16:37:57', 'Delete', NULL, 1, 9),
(10, '2018-09-22 16:38:02', 'Delete', NULL, 1, 27),
(11, '2018-09-22 16:38:07', 'Delete', NULL, 1, 28),
(12, '2018-09-22 16:38:10', 'Delete', NULL, 1, 8),
(13, '2018-09-22 16:38:17', 'Delete', NULL, 1, 10),
(14, '2018-09-22 16:38:24', 'Delete', NULL, 1, 15),
(15, '2018-09-22 16:38:27', 'Delete', NULL, 1, 19),
(16, '2018-09-23 14:53:03', 'Update', 'Item was manually updated', 1, 1),
(17, '2018-09-23 14:54:08', 'Create', 'Item was Created', 1, 1),
(18, '2018-09-23 14:58:54', 'Update', 'Item was manually updated', 1, 13),
(19, '2018-09-23 14:59:44', 'Update', 'Item was manually updated', 1, 32),
(20, '2018-09-23 15:00:13', 'Update', 'Item was manually updated', 1, 32),
(21, '2018-09-23 15:11:11', 'Delete', NULL, 1, 32),
(24, '2018-09-23 15:13:53', 'Delete', 'Item was deleted', 1, 30),
(25, '2018-09-24 22:35:40', 'Delete', 'Item was deleted', 1, 2),
(26, '2018-09-25 22:57:05', 'Update', 'Item was manually updated', 1, 2),
(27, '2018-09-25 23:05:17', 'Create', 'Item was Created', 1, 34);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transaction`
--

CREATE TABLE `stock_transaction` (
  `stock_transaction_id` int(11) NOT NULL,
  `transaction_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `type` enum('Restock','Sold','Damaged') NOT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_transaction`
--

INSERT INTO `stock_transaction` (`stock_transaction_id`, `transaction_timestamp`, `type`, `employee_id`) VALUES
(13, '2018-09-30 20:05:42', 'Sold', 1),
(14, '2018-09-30 21:11:23', 'Sold', 1),
(15, '2018-09-30 21:12:59', 'Sold', 1),
(16, '2018-10-02 22:28:02', 'Sold', 1),
(18, '2018-10-03 21:58:55', 'Sold', 1),
(22, '2018-10-04 21:49:46', 'Sold', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `employee_log`
--
ALTER TABLE `employee_log`
  ADD PRIMARY KEY (`employee_log_id`),
  ADD KEY `employee_log_fk1` (`employee_id`),
  ADD KEY `employee_log_fk2` (`performed_by`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `expense_fk` (`employee_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_line`
--
ALTER TABLE `item_line`
  ADD PRIMARY KEY (`item_line_id`),
  ADD KEY `item_line_fk1` (`stock_transaction_id`),
  ADD KEY `item_line_fk2` (`item_id`);

--
-- Indexes for table `item_log`
--
ALTER TABLE `item_log`
  ADD PRIMARY KEY (`item_log_id`),
  ADD KEY `item_log_fk1` (`employee_id`),
  ADD KEY `item_log_fk2` (`item_id`);

--
-- Indexes for table `stock_transaction`
--
ALTER TABLE `stock_transaction`
  ADD PRIMARY KEY (`stock_transaction_id`),
  ADD KEY `stock_transaction_fk` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee_log`
--
ALTER TABLE `employee_log`
  MODIFY `employee_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `item_line`
--
ALTER TABLE `item_line`
  MODIFY `item_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `item_log`
--
ALTER TABLE `item_log`
  MODIFY `item_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `stock_transaction`
--
ALTER TABLE `stock_transaction`
  MODIFY `stock_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_log`
--
ALTER TABLE `employee_log`
  ADD CONSTRAINT `employee_log_fk1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `employee_log_fk2` FOREIGN KEY (`performed_by`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_fk` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `item_line`
--
ALTER TABLE `item_line`
  ADD CONSTRAINT `item_line_fk1` FOREIGN KEY (`stock_transaction_id`) REFERENCES `stock_transaction` (`stock_transaction_id`),
  ADD CONSTRAINT `item_line_fk2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `item_log`
--
ALTER TABLE `item_log`
  ADD CONSTRAINT `item_log_fk1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `item_log_fk2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `stock_transaction`
--
ALTER TABLE `stock_transaction`
  ADD CONSTRAINT `stock_transaction_fk` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
