-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2019 at 01:44 PM
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
(1, 'Sugbo Mercado'),
(2, 'The Market'),
(3, 'Yellowcube');

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
(2, 'Samuel', 'Jones', 'Kevin', '123', 'samjones@gmail.com', '09991234567', '1990-09-13', 3, 0),
(3, 'sadfsadf', 'sdafsad', 'sadfasdf', '123', 'sdafsf@gmail.com', 'kejfwlf', '1111-11-11', 1, 1),
(4, 'John', 'Doe', 'JImmy', '123', 'jdoe@gmail.com', '09999876543', '1987-12-18', 1, 0),
(5, 'Antonita', 'Tiu', 'Chu', '123', 'atiu@test.com', '09111726354', '1994-04-04', 1, 0),
(6, 'Robin', 'Tubungbanua', 'Mangubat', '$2y$10$rrpHY16nhUeK8i0Aabfk/.INRoeaLzPQyHpl/tuZbsYtSLhSRQof.', 'lobin@gmail.com', '09111111111', '1997-10-19', 1, 0),
(7, 'Ted', 'Mosby', 'Evelynn', '$2y$10$JcYsP4zFwZX0suNWn5H3mOZbS1VvJXxAV9/QiFi6suNQMqL3A3RCm', 'ted@test.com', '09111726354', '1970-01-01', 2, 0);

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
(5, 'Update', 'Employee was manually updated', '2018-09-25 23:01:43', 2, 1),
(6, 'Update', 'Employee was manually updated', '2018-10-10 21:59:58', 1, 1),
(7, 'Create', 'Employee was Created', '2018-10-15 21:38:27', 4, 1),
(8, 'Update', 'Employee was manually updated', '2018-10-15 21:38:46', 4, 1),
(9, 'Update', 'Employee was manually updated', '2018-11-04 13:54:05', 2, 1),
(10, 'Create', 'Employee was Created', '2018-11-04 14:42:18', 5, 1),
(11, 'Update', 'Employee was manually updated', '2018-11-05 21:30:06', 1, 1),
(12, 'Update', 'Employee was manually updated', '2018-11-05 21:33:39', 5, 1),
(13, 'Update', 'Employee was manually updated', '2018-11-05 21:34:01', 5, 1),
(14, 'Create', 'Employee was Created', '2018-11-23 20:25:49', 6, 1),
(15, 'Update', 'Employee was manually updated', '2019-01-04 20:39:52', 4, 1),
(16, 'Create', 'Employee was Created', '2019-01-04 20:43:17', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` float NOT NULL,
  `expense_type` enum('Utility','Ingredient','Salary') NOT NULL,
  `expense_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `name`, `description`, `price`, `expense_type`, `expense_timestamp`, `isDeleted`, `employee_id`) VALUES
