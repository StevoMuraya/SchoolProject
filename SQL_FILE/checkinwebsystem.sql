-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 12:09 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `checkinwebsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_list`
--

CREATE TABLE `attendance_list` (
  `attendance_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scan_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_list`
--

INSERT INTO `attendance_list` (`attendance_id`, `class_id`, `class_code`, `student_id`, `scan_time`, `created_at`, `updated_at`) VALUES
(1, '1', '$2y$10$NyQULfwcHC.l6p3ZNalGhu.CUqqp0gcQ1Bp0CV8n.oMDULpWB9/8.', '2', '2021-12-02 03:39:42', '2021-12-02 00:39:42', '2021-12-02 00:39:42'),
(2, '4', '$2y$10$d6yver4O97/kbr4lkrR2/OJnFiCJiOrOhQ9oYic6NjzDQ8ZiMkrGi', '2', '2021-12-02 03:56:59', '2021-12-02 00:56:59', '2021-12-02 00:56:59'),
(3, '4', '$2y$10$d6yver4O97/kbr4lkrR2/OJnFiCJiOrOhQ9oYic6NjzDQ8ZiMkrGi', '3', '2021-12-02 04:53:42', '2021-12-02 01:53:42', '2021-12-02 01:53:42'),
(4, '4', '$2y$10$7UMeb78OZcK0kevdpRIH4.STn1/VmSHOW7xGs9597oX9Pb4qg/IfC', '3', '2021-12-02 05:35:56', '2021-12-02 02:35:56', '2021-12-02 02:35:56'),
(5, '5', '$2y$10$8xrjVWCiumwPJWJ9mZ6RzeDqqUm/WzxKiEadatFe73Z3o59XwFwg6', '1', '2021-12-03 01:51:25', '2021-12-02 22:51:25', '2021-12-02 22:51:25'),
(6, '5', '$2y$10$Z96.Eb3lVjlXDeMV9b3SUuCRo2Xk7GocpXzvwB7NRzHdgTcx8rvse', '2', '2021-12-03 01:53:26', '2021-12-02 22:53:26', '2021-12-02 22:53:26'),
(7, '5', '$2y$10$Z96.Eb3lVjlXDeMV9b3SUuCRo2Xk7GocpXzvwB7NRzHdgTcx8rvse', '1', '2021-12-03 01:54:20', '2021-12-02 22:54:20', '2021-12-02 22:54:20');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lec_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_sem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_start` datetime NOT NULL,
  `class_stop` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_code` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_updated` datetime NOT NULL,
  `date_reg` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `unit_id`, `lec_id`, `class_sem`, `class_year`, `class_start`, `class_stop`, `status`, `class_code`, `date_updated`, `date_reg`, `created_at`, `updated_at`) VALUES
(1, '1', '2', '1', '2021', '2021-11-13 15:37:00', '2021-11-13 16:37:00', '0', '$2y$10$KDIEZTjfaFfaOi.1xHEtnOYmKLZKKwS4yLPrMg.YfrWTdLgpPYrOC', '2021-12-02 15:53:47', '2021-12-02 11:00:30', '2021-12-02 08:00:30', '2021-12-02 12:53:47'),
(2, '1', '4', '2', '2021', '2021-11-13 15:37:00', '2021-11-13 16:37:00', '0', '$2y$10$19kE/1ToJgRimYGmN2aZ.uRbbEJxk0ulud5214YlJy8tLV7C6Pj12', '2021-12-02 11:59:20', '2021-12-02 11:59:20', '2021-12-02 08:59:20', '2021-12-02 08:59:20'),
(3, '1', '4', '1', '2021', '2021-11-13 15:37:00', '2021-11-13 16:37:00', '0', '$2y$10$y3fcBknRbTbW5xej7g76xeK/FJo7Raufo7wHa0jkwxo.TUS0LRivi', '2021-12-02 03:46:22', '2021-12-02 03:46:22', '2021-12-02 00:46:22', '2021-12-02 00:46:22'),
(4, '2', '2', '1', '2021', '2021-11-13 15:37:00', '2021-11-13 16:37:00', '0', '$2y$10$7UMeb78OZcK0kevdpRIH4.STn1/VmSHOW7xGs9597oX9Pb4qg/IfC', '2021-12-02 17:24:20', '2021-12-02 03:53:52', '2021-12-02 00:53:52', '2021-12-02 14:24:20'),
(5, '4', '5', '2', '2021', '2021-12-14 13:00:00', '2021-12-14 15:00:00', '0', '$2y$10$Z96.Eb3lVjlXDeMV9b3SUuCRo2Xk7GocpXzvwB7NRzHdgTcx8rvse', '2021-12-03 01:52:33', '2021-12-03 01:49:42', '2021-12-02 22:49:42', '2021-12-02 22:52:33');

-- --------------------------------------------------------

--
-- Table structure for table `classes_held`
--

CREATE TABLE `classes_held` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_start` datetime NOT NULL,
  `class_stop` datetime NOT NULL,
  `class_code` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes_held`
--

INSERT INTO `classes_held` (`id`, `class_id`, `class_start`, `class_stop`, `class_code`, `date_reg`, `created_at`, `updated_at`) VALUES
(1, '1', '2021-11-13 15:37:00', '2021-11-13 16:37:00', '$2y$10$M3wGZEbNPxkfrrIQ/KbNQ.JqbEicPY7TLJLAGoSBTDogYmzNvJWxm', '2021-12-02 11:00:30', '2021-12-02 08:00:30', '2021-12-02 08:00:30'),
(2, '1', '2021-11-13 15:37:00', '2021-11-13 16:37:00', '$2y$10$NyQULfwcHC.l6p3ZNalGhu.CUqqp0gcQ1Bp0CV8n.oMDULpWB9/8.', '2021-12-02 11:01:02', '2021-12-02 08:01:02', '2021-12-02 08:01:02'),
(3, '2', '2021-11-13 15:37:00', '2021-11-13 16:37:00', '$2y$10$19kE/1ToJgRimYGmN2aZ.uRbbEJxk0ulud5214YlJy8tLV7C6Pj12', '2021-12-02 11:59:20', '2021-12-02 08:59:20', '2021-12-02 08:59:20'),
(4, '3', '2021-11-13 15:37:00', '2021-11-13 16:37:00', '$2y$10$y3fcBknRbTbW5xej7g76xeK/FJo7Raufo7wHa0jkwxo.TUS0LRivi', '2021-12-02 03:46:22', '2021-12-02 00:46:22', '2021-12-02 00:46:22'),
(5, '1', '2021-11-13 15:37:00', '2021-11-13 16:37:00', '$2y$10$KDIEZTjfaFfaOi.1xHEtnOYmKLZKKwS4yLPrMg.YfrWTdLgpPYrOC', '2021-12-02 03:53:47', '2021-12-02 00:53:47', '2021-12-02 00:53:47'),
(6, '4', '2021-11-13 15:37:00', '2021-11-13 16:37:00', '$2y$10$d6yver4O97/kbr4lkrR2/OJnFiCJiOrOhQ9oYic6NjzDQ8ZiMkrGi', '2021-12-02 03:53:52', '2021-12-02 00:53:52', '2021-12-02 00:53:52'),
(7, '4', '2021-11-13 15:37:00', '2021-11-13 16:37:00', '$2y$10$7UMeb78OZcK0kevdpRIH4.STn1/VmSHOW7xGs9597oX9Pb4qg/IfC', '2021-12-02 05:24:20', '2021-12-02 02:24:20', '2021-12-02 02:24:20'),
(8, '5', '2021-12-07 13:00:00', '2021-12-07 15:00:00', '$2y$10$8xrjVWCiumwPJWJ9mZ6RzeDqqUm/WzxKiEadatFe73Z3o59XwFwg6', '2021-12-03 01:49:42', '2021-12-02 22:49:42', '2021-12-02 22:49:42'),
(9, '5', '2021-12-14 13:00:00', '2021-12-14 15:00:00', '$2y$10$Z96.Eb3lVjlXDeMV9b3SUuCRo2Xk7GocpXzvwB7NRzHdgTcx8rvse', '2021-12-03 01:52:33', '2021-12-02 22:52:33', '2021-12-02 22:52:33');

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
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `lec_id` bigint(20) UNSIGNED NOT NULL,
  `lec_firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lec_lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lec_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lec_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lec_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lec_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lec_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lec_id`, `lec_firstname`, `lec_lastname`, `lec_email`, `lec_phone`, `lec_code`, `lec_image`, `lec_password`, `date_reg`, `reg_by`, `created_at`, `updated_at`, `department`) VALUES
(2, 'Joel', 'Glacier', 'gathaiya28@gmail.com', '0797923201', 'J17/4089/2017', 'default.jpg', '$2y$10$Ateg860FlqILs1n39pLdvOGeKKEghazOAQtQdXa9ueZOSoIqe6Lwa', '2021-11-30 19:56:10', '5', '2021-11-30 16:56:10', '2021-11-30 16:56:10', 'Computing and Information Security'),
(3, 'Moses', 'Kamau', 'gathaiya.muraya@students.ku.ac.ke', '0797923202', 'J17/4089/2018', 'default.jpg', '$2y$10$GJx9HNE6p13s0v9cpq/Pouqdtf223JPVLe0lcD8sk3/EqhlI7cR66', '2021-12-01 16:11:46', '5', '2021-12-01 13:11:46', '2021-12-01 13:11:46', 'CIT'),
(4, 'John', 'Doe', 'jonnie@gmail.com', '0797923203', 'J17/4089/2019', 'default.jpg', '$2y$10$YsHCfuaFX310L3ZXhWTXW.cyKM7y3sxPEcSBxOT8Wi3jxO433ixeq', '2021-12-01 17:15:21', '5', '2021-12-01 14:15:21', '2021-12-01 14:15:21', 'CIT'),
(5, 'Stephen', 'Muraya', 'muraya@gmail.com', '0797923204', 'J17/4089/2050', 'default.jpg', '$2y$10$xVl2Jpi77/Vr8nOKxvscCe.LyDtTmq8KVhbsZASNVfzZ/tlF.y3aC', '2021-12-02 22:47:03', '5', '2021-12-02 19:47:03', '2021-12-02 19:47:03', 'CIT');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_30_165434_add_email_token_to_users', 2),
(6, '2021_11_30_192508_create_lecturers_table', 3),
(7, '2021_11_30_195132_add_department_to_lecturers', 4),
(8, '2021_12_01_083900_create_units_table', 5),
(9, '2021_12_01_144424_create_unit_lecs_table', 6),
(11, '2021_12_02_071008_create_classes_table', 7),
(13, '2021_12_02_074607_create_classes_helds_table', 8),
(14, '2021_12_02_104806_create_students_table', 9),
(15, '2021_12_02_113954_create_unit_students_table', 10),
(16, '2021_12_02_123113_create_attendance_lists_table', 11);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `student_firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_regNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_password` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_firstname`, `student_lastname`, `student_email`, `student_phone`, `student_regNo`, `student_password`, `student_profile`, `created_at`, `updated_at`) VALUES
(1, 'Stephen', 'Muraya', 'gathaiya28@gmail.com', '0797923201', 'J17/4089/2017', '$2y$10$oOchtGLoT84YloktKWhaWOY9p.Qcmn0K/9JPu4UyyQYsVkZaRIB8e', 'default.jpg', '2021-12-02 08:27:47', '2021-12-02 08:27:47'),
(2, 'Henry', 'Mutega', 'gathaiya@students.ku.ac.ke', '0797923202', 'J17/4089/2018', '$2y$10$DVxv5Jd1jW8HFPtNnLFjKuyKz/A8sRUQ5dYFAKg7ui/eodIduMSHS', 'default.jpg', '2021-12-02 08:32:23', '2021-12-02 08:32:23'),
(3, 'Moses', 'Mogusu', 'mugusu@gmail.com', '254797923203', 'J17/4089/2019', '$2y$10$kDtwtifK0oczMpKEMOC0VebwI8yx7oPYatxjwJguBDsYweGqaS0oC', 'default.jpg', '2021-12-02 01:53:33', '2021-12-02 01:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `unit_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_code`, `unit_name`, `unit_department`, `reg_by`, `created_at`, `updated_at`) VALUES
(1, 'SCO411', 'ARTIFICIAL NEURAL NETWORKS', 'CIT', '5', '2021-12-01 05:47:50', '2021-12-02 10:30:22'),
(2, 'SCO410', 'DISTRIBUTED SYSTEMS', 'CIT', '5', '2021-12-01 05:50:20', '2021-12-01 05:50:20'),
(4, 'SCO413', 'ROBOTICS', 'CIT', '5', '2021-12-01 11:37:10', '2021-12-02 03:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `unit_lecs`
--

CREATE TABLE `unit_lecs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lec_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_lecs`
--

INSERT INTO `unit_lecs` (`id`, `lec_id`, `unit_id`, `assigned_by`, `created_at`, `updated_at`) VALUES
(2, '4', '4', '5', '2021-12-01 14:16:00', '2021-12-01 14:16:00'),
(3, '3', '4', '5', '2021-12-01 14:33:51', '2021-12-01 14:33:51'),
(5, '2', '1', '5', '2021-12-01 14:43:45', '2021-12-01 14:43:45'),
(7, '2', '2', '5', '2021-12-01 14:58:47', '2021-12-01 14:58:47'),
(8, '2', '4', '5', '2021-12-01 15:00:12', '2021-12-01 15:00:12'),
(9, '4', '1', '5', '2021-12-02 05:58:33', '2021-12-02 05:58:33'),
(11, '5', '4', '5', '2021-12-02 19:48:29', '2021-12-02 19:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `unit_students`
--

CREATE TABLE `unit_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_students`
--

INSERT INTO `unit_students` (`id`, `student_id`, `class_id`, `date_reg`, `created_at`, `updated_at`) VALUES
(1, '2', '1', '2021-12-02 03:38:07', '2021-12-02 00:38:07', '2021-12-02 00:38:07'),
(2, '2', '4', '2021-12-02 03:56:59', '2021-12-02 00:56:59', '2021-12-02 00:56:59'),
(4, '3', '4', '2021-12-02 05:35:56', '2021-12-02 02:35:56', '2021-12-02 02:35:56'),
(5, '1', '5', '2021-12-03 01:51:25', '2021-12-02 22:51:25', '2021-12-02 22:51:25'),
(6, '2', '5', '2021-12-03 01:53:26', '2021-12-02 22:53:26', '2021-12-02 22:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verification_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `email_verified_at`, `account_type`, `password`, `remember_token`, `created_at`, `updated_at`, `email_verification_token`) VALUES
(3, 'Stephen', 'Muraya', 'gathaiya28@gmail.com', '2021-11-30 14:20:44', NULL, '$2y$10$A71T9SIk9teOZ.Ccj1SE3u8yStBNANS7WDKB6CoRuUxVQNy.BD.rK', 'Wgrx1whKlrvbQp4LwfphaiGFcBuieLIPCeUO5rgJWJMG04ngUkg44LCNSGEl', '2021-11-30 14:20:14', '2021-11-30 14:20:44', ''),
(5, 'Gathaiya', 'Muraya', 'gathaiya.muraya@students.ku.ac.ke', '2021-12-02 07:34:37', NULL, '$2y$10$tDeQMSDjKuBQVbT6FfWc/u/cCm.Z8OJTnDP.Zbgl0wy.BBN5gT7wa', 'iqsd7TSiRjE9ynNnUZqG5Sctq7lpKvJq8YS34f8H05ZuIsK9oCsdHXGi0nrD', '2021-11-30 14:49:36', '2021-12-02 07:34:37', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_list`
--
ALTER TABLE `attendance_list`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `classes_held`
--
ALTER TABLE `classes_held`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`lec_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `unit_lecs`
--
ALTER TABLE `unit_lecs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_students`
--
ALTER TABLE `unit_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_list`
--
ALTER TABLE `attendance_list`
  MODIFY `attendance_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `classes_held`
--
ALTER TABLE `classes_held`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `lec_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unit_lecs`
--
ALTER TABLE `unit_lecs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `unit_students`
--
ALTER TABLE `unit_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
