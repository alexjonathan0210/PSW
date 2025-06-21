-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2025 at 09:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stj`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `category`, `description`, `created_at`, `updated_at`, `price`) VALUES
(1, 'Nike Air Jordan', 'uploads/1750426618_8b3bfaf6d9a9ad6cc09c45f3d1b06395.jpg', 'Shoes', 'There’s no denying that the Nike Dunk, both high and low, is on track to become the hottest sneaker of the year — again. Known for its relatively thick silhouette and coveted colorways, the iconic shoe has undoubtedly made its way into the hearts of sneaker lovers. Quickly becoming a popular style across the board, even for those outside of the sneaker community.', '2025-06-20 13:36:58', '2025-06-20 13:40:56', 750000.00),
(2, 'Adidas sambaa', 'uploads/1750429279_f262483fce7f54b6d38915d0915c8362.jpg', 'Shoes', 'Mens Shoes - adidas Originals Samba OG - White - Core Black', '2025-06-20 14:21:19', '2025-06-20 14:21:30', 1000000.00),
(4, 'Puma Shoes', 'uploads/1750430266_8b3bfaf6d9a9ad6cc09c45f3d1b06395.jpg', 'Shoes', '\r\nSpeedcat OG Women\'s Sneakers | PUMA', '2025-06-20 14:37:46', '2025-06-20 14:37:46', 750000.00),
(5, 'Ventelaaa', 'uploads/1750431369_a00c977c2c30440052825ebb8aa63ff4.jpg', 'Shoes', 'Ventela low shoes black', '2025-06-20 14:56:09', '2025-06-20 14:56:14', 250000.00),
(6, 'Onitsuka tigerr', 'uploads/1750432082_680075572fc03cef5a96c2321bcfbcd5.jpg', 'Shoes', 'Onitsuka Tiger', '2025-06-20 15:08:02', '2025-06-20 15:08:07', 400000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$nx5h.VCwl6sRQPfkPmcCf.aEXUhvsyj9gXDACOAwSiQK0koPH42Mu', '2025-06-20 13:23:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
