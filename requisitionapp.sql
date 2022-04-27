-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2022 at 10:31 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `requisitionapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `claims_category`
--

CREATE TABLE `claims_category` (
  `id` int(11) NOT NULL,
  `name` varchar(36) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `createdby` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claims_category`
--

INSERT INTO `claims_category` (`id`, `name`, `description`, `created_at`, `createdby`) VALUES
(4, 'patient claims', 'bonus', '2022-04-16', 'ayindekazeem99@gmail.com'),
(5, 'patient compensation ', 'for job weldone', '2022-04-16', 'ayindekazeem99@gmail.com'),
(6, 'Bonus', 'Over time', '2022-04-16', 'ayindekazeem99@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `claims_detail`
--

CREATE TABLE `claims_detail` (
  `id` int(11) NOT NULL,
  `claim_id` int(11) NOT NULL,
  `Amount` decimal(19,4) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claims_detail`
--

INSERT INTO `claims_detail` (`id`, `claim_id`, `Amount`, `Description`) VALUES
(9, 11, '3500.0000', 'For Extra day'),
(10, 12, '15000.0000', 'The patient has paid back the money we mistakenly approved on 20/4/2022'),
(11, 13, '100.0000', 'extra charges in error'),
(12, 15, '67000.0000', 'test'),
(13, 16, '200.0000', 'Test A'),
(14, 16, '230.0000', 'Test B'),
(15, 17, '100.0000', 'TTT'),
(16, 17, '120.0000', 'AAA'),
(17, 18, '67000.0000', 'yuyu'),
(18, 21, '67000.0000', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `claims_header`
--

CREATE TABLE `claims_header` (
  `id` int(11) NOT NULL,
  `claimtype` int(11) DEFAULT NULL,
  `hospital_no` varchar(36) DEFAULT NULL,
  `Patient_name` varchar(36) DEFAULT NULL,
  `Payee` varchar(36) DEFAULT NULL,
  `Amount` decimal(19,2) NOT NULL DEFAULT 0.00,
  `Enteredby` varchar(36) NOT NULL,
  `departmentid` int(11) NOT NULL,
  `Approvedby` varchar(36) DEFAULT NULL,
  `Approved` tinyint(1) DEFAULT 0,
  `approvalRequest` int(11) DEFAULT NULL,
  `Approveddate` date DEFAULT NULL,
  `Audited` tinyint(1) DEFAULT 0,
  `Auditedby` varchar(36) DEFAULT NULL,
  `Accounting_status` tinyint(1) DEFAULT 0,
  `payment_date` datetime DEFAULT NULL,
  `Created_date` date DEFAULT current_timestamp(),
  `staffname` varchar(36) DEFAULT NULL,
  `hrstatus` int(11) DEFAULT 0,
  `hrrequired` int(11) DEFAULT 0,
  `hrname` varchar(11) DEFAULT NULL,
  `claim_categoryid` int(11) DEFAULT NULL,
  `returned` tinyint(1) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `account_name` varchar(36) DEFAULT NULL,
  `account_number` int(11) DEFAULT NULL,
  `bank_name` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claims_header`
--

INSERT INTO `claims_header` (`id`, `claimtype`, `hospital_no`, `Patient_name`, `Payee`, `Amount`, `Enteredby`, `departmentid`, `Approvedby`, `Approved`, `approvalRequest`, `Approveddate`, `Audited`, `Auditedby`, `Accounting_status`, `payment_date`, `Created_date`, `staffname`, `hrstatus`, `hrrequired`, `hrname`, `claim_categoryid`, `returned`, `comment`, `account_name`, `account_number`, `bank_name`) VALUES
(11, 2, '', '', 'Ayinde kazeem O', '3500.00', 'ayindekazeem99@gmail.com', 2, '3', 1, 1, '2022-04-16', 1, '2', 1, '2022-04-16 00:00:00', '2022-04-16', 'Olanrewaju', 1, 1, '14', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 'IHL126', 'John Jide', 'Olalekan Samuel', '15000.00', 'ayindekazeem99@gmail.com', 2, NULL, 0, 0, NULL, 0, '2', 0, NULL, '2022-04-17', NULL, 0, 0, NULL, NULL, 1, 'Test return', NULL, NULL, NULL),
(13, 1, 'ISH013', 'Kennedy', 'John', '100.00', 'Auditor@gmail.com', 7, '0', 0, 0, '2022-04-18', 0, '2', 0, NULL, '2022-04-18', NULL, 0, 0, '0', NULL, 1, 'Test return Claim', NULL, NULL, NULL),
(14, 1, '221221', '2112', '212', '0.00', 'highbee4u@gmail.com', 2, NULL, 0, NULL, NULL, 0, '2', 0, NULL, '2022-04-20', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, 'ISH001', 'Gabriel', 'Okoh', '67000.00', 'highbee4u@gmail.com', 2, '2', 1, 1, '2022-04-22', 1, '2', 1, '2022-04-22 00:00:00', '2022-04-22', NULL, 1, 0, '2', NULL, 0, NULL, NULL, NULL, NULL),
(16, 2, '', '', '', '430.00', 'Auditor@gmail.com', 7, NULL, 0, 1, NULL, 0, '2', 0, NULL, '2022-04-22', 'Jide', 0, 0, '0', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 2, '', '', '', '220.00', 'Auditor@gmail.com', 7, '2', 1, 1, '2022-04-22', 1, '2', 0, NULL, '2022-04-22', 'Jide', 1, 0, '2', NULL, 0, NULL, NULL, NULL, NULL),
(18, 2, '', '', '', '67000.00', 'Auditor@gmail.com', 7, '3', 1, 1, '2022-04-22', 1, '2', 0, NULL, '2022-04-22', 'Kola', 1, 1, '14', NULL, 0, NULL, NULL, NULL, NULL),
(21, NULL, '', '', 'Test Receiver', '67000.00', 'Auditor@gmail.com', 7, '3', 1, 1, '2022-04-25', 1, '2', 0, NULL, '2022-04-25', NULL, 0, 0, '', 4, 0, NULL, NULL, NULL, NULL),
(22, NULL, 'ISH010', 'lala', 'Okoh', '0.00', 'Auditor@gmail.com', 7, NULL, 0, NULL, NULL, 0, '2', 0, NULL, '2022-04-25', NULL, 0, 0, '', 4, 0, NULL, 'lala Okoh', 129332139, 'Providus bank');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'procurement'),
(2, 'IT'),
(3, 'Client service'),
(4, 'Nursing'),
(5, 'Laboratory'),
(6, 'Accounting'),
(7, 'Audit'),
(8, 'BBC'),
(9, 'Quicbook'),
(10, 'Pharmacy'),
(11, 'Radiology'),
(12, 'Kitchen'),
(13, 'HR'),
(14, 'Main Store'),
(15, 'Quality Control'),
(16, 'HMO'),
(17, 'BCC');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemid` int(11) NOT NULL,
  `itemname` varchar(36) NOT NULL,
  `uom` int(11) NOT NULL,
  `itemtypeid` int(11) NOT NULL,
  `qty` decimal(10,4) DEFAULT NULL,
  `limit` int(11) DEFAULT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemid`, `itemname`, `uom`, `itemtypeid`, `qty`, `limit`, `createdby`) VALUES
