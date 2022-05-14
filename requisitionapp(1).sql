-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2022 at 10:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

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
(8, 'Drugs', 'Drugs', '2022-05-05', 'it@isalu.com'),
(9, 'Test', 'Test', '2022-05-05', 'it@isalu.com'),
(10, 'Immunization', 'Immunization', '2022-05-05', 'it@isalu.com'),
(11, 'Generator & Lubricants', 'Generator & Lubricants', '2022-05-05', 'it@isalu.com'),
(12, 'Laboratory Reagents', 'Laboratory Reagents', '2022-05-05', 'it@isalu.com'),
(13, 'X-ray & Scan', 'X-ray & Scan', '2022-05-05', 'it@isalu.com'),
(14, 'Kitchen / Canteen Items', 'Kitchen / Canteen Items', '2022-05-05', 'it@isalu.com'),
(15, 'Household items', 'Household items', '2022-05-05', 'it@isalu.com'),
(16, 'Consultation', 'Consultation', '2022-05-05', 'it@isalu.com'),
(17, 'Directors\' Emolument', 'Directors\' Emolument', '2022-05-05', 'it@isalu.com'),
(18, 'Directors\' Fees', 'Directors\' Fees', '2022-05-06', 'it@isalu.com'),
(19, 'Salaries / Wages', 'Salaries / Wages', '2022-05-06', 'it@isalu.com'),
(20, 'Allowances', 'Allowances', '2022-05-06', 'it@isalu.com'),
(21, 'Staff Medical & Welfare', 'Staff Medical & Welfare', '2022-05-06', 'it@isalu.com'),
(22, 'Pension', 'Pension', '2022-05-06', 'it@isalu.com'),
(23, 'Training & Development', 'Training & Development', '2022-05-06', 'it@isalu.com'),
(24, 'PAYE', 'PAYE', '2022-05-06', 'it@isalu.com'),
(25, 'Commission: on referral', 'Commission: on referral', '2022-05-06', 'it@isalu.com'),
(26, 'Commission: on debt Recovery', 'Commission: on debt Recovery', '2022-05-06', 'it@isalu.com'),
(27, 'Performance Bonus', 'Performance Bonus', '2022-05-06', 'it@isalu.com'),
(28, 'Overtime', 'Overtime', '2022-05-06', 'it@isalu.com'),
(29, 'Payment in lieu of Leave ', 'Payment in lieu of Leave ', '2022-05-06', 'it@isalu.com'),
(30, 'A/C Repair and Maintenance', 'A/C Repair and Maintenance', '2022-05-06', 'it@isalu.com'),
(31, 'Ambulance Ford Repair and Maintenanc', 'Ambulance Ford Repair and Maintenance', '2022-05-06', 'it@isalu.com'),
(32, 'Ambulance Volkswagen Repair and Main', 'Ambulance Volkswagen Repair and Maintenance', '2022-05-06', 'it@isalu.com'),
(33, 'Bank Charges', 'Bank Charges', '2022-05-06', 'it@isalu.com'),
(34, 'Bank Interest', 'Bank Interest', '2022-05-06', 'it@isalu.com'),
(35, 'Big Gen Repair / maintenance', 'Big Gen Repair / maintenance', '2022-05-06', 'it@isalu.com'),
(36, 'Camry 2008 (GM 2) Repair and Mainten', 'Camry 2008 (GM 2) Repair and Maintenance', '2022-05-06', 'it@isalu.com'),
(37, 'Computer & Accessory', 'Computer & Accessory', '2022-05-06', 'it@isalu.com'),
(38, 'Electrical Maintenance', 'Electrical Maintenance', '2022-05-06', 'it@isalu.com'),
(39, 'Electrical Maintenance @ANNEX 1', 'Electrical Maintenance @ANNEX 1', '2022-05-06', 'it@isalu.com'),
(40, 'Electrical Maintenance @ANNEX 2', 'Electrical Maintenance @ANNEX 2', '2022-05-06', 'it@isalu.com'),
(41, 'Electrical Maintenance @ AY', 'Electrical Maintenance @ AY', '2022-05-06', 'it@isalu.com'),
(42, 'Equipment Maintenance', 'Equipment Maintenance', '2022-05-06', 'it@isalu.com'),
(43, 'Ford Edge (GM 3) Repair and Maintena', 'Ford Edge (GM 3) Repair and Maintenance', '2022-05-06', 'it@isalu.com'),
(44, 'Fueling - Ambulance Ford', 'Fueling - Ambulance Ford', '2022-05-06', 'it@isalu.com'),
(45, 'Fueling - Ambulance Volkswagen', 'Fueling - Ambulance Volkswagen', '2022-05-06', 'it@isalu.com'),
(46, 'Fueling - Big Gen', 'Fueling - Big Gen', '2022-05-06', 'it@isalu.com'),
(47, 'Fueling - Camry 2008 (GM 2)', 'Fueling - Camry 2008 (GM 2)', '2022-05-06', 'it@isalu.com'),
(48, 'Fueling - Ford Edge (GM3)', 'Fueling - Ford Edge (GM3)', '2022-05-06', 'it@isalu.com'),
(49, 'Fueling - Hilux', 'Fueling - Hilux', '2022-05-06', 'it@isalu.com'),
(50, 'Fueling - Toyota Highlander (CEO)', 'Fueling - Toyota Highlander (CEO)', '2022-05-06', 'it@isalu.com'),
(51, 'Fueling - Toyota Highlander (GM 1)', 'Fueling - Toyota Highlander (GM 1)', '2022-05-06', 'it@isalu.com'),
(52, 'Fueling - Toyota Sienna', 'Fueling - Toyota Sienna', '2022-05-06', 'it@isalu.com'),
(53, 'Fueling - tricycle', 'Fueling - tricycle', '2022-05-06', 'it@isalu.com'),
(54, 'Gen Repair / Maintenance', 'Gen Repair / Maintenance', '2022-05-06', 'it@isalu.com'),
(55, 'Gen Repair / Maintenance @ Annex 2 -', 'Gen Repair / Maintenance @ Annex 2 - 100KVA', '2022-05-06', 'it@isalu.com'),
(56, 'Gen Repair / Maintenance @ Annex 2 -', 'Gen Repair / Maintenance @ Annex 2 - 60KVA', '2022-05-06', 'it@isalu.com'),
(57, 'Gen Repair / Maintenance @ AY - 135K', 'Gen Repair / Maintenance @ AY - 135KVA', '2022-05-06', 'it@isalu.com'),
(58, 'Gen Repair / Maintenance @ AY - 350K', 'Gen Repair / Maintenance @ AY - 350KVA', '2022-05-06', 'it@isalu.com'),
(59, 'Gen Repair / Maintenance @ CEO - 5KV', 'Gen Repair / Maintenance @ CEO - 5KVA', '2022-05-06', 'it@isalu.com'),
(60, 'General Maintenance', 'General Maintenance', '2022-05-06', 'it@isalu.com'),
(61, 'Hilux Repair and maintenance ', 'Hilux Repair and maintenance ', '2022-05-06', 'it@isalu.com'),
(62, 'Housekeeping ', 'Housekeeping', '2022-05-06', 'it@isalu.com'),
(63, 'Insurance / Pension', 'Insurance / Pension', '2022-05-06', 'it@isalu.com'),
(64, 'License Renewal Charges', 'License Renewal Charges', '2022-05-06', 'it@isalu.com'),
(65, 'Light & Heat (PHCN)', 'Light & Heat (PHCN)', '2022-05-06', 'it@isalu.com'),
(66, 'Electricity Bill @ ANNEX 2', 'Electricity Bill @ ANNEX 2', '2022-05-06', 'it@isalu.com'),
(67, 'Electricity Bill @ AY', 'Electricity Bill @ AY', '2022-05-06', 'it@isalu.com'),
(68, 'MD Domestic / Med. Exps', 'MD Domestic / Med. Exps', '2022-05-06', 'it@isalu.com'),
(69, 'Office & Utility Expenses', 'Office & Utility Expenses', '2022-05-06', 'it@isalu.com'),
(70, 'Postage ', 'Postage', '2022-05-06', 'it@isalu.com'),
(71, 'Telephone', 'Telephone', '2022-05-06', 'it@isalu.com'),
(72, 'Newspaper & Periodicals', 'Newspaper & Periodicals', '2022-05-06', 'it@isalu.com'),
(73, 'PR / Entertainment', 'PR / Entertainment', '2022-05-06', 'it@isalu.com'),
(74, 'Printing', 'Printing', '2022-05-06', 'it@isalu.com'),
(75, 'Stationery ', 'Stationery ', '2022-05-06', 'it@isalu.com'),
(76, 'Rent', 'Rent', '2022-05-06', 'it@isalu.com'),
(77, 'Rates', 'Rates', '2022-05-06', 'it@isalu.com'),
(78, 'Sales Commission', 'Sales Commission', '2022-05-06', 'it@isalu.com'),
(79, 'Sundry / Advertisement ', 'Sundry / Advertisement ', '2022-05-06', 'it@isalu.com'),
(80, 'Taxes ', 'Taxes', '2022-05-06', 'it@isalu.com'),
(81, 'Renovation', 'Renovation', '2022-05-06', 'it@isalu.com'),
(82, 'Tax Consultancy Fee', 'Tax Consultancy Fee', '2022-05-06', 'it@isalu.com'),
(83, 'Toyota Highlander (CEO) Repair and M', 'Toyota Highlander (CEO) Repair and Maintenance ', '2022-05-06', 'it@isalu.com'),
(84, 'Toyota Highlander (GM 1) Repair and ', 'Toyota Highlander (GM 1) Repair and Maintenance ', '2022-05-06', 'it@isalu.com'),
(85, 'Toyota Sienna Repair and Maintenance', 'Toyota Sienna Repair and Maintenance', '2022-05-06', 'it@isalu.com'),
(86, 'Transport / Travel', 'Transport / Travel', '2022-05-06', 'it@isalu.com'),
(87, 'Tricycle Repair and Maintenance', 'Tricycle Repair and Maintenance', '2022-05-06', 'it@isalu.com'),
(88, 'Security Expenses', 'Security Expenses', '2022-05-06', 'it@isalu.com'),
(89, 'Refund to Patients', 'Refund to Patients', '2022-05-06', 'it@isalu.com'),
(90, 'Audit Fees', 'Audit Fees', '2022-05-06', 'it@isalu.com'),
(91, 'Legal Charges', 'Legal Charges', '2022-05-06', 'it@isalu.com'),
(92, 'Other Professional Consultancy Fee', 'Other Professional Consultancy Fee', '2022-05-06', 'it@isalu.com'),
(93, 'Spectranet Subscription', 'Spectranet Subscription', '2022-05-09', 'it@isalu.com'),
(94, 'LAWMA', 'LAWMA CHARGES', '2022-05-11', 'it@isalu.com'),
(95, 'SITE WORKS', 'SITE WORK', '2022-05-11', 'it@isalu.com'),
(96, 'POWER PACK', 'POWER PACK', '2022-05-11', 'it@isalu.com'),
(97, 'INDUCTEE', 'INDUCTION', '2022-05-11', 'it@isalu.com'),
(98, 'REFRESHMENT ', 'REFRESHMENT', '2022-05-11', 'it@isalu.com'),
(99, 'Snacks', 'Snacks', '2022-05-11', 'it@isalu.com'),
(100, 'Drinks', 'Drinks', '2022-05-11', 'it@isalu.com'),
(101, 'Space', 'Space', '2022-05-11', 'it@isalu.com'),
(102, 'IT', 'IT', '2022-05-11', 'it@isalu.com'),
(103, 'Diesel', 'Diesel', '2022-05-11', 'it@isalu.com'),
(104, 'Building Materials', 'Building Materials', '2022-05-11', 'it@isalu.com'),
(105, 'physiotherapist', 'physiotherapist', '2022-05-11', 'it@isalu.com'),
(106, 'WEBSITE/BLOG', 'WEBSITE/BLOG', '2022-05-12', 'it@isalu.com'),
(107, 'Extra Duty', 'Extra Duty', '2022-05-13', 'it@isalu.com'),
(108, 'Prepaid Recharge (Annex 2)', 'Prepaid Recharge (Annex 2)', '2022-05-13', 'it@isalu.com'),
(109, 'EXTERNAL INVESTIGATION (LAB/RADIOLOG', 'EXTERNAL INVESTIGATION', '2022-05-13', 'it@isalu.com'),
(110, 'CUG subscription ', 'CUG subscription', '2022-05-13', 'it@isalu.com');

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
(25, 27, '20000.0000', 'For Spectranet Subscriptions (Annex 2 usage).'),
(31, 33, '1000.0000', '3 Pepsi  (N450), 1 buiscuit (N50), 3 coke (450),  one craker buiscuit (N50)'),
(32, 34, '51000.0000', 'PAYMENT FOR 3 PINTS OF BLOOD--INV NUB 05327.'),
(33, 34, '51000.0000', 'PAYMENT FOR 3 PINT OF BLOOD -----INV NUMB 05325'),
(35, 35, '68000.0000', ' PAYMENT FOR 4 PINT OF BLOOD----INV NUMB 05734'),
(36, 36, '34000.0000', 'PAYMENT FOR 2 PINTS OF BLOOD---INV NUM 02472'),
(37, 37, '750.0000', 'Samson Adekomaya   (Nursing)\nEzenwaka Chiamaka   (Nursing)\nDr Ogbonna         (Doctor)'),
(38, 38, '1750.0000', 'Refreshment for intending employee'),
(48, 44, '7750.0000', 'REPLACEMENT OF MICROWAVE ELEMENT '),
(49, 44, '1500.0000', 'TRANSPORTATION TO PURCHASE OF ELEMENT FOR MICROWAVE'),
(61, 51, '245857.0000', '2% commission on sales turnover'),
(62, 52, '1100.0000', 'PURCAHSE OF 2PCS OF BULB @ 300 AND 4 MINUTE GUM 500'),
(63, 53, '30000.0000', '2PCS OF HP 840 KEYBOARD 2 15000'),
(64, 54, '150000.0000', 'PLASTERING OF STAIRCASE STRINGERS AND SOFFIT '),
(65, 55, '90000.0000', '180AH DEEP CYCLE BATTERIES'),
(66, 55, '5000.0000', 'TRANSPORTATION'),
(67, 55, '7125.0000', 'VAT'),
(68, 56, '37600.0000', 'SERVICING OF 60KVA GEN. SET'),
(69, 56, '20000.0000', 'ELECTRICAL REPAIRS (LAPTOP DETECTION)'),
(70, 56, '4320.0000', 'VAT 7.5%'),
(71, 57, '10000.0000', 'REMOVAL OF SCALFOLDING CLIPS '),
(72, 59, '1679538.0000', 'APRIL NEPA BILL @ A Y'),
(73, 60, '4500.0000', 'COMPLETE DOOR KEY @ NEW DOCTORS ROOM'),
(74, 60, '4440.0000', '12 YARDS OF SAND PAPER'),
(75, 61, '132000.0000', '12 CARTONS OF A4 PAPER'),
(76, 61, '3600.0000', '2 PACKS OF HIGHER EDUCATION'),
(77, 61, '5700.0000', '3 PCS OF 12 IN ONE NOTE'),
(78, 61, '4400.0000', '2 PACKS OF 80 LEAVES'),
(79, 61, '2500.0000', '1 PCS OF CALCULATOR'),
(80, 61, '12600.0000', '9PCS OF HARD COVER NOTE '),
(81, 61, '14000.0000', '14 PCS OF HARDCOVER NOTE LONG @1000'),
(82, 61, '7000.0000', '1 CARTON OF WHITE ENVELOPE'),
(83, 61, '1200.0000', '2 PACKS OF PERMANENT MAKER @ 600'),
(84, 61, '2400.0000', '2 PCS OF PUNCH @ 1200'),
(85, 61, '1800.0000', '1PCS OF STAPLER'),
(86, 61, '6000.0000', '12PCS OF TABLE PEN @ 500'),
(87, 61, '1200.0000', '12 PCS OF TIPPEX @ 100'),
(88, 61, '600.0000', '6 PCS HIGH LIGHT @ 100'),
(89, 61, '2800.0000', '2 PACKS OF BIRO @ 1400'),
(90, 61, '18500.0000', '1 CARTON OF ABRO PAPER TAPE'),
(91, 61, '18000.0000', '2 CARTONS OF POS PAPER @ 9000'),
(92, 61, '49000.0000', '2 CARTONS OF 80X80 PAPER BIXOLON PAPER @ 24500'),
(93, 61, '4900.0000', '7 PACKS OF  BROWN ENVELOPE @ 700'),
(94, 61, '3000.0000', '2 PCS OF PUNCH @ 1500 WITH INVOICE NUMBER (0011541 , 0011542 AND 0014133.'),
(95, 62, '1679539.0000', 'APRIL NEPA BILL FOR 2022 IN ISALU HOSPITALS LIMITED'),
(96, 63, '3175000.0000', '5000LITRES OF DIESEL TO BE SUPPLY @ 635 TO ISALU HOSPITALS LIMITED'),
(97, 64, '1270000.0000', '2000LITRE OF DIESEL @ SITE @ 635'),
(98, 65, '4000.0000', 'WIRING WORK AT HMO AND DOCTORS ROOM IN AY'),
(99, 66, '90000.0000', '180AH DEEP CYCLE BATTERIES'),
(100, 66, '5000.0000', 'TRANSPROTATION'),
(101, 66, '6750.0000', 'VAT 0N COST 7.5%'),
(102, 67, '37600.0000', 'SERVICING OF 60KVA GEN. SET'),
(103, 67, '20000.0000', 'ELECTRICAL REPAIRS ON LAPTOP DETECTION'),
(104, 67, '4275.0000', 'VAT ON COST 7.5%'),
(105, 68, '5000.0000', 'DATA SUBSCRIPTION'),
(108, 69, '1000.0000', 'SEDIK MOHAMMED'),
(109, 69, '1000.0000', 'OBI FELIX'),
(110, 69, '1000.0000', 'ANOKAM UCHECHUKWU'),
(111, 69, '1000.0000', 'AKIGBOGUN OMOTOMILOLA'),
(112, 69, '1000.0000', 'IMAJI FARUNA'),
(113, 69, '1000.0000', 'OSUNLETI ADEBISI'),
(114, 69, '1000.0000', 'MBAEGBU EZINNE'),
(115, 69, '1000.0000', 'AKANDE OMOBOLANLE'),
(116, 69, '1000.0000', 'ADEBAYO OLAJIDE'),
(117, 70, '2500.0000', 'For local government vaccine.'),
(118, 71, '5000.0000', 'BALANCE PAYMENT FOR ROOFING WORK @ AY AND ANNEX 1 AND INITIAL PAYMENT WAS 12000 AND WE GAVE HIM 7000 BEFORE AND NOW 5000'),
(120, 73, '18705.0000', 'VAT ON COST OF 249400 (7.5%)'),
(123, 75, '7500.0000', '1500*5 PACKS OF DRINKS FOR MOTHER-CRAFT'),
(124, 75, '16800.0000', '280*60PCS OF SNACKS FOR MOTHER-CRAFT'),
(125, 75, '25000.0000', 'AY SPACE FOR MOTHER-CRAFT LECTURE'),
(128, 77, '5000.0000', 'DATA SUBSCRIPTION FOR WEBSITE / BLOG '),
(129, 78, '81400.0000', '6pcs gall of white paints. (N9000 each), 1pc of white paints, (8500 each). 6pcs gallon of thiner (N300 each). 3pcs of filler (N3000 each) for painting of Doctors Rm, HMO, Rm 103, Rm 104 '),
(130, 79, '36000.0000', 'Additional paints for painting Doctors Rm, HMO, Rm 103 and Rm 104.\n4 gallons pitches @ N9000each\n'),
(131, 72, '1410000.0000', 'Site Annex\n6pcs of Midea split unit AC @N235,000 each.'),
(133, 81, '1410000.0000', 'PURCHASE OF 6PCS OF AIR CONDITION @ SITE ANNEX @ 235,000'),
(134, 82, '56545.0000', '65kva generator maintenance in Annex2. see invoice no: ISL/G/022/004'),
(135, 83, '500.0000', '3 cocacola (450) 1 biscuit  (50)'),
(137, 83, '500.0000', '3 pepsi (450) 1 cracker biscuite (50)'),
(139, 84, '1410000.0000', '6PCS OF AIR CONDITIONER @ 235,000 FOR ADMIN STAFF @ SITE ANNEX '),
(140, 85, '1750.0000', 'Refreshment for intending employees\n7 cokes  (1050)\n7 biscuits  (700)'),
(141, 86, '5000.0000', 'PURCHASE OF 2PCS OF PAN CONNECTOR @ 2500 IN NURSERY UNIT AND BALM GILEAD HOUSE BESIDE SITE ANNEX (IOU)'),
(142, 87, '8000.0000', 'change of fuel pump chamber  I.O.U'),
(143, 88, '1000.0000', 'Additional payment for furniture work at AY ( couch consulting room 6)'),
(144, 92, '1000.0000', 'GUM Small plastic for New doctors room Rug carpet'),
(145, 92, '3000.0000', 'small size chain  2pcs 1500 each'),
(146, 91, '85000.0000', 'Purchase of 20tonnes of sharp sand for site annex stampede concrete works. See invoice 00025'),
(147, 92, '800.0000', 'Pad Lock for fuel keg'),
(148, 93, '85000.0000', 'Purchase of sharp sand for Site Annex. See Invoice 00025'),
(149, 94, '1000.0000', 'transportation allowance'),
(150, 95, '30000.0000', '2PCS OF WALL FAN @ 15000 FOR ADMIN STAFF IN SITE ANNEX'),
(151, 96, '30000.0000', '2PCS OF WALL FAN @15000 FOR ADMIN STAFF IN SITE ANNEX AS IOU'),
(152, 97, '18705.0000', 'BALANCE PAYMENT FOR VAT @ SITE ANNEX'),
(153, 98, '80000.0000', 'ESTIMATE OF GATE REPAIR'),
(155, 99, '5500.0000', 'BREAD'),
(156, 99, '200.0000', 'SCENT LEAF'),
(157, 99, '700.0000', 'UGU'),
(158, 99, '3000.0000', 'EFOR'),
(159, 99, '1000.0000', 'AGIDI'),
(160, 99, '3000.0000', 'EJA KIKA'),
(161, 99, '500.0000', 'EWEDU'),
(162, 99, '15000.0000', 'CAT FISH'),
(163, 99, '3000.0000', 'PLAINTAIN'),
(164, 99, '32000.0000', 'GAS'),
(167, 100, '800.0000', ' 1pcs of padlock to secure the fuel @ Annex 2'),
(168, 100, '3000.0000', '2pcs of chain @ 1500 to secure the fuel @ Annex 2 '),
(169, 100, '1000.0000', '1pcs of evostic gum to gum the carpet @ doctors room in Annex 1'),
(170, 101, '4000.0000', 'For Extra duty'),
(171, 102, '50000.0000', 'Subscription of  prepaid meter in ANX 2  '),
(172, 104, '293700.0000', 'STATIONERIES FOR THE MONTH OF MAY 2022 IN ISALU WITH THE INVOICE NUMBER OF (0011541 AND 0011542)'),
(173, 105, '50000.0000', 'Subscription of prepaid meter ANX 2 I.O.U'),
(178, 106, '34000.0000', 'PAYMENT FOR 2 PINTS OF BLOOD----INV NUMB 05735'),
(180, 107, '58000.0000', 'PAYMENT FOR 5 PINTS OF BLOOD --- INV NUMB 05334'),
(181, 108, '1600.0000', 'RENTAGE FOR CHAIR OF 2 DOZEN @ 800 FOR MOTHERCRAFT ON SATURDAYS 14/5/2022 IN ISALU'),
(182, 109, '1000.0000', 'PURCHASE OF BUSHING FOR FIXING OF NEW PUMP @ AY (IOU)'),
(183, 109, '1400.0000', 'PAN CONNECTOR IN STAFF TOILET (IOU)'),
(184, 109, '4000.0000', 'LONG NECK TAP @ AY KITCHEN SINK (IOU)'),
(186, 110, '38000.0000', 'SUPPLY OF 16BAGS OF TISSUE PAPER @2375 FROM BELIMPEX COMPANY'),
(187, 110, '205000.0000', 'SUPPLY OF 600PCS OF BAGS @ 341.67'),
(189, 114, '70560.0000', 'HYPARXIS INTEGRATED SOLUTIONS FOR THE MONTH OF APRIL'),
(190, 113, '38000.0000', 'SUPPLY OF 16BAGS OF TISSUE PAPER 2375 FROM BELIMPEX COMPANY TO ISALU '),
(191, 113, '205000.0000', 'SUPPLY OF 600PCS OF BAGS @ 341.67 FROM LAGOS ISLAND'),
(192, 113, '591200.0000', 'OTHERS ITEMS ARE TO BE PURCHASE FROM OPEN MARKET (IOU)'),
(193, 116, '23200.0000', '0.45M LONGSTANDING SHEET 8M @ 2900'),
(194, 115, '2000.0000', 'Being cost of changing Nursing station Annex 1 down and the Ward Managers CUG charging points'),
(195, 116, '1000.0000', 'NAIL'),
(196, 116, '3000.0000', 'TRANSPORTATION'),
(197, 116, '15000.0000', 'WORKMANSHIP'),
(198, 120, '38000.0000', 'SUPPLY OF 16BAGS OF TISSUE PAPER @ 2375 FROM BELIMPEX COMPANY (IOU)'),
(199, 120, '205000.0000', 'SUPPLY OF 600PCS OF BAGS @ 341.67 FROM LAGOS ISLAND'),
(200, 120, '591200.0000', 'OTHERS ITEM WILL BE BUY FROM OPEN MARKET (IOU)'),
(201, 121, '205000.0000', 'SUPPLY OF 600PCS OF BAGS @ 341.67 FROM LAGOS ISLAND (IOU)'),
(202, 121, '38000.0000', '16BAGS OF TISSUE PAPER @ 2375 FROM BELIMPEX COMPANY (IOU)'),
(203, 121, '591200.0000', 'OTHERS WILL BE PURCHASE FROM THE OPEN MARKET (IOU)'),
(204, 122, '6059.3000', 'AMAZON WEB SERVICE SUBSCRIPTION FOR THE MONTH OF APRIL ($10.27 at the rate of N590)'),
(205, 123, '25000.0000', 'PURCHASE OF TOKUNBO AUTOMATOR FOR GREEN HIGHLANDER'),
(206, 123, '3000.0000', 'WORKMANSHIP FOR REPAIR OF GREEN HIGHLANDER AUTOMATOR'),
(209, 124, '6000.0000', '3PCS OF 18WATT LED LIGHT @ 2000 FOR OLD DOCTORS ROOM'),
(211, 127, '71100.0000', 'Being payment for external investigation (BRAIN MRI) @ clinx '),
(212, 128, '25000.0000', 'PURCHASE OF TOKUNBO ALTERNATOR'),
(213, 128, '3000.0000', 'WORKMANSHIP FOR REPAIR OF GREEN HIGHLANDER ALTERNATOR FOR GM 1 OFFICIAL CAR'),
(214, 129, '80000.0000', 'Repair of site Annex Gate '),
(215, 130, '85000.0000', 'PAYMENT FOR 5PINTS OF BLOOD INV NUMB 05334 (CORRECTED ONE )'),
(217, 131, '2000.0000', 'BEING PAYMENT FOR THE OVERTIME DONE IN PLACE OF IKENA CHIDIKE THAT WAS ABSENT FROM DUTY ON SUNDAY, MAY 1, 2022'),
(218, 132, '2000.0000', 'BEING PAYMENT FOR THE OVERTIME DONE IN PLACE OF GODWIN IDZI) THAT WAS ABSENT FROM DUTY ON SUNDAY, MAY 1, 2022'),
(219, 133, '4000.0000', 'BEING ABSENT FROM DUTY FOR GODWIN IDZI AND IKENNA CHIDIKE(3D SECURITY)  ON SUNDAY, MAY 1, 2022'),
(220, 135, '7000.0000', 'purchase of Dopamin injection emergency I.O.U'),
(221, 136, '4000.0000', 'WARDROUND DOCTOR	09095994080, NEW CALL DOCTOR	08096938058, MAINTENANCE AY	08093930762, PHARMACY GENERAL (OFFICE)	08172001529\n'),
(222, 137, '4000.0000', 'RECHARGE OF CUG MONTHLY SUBSCRIPTION ON THE FOLLOWING CUG LINES\nWARDROUND DOCTOR	9095994080\nNEW CALL DOCTOR	8096938058\nMAINTENANCE AY	8093930762\nPHARMACY GENERAL (OFFICE)	8172001529\n');

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
  `approvalRequest` int(11) DEFAULT 0,
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
(27, NULL, 'Nill', NULL, 'IT Department', '20000.00', 'it@isalu.com', 2, '19', 1, 1, '2022-05-09', 1, '19', 1, '2022-05-10 10:51:07', '2022-05-09', NULL, 1, 0, '19', 93, 0, NULL, 'IT Department', 0, 'IT Department'),
(33, NULL, '', NULL, 'Amadi Maureen', '1000.00', 'kitchen@isaluhospitals.com', 12, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 0, 0, '', 94, 1, 'Re-raised one approved today 12/5/2022', '', 0, ''),
(34, NULL, '', NULL, 'ORIS MEDICAL LABORATORY', '102000.00', 'laboratory@isaluhospitals.com', 5, '19', 1, 1, '2022-05-11', 1, '19', 1, '2022-05-11 02:02:36', '2022-05-11', NULL, 1, 0, '19', 12, 0, NULL, '', 0, ''),
(35, NULL, '', NULL, 'DIAMOND MEDICAL LABORATORY', '68000.00', 'laboratory@isaluhospitals.com', 5, '19', 1, 1, '2022-05-11', 1, '19', 1, '2022-05-11 02:02:44', '2022-05-11', NULL, 1, 0, '19', 12, 0, NULL, '', 0, ''),
(36, NULL, '', NULL, 'SIFOMEDICS LABORATORY', '34000.00', 'laboratory@isaluhospitals.com', 5, '19', 1, 1, '2022-05-11', 1, '19', 1, '2022-05-11 02:02:48', '2022-05-11', NULL, 1, 0, '19', 12, 0, NULL, '', 0, ''),
(37, NULL, '', NULL, 'Amadi Maureen', '750.00', 'kitchen@isaluhospitals.com', 12, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-13 04:55:05', '2022-05-11', NULL, 1, 1, '19', 97, 0, NULL, '', 0, ''),
(38, NULL, '', NULL, 'Amadi Maureen', '1750.00', 'kitchen@isaluhospitals.com', 12, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 1, 1, '23', 98, 1, 'IT to properly route the process', '', 0, ''),
(44, NULL, '', NULL, 'SUNDAY IDUMA', '9250.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-11', 1, '19', 1, '2022-05-11 06:05:30', '2022-05-11', NULL, 1, 0, '19', 60, 0, NULL, '', 0, ''),
(51, NULL, '', NULL, 'Kareem Fatai', '245857.00', 'account@isaluhospitals.com', 6, '19', 1, 1, '2022-05-11', 1, '19', 1, '2022-05-12 08:44:07', '2022-05-11', NULL, 1, 0, '19', 26, 0, NULL, '', 0, ''),
(52, NULL, '', NULL, 'MR TAIWO DAVID', '1100.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-11', 1, '19', 1, '2022-05-12 08:44:16', '2022-05-11', NULL, 1, 0, '19', 84, 0, NULL, '', 0, ''),
(53, NULL, '', NULL, 'RIDWON DAYABASE AND TECHNOLOGY SERVI', '30000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 0, 0, '', 102, 1, 'Not Properly Described', 'KAREEM RIDWON', 2120114016, 'UBA'),
(54, NULL, '', NULL, 'AKINKUNBI NIGERIA LIMITED', '150000.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-11', 1, '19', 1, '2022-05-12 08:44:20', '2022-05-11', NULL, 1, 0, '19', 95, 0, NULL, '', 0, ''),
(55, NULL, '', NULL, 'LINKWAY TECHNOLOGIES LIMITED', '102125.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 0, 0, '', 95, 1, 'VAT wrongly invoiced - N6,750 as against N7,125', '', 0, ''),
(56, NULL, '', NULL, 'REAL TECHNOLOGIES LIMITED', '61920.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 0, 0, '', 56, 1, 'Returned for Negotiation', '', 0, ''),
(57, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '10000.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-12 02:54:10', '2022-05-11', NULL, 1, 0, '19', 95, 0, NULL, '', 0, ''),
(58, NULL, '', NULL, 'IKEDC', '0.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 0, 0, '', 67, 0, NULL, '', 0, ''),
(59, NULL, '', NULL, 'IKEDC', '1679538.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 0, 0, '', 67, 1, 'Wrong Amount', '', 0, ''),
(60, NULL, '', NULL, 'SEKINAT RAJI', '8940.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-11', 1, '19', 1, '2022-05-12 08:44:24', '2022-05-11', NULL, 1, 0, '19', 104, 0, NULL, '', 0, ''),
(61, NULL, '', NULL, 'STATIONERY', '291200.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 0, 0, '', 75, 1, 'Not Properly Described/Processed', '', 0, ''),
(62, NULL, '', NULL, 'IKEDC', '1679539.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-11', 1, '19', 1, '2022-05-12 08:44:29', '2022-05-11', NULL, 1, 0, '19', 67, 0, NULL, '', 0, ''),
(63, NULL, '', NULL, 'DIESEL PLUS OIL AND GAS', '3175000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 0, 0, '', 103, 1, 'Not properly Documented', '', 0, ''),
(64, NULL, '', NULL, 'DIESEL PLUS OIL AND GAS', '1270000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 0, 0, '', 95, 1, 'Not properly Documented', '', 0, ''),
(65, NULL, '', NULL, 'IDRIS ABDULKAREEM ', '4000.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-12 12:47:26', '2022-05-11', NULL, 1, 0, '19', 60, 0, NULL, '', 0, ''),
(66, NULL, '', NULL, 'LINKWAY TECHNOLOGIES LIMITED', '101750.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-12 12:15:55', '2022-05-11', NULL, 1, 0, '19', 42, 0, NULL, '', 0, ''),
(67, NULL, '', NULL, 'REAL TECHNOLOGIES LIMITED', '61875.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 0, 0, '', 56, 1, 'For Re-negotiation', '', 0, ''),
(68, NULL, '', NULL, 'KEVIN DARIAN', '5000.00', 'it@isalu.com', 2, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 0, 0, '', 102, 1, 'Not Properly Described', '', 0, ''),
(69, NULL, '', NULL, 'DR SANGOBIYI TOPE', '9000.00', 'clientservice@isaluhospitals.com', 3, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-11', NULL, 0, 0, '', 105, 1, 'Patients Hospital Numbers are not indicated to ease checking', '', 0, ''),
(70, NULL, 'nill', NULL, 'oyenuga omotee', '2500.00', 'pharmacy@isaluhospitals.com', 10, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-12 09:43:28', '2022-05-12', NULL, 1, 0, '19', 10, 0, NULL, '', 0, ''),
(71, NULL, '', NULL, 'ALABI ADERONKE A', '5000.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-12 11:23:21', '2022-05-12', NULL, 1, 0, '19', 60, 0, NULL, '', 0, ''),
(72, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '1410000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 1, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 95, 1, 'Wrong Description', '', 0, ''),
(73, NULL, '', NULL, 'WORTHWHILE VENTURES LIMITED', '18705.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 95, 1, 'Duplication', 'WORTHWHILE VENTURES LIMITED', 1770002011, 'POLARIS BANK LTD'),
(74, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '0.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 95, 1, 'Not Properly Described', '', 0, ''),
(75, NULL, '', NULL, 'AWA GEORGINA', '49300.00', 'clientservice@isaluhospitals.com', 3, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-12 10:51:44', '2022-05-12', NULL, 1, 0, '19', 98, 0, NULL, '', 0, ''),
(77, NULL, '1097', NULL, 'KEVIN DARIAN', '5000.00', 'it@isalu.com', 2, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-12 12:55:20', '2022-05-12', NULL, 1, 0, '19', 106, 0, NULL, '', 0, ''),
(78, NULL, '', NULL, 'Folorunsho Jimoh', '81400.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-12 02:53:56', '2022-05-12', NULL, 1, 0, '19', 81, 0, NULL, 'Folorunsho Jimoh', 2002552068, 'Zenith Bank'),
(79, NULL, '', NULL, 'Folorunsho Jimoh', '36000.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-12 02:54:27', '2022-05-12', NULL, 1, 0, '19', 81, 0, NULL, 'Folorunsho Jimoh', 2002552068, 'Zenith Bank'),
(81, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '1410000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 95, 1, 'Re-raised ', '', 0, ''),
(82, NULL, '', NULL, 'Realtech Technologies', '56545.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-12', 1, '19', 0, NULL, '2022-05-12', NULL, 1, 0, '19', 55, 0, NULL, 'Realtech Technologies ', 0, 'Cheque'),
(83, NULL, '', NULL, 'Amadi Maureen', '1000.00', 'kitchen@isaluhospitals.com', 12, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-13 04:55:33', '2022-05-12', NULL, 1, 0, '19', 94, 0, NULL, '', 0, ''),
(84, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '1410000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 95, 1, 'KIV', '', 0, ''),
(85, NULL, '', NULL, 'Amadi Maureen', '1750.00', 'kitchen@isaluhospitals.com', 12, '19', 1, 1, '2022-05-13', 1, '19', 1, '2022-05-13 04:55:20', '2022-05-12', NULL, 1, 1, '19', 98, 0, NULL, '', 0, ''),
(86, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '5000.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-12 06:06:37', '2022-05-12', NULL, 1, 0, '19', 60, 0, NULL, '', 0, ''),
(87, NULL, '', NULL, 'ismail Tunde', '8000.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-12 04:05:50', '2022-05-12', NULL, 1, 1, '19', 83, 0, NULL, '', 0, ''),
(88, NULL, '', NULL, 'Alabi Aderonke', '1000.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-12 05:54:33', '2022-05-12', NULL, 1, 0, '19', 60, 0, NULL, '', 0, ''),
(89, NULL, '', NULL, 'MR. GBENGA', '0.00', 'bcc@isaluhospitals.com', 16, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 24, 0, NULL, '', 0, ''),
(90, NULL, '', NULL, 'MR. GBENGA (DISPATCH RIDER)', '0.00', 'bcc@isaluhospitals.com', 16, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 70, 1, 'Amount and descriptions are not stated.', '', 0, ''),
(91, NULL, '', NULL, 'Dayo Adekoya', '85000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 81, 1, 'Duplication', '', 0, ''),
(92, NULL, '', NULL, 'oluwakemi sekinat', '4800.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 60, 1, 'Duplication', '', 0, ''),
(93, NULL, '', NULL, 'Dayo Adekoya', '85000.00', 'procurement@isaluhospitals.com', 1, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-12', NULL, 1, 0, '19', 95, 0, NULL, '', 0, ''),
(94, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '1000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 20, 1, 'Wrong Description', '', 0, ''),
(95, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '30000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 95, 0, NULL, '', 0, ''),
(96, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '30000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 95, 1, 'Not for Site but for Rm 112 at AY', '', 0, ''),
(97, NULL, '', NULL, 'WORTHWHILE VENTURES LIMITED', '18705.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-12', NULL, 1, 0, '19', 95, 0, NULL, 'WORTHWHILE VENTURES LIMITED', 1770002011, 'POLARIS BANK LTD'),
(98, NULL, '', NULL, 'SANKAZ IRON CONSTRUCTION WORKS', '80000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-12', NULL, 0, 0, '', 95, 1, 'N60,000.00 advance payment to be raised first.', 'SANUSI KAZEEM', 0, ''),
(99, NULL, '', NULL, 'AMADI MAUREEM', '63900.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-12', 1, '19', 1, '2022-05-13 05:45:33', '2022-05-12', NULL, 1, 0, '19', 14, 0, NULL, '', 0, ''),
(100, NULL, '', NULL, 'SEKINAT RAJI', '4800.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-13', NULL, 1, 0, '19', 60, 0, NULL, '', 0, ''),
(101, NULL, 'IHL/989', NULL, 'Omobhude Evelyn', '4000.00', 'clientservice@isaluhospitals.com', 3, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-13', NULL, 1, 1, '19', 107, 0, NULL, 'Omobhude Evelyn', 2088786607, 'Zenith'),
(102, NULL, '', NULL, 'Sunday Iduma ', '50000.00', 'procurement@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 108, 1, 'Wrong Description', '', 0, ''),
(103, NULL, '', NULL, 'SANKAZ IRON CONSTRUCTION WORKS', '0.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 95, 0, NULL, '', 0, ''),
(104, NULL, '', NULL, 'QUALITY BOOKS AND STATIONERY STORES', '293700.00', 'procurement2@isaluhospitals.com', 1, '22', 0, 1, NULL, 1, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 75, 0, NULL, '', 0, ''),
(105, NULL, '', NULL, 'Sunday Iduma', '50000.00', 'procurement@isaluhospitals.com', 1, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-13', NULL, 1, 0, '19', 108, 0, NULL, '', 0, ''),
(106, NULL, '', NULL, 'DIAMOND MEDICAL LABORATORY', '34000.00', 'laboratory@isaluhospitals.com', 5, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-13', NULL, 1, 0, '19', 12, 0, NULL, '', 0, ''),
(107, NULL, '', NULL, 'ORIS MEDICAL LABORATORY', '58000.00', 'laboratory@isaluhospitals.com', 5, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-13', NULL, 1, 0, '19', 12, 0, NULL, '', 0, ''),
(108, NULL, '', NULL, 'IPAYE NIMOTA BUKOLA', '1600.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-13', 1, '19', 1, '2022-05-13 12:38:08', '2022-05-13', NULL, 1, 0, '19', 60, 0, NULL, '', 0, ''),
(109, NULL, '', NULL, 'IPAYE NIMOTA BUKOLA', '6400.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-13', 1, '19', 1, '2022-05-13 11:33:50', '2022-05-13', NULL, 1, 0, '19', 60, 0, NULL, '', 0, ''),
(110, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '243000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 62, 1, 'Not completely done', '', 0, ''),
(113, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '834200.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 62, 1, 'Not Properly Described', '', 0, ''),
(114, NULL, 'IHL/891', NULL, 'HYPARXIS INTEGRATED SOLUTIONS', '70560.00', 'it@isalu.com', 2, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-13', NULL, 1, 0, '19', 102, 0, NULL, 'HYPARXIS INTEGRATED SOLUTIONS', 2147483647, 'FCMB'),
(115, NULL, '267', NULL, 'Labode Macsam', '2000.00', 'hr@isaluhospitals.com', 13, '19', 1, 1, '2022-05-13', 1, '19', 1, '2022-05-13 05:50:01', '2022-05-13', NULL, 1, 0, '19', 71, 0, NULL, '', 0, ''),
(116, NULL, '', NULL, 'IPAYE NIMOTA BUKOLA', '42200.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 60, 0, NULL, '', 0, ''),
(117, NULL, '', NULL, 'IPAYE NIMOTA BUKOLA', '0.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 60, 0, NULL, '', 0, ''),
(118, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '0.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 62, 0, NULL, '', 0, ''),
(119, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '0.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 62, 0, NULL, '', 0, ''),
(120, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '834200.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 62, 1, 'Not Properly Described', '', 0, ''),
(121, NULL, '', NULL, 'SUARA OLUWAKEMI TAIWO', '834200.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-13', NULL, 1, 0, '19', 62, 0, NULL, '', 0, ''),
(122, NULL, 'IHL/891', NULL, 'IBIDUN OLUWATOSIN', '6059.30', 'it@isalu.com', 2, NULL, 0, 1, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 102, 0, NULL, 'IBIDUN OLUWATOSIN', 2147483647, 'ZENITH BANK'),
(123, NULL, '', NULL, 'LASISI TAIWO DAVID', '28000.00', 'procurement2@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 85, 1, 'Wrong Description', '', 0, ''),
(124, NULL, '', NULL, 'EKE NIGERIA LIMITED', '6000.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-13', NULL, 1, 0, '19', 60, 0, NULL, '', 0, ''),
(127, NULL, '', NULL, 'CLINX LABORATORY ', '71100.00', 'clientservice@isaluhospitals.com', 3, NULL, 0, 1, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 109, 0, NULL, '', 0, ''),
(128, NULL, '', NULL, 'LASIS DAVID TAIWO', '28000.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-13', NULL, 1, 0, '19', 84, 0, NULL, '', 0, ''),
(129, NULL, '', NULL, 'SANKAZ IRON CONSTRUCTION WORKS', '80000.00', 'procurement@isaluhospitals.com', 1, '19', 1, 1, '2022-05-13', 1, '19', 1, '2022-05-13 04:56:21', '2022-05-13', NULL, 1, 0, '19', 95, 0, NULL, '', 0, ''),
(130, NULL, '', NULL, 'ORIS MEDICAL LABORATORY', '85000.00', 'laboratory@isaluhospitals.com', 5, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-13', NULL, 1, 0, '19', 12, 0, NULL, '', 0, ''),
(131, NULL, '', NULL, 'SHARAFA AZEEZ', '2000.00', 'hr@isaluhospitals.com', 13, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 28, 1, 'Not Properly Described', '', 0, ''),
(132, NULL, '', NULL, 'SHARAFA AZEEZ', '2000.00', 'hr@isaluhospitals.com', 13, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 28, 1, 'Not Properly Described', '', 0, ''),
(133, NULL, '', NULL, 'SHARAFA AZEEZ', '4000.00', 'hr@isaluhospitals.com', 13, '19', 1, 1, '2022-05-13', 1, '19', 1, '2022-05-13 05:42:55', '2022-05-13', NULL, 1, 0, '19', 88, 0, NULL, '', 0, ''),
(134, NULL, '', NULL, 'Alabi Aderonke Atinuke', '0.00', 'procurement@isaluhospitals.com', 1, NULL, 0, 0, NULL, 0, '19', 0, NULL, '2022-05-13', NULL, 0, 0, '', 8, 0, NULL, '', 0, ''),
(135, NULL, '', NULL, 'Alabi Aderonke Atinuke', '7000.00', 'procurement2@isaluhospitals.com', 1, '19', 1, 1, '2022-05-13', 1, '19', 1, '2022-05-13 05:39:27', '2022-05-13', NULL, 1, 0, '19', 8, 0, NULL, '', 0, ''),
(136, NULL, '', NULL, 'ADEBOLA HASSAN', '4000.00', 'bcc@isaluhospitals.com', 16, NULL, 0, 0, NULL, 0, '', 0, NULL, '2022-05-13', NULL, 0, 1, '23', 110, 1, 'The description is not detailed enough', 'ADEBOLA HASSAN', 1410147855, 'ACCESS BANK'),
(137, NULL, '', NULL, 'ADEBOLA HASSAN', '4000.00', 'bcc@isaluhospitals.com', 16, '19', 1, 1, '2022-05-13', 1, '19', 0, NULL, '2022-05-13', NULL, 1, 1, '19', 110, 0, NULL, 'ADEBOLA HASSAN', 1410147855, 'ACCESS BANK');

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
(9, 'Quicbook'),
(10, 'Pharmacy'),
(11, 'Radiology'),
(12, 'Kitchen'),
(13, 'HR'),
(14, 'Main Store'),
(15, 'Quality Control'),
(16, 'BCC'),
(17, 'Medical'),
(18, 'Test');

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
(98, 'Bixolon Paper', 16, 1, '27.0000', 10, 1),
(99, 'Washing handsoap', 13, 1, NULL, 10, 1),
(100, 'mopping soap', 10, 1, NULL, 10, 1),
(101, 'POS Paper', 16, 1, '32.0000', 10, 1),
(102, 'hypo', 10, 1, NULL, 10, 1),
(103, 'Black Pen', 10, 1, '43.0000', 10, 1),
(104, 'harpic', 10, 1, NULL, 10, 1),
(105, 'toilet soap', 13, 1, NULL, 10, 1),
(106, 'Envelope (White)', 10, 1, '9.0000', 10, 1),
(107, 'Staple pin', 11, 1, '10.0000', 10, 1),
(108, 'tooth brush', 11, 1, '15.0000', 10, 1),
(109, 'Calculator', 10, 1, '1.0000', 5, 1),
(110, 'Hard cover long note', 10, 1, '18.0000', 5, 1),
(111, 'cream', 11, 1, '13.0000', 10, 1),
(112, 'Hard cover short note', 10, 1, NULL, 5, 1),
(113, 'Paper file', 10, 1, '65.0000', 10, 1),
(114, 'Rubber file', 10, 1, '30.0000', 10, 1),
(115, 'Tag', 10, 1, NULL, 5, 1),
(116, 'scrubbing brush', 10, 1, NULL, 10, 1),
(117, 'air freshener solid', 10, 1, NULL, 10, 1),
(118, 'Ruler', 10, 1, NULL, 10, 1),
(119, 'air freshener liquid', 10, 1, '21.0000', 10, 1),
(120, 'Tippex', 10, 1, '23.0000', 5, 1),
(121, 'Permanent marker', 10, 1, '15.0000', 5, 1),
(122, 'towel', 10, 1, NULL, 10, 1),
(123, 'bag', 10, 1, NULL, 10, 1),
(124, 'Temporary marker', 10, 1, '13.0000', 10, 1),
(125, 'closeup', 10, 1, NULL, 10, 1),
(126, 'Higher Education note', 10, 1, '19.0000', 10, 1),
(127, 'flit', 10, 1, '61.0000', 10, 1),
(128, 'ariel', 17, 1, '1.0000', 10, 1),
(129, 'broom', 10, 1, NULL, 10, 1),
(130, '8 in one note', 10, 1, NULL, 10, 1),
(131, 'mopp', 10, 1, NULL, 10, 1),
(132, '6 in one note', 10, 1, NULL, 5, 1),
(133, 'bowl', 10, 1, NULL, 10, 1),
(134, 'bucket', 10, 1, NULL, 10, 1),
(135, 'File Tag', 10, 1, '57.0000', 5, 1),
(136, 'long brush', 10, 1, NULL, 10, 1),
(137, 'Wall pin', 11, 1, '3.0000', 5, 1),
(138, 'Exercise book (60 leaves)', 10, 1, NULL, 10, 1),
(139, 'dustbin nylon', 18, 1, '1.0000', 10, 1),
(140, 'File Clip', 10, 1, '33.0000', 10, 1),
(141, 'Stamp pad', 10, 1, '1.0000', 5, 1),
(142, 'disposable cup', 16, 1, '13.0000', 10, 1),
(143, 'Paper tape', 10, 1, NULL, 5, 1),
(144, 'Paper gum', 10, 1, '12.0000', 5, 1),
(145, 'red nylon', 10, 1, NULL, 10, 1),
(146, 'yellow nylon', 10, 1, NULL, 10, 1),
(147, 'Brown envelope (big)', 10, 1, NULL, 5, 1),
(148, 'Brown envelope (small)', 10, 1, NULL, 5, 1),
(149, 'toilet roll', 17, 1, '6.0000', 10, 1),
(150, 'Brown envelope (medium)', 10, 1, NULL, 5, 1),
(151, 'A4 paper', 15, 1, '52.0000', 10, 1),
(152, 'Basin tap', 10, 2, NULL, 0, 1),
(153, 'Mangle waste ', 10, 2, NULL, 0, 1),
(154, 'Flexible connector', 10, 2, NULL, 0, 1),
(155, 'Hand press tap', 10, 2, NULL, 0, 1),
(156, 'test', 10, 1, '10.0000', 5, 1),
(157, 'wall sucket', 10, 1, NULL, 10, 1),
(158, 'extention box', 10, 1, NULL, 10, 1),
(159, 'bulb (midium,small.big', 10, 1, NULL, 10, 1),
(160, 'battery (duracel)', 10, 1, NULL, 10, 1),
(161, 'fused', 10, 1, NULL, 10, 1),
(162, 'water heater switch', 10, 1, NULL, 10, 1),
(163, 'patress 3by 3', 10, 1, NULL, 10, 1),
(164, 'hi watt battery', 10, 1, NULL, 10, 1),
(165, 'installation tape', 10, 1, NULL, 10, 1),
(166, '3by3 sucket,3by6 sucket', 10, 1, NULL, 10, 1),
(167, '24 watt light', 10, 1, NULL, 10, 1),
(168, '18 watt light', 10, 1, NULL, 10, 1),
(169, '12 watt light', 10, 1, NULL, 10, 1),
(170, 'led schock', 10, 1, NULL, 10, 1),
(171, '13 amps plug', 10, 1, NULL, 10, 1),
(172, '15 amps plug', 10, 1, NULL, 10, 1),
(173, 'cable wire', 11, 1, NULL, 10, 1),
(174, 'single core', 10, 1, NULL, 10, 1),
(175, 'Salvon', 10, 2, NULL, 0, 1),
(176, 'double core', 10, 1, NULL, 10, 1),
(177, 'Mixer tap', 10, 2, NULL, 0, 1),
(178, 'adaptor', 10, 1, NULL, 10, 1),
(179, 'ac switch', 10, 1, NULL, 10, 1),
(180, 'wall fan', 10, 1, NULL, 10, 1),
(181, 'tv', 10, 1, NULL, 10, 1),
(182, 'ceiling fan', 10, 1, NULL, 10, 1),
(183, '12 mm clip', 10, 1, NULL, 10, 1),
(184, '20 mm clip', 10, 1, NULL, 10, 1),
(185, 'Tap (Plastic)', 10, 2, NULL, 0, 1),
(186, 'truncking 16 by 25', 10, 1, NULL, 10, 1),
(187, 'tunado nail', 10, 1, NULL, 10, 1),
(188, 'Tap (Iron)', 10, 2, NULL, 0, 1),
(189, 'Angle tap', 10, 2, NULL, 0, 1),
(190, 'Silicon gel ', 10, 2, NULL, 0, 1),
(191, 'Plumbing Gum', 10, 2, NULL, 10, 1),
(192, 'Plumbing plug', 10, 2, NULL, 10, 1),
(193, '1inch elbow', 10, 2, NULL, 10, 1),
(194, '1inch Adpter ', 10, 2, NULL, 10, 1),
(195, '1inch union connector', 10, 2, NULL, 10, 1),
(196, '1inch sucket', 10, 2, NULL, 10, 1),
(197, '1inch Tee', 10, 2, NULL, 10, 1),
(198, '1inch Air valve', 10, 2, NULL, 10, 1),
(199, 'Tee Tap', 10, 2, NULL, 10, 1),
(200, '1/2 inch Tee', 10, 2, NULL, 10, 1),
(201, '1/2 inch Elbow', 10, 2, NULL, 10, 1),
(202, '1/2 inch Socket', 10, 2, NULL, 10, 1),
(203, '1/2 inch Male & Female Socket', 10, 2, NULL, 10, 1),
(204, 'Pipe connector 4 inches', 10, 2, NULL, 10, 1),
(205, '3/4 Elbow', 10, 2, NULL, 10, 1),
(206, '3/4 Socket', 10, 2, NULL, 10, 1),
(207, '3/4 Air valve', 10, 2, NULL, 10, 1),
(208, '3/4 union', 10, 2, NULL, 10, 1),
(209, 'Nurses cap', 10, 2, NULL, 10, 1),
(210, 'Connecting tube', 10, 1, NULL, 10, 1),
(211, 'Nurses cap', 10, 1, NULL, 10, 1),
(212, 'Sectioning tube', 10, 1, NULL, 10, 1),
(213, 'Baby sex indicator', 10, 1, NULL, 10, 1),
(214, 'Nasal Prone Child', 10, 1, NULL, 10, 1),
(215, 'Nasal Prone Adult', 10, 1, NULL, 10, 1),
(216, 'Auto tape', 10, 1, NULL, 10, 1),
(217, 'Laptop Keyboard', 10, 2, NULL, 0, 1),
(218, 'Laptop charger (pin mouth)', 10, 2, NULL, 0, 1),
(219, 'Laptop charger (Big mouth)', 10, 2, NULL, 0, 1),
(220, 'Printer', 10, 2, NULL, 0, 1),
(221, 'Mouse', 10, 2, NULL, 0, 1),
(222, 'Mouse', 10, 1, NULL, 5, 1),
(223, 'Computer Laptop', 10, 2, NULL, 0, 1),
(224, 'Desktop Keyboard', 10, 2, NULL, 0, 1),
(225, 'Tonner (Black)', 10, 1, NULL, 5, 1),
(226, 'Tonner (Black)', 10, 2, NULL, 0, 1),
(227, 'Desktop hard drive ', 10, 2, NULL, 0, 1),
(228, 'Laptop hard drive', 10, 2, NULL, 0, 1),
(229, 'Laptop Battery ', 10, 2, NULL, 0, 1),
(230, 'Laptop Cooling Fan', 10, 2, NULL, 0, 1),
(231, 'Blue pen', 10, 1, '111.0000', 10, 1),
(232, 'Red pen', 10, 1, '45.0000', 10, 1),
(233, 'Green pen', 10, 1, '21.0000', 10, 1),
(234, 'Paforator', 10, 1, '1.0000', 2, 1),
(235, 'Schneider pen blue', 10, 1, '24.0000', 10, 1),
(236, 'Schneider pen black', 10, 1, '17.0000', 10, 1),
(237, 'Refine pen', 10, 1, '16.0000', 10, 1),
(238, 'Roller tip pen', 10, 1, '2.0000', 10, 1),
(239, 'File wool', 10, 1, '18.0000', 10, 1),
(240, 'Table pen', 10, 1, '10.0000', 10, 1),
(241, 'Rubber band', 11, 1, '3.0000', 10, 1),
(242, 'Cello tape ', 10, 1, '61.0000', 10, 1),
(243, 'Thumb tack', 11, 1, '2.0000', 5, 1),
(244, 'Stapler machine', 10, 1, '2.0000', 5, 1),
(245, 'Flit', 10, 2, NULL, 5, 1),
(246, 'Sweet', 10, 1, '13.0000', 2, 1),
(247, 'Wall clock', 10, 1, '20.0000', 2, 1),
(249, 'Air-conditional', 10, 2, NULL, 0, 1),
(250, 'A4 paper ', 15, 2, NULL, 0, 1),
(251, 'Higher education ', 10, 2, NULL, 0, 1),
(252, '12 in one note', 10, 2, NULL, 0, 1),
(253, '80 leaves exercise book', 10, 2, NULL, 0, 1),
(254, 'Calculator', 10, 2, NULL, 0, 1),
(255, 'Office file', 10, 2, NULL, 0, 1),
(256, 'Hard cover note long', 10, 2, NULL, 0, 1),
(257, 'Hard cover note medium', 10, 2, NULL, 0, 1),
(258, 'Envelope (White)', 11, 2, NULL, 0, 1),
(259, 'Permanent marker', 10, 2, NULL, 0, 1),
(260, 'Hand punch (For file)', 10, 2, NULL, 0, 1),
(261, 'Stapler ', 10, 2, NULL, 0, 1),
(262, 'Table pen', 10, 2, NULL, 0, 1),
(263, 'Tippex correction pen', 10, 2, NULL, 0, 1),
(264, 'High light for correction', 10, 2, NULL, 0, 1),
(265, 'Biro', 10, 2, NULL, 0, 1),
(266, 'Abro paper tape', 10, 2, NULL, 0, 1),
(267, 'POS paper', 16, 2, NULL, 0, 1),
(268, 'Bioxolon pape (80x80)', 16, 2, NULL, 0, 1),
(269, 'Brown envelope medium', 11, 2, NULL, 0, 1),
(270, 'Punch', 10, 2, NULL, 0, 1),
(271, 'Tissue paper', 17, 2, NULL, 0, 1),
(272, 'hypo', 19, 2, NULL, 0, 1),
(273, 'soap', 19, 2, NULL, 0, 1),
(274, 'Ariel', 17, 2, NULL, 0, 1),
(275, 'Cream', 10, 2, NULL, 0, 1),
(276, 'Black nylon', 18, 2, NULL, 0, 1),
(277, 'Towels', 10, 2, NULL, 0, 1),
(278, 'Bags', 10, 2, NULL, 0, 1),
(279, 'Brush', 10, 2, NULL, 0, 1),
(280, 'Air freshner', 10, 2, NULL, 0, 1),
(281, 'Sweet', 11, 2, NULL, 0, 1),
(282, 'Disposable cup', 16, 2, NULL, 0, 1),
(283, 'Close up', 10, 2, NULL, 0, 1),
(284, 'Soap for pack', 10, 2, NULL, 0, 1),
(285, 'Huggies wipe', 10, 2, NULL, 0, 1),
(286, 'Harpic 450mls', 18, 2, NULL, 0, 1),
(287, 'POE POWER PACK', 10, 2, NULL, 0, 1),
(288, 'Punch (For file)', 10, 1, '2.0000', 1, 1),
(289, '80 leaves exercise book', 10, 1, '24.0000', 5, 1),
(290, 'Hard cover note medium', 10, 1, '14.0000', 2, 1),
(291, '12 in one note', 10, 1, '3.0000', 1, 1),
(292, 'Office file', 10, 1, '100.0000', 10, 1),
(293, 'BLACK CATRIDGE ', 10, 2, NULL, 0, 1),
(294, 'CATRIDGE REFILL', 10, 2, NULL, 0, 1),
(295, 'BIXOLON PRINTER', 10, 2, NULL, 0, 1),
(296, 'SITE WORKS', 20, 2, NULL, 0, 1),
(297, 'MAC AGAR', 21, 2, NULL, 0, 1),
(298, 'CLED AGAR', 21, 2, NULL, 0, 1),
(299, 'NUTRIENT AGAR', 21, 2, NULL, 0, 1),
(300, 'SS AGAR', 21, 2, NULL, 0, 1),
(301, 'ALT/GPT ERBA', 21, 2, NULL, 0, 1),
(302, 'URIC ACID RANDOX', 21, 2, NULL, 0, 1),
(303, 'CREATINE ERBA', 21, 2, NULL, 0, 1),
(304, 'HIV UNIGOLD', 11, 2, NULL, 0, 1),
(305, 'NBAIC CARTRIDGES', 11, 2, NULL, 0, 1),
(306, 'ACCU CHEK LANCET', 11, 2, NULL, 0, 1),
(307, 'MALARIA KIT CTK', 11, 2, NULL, 0, 1),
(308, 'FAECAL OCCULT BLOOD FOB', 11, 2, NULL, 0, 1),
(309, 'Monthly subscription', 22, 2, NULL, 0, 1),
(310, 'Diesel', 13, 2, NULL, 0, 1),
(311, 'CUG suscription', 22, 2, NULL, 0, 1),
(312, 'POP cement', 17, 1, NULL, 5, 1),
(313, 'POP Paint', 17, 1, NULL, 1, 1),
(314, 'POP cement', 17, 2, NULL, 0, 1),
(315, 'POP Paint', 10, 2, NULL, 0, 1),
(316, 'Cement', 17, 2, NULL, 0, 1),
(317, 'Old Ambulance', 26, 2, NULL, 0, 1);

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
(92, 156, 10, 'IN', '2022-05-05 05:36:24'),
(93, 98, 7, 'IN', '2022-05-09 12:11:18'),
(94, 101, 12, 'IN', '2022-05-09 12:11:37'),
(95, 103, 49, 'IN', '2022-05-09 12:11:59'),
(96, 231, 13, 'IN', '2022-05-09 12:12:52'),
(97, 232, 48, 'IN', '2022-05-09 12:13:51'),
(98, 234, 1, 'IN', '2022-05-09 12:14:49'),
(99, 233, 22, 'IN', '2022-05-09 12:15:11'),
(100, 235, 24, 'IN', '2022-05-09 12:15:47'),
(101, 236, 17, 'IN', '2022-05-09 12:16:03'),
(102, 237, 16, 'IN', '2022-05-09 12:16:29'),
(103, 238, 2, 'IN', '2022-05-09 12:16:52'),
(104, 106, 9, 'IN', '2022-05-09 12:17:27'),
(105, 239, 18, 'IN', '2022-05-09 12:18:15'),
(106, 240, 10, 'IN', '2022-05-09 12:18:55'),
(107, 151, 3, 'IN', '2022-05-09 12:19:52'),
(108, 241, 3, 'IN', '2022-05-09 12:21:56'),
(109, 242, 62, 'IN', '2022-05-09 12:24:34'),
(110, 144, 12, 'IN', '2022-05-09 12:26:48'),
(112, 141, 1, 'IN', '2022-05-09 12:33:39'),
(113, 140, 33, 'IN', '2022-05-09 12:34:36'),
(114, 137, 3, 'IN', '2022-05-09 12:36:12'),
(115, 243, 2, 'IN', '2022-05-09 12:38:38'),
(116, 135, 57, 'IN', '2022-05-09 12:39:01'),
(117, 126, 9, 'IN', '2022-05-09 12:59:50'),
(118, 124, 13, 'IN', '2022-05-09 01:00:16'),
(119, 121, 15, 'IN', '2022-05-09 01:01:43'),
(120, 120, 25, 'IN', '2022-05-09 01:02:16'),
(121, 114, 30, 'IN', '2022-05-09 01:04:36'),
(122, 113, 71, 'IN', '2022-05-09 01:06:23'),
(123, 110, 9, 'IN', '2022-05-09 01:07:35'),
(124, 107, 12, 'IN', '2022-05-09 01:08:48'),
(125, 108, 15, 'IN', '2022-05-09 06:02:53'),
(126, 111, 13, 'IN', '2022-05-09 06:03:52'),
(127, 119, 21, 'IN', '2022-05-09 06:09:47'),
(128, 127, 61, 'IN', '2022-05-09 06:23:30'),
(129, 128, 1, 'IN', '2022-05-09 06:25:41'),
(130, 139, 1, 'IN', '2022-05-09 06:28:00'),
(131, 142, 13, 'IN', '2022-05-09 06:32:55'),
(132, 246, 13, 'IN', '2022-05-09 06:34:06'),
(133, 247, 20, 'IN', '2022-05-09 06:35:10'),
(134, 149, 6, 'IN', '2022-05-09 06:37:12'),
(135, 103, -6, 'OUT', '2022-05-10 02:33:23'),
(136, 113, -6, 'OUT', '2022-05-10 02:33:23'),
(137, 151, -2, 'OUT', '2022-05-10 02:33:23'),
(138, 232, -3, 'OUT', '2022-05-10 02:33:23'),
(139, 151, -2, 'OUT', '2022-05-12 10:17:43'),
(140, 120, -2, 'OUT', '2022-05-12 10:17:43'),
(141, 151, 60, 'IN', '2022-05-12 04:34:44'),
(142, 98, 20, 'IN', '2022-05-12 04:36:48'),
(143, 101, 20, 'IN', '2022-05-12 04:37:10'),
(144, 231, 100, 'IN', '2022-05-12 04:39:09'),
(145, 244, 2, 'IN', '2022-05-12 04:41:48'),
(146, 109, 1, 'IN', '2022-05-12 04:42:20'),
(147, 288, 2, 'IN', '2022-05-12 04:44:26'),
(148, 289, 24, 'IN', '2022-05-12 04:48:01'),
(149, 110, 9, 'IN', '2022-05-12 04:49:50'),
(150, 290, 14, 'IN', '2022-05-12 04:52:45'),
(151, 291, 3, 'IN', '2022-05-12 04:54:42'),
(152, 126, 10, 'IN', '2022-05-12 04:55:28'),
(153, 292, 100, 'IN', '2022-05-12 04:59:08'),
(154, 231, -2, 'OUT', '2022-05-13 09:31:42'),
(155, 107, -1, 'OUT', '2022-05-13 09:31:42'),
(156, 151, -5, 'OUT', '2022-05-13 09:31:42'),
(157, 151, -1, 'OUT', '2022-05-13 02:51:14'),
(158, 233, -1, 'OUT', '2022-05-13 02:51:14'),
(159, 151, -1, 'OUT', '2022-05-13 05:24:22'),
(160, 107, -1, 'OUT', '2022-05-13 05:24:22'),
(161, 242, -1, 'OUT', '2022-05-13 05:24:22');

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
(35, 27, '2000.0000', 'REFUND ON EXCESS PAYMENT FOR LAB'),
(36, 28, '5100.0000', 'REFUND ON DRUG NOT AVAILABLE (PARLODEL)'),
(37, 29, '3750.0000', 'REFUND ON UNAVAILABLE DRUG'),
(38, 30, '5000.0000', 'REFUND ON EXCESS ACCOMODATION DIFF'),
(40, 32, '6153.0000', 'PATIENT REFUSED DRUGS'),
(41, 33, '6650.0000', 'OVER BILLED FOR DRUG'),
(42, 35, '1020.0000', 'REFUND ON NORMAL SALINE NOT TAKEN'),
(43, 36, '6020.0000', 'REFUND ON PAEDIATRICIAN EMERG, CONS DIFFERENCE NOT UTILIZED'),
(44, 39, '1213.0000', 'REFUND ON LAB TEST NOT DONE'),
(45, 40, '7000.0000', 'REFUND ON EXCESS BILL FOR DRUG'),
(46, 41, '9100.0000', 'REFUND ON DRUG NOT GIVEN( ZINNAT INJ)'),
(47, 45, '20000.0000', 'REFUND ON DIETICIAN NOT SEEN');

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
(27, 'NYR/6799', 'MOGAJI RUKAYAT', 'MOGAJI RUKAYAT', '0224002780', '2000.00', 'GT BANK', 'clientservice@isaluhospitals.com', 3, NULL, 1, 1, 19, 19, '2022-05-10', 1, 1, '2022-05-10 01:42:41', 0, NULL, 0, 0, 0, 25, 1),
(28, 'F/9041A', 'OLOGBESE FOLUSO', 'OLOGBESE FOLUSO', '0049439204', '5100.00', 'GTBANK', 'clientservice@isaluhospitals.com', 3, NULL, 1, 1, 19, 19, '2022-05-12', 1, 0, NULL, 0, NULL, 0, 0, 0, 25, 1),
(29, ' F/5023A ]', 'ADENIYE AYOKUNLE ', 'ADENIYE AYOKUNLE  AFEEZ', '0013559796', '3750.00', 'GT BANK', 'clientservice@isaluhospitals.com', 3, NULL, 1, 1, 19, 19, '2022-05-10', 1, 1, '2022-05-10 01:42:50', 0, NULL, 0, 0, 0, 25, 1),
(30, 'HG/2998B', 'OLUGBILE JUSTIN', 'OLUGBILE JUSTINA', '3026089377', '5000.00', 'POLARIS BANK', 'clientservice@isaluhospitals.com', 3, NULL, 0, 0, NULL, NULL, NULL, 1, 0, NULL, 0, NULL, 1, 0, 24, 25, 1),
(32, 'MSH/3738A', 'AKUBO CELESTINE', 'AKUBO CELESTINE', '6172411744', '6153.00', 'FIDELITY BANK', 'clientservice@isaluhospitals.com', 3, NULL, 0, 0, NULL, NULL, NULL, 1, 0, NULL, 0, NULL, 1, 0, 24, 25, 1),
(33, 'F/56A', 'IBEZIAKO MICHEAL', 'ZITA MARIA IBEZIAKO', '3044411883', '6650.00', 'FIRST BANK', 'clientservice@isaluhospitals.com', 3, NULL, 1, 1, 19, 19, '2022-05-10', 1, 1, '2022-05-10 01:42:55', 0, NULL, 0, 0, 0, 25, 1),
(35, 'P/7632', 'OSHOBU IMOLEOLUWA', 'EMECHEBE NGOZI', '0001999753', '1020.00', 'STANBIC BANK', 'clientservice@isaluhospitals.com', 3, NULL, 1, 1, 19, 19, '2022-05-13', 1, 0, NULL, 0, NULL, 0, 0, 0, 25, 1),
(36, 'RC/369B', 'ODEYEMI ZION', 'AROMOLARAN BLESSING', '1022067790', '6020.00', 'UBA', 'clientservice@isaluhospitals.com', 3, NULL, 0, 0, NULL, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 1, 24, 0, 0),
(39, 'MSH/8972B', 'OGUNSANWO OLUWANIMISOKAN', 'OGUNSANWO OPEMIPO', '3182937850', '1213.00', 'FIRST BANK', 'clientservice@isaluhospitals.com', 3, NULL, 0, 0, NULL, NULL, NULL, 1, 0, NULL, 0, NULL, 0, 1, 24, 0, 0),
(40, ' F/2840D', 'EDOUGHA VALERIE', 'BLESSING AUGUSTINE', '2005133644', '7000.00', 'ZENITH BANK', 'clientservice@isaluhospitals.com', 3, NULL, 1, 1, 19, 19, '2022-05-13', 1, 0, NULL, 0, NULL, 0, 0, 0, 25, 1),
(41, 'F/513C', 'BRISIBE DAVID TAMARA', 'OYINBRAKEMI BRISIBE', '2001423095', '9100.00', 'ZENITH BANK', 'clientservice@isaluhospitals.com', 3, NULL, 1, 1, 19, 19, '2022-05-13', 1, 0, NULL, 0, NULL, 0, 0, 0, 25, 1),
(42, 'f/4717h', 'iyanda olufunke', 'ISAAC OLUWAPELUMI', '2051105431', '0.00', 'ZENITH BANK', 'clientservice@isaluhospitals.com', 3, NULL, 0, 0, 19, NULL, NULL, 1, 0, NULL, 1, 'No amount stated', 0, 0, 0, 25, 1),
(43, 'F/4717H', 'IYANDA OLUFUNKE', 'ISAAC OLUWAPELUMI', '2051105431', '0.00', 'ZENITH BANK', 'clientservice@isaluhospitals.com', 3, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, 0, 25, 1),
(44, 'F/4717H', 'IYANDA OLUFUNKE', 'ISAAC OLUWAPELUMI', '2051105431', '0.00', 'ZENITH BANK', 'clientservice@isaluhospitals.com', 3, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, 0, 25, 1),
(45, 'F/4717H', 'IYANDA OLUFUNKE', 'ISAAC OLUWAPELUMI', '2051105431', '20000.00', 'ZENITH BANK', 'clientservice@isaluhospitals.com', 3, NULL, 1, 1, 19, 19, '2022-05-13', 1, 0, NULL, 0, NULL, 0, 0, 0, 25, 1);

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
(65, 69, 98, NULL, 20, 'roll', '49000.0000'),
(66, 69, 101, NULL, 20, 'roll', '18000.0000'),
(67, 70, 103, NULL, 6, 'Pcs', '0.0000'),
(68, 70, 113, NULL, 6, 'Pcs', '0.0000'),
(69, 70, 151, NULL, 2, 'realm', '0.0000'),
(70, 70, 232, NULL, 3, 'Pcs', '0.0000'),
(71, 69, 106, NULL, 20, 'Pcs', '7000.0000'),
(72, 69, 103, NULL, 100, 'Pcs', '2800.0000'),
(73, 69, 110, NULL, 9, 'Pcs', '12600.0000'),
(74, 69, 113, NULL, 100, 'Pcs', '2500.0000'),
(75, 69, 120, NULL, 12, 'Pcs', '1200.0000'),
(76, 69, 121, NULL, 24, 'Pcs', '1200.0000'),
(77, 69, 126, NULL, 10, 'Pcs', '3600.0000'),
(78, 69, 151, NULL, 60, 'realm', '132000.0000'),
(79, 72, 151, NULL, 2, 'realm', '4400.0000'),
(80, 72, 120, NULL, 2, 'Pcs', '200.0000'),
(82, 85, 249, NULL, 6, 'Pcs', '235000.0000'),
(83, 88, 250, NULL, 60, 'realm', '2200.0000'),
(84, 88, 251, NULL, 10, 'Pcs', '360.0000'),
(85, 88, 252, NULL, 3, 'Pcs', '1900.0000'),
(86, 88, 253, NULL, 24, 'Pcs', '183.3300'),
(87, 88, 254, NULL, 1, 'Pcs', '2500.0000'),
(88, 88, 255, NULL, 100, 'Pcs', '25.0000'),
(89, 88, 256, NULL, 9, 'Pcs', '1400.0000'),
(90, 88, 257, NULL, 14, 'Pcs', '1000.0000'),
(91, 88, 258, NULL, 24, 'pack', '291.6600'),
(92, 88, 259, NULL, 24, 'Pcs', '50.0000'),
(93, 88, 260, NULL, 2, 'Pcs', '1200.0000'),
(94, 88, 261, NULL, 1, 'Pcs', '1800.0000'),
(95, 88, 262, NULL, 12, 'Pcs', '500.0000'),
(96, 88, 263, NULL, 12, 'Pcs', '100.0000'),
(97, 88, 264, NULL, 6, 'Pcs', '100.0000'),
(98, 89, 287, NULL, 2, 'Pcs', '25000.0000'),
(99, 88, 265, NULL, 100, 'Pcs', '28.0000'),
(100, 88, 266, NULL, 36, 'Pcs', '513.8800'),
(101, 88, 267, NULL, 20, 'roll', '900.0000'),
(102, 88, 268, NULL, 20, 'roll', '2450.0000'),
(103, 88, 269, NULL, 7, 'pack', '700.0000'),
(104, 88, 270, NULL, 2, 'Pcs', '1500.0000'),
(105, 91, 271, NULL, 16, 'bag', '2375.0000'),
(107, 91, 272, NULL, 6, 'keg', '7500.0000'),
(108, 91, 273, NULL, 10, 'keg', '6500.0000'),
(109, 91, 274, NULL, 4, 'bag', '6500.0000'),
(110, 91, 275, NULL, 288, 'Pcs', '168.0600'),
(111, 91, 276, NULL, 4, 'carton ', '12500.0000'),
(112, 91, 277, NULL, 600, 'Pcs', '350.0000'),
(113, 91, 278, NULL, 600, 'Pcs', '341.6600'),
(114, 91, 279, NULL, 288, 'Pcs', '69.4500'),
(115, 91, 280, NULL, 24, 'Pcs', '475.0000'),
(116, 91, 281, NULL, 10, 'pack', '480.0000'),
(117, 91, 282, NULL, 15, 'roll', '533.3300'),
(118, 91, 283, NULL, 288, 'Pcs', '52.0800'),
(119, 91, 284, NULL, 288, 'Pcs', '29.1600'),
(120, 91, 285, NULL, 60, 'Pcs', '700.0000'),
(121, 91, 286, NULL, 4, 'carton ', '9300.0000'),
(123, 95, 249, NULL, 6, 'Pcs', '1410000.0000'),
(124, 96, 249, NULL, 6, 'Pcs', '235000.0000'),
(125, 98, 249, NULL, 6, 'Pcs', '1410000.0000'),
(126, 105, 231, NULL, 2, 'Pcs', '0.0000'),
(127, 105, 107, NULL, 1, 'pack', '0.0000'),
(128, 105, 151, NULL, 5, 'realm', '0.0000'),
(129, 120, 293, NULL, 1, 'Pcs', '0.0000'),
(130, 120, 294, NULL, 1, 'Pcs', '0.0000'),
(131, 122, 295, NULL, 1, 'Pcs', '0.0000'),
(132, 125, 296, NULL, 1, 'installatio', '24527.0000'),
(133, 127, 309, NULL, 1, 'monthly', '0.0000'),
(134, 128, 309, NULL, 1, 'monthly', '0.0000'),
(135, 129, 151, NULL, 1, 'realm', '0.0000'),
(136, 129, 233, NULL, 1, 'Pcs', '0.0000'),
(137, 130, 310, NULL, 7000, 'liters', '635.0000'),
(138, 132, 151, NULL, 1, 'realm', '0.0000'),
(139, 132, 107, NULL, 1, 'pack', '0.0000'),
(140, 132, 242, NULL, 1, 'Pcs', '0.0000'),
(141, 133, 296, NULL, -1, 'installatio', '0.0000'),
(142, 135, 311, NULL, 4, 'monthly', '0.0000'),
(143, 138, 151, NULL, 15, 'realm', '0.0000'),
(144, 136, 314, NULL, 5, 'bag', '5900.0000'),
(145, 136, 315, NULL, 5, 'Pcs', '4200.0000'),
(146, 139, 317, NULL, 1, '1CAR', '70000.0000');

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
  `awaiting_price` int(11) NOT NULL DEFAULT 1,
  `requisitiontype` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `payment_date` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisition_header`
--

INSERT INTO `requisition_header` (`reqnumber`, `reqby`, `reqdate`, `coment`, `approved`, `audited`, `auditedby`, `approvedby`, `approvalRequest`, `voided`, `req_description`, `return`, `description`, `departmentid`, `returned`, `awaiting_price`, `requisitiontype`, `payment_status`, `payment_date`) VALUES
(69, 'procurement@isaluhospitals.com', '2022-05-10 11:27:55', 'Price Calculation is wrong', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'STATIONERY', 1, 1, 1, 1, 0, '0000-00-00 00:00:00'),
(70, 'account@isaluhospitals.com', '2022-05-10 12:05:05', '', 1, 1, '19', '19', 1, 0, NULL, NULL, '2 RIMS OF PAPER\n6 BLACK PEN \n1 BLACK PEN \n6 OFFICE FILE \n3 RED PEN', 6, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(71, 'pharmacy@isaluhospitals.com', '2022-05-11 07:54:20', '', 0, 0, '19', NULL, 1, 0, NULL, NULL, '', 10, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(72, 'clientservice@isaluhospitals.com', '2022-05-11 10:16:21', '', 1, 1, '19', '19', 1, 0, NULL, NULL, 'stationary', 3, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(73, 'procurement@isaluhospitals.com', '2022-05-11 11:03:11', 'Not Properly filled', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'PHCN bill', 1, 1, 1, 2, 0, '0000-00-00 00:00:00'),
(74, 'procurement@isaluhospitals.com', '2022-05-11 11:24:50', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'IKEDC NEPA BILL', 1, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(75, 'procurement@isaluhospitals.com', '2022-05-11 11:30:05', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'External requisition for site', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(76, 'procurement@isaluhospitals.com', '2022-05-11 11:30:33', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'STATIONERY', 1, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(79, 'procurement@isaluhospitals.com', '2022-05-11 02:44:11', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'STATIONERY', 1, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(80, 'it@isalu.com', '2022-05-11 02:59:06', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'Stationary', 2, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(81, 'procurement@isaluhospitals.com', '2022-05-11 02:59:28', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'STATIONERY', 1, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(82, 'clientservice@isaluhospitals.com', '2022-05-11 05:30:45', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'Mother craft refreshment\n\n', 3, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(83, 'clientservice@isaluhospitals.com', '2022-05-11 05:51:05', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'Mother-craft Refreshment', 3, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(84, 'clientservice@isaluhospitals.com', '2022-05-11 05:53:37', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'Mother-craft Refreshment', 3, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(85, 'procurement@isaluhospitals.com', '2022-05-12 10:00:02', 'KIV', 0, 0, '19', NULL, 1, 0, NULL, NULL, '6pcs of Midea Air-condition (2HP) for Site Annex', 1, 1, 1, 2, 0, '0000-00-00 00:00:00'),
(86, 'procurement2@isaluhospitals.com', '2022-05-12 10:24:14', '', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'STATIONERIES FOR THE MONTH OF MAY 2022', 1, 0, 1, 2, 0, '0000-00-00 00:00:00'),
(87, 'procurement@isaluhospitals.com', '2022-05-12 10:50:31', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'Painting materials purchase for Doctors room, HMO, 103, 104', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(88, 'procurement2@isaluhospitals.com', '2022-05-12 10:56:42', 'Wrong Amount', 1, 1, '19', '19', 1, 0, NULL, NULL, 'STATIONERIES FOR THE MONTH OF MAY,2022', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(89, 'it@isalu.com', '2022-05-12 11:02:15', '', 1, 1, '19', '22', 1, 0, NULL, NULL, 'POE POWER PACK FOR RADIO TRANSMITTER', 2, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(90, 'procurement2@isaluhospitals.com', '2022-05-12 11:08:09', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'STATIONERIES FOR THE MONTH OF MAY, 2022', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(91, 'procurement@isaluhospitals.com', '2022-05-12 11:19:47', 'Price Calculation is wrong', 0, 1, '19', '22', 1, 0, NULL, NULL, 'HOUSE KEEPING ITEMS FOR THE MONTH OF MAY 2022', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(92, 'procurement2@isaluhospitals.com', '2022-05-12 11:41:02', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'HOUSE KEEPING ITEMS FOR THE MONTH OF MAY 2022', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(93, 'it@isalu.com', '2022-05-12 11:44:53', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '1 RIM OF A4 PAPER, A PIECE OF GREEN PEN\n', 2, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(94, 'audit@isaluhospitals.com', '2022-05-12 11:49:09', '', 0, 0, '19', NULL, 1, 0, NULL, NULL, '1 RIM OF A4 PAPER, 1 PIECE OF GREEN PEN', 7, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(95, 'procurement@isaluhospitals.com', '2022-05-12 12:13:56', 'Price Calculation is wrong', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'PURCHASE OF 6PCS OF AIR CONDITION @ SITE ANNEX OFFICES FOR ADMIT STAFF @ 235,000=#1,410,000', 1, 1, 1, 2, 0, '0000-00-00 00:00:00'),
(96, 'procurement@isaluhospitals.com', '2022-05-12 12:42:30', 'put on hold', 0, 0, '19', '22', 1, 0, NULL, NULL, 'PURCHASE OF 6PCS OF AIR CONDITIONER @ 235,000 @ SITE ANNEX FOR ADMIN STAFFS OFFICE', 1, 1, 1, 2, 0, '0000-00-00 00:00:00'),
(97, 'procurement@isaluhospitals.com', '2022-05-12 12:44:02', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'AIR CONDITIONER', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(98, 'procurement@isaluhospitals.com', '2022-05-12 12:47:28', 'Price Calculation is wrong', 0, 0, '19', NULL, 1, 0, NULL, NULL, '6PCS OF AIR CONDITONER @ 235,000 @ SITE ANNEX', 1, 1, 1, 2, 0, '0000-00-00 00:00:00'),
(99, 'procurement@isaluhospitals.com', '2022-05-12 01:33:16', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '5000LITRES OF DIESEL @ 635 IN ISALU AY ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(100, 'procurement@isaluhospitals.com', '2022-05-12 01:35:06', '', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'SUPPLY OF 5000LITRES OF DIESEL @ 635=#3,175,000 IN ISALU AY\n', 1, 0, 1, 2, 0, '0000-00-00 00:00:00'),
(101, 'procurement@isaluhospitals.com', '2022-05-12 01:37:28', 'Not Properly filled', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'SUPPLY OF2000  DIESEL @ 635 @ SITE =1,270,000', 1, 1, 1, 2, 0, '0000-00-00 00:00:00'),
(102, 'procurement@isaluhospitals.com', '2022-05-12 01:39:39', 'Incomplete Entry ', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'SUPPLY OF 5000LITRES DIESEL @ 635 =#3,175,000 IN ISALU AY', 1, 1, 1, 2, 0, '0000-00-00 00:00:00'),
(103, 'clientservice@isaluhospitals.com', '2022-05-12 01:43:29', 'Not properly Documented', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'A4 PAPER', 3, 1, 1, 1, 0, '0000-00-00 00:00:00'),
(104, 'clientservice@isaluhospitals.com', '2022-05-12 01:44:51', 'Not properly Documented', 0, 0, '19', NULL, 1, 0, NULL, NULL, '1 CARTON OF A4 PAPER\n2 PEN\n1 STAPPLE PIN', 3, 1, 1, 2, 0, '0000-00-00 00:00:00'),
(105, 'clientservice@isaluhospitals.com', '2022-05-12 04:13:07', '', 1, 1, '19', '19', 1, 0, NULL, NULL, 'A4 paper, Staple pin and 2 pens For HMO desk usage.', 3, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(106, 'procurement@isaluhospitals.com', '2022-05-12 06:41:25', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @15,000 in site annex for admin staff ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(107, 'procurement@isaluhospitals.com', '2022-05-12 06:41:25', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @15,000 in site annex for admin staff ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(108, 'procurement@isaluhospitals.com', '2022-05-12 06:41:25', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @15,000 in site annex for admin staff ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(109, 'procurement@isaluhospitals.com', '2022-05-12 06:41:25', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @15,000 in site annex for admin staff ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(110, 'procurement@isaluhospitals.com', '2022-05-12 06:41:25', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @15,000 in site annex for admin staff ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(111, 'procurement@isaluhospitals.com', '2022-05-12 06:41:25', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @15,000 in site annex for admin staff ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(112, 'procurement@isaluhospitals.com', '2022-05-12 06:41:25', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @15,000 in site annex for admin staff ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(113, 'procurement@isaluhospitals.com', '2022-05-12 06:41:25', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @15,000 in site annex for admin staff ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(114, 'procurement@isaluhospitals.com', '2022-05-12 06:41:25', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @15,000 in site annex for admin staff ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(115, 'procurement@isaluhospitals.com', '2022-05-12 06:41:25', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @15,000 in site annex for admin staff ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(116, 'procurement@isaluhospitals.com', '2022-05-12 06:41:25', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @15,000 in site annex for admin staff ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(117, 'procurement@isaluhospitals.com', '2022-05-12 06:41:25', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @15,000 in site annex for admin staff ', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(118, 'procurement2@isaluhospitals.com', '2022-05-12 06:43:30', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '2pcs of wall fan @ 15000 in site annex for admin staff', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(119, 'procurement@isaluhospitals.com', '2022-05-12 06:54:28', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '7000LITRES OF DIESEL @ ISALU AND SITE @ 635', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(120, 'it@isalu.com', '2022-05-13 06:56:03', '', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'CARTRIDGE FOR PRINTER', 2, 0, 1, 2, 0, '0000-00-00 00:00:00'),
(122, 'it@isalu.com', '2022-05-13 07:11:03', '', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'BIXOLON PRINTER FOR CASH DESK ', 2, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(123, 'procurement@isaluhospitals.com', '2022-05-13 08:27:50', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'LABORATORY ITEMS FOR THE MONTH OF APRIL,2022', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(124, 'procurement@isaluhospitals.com', '2022-05-13 08:38:21', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'ALP 110', 1, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(125, 'procurement@isaluhospitals.com', '2022-05-13 09:57:54', '', 1, 1, '19', '19', 1, 0, NULL, NULL, 'Payment for outstanding tile milling works @site main building', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(126, 'laboratory@isaluhospitals.com', '2022-05-13 10:04:25', '', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'Hepatitis B', 5, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(127, 'it@isalu.com', '2022-05-13 10:44:46', '', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'Google mail subscription for the month of April', 2, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(128, 'it@isalu.com', '2022-05-13 11:19:32', '', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'subcription for Amazon web services', 2, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(129, 'audit@isaluhospitals.com', '2022-05-13 12:28:25', '', 1, 1, '19', '19', 1, 0, NULL, NULL, '1 ream of A4 paper, 1 piece of green pen', 7, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(130, 'procurement@isaluhospitals.com', '2022-05-13 12:36:06', '', 0, 1, '19', '22', 1, 0, NULL, NULL, 'SUPPLY OF 7000LITRES OF DIESEL @635 FOR ISALU AND SITE', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(132, 'mainstore@isaluhospitals.com', '2022-05-13 01:17:10', '', 1, 1, '19', '19', 1, 0, NULL, NULL, 'cellotape, A4 paper,staple pin for main store usage.', 14, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(133, 'procurement@isaluhospitals.com', '2022-05-13 03:34:35', '', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'SANKAZ  Gate repair @ Site ', 1, 0, 1, 2, 0, '0000-00-00 00:00:00'),
(134, 'bcc@isaluhospitals.com', '2022-05-13 04:39:50', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, '', 16, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(135, 'bcc@isaluhospitals.com', '2022-05-13 04:40:32', 'Claim is to be used for this.', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'CUG SUBSCRIPTION (4,000.00)\nWARDROUND DOCTOR	9095994080	\nNEW CALL DOCTOR	8096938058	\nMAINTENANCE AY	8093930762	\nPHARMACY GENERAL (OFFICE)	8172001529	', 16, 1, 1, 2, 0, '0000-00-00 00:00:00'),
(136, 'procurement@isaluhospitals.com', '2022-05-13 04:44:59', '', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'Purchase of 5 bag of pop cement\nPurchase of 5pcs of glover paint for Site Annex', 1, 0, 0, 2, 0, '0000-00-00 00:00:00'),
(137, 'yosanusi@isaluhospitals.com', '2022-05-13 05:28:11', '', 0, 0, '19', NULL, 0, 0, NULL, NULL, 'STATIONARY', 17, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(138, 'bcc@isaluhospitals.com', '2022-05-13 06:13:12', '', 0, 0, '19', NULL, 1, 0, NULL, NULL, 'Outstanding requisition(previously approved), A4 paper, For BCC usage.', 16, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(139, 'procurement@isaluhospitals.com', '2022-05-13 06:55:12', '', 1, 1, '19', '19', 1, 0, NULL, NULL, 'Old ambulance repair', 1, 0, 0, 2, 0, '0000-00-00 00:00:00');

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
(14, 'carton'),
(15, 'realm'),
(16, 'roll'),
(17, 'bag'),
(18, 'carton '),
(19, 'keg'),
(20, 'installation'),
(21, 'bottle'),
(22, 'monthly'),
(23, 'yearly'),
(24, 'galon'),
(25, 'gallon'),
(26, '1CAR');

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
(1, 'IT', 'it@isalu.com', 'cd583446b7cac435a84920a7d524ae8b', -1, 1, 2),
(19, 'Audit', 'audit@isaluhospitals.com', 'fbad4b6f1e710ddf1a3d37106d096688', 1, 1, 7),
(20, 'Procurement', 'procurement@isaluhospitals.com', '93aa88d53279ccb3e40713d4396e198f', 3, 1, 1),
(21, 'Account', 'account@isaluhospitals.com', '815bfabdb81b8c068304980343e02cba', 4, 1, 6),
(22, 'MD/CEO', 'yosanusi@isaluhospitals.com', '9ed04da71ff9947afab3cd880a7dd26b', 2, 1, 17),
(23, 'HR', 'hr@isaluhospitals.com', '5f4dcc3b5aa765d61d8327deb882cf99', 5, 1, 13),
(24, 'BCC HOD', 'bcc@isaluhospitals.com', 'e47429a2e15df3ded842178ff6d837ef', 7, 1, 16),
(25, 'Client Service HOD', 'clientservice@isaluhospitals.com', '5f4dcc3b5aa765d61d8327deb882cf99', 8, 1, 3),
(26, 'Radiology ', 'radiology@isaluhospitals.com', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 0, 11),
(27, 'Laboratory', 'laboratory@isaluhospitals.com', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 1, 5),
(28, 'Nursing ', 'nursing@isaluhospitals.com', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 0, 4),
(29, 'Quickbook', 'quickbook@isaluhospitals.com', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 0, 9),
(30, 'Test', 'test@isaluhospitals.com', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 1, 18),
(31, 'Quality Control', 'qualitycontrol@isaluhospitals.com', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 0, 15),
(32, 'Pharmacy', 'pharmacy@isaluhospitals.com', '47a2575b04f890b69da851f279eb69e0', 0, 1, 10),
(33, 'Medical', 'medical@isaluhospitals.com', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 0, 17),
(34, 'Kitchen', 'kitchen@isaluhospitals.com', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 1, 12),
(35, 'procurement2', 'procurement2@isaluhospitals.com', '7c6a180b36896a0a8c02787eeafb0e4c', 0, 1, 1),
(36, 'Security Department', 'security@isalu.com', 'e91e6348157868de9dd8b25c81aebfb9', 0, 1, 13),
(37, 'Main Store', 'mainstore@isaluhospitals.com', 'a773b3ad900819de179be72d96687c38', 0, 1, 14);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `claims_detail`
--
ALTER TABLE `claims_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `claims_header`
--
ALTER TABLE `claims_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT for table `item_movement`
--
ALTER TABLE `item_movement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `refunds_detail`
--
ALTER TABLE `refunds_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `refunds_header`
--
ALTER TABLE `refunds_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `requisition_detail`
--
ALTER TABLE `requisition_detail`
  MODIFY `reqdetailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `requisition_header`
--
ALTER TABLE `requisition_header`
  MODIFY `reqnumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
