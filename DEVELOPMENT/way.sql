-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2023 at 09:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `way`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id_attachment` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id_attachment`, `id_user`, `type`, `name`, `extension`, `path`, `size_b`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1679902971r97203', 'jpg', '/uploads/attachment/images/', '100224', '2023-03-27 07:42:52', '2023-03-27 07:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `attachment_message`
--

CREATE TABLE `attachment_message` (
  `id_attachment_message` bigint(20) UNSIGNED NOT NULL,
  `id_attachment` bigint(20) UNSIGNED NOT NULL,
  `id_message` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attachment_message`
--

INSERT INTO `attachment_message` (`id_attachment_message`, `id_attachment`, `id_message`, `created_at`, `updated_at`) VALUES
(1, 1, 124, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `authentication_codes`
--

CREATE TABLE `authentication_codes` (
  `id_authentication_code` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authentication_codes`
--

INSERT INTO `authentication_codes` (`id_authentication_code`, `id_user`, `code`, `expired`, `created_at`, `updated_at`) VALUES
(1, 1, '11111', 1, '2023-03-10 12:27:16', '2023-03-10 12:27:34'),
(2, 1, '11111', 1, '2023-03-14 16:45:50', '2023-03-14 16:45:53'),
(3, 1, '11111', 1, '2023-03-17 19:38:12', '2023-03-17 19:38:16'),
(4, 1, '11111', 1, '2023-03-19 22:51:38', '2023-03-19 22:51:42'),
(5, 1, '11111', 1, '2023-03-19 22:51:45', '2023-03-19 22:51:47'),
(6, 1, '11111', 1, '2023-03-19 23:35:25', '2023-03-19 23:35:27'),
(7, 5, '11111', 1, '2023-03-21 16:07:00', '2023-03-21 16:07:08'),
(8, 1, '11111', 1, '2023-03-21 16:07:13', '2023-03-21 16:07:15'),
(9, 1, '11111', 1, '2023-03-21 16:07:26', '2023-03-21 16:07:27'),
(10, 6, '11111', 1, '2023-03-21 16:20:23', '2023-03-21 16:20:29'),
(11, 7, '11111', 1, '2023-03-21 16:22:46', '2023-03-21 16:22:51'),
(12, 1, '11111', 1, '2023-03-23 10:49:52', '2023-03-23 10:49:58'),
(13, 7, '11111', 1, '2023-03-23 10:50:57', '2023-03-23 10:51:05'),
(14, 8, '11111', 1, '2023-03-23 10:51:33', '2023-03-23 10:51:40'),
(15, 1, '11111', 1, '2023-03-25 11:26:27', '2023-03-25 11:26:31'),
(16, 1, '11111', 0, '2023-03-25 11:26:53', '2023-03-25 11:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `id_avatar` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatars`
--

INSERT INTO `avatars` (`id_avatar`, `name`, `extension`, `path`, `width`, `height`, `id_user`, `created_at`, `updated_at`) VALUES
(1, '1678464325d62151', 'jpg', '/uploads/avatar/', 800, 800, 1, '2023-03-10 12:35:26', '2023-03-10 12:35:26'),
(2, '1678464336n98344', 'jpg', '/uploads/avatar/', 800, 800, 1, '2023-03-10 12:35:37', '2023-03-10 12:35:37'),
(3, '1678464419z91406', 'jpg', '/uploads/avatar/', 800, 800, 1, '2023-03-10 12:37:00', '2023-03-10 12:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id_contact` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `contact_user_id` bigint(20) UNSIGNED NOT NULL,
  `contact_user_mobile` tinyint(1) NOT NULL DEFAULT 0,
  `contact_user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id_contact`, `id_user`, `contact_user_id`, `contact_user_mobile`, `contact_user_name`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 0, 'sssss', '2023-03-10 12:40:11', '2023-03-10 12:49:20');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id_message` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_message_hook` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `context` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_message`, `id_user`, `id_message_hook`, `type`, `context`, `created_at`, `updated_at`) VALUES
(11, 1, 20, 1, 'hello', '2023-03-16 07:09:04', '2023-03-16 07:09:04'),
(12, 1, 20, 1, 'hello', '2023-03-16 07:23:02', '2023-03-16 07:23:02'),
(13, 1, 20, 1, 'how are you my friend ?', '2023-03-16 08:09:11', '2023-03-16 08:09:11'),
(14, 1, 20, 1, 'every thing was ok?\n I was nervous abous you', '2023-03-16 08:09:37', '2023-03-16 08:09:37'),
(15, 1, 20, 1, 'that you can&#039;t get pass through it', '2023-03-16 08:09:51', '2023-03-16 08:09:51'),
(16, 1, 20, 1, 'and you want to forget it', '2023-03-16 08:09:59', '2023-03-16 08:09:59'),
(17, 1, 20, 1, 'to move to another city', '2023-03-16 08:10:05', '2023-03-16 08:10:05'),
(18, 1, 20, 1, 'lorem 1', '2023-03-16 08:10:55', '2023-03-16 08:10:55'),
(19, 1, 20, 1, 'lorem 2', '2023-03-16 08:10:56', '2023-03-16 08:10:56'),
(20, 1, 20, 1, 'lorem 3', '2023-03-16 08:10:58', '2023-03-16 08:10:58'),
(21, 2, 20, 1, 'lorem 4', '2023-03-16 08:10:59', '2023-03-16 08:10:59'),
(22, 2, 20, 1, 'lorem 5', '2023-03-16 08:11:00', '2023-03-16 08:11:00'),
(23, 2, 20, 1, 'lorem 6', '2023-03-16 08:11:01', '2023-03-16 08:11:01'),
(24, 1, 20, 1, 'lorem 7', '2023-03-16 08:11:02', '2023-03-16 08:11:02'),
(25, 1, 20, 1, 'lorem 8', '2023-03-16 08:11:03', '2023-03-16 08:11:03'),
(26, 2, 20, 1, 'lorem 9', '2023-03-16 08:11:06', '2023-03-16 08:11:06'),
(27, 1, 20, 1, 'lorem 10', '2023-03-16 08:11:07', '2023-03-16 08:11:07'),
(28, 2, 20, 1, 'lorem 11', '2023-03-16 08:11:08', '2023-03-16 08:11:08'),
(29, 2, 20, 1, 'lorem 12', '2023-03-16 08:11:09', '2023-03-16 08:11:09'),
(30, 1, 20, 1, 'lorem 13', '2023-03-16 08:11:10', '2023-03-16 08:11:10'),
(31, 1, 20, 1, 'lorem 14', '2023-03-16 08:11:11', '2023-03-16 08:11:11'),
(32, 2, 20, 1, 'lorem 15', '2023-03-16 08:11:13', '2023-03-16 08:11:13'),
(33, 2, 20, 1, 'lorem 16', '2023-03-16 08:11:14', '2023-03-16 08:11:14'),
(34, 2, 20, 1, 'lorem 17', '2023-03-16 08:11:15', '2023-03-16 08:11:15'),
(35, 2, 20, 1, 'lorem 18', '2023-03-16 08:11:17', '2023-03-16 08:11:17'),
(36, 1, 20, 1, 'lorem 19', '2023-03-16 08:11:18', '2023-03-16 08:11:18'),
(37, 1, 20, 1, 'lorem 200', '2023-03-16 08:11:19', '2023-03-16 08:11:19'),
(38, 1, 21, 1, 'Hi beauty ..', '2023-03-16 12:57:20', '2023-03-16 12:57:20'),
(39, 1, 22, 1, 'lorem 20', '2023-03-16 13:50:58', '2023-03-16 13:50:58'),
(40, 1, 20, 1, 'my last pm', '2023-03-16 15:55:34', '2023-03-16 15:55:34'),
(41, 1, 21, 1, 'this is my laaaaaaaast', '2023-03-16 15:55:52', '2023-03-16 15:55:52'),
(42, 1, 22, 1, 'LASTTTTTTTTTTTTTTTTTTTTTTTTTTT', '2023-03-16 16:30:15', '2023-03-16 16:30:15'),
(43, 1, 22, 1, 'LASTTTTTTTTTTTTTTTTTTTTTTTTTTT ONEEE', '2023-03-17 20:05:10', '2023-03-16 20:05:10'),
(44, 1, 21, 1, 'l', '2023-03-16 20:14:22', '2023-03-16 20:14:22'),
(56, 1, 20, 1, ':D', '2023-03-17 22:04:28', '2023-03-17 22:04:28'),
(57, 4, 44, 1, ':)))))))))', '2023-03-17 22:04:28', '2023-03-17 22:04:28'),
(58, 1, 22, 1, 'LASTTTTTTTTTTTTTTTTTTTTTTTTTTT2', '2023-03-19 21:17:12', '2023-03-19 21:17:12'),
(59, 1, 22, 1, 'LASTTTTTTTTTTTTTTTTTTTTTTTTTTT2 3', '2023-03-19 21:19:13', '2023-03-19 21:19:13'),
(60, 2, 20, 1, 'Hello my friend ...', '2023-03-21 11:08:30', '2023-03-21 11:08:30'),
(62, 2, 20, 1, 'Hello my friend 2...', '2023-03-21 11:17:06', '2023-03-21 11:17:06'),
(63, 2, 20, 1, 'Hello my friend 2...', '2023-03-21 11:19:08', '2023-03-21 11:19:08'),
(64, 2, 20, 1, 'Hello my friend 2...', '2023-03-21 11:20:21', '2023-03-21 11:20:21'),
(65, 2, 20, 1, 'Hello my friend 2...', '2023-03-21 11:25:40', '2023-03-21 11:25:40'),
(66, 2, 20, 1, 'Hello my friend 2...', '2023-03-21 11:25:52', '2023-03-21 11:25:52'),
(67, 2, 20, 1, 'Hello my friend 2...', '2023-03-21 11:26:21', '2023-03-21 11:26:21'),
(68, 2, 20, 1, 'Hello my friend 2...', '2023-03-21 11:28:00', '2023-03-21 11:28:00'),
(69, 2, 20, 1, 'Hello my friend 2...', '2023-03-21 11:28:08', '2023-03-21 11:28:08'),
(70, 2, 20, 1, 'Hello my friend 2...', '2023-03-21 11:28:39', '2023-03-21 11:28:39'),
(71, 2, 20, 1, 'Hello my friend 2...', '2023-03-21 11:29:32', '2023-03-21 11:29:32'),
(72, 2, 20, 1, 'Hello my friend 2...', '2023-03-21 11:34:41', '2023-03-21 11:34:41'),
(73, 2, 20, 1, 'Hello my friend3...', '2023-03-21 11:51:57', '2023-03-21 11:51:57'),
(74, 5, 46, 1, 'Hello my friend ...', '2023-03-21 16:17:08', '2023-03-21 16:17:08'),
(75, 5, 46, 1, 'Hello my friend ...', '2023-03-21 16:20:14', '2023-03-21 16:20:14'),
(76, 6, 47, 1, 'Hello ...', '2023-03-21 16:20:48', '2023-03-21 16:20:48'),
(77, 7, 48, 1, 'Hiiii', '2023-03-21 16:23:11', '2023-03-21 16:23:11'),
(78, 8, 49, 1, 'Hello my friend ...', '2023-03-23 10:51:46', '2023-03-23 10:51:46'),
(81, 1, 20, 1, 'hello back ...', '2023-03-25 14:49:27', '2023-03-25 14:49:27'),
(82, 1, 20, 1, 'hello back ...', '2023-03-25 14:58:16', '2023-03-25 14:58:16'),
(83, 2, 50, 1, 'test', '2023-03-25 14:58:16', '2023-03-25 14:58:16'),
(84, 1, 20, 1, 'HI again', '2023-03-26 19:58:52', '2023-03-26 19:58:52'),
(121, 1, 20, 2, '', '2023-03-27 07:14:25', '2023-03-27 07:14:25'),
(123, 1, 20, 2, '', '2023-03-27 07:35:16', '2023-03-27 07:35:16'),
(124, 1, 20, 2, 'this caption', '2023-03-27 07:44:39', '2023-03-27 07:44:39');

-- --------------------------------------------------------

--
-- Table structure for table `message_hooks`
--

CREATE TABLE `message_hooks` (
  `id_message_hook` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_hooks`
--

INSERT INTO `message_hooks` (`id_message_hook`, `type`, `created_at`, `updated_at`) VALUES
(20, 1, '2023-03-16 07:09:04', '2023-03-16 07:09:04'),
(21, 1, '2023-03-16 12:57:20', '2023-03-16 12:57:20'),
(22, 1, '2023-03-16 13:50:58', '2023-03-16 13:50:58'),
(44, 1, '2023-03-16 13:50:58', '2023-03-16 13:50:58'),
(46, 1, '2023-03-21 16:17:08', '2023-03-21 16:17:08'),
(47, 1, '2023-03-21 16:20:48', '2023-03-21 16:20:48'),
(48, 1, '2023-03-21 16:23:11', '2023-03-21 16:23:11'),
(49, 1, '2023-03-23 10:51:46', '2023-03-23 10:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `message_hook_members`
--

CREATE TABLE `message_hook_members` (
  `id_message_hook_member` bigint(20) UNSIGNED NOT NULL,
  `id_message_hook` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_hook_members`
--

INSERT INTO `message_hook_members` (`id_message_hook_member`, `id_message_hook`, `id_user`, `created_at`, `updated_at`) VALUES
(23, 20, 1, '2023-03-16 07:09:04', '2023-03-16 07:09:04'),
(24, 20, 2, '2023-03-16 07:09:04', '2023-03-16 07:09:04'),
(25, 21, 1, '2023-03-16 12:57:20', '2023-03-16 12:57:20'),
(26, 21, 3, '2023-03-16 12:57:20', '2023-03-16 12:57:20'),
(27, 22, 1, '2023-03-16 13:50:58', '2023-03-16 13:50:58'),
(28, 22, 4, '2023-03-16 13:50:58', '2023-03-16 13:50:58'),
(31, 50, 4, '2023-03-16 13:50:58', '2023-03-16 13:50:58'),
(32, 50, 2, '2023-03-16 13:50:58', '2023-03-16 13:50:58'),
(33, 46, 5, '2023-03-21 16:17:08', '2023-03-21 16:17:08'),
(34, 46, 1, '2023-03-21 16:17:08', '2023-03-21 16:17:08'),
(35, 47, 6, '2023-03-21 16:20:48', '2023-03-21 16:20:48'),
(36, 47, 1, '2023-03-21 16:20:48', '2023-03-21 16:20:48'),
(37, 48, 7, '2023-03-21 16:23:11', '2023-03-21 16:23:11'),
(38, 48, 1, '2023-03-21 16:23:11', '2023-03-21 16:23:11'),
(39, 49, 8, '2023-03-23 10:51:46', '2023-03-23 10:51:46'),
(40, 49, 1, '2023-03-23 10:51:46', '2023-03-23 10:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `message_seens`
--

CREATE TABLE `message_seens` (
  `id_message_seen` bigint(20) UNSIGNED NOT NULL,
  `id_message` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_seens`
--

INSERT INTO `message_seens` (`id_message_seen`, `id_message`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 40, 1, '2023-03-25 17:14:19', '2023-03-25 17:16:58'),
(2, 37, 1, '2023-03-25 17:11:59', '2023-03-25 17:11:59'),
(73, 77, 1, '2023-03-25 17:20:34', '2023-03-25 17:20:34'),
(74, 78, 1, '2023-03-25 17:20:34', '2023-03-25 17:20:34'),
(75, 81, 1, '2023-03-25 17:20:45', '2023-03-25 17:20:45'),
(78, 39, 1, '2023-03-25 17:20:57', '2023-03-25 17:20:57'),
(80, 41, 1, '2023-03-25 17:21:08', '2023-03-25 17:21:08');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_26_195349_create_authentication_codes_table', 1),
(6, '2023_03_08_181342_create_avatars_table', 1),
(7, '2023_03_09_143635_create_contacts_table', 1),
(9, '2023_03_10_200929_create_message_hook_members_table', 2),
(11, '2023_03_10_200731_create_message_hooks_table', 3),
(12, '2023_03_10_201042_create_messages_table', 4),
(15, '2023_03_25_155035_create_message_seens_table', 5),
(25, '2023_03_27_000930_create_attachments_table', 6),
(26, '2023_03_27_103415_create_attachment_message_table', 6);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `mobile`, `name`, `username`, `password`, `gender`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '09365371300', 'alex', 'alitna', NULL, '1', NULL, '2023-03-10 12:27:16', '2023-03-10 12:34:02'),
(2, '09365371302', 'alex2', 'alitna2', NULL, '1', NULL, '2023-03-10 12:27:16', '2023-03-10 12:33:01'),
(3, '09365371303', 'alex3', 'alitna3', NULL, '0', NULL, '2023-03-10 12:27:16', '2023-03-10 12:33:01'),
(4, '09365371304', 'alex4', 'alitna4', NULL, '0', NULL, '2023-03-10 12:27:16', '2023-03-10 12:33:01'),
(5, '09365371310', NULL, NULL, NULL, NULL, NULL, '2023-03-21 16:07:00', '2023-03-21 16:07:00'),
(6, '09365371320', NULL, NULL, NULL, NULL, NULL, '2023-03-21 16:20:23', '2023-03-21 16:20:23'),
(7, '09365371330', 'aleex 30', 'alitna30', NULL, '0', NULL, '2023-03-21 16:22:46', '2023-03-21 16:32:11'),
(8, '09365371340', NULL, NULL, NULL, NULL, NULL, '2023-03-23 10:51:33', '2023-03-23 10:51:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id_attachment`);

--
-- Indexes for table `attachment_message`
--
ALTER TABLE `attachment_message`
  ADD PRIMARY KEY (`id_attachment_message`),
  ADD KEY `attachment_message_id_attachment_foreign` (`id_attachment`),
  ADD KEY `attachment_message_id_message_foreign` (`id_message`);

--
-- Indexes for table `authentication_codes`
--
ALTER TABLE `authentication_codes`
  ADD PRIMARY KEY (`id_authentication_code`);

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id_avatar`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`);

--
-- Indexes for table `message_hooks`
--
ALTER TABLE `message_hooks`
  ADD PRIMARY KEY (`id_message_hook`);

--
-- Indexes for table `message_hook_members`
--
ALTER TABLE `message_hook_members`
  ADD PRIMARY KEY (`id_message_hook_member`);

--
-- Indexes for table `message_seens`
--
ALTER TABLE `message_seens`
  ADD PRIMARY KEY (`id_message_seen`),
  ADD UNIQUE KEY `message_seens_id_message_id_user_unique` (`id_message`,`id_user`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id_attachment` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attachment_message`
--
ALTER TABLE `attachment_message`
  MODIFY `id_attachment_message` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `authentication_codes`
--
ALTER TABLE `authentication_codes`
  MODIFY `id_authentication_code` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id_avatar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id_contact` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `message_hooks`
--
ALTER TABLE `message_hooks`
  MODIFY `id_message_hook` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `message_hook_members`
--
ALTER TABLE `message_hook_members`
  MODIFY `id_message_hook_member` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `message_seens`
--
ALTER TABLE `message_seens`
  MODIFY `id_message_seen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachment_message`
--
ALTER TABLE `attachment_message`
  ADD CONSTRAINT `attachment_message_id_attachment_foreign` FOREIGN KEY (`id_attachment`) REFERENCES `attachments` (`id_attachment`),
  ADD CONSTRAINT `attachment_message_id_message_foreign` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id_message`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
