-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 05, 2021 at 09:25 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `2021indoconnex`
--

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
                                       `id` bigint(20) UNSIGNED NOT NULL,
                                       `data_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                       `data_name_lang` text COLLATE utf8mb4_unicode_ci,
                                       `data_description` text COLLATE utf8mb4_unicode_ci,
                                       `file_path` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                       `file_name_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                       `file_name_original` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                       `file_json` text COLLATE utf8mb4_unicode_ci,
                                       `published` datetime NOT NULL,
                                       `status` smallint(6) NOT NULL DEFAULT '0',
                                       `created_at` datetime NOT NULL,
                                       `created_by` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                       `updated_at` timestamp NOT NULL,
                                       `updated_by` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                       `deleted_at` datetime DEFAULT NULL,
                                       `deleted_by` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`id`, `data_name`, `data_name_lang`, `data_description`, `file_path`, `file_name_thumbnail`, `file_name_original`, `file_json`, `published`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(18446744073709551615, 'Category 1', NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-05 00:00:00', 0, '2021-07-05 09:22:41', NULL, '2021-07-05 02:22:41', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9223372036854775807;
