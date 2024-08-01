-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 01, 2024 at 03:54 PM
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
(18, 'Rechargeable Fan', '1', 1, 5, '2024-07-22 02:17:28', '2024-07-28 23:02:51'),
(19, 'Extension Socket', '1', 0, 5, '2024-07-28 22:01:47', '2024-07-28 23:02:18'),
(20, 'Mobile', '1', 1, 5, '2024-07-28 22:27:03', '2024-07-28 22:27:03'),
(21, 'Speaker', '1', 0, 5, '2024-07-28 22:46:14', '2024-07-28 23:02:31'),
(22, 'LED Light', '1', 0, 5, '2024-07-28 22:52:36', '2024-07-28 23:02:27'),
(23, 'Accessories', '1', 1, 5, '2024-07-28 23:00:13', '2024-07-28 23:00:13'),
(24, 'Fan', '1', 1, 5, '2024-07-28 23:09:44', '2024-07-28 23:09:44'),
(25, 'Home Appliances', '1', 1, 5, '2024-07-28 23:31:54', '2024-07-28 23:31:54'),
(26, 'Kitchen Appliances', '1', 1, 5, '2024-07-28 23:50:52', '2024-07-28 23:50:52'),
(27, 'Television', '1', 1, 5, '2024-07-29 22:09:14', '2024-07-29 22:09:14'),
(28, 'Air Conditioner', '1', 1, 5, '2024-08-01 05:42:01', '2024-08-01 05:42:01');

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
(53, 'WFC-3X7-GDXX-XX', '46190', '8', 'uploads/5-1722527038.jpg', NULL, 11, 5, 1, '2024-07-22 02:06:44', '2024-08-01 09:43:58'),
(54, 'W17OA-MS (17\")', '6290', '10', 'uploads/5-1722226026.jpg', 'https://waltonbd.com/fan/rechargeable-fan/w17oa-ms-17', 18, 5, 1, '2024-07-22 02:18:26', '2024-07-28 22:11:38'),
(55, 'Extension Socket 1500W', '845', '10', 'uploads/5-1722225772.jpg', 'https://waltonbd.com/switch-sockets/extension-socket/without-usb/wes2p4e-white-1500w', 23, 5, 1, '2024-07-28 22:02:52', '2024-07-28 23:45:00'),
(56, 'WRTF14A (14\")', '4490', '10', 'uploads/5-1722226426.jpg', 'https://waltonbd.com/fan/rechargeable-fan/wrtf14a-14', 18, 5, 1, '2024-07-28 22:13:46', '2024-07-28 22:13:46'),
(57, 'WRTF12B (12\")', '3990', '10', 'uploads/5-1722226651.jpg', 'https://waltonbd.com/fan/rechargeable-fan/wrtf12b-12', 18, 5, 1, '2024-07-28 22:17:31', '2024-07-28 22:17:31'),
(58, 'Olvio L29', '1050', '10', 'uploads/5-1722227281.jpg', 'https://waltonbd.com/mobile/feature-phone/olvio-l29', 20, 5, 1, '2024-07-28 22:28:01', '2024-07-28 22:28:01'),
(59, 'NEXG N25', '14999', '10', 'uploads/5-1722228048.jpg', 'https://waltonbd.com/mobile/smart-phone/nexg-n25', 20, 5, 1, '2024-07-28 22:40:48', '2024-07-28 22:40:48'),
(60, 'PRIMO GH11', '9523', '10', 'uploads/5-1722228226.jpg', 'https://waltonbd.com/mobile/smart-phone/primo-gh11', 20, 5, 1, '2024-07-28 22:43:46', '2024-07-28 22:43:46'),
(61, 'Speaker (WS2149)', '5850', '10', 'uploads/5-1722228514.png', 'https://waltondigitech.com/products/music/speaker', 23, 5, 1, '2024-07-28 22:48:34', '2024-07-28 23:01:29'),
(62, 'LED Light (WLED-DC24V-10W)', '430', '10', 'uploads/5-1722228892.png', 'https://waltonbd.com/led-light/indoor/luminaries/dc-tube/wled-dc24v-10w', 23, 5, 1, '2024-07-28 22:54:52', '2024-07-28 23:02:03'),
(64, 'Weight Machine (WBWS-G18A 180KG)', '1200', '10', 'uploads/5-1722229466.jpg', 'https://waltonbd.com/hardware-sanitary-solutions/weight-machine/wbws-g18a-180', 23, 5, 1, '2024-07-28 23:04:26', '2024-07-28 23:46:29'),
(65, 'CEILING FAN (WCF5601 WR 56\")', '4390', '10', 'uploads/5-1722316164.jpg', 'https://waltonbd.com/fan/ceiling-fan/lotus-ceiling-fan-52', 24, 5, 1, '2024-07-28 23:17:05', '2024-07-29 23:09:24'),
(66, 'Tornado Fan (WTF9S5 09\")', '1090', '10', 'uploads/5-1722230390.png', 'https://waltonbd.com/fan/tornado-fan', 24, 5, 1, '2024-07-28 23:19:50', '2024-07-28 23:19:50'),
(67, 'Pedestal Fan (WPF-24A-PBC 24\")', '7990', '10', 'uploads/5-1722230810.jpg', 'https://waltonbd.com/fan/pedestal-fan/wpf-24a-pbc-24', 24, 5, 1, '2024-07-28 23:26:50', '2024-07-28 23:45:56'),
(68, 'Wall Fan (W18OA-RGC 18\")', '3130', '10', 'uploads/5-1722230985.jpg', 'https://waltonbd.com/fan/wall-fan/w18oa-rgc-18', 24, 5, 1, '2024-07-28 23:29:45', '2024-07-28 23:29:45'),
(69, 'Water Purifier (WWP-UF20L)', '3900', '10', 'uploads/5-1722231353.png', 'https://waltonbd.com/home-appliances/water-purifier-dispenser/wwp-uf20l-purifier', 25, 5, 1, '2024-07-28 23:35:53', '2024-07-28 23:35:53'),
(70, 'Geyser (WG-C45L)', '9290', '10', 'uploads/5-1722231578.png', 'https://waltonbd.com/hardware-sanitary-solutions/water-heater-geyser?product_id=5711', 25, 5, 1, '2024-07-28 23:39:38', '2024-07-28 23:40:34'),
(71, 'Gas Stove (WGS-GNS1 LPG / NG)', '4090', '10', 'uploads/5-1722232376.jpg', 'https://waltonbd.com/kitchen-appliances/gas-stove/glass-top-double-burner/wgs-gns1-en', 26, 5, 1, '2024-07-28 23:52:56', '2024-07-28 23:52:56'),
(72, 'Fry Pan (WCW-SFGC2200)', '1190', '10', 'uploads/5-1722233097.jpg', 'https://waltonbd.com/kitchen-appliances/kitchen-cookware/non-induction-cookware?product_id=5858', 26, 5, 1, '2024-07-29 00:04:57', '2024-07-29 00:04:57'),
(73, 'Oven (WEO-J28EDK)', '7750', '10', 'uploads/5-1722272487.jpg', 'https://waltonbd.com/microwave-and-electric-oven/electric-oven?product_id=5913', 26, 5, 1, '2024-07-29 11:01:27', '2024-07-29 11:01:27'),
(74, 'Ruti Tawa (WCW-TPS2801)', '850', '10', 'uploads/5-1722273000.jpg', 'https://eplaza.waltonbd.com/index.php?route=product/product&product_id=3089', 26, 5, 1, '2024-07-29 11:10:01', '2024-07-29 11:10:01'),
(75, 'Kettle (WK-LJSS170)', '1050', '10', 'uploads/5-1722273814.jpg', 'https://waltonbd.com/home-appliances/kettle-electric/wk-ljss170', 25, 5, 1, '2024-07-29 11:23:34', '2024-07-29 11:23:34'),
(76, 'Iron (WIR-D02)', '1220', '10', 'uploads/5-1722274085.png', 'https://waltonbd.com/home-appliances/iron/wir-d02', 25, 5, 1, '2024-07-29 11:28:05', '2024-07-29 11:28:05'),
(77, 'Induction Cooker (WI-F15)', '4590', '10', 'uploads/5-1722274659.jpg', 'https://bitly.cx/0P0x', 26, 5, 1, '2024-07-29 11:37:39', '2024-07-29 11:37:39'),
(78, 'Infrared Cooker (WIR-KS20)', '5590', '10', 'uploads/5-1722274788.png', 'https://waltonbd.com/infrared-cooker/wir-ks20-en', 26, 5, 1, '2024-07-29 11:39:48', '2024-08-01 07:00:00'),
(79, 'Multi Cooker (WDC-SDE280)', '3990', '10', 'uploads/5-1722275005.png', 'https://waltonbd.com/kitchen-appliances/multi-cooker-electric?product_id=5912', 26, 5, 1, '2024-07-29 11:43:25', '2024-07-29 11:43:25'),
(80, 'Pressure Cooker (WPC-MSC350)', '1590', '10', 'uploads/5-1722275250.jpg', 'https://waltonbd.com/kitchen-appliances/pressure-cooker-electric-manual/wpc-msc350', 26, 5, 1, '2024-07-29 11:47:30', '2024-07-29 11:47:30'),
(81, 'Rice Cooker (WRC-SGAE18)', '2790', '10', 'uploads/5-1722275674.jpg', 'https://waltonbd.com/kitchen-appliances/rice-cooker-electric/wrc-sgae18', 26, 5, 1, '2024-07-29 11:54:34', '2024-07-29 11:54:34'),
(82, 'Blender (WBL-13C330N)', '2290', '10', 'uploads/5-1722309398.jpg', 'https://waltonbd.com/blender-and-mixer-grinder/blender/wbl-13c330n', 26, 5, 1, '2024-07-29 21:16:38', '2024-07-29 21:16:38'),
(83, 'Mixer Grinder (WBL-VK01N)', '5490', '10', 'uploads/5-1722309494.png', 'https://waltonbd.com/blender-and-mixer-grinder/mixer-grinder/wbl-vk01n', 26, 5, 1, '2024-07-29 21:18:14', '2024-07-29 21:18:14'),
(84, 'Washing Machine (WWM-TWG110)', '19900', '10', 'uploads/5-1722310322.jpg', 'https://waltonbd.com/n-a', 25, 5, 1, '2024-07-29 21:32:02', '2024-07-29 21:43:16'),
(85, 'Room Heater (WRH-PTC0X)', '2680', '10', 'uploads/5-1722311582.jpg', 'https://waltonbd.com/wrh-ptc0x', 23, 5, 1, '2024-07-29 21:53:02', '2024-08-01 06:59:03'),
(86, 'TV Remote Controller', '500', '10', 'uploads/5-1722312176.png', 'https://waltonbd.com/television/tv-accessories/remote-controller', 23, 5, 1, '2024-07-29 22:02:56', '2024-07-29 22:02:56'),
(87, '24 inch (WD24HLR 610mm)', '16,900', '10', 'uploads/5-1722312637.jpg', 'https://waltonbd.com/television/led-tv/wd24hlr', 27, 5, 1, '2024-07-29 22:10:37', '2024-07-29 22:10:37'),
(88, '32 inch (W32D120BL 813mm)', '19900', '10', 'uploads/5-1722312830.jpg', 'https://waltonbd.com/television/led-tv/w32d120bl-813mm', 27, 5, 1, '2024-07-29 22:13:50', '2024-07-29 22:13:50'),
(89, '40 inch (WD40HLR (1.016m)', '26900', '10', 'uploads/5-1722312983.jpg', 'https://waltonbd.com/television/led-tv/wd40hlr-1-016m', 27, 5, 1, '2024-07-29 22:16:23', '2024-07-29 22:16:23'),
(90, '43 inch (W43D210TS)', '33990', '10', 'uploads/5-1722313480.jpg', 'https://waltonbd.com/television/led-tv?product_id=7020', 27, 5, 1, '2024-07-29 22:24:40', '2024-07-29 22:24:40'),
(91, 'Voltage Stabilizer (WVS-1000 SD)', '4700', '10', 'uploads/5-1722315171.jpg', 'https://waltonbd.com/home-appliances/voltage-stabilizer-protector/wvs-1000-sd', 25, 5, 1, '2024-07-29 22:52:51', '2024-07-29 22:52:51'),
(92, 'Automatic Voltage Protector (WVP-SG15)', '1200', '10', 'uploads/5-1722315353.jpg', 'https://waltonbd.com/wvp-sg15-automatic-voltage-protector', 25, 5, 1, '2024-07-29 22:55:53', '2024-08-01 06:57:08'),
(93, 'WFC-3D8-GDXX-XX (348 Ltr)', '49390', '10', 'uploads/5-1722505137.jpg', 'https://waltonbd.com/refrigerator-freezer/direct-cool-refrigerator/wfc-3d8-gdxx-xx', 11, 5, 1, '2024-08-01 03:38:57', '2024-08-01 03:38:57'),
(94, 'WFC-3D8-GDXX-XX Inverter (348 Ltr)', '50390', '10', 'uploads/5-1722505780.jpg', 'https://waltonbd.com/refrigerator-freezer/direct-cool-refrigerator/wfc-3d8-gdxx-xx-inverter', 11, 5, 1, '2024-08-01 03:49:41', '2024-08-01 03:49:41'),
(95, 'WNI-5F3-GDEL-DD (563 Ltr)', '98990', '10', 'uploads/5-1722512090.jpg', 'https://waltonbd.com/refrigerator-freezer/non-frost-refrigerator/wni-5f3-gdel-dd', 12, 5, 1, '2024-08-01 05:34:50', '2024-08-01 05:34:50'),
(96, 'WNI-5F3-GDEL-ID (563 Ltr)', '93490', '10', 'uploads/5-1722512181.jpg', 'https://waltonbd.com/refrigerator-freezer/non-frost-refrigerator/wni-5f3-gdel-id', 12, 5, 1, '2024-08-01 05:36:21', '2024-08-01 05:36:21'),
(97, 'Air Cooler (WEA-B128R)', '9850', '10', 'uploads/5-1722512398.png', 'https://waltonbd.com/home-appliances/air-cooler/wea-b128r', 25, 5, 1, '2024-08-01 05:39:58', '2024-08-01 05:39:58'),
(98, 'WSI-KRYSTALINE-18F (1.5 Ton)', '73490', '10', 'uploads/5-1722513290.jpg', 'https://waltonbd.com/split-ac/5275-watts-18000-btu-hr/wsi-krystaline-18f-plasma', 28, 5, 1, '2024-08-01 05:54:51', '2024-08-01 05:54:51'),
(99, 'WSN-VENTURI-18A (1.5 Ton)', '49900', '10', 'uploads/5-1722513571.jpg', 'https://waltonbd.com/split-ac/5275-watts-18000-btu-hr/wsn-venturi-18a', 28, 5, 1, '2024-08-01 05:59:31', '2024-08-01 05:59:31'),
(100, 'WSI-COATEC SUPERSAVER-18C (1.5 Ton)', '108500', '10', 'uploads/5-1722513866.jpg', 'https://waltonbd.com/wsi-coatec-supersaver-18c-solar-hybrid', 28, 5, 1, '2024-08-01 06:04:26', '2024-08-01 06:54:05'),
(101, 'WSI-INVERNA-12C (1 Ton)', '67300', '10', 'uploads/5-1722514178.jpg', 'https://waltonbd.com/wsi-inverna-extreme-saver-12c-smart-6-star', 28, 5, 1, '2024-08-01 06:09:38', '2024-08-01 06:54:55'),
(102, 'WSI-KRYSTALINE-24C (2 Ton)', '88000', '10', 'uploads/5-1722514341.jpg', 'https://waltonbd.com/wsi-krystaline-24c-smart-defender', 28, 5, 1, '2024-08-01 06:12:21', '2024-08-01 06:55:54'),
(103, 'WSN-RIVERINE-24B (2 Ton)', '76500', '10', 'uploads/5-1722514645.jpg', 'https://waltonbd.com/split-ac/7034-watts-24000-btu-hr/wsn-riverine-24b', 28, 5, 1, '2024-08-01 06:17:25', '2024-08-01 06:17:25'),
(104, 'WFE-3B0-GDEL-XX (320 Ltr)', '48690', '10', 'uploads/5-1722516161.jpg', 'https://waltonbd.com/refrigerator-freezer/direct-cool-refrigerator/wfe-3b0-gdel-xx', 11, 5, 1, '2024-08-01 06:42:41', '2024-08-01 06:42:41'),
(105, 'WFE-3B0-GDXX-XX Inverter (320 Ltr)', '48690', '10', 'uploads/5-1722516403.jpg', 'https://waltonbd.com/wfe-3b0-gdxx-xx-inverter', 11, 5, 1, '2024-08-01 06:46:43', '2024-08-01 06:51:02'),
(106, 'WFE-3B0-GDXX-XX (320 Ltr)', '48190', '10', 'uploads/5-1722516625.jpg', 'https://waltonbd.com/refrigerator-freezer/direct-cool-refrigerator/wfe-3b0-gdxx-xx', 11, 5, 1, '2024-08-01 06:50:25', '2024-08-01 06:50:25'),
(107, 'WFC-3D8-GDSH Inverter (348 Ltr)', '51890', '10', 'uploads/5-1722517610.jpg', 'https://waltonbd.com/wfc-3d8-gdsh-xx-inverter', 11, 5, 1, '2024-08-01 07:06:50', '2024-08-01 07:06:50'),
(108, 'WFC-3A7-GDNE-XX (317 Ltr)', '47090', '10', 'uploads/5-1722517933.jpg', 'https://waltonbd.com/wfc-3a7-gdne-xx', 11, 5, 1, '2024-08-01 07:12:13', '2024-08-01 07:12:13'),
(109, 'WFC-3A7-GDXX-XX (317 Ltr)', '46590', '10', 'uploads/5-1722518105.jpg', 'https://waltonbd.com/wfc-3a7-gdxx-xx', 11, 5, 1, '2024-08-01 07:15:05', '2024-08-01 07:15:05'),
(110, 'WFE-3A2-GDEN-DD (312 Ltr)', '49590', '10', 'uploads/5-1722518325.jpg', 'https://waltonbd.com/wfe-3a2-gden-dd', 11, 5, 1, '2024-08-01 07:18:45', '2024-08-01 07:18:45'),
(111, 'WFE-3A2-GDEL-XX (312 Ltr)', '46690', '10', 'uploads/5-1722518455.jpg', 'https://waltonbd.com/wfe-3a2-gdel-xx', 11, 5, 1, '2024-08-01 07:20:55', '2024-08-01 07:20:55'),
(112, 'WFE-3A2-GDXX-XX (312 Ltr)', '46190', '10', 'uploads/5-1722518608.jpg', 'https://waltonbd.com/wfe-3a2-gdxx-xx', 11, 5, 1, '2024-08-01 07:23:28', '2024-08-01 07:23:28'),
(113, 'WFE-3X9-GDEL-XX (309 Ltr)', '47690', '10', 'uploads/5-1722518809.jpg', 'https://waltonbd.com/wfe-3x9-gdel-xx', 11, 5, 1, '2024-08-01 07:26:49', '2024-08-01 07:26:49'),
(114, 'WFE-3X9-GDXX-XX (309 Ltr)', '47190', '10', 'uploads/5-1722518921.jpg', 'https://waltonbd.com/wfe-3x9-gdxx-xx', 11, 5, 1, '2024-08-01 07:28:41', '2024-08-01 07:28:41'),
(115, 'WFC-3X7-GDEL-XX (307 Ltr)', '46690', '10', 'uploads/5-1722519085.jpg', 'https://waltonbd.com/wfc-3x7-gdel-xx', 11, 5, 1, '2024-08-01 07:31:25', '2024-08-01 07:31:25'),
(116, 'WFC-3X7-GDEH-DD Inverter (307 Ltr)', '50090', '10', 'uploads/5-1722525904.jpg', 'https://waltonbd.com/wfc-3x7-gdeh-dd-inverter', 11, 5, 1, '2024-08-01 09:25:04', '2024-08-01 09:25:04'),
(117, 'WFE-2N5-GDEL Inverter (295 Ltr)', '46290', '10', 'uploads/5-1722526165.jpg', 'https://waltonbd.com/wfe-2n5-gdel-xx-inverter', 11, 5, 1, '2024-08-01 09:29:25', '2024-08-01 09:29:25'),
(118, 'WFE-2N5-GDEL (295 Ltr)', '44790', '10', 'uploads/5-1722526437.jpg', 'https://waltonbd.com/wfe-2n5-gdel-xx', 11, 5, 1, '2024-08-01 09:33:57', '2024-08-01 09:33:57'),
(119, 'WFE-2N5-GDXX (295 Ltr)', '44290', '10', 'uploads/5-1722526671.jpg', 'https://waltonbd.com/wfe-2n5-gdxx-xx', 11, 5, 1, '2024-08-01 09:37:51', '2024-08-01 09:37:51'),
(120, 'WFE-2N5-GDEN (295 Ltr)', '45290', '10', 'uploads/5-1722526883.jpg', 'https://waltonbd.com/wfe-2n5-gden-xx', 11, 5, 1, '2024-08-01 09:41:23', '2024-08-01 09:41:23');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dues`
--
ALTER TABLE `dues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

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
