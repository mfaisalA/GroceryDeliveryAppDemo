-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2018 at 09:37 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automated_cafeteria_app`
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
(1, 'EMP10001', 'Rashid Shamsi', 'rashid@mail.com', '36545650', 'Building 78, Road 543, Block 606, Muharraq', '16.3', '123', '2017-12-04 14:03:42', 1, 1),
(2, 'EMP10002', 'Muhammad Jaber', 'jaber@mail.com', '63258790', 'Building-095, Road-3511, Block-335, Umm Al Hassam', '4.4', '123', '2017-12-04 15:54:24', 1, 1),
(3, 'EMP10003', 'Marwa Al Shams', 'marwa@gmail.com', '36553256', 'Building-653, Road-521, Block-635, Arad', '8.5', 'abc123', '2017-12-04 16:22:02', 0, 1),
(4, 'emp22222', 'faisal', 'fa@ma.co', '55555555', 'hhh\n', '4.4', '123', '2017-12-09 17:13:49', 1, 0),
(5, '', '', '', '88525856', '', '4.4', '', '2017-12-13 12:26:05', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `created_date`, `status`) VALUES
(1, 'breakfast', '2017-12-11 16:18:50', 1),
(2, 'lunch', '2017-12-11 16:19:03', 1),
(3, 'dinner', '2017-12-11 16:19:10', 1);

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
(89, '2018-03-19 01:31:15', -1, '2.2', 1, 1, 1, 1, 1, 'arif Ahmed', 'arif@mail.com', '36585665', '');

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
(320, 89, 8, '1', '2.2', '2.2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
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

INSERT INTO `products` (`id`, `menu_id`, `category_id`, `product_code`, `product_name`, `product_price`, `product_desc`, `image_1`, `image_2`, `image_3`, `qty`, `stock_status`, `product_status`, `status`, `created_date`, `modified_date`) VALUES
(8, 1, 1, 'BBR', 'Beef Bacon Burger', '2.2', 'Smoked Beef Bacon, Swiss Cheese, Tomatoes, Onions', '76848.jpg', '', '', 0, 0, 1, 1, '2017-12-12 13:18:13', '0000-00-00 00:00:00'),
(9, 1, 2, 'DTE', 'Tea', '0.2', 'Hot Tea with milk and sugar', '82220.jpg', '', '', 0, 0, 1, 1, '2017-12-12 13:21:31', '0000-00-00 00:00:00'),
(12, 2, 1, 'CHN', 'Chicken Noodles', '1.8', 'Chicken noodles, vegetables, mozzarella cheese, Tomato Sauce', '115827.jpg', '', '', 0, 0, 1, 1, '2017-12-12 14:30:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `category_code` varchar(10) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL,
  `label_color` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `category_code`, `category_name`, `is_active`, `status`, `label_color`, `created_date`) VALUES
(1, 'MCO', 'Main Course', 1, 1, '#3fb7d2', '2017-08-07 14:00:00'),
(2, 'DRK', 'Drinks', 1, 1, '#15c01c', '2017-08-07 14:10:00'),
(3, 'DES', 'Desserts', 1, 1, '#ff9e29', '2017-08-07 14:10:00');

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
-- Indexes for table `menus`
--
ALTER TABLE `menus`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
