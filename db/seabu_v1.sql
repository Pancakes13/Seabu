-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2019 at 05:05 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
(7, 'Ted', 'Mosby', 'Evelynn', '$2y$10$JcYsP4zFwZX0suNWn5H3mOZbS1VvJXxAV9/QiFi6suNQMqL3A3RCm', 'ted@test.com', '09111726354', '1970-01-01', 2, 0),
(8, 'aa', 'aa', '', '$2y$10$a2Uv1qEtzvOTNd5KZyS4Ie6n4vn4fr4IZLMAK7jvN4hqcqtt7lH9u', 'aa@test.com', '12123123', '1111-11-11', 1, 0),
(9, 'Swag', 'Test', '', '$2y$10$qLQ2whZ0n/b5n8Zwuh1QjuWUlvXEI4rhfbMYxKvWpyBNzlsG5dBlm', 'swag@test.com', '09111234567', '2222-02-22', 3, 0),
(10, 'bb', 'bb', '', '$2y$10$VCWLuz1Pc6ykETMaYKfZjuIiEzzpKgOtP70XXHEASNt8cuiuPIpmu', 'bb@test.com', '123123123', '1997-11-11', 3, 1),
(11, 'bb', 'bb', '', '$2y$10$Pida3iY92YqZmWQsk9Ydc.7rAHHOIb20AcDLPsG9MyrtwRsoYqrJ6', 'bb@test.com', '09111726354', '1986-11-11', 3, 0),
(12, 'cc', 'cc', '', '$2y$10$ML02udbDdxZ1KrY33.g6zecUlFGK/yey6em6QJEBMJ1PB01xg76xy', 'cc@test.com', '0918273645', '1121-02-12', 3, 0);

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
(16, 'Create', 'Employee was Created', '2019-01-04 20:43:17', 7, 1),
(17, 'Create', 'Employee was Created', '2019-01-25 21:38:30', 8, 1),
(18, 'Create', 'Employee was Created', '2019-01-25 21:40:01', 9, 1),
(19, 'Update', 'Employee was manually updated', '2019-01-25 21:40:55', 8, 1),
(20, 'Update', 'Employee was manually updated', '2019-01-25 21:44:33', 8, 1),
(21, 'Create', 'Employee was Created', '2019-01-25 21:47:33', 10, 1),
(22, 'Delete', 'Employee was deleted', '2019-01-25 21:51:33', 10, 1),
(23, 'Create', 'Employee was Created', '2019-01-25 22:11:16', 11, 1),
(24, 'Create', 'Employee was Created', '2019-01-25 22:18:44', 12, 1);

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

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `name`, `description`, `price`, `expense_type`, `expense_timestamp`, `isDeleted`, `employee_id`) VALUES
(3, 'Electricity Bill', 'Paid Electricity Bill for September 2018', '8750.00', 'Utility', '2018-09-23 18:46:21', 0, 1),
(4, 'Water Bill', 'Paid water bill for the month', '3420.00', 'Utility', '2018-09-23 19:04:20', 0, 1),
(5, 'Expense', 'A test expense', '10100.00', 'Ingredient', '2018-10-07 20:23:16', 0, 1),
(6, 'Expense2', 'A test expense', '1500.00', 'Ingredient', '2018-10-07 20:23:33', 0, 1),
(7, 'Expense3', 'A test expense', '37500.00', 'Ingredient', '2018-10-07 20:23:44', 0, 1),
(8, 'Stove repair', 'Stove required new parts. Plus labor fee', '3500.00', 'Salary', '2018-10-15 21:39:33', 0, 1),
(10, 'aaa', 'bbb', '222.00', 'Salary', '2018-10-15 21:40:09', 1, 1),
(11, 'Salary November 2018', 'Paid employee salary for November 2018', '45000.00', 'Salary', '2018-11-19 22:31:14', 0, 1),
(12, 'Electricity November 2018', 'Paid Electricity bill for November 2018', '8500.00', 'Utility', '2018-11-19 22:31:56', 0, 1),
(13, 'Ingredients November 2018', 'Purchased ingredients for November 2018', '50000.00', 'Ingredient', '2018-11-19 22:32:35', 0, 1),
(14, 'Scallops', '100 pcs of scallops', '1000.00', 'Ingredient', '2018-12-31 13:53:52', 0, 1),
(15, 'fweqf', 'wef', '1.00', 'Ingredient', '2018-12-31 13:54:12', 0, 1);

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
(1, 'Scallops', '1500.00', 100, '2018-12-31 14:02:00', 1, 0),
(2, 'Lobsters', '2500.00', 15, '2018-12-31 14:03:34', 1, 0),
(3, 'sdaf', '1.00', 1, '2018-12-31 14:07:53', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `branch_id` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `name`, `price`, `qty`, `branch_id`, `isDeleted`) VALUES
(1, 'Cheezy Scallop', '179.00', 25, 1, 0),
(2, '', '0.00', 0, 1, 1),
(3, 'Lobster', '175.00', 10, 1, 0),
(4, 'Shrimp', '150.00', 0, 1, 0),
(5, 'Calamares', '250.00', 5, 1, 0),
(6, 'Food', '100.00', 0, 1, 0),
(7, 'fsdjfsldkf', '111.00', 0, 1, 1),
(8, 'sadfsad', '111.00', 0, 1, 1),
(9, 'sadfds', '111.00', 0, 1, 1),
(10, 'faa', '12.00', 0, 1, 1),
(11, 'bn', '222.00', 0, 1, 1),
(12, 'lumpia', '300.00', 10, 1, 0),
(13, 'Lechon', '250.00', 15, 1, 0),
(14, 'aaa', '111.00', 0, 1, 1),
(15, 'bb', '111.00', 0, 1, 1),
(16, 'ccc', '222.00', 0, 1, 1),
(17, 'abc', '123.00', 0, 1, 1),
(18, 'aaaa', '123.00', 0, 1, 1),
(19, 'aa', '22.00', 0, 1, 1),
(20, 'a', '1.00', 0, 1, 1),
(21, 'a', '1.00', 0, 1, 1),
(22, 'aaaa', '11111.00', 0, 1, 1),
(23, '11111', '55555.00', 0, 1, 1),
(24, 'a', '123.00', 0, 1, 1),
(25, 'a', '123.00', 0, 1, 1),
(26, 'a', '54321.00', 0, 1, 1),
(27, 'zoo', '200.00', 0, 1, 1),
(28, 'zoo', '200.00', 0, 1, 1),
(29, 'zoo', '199.00', 0, 1, 1),
(30, 'zoo', '199.00', 0, 1, 1),
(31, '123', '123.00', 0, 1, 1),
(32, 'Yummy food', '120.00', 0, 1, 1),
(33, 'Fried Chicken (4 pc)', '280.00', 12, 1, 0),
(34, 'Nachos', '234.00', 6, 1, 0),
(35, 'Rice (1 Cup)', '17.00', 30, 1, 0),
(36, 'Coke (1 Liter)', '35.00', 0, 1, 1),
(37, 'Coke', '35.00', 0, 1, 1),
(38, 'Coke (1 Liter)', '35.00', 0, 1, 1),
(39, 'Coke (1 Liter)', '35.00', 0, 1, 0),
(43, 'The Market Lobster', '350.00', 0, 1, 1),
(44, 'The Market Lobster', '350.00', 20, 2, 0),
(45, 'sadfsadf', '123.00', 0, 3, 1),
(46, 'Cheezy Scallop', '200.00', 50, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_line`
--

CREATE TABLE `item_line` (
  `item_line_id` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
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
(13, '175.00', 0, 4, 'local', 13, 1),
(14, '280.00', 0, 5, 'local', 13, 33),
(15, '175.00', 0, 5, 'local', 14, 1),
(16, '175.00', 0, 3, 'local', 14, 3),
(17, '112.00', 0, 2, 'local', 14, 6),
(18, '175.00', 0, 2, 'local', 15, 1),
(19, '175.00', 0, 2, 'honestbee', 16, 1),
(20, '150.00', 0, 1, 'local', 16, 4),
(21, '230.00', 0, 1, 'local', 16, 5),
(22, '112.00', 0, 1, 'local', 16, 6),
(23, '234.00', 0, 1, 'local', 16, 34),
(26, '150.00', 0, 1, 'local', 18, 4),
(27, '112.00', 0, 2, 'honestbee', 18, 6),
(35, '175.00', 0, 2, 'honestbee', 22, 1),
(36, '150.00', 0, 1, 'local', 22, 4),
(37, '300.00', 0, 1, 'honestbee', 22, 12),
(38, '280.00', 0, 1, 'honestbee', 22, 33),
(39, '234.00', 0, 1, 'local', 22, 34),
(40, '175.00', 0, 2, 'local', 23, 1),
(41, '150.00', 0, 2, 'local', 23, 4),
(42, '112.00', 0, 1, 'local', 23, 6),
(43, '250.00', 0, 3, 'local', 23, 13),
(44, '280.00', 0, 1, 'local', 23, 33),
(51, '150.00', 0, 2, 'local', 27, 4),
(52, '300.00', 0, 2, 'local', 27, 12),
(54, '280.00', 0, 1, 'local', 27, 33),
(55, '175.00', 0, 3, 'local', 28, 1),
(56, '175.00', 0, 9, 'local', 29, 1),
(59, '0.00', 0, 4, NULL, 35, 3),
(60, '0.00', 0, -2, NULL, 36, 5),
(61, '179.00', 0, 2, 'local', 37, 1),
(62, '250.00', 0, 2, 'local', 37, 5),
(63, '280.00', 0, 1, 'local', 37, 33),
(64, '250.00', 0, 2, 'local', 38, 5),
(65, '175.00', 0, 2, 'honestbee', 39, 3),
(66, '179.00', 0, 1, 'local', 39, 1),
(67, '250.00', 0, 2, 'local', 39, 5),
(68, '250.00', 0, 1, 'local', 39, 13),
(69, '280.00', 0, 2, 'local', 39, 33),
(70, '0.00', 0, 16, NULL, 40, 5),
(71, '0.00', 0, 5, NULL, 41, 6),
(72, '0.00', 0, 8, NULL, 42, 1),
(73, '0.00', 0, 7, NULL, 43, 3),
(74, '0.00', 0, 7, NULL, 44, 34),
(75, '0.00', 0, 17, NULL, 45, 4),
(76, '179.00', 0, 3, 'local', 46, 1),
(77, '175.00', 0, 2, 'local', 46, 3),
(78, '150.00', 0, 3, 'local', 46, 4),
(79, '250.00', 0, 4, 'local', 46, 5),
(80, '234.00', 0, 1, 'local', 46, 34),
(81, '0.00', 15, 3, '', 48, 5),
(82, '0.00', 8, 7, '', 49, 1),
(83, '0.00', 1, 14, '', 50, 33),
(84, '0.00', 4, 8, '', 51, 13),
(85, '0.00', 0, 25, '', 52, 12),
(86, '179.00', 15, 3, 'local', 55, 1),
(87, '150.00', 14, 2, 'honestbee', 55, 4),
(88, '250.00', 18, 2, 'honestbee', 55, 5),
(89, '250.00', 16, 3, 'local', 56, 5),
(90, '300.00', 25, 7, 'local', 56, 12),
(95, '179.00', 15, 3, 'local', 63, 1),
(96, '0.00', 12, 10, '', 64, 1),
(97, '0.00', 22, 2, '', 65, 1),
(98, '179.00', 20, 2, 'honestbee', 66, 1),
(99, '250.00', 13, 3, 'local', 66, 5),
(100, '0.00', 10, 5, '', 67, 5),
(101, '0.00', 5, 8, '', 68, 6),
(102, '0.00', 5, 7, '', 69, 3),
(103, '0.00', 18, 5, '', 70, 1),
(104, '0.00', 23, 12, '', 71, 1),
(117, '250.00', 7, 1, 'local', 83, 13),
(118, '0.00', 6, 4, '', 84, 13),
(119, '179.00', 35, 5, 'local', 85, 1),
(120, '250.00', 15, 3, 'local', 85, 5),
(121, '112.00', 13, 1, 'local', 85, 6),
(122, '0.00', 0, 30, '', 86, 35),
(123, '179.00', 30, 3, 'local', 87, 1),
(124, '150.00', 4, 2, 'local', 87, 4),
(125, '179.00', 27, 2, 'local', 88, 1),
(126, '175.00', 12, 2, 'local', 88, 3),
(127, '0.00', 0, 15, '', 89, 44),
(128, '350.00', 15, 3, 'local', 90, 44),
(129, '350.00', 12, 1, 'local', 91, 44),
(130, '250.00', 12, 1, 'local', 92, 5),
(131, '250.00', 10, 1, 'local', 92, 13),
(132, '250.00', 11, 1, 'local', 93, 5),
(133, '300.00', 17, 1, 'local', 93, 12),
(134, '250.00', 10, 1, 'local', 94, 5),
(135, '300.00', 16, 1, 'local', 94, 12),
(136, '250.00', 9, 1, 'local', 95, 5),
(137, '300.00', 15, 1, 'local', 95, 12),
(138, '250.00', 8, 1, 'local', 96, 5),
(139, '300.00', 14, 1, 'local', 96, 12),
(140, '250.00', 7, 1, 'local', 97, 5),
(141, '300.00', 13, 1, 'local', 97, 12),
(142, '250.00', 6, 1, 'local', 98, 5),
(143, '300.00', 12, 1, 'local', 98, 12),
(144, '300.00', 11, 1, 'local', 99, 12),
(145, '250.00', 9, 1, 'local', 99, 13),
(146, '150.00', 2, 1, 'local', 100, 4),
(147, '100.00', 12, 1, 'local', 100, 6),
(148, '300.00', 1, 1, 'local', 101, 12),
(149, '250.00', 8, 1, 'local', 101, 13),
(150, '0.00', 0, 15, '', 102, 13),
(151, '0.00', 0, 10, '', 103, 12),
(152, '300.00', 10, 3, 'local', 104, 12),
(153, '250.00', 15, 2, 'local', 104, 13),
(154, '300.00', 10, 3, 'local', 105, 12),
(155, '250.00', 15, 2, 'local', 105, 13),
(156, '300.00', 10, 3, 'local', 106, 12),
(157, '250.00', 15, 2, 'local', 106, 13),
(158, '350.00', 11, 3, 'local', 107, 44),
(159, '0.00', 8, 10, '', 108, 44),
(160, '0.00', 18, 3, '', 109, 44),
(161, '0.00', 0, 50, '', 110, 46),
(162, '200.00', 50, 3, 'local', 111, 46),
(163, '350.00', 21, 1, 'local', 112, 44),
(164, '350.00', 21, 1, 'local', 113, 44);

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
(53, '2018-12-17 22:20:08', 'Delete', 'Item was deleted', 1, 45),
(54, '2019-01-13 19:56:21', 'Update', 'Item was manually updated', 1, 6),
(55, '2019-01-13 19:56:55', 'Update', 'Item was manually updated', 1, 6),
(56, '2019-01-13 19:57:04', 'Update', 'Item was manually updated', 1, 6),
(57, '2019-01-25 21:27:42', 'Create', 'Item was Created', 1, 46);

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
(51, 8, 87, 1),
(138, 1, 88, 3),
(139, 2, 88, 1),
(140, 7, 88, 1),
(141, 8, 88, 1),
(142, 5, 90, 1),
(143, 9, 90, 1),
(144, 5, 91, 1),
(145, 6, 91, 1),
(146, 7, 91, 1),
(147, 8, 92, 1),
(148, 5, 93, 1),
(149, 8, 93, 1),
(150, 5, 94, 1),
(151, 8, 94, 1),
(152, 5, 95, 1),
(153, 8, 95, 1),
(154, 5, 96, 1),
(155, 8, 96, 1),
(156, 5, 97, 1),
(157, 8, 97, 1),
(158, 5, 98, 1),
(159, 8, 98, 1),
(160, 5, 100, 1),
(161, 7, 100, 1),
(162, 5, 101, 1),
(163, 8, 101, 1),
(164, 6, 104, 2),
(165, 7, 104, 1),
(166, 9, 104, 1),
(167, 5, 105, 2),
(168, 6, 105, 1),
(169, 7, 105, 1),
(170, 8, 105, 2),
(171, 7, 106, 2),
(172, 9, 106, 1),
(173, 5, 107, 1),
(174, 9, 107, 1),
(175, 6, 111, 1),
(176, 8, 111, 1),
(177, 5, 112, 1),
(178, 6, 112, 1),
(179, 7, 112, 1),
(180, 5, 113, 1),
(181, 6, 113, 1),
(182, 7, 113, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transaction`
--

CREATE TABLE `stock_transaction` (
  `stock_transaction_id` int(11) NOT NULL,
  `transaction_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `type` enum('Restock','Sold','Damaged') NOT NULL,
  `isVoid` int(11) NOT NULL DEFAULT '0',
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_transaction`
--

INSERT INTO `stock_transaction` (`stock_transaction_id`, `transaction_timestamp`, `type`, `isVoid`, `employee_id`) VALUES
(13, '2018-09-30 20:05:42', 'Sold', 0, 1),
(14, '2018-09-30 21:11:23', 'Sold', 0, 1),
(15, '2018-09-30 21:12:59', 'Sold', 0, 1),
(16, '2018-10-02 22:28:02', 'Sold', 0, 1),
(18, '2018-10-03 21:58:55', 'Sold', 0, 1),
(22, '2018-10-04 21:49:46', 'Sold', 0, 1),
(23, '2018-10-06 18:43:33', 'Sold', 0, 1),
(27, '2018-10-07 20:40:13', 'Sold', 0, 1),
(28, '2018-10-09 21:18:38', 'Sold', 0, 1),
(29, '2018-10-10 21:41:37', 'Sold', 0, 1),
(35, '2018-10-12 23:50:09', 'Restock', 0, 1),
(36, '2018-10-14 19:40:42', 'Damaged', 0, 1),
(37, '2018-10-15 21:36:45', 'Sold', 0, 1),
(38, '2018-10-17 21:34:40', 'Sold', 0, 1),
(39, '2018-10-18 22:19:45', 'Sold', 0, 1),
(40, '2018-10-18 23:00:04', 'Restock', 0, 1),
(41, '2018-10-18 23:01:16', 'Restock', 0, 1),
(42, '2018-10-18 23:01:22', 'Restock', 0, 1),
(43, '2018-10-18 23:01:27', 'Restock', 0, 1),
(44, '2018-10-18 23:01:32', 'Restock', 0, 1),
(45, '2018-10-18 23:01:38', 'Restock', 0, 1),
(46, '2018-10-28 19:47:11', 'Sold', 0, 1),
(48, '2018-10-30 22:11:56', 'Restock', 0, 1),
(49, '2018-10-30 22:12:20', 'Restock', 0, 1),
(50, '2018-10-30 22:12:27', 'Restock', 0, 1),
(51, '2018-10-30 22:12:33', 'Restock', 0, 1),
(52, '2018-10-30 22:12:40', 'Restock', 0, 1),
(53, '2018-10-30 22:21:04', 'Sold', 0, 1),
(54, '2018-10-30 22:22:17', 'Sold', 0, 1),
(55, '2018-10-30 22:23:11', 'Sold', 0, 1),
(56, '2018-11-05 21:26:32', 'Sold', 0, 1),
(63, '2018-11-11 21:35:25', 'Sold', 0, 1),
(64, '2018-11-11 21:35:45', 'Restock', 0, 1),
(65, '2018-11-11 21:35:51', 'Damaged', 0, 1),
(66, '2018-11-21 22:25:57', 'Sold', 0, 1),
(67, '2018-11-22 21:59:15', 'Restock', 0, 1),
(68, '2018-11-22 21:59:22', 'Restock', 0, 1),
(69, '2018-11-22 21:59:49', 'Restock', 0, 1),
(70, '2018-11-22 22:00:20', 'Restock', 0, 1),
(71, '2018-11-22 22:00:27', 'Restock', 0, 1),
(83, '2018-11-25 20:16:19', 'Sold', 0, 1),
(84, '2018-11-25 20:16:38', 'Restock', 0, 1),
(85, '2018-12-02 18:41:41', 'Sold', 0, 1),
(86, '2018-12-05 20:51:46', 'Restock', 0, 1),
(87, '2018-12-31 12:27:40', 'Sold', 0, 1),
(88, '2019-01-05 19:23:02', 'Sold', 0, 1),
(89, '2019-01-11 20:42:55', 'Restock', 0, 1),
(90, '2019-01-11 20:43:20', 'Sold', 1, 1),
(91, '2019-01-11 21:23:26', 'Sold', 0, 1),
(92, '2019-01-13 19:11:07', 'Sold', 1, 1),
(93, '2019-01-13 19:46:33', 'Sold', 1, 1),
(94, '2019-01-13 19:48:17', 'Sold', 1, 1),
(95, '2019-01-13 19:49:13', 'Sold', 1, 1),
(96, '2019-01-13 19:53:45', 'Sold', 1, 1),
(97, '2019-01-13 19:54:26', 'Sold', 1, 1),
(98, '2019-01-13 19:59:35', 'Sold', 1, 1),
(99, '2019-01-13 20:01:07', 'Sold', 1, 1),
(100, '2019-01-13 20:13:08', 'Sold', 1, 1),
(101, '2019-01-13 20:15:43', 'Sold', 1, 1),
(102, '2019-01-13 20:18:39', 'Restock', 0, 1),
(103, '2019-01-13 20:18:51', 'Restock', 0, 1),
(104, '2019-01-13 20:19:17', 'Sold', 1, 1),
(105, '2019-01-13 20:20:20', 'Sold', 1, 1),
(106, '2019-01-13 20:21:31', 'Sold', 1, 1),
(107, '2019-01-20 18:10:25', 'Sold', 0, 1),
(108, '2019-01-20 18:10:53', 'Restock', 0, 1),
(109, '2019-01-20 18:11:04', 'Damaged', 0, 1),
(110, '2019-01-25 21:27:58', 'Restock', 0, 1),
(111, '2019-01-25 21:28:33', 'Sold', 1, 1),
(112, '2019-01-26 17:50:43', 'Sold', 1, 1),
(113, '2019-01-26 18:00:07', 'Sold', 0, 1);

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
(1, '2019-01-13 19:45:35', 1, 92),
(2, '2019-01-13 19:46:36', 7, 93),
(3, '2019-01-13 19:48:41', 1, 94),
(4, '2019-01-13 19:48:48', 2, 94),
(5, '2019-01-13 19:49:24', 1, 95),
(6, '2019-01-13 19:53:47', 1, 96),
(7, '2019-01-13 19:58:53', 1, 97),
(8, '2019-01-13 19:59:40', 1, 98),
(9, '2019-01-13 20:13:20', 1, 100),
(10, '2019-01-13 20:15:53', 6, 101),
(11, '2019-01-13 20:19:26', 1, 104),
(12, '2019-01-13 20:20:26', 6, 105),
(13, '2019-01-13 20:21:35', 1, 106),
(14, '2019-01-25 21:28:45', 1, 111),
(15, '2019-01-26 17:53:58', 1, 112);

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
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee_log`
--
ALTER TABLE `employee_log`
  MODIFY `employee_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `item_line`
--
ALTER TABLE `item_line`
  MODIFY `item_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `item_log`
--
ALTER TABLE `item_log`
  MODIFY `item_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `money_bill`
--
ALTER TABLE `money_bill`
  MODIFY `money_bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `money_denomination`
--
ALTER TABLE `money_denomination`
  MODIFY `money_denomination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `stock_transaction`
--
ALTER TABLE `stock_transaction`
  MODIFY `stock_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `void_transaction`
--
ALTER TABLE `void_transaction`
  MODIFY `void_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
