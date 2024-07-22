-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2024 at 08:22 AM
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
  `type` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `active`, `user_id`, `created_at`, `updated_at`) VALUES
(11, 'Direct Cool Refrigerator', '1', 1, 5, '2024-06-26 23:46:22', '2024-07-21 14:49:30'),
(12, 'Non-Frost Refrigerator', '1', 1, 5, '2024-07-14 00:14:46', '2024-07-21 14:49:33'),
(13, 'Freezer', '1', 1, 5, '2024-07-14 00:15:03', '2024-07-21 14:49:36'),
(14, 'Beverage Cooler', '1', 1, 5, '2024-07-14 00:15:20', '2024-07-21 14:49:38'),
(15, 'Electricity Bill', '2', 1, 5, '2024-07-21 04:48:10', '2024-07-21 14:49:41'),
(16, 'Staff Cost', '2', 1, 5, '2024-07-21 07:05:26', '2024-07-21 14:49:44'),
(17, 'Mixer Grinder', '1', 1, 5, '2024-07-22 01:25:50', '2024-07-22 01:25:50'),
(18, 'Rechargeable Table Fan', '1', 1, 5, '2024-07-22 02:17:28', '2024-07-22 02:17:28');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `mobile`, `address`, `type`, `active`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Walton Hi-Tech industries', 'info@waltonbd.com', '008809606-555555', 'Plot-1088, Block-I, Sabrina Sobhan Road P.O-Khilkhet, P.S-Vatara, Bashundhara R/A, Dhaka-1229', '2', 1, 5, '2024-07-16 01:30:41', '2024-07-16 01:48:39'),
(4, 'Foyez Mia', 'N/A', '01726222233, 01813032777, 01839022598', 'Shonkoradoho, Nasirnagar, Brahmanbaria', '1', 1, 5, '2024-07-22 00:16:27', '2024-07-22 00:24:44'),
(5, 'Saddam Hossain', 'N/A', '01739701775', 'Madhabpur, Habiganj', '1', 1, 5, '2024-07-22 00:23:13', '2024-07-22 00:24:56'),
(6, 'Nusrat Jahan', 'N/A', '01754694194, 01722786571', 'Mohammad Ali Dental Care, Madhabpur', '1', 1, 5, '2024-07-22 00:32:07', '2024-07-22 00:32:07'),
(7, 'Ayesha Begum', 'N/A', '01708024486, 01314792404', 'Shomojdipur, Madhabpur', '1', 1, 5, '2024-07-22 01:39:49', '2024-07-22 01:39:49'),
(8, 'Rima Akhter (Police)', 'N/A', '01992221666, 01640011110', 'Madhabpur Thana, Habiganj', '1', 1, 5, '2024-07-22 01:57:23', '2024-07-22 01:57:23'),
(9, 'Bimol Debnath', 'N/A', '01765784602', 'Haluapara, Madhabpur, Habiganj', '1', 1, 5, '2024-07-22 02:09:23', '2024-07-22 02:09:23'),
(10, 'Juel Rahman', 'N/A', '01726358489, 01758601984', 'Shahpur, Vangarua', '1', 1, 5, '2024-07-22 02:15:17', '2024-07-22 02:15:17');

-- --------------------------------------------------------

--
-- Table structure for table `dues`
--

