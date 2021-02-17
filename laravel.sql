-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 05, 2021 at 02:11 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2021_01_26_053016_create_tasks_table', 2),
(6, '2019_08_28_140846_create_projects_table', 3),
(7, '2021_01_28_072134_create_task_table', 4),
(8, '2021_01_28_085409_create_posts_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `target_selesai` date NOT NULL,
  `user_id` int(12) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bagian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `progress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_selesai` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `updated_at`, `target_selesai`, `user_id`, `name`, `jabatan`, `supervisi`, `bagian`, `bidang`, `progress`, `status`, `tanggal_selesai`) VALUES
(2, 'Supervisor Software', 'Task Supervisor Software IT', '2021-01-29 01:33:41', '2021-01-29 01:50:27', '2021-01-30', 3, 'Supervisor', 'Supervisor', 'Software', 'IT', 'Operasional', '70', 'Terkendala', NULL),
(3, 'Task Kabag IT', 'INI Task Kabag IT', '2021-01-29 01:34:29', '2021-01-29 01:34:29', '2021-01-30', 2, 'Kepala Bagian', 'Kabag', '0', 'IT', 'Operasional', '0', '-', NULL),
(4, 'Task VP', 'ini punya VP', '2021-01-29 01:35:01', '2021-01-29 01:35:01', '2021-01-30', 1, 'Vice President', 'Vp', '0', '0', '0', '0', '-', NULL),
(5, 'Bukan Staff Software', 'Bukan Staff Software', NULL, NULL, '2021-01-30', 8, 'Hardware', 'Staff', 'Hardware', 'IT', 'Operasional', '0', '-', NULL),
(6, 'Temen Software', 'Satu supervisi sama software', NULL, NULL, '2021-01-23', 7, 'Staff Supervisi Software', 'Staff', 'Software', 'IT', 'Operasional', '0', '-', NULL),
(7, 'Supervisi Hardware', 'Ini task supervisi hardware', NULL, NULL, '2021-01-30', 8, 'Supervisor Hardware', 'Staff', 'Hardware', 'IT', 'Operasional', '100', 'Selesai', '2021-02-04 10:06:07'),
(8, 'Ini dari Kabag Bisnis', 'Task punya kabag Bisnis', NULL, NULL, '2021-01-30', 10, 'Kabag Bisnis', 'Kabag', '0', 'Bisnis', 'Bukan Operasional', '0', '-', NULL),
(11, 'Supervisor sebelah', 'Bukan supervisor software', NULL, NULL, '2021-01-30', 10, 'Supervisor Hardware', 'Supervisor', 'Hardware', 'IT', 'Operasional', '0', '-', NULL),
(17, 'judul', 'punya supervisor software', '2021-02-01 07:29:51', '2021-02-01 07:29:51', '2021-02-20', 3, 'Supervisor', 'Supervisor', 'Software', 'IT', 'Operasional', '0', 'Sedang Dikerjakan', NULL),
(18, 'danang', 'kakak', '2021-02-01 07:59:41', '2021-02-04 19:07:02', '2021-02-26', 3, 'Supervisor', 'Supervisor', 'Software', 'IT', 'Operasional', '100', 'Selesai', '2021-02-04 19:07:02'),
(50, 'Judul 1', 'Deskripsi', '2021-02-04 19:05:25', '2021-02-04 19:05:42', '2021-02-06', 4, 'Staff', 'Staff', 'Software', 'IT', 'Operasional', '100', 'Selesai', '2021-02-04 19:05:42'),
(51, 'Judul 2', 'Deskripsi 2', '2021-02-04 19:05:57', '2021-02-04 21:21:43', '2021-02-27', 4, 'Staff', 'Staff', 'Software', 'IT', 'Operasional', '20', 'Dibatalkan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(12) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `bagian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `jabatan`, `supervisi`, `bagian`, `bidang`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Vice President', 'vp@mail.com', NULL, 'Vp', '0', '0', '0', '$2y$10$gQgeN5e7cLmIwlHloLpYm.1OlMGk.ZqTmJMP.HwfVV6/AF.9lqssm', NULL, '2021-01-28 20:18:18', '2021-01-28 20:18:18'),
(2, 'Kepala Bagian', 'kabag@mail.com', NULL, 'Kabag', '0', 'IT', 'Operasional', '$2y$10$xpLiOmq.GDaiasg04S6mN.vXMV5Pb226VkvnMbO4.eOMba8tO4hJu', NULL, '2021-01-28 20:18:18', '2021-01-28 20:18:18'),
(3, 'Supervisor', 'spv@mail.com', NULL, 'Supervisor', 'Software', 'IT', 'Operasional', '$2y$10$P9a6vYbpzoWXsHnVC0716eJbU087xMHaaG/v3kYr3O7CfEJV1oGQm', NULL, '2021-01-28 20:18:18', '2021-01-28 20:18:18'),
(4, 'Staff', 'staff@mail.com', NULL, 'Staff', 'Software', 'IT', 'Operasional', '$2y$10$PO1FLRwa189Ro3K8Webe9e3g.u4TVG/79cxe1rDfaXC2sJ.7eK5LG', NULL, '2021-01-28 20:18:18', '2021-01-28 20:18:18'),
(5, 'Staff2', 'staff2@mail.com', NULL, 'Staff', 'Software', 'IT', 'Operasional', '$2y$10$1QpCAaI5YlKPX1xGhvsuGOUrog1zv3uoWVnLFeTCccs58n7ukEvi6', NULL, '2021-01-28 20:18:18', '2021-01-28 20:18:18'),
(6, 'Staff3', 'staff3@mail.com', NULL, 'Staff', 'Software', 'IT', 'Operasional', '$2y$10$soCpKGvrDzgFeoinxKb97ufoS40ixLIohplmi3/lDUB8ITtYL3cNC', NULL, '2021-01-28 20:18:18', '2021-01-28 20:18:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
