-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2018 at 10:46 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ajyad_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `credit` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `employee_id`, `fullname`, `email`, `contact`, `address`, `credit`, `password`, `created_date`, `is_active`, `status`) VALUES
(1, 'mohammad_sl', 'Mohammad Salah', 'salah@mail.com', '36545650', 'Building 78, Road 543, Block 606, Muharraq', '16.3', '123', '2017-12-04 14:03:42', 1, 1),
(2, 'jaber', 'Muhammad Jaber', 'jaber@mail.com', '63258790', 'Building-095, Road-3511, Block-335, Umm Al Hassam', '4.4', '123', '2017-12-04 15:54:24', 1, 1),
(3, 'nawal_bk', 'Nawal Al Bukhari', 'nawal@gmail.com', '36553256', 'Building-653, Road-521, Block-635, Arad', '8.5', 'abc123', '2017-12-04 16:22:02', 0, 1),
(4, 'fatima', 'Fatima Al Mutawa', 'fatima@mail.com', '65678788', 'Flat-10, Building-886, Road-980, RIffa', '0', '123', '2018-05-30 14:36:32', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `order_type` int(11) NOT NULL,
  `process_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_ship_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `customer_id`, `grand_total`, `total_qty`, `payment_type`, `order_type`, `process_status`, `order_status`, `customer_name`, `customer_email`, `customer_contact`, `customer_ship_address`) VALUES
(83, '2017-12-13 16:03:02', 1, '6.2', 3, 2, 2, 2, 1, 'Rashid', 'rashid@mail.com', '56891235', 'building 20, road 569, block 878, Muharraq'),
(84, '2017-12-17 13:13:36', 1, '4.4', 2, 2, 1, 1, 1, 'rashid ahmed', 'rashid@mail.com', '55555555', 'building 5630, road 569, block 878, Arad'),
(85, '2017-12-17 13:22:23', 1, '7.2', 4, 1, 2, 1, 1, 'Rashid', 'rashid@mail.com', '55555555', 'building 20, road 569, block 878, Muharraq'),
(86, '2017-12-17 14:40:30', 1, '4.4', 2, 2, 1, 1, 0, '', '', '36523652', 'building 67, road 787'),
(87, '2017-12-17 14:50:59', 1, '0.4', 2, 2, 1, 1, 1, 'Rashid Shamsi', 'rashid@mail.com', '36545655', 'Building 78, Road 543, Block 606, Muharraq'),
(88, '2018-03-19 01:11:47', -1, '3.6', 2, 1, 1, 1, 1, 'saqib ', 'saqib@mail.com', '36656985', ''),
(89, '2018-03-19 01:31:15', -1, '2.2', 1, 1, 1, 1, 1, 'arif Ahmed', 'arif@mail.com', '36585665', ''),
(90, '2018-05-30 14:31:20', -1, '3.6', 2, 1, 1, 1, 0, 'fff', 'fff@mail.com', '86868623', ''),
(91, '2018-05-30 15:56:34', 4, '1.8', 1, 1, 0, 1, 1, 'Fatima Al Mutawa', 'fatima@mail.com', '', 'Flat-10, Building-886, Road-980, RIffa'),
(92, '2018-05-30 16:01:23', 4, '3.6', 2, 1, 0, 1, 1, 'Fatima Al Mutawa', 'fatima@mail.com', '', 'Flat-10, Building-886, Road-980, RIffa'),
(93, '2018-05-30 16:02:03', 4, '3.6', 2, 1, 0, 1, 1, 'Fatima Al Mutawa', 'fatima@mail.com', '', 'Flat-10, Building-886, Road-980, RIffa'),
(94, '2018-05-30 16:04:19', 4, '3.6', 2, 1, 0, 1, 1, 'Fatima Al Mutawa', 'fatima@mail.com', '', 'Flat-10, Building-886, Road-980, RIffa'),
(95, '2018-05-30 16:07:21', -1, '3.6', 2, 1, 1, 1, 0, 'Fatima', 'fatima@mail.com', '', ''),
(96, '2018-05-30 16:18:01', -1, '2.2', 1, 1, 1, 1, 0, 'abc', 'abc@mail.com', '', ''),
(97, '2018-05-30 16:36:31', -1, '2.2', 1, 1, 1, 1, 0, 'ghg', 'fg@ghh.co', '', ''),
(98, '2018-05-30 16:37:12', -1, '2.2', 1, 1, 1, 1, 0, 'ghg', 'fg@ghh.co', '', ''),
(99, '2018-05-30 16:41:13', -1, '2.2', 1, 1, 1, 1, 0, 'ghg', 'fg@ghh.co', '', ''),
(100, '2018-05-30 16:41:24', -1, '2.2', 1, 1, 1, 1, 0, 'ghg', 'fg@ghh.co', '', ''),
(101, '2018-05-30 16:44:30', -1, '2.2', 1, 1, 1, 1, 0, 'ghg', 'fg@ghh.co', '', ''),
(102, '2018-05-30 21:49:29', -1, '2.2', 1, 1, 1, 1, 0, 'hhh', 'fa@mail.com', '', ''),
(103, '2018-05-30 22:12:50', -1, '1.8', 1, 1, 1, 1, 0, 'hhh', 'hh@mail.com', '36925817', ''),
(104, '2018-05-30 22:24:26', -1, '1.8', 1, 1, 0, 1, 0, 'hh', 'hh@mail.co', '64664366', 'riffa'),
(105, '2018-05-30 22:27:35', -1, '2.2', 1, 2, 0, 1, 0, 'hgh', 'hgh@mail.co', '', 'hkl'),
(106, '2018-05-30 22:27:49', -1, '2.2', 1, 1, 0, 1, 0, 'hgh', 'hgh@mail.co', '12345678', 'hkl'),
(107, '2018-05-30 22:39:47', -1, '1.8', 1, 2, 1, 1, 0, 'ggg', 'gg@mail.co', '', 'hjja'),
(108, '2018-05-30 22:48:36', -1, '1.8', 1, 2, 1, 1, 0, 'hh', 'hh@mail.ci', '36925814', 'riffa'),
(109, '2018-06-18 11:19:55', -1, '2.3', 2, 2, 1, 1, 1, 'Hamdan Al Ashraf', 'hamdan@mail.com', '38987456', 'Flat 23, Road 789, Block 0987, Muharraq'),
(110, '2018-07-07 12:02:49', -1, '4.8', 4, 2, 1, 1, 1, 'hh', 'hh@mail.com', '34545444', 'riffa');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`) VALUES
(313, 83, 12, '1', '1.8', '1.8', 1),
(314, 83, 8, '2', '2.2', '4.4', 1),
(315, 84, 8, '2', '2.2', '4.4', 1),
(316, 85, 12, '4', '1.8', '7.2', 1),
(317, 86, 8, '2', '2.2', '4.4', 1),
(318, 87, 9, '2', '0.2', '0.4', 1),
(319, 88, 12, '2', '1.8', '3.6', 1),
(320, 89, 8, '1', '2.2', '2.2', 1),
(321, 90, 12, '2', '1.8', '3.6', 1),
(322, 91, 12, '1', '1.8', '1.8', 1),
(323, 92, 12, '1', '1.8', '1.8', 1),
(324, 92, 12, '1', '1.8', '1.8', 1),
(325, 93, 12, '1', '1.8', '1.8', 1),
(326, 93, 12, '1', '1.8', '1.8', 1),
(327, 94, 12, '1', '1.8', '1.8', 1),
(328, 94, 12, '1', '1.8', '1.8', 1),
(329, 95, 12, '1', '1.8', '1.8', 1),
(330, 95, 12, '1', '1.8', '1.8', 1),
(331, 96, 8, '1', '2.2', '2.2', 1),
(332, 97, 8, '1', '2.2', '2.2', 1),
(333, 98, 8, '1', '2.2', '2.2', 1),
(334, 99, 8, '1', '2.2', '2.2', 1),
(335, 100, 8, '1', '2.2', '2.2', 1),
(336, 101, 8, '1', '2.2', '2.2', 1),
(337, 102, 8, '1', '2.2', '2.2', 1),
(338, 103, 12, '1', '1.8', '1.8', 1),
(339, 104, 12, '1', '1.8', '1.8', 1),
(340, 105, 8, '1', '2.2', '2.2', 1),
(341, 106, 8, '1', '2.2', '2.2', 1),
(342, 107, 12, '1', '1.8', '1.8', 1),
(343, 108, 12, '1', '1.8', '1.8', 1),
(344, 109, 15, '1', '0.1', '0.1', 1),
(345, 109, 19, '1', '2.2', '2.2', 1),
(346, 110, 19, '2', '2.2', '4.4', 1),
(347, 110, 16, '2', '0.2', '0.4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `image_2` varchar(255) NOT NULL,
  `image_3` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `stock_status` tinyint(4) NOT NULL,
  `product_status` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `subcategory_id`, `category_id`, `product_code`, `product_name`, `product_price`, `product_desc`, `image_1`, `image_2`, `image_3`, `qty`, `stock_status`, `product_status`, `status`, `created_date`, `modified_date`) VALUES