(3, 'Electricity Bill', 'Paid Electricity Bill for September 2018', 8750, 'Utility', '2018-09-23 18:46:21', 0, 1),
(4, 'Water Bill', 'Paid water bill for the month', 3420, 'Utility', '2018-09-23 19:04:20', 0, 1),
(5, 'Expense', 'A test expense', 10100, 'Ingredient', '2018-10-07 20:23:16', 0, 1),
(6, 'Expense2', 'A test expense', 1500, 'Ingredient', '2018-10-07 20:23:33', 0, 1),
(7, 'Expense3', 'A test expense', 37500, 'Ingredient', '2018-10-07 20:23:44', 0, 1),
(8, 'Stove repair', 'Stove required new parts. Plus labor fee', 3500, 'Salary', '2018-10-15 21:39:33', 0, 1),
(10, 'aaa', 'bbb', 222, 'Salary', '2018-10-15 21:40:09', 1, 1),
(11, 'Salary November 2018', 'Paid employee salary for November 2018', 45000, 'Salary', '2018-11-19 22:31:14', 0, 1),
(12, 'Electricity November 2018', 'Paid Electricity bill for November 2018', 8500, 'Utility', '2018-11-19 22:31:56', 0, 1),
(13, 'Ingredients November 2018', 'Purchased ingredients for November 2018', 50000, 'Ingredient', '2018-11-19 22:32:35', 0, 1),
(14, 'Scallops', '100 pcs of scallops', 1000, 'Ingredient', '2018-12-31 13:53:52', 0, 1),
(15, 'fweqf', 'wef', 1, 'Ingredient', '2018-12-31 13:54:12', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fisherman_expense`
--

CREATE TABLE `fisherman_expense` (
  `fisherman_expense_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `item_qty` int(11) NOT NULL,
  `expense_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_id` int(11) DEFAULT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fisherman_expense`
--

INSERT INTO `fisherman_expense` (`fisherman_expense_id`, `item_name`, `price`, `item_qty`, `expense_timestamp`, `employee_id`, `isDeleted`) VALUES
(1, 'Scallops', 1500, 100, '2018-12-31 14:02:00', 1, 0),
(2, 'Lobsters', 2500, 15, '2018-12-31 14:03:34', 1, 0),
(3, 'sdaf', 1, 1, '2018-12-31 14:07:53', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `branch_id` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `name`, `price`, `qty`, `branch_id`, `isDeleted`) VALUES
(1, 'Cheezy Scallop', 179, 27, 1, 0),
(2, '', 0, 0, 1, 1),
(3, 'Lobster', 175, 12, 1, 0),
(4, 'Shrimp', 150, 2, 1, 0),
(5, 'Calamares', 250, 12, 1, 0),
(6, 'Foods', 112, 12, 1, 0),
(7, 'fsdjfsldkf', 111, 0, 1, 1),
(8, 'sadfsad', 111, 0, 1, 1),
(9, 'sadfds', 111, 0, 1, 1),
(10, 'faa', 12, 0, 1, 1),
(11, 'bn', 222, 0, 1, 1),
(12, 'lumpia', 300, 17, 1, 0),
(13, 'Lechon', 250, 10, 1, 0),
(14, 'aaa', 111, 0, 1, 1),
(15, 'bb', 111, 0, 1, 1),
(16, 'ccc', 222, 0, 1, 1),
(17, 'abc', 123, 0, 1, 1),
(18, 'aaaa', 123, 0, 1, 1),
(19, 'aa', 22, 0, 1, 1),
(20, 'a', 1, 0, 1, 1),
(21, 'a', 1, 0, 1, 1),
(22, 'aaaa', 11111, 0, 1, 1),
(23, '11111', 55555, 0, 1, 1),
(24, 'a', 123, 0, 1, 1),
(25, 'a', 123, 0, 1, 1),
(26, 'a', 54321, 0, 1, 1),
(27, 'zoo', 200, 0, 1, 1),
(28, 'zoo', 200, 0, 1, 1),
(29, 'zoo', 199, 0, 1, 1),
(30, 'zoo', 199, 0, 1, 1),
(31, '123', 123, 0, 1, 1),
(32, 'Yummy food', 120, 0, 1, 1),
(33, 'Fried Chicken (4 pc)', 280, 12, 1, 0),
(34, 'Nachos', 234, 6, 1, 0),
(35, 'Rice (1 Cup)', 17, 30, 1, 0),
(36, 'Coke (1 Liter)', 35, 0, 1, 1),
(37, 'Coke', 35, 0, 1, 1),
(38, 'Coke (1 Liter)', 35, 0, 1, 1),
(39, 'Coke (1 Liter)', 35, 0, 1, 0),
(43, 'The Market Lobster', 350, 0, 1, 1),
(44, 'The Market Lobster', 350, 0, 2, 0),
(45, 'sadfsadf', 123, 0, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_line`
--

CREATE TABLE `item_line` (
  `item_line_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `old_stock` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `item_line_type` enum('local','honestbee') DEFAULT NULL,
  `stock_transaction_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_line`
--

INSERT INTO `item_line` (`item_line_id`, `price`, `old_stock`, `qty`, `item_line_type`, `stock_transaction_id`, `item_id`) VALUES
(13, 175, 0, 4, 'local', 13, 1),
(14, 280, 0, 5, 'local', 13, 33),
(15, 175, 0, 5, 'local', 14, 1),
(16, 175, 0, 3, 'local', 14, 3),
(17, 112, 0, 2, 'local', 14, 6),
(18, 175, 0, 2, 'local', 15, 1),
(19, 175, 0, 2, 'honestbee', 16, 1),
(20, 150, 0, 1, 'local', 16, 4),
(21, 230, 0, 1, 'local', 16, 5),
(22, 112, 0, 1, 'local', 16, 6),
(23, 234, 0, 1, 'local', 16, 34),
(26, 150, 0, 1, 'local', 18, 4),
(27, 112, 0, 2, 'honestbee', 18, 6),
(35, 175, 0, 2, 'honestbee', 22, 1),
(36, 150, 0, 1, 'local', 22, 4),
(37, 300, 0, 1, 'honestbee', 22, 12),
(38, 280, 0, 1, 'honestbee', 22, 33),
(39, 234, 0, 1, 'local', 22, 34),
(40, 175, 0, 2, 'local', 23, 1),
(41, 150, 0, 2, 'local', 23, 4),
(42, 112, 0, 1, 'local', 23, 6),
(43, 250, 0, 3, 'local', 23, 13),
(44, 280, 0, 1, 'local', 23, 33),
(51, 150, 0, 2, 'local', 27, 4),
(52, 300, 0, 2, 'local', 27, 12),
(54, 280, 0, 1, 'local', 27, 33),
(55, 175, 0, 3, 'local', 28, 1),
(56, 175, 0, 9, 'local', 29, 1),
(59, 0, 0, 4, NULL, 35, 3),
(60, 0, 0, -2, NULL, 36, 5),
(61, 179, 0, 2, 'local', 37, 1),
(62, 250, 0, 2, 'local', 37, 5),
(63, 280, 0, 1, 'local', 37, 33),
(64, 250, 0, 2, 'local', 38, 5),
(65, 175, 0, 2, 'honestbee', 39, 3),
(66, 179, 0, 1, 'local', 39, 1),
(67, 250, 0, 2, 'local', 39, 5),
(68, 250, 0, 1, 'local', 39, 13),
(69, 280, 0, 2, 'local', 39, 33),
(70, 0, 0, 16, NULL, 40, 5),
(71, 0, 0, 5, NULL, 41, 6),
(72, 0, 0, 8, NULL, 42, 1),
(73, 0, 0, 7, NULL, 43, 3),
(74, 0, 0, 7, NULL, 44, 34),
(75, 0, 0, 17, NULL, 45, 4),
(76, 179, 0, 3, 'local', 46, 1),
(77, 175, 0, 2, 'local', 46, 3),
(78, 150, 0, 3, 'local', 46, 4),
(79, 250, 0, 4, 'local', 46, 5),
(80, 234, 0, 1, 'local', 46, 34),
(81, 0, 15, 3, '', 48, 5),
(82, 0, 8, 7, '', 49, 1),
(83, 0, 1, 14, '', 50, 33),
(84, 0, 4, 8, '', 51, 13),
(85, 0, 0, 25, '', 52, 12),
(86, 179, 15, 3, 'local', 55, 1),
(87, 150, 14, 2, 'honestbee', 55, 4),
(88, 250, 18, 2, 'honestbee', 55, 5),
(89, 250, 16, 3, 'local', 56, 5),
(90, 300, 25, 7, 'local', 56, 12),
(95, 179, 15, 3, 'local', 63, 1),
(96, 0, 12, 10, '', 64, 1),
(97, 0, 22, 2, '', 65, 1),
(98, 179, 20, 2, 'honestbee', 66, 1),
(99, 250, 13, 3, 'local', 66, 5),
(100, 0, 10, 5, '', 67, 5),
(101, 0, 5, 8, '', 68, 6),
(102, 0, 5, 7, '', 69, 3),
(103, 0, 18, 5, '', 70, 1),
(104, 0, 23, 12, '', 71, 1),
(117, 250, 7, 1, 'local', 83, 13),
(118, 0, 6, 4, '', 84, 13),
(119, 179, 35, 5, 'local', 85, 1),
(120, 250, 15, 3, 'local', 85, 5),
(121, 112, 13, 1, 'local', 85, 6),
(122, 0, 0, 30, '', 86, 35),
(123, 179, 30, 3, 'local', 87, 1),
(124, 150, 4, 2, 'local', 87, 4);

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
(27, '2018-09-25 23:05:17', 'Create', 'Item was Created', 1, 34),
(28, '2018-10-10 21:55:01', 'Update', 'Item was manually updated', 1, 1),
(29, '2018-10-10 21:55:25', 'Update', 'Item was manually updated', 1, 1),
(30, '2018-10-10 21:55:40', 'Update', 'Item was manually updated', 1, 1),
(31, '2018-10-14 20:32:36', 'Update', 'Item was manually updated', 1, 5),
(32, '2018-12-05 20:50:26', 'Create', 'Item was Created', NULL, 35),
(33, '2018-12-05 20:53:15', 'Update', 'Item was manually updated', 1, 35),
(34, '2018-12-05 20:53:45', 'Update', 'Item was manually updated', 1, 35),
(35, '2018-12-05 20:54:25', 'Update', 'Item was manually updated', 1, 35),
(36, '2018-12-05 20:56:24', 'Update', 'Item was manually updated', 1, 35),
(37, '2018-12-05 20:56:54', 'Update', 'Item was manually updated', 1, 35),
(38, '2018-12-05 20:57:45', 'Update', 'Item was manually updated', 1, 35),
(39, '2018-12-05 20:58:46', 'Update', 'Item was manually updated', 1, 35),
(40, '2018-12-05 21:02:23', 'Update', 'Item was manually updated', 1, 35),
(41, '2018-12-05 21:03:24', 'Create', 'Item was Created', NULL, 36),
(42, '2018-12-05 21:03:36', 'Create', 'Item was Created', NULL, 37),
(43, '2018-12-05 21:04:31', 'Create', 'Item was Created', 6, 38),
(44, '2018-12-05 21:04:35', 'Delete', 'Item was deleted', 1, 38),
(45, '2018-12-05 21:04:45', 'Delete', 'Item was deleted', 1, 37),
(46, '2018-12-05 21:04:49', 'Delete', 'Item was deleted', 1, 36),
(47, '2018-12-05 21:04:58', 'Create', 'Item was Created', 6, 39),
(48, '2018-12-17 22:16:56', 'Create', 'Item was Created', 1, 43),
(49, '2018-12-17 22:17:21', 'Delete', 'Item was deleted', 1, 43),
(50, '2018-12-17 22:17:34', 'Create', 'Item was Created', 1, 44),
(51, '2018-12-17 22:17:57', 'Delete', 'Item was deleted', 1, 44),
(52, '2018-12-17 22:20:02', 'Create', 'Item was Created', 1, 45),
(53, '2018-12-17 22:20:08', 'Delete', 'Item was deleted', 1, 45);

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
(37, 5, 83, 1),
(38, 7, 83, 1),
(39, 1, 85, 2),
(40, 2, 85, 1),
(41, 5, 85, 1),
(42, 7, 85, 1),
(43, 8, 85, 1),
(44, 9, 85, 1),
(45, 1, 87, 2),
(46, 2, 87, 1),
(47, 3, 87, 1),
(48, 4, 87, 1),
(49, 6, 87, 1),
(50, 7, 87, 1),
(51, 8, 87, 1);

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
(22, '2018-10-04 21:49:46', 'Sold', 1),
(23, '2018-10-06 18:43:33', 'Sold', 1),
(27, '2018-10-07 20:40:13', 'Sold', 1),
(28, '2018-10-09 21:18:38', 'Sold', 1),
(29, '2018-10-10 21:41:37', 'Sold', 1),
(35, '2018-10-12 23:50:09', 'Restock', 1),
(36, '2018-10-14 19:40:42', 'Damaged', 1),
(37, '2018-10-15 21:36:45', 'Sold', 1),
(38, '2018-10-17 21:34:40', 'Sold', 1),
(39, '2018-10-18 22:19:45', 'Sold', 1),
(40, '2018-10-18 23:00:04', 'Restock', 1),
(41, '2018-10-18 23:01:16', 'Restock', 1),
(42, '2018-10-18 23:01:22', 'Restock', 1),
(43, '2018-10-18 23:01:27', 'Restock', 1),
(44, '2018-10-18 23:01:32', 'Restock', 1),
(45, '2018-10-18 23:01:38', 'Restock', 1),
(46, '2018-10-28 19:47:11', 'Sold', 1),
(48, '2018-10-30 22:11:56', 'Restock', 1),
(49, '2018-10-30 22:12:20', 'Restock', 1),
(50, '2018-10-30 22:12:27', 'Restock', 1),
(51, '2018-10-30 22:12:33', 'Restock', 1),
(52, '2018-10-30 22:12:40', 'Restock', 1),
(53, '2018-10-30 22:21:04', 'Sold', 1),
(54, '2018-10-30 22:22:17', 'Sold', 1),
(55, '2018-10-30 22:23:11', 'Sold', 1),
(56, '2018-11-05 21:26:32', 'Sold', 1),
(63, '2018-11-11 21:35:25', 'Sold', 1),
(64, '2018-11-11 21:35:45', 'Restock', 1),
(65, '2018-11-11 21:35:51', 'Damaged', 1),
(66, '2018-11-21 22:25:57', 'Sold', 1),
(67, '2018-11-22 21:59:15', 'Restock', 1),
(68, '2018-11-22 21:59:22', 'Restock', 1),
(69, '2018-11-22 21:59:49', 'Restock', 1),
(70, '2018-11-22 22:00:20', 'Restock', 1),
(71, '2018-11-22 22:00:27', 'Restock', 1),
(83, '2018-11-25 20:16:19', 'Sold', 1),
(84, '2018-11-25 20:16:38', 'Restock', 1),
(85, '2018-12-02 18:41:41', 'Sold', 1),
(86, '2018-12-05 20:51:46', 'Restock', 1),
(87, '2018-12-31 12:27:40', 'Sold', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

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
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_fk` (`branch_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `employee_log`
--
ALTER TABLE `employee_log`
  MODIFY `employee_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `fisherman_expense`
--
ALTER TABLE `fisherman_expense`
  MODIFY `fisherman_expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `item_line`
--
ALTER TABLE `item_line`
  MODIFY `item_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `item_log`
--
ALTER TABLE `item_log`
  MODIFY `item_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `money_bill`
--
ALTER TABLE `money_bill`
  MODIFY `money_bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `money_denomination`
--
ALTER TABLE `money_denomination`
  MODIFY `money_denomination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `stock_transaction`
--
ALTER TABLE `stock_transaction`
  MODIFY `stock_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- Constraints for dumped tables
--

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
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
