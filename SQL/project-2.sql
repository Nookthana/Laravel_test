-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2022 at 02:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `title`, `created_at`, `updated_at`) VALUES
(96, 38, 'Movie', '2022-06-27 04:42:59', '2022-06-27 04:42:59'),
(97, 38, 'Cute', '2022-06-27 04:43:08', '2022-06-27 04:43:08'),
(98, 38, 'Cartoon', '2022-06-27 04:43:22', '2022-06-27 04:43:22'),
(99, 39, 'A', '2022-06-27 04:55:37', '2022-06-27 04:55:37'),
(100, 39, 'B', '2022-06-27 04:55:45', '2022-06-27 04:55:45'),
(101, 39, 'C', '2022-06-27 04:55:51', '2022-06-27 04:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categories_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` double(8,2) DEFAULT NULL,
  `mine` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `categories_id`, `user_id`, `src`, `size`, `mine`, `created_at`, `updated_at`) VALUES
(100, 96, 38, 'download (6).jpg', 13187.00, 'jpeg', '2022-06-27 04:42:59', '2022-06-27 04:42:59'),
(101, 97, 38, 'b87b2aee93311dfee1c79b036f4c4c58.gif', 91060.00, 'gif', '2022-06-27 04:43:08', '2022-06-27 04:43:08'),
(102, 98, 38, 'p4.png', 9010.00, 'png', '2022-06-27 04:43:22', '2022-06-27 04:43:22'),
(103, 96, 38, 'thor.jpg', 12342.00, 'jpeg', '2022-06-27 04:43:38', '2022-06-27 04:43:38'),
(104, 96, 38, 'download (5).jpg', 12738.00, 'jpeg', '2022-06-27 04:43:45', '2022-06-27 04:43:45'),
(105, 97, 38, 'p9fu9a8ftPFmDUF9KbT-o.gif', 140628.00, 'gif', '2022-06-27 04:43:49', '2022-06-27 04:43:49'),
(106, 97, 38, 'q4vays1eyVlOuB1FL7h-o.gif', 187640.00, 'gif', '2022-06-27 04:43:52', '2022-06-27 04:43:52'),
(107, 98, 38, 'p100.gif', 114822.00, 'gif', '2022-06-27 04:43:56', '2022-06-27 04:43:56'),
(108, 98, 38, '2b7d55e5d3a36162ce9c3b337b45b488.gif', 188829.00, 'gif', '2022-06-27 04:44:00', '2022-06-27 04:44:00'),
(109, 99, 39, 'download (1).jpg', 10920.00, 'jpeg', '2022-06-27 04:55:37', '2022-06-27 04:55:37'),
(110, 100, 39, 'download (2).jpg', 10021.00, 'jpeg', '2022-06-27 04:55:45', '2022-06-27 04:55:45'),
(111, 101, 39, 'download (4).jpg', 8636.00, 'jpeg', '2022-06-27 04:55:51', '2022-06-27 04:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_06_17_105705_create_categories_table', 1),
(5, '2022_06_17_105837_create_posts_table', 1),
(6, '2022_06_17_111851_add_is_admin_to_users_table', 1),
(7, '2022_06_20_072027_create_user_photo_table', 1),
(8, '2022_06_23_081129_create_gallery_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Luisa Roberts', 'lbayer@example.net', '2022-06-23 01:22:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'VLBTmyq2Fm', '2022-06-23 01:22:37', '2022-06-23 01:22:37', 0),
(2, 'Sigurd Bayer', 'hauck.novella@example.net', '2022-06-23 01:22:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9L0QlrciGJ', '2022-06-23 01:22:37', '2022-06-23 01:22:37', 0),
(3, 'Archibald Swift II', 'ronny67@example.org', '2022-06-23 01:22:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wo8rtUPHkf', '2022-06-23 01:22:37', '2022-06-23 01:22:37', 0),
(4, 'Miss Maida Howe', 'trent01@example.org', '2022-06-23 01:22:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'uzUNK3WjHn', '2022-06-23 01:22:37', '2022-06-23 01:22:37', 0),
(5, 'Dr. Oran Keeling', 'granville.rogahn@example.org', '2022-06-23 01:22:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'g4YPqC2mNX', '2022-06-23 01:22:37', '2022-06-23 01:22:37', 0),
(6, 'Dr. Dayton Mante', 'xbrown@example.com', '2022-06-23 01:22:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'D5GD3hb8W1', '2022-06-23 01:22:37', '2022-06-23 01:22:37', 0),
(7, 'Mrs. Pearlie Hoeger', 'rsawayn@example.net', '2022-06-23 01:22:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'c5AWXph3aR', '2022-06-23 01:22:37', '2022-06-23 01:22:37', 0),
(8, 'Dorris Bogisich', 'aida19@example.com', '2022-06-23 01:22:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CuzUd070hp', '2022-06-23 01:22:37', '2022-06-23 01:22:37', 0),
(9, 'Seth Keeling', 'dferry@example.com', '2022-06-23 01:22:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'f5h9MPc2Ir', '2022-06-23 01:22:37', '2022-06-23 01:22:37', 0),
(10, 'Norbert Bins I', 'ruecker.devin@example.org', '2022-06-23 01:22:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'WBnxpKenNL', '2022-06-23 01:22:37', '2022-06-23 01:22:37', 0),
(11, 'Monica Wehner III', 'cschulist@example.org', '2022-06-23 01:22:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '94lsMXnCL1', '2022-06-23 01:22:37', '2022-06-23 01:22:37', 1),
(12, 'Ivory Jaskolski', 'jevon.jerde@example.net', '2022-06-23 01:23:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'H83V5RZ6kW', '2022-06-23 01:23:33', '2022-06-23 01:23:33', 0),
(13, 'Domenick Prohaska', 'zlittel@example.net', '2022-06-23 01:23:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '57l3MZHRTS', '2022-06-23 01:23:33', '2022-06-23 01:23:33', 0),
(14, 'Paxton Becker DVM', 'monahan.jasen@example.org', '2022-06-23 01:23:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SHdzm7DTdZ', '2022-06-23 01:23:33', '2022-06-23 01:23:33', 0),
(15, 'Miss Jammie Johnston Jr.', 'khirthe@example.org', '2022-06-23 01:23:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'K1z550hVZY', '2022-06-23 01:23:33', '2022-06-23 01:23:33', 0),
(16, 'Maritza Ernser', 'hodkiewicz.norval@example.com', '2022-06-23 01:23:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yDmmW3RZpo', '2022-06-23 01:23:33', '2022-06-23 01:23:33', 0),
(17, 'Perry Kertzmann DDS', 'xschinner@example.net', '2022-06-23 01:23:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jUTP3LstB1', '2022-06-23 01:23:33', '2022-06-23 01:23:33', 0),
(18, 'Mollie Ebert', 'florine.kuphal@example.org', '2022-06-23 01:23:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'avpPv4FBvk', '2022-06-23 01:23:33', '2022-06-23 01:23:33', 0),
(19, 'Izaiah Greenfelder', 'trantow.ciara@example.org', '2022-06-23 01:23:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jEpK5HkQcb', '2022-06-23 01:23:33', '2022-06-23 01:23:33', 0),
(20, 'Forrest Bergstrom', 'zkilback@example.net', '2022-06-23 01:23:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'WuGrBup3P4', '2022-06-23 01:23:33', '2022-06-23 01:23:33', 0),
(21, 'Kaden Little', 'wuckert.margie@example.org', '2022-06-23 01:23:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pzMuoHuNsR', '2022-06-23 01:23:33', '2022-06-23 01:23:33', 0),
(22, 'Kylee Gusikowski', 'trent98@example.org', '2022-06-23 01:23:33', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cLQkAUjBfA', '2022-06-23 01:23:33', '2022-06-23 01:23:33', 1),
(24, 'Mr. Otto Kirlin', 'angelica.sauer@example.com', '2022-06-23 01:25:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ldoasd2kY2', '2022-06-23 01:25:04', '2022-06-23 01:25:04', 0),
(25, 'Prof. Jessie Lemke MD', 'xhuels@example.net', '2022-06-23 01:25:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'w9BfEoPpgP', '2022-06-23 01:25:04', '2022-06-23 01:25:04', 0),
(26, 'Mr. Arno Stoltenberg', 'lacy.lesch@example.org', '2022-06-23 01:25:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 's8Ld4gQXRo', '2022-06-23 01:25:04', '2022-06-23 01:25:04', 0),
(27, 'Prof. Derek Christiansen', 'flatley.hunter@example.org', '2022-06-23 01:25:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Y4k4xeGHLw', '2022-06-23 01:25:04', '2022-06-23 01:25:04', 0),
(28, 'Cordell Hyatt', 'gstroman@example.org', '2022-06-23 01:25:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fMv9QNB9TR', '2022-06-23 01:25:04', '2022-06-23 01:25:04', 0),
(29, 'Ms. Hortense Borer', 'fwisoky@example.net', '2022-06-23 01:25:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3P5QFXj2oX', '2022-06-23 01:25:04', '2022-06-23 01:25:04', 0),
(30, 'Mr. Cyril Marvin', 'liana57@example.com', '2022-06-23 01:25:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5sjV4hbWP8', '2022-06-23 01:25:04', '2022-06-23 01:25:04', 0),
(31, 'Coty Hermann', 'rodriguez.israel@example.org', '2022-06-23 01:25:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '4JtUzLaARt', '2022-06-23 01:25:04', '2022-06-23 01:25:04', 0),
(32, 'Oma Muller', 'leuschke.raoul@example.com', '2022-06-23 01:25:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'a3b4R0TMWA', '2022-06-23 01:25:04', '2022-06-23 01:25:04', 0),
(33, 'Mr. Quentin Armstrong', 'qdaugherty@example.net', '2022-06-23 01:25:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'PNfLlLAEdN', '2022-06-23 01:25:04', '2022-06-23 01:25:04', 1),
(38, 'Thana', 'Nookkub70@gmail.com', NULL, '$2y$10$QFabJqHZS81EzJz7KPYH3.5vGYxQwdmCknKFqHX2jVjDUFFM/eygG', NULL, '2022-06-27 04:42:13', '2022-06-27 04:42:13', 0),
(39, 'Mint', 'MIntKa90@gmail.com', NULL, '$2y$10$P/72jo4zx4525GO6WEv5MOPUGZWICU7K7zB8w97vLMyrZGzQV1YFu', NULL, '2022-06-27 04:55:05', '2022-06-27 04:55:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_photo`
--

CREATE TABLE `user_photo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` double(8,2) NOT NULL,
  `mine` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_photo`
--

INSERT INTO `user_photo` (`id`, `user_id`, `src`, `size`, `mine`, `created_at`, `updated_at`) VALUES
(42, 38, 'p9.png', 6602.00, 'png', '2022-06-27 04:42:23', '2022-06-27 04:42:23'),
(43, 38, 'p1.png', 8599.00, 'png', '2022-06-27 04:42:28', '2022-06-27 04:42:28'),
(44, 38, 'p4.png', 9010.00, 'png', '2022-06-27 04:42:40', '2022-06-27 04:42:40'),
(45, 38, 'p8.gif', 159760.00, 'gif', '2022-06-27 04:42:46', '2022-06-27 04:42:46'),
(46, 39, 'p3.jpg', 4476.00, 'jpeg', '2022-06-27 04:55:17', '2022-06-27 04:55:17'),
(47, 39, 'p9.png', 6602.00, 'png', '2022-06-27 04:55:22', '2022-06-27 04:55:22'),
(48, 39, 'p5.jpg', 6589.00, 'jpeg', '2022-06-27 04:55:25', '2022-06-27 04:55:25');

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
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_categories_id_foreign` (`categories_id`),
  ADD KEY `gallery_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_photo`
--
ALTER TABLE `user_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_photo_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_photo`
--
ALTER TABLE `user_photo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_categories_id_foreign` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gallery_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_photo`
--
ALTER TABLE `user_photo`
  ADD CONSTRAINT `user_photo_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