(64, 'computer system', 10, 1, '3.0000', 2, 1),
(65, 'Television', 10, 1, NULL, 2, 1),
(66, 'A4 paper', 11, 1, '1.0000', 2, 1),
(67, 'Mouse', 10, 1, '9.0000', 2, 1),
(68, 'POS paper', 10, 1, '10.0000', 2, 1),
(69, 'computer system', 10, 2, '-1.0000', 0, 1),
(70, 'Television', 10, 2, NULL, 0, 1),
(71, 'Printer', 10, 2, '-1.0000', 0, 1),
(72, 'Printer refill', 10, 2, NULL, 0, 1),
(73, 'Hypo', 10, 1, '50.0000', 5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `item_movement`
--

CREATE TABLE `item_movement` (
  `id` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `flow` varchar(10) NOT NULL,
  `flowdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_movement`
--

INSERT INTO `item_movement` (`id`, `itemid`, `qty`, `flow`, `flowdate`) VALUES
(57, 67, 10, 'IN', '2022-04-16 00:00:00'),
(58, 68, 10, 'IN', '2022-04-16 00:00:00'),
(59, 66, 10, 'IN', '2022-04-16 00:00:00'),
(60, 69, -1, 'OUT', '2022-04-16 00:00:00'),
(61, 67, -1, 'OUT', '2022-04-16 00:00:00'),
(62, 66, -2, 'OUT', '2022-04-16 00:00:00'),
(63, 71, -1, 'OUT', '2022-04-16 00:00:00'),
(64, 66, -1, 'OUT', '2022-04-18 00:00:00'),
(65, 66, -1, 'OUT', '2022-04-18 00:00:00'),
(66, 66, -1, 'OUT', '2022-04-18 00:00:00'),
(67, 66, -1, 'OUT', '2022-04-18 00:00:00'),
(68, 73, 50, 'IN', '2022-04-18 01:29:57'),
(69, 64, 5, 'IN', '2022-04-18 06:09:51'),
(70, 66, -3, 'OUT', '2022-04-18 06:23:29'),
(71, 64, -2, 'OUT', '2022-04-22 12:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `refunds_detail`
--

CREATE TABLE `refunds_detail` (
  `id` int(11) NOT NULL,
  `refund_id` int(11) NOT NULL,
  `amount` decimal(19,4) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `refunds_detail`
--

INSERT INTO `refunds_detail` (`id`, `refund_id`, `amount`, `Description`) VALUES
(16, 7, '10000.0000', 'Over charges for investigation (Blood Group)'),
(17, 8, '20000.0000', 'for Over charges '),
(18, 9, '10000.0000', 'excess payment'),
(19, 10, '250.0000', 'test'),
(20, 11, '1200.0000', 'Test'),
(21, 13, '3000.0000', 'Test Flow'),
(22, 16, '9000.0000', 'uio'),
(23, 17, '67000.0000', 'yuyuy'),
(24, 19, '67000.0000', 'Test'),
(25, 20, '1400.0000', 'Test'),
(26, 21, '10000.0000', 'Excess Charge'),
(27, 22, '10.0000', 'Ten ten'),
(28, 23, '200.0000', 'xyz'),
(29, 24, '350000.0000', 'Excess Payment'),
(30, 25, '1200.0000', 'XYZ'),
(31, 27, '67000.0000', 'qwerty'),
(32, 28, '345.0000', 'tttt');

-- --------------------------------------------------------

--
-- Table structure for table `refunds_header`
--

CREATE TABLE `refunds_header` (
  `id` int(11) NOT NULL,
  `hospital_no` varchar(36) NOT NULL,
  `patient_name` varchar(36) NOT NULL,
  `account_name` varchar(36) DEFAULT NULL,
  `account_number` varchar(36) DEFAULT NULL,
  `amount` decimal(19,2) NOT NULL DEFAULT 0.00,
  `bank_name` varchar(36) DEFAULT NULL,
  `enteredby` varchar(36) NOT NULL,
  `departmentid` int(11) DEFAULT NULL,
  `hod_signature` varchar(36) DEFAULT NULL,
  `audited` tinyint(1) NOT NULL DEFAULT 0,
  `approval` tinyint(1) NOT NULL DEFAULT 0,
  `auditedby` tinyint(4) DEFAULT NULL,
  `approvedby` tinyint(4) DEFAULT NULL,
  `approveddate` date DEFAULT NULL,
  `approvalRequest` tinyint(1) NOT NULL DEFAULT 0,
  `accountant_status` tinyint(1) DEFAULT 0,
  `payment_date` datetime DEFAULT NULL,
  `returned` tinyint(1) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_hod` tinyint(1) NOT NULL DEFAULT 0,
  `is_bcc` tinyint(1) NOT NULL DEFAULT 0,
  `bcc` int(11) NOT NULL DEFAULT 0,
  `hod` int(11) NOT NULL DEFAULT 0,
  `hodrequired` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `refunds_header`
--

INSERT INTO `refunds_header` (`id`, `hospital_no`, `patient_name`, `account_name`, `account_number`, `amount`, `bank_name`, `enteredby`, `departmentid`, `hod_signature`, `audited`, `approval`, `auditedby`, `approvedby`, `approveddate`, `approvalRequest`, `accountant_status`, `payment_date`, `returned`, `comment`, `is_hod`, `is_bcc`, `bcc`, `hod`, `hodrequired`) VALUES
(7, 'IHL123', 'Aderibigbe Temitope', 'Aderibigbe Temitope', '0331458901', '10000.00', 'First Bank', 'Others@gmail.com', 3, NULL, 1, 1, 2, 3, '2022-04-16', 1, 1, '2022-04-16 06:19:20', NULL, NULL, 0, 0, 0, 0, 1),
(8, 'IHL126', 'Kolade', 'Aderibigbe Temitope', '0331458901', '20000.00', 'First Bank', 'ayindekazeem99@gmail.com', 2, NULL, 0, 0, 2, NULL, NULL, 1, 0, NULL, NULL, NULL, 0, 0, 0, 0, 1),
(9, 'IHL126', 'Alade', 'Aderibigbe Temitope', '0331458901', '10000.00', 'First Bank', 'ayindekazeem99@gmail.com', 2, NULL, 0, 0, 2, NULL, NULL, 1, 0, NULL, 1, 'Test return for refund', 0, 0, 0, 0, 1),
(10, 'ISH001', 'Test', 'Gabriel Afolayan', '0129332139', '250.00', 'GTB', 'Auditor@gmail.com', 7, NULL, 1, 1, 2, 2, '2022-04-22', 1, 1, '2022-04-22 01:22:41', 0, NULL, 0, 0, 0, 0, 1),
(11, 'ISH003', 'Test', 'Gabriel Afolayan', '0129332139', '1200.00', 'GTB', 'Auditor@gmail.com', 7, NULL, 1, 1, 2, 3, '2022-04-22', 1, 0, NULL, 0, NULL, 0, 0, 0, 0, 1),
(12, 'ISH001', 'Test', 'Gabriel Afolayan', '0129332139', '0.00', 'GTB', 'highbee4u@gmail.com', 2, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 1, 16, 16, 1),
(13, 'ISH010', 'Gabriel', 'John M', '0909090877', '3000.00', 'Access', 'highbee4u@gmail.com', 2, NULL, 0, 0, 2, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 0, 0, 17, 1),
(14, 'ISH001', 'Test', 'Gabriel Afolayan', '0129332139', '0.00', 'GTB', 'Auditor@gmail.com', 7, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, 0, 17, 1),
(15, 'ISH001', 'Test', 'Gabriel Afolayan', '0129332139', '0.00', 'GTB', 'Auditor@gmail.com', 7, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, 0, 17, 1),
(16, 'ISH002', 'Test', 'Gabriel Afolayan', '0129332139', '9000.00', 'GTB', 'Auditor@gmail.com', 7, NULL, 0, 0, NULL, NULL, NULL, 1, 0, NULL, 0, NULL, 1, 0, 0, 17, 1),
(17, 'ISH003', 'Test', 'John M', '0129332139', '67000.00', 'GTB', 'Auditor@gmail.com', 7, NULL, 0, 0, 2, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 0, 0, 15, 1),
(19, 'ISH001', 'Ibrahim Oladepo', 'John M', '0909090877', '67000.00', 'GTB', 'Auditor@gmail.com', 7, NULL, 0, 0, 2, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 0, 0, 17, 1),
(20, 'ISH010', 'Test', 'Alex', '0129332139', '1400.00', 'Access', 'Auditor@gmail.com', 7, NULL, 0, 0, 17, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 0, 16, 0, 1),
(21, 'ISH010', 'Test', 'Salami Ibrahim Adeyemi', '0129332139', '10000.00', 'GTB', 'Approval@gmail.com', 10, NULL, 0, 0, NULL, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 1, 16, 0, 1),
(22, 'ISH003', 'Gabriel', 'Afolayan', '12345', '10.00', 'Exodus Bank', 'Auditor@gmail.com', 7, NULL, 0, 0, 17, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 0, 16, 0, 1),
(23, 'ISH001', 'Test', 'Test', '0129332139', '200.00', 'Bank PHB', 'Auditor@gmail.com', 7, NULL, 0, 0, 2, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 0, 16, 17, 1),
(24, 'ISH002', 'oloye', 'Oloye', '12345678', '350000.00', 'Providus bank', 'Others@gmail.com', 3, NULL, 0, 0, 2, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 0, 16, 17, 1),
(25, 'ISH010', 'Test', 'Gabriel Afolayan', '0909090877', '1200.00', 'Access', 'highbee4u@gmail.com', 2, NULL, 0, 0, NULL, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 1, 16, 0, 1),
(26, 'ISH010', 'Test', 'John M', '0909090877', '0.00', 'Access', 'highbee4u@gmail.com', 2, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, 0, 17, 1),
(27, 'ISH010', 'Test', 'John M', '0129332139', '67000.00', 'GTB', 'highbee4u@gmail.com', 2, NULL, 0, 0, 2, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 0, 0, 17, 1),
(28, 'ISH002', 'Gabriel', 'Gabriel Afolayan', '0129332139', '345.00', 'GTB', 'highbee4u@gmail.com', 2, NULL, 0, 0, 2, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 0, 16, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `requisition_detail`
--

CREATE TABLE `requisition_detail` (
  `reqdetailid` int(11) NOT NULL,
  `reqnumber` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `qty` float NOT NULL,
  `uom` varchar(11) NOT NULL,
  `price` decimal(19,4) NOT NULL DEFAULT 0.0000
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisition_detail`
--

INSERT INTO `requisition_detail` (`reqdetailid`, `reqnumber`, `itemid`, `Description`, `qty`, `uom`, `price`) VALUES
(30, 31, 69, NULL, 1, 'Pcs', '185000.0000'),
(31, 32, 67, NULL, 1, 'Pcs', '0.0000'),
(32, 34, 71, NULL, 1, 'Pcs', '430000.0000'),
(33, 35, 66, NULL, 2, 'pack', '0.0000'),
(34, 36, 69, NULL, 1, 'Pcs', '200000.0000'),
(35, 39, 66, NULL, 1, 'pack', '1000.0000'),
(36, 40, 66, NULL, 1, 'pack', '0.0000'),
(37, 41, 73, NULL, 10, 'Pcs', '150.0000'),
(38, 42, 66, NULL, 3, 'pack', '1200.0000'),
(39, 43, 69, NULL, 2, 'Pcs', '150000.0000'),
(40, 44, 64, NULL, 2, 'Pcs', '0.0000'),
(41, 45, 64, NULL, 2, 'Pcs', '100.0000'),
(42, 46, 71, NULL, 45, 'Pcs', '0.0000');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_header`
--

CREATE TABLE `requisition_header` (
  `reqnumber` int(11) NOT NULL,
  `reqby` varchar(36) NOT NULL,
  `reqdate` datetime NOT NULL,
  `coment` varchar(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `audited` tinyint(1) NOT NULL DEFAULT 0,
  `auditedby` varchar(36) NOT NULL,
  `approvedby` varchar(36) DEFAULT NULL,
  `approvalRequest` int(11) NOT NULL DEFAULT 0,
  `voided` tinyint(1) NOT NULL DEFAULT 0,
  `req_description` varchar(255) DEFAULT NULL,
  `return` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `departmentid` int(11) NOT NULL,
  `returned` int(11) DEFAULT 0,
  `awaiting_price` int(11) NOT NULL DEFAULT 0,
  `requisitiontype` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `payment_date` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisition_header`
--

INSERT INTO `requisition_header` (`reqnumber`, `reqby`, `reqdate`, `coment`, `approved`, `audited`, `auditedby`, `approvedby`, `approvalRequest`, `voided`, `req_description`, `return`, `description`, `departmentid`, `returned`, `awaiting_price`, `requisitiontype`, `payment_status`, `payment_date`) VALUES
(31, 'ayindekazeem99@gmail.com', '2022-04-16 00:00:00', '', 1, 1, '2', '3', 1, 0, '', NULL, 'BCC employed an extra hand and they need a computer system.', 2, 0, 0, 2, 1, '2022-04-16 00:00:00'),
(32, 'Others@gmail.com', '2022-04-16 00:00:00', '', 1, 1, '2', '2', 1, 0, '', NULL, 'We need mouse at cash desk system1', 3, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(34, 'Accountant@gmail.com', '2022-04-16 04:32:46', '', 1, 1, '2', '3', 1, 0, '', NULL, 'We are in need of 2 packs of A4 papers', 6, 0, 0, 2, 1, '2022-04-16 04:57:36'),
(35, 'Others@gmail.com', '2022-04-16 04:41:14', '', 1, 1, '2', '2', 1, 0, '', NULL, 'A4 paper is needed at Inpatient billing', 3, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(36, 'ayindekazeem99@gmail.com', '2022-04-17 01:24:38', 'we can not afford the price, lets go for 150,000.00', 0, 0, '2', NULL, 1, 0, '', NULL, 'A computer system is needed at pharmacy unit', 2, 1, 0, 2, 0, '0000-00-00 00:00:00'),
(37, 'highbee4u@gmail.com', '2022-04-17 05:43:45', '', 0, 0, '2', NULL, 0, 0, NULL, NULL, 'Test', 2, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(38, 'highbee4u@gmail.com', '2022-04-17 05:48:04', '', 0, 0, '2', NULL, 0, 0, NULL, NULL, 'Yesterday', 2, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(39, 'highbee4u@gmail.com', '2022-04-18 07:17:23', '', 1, 1, '2', '2', 1, 0, NULL, NULL, 'Text', 2, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(40, 'Auditor@gmail.com', '2022-04-18 12:24:11', '', 0, 0, '2', NULL, 1, 0, NULL, NULL, 'Test ', 7, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(41, 'highbee4u@gmail.com', '2022-04-18 01:29:11', 'tytr', 0, 0, '2', NULL, 1, 0, NULL, NULL, 'Needed for ward Cleaning', 2, 1, 1, 1, 0, '0000-00-00 00:00:00'),
(42, 'Auditor@gmail.com', '2022-04-18 04:01:55', 'check the price', 1, 1, '2', '2', 1, 0, NULL, NULL, 'ABCD', 7, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(43, 'ayindekazeem99@gmail.com', '2022-04-18 06:10:11', 'check the price', 0, 1, '2', '3', 1, 0, NULL, NULL, 'computer needed at pharmacy unit', 2, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(44, 'highbee4u@gmail.com', '2022-04-21 03:30:02', '', 0, 0, '2', NULL, 1, 0, NULL, NULL, 'test', 2, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(45, 'Auditor@gmail.com', '2022-04-21 11:16:14', '', 1, 1, '2', '3', 1, 0, NULL, NULL, 'Test tonight', 7, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(46, 'Accountant@gmail.com', '2022-04-22 01:23:25', '', 0, 0, '2', NULL, 1, 0, NULL, NULL, 'yuyuy', 6, 0, 1, 2, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `id` int(11) NOT NULL,
  `uomname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`id`, `uomname`) VALUES
(10, 'Pcs'),
(11, 'pack'),
(12, 'dozen'),
(13, 'liters'),
(14, 'carton');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(36) NOT NULL,
  `email` varchar(36) NOT NULL,
  `password` varchar(36) NOT NULL,
  `user_roleid` int(11) NOT NULL,
  `login_attempt` int(11) NOT NULL DEFAULT 0,
  `departmentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_roleid`, `login_attempt`, `departmentid`) VALUES
(1, 'Kazeem Ayinde', 'ayindekazeem99@gmail.com', '902fbdd2b1df0c4f70b4a5d23525e932', -1, 0, 2),
(2, 'Auditor', 'Auditor@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, 7),
(3, 'Approval', 'Approval@gmail.com', '202cb962ac59075b964b07152d234b70', 2, 1, 10),
(4, 'Others', 'Others@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 1, 3),
(6, 'Procurement', 'procurement@gmail.com', '202cb962ac59075b964b07152d234b70', 3, 1, 1),
(7, 'Temitope Olanrewaju', 'temi@gmail.com', '767e955464233667bfd855686a55b352', 0, 1, 10),
(9, 'Ismaeel Olatunji', 'ismaeel@gmail.com', '767e955464233667bfd855686a55b352', 0, 1, 5),
(10, 'Adeyemi Esther', 'adeyemi@gmail.com', '767e955464233667bfd855686a55b352', 0, 1, 6),
(11, 'Henry', 'henry@gmail.com', '767e955464233667bfd855686a55b352', 0, 1, 8),
(12, 'Ibrahim', 'highbee4u@gmail.com', '202cb962ac59075b964b07152d234b70', -1, 1, 2),
(13, 'Accountant', 'Accountant@gmail.com', '202cb962ac59075b964b07152d234b70', 4, 1, 6),
(14, 'HR', 'hr@gmail.com', '202cb962ac59075b964b07152d234b70', 5, 1, 13),
(15, 'HMO', 'hmo@gmail.com', '202cb962ac59075b964b07152d234b70', 6, 1, 16),
(16, 'BCC', 'bcc@gmail.com', '202cb962ac59075b964b07152d234b70', 7, 1, 17),
(17, 'HOD', 'Hod@gmail.com', '202cb962ac59075b964b07152d234b70', 8, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `role_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claims_category`
--
ALTER TABLE `claims_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claims_detail`
--
ALTER TABLE `claims_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claims_header`
--
ALTER TABLE `claims_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemid`),
  ADD UNIQUE KEY `itemid` (`itemid`);

--
-- Indexes for table `item_movement`
--
ALTER TABLE `item_movement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `refunds_detail`
--
ALTER TABLE `refunds_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refunds_header`
--
ALTER TABLE `refunds_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition_detail`
--
ALTER TABLE `requisition_detail`
  ADD PRIMARY KEY (`reqdetailid`);

--
-- Indexes for table `requisition_header`
--
ALTER TABLE `requisition_header`
  ADD PRIMARY KEY (`reqnumber`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claims_category`
--
ALTER TABLE `claims_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `claims_detail`
--
ALTER TABLE `claims_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `claims_header`
--
ALTER TABLE `claims_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `item_movement`
--
ALTER TABLE `item_movement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `refunds_detail`
--
ALTER TABLE `refunds_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `refunds_header`
--
ALTER TABLE `refunds_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `requisition_detail`
--
ALTER TABLE `requisition_detail`
  MODIFY `reqdetailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `requisition_header`
--
ALTER TABLE `requisition_header`
  MODIFY `reqnumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
