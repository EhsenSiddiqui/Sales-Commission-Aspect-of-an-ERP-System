-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2021 at 02:02 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_commission`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `PRODUCT_CATEGORY` varchar(10) NOT NULL,
  `DESCRIPTION` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`PRODUCT_CATEGORY`, `DESCRIPTION`) VALUES
('A', 'This is product category \'A\'.'),
('B', 'This is product category \'B\'.');

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `COMMISSION_ID` int(11) NOT NULL,
  `SALESPERSON_ID` int(11) NOT NULL,
  `PRODUCT_CATEGORY` varchar(10) NOT NULL,
  `TOTAL_SALES` double NOT NULL,
  `COMMISSION_PCT` double NOT NULL,
  `COMMISSION_AMOUNT` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`COMMISSION_ID`, `SALESPERSON_ID`, `PRODUCT_CATEGORY`, `TOTAL_SALES`, `COMMISSION_PCT`, `COMMISSION_AMOUNT`) VALUES
(1, 5, 'A', 6500, 0.35, 2275),
(2, 5, 'B', 5000, 0.12, 600),
(3, 6, 'A', 2000, 0.15, 300),
(4, 7, 'B', 5000, 0.12, 600),
(5, 8, 'A', 2000, 0.15, 300),
(6, 8, 'B', 8000, 0.18, 1440);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CUSTOMER_ID` int(11) NOT NULL,
  `FIRST_NAME` text NOT NULL,
  `LAST_NAME` text NOT NULL,
  `ADDRESS` text NOT NULL,
  `EMAIL` text NOT NULL,
  `CONTACT_NO` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CUSTOMER_ID`, `FIRST_NAME`, `LAST_NAME`, `ADDRESS`, `EMAIL`, `CONTACT_NO`) VALUES
(1, 'A', 'B', '', '', 0),
(2, 'ABC', 'XYZ', 'a', 'a@gmail.com', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `TRANSACTION_ID` int(11) NOT NULL,
  `EMP_ID` int(11) NOT NULL,
  `PAYMENT_TYPE` varchar(10) NOT NULL,
  `DATE` datetime NOT NULL,
  `AMOUNT` double NOT NULL,
  `Paid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`TRANSACTION_ID`, `EMP_ID`, `PAYMENT_TYPE`, `DATE`, `AMOUNT`, `Paid`) VALUES
(5, 5, 'C', '2021-04-12 12:53:52', 2875, 1),
(6, 6, 'C', '0000-00-00 00:00:00', 300, 1),
(7, 7, 'C', '0000-00-00 00:00:00', 600, 1),
(8, 8, 'C', '2021-04-12 12:51:20', 1740, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `ID` int(11) NOT NULL,
  `PRODUCT_CATEGORY` varchar(10) NOT NULL,
  `MIN_AMOUNT` double NOT NULL,
  `MAX_AMOUNT` double NOT NULL,
  `COMMISSION_PCT` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`ID`, `PRODUCT_CATEGORY`, `MIN_AMOUNT`, `MAX_AMOUNT`, `COMMISSION_PCT`) VALUES
(4, 'A', 500, 1000, 0.05),
(5, 'A', 1000, 2000, 0.1),
(6, 'A', 2000, 3000, 0.15),
(7, 'A', 3000, 4000, 0.2),
(8, 'A', 4000, 5000, 0.25),
(9, 'A', 5000, 6000, 0.3),
(10, 'A', 6000, 7000, 0.35),
(11, 'A', 7000, 8000, 0.4),
(12, 'A', 8000, 9000, 0.45),
(13, 'A', 9000, 10000, 0.5),
(14, 'B', 800, 1000, 0.02),
(15, 'B', 1000, 2000, 0.04),
(16, 'B', 2000, 3000, 0.06),
(17, 'B', 3000, 4000, 0.08),
(18, 'B', 4000, 5000, 0.1),
(19, 'B', 5000, 6000, 0.12),
(20, 'B', 6000, 7000, 0.14),
(21, 'B', 7000, 8000, 0.16),
(22, 'B', 8000, 9000, 0.18),
(23, 'B', 9000, 10000, 0.2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `PRODUCT_ID` varchar(10) NOT NULL,
  `PRODUCT_CATEGORY` varchar(10) NOT NULL,
  `PRODUCT_NAME` text NOT NULL,
  `PRICE` float NOT NULL,
  `TAX_PCT` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quarter`
--

CREATE TABLE `quarter` (
  `ID` int(11) NOT NULL,
  `QUARTER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quarter`
--

INSERT INTO `quarter` (`ID`, `QUARTER`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `SALE_ID` int(11) NOT NULL,
  `CUSTOMER_ID` int(11) NOT NULL,
  `SALESPERSON_ID` int(11) NOT NULL,
  `PRODUCT_CATEGORY` varchar(10) NOT NULL,
  `UNITS_SOLD` int(11) NOT NULL,
  `SALES_AMOUNT` double NOT NULL,
  `QUARTER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`SALE_ID`, `CUSTOMER_ID`, `SALESPERSON_ID`, `PRODUCT_CATEGORY`, `UNITS_SOLD`, `SALES_AMOUNT`, `QUARTER`) VALUES
