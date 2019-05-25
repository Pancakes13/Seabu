-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2019 at 02:38 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seabu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `name`) VALUES
(1, 'Warehouse'),
(2, 'Sugbo Mercado'),
(3, 'The Market'),
(4, 'Yellowcube');

-- --------------------------------------------------------

--
-- Table structure for table `branch_item`
--

CREATE TABLE `branch_item` (
  `branch_item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `branch_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch_item`
--

INSERT INTO `branch_item` (`branch_item_id`, `qty`, `branch_id`, `item_id`) VALUES
(57, 14, 1, 18),
(58, 6, 2, 18),
(59, 4, 3, 18),
(60, 4, 4, 18),
(61, 9, 1, 19),
(62, 0, 2, 19),
(63, 3, 3, 19),
(64, 5, 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `pass` text NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_no` varchar(11) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `isAdmin` int(10) DEFAULT '0',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `last_name`, `middle_name`, `pass`, `email`, `contact_no`, `birthdate`, `branch_id`, `isAdmin`, `isDeleted`) VALUES
(1, 'Neil', 'Llenes', 'Diaz', '$2y$10$rrpHY16nhUeK8i0Aabfk/.INRoeaLzPQyHpl/tuZbsYtSLhSRQof.', 'neilllenes@gmail.com', '09111111111', '1997-11-13', 1, 0, 0),
(6, 'Robin', 'Tubungbanua', 'Mangubat', '$2y$10$rrpHY16nhUeK8i0Aabfk/.INRoeaLzPQyHpl/tuZbsYtSLhSRQof.', 'lobin@gmail.com', '09111111111', '1997-10-19', 1, 0, 0),
(7, 'Ted', 'Mosby', 'Evelynn', '$2y$10$JcYsP4zFwZX0suNWn5H3mOZbS1VvJXxAV9/QiFi6suNQMqL3A3RCm', 'ted@test.com', '09111726354', '1970-01-01', 2, 0, 0),
(8, 'aa', 'aa', '', '$2y$10$a2Uv1qEtzvOTNd5KZyS4Ie6n4vn4fr4IZLMAK7jvN4hqcqtt7lH9u', 'aa@test.com', '12123123', '1111-11-11', 1, 0, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(11,2) NOT NULL,
  `expense_type` enum('Utility','Ingredient','Salary') NOT NULL,
  `expense_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fisherman_expense`
--

CREATE TABLE `fisherman_expense` (
  `fisherman_expense_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `expense_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` int(11) DEFAULT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fisherman_expense`
--

INSERT INTO `fisherman_expense` (`fisherman_expense_id`, `item_name`, `price`, `item_qty`, `expense_timestamp`, `employee_id`, `isDeleted`) VALUES
(1, 'Fish', '2000.00', 30, '2019-04-14 15:24:31', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `name`, `price`, `isDeleted`) VALUES
(18, 'Scallop', '200.00', 0),
(19, 'Shrimp', '250.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_line`
--

CREATE TABLE `item_line` (
  `item_line_id` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `old_stock` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `stock_transaction_id` int(11) DEFAULT NULL,
  `branch_item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_line`
--

INSERT INTO `item_line` (`item_line_id`, `price`, `old_stock`, `qty`, `stock_transaction_id`, `branch_item_id`) VALUES
(3, '0.00', 0, 4, 23, 57),
(4, '0.00', 0, 1, 23, 58),
(5, '0.00', 0, 2, 23, 59),
(6, '0.00', 0, 3, 23, 60),
(8, '0.00', 0, 2, 24, 58),
(11, '0.00', 0, 3, 25, 57),
(12, '0.00', 0, 4, 25, 58),
(13, '0.00', 0, 3, 25, 59),
(14, '0.00', 2, 10, 26, 57),
(15, '0.00', 2, 10, 27, 57),
(16, '0.00', 12, 8, 28, 57),
(17, '0.00', 0, 1, 29, 57),
(18, '0.00', 0, 2, 29, 58),
(19, '0.00', 0, 3, 29, 59),
(20, '0.00', 0, 10, 30, 61),
(34, '200.00', 7, 1, 39, 58),
(35, '250.00', 4, 1, 39, 62),
(36, '200.00', 8, 2, 40, 59),
(37, '200.00', 8, 2, 41, 59),
(38, '200.00', 8, 1, 42, 59),
(39, '200.00', 8, 1, 43, 59),
(40, '200.00', 8, 2, 44, 59),
(41, '200.00', 8, 2, 45, 59),
(42, '200.00', 8, 1, 46, 59),
(43, '250.00', 4, 1, 46, 63),
(53, '200.00', 8, 2, 55, 59),
(54, '200.00', 7, 1, 56, 58),
(55, '250.00', 4, 1, 56, 62),
(56, '0.00', 0, 10, 58, 61),
(57, '0.00', 0, 10, 61, 61),
(58, '0.00', 0, 1, 62, 57),
(59, '0.00', 0, 2, 62, 58),
(60, '0.00', 0, 3, 62, 59),
(62, '0.00', 0, 1, 63, 63),
(63, '0.00', 0, 2, 63, 64),
(65, '0.00', 0, 1, 64, 63),
(67, '0.00', 0, 5, 65, 62),
(68, '0.00', 0, 3, 66, 63),
(69, '200.00', 6, 2, 67, 59),
(70, '250.00', 5, 1, 67, 63),
(71, '200.00', 7, 1, 68, 58),
(72, '200.00', 9, 5, 69, 60),
(73, '0.00', 0, 1, 70, 63),
(76, '0.00', 0, 1, 71, 64),
(77, '0.00', 0, 1, 72, 64),
(78, '0.00', 0, 2, 73, 64);

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
(17, '2019-03-17 13:26:54', 'Create', 'Item was Created', 1, 18),
(18, '2019-04-02 22:14:17', 'Create', 'Item was Created', 1, 19),
(19, '2019-04-02 22:14:52', 'Update', 'Item was manually updated', 1, 19),
(20, '2019-04-02 22:14:56', 'Update', 'Item was manually updated', 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `money_bill`
--

CREATE TABLE `money_bill` (
  `money_bill_id` int(11) NOT NULL,
  `money_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `money_bill`
--

INSERT INTO `money_bill` (`money_bill_id`, `money_value`) VALUES
(1, 1),
(2, 5),
(3, 10),
(4, 20),
(5, 50),
(6, 100),
(7, 200),
(8, 500),
(9, 1000),
(10, 0.05),
(11, 0.1),
(12, 0.25);

-- --------------------------------------------------------

--
-- Table structure for table `money_denomination`
--

CREATE TABLE `money_denomination` (
  `money_denomination_id` int(11) NOT NULL,
  `money_bill_id` int(11) DEFAULT NULL,
  `stock_transaction_id` int(11) DEFAULT NULL,
  `money_denomination_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `money_denomination`
--

INSERT INTO `money_denomination` (`money_denomination_id`, `money_bill_id`, `stock_transaction_id`, `money_denomination_qty`) VALUES
(13, 7, 39, 2),
(14, 5, 39, 1),
(15, 7, 40, 1),
(16, 6, 40, 2),
(17, 7, 41, 2),
(18, 7, 42, 1),
(19, 7, 43, 1),
(20, 7, 44, 2),
(21, 7, 45, 2),
(22, 7, 46, 2),
(23, 5, 46, 1),
(33, 7, 54, 2),
(34, 7, 55, 1),
(35, 6, 55, 2),
(36, 7, 56, 1),
(37, 6, 56, 2),
(38, 5, 56, 1),
(39, 8, 67, 1),
(40, 6, 67, 1),
(41, 5, 67, 1),
(42, 7, 68, 1),
(43, 9, 69, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transaction`
--

CREATE TABLE `stock_transaction` (
  `stock_transaction_id` int(11) NOT NULL,
  `transaction_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `type` enum('Restock','Sold','Damaged','Transfer','TransferHouse') NOT NULL,
  `isVoid` int(11) NOT NULL DEFAULT '0',
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_transaction`
--

INSERT INTO `stock_transaction` (`stock_transaction_id`, `transaction_timestamp`, `type`, `isVoid`, `employee_id`) VALUES
(23, '2019-03-25 21:40:35', 'Transfer', 0, 1),
(24, '2019-03-25 21:40:58', 'Transfer', 0, 1),
(25, '2019-03-27 20:15:20', 'Transfer', 0, 1),
(26, '2019-04-02 22:11:39', 'Restock', 0, 1),
(27, '2019-04-02 22:12:26', 'Restock', 0, 1),
(28, '2019-04-02 22:12:46', 'Restock', 0, 1),
(29, '2019-04-02 22:13:45', 'Transfer', 0, 1),
(30, '2019-04-08 20:00:52', 'Restock', 0, 1),
(31, '2019-04-08 20:01:01', 'Transfer', 0, 1),
(38, '2019-04-08 20:29:40', 'Sold', 0, 1),
(39, '2019-04-08 20:36:23', 'Sold', 1, 1),
(40, '2019-04-08 20:38:20', 'Sold', 1, 1),
(41, '2019-04-08 20:45:18', 'Sold', 1, 1),
(42, '2019-04-08 20:51:02', 'Sold', 1, 1),
(43, '2019-04-08 20:55:06', 'Sold', 1, 1),
(44, '2019-04-08 20:56:33', 'Sold', 1, 1),
(45, '2019-04-08 20:57:42', 'Sold', 1, 1),
(46, '2019-04-08 20:58:02', 'Sold', 1, 1),
(54, '2019-04-08 00:00:00', 'Sold', 0, 1),
(55, '2019-04-08 00:00:00', 'Sold', 0, 1),
(56, '2019-04-19 12:00:48', 'Sold', 1, 1),
(58, '2019-04-22 20:31:24', 'Restock', 0, 1),
(61, '2019-04-22 20:33:16', 'Restock', 0, 1),
(62, '2019-04-22 20:33:22', 'Transfer', 0, 1),
(63, '2019-04-22 20:35:15', 'Transfer', 0, 1),
(64, '2019-04-22 20:35:22', 'Transfer', 0, 1),
(65, '2019-04-22 20:40:18', 'Transfer', 0, 1),
(66, '2019-04-22 20:40:28', 'Transfer', 0, 1),
(67, '2019-05-12 08:03:48', 'Sold', 0, 1),
(68, '2019-05-12 17:58:14', 'Sold', 0, 1),
(69, '2019-05-12 00:00:00', 'Sold', 0, 1),
(70, '2019-05-12 19:34:57', 'Transfer', 0, 1),
(71, '2019-05-12 19:43:01', 'Transfer', 0, 1),
(72, '2019-05-12 19:46:25', 'Transfer', 0, 1),
(73, '2019-05-19 08:26:14', 'TransferHouse', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `void_transaction`
--

CREATE TABLE `void_transaction` (
  `void_transaction_id` int(11) NOT NULL,
  `transaction_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` int(11) NOT NULL,
  `stock_transaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `void_transaction`
--

INSERT INTO `void_transaction` (`void_transaction_id`, `transaction_timestamp`, `employee_id`, `stock_transaction_id`) VALUES
(1, '2019-04-08 20:57:47', 1, 45),
(2, '2019-04-08 20:58:06', 1, 46),
(3, '2019-04-19 11:43:58', 1, 39),
(4, '2019-04-19 12:00:53', 1, 56);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `branch_item`
--
ALTER TABLE `branch_item`
  ADD PRIMARY KEY (`branch_item_id`),
  ADD KEY `branch_item_fk1` (`branch_id`),
  ADD KEY `branch_item_fk2` (`item_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employee_fk1` (`branch_id`);

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
-- Indexes for table `fisherman_expense`
--
ALTER TABLE `fisherman_expense`
  ADD PRIMARY KEY (`fisherman_expense_id`),
  ADD KEY `fisherman_expense_fk` (`employee_id`);

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
  ADD KEY `item_line_fk2` (`branch_item_id`);

--
-- Indexes for table `item_log`
--
ALTER TABLE `item_log`
  ADD PRIMARY KEY (`item_log_id`),
  ADD KEY `item_log_fk1` (`employee_id`),
  ADD KEY `item_log_fk2` (`item_id`);

--
-- Indexes for table `money_bill`
--
ALTER TABLE `money_bill`
  ADD PRIMARY KEY (`money_bill_id`);

--
-- Indexes for table `money_denomination`
--
ALTER TABLE `money_denomination`
  ADD PRIMARY KEY (`money_denomination_id`),
  ADD KEY `money_denomination_fk1` (`money_bill_id`),
  ADD KEY `money_denomination_fk2` (`stock_transaction_id`);

--
-- Indexes for table `stock_transaction`
--
ALTER TABLE `stock_transaction`
  ADD PRIMARY KEY (`stock_transaction_id`),
  ADD KEY `stock_transaction_fk` (`employee_id`);

--
-- Indexes for table `void_transaction`
--
ALTER TABLE `void_transaction`
  ADD PRIMARY KEY (`void_transaction_id`),
  ADD KEY `void_transaction_fk1` (`employee_id`),
  ADD KEY `void_transaction_fk2` (`stock_transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branch_item`
--
ALTER TABLE `branch_item`
  MODIFY `branch_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee_log`
--
ALTER TABLE `employee_log`
  MODIFY `employee_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fisherman_expense`
--
ALTER TABLE `fisherman_expense`
  MODIFY `fisherman_expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `item_line`
--
ALTER TABLE `item_line`
  MODIFY `item_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `item_log`
--
ALTER TABLE `item_log`
  MODIFY `item_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `money_bill`
--
ALTER TABLE `money_bill`
  MODIFY `money_bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `money_denomination`
--
ALTER TABLE `money_denomination`
  MODIFY `money_denomination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `stock_transaction`
--
ALTER TABLE `stock_transaction`
  MODIFY `stock_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `void_transaction`
--
ALTER TABLE `void_transaction`
  MODIFY `void_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch_item`
--
ALTER TABLE `branch_item`
  ADD CONSTRAINT `branch_item_fk1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `branch_item_fk2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_fk1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

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
-- Constraints for table `fisherman_expense`
--
ALTER TABLE `fisherman_expense`
  ADD CONSTRAINT `fisherman_expense_fk` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `item_line`
--
ALTER TABLE `item_line`
  ADD CONSTRAINT `item_line_fk1` FOREIGN KEY (`stock_transaction_id`) REFERENCES `stock_transaction` (`stock_transaction_id`),
  ADD CONSTRAINT `item_line_fk2` FOREIGN KEY (`branch_item_id`) REFERENCES `branch_item` (`branch_item_id`);

--
-- Constraints for table `item_log`
--
ALTER TABLE `item_log`
  ADD CONSTRAINT `item_log_fk1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `item_log_fk2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `money_denomination`
--
ALTER TABLE `money_denomination`
  ADD CONSTRAINT `money_denomination_fk1` FOREIGN KEY (`money_bill_id`) REFERENCES `money_bill` (`money_bill_id`),
  ADD CONSTRAINT `money_denomination_fk2` FOREIGN KEY (`stock_transaction_id`) REFERENCES `stock_transaction` (`stock_transaction_id`);

--
-- Constraints for table `stock_transaction`
--
ALTER TABLE `stock_transaction`
  ADD CONSTRAINT `stock_transaction_fk` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `void_transaction`
--
ALTER TABLE `void_transaction`
  ADD CONSTRAINT `void_transaction_fk1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `void_transaction_fk2` FOREIGN KEY (`stock_transaction_id`) REFERENCES `stock_transaction` (`stock_transaction_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