CREATE TABLE `dues` (
  `id` bigint UNSIGNED NOT NULL,
  `date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dues`
--

INSERT INTO `dues` (`id`, `date`, `amount`, `user_id`, `invoice_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(3, '2023-05-25', '5000', 5, 6, 6, '2024-07-22 00:56:18', '2024-07-22 06:58:46'),
(4, '2023-07-06', '6500', 5, 6, 6, '2024-07-22 00:59:56', '2024-07-22 00:59:56'),
(5, '2022-05-16', '7000', 5, 8, 7, '2024-07-22 01:46:45', '2024-07-22 01:46:45'),
(6, '2022-05-24', '3000', 5, 8, 7, '2024-07-22 01:47:14', '2024-07-22 01:47:14'),
(7, '2022-05-15', '6000', 5, 9, 8, '2024-07-22 02:00:56', '2024-07-22 02:00:56'),
(8, '2022-07-16', '6000', 5, 9, 8, '2024-07-22 02:01:07', '2024-07-22 02:01:07'),
(9, '2022-04-17', '16000', 5, 10, 9, '2024-07-22 02:12:09', '2024-07-22 02:12:09'),
(10, '2022-05-17', '11000', 5, 10, 9, '2024-07-22 02:12:20', '2024-07-22 02:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(12,2) NOT NULL,
  `date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
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
  `type` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double(12,2) NOT NULL,
  `discount` double(12,2) NOT NULL,
  `payable` double(12,2) NOT NULL,
  `paid` double(12,2) NOT NULL,
  `initial_due` double(12,2) NOT NULL,
  `remaining_due` double(12,2) NOT NULL,
  `date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `type`, `total`, `discount`, `payable`, `paid`, `initial_due`, `remaining_due`, `date`, `active`, `user_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(5, 's', 36390.00, 6390.00, 30000.00, 30000.00, 0.00, 0.00, '2023-04-15 09:47:22 AM', 1, 5, 4, '2024-07-22 00:20:27', '2024-07-22 06:35:12'),
(6, 's', 36390.00, 4890.00, 31500.00, 20000.00, 11500.00, 0.00, '2023-04-15 10:07:11 AM', 1, 5, 6, '2024-07-22 00:34:00', '2024-07-22 00:59:56'),
(7, 's', 5400.00, 1000.00, 4400.00, 4400.00, 0.00, 0.00, '2022-04-16 09:07:24 AM', 1, 5, 4, '2024-07-22 01:31:50', '2024-07-22 01:31:50'),
(8, 's', 33090.00, 9090.00, 24000.00, 14000.00, 10000.00, 0.00, '2022-04-16 09:07:47 AM', 1, 5, 7, '2024-07-22 01:44:02', '2024-07-22 01:47:14'),
(9, 's', 33690.00, 9690.00, 24000.00, 12000.00, 12000.00, 0.00, '2022-04-16 11:07:37 AM', 1, 5, 8, '2024-07-22 01:59:45', '2024-07-22 02:01:07'),
(10, 's', 46190.00, 18190.00, 28000.00, 1000.00, 27000.00, 0.00, '2022-04-16 11:07:31 AM', 1, 5, 9, '2024-07-22 02:11:17', '2024-07-22 02:12:20'),
(11, 's', 6290.00, 2490.00, 3800.00, 3800.00, 0.00, 0.00, '2022-04-16 11:07:54 AM', 1, 5, 10, '2024-07-22 02:21:27', '2024-07-22 02:21:27');

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

--
-- Dumping data for table `invoice_products`
--

INSERT INTO `invoice_products` (`id`, `invoice_id`, `product_id`, `user_id`, `quantity`, `sale_price`, `created_at`, `updated_at`) VALUES
(7, 5, 34, 5, '1', '36390.00', '2024-07-22 00:20:27', '2024-07-22 00:20:27'),
(8, 6, 34, 5, '1', '36390.00', '2024-07-22 00:34:00', '2024-07-22 00:34:00'),
(9, 7, 50, 5, '1', '5400.00', '2024-07-22 01:31:50', '2024-07-22 01:31:50'),
(10, 8, 51, 5, '1', '33090.00', '2024-07-22 01:44:02', '2024-07-22 01:44:02'),
(11, 9, 52, 5, '1', '33690.00', '2024-07-22 01:59:45', '2024-07-22 01:59:45'),
(12, 10, 53, 5, '1', '46190.00', '2024-07-22 02:11:17', '2024-07-22 02:11:17'),
(13, 11, 54, 5, '1', '6290.00', '2024-07-22 02:21:27', '2024-07-22 02:21:27');

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
(9, '2024_06_27_063651_add_details_url_to_products_table', 2),
(10, '2024_07_16_060125_add_address_type_to_customers_table', 3),
(30, '2023_09_28_105630_create_invoices_table', 4),
(31, '2023_09_28_105631_create_invoice_products_table', 4),
(32, '2024_07_19_235040_create_dues_table', 4),
(33, '2024_07_21_095620_add_type_to_categories_table', 5),
(34, '2024_07_21_112345_create_expenses_table', 5);

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
(1, 'WFC-3F5-GDEL-XX (INVERTER)', '53090', '10', 'uploads/5-1719467375.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3f5-gdel-xx-inverter', 11, 5, 1, '2024-06-26 23:49:35', '2024-07-21 06:48:38'),
(6, 'WFC-3F5-GDEL-XX', '51090', '10', 'uploads/5-1719472532.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3f5-gdel-xx', 11, 5, 1, '2024-06-27 01:15:32', '2024-07-21 19:46:01'),
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
(17, 'WFE-3E8-GDEN-XX', '52290', '10', 'uploads/5-1719474247.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfe-3e8-gden-xx', 11, 5, 1, '2024-06-27 01:44:07', '2024-07-21 19:46:40'),
(18, 'WFC-3D8-GAXA-UX-P (Inverter)', '52990', '10', 'uploads/5-1719474369.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gaxa-ux-p-inverter', 11, 5, 1, '2024-06-27 01:46:09', '2024-06-27 01:46:09'),
(19, 'WFC-3D8-GDEH-DD (Inverter)', '53890', '10', 'uploads/5-1719474450.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gdeh-dd-inverter', 11, 5, 1, '2024-06-27 01:47:30', '2024-07-13 07:33:25'),
(20, 'WFC-3D8-GDEH-XX', '49490', '10', 'uploads/5-1719474809.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gdeh-xx', 11, 5, 1, '2024-06-27 01:53:29', '2024-06-27 01:53:29'),
(21, 'WFC-3D8-GDEL-XX', '50390', '10', 'uploads/5-1719474883.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gdel-xx', 11, 5, 1, '2024-06-27 01:54:43', '2024-07-13 07:34:14'),
(22, 'WFC-3D8-GJXB-LX-P (Inverter)', '52690', '10', 'uploads/5-1719474940.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gjxb-lx-p-inverter', 11, 5, 1, '2024-06-27 01:55:40', '2024-06-27 01:55:40'),
(23, 'WFC-3D8-GDEH-XX (Inverter)', '51390', '10', 'uploads/5-1719475045.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gdeh-xx-inverter', 11, 5, 1, '2024-06-27 01:57:25', '2024-07-13 07:35:19'),
(24, 'WFC-3D8-GDEL-XX (Inverter)', '51390', '10', 'uploads/5-1719475119.jpg', 'https://waltonbd.com/direct-cool-refrigerator/wfc-3d8-gdel-xx-inverter', 11, 5, 1, '2024-06-27 01:58:39', '2024-07-13 07:35:49'),
(25, 'WBB-2F0-TDXX-XX', '58,990', '10', 'uploads/5-1721012741.jpg', 'https://waltonbd.com/refrigerator-freezer/beverage-cooler/wbb-2f0-tdxx-xx', 14, 5, 1, '2024-07-14 21:05:42', '2024-07-14 21:05:42'),
(26, 'WBQ-4D0-TDXX-XX', '80990', '10', 'uploads/5-1721012811.jpg', 'https://waltonbd.com/refrigerator-freezer/beverage-cooler/wbq-4d0-tdxx-xx', 14, 5, 1, '2024-07-14 21:06:51', '2024-07-14 21:06:51'),
(27, 'WBA-2B4-GTXA-XX', '48990', '10', 'uploads/5-1721012857.jpg', 'https://waltonbd.com/refrigerator-freezer/beverage-cooler/wba-2b4-gtxa-xx', 14, 5, 1, '2024-07-14 21:07:37', '2024-07-14 21:07:37'),
(28, 'WUE-3C4-GEPB-XX (Inverter)', '55200', '10', 'uploads/5-1721012977.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wue-3c4-gepb-xx-inverter', 13, 5, 1, '2024-07-14 21:09:37', '2024-07-21 19:46:09'),
(29, 'WCF-1D5-GDEL-LX', '31190', '10', 'uploads/5-1721013024.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcf-1d5-gdel-lx', 13, 5, 1, '2024-07-14 21:10:24', '2024-07-21 19:46:23'),
(30, 'WCF-1D5-GDEL-XX', '30690', '10', 'uploads/5-1721013081.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcf-1d5-gdel-xx', 13, 5, 1, '2024-07-14 21:11:21', '2024-07-14 21:11:21'),
(31, 'WCF-1D5-RRXX-XX', '29390', '10', 'uploads/5-1721013120.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcf-1d5-rrxx-xx', 13, 5, 1, '2024-07-14 21:12:00', '2024-07-14 21:12:00'),
(32, 'WCF-1B5-GDEL-XX', '27590', '10', 'uploads/5-1721013174.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcf-1b5-gdel-xx', 13, 5, 1, '2024-07-14 21:12:54', '2024-07-14 21:12:54'),
(33, 'WCF-2T5-GDEL-GX', '36890', '10', 'uploads/5-1721013231.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcf-2t5-gdel-gx', 13, 5, 1, '2024-07-14 21:13:51', '2024-07-14 21:13:51'),
(34, 'WCF-2T5-GDEL-XX', '36390', '8', 'uploads/5-1721013272.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcf-2t5-gdel-xx', 13, 5, 1, '2024-07-14 21:14:32', '2024-07-22 00:34:00'),
(35, 'WCF-2T5-RRLX-XX', '35390', '10', 'uploads/5-1721013318.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcf-2t5-rrlx-xx', 13, 5, 1, '2024-07-14 21:15:18', '2024-07-14 21:15:18'),
(36, 'WCF-2T5-RRLX-GX', '35890', '10', 'uploads/5-1721013374.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcf-2t5-rrlx-gx', 13, 5, 1, '2024-07-14 21:16:14', '2024-07-14 21:16:14'),
(37, 'WCF-2A0-GSRE-XX-P', '37490', '10', 'uploads/5-1721019297.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcf-2a0-gsre-xx-p', 13, 5, 1, '2024-07-14 22:54:57', '2024-07-14 22:54:57'),
(38, 'WCG-2E5-EHLC-XX', '37990', '10', 'uploads/5-1721019346.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcg-2e5-ehlc-xx', 13, 5, 1, '2024-07-14 22:55:46', '2024-07-14 22:55:46'),
(39, 'WCG-2E5-EHLX-XX', '38890', '10', 'uploads/5-1721019405.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcg-2e5-ehlx-xx', 13, 5, 1, '2024-07-14 22:56:45', '2024-07-14 22:56:45'),
(40, 'WCG-2E5-EHLX-XX (Inverter)', '39890', '10', 'uploads/5-1721019606.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcg-2e5-ehlx-xx-inverter', 13, 5, 1, '2024-07-14 23:00:06', '2024-07-14 23:00:06'),
(41, 'WCG-2E5-GDEL-DD', '42290', '10', 'uploads/5-1721019667.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcg-2e5-gdel-dd', 13, 5, 1, '2024-07-14 23:01:07', '2024-07-14 23:01:07'),
(42, 'WCG-2E5-GDEL-XX', '40890', '10', 'uploads/5-1721019823.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcg-2e5-gdel-xx', 13, 5, 1, '2024-07-14 23:03:43', '2024-07-14 23:03:43'),
(43, 'WCG-2E5-GDEL-XX (Inverter)', '41890', '10', 'uploads/5-1721019911.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcg-2e5-gdel-xx-inverter', 13, 5, 1, '2024-07-14 23:05:11', '2024-07-14 23:05:11'),
(44, 'WCG-3J0-DDGE-XX', '44690', '10', 'uploads/5-1721019963.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcg-3j0-ddge-xx', 13, 5, 1, '2024-07-14 23:06:03', '2024-07-14 23:06:03'),
(45, 'WCG-3J0-DDXX-XX', '43690', '10', 'uploads/5-1721020112.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcg-3j0-ddxx-xx', 13, 5, 1, '2024-07-14 23:08:32', '2024-07-14 23:08:32'),
(46, 'WCG-3J0-RXLX-GX', '44690', '10', 'uploads/5-1721020162.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcg-3j0-rxlx-gx', 13, 5, 1, '2024-07-14 23:09:22', '2024-07-14 23:09:22'),
(47, 'WCG-3J0-RXLX-XX', '43690', '10', 'uploads/5-1721020239.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcg-3j0-rxlx-xx', 13, 5, 1, '2024-07-14 23:10:39', '2024-07-14 23:10:39'),
(48, 'WCG-2G0-CGXX-XX', '53990', '10', 'uploads/5-1721020452.jpg', 'https://waltonbd.com/refrigerator-freezer/freezer/wcg-2g0-cgxx-xx', 13, 5, 1, '2024-07-14 23:14:12', '2024-07-14 23:14:12'),
(49, 'WBL-VK85N', '5600', '10', '', 'n/a', 17, 5, 1, '2024-07-22 01:27:43', '2024-07-22 01:27:43'),
(50, 'WBL-VK01N', '5400', '9', '', 'n/a', 17, 5, 1, '2024-07-22 01:28:39', '2024-07-22 01:31:50'),
(51, 'WFD-1F3-GDEL-XX', '33090', '9', '', NULL, 11, 5, 1, '2024-07-22 01:41:35', '2024-07-22 01:44:02'),
(52, 'WFD-1F3-GDSH-XX', '33690', '9', '', NULL, 11, 5, 1, '2024-07-22 01:52:57', '2024-07-22 01:59:45'),
(53, 'WFC-3X7-GDXX-XX', '46190', '9', '', NULL, 11, 5, 1, '2024-07-22 02:06:44', '2024-07-22 02:11:17'),
(54, 'W170A-MS', '6290', '19', '', NULL, 18, 5, 1, '2024-07-22 02:18:26', '2024-07-22 02:21:27');

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
-- Indexes for table `dues`
--
ALTER TABLE `dues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dues_user_id_foreign` (`user_id`),
  ADD KEY `dues_invoice_id_foreign` (`invoice_id`),
  ADD KEY `dues_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_category_id_foreign` (`category_id`),
  ADD KEY `expenses_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dues`
--
ALTER TABLE `dues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
-- Constraints for table `dues`
--
ALTER TABLE `dues`
  ADD CONSTRAINT `dues_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `dues_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `dues_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD CONSTRAINT `invoice_products_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

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
