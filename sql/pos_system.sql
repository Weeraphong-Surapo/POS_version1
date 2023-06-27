-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 27, 2023 at 06:14 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`category_id`, `category_name`) VALUES
(1, 'กาแฟ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_fname` varchar(200) NOT NULL,
  `customer_lname` varchar(200) NOT NULL,
  `customer_phone` varchar(10) NOT NULL,
  `customer_line` varchar(100) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`customer_id`, `customer_fname`, `customer_lname`, `customer_phone`, `customer_line`, `customer_address`, `created_at`) VALUES
(8, '111', '111', '111', '111', '111', '15-03-23 06:35'),
(11, 'user4', '44', '32423', '324234', '', '17-03-23 03:59'),
(12, 'วีระพงษ์', 'สุราโพธิ์', '0925562767', '1', 'fdsfsdf', '18-03-23 10:16'),
(13, 'test', 'test', '213', 'sadf', 'test', '02-04-23 23:37');

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE `tb_employee` (
  `employee_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(200) DEFAULT NULL,
  `lname` varchar(200) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `line` varchar(100) DEFAULT NULL,
  `user_img` varchar(255) NOT NULL DEFAULT 'avatar.png',
  `type` int(3) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`employee_id`, `username`, `password`, `fname`, `lname`, `address`, `phone`, `line`, `user_img`, `type`, `created_at`) VALUES
(13, 'emp', 'e10adc3949ba59abbe56e057f20f883e', 'Weeraphong', 'Surapho', 'test', '234', 'test', '99825152-4DQpjUtzLUwmJZZSB0UzGGz9gSB9x3oxSOGUyKGbhxrm.jpeg', 1, '19/03/2023 20:22:39'),
(18, 'test', '098f6bcd4621d373cade4e832627b4f6', 'Admin', 'Admin', 'sjiodf11', '9808', '8908', '83910620-2.jpeg', 999, '02/04/2023 16:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_qty` int(10) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_total_price` decimal(10,2) NOT NULL,
  `day` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `product_id`, `sale_id`, `product_qty`, `product_price`, `product_total_price`, `day`) VALUES
(1, 1, 1, 1, '1.00', '0.00', '02'),
(2, 3, 1, 1, '324.00', '0.00', '02'),
(3, 1, 2, 1, '1.00', '0.00', '02'),
(4, 3, 3, 1, '324.00', '324.00', '03');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_img` varchar(255) NOT NULL DEFAULT 'upload/product.png',
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `product_code`, `product_name`, `product_price`, `product_qty`, `product_img`, `category_id`, `created_at`) VALUES
(1, '1', '1', 1, 1, 'upload/56149-1471022813.jpeg', 1, '2023-04-01 16:09:06'),
(3, 'test', 'test', 324, 234, 'upload/29732-แบบแผนที่ยังไม่ได้ตั้งชื่อ.drawio-(5).png', 1, '2023-04-01 15:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sale`
--

CREATE TABLE `tb_sale` (
  `sale_id` int(11) NOT NULL,
  `sale_code` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `count_cart` int(100) NOT NULL,
  `get_money` decimal(10,2) NOT NULL,
  `change_money` decimal(10,2) NOT NULL,
  `product_total_price` decimal(10,2) NOT NULL,
  `by_date` varchar(100) NOT NULL,
  `by_month` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_sale`
--

INSERT INTO `tb_sale` (`sale_id`, `sale_code`, `customer_id`, `employee_id`, `count_cart`, `get_money`, `change_money`, `product_total_price`, `by_date`, `by_month`) VALUES
(1, '#744795', '', 1, 2, '325.00', '0.00', '325.00', '02-04-23 16:36:06', 4),
(2, '#189815', '', 18, 1, '1.00', '0.00', '1.00', '02-04-23 21:55:06', 4),
(3, '#400747', '12', 18, 1, '324.00', '0.00', '324.00', '03-04-23 15:00:14', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_shop`
--

CREATE TABLE `tb_shop` (
  `id` int(11) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_address` varchar(255) NOT NULL,
  `shop_img` varchar(255) NOT NULL,
  `shop_phone` varchar(100) NOT NULL,
  `line_notify` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_shop`
--

INSERT INTO `tb_shop` (`id`, `shop_name`, `shop_address`, `shop_img`, `shop_phone`, `line_notify`) VALUES
(1, 'บริษัทบิ้กออโต้ จำกัด', 'ยโสธร', '63465618-6ecb91e73eab30f51b0b29a880338147.png', '0925562767', 'EGUQButlBysapnuGO44jKpx3biPIHvJKBy2HlLksnw3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tb_sale`
--
ALTER TABLE `tb_sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `tb_shop`
--
ALTER TABLE `tb_shop`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_sale`
--
ALTER TABLE `tb_sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_shop`
--
ALTER TABLE `tb_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
