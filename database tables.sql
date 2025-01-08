-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2021 at 12:18 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtocart`
--

CREATE TABLE `addtocart` (
  `pk` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(65,2) NOT NULL,
  `quantity` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addtocart`
--

INSERT INTO `addtocart` (`pk`, `id`, `name`, `price`, `quantity`, `image`, `username`) VALUES
(26, 90, 'BMW', '457800.00', 2, '60f27e3b28e981.85667520.jpg', 'buyer'),
(28, 87, 'Apple watch', '750.00', 1, '60f27dabcd4504.20540312.jpeg', 'user1');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `password` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin1', 12345),
('admin2', 12345);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `sender` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `reportedseller` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`sender`, `message`, `reportedseller`) VALUES
('user1', 'sell fake product', 'seller');

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--

CREATE TABLE `orderproduct` (
  `orderproductid` int(255) NOT NULL,
  `productid` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `deliverystatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderproduct`
--

INSERT INTO `orderproduct` (`orderproductid`, `productid`, `image`, `name`, `quantity`, `buyer`, `seller`, `status`, `deliverystatus`) VALUES
(34, 87, '60f27dabcd4504.20540312.jpeg', 'Apple watch', 4, 'buyer', 'seller', 2, 'Delivery completed');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price` decimal(65,2) NOT NULL,
  `stock` int(4) NOT NULL,
  `sold` int(255) NOT NULL DEFAULT 0,
  `user_id` varchar(255) NOT NULL,
  `mainimage` varchar(255) NOT NULL,
  `subimage1` varchar(255) DEFAULT NULL,
  `subimage2` varchar(255) DEFAULT NULL,
  `subimage3` varchar(255) DEFAULT NULL,
  `subimage4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `category`, `brand`, `price`, `stock`, `sold`, `user_id`, `mainimage`, `subimage1`, `subimage2`, `subimage3`, `subimage4`) VALUES
(86, 'Asus Computer', 'Nice computer', 'Computer & Accessories', 'Asus', '2500.00', 5, 0, 'seller', '60f27cf59c2490.42407034.jpg', NULL, NULL, NULL, NULL),
(87, 'Apple watch', 'Nice watch', 'Clothing', 'Apple', '750.00', 1, 40, 'seller', '60f27dabcd4504.20540312.jpeg', NULL, NULL, NULL, NULL),
(88, 'Android TV', 'Nice TV', 'Home & Living', 'Android', '4300.00', 3, 0, 'seller', '60f27dd6aab557.36651959.jpg', NULL, NULL, NULL, NULL),
(89, 'TV cabinet', 'Nice cabinet', 'Home & Living', 'No brand', '1599.00', 10, 0, 'seller', '60f27e1126a9f7.56718623.jpg', NULL, NULL, NULL, NULL),
(90, 'BMW', 'Nice car', 'Car & Accessories', 'BMW', '457800.00', 5, 0, 'seller', '60f27e3b28e981.85667520.jpg', '60f27e3b28e9f2.79331309.png', '60f27e3b28ea09.83907032.jpg', NULL, NULL),
(92, 'Iphone 12', 'Nice phone', 'Mobile & Gadgets', 'Apple', '2500.00', 3, 0, 'buyer', '60f2a9fb0dc649.96074162.jpg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telno` varchar(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `address`, `telno`, `status`) VALUES
('buyer', '12345', 'Taman Green', '01234567890', 1),
('seller', '12345', 'Taman Good', '0123456789', 1),
('user1', '123456', 'Taman Nice', '0123456789', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtocart`
--
ALTER TABLE `addtocart`
  ADD PRIMARY KEY (`pk`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`sender`);

--
-- Indexes for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`orderproductid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addtocart`
--
ALTER TABLE `addtocart`
  MODIFY `pk` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `orderproduct`
--
ALTER TABLE `orderproduct`
  MODIFY `orderproductid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
