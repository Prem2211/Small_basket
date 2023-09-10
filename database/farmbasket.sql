-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 06:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmbasket`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `info` text NOT NULL,
  `total` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `email`, `info`, `total`, `address`, `pincode`, `city`, `state`, `created_at`) VALUES
(2, 'test@gmail.com', '[{\"img\":\"img/product4/2.jpg\",\"title\":\"Air Jordan Zion 1 PS \",\"price\":\"u20b917900\",\"qty\":\"1\"},{\"img\":\"img/product4/3.jpg\",\"title\":\"AIR JORDAN ZION 1 Z\",\"price\":\"u20b923900\",\"qty\":\"1\"}]', 0, 'dsa', '324344', 'dffsd', 'Punjab', '2023-04-18 03:18:08'),
(3, 'test@gmail.com', '[{\"img\":\"img/product4/2.jpg\",\"title\":\"Air Jordan Zion 1 PS \",\"price\":\"u20b917900\",\"qty\":\"1\"},{\"img\":\"img/product4/3.jpg\",\"title\":\"AIR JORDAN ZION 1 Z\",\"price\":\"u20b923900\",\"qty\":\"1\"}]', 0, 'dsa', '324344', 'dffsd', 'Punjab', '2023-04-18 03:18:34'),
(4, 'test@gmail.com', '[{\"img\":\"img/product4/2.jpg\",\"title\":\"Air Jordan Zion 1 PS \",\"price\":\"u20b917900\",\"qty\":\"1\"},{\"img\":\"img/product4/3.jpg\",\"title\":\"AIR JORDAN ZION 1 Z\",\"price\":\"u20b923900\",\"qty\":\"1\"}]', 0, 'dsa', '324344', 'dffsd', 'Punjab', '2023-04-18 03:19:01'),
(5, 'test@gmail.com', '[{\"img\":\"img/product4/2.jpg\",\"title\":\"Air Jordan Zion 1 PS \",\"price\":\"u20b917900\",\"qty\":1}]', 0, 'wdq', '123423', 'sdfsdf', 'Odisha', '2023-04-18 03:19:26'),
(6, 'test@gmail.com', '[{\"img\":\"img/product4/2.jpg\",\"title\":\"Air Jordan Zion 1 PS \",\"price\":\"u20b917900\",\"qty\":1}]', 17900, 'wdq', '123423', 'sdfsdf', 'Odisha', '2023-04-18 03:20:28'),
(7, 'test@gmail.com', '[{\"img\":\"img/product4/2.jpg\",\"title\":\"Air Jordan Zion 1 PS \",\"price\":\"u20b917900\",\"qty\":\"1\"}]', 17900, '43543f', '345646', 'dgtd', 'Manipur', '2023-04-18 04:46:05'),
(8, 'test@gmail.com', '[{\"img\":\"img/fruit/2.jpg\",\"title\":\"BANANA 1 KG\",\"price\":\"45.00\",\"qty\":1}]', 45, '3242243', '964525', 'fghfg', 'Maharashtra', '2023-04-18 07:22:26'),
(9, 'adarsh@gmail.com', '[{\"img\":\"img/fruit/3.jpg\",\"title\":\"MANGO SAFEDA 1KG\",\"price\":\"79.00\",\"qty\":\"2\"},{\"img\":\"img/vege/1.jpg\",\"title\":\"POTATO 1KG\",\"price\":\"25.00\",\"qty\":1},{\"img\":\"img/vege/9.jpg\",\"title\":\"KARELA  500G\",\"price\":\"45.00\",\"qty\":\"1\"}]', 228, 'Patel Nagar', '800023', 'Patna', 'Bihar', '2023-05-21 06:05:25'),
(10, 'adarsh@gmail.com', '[{\"img\":\"img/fruit/1.jpg\",\"title\":\"APPLE 1KG\",\"price\":\"145.00\",\"qty\":1}]', 145, 'Manipal', '800023', 'Jaipur', 'Rajasthan', '2023-05-21 06:11:35'),
(11, 'test@gmail.com', '[{\"img\":\"img/fruit/2.jpg\",\"title\":\"BANANA 1 KG\",\"price\":\"45.00\",\"qty\":1},{\"img\":\"img/vege/3.jpg\",\"title\":\"CUCUMBER\",\"price\":\"40.00\",\"qty\":1},{\"img\":\"img/vege/6.jpg\",\"title\":\"LADYFINGER 500G\",\"price\":\"50.00\",\"qty\":1},{\"img\":\"img/vege/9.jpg\",\"title\":\"KARELA  500G\",\"price\":\"45.00\",\"qty\":1},{\"img\":\"img/exotics/2.jpg\",\"title\":\"DragonFRUIT 1PC\",\"price\":\"190.00\",\"qty\":1},{\"img\":\" img/dairy/1.jpg\",\"title\":\"Milk 1L\",\"price\":\"60.00\",\"qty\":1}]', 430, 'gardanibagh', '800001', 'Patna', 'Bihar', '2023-05-21 18:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(6, 'APPLE 1KG', 'fruit', 145.00, 'img/fruit/1.jpg', '2023-04-12 01:43:43', '2023-04-12 01:44:32'),
(7, 'BANANA 1 KG', 'fruit', 45.00, 'img/fruit/2.jpg', '2023-04-12 01:44:59', '2023-04-12 01:44:59'),
(8, 'MANGO SAFEDA 1KG', 'fruit', 79.00, 'img/fruit/3.jpg', '2023-04-12 01:45:53', '2023-04-12 01:45:53'),
(9, 'PINEAPPLE 1 PC', 'fruit', 85.00, 'img/fruit/4.jpg', '2023-04-12 01:48:09', '2023-04-12 01:48:09'),
(10, 'WATERMELON 3KG', 'fruit', 70.00, 'img/fruit/5.jpg', '2023-04-12 01:48:34', '2023-04-12 01:48:34'),
(11, 'PAPAYA 1PC', 'fruit', 75.00, 'img/fruit/6.jpg', '2023-04-12 01:50:07', '2023-04-12 01:50:07'),
(12, 'POMOGRENATE 1KG', 'fruit', 129.00, 'img/fruit/7.jpg', '2023-04-12 01:50:39', '2023-04-12 01:50:39'),
(13, 'PEAR 1KG', 'fruit', 145.00, 'img/fruit/8.jpg', '2023-04-12 01:57:17', '2023-04-12 01:57:17'),
(14, 'MOSAMBI 1KG', 'fruit', 90.00, 'img/fruit/9.jpg', '2023-04-12 01:59:25', '2023-04-12 01:59:25'),
(15, 'POTATO 1KG', 'vege', 25.00, 'img/vege/1.jpg', '2023-04-12 02:04:38', '2023-04-12 02:04:38'),
(16, 'TOMATO 1KG', 'vege', 35.00, 'img/vege/2.jpg', '2023-04-12 02:05:58', '2023-04-12 02:05:58'),
(17, 'CUCUMBER', 'vege', 40.00, 'img/vege/3.jpg', '2023-04-12 02:06:17', '2023-04-12 02:06:17'),
(18, 'PINK GUAVA 1KG', 'fruit', 120.00, ' img/fruit/10.jpg', '2023-04-12 02:06:43', '2023-04-12 02:06:43'),
(19, 'ONION 1 KG', 'vege', 30.00, 'img/vege/4.jpg', '2023-04-12 03:54:33', '2023-04-12 03:54:33'),
(20, 'CAPSICUM 500G', 'vege', 40.00, 'img/vege/5.jpg', '2023-04-12 03:56:40', '2023-04-12 03:56:40'),
(21, 'LADYFINGER 500G', 'vege', 50.00, 'img/vege/6.jpg', '2023-04-12 03:57:04', '2023-04-12 03:57:04'),
(22, 'SPINACH 500G', 'vege', 55.00, 'img/vege/7.jpg', '2023-04-12 04:03:43', '2023-04-12 04:03:43'),
(23, 'LEMON 1DOZEN', 'vege', 60.00, 'img/vege/8.jpg', '2023-04-12 04:04:44', '2023-05-21 06:13:20'),
(24, 'KARELA  500G', 'vege', 45.00, 'img/vege/9.jpg', '2023-04-12 06:16:15', '2023-04-12 06:16:15'),
(25, 'DragonFRUIT 1PC', 'exotic', 190.00, 'img/exotics/2.jpg', '2023-04-17 15:23:16', '2023-05-21 06:15:37'),
(26, 'Milk 1L', 'dairy', 60.00, ' img/dairy/1.jpg', '2023-05-20 16:16:15', '2023-05-20 16:16:15'),
(27, 'Ghee 1 KG', 'dairy', 550.00, ' img/dairy/5.jpg', '2023-05-20 16:19:18', '2023-05-20 16:19:18'),
(28, 'Cottage Cheese', 'dairy', 350.00, 'img/dairy/6.jpg', '2023-05-20 16:20:34', '2023-05-20 16:20:34'),
(29, 'Butter 250gm', 'dairy', 110.00, ' img/dairy/7.jpg', '2023-05-20 16:24:20', '2023-05-20 16:24:20'),
(30, 'Cheese 500gm', 'dairy', 280.00, 'img/dairy/8.jpg', '2023-05-20 17:06:01', '2023-05-20 17:06:01'),
(31, 'Kiwi 1KG', 'exotic', 220.00, ' img/exotics/1.jpg', '2023-05-20 17:08:21', '2023-05-20 17:08:21'),
(32, 'Cheery 500gm', 'exotic', 300.00, 'img/exotics/3.jpg', '2023-05-20 17:09:32', '2023-05-20 17:09:32'),
(33, 'Avocado 1KG', 'exotic', 180.00, 'img/exotics/9.jpg', '2023-05-20 17:10:34', '2023-05-21 06:15:57'),
(34, 'Blueberry 500gm', 'exotic', 150.00, 'img/exotics/8.jpg', '2023-05-21 06:14:46', '2023-05-21 06:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pincode` int(6) NOT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `number`, `email`, `password`, `address`, `pincode`, `city`, `state`) VALUES
(23, 'tester', '9999988888', 'test@gmail.com', 'tester123', 'gardanibagh', 800001, 'Patna', 'Bihar'),
(25, 'Adarsh', '9080706050', 'adarsh@gmail.com', 'ADdv2002', 'Manipal', 800023, 'Jaipur', 'Rajasthan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