(8, 1, 1, 'BBR', 'Mini Burger', '.8', 'Mini beef burger', '76848.jpg', '', '', 0, 0, 1, 1, '2017-12-12 13:18:13', '0000-00-00 00:00:00'),
(9, 1, 1, 'DTE', 'Lipton Tea 1KG', '0.2', 'world most famous tea', '82220.jpg', '', '', 0, 0, 1, 0, '2017-12-12 13:21:31', '0000-00-00 00:00:00'),
(12, 2, 1, 'CHN', 'Maggie Noodles', '1.8', 'Maggie amazing chicken noodles', '115827.jpg', '', '', 0, 0, 1, 0, '2017-12-12 14:30:59', '0000-00-00 00:00:00'),
(14, 4, 2, 'PES', 'Pepsi 2.25Ltr', '7.5', 'Pepsi Cold Drink Jumbo 2.25 Ltr', '138812.jpg', '', '', 0, 0, 1, 1, '2018-05-27 11:07:17', '0000-00-00 00:00:00'),
(15, 2, 1, 'BRL', 'Bread Large', '0.1', 'White Bread Large', '149510.jpeg', '', '', 0, 0, 1, 1, '2018-06-18 11:10:35', '0000-00-00 00:00:00'),
(16, 2, 1, 'BRB', 'Brown Bread', '0.2', 'Brown Bread Medium', '153561.jpeg', '', '', 0, 0, 1, 1, '2018-06-18 11:11:16', '0000-00-00 00:00:00'),
(17, 2, 1, 'BNR', 'Buns Round (8pcs)', '.1', 'Round Burger Buns 8pcs', '164004.jpeg', '', '', 0, 0, 1, 1, '2018-06-18 11:12:41', '0000-00-00 00:00:00'),
(18, 2, 1, 'BRN', 'Bun Rolls 6pcs', '0.2', 'Bun rolls 6pcs', '171059.jpg', '', '', 0, 0, 1, 1, '2018-06-18 11:13:55', '0000-00-00 00:00:00'),
(19, 1, 1, 'CHC', 'Chocolate Cake 1 pound', '2.2', 'Delicious Fresh Chocolate Cake 1 pound', '181008.png', '', '', 0, 0, 1, 1, '2018-06-18 11:15:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `category_code` varchar(10) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `category_code`, `category_name`, `image`, `is_active`, `status`, `created_date`) VALUES
(1, 'BKP', 'Bakery Products', 'CAT-7815.jpg', 1, 1, '2017-08-07 14:00:00'),
(2, 'DRK', 'Drinks & Bevearges', 'CAT-8062.jpg', 1, 1, '2017-08-07 14:10:00'),
(3, 'DRP', 'Dairy Products', 'CAT-5148.png', 1, 1, '2017-08-07 14:10:00'),
(4, 'FRF', 'Frozen Food', 'CAT-8298.jpg', 1, 1, '2018-05-26 14:36:49'),
(5, 'STI', 'Stationary Items', 'CAT-4302.jpg', 1, 1, '2018-05-26 14:40:47'),
(8, 'GRM', 'Garments', 'CAT-3725.jpeg', 1, 1, '2018-05-27 15:31:06');

-- --------------------------------------------------------

--
-- Table structure for table `product_subcategories`
--

CREATE TABLE `product_subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_subcategories`
--

INSERT INTO `product_subcategories` (`id`, `category_id`, `name`, `is_active`, `status`, `created_date`) VALUES
(1, 1, 'Cakes & Pastries', 1, 1, '2018-05-26 14:56:30'),
(2, 1, 'Breads & Buns', 1, 1, '2018-05-26 15:08:21'),
(3, 4, 'Meat & Chicken', 1, 1, '2018-05-27 10:57:52'),
(4, 2, 'Cold Drinks', 1, 1, '2018-05-27 11:00:03'),
(5, 2, 'Juices', 1, 1, '2018-05-27 11:00:19'),
(6, 3, 'Milk & Yogurt', 1, 1, '2018-05-27 11:01:14'),
(7, 3, 'Cheese & Butter', 1, 1, '2018-05-27 11:01:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_subcategories`
--
ALTER TABLE `product_subcategories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=348;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_subcategories`
--
ALTER TABLE `product_subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
