-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2024 at 04:01 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airbnb_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `province`, `municipality`, `barangay`, `created_at`, `updated_at`) VALUES
(1, 'south cotabato', 'tantangan', 'san felipe', '2024-03-31 16:53:17', '2024-03-31 16:53:17'),
(2, 'batanes', 'sabtang', 'sinakan (pob.)', '2024-03-31 16:54:31', '2024-03-31 16:54:31'),
(3, 'bataan', 'samal', 'santa lucia', '2024-03-31 16:55:28', '2024-03-31 16:55:28'),
(4, 'Aurora', 'Casiguran', 'Tinib', '2024-04-03 15:41:45', '2024-04-03 15:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cable & TV', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(2, 'Wifi', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(3, 'Kitchen', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(4, 'Refrigerator', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(5, 'Coffee Maker', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(6, 'Dishes and silverware', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(7, 'Cooking Stive', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(8, 'Beach Access', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(9, 'Private Patio or Balcony', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(10, 'Free Parking', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(11, 'Washing Machine', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(12, 'Dryer', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(13, 'Air-conditioning', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(14, 'Smoke Alarm', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(15, 'Backyard', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(16, 'Bathtub', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(17, 'BBQ Grill', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(18, 'CCTV', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(19, 'Swimming Pool', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(20, 'Exercise Equipment', '2024-03-31 15:32:56', '2024-03-31 15:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `guest_id` bigint UNSIGNED NOT NULL,
  `booking_date` timestamp NOT NULL,
  `property_booked` bigint UNSIGNED NOT NULL,
  `check_in_date` timestamp NOT NULL,
  `check_out_date` timestamp NOT NULL,
  `price` double NOT NULL,
  `discount` bigint UNSIGNED NOT NULL,
  `isCancelled` tinyint(1) DEFAULT NULL,
  `dateCancelled` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `guest_id`, `booking_date`, `property_booked`, `check_in_date`, `check_out_date`, `price`, `discount`, `isCancelled`, `dateCancelled`, `created_at`, `updated_at`) VALUES
(1, 6, '2024-03-31 17:53:19', 1, '2024-03-31 17:49:12', '2024-04-01 17:50:02', 2400, 1, NULL, NULL, '2024-03-31 18:03:17', '2024-03-31 18:03:17'),
(2, 6, '2024-03-31 17:53:19', 1, '2024-04-02 17:49:12', '2024-04-10 17:50:02', 2400, 1, 1, '2024-04-01 16:03:13', '2024-03-31 18:27:54', '2024-04-01 16:03:13'),
(4, 6, '2024-03-31 17:53:19', 1, '2024-04-11 17:49:12', '2024-04-11 17:50:02', 2400, 1, 1, '2024-04-01 17:13:06', '2024-03-31 19:07:22', '2024-04-01 17:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_bookings`
--

CREATE TABLE `cancellation_bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED NOT NULL,
  `refund_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cancellation_bookings`
--

INSERT INTO `cancellation_bookings` (`id`, `booking_id`, `refund_id`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2024-04-01 16:03:13', '2024-04-01 16:03:13'),
(2, 4, 2, '2024-04-01 17:13:06', '2024-04-01 17:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_policies`
--

CREATE TABLE `cancellation_policies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cancellation_policies`
--

INSERT INTO `cancellation_policies` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'flexible', 'full refund up to one-day prior arrival', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(2, 'moderate', 'full refund 5 days prior arrival, 70% refund 3 days prior arrival, 50% refund 1-day prior arrival', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(3, 'strict', '70% refund 5 days prior arrival, 50% refund 3 days prior arrival, 30% refund 1-day prior arrival', '2024-03-31 15:32:56', '2024-03-31 15:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_refunds`
--

CREATE TABLE `cancellation_refunds` (
  `id` bigint UNSIGNED NOT NULL,
  `policy_id` bigint UNSIGNED NOT NULL,
  `days` int NOT NULL,
  `refund_percentage` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cancellation_refunds`
--

INSERT INTO `cancellation_refunds` (`id`, `policy_id`, `days`, `refund_percentage`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(2, 2, 5, 1, '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(3, 2, 3, 0.7, '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(4, 2, 1, 0.5, '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(5, 3, 5, 0.7, '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(6, 3, 3, 0.5, '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(7, 3, 1, 0.3, '2024-03-31 15:32:56', '2024-03-31 15:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nights` int NOT NULL,
  `percentage` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `nights`, `percentage`, `description`, `created_at`, `updated_at`) VALUES
(1, 'New Listing', 0, 0.2, 'discount', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(2, 'Weekly discount', 7, 0.1, '(7 nights or more) discount', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(3, 'Monthly discount', 28, 0.25, '(28 nights or more) discount', '2024-03-31 15:32:56', '2024-03-31 15:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registered_date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `username`, `password`, `fullname`, `registered_date`) VALUES
(6, 'danny123', '$2y$12$toMJ6ogkz8wumiedL38Ygem5Ja.Dt0hC9oy0DvEEnKIhYUcyx.0Nu', 'Danny Cakes', '2024-03-31 16:25:52'),
(7, 'guest123', '$2y$12$SP1zylJ0I/POrhLLRFFIiuPH.byOMs8JsZxrdHOVcQ8tKLvody15u', 'Secret Guess', '2024-03-31 16:43:39'),
(8, 'guest12', '$2y$12$7PqbI.HzkUiwAHCaTye4kO48wDD5jz4leQEr8du9bmL5M3V916bM6', 'Secret Guess', '2024-03-31 17:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `username`, `password`, `fullname`, `created_at`, `updated_at`) VALUES
(1, 'owner1', '$2y$12$LGKZfg1uUMxqshObJlXQl.zjvT1jutWZI6I74U6dGn.01XYP4e/vq', 'Daniel Albertz', NULL, NULL),
(2, 'owner2', '$2y$12$N4Jco9jXwv5dFqs31UI8TOlW/sySkFcDgNz80/i3jxtIKcBj4VuW6', 'Seklet Admirez', NULL, NULL);

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
(2, '2024_03_27_101602_create_addresses_table', 1),
(3, '2024_03_27_103840_create_managers_table', 1),
(4, '2024_03_27_103853_create_guests_table', 1),
(5, '2024_03_27_104313_create_types_table', 1),
(6, '2024_03_27_104557_create_properties_table', 1),
(7, '2024_03_27_104600_create_property_addresses_table', 1),
(8, '2024_03_27_105157_create_discounts_table', 1),
(9, '2024_03_27_105931_create_property_pictures_table', 1),
(10, '2024_03_27_105945_create_amenities_table', 1),
(11, '2024_03_27_106000_create_property_amenities_table', 1),
(12, '2024_03_27_113839_create_reviews_table', 1),
(13, '2024_03_27_131925_create_cancellation_policies_table', 1),
(14, '2024_03_27_132012_create_cancellation_refunds_table', 1),
(15, '2024_03_27_132013_create_property_policies_table', 1),
(16, '2024_03_27_133643_create_bookings_table', 1),
(17, '2024_03_27_134134_create_cancellation_bookings_table', 1),
(18, '2024_03_29_113540_create_property_discounts_table', 1),
(19, '2024_03_29_170002_create_property_types_table', 1),
(20, '2024_03_31_103448_create_token_managers_table', 1),
(21, '2024_03_31_143051_create_token_guests_table', 1);

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
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint UNSIGNED NOT NULL,
  `manager_id` bigint UNSIGNED NOT NULL,
  `property_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `no_of_beds` int NOT NULL,
  `no_of_bedrooms` int NOT NULL,
  `no_of_bathrooms` int NOT NULL,
  `price` double NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `manager_id`, `property_title`, `description`, `slug`, `capacity`, `no_of_beds`, `no_of_bedrooms`, `no_of_bathrooms`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sample List', 'This is Sample List', 'sample-list', 50, 50, 50, 50, 50, 'listed', '2024-03-31 16:53:16', '2024-03-31 16:53:16'),
(2, 2, 'Calatao Sample', 'This is calatao', 'calatao-sample', 25, 5, 5, 5, 5, 'listed', '2024-03-31 16:54:31', '2024-03-31 16:54:31'),
(3, 2, 'Sample Property', 'This is a sample property', 'sample-property', 20, 2, 2, 2, 500, 'unlisted', '2024-03-31 16:55:28', '2024-03-31 16:56:24'),
(4, 1, 'New Listing Owner 1', 'This is a new apartment for rich people only', 'new-listing-owner-1', 50, 50, 50, 50, 150, 'listed', '2024-04-03 15:41:45', '2024-04-03 15:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `property_addresses`
--

CREATE TABLE `property_addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `address_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_addresses`
--

INSERT INTO `property_addresses` (`id`, `property_id`, `address_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-03-31 16:53:17', '2024-03-31 16:53:17'),
(2, 2, 2, '2024-03-31 16:54:31', '2024-03-31 16:54:31'),
(3, 3, 3, '2024-03-31 16:55:28', '2024-03-31 16:55:28'),
(4, 4, 4, '2024-04-03 15:41:45', '2024-04-03 15:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `property_amenities`
--

CREATE TABLE `property_amenities` (
  `id` bigint UNSIGNED NOT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `amenity_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_amenities`
--

INSERT INTO `property_amenities` (`id`, `property_id`, `amenity_id`, `created_at`, `updated_at`) VALUES
(1, 1, 6, '2024-03-31 16:53:16', '2024-03-31 16:53:16'),
(2, 1, 10, '2024-03-31 16:53:17', '2024-03-31 16:53:17'),
(3, 1, 11, '2024-03-31 16:53:17', '2024-03-31 16:53:17'),
(4, 1, 15, '2024-03-31 16:53:17', '2024-03-31 16:53:17'),
(5, 2, 3, '2024-03-31 16:54:31', '2024-03-31 16:54:31'),
(6, 2, 7, '2024-03-31 16:54:31', '2024-03-31 16:54:31'),
(7, 2, 14, '2024-03-31 16:54:31', '2024-03-31 16:54:31'),
(8, 2, 19, '2024-03-31 16:54:31', '2024-03-31 16:54:31'),
(9, 2, 20, '2024-03-31 16:54:31', '2024-03-31 16:54:31'),
(10, 3, 9, '2024-03-31 16:55:28', '2024-03-31 16:55:28'),
(11, 3, 10, '2024-03-31 16:55:28', '2024-03-31 16:55:28'),
(12, 3, 13, '2024-03-31 16:55:28', '2024-03-31 16:55:28'),
(13, 3, 19, '2024-03-31 16:55:28', '2024-03-31 16:55:28'),
(14, 3, 20, '2024-03-31 16:55:28', '2024-03-31 16:55:28'),
(15, 4, 10, '2024-04-03 15:41:45', '2024-04-03 15:41:45'),
(16, 4, 11, '2024-04-03 15:41:45', '2024-04-03 15:41:45'),
(17, 4, 15, '2024-04-03 15:41:45', '2024-04-03 15:41:45'),
(18, 4, 16, '2024-04-03 15:41:45', '2024-04-03 15:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `property_discounts`
--

CREATE TABLE `property_discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `discount_id` bigint UNSIGNED NOT NULL,
  `changed_value` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_discounts`
--

INSERT INTO `property_discounts` (`id`, `property_id`, `discount_id`, `changed_value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0.2, '2024-03-31 16:53:27', '2024-03-31 16:53:27'),
(2, 3, 1, 0.5, '2024-03-31 16:56:08', '2024-03-31 16:56:08'),
(3, 2, 1, 0.2, '2024-04-01 18:22:17', '2024-04-01 18:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `property_pictures`
--

CREATE TABLE `property_pictures` (
  `id` bigint UNSIGNED NOT NULL,
  `property` bigint UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_pictures`
--

INSERT INTO `property_pictures` (`id`, `property`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, 'storage/pictures/vE9e2BSpDZB4xyHiNk46gippdqv4ABJ38R8guoE3.jpg', '2024-03-31 16:53:24', '2024-03-31 16:53:24'),
(2, 2, 'storage/pictures/50zwaPybVswcnrbIeDyBWKAtuW07gpA0P3jgcHoc.jpg', '2024-03-31 16:54:39', '2024-03-31 16:54:39'),
(3, 3, 'storage/pictures/bGCRd55rNUwndxzVhKDyLuPmESXSk330dhFKfWAq.jpg', '2024-03-31 16:55:52', '2024-03-31 16:55:52'),
(4, 3, 'storage/pictures/5lM5CZDJFqxbWe59Ftf6SZC1yZkSW6pOCHmVFLsf.jpg', '2024-03-31 16:56:02', '2024-03-31 16:56:02'),
(5, 1, 'storage/pictures/t8UKlhZTOLYViajIRInbDumbffF4OBxyBVvGeohf.jpg', '2024-04-01 03:58:31', '2024-04-01 03:58:31'),
(6, 1, 'storage/pictures/iFOMDQ1P3NObG7mSe1q0DVDBgS7YkIHfQpW4AglV.jpg', '2024-04-01 04:02:55', '2024-04-01 04:02:55'),
(7, 4, 'storage/pictures/F9N3hPSlwcCBoFtAd9VuwCkpFnUnDW1hCovCRk22.jpg', '2024-04-03 15:41:54', '2024-04-03 15:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `property_policies`
--

CREATE TABLE `property_policies` (
  `id` bigint UNSIGNED NOT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `policy_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_policies`
--

INSERT INTO `property_policies` (`id`, `property_id`, `policy_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2024-03-31 16:53:17', '2024-03-31 16:53:17'),
(2, 2, 3, '2024-03-31 16:54:31', '2024-03-31 16:54:31'),
(3, 3, 1, '2024-03-31 16:55:28', '2024-03-31 16:55:28'),
(4, 4, 1, '2024-04-03 15:41:45', '2024-04-03 15:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint UNSIGNED NOT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `type_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `property_id`, `type_id`, `created_at`, `updated_at`) VALUES
(1, 1, 8, '2024-03-31 16:53:17', '2024-03-31 16:53:17'),
(2, 2, 9, '2024-03-31 16:54:31', '2024-03-31 16:54:31'),
(3, 3, 9, '2024-03-31 16:55:28', '2024-03-31 16:55:28'),
(4, 4, 7, '2024-04-03 15:41:45', '2024-04-03 15:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `rating` double NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `property_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 4.2, 'Clean and as advertised', '2024-04-05 13:44:18', '2024-04-01 17:04:53'),
(2, 6, 1, 4.2, 'Clean and as advertised', '2024-04-05 13:44:18', '2024-04-01 17:05:08'),
(3, 6, 1, 4.2, 'Clean and as advertised', '2024-04-05 13:44:18', '2024-04-01 17:05:09'),
(4, 6, 1, 4.2, 'Clean and as advertised', '2024-04-05 13:44:18', '2024-04-01 17:05:09'),
(5, 6, 1, 4.2, 'Clean and as advertised', '2024-04-05 13:44:18', '2024-04-01 17:05:10'),
(6, 6, 1, 3, 'Clean and as advertised', '2024-04-05 13:44:18', '2024-04-01 18:05:35'),
(7, 6, 1, 3, 'Clean and as advertised', '2024-04-06 13:44:18', '2024-04-01 18:08:02'),
(8, 6, 1, 3, 'Nestled amidst lush greenery and serene landscapes, the [Property Name] stands as a testament to tranquility and luxury. My recent stay at this remarkable property was an unforgettable experience that surpassed all expectations.', '2024-04-06 13:44:18', '2024-04-01 18:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `token_guests`
--

CREATE TABLE `token_guests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `token_guests`
--

INSERT INTO `token_guests` (`id`, `user_id`, `token`, `created_at`, `updated_at`) VALUES
(3, 6, 'dc69243373e94b7b386fe167500e09a2', NULL, NULL),
(4, 7, 'bf66e87c28ff612b349df846357d0f74', NULL, NULL),
(5, 8, 'f775666fed0dc786fa100c0329906799', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `token_managers`
--

CREATE TABLE `token_managers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `token_managers`
--

INSERT INTO `token_managers` (`id`, `user_id`, `token`, `created_at`, `updated_at`) VALUES
(1, 2, 'DNXvXgv9aLW7gA6ZFk8fp9pkeQIkNaTNo0pFcfdLxIAGB32VtfQSjCGT90i0', NULL, NULL),
(2, 1, 'kZ8NBiNJTouKhRGoHSMVmamHWXmbEG302Z1Nz6lG', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'House', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(2, 'Apartment', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(3, 'Bed and Breakfast', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(4, 'Cabin', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(5, 'Villa', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(6, 'Condo Unit', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(7, 'Camper/RV', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(8, 'Farmhouse', '2024-03-31 15:32:56', '2024-03-31 15:32:56'),
(9, 'Guesthouse', '2024-03-31 15:32:56', '2024-03-31 15:32:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_guest_id_foreign` (`guest_id`),
  ADD KEY `bookings_property_booked_foreign` (`property_booked`),
  ADD KEY `bookings_discount_foreign` (`discount`);

--
-- Indexes for table `cancellation_bookings`
--
ALTER TABLE `cancellation_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cancellation_bookings_booking_id_foreign` (`booking_id`),
  ADD KEY `cancellation_bookings_refund_id_foreign` (`refund_id`);

--
-- Indexes for table `cancellation_policies`
--
ALTER TABLE `cancellation_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancellation_refunds`
--
ALTER TABLE `cancellation_refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cancellation_refunds_policy_id_foreign` (`policy_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guests_username_unique` (`username`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `managers_username_unique` (`username`);

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
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_manager_id_foreign` (`manager_id`);

--
-- Indexes for table `property_addresses`
--
ALTER TABLE `property_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_addresses_property_id_foreign` (`property_id`),
  ADD KEY `property_addresses_address_id_foreign` (`address_id`);

--
-- Indexes for table `property_amenities`
--
ALTER TABLE `property_amenities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_amenities_property_id_foreign` (`property_id`),
  ADD KEY `property_amenities_amenity_id_foreign` (`amenity_id`);

--
-- Indexes for table `property_discounts`
--
ALTER TABLE `property_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_discounts_property_id_foreign` (`property_id`),
  ADD KEY `property_discounts_discount_id_foreign` (`discount_id`);

--
-- Indexes for table `property_pictures`
--
ALTER TABLE `property_pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_pictures_property_foreign` (`property`);

--
-- Indexes for table `property_policies`
--
ALTER TABLE `property_policies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_policies_property_id_foreign` (`property_id`),
  ADD KEY `property_policies_policy_id_foreign` (`policy_id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_types_property_id_foreign` (`property_id`),
  ADD KEY `property_types_type_id_foreign` (`type_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_property_id_foreign` (`property_id`);

--
-- Indexes for table `token_guests`
--
ALTER TABLE `token_guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `token_guests_user_id_foreign` (`user_id`);

--
-- Indexes for table `token_managers`
--
ALTER TABLE `token_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `token_managers_user_id_foreign` (`user_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cancellation_bookings`
--
ALTER TABLE `cancellation_bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cancellation_policies`
--
ALTER TABLE `cancellation_policies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cancellation_refunds`
--
ALTER TABLE `cancellation_refunds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_addresses`
--
ALTER TABLE `property_addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_amenities`
--
ALTER TABLE `property_amenities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `property_discounts`
--
ALTER TABLE `property_discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_pictures`
--
ALTER TABLE `property_pictures`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `property_policies`
--
ALTER TABLE `property_policies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `token_guests`
--
ALTER TABLE `token_guests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `token_managers`
--
ALTER TABLE `token_managers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_discount_foreign` FOREIGN KEY (`discount`) REFERENCES `discounts` (`id`),
  ADD CONSTRAINT `bookings_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`),
  ADD CONSTRAINT `bookings_property_booked_foreign` FOREIGN KEY (`property_booked`) REFERENCES `properties` (`id`);

--
-- Constraints for table `cancellation_bookings`
--
ALTER TABLE `cancellation_bookings`
  ADD CONSTRAINT `cancellation_bookings_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `cancellation_bookings_refund_id_foreign` FOREIGN KEY (`refund_id`) REFERENCES `cancellation_refunds` (`id`);

--
-- Constraints for table `cancellation_refunds`
--
ALTER TABLE `cancellation_refunds`
  ADD CONSTRAINT `cancellation_refunds_policy_id_foreign` FOREIGN KEY (`policy_id`) REFERENCES `cancellation_policies` (`id`);

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `managers` (`id`);

--
-- Constraints for table `property_addresses`
--
ALTER TABLE `property_addresses`
  ADD CONSTRAINT `property_addresses_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `property_addresses_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);

--
-- Constraints for table `property_amenities`
--
ALTER TABLE `property_amenities`
  ADD CONSTRAINT `property_amenities_amenity_id_foreign` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`),
  ADD CONSTRAINT `property_amenities_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);

--
-- Constraints for table `property_discounts`
--
ALTER TABLE `property_discounts`
  ADD CONSTRAINT `property_discounts_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`),
  ADD CONSTRAINT `property_discounts_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);

--
-- Constraints for table `property_pictures`
--
ALTER TABLE `property_pictures`
  ADD CONSTRAINT `property_pictures_property_foreign` FOREIGN KEY (`property`) REFERENCES `properties` (`id`);

--
-- Constraints for table `property_policies`
--
ALTER TABLE `property_policies`
  ADD CONSTRAINT `property_policies_policy_id_foreign` FOREIGN KEY (`policy_id`) REFERENCES `cancellation_policies` (`id`),
  ADD CONSTRAINT `property_policies_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);

--
-- Constraints for table `property_types`
--
ALTER TABLE `property_types`
  ADD CONSTRAINT `property_types_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`),
  ADD CONSTRAINT `property_types_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `guests` (`id`);

--
-- Constraints for table `token_guests`
--
ALTER TABLE `token_guests`
  ADD CONSTRAINT `token_guests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `guests` (`id`);

--
-- Constraints for table `token_managers`
--
ALTER TABLE `token_managers`
  ADD CONSTRAINT `token_managers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `managers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
