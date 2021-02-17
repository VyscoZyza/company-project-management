-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2021 at 07:15 AM
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
  `user_id` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'Judul', 'Deskripsi', '2021-02-13 19:32:33', '2021-02-13 20:08:07', '2021-02-27', '1000000004', 'Staff', 'Staff', 'Software', 'IT', 'Operasional', '100', 'Selesai', '2021-02-13 20:08:07'),
(2, 'task supervisor software', '12121', '2021-02-13 20:33:21', '2021-02-13 20:33:21', '2021-02-18', '1000000003', 'Supervisor', 'Supervisor', 'Software', 'IT', 'Operasional', '30', 'Ditunda', NULL),
(3, 'iini kabag', 'asdasd', '2021-02-13 20:39:10', '2021-02-13 20:39:10', '2021-02-18', '1000000002', 'Kepala Bagian', 'Kabag', '0', 'IT', 'Operasional', '30', 'Ditunda', NULL),
(4, 'judul vp', 'deskripsiintyaaaaaa', '2021-02-13 20:44:37', '2021-02-13 20:44:48', '2021-02-19', '1000000001', 'Vice President', 'Vp', '0', '0', '0', '80', 'Ditunda', NULL),
(5, 'Job 15 Feb', 'contoh desc', '2021-02-14 20:19:20', '2021-02-16 20:19:43', '2021-02-28', '1000000004', 'Staff', 'Staff', 'Software', 'IT', 'Operasional', '50', 'Sedang Dikerjakan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(12) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(2) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `bagian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `level`, `email_verified_at`, `jabatan`, `supervisi`, `bagian`, `bidang`, `password`, `remember_token`, `created_at`, `updated_at`, `uid`) VALUES
(1, 'Admin', 'Admin@mail.com', 0, NULL, 'Admin', '0', '0', '0', '$2y$10$KSY/Zo9fBQ1YxhGD6bcffOmXD.Eluj0rNhTVbWwAUO15TVTAX3RSG', NULL, '2021-02-10 04:39:10', '2021-02-10 04:39:10', 1000000000),
(2, 'Vice President', 'vp@mail.com', 1, NULL, 'Vp', '0', '0', '0', '$2y$10$GYqOFp6g5.xgTRhx0tPajufdudtTCHWAJ8pOL/C9/72ffgC6YwSrG', NULL, '2021-02-10 04:39:11', '2021-02-10 04:39:11', 1000000001),
(3, 'Kepala Bagian', 'kabag@mail.com', 2, NULL, 'Kabag', '0', 'IT', 'Operasional', '$2y$10$4yIZ1S1ploQTR8ccgPmDEeepOie60XsmPXFZOHSlmW4Cp5r8H2A7m', NULL, '2021-02-10 04:39:11', '2021-02-10 04:39:11', 1000000002),
(4, 'Supervisor', 'spv@mail.com', 3, NULL, 'Supervisor', 'Software', 'IT', 'Operasional', '$2y$10$YnHgI1z2lqOi8e.MZjtb0uWUu/q9V/5zd1FvO2dOi/4Y7FDiq1WNu', NULL, '2021-02-10 04:39:11', '2021-02-10 04:39:11', 1000000003),
(5, 'Staff', 'staff@mail.com', 4, NULL, 'Staff', 'Software', 'IT', 'Operasional', '$2y$10$5XwPkCy18OgD.xSR0.e2c.h0ZzFYojZhDmfy7pwDZBj2Zy5v/x7La', NULL, '2021-02-10 04:39:11', '2021-02-10 04:39:11', 1000000004),
(6, 'Staff2', 'staff2@mail.com', 4, NULL, 'Staff', 'Software', 'IT', 'Operasional', '$2y$10$fM5ngBRDLx3WxoGaPF7amuv4ixjY0LfdZR0hv8hPIQ/SieSUukAhG', NULL, '2021-02-10 04:39:11', '2021-02-10 04:39:11', 1000000005),
(7, 'Staff3', 'staff3@mail.com', 4, NULL, 'Staff', 'Software', 'IT', 'Operasional', '$2y$10$HvV.AsPhqFRkVOTtGsy5WeShxmIDQHOiRSWSgP3lxLObG5fmAcuOG', NULL, '2021-02-10 04:39:11', '2021-02-10 04:39:11', 1000000006);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `uid` (`uid`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
