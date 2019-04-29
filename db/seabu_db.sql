-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2019 at 06:27 AM
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
(57, 0, 1, 18),
(58, 0, 2, 18),
(59, 0, 3, 18),
(60, 0, 4, 18);

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
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `last_name`, `middle_name`, `pass`, `email`, `contact_no`, `birthdate`, `branch_id`, `isDeleted`) VALUES
(1, 'Neil', 'Llenes', 'Diaz', '$2y$10$rrpHY16nhUeK8i0Aabfk/.INRoeaLzPQyHpl/tuZbsYtSLhSRQof.', 'neilllenes@gmail.com', '09111111111', '1997-11-13', 1, 0),
(6, 'Robin', 'Tubungbanua', 'Mangubat', '$2y$10$rrpHY16nhUeK8i0Aabfk/.INRoeaLzPQyHpl/tuZbsYtSLhSRQof.', 'lobin@gmail.com', '09111111111', '1997-10-19', 1, 0),
(7, 'Ted', 'Mosby', 'Evelynn', '$2y$10$JcYsP4zFwZX0suNWn5H3mOZbS1VvJXxAV9/QiFi6suNQMqL3A3RCm', 'ted@test.com', '09111726354', '1970-01-01', 2, 0),
(8, 'aa', 'aa', '', '$2y$10$a2Uv1qEtzvOTNd5KZyS4Ie6n4vn4fr4IZLMAK7jvN4hqcqtt7lH9u', 'aa@test.com', '12123123', '1111-11-11', 1, 0);

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
(18, 'Scallop', '200.00', 0);

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
(17, '2019-03-17 13:26:54', 'Create', 'Item was Created', 1, 18);

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

-- --------------------------------------------------------

--
-- Table structure for table `stock_transaction`
--

CREATE TABLE `stock_transaction` (
  `stock_transaction_id` int(11) NOT NULL,
  `transaction_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `type` enum('Restock','Sold','Damaged','Transfer') NOT NULL,
  `isVoid` int(11) NOT NULL DEFAULT '0',
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `branch_item`
--
ALTER TABLE `branch_item`
  MODIFY `branch_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `fisherman_expense_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `item_line`
--
ALTER TABLE `item_line`
  MODIFY `item_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_log`
--
ALTER TABLE `item_log`
  MODIFY `item_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `money_bill`
--
ALTER TABLE `money_bill`
  MODIFY `money_bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `money_denomination`
--
ALTER TABLE `money_denomination`
  MODIFY `money_denomination_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_transaction`
--
ALTER TABLE `stock_transaction`
  MODIFY `stock_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `void_transaction`
--
ALTER TABLE `void_transaction`
  MODIFY `void_transaction_id` int(11) NOT NULL AUTO_INCREMENT;

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
