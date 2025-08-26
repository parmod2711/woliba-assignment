-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 26, 2025 at 07:16 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `magic_links`
--

CREATE TABLE `magic_links` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '2025_08_24_151410_add_custom_fields_to_users_table', 1),
(4, '2025_08_24_151641_create_magic_links_table', 1),
(5, '2025_08_24_151804_create_wellness_interests_table', 1),
(6, '2025_08_24_151841_create_user_wellness_interest_table', 1),
(7, '2025_08_24_152820_create_wellbeing_pillars_table', 1),
(8, '2025_08_24_153347_create_user_wellbeing_pillar_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('NBCAuX729YaDMSwpV7BzyMScRVu2XyWQPeglOtsP', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1JCUE05S1pSd2tMcTdxQUZEcnZxNXJpOGs4YklVYjRxWko4M0FMViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756187988);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `confirmation_flag` tinyint(1) NOT NULL DEFAULT '0',
  `registration_complete` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `email_verification_otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `magic_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_expires_at` timestamp NULL DEFAULT NULL,
  `magic_token_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `company_name`, `contact_number`, `dob`, `confirmation_flag`, `registration_complete`, `email`, `email_verified`, `email_verification_otp`, `otp_expires_at`, `email_verified_at`, `password`, `remember_token`, `magic_token`, `token_expires_at`, `magic_token_used_at`, `created_at`, `updated_at`) VALUES
(2, 'Parmod', 'Kumar', 'Demo Company', '9729159515', '1988-06-15', 1, 1, 'parmod2711@gmail.com', 0, NULL, NULL, NULL, '$2y$12$Uen5Mf8EIBcefMYaE4.T1OWezAshzkhSZafQA2tG/bD9BID73j70q', NULL, 'vlRnvpAcNLgCoCF7IkzMFePrmKCkvUE8qgMHcQJ1JmBrWEYRtLsVEgK0hIQTLWK5', '2025-08-26 02:11:05', '2025-08-26 01:41:31', '2025-08-26 01:41:05', '2025-08-26 01:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_wellbeing_pillar`
--

CREATE TABLE `user_wellbeing_pillar` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `wellbeing_pillar_id` bigint UNSIGNED NOT NULL,
  `order` tinyint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_wellbeing_pillar`
--

INSERT INTO `user_wellbeing_pillar` (`id`, `user_id`, `wellbeing_pillar_id`, `order`) VALUES
(1, 2, 1, 1),
(2, 2, 2, 2),
(3, 2, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_wellness_interest`
--

CREATE TABLE `user_wellness_interest` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `wellness_interest_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_wellness_interest`
--

INSERT INTO `user_wellness_interest` (`id`, `user_id`, `wellness_interest_id`) VALUES
(1, 2, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `wellbeing_pillars`
--

CREATE TABLE `wellbeing_pillars` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wellbeing_pillars`
--

INSERT INTO `wellbeing_pillars` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Physical', '2025-08-25 23:22:37', '2025-08-25 23:22:37'),
(2, 'Mental', '2025-08-25 23:22:37', '2025-08-25 23:22:37'),
(3, 'Social', '2025-08-25 23:22:37', '2025-08-25 23:22:37'),
(4, 'Financial', '2025-08-25 23:22:37', '2025-08-25 23:22:37'),
(5, 'Emotional', '2025-08-25 23:22:37', '2025-08-25 23:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `wellness_interests`
--

CREATE TABLE `wellness_interests` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wellness_interests`
--

INSERT INTO `wellness_interests` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Yoga', '2025-08-25 23:22:37', '2025-08-25 23:22:37'),
(2, 'Meditation', '2025-08-25 23:22:37', '2025-08-25 23:22:37'),
(3, 'Fitness', '2025-08-25 23:22:37', '2025-08-25 23:22:37'),
(4, 'Nutrition', '2025-08-25 23:22:37', '2025-08-25 23:22:37'),
(5, 'Mindfulness', '2025-08-25 23:22:37', '2025-08-25 23:22:37'),
(6, 'Work-Life Balance', '2025-08-25 23:22:37', '2025-08-25 23:22:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `magic_links`
--
ALTER TABLE `magic_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `magic_links_token_unique` (`token`),
  ADD KEY `magic_links_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_magic_token_unique` (`magic_token`);

--
-- Indexes for table `user_wellbeing_pillar`
--
ALTER TABLE `user_wellbeing_pillar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_wellbeing_pillar_user_id_foreign` (`user_id`),
  ADD KEY `user_wellbeing_pillar_wellbeing_pillar_id_foreign` (`wellbeing_pillar_id`);

--
-- Indexes for table `user_wellness_interest`
--
ALTER TABLE `user_wellness_interest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_wellness_interest_user_id_foreign` (`user_id`),
  ADD KEY `user_wellness_interest_wellness_interest_id_foreign` (`wellness_interest_id`);

--
-- Indexes for table `wellbeing_pillars`
--
ALTER TABLE `wellbeing_pillars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wellness_interests`
--
ALTER TABLE `wellness_interests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `magic_links`
--
ALTER TABLE `magic_links`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_wellbeing_pillar`
--
ALTER TABLE `user_wellbeing_pillar`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_wellness_interest`
--
ALTER TABLE `user_wellness_interest`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wellbeing_pillars`
--
ALTER TABLE `wellbeing_pillars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wellness_interests`
--
ALTER TABLE `wellness_interests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `magic_links`
--
ALTER TABLE `magic_links`
  ADD CONSTRAINT `magic_links_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_wellbeing_pillar`
--
ALTER TABLE `user_wellbeing_pillar`
  ADD CONSTRAINT `user_wellbeing_pillar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_wellbeing_pillar_wellbeing_pillar_id_foreign` FOREIGN KEY (`wellbeing_pillar_id`) REFERENCES `wellbeing_pillars` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_wellness_interest`
--
ALTER TABLE `user_wellness_interest`
  ADD CONSTRAINT `user_wellness_interest_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_wellness_interest_wellness_interest_id_foreign` FOREIGN KEY (`wellness_interest_id`) REFERENCES `wellness_interests` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
