-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2021 at 02:31 PM
-- Server version: 5.5.51
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeigniter_dckap`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `status`, `created_date`, `modified_date`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', '2021-03-21 04:05:35', '2021-03-21 04:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Soap', 0, '1', '2021-03-21 14:15:11', '2021-03-21 14:15:11'),
(2, 'Laptop', 0, '1', '2021-03-21 14:15:26', '2021-03-21 14:15:26'),
(3, 'Watch', 0, '1', '2021-03-21 14:20:23', '2021-03-21 14:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone_no` varchar(55) NOT NULL,
  `address` text NOT NULL,
  `main_total` decimal(10,2) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`id`, `name`, `email`, `phone_no`, `address`, `main_total`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Karthik', 'mskarthikt@yahoo.co.in', '9025110811', 'Beacon Law Solicitors Ltd\r\nShirley House\r\n12 Gatley Road', '35070.00', '1', '2021-03-21 14:23:09', '2021-03-21 14:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order_items`
--

CREATE TABLE `customer_order_items` (
  `id` int(11) NOT NULL,
  `customer_orders_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(55) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_total` decimal(10,2) NOT NULL,
  `item_img` varchar(55) DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_order_items`
--

INSERT INTO `customer_order_items` (`id`, `customer_orders_id`, `item_id`, `item_name`, `item_qty`, `item_price`, `item_total`, `item_img`, `status`, `created_date`, `modified_date`) VALUES
(1, 1, 1, 'Lux', 2, '35.00', '70.00', '1616316394.jpg', '1', '2021-03-21 14:23:09', '2021-03-21 14:23:09'),
(2, 1, 2, 'Lenova Thinkpad', 1, '35000.00', '35000.00', '1616316443.jpg', '1', '2021-03-21 14:23:09', '2021-03-21 14:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `product_name` varchar(155) NOT NULL,
  `short_description` text NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categories_id`, `product_name`, `short_description`, `description`, `price`, `status`, `created_date`, `modified_date`) VALUES
(1, 1, 'Lux', 'LUX is a global brand developed by Unilever. The range of products includes beauty soaps, shower gels, bath additives, hair shampoos and conditioners. Lux started as "Sunlight Flakes" laundry soap in 1899.', 'LUX is a global brand developed by Unilever. The range of products includes beauty soaps, shower gels, bath additives, hair shampoos and conditioners. Lux started as "Sunlight Flakes" laundry soap in 1899.', '35.00', '1', '2021-03-21 14:16:34', '2021-03-21 14:16:34'),
(2, 2, 'Lenova Thinkpad', 'Lenovo ThinkPad is a Windows 10 laptop with a 14.00-inch display that has a resolution of 1920x1080 pixels. It is powered by a Core i7 processor and it comes with 12GB of RAM. The Lenovo ThinkPad packs 256GB of SSD storage. Graphics are powered by Intel HD Graphics 520.', 'Lenovo ThinkPad is a Windows 10 laptop with a 14.00-inch display that has a resolution of 1920x1080 pixels. It is powered by a Core i7 processor and it comes with 12GB of RAM. The Lenovo ThinkPad packs 256GB of SSD storage. Graphics are powered by Intel HD Graphics 520.', '35000.00', '1', '2021-03-21 14:17:23', '2021-03-21 14:17:23'),
(3, 3, 'Titan', 'Titan Company Ltd is the world\'s fifth largest wrist watch manufacturer and India\'s leading producer of watches. The company is engaged in manufacturing of watches jewelry precision engineering and Eyewear. They produce watches under the brand name Titan Fastrack Sonata Nebula RAGA Regalia Octane & Xylys.', 'Titan Company Ltd is the world\'s fifth largest wrist watch manufacturer and India\'s leading producer of watches. The company is engaged in manufacturing of watches jewelry precision engineering and Eyewear. They produce watches under the brand name Titan Fastrack Sonata Nebula RAGA Regalia Octane & Xylys.', '500.00', '1', '2021-03-21 14:21:13', '2021-03-21 14:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `image_name` varchar(155) NOT NULL,
  `image_path` varchar(155) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `products_id`, `image_name`, `image_path`, `status`, `created_date`, `modified_date`) VALUES
(1, 1, '1616316394.jpg', 'assets/products/', '1', '2021-03-21 14:16:34', '2021-03-21 14:16:34'),
(2, 2, '1616316443.jpg', 'assets/products/', '1', '2021-03-21 14:17:23', '2021-03-21 14:17:23'),
(3, 2, '16163164431.jpg', 'assets/products/', '1', '2021-03-21 14:17:23', '2021-03-21 14:17:23'),
(4, 3, '1616316673.jpg', 'assets/products/', '1', '2021-03-21 14:21:13', '2021-03-21 14:21:13'),
(5, 3, '16163166731.jpg', 'assets/products/', '1', '2021-03-21 14:21:13', '2021-03-21 14:21:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_order_items`
--
ALTER TABLE `customer_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer_order_items`
--
ALTER TABLE `customer_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
