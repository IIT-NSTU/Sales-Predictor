-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2024 at 01:36 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_predictor`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`, `user_id`, `created_at`, `updated_at`) VALUES
(11, 'Direct Cool Refrigerator', 1, 5, '2024-06-26 23:46:22', '2024-06-26 23:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `total` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payable` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_products`
--

CREATE TABLE `invoice_products` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `quantity` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_price` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_09_21_081359_create_users_table', 1),
(3, '2023_09_24_064609_create_categories_table', 1),
(4, '2023_09_24_135939_create_products_table', 1),
(5, '2023_09_24_140130_create_customers_table', 1),
(6, '2023_09_28_105630_create_invoices_table', 1),
(7, '2023_09_28_105631_create_invoice_products_table', 1),
(9, '2024_06_27_063651_add_details_url_to_products_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `unit`, `img_url`, `details_url`, `category_id`, `user_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'WFC-3F5-GDEL-XX (INVERTER)', '53090', '10', 'uploads/5-1719467375.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3f5-gdel-xx-inverter', 11, 5, 1, '2024-06-26 23:49:35', '2024-07-13 07:24:27'),
(6, 'WFC-3F5-GDEL-XX', '51090', '10', 'uploads/5-1719472532.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3f5-gdel-xx', 11, 5, 1, '2024-06-27 01:15:32', '2024-06-27 01:15:32'),
(7, 'WFC-3F5-GDNE-XX (Inverter)', '53090', '10', 'uploads/5-1719473585.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3f5-gdne-xx-inverter', 11, 5, 1, '2024-06-27 01:33:05', '2024-07-13 07:24:56'),
(8, 'WFC-3F5-GDNE-XX', '51790', '10', 'uploads/5-1719473643.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3f5-gdne-xx', 11, 5, 1, '2024-06-27 01:34:03', '2024-06-27 01:34:03'),
(9, 'WFC-3F5-GAXA-UX-P (Inverter)', '54690', '10', 'uploads/5-1719473713.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3f5-gaxa-ux-p-inverter', 11, 5, 1, '2024-06-27 01:35:13', '2024-06-27 01:35:13'),
(10, 'WFC-3F5-GDXX-XX (Inverter)', '52390', '10', 'uploads/5-1719473779.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3f5-gdxx-xx-inverter', 11, 5, 1, '2024-06-27 01:36:19', '2024-07-13 07:25:52'),
(11, 'WFC-3F5-GDEH-DD (Inverter)', '56290', '10', 'uploads/5-1719473867.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3f5-gdeh-dd-inverter', 11, 5, 1, '2024-06-27 01:37:47', '2024-07-13 07:26:49'),
(12, 'WFC-3F5-GDEH-XX (Inverter)', '53590', '10', 'uploads/5-1719473948.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3f5-gdeh-xx-inverter', 11, 5, 1, '2024-06-27 01:39:08', '2024-07-13 07:27:21'),
(13, 'WFC-3F5-GDEH-XX', '51990', '10', 'uploads/5-1719474012.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3f5-gdeh-xx', 11, 5, 1, '2024-06-27 01:40:12', '2024-06-27 01:40:12'),
(14, 'WFC-3F5-GDXX-XX', '50390', '10', 'uploads/5-1719474066.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3f5-gdxx-xx', 11, 5, 1, '2024-06-27 01:41:06', '2024-06-27 01:41:06'),
(15, 'WFE-3E8-GDXX-XX', '51290', '10', 'uploads/5-1719474120.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfe-3e8-gdxx-xx', 11, 5, 1, '2024-06-27 01:42:00', '2024-07-13 07:31:17'),
(16, 'WFE-3E8-GDEL-XX', '51790', '10', 'uploads/5-1719474191.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfe-3e8-gdel-xx', 11, 5, 1, '2024-06-27 01:43:11', '2024-07-13 07:31:49'),
(17, 'WFE-3E8-GDEN-XX', '52290', '10', 'uploads/5-1719474247.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfe-3e8-gden-xx', 11, 5, 1, '2024-06-27 01:44:07', '2024-07-13 07:32:14'),
(18, 'WFC-3D8-GAXA-UX-P (Inverter)', '52990', '10', 'uploads/5-1719474369.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gaxa-ux-p-inverter', 11, 5, 1, '2024-06-27 01:46:09', '2024-06-27 01:46:09'),
(19, 'WFC-3D8-GDEH-DD (Inverter)', '53890', '10', 'uploads/5-1719474450.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gdeh-dd-inverter', 11, 5, 1, '2024-06-27 01:47:30', '2024-07-13 07:33:25'),
(20, 'WFC-3D8-GDEH-XX', '49490', '10', 'uploads/5-1719474809.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gdeh-xx', 11, 5, 1, '2024-06-27 01:53:29', '2024-06-27 01:53:29'),
(21, 'WFC-3D8-GDEL-XX', '50390', '10', 'uploads/5-1719474883.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gdel-xx', 11, 5, 1, '2024-06-27 01:54:43', '2024-07-13 07:34:14'),
(22, 'WFC-3D8-GJXB-LX-P (Inverter)', '52690', '10', 'uploads/5-1719474940.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gjxb-lx-p-inverter', 11, 5, 1, '2024-06-27 01:55:40', '2024-06-27 01:55:40'),
(23, 'WFC-3D8-GDEH-XX (Inverter)', '51390', '10', 'uploads/5-1719475045.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gdeh-xx-inverter', 11, 5, 1, '2024-06-27 01:57:25', '2024-07-13 07:35:19'),
(24, 'WFC-3D8-GDEL-XX (Inverter)', '51390', '10', 'uploads/5-1719475119.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gdel-xx-inverter', 11, 5, 1, '2024-06-27 01:58:39', '2024-07-13 07:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `mobile`, `password`, `otp`, `created_at`, `updated_at`) VALUES
(5, 'Samir Chandra', 'Deb', 'samirelectronics7@gmail.com', '01791233473', '$2y$10$cuJlZbUCpNtj8K85zCJ3auwHjEZ4dByeXzDk0.Dyt.c/gwM3f43Qy', '0', '2024-06-26 03:31:48', '2024-06-26 03:31:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`),
  ADD KEY `invoices_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_products_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_products_product_id_foreign` (`product_id`),
  ADD KEY `invoice_products_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD CONSTRAINT `invoice_products_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
