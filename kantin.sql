-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 11:56 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kantin`
--

-- --------------------------------------------------------

--
-- Table structure for table `canteen_info`
--

CREATE TABLE `canteen_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `rating` float NOT NULL DEFAULT 0,
  `count_buyer` int(11) DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `stand_picture` varchar(255) NOT NULL DEFAULT 'default.png',
  `open_hours` time DEFAULT NULL,
  `close_hours` time DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `canteen_info`
--

INSERT INTO `canteen_info` (`id`, `user_id`, `description`, `rating`, `count_buyer`, `name`, `stand_picture`, `open_hours`, `close_hours`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'kantin satu', 4.125, 8, 'kantin satu', 'default.png', '08:00:00', '23:00:00', 1, '2022-01-27 01:03:51', '2022-05-26 22:37:14', NULL),
(2, 4, 'kantin dua', 3.66667, 3, 'kantin dua', '1643267207_70b8fdccb8913b8ee469.jpg', '08:00:00', '20:00:00', 1, '2022-01-27 01:06:22', '2022-05-23 20:23:47', NULL),
(3, 5, 'penjual 3', 5, 0, 'penjual 3', '1643268760_d597a0f5a20c91968924.jpg', '08:00:00', '16:00:00', 1, '2022-01-27 01:31:52', '2022-01-27 01:32:40', NULL),
(4, 6, '', 5, 0, 'penjual 4', '1643268923_819ba32b76ab409d06f7.png', '08:00:00', '16:00:00', 1, '2022-01-27 01:35:09', '2022-01-27 01:35:23', NULL),
(5, 8, 'kantin 6', 5, 0, 'kantin 6', '1643340841_c0dbdaaeb9a1285bbf70.jpg', '08:00:00', '16:00:00', 1, '2022-01-27 21:33:38', '2022-01-27 21:35:02', NULL),
(6, 7, 'kantin 5', 5, 0, 'kantin 5', '1643341032_4c9a6ec322fc4500888c.jpeg', '08:00:00', '16:00:00', 1, '2022-01-27 21:36:45', '2022-01-27 21:37:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dev_api`
--

CREATE TABLE `dev_api` (
  `id` int(11) NOT NULL,
  `dev_user_id` int(11) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `application_name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `information` text NOT NULL,
  `application_type` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dev_api`
--

INSERT INTO `dev_api` (`id`, `dev_user_id`, `api_key`, `application_name`, `url`, `information`, `application_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 1, 'a7d1f6bcd9f3a920b80be198ecd741d5', 'apriori app', 'http://localhost', 'aplikasi algoritma apriori', 1, 1, '2022-05-23 10:33:43', '2022-05-23 10:33:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dev_users`
--

CREATE TABLE `dev_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dev_users`
--

INSERT INTO `dev_users` (`id`, `name`, `email`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Erik Rihendri Candra A', '221810270@stis.ac.id', 1, NULL, '2022-05-19 16:06:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` int(1) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `rating` float DEFAULT 0,
  `count_purchased` int(11) DEFAULT 0,
  `time_estimate` float NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `user_id`, `name`, `type`, `photo`, `price`, `description`, `rating`, `count_purchased`, `time_estimate`, `status`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 3, 'bebek sinjay', 1, '1643266843_fa75813b6c812b2daccc.jpg', 20000, 'bebek madura', 4.33333, 3, 5, 1, '2022-01-27 01:00:43', NULL, '2022-05-26 13:46:21'),
(2, 3, 'pecel mediun', 1, '1643266960_a234dd1583c8f391a424.jpg', 10000, 'pecel khas mediun', 4.33333, 3, 5, 1, '2022-01-27 01:02:40', NULL, '2022-05-26 13:33:19'),
(3, 3, 'es kopyor', 2, '1643267025_e086bec9f5654214bcb4.jpg', 5000, 'es kelapa kopyor', 4, 1, 5, 0, '2022-01-27 01:03:45', NULL, '2022-05-26 13:29:08'),
(4, 4, 'soto lamongan', 1, '1643267240_5075ed05bd83696095be.jpg', 15000, 'soto khas lamongan', 3.66667, 3, 5, 1, '2022-01-27 01:07:20', NULL, '2022-05-23 20:23:47'),
(5, 4, 'lontong kupang', 1, '1643267314_ef749a4434b870a34a7b.jpeg', 10000, 'khas sidoarjo', 3.66667, 3, 5, 1, '2022-01-27 01:08:34', NULL, '2022-05-23 20:23:47'),
(6, 5, 'biskuat', 2, '1643268831_16558e74c9fcead0c72d.jpg', 500, '', 5, 0, 5, 1, '2022-01-27 01:33:51', NULL, '2022-01-27 01:33:51'),
(7, 6, 'sate buntel', 1, '1643268958_3b108b341eeb84346db4.jpg', 15000, '', 5, 0, 5, 1, '2022-01-27 01:35:58', NULL, '2022-01-27 01:35:58'),
(8, 8, 'eskrim', 1, '1643340952_023dbf7c5f59c79bab71.jpg', 5000, 'es krim', 5, 0, 5, 1, '2022-01-27 21:35:52', NULL, '2022-01-27 21:35:52'),
(9, 7, 'sate kereco', 1, '1643341066_8b5000ea32ced54fbf6f.jpg', 10000, 'sate kediri', 5, 0, 5, 1, '2022-01-27 21:37:46', NULL, '2022-01-27 21:37:46'),
(10, 5, 'ayam goren', 1, '1643367606_2f6245475bdbe0472f94.jpg', 15000, 'ayam + nasi + lalapan', 5, 0, 5, 1, '2022-01-28 05:00:06', NULL, '2022-01-28 05:00:06'),
(11, 5, 'lele goreng', 1, '1643367672_715e4a29b7120e198f94.jpg', 10000, 'lele + nasi + lalapan + sambal', 5, 0, 5, 1, '2022-01-28 05:01:12', NULL, '2022-01-28 05:01:12'),
(12, 5, 'ayam bakar', 1, '1643367815_b4b845aeae9c33ebab6c.jpg', 15000, 'ayam + nasi + lalapan + sambal', 5, 0, 5, 1, '2022-01-28 05:03:35', NULL, '2022-01-28 05:03:35'),
(13, 5, 'bebek goreng', 1, '1643367889_13150f693fe4848e5ed7.jpg', 17000, 'bebek + nasi + lalapan + sambal', 5, 0, 5, 1, '2022-01-28 05:04:49', NULL, '2022-01-28 05:04:49'),
(14, 5, 'gurame bakar', 1, '1643367941_6f62601ffea552446801.jpg', 20000, 'gurame + nasi + lalapan + sambal', 5, 0, 5, 1, '2022-01-28 05:05:41', NULL, '2022-01-28 05:05:41'),
(15, 5, 'gurame goreng', 1, '1643368001_22910a205f27015093c5.jpg', 20000, 'gurame+ nasi + lalapan + sambal', 5, 0, 5, 1, '2022-01-28 05:06:41', NULL, '2022-01-28 05:06:41'),
(16, 5, 'es kopyor', 3, '1643368052_766b2412bb4016b5aa96.jpg', 5000, 'es kelapa kopyor', 5, 0, 5, 1, '2022-01-28 05:07:32', NULL, '2022-01-28 05:07:32'),
(17, 5, 'ote ote', 2, '1643368097_ea1f8d0981ee0d20a411.jpg', 1000, 'bakwan', 5, 0, 5, 1, '2022-01-28 05:08:17', NULL, '2022-01-28 05:08:17'),
(18, 5, 'es cendol dawet', 3, '1643368140_174d911902e6d21d64a3.jpg', 5000, 'es cendol dawet khas mojokerto', 5, 0, 5, 1, '2022-01-28 05:09:00', NULL, '2022-01-28 05:09:00'),
(19, 6, 'nasi padang', 1, '1643368413_9c0d36d5fd2ee8b37063.jpg', 10000, 'nasi khas minang', 5, 0, 5, 1, '2022-01-28 05:13:33', NULL, '2022-01-28 05:13:33'),
(20, 6, 'nasi campur', 1, '1643368511_ae33cd4d432472333dec.jpg', 10000, '', 5, 0, 5, 1, '2022-01-28 05:15:11', NULL, '2022-01-28 05:15:11'),
(21, 6, 'nasi goreng', 1, '1643368567_ff552e9dc8072bc44547.jpg', 10000, '', 5, 0, 5, 1, '2022-01-28 05:16:07', NULL, '2022-01-28 05:16:07'),
(22, 6, 'soto rumahan', 1, '1643368636_2a564ed111423e1ed33c.jpg', 10000, 'soto rumahan', 5, 0, 5, 1, '2022-01-28 05:17:16', NULL, '2022-01-28 05:17:16'),
(23, 6, 'biskuat', 2, '1643368681_bfe6178bf5cefbccf75a.jpg', 500, '', 5, 0, 5, 1, '2022-01-28 05:18:01', NULL, '2022-01-28 05:18:01'),
(24, 6, 'ote ote', 1, '1643368708_4d2ea972eae94631536d.jpg', 500, 'bakwan', 5, 0, 5, 1, '2022-01-28 05:18:28', NULL, '2022-01-28 05:18:28'),
(25, 6, 'lemet', 2, '1643368740_28b88be2ebf6be27800a.jpg', 1000, '', 5, 0, 5, 1, '2022-01-28 05:19:00', NULL, '2022-01-28 05:19:00'),
(26, 6, 'es degan', 3, '1643368781_eba0225f519fa1734a99.jpg', 10000, '', 5, 0, 5, 1, '2022-01-28 05:19:41', NULL, '2022-01-28 05:19:41'),
(27, 6, 'es timun', 3, '1643368804_0a92f83e68b3d09bae4b.jpg', 5000, '', 5, 0, 5, 1, '2022-01-28 05:20:04', NULL, '2022-01-28 05:20:04'),
(28, 3, 'soto lamongan', 1, '1643370195_e7549fea64f2fb906ca8.jpg', 15000, '', 4.33333, 3, 5, 0, '2022-01-28 05:43:15', NULL, '2022-05-26 13:29:03'),
(29, 3, 'rawon', 1, '1643370284_7319f889a559c6252055.jpg', 10000, '', 4, 5, 5, 0, '2022-01-28 05:44:44', NULL, '2022-05-26 13:29:05'),
(30, 3, 'mie goreng', 1, '1643370363_1672c7ac5569594c447b.jpg', 5000, 'mie goreng', 4, 2, 5, 1, '2022-01-28 05:46:03', NULL, '2022-05-26 13:37:33'),
(31, 3, 'es degan', 1, '1653365240_f85f8b0e776e4888bb03.jpg', 10000, '', 4, 1, 5, 0, '2022-01-28 05:47:05', NULL, '2022-05-26 13:29:07'),
(32, 3, 'biskuat', 2, '1643370462_a22628ed0149f71819cb.jpg', 500, '', 4, 1, 5, 0, '2022-01-28 05:47:42', NULL, '2022-05-26 13:29:09'),
(33, 3, 'mie lidi', 2, '1643370567_807167d994e237f07a5d.jpg', 500, '', 5, 0, 5, 1, '2022-01-28 05:49:27', '2022-05-24 22:26:13', '2022-05-24 22:26:13'),
(34, 3, 'slai olai', 2, '1643370594_d71b4d61aa836c9ad64c.jpg', 500, '', 5, 0, 5, 1, '2022-01-28 05:49:54', NULL, '2022-05-26 13:37:29'),
(35, 4, 'opor ayam', 1, '1643370641_e42eaca682a5a0bd14f6.jpg', 10000, '', 3.66667, 3, 5, 1, '2022-01-28 05:50:41', NULL, '2022-05-23 20:23:47'),
(36, 4, 'mie aceh', 1, '1643370707_ddf19cabbbdfe96c4fd6.jpeg', 10000, '', 5, 0, 5, 1, '2022-01-28 05:51:47', NULL, '2022-01-28 05:51:47'),
(37, 4, 'batagor', 1, '1643370795_d5e78e4cbb44b9a25717.jpg', 5000, '', 5, 0, 5, 1, '2022-01-28 05:53:15', NULL, '2022-01-28 05:53:15'),
(38, 4, 'es kopyor', 3, '1643370873_cfbc98e15026ae2f52d3.jpg', 5000, '', 5, 0, 5, 1, '2022-01-28 05:53:51', NULL, '2022-01-28 05:54:33'),
(39, 4, 'nextar', 2, '1643370918_fc8c90e02c0f14813bfe.jpg', 2000, '', 5, 0, 5, 1, '2022-01-28 05:55:18', NULL, '2022-01-28 05:55:18'),
(40, 4, 'regal', 2, '1643370935_1e50b2bcfcfad4a7609b.jpg', 1000, '', 5, 0, 5, 1, '2022-01-28 05:55:35', NULL, '2022-01-28 05:55:35'),
(41, 4, 'maici', 2, '1643370962_19a9ea0495468bf157b9.jpg', 5000, '', 5, 0, 5, 1, '2022-01-28 05:56:02', NULL, '2022-01-28 05:56:02'),
(42, 4, 'es cendol dawet', 3, '1643370985_08b81910799722ea9854.jpg', 5000, '', 5, 0, 5, 1, '2022-01-28 05:56:25', NULL, '2022-01-28 05:56:25'),
(43, 7, 'rujak cingur', 1, '1643371102_7bdfe9183814a9f019bc.jpg', 10000, '', 5, 0, 5, 1, '2022-01-28 05:58:22', NULL, '2022-01-28 05:58:22'),
(44, 7, 'pempek', 1, '1643371162_b770f0bb99c9ac764946.jpg', 7000, '', 5, 0, 5, 1, '2022-01-28 05:59:22', NULL, '2022-01-28 05:59:22'),
(45, 7, 'nasi kuning', 1, '1643371198_8491738be14a7765d38b.jpg', 10000, '', 5, 0, 5, 1, '2022-01-28 05:59:58', NULL, '2022-01-28 05:59:58'),
(46, 7, 'sate ayam', 1, '1643371348_ac20869cb5c87c5505c7.jpg', 10000, '', 5, 0, 5, 1, '2022-01-28 06:02:28', NULL, '2022-01-28 06:02:28'),
(47, 7, 'es kopyor', 3, '1643371419_00ddb18c7b272bd011ce.jpg', 5000, '', 5, 0, 5, 1, '2022-01-28 06:03:39', NULL, '2022-01-28 06:03:39'),
(48, 7, 'es degan', 3, '1643371453_ac5b010d2fe8ca060c5d.jpg', 10000, '', 5, 0, 5, 1, '2022-01-28 06:04:13', NULL, '2022-01-28 06:04:13'),
(50, 7, 'biskuat', 2, '1643371573_d5f511e889cdc81c48ff.jpg', 500, '', 5, 0, 5, 1, '2022-01-28 06:06:13', NULL, '2022-01-28 06:06:13'),
(51, 7, 'slai olai', 2, '1643371601_6548ba07adc00792692d.jpg', 2000, '', 5, 0, 5, 1, '2022-01-28 06:06:41', NULL, '2022-01-28 06:06:41'),
(52, 7, 'ote ote', 1, 'default.png', 1000, '', 5, 0, 5, 1, '2022-01-28 06:07:05', NULL, '2022-01-28 06:07:05'),
(53, 8, 'es kopyor', 3, '1643371688_022c7a9d0c8b15792708.jpg', 5000, '', 5, 0, 5, 1, '2022-01-28 06:08:08', NULL, '2022-01-28 06:08:08'),
(54, 8, 'nasi padang', 1, '1643371721_bf631620c6c1b1847c6f.jpg', 10000, '', 5, 0, 5, 1, '2022-01-28 06:08:41', NULL, '2022-01-28 06:08:41'),
(55, 8, 'nasi goreng kambing', 1, '1643371810_606f2d3db36be0e4336e.jpg', 17000, '', 5, 0, 5, 1, '2022-01-28 06:10:10', NULL, '2022-01-28 06:10:10'),
(56, 8, 'tahu tek', 1, '1643371867_f60840b8e1fd2e969dcc.jpg', 7000, '', 5, 0, 5, 1, '2022-01-28 06:11:07', NULL, '2022-01-28 06:11:07'),
(57, 8, 'mie ayam', 1, '1643371898_6444530748751d00978a.jpg', 10000, '', 5, 0, 5, 1, '2022-01-28 06:11:38', NULL, '2022-01-28 06:11:38'),
(58, 8, 'lontong kikil', 1, '1643371977_4e787e77c84dae87d2d2.jpg', 15000, '', 5, 0, 5, 1, '2022-01-28 06:12:57', NULL, '2022-01-28 06:12:57'),
(59, 8, 'biskuat', 2, '1643372018_a05d68471ff34dfc8fa4.jpg', 500, '', 5, 0, 5, 1, '2022-01-28 06:13:38', NULL, '2022-01-28 06:13:38'),
(60, 8, 'maici', 2, '1643372161_1c8afa0bc7a57543e010.jpg', 5000, '', 5, 0, 2, 1, '2022-01-28 06:16:01', NULL, '2022-01-28 06:16:01'),
(61, 8, 'mie lidi', 2, '1643372191_54e8da984682117e9235.jpg', 1000, '', 5, 0, 5, 1, '2022-01-28 06:16:31', NULL, '2022-01-28 06:16:31'),
(62, 4, 'coba dong broo', 1, 'default.png', 24324, 'sadasdas', 5, 0, 4, 1, '2022-05-16 12:27:50', NULL, '2022-05-16 12:27:50');

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id`, `name`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'makanan berat', NULL, NULL, NULL),
(2, 'makanan ringan', NULL, NULL, NULL),
(3, 'minuman', NULL, NULL, NULL),
(4, 'lainya', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` bigint(20) NOT NULL,
  `transaction_id` bigint(20) NOT NULL,
  `reporter` bigint(20) NOT NULL,
  `reported` bigint(20) NOT NULL,
  `comment` text NOT NULL,
  `cleaning` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `transaction_id`, `reporter`, `reported`, `comment`, `cleaning`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 511, 'gak ambil makanan', 1, '2022-01-27 01:42:22', '2022-01-27 01:43:49', NULL),
(2, 69, 3, 11, 'cosdjadass\r\nasdmsad,sandaa\n', 1, '2022-01-30 06:36:59', '2022-05-19 16:23:03', NULL),
(3, 25, 3, 23, 'sadsadas\n\r\nsadsad', 0, '2022-01-30 06:41:59', '2022-01-30 07:05:02', NULL),
(4, 31, 3, 27, 'asdsadasd', 0, '2022-01-30 07:05:12', '2022-01-30 07:05:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'superadmin', NULL, NULL, NULL),
(2, 'admin', NULL, NULL, NULL),
(3, 'penjual', NULL, NULL, NULL),
(4, 'pembeli', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `user_id`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 12, 'coba\r\n', '2022-05-24 08:54:14', '2022-05-24 08:54:14', NULL),
(2, 20, 'sadsadas\r\n', '2022-05-24 19:22:56', '2022-05-24 19:22:56', NULL),
(3, 20, 'sadasdsa', '2022-05-24 19:23:02', '2022-05-24 19:23:02', NULL),
(4, 3, 'sdasd', '2022-05-24 19:49:57', '2022-05-24 19:49:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `toping`
--

CREATE TABLE `toping` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toping`
--

INSERT INTO `toping` (`id`, `menu_id`, `name`, `price`, `status`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 1, 'extra sambel', 3000, 1, '2022-01-27 01:00:53', NULL, '2022-01-27 01:00:53'),
(2, 1, 'tahu tempe', 3000, 0, '2022-01-27 01:01:01', NULL, '2022-05-26 13:46:06'),
(3, 2, 'extra peyek', 2000, 0, '2022-01-27 01:02:50', NULL, '2022-01-27 01:02:50'),
(4, 2, 'extra sambel kacang', 1000, 1, '2022-01-27 01:03:10', NULL, '2022-01-27 01:03:10'),
(5, 4, 'extra koya', 2000, 1, '2022-01-27 01:07:30', NULL, '2022-01-27 01:07:30'),
(6, 5, 'extra sate kerang', 2000, 1, '2022-01-27 01:08:50', NULL, '2022-01-27 01:08:50'),
(7, 7, 'extra bumbu kacang', 2000, 1, '2022-01-27 01:36:10', NULL, '2022-01-27 01:36:10'),
(8, 9, 'extra sambel kacang', 2000, 1, '2022-01-27 21:37:56', NULL, '2022-01-27 21:37:56'),
(9, 10, 'tahu tempe', 1500, 1, '2022-01-28 05:00:14', NULL, '2022-01-28 05:00:14'),
(10, 10, 'extra sambel', 1500, 1, '2022-01-28 05:00:19', NULL, '2022-01-28 05:00:19'),
(11, 10, 'ikan asin', 1500, 1, '2022-01-28 05:00:25', NULL, '2022-01-28 05:00:25'),
(12, 10, 'terong', 2000, 1, '2022-01-28 05:00:29', NULL, '2022-01-28 05:00:29'),
(13, 11, 'tahu tempe', 1500, 1, '2022-01-28 05:01:20', NULL, '2022-01-28 05:01:20'),
(14, 11, 'extra sambel', 1500, 1, '2022-01-28 05:01:24', NULL, '2022-01-28 05:01:24'),
(15, 11, 'terong', 2000, 1, '2022-01-28 05:01:33', NULL, '2022-01-28 05:01:33'),
(16, 12, 'tahu tempe', 1500, 1, '2022-01-28 05:03:40', NULL, '2022-01-28 05:03:40'),
(17, 12, 'terong', 1500, 1, '2022-01-28 05:03:47', NULL, '2022-01-28 05:03:47'),
(18, 12, 'extra sambel', 1500, 1, '2022-01-28 05:03:55', NULL, '2022-01-28 05:03:55'),
(19, 13, 'terong', 1500, 1, '2022-01-28 05:04:54', NULL, '2022-01-28 05:04:54'),
(20, 13, 'extra sambel', 1500, 1, '2022-01-28 05:05:01', NULL, '2022-01-28 05:05:01'),
(21, 13, 'tahu tempe', 1500, 1, '2022-01-28 05:05:07', NULL, '2022-01-28 05:05:07'),
(22, 14, 'tahu tempe', 1500, 1, '2022-01-28 05:05:48', NULL, '2022-01-28 05:05:48'),
(23, 14, 'extra sambel', 1500, 1, '2022-01-28 05:05:53', NULL, '2022-01-28 05:05:53'),
(24, 14, 'terong', 1500, 1, '2022-01-28 05:05:58', NULL, '2022-01-28 05:05:58'),
(25, 15, 'tahu tempe', 1500, 1, '2022-01-28 05:06:46', NULL, '2022-01-28 05:06:46'),
(26, 15, 'extra sambel', 1500, 1, '2022-01-28 05:06:50', NULL, '2022-01-28 05:06:50'),
(27, 15, 'terong', 1500, 1, '2022-01-28 05:06:55', NULL, '2022-01-28 05:06:55'),
(28, 19, 'kakap', 10000, 1, '2022-01-28 05:13:42', NULL, '2022-01-28 05:13:42'),
(29, 19, 'daging', 7000, 1, '2022-01-28 05:13:49', NULL, '2022-01-28 05:13:49'),
(30, 19, 'kepiting', 15000, 1, '2022-01-28 05:13:58', NULL, '2022-01-28 05:13:58'),
(31, 19, 'cumi', 6000, 1, '2022-01-28 05:14:04', NULL, '2022-01-28 05:14:04'),
(32, 19, 'tempe tahu', 2000, 1, '2022-01-28 05:14:11', NULL, '2022-01-28 05:14:11'),
(33, 19, 'terong', 2000, 1, '2022-01-28 05:14:17', NULL, '2022-01-28 05:14:17'),
(34, 19, 'mujair', 5000, 1, '2022-01-28 05:14:25', NULL, '2022-01-28 05:14:25'),
(35, 19, 'ayam', 5000, 1, '2022-01-28 05:14:29', NULL, '2022-01-28 05:14:29'),
(36, 19, 'telor', 5000, 1, '2022-01-28 05:14:34', NULL, '2022-01-28 05:14:34'),
(37, 20, 'telor', 3000, 1, '2022-01-28 05:15:21', NULL, '2022-01-28 05:15:21'),
(38, 20, 'ayam', 5000, 1, '2022-01-28 05:15:26', NULL, '2022-01-28 05:15:26'),
(39, 20, 'daging', 7000, 1, '2022-01-28 05:15:32', NULL, '2022-01-28 05:15:32'),
(40, 21, 'extra telor', 3000, 1, '2022-01-28 05:16:15', NULL, '2022-01-28 05:16:15'),
(41, 21, 'extra pedas', 500, 1, '2022-01-28 05:16:28', NULL, '2022-01-28 05:16:28'),
(42, 21, 'ayam', 2000, 1, '2022-01-28 05:16:36', NULL, '2022-01-28 05:16:36'),
(43, 22, 'extra ayam', 2000, 1, '2022-01-28 05:17:24', NULL, '2022-01-28 05:17:24'),
(44, 22, 'extra telor', 2000, 1, '2022-01-28 05:17:33', NULL, '2022-01-28 05:17:33'),
(45, 27, 'extra gula aren', 1000, 1, '2022-01-28 05:20:12', NULL, '2022-01-28 05:20:12'),
(46, 27, 'selasih', 1000, 1, '2022-01-28 05:20:27', NULL, '2022-01-28 05:20:27'),
(47, 28, 'babad', 5000, 1, '2022-01-28 05:43:27', NULL, '2022-01-28 05:43:27'),
(48, 28, 'extra koya', 1000, 1, '2022-01-28 05:43:41', NULL, '2022-01-28 05:43:41'),
(49, 28, 'extra telor', 3000, 1, '2022-01-28 05:44:01', NULL, '2022-01-28 05:44:01'),
(50, 29, 'empal', 5000, 1, '2022-01-28 05:44:55', NULL, '2022-01-28 05:44:55'),
(51, 29, 'perkedel', 2000, 1, '2022-01-28 05:45:02', NULL, '2022-01-28 05:45:02'),
(52, 29, 'extra tauge', 1000, 1, '2022-01-28 05:45:11', NULL, '2022-01-28 05:45:11'),
(53, 29, 'paru', 3000, 1, '2022-01-28 05:45:17', NULL, '2022-01-28 05:45:17'),
(54, 29, 'limpo', 3000, 1, '2022-01-28 05:45:21', NULL, '2022-01-28 05:45:21'),
(55, 29, 'usus', 3000, 1, '2022-01-28 05:45:26', NULL, '2022-01-28 05:45:26'),
(56, 30, 'telor', 3000, 1, '2022-01-28 05:46:09', NULL, '2022-01-28 05:46:09'),
(57, 30, 'udang', 2000, 1, '2022-01-28 05:46:18', NULL, '2022-01-28 05:46:18'),
(58, 30, 'daging', 5000, 1, '2022-01-28 05:46:29', NULL, '2022-01-28 05:46:29'),
(59, 30, 'extra sambel', 1000, 1, '2022-01-28 05:46:36', NULL, '2022-01-28 05:46:36'),
(60, 31, 'extra gula aren', 1000, 1, '2022-01-28 05:47:11', NULL, '2022-01-28 05:47:11'),
(61, 31, 'nata de coco', 1000, 1, '2022-01-28 05:47:17', NULL, '2022-01-28 05:47:17'),
(62, 35, 'double ayam', 7000, 1, '2022-01-28 05:50:50', NULL, '2022-01-28 05:50:50'),
(63, 35, 'extra nasi', 1000, 1, '2022-01-28 05:51:00', NULL, '2022-01-28 05:51:00'),
(64, 35, 'tahu tempe', 1000, 1, '2022-01-28 05:51:10', NULL, '2022-01-28 05:51:10'),
(65, 36, 'ayam suir', 2000, 1, '2022-01-28 05:51:55', NULL, '2022-01-28 05:51:55'),
(66, 36, 'telor ayam kampung', 4000, 1, '2022-01-28 05:52:06', NULL, '2022-01-28 05:52:06'),
(67, 36, 'double mie', 3000, 1, '2022-01-28 05:52:22', NULL, '2022-01-28 05:52:22'),
(68, 36, 'daging', 5000, 1, '2022-01-28 05:52:30', NULL, '2022-01-28 05:52:30'),
(69, 37, 'telor', 3000, 1, '2022-01-28 05:53:24', NULL, '2022-01-28 05:53:24'),
(70, 37, 'pare', 1000, 1, '2022-01-28 05:53:28', NULL, '2022-01-28 05:53:28'),
(71, 37, 'extra sambel kacang', 2000, 1, '2022-01-28 05:53:36', NULL, '2022-01-28 05:53:36'),
(72, 38, 'extra gula aren', 1000, 1, '2022-01-28 05:54:11', NULL, '2022-01-28 05:54:11'),
(73, 38, 'selasih', 1000, 1, '2022-01-28 05:54:15', NULL, '2022-01-28 05:54:15'),
(74, 42, 'extra gula aren', 1000, 1, '2022-01-28 05:56:33', NULL, '2022-01-28 05:56:33'),
(75, 42, 'nata de coco', 1000, 1, '2022-01-28 05:56:46', NULL, '2022-01-28 05:56:46'),
(76, 43, 'extra cingur', 3000, 1, '2022-01-28 05:58:31', NULL, '2022-01-28 05:58:31'),
(77, 43, 'extra lontong', 1000, 1, '2022-01-28 05:58:36', NULL, '2022-01-28 05:58:36'),
(78, 43, 'extra nasi', 1000, 1, '2022-01-28 05:58:40', NULL, '2022-01-28 05:58:40'),
(79, 43, 'extra bumbu', 1000, 1, '2022-01-28 05:58:50', NULL, '2022-01-28 05:58:50'),
(80, 43, 'extra pedas', 500, 1, '2022-01-28 05:58:57', NULL, '2022-01-28 05:58:57'),
(81, 44, 'extra saus', 1000, 1, '2022-01-28 05:59:28', NULL, '2022-01-28 05:59:28'),
(82, 44, 'telor', 3000, 1, '2022-01-28 05:59:32', NULL, '2022-01-28 05:59:32'),
(83, 45, 'tahu tempe', 1000, 1, '2022-01-28 06:00:06', NULL, '2022-01-28 06:00:06'),
(84, 45, 'telor', 3000, 1, '2022-01-28 06:00:52', NULL, '2022-01-28 06:00:52'),
(85, 45, 'ayam', 5000, 1, '2022-01-28 06:00:57', NULL, '2022-01-28 06:00:57'),
(86, 45, 'daging', 5000, 1, '2022-01-28 06:01:01', NULL, '2022-01-28 06:01:01'),
(87, 45, 'keripik kentang', 1000, 1, '2022-01-28 06:01:11', NULL, '2022-01-28 06:01:11'),
(88, 45, 'extra srundeng', 2000, 1, '2022-01-28 06:01:25', NULL, '2022-01-28 06:01:25'),
(89, 46, 'lontong', 2000, 1, '2022-01-28 06:02:34', NULL, '2022-01-28 06:02:34'),
(90, 46, 'nasi', 1000, 1, '2022-01-28 06:02:38', NULL, '2022-01-28 06:02:38'),
(91, 47, 'extra gula aren', 1000, 1, '2022-01-28 06:03:45', NULL, '2022-01-28 06:03:45'),
(92, 47, 'selasih', 1000, 1, '2022-01-28 06:03:49', NULL, '2022-01-28 06:03:49'),
(93, 48, 'extra gula aren', 1000, 1, '2022-01-28 06:04:22', NULL, '2022-01-28 06:04:22'),
(94, 53, 'extra gula aren', 1000, 1, '2022-01-28 06:08:13', NULL, '2022-01-28 06:08:13'),
(95, 53, 'selasih', 1000, 1, '2022-01-28 06:08:16', NULL, '2022-01-28 06:08:16'),
(96, 54, 'dagin', 5000, 1, '2022-01-28 06:08:46', NULL, '2022-01-28 06:08:46'),
(97, 54, 'ayam', 5000, 1, '2022-01-28 06:08:51', NULL, '2022-01-28 06:08:51'),
(98, 54, 'kakap', 5000, 1, '2022-01-28 06:08:55', NULL, '2022-01-28 06:08:55'),
(99, 54, 'mujair', 5000, 1, '2022-01-28 06:09:00', NULL, '2022-01-28 06:09:00'),
(100, 54, 'gurame', 5000, 1, '2022-01-28 06:09:07', NULL, '2022-01-28 06:09:07'),
(101, 54, 'telor', 3000, 1, '2022-01-28 06:09:12', NULL, '2022-01-28 06:09:12'),
(102, 54, 'tahu tempe', 2000, 1, '2022-01-28 06:09:18', NULL, '2022-01-28 06:09:18'),
(103, 54, 'perkedel', 3000, 1, '2022-01-28 06:09:22', NULL, '2022-01-28 06:09:22'),
(104, 54, 'peyek udang', 2000, 1, '2022-01-28 06:09:33', NULL, '2022-01-28 06:09:33'),
(105, 54, 'cumi', 5000, 1, '2022-01-28 06:09:38', NULL, '2022-01-28 06:09:38'),
(106, 55, 'extra telor', 3000, 1, '2022-01-28 06:10:17', NULL, '2022-01-28 06:10:17'),
(107, 55, 'extra sosis', 2000, 1, '2022-01-28 06:10:22', NULL, '2022-01-28 06:10:22'),
(108, 55, 'extra ayam', 3000, 1, '2022-01-28 06:10:28', NULL, '2022-01-28 06:10:28'),
(109, 56, 'telor', 3000, 1, '2022-01-28 06:11:13', NULL, '2022-01-28 06:11:13'),
(110, 57, 'extra ayam', 2000, 1, '2022-01-28 06:11:44', NULL, '2022-01-28 06:11:44'),
(111, 57, 'extra daging', 3000, 1, '2022-01-28 06:12:00', NULL, '2022-01-28 06:12:00'),
(112, 57, 'extra pangsit', 2000, 1, '2022-01-28 06:12:08', NULL, '2022-01-28 06:12:08'),
(113, 58, 'extra kikil', 5000, 1, '2022-01-28 06:13:09', NULL, '2022-01-28 06:13:09'),
(114, 58, 'extra lontong', 2000, 1, '2022-01-28 06:13:14', NULL, '2022-01-28 06:13:14'),
(115, 62, 'sadad', 342324, 1, '2022-05-16 12:27:58', NULL, '2022-05-16 12:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `canteen_id` int(11) NOT NULL,
  `noted` text DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `time_estimate` float NOT NULL,
  `notify` int(1) NOT NULL,
  `comment` text NOT NULL,
  `order_option` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `status`, `canteen_id`, `noted`, `rating`, `time_estimate`, `notify`, `comment`, `order_option`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 12, 5, 3, '', NULL, 20, 1, '', 0, '2022-05-22 19:16:49', NULL, '2022-05-24 19:24:51'),
(2, 12, 5, 4, '', 3, 25, 0, 'kjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdshkjkdskfdhjsfhdsjfhdsfhdfdsh', 0, '2022-05-22 19:18:39', NULL, '2022-05-23 20:23:47'),
(3, 12, 5, 3, NULL, 5, 0, 0, 'kjsahdjhas', 0, '2022-05-22 19:22:22', NULL, '2022-05-23 20:22:47'),
(4, 14, 5, 5, '', NULL, 40, 0, '', 0, '2022-05-22 20:58:17', NULL, '2022-05-22 20:58:30'),
(5, 14, 5, 3, '', NULL, 10, 0, '', 0, '2022-05-23 11:14:40', NULL, '2022-05-23 19:00:49'),
(6, 12, 5, 3, '', NULL, 20, 1, '', 0, '2022-05-24 08:35:24', NULL, '2022-05-24 19:24:54'),
(8, 12, 5, 3, '', NULL, 5, 1, '', 0, '2022-05-24 11:08:01', NULL, '2022-05-24 19:24:56'),
(9, 20, 5, 3, '', 4, 5, 1, '', 0, '2022-05-24 19:23:12', NULL, '2022-05-24 19:26:06'),
(10, 20, 5, 3, '', 4, 5, 1, '', 0, '2022-05-24 19:23:23', NULL, '2022-05-24 19:26:02'),
(11, 20, 5, 3, '', 4, 5, 1, '', 0, '2022-05-24 19:23:36', NULL, '2022-05-24 19:25:58'),
(12, 20, 5, 3, '', 4, 10, 1, '', 0, '2022-05-24 19:23:45', NULL, '2022-05-24 19:25:52'),
(13, 20, 5, 3, '', 4, 25, 1, '1', 0, '2022-05-24 19:23:57', NULL, '2022-05-24 19:25:48'),
(18, 12, 9, 3, '', NULL, 10, 0, '', 0, '2022-05-26 10:35:28', NULL, '2022-05-26 10:54:50'),
(24, 12, 4, 3, '', NULL, 15, 1, '', 1, '2022-05-26 19:07:51', NULL, '2022-05-26 20:41:28'),
(25, 12, 2, 4, '', NULL, 5, 0, '', 1, '2022-05-26 19:11:33', NULL, '2022-05-26 19:59:20'),
(26, 12, 2, 3, '', NULL, 10, 0, '', 0, '2022-05-26 22:37:22', NULL, '2022-05-26 22:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_menu`
--

CREATE TABLE `transaction_menu` (
  `id` bigint(20) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `count` int(11) NOT NULL,
  `price` double NOT NULL,
  `transaction_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_menu`
--

INSERT INTO `transaction_menu` (`id`, `menu_id`, `name`, `count`, `price`, `transaction_id`, `created_at`, `deleted_at`, `updated_at`) VALUES
(68, 2, 'pecel mediun', 1, 10000, 28, '2022-05-20 14:12:59', NULL, '2022-05-20 14:12:59'),
(69, 28, 'soto lamongan', 1, 15000, 28, '2022-05-20 14:13:02', NULL, '2022-05-20 14:13:02'),
(70, 29, 'rawon', 1, 10000, 28, '2022-05-20 14:13:03', NULL, '2022-05-20 14:13:03'),
(71, 1, 'bebek sinjay', 1, 20000, 29, '2022-05-20 14:13:22', NULL, '2022-05-20 14:13:22'),
(72, 2, 'pecel mediun', 1, 10000, 29, '2022-05-20 14:13:22', NULL, '2022-05-20 14:13:22'),
(73, 28, 'soto lamongan', 1, 15000, 29, '2022-05-20 14:13:25', NULL, '2022-05-20 14:13:25'),
(74, 1, 'bebek sinjay', 1, 20000, 30, '2022-05-20 14:13:41', NULL, '2022-05-20 14:13:41'),
(75, 2, 'pecel mediun', 1, 10000, 30, '2022-05-20 14:13:42', NULL, '2022-05-20 14:13:42'),
(76, 28, 'soto lamongan', 1, 15000, 30, '2022-05-20 14:13:46', NULL, '2022-05-20 14:13:46'),
(77, 1, 'bebek sinjay', 1, 20000, 31, '2022-05-20 14:14:00', NULL, '2022-05-20 14:14:00'),
(78, 2, 'pecel mediun', 2, 10000, 31, '2022-05-20 14:14:01', NULL, '2022-05-20 14:14:04'),
(79, 28, 'soto lamongan', 2, 15000, 31, '2022-05-20 14:14:02', NULL, '2022-05-20 14:14:03'),
(80, 1, 'bebek sinjay', 1, 20000, 32, '2022-05-20 14:14:20', NULL, '2022-05-20 14:14:20'),
(81, 2, 'pecel mediun', 1, 10000, 32, '2022-05-20 14:14:21', NULL, '2022-05-20 14:14:21'),
(82, 1, 'bebek sinjay', 1, 20000, 33, '2022-05-20 14:14:37', NULL, '2022-05-20 14:14:37'),
(83, 1, 'bebek sinjay', 1, 20000, 34, '2022-05-20 14:14:53', NULL, '2022-05-20 14:14:53'),
(84, 2, 'pecel mediun', 1, 10000, 34, '2022-05-20 14:14:54', NULL, '2022-05-20 14:14:54'),
(85, 28, 'soto lamongan', 1, 15000, 34, '2022-05-20 14:14:55', NULL, '2022-05-20 14:14:55'),
(86, 29, 'rawon', 1, 10000, 34, '2022-05-20 14:14:56', NULL, '2022-05-20 14:14:56'),
(87, 4, 'soto lamongan', 1, 15000, 35, '2022-05-21 20:24:01', NULL, '2022-05-21 20:24:01'),
(88, 5, 'lontong kupang', 1, 10000, 35, '2022-05-21 20:24:02', NULL, '2022-05-21 20:24:02'),
(89, 35, 'opor ayam', 1, 10000, 35, '2022-05-21 20:24:02', NULL, '2022-05-21 20:24:02'),
(90, 36, 'mie aceh', 1, 10000, 35, '2022-05-21 20:24:03', NULL, '2022-05-21 20:24:03'),
(91, 4, 'soto lamongan', 1, 15000, 36, '2022-05-21 20:43:47', NULL, '2022-05-21 20:43:47'),
(92, 5, 'lontong kupang', 1, 10000, 36, '2022-05-21 20:43:48', NULL, '2022-05-21 20:43:48'),
(93, 35, 'opor ayam', 1, 10000, 36, '2022-05-21 20:43:49', NULL, '2022-05-21 20:43:49'),
(94, 36, 'mie aceh', 1, 10000, 36, '2022-05-21 20:43:50', NULL, '2022-05-21 20:43:50'),
(95, 1, 'bebek sinjay', 2, 20000, 1, '2022-05-22 19:16:49', NULL, '2022-05-22 19:16:50'),
(96, 2, 'pecel mediun', 2, 10000, 1, '2022-05-22 19:16:57', NULL, '2022-05-22 19:17:20'),
(97, 4, 'soto lamongan', 3, 15000, 2, '2022-05-22 19:18:39', NULL, '2022-05-22 19:18:51'),
(98, 5, 'lontong kupang', 1, 10000, 2, '2022-05-22 19:18:41', NULL, '2022-05-22 19:18:41'),
(99, 35, 'opor ayam', 1, 10000, 2, '2022-05-22 19:18:45', NULL, '2022-05-22 19:18:45'),
(100, 1, 'bebek sinjay', 1, 20000, 3, '2022-05-22 19:22:22', NULL, '2022-05-22 19:22:22'),
(101, 2, 'pecel mediun', 1, 10000, 3, '2022-05-22 19:22:24', NULL, '2022-05-22 19:22:24'),
(102, 28, 'soto lamongan', 1, 15000, 3, '2022-05-22 19:22:25', NULL, '2022-05-22 19:22:25'),
(103, 10, 'ayam goren', 1, 15000, 4, '2022-05-22 20:58:17', NULL, '2022-05-22 20:58:17'),
(104, 11, 'lele goreng', 1, 10000, 4, '2022-05-22 20:58:18', NULL, '2022-05-22 20:58:18'),
(105, 12, 'ayam bakar', 1, 15000, 4, '2022-05-22 20:58:20', NULL, '2022-05-22 20:58:20'),
(106, 13, 'bebek goreng', 1, 17000, 4, '2022-05-22 20:58:21', NULL, '2022-05-22 20:58:21'),
(107, 15, 'gurame goreng', 1, 20000, 4, '2022-05-22 20:58:23', NULL, '2022-05-22 20:58:23'),
(108, 14, 'gurame bakar', 1, 20000, 4, '2022-05-22 20:58:24', NULL, '2022-05-22 20:58:24'),
(109, 6, 'biskuat', 1, 500, 4, '2022-05-22 20:58:26', NULL, '2022-05-22 20:58:26'),
(110, 17, 'ote ote', 1, 1000, 4, '2022-05-22 20:58:27', NULL, '2022-05-22 20:58:27'),
(111, 1, 'bebek sinjay', 1, 20000, 5, '2022-05-23 11:14:40', NULL, '2022-05-23 11:14:40'),
(112, 2, 'pecel mediun', 1, 10000, 5, '2022-05-23 11:14:41', NULL, '2022-05-23 11:14:41'),
(113, 29, 'rawon', 1, 10000, 6, '2022-05-24 08:35:24', NULL, '2022-05-24 08:35:24'),
(114, 30, 'mie goreng', 1, 5000, 6, '2022-05-24 08:35:25', NULL, '2022-05-24 08:35:25'),
(115, 31, 'es degan', 1, 10000, 6, '2022-05-24 08:35:27', NULL, '2022-05-24 08:35:27'),
(116, 3, 'es kopyor', 1, 5000, 6, '2022-05-24 08:35:28', NULL, '2022-05-24 08:35:28'),
(118, 31, 'es degan', 1, 10000, 8, '2022-05-24 11:08:01', NULL, '2022-05-24 11:08:01'),
(119, 29, 'rawon', 1, 10000, 9, '2022-05-24 19:23:12', NULL, '2022-05-24 19:23:12'),
(120, 29, 'rawon', 1, 10000, 10, '2022-05-24 19:23:23', NULL, '2022-05-24 19:23:23'),
(121, 29, 'rawon', 1, 10000, 11, '2022-05-24 19:23:36', NULL, '2022-05-24 19:23:36'),
(122, 29, 'rawon', 1, 10000, 12, '2022-05-24 19:23:45', NULL, '2022-05-24 19:23:45'),
(123, 30, 'mie goreng', 1, 5000, 12, '2022-05-24 19:23:46', NULL, '2022-05-24 19:23:46'),
(124, 29, 'rawon', 1, 10000, 13, '2022-05-24 19:23:58', NULL, '2022-05-24 19:23:58'),
(125, 30, 'mie goreng', 1, 5000, 13, '2022-05-24 19:23:58', NULL, '2022-05-24 19:23:58'),
(126, 31, 'es degan', 1, 10000, 13, '2022-05-24 19:23:59', NULL, '2022-05-24 19:23:59'),
(127, 3, 'es kopyor', 1, 5000, 13, '2022-05-24 19:24:01', NULL, '2022-05-24 19:24:01'),
(128, 32, 'biskuat', 1, 500, 13, '2022-05-24 19:24:02', NULL, '2022-05-24 19:24:02'),
(177, 34, 'slai olai', 1, 500, 18, '2022-05-26 10:35:28', NULL, '2022-05-26 10:35:28'),
(178, 2, 'pecel mediun', 1, 10000, 18, '2022-05-26 10:35:29', NULL, '2022-05-26 10:35:29'),
(205, 1, 'bebek sinjay', 2, 20000, 24, '2022-05-26 19:07:51', NULL, '2022-05-26 19:07:54'),
(206, 2, 'pecel mediun', 1, 10000, 24, '2022-05-26 19:08:00', NULL, '2022-05-26 19:08:00'),
(208, 36, 'mie aceh', 1, 10000, 25, '2022-05-26 19:11:33', NULL, '2022-05-26 19:11:33'),
(209, 34, 'slai olai', 1, 500, 26, '2022-05-26 22:37:22', NULL, '2022-05-26 22:37:22'),
(210, 1, 'bebek sinjay', 1, 20000, 26, '2022-05-26 22:37:23', NULL, '2022-05-26 22:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_toping`
--

CREATE TABLE `transaction_toping` (
  `id` bigint(20) NOT NULL,
  `transaction_menu_id` bigint(20) NOT NULL,
  `toping_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_toping`
--

INSERT INTO `transaction_toping` (`id`, `transaction_menu_id`, `toping_id`, `price`, `created_at`, `deleted_at`, `updated_at`) VALUES
(42, 67, 1, 3000, '2022-05-20 14:13:00', NULL, '2022-05-20 14:13:00'),
(43, 67, 2, 3000, '2022-05-20 14:13:00', NULL, '2022-05-20 14:13:00'),
(44, 68, 3, 2000, '2022-05-20 14:13:01', NULL, '2022-05-20 14:13:01'),
(45, 68, 4, 1000, '2022-05-20 14:13:01', NULL, '2022-05-20 14:13:01'),
(46, 70, 50, 5000, '2022-05-20 14:13:05', NULL, '2022-05-20 14:13:05'),
(47, 71, 1, 3000, '2022-05-20 14:13:23', NULL, '2022-05-20 14:13:23'),
(48, 72, 3, 2000, '2022-05-20 14:13:24', NULL, '2022-05-20 14:13:24'),
(50, 73, 48, 1000, '2022-05-20 14:13:27', NULL, '2022-05-20 14:13:27'),
(51, 73, 47, 5000, '2022-05-20 14:13:27', NULL, '2022-05-20 14:13:27'),
(52, 74, 2, 3000, '2022-05-20 14:13:43', NULL, '2022-05-20 14:13:43'),
(53, 75, 3, 2000, '2022-05-20 14:13:44', NULL, '2022-05-20 14:13:44'),
(54, 76, 47, 5000, '2022-05-20 14:13:47', NULL, '2022-05-20 14:13:47'),
(55, 76, 48, 1000, '2022-05-20 14:13:48', NULL, '2022-05-20 14:13:48'),
(56, 80, 2, 3000, '2022-05-20 14:14:22', NULL, '2022-05-20 14:14:22'),
(57, 81, 3, 2000, '2022-05-20 14:14:24', NULL, '2022-05-20 14:14:24'),
(58, 85, 48, 1000, '2022-05-20 14:14:56', NULL, '2022-05-20 14:14:56'),
(59, 85, 47, 5000, '2022-05-20 14:14:57', NULL, '2022-05-20 14:14:57'),
(60, 89, 62, 7000, '2022-05-21 20:24:04', NULL, '2022-05-21 20:24:04'),
(61, 89, 63, 1000, '2022-05-21 20:24:05', NULL, '2022-05-21 20:24:05'),
(62, 93, 62, 7000, '2022-05-21 20:43:52', NULL, '2022-05-21 20:43:52'),
(63, 93, 63, 1000, '2022-05-21 20:43:53', NULL, '2022-05-21 20:43:53'),
(64, 95, 1, 3000, '2022-05-22 19:16:55', NULL, '2022-05-22 19:16:55'),
(66, 96, 3, 2000, '2022-05-22 19:17:21', NULL, '2022-05-22 19:17:21'),
(67, 97, 5, 2000, '2022-05-22 19:18:40', NULL, '2022-05-22 19:18:40'),
(68, 98, 6, 2000, '2022-05-22 19:18:43', NULL, '2022-05-22 19:18:43'),
(70, 99, 62, 7000, '2022-05-22 19:19:00', NULL, '2022-05-22 19:19:00'),
(71, 102, 47, 5000, '2022-05-22 19:22:27', NULL, '2022-05-22 19:22:27'),
(72, 103, 9, 1500, '2022-05-22 20:58:19', NULL, '2022-05-22 20:58:19'),
(73, 103, 10, 1500, '2022-05-22 20:58:19', NULL, '2022-05-22 20:58:19'),
(74, 108, 22, 1500, '2022-05-22 20:58:24', NULL, '2022-05-22 20:58:24'),
(75, 118, 61, 1000, '2022-05-24 11:08:04', NULL, '2022-05-24 11:08:04'),
(76, 120, 55, 3000, '2022-05-24 19:23:24', NULL, '2022-05-24 19:23:24'),
(90, 205, 1, 3000, '2022-05-26 19:07:56', NULL, '2022-05-26 19:07:56'),
(91, 206, 4, 1000, '2022-05-26 19:08:01', NULL, '2022-05-26 19:08:01'),
(94, 208, 65, 2000, '2022-05-26 19:11:35', NULL, '2022-05-26 19:11:35'),
(95, 208, 67, 3000, '2022-05-26 19:11:38', NULL, '2022-05-26 19:11:38'),
(96, 210, 1, 3000, '2022-05-26 22:37:24', NULL, '2022-05-26 22:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 4,
  `photo` varchar(255) NOT NULL DEFAULT 'default.png',
  `type_login` varchar(20) NOT NULL DEFAULT 'none',
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `photo`, `type_login`, `status`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'super admin', 'superadmin@gmail.com', '$2y$10$3AF9m9VWJdTxbt6ktg.GtuOvwGO8lIDRtTauXfEh8JknTpfTSrEn6', 1, 'default.png', 'none', 1, '2022-01-27 00:51:21', NULL, '2022-01-27 00:51:21'),
(2, 'admin', 'admin@gmail.com', '$2y$10$LtoDmhb.ib0d7smRmS7.JOeER8BpB6N2SjLOrlDzYI3bQB/EGr2D.', 2, 'default.png', 'none', 1, '2022-01-27 00:51:21', NULL, '2022-01-27 00:51:21'),
(3, 'penjual satu', 'penjual1@gmail.com', '$2y$10$/Xmz0GgYLKRPKn/sk2s.H.XM0zF6NUebCNGp9TDzHeytM4Ep5tsQ2', 3, 'default.png', 'none', 1, '2022-01-27 00:51:21', NULL, '2022-05-19 12:04:21'),
(4, 'penjual dua', 'penjual2@gmail.com', '$2y$10$B7e7mClljVCHirnLg7Wu4eELKi8WCEbCXO9nKpo.ieU7xWHnN9nvK', 3, 'default.png', 'none', 1, '2022-01-27 00:51:22', NULL, '2022-01-27 00:51:22'),
(5, 'penjual tiga', 'penjual3@gmail.com', '$2y$10$n8rzyZWDLzkaQFfmZ6b/oOAQkVai.kKjQ5njGeMBoPfTPjwPU2b9W', 3, 'default.png', 'none', 1, '2022-01-27 00:51:22', NULL, '2022-01-27 00:51:22'),
(6, 'penjual empat', 'penjual4@gmail.com', '$2y$10$tzlgKjKqVMZ2cb1jjSQasOgp/3gclh8D94LItqgr3xyIN0BuELfgG', 3, 'default.png', 'none', 1, '2022-01-27 00:51:22', NULL, '2022-01-27 00:51:22'),
(7, 'penjual lima', 'penjual5@gmail.com', '$2y$10$3enkJOf/FayaGHH4JfVYFu1t2DPiIwS/N7DNtqx9vf1qtFCQQ/NhK', 3, 'default.png', 'none', 1, '2022-01-27 00:51:22', NULL, '2022-01-27 00:51:22'),
(8, 'penjual enam', 'penjual6@gmail.com', '$2y$10$QjSAQnDwHRrBaGWKFQyaquphnMi8ZlWISx2csy4UmUgGvZQ3cl/6K', 3, 'default.png', 'none', 1, '2022-01-27 00:51:22', NULL, '2022-01-27 00:51:22'),
(10, 'pembeli2', 'pembeli2@gmail.com', '$2y$10$hni8q1wrd1piX4tLT7lzC.tDA.jI1qBpEYrG4T9MTL3YmShjRi2L2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:22', NULL, '2022-03-31 04:32:14'),
(11, 'pembeli3', 'pembeli3@gmail.com', '$2y$10$dMzfWX56CMWubXmDgp8O4Ovo0/HJpDv88Y7XXygKXMYa6eoL/4jYG', 4, 'default.png', 'none', 1, '2022-01-27 00:51:23', NULL, '2022-01-27 00:51:23'),
(12, 'pembeli4', 'pembeli4@gmail.com', '$2y$10$tH42uxmfS1WPZg5MkBP1Be.RHDCxjcJrSUY0Sz5ibGVuFTIRO83O2', 4, 'download (35).jpg', 'none', 1, '2022-01-27 00:51:23', NULL, '2022-03-31 04:40:31'),
(14, 'pembeli6', 'pembeli6@gmail.com', '$2y$10$Bl6bIfcEw1kzzTzJp/5Aiuc44AiQSuEAPZMcpHJ5qQv1MOvwhhGXu', 4, 'default.png', 'none', 1, '2022-01-27 00:51:23', NULL, '2022-01-27 00:51:23'),
(15, 'pembeli7', 'pembeli7@gmail.com', '$2y$10$AHbLbTQkrULJfcL9fcTMouGr72hOpZBR/aSpM0y0JLqouAmdVV/H2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:24', NULL, '2022-01-27 00:51:24'),
(16, 'pembeli8', 'pembeli8@gmail.com', '$2y$10$sj/N6EyYrzAtOSw4JrVgBOwQ5Utv6VERSfxt5Cn8kLePW.NCF1jfW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:24', NULL, '2022-01-27 00:51:24'),
(17, 'pembeli9', 'pembeli9@gmail.com', '$2y$10$IiIyhH6W8tDOF4VCjetz9OlBhEgqUhKMSw5/dJp6sTkz2X45a706S', 4, 'default.png', 'none', 1, '2022-01-27 00:51:24', NULL, '2022-01-27 00:51:24'),
(18, 'pembeli10', 'pembeli10@gmail.com', '$2y$10$r1ScheaQ7n/iQHDFt6nnguOnDlJIbQMz7H3.RZNWGUNMKR7ceRiPO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:24', NULL, '2022-01-27 00:51:24'),
(19, 'pembeli11', 'pembeli11@gmail.com', '$2y$10$cXwVOpqv/1C1qKfRUzLYPO2IIMzerba.Wk8N3z4Cb5DbU391OmK5S', 4, 'default.png', 'none', 1, '2022-01-27 00:51:24', NULL, '2022-01-27 00:51:24'),
(20, 'pembeli12', 'pembeli12@gmail.com', '$2y$10$tffkvkhIcPx5r2IWtdg9LugFpCtQaD.kAbgkQepb3mJOSgsdK5XNC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:24', NULL, '2022-01-27 00:51:24'),
(21, 'pembeli13', 'pembeli13@gmail.com', '$2y$10$fW2Q8PSokRwHSZ9fdE.OueOS.uLRTAGw708iSHTTBnG7RKFi8H/fG', 4, 'default.png', 'none', 1, '2022-01-27 00:51:24', NULL, '2022-01-27 00:51:24'),
(22, 'pembeli14', 'pembeli14@gmail.com', '$2y$10$B.cVZ.XbhEFvzIoLYUAWGem.Mtg4coI2Iu2qk0wFQurdUqeLn88Lm', 4, 'default.png', 'none', 1, '2022-01-27 00:51:25', NULL, '2022-01-27 00:51:25'),
(23, 'pembeli15', 'pembeli15@gmail.com', '$2y$10$LhaKO6Zm3QRbI8qOplFw1eiCYhy1biS/n38wp4S4Dt9NzHoJHuci2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:25', NULL, '2022-01-27 00:51:25'),
(24, 'pembeli16', 'pembeli16@gmail.com', '$2y$10$g1PpUkE96wLQ4Xmv5CzncOG/spvuT1AxPtmPx6aC7tdlrYdPssUJK', 4, 'default.png', 'none', 1, '2022-01-27 00:51:25', NULL, '2022-01-27 00:51:25'),
(25, 'pembeli17', 'pembeli17@gmail.com', '$2y$10$oNMRZk4hwf.JbZFu2/AR4e066V..tGafBJNHw.WGS6hfz/.MbBS62', 4, 'default.png', 'none', 1, '2022-01-27 00:51:25', NULL, '2022-01-27 00:51:25'),
(26, 'pembeli18', 'pembeli18@gmail.com', '$2y$10$uqgp/7sy35/BLUcMDmYHMemNzxLQIXXOHBeurgLiznwrnYrkeWS36', 4, 'default.png', 'none', 1, '2022-01-27 00:51:25', NULL, '2022-01-27 00:51:25'),
(27, 'pembeli19', 'pembeli19@gmail.com', '$2y$10$DFQ8d3GrPDOXOZN9Koeymu7BL5UF/B0iMRuZCF1..iSWb/b9zcEAi', 4, 'default.png', 'none', 1, '2022-01-27 00:51:26', NULL, '2022-01-27 00:51:26'),
(28, 'pembeli20', 'pembeli20@gmail.com', '$2y$10$thtr9pHl4x9MYHLja91y..KKxxU0B5/kDpzca3hfsSAE2ieL08EW2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:26', NULL, '2022-01-27 00:51:26'),
(29, 'pembeli21', 'pembeli21@gmail.com', '$2y$10$iUNUN8fT4paQeNCZJ0cnWOEf1CCbOqQc9J5VrDLa914uJb/or17SO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:26', NULL, '2022-01-27 00:51:26'),
(30, 'pembeli22', 'pembeli22@gmail.com', '$2y$10$8Sge9TOw0qBj6A4NBneYBeRMQGGT9.szJ4EkszR0SBPaWElRDvjJy', 4, 'default.png', 'none', 1, '2022-01-27 00:51:26', NULL, '2022-01-27 00:51:26'),
(31, 'pembeli23', 'pembeli23@gmail.com', '$2y$10$eGp6J4.JhK9MDRuHv7deeul6bWzVCTDWCGnjF.DXJpy6yWu9yYSBm', 4, 'default.png', 'none', 1, '2022-01-27 00:51:26', NULL, '2022-01-27 00:51:26'),
(32, 'pembeli24', 'pembeli24@gmail.com', '$2y$10$zdwPGOjJDHlNSlbVpeHkOu5QtsW.vgde9G8Jcw3BwrzKdVXbTDpAO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:26', NULL, '2022-01-27 00:51:26'),
(33, 'pembeli25', 'pembeli25@gmail.com', '$2y$10$YxCO88tv6Y9nsVCdu2xiXe6zoY7m3QymmHF.0QdSCm0Wh0F9DTYIy', 4, 'default.png', 'none', 1, '2022-01-27 00:51:27', NULL, '2022-01-27 00:51:27'),
(34, 'pembeli26', 'pembeli26@gmail.com', '$2y$10$DSrr9xfhB5zasljX7d95du8lCrD2HzNkjZp2P0pPIeAQ/DZCPqZA2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:27', NULL, '2022-01-27 00:51:27'),
(35, 'pembeli27', 'pembeli27@gmail.com', '$2y$10$f1Gf1IdqaQxCjqfefkeLDejCoszKbtO.KqxzIGAfJn0bKhIZkZ75W', 4, 'default.png', 'none', 1, '2022-01-27 00:51:27', NULL, '2022-01-27 00:51:27'),
(36, 'pembeli28', 'pembeli28@gmail.com', '$2y$10$Z6E9EwFRs8iHAVzOkJ7fyeh8qMm7u4KvovZDcUZc3BavxRpZshWWe', 4, 'default.png', 'none', 1, '2022-01-27 00:51:27', NULL, '2022-01-27 00:51:27'),
(37, 'pembeli29', 'pembeli29@gmail.com', '$2y$10$37CnCZ27jw9H5cujRnO4TO6SKE5kqs1tn48OTVLtZbm2PgZaBqU5S', 4, 'default.png', 'none', 1, '2022-01-27 00:51:27', NULL, '2022-01-27 00:51:27'),
(38, 'pembeli30', 'pembeli30@gmail.com', '$2y$10$oOO331Ej1FoYYaffneUXve6gFNPTtJD1Y1UadAKMdVhyJ5cIf1EdK', 4, 'default.png', 'none', 1, '2022-01-27 00:51:27', NULL, '2022-01-27 00:51:27'),
(39, 'pembeli31', 'pembeli31@gmail.com', '$2y$10$ZjRU5UaDvsOw6xCJrsHmheK3mEjIaSlFykw4wJmJDFwEDfDqmmyyO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:27', NULL, '2022-01-27 00:51:27'),
(40, 'pembeli32', 'pembeli32@gmail.com', '$2y$10$wPkq2njKNzUKR6xiLpCAcunOqiPlGDrTU7Cf83T15ed1aUd4xsj5K', 4, 'default.png', 'none', 1, '2022-01-27 00:51:27', NULL, '2022-01-27 00:51:27'),
(41, 'pembeli33', 'pembeli33@gmail.com', '$2y$10$Ii4OBOfLVV2TPMN8P9XOeenAlc1CkXj9la0u8xELc8XpYbttnJHYC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:27', NULL, '2022-01-27 00:51:27'),
(42, 'pembeli34', 'pembeli34@gmail.com', '$2y$10$IVmI5DPLGT0WD2FaDpXFd.vocOl.AP.1vFW1mVwb3SDDVf4GJ4VeK', 4, 'default.png', 'none', 1, '2022-01-27 00:51:28', NULL, '2022-01-27 00:51:28'),
(43, 'pembeli35', 'pembeli35@gmail.com', '$2y$10$HJ94tQ8ae8EDNZ.BF81GnefzBDiXzq..SPVQaV07O7USLe23SYu1W', 4, 'default.png', 'none', 1, '2022-01-27 00:51:28', NULL, '2022-01-27 00:51:28'),
(44, 'pembeli36', 'pembeli36@gmail.com', '$2y$10$TLoiHAGckDWmGtpaT2jqqeKJ3H19YE9qjsQLWLbjgQ7yhHMd2mRHW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:28', NULL, '2022-01-27 00:51:28'),
(45, 'pembeli37', 'pembeli37@gmail.com', '$2y$10$3eszKjpmhkJNdwz8tfYkmudCJrZT6Dco3kOa9bnRoP7.TyZ4mL92C', 4, 'default.png', 'none', 1, '2022-01-27 00:51:28', NULL, '2022-01-27 00:51:28'),
(46, 'pembeli38', 'pembeli38@gmail.com', '$2y$10$n8cPYkhV9Pm.Xg38/V4.WuMvyrGBnjeH.VI7.JrNio4FoukG8d4T6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:29', NULL, '2022-01-27 00:51:29'),
(47, 'pembeli39', 'pembeli39@gmail.com', '$2y$10$CMYIwhf4.DOdGoDEj8US.O87kOD/iI7k9XL2o5qG6Fx45J4cKKBVK', 4, 'default.png', 'none', 1, '2022-01-27 00:51:29', NULL, '2022-01-27 00:51:29'),
(48, 'pembeli40', 'pembeli40@gmail.com', '$2y$10$1wZnxLPy1ZYZdKG6Ac3GDetGhCzF6cxwCGVie5RGx7ok49AqqD4Va', 4, 'default.png', 'none', 1, '2022-01-27 00:51:29', NULL, '2022-01-27 00:51:29'),
(49, 'pembeli41', 'pembeli41@gmail.com', '$2y$10$WrVw3HAdr5tui/h2Tfo7ce9G0kwdUZaJfU7JvKvN/EFGb07vXB3Ai', 4, 'default.png', 'none', 1, '2022-01-27 00:51:29', NULL, '2022-01-27 00:51:29'),
(50, 'pembeli42', 'pembeli42@gmail.com', '$2y$10$HVF4D8UYqlzevuqNRi/2Tu/aeizNQnlE4WJ4X81pGFrCqM6.CmJQC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:30', NULL, '2022-01-27 00:51:30'),
(51, 'pembeli43', 'pembeli43@gmail.com', '$2y$10$uhAVrRYbu15QrPIzwMbSru4fqIFtR.V9tXuwp4ZpjJ9DR1wfTEIxC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:30', NULL, '2022-01-27 00:51:30'),
(52, 'pembeli44', 'pembeli44@gmail.com', '$2y$10$Gy6McxMjVwCqvxEMyA4lg.LPn2aVYO.0ljATcA2.n4I5WgEe8k5Ui', 4, 'default.png', 'none', 1, '2022-01-27 00:51:30', NULL, '2022-01-27 00:51:30'),
(53, 'pembeli45', 'pembeli45@gmail.com', '$2y$10$a3./jsUE5li0uyic57gkDesERUuNebSk5ZQjR55EnuTEVMxaoOO2a', 4, 'default.png', 'none', 1, '2022-01-27 00:51:30', NULL, '2022-01-27 00:51:30'),
(54, 'pembeli46', 'pembeli46@gmail.com', '$2y$10$JlNc53Q78zVu3oPmo/LoIOoyerlxAYmBajO6RCh.1ozw4D8N.vLv6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:30', NULL, '2022-01-27 00:51:30'),
(55, 'pembeli47', 'pembeli47@gmail.com', '$2y$10$fNtjsZzX.AYS0.KM85.5De9R6rIqxZtoe.ChyrBu9SYPVyshiYAn6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:31', NULL, '2022-01-27 00:51:31'),
(56, 'pembeli48', 'pembeli48@gmail.com', '$2y$10$3ohrgBHz.z3lR6rrPGlneu7bNFwZ5msloz4nP/HRjutUrqQ8RsTFS', 4, 'default.png', 'none', 1, '2022-01-27 00:51:31', NULL, '2022-01-27 00:51:31'),
(57, 'pembeli49', 'pembeli49@gmail.com', '$2y$10$9fptZi4S75iSCZhda2BkSOzw6X/N3oLF6OaLFasNw8qswErFTDSaS', 4, 'default.png', 'none', 1, '2022-01-27 00:51:31', NULL, '2022-01-27 00:51:31'),
(58, 'pembeli50', 'pembeli50@gmail.com', '$2y$10$MSbLgD0H.irdTI5YpYlJNeBfbiP84jrgZlzIv7o1OaQs86Pj1p.cu', 4, 'default.png', 'none', 1, '2022-01-27 00:51:31', NULL, '2022-01-27 00:51:31'),
(59, 'pembeli51', 'pembeli51@gmail.com', '$2y$10$Jph/2zc2/gXeZU1EmRuiSuxLL05LefB.C4F4TVCoh9D9eySqUhm2y', 4, 'default.png', 'none', 1, '2022-01-27 00:51:31', NULL, '2022-01-27 00:51:31'),
(60, 'pembeli52', 'pembeli52@gmail.com', '$2y$10$wmZC6xIYYj4zEJVmzszGa.NTRrwrzQtOgMuMjPbcgPIeqz0hnIb76', 4, 'default.png', 'none', 1, '2022-01-27 00:51:31', NULL, '2022-01-27 00:51:31'),
(61, 'pembeli53', 'pembeli53@gmail.com', '$2y$10$2l6TrDcjYdwylpJzwBc5q./djMz1Bc3aQh3yTWVgUBFd95x.n83nm', 4, 'default.png', 'none', 1, '2022-01-27 00:51:32', NULL, '2022-01-27 00:51:32'),
(62, 'pembeli54', 'pembeli54@gmail.com', '$2y$10$QYR1tBPe7t7TwF.Oqg6gUe5A/ltgZj9yvM6.CyFUTSN.oyWdVYUh6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:32', NULL, '2022-01-27 00:51:32'),
(63, 'pembeli55', 'pembeli55@gmail.com', '$2y$10$DDf1dzuQzMIhLtnxZrWio.4oMw8u8XZg8LGOOLa7fPTn7iS5ttcKO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:32', NULL, '2022-01-27 00:51:32'),
(64, 'pembeli56', 'pembeli56@gmail.com', '$2y$10$2S6tQ6qWSl4qmwQXjp8Gie6jygO40wNDpGoCMCDxNmtLvmj2jOe/.', 4, 'default.png', 'none', 1, '2022-01-27 00:51:32', NULL, '2022-01-27 00:51:32'),
(65, 'pembeli57', 'pembeli57@gmail.com', '$2y$10$GxwNL3sRUkvYC.aaWgXMt.ONH4NxBWTyfKOlh3ZaQjxry0BoJwoBO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:32', NULL, '2022-01-27 00:51:32'),
(66, 'pembeli58', 'pembeli58@gmail.com', '$2y$10$0qE229MYkKEJctQgBiPvq.ud5QHM6Yl/92w.EDarSjnGzB4Zx7SfS', 4, 'default.png', 'none', 1, '2022-01-27 00:51:32', NULL, '2022-01-27 00:51:32'),
(67, 'pembeli59', 'pembeli59@gmail.com', '$2y$10$mDfNAg7W1BOAduXEPOcj0.w2M/VyQCGr/cuXTnE5fcfu08UTxaVvC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:32', NULL, '2022-01-27 00:51:32'),
(68, 'pembeli60', 'pembeli60@gmail.com', '$2y$10$nOh3qBevko01c7LKIVmJA.Q1.mY8rMG8SdEtxyuT4c/i4rPWUh6tW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:32', NULL, '2022-01-27 00:51:32'),
(69, 'pembeli61', 'pembeli61@gmail.com', '$2y$10$Od6ziKnAin7Gz6LOLqEPx.5Km8AurfGb5c.9xDHpnwtMR34aU25iK', 4, 'default.png', 'none', 1, '2022-01-27 00:51:33', NULL, '2022-01-27 00:51:33'),
(70, 'pembeli62', 'pembeli62@gmail.com', '$2y$10$Gl/droStEX9K4ybmZMFCqOsvcrZerxFSge04bfHW4.nqHPOTXgYO6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:33', NULL, '2022-01-27 00:51:33'),
(71, 'pembeli63', 'pembeli63@gmail.com', '$2y$10$74YHSmjt959l4xp1Ti9nMec5/pamC9Dr6sCxdwDAYF.ynDHqqOAMi', 4, 'default.png', 'none', 1, '2022-01-27 00:51:33', NULL, '2022-01-27 00:51:33'),
(72, 'pembeli64', 'pembeli64@gmail.com', '$2y$10$do0g2fYiY3psUdKrW2We3O3/K56n0.hETTrXM4vo3aesEF7ppaeha', 4, 'default.png', 'none', 1, '2022-01-27 00:51:33', NULL, '2022-01-27 00:51:33'),
(73, 'pembeli65', 'pembeli65@gmail.com', '$2y$10$87.BKfgXRX0hUyBVx2ycO.WAVyCivXptym0ZNMYcqjhSx.BUu99gq', 4, 'default.png', 'none', 1, '2022-01-27 00:51:33', NULL, '2022-01-27 00:51:33'),
(74, 'pembeli66', 'pembeli66@gmail.com', '$2y$10$OwR5U7sTRz3fkbA7wb5XJ.FZ2OwinWvuOorb7kNfPG8IAt7i/mYgW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:33', NULL, '2022-01-27 00:51:33'),
(75, 'pembeli67', 'pembeli67@gmail.com', '$2y$10$W5q1NnY1oeF2B5NSAXdreeZ3BlnwASIqNQVNfYDkjGWqHj/ilW72q', 4, 'default.png', 'none', 1, '2022-01-27 00:51:34', NULL, '2022-01-27 00:51:34'),
(76, 'pembeli68', 'pembeli68@gmail.com', '$2y$10$gXWDj14BA6Ex/q6myxlIAevrcgeqz6FZJ9PaqEzx444MgqqPv/NIa', 4, 'default.png', 'none', 1, '2022-01-27 00:51:34', NULL, '2022-01-27 00:51:34'),
(77, 'pembeli69', 'pembeli69@gmail.com', '$2y$10$VXxYguAphveKB5WNyokpbuDuEyMkm9hiYDq21AzgySieVjADVd1CW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:34', NULL, '2022-01-27 00:51:34'),
(78, 'pembeli70', 'pembeli70@gmail.com', '$2y$10$z2r.HnXdpgw/W1s9AW6QjO9n2Hb524LY0mbY7UyxxmFaxs029XjG2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:34', NULL, '2022-01-27 00:51:34'),
(79, 'pembeli71', 'pembeli71@gmail.com', '$2y$10$9mVSuYsHLVs9Og9.bNNRfe7V7FVn9zTWaofNCIiyBnoqGfyC/Saiq', 4, 'default.png', 'none', 1, '2022-01-27 00:51:34', NULL, '2022-01-27 00:51:34'),
(80, 'pembeli72', 'pembeli72@gmail.com', '$2y$10$UhIQGupOn/2kZhS8XK1c4OftQhgfWpDeZ6sxH5yILDpHFfcB/wX2q', 4, 'default.png', 'none', 1, '2022-01-27 00:51:34', NULL, '2022-01-27 00:51:34'),
(81, 'pembeli73', 'pembeli73@gmail.com', '$2y$10$8Iz4iuq1jUtb3qkc5IpTWeTNf1ffmtAtYHgSV03VEVRKSCsCEdmaa', 4, 'default.png', 'none', 1, '2022-01-27 00:51:35', NULL, '2022-01-27 00:51:35'),
(82, 'pembeli74', 'pembeli74@gmail.com', '$2y$10$AfNTOnp4vxSdzNxVLERTcu/D5Y2kiyGj/4I9pc6SOGXW3YTgPzApe', 4, 'default.png', 'none', 1, '2022-01-27 00:51:35', NULL, '2022-01-27 00:51:35'),
(83, 'pembeli75', 'pembeli75@gmail.com', '$2y$10$iIlzVitrLRKeBrDMaBm5aeFyVP26dwPVR5pmOoqXTYZSIDfxrvjfq', 4, 'default.png', 'none', 1, '2022-01-27 00:51:35', NULL, '2022-01-27 00:51:35'),
(84, 'pembeli76', 'pembeli76@gmail.com', '$2y$10$cMw/gGp5ELle/OakpJBYzOdgiY9rd7HFyvc1Eg6JFKA1XPeqa/4C6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:35', NULL, '2022-01-27 00:51:35'),
(85, 'pembeli77', 'pembeli77@gmail.com', '$2y$10$j99OB0Rj6E46hen7.B37vusENCRCsjZLiBD62ab27eFjr5vRVkl32', 4, 'default.png', 'none', 1, '2022-01-27 00:51:35', NULL, '2022-01-27 00:51:35'),
(86, 'pembeli78', 'pembeli78@gmail.com', '$2y$10$rj.RAilASYZS5ELDeGkvte4bd95xlBLkJROfWqlWCNB3Cqae4yppu', 4, 'default.png', 'none', 1, '2022-01-27 00:51:35', NULL, '2022-01-27 00:51:35'),
(87, 'pembeli79', 'pembeli79@gmail.com', '$2y$10$mun5Ad9vfDncg/kqXPOXBe1/NZ4yFl4ZMhQ4/eRRW0yAp3MktDSDa', 4, 'default.png', 'none', 1, '2022-01-27 00:51:36', NULL, '2022-01-27 00:51:36'),
(88, 'pembeli80', 'pembeli80@gmail.com', '$2y$10$dZ5OuDrtthB/fIMehxO4GujG9E0y0ZP9ctMqF9O51YYOpjxGj1aFS', 4, 'default.png', 'none', 1, '2022-01-27 00:51:36', NULL, '2022-01-27 00:51:36'),
(89, 'pembeli81', 'pembeli81@gmail.com', '$2y$10$NzGcSGl3z2Qv/wnYbITZ/OYIBxxtdRzmrcKPOW/QCUrTHHVkbSPnW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:36', NULL, '2022-01-27 00:51:36'),
(90, 'pembeli82', 'pembeli82@gmail.com', '$2y$10$Azu9TKGy6fuolmmmoBWUg.wn1sWijdWEVhCOa4ODReGXVyDnai2Ie', 4, 'default.png', 'none', 1, '2022-01-27 00:51:36', NULL, '2022-01-27 00:51:36'),
(91, 'pembeli83', 'pembeli83@gmail.com', '$2y$10$JQx6sVtxivQtQB9vxRPmMOIcs.yamnR2X5smWrgrBT2mlJwGff1n2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:36', NULL, '2022-01-27 00:51:36'),
(92, 'pembeli84', 'pembeli84@gmail.com', '$2y$10$Isu0jHVt2VGLX1PE8.uZ0Ob/ZUve0uy29Cw5OwyBW4TKx44eM6zk.', 4, 'default.png', 'none', 1, '2022-01-27 00:51:36', NULL, '2022-01-27 00:51:36'),
(93, 'pembeli85', 'pembeli85@gmail.com', '$2y$10$QlAw18Tqvry/9H6dz4adEOm6DtXRIw.s79FwyS13AnhfEneCUOdfW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:37', NULL, '2022-01-27 00:51:37'),
(94, 'pembeli86', 'pembeli86@gmail.com', '$2y$10$cWPHaUEXiFXjKqmnheb...QAE0Lx7y.cjJp9M4jzxWcF3XOiUwQd.', 4, 'default.png', 'none', 1, '2022-01-27 00:51:37', NULL, '2022-01-27 00:51:37'),
(95, 'pembeli87', 'pembeli87@gmail.com', '$2y$10$5dKcc6DYLj/jULKtE0fAzewt74.19YUGB5Z9rkhe9U48ZS5lPu7lu', 4, 'default.png', 'none', 1, '2022-01-27 00:51:37', NULL, '2022-01-27 00:51:37'),
(96, 'pembeli88', 'pembeli88@gmail.com', '$2y$10$chw0fzKNijPc/4GYZ36MSubxf6rGEDver7RbdPmE7gJ2GHYKp1azC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:37', NULL, '2022-01-27 00:51:37'),
(97, 'pembeli89', 'pembeli89@gmail.com', '$2y$10$zCCOhli8vn6oil4hzssWreuMHSujYrNyEc5zuAbpYqTYHsDoNPHNW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:37', NULL, '2022-01-27 00:51:37'),
(98, 'pembeli90', 'pembeli90@gmail.com', '$2y$10$oSN8BQnuP/K9quVU1Bynz.3kd0Iu/5SRzNYd0gUbM5Q4fR/ju.8uq', 4, 'default.png', 'none', 1, '2022-01-27 00:51:38', NULL, '2022-01-27 00:51:38'),
(99, 'pembeli91', 'pembeli91@gmail.com', '$2y$10$tDdI1EpmMXdef/EZDa77R.Q2VPYPCc6CU4S7z8h2eOMiTYceNSd3W', 4, 'default.png', 'none', 1, '2022-01-27 00:51:38', NULL, '2022-01-27 00:51:38'),
(100, 'pembeli92', 'pembeli92@gmail.com', '$2y$10$GZBbjxplhb2HQ90NmymivOe2MJwR.ak6Xr8YUKpJac7mJcdzr.3Ha', 4, 'default.png', 'none', 1, '2022-01-27 00:51:38', NULL, '2022-01-27 00:51:38'),
(101, 'pembeli93', 'pembeli93@gmail.com', '$2y$10$FnKu4ng/GU79Jk/hqN.LfeIL9aUQlsknoz2dfGFgFcD9zhJJNEwAS', 4, 'default.png', 'none', 1, '2022-01-27 00:51:38', NULL, '2022-01-27 00:51:38'),
(102, 'pembeli94', 'pembeli94@gmail.com', '$2y$10$Crv1WdlCVXLAE1DM8LZl..GvaLSLZolfA7mTnV0BIIwHx78vDFOS6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:38', NULL, '2022-01-27 00:51:38'),
(103, 'pembeli95', 'pembeli95@gmail.com', '$2y$10$dPbUF824tyXTQuonp9k6KezqJ8LmLYEzLPvDDrHD5PHbxMLxfVp7O', 4, 'default.png', 'none', 1, '2022-01-27 00:51:38', NULL, '2022-01-27 00:51:38'),
(104, 'pembeli96', 'pembeli96@gmail.com', '$2y$10$1mzREGgii3RVxf2S.OaN3u7keiIY0mfJnLGWt3bBTy0n.61/Jni/W', 4, 'default.png', 'none', 1, '2022-01-27 00:51:39', NULL, '2022-01-27 00:51:39'),
(105, 'pembeli97', 'pembeli97@gmail.com', '$2y$10$n94NvGCrRI3U18CE8TXAueIUX9haaPSSsjJQs9Vb9IhPu18xz0nOK', 4, 'default.png', 'none', 1, '2022-01-27 00:51:39', NULL, '2022-01-27 00:51:39'),
(106, 'pembeli98', 'pembeli98@gmail.com', '$2y$10$cyeTAbbHuRrgDMUSsimFCOJ0/J14RVQgQRxiAKCF1UAUfYdfiEmnu', 4, 'default.png', 'none', 1, '2022-01-27 00:51:39', NULL, '2022-01-27 00:51:39'),
(107, 'pembeli99', 'pembeli99@gmail.com', '$2y$10$KmsYF3D7YaA8K3yxwDlwKeebw.VJqr1pqaRbfBT5a7R.rIPCNM7QC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:39', NULL, '2022-01-27 00:51:39'),
(108, 'pembeli100', 'pembeli100@gmail.com', '$2y$10$YO4D85s24gjo2DtFsDBXTuTtIW9fH43p/JmBmmIogdHcsExK1oDFm', 4, 'default.png', 'none', 1, '2022-01-27 00:51:39', NULL, '2022-01-27 00:51:39'),
(109, 'pembeli101', 'pembeli101@gmail.com', '$2y$10$Wqb/cjisnFQNbQ7f9ysHGOvaFRXIKogX2dvqqrbthwKbJS82gCnkW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:39', NULL, '2022-01-27 00:51:39'),
(110, 'pembeli102', 'pembeli102@gmail.com', '$2y$10$460AkJsFco1mxHK/X4h7ruw3Waf/YNptsRpObAq0prTcauUiMSr4i', 4, 'default.png', 'none', 1, '2022-01-27 00:51:39', NULL, '2022-01-27 00:51:39'),
(111, 'pembeli103', 'pembeli103@gmail.com', '$2y$10$6NTyo0MuvlOAnTGKVooDKuN6T.nljMISCQJnP3qlao6DVIy.drsKu', 4, 'default.png', 'none', 1, '2022-01-27 00:51:40', NULL, '2022-01-27 00:51:40'),
(112, 'pembeli104', 'pembeli104@gmail.com', '$2y$10$4imL65z54pQvsGXSC3thruBLpXxhV8M82bvf0lsn4eutw3RP4bhae', 4, 'default.png', 'none', 1, '2022-01-27 00:51:40', NULL, '2022-01-27 00:51:40'),
(113, 'pembeli105', 'pembeli105@gmail.com', '$2y$10$kMD7QKxNtFS.xnUGBsXJEevCabsCOo8fhUgrpm56z6wtrC/JUzt7y', 4, 'default.png', 'none', 1, '2022-01-27 00:51:40', NULL, '2022-01-27 00:51:40'),
(114, 'pembeli106', 'pembeli106@gmail.com', '$2y$10$JHBw5TxdvCNjfmw4Gtb18O.5S7AGfZQlDpIwQL7RPCDzSViDHVh0u', 4, 'default.png', 'none', 1, '2022-01-27 00:51:40', NULL, '2022-01-27 00:51:40'),
(115, 'pembeli107', 'pembeli107@gmail.com', '$2y$10$IhtvX6UTgCFPmiKMO30qleA5fljPZMGP4bVFRuhzG2JiacR03NSRO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:40', NULL, '2022-01-27 00:51:40'),
(116, 'pembeli108', 'pembeli108@gmail.com', '$2y$10$OOpRlJc5AmDDKmzT8cKDLej5RfhbGdNxroGkiaqnjsB33zyPdXJHC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:41', NULL, '2022-01-27 00:51:41'),
(117, 'pembeli109', 'pembeli109@gmail.com', '$2y$10$DhrfILIwgybkJqZQM..W..8/RtUcI2uLJgoBrevHzXrD2aefnME7C', 4, 'default.png', 'none', 1, '2022-01-27 00:51:41', NULL, '2022-01-27 00:51:41'),
(118, 'pembeli110', 'pembeli110@gmail.com', '$2y$10$SkNx/8D4vfEMq.4oYnFsGeoIZGE9d84F9ua5YxFKjCBPBPM5AFQlC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:41', NULL, '2022-01-27 00:51:41'),
(119, 'pembeli111', 'pembeli111@gmail.com', '$2y$10$9UqUbR7KdHg/x4nGx4epEO6DlxtQ9wrmX2BzdCe/fcLp0Tek0/VhC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:41', NULL, '2022-01-27 00:51:41'),
(120, 'pembeli112', 'pembeli112@gmail.com', '$2y$10$QLSdkRdMnGiA8FPYs.OlAe3Oq33ehDC4B528hHbGl15qQ25hu0jpi', 4, 'default.png', 'none', 1, '2022-01-27 00:51:41', NULL, '2022-01-27 00:51:41'),
(121, 'pembeli113', 'pembeli113@gmail.com', '$2y$10$5B/o3MPxQnjYwFU3GdrkQuEHoyFMx0NfbllA1fjdSNv8e1e/Pm3aC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:42', NULL, '2022-01-27 00:51:42'),
(122, 'pembeli114', 'pembeli114@gmail.com', '$2y$10$KLfZshY3n1tGpeQ9FP2gPOs1kGZkGJEsldo0s9V6.qyOD9A9xvCUO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:42', NULL, '2022-01-27 00:51:42'),
(123, 'pembeli115', 'pembeli115@gmail.com', '$2y$10$Uc9lVPXWA9k7uI5ePzBMme1V/U2c/tLba937XyPE1VOS2s0xX2yje', 4, 'default.png', 'none', 1, '2022-01-27 00:51:42', NULL, '2022-01-27 00:51:42'),
(124, 'pembeli116', 'pembeli116@gmail.com', '$2y$10$qkoyp0upz.g2uBTZDepxQeGZv1I1REPDnnBvBfuji/Y3QhH7mIV5m', 4, 'default.png', 'none', 1, '2022-01-27 00:51:42', NULL, '2022-01-27 00:51:42'),
(125, 'pembeli117', 'pembeli117@gmail.com', '$2y$10$7PYGsPBX0Ml2pn85onX3uubBqiAuNA.zxRdNyALUeIjDVKvKllViK', 4, 'default.png', 'none', 1, '2022-01-27 00:51:42', NULL, '2022-01-27 00:51:42'),
(126, 'pembeli118', 'pembeli118@gmail.com', '$2y$10$W.ztIijVJk7D6defkTKQk.xYKmg3TNxqtOUHsfBS/DLTc5qLeF6su', 4, 'default.png', 'none', 1, '2022-01-27 00:51:43', NULL, '2022-01-27 00:51:43'),
(127, 'pembeli119', 'pembeli119@gmail.com', '$2y$10$zQLcxa81iLJEuLYPHexhgejrXsWDdCMWs5rmvquuTe4CbdsZhHZV.', 4, 'default.png', 'none', 1, '2022-01-27 00:51:43', NULL, '2022-01-27 00:51:43'),
(128, 'pembeli120', 'pembeli120@gmail.com', '$2y$10$KKeTw4OImXNKNeeA0mZYnOliWpjqqYlYP.m6mV9T35P2fazRe2mrW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:43', NULL, '2022-01-27 00:51:43'),
(129, 'pembeli121', 'pembeli121@gmail.com', '$2y$10$kULS9ZPbXYtbdlOqbavhY.GDPJUwgpaJRm34b5o03rxUvpzie2STO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:43', NULL, '2022-01-27 00:51:43'),
(130, 'pembeli122', 'pembeli122@gmail.com', '$2y$10$lCcklNTasBMThwcDEpb3rOWCuJDjvcsZefgZYEMtruN.tDs.zIjHO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:43', NULL, '2022-01-27 00:51:43'),
(131, 'pembeli123', 'pembeli123@gmail.com', '$2y$10$1gSXyiW.tV1o66cVWl5xIeFdi1NgoJO1iLFZj92AyrbX4Xynbp7C6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:43', NULL, '2022-01-27 00:51:43'),
(132, 'pembeli124', 'pembeli124@gmail.com', '$2y$10$dYSEoZ93/NNgKdJNzoDcsOlUYkrRh2kAXh5w0Plet9axTJlpkqIcW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:44', NULL, '2022-01-27 00:51:44'),
(133, 'pembeli125', 'pembeli125@gmail.com', '$2y$10$vJXLB5PK9/VV4HckXKjtdOIB8P2ld0S1ybe703p1ralxk8wkKy7uW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:44', NULL, '2022-01-27 00:51:44'),
(134, 'pembeli126', 'pembeli126@gmail.com', '$2y$10$n8JYgyqQ8x8PEpOiFu8rbe.xyVLfFPPyFwsHxbWSOKHpv6Zd/6oJS', 4, 'default.png', 'none', 1, '2022-01-27 00:51:44', NULL, '2022-01-27 00:51:44'),
(135, 'pembeli127', 'pembeli127@gmail.com', '$2y$10$62Lg.6uCawbOk7RyI9/sd.me0h9ti9DzWCUtvmWAEZZgcpf4fZG5S', 4, 'default.png', 'none', 1, '2022-01-27 00:51:44', NULL, '2022-01-27 00:51:44'),
(136, 'pembeli128', 'pembeli128@gmail.com', '$2y$10$cuek7hFW1/Hexy0wfOFCYeuROx4xLTTc7S4S.53QmGTd8mTaQx5Ve', 4, 'default.png', 'none', 1, '2022-01-27 00:51:44', NULL, '2022-01-27 00:51:44'),
(137, 'pembeli129', 'pembeli129@gmail.com', '$2y$10$v8bI4Vb96Sl/Qpabbw9zKe00Ym0IuxOuzbG1xaxBRqzc3QPolmDSK', 4, 'default.png', 'none', 1, '2022-01-27 00:51:45', NULL, '2022-01-27 00:51:45'),
(138, 'pembeli130', 'pembeli130@gmail.com', '$2y$10$8knKxyFhDJd6bzx0pGcwDeXG1NadiCrRDnxDK.d7/jaMmFhaIxj42', 4, 'default.png', 'none', 1, '2022-01-27 00:51:45', NULL, '2022-01-27 00:51:45'),
(139, 'pembeli131', 'pembeli131@gmail.com', '$2y$10$ZkU9f.igKl3HV0nY7PWJQuO8FBLFMGUr32LMZE0Y49TtuU0cRpjyO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:45', NULL, '2022-01-27 00:51:45'),
(140, 'pembeli132', 'pembeli132@gmail.com', '$2y$10$tDxJXIATp3yH0lvXb/WT2O6UpiAUQC0a0vd3Z2WZkKjKfX4R8Ef6S', 4, 'default.png', 'none', 1, '2022-01-27 00:51:45', NULL, '2022-01-27 00:51:45'),
(141, 'pembeli133', 'pembeli133@gmail.com', '$2y$10$A5bIuj/clGhZb7RRTk4UnubDQtSqL3CvJoKrSjGKbsEvQAEqs8Xu2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:45', NULL, '2022-01-27 00:51:45'),
(142, 'pembeli134', 'pembeli134@gmail.com', '$2y$10$XKbizXcWUhIN9awrHKGZluaflajpTJDN9Ziw7mZTFHonqHWmAGXFa', 4, 'default.png', 'none', 1, '2022-01-27 00:51:45', NULL, '2022-01-27 00:51:45'),
(143, 'pembeli135', 'pembeli135@gmail.com', '$2y$10$z4fg/A.jLVkSrXCRuB0D6eS5PEhb6j1Lu72hUggM/Uny8wAFbxdMi', 4, 'default.png', 'none', 1, '2022-01-27 00:51:46', NULL, '2022-01-27 00:51:46'),
(144, 'pembeli136', 'pembeli136@gmail.com', '$2y$10$j/zRXk8FEPrG2FffoS2iGeIrnQAJkW8L/s0z1AxXhi4289Waf3il.', 4, 'default.png', 'none', 1, '2022-01-27 00:51:46', NULL, '2022-01-27 00:51:46'),
(145, 'pembeli137', 'pembeli137@gmail.com', '$2y$10$VQhBUlaUoIUjsP960DYsgOv86JV08o1/8XXdAUrLpR8zxSpekBrrW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:46', NULL, '2022-01-27 00:51:46'),
(146, 'pembeli138', 'pembeli138@gmail.com', '$2y$10$IWvGqlMHXhM72y8d0/0xU.nOQ5lfkQRw2iDDPzuq30h4Q/GkPGTKm', 4, 'default.png', 'none', 1, '2022-01-27 00:51:46', NULL, '2022-01-27 00:51:46'),
(147, 'pembeli139', 'pembeli139@gmail.com', '$2y$10$uxCCK6AA608vcWttTV.KyuFDv3E9hKUNSmvfhE09Ukw2TKfxuniTW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:46', NULL, '2022-01-27 00:51:46'),
(148, 'pembeli140', 'pembeli140@gmail.com', '$2y$10$xxcq9Ath/TaSrBYWQKx9IeaUKuzwacyHS8Ejoy1nU0aWO4hucq336', 4, 'default.png', 'none', 1, '2022-01-27 00:51:46', NULL, '2022-01-27 00:51:46'),
(149, 'pembeli141', 'pembeli141@gmail.com', '$2y$10$YJo8zYrXVpFgZZ2tCgML1.R3phij2ERg3b2ltOQAwGu3/Ai9NzotS', 4, 'default.png', 'none', 1, '2022-01-27 00:51:46', NULL, '2022-01-27 00:51:46'),
(150, 'pembeli142', 'pembeli142@gmail.com', '$2y$10$jEdd8T47cu2Hm6cdZexUveeTvbf0./Scu.7vfffxtpDxmiNqtznFG', 4, 'default.png', 'none', 1, '2022-01-27 00:51:46', NULL, '2022-01-27 00:51:46'),
(151, 'pembeli143', 'pembeli143@gmail.com', '$2y$10$CJXLUggSRNzZCO2Mj1e57uq/523SROv0RXHX34LJl8BLaJG7J0z2C', 4, 'default.png', 'none', 1, '2022-01-27 00:51:47', NULL, '2022-01-27 00:51:47'),
(152, 'pembeli144', 'pembeli144@gmail.com', '$2y$10$Lel9Vo1jsnvRTnebqfhZxulOViBIvECGVKeaYYQfwyEHcY48r71f.', 4, 'default.png', 'none', 1, '2022-01-27 00:51:47', NULL, '2022-01-27 00:51:47'),
(153, 'pembeli145', 'pembeli145@gmail.com', '$2y$10$kocyvJXqIt/yZCDx/oMhwuw.RTyTLlCvUIkVoPwCoutfX7lRZ.UH2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:47', NULL, '2022-01-27 00:51:47'),
(154, 'pembeli146', 'pembeli146@gmail.com', '$2y$10$y0UaLYug4COcltkHI8OB7.wUBtc9l/Uannd2EBaDcWGUw9xvtkzAS', 4, 'default.png', 'none', 1, '2022-01-27 00:51:47', NULL, '2022-01-27 00:51:47'),
(155, 'pembeli147', 'pembeli147@gmail.com', '$2y$10$VaBgAHoS08k8Nx6HB3kh8OiyycnQBO3nrCkg/vn9okKOY0fCqSWsK', 4, 'default.png', 'none', 1, '2022-01-27 00:51:47', NULL, '2022-01-27 00:51:47'),
(156, 'pembeli148', 'pembeli148@gmail.com', '$2y$10$l4SYmRbI2IG/DALGtaMdmejMm0FaBOoX8oItfxGtCKb1uKtyMhqFa', 4, 'default.png', 'none', 1, '2022-01-27 00:51:47', NULL, '2022-01-27 00:51:47'),
(157, 'pembeli149', 'pembeli149@gmail.com', '$2y$10$tDhmhFsl5aezjQIyvKG1Ve2AhCZsv8dVvwXlS.IygAkk0t..u1iVa', 4, 'default.png', 'none', 1, '2022-01-27 00:51:48', NULL, '2022-01-27 00:51:48'),
(158, 'pembeli150', 'pembeli150@gmail.com', '$2y$10$WD6h3eR23cZTYzetBihwhOugChOyhlcbkYmDQGHYxPXSGdiAPqdpe', 4, 'default.png', 'none', 1, '2022-01-27 00:51:48', NULL, '2022-01-27 00:51:48'),
(159, 'pembeli151', 'pembeli151@gmail.com', '$2y$10$NjMURCyFfUNz7TqDF7kYru94dgDxQCKb1mcKGTZ6EJA0cZicPWAfa', 4, 'default.png', 'none', 1, '2022-01-27 00:51:48', NULL, '2022-01-27 00:51:48'),
(160, 'pembeli152', 'pembeli152@gmail.com', '$2y$10$ZlZCQzNvFQJ3buxuim7K..lvIF3w4Kuqsl0kwav5UaOPC/kIu54cG', 4, 'default.png', 'none', 1, '2022-01-27 00:51:48', NULL, '2022-01-27 00:51:48'),
(161, 'pembeli153', 'pembeli153@gmail.com', '$2y$10$Pm0CiS7oh/2BUkUkgmyeo./djKP3nvI91sRD4HtOUtWGkytduz0ie', 4, 'default.png', 'none', 1, '2022-01-27 00:51:48', NULL, '2022-01-27 00:51:48'),
(162, 'pembeli154', 'pembeli154@gmail.com', '$2y$10$0p//5PjL.bz./cz8zFuq0.hrHs9F6UgMDtgzywyUpxQtcAIzjwXYy', 4, 'default.png', 'none', 1, '2022-01-27 00:51:48', NULL, '2022-01-27 00:51:48'),
(163, 'pembeli155', 'pembeli155@gmail.com', '$2y$10$nFq7IZKYB/ycDC8I940ze.Ow8COMRh.U83PGb051pKRJhbuQ5UNaO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:48', NULL, '2022-01-27 00:51:48'),
(164, 'pembeli156', 'pembeli156@gmail.com', '$2y$10$xH.p9JXs1LW9eHBJKRfkWui6XtssCZSBQmyV6vw8/PCGyHkQNszqO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:48', NULL, '2022-01-27 00:51:48'),
(165, 'pembeli157', 'pembeli157@gmail.com', '$2y$10$NqIKPF8hyfk1bdfsaCO63OT6dgt0/W5anszmQ1SH0JDiCqS1wjj8C', 4, 'default.png', 'none', 1, '2022-01-27 00:51:49', NULL, '2022-01-27 00:51:49'),
(166, 'pembeli158', 'pembeli158@gmail.com', '$2y$10$AZMpsUCGHTQMq.s35Ky8ZOumUfY.zPwB0BjDB1hCVXFOnq3kTakU2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:49', NULL, '2022-01-27 00:51:49'),
(167, 'pembeli159', 'pembeli159@gmail.com', '$2y$10$N7bAAsbVbI3AuKZT3.R/OeMK1A.VIKE.tyYxiK/gjvyf41MJIjvoe', 4, 'default.png', 'none', 1, '2022-01-27 00:51:49', NULL, '2022-01-27 00:51:49'),
(168, 'pembeli160', 'pembeli160@gmail.com', '$2y$10$/zbAfLZiSI2mUQx6nBc8TunNsEpLUQUZioW.c6lz..azhSWnxexOm', 4, 'default.png', 'none', 1, '2022-01-27 00:51:49', NULL, '2022-01-27 00:51:49'),
(169, 'pembeli161', 'pembeli161@gmail.com', '$2y$10$zaEyG.yWv9LqyLo0JLL9N.RGAHVwzWI1ePsnEmlnE9kxHsOU0bpfq', 4, 'default.png', 'none', 1, '2022-01-27 00:51:49', NULL, '2022-01-27 00:51:49'),
(170, 'pembeli162', 'pembeli162@gmail.com', '$2y$10$HG975Ag5DyQswonlPmS0i.y06lpsXJkG8CJEHwB0xFke8ba.j00S.', 4, 'default.png', 'none', 1, '2022-01-27 00:51:50', NULL, '2022-01-27 00:51:50'),
(171, 'pembeli163', 'pembeli163@gmail.com', '$2y$10$MQsW6aLMxH.1eiBkmqx0QOu3sHYJ57RZN9L6sr.g0QJawmtZgVzIC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:50', NULL, '2022-01-27 00:51:50'),
(172, 'pembeli164', 'pembeli164@gmail.com', '$2y$10$/impVW2pMoL3CYLIW4son.WiDZHp4sKbzB7okGPUtqobrGvIhtnp.', 4, 'default.png', 'none', 1, '2022-01-27 00:51:50', NULL, '2022-01-27 00:51:50'),
(173, 'pembeli165', 'pembeli165@gmail.com', '$2y$10$NRa6GAgOFbCPrC9uD3rope.EWuHfhYsb5QYb9cYIoKvP/Koxn5ZVe', 4, 'default.png', 'none', 1, '2022-01-27 00:51:50', NULL, '2022-01-27 00:51:50'),
(174, 'pembeli166', 'pembeli166@gmail.com', '$2y$10$jY5TxrttjsDQVI/ymMRwZuQWa5JsXE.bz8FxwdPdVsoq8Ou6OEEty', 4, 'default.png', 'none', 1, '2022-01-27 00:51:50', NULL, '2022-01-27 00:51:50'),
(175, 'pembeli167', 'pembeli167@gmail.com', '$2y$10$toyt8ClQgbtZ2G8FNPLBveleN.Akl8V.urVR3ynaZwRBKho9Tabsu', 4, 'default.png', 'none', 1, '2022-01-27 00:51:50', NULL, '2022-01-27 00:51:50'),
(176, 'pembeli168', 'pembeli168@gmail.com', '$2y$10$Y/4m6xxdOgDuU42Qh/AK8esoWCVsnWPgPfsyee54jHaYcQMIHpT/e', 4, 'default.png', 'none', 1, '2022-01-27 00:51:50', NULL, '2022-01-27 00:51:50'),
(177, 'pembeli169', 'pembeli169@gmail.com', '$2y$10$jtv4OQ6BEer.wHw72tA9DO.MR9xUGZxIlxyrph7u0aSS0etA9Z8TW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:51', NULL, '2022-01-27 00:51:51'),
(178, 'pembeli170', 'pembeli170@gmail.com', '$2y$10$5fTPid4DD.PDGZtz0Sg/jexJzbN4vnd8K464ti/yqOj7CZJs3s9km', 4, 'default.png', 'none', 1, '2022-01-27 00:51:51', NULL, '2022-01-27 00:51:51'),
(179, 'pembeli171', 'pembeli171@gmail.com', '$2y$10$dVqFeNWSINnGjmNlAFrzaOlmLsr/ofe.wljB20KYF2GhEWq9A/A6i', 4, 'default.png', 'none', 1, '2022-01-27 00:51:51', NULL, '2022-01-27 00:51:51'),
(180, 'pembeli172', 'pembeli172@gmail.com', '$2y$10$UpPGyL95j4aqt.WWSWYNde/uOSZ0kGDSOSOO.xD5Yus6YjR.LF9Si', 4, 'default.png', 'none', 1, '2022-01-27 00:51:51', NULL, '2022-01-27 00:51:51'),
(181, 'pembeli173', 'pembeli173@gmail.com', '$2y$10$L2mIok6VZSmLG24Rf4o9WeYocF9xY0nnHukwejZbazl4pze7es/JS', 4, 'default.png', 'none', 1, '2022-01-27 00:51:51', NULL, '2022-01-27 00:51:51'),
(182, 'pembeli174', 'pembeli174@gmail.com', '$2y$10$8UBpukVZvU7tcYMsx5q/DugqJmgDB2wAJ6shN96RqSy.a6J7InukK', 4, 'default.png', 'none', 1, '2022-01-27 00:51:51', NULL, '2022-01-27 00:51:51'),
(183, 'pembeli175', 'pembeli175@gmail.com', '$2y$10$FsZtZpRKB6D7T6m7m0JVNe7HKoDEbwI0rJgAwDibnfwGeqEhsqHZC', 4, 'default.png', 'none', 1, '2022-01-27 00:51:51', NULL, '2022-01-27 00:51:51'),
(184, 'pembeli176', 'pembeli176@gmail.com', '$2y$10$otwgL8JYcSnPZvgNb9Nsue9bCJrnHkD.i4.qHRJRAdkJqK9Zqia/2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:52', NULL, '2022-01-27 00:51:52'),
(185, 'pembeli177', 'pembeli177@gmail.com', '$2y$10$IzwvJLdkk/qY/futnRqeY.iMTbDqUoyjI7h0lbka5VTYNHiiTCVUK', 4, 'default.png', 'none', 1, '2022-01-27 00:51:52', NULL, '2022-01-27 00:51:52'),
(186, 'pembeli178', 'pembeli178@gmail.com', '$2y$10$75vMtOFJmWmYodKHonnp8OOCJcp9hJq1cAe9P8.hecUGvy0MPfxK6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:52', NULL, '2022-01-27 00:51:52'),
(187, 'pembeli179', 'pembeli179@gmail.com', '$2y$10$5rHc53BQChqh6/EMa2Uv6.KEy2Bf8x5.Npmot/oeO5Fld4yKFWNVW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:52', NULL, '2022-01-27 00:51:52'),
(188, 'pembeli180', 'pembeli180@gmail.com', '$2y$10$.x/10tm/g0hsV4nU1eOw0OfwTDAl0sszq/pffVC1o81fUh.ANItJO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:52', NULL, '2022-01-27 00:51:52'),
(189, 'pembeli181', 'pembeli181@gmail.com', '$2y$10$Ad7iYrWW2wNYtGTRFtY40OXeSnZ3HYnjIS4eBRRDYAiwxmnuKUnB.', 4, 'default.png', 'none', 1, '2022-01-27 00:51:52', NULL, '2022-01-27 00:51:52'),
(190, 'pembeli182', 'pembeli182@gmail.com', '$2y$10$p27NXZX5OXGkJuwNmdpU2eZthc9jWdle8k.T8BvRgP2YCCMmeBv3y', 4, 'default.png', 'none', 1, '2022-01-27 00:51:52', NULL, '2022-01-27 00:51:52'),
(191, 'pembeli183', 'pembeli183@gmail.com', '$2y$10$6qYpP11wsejwrGKC0itIB.n1kcOWS2Qk6kPdnezjKt97uL7cPVld2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:52', NULL, '2022-01-27 00:51:52'),
(192, 'pembeli184', 'pembeli184@gmail.com', '$2y$10$N77zE9XGOHN39IOSJZUpT.NVUKtV9BBx4QtWn0CQW0UegxDVIWaGO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:53', NULL, '2022-01-27 00:51:53'),
(193, 'pembeli185', 'pembeli185@gmail.com', '$2y$10$AItoGwKi51eZF93q1o2L2.M1sr/YjiEnwxsOrZXeTrd84UoWYOISS', 4, 'default.png', 'none', 1, '2022-01-27 00:51:53', NULL, '2022-01-27 00:51:53'),
(194, 'pembeli186', 'pembeli186@gmail.com', '$2y$10$sMCy5vB/mxpeq5/G.EiRo.VoR5UCjKM5//4ccIIZcrQQ50gpMuJRe', 4, 'default.png', 'none', 1, '2022-01-27 00:51:53', NULL, '2022-01-27 00:51:53'),
(195, 'pembeli187', 'pembeli187@gmail.com', '$2y$10$2bbVphRdjbM.ex.XgAy.0OSf8ZdY0ipMFR7LlB8nwL6Q3AQZbkFpu', 4, 'default.png', 'none', 1, '2022-01-27 00:51:53', NULL, '2022-01-27 00:51:53'),
(196, 'pembeli188', 'pembeli188@gmail.com', '$2y$10$IU9fZeArQs3oBv5ZQWR//uoUr7b6LfnrWVEQBdtblGaIqaQEMK1uO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:53', NULL, '2022-01-27 00:51:53'),
(197, 'pembeli189', 'pembeli189@gmail.com', '$2y$10$gt6rzP7b33tL2.FM95CDLuUi/MKpnjj5mrLtAY2OBzgC/h4vc0JOu', 4, 'default.png', 'none', 1, '2022-01-27 00:51:53', NULL, '2022-01-27 00:51:53'),
(198, 'pembeli190', 'pembeli190@gmail.com', '$2y$10$J2xxdUbUpb8ZtyLc3iic.eVm9obUZ3GUI965uVInJ16PJ/qByEqya', 4, 'default.png', 'none', 1, '2022-01-27 00:51:54', NULL, '2022-01-27 00:51:54'),
(199, 'pembeli191', 'pembeli191@gmail.com', '$2y$10$bsKcugzqNRx/0i6Yscec2uvJZRncf4KwXJXLgCv1ttW.3U/Y/k.4i', 4, 'default.png', 'none', 1, '2022-01-27 00:51:54', NULL, '2022-01-27 00:51:54'),
(200, 'pembeli192', 'pembeli192@gmail.com', '$2y$10$HR3TdUJqmk5M6yPWbMWT9.npWVS/L57tXI7y1V6hi5Mb6ElOF3npe', 4, 'default.png', 'none', 1, '2022-01-27 00:51:54', NULL, '2022-01-27 00:51:54'),
(201, 'pembeli193', 'pembeli193@gmail.com', '$2y$10$QRXwVrNqM.j58WEFEsInpOl8z2XU7aFufufEZ/vNYlbhBNouCInPa', 4, 'default.png', 'none', 1, '2022-01-27 00:51:54', NULL, '2022-01-27 00:51:54'),
(202, 'pembeli194', 'pembeli194@gmail.com', '$2y$10$h3aQvzzNQptcP1u5WLKJ1.EGSYLYrKZRt6AbITmSOOXuFhAoT44W2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:54', NULL, '2022-01-27 00:51:54'),
(203, 'pembeli195', 'pembeli195@gmail.com', '$2y$10$X.48mS27G8DE/KoNIOd5ZeiCefWGOQFkA5sy2TTKfuKP/HYfkINSa', 4, 'default.png', 'none', 1, '2022-01-27 00:51:54', NULL, '2022-01-27 00:51:54'),
(204, 'pembeli196', 'pembeli196@gmail.com', '$2y$10$1K6RKnPwPP7bXGcvsrETNuJyalQ7h2TTJD/LQfwzNUMYVVUzgo7s6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:54', NULL, '2022-01-27 00:51:54'),
(205, 'pembeli197', 'pembeli197@gmail.com', '$2y$10$yNOraZbIuln3rgmbNw/SKOx1PR5GukvuORxFwXEsSXfX3lpvAeAw2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:55', NULL, '2022-01-27 00:51:55'),
(206, 'pembeli198', 'pembeli198@gmail.com', '$2y$10$v4pIsrbajKP5tZaZTGzm/.fRa2Oo7gCxnw9ojn7xVFsp4zrwwI04i', 4, 'default.png', 'none', 1, '2022-01-27 00:51:55', NULL, '2022-01-27 00:51:55'),
(207, 'pembeli199', 'pembeli199@gmail.com', '$2y$10$XdUsEDZM/hdtqwzf3wrSf.27gDrZt.MPRi.Hi1higWJfimmnIhYNu', 4, 'default.png', 'none', 1, '2022-01-27 00:51:55', NULL, '2022-01-27 00:51:55'),
(208, 'pembeli200', 'pembeli200@gmail.com', '$2y$10$ONUj5B.n8EhNcafp6YnHj.FztPliZzk5xIkaF7C/JzymT8sgxOrrG', 4, 'default.png', 'none', 1, '2022-01-27 00:51:55', NULL, '2022-01-27 00:51:55'),
(209, 'pembeli201', 'pembeli201@gmail.com', '$2y$10$evZekz5OsfAPkX//3H/nx.VHYjSJMc4B4sXRPxERIIW5VWu0rFDR6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:55', NULL, '2022-01-27 00:51:55'),
(210, 'pembeli202', 'pembeli202@gmail.com', '$2y$10$S3KjcvQ8iVpeCZALYUBPAeZaPRdrBOdJZgD.Xdv5J3z/KdjvBG5eu', 4, 'default.png', 'none', 1, '2022-01-27 00:51:55', NULL, '2022-01-27 00:51:55'),
(211, 'pembeli203', 'pembeli203@gmail.com', '$2y$10$.h3CrXbCBxRktrafYfgKLe.3m3S2uGyzThUAqvmow1l3WN/yoYo4e', 4, 'default.png', 'none', 1, '2022-01-27 00:51:56', NULL, '2022-01-27 00:51:56'),
(212, 'pembeli204', 'pembeli204@gmail.com', '$2y$10$uHAJYCwo0X5Ui0FONnRryewadW3438tPXHlhdQntof/NvQb5kCE3i', 4, 'default.png', 'none', 1, '2022-01-27 00:51:56', NULL, '2022-01-27 00:51:56'),
(213, 'pembeli205', 'pembeli205@gmail.com', '$2y$10$vnBMiy35hVZgFSs9H7eNf.xQQYEvgaFu0OyiCkMCmYiF9wNGWYLi6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:56', NULL, '2022-01-27 00:51:56'),
(214, 'pembeli206', 'pembeli206@gmail.com', '$2y$10$/hSdWeCYARJ.Wjrro3kLuu72HQ.YyPKMVt74MWbbAWCAwHzYLHly2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:56', NULL, '2022-01-27 00:51:56'),
(215, 'pembeli207', 'pembeli207@gmail.com', '$2y$10$K7ZkkYfBN7wFTmr4jKwbwuRq3L8hd4MBAf7X7UlmJW4LXeyuZ7yC.', 4, 'default.png', 'none', 1, '2022-01-27 00:51:56', NULL, '2022-01-27 00:51:56'),
(216, 'pembeli208', 'pembeli208@gmail.com', '$2y$10$039XMIvV8v/w73P.pckqHOytMECN/DJ6KeU7QEzdutX4A/W8K93Qa', 4, 'default.png', 'none', 1, '2022-01-27 00:51:56', NULL, '2022-01-27 00:51:56'),
(217, 'pembeli209', 'pembeli209@gmail.com', '$2y$10$o5ikhwJpYqgIEb2bffpZYuLFTpxC01EDZbKpt10k/DbesHUwiSOL6', 4, 'default.png', 'none', 1, '2022-01-27 00:51:56', NULL, '2022-01-27 00:51:56'),
(218, 'pembeli210', 'pembeli210@gmail.com', '$2y$10$j878cz6m3uw5QJw8WQDkcuUbzjv08Eh0R7siA8XugWdSeeqscz6cO', 4, 'default.png', 'none', 1, '2022-01-27 00:51:57', NULL, '2022-01-27 00:51:57'),
(219, 'pembeli211', 'pembeli211@gmail.com', '$2y$10$KEg.15UP0gAfXXDEhkXzD.DE5YDklIZUyYcCMjpboaLPBvNcGZ3vm', 4, 'default.png', 'none', 1, '2022-01-27 00:51:57', NULL, '2022-01-27 00:51:57'),
(220, 'pembeli212', 'pembeli212@gmail.com', '$2y$10$YuxlTlxeLYMgyTJGjtChgODfNmM00Qfp9RZZCRmjY.rHmeIE7EaJ.', 4, 'default.png', 'none', 1, '2022-01-27 00:51:57', NULL, '2022-01-27 00:51:57'),
(221, 'pembeli213', 'pembeli213@gmail.com', '$2y$10$qRUJJZfBoU7lD8vXXJhSkerkdBSROe7WZgOJEIIknkOpDcTrqmjk2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:57', NULL, '2022-01-27 00:51:57'),
(222, 'pembeli214', 'pembeli214@gmail.com', '$2y$10$E7nuCg.VUmHiKeBHEPNhReLFJEFxnaNR4XpYgqRwF1xjgzfDUApBe', 4, 'default.png', 'none', 1, '2022-01-27 00:51:57', NULL, '2022-01-27 00:51:57'),
(223, 'pembeli215', 'pembeli215@gmail.com', '$2y$10$i3jGn7NMpM3H4MbxZGek0OksnePWYmqhcGyY1w1Vu8.xMSciU2lfm', 4, 'default.png', 'none', 1, '2022-01-27 00:51:57', NULL, '2022-01-27 00:51:57'),
(224, 'pembeli216', 'pembeli216@gmail.com', '$2y$10$Rqzig2tNqO5bLxpp7UEbDePvrEYQ4WWFUfY0oMxJWuSP4oFbNe6Q2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:58', NULL, '2022-01-27 00:51:58'),
(225, 'pembeli217', 'pembeli217@gmail.com', '$2y$10$qAbLV/vvKX78GXE425y2UOWyHrt9cxp0GEt6u0E/JeF.v.htyunZS', 4, 'default.png', 'none', 1, '2022-01-27 00:51:58', NULL, '2022-01-27 00:51:58'),
(226, 'pembeli218', 'pembeli218@gmail.com', '$2y$10$dwgz6DwCOoKj0jafUn9hDOWPFHEakOAa5g9GdAooXppdkyxJjc54q', 4, 'default.png', 'none', 1, '2022-01-27 00:51:58', NULL, '2022-01-27 00:51:58'),
(227, 'pembeli219', 'pembeli219@gmail.com', '$2y$10$cbmXjIYWbgpOHOlsJS2zZeL.Lwlw79bWbvd/zBBZ8l83dDGEm3xP2', 4, 'default.png', 'none', 1, '2022-01-27 00:51:58', NULL, '2022-01-27 00:51:58'),
(228, 'pembeli220', 'pembeli220@gmail.com', '$2y$10$r74UMmhGdxc8t4nkU3OlmePdhLJYjb4WZ8QcKh95bu7CJTVqaxiZq', 4, 'default.png', 'none', 1, '2022-01-27 00:51:58', NULL, '2022-01-27 00:51:58'),
(229, 'pembeli221', 'pembeli221@gmail.com', '$2y$10$9yJc4RvoKvP3CrTj5svW3.gxRO0qpnRoEpavvnw6U5xPKQSpFJq92', 4, 'default.png', 'none', 1, '2022-01-27 00:51:58', NULL, '2022-01-27 00:51:58'),
(230, 'pembeli222', 'pembeli222@gmail.com', '$2y$10$ujwxyoDt0C34zn0oE56.3uAVOGTk8yKYaeZZNy9FWpORU6R/T/cYe', 4, 'default.png', 'none', 1, '2022-01-27 00:51:59', NULL, '2022-01-27 00:51:59'),
(231, 'pembeli223', 'pembeli223@gmail.com', '$2y$10$OH2IOpQ8NClzupf.hoyMl.y67iKBYIDoVko.8b7HtKhvxCw4tp2gG', 4, 'default.png', 'none', 1, '2022-01-27 00:51:59', NULL, '2022-01-27 00:51:59'),
(232, 'pembeli224', 'pembeli224@gmail.com', '$2y$10$xDQFHlEOJH4jjqlVMKeTde4q3uCjEW.ImkLHDfgaAEgXHSP3HOO/m', 4, 'default.png', 'none', 1, '2022-01-27 00:51:59', NULL, '2022-01-27 00:51:59'),
(233, 'pembeli225', 'pembeli225@gmail.com', '$2y$10$iH6Tg9f/wqR8y2IcC/LsX.wFVitPIglVLMDAD0sMa9MaJM6qTjnNu', 4, 'default.png', 'none', 1, '2022-01-27 00:51:59', NULL, '2022-01-27 00:51:59'),
(234, 'pembeli226', 'pembeli226@gmail.com', '$2y$10$tlb5yunq7n89nesNNptYzuvoSXd0K6L.tyh5YT0o6OpiZBbP4RvES', 4, 'default.png', 'none', 1, '2022-01-27 00:51:59', NULL, '2022-01-27 00:51:59'),
(235, 'pembeli227', 'pembeli227@gmail.com', '$2y$10$xVV26L7w4S/lWQ5d.WF.ru09oYQ5Wf.pBTU7TRvTx89a9N55DTuuW', 4, 'default.png', 'none', 1, '2022-01-27 00:51:59', NULL, '2022-01-27 00:51:59'),
(236, 'pembeli228', 'pembeli228@gmail.com', '$2y$10$5ZWOwM0/Jxu.lk8gHLGzIOjRKQafAzmgBuPVO0DbG9I6VUG9/mUGu', 4, 'default.png', 'none', 1, '2022-01-27 00:52:00', NULL, '2022-01-27 00:52:00'),
(237, 'pembeli229', 'pembeli229@gmail.com', '$2y$10$2GTTGCytmUC4YKSIpeCaS.RN7ZwZJ5YPn5nLq5zZF.U.CMweIXM.q', 4, 'default.png', 'none', 1, '2022-01-27 00:52:00', NULL, '2022-01-27 00:52:00'),
(238, 'pembeli230', 'pembeli230@gmail.com', '$2y$10$gcPIhW9rgaPL5rAIalDes.7h2k0Jk7MKaMnTnn8to8yHZre1Swu9O', 4, 'default.png', 'none', 1, '2022-01-27 00:52:00', NULL, '2022-01-27 00:52:00'),
(239, 'pembeli231', 'pembeli231@gmail.com', '$2y$10$TSrpmMoLSm3MHS1L4DAFBONuGga8PthXtVWdrWu78wOCTF8iN752W', 4, 'default.png', 'none', 1, '2022-01-27 00:52:00', NULL, '2022-01-27 00:52:00'),
(240, 'pembeli232', 'pembeli232@gmail.com', '$2y$10$sXHyeT0w4oSI4UF9NPSshOF.gvk.uvvY1LRpROScKBc3S5PAemYaK', 4, 'default.png', 'none', 1, '2022-01-27 00:52:00', NULL, '2022-01-27 00:52:00'),
(241, 'pembeli233', 'pembeli233@gmail.com', '$2y$10$HQ8Ds4d.0zAPJwE2kg.Qdu5/2GGUzYhxkt7rFw7F./Wv0GfxjR0im', 4, 'default.png', 'none', 1, '2022-01-27 00:52:01', NULL, '2022-01-27 00:52:01'),
(242, 'pembeli234', 'pembeli234@gmail.com', '$2y$10$GQFrSVzb6mYwzGYc7f10vOZ28OKGn/NK4M2JGZZXcOhvsK8gzNcHm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:01', NULL, '2022-01-27 00:52:01'),
(243, 'pembeli235', 'pembeli235@gmail.com', '$2y$10$1h3yElucOEyPuJ3rC1Jm0OSu0xJVwkj5e6DPVF2shGRkSuyUAFzni', 4, 'default.png', 'none', 1, '2022-01-27 00:52:01', NULL, '2022-01-27 00:52:01'),
(244, 'pembeli236', 'pembeli236@gmail.com', '$2y$10$ahCDQi/qzA2LafjQvCuIIOMH5wHrdR90NcgiMTn2OgXS.MXCDbmZy', 4, 'default.png', 'none', 1, '2022-01-27 00:52:01', NULL, '2022-01-27 00:52:01'),
(245, 'pembeli237', 'pembeli237@gmail.com', '$2y$10$ZYMcW/uiVDkTqc8RyO5/HOk8OdbEVwtgITeQPlJaMbydGaSeuOSr.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:01', NULL, '2022-01-27 00:52:01'),
(246, 'pembeli238', 'pembeli238@gmail.com', '$2y$10$lj1DG8ByTHWJfzMj4CraBuj7XQtT3sKFRozdvPtg5XpT/Jf6Dh9bm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:02', NULL, '2022-01-27 00:52:02'),
(247, 'pembeli239', 'pembeli239@gmail.com', '$2y$10$sy1AT0WCPO56xpSClMauA.7ldCtH2aMgl/47dYXRKwqDXmdMQM/WC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:02', NULL, '2022-01-27 00:52:02'),
(248, 'pembeli240', 'pembeli240@gmail.com', '$2y$10$Qkni1jkdq.h.2cS9FLa9zeHTTDv0Jm0jxdT2f89jCcd9zUK2ngiT6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:02', NULL, '2022-01-27 00:52:02'),
(249, 'pembeli241', 'pembeli241@gmail.com', '$2y$10$jAUM4qVlEkmHHZjbGd4CyOQyFvOzjxOOBYcICOHR7KrckLAkdwJIq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:02', NULL, '2022-01-27 00:52:02'),
(250, 'pembeli242', 'pembeli242@gmail.com', '$2y$10$mhsO/7hD6c41FKS1J9MBIuwkKYxuP8kbLmEGh7OnyhQtSy2CNvLnG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:02', NULL, '2022-01-27 00:52:02'),
(251, 'pembeli243', 'pembeli243@gmail.com', '$2y$10$ORq93d4RinRhP2oTNgAvsORBYVYls4GD/1aIUfF5PrA1HlBIFSlXa', 4, 'default.png', 'none', 1, '2022-01-27 00:52:03', NULL, '2022-01-27 00:52:03'),
(252, 'pembeli244', 'pembeli244@gmail.com', '$2y$10$yccMQvpnOZWvUlqNUhDGcO7I2VJ1LTCol6S4KxD8Lz91ODcBVqdem', 4, 'default.png', 'none', 1, '2022-01-27 00:52:03', NULL, '2022-01-27 00:52:03'),
(253, 'pembeli245', 'pembeli245@gmail.com', '$2y$10$1WDWHoufFDSwRW.MkjQuU.GvyWU0EXTkXVwbx6MZ0teEwPKRC9fgm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:03', NULL, '2022-01-27 00:52:03'),
(254, 'pembeli246', 'pembeli246@gmail.com', '$2y$10$OzhuS64j8aEjJIptAmpRZeeip54J1f3csY1pWS.lJ1Lhl4ywIMDAa', 4, 'default.png', 'none', 1, '2022-01-27 00:52:03', NULL, '2022-01-27 00:52:03'),
(255, 'pembeli247', 'pembeli247@gmail.com', '$2y$10$I2FDFOSQf7546yUEMRbIKu3qwrPXRu5l/RnYN2dMxzCsvKvIJWlfK', 4, 'default.png', 'none', 1, '2022-01-27 00:52:03', NULL, '2022-01-27 00:52:03'),
(256, 'pembeli248', 'pembeli248@gmail.com', '$2y$10$bn/j1viCxSjyC.rg8kkbYusNDTz6sfwGEYzgkL.gW4y2VkeU7LWeG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:03', NULL, '2022-01-27 00:52:03'),
(257, 'pembeli249', 'pembeli249@gmail.com', '$2y$10$QeeLdAaNoYfNxcNRRhKuDOVFLnsTeZzPWp9xz8a3hfBVfoHMnrCM.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:03', NULL, '2022-01-27 00:52:03'),
(258, 'pembeli250', 'pembeli250@gmail.com', '$2y$10$EOMrvzoSfw..BdtVAZnUn.wBNghsUY/l0oqKrhtcfeFd18yLi.vSW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:03', NULL, '2022-01-27 00:52:03'),
(259, 'pembeli251', 'pembeli251@gmail.com', '$2y$10$a2HuTIoOtS/IA4xVD/fjRuY5QTum2aPCefMwccGSABGajNdXZE6Dy', 4, 'default.png', 'none', 1, '2022-01-27 00:52:04', NULL, '2022-01-27 00:52:04'),
(260, 'pembeli252', 'pembeli252@gmail.com', '$2y$10$H4Oh8xHOcaXBf5Q89i6RF.zq6uoPTebnLZA5bJq8i84HE0x8F9Pwi', 4, 'default.png', 'none', 1, '2022-01-27 00:52:04', NULL, '2022-01-27 00:52:04'),
(261, 'pembeli253', 'pembeli253@gmail.com', '$2y$10$2MdY54XRC5zuguhXmdWQR.FPvVWIWIQDdWqc1jW7hgkQo1G4qJmfW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:04', NULL, '2022-01-27 00:52:04'),
(262, 'pembeli254', 'pembeli254@gmail.com', '$2y$10$YVbpL0eGK/dCpt71fu4RBef3g4HDiP5naD0aGMNpPf2g43BTDov.C', 4, 'default.png', 'none', 1, '2022-01-27 00:52:04', NULL, '2022-01-27 00:52:04'),
(263, 'pembeli255', 'pembeli255@gmail.com', '$2y$10$TJXAba62IoP8pGs9PRoKi.y.ou9qAummspD2SigQ8h43qkh1E2Ae2', 4, 'default.png', 'none', 1, '2022-01-27 00:52:04', NULL, '2022-01-27 00:52:04'),
(264, 'pembeli256', 'pembeli256@gmail.com', '$2y$10$JM1Z4o06Lm4ya8GXfC87kukISy2hHVxtHvEYV3QlnSMFO3wksQZL6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:05', NULL, '2022-01-27 00:52:05'),
(265, 'pembeli257', 'pembeli257@gmail.com', '$2y$10$Klok551fBT4vjIKJX6qtqOHpVTKxtc2MSUgC.8zYIFRF6CWQL0iie', 4, 'default.png', 'none', 1, '2022-01-27 00:52:05', NULL, '2022-01-27 00:52:05'),
(266, 'pembeli258', 'pembeli258@gmail.com', '$2y$10$IVZP4b0h1NXx5bi/9bMKIOykCiqDTRQIa4P9WufW40nwoEPm/TJh2', 4, 'default.png', 'none', 1, '2022-01-27 00:52:05', NULL, '2022-01-27 00:52:05'),
(267, 'pembeli259', 'pembeli259@gmail.com', '$2y$10$gFykBvUv7aVlvowlyVC87ukHM4C2t8ziN923r..wZQl/CQBvm4flS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:05', NULL, '2022-01-27 00:52:05'),
(268, 'pembeli260', 'pembeli260@gmail.com', '$2y$10$uEhzQ1jOcIZ8r4f1ETOZMO8VYtx7qi6fSDocvjH93JskHMuUN8fRW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:05', NULL, '2022-01-27 00:52:05');
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `photo`, `type_login`, `status`, `created_at`, `deleted_at`, `updated_at`) VALUES
(269, 'pembeli261', 'pembeli261@gmail.com', '$2y$10$/TduJIsXibLFDD.Z5zfmm.sPT3mndy/Sgr9YMu.9ErenKwnYI/jbq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:05', NULL, '2022-01-27 00:52:05'),
(270, 'pembeli262', 'pembeli262@gmail.com', '$2y$10$3ruPSeK0VWSpAdkGyflzEefZjcW46IJA/ByvJ.8na9eQ3FMM3vGz.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:05', NULL, '2022-01-27 00:52:05'),
(271, 'pembeli263', 'pembeli263@gmail.com', '$2y$10$/v8mxd9iXs/H5.yHO5t.4OrPe137YkFrxfuVSICw5n0FJ5ltwhGX6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:06', NULL, '2022-01-27 00:52:06'),
(272, 'pembeli264', 'pembeli264@gmail.com', '$2y$10$nrN0fz4KDwq0Kf4lbHHuvu/vgqxqcVgSFAMoViuaFL2DG3JkUb0ta', 4, 'default.png', 'none', 1, '2022-01-27 00:52:06', NULL, '2022-01-27 00:52:06'),
(273, 'pembeli265', 'pembeli265@gmail.com', '$2y$10$73jzLhD7ZsVJmldc4IMipO.BMYF.BD8recuz02hIuvShOjCdsVfnO', 4, 'default.png', 'none', 1, '2022-01-27 00:52:06', NULL, '2022-01-27 00:52:06'),
(274, 'pembeli266', 'pembeli266@gmail.com', '$2y$10$cosORYNqOmh7OKfq4Gn4YuXJpl5OrMHYIqMGkmV2ZkYk7Wkwmr1NS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:06', NULL, '2022-01-27 00:52:06'),
(275, 'pembeli267', 'pembeli267@gmail.com', '$2y$10$TpLLKfWWak9ZOn3bEjpx6.fmVzjtu/kMnyQN6NJLZLDdbRumXMlhG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:06', NULL, '2022-01-27 00:52:06'),
(276, 'pembeli268', 'pembeli268@gmail.com', '$2y$10$n3y8XAHemPxXIomjIDYzMeOuSW8Qt80o2nNh40iszOFSza3KnVC9q', 4, 'default.png', 'none', 1, '2022-01-27 00:52:06', NULL, '2022-01-27 00:52:06'),
(277, 'pembeli269', 'pembeli269@gmail.com', '$2y$10$ixQTAQsMY3GJrfUtbpAyNOMjiydpk7X9ZRu9jZe1s7OtTll7.sHuG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:06', NULL, '2022-01-27 00:52:06'),
(278, 'pembeli270', 'pembeli270@gmail.com', '$2y$10$j/duIYBb7bqYUJX4dExg6Ocq3VAkwvUfAJ52gyNASsUXya.FcjeaG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:07', NULL, '2022-01-27 00:52:07'),
(279, 'pembeli271', 'pembeli271@gmail.com', '$2y$10$fpuZ9HsE49CNEUaK3xZzFeE2VwhgXnuyJHzQMk/1v/2gtEup9eMcq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:07', NULL, '2022-01-27 00:52:07'),
(280, 'pembeli272', 'pembeli272@gmail.com', '$2y$10$cUjOek2EbQEwiLu3I7qFXu7CIOA3z/pAC5j5GoaqkhUq6RWYGB5O.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:07', NULL, '2022-01-27 00:52:07'),
(281, 'pembeli273', 'pembeli273@gmail.com', '$2y$10$DuxFRo0PHRo3.mriMAGTx.3SIw3iIja/WE6tn4YoTqCAj2ZvXyzkS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:07', NULL, '2022-01-27 00:52:07'),
(282, 'pembeli274', 'pembeli274@gmail.com', '$2y$10$7oOhisBIillXHI3wtM9hOOF8lOOYcV2Tma38bGjZopzjbPk.6w.Yy', 4, 'default.png', 'none', 1, '2022-01-27 00:52:07', NULL, '2022-01-27 00:52:07'),
(283, 'pembeli275', 'pembeli275@gmail.com', '$2y$10$D5cQHrr2qzk3v4A8oep4oe4h/foVP25YWlNaBWvcqMlybRXMXV/LW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:07', NULL, '2022-01-27 00:52:07'),
(284, 'pembeli276', 'pembeli276@gmail.com', '$2y$10$xyHDarZYVyn.kXFY2AXS0OjgWqQzjVCw.3YqNAW6108clCbdDj/A6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:07', NULL, '2022-01-27 00:52:07'),
(285, 'pembeli277', 'pembeli277@gmail.com', '$2y$10$r6g2QD75xPcJ7TUY.itBzOq6oh.xOdpWXS/55TPgVJVwzH3wS9hr6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:07', NULL, '2022-01-27 00:52:07'),
(286, 'pembeli278', 'pembeli278@gmail.com', '$2y$10$gy9/yX7nvZW7IUTr2GRxwutePKMeNfOtv1o0y2..kcXxGmTnaS1S6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:08', NULL, '2022-01-27 00:52:08'),
(287, 'pembeli279', 'pembeli279@gmail.com', '$2y$10$TB8H5UUPopihbJIqsUi/du3phA7cSfOau1K6DfCVfChwjh0zg4/Ea', 4, 'default.png', 'none', 1, '2022-01-27 00:52:08', NULL, '2022-01-27 00:52:08'),
(288, 'pembeli280', 'pembeli280@gmail.com', '$2y$10$I0NRduinFJ23F3nylwm/Oekt9NihUgvAnMO.7u1JZoAYQOU5yl0pi', 4, 'default.png', 'none', 1, '2022-01-27 00:52:08', NULL, '2022-01-27 00:52:08'),
(289, 'pembeli281', 'pembeli281@gmail.com', '$2y$10$8hLYoKzw/1wLcl7nh8Adl.onu4p2jK6vgbbaNsUKNiiVkFMTPa1vq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:08', NULL, '2022-01-27 00:52:08'),
(290, 'pembeli282', 'pembeli282@gmail.com', '$2y$10$s3COnAkKqm.Jn6Mbs4CzE.NdFl1ol4rPf5q0Cn04tMXfVzVGNKNmW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:08', NULL, '2022-01-27 00:52:08'),
(291, 'pembeli283', 'pembeli283@gmail.com', '$2y$10$fxpFM.KmmjVmvdnlOAUslOf8.pIKZPjJktPiaxflPZWPmlK9kFVTu', 4, 'default.png', 'none', 1, '2022-01-27 00:52:09', NULL, '2022-01-27 00:52:09'),
(292, 'pembeli284', 'pembeli284@gmail.com', '$2y$10$RsGM0ZUIxQn//Uu2LzLvuOQvXFAKkjBBkJhS2oz5aksv7OTmP/B5.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:09', NULL, '2022-01-27 00:52:09'),
(293, 'pembeli285', 'pembeli285@gmail.com', '$2y$10$Ue4QxrOy20.Zseq9YpMgHehArhMTbaq3wUWXVu2rgFpF.nb0elrQu', 4, 'default.png', 'none', 1, '2022-01-27 00:52:09', NULL, '2022-01-27 00:52:09'),
(294, 'pembeli286', 'pembeli286@gmail.com', '$2y$10$GpTX.zhPUbR0.1xcD7tf9Ogs8d2bL6/rFdT1XjEearLxKFZAgHXwu', 4, 'default.png', 'none', 1, '2022-01-27 00:52:09', NULL, '2022-01-27 00:52:09'),
(295, 'pembeli287', 'pembeli287@gmail.com', '$2y$10$SF8VQoeItRS1EFW2EfqF7OGFteVHTTgE.jR0y8w4UZzlUbqEuhRHi', 4, 'default.png', 'none', 1, '2022-01-27 00:52:09', NULL, '2022-01-27 00:52:09'),
(296, 'pembeli288', 'pembeli288@gmail.com', '$2y$10$KWurfBGY5dKUlNaZCkgE1eYKYIq1BJ18it.2e8psxRrFpiv8Htufe', 4, 'default.png', 'none', 1, '2022-01-27 00:52:09', NULL, '2022-01-27 00:52:09'),
(297, 'pembeli289', 'pembeli289@gmail.com', '$2y$10$k4ySKzVOk/2RTDsqbOtaVuEoaXej0Sa4DU20r9DGqgaJh57dphJ0C', 4, 'default.png', 'none', 1, '2022-01-27 00:52:09', NULL, '2022-01-27 00:52:09'),
(298, 'pembeli290', 'pembeli290@gmail.com', '$2y$10$e85Kr4Z8EBwP4D8EdAP8ruwA0Eaksgw6fvPPsRQPmfODGeltoO6US', 4, 'default.png', 'none', 1, '2022-01-27 00:52:09', NULL, '2022-01-27 00:52:09'),
(299, 'pembeli291', 'pembeli291@gmail.com', '$2y$10$wngWB9Jr5998hj9nVb5Q8uHexICzB..UmqRVRsxTWEe8Gn6fM4cOi', 4, 'default.png', 'none', 1, '2022-01-27 00:52:10', NULL, '2022-01-27 00:52:10'),
(300, 'pembeli292', 'pembeli292@gmail.com', '$2y$10$CT88F1cNUHqzv.84lZF3t.SiPPPywPO3Fz.86T37rQMqu5zE4b7VO', 4, 'default.png', 'none', 1, '2022-01-27 00:52:10', NULL, '2022-01-27 00:52:10'),
(301, 'pembeli293', 'pembeli293@gmail.com', '$2y$10$VFjyFq7lloQfq7G0NQyar.jpLnyfEtOA6qwycBQi5j5nH5XHETWSi', 4, 'default.png', 'none', 1, '2022-01-27 00:52:10', NULL, '2022-01-27 00:52:10'),
(302, 'pembeli294', 'pembeli294@gmail.com', '$2y$10$gWbrRV7OKV7OnZ9RunD/suhQfq5ZyIV32fGKmd9fMBoSiIuvs6ARy', 4, 'default.png', 'none', 1, '2022-01-27 00:52:10', NULL, '2022-01-27 00:52:10'),
(303, 'pembeli295', 'pembeli295@gmail.com', '$2y$10$mCVMQH7oUY53NE5Ayqg7aeST4iHWdfqt2KmCmGC2.DJ2i5ISsgQSC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:10', NULL, '2022-01-27 00:52:10'),
(304, 'pembeli296', 'pembeli296@gmail.com', '$2y$10$cBPCQSG35h4Q4FmLlDwvlOUZGvK1AyQrfALTbBF5y7mtHiqL92z0.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:11', NULL, '2022-01-27 00:52:11'),
(305, 'pembeli297', 'pembeli297@gmail.com', '$2y$10$cihiWKUxVJhvR3eNAyeK6OGxX5sO1KhviAK32PVTO99GN8pwGLZzS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:11', NULL, '2022-01-27 00:52:11'),
(306, 'pembeli298', 'pembeli298@gmail.com', '$2y$10$Bo/aRvxQ2H0WpknDwZh3Eep3HWcX6nozRmY5VbSyMbcNrKg1Y0aMe', 4, 'default.png', 'none', 1, '2022-01-27 00:52:11', NULL, '2022-01-27 00:52:11'),
(307, 'pembeli299', 'pembeli299@gmail.com', '$2y$10$iwILZmeTfKWjJPH84HrpC.dZa8LOMJStZGZp0kSne3CWxKSo1j656', 4, 'default.png', 'none', 1, '2022-01-27 00:52:11', NULL, '2022-01-27 00:52:11'),
(308, 'pembeli300', 'pembeli300@gmail.com', '$2y$10$.Q1tahOYqC1NtYBj1ppbJeJs5caCVf0ysrVahp7WDk5s/9sZroC6a', 4, 'default.png', 'none', 1, '2022-01-27 00:52:11', NULL, '2022-01-27 00:52:11'),
(309, 'pembeli301', 'pembeli301@gmail.com', '$2y$10$Qd9/frafE0szF/w/RgXK9umYNVvyHp00/OOt1ckjbmStI0E1riLaO', 4, 'default.png', 'none', 1, '2022-01-27 00:52:11', NULL, '2022-01-27 00:52:11'),
(310, 'pembeli302', 'pembeli302@gmail.com', '$2y$10$IXRXFQY.BboIcliojYcorueGuw9PCyIbWX.TbGoGUFbPpqohjIk9W', 4, 'default.png', 'none', 1, '2022-01-27 00:52:11', NULL, '2022-01-27 00:52:11'),
(311, 'pembeli303', 'pembeli303@gmail.com', '$2y$10$wgMubDYAwwyf2J5WfbCuze41ymkyk0HWKaPmQm9kX2.ltKyCYImja', 4, 'default.png', 'none', 1, '2022-01-27 00:52:12', NULL, '2022-01-27 00:52:12'),
(312, 'pembeli304', 'pembeli304@gmail.com', '$2y$10$8v49n/vnz8Mgk0JQwnVLe.F20xxQgDR8t3a7CaTOzwTyvj.sFoeOi', 4, 'default.png', 'none', 1, '2022-01-27 00:52:12', NULL, '2022-01-27 00:52:12'),
(313, 'pembeli305', 'pembeli305@gmail.com', '$2y$10$.0F3NP9h0Ro4L9X262ucyOkVWkJkw0CGLj8eeqjILYY8ei2yVWN2y', 4, 'default.png', 'none', 1, '2022-01-27 00:52:12', NULL, '2022-01-27 00:52:12'),
(314, 'pembeli306', 'pembeli306@gmail.com', '$2y$10$yQJ0VEMoOxY6v3tWLVyk2.z0Tph4N3422pIyQIKXe/vGNe5rL0qIq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:12', NULL, '2022-01-27 00:52:12'),
(315, 'pembeli307', 'pembeli307@gmail.com', '$2y$10$g7LqFhZshr3IG3Wuey0KFuMSa2bnx7ceyYNOc2RqimsACdChzqm0u', 4, 'default.png', 'none', 1, '2022-01-27 00:52:12', NULL, '2022-01-27 00:52:12'),
(316, 'pembeli308', 'pembeli308@gmail.com', '$2y$10$nOo7mAEYXgQn9AFR7ul64erEJbHlgnN4V.NAFq2dRVpCs4hQn.cHm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:12', NULL, '2022-01-27 00:52:12'),
(317, 'pembeli309', 'pembeli309@gmail.com', '$2y$10$ukMerYRE7MV6fFTx5lzWp.XDcXrdzt4rrVICTBW1.gy8HwjadGyKy', 4, 'default.png', 'none', 1, '2022-01-27 00:52:13', NULL, '2022-01-27 00:52:13'),
(318, 'pembeli310', 'pembeli310@gmail.com', '$2y$10$svR9EB4RhDXS.DH3gBcQjuQQGslmXF1H1qCw5g.MnlBCUhlNXu4jS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:13', NULL, '2022-01-27 00:52:13'),
(319, 'pembeli311', 'pembeli311@gmail.com', '$2y$10$axojo534C14lHtwyiPemfOVjYFLPWNiV1kuztbX5xpVhjcAviJHjm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:13', NULL, '2022-01-27 00:52:13'),
(320, 'pembeli312', 'pembeli312@gmail.com', '$2y$10$fljHlVF1q49FU6vY7HtR5e4H9IK6trMFBJprF5d3vB/05K7hoCtc6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:13', NULL, '2022-01-27 00:52:13'),
(321, 'pembeli313', 'pembeli313@gmail.com', '$2y$10$LZ6jgrNbbACXZfPJDPOKZeTxfEKV0G5Lf4wBcSrpu9nFjIkPPtLOy', 4, 'default.png', 'none', 1, '2022-01-27 00:52:13', NULL, '2022-01-27 00:52:13'),
(322, 'pembeli314', 'pembeli314@gmail.com', '$2y$10$aWLox0vANBUvsploCoTbYewkoRTtpYBFJV7Q618hdQIMitugUYjLC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:13', NULL, '2022-01-27 00:52:13'),
(323, 'pembeli315', 'pembeli315@gmail.com', '$2y$10$0Io5cQjUKBF/7xjVHlLSveyULlsi3IXp24LYxA7xdmF14SmBDPlwi', 4, 'default.png', 'none', 1, '2022-01-27 00:52:14', NULL, '2022-01-27 00:52:14'),
(324, 'pembeli316', 'pembeli316@gmail.com', '$2y$10$ntjU1FlQyyX5QteMrRatteAJFrc5llDxVk9Ipgn4p4fuDhxqaqNIq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:14', NULL, '2022-01-27 00:52:14'),
(325, 'pembeli317', 'pembeli317@gmail.com', '$2y$10$r9njwKy0E6Q0P.ZSg1fJwuDbO9w7/FPm.RGo4jARiZ0QHMm3pcAfS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:14', NULL, '2022-01-27 00:52:14'),
(326, 'pembeli318', 'pembeli318@gmail.com', '$2y$10$n85JDTj2yigDskBEJsQTyO9FNbkXEVCNNFuzT01vCXo06QhW6euaa', 4, 'default.png', 'none', 1, '2022-01-27 00:52:14', NULL, '2022-01-27 00:52:14'),
(327, 'pembeli319', 'pembeli319@gmail.com', '$2y$10$iiR9IrwQ.qQpU95vskb3jOqptYaym0E8eRYr4K65fVokeX1nKBGFC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:14', NULL, '2022-01-27 00:52:14'),
(328, 'pembeli320', 'pembeli320@gmail.com', '$2y$10$tIFeFAtf1RwZwOcjZdfYmOpdn1jnY92NmNugS58YSbhcjdGvU0LXi', 4, 'default.png', 'none', 1, '2022-01-27 00:52:14', NULL, '2022-01-27 00:52:14'),
(329, 'pembeli321', 'pembeli321@gmail.com', '$2y$10$Q6/VoqCrCCRdlFkEZbALTu7rHp.OJ7DY1QWVOJqg7fm.EKweF.hOK', 4, 'default.png', 'none', 1, '2022-01-27 00:52:14', NULL, '2022-01-27 00:52:14'),
(330, 'pembeli322', 'pembeli322@gmail.com', '$2y$10$jKiawThXuD/eMDqoLLjDDuFXIyE/lWSARvnA7fsCDrvk7ggaAT1Ue', 4, 'default.png', 'none', 1, '2022-01-27 00:52:14', NULL, '2022-01-27 00:52:14'),
(331, 'pembeli323', 'pembeli323@gmail.com', '$2y$10$.XtrpItc8BbDtsKZ1kvtvu0wjWIXAsaVxL6T21umC.Tbef/QA0zia', 4, 'default.png', 'none', 1, '2022-01-27 00:52:15', NULL, '2022-01-27 00:52:15'),
(332, 'pembeli324', 'pembeli324@gmail.com', '$2y$10$6PSyOMIKaArULuh/OthWAusLQMUHT76gMEIFplNj1b8cJkJzNf9X6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:15', NULL, '2022-01-27 00:52:15'),
(333, 'pembeli325', 'pembeli325@gmail.com', '$2y$10$xV76I9hAbqIxMhb5TmjAmeibxKw7SJtrHZ.7C9JL7PZvsOCgch2S6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:15', NULL, '2022-01-27 00:52:15'),
(334, 'pembeli326', 'pembeli326@gmail.com', '$2y$10$Shf3QOmGWApoGMMevg8Exu2uKUXTyF1E8F3oDGq.PiGz59WXORohi', 4, 'default.png', 'none', 1, '2022-01-27 00:52:15', NULL, '2022-01-27 00:52:15'),
(335, 'pembeli327', 'pembeli327@gmail.com', '$2y$10$JQxU49NNIcwdw8MGSlW5De1M1Els8v/TbtKNdHARaotn3D8JYMC2i', 4, 'default.png', 'none', 1, '2022-01-27 00:52:15', NULL, '2022-01-27 00:52:15'),
(336, 'pembeli328', 'pembeli328@gmail.com', '$2y$10$xdIXmT4PgmzOr1XZST7v...6yvi4JFEPtipGRH1JJxRxWipzWoWSS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:15', NULL, '2022-01-27 00:52:15'),
(337, 'pembeli329', 'pembeli329@gmail.com', '$2y$10$eBfZsq5GPuP7BpySVI85L.O/molax0R5NkGTyb01vdGuh6zMZwH0G', 4, 'default.png', 'none', 1, '2022-01-27 00:52:15', NULL, '2022-01-27 00:52:15'),
(338, 'pembeli330', 'pembeli330@gmail.com', '$2y$10$1RP3wsOkdQ7qyN6wNW.MauxZ/pJz.luGR8FBLCqP8TDiBVB0QSUeO', 4, 'default.png', 'none', 1, '2022-01-27 00:52:16', NULL, '2022-01-27 00:52:16'),
(339, 'pembeli331', 'pembeli331@gmail.com', '$2y$10$5J7T3Jig8pqH8xfHMpa0LOI33aMN.U7myoo8USPG4c4yVXnFjf9WG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:16', NULL, '2022-01-27 00:52:16'),
(340, 'pembeli332', 'pembeli332@gmail.com', '$2y$10$clOPgWct98seSMEF8qqHY.JfvLgIKrt1ZY20gIJh.H/Meo/ZawXMO', 4, 'default.png', 'none', 1, '2022-01-27 00:52:16', NULL, '2022-01-27 00:52:16'),
(341, 'pembeli333', 'pembeli333@gmail.com', '$2y$10$C0r10ERVJtB7vMjGYfKEMuVFMX6.ym8u.KXMehE1hPWkBSzhsJUSO', 4, 'default.png', 'none', 1, '2022-01-27 00:52:16', NULL, '2022-01-27 00:52:16'),
(342, 'pembeli334', 'pembeli334@gmail.com', '$2y$10$D83q/.Dfe9vSNn2t0Z3lSe3c9.Qpyzd5szzEx3paTStXO4xEorlSG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:16', NULL, '2022-01-27 00:52:16'),
(343, 'pembeli335', 'pembeli335@gmail.com', '$2y$10$A.aAhUej9NPQ/LpBqrzZ/.sPQIFgWUpGBMXB7/13/4dUn4HWIFr9K', 4, 'default.png', 'none', 1, '2022-01-27 00:52:16', NULL, '2022-01-27 00:52:16'),
(344, 'pembeli336', 'pembeli336@gmail.com', '$2y$10$w/VoWHomkEMXvh/7VfZlhO.9nmzZtYyKmWsNTXOwlypfbuSpcBGJ2', 4, 'default.png', 'none', 1, '2022-01-27 00:52:17', NULL, '2022-01-27 00:52:17'),
(345, 'pembeli337', 'pembeli337@gmail.com', '$2y$10$p43yO7WsgizE/.NJUuA4BujBUXsWR.aXc5yyYrzoh4zpa5lVXZr6y', 4, 'default.png', 'none', 1, '2022-01-27 00:52:17', NULL, '2022-01-27 00:52:17'),
(346, 'pembeli338', 'pembeli338@gmail.com', '$2y$10$aPhRLnp4OeOiL8UIZmL0C.GazbXCOxpGfHtL1BS0tXEFqOxEz707a', 4, 'default.png', 'none', 1, '2022-01-27 00:52:17', NULL, '2022-01-27 00:52:17'),
(347, 'pembeli339', 'pembeli339@gmail.com', '$2y$10$y6WrqQKjkksBYEOW5OfZteNmiEIPkBwkGHmudVpRfz8OZytkyyvyC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:17', NULL, '2022-01-27 00:52:17'),
(348, 'pembeli340', 'pembeli340@gmail.com', '$2y$10$7Z6aerzN/gJBvnaSjblRzORrCqNs3EJitY8qr6D9vTHFzqIW0OYDa', 4, 'default.png', 'none', 1, '2022-01-27 00:52:17', NULL, '2022-01-27 00:52:17'),
(349, 'pembeli341', 'pembeli341@gmail.com', '$2y$10$KqjJc2xIptkPjmVR0/7gWevCDCgjoZqoa0Y8dD.KqapF8tSsNVQsW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:17', NULL, '2022-01-27 00:52:17'),
(350, 'pembeli342', 'pembeli342@gmail.com', '$2y$10$gNtGrHwpy8IZM1aaePMCWes2ZMGduYyRPlSMb5H52dHv90QWWARDi', 4, 'default.png', 'none', 1, '2022-01-27 00:52:17', NULL, '2022-01-27 00:52:17'),
(351, 'pembeli343', 'pembeli343@gmail.com', '$2y$10$R6a0CmhIUJUZlpBty0qaIOGNYOGskLwqiW0o9WN/lLckQuDMV0YoW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:18', NULL, '2022-01-27 00:52:18'),
(352, 'pembeli344', 'pembeli344@gmail.com', '$2y$10$TT2x0psbIeWj5EYHXwtzp.DV9im6nOOoKBhVGDrnVq9W0atUQF6Ie', 4, 'default.png', 'none', 1, '2022-01-27 00:52:18', NULL, '2022-01-27 00:52:18'),
(353, 'pembeli345', 'pembeli345@gmail.com', '$2y$10$RBHkyBZSLioRPl.sBJv1..9zEQ7Tef0jUGTNak77rjVd3kZgsFtGe', 4, 'default.png', 'none', 1, '2022-01-27 00:52:18', NULL, '2022-01-27 00:52:18'),
(354, 'pembeli346', 'pembeli346@gmail.com', '$2y$10$Bfx5unq0iFUaUjIxoEC6duqXaoABACaAIreKYo.biFt7CQC7CCTV.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:18', NULL, '2022-01-27 00:52:18'),
(355, 'pembeli347', 'pembeli347@gmail.com', '$2y$10$fZR0PfjV/19H07nzwH.86uf.GQuIkwFLiSBsGEbmJbGK0mHIRSoo.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:18', NULL, '2022-01-27 00:52:18'),
(356, 'pembeli348', 'pembeli348@gmail.com', '$2y$10$e2eqpf4IHZAwjnSg7xxLjumUHy5wNDxuz4cV0rcol7MuUzxHH0P8m', 4, 'default.png', 'none', 1, '2022-01-27 00:52:18', NULL, '2022-01-27 00:52:18'),
(357, 'pembeli349', 'pembeli349@gmail.com', '$2y$10$Fan2Uc.x6o4bMIHO.kNVSeDc/XKVYzyD6u9DOpoezYoH9yFOfbbbG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:18', NULL, '2022-01-27 00:52:18'),
(358, 'pembeli350', 'pembeli350@gmail.com', '$2y$10$4PLVynPqWEIYZx7pNoitQ.erTUvkRKoq/SdNVfW55dNGZ9EqPqan.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:18', NULL, '2022-01-27 00:52:18'),
(359, 'pembeli351', 'pembeli351@gmail.com', '$2y$10$.mgXr6cv9krjsdTsOhIP4..Dz2I8O1f0NjTrak7Ww0rxh9MN9ysdm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:19', NULL, '2022-01-27 00:52:19'),
(360, 'pembeli352', 'pembeli352@gmail.com', '$2y$10$Z2NZjguStEdRebsEvat75.//ksMGQSKoZsUMXmpKo0OSXy4dmVqZ.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:19', NULL, '2022-01-27 00:52:19'),
(361, 'pembeli353', 'pembeli353@gmail.com', '$2y$10$8BZ.YsM5qkVP2LLnzv9QJuecq280.K6dGHMAA34EkHb/ppAZF7y6i', 4, 'default.png', 'none', 1, '2022-01-27 00:52:19', NULL, '2022-01-27 00:52:19'),
(362, 'pembeli354', 'pembeli354@gmail.com', '$2y$10$u1D2mg0v8IadYLwvYkvB0e11W3MZct7ioMKSNU3BBU5ojuhU2FE4e', 4, 'default.png', 'none', 1, '2022-01-27 00:52:19', NULL, '2022-01-27 00:52:19'),
(363, 'pembeli355', 'pembeli355@gmail.com', '$2y$10$.uZdyVhIRS54//wgnJyZHeup0C4vvHq5T8sOKlHhNLv8xHgPolFG.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:19', NULL, '2022-01-27 00:52:19'),
(364, 'pembeli356', 'pembeli356@gmail.com', '$2y$10$HTMMs37ipGNT1ClvaNYdw.7ibX7AC.6hioXkE9ujDWx26KbNJ1CSe', 4, 'default.png', 'none', 1, '2022-01-27 00:52:19', NULL, '2022-01-27 00:52:19'),
(365, 'pembeli357', 'pembeli357@gmail.com', '$2y$10$hTZA1JtPb.mkbMr6wykRReCcM8lCl9Gvc3jG071NL2ipBk1J/pk.S', 4, 'default.png', 'none', 1, '2022-01-27 00:52:19', NULL, '2022-01-27 00:52:19'),
(366, 'pembeli358', 'pembeli358@gmail.com', '$2y$10$ndaxh/rCuQQ9guXicyVyLegmPCjr5BzF08S1Cx8y57tQfXuzxvBGO', 4, 'default.png', 'none', 1, '2022-01-27 00:52:19', NULL, '2022-01-27 00:52:19'),
(367, 'pembeli359', 'pembeli359@gmail.com', '$2y$10$mAzT7bEy.InRvQmKeT/UYeMNG9Y8dM10sbsyR84d.olscqgnxB5oO', 4, 'default.png', 'none', 1, '2022-01-27 00:52:20', NULL, '2022-01-27 00:52:20'),
(368, 'pembeli360', 'pembeli360@gmail.com', '$2y$10$qBaP336Z/QNYVB.77CS2c.4N0pKZe0QwR6/jznRTSR5FOnj/nq1T.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:20', NULL, '2022-01-27 00:52:20'),
(369, 'pembeli361', 'pembeli361@gmail.com', '$2y$10$arjBX9brjrucI/pbHdxP0e4FckjVGydzQpmqDX5Ahw/hZzidowmDq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:20', NULL, '2022-01-27 00:52:20'),
(370, 'pembeli362', 'pembeli362@gmail.com', '$2y$10$LhphkdeLjBr7ks60gsUh4OOC9JEZaLduA6.jGlBJdcolwEcvm4hW.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:20', NULL, '2022-01-27 00:52:20'),
(371, 'pembeli363', 'pembeli363@gmail.com', '$2y$10$0qry4xzTsGP92QNDFM/eMO5qTHfOQYineTAmzTUzC9IKFJ5DAc6X.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:20', NULL, '2022-01-27 00:52:20'),
(372, 'pembeli364', 'pembeli364@gmail.com', '$2y$10$Yt9KGYROgng1/Hgqn4BLWOQ30xIvOALnXnI/3e5U45ii3LE9CZ4d2', 4, 'default.png', 'none', 1, '2022-01-27 00:52:21', NULL, '2022-01-27 00:52:21'),
(373, 'pembeli365', 'pembeli365@gmail.com', '$2y$10$muDfYyrzR0f4t0oDyItOl.jI6mdZ1T4T6Fm1EzfC7wKF4MAqXeGEu', 4, 'default.png', 'none', 1, '2022-01-27 00:52:21', NULL, '2022-01-27 00:52:21'),
(374, 'pembeli366', 'pembeli366@gmail.com', '$2y$10$iZPKk5031fPYk/AbpptDN.5nYZzpaffn/aSlOAYc2cPVnELx8Rq.C', 4, 'default.png', 'none', 1, '2022-01-27 00:52:21', NULL, '2022-01-27 00:52:21'),
(375, 'pembeli367', 'pembeli367@gmail.com', '$2y$10$SdSqQOjML7ftf4B911YZ4OBGw6hxOKeK6BLmxjNDRrsDDVwLmFZCa', 4, 'default.png', 'none', 1, '2022-01-27 00:52:21', NULL, '2022-01-27 00:52:21'),
(376, 'pembeli368', 'pembeli368@gmail.com', '$2y$10$TZga9tWa.BrjU9nsxRKWausYtCJE2aoYrLCC9pCNuvZGryUgYbsK6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:21', NULL, '2022-01-27 00:52:21'),
(377, 'pembeli369', 'pembeli369@gmail.com', '$2y$10$7JEdN2WtcXQckS/.prxFc.kXd0v9BnyX9ayMtgsfgjQFQudytSNxS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:21', NULL, '2022-01-27 00:52:21'),
(378, 'pembeli370', 'pembeli370@gmail.com', '$2y$10$VLcpLy9v6tOCb5yeid1MWu6ZJ4u/6JVg4heyS0sbmhuPwoySv0CHW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:21', NULL, '2022-01-27 00:52:21'),
(379, 'pembeli371', 'pembeli371@gmail.com', '$2y$10$x3x4EFJ0jvv7ydH/UPvV8OP2BWwujyOv/vS7FPnGceThBDUaUZeI6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:21', NULL, '2022-01-27 00:52:21'),
(380, 'pembeli372', 'pembeli372@gmail.com', '$2y$10$QM7YKJL17Lh1oLXXweTqK.oANLv7R9j6zWK.GFuQpmLyEtfYkkZ6a', 4, 'default.png', 'none', 1, '2022-01-27 00:52:22', NULL, '2022-01-27 00:52:22'),
(381, 'pembeli373', 'pembeli373@gmail.com', '$2y$10$3L.a9hRWSzy0/kHNDTAfHepqpAoig.FDCAPFvtJfliB5twyw3Eeza', 4, 'default.png', 'none', 1, '2022-01-27 00:52:22', NULL, '2022-01-27 00:52:22'),
(382, 'pembeli374', 'pembeli374@gmail.com', '$2y$10$yVV0fT6BCQIjcDX7N.0s7uCFV524VIeIhUXTcgoxdHuZdweIleaH6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:22', NULL, '2022-01-27 00:52:22'),
(383, 'pembeli375', 'pembeli375@gmail.com', '$2y$10$WT/EDiTsdJhmu.9MTV78nO0HckUVSMFtkEzIX5OeMxy0qaJzLMPnG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:22', NULL, '2022-01-27 00:52:22'),
(384, 'pembeli376', 'pembeli376@gmail.com', '$2y$10$H5QrFcxgGD.y7a3iGuitQ.dgRS8sqU1KMIwkelXm2hANXWzpm1J.C', 4, 'default.png', 'none', 1, '2022-01-27 00:52:22', NULL, '2022-01-27 00:52:22'),
(385, 'pembeli377', 'pembeli377@gmail.com', '$2y$10$g5mJr9IT4MQOTjRYixtUhu8fBSIAZhduGWYpOPpmj2zWaXMiTdM5K', 4, 'default.png', 'none', 1, '2022-01-27 00:52:22', NULL, '2022-01-27 00:52:22'),
(386, 'pembeli378', 'pembeli378@gmail.com', '$2y$10$.8ni2SFGbIvDpeGmslZhauUo4A/oBYNPrCBSlxgIbJH5/hEGNsSvC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:22', NULL, '2022-01-27 00:52:22'),
(387, 'pembeli379', 'pembeli379@gmail.com', '$2y$10$8IjFw6ZQj8Uec0yKHyZ0Fe/XJTJTXEiC4eg1ptsDMmuA8By1dxqoa', 4, 'default.png', 'none', 1, '2022-01-27 00:52:22', NULL, '2022-01-27 00:52:22'),
(388, 'pembeli380', 'pembeli380@gmail.com', '$2y$10$/LtNAhQrVsruhuQ3cAhVtu0teQDqFU4nRoEqOvjjQQkYL7CNObAjm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:23', NULL, '2022-01-27 00:52:23'),
(389, 'pembeli381', 'pembeli381@gmail.com', '$2y$10$SAkAhkswpVr5k6.8AJJj1u/VRy9YOB3i3MR7gJhUER6Z6fLCoeix6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:23', NULL, '2022-01-27 00:52:23'),
(390, 'pembeli382', 'pembeli382@gmail.com', '$2y$10$a1PASik2c7f4HdWUgO.g1OywN5E5kk3NG6p/nDyuYAh6EJk7Xw036', 4, 'default.png', 'none', 1, '2022-01-27 00:52:23', NULL, '2022-01-27 00:52:23'),
(391, 'pembeli383', 'pembeli383@gmail.com', '$2y$10$fIctkVbTKNznXvWm3OXa/uKP3BTq0E.57Vi/Bu8BOzEgZaCBBY6gy', 4, 'default.png', 'none', 1, '2022-01-27 00:52:23', NULL, '2022-01-27 00:52:23'),
(392, 'pembeli384', 'pembeli384@gmail.com', '$2y$10$IUqR7vMe3d1mt1oS6MbNi.Vu3OckQDeFXrdkmrm/K.GoOg105mhPe', 4, 'default.png', 'none', 1, '2022-01-27 00:52:23', NULL, '2022-01-27 00:52:23'),
(393, 'pembeli385', 'pembeli385@gmail.com', '$2y$10$vKliBLBFUxs4PAtQbQyCxeXIv25eRa1douM5aYFiVHpISfvmCUQz2', 4, 'default.png', 'none', 1, '2022-01-27 00:52:23', NULL, '2022-01-27 00:52:23'),
(394, 'pembeli386', 'pembeli386@gmail.com', '$2y$10$51FNIamUSdd8NvIoYIwRFu8NLuqATIVCHTFZiLiY8CsCq0HvvHs1y', 4, 'default.png', 'none', 1, '2022-01-27 00:52:23', NULL, '2022-01-27 00:52:23'),
(395, 'pembeli387', 'pembeli387@gmail.com', '$2y$10$Yh2cYopeMmDJ00ByOMcD/OVZs7tWXAhStrrSVfem3X9PHG0oHPVDO', 4, 'default.png', 'none', 1, '2022-01-27 00:52:24', NULL, '2022-01-27 00:52:24'),
(396, 'pembeli388', 'pembeli388@gmail.com', '$2y$10$DV7q8PVmuwa4ywlh3VQ6/Ol5pFAs3s6jCcLye2xYcc/J4iDi7u3De', 4, 'default.png', 'none', 1, '2022-01-27 00:52:24', NULL, '2022-01-27 00:52:24'),
(397, 'pembeli389', 'pembeli389@gmail.com', '$2y$10$rvpM6mSXUyHaf1hZFDnT6ujBNGDRoTuJOgmqp/Es2so39nS386dhm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:24', NULL, '2022-01-27 00:52:24'),
(398, 'pembeli390', 'pembeli390@gmail.com', '$2y$10$yLE0FjQLTINyt0CQ33qy2u9LPqYVefT0OnQM1BhX/8FT1bIckyqvu', 4, 'default.png', 'none', 1, '2022-01-27 00:52:24', NULL, '2022-01-27 00:52:24'),
(399, 'pembeli391', 'pembeli391@gmail.com', '$2y$10$UI/l2QdUs4vJF/jYY7p4w.2GOjzsudSenwiw6PD.AYeiI6y0ujKBm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:24', NULL, '2022-01-27 00:52:24'),
(400, 'pembeli392', 'pembeli392@gmail.com', '$2y$10$xfLVjiCkmb2ieDF6.fJCwOLifYuEy.2a/CjzJLSzeOLN4fbQz56Q.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:24', NULL, '2022-01-27 00:52:24'),
(401, 'pembeli393', 'pembeli393@gmail.com', '$2y$10$2j2uGPLnzvgGktGJxX27NOLA5WIKdavU41lzXMjQmC0b4GZaTlGRa', 4, 'default.png', 'none', 1, '2022-01-27 00:52:24', NULL, '2022-01-27 00:52:24'),
(402, 'pembeli394', 'pembeli394@gmail.com', '$2y$10$tv1xO/WTGJ.IgGGBLiL3tOSphr6WAn.gg/qTwz6ZDlSaPY0ZJEmL2', 4, 'default.png', 'none', 1, '2022-01-27 00:52:24', NULL, '2022-01-27 00:52:24'),
(403, 'pembeli395', 'pembeli395@gmail.com', '$2y$10$0enIcL2/XoCMfgu0dF8MY..b9hwXGqIgG4kY4Qf9L1q3iVeyhH/CC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:25', NULL, '2022-01-27 00:52:25'),
(404, 'pembeli396', 'pembeli396@gmail.com', '$2y$10$erHQHl/NfisC9XDXEyKI5.H4VyHxdyF0dGW1SYhsz2TXdvCWXSvbO', 4, 'default.png', 'none', 1, '2022-01-27 00:52:25', NULL, '2022-01-27 00:52:25'),
(405, 'pembeli397', 'pembeli397@gmail.com', '$2y$10$xXvk3fp4rn.mNHI5qy8OFel8xkJ992yMQB29iDYkiV49fqA/EviM2', 4, 'default.png', 'none', 1, '2022-01-27 00:52:25', NULL, '2022-01-27 00:52:25'),
(406, 'pembeli398', 'pembeli398@gmail.com', '$2y$10$5iYSedLpHyUUX2LJYhTYOeLTM1kNwH7fv4NA7BX64Vg0nYhf3/OFq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:25', NULL, '2022-01-27 00:52:25'),
(407, 'pembeli399', 'pembeli399@gmail.com', '$2y$10$beYUGSug8juXo14TDHiLlOiKM2DrLa1k3PyknXETf/w3nG4z4j4pa', 4, 'default.png', 'none', 1, '2022-01-27 00:52:25', NULL, '2022-01-27 00:52:25'),
(408, 'pembeli400', 'pembeli400@gmail.com', '$2y$10$/EZSitiVoHfsTxzNErfHQOGbugii0avCIte0xxyIGmhr32vpO.bGq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:25', NULL, '2022-01-27 00:52:25'),
(409, 'pembeli401', 'pembeli401@gmail.com', '$2y$10$o9jAEJEhDnBlEBBsUNnXNOIL2nJ/p9Dk/OM097Oy9uMXMq5C0vLZe', 4, 'default.png', 'none', 1, '2022-01-27 00:52:25', NULL, '2022-01-27 00:52:25'),
(410, 'pembeli402', 'pembeli402@gmail.com', '$2y$10$fAC4JPBnf9/.r0unUiXgte54rxNp0ZoWQ0k927fCFhLgXM/bPAQX6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:26', NULL, '2022-01-27 00:52:26'),
(411, 'pembeli403', 'pembeli403@gmail.com', '$2y$10$7koc.zIHKLmG4OibeDFclutJXvSSnaXciQ8wCA3EQHdNH0bwQsM26', 4, 'default.png', 'none', 1, '2022-01-27 00:52:26', NULL, '2022-01-27 00:52:26'),
(412, 'pembeli404', 'pembeli404@gmail.com', '$2y$10$Z/1dPrbuUNObHPZ2hfgCpevyZAnQA3HexQiRGnNGue6uY/Rv/0wtS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:26', NULL, '2022-01-27 00:52:26'),
(413, 'pembeli405', 'pembeli405@gmail.com', '$2y$10$jy5HAabwsd7v3U4TCVhS/u5jeC.SgsoSOs4ZC0jMWIFpSLc5dKQxa', 4, 'default.png', 'none', 1, '2022-01-27 00:52:26', NULL, '2022-01-27 00:52:26'),
(414, 'pembeli406', 'pembeli406@gmail.com', '$2y$10$qdURU2NiUP8v3OvgrutPdOv4ckRfufQ.AVjMfedxLBQDqPhReZ/R.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:26', NULL, '2022-01-27 00:52:26'),
(415, 'pembeli407', 'pembeli407@gmail.com', '$2y$10$cKiC5v8jF5Hng7KsAEW2YuyX5lL/lqdlyqOZfxs1esop6Urs3m/ve', 4, 'default.png', 'none', 1, '2022-01-27 00:52:26', NULL, '2022-01-27 00:52:26'),
(416, 'pembeli408', 'pembeli408@gmail.com', '$2y$10$5KEymKr44HblwYSyQL3qFOBKAJc.pqasexB617iJVVaabx/4nhlgC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:27', NULL, '2022-01-27 00:52:27'),
(417, 'pembeli409', 'pembeli409@gmail.com', '$2y$10$6U6nMEvmGpYwCLherCOsYuyBLTdrLAfwWlRUPTxSpkMofanGz8hV6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:27', NULL, '2022-01-27 00:52:27'),
(418, 'pembeli410', 'pembeli410@gmail.com', '$2y$10$i9ohPwEx0dUgAF5v3/jdO.r2S7o2PcH38YZn6u7MftAw6iolkaeqe', 4, 'default.png', 'none', 1, '2022-01-27 00:52:27', NULL, '2022-01-27 00:52:27'),
(419, 'pembeli411', 'pembeli411@gmail.com', '$2y$10$FL0qbeQ0TNMe8Rwv5nsO3uFv5MmFPRpnOZ4V7Zl23ZheLsHRiSAem', 4, 'default.png', 'none', 1, '2022-01-27 00:52:27', NULL, '2022-01-27 00:52:27'),
(420, 'pembeli412', 'pembeli412@gmail.com', '$2y$10$uHWz.2D2zwAiik4oEDI7UeYlMORN41G2oR/6miNrLfgx5dNqJc.vS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:27', NULL, '2022-01-27 00:52:27'),
(421, 'pembeli413', 'pembeli413@gmail.com', '$2y$10$QY/WIoNynszjkTos6euw.O6zaoQCcKszKXw851zvSDYAv.HCD6/sG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:27', NULL, '2022-01-27 00:52:27'),
(422, 'pembeli414', 'pembeli414@gmail.com', '$2y$10$r300mqnFdOxJ7gpwonqlTOAdzyeexa3XAERN41hWEBCX/1TU71JPK', 4, 'default.png', 'none', 1, '2022-01-27 00:52:27', NULL, '2022-01-27 00:52:27'),
(423, 'pembeli415', 'pembeli415@gmail.com', '$2y$10$tXPnO3GjVxTjCN7BZQLh7OpSLJwZymWRz7jC/lA50/7YxIbwKDkZa', 4, 'default.png', 'none', 1, '2022-01-27 00:52:28', NULL, '2022-01-27 00:52:28'),
(424, 'pembeli416', 'pembeli416@gmail.com', '$2y$10$JrK04PG0hKLogEPwb9jI0.H/m3Hd3RfFbCcFWvoJzmL7USAZ5koZq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:28', NULL, '2022-01-27 00:52:28'),
(425, 'pembeli417', 'pembeli417@gmail.com', '$2y$10$ylwEYHoJFqAHl/o7PPUbCeDI.zj1ljxSc7PNIXadCXpAC0qPFCSoC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:28', NULL, '2022-01-27 00:52:28'),
(426, 'pembeli418', 'pembeli418@gmail.com', '$2y$10$1kN4PAPdjs5Z2NWoZJjjTODX83ZLo9R7Yk7J8Iytr/uIY2wLADHTW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:28', NULL, '2022-01-27 00:52:28'),
(427, 'pembeli419', 'pembeli419@gmail.com', '$2y$10$tX9GDaVI9xUZEC9oBOsIOewGH7mDliAbFJ9CSDCOkd3UNqANTaBIm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:28', NULL, '2022-01-27 00:52:28'),
(428, 'pembeli420', 'pembeli420@gmail.com', '$2y$10$ZHrAhV0qqLusyOc0duIKLe23fMW0Cbn6fgDOopsvowmAnOoR7TJ..', 4, 'default.png', 'none', 1, '2022-01-27 00:52:28', NULL, '2022-01-27 00:52:28'),
(429, 'pembeli421', 'pembeli421@gmail.com', '$2y$10$Kno2jz7HBsq6DvtYjkdtsuyDu7N8XGb.rvSaJHKeWaptSpDwhf0g2', 4, 'default.png', 'none', 1, '2022-01-27 00:52:28', NULL, '2022-01-27 00:52:28'),
(430, 'pembeli422', 'pembeli422@gmail.com', '$2y$10$pipleJlgNnYCtIGDhv8Fdu4hZYCFWe5vaJXL4CZVALepmrBtSCd.a', 4, 'default.png', 'none', 1, '2022-01-27 00:52:28', NULL, '2022-01-27 00:52:28'),
(431, 'pembeli423', 'pembeli423@gmail.com', '$2y$10$0XT6hD18KbgLhrHzaIPZj.i1c5Oua10pNzTznlGEeqMcLQVlHBhl6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:28', NULL, '2022-01-27 00:52:28'),
(432, 'pembeli424', 'pembeli424@gmail.com', '$2y$10$l0seFt5Oo7H0l9GUkeFLzuawQhsu/agTB1Gr9CZhHmaEvhCnugMTq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:29', NULL, '2022-01-27 00:52:29'),
(433, 'pembeli425', 'pembeli425@gmail.com', '$2y$10$6Q7kJ7AI9AFkvJIhUfW8Pes5vJIZEZGJodYGfPRAk38bSL1zoko6C', 4, 'default.png', 'none', 1, '2022-01-27 00:52:29', NULL, '2022-01-27 00:52:29'),
(434, 'pembeli426', 'pembeli426@gmail.com', '$2y$10$oa8yRHxW93e3ITUsfNtq8OmRf4AJMyLqVPpJs7uhSO.phX5WiE3ba', 4, 'default.png', 'none', 1, '2022-01-27 00:52:29', NULL, '2022-01-27 00:52:29'),
(435, 'pembeli427', 'pembeli427@gmail.com', '$2y$10$LEGWKZUvoB0f8mLYBaE1NOVY3FCSpxghJ8UZt04uQXyaIXvHvqvkW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:29', NULL, '2022-01-27 00:52:29'),
(436, 'pembeli428', 'pembeli428@gmail.com', '$2y$10$EKd3QMzACL96/LSulYH5v.pSUTc4KO1l.R5OTRb6H3Qh3UhalpmTy', 4, 'default.png', 'none', 1, '2022-01-27 00:52:29', NULL, '2022-01-27 00:52:29'),
(437, 'pembeli429', 'pembeli429@gmail.com', '$2y$10$1g7.GIC0KPD86elx0eWyCO1RcAS/AL0u1f6tpkdN1tHysLMwwZTJ2', 4, 'default.png', 'none', 1, '2022-01-27 00:52:29', NULL, '2022-01-27 00:52:29'),
(438, 'pembeli430', 'pembeli430@gmail.com', '$2y$10$CKcDivIJQ8gfjlq.FpzPKe7AO1fFxDHqT3qrdQy.md51nQ5uzuLvi', 4, 'default.png', 'none', 1, '2022-01-27 00:52:29', NULL, '2022-01-27 00:52:29'),
(439, 'pembeli431', 'pembeli431@gmail.com', '$2y$10$CpKtvIrv28qr2kL3.xx/q.AhSHoDBIEwhlWnFr1FQf23hEM2s5Gfm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:30', NULL, '2022-01-27 00:52:30'),
(440, 'pembeli432', 'pembeli432@gmail.com', '$2y$10$BMSJTmtRCfL0LH8LrcPIP.z9dF.41.Pa4NNuqzRZrDXRLauNhNCke', 4, 'default.png', 'none', 1, '2022-01-27 00:52:30', NULL, '2022-01-27 00:52:30'),
(441, 'pembeli433', 'pembeli433@gmail.com', '$2y$10$xzJG67YhrQADs91OhYACVOhb.xw7exU7AOeqmm35doi3W2kNCjOSy', 4, 'default.png', 'none', 1, '2022-01-27 00:52:30', NULL, '2022-01-27 00:52:30'),
(442, 'pembeli434', 'pembeli434@gmail.com', '$2y$10$2MMI/igx1T1P3KYmJjYGBe0gQ3pQPp/twznkGzKqmutXwmRcKY8De', 4, 'default.png', 'none', 1, '2022-01-27 00:52:30', NULL, '2022-01-27 00:52:30'),
(443, 'pembeli435', 'pembeli435@gmail.com', '$2y$10$Gn2GC9RxYpcX9RHoaJTuvufIZpR32OSB/hpLV3xuukcanhvTKh2Bq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:30', NULL, '2022-01-27 00:52:30'),
(444, 'pembeli436', 'pembeli436@gmail.com', '$2y$10$gfWQE1D4D8tBYCoeMVOswuJHc6arKBqvxEveV5.joFYI8A0fPqmAK', 4, 'default.png', 'none', 1, '2022-01-27 00:52:31', NULL, '2022-01-27 00:52:31'),
(445, 'pembeli437', 'pembeli437@gmail.com', '$2y$10$gyEp04uMgPX3GSLAEyEwueC/dHrKTLXdrr8W3KXvQNblKXNTYXXMe', 4, 'default.png', 'none', 1, '2022-01-27 00:52:31', NULL, '2022-01-27 00:52:31'),
(446, 'pembeli438', 'pembeli438@gmail.com', '$2y$10$8P.9p92LmOId8NzJgUJu7OhjJXpqB1XiwPLIMYNo9IeP9HiuxNJm6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:31', NULL, '2022-01-27 00:52:31'),
(447, 'pembeli439', 'pembeli439@gmail.com', '$2y$10$SELwF7kQodKVPBshQ.hwyu1j6pwKB4CgLBxolGt7NONcv4nqXuHbq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:31', NULL, '2022-01-27 00:52:31'),
(448, 'pembeli440', 'pembeli440@gmail.com', '$2y$10$H1R4NpcH8ljkS4UKrsWLkutLs7iZlQPdBHvNXXzu.0S/YKsPwEjTW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:31', NULL, '2022-01-27 00:52:31'),
(449, 'pembeli441', 'pembeli441@gmail.com', '$2y$10$lkdCY3XsmmFrUmvWdxUjD.ob5L3zaqG5BzLkFd0diXEnrAdq4Y3KC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:31', NULL, '2022-01-27 00:52:31'),
(450, 'pembeli442', 'pembeli442@gmail.com', '$2y$10$qsxURo.TgK14JuY59LJkve9EHaisHaiXhqOEPYpePWhZbrFu9aHGa', 4, 'default.png', 'none', 1, '2022-01-27 00:52:31', NULL, '2022-01-27 00:52:31'),
(451, 'pembeli443', 'pembeli443@gmail.com', '$2y$10$uZW4jwVGamtDiJ2juNWmvuLfLKcTFdE0EWfDZuAPMEaejnanTwrfS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:32', NULL, '2022-01-27 00:52:32'),
(452, 'pembeli444', 'pembeli444@gmail.com', '$2y$10$xJoASwVgFKKiLWKJYTLe9.uN/p9ydlLTEqC9Hs9Oq0gFGDiNrBh3a', 4, 'default.png', 'none', 1, '2022-01-27 00:52:32', NULL, '2022-01-27 00:52:32'),
(453, 'pembeli445', 'pembeli445@gmail.com', '$2y$10$FqkYKibH8z00TTb5L3kEYOuekR17j5PVSU7ON1xKe/30oYERTdB3W', 4, 'default.png', 'none', 1, '2022-01-27 00:52:32', NULL, '2022-01-27 00:52:32'),
(454, 'pembeli446', 'pembeli446@gmail.com', '$2y$10$B71NH/1tlRWzwx/0qYz0peLc8DN2xCzZpoLgeYUvWoYlyTA1Qein6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:32', NULL, '2022-01-27 00:52:32'),
(455, 'pembeli447', 'pembeli447@gmail.com', '$2y$10$Js0RvnnzUagE/EowDjxtoeFSSWq1exzZkj.Yp8yG8qsX1hRPrEyC6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:32', NULL, '2022-01-27 00:52:32'),
(456, 'pembeli448', 'pembeli448@gmail.com', '$2y$10$BQSQmUn3Aim6zTrl2uxl4.6sAPrcf.8Kn/iQ1VRjtVqkPuZiqObiy', 4, 'default.png', 'none', 1, '2022-01-27 00:52:32', NULL, '2022-01-27 00:52:32'),
(457, 'pembeli449', 'pembeli449@gmail.com', '$2y$10$DnYw0kf5kfbsqGwj2Hd2F.eFKCGxlFEou8LMjiiQ.m3exlDsA1tlG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:33', NULL, '2022-01-27 00:52:33'),
(458, 'pembeli450', 'pembeli450@gmail.com', '$2y$10$/bXVAx74a6JWEEhsOxGI7.CTnMqV49Qgrbe3he6ur4IPPJrHC0JWW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:33', NULL, '2022-01-27 00:52:33'),
(459, 'pembeli451', 'pembeli451@gmail.com', '$2y$10$kD4i0oTqqitcR.OdZksow.9Gk3hlfzlCERA1.EUuZRVYXiTv/R8rS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:33', NULL, '2022-01-27 00:52:33'),
(460, 'pembeli452', 'pembeli452@gmail.com', '$2y$10$o4.Dyon6Fxlb3.zaTeNy2uyERnqc4ZdK.NH64vKUFbQRetsUX/NGG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:33', NULL, '2022-01-27 00:52:33'),
(461, 'pembeli453', 'pembeli453@gmail.com', '$2y$10$kapQV6CCxVIT70GdyMIDdun3WDgSSMbplGxHQpYe4utZSviZIZ57W', 4, 'default.png', 'none', 1, '2022-01-27 00:52:33', NULL, '2022-01-27 00:52:33'),
(462, 'pembeli454', 'pembeli454@gmail.com', '$2y$10$PyrIfPnBeoP88MPa3wwRBuMP7drdIdP2Bz5xdiwbYTkZLyTASM.cq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:33', NULL, '2022-01-27 00:52:33'),
(463, 'pembeli455', 'pembeli455@gmail.com', '$2y$10$BISjH0lcQN9UA5/ZCV34x.Fh.WM3aTaakkDC9RayLYBIbwwjbpENe', 4, 'default.png', 'none', 1, '2022-01-27 00:52:34', NULL, '2022-01-27 00:52:34'),
(464, 'pembeli456', 'pembeli456@gmail.com', '$2y$10$vdD0EEpM5BSLahaXVTqOPeGOZ4K0Fiyx8FYplNcOTWUmeTJQuLEEy', 4, 'default.png', 'none', 1, '2022-01-27 00:52:34', NULL, '2022-01-27 00:52:34'),
(465, 'pembeli457', 'pembeli457@gmail.com', '$2y$10$E.BvwCte3JSWbPgmTVDggezw2ywpuJfKmXNt9oXaJLhBNNW39gmvG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:34', NULL, '2022-01-27 00:52:34'),
(466, 'pembeli458', 'pembeli458@gmail.com', '$2y$10$pEfGn8YADfHIWi6ug.eZp.H6wrJ6NRcgUiKvGUJuYcY.eQDhPFVAO', 4, 'default.png', 'none', 1, '2022-01-27 00:52:34', NULL, '2022-01-27 00:52:34'),
(467, 'pembeli459', 'pembeli459@gmail.com', '$2y$10$zgOVb45jU1tJVSbtKZB3aeTw3vQJtHf5ySjfSrnQf9ZLqanDaPRYC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:34', NULL, '2022-01-27 00:52:34'),
(468, 'pembeli460', 'pembeli460@gmail.com', '$2y$10$Q/uyXEFE6kmku1TaRWRcWefgR2sbwWfcfmDIuDkV9kYbn5L4TFbaO', 4, 'default.png', 'none', 1, '2022-01-27 00:52:35', NULL, '2022-01-27 00:52:35'),
(469, 'pembeli461', 'pembeli461@gmail.com', '$2y$10$ytxkNNenrTtZa7I2miMgr.FHeMoIRIuFRG4Q7.ntKKWKaBvB9/B5S', 4, 'default.png', 'none', 1, '2022-01-27 00:52:35', NULL, '2022-01-27 00:52:35'),
(470, 'pembeli462', 'pembeli462@gmail.com', '$2y$10$SQ4rpI2brBuF0JP/edulqe58Qe10hvUY4iCTz923aQhgaY7IFNBfS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:35', NULL, '2022-01-27 00:52:35'),
(471, 'pembeli463', 'pembeli463@gmail.com', '$2y$10$wXOOOGNA.6pA0hqIzq57CeDVXKB1nQ4gFXQoqrO5nEeZFDoc0eGIK', 4, 'default.png', 'none', 1, '2022-01-27 00:52:35', NULL, '2022-01-27 00:52:35'),
(472, 'pembeli464', 'pembeli464@gmail.com', '$2y$10$W0qr8O1e6pf.tIQmNzUQH.MN0FIcYnBj9CecNFuitRcbUQZ8JA7kW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:35', NULL, '2022-01-27 00:52:35'),
(473, 'pembeli465', 'pembeli465@gmail.com', '$2y$10$lrtBCineKvfeT9EMIn2THe1XXONhnfBMo3RCiRBzjT5utArLUFhoC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:35', NULL, '2022-01-27 00:52:35'),
(474, 'pembeli466', 'pembeli466@gmail.com', '$2y$10$lUlucuMJs9NbESjbKLMdeels9kMbyFokJhybakySIDgwAV4266ElK', 4, 'default.png', 'none', 1, '2022-01-27 00:52:35', NULL, '2022-01-27 00:52:35'),
(475, 'pembeli467', 'pembeli467@gmail.com', '$2y$10$.rhsCc/vac6gtr0vEq9Ztes6XiNdGL4IdJexw8tnHNl7bO.itEzru', 4, 'default.png', 'none', 1, '2022-01-27 00:52:35', NULL, '2022-01-27 00:52:35'),
(476, 'pembeli468', 'pembeli468@gmail.com', '$2y$10$mMPCmm/XtIizs0Q/EL/0quLHtRW3pz2/6joupEgGP.xDYB15WD7Rm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:36', NULL, '2022-01-27 00:52:36'),
(477, 'pembeli469', 'pembeli469@gmail.com', '$2y$10$05dptQvhLry/wwZVmKNVGeN0p6WZQXvzQ/Z4Q3MVdcQsOEUUCwra6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:36', NULL, '2022-01-27 00:52:36'),
(478, 'pembeli470', 'pembeli470@gmail.com', '$2y$10$dn45TpGX/2GSuiUs1wthZeefsyTdiITA60LQ382Ha9cKKB4AtKk3O', 4, 'default.png', 'none', 1, '2022-01-27 00:52:36', NULL, '2022-01-27 00:52:36'),
(479, 'pembeli471', 'pembeli471@gmail.com', '$2y$10$UnhdeILCJbhXEhBp339jguRdhfEGYD7fq9vmPLjDf0gPkWpYllEZW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:36', NULL, '2022-01-27 00:52:36'),
(480, 'pembeli472', 'pembeli472@gmail.com', '$2y$10$WvzysWWDsXUy90wfszKPd.jwnCQgr5VfQ.qaCKxnS74MUYpQrAC92', 4, 'default.png', 'none', 1, '2022-01-27 00:52:36', NULL, '2022-01-27 00:52:36'),
(481, 'pembeli473', 'pembeli473@gmail.com', '$2y$10$0P0pZUDKaTZ7YjS1rex09e6NP8duegh7zux6XexVRbH3.Vkrd2KBC', 4, 'default.png', 'none', 1, '2022-01-27 00:52:36', NULL, '2022-01-27 00:52:36'),
(482, 'pembeli474', 'pembeli474@gmail.com', '$2y$10$LqxIbLNiNV1mIu4EGag4VOgkNsgwuhOMLIGwm6l8QmTuHmn2Q775.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:36', NULL, '2022-01-27 00:52:36'),
(483, 'pembeli475', 'pembeli475@gmail.com', '$2y$10$WEmtZlcAYIR2kwnj0TK/7utHHN9aGdvvPPQfooWEKPGHkcW7yqk.y', 4, 'default.png', 'none', 1, '2022-01-27 00:52:36', NULL, '2022-01-27 00:52:36'),
(484, 'pembeli476', 'pembeli476@gmail.com', '$2y$10$vlLcrIQHEvGWasDJ7d6kn.3Lrsy.9t/MWlhQfhdP2bCAlxs4Ud1L2', 4, 'default.png', 'none', 1, '2022-01-27 00:52:37', NULL, '2022-01-27 00:52:37'),
(485, 'pembeli477', 'pembeli477@gmail.com', '$2y$10$lO2tol35RrgRWLW2sS7oMuI3hQ8UaortfHObFFDD0kNrZGA2e0L7K', 4, 'default.png', 'none', 1, '2022-01-27 00:52:37', NULL, '2022-01-27 00:52:37'),
(486, 'pembeli478', 'pembeli478@gmail.com', '$2y$10$/TuJzJx9mhLQJTPW9qQjMeex4V08OPaFo2EMV2nueaiLgcCjMk23K', 4, 'default.png', 'none', 1, '2022-01-27 00:52:37', NULL, '2022-01-27 00:52:37'),
(487, 'pembeli479', 'pembeli479@gmail.com', '$2y$10$PYjZgzipREcawZDAyizR8uA4qJgmcMOGG6IZllY3Pf.CyPao73KpW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:37', NULL, '2022-01-27 00:52:37'),
(488, 'pembeli480', 'pembeli480@gmail.com', '$2y$10$jpRwPJ.FRn5e6A.qDf63cOnINa2J8CDTWs9PARwklUCHmo2WiaTEW', 4, 'default.png', 'none', 1, '2022-01-27 00:52:37', NULL, '2022-01-27 00:52:37'),
(489, 'pembeli481', 'pembeli481@gmail.com', '$2y$10$YZewKLEi/bh1EF0/kFslWuM723bTgfMksWYKxG39x5MOUr4sr14ri', 4, 'default.png', 'none', 1, '2022-01-27 00:52:37', NULL, '2022-01-27 00:52:37'),
(490, 'pembeli482', 'pembeli482@gmail.com', '$2y$10$5psquxi49us.8H5VsAPJI.m2lmpWaXOpR8yPonpPq6K2ekh7dxaNe', 4, 'default.png', 'none', 1, '2022-01-27 00:52:37', NULL, '2022-01-27 00:52:37'),
(491, 'pembeli483', 'pembeli483@gmail.com', '$2y$10$lH1yLs0LJ2pBx2XGF9c8rOmu2p7AwFuw/zCXSzKmg/1Wjk/xf5FTu', 4, 'default.png', 'none', 1, '2022-01-27 00:52:38', NULL, '2022-01-27 00:52:38'),
(492, 'pembeli484', 'pembeli484@gmail.com', '$2y$10$DX27wmAZ3PonjrTCVa6JWeBLt5NzsMCzOPmCK8uClcDzQkGfJTFke', 4, 'default.png', 'none', 1, '2022-01-27 00:52:38', NULL, '2022-01-27 00:52:38'),
(493, 'pembeli485', 'pembeli485@gmail.com', '$2y$10$ybhb9g4WLiB.f.ZR/LO/3.nxiIu8zvkDbsQHx4x5pG0.MNGEYMrfa', 4, 'default.png', 'none', 1, '2022-01-27 00:52:38', NULL, '2022-01-27 00:52:38'),
(494, 'pembeli486', 'pembeli486@gmail.com', '$2y$10$3O6Qd0jJKJINalltxwHrJ.SThCC2JMf.uQ6VW01ZVZiAELdAJDR9m', 4, 'default.png', 'none', 1, '2022-01-27 00:52:38', NULL, '2022-01-27 00:52:38'),
(495, 'pembeli487', 'pembeli487@gmail.com', '$2y$10$D3gKufLrv2Ml1Jvey1if3eyxeJhqSuH4JqOfQebrio7kIxElDrKOG', 4, 'default.png', 'none', 1, '2022-01-27 00:52:38', NULL, '2022-01-27 00:52:38'),
(496, 'pembeli488', 'pembeli488@gmail.com', '$2y$10$q4aSe/naxC3qrYMnVJJ72Oifgf0jPzulThK09lt0G3oEOZdEWgUGi', 4, 'default.png', 'none', 1, '2022-01-27 00:52:38', NULL, '2022-01-27 00:52:38'),
(497, 'pembeli489', 'pembeli489@gmail.com', '$2y$10$aellm26RpWDZRozFgCUxJOo0Zrx7aoXqtdcgs1ie0OuJ8lmKarrwe', 4, 'default.png', 'none', 1, '2022-01-27 00:52:38', NULL, '2022-01-27 00:52:38'),
(498, 'pembeli490', 'pembeli490@gmail.com', '$2y$10$t0xI9LnOy6cEvX52Z2DNju/yVOacNfeIGErDEsbOkZc/kUIRD13w.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:39', NULL, '2022-01-27 00:52:39'),
(499, 'pembeli491', 'pembeli491@gmail.com', '$2y$10$htw8ljTtYaE0B5M2DfFF6.il.idTtZtPAR0zLp1.cZiwtzARuG0L6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:39', NULL, '2022-01-27 00:52:39'),
(500, 'pembeli492', 'pembeli492@gmail.com', '$2y$10$RIaWeBoxzK5FHdIyTdBxf.9bvwLO2Wn3rNdAxZl0elTELiw.6FePS', 4, 'default.png', 'none', 1, '2022-01-27 00:52:39', NULL, '2022-01-27 00:52:39'),
(501, 'pembeli493', 'pembeli493@gmail.com', '$2y$10$ENPfqjo08pjYs/rmT3p/Ze7kIjF2QNeZ4KRW8CGII9OFfIrE78ZO.', 4, 'default.png', 'none', 1, '2022-01-27 00:52:39', NULL, '2022-01-27 00:52:39'),
(502, 'pembeli494', 'pembeli494@gmail.com', '$2y$10$V0eksScgk4vzTJ2R/kBDJeyZ6MjDI0AD.uSl9KLy/KqjSG0AO46pe', 4, 'default.png', 'none', 1, '2022-01-27 00:52:39', NULL, '2022-01-27 00:52:39'),
(503, 'pembeli495', 'pembeli495@gmail.com', '$2y$10$x4fik8AB.InrxM9jwJYMoexW9qscwySU/M2hIiU.2VAq5uECIrleq', 4, 'default.png', 'none', 1, '2022-01-27 00:52:39', NULL, '2022-01-27 00:52:39'),
(504, 'pembeli496', 'pembeli496@gmail.com', '$2y$10$qqdz3sQg2SLMwxQYYtPhM.HRfx7fvqsRISxHv9Xj06NrHbPiYa7XK', 4, 'default.png', 'none', 1, '2022-01-27 00:52:39', NULL, '2022-01-27 00:52:39'),
(505, 'pembeli497', 'pembeli497@gmail.com', '$2y$10$4ew9/vIb/8RURr1eal3HNeU.1BpAvxYNvwxGlAFlqGzYGjxGE9kpm', 4, 'default.png', 'none', 1, '2022-01-27 00:52:39', NULL, '2022-01-27 00:52:39'),
(506, 'pembeli498', 'pembeli498@gmail.com', '$2y$10$b8Y2/LkDSAgfh1OhynUEc.pHT19tgViz21GeNQM3nQm7I955V04.G', 4, 'default.png', 'none', 1, '2022-01-27 00:52:40', NULL, '2022-01-27 00:52:40'),
(507, 'pembeli499', 'pembeli499@gmail.com', '$2y$10$dCs/ynnK4d.aA5F.wgnoEeK2NoIrmbCWUtkB92cTjKctv5zo5r9e6', 4, 'default.png', 'none', 1, '2022-01-27 00:52:40', NULL, '2022-01-27 00:52:40'),
(508, 'pembeli500', 'pembeli500@gmail.com', '$2y$10$icR/V37USqGSDY1JlzJfK.93ej71nTvSL.DaUNFlsqeW0qelDw3.S', 4, 'default.png', 'none', 1, '2022-01-27 00:52:40', NULL, '2022-01-27 00:52:40'),
(510, 'pakpoo', 'erca.rihendri@gmail.com', '', 4, 'https://lh3.googleusercontent.com/a/AATXAJyxiWuSP0MrDNZkXBgTRRdtbm0bNwfu6UI3FpKx=s96-c', 'sso', 1, '2022-01-27 00:55:21', NULL, '2022-01-27 00:55:21'),
(511, 'Erik Rihendri Candra Adifa', '221810270@stis.ac.id', '', 4, 'https://lh3.googleusercontent.com/a-/AOh14Gir1lg38Px3GjISwB-cBk82IrZrWqMfMLu4sHaYfg=s96-c', 'sso', 0, '2022-01-27 01:24:38', NULL, '2022-01-27 01:43:49'),
(513, 'sadasdas', 'asdsadsad@dsfds.sdfsd', '$2y$10$uRuLj.V3SFKXYpxiHqiLb.iCWkyKokGfQCUE0cdz3G4fLBYq2Umui', 3, 'default', 'none', 1, '2022-05-19 11:55:58', NULL, '2022-05-19 11:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `created_at`, `deleted_at`, `updated_at`) VALUES
(45, 12, '2022-05-17 14:51:52', NULL, '2022-05-17 14:51:52'),
(46, 12, '2022-05-17 20:25:03', NULL, '2022-05-17 20:25:03'),
(47, 3, '2022-05-18 19:36:21', NULL, '2022-05-18 19:36:21'),
(48, 12, '2022-05-19 11:35:50', NULL, '2022-05-19 11:35:50'),
(49, 2, '2022-05-19 11:37:34', NULL, '2022-05-19 11:37:34'),
(50, 1, '2022-05-19 11:38:27', NULL, '2022-05-19 11:38:27'),
(51, 2, '2022-05-19 11:38:59', NULL, '2022-05-19 11:38:59'),
(52, 2, '2022-05-19 11:40:08', NULL, '2022-05-19 11:40:08'),
(53, 1, '2022-05-19 14:02:55', NULL, '2022-05-19 14:02:55'),
(54, 1, '2022-05-19 16:22:39', NULL, '2022-05-19 16:22:39'),
(55, 1, '2022-05-19 16:25:53', NULL, '2022-05-19 16:25:53'),
(56, 1, '2022-05-19 19:04:47', NULL, '2022-05-19 19:04:47'),
(57, 1, '2022-05-20 13:24:16', NULL, '2022-05-20 13:24:16'),
(58, 3, '2022-05-20 13:34:07', NULL, '2022-05-20 13:34:07'),
(59, 3, '2022-05-20 13:37:09', NULL, '2022-05-20 13:37:09'),
(60, 12, '2022-05-20 14:12:52', NULL, '2022-05-20 14:12:52'),
(61, 3, '2022-05-20 14:17:11', NULL, '2022-05-20 14:17:11'),
(62, 3, '2022-05-20 14:31:29', NULL, '2022-05-20 14:31:29'),
(63, 1, '2022-05-20 14:55:37', NULL, '2022-05-20 14:55:37'),
(64, 3, '2022-05-20 14:55:53', NULL, '2022-05-20 14:55:53'),
(65, 3, '2022-05-21 09:57:37', NULL, '2022-05-21 09:57:37'),
(66, 3, '2022-05-21 10:10:50', NULL, '2022-05-21 10:10:50'),
(67, 3, '2022-05-21 15:53:05', NULL, '2022-05-21 15:53:05'),
(68, 3, '2022-05-21 16:29:43', NULL, '2022-05-21 16:29:43'),
(69, 2, '2022-05-21 18:01:03', NULL, '2022-05-21 18:01:03'),
(70, 2, '2022-05-21 18:06:48', NULL, '2022-05-21 18:06:48'),
(71, 3, '2022-05-21 20:10:48', NULL, '2022-05-21 20:10:48'),
(72, 2, '2022-05-21 20:13:45', NULL, '2022-05-21 20:13:45'),
(73, 12, '2022-05-21 20:23:53', NULL, '2022-05-21 20:23:53'),
(74, 8, '2022-05-21 20:43:24', NULL, '2022-05-21 20:43:24'),
(75, 18, '2022-05-21 20:43:41', NULL, '2022-05-21 20:43:41'),
(76, 2, '2022-05-22 19:03:11', NULL, '2022-05-22 19:03:11'),
(77, 2, '2022-05-22 19:04:58', NULL, '2022-05-22 19:04:58'),
(78, 12, '2022-05-22 19:16:42', NULL, '2022-05-22 19:16:42'),
(79, 3, '2022-05-22 19:42:55', NULL, '2022-05-22 19:42:55'),
(80, 14, '2022-05-22 20:58:11', NULL, '2022-05-22 20:58:11'),
(81, 2, '2022-05-22 21:03:10', NULL, '2022-05-22 21:03:10'),
(82, 3, '2022-05-22 21:08:43', NULL, '2022-05-22 21:08:43'),
(83, 14, '2022-05-23 11:14:35', NULL, '2022-05-23 11:14:35'),
(84, 3, '2022-05-23 11:16:42', NULL, '2022-05-23 11:16:42'),
(85, 14, '2022-05-23 19:00:27', NULL, '2022-05-23 19:00:27'),
(86, 14, '2022-05-23 19:24:56', NULL, '2022-05-23 19:24:56'),
(87, 12, '2022-05-23 19:25:15', NULL, '2022-05-23 19:25:15'),
(88, 12, '2022-05-23 19:25:47', NULL, '2022-05-23 19:25:47'),
(89, 12, '2022-05-23 19:26:36', NULL, '2022-05-23 19:26:36'),
(90, 12, '2022-05-23 19:27:33', NULL, '2022-05-23 19:27:33'),
(91, 12, '2022-05-23 19:29:18', NULL, '2022-05-23 19:29:18'),
(92, 12, '2022-05-23 19:29:55', NULL, '2022-05-23 19:29:55'),
(93, 12, '2022-05-23 20:00:09', NULL, '2022-05-23 20:00:09'),
(94, 12, '2022-05-23 20:21:28', NULL, '2022-05-23 20:21:28'),
(95, 12, '2022-05-24 08:34:39', NULL, '2022-05-24 08:34:39'),
(96, 3, '2022-05-24 11:03:57', NULL, '2022-05-24 11:03:57'),
(97, 3, '2022-05-24 15:12:28', NULL, '2022-05-24 15:12:28'),
(98, 12, '2022-05-24 15:16:48', NULL, '2022-05-24 15:16:48'),
(99, 3, '2022-05-24 15:19:35', NULL, '2022-05-24 15:19:35'),
(100, 3, '2022-05-24 15:42:07', NULL, '2022-05-24 15:42:07'),
(101, 3, '2022-05-24 19:20:44', NULL, '2022-05-24 19:20:44'),
(102, 20, '2022-05-24 19:22:48', NULL, '2022-05-24 19:22:48'),
(103, 1, '2022-05-24 19:28:47', NULL, '2022-05-24 19:28:47'),
(104, 3, '2022-05-24 19:38:32', NULL, '2022-05-24 19:38:32'),
(105, 3, '2022-05-24 19:42:10', NULL, '2022-05-24 19:42:10'),
(106, 1, '2022-05-24 20:00:30', NULL, '2022-05-24 20:00:30'),
(107, 1, '2022-05-24 20:03:38', NULL, '2022-05-24 20:03:38'),
(108, 3, '2022-05-24 20:03:50', NULL, '2022-05-24 20:03:50'),
(109, 2, '2022-05-24 20:05:30', NULL, '2022-05-24 20:05:30'),
(110, 1, '2022-05-24 20:38:30', NULL, '2022-05-24 20:38:30'),
(111, 12, '2022-05-24 20:43:56', NULL, '2022-05-24 20:43:56'),
(112, 3, '2022-05-24 20:44:22', NULL, '2022-05-24 20:44:22'),
(113, 2, '2022-05-24 20:46:25', NULL, '2022-05-24 20:46:25'),
(114, 3, '2022-05-24 22:24:32', NULL, '2022-05-24 22:24:32'),
(115, 3, '2022-05-25 10:38:40', NULL, '2022-05-25 10:38:40'),
(116, 3, '2022-05-25 10:58:13', NULL, '2022-05-25 10:58:13'),
(117, 3, '2022-05-25 10:59:45', NULL, '2022-05-25 10:59:45'),
(118, 12, '2022-05-25 18:03:44', NULL, '2022-05-25 18:03:44'),
(119, 12, '2022-05-25 18:05:58', NULL, '2022-05-25 18:05:58'),
(120, 3, '2022-05-25 18:06:41', NULL, '2022-05-25 18:06:41'),
(121, 3, '2022-05-25 20:16:56', NULL, '2022-05-25 20:16:56'),
(122, 12, '2022-05-25 20:19:38', NULL, '2022-05-25 20:19:38'),
(123, 12, '2022-05-25 21:18:37', NULL, '2022-05-25 21:18:37'),
(124, 12, '2022-05-25 21:20:00', NULL, '2022-05-25 21:20:00'),
(125, 12, '2022-05-26 10:35:17', NULL, '2022-05-26 10:35:17'),
(126, 3, '2022-05-26 11:45:20', NULL, '2022-05-26 11:45:20'),
(127, 3, '2022-05-26 12:07:25', NULL, '2022-05-26 12:07:25'),
(128, 3, '2022-05-26 13:00:52', NULL, '2022-05-26 13:00:52'),
(129, 12, '2022-05-26 18:58:49', NULL, '2022-05-26 18:58:49'),
(130, 12, '2022-05-26 19:01:28', NULL, '2022-05-26 19:01:28'),
(131, 12, '2022-05-26 19:14:27', NULL, '2022-05-26 19:14:27'),
(132, 12, '2022-05-26 20:01:23', NULL, '2022-05-26 20:01:23'),
(133, 3, '2022-05-26 20:25:53', NULL, '2022-05-26 20:25:53'),
(134, 3, '2022-05-26 20:32:21', NULL, '2022-05-26 20:32:21'),
(135, 510, '2022-05-26 22:12:53', NULL, '2022-05-26 22:12:53'),
(136, 3, '2022-05-26 22:15:34', NULL, '2022-05-26 22:15:34'),
(137, 1, '2022-05-26 22:17:00', NULL, '2022-05-26 22:17:00'),
(138, 1, '2022-05-26 22:19:25', NULL, '2022-05-26 22:19:25'),
(139, 3, '2022-05-26 22:20:05', NULL, '2022-05-26 22:20:05'),
(140, 3, '2022-05-26 22:36:34', NULL, '2022-05-26 22:36:34'),
(141, 12, '2022-05-26 22:36:51', NULL, '2022-05-26 22:36:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canteen_info`
--
ALTER TABLE `canteen_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dev_api`
--
ALTER TABLE `dev_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dev_users`
--
ALTER TABLE `dev_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toping`
--
ALTER TABLE `toping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_menu`
--
ALTER TABLE `transaction_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_toping`
--
ALTER TABLE `transaction_toping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `canteen_info`
--
ALTER TABLE `canteen_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dev_api`
--
ALTER TABLE `dev_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dev_users`
--
ALTER TABLE `dev_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `toping`
--
ALTER TABLE `toping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `transaction_menu`
--
ALTER TABLE `transaction_menu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `transaction_toping`
--
ALTER TABLE `transaction_toping`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=514;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
