-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 03:56 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alkigrocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `name`, `parent_id`) VALUES
(1, 'Fruits and Vegetables', 0),
(2, 'Dairy and Eggs', 0),
(3, 'Drinks', 0),
(4, 'Household Items', 0),
(5, 'Bakery', 0),
(6, 'Fruits', 1),
(7, 'Vegetables', 1),
(8, 'Nuts', 1),
(9, 'Milk and Cream', 2),
(10, 'Eggs and Butter', 2),
(11, 'Cleaning', 4),
(12, 'Laundry', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ord`
--

CREATE TABLE `ord` (
  `oid` int(11) NOT NULL,
  `uname` varchar(50) DEFAULT NULL,
  `umobile` int(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `uadd` varchar(50) DEFAULT NULL,
  `ustate` varchar(50) DEFAULT NULL,
  `ucity` varchar(50) DEFAULT NULL,
  `upostcode` int(50) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ord`
--

INSERT INTO `ord` (`oid`, `uname`, `umobile`, `email`, `uadd`, `ustate`, `ucity`, `upostcode`, `total`, `date`) VALUES
(44, 'Anishaa', 420826597, 'anigmail@hotmail.com', 'unit 6 high street', 'NSW', 'sydney', 2005, 23, '2024-04-28 23:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `oid`, `pid`, `quantity`, `amount`, `subtotal`) VALUES
(25, 44, 4, 1, 11, 11),
(26, 44, 6, 1, 12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `cid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `name`, `price`, `stock`, `weight`, `pic`, `cid`) VALUES
(1, 'Ajax Disinfectant', 15, 0, '(500ml)', 'images/ajax.jpg', 11),
(2, 'Almond', 12, 9, '(200gm)', 'images/almond.jpg', 8),
(3, 'Apple', 20, 10, ' (1kg)', 'images/apple.jpg', 6),
(4, 'Banana', 11, 9, '(1kg)', 'images/banana.jpg', 6),
(5, 'Black berries', 15, 10, '(200gm)', 'images/blackberry.jpg', 6),
(6, 'Blue berries', 12, 8, '(300gm)', 'images/blueberry.jpg', 6),
(7, 'Wholemeal Bread', 3, 9, '(1kg)', 'images/brown.jpg', 5),
(8, 'Carrot', 2, 10, '(1kg)', 'images/carrot.jpg', 7),
(9, 'Cauliflower', 4, 10, '(100gm)', 'images/cauliflower.jpg', 7),
(10, 'Chillies', 2, 10, '(300gm)', 'images/chilli.jpg', 7),
(11, 'Coca Cola', 4, 10, '(1Ltr)', 'images/cola.jpg', 3),
(12, 'Fabric Conditioner', 6, 10, '(1Ltr)', 'images/conditioner.jpg', 12),
(13, 'Full Cream', 2, 10, '(500ml)', 'images/cream.jpg', 9),
(14, 'Cucumber', 1, 10, '(100gm)', 'images/cucumber.jpg', 7),
(15, 'Free Range Eggs', 3, 10, '(400gm)', 'images/freeeggs.jpg', 10),
(16, 'Full Cream Milk', 5, 10, '(1Ltr)', 'images/fullcreammilk.jpg', 9),
(17, 'Grapes', 14, 10, ' (1kg)', 'images/grapes.jpg', 6),
(18, 'Harpic Disinfectant', 17, 10, '(500ml)', 'images/harpic.jpg', 11),
(19, 'Laundry Liquid', 4, 10, '(1Ltr)', 'images/laundryliquid.jpg', 12),
(20, 'Laundry Powder', 5, 10, '(1Ltr)', 'images/laundrypowder.jpg', 12),
(21, 'Lime Juice', 3, 10, '(1Ltr)', 'images/limedrink.jpg', 3),
(22, 'Long Life Milk', 6, 10, '(1Ltr)', 'images/longlifemilk.jpg', 9),
(23, 'Low Fat Milk', 5, 10, '(1Ltr)', 'images/lowcreammilk.jpg', 9),
(24, 'Mandarins', 13, 10, ' (1kg)', 'images/mandarin.jpg', 6),
(25, 'Multigrain Bread', 4, 10, '(1kg)', 'images/multigrain.jpg', 5),
(26, 'Onion', 5, 10, '(500gm)', 'images/onion.jpg', 7),
(27, 'Orange Juice', 4, 10, '(1Ltr)', 'images/orangedrink.jpg', 3),
(28, 'Organic Eggs', 8, 10, '(500gm)', 'images/organiceggs.jpg', 10),
(29, 'Pear', 3, 10, ' (1kg)', 'images/pear.jpg', 6),
(30, 'Pista', 14, 10, '(200gm)', 'images/pista.jpg', 8),
(31, 'Potato', 6, 10, '(500gm)', 'images/potato.jpg', 7),
(32, 'Salted Butter', 6, 10, '(200gm)', 'images/saltedbutter.jpg', 10),
(33, 'UnSalted Butter', 10, 10, '(200gm)', 'images/unsaltedbutter.jpg', 10),
(34, 'Spinach', 4, 10, '(500gm)', 'images/spinach.jpg', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ord`
--
ALTER TABLE `ord`
  ADD UNIQUE KEY `oid` (`oid`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD UNIQUE KEY `pid` (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ord`
--
ALTER TABLE `ord`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