(1, 1, 5, 'A', 3, 2000, 3),
(2, 2, 5, 'A', 5, 4500, 3),
(3, 1, 5, 'B', 3, 3000, 3),
(4, 1, 5, 'B', 2, 2000, 3),
(5, 1, 8, 'A', 1, 500, 3),
(6, 1, 8, 'A', 2, 1500, 3),
(7, 1, 8, 'B', 7, 7000, 3),
(8, 1, 8, 'B', 1, 1000, 3),
(9, 2, 6, 'A', 4, 2000, 3),
(10, 1, 7, 'B', 2, 5000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `STATUS_ID` int(11) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `STATUS` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`STATUS_ID`, `DESCRIPTION`, `STATUS`) VALUES
(1, 'Sent for CEO\'s approval', NULL),
(2, 'Approved by CEO/Calculated commission sent for Sales Department Head\'s approval', NULL),
(3, 'Sales HOD accepts the calculated commission', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `USER_TYPE_ID` varchar(20) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `USER_TYPE_ID`, `EMAIL`, `PASSWORD`) VALUES
(1, 'SD_TM', '', '123'),
(2, 'CEO', '', '123'),
(3, 'SALES_HOD', '', '123'),
(4, 'PAY_MGR', '', '123'),
(5, 'SALES_REP', 'm.ahsan.18076@khi.iba.edu.pk', '123'),
(6, 'SALES_REP', 'ahsan.sdi00@gmail.com', '123'),
(7, 'SALES_REP', 'mohammadahsansiddiqui@outlook.com', '123'),
(8, 'SALES_REP', 'ahsan@inqline.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `USER_TYPE_ID` varchar(20) NOT NULL,
  `DESCRIPTION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`USER_TYPE_ID`, `DESCRIPTION`) VALUES
('CEO', 'Chief Executive Officer '),
('PAY_MGR', 'Payables Manager'),
('SALES_HOD', 'Sales Department Head'),
('SALES_REP', 'Salesperson'),
('SD_TM', 'Sales Team Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`PRODUCT_CATEGORY`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`COMMISSION_ID`),
  ADD KEY `FK_ON_PRODUCT_CATEGORY` (`PRODUCT_CATEGORY`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CUSTOMER_ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`TRANSACTION_ID`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Test` (`PRODUCT_CATEGORY`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PRODUCT_ID`),
  ADD KEY `Foreign_Key_From_Categories` (`PRODUCT_CATEGORY`);

--
-- Indexes for table `quarter`
--
ALTER TABLE `quarter`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SALE_ID`),
  ADD KEY `FK_FROM_CATEGORIES` (`PRODUCT_CATEGORY`),
  ADD KEY `FK_FROM_CUSTOMERS` (`CUSTOMER_ID`),
  ADD KEY `FK_FROM_USERS` (`SALESPERSON_ID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`STATUS_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD KEY `FOREIGN_KEY_FROM_USER_TYPES_TABLE` (`USER_TYPE_ID`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`USER_TYPE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `COMMISSION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CUSTOMER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `TRANSACTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `quarter`
--
ALTER TABLE `quarter`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SALE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `STATUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commissions`
--
ALTER TABLE `commissions`
  ADD CONSTRAINT `FK_ON_PRODUCT_CATEGORY` FOREIGN KEY (`PRODUCT_CATEGORY`) REFERENCES `categories` (`PRODUCT_CATEGORY`);

--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `Test` FOREIGN KEY (`PRODUCT_CATEGORY`) REFERENCES `categories` (`PRODUCT_CATEGORY`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Foreign_Key_From_Categories` FOREIGN KEY (`PRODUCT_CATEGORY`) REFERENCES `categories` (`PRODUCT_CATEGORY`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `FK_FROM_CATEGORIES` FOREIGN KEY (`PRODUCT_CATEGORY`) REFERENCES `categories` (`PRODUCT_CATEGORY`),
  ADD CONSTRAINT `FK_FROM_CUSTOMERS` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `customers` (`CUSTOMER_ID`),
  ADD CONSTRAINT `FK_FROM_USERS` FOREIGN KEY (`SALESPERSON_ID`) REFERENCES `users` (`USER_ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FOREIGN_KEY_FROM_USER_TYPES_TABLE` FOREIGN KEY (`USER_TYPE_ID`) REFERENCES `user_types` (`USER_TYPE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
