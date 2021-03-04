-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 02:36 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstoreproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `name`, `city`, `phone`) VALUES
(1, 'Simon Sinek', 'New York', 1234567891),
(2, 'Eric Ries', 'Deroit', 1597531265),
(3, 'Stephen Covey', 'California', 1651485290),
(4, 'Alisha Rai', 'Kolkata', 1265147892),
(5, 'Tessa Dare', 'Miami', 2135201459);

-- --------------------------------------------------------

--
-- Table structure for table `book_store_inventory`
--

CREATE TABLE `book_store_inventory` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(20) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `Price` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_store_inventory`
--

INSERT INTO `book_store_inventory` (`book_id`, `book_name`, `author_id`, `category_id`, `quantity`, `Price`) VALUES
(1, 'The Infinite Game', 1, 1, 5, '59'),
(2, 'Leaders Eat Last', 1, 1, 4, '99'),
(3, 'The Lean Startup', 2, 1, 10, '29'),
(4, 'The Leader\'s Guide', 2, 1, 5, '39'),
(5, 'First Things First', 3, 1, 14, '89'),
(6, 'The 8th Habit', 3, 1, 9, '25'),
(7, 'Serving Pleasure', 4, 2, 20, '19'),
(8, 'Play with me', 4, 2, 14, '29'),
(9, 'A Lady at midnight', 5, 2, 12, '5');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'business'),
(2, 'romance');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `book_name` varchar(50) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` int(10) NOT NULL,
  `debit/credit` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`book_name`, `order_id`, `customer_name`, `address`, `phone`, `debit/credit`) VALUES
('The Infinite Game', 8, 'DarshPatel', 'Old Huron', 2147483647, 215368497),
('The Infinite Game', 9, 'Darsh', 'huron', 2147483647, 1234567890),
('Play with me', 15, 'Darsh', 'huron', 2147483647, 1234567890),
('First Things First', 16, 'Darsh', 'huron', 2147483647, 1234567890);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `book_store_inventory`
--
ALTER TABLE `book_store_inventory`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_store_inventory`
--
ALTER TABLE `book_store_inventory`
  ADD CONSTRAINT `book_store_inventory_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`),
  ADD CONSTRAINT `book_store_inventory_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
