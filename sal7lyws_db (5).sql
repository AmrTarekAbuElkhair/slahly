-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2022 at 02:43 PM
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
-- Database: `sal7lyws_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `image`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', 'user.png', 'admin@admin.com', '$2y$10$e0qwmBI2B1IOmJJ5X3/O/OlHvDqLuJlSFABw8u63XFRqEgRA5Apn2', '2022-08-03 05:11:39', '2022-09-09 11:58:25'),
(2, 'ahmed hegazy', '1662989160.png', 'ahmed@admin.com', '$2y$10$XIQNobDOleoclJ48/6eTue5/DAfnrr6d4.wFlDEAQ76bLUyF5F3Vq', '2022-09-12 13:26:00', '2022-09-12 13:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => inactive, 1 => active',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => inside, 1 => outside',
  `offer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `status`, `url`, `image`, `type`, `offer_id`, `package_id`, `created_at`, `updated_at`, `start_date`, `end_date`) VALUES
(2, 1, 'test.com', '1662379844.png', 0, 2, NULL, '2022-09-05 12:10:44', '2022-09-05 12:24:13', '2022-09-10', '2022-09-09'),
(3, 1, 'test.com', '1662379844.png', 0, NULL, 1, '2022-09-05 12:10:44', '2022-09-05 12:24:13', '2022-09-07', '2022-09-10'),
(4, 1, 'test.com', '1662379844.png', 0, 1, NULL, '2022-09-05 12:10:44', '2022-09-05 12:24:13', '2022-09-06', '2022-09-09'),
(5, 0, 'test.com', '1662379844.png', 0, NULL, 2, '2022-09-05 12:10:44', '2022-09-05 12:24:13', '2022-09-07', '2022-09-11');

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_reasons`
--

CREATE TABLE `cancellation_reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `reason_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => inactive, 1 => active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_translations`
--

CREATE TABLE `client_translations` (
  `clients_trans_id` int(10) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_services`
--

CREATE TABLE `company_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `read` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => un read, 1 => read',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `user_id`, `name`, `email`, `phone`, `user_message`, `admin_message`, `admin_id`, `read`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, NULL, '01097253062', 'text', NULL, NULL, 1, '2022-08-17 13:03:30', '2022-09-06 07:58:58'),
(2, 3, NULL, NULL, '01023701839', 'Bnnn', NULL, NULL, 0, '2022-08-17 13:11:03', '2022-08-17 13:11:03'),
(3, 3, NULL, NULL, '01023701839', 'Ghhjj', NULL, NULL, 0, '2022-08-17 13:11:57', '2022-08-17 13:11:57'),
(4, 3, NULL, NULL, '01023701839', 'منببهبع', NULL, NULL, 0, '2022-08-22 12:04:19', '2022-08-22 12:04:19'),
(5, 3, NULL, NULL, '01023701839', 'nnn', NULL, NULL, 0, '2022-08-23 14:53:35', '2022-08-23 14:53:35'),
(6, 12, NULL, NULL, '01033009930', 'شكرا', NULL, NULL, 0, '2022-08-25 10:20:43', '2022-08-25 10:20:43'),
(7, 3, NULL, NULL, 'll010237018', 'ghgg', NULL, NULL, 0, '2022-08-25 11:12:09', '2022-08-25 11:12:09'),
(8, 3, NULL, NULL, '01023701839', 'Welcome', NULL, NULL, 1, '2022-08-27 00:47:38', '2022-09-06 07:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => inactive, 1 => active',
  `digits` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `status`, `digits`, `logo`, `code`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 'egypt.png', '020', NULL, '2022-08-24 09:18:52'),
(2, 0, 14, 'saudi-arabia.png', '966', '2022-05-21 11:48:59', '2022-08-25 10:37:19'),
(3, 0, 15, 'united-arab-emirates.png', '971', '2022-05-21 11:49:38', '2022-08-21 11:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `country_translations`
--

CREATE TABLE `country_translations` (
  `countries_trans_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country_translations`
--

INSERT INTO `country_translations` (`countries_trans_id`, `country_id`, `locale`, `name`) VALUES
(1, 1, 'en', 'egypt'),
(2, 1, 'ar', 'مصر'),
(3, 2, 'en', 'saudi arabia'),
(4, 2, 'ar', 'المملكة العربية السعودية'),
(5, 3, 'en', 'united arab emirates'),
(6, 3, 'ar', 'الامارات العربية المتحدة');

-- --------------------------------------------------------

--
-- Table structure for table `descriptions`
--

CREATE TABLE `descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `descriptions`
--

INSERT INTO `descriptions` (`id`, `package_id`, `service_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2022-09-13 09:20:23', '2022-09-13 09:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `description_translations`
--

CREATE TABLE `description_translations` (
  `descriptions_trans_id` int(10) UNSIGNED NOT NULL,
  `description_id` int(11) NOT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `description_translations`
--

INSERT INTO `description_translations` (`descriptions_trans_id`, `description_id`, `locale`, `text`) VALUES
(1, 2, 'en', '<p>test</p>'),
(2, 2, 'ar', '<p>تيست</p>');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_rate` double DEFAULT NULL,
  `user_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_rate` double DEFAULT NULL,
  `provider_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `worker_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE `instructions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => inactive, 1 => active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instruction_translations`
--

CREATE TABLE `instruction_translations` (
  `instructions_trans_id` int(10) UNSIGNED NOT NULL,
  `instruction_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_05_17_135745_create_admins_table', 1),
(3, '2022_05_18_091256_create_types_table', 1),
(4, '2022_05_18_103008_create_countries_table', 1),
(5, '2022_05_19_000000_create_services_table', 1),
(6, '2022_05_19_000001_create_users_table', 1),
(7, '2022_05_19_000002_create_password_resets_table', 1),
(8, '2022_05_19_000003_create_failed_jobs_table', 1),
(9, '2022_05_19_080541_create_verifications_table', 1),
(10, '2022_05_19_081054_create_settings_table', 1),
(11, '2022_05_19_081919_create_instructions_table', 1),
(12, '2022_05_19_082526_create_works_table', 1),
(13, '2022_05_19_082923_create_contact_us_table', 1),
(14, '2022_05_19_083649_create_reasons_table', 1),
(15, '2022_05_19_085517_create_worker_prices_table', 1),
(16, '2022_05_19_085949_create_qr_codes_table', 1),
(17, '2022_05_19_090512_create_favorites_table', 1),
(18, '2022_05_19_091307_create_subscribes_table', 1),
(19, '2022_05_19_091704_create_clients_table', 1),
(20, '2022_05_21_095458_create_socials_table', 1),
(21, '2022_06_01_100751_create_notifications_table', 1),
(22, '2022_06_02_105336_create_titles_table', 1),
(23, '2022_06_02_120848_create_wallets_table', 1),
(24, '2022_06_18_095249_create_packages_table', 1),
(25, '2022_06_18_095437_create_descriptions_table', 1),
(26, '2022_06_18_121003_create_offers_table', 1),
(29, '2022_06_19_192028_create_order_package_services_table', 1),
(34, '2022_07_03_135303_create_permission_tables', 1),
(36, '2022_08_28_121701_create_company_services_table', 1),
(37, '2022_06_19_093335_create_orders_table', 2),
(38, '2022_06_20_095306_create_cancellation_reasons_table', 3),
(40, '2022_06_20_101656_create_notification_contents_table', 4),
(41, '2022_06_20_094713_create_evaluations_table', 5),
(42, '2022_08_24_084839_create_ads_table', 6),
(43, '2022_06_27_124928_create_provider_offers_table', 7),
(44, '2022_06_18_123536_create_package_companies_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(2, 'App\\Models\\Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => inactive, 1 => active',
  `type` tinyint(4) NOT NULL,
  `redirect` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `status`, `type`, `redirect`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '2022-06-01 16:25:52', NULL),
(2, 1, 2, 0, '2022-06-01 16:25:52', NULL),
(3, 1, 3, 0, '2022-06-01 16:25:52', NULL),
(4, 1, 4, 0, '2022-06-01 16:25:52', NULL),
(5, 1, 5, 0, '2022-06-01 16:25:52', NULL),
(6, 1, 6, 0, '2022-06-01 16:25:52', NULL),
(7, 1, 7, 0, '2022-06-01 16:25:52', NULL),
(10, 1, 8, 0, '2022-06-01 16:25:52', NULL),
(11, 1, 9, 0, '2022-06-01 16:25:52', NULL),
(12, 1, 0, 0, '2022-06-01 16:25:52', NULL),
(14, 1, 7, 1, '2022-06-01 16:25:52', NULL),
(15, 1, 8, 1, '2022-06-01 16:25:52', NULL),
(16, 1, 5, 0, '2022-09-13 13:13:48', '2022-09-13 13:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `notification_contents`
--

CREATE TABLE `notification_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_contents`
--

INSERT INTO `notification_contents` (`id`, `notification_id`, `order_id`, `user_id`, `provider_id`, `created_at`, `updated_at`) VALUES
(8, 12, 5, NULL, 24, '2022-09-08 09:12:24', '2022-09-08 09:12:24'),
(9, 12, 4, 3, NULL, '2022-09-08 09:12:24', '2022-09-08 09:12:24'),
(10, 16, NULL, 1, NULL, '2022-09-13 13:13:48', '2022-09-13 13:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `notification_translations`
--

CREATE TABLE `notification_translations` (
  `notifications_trans_id` int(10) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_translations`
--

INSERT INTO `notification_translations` (`notifications_trans_id`, `notification_id`, `locale`, `title`, `desc`) VALUES
(1, 1, 'en', 'order accepted', 'The maintenance request has been successfully accepted'),
(2, 1, 'ar', 'تم قبول طلب الصيانة بنجاح', 'سوف يقوم الفني بالتوجه اليك في اسرع وقت'),
(3, 2, 'en', 'order rejected', 'order rejected'),
(4, 2, 'ar', 'تم رفض الطلب', 'تم رفض الطلب'),
(5, 3, 'en', 'The technician is on the way to you', 'The technician will contact you as soon as possible'),
(6, 3, 'ar', 'الفني في الطريق اليك', 'برجاء انتظار الفني في موقع العمل'),
(7, 4, 'en', 'technician arrived', 'Please confirm from the technician through the qrcode'),
(8, 4, 'ar', 'تم وصول الفني', 'برجاء التأكيد من الفني من خلال ال qrcode'),
(9, 5, 'en', 'notification', 'notification'),
(10, 5, 'ar', 'اشعار', 'اشعار'),
(11, 6, 'en', 'offer', 'offer'),
(12, 6, 'ar', 'عرض', 'عرض'),
(13, 7, 'en', 'The work has been completed', 'The maintenance process has been completed successfully'),
(14, 7, 'ar', 'تم انتهاء العملية', 'تم الانتهاء من عملية الصيانة بنجاح'),
(15, 10, 'en', 'The technician has been confirmed successfully', 'The working time will be calculated from now on'),
(16, 10, 'ar', 'تم تأكيد الفني بنجاح', 'سيتم احتساب وقت العمل من الان'),
(17, 11, 'en', 'order finished please pay', 'order finished please pay'),
(18, 11, 'ar', 'تم انتهاء العمل يرجي الدفع', 'تم انتهاء العمل يرجي الدفع'),
(19, 12, 'en', 'You have a new maintenance request', 'Please accept or reject the request within 4 minutes'),
(20, 12, 'ar', 'لديك طلب صيانة جديد', 'برجاء قبول الطلب او رفضه في غضون 4 دقائفق'),
(23, 14, 'en', 'order finished from client', 'Do you agree to quit the job?'),
(24, 14, 'ar', 'تم انتهاء العمل من قبل العميل', 'هل انت موافق علي انهاء العمل'),
(25, 15, 'en', 'The order has been confirmed successfully', 'The working time will be calculated from now on'),
(26, 15, 'ar', 'تم تأكيد الطلب بنجاح', 'سيتم احتساب وقت العمل من الان'),
(27, 16, 'en', 'What is Lorem Ipsum?', '<p>What is Lorem Ipsum?</p>'),
(28, 16, 'ar', 'ما هو \"لوريم إيبسوم\" ؟', '<p>ما هو &quot;لوريم إيبسوم&quot; ؟</p>');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_before_sale` double NOT NULL,
  `price_after_sale` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => inactive, 1 => active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `service_id`, `package_id`, `percentage`, `image`, `price_before_sale`, `price_after_sale`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '10', 'stock-photo-business-girl-smiling-businesswoman-mobile-phone-happy-mobile-smiling-face-using-phone-a7d9ef7e-876f-47c6-9e9f-0b410a49690c.png', 100, 90, 1, '2022-08-21 14:56:30', '2022-08-21 14:56:30'),
(2, 2, 2, '10', 'stock-photo-business-girl-smiling-businesswoman-mobile-phone-happy-mobile-smiling-face-using-phone-a7d9ef7e-876f-47c6-9e9f-0b410a49690c.png', 100, 90, 1, '2022-08-28 14:13:59', '2022-08-28 14:13:59'),
(3, 1, 1, '100', 'stock-photo-business-girl-smiling-businesswoman-mobile-phone-happy-mobile-smiling-face-using-phone-a7d9ef7e-876f-47c6-9e9f-0b410a49690c.png', 1000, 900, 1, '2022-08-30 08:33:25', '2022-08-30 09:02:10'),
(4, NULL, 2, '10', '1662902137.png', 100, 90, 1, '2022-09-11 12:45:47', '2022-09-11 13:15:38');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => new, 1 => in way, 2=> in processing, 3=> finish, 4=> done,-1 => cancelled',
  `payment_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => not paid yet, 1 => paid',
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `visit_time` time DEFAULT NULL,
  `visit_date` date DEFAULT NULL,
  `finish_time` time DEFAULT NULL,
  `working_hours` double DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `provider_id`, `package_id`, `service_id`, `offer_id`, `mobile`, `order_number`, `price`, `status`, `payment_status`, `payment`, `time`, `date`, `visit_time`, `visit_date`, `finish_time`, `working_hours`, `title`, `city`, `lat`, `lng`, `notes`, `apartment_no`, `floor_no`, `mark`, `created_at`, `updated_at`) VALUES
(4, 3, 4, NULL, 1, NULL, '01097253062', '1', '0', 0, 0, '', '10:11:32', '2022-09-06', NULL, NULL, NULL, NULL, 'test', 'test', '31.9876', '29.5432', 'test', '601', '6', 'test', '2022-09-06 08:11:32', NULL),
(5, 3, 24, NULL, 1, NULL, '01097253062', '1', '0', 0, 0, '', '10:11:32', '2022-09-06', NULL, NULL, NULL, NULL, 'test', 'test', '30.033333', '31.233334', 'test', '601', '6', 'test', '2022-09-06 08:11:32', '2022-09-08 09:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `order_package_services`
--

CREATE TABLE `order_package_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => in processing, 1 => finished',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => inactive, 1 => active',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `status`, `image`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, '0B1E8gqlRN9AXtjEtontVOIJ7EsqB1g3YJxQ71CK.png', '100', '2022-06-18 22:45:31', NULL),
(2, 1, '0B1E8gqlRN9AXtjEtontVOIJ7EsqB1g3YJxQ71CK.png', '150', '2022-06-18 22:45:31', NULL),
(3, 1, '2ZQb9u8I8DAAw0Zt5qFRMiD0PAdGgs6MDQUhMZBm.jpeg', '150', '2022-06-18 22:45:31', NULL),
(4, 1, '5kYy494se2pu1UcuVj2Rlkr3W2J3iH6VaCIrCu4O.jpeg', '100', '2022-06-18 22:45:31', NULL),
(5, 1, 'AbiiFoBNw9EEKB7QWT94aBG3e7keQpQPLoWhOkkX.png', '150', '2022-06-18 22:45:31', NULL),
(6, 1, '1663057987.jpeg', '150', '2022-06-18 22:45:31', '2022-09-13 08:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `package_companies`
--

CREATE TABLE `package_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_companies`
--

INSERT INTO `package_companies` (`id`, `package_id`, `provider_id`, `created_at`, `updated_at`) VALUES
(4, 6, 9, '2022-09-13 08:33:07', '2022-09-13 08:33:07'),
(5, 6, 16, '2022-09-13 08:33:07', '2022-09-13 08:33:07'),
(6, 6, 27, '2022-09-13 08:33:08', '2022-09-13 08:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `package_translations`
--

CREATE TABLE `package_translations` (
  `packages_trans_id` int(10) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_translations`
--

INSERT INTO `package_translations` (`packages_trans_id`, `package_id`, `locale`, `name`) VALUES
(1, 1, 'en', 'super lux'),
(2, 1, 'ar', 'سوبر لوكس'),
(3, 2, 'en', 'ultra super lux'),
(4, 2, 'ar', 'الترا سوبر لوكس'),
(5, 3, 'en', 'super lux'),
(6, 3, 'ar', 'سوبر لوكس'),
(7, 4, 'en', 'ultra super lux'),
(8, 4, 'ar', 'الترا سوبر لوكس'),
(9, 5, 'en', 'super lux'),
(10, 5, 'ar', 'سوبر لوكس'),
(11, 6, 'en', 'ultra super lux'),
(12, 6, 'ar', 'الترا سوبر لوكس');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.index', 'admin', '2022-09-12 11:54:54', NULL),
(2, 'settings.index', 'admin', '2022-09-12 11:54:51', NULL),
(3, 'settings.update', 'admin', '2022-09-12 11:54:49', NULL),
(4, 'contacts.index', 'admin', '2022-08-03 03:13:50', NULL),
(5, 'contacts.destroy', 'admin', '2022-08-03 03:13:50', NULL),
(6, 'contacts.reply', 'admin', '2022-08-03 03:13:50', NULL),
(7, 'contacts.store.reply', 'admin', '2022-08-03 03:13:50', NULL),
(8, 'admins.index', 'admin', '2022-08-03 03:13:50', NULL),
(9, 'admins.create', 'admin', '2022-08-03 03:13:50', NULL),
(10, 'admins.edit', 'admin', '2022-08-03 03:13:50', NULL),
(11, 'admins.profile', 'admin', '2022-08-03 03:13:50', NULL),
(12, 'ads.index', 'admin', '2022-08-03 03:13:50', NULL),
(13, 'ads.create', 'admin', '2022-08-03 03:13:50', NULL),
(14, 'ads.edit', 'admin', '2022-08-03 03:13:50', NULL),
(16, 'countries.index', 'admin', '2022-08-03 03:13:50', NULL),
(17, 'countries.create', 'admin', '2022-08-03 03:13:50', NULL),
(18, 'countries.edit', 'admin', '2022-08-03 03:13:50', NULL),
(19, 'instructions.index', 'admin', '2022-08-03 03:13:50', NULL),
(20, 'instructions.create', 'admin', '2022-08-03 03:13:50', NULL),
(21, 'instructions.edit', 'admin', '2022-08-03 03:13:50', NULL),
(22, 'notifications.index', 'admin', '2022-08-03 03:13:50', NULL),
(23, 'notifications.create', 'admin', '2022-08-03 03:13:50', NULL),
(24, 'offers.index', 'admin', '2022-08-03 03:13:50', NULL),
(25, 'offers.create', 'admin', '2022-08-03 03:13:50', NULL),
(26, 'offers.edit', 'admin', '2022-08-03 03:13:50', NULL),
(27, 'orders.index', 'admin', '2022-09-12 08:10:14', NULL),
(28, 'orders.export', 'admin', '2022-09-12 08:10:14', NULL),
(29, 'orders.all.delete', 'admin', '2022-09-12 08:10:14', NULL),
(30, 'orders.show', 'admin', '2022-09-12 08:10:14', NULL),
(31, 'orders-management.index', 'admin', '2022-09-12 08:10:14', NULL),
(32, 'orders-management.export', 'admin', '2022-09-12 08:10:14', NULL),
(33, 'orders-management.all.delete', 'admin', '2022-09-12 08:10:14', NULL),
(34, 'orders-management.show', 'admin', '2022-09-12 08:10:14', NULL),
(35, 'orders-management.update', 'admin', '2022-09-12 08:10:14', NULL),
(36, 'packages.index', 'admin', '2022-08-03 03:13:50', NULL),
(37, 'packages.create', 'admin', '2022-08-03 03:13:50', NULL),
(38, 'packages.edit', 'admin', '2022-08-03 03:13:50', NULL),
(39, 'providers.index', 'admin', '2022-08-03 03:13:50', NULL),
(40, 'providers.create', 'admin', '2022-08-03 03:13:50', NULL),
(41, 'providers.edit', 'admin', '2022-08-03 03:13:50', NULL),
(42, 'providers.export', 'admin', '2022-08-03 03:13:50', NULL),
(43, 'providers.all.delete', 'admin', '2022-08-03 03:13:50', NULL),
(44, 'providers.show', 'admin', '2022-08-03 03:13:50', NULL),
(45, 'reasons.index', 'admin', '2022-08-03 03:13:50', NULL),
(46, 'reasons.create', 'admin', '2022-08-03 03:13:50', NULL),
(47, 'reasons.edit', 'admin', '2022-08-03 03:13:50', NULL),
(48, 'roles.index', 'admin', '2022-08-03 03:13:50', NULL),
(49, 'roles.create', 'admin', '2022-08-03 03:13:50', NULL),
(50, 'roles.edit', 'admin', '2022-08-03 03:13:50', NULL),
(51, 'services.index', 'admin', '2022-08-03 03:13:50', NULL),
(52, 'services.create', 'admin', '2022-08-03 03:13:50', NULL),
(53, 'services.edit', 'admin', '2022-08-03 03:13:50', NULL),
(54, 'socials.index', 'admin', '2022-08-03 03:13:50', NULL),
(55, 'socials.create', 'admin', '2022-08-03 03:13:50', NULL),
(56, 'socials.edit', 'admin', '2022-08-03 03:13:50', NULL),
(57, 'users.index', 'admin', '2022-08-03 03:13:50', NULL),
(58, 'users.create', 'admin', '2022-08-03 03:13:50', NULL),
(59, 'users.edit', 'admin', '2022-08-03 03:13:50', NULL),
(60, 'users.export', 'admin', '2022-08-03 03:13:50', NULL),
(61, 'users.all.delete', 'admin', '2022-08-03 03:13:50', NULL),
(62, 'users.show', 'admin', '2022-08-03 03:13:50', NULL),
(64, 'packages-services.index', 'admin', '2022-08-03 03:13:50', NULL),
(65, 'packages-services.create', 'admin', '2022-08-03 03:13:50', NULL),
(66, 'packages-services.edit', 'admin', '2022-08-03 03:13:50', NULL);

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 3, 'access_token', '8cd902afc87c545e55427f967920173f5b8354fe92a3a13a2d94ef14a7f7011d', '[\"*\"]', '2022-09-08 14:42:30', '2022-09-08 14:31:58', '2022-09-08 14:42:30'),
(2, 'App\\Models\\User', 2, 'access_token', 'b032b5ef8ff28d0cd070a4e066d1ec6d4af6369d6d216b0495cf3721f9b535ab', '[\"*\"]', '2022-09-11 08:14:22', '2022-09-11 08:13:21', '2022-09-11 08:14:22'),
(3, 'App\\Models\\User', 3, 'access_token', 'd305362bf6d1a60f238540e87c7e2d27e4e89d53ab2d31940c9cb04823cb8b1d', '[\"*\"]', '2022-09-11 08:20:40', '2022-09-11 08:15:12', '2022-09-11 08:20:40'),
(4, 'App\\Models\\User', 1, 'access_token', '9d8f96c37a88399819a55d2f36df51e7efe6c10c6e9309efd845fd1a65de6d09', '[\"*\"]', NULL, '2022-09-11 08:41:21', '2022-09-11 08:41:21'),
(5, 'App\\Models\\User', 3, 'access_token', '919d5c4df1ef7b1ce42db1b6fe51cc48a1d173712b53b75ef5ec374970c0af61', '[\"*\"]', NULL, '2022-09-11 08:46:45', '2022-09-11 08:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `provider_offers`
--

CREATE TABLE `provider_offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provider_offers`
--

INSERT INTO `provider_offers` (`id`, `offer_id`, `provider_id`, `created_at`, `updated_at`) VALUES
(1, 4, 3, '2022-09-11 12:45:49', '2022-09-11 12:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `qr_codes`
--

CREATE TABLE `qr_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => inactive, 1 => active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, '2022-09-11 11:23:40', '2022-09-11 11:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `reason_translations`
--

CREATE TABLE `reason_translations` (
  `reasons_trans_id` int(10) UNSIGNED NOT NULL,
  `reason_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reason_translations`
--

INSERT INTO `reason_translations` (`reasons_trans_id`, `reason_id`, `locale`, `text`) VALUES
(1, 1, 'en', '<p>test1</p>'),
(2, 1, 'ar', '<p>تيست1</p>');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', NULL, NULL),
(2, 'Settings Admin', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(55, 2),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(61, 1),
(61, 2),
(62, 1),
(62, 2),
(64, 1),
(64, 2),
(65, 1),
(65, 2),
(66, 1),
(66, 2);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => inactive, 1 => active',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `status`, `icon`, `created_at`, `updated_at`) VALUES
(1, 1, 'Group90487.png', '2022-05-19 12:31:12', '2022-08-22 11:46:03'),
(2, 1, 'Group90487.png', '2022-05-19 12:31:12', NULL),
(3, 1, 'Group90488.png', '2022-05-19 12:31:22', NULL),
(4, 1, 'Group90490.png', '2022-05-19 12:31:22', NULL),
(5, 1, '1662044287.png', '2022-05-19 12:31:22', '2022-09-01 14:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `service_translations`
--

CREATE TABLE `service_translations` (
  `services_trans_id` int(10) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_translations`
--

INSERT INTO `service_translations` (`services_trans_id`, `service_id`, `locale`, `name`, `desc`) VALUES
(1, 1, 'en', 'electricity', '<p>lorem</p>'),
(2, 1, 'ar', 'كهرباء', '<p>لوريملاغفةرلاغعلا فغرىقفغعو7ةىللاقفىغىوعةىللاىفغةتوهىغلاىفغةعخه</p>'),
(3, 2, 'en', 'home services', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(4, 2, 'ar', 'خدمة منازل', 'لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.'),
(5, 3, 'en', 'carpentry', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(6, 3, 'ar', 'نجارة', 'لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.'),
(7, 4, 'en', 'plumbing', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(8, 4, 'ar', 'سباكة', 'لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.'),
(9, 5, 'en', 'conditioning', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'),
(10, 5, 'ar', 'تكييفات', '<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `help_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `management_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `android_version_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `android_version_provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ios_version_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ios_version_provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `default_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'logo.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `phone`, `email`, `address`, `youtube`, `whatsapp`, `help_phone`, `management_phone`, `android_version_user`, `android_version_provider`, `ios_version_user`, `ios_version_provider`, `created_at`, `updated_at`, `default_image`) VALUES
(1, 'logo.jpg', '01023444476', 'int412@yahoo.com', '17 El Batrawy, First District, Nasr City, Cairo Governorate', 'https://www.facebook.com/%D8%A7%D9%86%D8%AA%D8%B1%D9%86%D8%A7%D8%B4%D9%8A%D9%88%D9%86%D8%A7%D9%84-%D9%84%D9%84%D9%85%D9%82%D8%A7%D9%88%D9%84%D8%A7%D8%AA-%D9%88%D8%A7%D9%84%D8%A5%D9%86%D8%B4%D8%A7%D8%A1%D8%A7%D8%AA-508079179262920/', '01023444476', '01023444476', '01023444476', '1.0', '1.0', '16.0 beta 4', '16.0 beta 4', '2022-05-19 11:27:55', '2022-08-30 09:14:58', 'logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `setting_translations`
--

CREATE TABLE `setting_translations` (
  `settings_trans_id` int(10) UNSIGNED NOT NULL,
  `setting_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacy_users` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacy_providers` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting_translations`
--

INSERT INTO `setting_translations` (`settings_trans_id`, `setting_id`, `locale`, `desc`, `about`, `terms`, `privacy_users`, `privacy_providers`) VALUES
(3, 1, 'en', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</strong></p>', '<p>Codebeautify.org Text to HTML Converter</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p>Codebeautify.org Text to HTML Converter</p>  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p>Codebeautify.org Text to HTML Converter</p>  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>');
INSERT INTO `setting_translations` (`settings_trans_id`, `setting_id`, `locale`, `desc`, `about`, `terms`, `privacy_users`, `privacy_providers`) VALUES
(4, 1, 'ar', '<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق &quot;ليتراسيت&quot; (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل &quot;ألدوس بايج مايكر&quot; (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>', '<blockquote>\r\n<p><strong>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق &quot;ليتراسيت&quot; (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل &quot;ألدوس بايج مايكر&quot; (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</strong></p>\r\n</blockquote>', '<p>شكرا الستخدامك خدماتنا. و من أجل تنظيم العالقة الناتجة عن استخدامك لموقع&quot;) com .الموقع&quot;(، أو تطبيقنا صلح لي و شطب لي، )&quot;التطبيق&quot;( والخدمات التي تقدمها .............، تشكل شروط االستخدام هذه )&quot;الشروط&quot;( اتفاقية ملزمة قانونًا بينك، إما بصفتك فر ًدا أو نيابة عن &quot;لك&quot;( ، و شركة ، &quot;الخاص بك&quot; ، له قانونًا )&quot;أنت&quot; ّ منظمة أو كيان تمث ..............شركة مساهمة مصرية ، مالك ومشغل موقع صلح لي و شطب لي ،)&quot;الشركة&quot;، &quot;نحن&quot; ، &quot;لدينا&quot;(. تُطبق هذه الشروط على جميع مستخدمي الموقع، بما في ذلك على سبيل المثال ال الحصر المتصفحات و / أو البائعين و / أو العمالء و / أو مقدمي الخدمات و / أو المساهمين في المحتوى )&quot;المستخدمون&quot;(. ولعلك تدرك أن الشركة أو أي من الشركات التابعة لها تحتفظ بالحق في تقييد أو وقف استخدامك للخدمات عبر اإلنترنت إذا كنت ال تلتزم بهذه الشروط أو وفقً الشركة وحدها. من خالل الوصول إلى ا لتقدير الموقع أو التطبيق أو استخدام أي جزء منهما، فإنك توافق على أنك قد قرأت وفهمت ووافقت على االلتزام بهذه الشروط ، باإلضافة إلى اإلرشادات أو السياسات أو القواعد اإلضافية المتاحة كما هو معمول به على الموقع والتطبيق ، بما في ذلك ، على سبيل المثال ال الحصر ، سياسة الخصوصية اللشركة ، والتي تم دمجها باإلشارة إلى هذه الشروط. إذا كنت ال توافق على االلتزام بهذه الشروط وعلى اتباع جميع القوانين والمبادئ التوجيهية والسياسات المعمول بها ، فال تدخل إلى الموقع أو تستخدمه. .1طبيعة المحتوى الذي يظهر على خدماتنا 1.1نظرة عامة قد تتضمن خدماتنا ن ًصا أو بيانات أو رسومات أو صو ًرا &quot;المحتوى&quot;( أنشأناه بمعرفتنا أو باسم أو أي محتوى آخر )يُشار إليه إجماالً من قبل الغير، بما في ذلك المتعاقدين للتسويق مع الشركة من &lt;&lt;&lt;&lt;&lt;&lt;&lt; 2.1خدماتنا تشمل خدماتنا هذا الموقع والتطبيق مما يتيح للمستخدمين التعرف على مقدمي الخدمة والحجز لديهم بما في ذلك ....... &quot;الخدمات&quot;. بمعنى آخر ، . يُشار إلى خدماتنا العامة والمحمية إجماًال باسم تهدف خدماتنا فقط إلى مساعدتك في البحث وحجز موعد مع مقدم الخدمة. أنت تعلم بأن بعض الخدمات متاحة تحت أسماء مختلفة . أنت تعلم أي ًضا بأنه قد يتم توفير الخدمات من قبل )1 )بعض الشركات الفرعية والتابعة لـ الشركة أو )2 )مقدمي الخدمات المستقلين. 1.2.1الخدمات العامة نُتيح بعض الخدمات بدون تسجيل أو كلمة مرور. و نُطلق عليها &quot;الخدمات العامة&quot;. يجوز لك استخدام الخدمات العامة بشكل شخصي غير تجاري طالما أنك تمتثل لهذه الشروط. تتضمن هذه الخدمات مقدمو دالئل )&quot;الدالئل&quot;( ......................، يُشار إليها إجماًال باسم )&quot; الخدمات&quot;(. حيث يتم تقديم هذه الدالئل لراحتك. تشمل الدالئل فقط مقدمي الخدمات الذين يستخدمون خدماتنا والذين اختاروا المشاركة في الدالئل. ال يشكل إدراج مقدم الخدمات في الدالئل توصية لخدمات مقدم الخدمة هذا أو ضمانًا لشهاداته أو مؤهالته. نظ ًرا ألن جميع المعلومات يتم نقلها على النحو الذي قدمه مقدمو الخدمات ، وبينما نبذل جهو ًدا معقولة لتزويدك بمحتوى دقيق ، فإننا ال نضمن ، أو نمثل ، أو نكفل دقة أي معلومات فيما يتعلق بالمؤهالت المهنية ، الخبرات أو جودة العمل أو معلومات السعر أو التكلفة أو التأمين أو أي محتوى آخر متاح من خالل الخدمات، سواء كانت صريحة أو ضمنية. و لن نتحمل بأي حال من األحوال المسؤولية تجاهك أو تجاه أي شخص آخر عن أي قرار أو إجراء تتخذه اعتما ًدا على أي محتوى من هذا صي بأي شكل من األشكال بأي فرد أو كيان ُم القبيل. نحن ال نؤيد أو نو درج أو يمكن الوصول إليه من خالل الخدمات. بينما يمكن إجراء الحجوزات من خالل موقعنا ، ال يمكننا ضمان توافر مقدم الخدمات ذي الصلة ، وال يمكننا توقع إلغاء مواعيده. 1.2.2الخدمات المحمية بعض خدماتنا محمية بواسطة تدابير تقنية تهدف إلى حماية سرية المعلومات الحساسة وسالمتها وإمكانية الوصول إليها و التي يقوم المستخدمون بتخزينها ومشاركتها باستخدام خدماتنا؛ و نُطلق عليها &quot;الخدمات المحمية&quot;. تتطلب هذه الضمانات من كل مستخدم المصادقة بشكل صحيح عن طريق التفويض )&quot;بيانات االعتماد&quot;( ، مثل المعرفات الفريدة وأسماء المستخدمين وكلمات المرور وما شابه. و من أجل الحصول على بيانات االعتماد ، يجب عليك تقديم معلومات معينة عن نفسك. إذا كنت تقوم بالتسجيل في خدمة محمية ، أو تقوم بالوصول إلى خدمة محمية أو استخدامها ، أو تحاول الوصول إليها أو استخدامها ، نيابة عن ، أو لصالح ، شخص آخر غيرك - مثل أي من أفراد عائلتك )&quot;الفاعل األصلي&quot;( - يجب عليك أي ًضا تحديد وتقديم معلومات حول كل فاعل. تمت اإلشارة إلى الشروط واألحكام األخرى المتعلقة بتسجيل المستخدم في القسم 6 .هذه الخدمات المحمية هي جميع الخدمات التي تُنشئ لك سجال طبيًا شخصيًا للخدمات )&quot;السجل الخدمي&quot;( ، مثل تلقي . هذه البيانات خاصة ومؤمنة تما ًما ونضمن لك ذلك. تُعتبر أنت مالك البيانات الوحيد ، وبمجرد النقر على &quot;أوافق&quot; ، فإنك تمنح مقدمي الخدمات الحق في إرسال المعلومات إليك من خالل حسابك الخاص على الموقع. و من أجل مساعدتك في إنشاء سجلك الخدمي اإللكتروني ، يمكنك الموافقة على إرسال نسخة من هذه البيانات إلى الخدميب الذي يُقدم الخدمة من خالل خدماتنا ، والتي ستتم حمايتها والحفاظ على خصوصيتها باإلضافة إلى عدم مشاركتها مع الغير. سيحتفظ الخدميب بهذه البيانات باسمك في حسابه إلنشاء سجلك الخدمي. في حالة عدم موافقتك على االحتفاظ بسجل طبي لبياناتك ، يمكنك إرسال طلبك إلى الشركة إلبداء رغبتك في عدم مشاركته ، وستلتزم الشركة باالمتثال لهذا الطلب. 3.1المحتوى تُتيح لك خدماتنا الوصول إلى المراجعات والمنتديات األخرى حيث يمكن لمختلف المستخدمين مشاركة المعلومات واآلراء والتقييمات ا المحتوى المقدم أو والمحتويات األخرى. نحن بشكل عام ال نفرز مسبقً نتابعه ، وقد يمثل هذا المحتوى رأي المستخدم ببساطة. قد تتضمن خدماتنا أي ًضا نتائج االستبيان أو التقييمات أو الشهادات )&quot;التقييمات&quot;( من المستخدمين الذين قد يؤيدون أو يوصون أو ينتقدون أو يحللون أو يقيّمون أو يوضحون بطريقة أخرى مقدمي الخدمات وطبيعة الخدمات أو جودتها التي يتلقاها هذا المستخدم. هذه التقييمات هي حسابات قصصية مباشرة للمستخدمين الفرديين ، وال تشكل حكم مقدم الخدمات وال نتاج العلوم الخدمية. لعلك تدرك أن التقييمات الواردة في الموقع هي من أولئك الذين يقدمونها ، وأنها ال تعكس آراء الشركة ، وال تشكل بأي حال من األحوال تأييدنا أو توصيتنا لها. وبالتالي ، لن تتحمل الشركة أي مسؤولية عن أي من التقييمات المنشورة. عالوة على ذلك ، يجب أن تضع في اعتبارك أن التقييمات ُعرضة لألخطاء والتحيزات الشائعة في الحسابات القصصية المباشرة ، وال يُفترض أن تكون موثوقة أو خالية من األخطاء. أي محتوى تحصل عليه أو تستقبله من الشركة أو موظفيها أو المقاولين أو الشركاء أو الرعاة أو المعلنين أو المرخصين أو غير ذلك من خالل الخدمات ، هو ألغراض إعالمية و أغراض التنظيم والدفع فقط. حيث أن جميع المعلومات لألغراض اإلعالمية فقط ،. وال تُعتبر المعلومات المعروضة على الموقع بديالً عن المشورة الخدمية من قبل متخصصي تقديم الخدمة المؤهلين. فإذا كنت تعتمد على أي محتوى ، بما في ذلك المراجعات ، فأنت تقوم بذلك على مسؤوليتك الخاصة. لذلك نشجعك على تأكيد أي محتوى ذي صلة بك بشكل مستقل مع مصادر أخرى ، بما في ذلك مقرات مقدمي الخدمة ، والجمعيات ة ذات الصلة بالتخصص ال الخدمية في الدولة ، ُم الخدمي طبق ، والمجالس وسلطات الترخيص أو التصديق المناسبة للتحقق من بيانات االعتماد والتعليم ال . ُمدرجة .2سياسة الخصوصية واألمان 2.1تعتبر الشركة والشركات التابعة لها أن خصوصية معلوماتك الخدمية من أهم العناصر في عالقتنا معك. مسؤوليتنا في الحفاظ على سرية معلوماتك الخدميةهي مسؤولية نأخذها على محمل الجد. نحن مطالبون بموجب القانون بالحفاظ على خصوصية وأمان معلوماتك الخدمية المحمية. سنخبرك على الفور في حالة حدوث خرق قد يكشف عن خصوصية أو أمان معلوماتك. و لن نستخدم أو نشارك معلوماتك بخالف ما هو موضح هنا. حيث تُعتبر أنت مالك البيانات الوحيد و تشاركها عندما ترغب من خالل موقعنا. 2.2لمزيد من الحماية لسرية المعلومات وسالمتها وتوافرها على الشركة ومشاركتها ، باإلضافة إلى استقرار خدماتنا ، فإنك توافق على الضمانات اإلضافية التالية. وبنا ًء على ذلك ، فإنك توافق على أنك لن تفعل ولن تحاول: &bull;الوصول إلى خدماتنا أو استخدامها أو نشرها أو أي معلومات أو ملفات يمكن الوصول إليها عبر خدماتنا ، بطريقة تنتهك القوانين واللوائح المعمول بها أو حقوق أي فرد أو كيان &bull;بيع أو تحويل أي معلومات ُمدرجة في خدماتنا أو استخدام تلك المعلومات لتسويق أي منتج أو خدمة - بما في ذلك عن طريق إرسال أو تسهيل إرسال رسائل البريد اإللكتروني غير المرغوب فيها أو الرسائل االقتحامية (SPAM(؛ &bull;بحث أو فحص أو اختبار نقاط الضعف في خدماتنا ، أو النظام أو الشبكة التي تدعم خدماتنا ، أو التحايل على التدابير األمنية أو المصادقة ؛ &bull;تعطيل أو إغفال أو تجاوز أو تجنب أو إزالة أو إلغاء تنشيط أو التحايل بطريقة أخرى على أي تدابير فنية نُجريها لحماية استقرار خدماتنا ، أو سرية أو سالمة أو توافر أي معلومات أو محتوى أو بيانات موجودة في خدماتنا ؛ &bull;تقديم خدماتنا ألي برنامج أو رمز أو أي جهاز آخر )1 )يسمح بأي طريقة بالوصول غير المصرح به إلى أنظمتنا أو أي برامج أو أجهزة أو ملفات أو بيانات موجودة عليها ، )2 )تعطيل أو إتالف أو التدخل أو التأثير سلبًا على تشغيل أنظمتنا أو أي برامج أو أجهزة أو ملفات أو بيانات موجودة عليها ، أو )3 )يثقل أو يتداخل مع األداء الوظيفي لخدماتنا ؛ &bull;تفكيك أو عكس هندسة خدماتنا ؛ &bull;الحصول على أو استرداد أو فهرسة أو نشر أي جزء من خدماتنا ما لم تكن محرك بحث عام يشارك في خدمات البحث العامة ؛ &bull;تعطيل أو التحايل على ضمانات استخدام واجهة برمجة التطبيقات لدينا ، بما في ذلك الضمانات المصممة لتنظيم طبيعة أو مقدار البيانات التي يُسمح لك باستخراجها من خدماتنا ، أو تكرار الوصول إلى هذه البيانات ؛ أو إجراء مكالمات إلى واجهة برمجة التطبيقات الخاصة بنا بخالف تلك المصرح بها في وثائق واجهة برمجة التطبيقات لدينا ؛ &bull;إزالة أي حقوق نشر أو عالمة تجارية أو إشعارات حقوق الملكية األخرى الواردة في خدماتنا أو ؛ ً &bull; في هذه الشروط المشاركة في أي نشاط آخر غير المسموح به صراحة . يمكنك العثور على مزيد من المعلومات المتعلقة بإجراءات الخصوصية الخاصة بنا في سياسة الخصوصية الخاصة بنا. .3الدفع 1.3تحصيل المدفوعات 1.1.3يمكنك اختيار إما )1 )الدفع نق ًدا لمقدم الخدمة في وقت تقديم الخدمة أو )2 )الدفع عبر اإلنترنت من خالل موقعنا أو تطبيقنا. عند تحصيل المبالغ نيابة عن مقدمي الخدمات ، فإنك توافق صرا ًحة على االلتزام بشروط الدفع الخاصة بمقدم الخدمة هذا. و عند االقتضاء ، سنقوم بتضمين أية ضرائب. نقبل حاليًا الدفع من خالل بطاقات االئتمان / الخصم أو خدمة فوري أو المحافظ الرقمية. أنت توافق على إجراء جميع هذه المدفوعات في الوقت المناسب ، وتقر بأنك مسؤول عن أي مبالغ مرتبطة بحسابك. و اعتما ًدا على الخدمة ، سنقوم بتحصيل المدفوعات قبل أو بعد تقديم الخدمة. نحتفظ بالحق في تحديد أو تعديل أو إزالة أي رسوم ، وفقً 2.1.3 ا لتقديرنا الخاص. قد نقدم أي ًضا عرو ًضا ترويجية أو خصومات ، والتي ستغير المبلغ المدفوع ، ولكن تخضع فقط لشروط وأحكام هذا العرض الترويجي أو الخصم. 2.3سياسة االسترداد 1.2.3الرسوم التي تدفعها نهائية وغير قابلة لالسترداد ، ما لم تحدد الشركة خالف ذلك. تُسترد األموال بنفس طريقة الدفع ، إن ُو . 2.2.3 جدت 3.2.3تحتفظ الشركة بحقها في استرداد أي مبالغ إلى حساب المستخدمين الستخدامها في خدمات أخرى وفقً . ا لتقديرها الخاص ُمستردة غير قابلة للتطبيق إذا كان المستخدم غير را ٍض عن ال المبالغ3.2.4 ة ال . ُم الخدمة الخدمي قدمة 5.2.3يحق للمستخدم استرداد كامل المبلغ إذا: .1.5.2.3ألغى المستخدم الحجز قبل تاريخ الموعد؛ .2.5.2.3ألغى مقدم الخدمة ، أو لم يحضر ، الموعد الذي دفع المستخدم من أجله ؛ .4االمتثال 1.4يتعين عليك االمتثال لهذه الشروط وأي سياسات ُمشار إليها على الموقع وأي قوانين أو لوائح أو قواعد أو تراخيص أو قيود معتمدة من قبل الشركة. .5الترخيص ا لهذه الشروط ، تُمنح حقً 1.5 ا محدو ًدا وقابل لإللغاء وغير حصريًا وفقً الستخدام الخدمات والمحتوى والمواد الموجودة على الموقع في السياق العادي الستخدامك للموقع. ال يجوز لك استخدام الملكية الفكرية للغير دون إذن كتابي صريح منه. 2.5تحتفظ الشركة بملكية حقوق الملكية الفكرية الخاصة بها وال يجوز لك الحصول على أي حقوق بموجب هذه الشروط أو غير ذلك ، باستثناء ما هو في هذه الشروط. وال يحق لك استخدام أو نسخ أو منصوص عليه صراحةً عرض أو أداء أو إنشاء أعمال مشتقة أو توزيع أو نقل أو ترخيص من الباطن من المواد أو المحتوى المتاح على الموقع ، مما قد يكون ضروريًا بشكل معقول الستخدام الخدمات للغرض المقصود منها وباستثناء ما هو منصوص عليه صرا ًحة في هذه الشروط. .6تسجيل المستخدم 1.6ليس عليك التسجيل من أجل زيارة الموقع. للوصول إلى ميزات معينة في الخدمات ، ستحتاج إلى التسجيل في الشركة وإنشاء )&quot;حساب مستخدم&quot;( من خالل عملية التسجيل عبر اإلنترنت على الموقع. يمنحك حسابك إمكانية الوصول إلى الخدمات والوظائف التي قد ننشئها ونحافظ عليها من حين الشركة ا لتقديرنا الخاص. عند إنشاء حساب ، يجب عليك تزويد آلخر ووفقً بمعلومات تسجيل دقيقة وكاملة ، كما هو مطلوب في استمارة التسجيل. عليك إخطار الشركة على الفور إذا تغير أي من هذه المعلومات. و إذا فشلت في تقديم هذه المعلومات أو تحديثها ، فلن تتمكن من تلقي المعلومات المطلوبة من خالل الموقع. و يحق اللشركة أي ًضا إنهاء أو منع استخدامك للخدمات. و بمجرد إنشاء حساب ، يُطلب منك الموافقة صراحةً 2.6 على هذه الشروط. و تُقر أي ًضا بأن عمرك يتجاوز 11 عا ًما لالستفادة من خدماتنا ، وأننا ال نتحمل المسؤولية عن استخدام خدماتنا إذا كان عمرك أقل من 11 عا ًما. 3.6يتعين عليك اختيار كلمة مرور للوصول إلى حساب المستخدم الخاص بك و تحافظ على سريتها في جميع األوقات. و تدرك أي ًضا أنك ستكون مسؤوالً عن أي أفعال / أنشطة تتم على حساب المستخدم الخاص بك من قبل األطراف غير المصرح لها. و يجب عليك إخطارنا إذا كنت تعتقد بشدة أن حسابك قد تم اختراقه. ال يجب عليك تحت أي ظرف من الظروف الرد على طلب للحصول على كلمة المرور الخاصة بك ، و ال سيما طلب من شخص يدعي أنه موظف في الشركة. و ال يجوز لك تفويض أو تعيين أو نقل حساب المستخدم الخاص بك إلى الغير. وال بد أن تدرك أنه سيتم رفض وصولك إلى حسابك إذا فشلت في إدخال كلمة المرور الخاصة بك لمرتين متتاليتين. 4.6من خالل الوصول إلى خدماتنا واستخدامها ، فإنك توافق على استخدامنا لعنوان بريدك اإللكتروني إلرسال إشعارات متعلقة بالخدمة أو تغيير الميزات أو العروض الخاصة بما في ذلك أي إشعارات مطلوبة بموجب القانون ، بدالً من االتصال بالبريد العادي. .7دقة المعلومات واكتمالها و حداثتها 1.7لسنا مسؤولين إذا كانت المعلومات المتوفرة على هذا الموقع غير دقيقة أو كاملة أو حديثة. يتم توفير المواد الموجودة على هذا الموقع للحصول على معلومات عامة فقط وال ينبغي االعتماد عليها أو استخدامها كأساس وحيد التخاذ القرارات دون استشارة مصادر المعلومات األولية أو األكثر دقة أو األكثر اكتماًال أو األكثر حداثة. يكون أي اعتماد على المواد الموجودة على هذا الموقع على مسؤوليتك الخاصة. 2.7قد يحتوي هذا الموقع على معلومات تاريخية معينة. ليست بالضرورة أن تكون المعلومات التاريخية حديثة ولكن يتم توفيرها كمرجع لك فقط. نحتفظ بالحق في تعديل محتويات هذا الموقع في أي وقت ، لكننا لسنا ملزمين بتحديث أي معلومات على موقعنا. و توافق على أنه من مسؤوليتك مراقبة التغييرات على موقعنا. .8األدوات االختيارية 1.8قد نوفر لك إمكانية الوصول إلى أدوات الغير التي ال نراقبها وال نملك أي سيطرة عليها. &quot;كما و &quot; 2.8تُقر وتوافق على أننا نوفر الوصول إلى هذه األدوات &quot;كما هي هي متوفرة&quot; دون أي ضمانات أو إقرارات أو شروط من أي نوع ودون أي مصادقة. و لن نتحمل أي مسؤولية من أي نوع تنشأ عن أو تتعلق باستخدامك لألدوات االختيارية التابعة للغير. 3.8أي استخدام من جانبك لألدوات االختيارية المقدمة من خالل الموقع يكون على مسؤوليتك الخاصة وتقديرك تما ًما ، ويجب عليك التأكد من أنك على دراية بالشروط التي يتم توفير األدوات من خاللها والموافقة عليها من قبل مقدمي خدمات األطراف الثالثة ذي الصلة. 4.8قد نقدم أي ًضا ، في المستقبل ، خدمات و / أو ميزات جديدة من خالل موقع الويب )بما في ذلك ، إصدار أدوات وموارد جديدة(. تخضع هذه الميزات و / أو الخدمات الجديدة أي ًضا لشروط الخدمة هذه. .9روابط الغير 1.9قد تشتمل بعض المحتويات والمنتجات والخدمات المتوفرة عبر موقعنا على مواد من األطراف الثالثة. قد توجهك روابط الغير الموجودة على هذا الموقع إلى مواقع ويب تابعة ألطراف ثالثة غير تابعة لنا. 2.9لسنا مسؤولين عن فحص أو تقييم المحتوى أو دقته وال نضمن ولن نتحمل أي مسؤولية عن أي مواد أو مواقع خاصة بطرف ثالث ، أو عن أي مواد أو منتجات أو خدمات أخرى ألطراف ثالثة. 3.9لسنا مسؤولين عن أي ضرر أو تلف يتعلق باستخدام الخدمات أو الموارد أو المحتوى أو أي معامالت أخرى تتم فيما يتعلق بأي مواقع ويب تابعة ألطراف ثالثة. يُرجى مراجعة سياسات وممارسات الطرف الثالث بعناية والتأكد من فهمك لها قبل الدخول في أي معاملة. تُوجه الشكاوى أو المطالبات أو المخاوف أو األسئلة المتعلقة بمنتجات الطرف الثالث إلى الطرف الثالث نفسه. .10تعليقات المستخدم والمالحظات واالقتراحات األخرى إذا قمت ، بنا ًء 1.10 على طلبنا ، بإرسال بعض المقترحات المحددة )على سبيل المثال خانات المسابقات( أو دون طلب منا ، فإنك ترسل أفكا ًرا أو اقتراحات أو مقترحات أو خط ًطا إبداعية أو مواد أخرى ، سواء عبر اإلنترنت أو عبر البريد اإللكتروني أو البريد العادي أو غير ذلك. )يُشار &quot;التعليقات&quot;( ، و توافق على أنه يجوز لنا ، في أي وقت باسم ، إليها إجماالً ، دون قيود ، تعديل ونسخ ونشر وتوزيع وترجمة واستخدام أي تعليقات ترسلها إلينا بأي وسيلة أخرى. ولسنا ملزمين )1 )بالحفاظ على سرية أي تعليقات ؛ )2 )بدفع تعويض عن أي تعليقات ؛ أو )3 )بالرد على أي تعليقات. 2.10يجوز لنا ، ولكننا غير ملزمين بمراقبة أو تعديل أو إزالة المحتوى ا لتقديرنا الخاص بأنه غير قانوني أو مسيء أو مهدد أو الذي نحدده وفقً تشهيري أو قذفي أو فاحش أو ينتهك الملكية الفكرية ألي طرف أو شروط االستخدام هذه. 3.10توافق على عدم انتهاك تعليقاتك ألي حق ألي طرف ثالث ، بما في ذلك حقوق النشر أو العالمات التجارية أو الخصوصية أو الشخصية أو أي حقوق شخصية أو حقوق ملكية أخرى. و توافق أي ًضا على عدم احتواء تعليقاتك على مواد تشهيرية أو غير قانونية أو مسيئة أو فاحشة ، أو تحتوي على أي فيروسات للحاسوب أو برامج ضارة أخرى يمكن أن تؤثر بأي شكل من األشكال على تشغيل الخدمة أو أي موقع ويب ذي صلة. ال يجوز لك استخدام عنوان بريد إلكتروني مزيف ، أو التظاهر بأنك شخص آخر غيرك ، أو تضليلنا أو تضليل الغير فيما يتعلق بأي تعليقات. أنت وحدك المسؤول عن أي تعليقات تنشرها و مسؤول أي ًضا عن دقتها. وال نتحمل أي مسؤولية عن أي تعليقات تنشرها أو ينشرها الغير. .11األخطاء وعدم الدقة والسهو 1.11أحيانًا ، قد تكون هناك معلومات على موقعنا تحتوي على أخطاء مطبعية أو عدم دقة أو سهو قد يتعلق بمقدمي الخدمات و المنتجات المتعلقة بالخدمة من حيث أوصاف المنتج ، والتسعير ، والعروض الترويجية ، والعروض ، ورسوم شحن المنتج ، وأوقات االنتقال والتوافر. نحتفظ بالحق في تصويب أي أخطاء أو عدم دقة أو سهو و تغيير المعلومات أو تحديثها و إلغاء الطلبات إذا كانت أي معلومات في الخدمة أو على أي موقع إلكتروني ذي صلة غير دقيقة في أي وقت دون إشعار مسبق. .12االستخدامات المحظورة 1.12باإلضافة إلى المحظورات األخرى المنصوص عليها في هذه الشروط ، يُحظر عليك استخدام الموقع أو تطبيقنا أو محتواه: )أ( ألي غرض غير قانوني ؛ )ب( تحريض اآلخرين على المشاركة في أي أعمال غير قانونية ؛ )ج( انتهاك أي لوائح أو قواعد أو قوانين أو مراسيم محلية أو دولية أو فيدرالية أو إقليمية أو خاصة بالوالية ؛ )د( التعدي على أو انتهاك حقوق الملكية الفكرية الخاصة بنا أو حقوق الملكية الفكرية لآلخرين ؛ )هـ( المضايقة أو اإلساءة أو اإلهانة أو األذى أو التشهير أو االستخفاف أو التخويف أو التمييز على أساس الجنس أو الميول الجنسية أو الدين أو العرق أو الساللة أو السن أو األصل القومي أو اإلعاقة ؛ )و( تقديم معلومات خاطئة أو مضللة ؛ )ز( لتحميل أو نقل فيروسات أو أي نوع آخر من الشفرات الخبيثة التي ستستخدم أو يمكن استخدامها بأي طريقة من شأنها التأثير على وظيفة أو تشغيل الخدمة أو أي موقع ويب ذي صلة أو مواقع ويب أخرى أو اإلنترنت ؛ )ح( لجمع أو تتبع المعلومات الشخصية لآلخرين ؛ )ط( إرسال بريد عشوائي أو التصيد االحتيالي أو التحجج االحتيالي أو زحف الشبكة ؛ )ي( ألي غرض فاحش أو غير أخالقي ؛ أو )ك( للتدخل أو التحايل على ميزات األمان للخدمة أو أي موقع ويب ذي صلة أو مواقع ويب أخرى أو اإلنترنت. و نحتفظ بالحق في إنهاء استخدامك للخدمة أو أي موقع ويب ذي صلة النتهاك أي من االستخدامات المحظورة. .13إخالء المسؤولية عن الضمانات وحدود المسؤولية 1.13ال نضمن أن استخدامك لخدمتنا سيكون دون انقطاع أو مناسبًا أو آمنًا أو خاليًا من األخطاء. بينما نسعى دائ ًما للتأكد من أن مقدمي الخدمات مرخصون حسب األصول في االختصاص ذي الصلة ، و ال نضمن أن ا أو يكون المحتوى الخاص بنا دائ ًما خاليًا من األخطاء أو كامًال أو دقيقً ا ُمحدث . ً 2.13ال نضمن أن النتائج التي قد تحصل عليها من استخدام الخدمة ستكون دقيقة أو موثوقة. 3.13توافق على أنه من حين آلخر قد نمحي الخدمة لفترات زمنية غير ُمحددة أو إلغاء الخدمة في أي وقت دون إخطارك. 4.13توافق صرا ًحة على أن استخدامك للخدمة أو عدم قدرتك على استخدامها يكون على مسؤوليتك الخاصة. تُقدم الخدمات وجميع المنتجات والخدمات المقدمة لك من خالل الخدمة )باستثناء ما هو مذكور صرا ًحة من قبلنا&quot; (كما هي&quot; و &quot;كما هي متوفرة&quot; الستخدامك ، دون أي إقرارت أو ضمانات أو شروط من أي نوع ، سواء كانت صريحة أو ضمنية ، بما في ذلك جميع الضمانات الضمنية أو شروط صالحية العرض في السوق والجودة التجارية والمالءمة لغرض معين و االستمرارية والملكية وعدم االنتهاك. 5.13لن نتحمل بأي حال من األحوال و مديرينا أو مسؤولينا أو موظفينا أو الشركات التابعة لنا أو الوكالء أو المقاولين أو األطباء المقيمون أو الموردين أو مقدمي الخدمات أو المرخصين المسؤولية عن أي إصابة أو خسارة أو مطالبة أو أي ضرر مباشر أو غير مباشر أو عرضي أو تأديبي أو خاص أو أضرار تبعية من أي نوع ، بما في ذلك ، على سبيل المثال ال الحصر ، خسارة األرباح ، أو خسارة اإليرادات ، أو خسارة المدخرات ، أو فقدان البيانات ، أو تكاليف االستبدال ، أو أي أضرار مماثلة ، سواء كانت قائمة في العقد ، أو الضرر )بما في ذلك اإلهمال( ، أو المسؤولية التامة أو غير ذلك ، الناشئة عن استخدامك ألي من الخدمات أو أي منتجات تم شراؤها باستخدام الخدمة أو ألي مطالبة أخرى تتعلق بأي شكل من األشكال باستخدامك للخدمة أو أي منتج ، بما في ذلك ، على سبيل المثال ال الحصر ، أي أخطاء أو سهو في أي محتوى ، أو المشورة الخدمية أو الوصفات الخدمية أو أي خسارة أو ضرر من أي نوع يحدث نتيجة الستخدام الخدمة أو أي محتوى )أو منتج( يتم نشره أو نقله أو إتاحته بطريقة أخرى عبر الخدمة ، حتى لو تم التنبيه بإمكانية حدوث ذلك. 6.13ال تتحمل الشركة المسؤولية عن أي أضرار تلحق بك بما في ذلك على سبيل المثال ال الحصر، األضرار المباشرة أو غير المباشرة أو الخاصة أو التبعية أو التأديبية أو العرضية ، الناشئة عن أو فيما يتعلق بأي من األفعال التالية التي يرتكبها مقدمو الخدمة: &bull;اإلخفاق في تقديم آداب معاملة العميل )متلقي الخدمة(؛ ُ &bull; مشين ؛ السلوك غير المهني أو غير األخالقي أو ال &bull;التشخيص الخاطئ أو المتأخر بشأن الخدمة المطلوبة؛ &bull;المعالجة الخاطئة أو المتأخرة أو عدم وجود معالجة على اإلطالق للمشكلة المراد تلقي الخدمة بشأنها. &bull;سوء الممارسة الخدمية أو اإلهمال ؛ &bull;إلغاء الموعد أو تأخر مقدم الخدمة أو عدم الحضور على اإلطالق إلى موعد الفحص. نحن ال نقدم المشورة الخدمية أو معالجة للمشكالت المراد تلقي الخدمة بشأنها ، و ال ندعم وال نوصي بـ مقدم خدمة ُمعين، ولكن نود مساعدتك فقط في البحث عن أفضل مقدم للخدمة وحجز موعد وفقً الحتياجاتك الخدمية. لذلك ا ، من الضروري أن تتوخى نفس الحذر و تتخذ الحيطة التي كنت ستطبقها حتى لو لم تكن تستخدم خدماتنا. أنت تدرك وتقر بأن الشركة لن تكون مسؤولة عن أي أضرار أو وفيات أو إصابات أو أمراض أو خسائر أو تكاليف أو مصروفات مهما كانت طبيعتها الناجمة عن مقدم الخدمة. .14التعديل 1.14تتغير تقنية اإلنترنت والقوانين والقواعد واللوائح المعمول بها بشكل متكرر. و عليه ، تحتفظ الشركة بالحق في إجراء تغييرات على هذه الشروط في أي وقت. حيث يُشكل استمرار استخدامك للموقع موافقة على أي حكم جديد أو ُمعدل من هذه الشروط قد يتم نشره على الموقع. سننشر الشروط ُمعدلة على هذه الصفحة ونشير في أعلى الصفحة إلى آخر تاريخ لمراجعة ال لهذه الشروط. .15اختيار القانون 1.15تخضع هذه الشروط وجميع الدعاوى واإلجراءات الواردة أدناه وتُفسر ا لقوانين جمهورية مصر العربية. كما تخضع بشكل صريح وغير قابل وفقً لإللغاء لالختصاص القضائي الحصري لمحاكم القاهرة و مصر وتتنازل عن أي دعاوى تتعلق بمكان محاكمة غير مالئم. .16أحكام متنوعة 1.16لعلك تدرك أنه قد يتم إلغاء تنشيط حسابك أو استخدامك للموقع / التطبيق أو إنهاؤه بنا ًء على طلبك أو وفقً الشركة أو أي من الشركات ا لتقدير التابعة لها لعدم االلتزام بهذه الشروط. 2.16يجوز لنا التنازل عن هذه الشروط بحرية فيما يتعلق بدمج األصول أو االستحواذ عليها أو بيعها ، أو بموجب القانون أو ألي سبب آخر. 3.16في حالة أصبح أي حكم من هذه الشروط غير قانوني أو باطل أو غير للتنفيذ إلى أقصى حد يسمح به القانون قابل للتنفيذ ، يكون هذا الحكم قابالً المعمول به ، ويُعتبر الجزء غير القابل للتنفيذ منفصًال عن شروط الخدمة هذه ، وال يؤثر هذا على صالحية وإنفاذ أي من األحكام األخرى. 4.16ال يشكل إخفاقنا في ممارسة أو إنفاذ أي حق أو حكم من هذه الشروط تنازالً عن هذا الحق أو الحكم. 5.16تشكل هذه الشروط ، جنبًا إلى جنب مع اتفاقية المستخدم النهائي وسياسة الخصوصية ، االتفاقية الكاملة بينك وبين الشركة فيما يتعلق بأي خدمات نقدمها ، وتحل محل جميع االتصاالت أو اإلقرارات أو التفاهمات السابقة ، سواء كانت شفهية أو مكتوبة ، فيما يتعلق بموضوع االتفاقية</p>', '<p>شكًرا الستخدامك &quot;الشركة&quot;. ويهمنا للغاية ثقتكم بنا، ونحن ملتزمون بحماية خصوصية وأمن معلوماتك الشخصية. وتساعدنا المعلومات التي تشاركها معنا في أن نقدم لك تجربة رائعة مع &quot;الشركة&quot;. وتشير سياسة الخصوصية إلى ممارسات الخصوصية التي نتبعها بشأن جميع الخدمات التي نقدمها في جميع أنحاء العالم. يشير مصطلح &quot;الشركة&quot; أو &quot;لنا&quot; أو &quot;نحن&quot; إلى شركة &quot;الشركة&quot; شركة مساهمة مصرية ، بينما يشير مصطلح &quot;المستخدم&quot; و&quot;أنت&quot; و&quot;لك&quot; إلى شخصك بصفك مستخدم لخدمات &quot;الشركة&quot;. وتتضمن سياسة الخصوصية، إلى جانب شروط االستخدام، القواعد والسياسات العامة التي تحكم استخدامك لمنصتنا. وربما يُطلب منك الموافقة على شروط وأحكام إضافية بنا ًء على نشاطك عند زيارة منصتنا: .1المعلومات التي نجمعها &quot; بالحفاظ على حماية خصوصية مستخدميها. ُو 1.1تلتزم شركة &quot;الشركة وضعت سياسة الخصوصية التي نتبعها من أجل مساعدتك في فهم كيف نقوم بجمع المعلومات التي تزودنا بها واستخدامها وحمايتها. ولدى ولوجك إلى موقع &quot;الشركة&quot;، نجمع تلقائيًا معلومات معينة حول جهازك، ومنها معلومات حول متصفح الويب الذي تستخدمه، وعنوان بروتوكول اإلنترنت، ومنطقتك الزمنية، وبعض ملفات تعريف االرتباط )الكوكيز( المثبتة على جهازك. عالوة على ذلك، بينما تتصفح الموقع، نجمع معلومات حول صفحات الويب الفردية أو األطباء الذين تشاهدهم، والمواقع اإللكترونية أو مصطلحات البحث التي أحالتك إلى موقع &quot;الشركة&quot;، والمعلومات حول كيفية تفاعلك مع &quot;الشركة.&quot; 2.1كما نقوم بجمع معلومات منك عند التسجيل على موقع &quot;الشركة&quot; أو حجز موعد مع أحد مقدمي الخدمة أو االشتراك في نشرتنا اإلخبارية. وعند الحجز أو التسجيل على موقعنا اإللكتروني، حسبما يكون مناسبًا، قد يُطلب منك إدخال اسمك وعنوان بريدك اإللكتروني وعنوانك البريدي ورقم هاتفك وتاريخ ميالدك )&quot;معلومات شخصية.(&quot; 3.1قد نطلب منك أي ًضا تزويدنا بمعلومات حول تحصيل المدفوعات من بطاقة ائتمانك أو بطاقة الخصم المباشر. وبعد إجراء معاملة ما، لن تُخزن هذه المعلومات الخاصة )بطاقات االئتمان، وأرقام الضمان االجتماعي، والبيانات المالية، وما إلى ذلك( على خوادمنا. 4.1يمكنك أن تطلب منا حذف هذه المعلومات في أي وقت، أو إلغاء االشتراك من رسائل البريد اإللكتروني من خالل الولوج إلى إعدادات حسابك أو اتباع اإلرشادات التفصيلية الواردة أسفل كل رسالة إلكترونية. .2كيف نستخدم بياناتك 1.2نستخدم بعض المعلومات التي نجمعها لمساعدتنا في الكشف عن المخاطر المحتملة واالحتيال )ال سيما عنوان بروتوكول اإلنترنت الخاص بك(، وبوجه أعم لتحسين موقع &quot;الشركة&quot; والنهوض به إلى أفضل مستوى )على سبيل المثال، من خالل إنشاء تحليالت حول كيفية تصفح الموقع أو التطبيق عمالئنا وتفاعلهم معهما، وكذلك لتقييم نجاح حمالتنا التسويقية واإلعالنية.( 2.2نستخدم المعلومات الشخصية التي نجمعها بشكل عام لتلبية أي حجوزات تُجرى من خالل &quot;الشركة&quot;، والتواصل معك، والكشف عن المخاطر المحتملة أو االحتيال، وتزويدك بالمعلومات أو اإلعالنات المتعلقة بمنتجاتنا أو خدماتنا عندما تتماشى المعلومات مع التفضيالت التي شاركتها معنا. .3حماية معلوماتك 1.3نحن نسعى جاهدين لحماية معلوماتك عن طريق تطبيق معايير الحماية الدولية واتخاذ مجموعة متنوعة من التدابير األمنية للحفاظ على سالمة معلوماتك الشخصية عندما تقوم بإجراء حجز أو تدخل معلوماتك الشخصية أو ترسلها أو الوصول إليها. نقوم بفحص موقعنا اإللكتروني وتطبيقنا بانتظام بحثً 2.3 ا عن الثغرات األمنية ونقاط الضعف وذلك للتأكد من أن زيارتك لموقعنا آمنة قدر المستطاع. ونحمي موقعنا اإللكتروني من خالل جدار حماية تطبيقات الويب الذي يقوم بتصفية ومراقبة حركة المرور بين تطبيق الويب وشبكة اإلنترنت. ويكتشف هذا الجدار نقاط الضعف الشائعة في طبقات التطبيق على حافة الشبكة ويحجبها. 3.3نحن نوفر خاصية استخدام خادم آمن. وتُرسل جميع المعلومات الحساسة / االئتمانية المقدمة عبر تقنية &quot;بروتوكول طبقة المقبس اآلمن&quot; ثم تسجل في قاعدة بيانات &quot;مزودي بوابة الدفع&quot; الخاصة بنا وذلك لكي تكون تلك المعلومات متاحة فقط لألفراد الممنوحين حقوق الولوج الخاصة إلى هذه األنظمة والذين يُطلب منهم الحفاظ على سرية المعلومات. 4.3تُخزن بياناتنا مع مزود خارجي يحمل شهادات وتدقيقات معترف بها في مجال الصناعة، بما في ذلك معيار أمان بيانات صناعة بطاقات الدفع المستوى األول، ومعيار اآليزو 10772 ،ومعيار &quot;تأثير معتدل&quot; لقانون إدارة أمن المعلومات الفيدرالي، والبرنامج الفيدرالي إلدارة المخاطر والتفويض، وقانون نقل التأمين )يُشار إليها سابقً الصحي والمساءلة، وتقرير التدقيق لضوابط منظمة الخدمات 2 ا باسم بيان معايير التدقيق رقم 07 و / أو البيان الخاص بمعايير مهام التصديق رقم 21 )وتقرير التدقيق لضوابط منظمة الخدمات 1. 5.3كما نضمن أن جميع بياناتنا محمية بكلمة مرور، ويمكن الوصول إلى تلك البيانات من خالل المصادقة متعددة العوامل. وال يستطيع جميع أفراد فريق &quot;الشركة&quot; الوصول إلى أي بيانات يتم جمعها، حيث يُسمح فقط لألفراد الذين لديهم أدوار محددة باالطالع على البيانات التي يتم جمعها. عندما تُخزن بياناتك على خوادمنا، فإننا نقدمها باسم مستعار ونشفّرها للحفاظ على إخفاء الهوية وتوفير طبقة إضافية من األمان في حالة حدوث خرق للبيانات. .4إلى متى نحتفظ ببياناتك 1.4المعايير المستخدمة لتحديد فترة تخزين البيانات الشخصية هي فترة االحتفاظ القانونية المعنية. وبعد انقضاء تلك الفترة، تُحذف البيانات المقابلة بشكل روتيني، لطالما أنها لم تعد ضرورية لالضطالع بخدماتنا. 2.4نقوم بمعالجة وتخزين بياناتك الشخصية للفترة الالزمة لتحقيق الغرض من ا لذلك، إذا كان لدينا عنوان بريدك اإللكتروني ألننا نقدم خدمات التخزين فقط. ووفقً معينة لك، فإننا نحتفظ بعنوان البريد اإللكتروني طوال الفترة التي نقدم لك فيها هذه الخدمات. 3.4بصورة أساسية، نحتفظ ببياناتك إلى أن يتم حذف حسابك. ويمكنك االطالع على البيانات التي نجمعها منك في أي وقت، ويجوز لك أن تطلب حذفها في أي وقت من خالل الولوج إلى إعدادات حسابك. .5سياسة استخدام ملفات تعريف االرتباط 1.5ملفات تعريف االرتباط هي ملفات صغيرة ينقلها الموقع أو مزود الخدمة إلى القرص الصلب لجهاز الحاسب اآللي من خالل متصفح الويب الخاص بك )إذا سمح َت بذلك( والتي تمكن الموقع اإللكتروني أو أنظمة مزودي الخدمة من التعرف على متصفحك والتقاط معلومات معينة وتذكرها. 2.5نحن نستخدم ملفات تعريف االرتباط لتحسين تجربتك للتحليالت وإلظهار عروض مصصمة خصي ًصا لزياراتك السابقة إلى موقعنا اإللكتروني. كما نستخدم ملفات تعريف االرتباط لمساعدتنا في تجميع البيانات المجمعة حول ارتياد الموقع والتفاعل معه حتى نتمكن من تقديم تجربة مميزة وأدوات أفضل في المستقبل. 3.5إذا كنت تفضل ذلك، يمكنك اختيار تفعيل خاصية التحذير في جهاز الحاسوب الخاص بك في كل مرة يتم فيها إرسال ملف تعريف ارتباط، أو يمكنك اختيار إيقاف تشغيل جميع ملفات تعريف االرتباط من خالل الولوج إلى إعدادات المتصفح الخاص بك. وعلى غرار معظم المواقع اإللكترونية، إذا قم َت بإيقاف تشغيل ملفات تعريف االرتباط، قد ال تعمل بعض خدماتنا على نحو سليم. .6عدم اإلفصاح عن المعلومات لطرف ثالث 1.6نحن ال نبيع معلوماتك الشخصية المحددة إلى أطراف خارجية وال نتاجر بها وال ننقلها بأي طريقة أخرى. وال يشمل ذلك األطراف الثالثة الموثوقة التي تساعدنا في تشغيل موقعنا اإللكتروني أو إجراء أعمالنا أو تزويدك بالخدمات، طالما أن هذه األطراف وافقت على الحفاظ على سرية هذه المعلومات. ويجوز لنا أي ًضا اإلفصاح عن معلوماتك عندما نرى أن اإلفراج عنها يتماشى مع االمتثال بالقانون، أو بغرض تنفيذ سياسات موقعنا، أو حماية حقوقنا أو حقوق اآلخرين أو ممتلكاتهم أو ألغراض التسويق أو اإلعالن أو غيرها من األغراض. 2.6لن تُخزن كافة تفاصيل الدفع والمعلومات الشخصية محددة الهوية أو تُباع ألي أطراف ثالثة أو تطلع عليها أو تسجيلها لديها. .7اإلفصاح بشأن منصة &quot;إعالن جوجل ديسبالي&quot; 1.7نطبق ميزات تحليالت جوجل، أو &quot;جوجل أناليتيكس&quot;، التي تستخدم معلومات &quot;إعالن ديسبالي&quot; من أجل إعداد تقارير الخصائص الديمغرافية واالهتمامات عبر أداة &quot;جوجل أناليتيكس.&quot; 2.7يمكنك إلغاء االشتراك في أداة &quot;جوجل أناليتيكس&quot; لمنصة &quot;إعالن جوجل ديسبالي&quot; وذلك لمنع استخدام بياناتك بواسطة أداة &quot;جوجل أناليتيكس&quot;، ويتم ذلك من خالل االنتقال إلى صفحة إلغاء االشتراك في أداة &quot;جوجل أناليتيكس.&quot; 3.7نستخدم ملفات تعريف ارتباط الطرف األول، جنبًا إلى جنب مع بائعي الطرف الثالث )بما في ذلك شركة جوجل(، )مثل ملفات تعريف ارتباط &quot;جوجل أناليتيكس&quot;( وملفات تعريف ارتباط الطرف الثالث )مثل ملفات تعريف االرتباط لبرامج &quot;دبل كليك&quot;( وذلك لإلبالغ عن كيفية ارتباط ظهور اإلعالن، واالستخدامات األخرى للخدمات اإلعالنية، والتفاعالت مع ظهور اإلعالنات والخدمات اإلعالنية بزيارة موقعنا اإللكتروني. ويمكنك قراءة المزيد حول ملفات تعريف االرتباط التي تستخدمها مميزات إعالنات &quot;جوجل أناليتيكس&quot; من خالل االنتقال إلى صفحة &quot;سياسة الخصوصية&quot; لمنصة &quot;جوجل أناليتيكس.&quot; .8روابط الطرف الثالث 1.8يجوز لنا إدراج أو تقديم منتجات أو خدمات يقدمها طرف ثالث على موقعنا اإللكتروني. وتتبنى مواقع األطراف الثالثة سياسات خصوصية منفصلة ومستقلة. وبالتالي، ال نتحمل أي مسؤولية أو التزام تجاه محتوى هذه المواقع المتصلة وأنشطتها. ومع ذلك، فإننا نسعى إلى حماية سالمة موقعنا، ونرحب بأي مالحظات أو تعقيبات حول تلك المواقع. وننصحك بشدة باالطالع على سياسة الخصوصية والشروط واألحكام الواردة في كل موقع إلكتروني تزوره. .9حقوقك 1.9لديك الحق في الحصول على تأكيد بشأن ما إذا كانت بياناتك الشخصية قيد المعالجة أم ال. ويمكنك االتصال بنا في أي وقت للمطالبة بهذا الحق. 2.9يحق لك طلب المعلومات التي نقوم بمعالجتها حاليًا. كما يمكنك أن تطلب ما يلي ألغراض المعالجة؛ فئات البيانات الشخصية المعنية؛ والجهات المستفيدة أو فئات الجهات المستفيدة التي ُكشفت البيانات الشخصية لها أو سيتم الكشف عنها، وال سيما الجهات المستفيدة المتواجدة في دول ثالثة أو منظمات دولية؛ والمدة المقررة التي ستُخزن البيانات الشخصية خاللها، حيثما أمكن ذلك، أو المعايير المستخدمة لتحديد تلك المدة إذا لم يكن ذلك ممكنًا؛ والحق في طلب تصحيح البيانات الشخصية من وحدة التحكم أو محوها، أو تقييد معالجة البيانات الشخصية المتعلقة بصاحب البيانات، أو االعتراض على عملية معالجة البيانات؛ والحق في تقديم شكوى إلى هيئة إشرافية؛ وفي حالة عدم جمع البيانات الشخصية من صاحب البيانات، وأي معلومات متاحة من مصدرها. 3.9لديك الحق في إبالغنا بتغير معلوماتك، وعندما لم تعد المعلومات الموجودة لدينا في الملف دقيقة. وبالنظر إلى أغراض المعالجة، تتمتع بالحق في استكمال البيانات الشخصية غير الكاملة، ومنها تقديم بيان تكميلي. 4.9لك كل الحق في طلب محو البيانات الشخصية دون تأخير ال مبرر له. يحق لك تلقي البيانات الشخصية المتعلقة بك التي قُ 5.9 دمت إلى وحدة التحكم، في صيغة منظمة وشائعة االستخدام ومقروءة آليًا. 6.9لديك الحق في االعتراض، في أي وقت، على معالجة بياناتك الشخصية. ولن نعالج البيانات الشخصية في حالة االعتراض على ذلك، ما لم نجد أسباب مشروعة وقهرية لمعالجة البيانات التي من شأنها أن تحجب مصالحك وحقوقك وحرياتك، أو لرفع الدعاوى القانونية أو ممارستها أو الدفاع عنها. 7.9يحق لك سحب موافقتك على معالجة بياناتك الشخصية في أي وقت. .10شروط االستخدام 1.10يُرجى االطالع على شروط االستخدام التي تحدد االستخدام والتنازالت وحدود المسؤولية التي تحكم استخدام موقعنا اإللكتروني، من خالل زيارة الرابط التالي : www.&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;.com .11موافقتك 1.11أنت توافق على سياسة خصوصيتنا لدى زيارة موقعنا اإللكتروني. 2.11يجوز تغيير شروط االستخدام وسياسة الخصوصية الواردة في الموقع اإللكتروني أو تحدثيها من حين آلخر لتلبية المتطلبات والمعايير القانونية. لذلك، نود حثك على زيارة هذه األقسام بشكل متكرر من أجل االطالع على التغييرات التي تُجرى في الموقع. وتعتبر التعديالت سارية المفعول في يوم نشرها. .12االتصال بنا إذا كان لديك أية استفسارات بخصوص سياسة الخصوصية، يمكنك التواصل معنا عبر البريد اإللكتروني على العنوان التاليco@&gt;&gt;&gt;&gt;&gt;&gt;&gt;.customercare</p>', '<p>شكًرا الستخدامكم خدمات &quot; &quot;. تشكل هذه الشروط واألحكام )&quot;الشروط&quot;( اتفاق ُم &quot; )يُشار إليها بـ &quot; &quot; و/أو &quot;نحن&quot;( لزم قانونًا مبرم بين شركة &quot; وبينك بصفتك فرد مستقل، أو بالنيابة عن الكيان الذي تمثله بشكل قانوني عند االقتضاء، أو من تستخدم هذا التطبيق ألجله )يُشار إليهم مجتمعين بـ &quot;مقدم الخدمة&quot; أو &quot;أنت&quot; أو &quot;لك&quot; أو &quot;لكم.(&quot; وتشمل جميع اإلشارات إلى الشروط أي شروط وإرشادات وقواعد اعتمدتها/حددتها &quot; &quot;. ومن خالل استخدام هذه الخدمات، أنت تُقر توافق على أن &quot;فيزيتا&quot; ستتعامل مع استخدامك لهذه الخدمات باعتبار أنه يُعد بمثابة قبول للشروط وأنك ملتزم باالمتثال لها. وتحكم هذه الشروط وصولك للموقع اإللكتروني.www : com.واستخدامك له، باإلضافة إلى أي موقع إلكتروني آخر تملكها أو تديرها &quot; &quot; أو مرخصة من قبلها أو تخضع لرقابتها )يُشار إليها مجتمعة بـ &quot;الموقع اإللكتروني&quot;( والمنتجات والخدمات أو التطبيقات )&quot;التطبيق&quot;( التي تقدمها أو تطورها &quot; &quot; )يُشار إليها مجتمعة بـ&quot;الخدمات&quot;(. عالوة على ذلك، تحكم هذه الشروط، بصيغتها المعدلة من حين آلخر، استخدامك ألي خدمات إلكترونية التي قد تقدمها &quot; &quot; وتحصل عليها، إلى جانب أي خدمة تتطلب االتصال بشبكة اإلنترنت أو الحساب األصلي أو أي حساب آخر تستخدمه للحصول على منتجات أو خدمات إلكترونية تقدمها &quot; &quot;. .1خدماتنا 1.1تتكون خدمتنا من منصة تكنولوجية تسمح لمستخدمي تطبيق أو موقعه اإللكتروني بالبحث عن مواعيد وحجزها لك بصفتك مقدم خدمة مستقل ومقدمي الخدمات المشتركين في منصتنا، بما في ذلك و وغيرها من الخدمات . بعبارة أخرى، نحن نسمح للمستخدمين بالوصول إلى مقدمي الخدمات بسهولة لتلقي . 2.1من الضروري أن تفهم أنك مسؤول مسؤولية كاملة وحصرية عن تزويد المستخدمين بأفضل ، وتقديم الحل الصحيح والفعال والنصائح الفنية و التي يسعون للحصول عليها من طرفك. الحصول على خدمات فنية . ويمكنك التواصل مع مجموعة كبيرة من المستخدمين الذين يسعون للحصول على خدمات فنية من طرفك. 3.1هذه الخدمات غير مخصصة لالستخدام من جانبك في حال كن َت أو الكيان الذي تنتمي إليه أو الكيان الذي تمثله غير مصرح لكم بشكل قانوني بممارسة مهنتك/مهنته أو مزاولة نشاطاتك/ نشاطاته. ومن خالل الموافقة على هذه الشروط، أنت تُقر وتضمن أنك والكيان الذي تنتمي إليه مرخص لك/ له قانونًا بمزاولة أنشطتك/ أنشطته المهنية. الترخيص1. 2. ا محدو ًدا وقابالً 1.2 لإللغاء وغير من خالل استخدام خدماتنا، نمنحك بموجب هذا حقً حصريًا وغير قابالً للترخيص من الباطن في) )1 )الولوج إلى تطبيقنا اإللكتروني أو الموقع اإللكتروني وتحميلهما واستخدامهما لغرض وحيد وهو استخدام خدماتنا، و)2 ) االطالع على المعلومات والمواد المقدمة أو المتاحة أو الموجودة بأي طريقة أخرى على المحتوى الخاص بنا واستخدامها. 2.2هذا الترخيص ال يُقصد به أن يتم التنازل عنه من الباطن، أو بيعه، أو تأجيره، أو استئجاره، أو تصديره، أو استيراده، أو توزيعه، أو نقله، أو منحه بأي طريقة أخرى ألطراف ثالثة. وهو غير مخصص لالستخدام التجاري. وأنت مصرح لك باالستفادة من خدماتنا لالستخدام الشخصي وغير المربح وغير التجاري فقط. 3.2ال يحق لك استكشاف ضعف أي نظام أو شبكة أو فحصه أو اختباره أو اللجوء إلى أي وسيلة أخرى لاللتفاف حول اإلجراءات األمنية أو إجراءات التحقق؛ أو الحصول على مجاالت الخدمة غير العامة أو مجاالت الخدمة المشتركة التي لم تتم دعوتك بشأنها أو التالعب بها أو استخدامها، أو النظم الحاسوبية الخاصة ب أو مقدمي الخدمات التابعين ل؛ أو التشويش أو عرقلة أي مستخدم أو مضيف أو شبكة، على سبيل المثال من خالل إرسال فيروس إلكتروني، أو التحميل الزائد، أو فيض الرسائل، أو الرسائل اإللكترونية غير المرغوب فيها، أو قصف البريد اإللكتروني ألي جزء من الخدمات؛ أو زرع برمجيات خبيثة أو خالفه من خالل استخدام الخدمات في نشر البرمجيات الخبيثة أو الولوج إلى الخدمات أو البحث عنها بأي وسيلة أخرى بخالف واجهاتنا المدعومة للجمهور )على سبيل المثال &quot;تجريف الويب&quot;(؛ أو إرسال رسائل غير مرغوب فيها، أو إعالنات ترويجية، أو إعالنات دعائية أو رسائل إلكترونية تطفلية، أو إرسال معلومات زائفة أو مضللة أو معدلة، بما في ذلك رسائل التصيد االحتيالي )رسائل الدعاية الساخرة(؛ أو نشر أي مواد مزيفة أو مضللة أو تنتهك حقوق اآلخرين) أو الترويج أو الدعاية لمنتجات أو خدمات بخالف منتجاتك وخدماتك بدون الحصول على التصريح الالزم؛ أو انتحال شخصية أو تشويه انتمائك لشخص أو كيان ما) أو نشر أو مشاركة مواد تعتبر غير قانونية أو إباحية أو غير الئقة أو تدعو إلى التعصب أو الكراهية الدينية أو العنصرية أو العرقية أو تنتهك القانون بأي طريقة أخرى أو خصوصية اآلخرين أو تشوه سمعة اآلخرين. .3القيود 1.3ال يحق لمقدمي الخدمات استكشاف ضعف أي نظام أو شبكة أو فحصه أو اختباره أو اللجوء إلى أي وسيلة أخرى لاللتفاف حول اإلجراءات األمنية أو إجراءات التحقق؛ أو الحصول على مجاالت الخدمة غير العامة أو مجاالت الخدمة المشتركة أو التالعب بها أو استخدامها، أو النظم الحاسوبية الخاصة ب أو مقدمي الخدمات التابعين ل؛ أو التشويش أو عرقلة أي مضيف أو شبكة، أو التحميل الزائد، أو فيض الرسائل، أو الرسائل اإللكترونية غير المرغوب فيها، أو قصف البريد اإللكتروني ألي جزء من الخدمات؛ أو زرع برمجيات خبيثة أو خالفه من خالل استخدام الخدمات في نشر البرمجيات الخبيثة أو الولوج إلى الخدمات أو البحث عنها بأي وسيلة أخرى بخالف واجهاتنا المدعومة للجمهور؛ أو إرسال رسائل غير مرغوب فيها، أو إعالنات ترويجية، أو إعالنات دعائية أو رسائل إلكترونية تطفلية، أو زرع معلومات زائفة أو مضللة، بما في ذلك رسائل التصيد االحتيالي )رسائل الدعاية الساخرة(؛ أو نشر أي مواد مزيفة أو مضللة أو تنتهك حقوق اآلخرين) أو الترويج أو الدعاية لمنتجات أو خدمات بخالف منتجاتهم وخدماتهم؛ أو مشاركة مواد غير قانونية أو غير الئقة أو تشهيرية، أو مشاركة محتوى يدعو إلى التعصب أو الكراهية الدينية أو العنصرية أو العرقية. ا محدو ًدا وقابالً 2.3 لإللغاء وغير مع مراعاة هذه الشروط، تُمنح بموجب هذا حقً حصريًا الستخدام المحتوى والمواد المتاحة على التطبيق في السياق العادي الستخدام التطبيق. وال يجوز لك استخدام حقوق الملكية الفكرية للغير بدون الحصول على إذن خطي صريح من الغير فيما عدا ما يسمح به القانون. .4تسجيل مقدم الخدمة وكلمات المرور 1.4من أجل الحصول على ميزات مقدم الخدمة المتعلقة بالخدمات، يتعين عليك التسجيل لدى &quot; &quot; وإنشاء حساب من خالل اتباع عملية التسجيل اإللكترونية على الموقع اإللكتروني. ويتيح لك حسابك الحصول على الخدمات والعمليات التي قد ننشأها ونديرها من حين آلخر ووفق تقديرنا المطلق. ومن خالل إنشاء الحساب، يجب أن تقدم ل معلومات دقيقة وكاملة على النحو المبين في استمارة التسجيل. ويتعين عليك إخطار &quot; &quot; فو ًرا في حال تغيرت هذه المعلومات. وإذا لم تقدم أو تُح ّدث هذه المعلومات، يجوز ل وفق تقديرها الخاص إنهاء حقك في استخدام التطبيق أو الخدمات. 2.4إذا كنت تتعامل مع ألول مرة وأدخل َت بياناتك على النحو الواجب، يُرجى منك التواصل مع لفتح حساب لممارستك، ومن أجل استخدام خدماتنا، يتعين عليك التوقيع على )&quot;اتفاقية &quot;مقدم الخدمة&quot;( حيث تتعهد باالمتثال قانونًا لهذه الشروط وتحميل تطبيقنا على الهاتف المحمول. باإلضافة إلى ذلك، يجب عليك تقديم التصاريح والشهادات والتراخيص التي تثبت أنك مخول على النحو الواجب لممارسة الخدمات المقدمة ، إلى جانب معلوماتك الشخصية )وكذلك &quot;ملفك&quot;( ل. وتمنح ، بموجب هذا، الترخيص الحصري وقابل للتحويل وقابل للترخيص من الباطن وبدون أي رسوم والدائم وغير قابل لإللغاء في استخدام ملفك، واستنساخه، ونشره، وترجمته، وترخيصه من الباطن، ونسخه، وتعديله، وحذفه، وتطويره، وتوزيعه، وإدراج الملف نفسه على منصتنا. 3.4عندما تفتح حسابك، سوف يُطلب منك اختيار كلمة مرور. ويجب أن تحافظ على سرية كلمة مرورك، ويتعين عليك أال تستجيب تحت أي ظرف من الظروف لطلب الحصول على كلمة مرورك، وخاصة إذا كان هذا الطلب من فرد يدعي أنه أحد موظفي . ولن يطلب موظفو الحصول على كلمة مرورك أب ًدا. ويجب أن تُخطر في حال تلقيت مثل هذا الطلب. تعتبر مسؤوالً ، بما في ذلك ال الحصر 4.4 عن أي استخدام لكلمة مرورك وحسابك أي استخدام من جانب طرف ثالث غير مصرح له. ويجب عليك إخطار فو ًرا إذا كنت تظن أن شخص أو كيان غير مصرح له قد حصل على كلمة مرورك أو حسابك أو ولج إليهما أو استخدمهما. عالوة على ذلك، يجب أن تُخطر فو ًرا في حال أصبحت على علم بأي خرق أو محاولة خرق ألمن التطبيق. 5.4تتحمل المسؤولية عن أي نشاط يستخدم حسابك، سواء أذن َت بهذا النشاط أم ال. وأنت تُقر بأنك إذا كنت ترغب في حماية نقل بياناتك أو ملفاتك إلى ، فأنت مسؤول عن استخدام اتصال مشفر وآمن للحصول على الخدمات واستخدامها. وستؤدي فشل عملية تسجيل الدخول ثالث مرات متتالية إلى تعليق معلومات تسجيل الدخول الخاصة بك، وهو ما يُحتم عليك التواصل مع عبر البريد اإللكتروني إلعادة التحقق من حسابك. 6.4لقد اتخذنا تدابير تقنية وتنظيمية معقولة تجاريًا ُمصممة لحماية أمن معلوماتك الشخصية من الفقدان العرضي والوصول واالستخدام غير المصرح به أو التعديل أو اإلفصاح عنها. مع ذلك، ال يمكننا ضمان أن األطراف الثالثة غير المصرح لهم لن يتمكنوا من اختراق هذه التدابير أو استخدام معلوماتك الشخصية ألغراض غير مشروعة. وأنت تُقر بأنك تُقدم معلوماتك الشخصية على مسؤوليتك الشخصية. 7.4يجب أن تأخذ بعين االعتبار ما يلي: &bull;يجب أن تكون بياناتك الشخصية وتصاريحك وتراخيصك دقيقة وكاملة و ُمحدثة في جميع األوقات. وفي حالة اإلخفاق في فعل ذلك، أنت تُقر بأنه يحق ل إنهاء استخدامك للخدمات. &bull;يجب أن تختار كلمة مرور للولوج إلى حساب المستخدم الخاص بك، ويجب أن تحافظ على سرية كلمة المرور في جميع األوقات. أنت توافق على أنك مسؤوالً &bull; عن أي أفعال/ نشاطات تجريها أطراف ثالثة غير مصرح لهم على حساب مقدم الخدمة الخاص بك. وينبغي أن تُخطرنا إذا كنت تعتقد اعتقا ًدا راس ًخا بأنه قد تم اختراق حسابك. &bull;يجب أال تستجيب تحت أي ظرف من الظروف لطلب الحصول على كلمة مرورك، وخاصة إذا كان هذا الطلب من شخص يدعي أنه أحد موظفي . &bull;ال يحق لك تفويض حساب مقدم الخدمة الخاص بك أو إحالته أو نقله للغير. &bull;أنت توافق على أنك ستُمنع من الولوج إلى حسابك في حال فشلت في إدخال كلمة مرورك مرتين متتاليتين. .5الموافقة على الرسائل الواردة من ...... 1.5من خالل التسجيل كمقدم خدمة وتزويد بعنوان بريدك اإللكتروني، أنت توافق على استخدامنا لعنوان بريدك اإللكتروني إلرسال اإلشعارات المتعلقة بالخدمات إليك، ومنها أي إشعارات يقتضيها القانون، أو تغييرات في الميزات والعروض الخاصة بدالً من التواصل عبر البريد. ويجوز لك عدم قبول الرسائل اإللكترونية المتعلقة بالخدمات من خالل إلغاء هذه الخاصية. .6مواقع األطراف الثالثة 1.6قد يحتوي التطبيق على روابط لمواقع األطراف الثالثة أو شركات اإلعالنات أو الخدمات التي ال تملكها &quot; &quot; أو تخضع لرقابتها. وال تتحكم &quot; &quot; وال تتحمل مسؤولية أي محتوى، أو سياسات خصوصية، أو ممارسات خاصة بأي من مواقع األطراف الثالثة أو خدماتها، وال تسري سياسة الخصوصية التي تعتمدها على استخدامك لهذه المواقع. وفي حال ولج َت إلى أحد المواقع اإللكترونية من الموقع اإللكتروني الخاص ب ، فسوف تتحمل مسؤولية ذلك. وأنت تُعفي &quot; &quot; صراحة من أي مسؤولية تنشأ عن استخدامك ألي من مواقع األطراف الثالثة أو خدماتها أو المحتوى الذي تملكه األطراف الثالثة. فضالً عن ذلك، تعتبر أي تعامالت أو المشاركة في اإلعالنات الترويجية لشركات اإلعالن الموجودة على الموقع اإللكتروني، بما في ذلك الدفع وتسليم السلع وأي شروط أخرى )مثل الضمانات(، أمًرا محصو ًرا بينك وبين شركات اإلعالن فقط. وأنت توافق على أن &quot; &quot; ال تتحمل مسؤولية أية أضرار أو خسائر تنشأ من تعامالتك مع شركات اإلعالن تلك. .7المحتوى الذي ينتجه مقدم الخدمة 1.7من خالل استخدام خدماتنا، أنت تزودنا بمعلومات وملفات ومجلدات تقدمها ل )يُشار إليها مجتمعة بـ &quot;ملفك&quot;(. ومن خالل نشر أو تخزين أو نقل أي محتوى على التطبيق أو إليه، بما في ذلك عن طريق تقديم المحتوى الذي ينتجه مقدم الخدمة على الموقع اإللكتروني، أنت تقبل بمنح &quot; &quot; أو تمثيل أو ضمان أن صاحب هذا للتحويل وقابالً المحتوى قد منح &quot; ا وترخي ًصا حصريًا وقابالً &quot; صراحة حقً لإللغاء الستخدام هذا للترخيص من الباطن وخاليًا من أي رسوم ودائ ًما وغير قابالً المحتوى، واستنساخه، ونشره، وترجمته، وترخيصه من الباطن، ونسخه، وتعديله، وحذفه، وتطويره ونشره من أجل إدراج المحتوى ذاته على منصة &quot; &quot;، بما في ذلك على سبيل المثال ال الحصر الموقع اإللكتروني الخاص ب . ويشمل هذا اإلدراج معالجة المحتوى، بما في ذلك على سبيل المثال ال الحصر المنتجات أو الميزات أو الصور المصغرة أو معاينة المستند، أو خيارات التصميم التي نتخذها إلدارة خدماتنا تقنيًا، على سبيل المثال كيف ننشأ نسخ احتياطية للبيانات بشكل متكرر لحماية أمنها. وأنت تمنحنا التصاريح التي نحتاجها للقيام بكافة اإلجراءات الواردة أعاله لغرض وحيد وحصري وهو تقديم الخدمات وتطويرها. ويمتد هذا التصريح أي ًضا ليشمل األطراف الثالثة الموثوقين. 2.7أنت تُقر بأن استخدام &quot; &quot; للمحتوى على منصة &quot; &quot; ال يشكل انتها ًكا لحقوق الملكية الفكرية أو حقوق الطبع والنشر أو العالمات التجارية التي تملكها. وتُقر &quot; &quot; بالحصول على موافقتك المسبقة لإلفصاح عن أي محتوى على أي منصات أخرى بخالف منصة &quot; . وفي حالة رفض المستخدم الموافقة على هذا اإلفصاح، يمنع هذا الرفض &quot; &quot; من اإلفصاح عن المحتوى. وتحتفظ بالملكية الكاملة لملفك أو الصيغة التي يُنشأ بها من قبل &quot; &quot; باعتباره المحتوى الذي ينتجه مقدم الخدمة. ُ 3.7أنت تفهم وتوافق على أن العالقة الت قيمت بينك وبين &quot; ي أ &quot; هي عبارة عن اتفاقية إدارة لجمع البيانات، والحصول عليها، واستحواذها، ونقلها، ومعالجتها، ودمجها وترحيلها، وأنك قدمت تلك البيانات ل لهذا الغرض. وبصرف النظر عن االستثناءات النادرة التي نوضحها في سياستنا بشأن الخصوصية، وبصرف النظر عن مدى تغير الخدمات، نحن ال نُطلع السلطات المعنية بإنفاذ القانون على المحتوى الخاص بك ألي غرض، إال إذا أصدر َت لنا تعليمات بذلك. وأنت المسؤول الوحيد عن دقة الملفات أو المنشورات أو أي معلومات أخرى تقدمها ل واستيفائها وصحتها وقانونيتها. وتقدم الخدمات ميزات تتيح لك مشاركة محتواك مع األشخاص اآلخرين الذين يعملون تحت إشرافك، وهو ما يسمح لهم باالطالع على ملف المحتوى، ونسخ المحتوى أو تعديله أو حتى مشاركته. لذلك، ننصحك بتوخي الحذر مع المحتوى الذي تشاركه مع موظفينك. وأنت تُقر وتوافق، بموجب هذا، على أنه يحق لـ&quot; &quot; االحتفاظ بملفك الشخصي المتاح عبر منصة &quot; &quot; حتى بعدما لم يعد بإمكانك الحصول على خدمات &quot; &quot; أو استخدامها. .8المحتوى الذي تنشأه &quot; &quot; 1.8يشمل المحتوى الذي تنشأه &quot; &quot; جميع المواد المتاحة على التطبيق من خالل الخدمات، بما في ذلك على سبيل المثال ال الحصر الشعارات والتصميم والنصوص ورسومات الجرافيك، إلى جانب اختيارها وترتيبها وتنظيمها. ويشمل المحتوى أي ًضا أسماء منتجات &quot; &quot; وشعاراتها وتصميماتها وتسمياتها. 2.8عالوة على ذلك، يغطي المحتوى الذي تنشأه &quot; &quot; جميع رؤوس الصفحات، أو رسومات الجرافيك المصممة خصي ًصا، أو األيقونات، أو النصوص، أو العالمات التجارية أو اللباس التجاري الخاص ب . وإذا استخدم َت هذا المحتوى، يجب أن يشمل التخصيص المناسب. وتعتبر جميع العالمات التجارية األخرى أو األسماء التجارية وما شابه ذلك والتي تظهر على التطبيق ملك لمالكي كل منها. وال يحق لك استخدام أي من العالمات التجارية أو اللباس التجاري أو األسماء التجارية أو أي عالمات أو لباس أو أسماء مماثلة بشكل محير بدون الحصول على موافقة خطية مسبقة وصريحة من &quot; &quot; أو ملكيتها. 3.8يجوز لك اختيار أو يجوز لنا دعوتك لتقديم تعليقات وشهادات ومالحظات واقتراحات وأفكار وغيرها من اآلراء حول الخدمات، بما في ذلك على سبيل المثال ال الحصر كيفية تطوير الخدمات أو منتجاتنا )&quot;األفكار&quot;(. ومن خالل تقديم أي فكرة، أنت تُقر بأن كشفك عن هذه الفكرة يعتبر مجاني وغير ملتمس، ولن يضع &quot; &quot; تحت أي التزامات ائتمانية وغيرها من االلتزامات المتعلقة بها، وأنه يحق لـ &quot; &quot; الكشف عن األفكار استنا ًدا إلى عدم السرية ألي شخص أو غير ذلك الستخدام األفكار بدون دفع أي تعويض إضافي لك. ويشكل اإلفصاح عن أي أفكار أو تقديمها أو عرضها ترخي ًصا وملكية ومصلحة دائمة وخالية من أي رسوم وعالمية وغير قابلة لإللغاء في جميع براءات االختراع وحقوق الطبع والنشر والعالمات التجارية وجميع حقوق الملكية الفكرية األخرى وغيرها من الحقوق المتعلقة باألفكار مهما كانت طبيعتها، وتنازالً عن أي مطالبة تستند إلى الحقوق األدبية والمنافسة غير المنصفة وأي أساس قانوني آخر. وال يتعين عليك تقديم أية أفكار لنا إذا كنت ال ترغب في منحنا ترخي ًصا بهذه الحقوق. وتعتبر المسؤول الوحيد عن محتوى أي أفكار تصنعها، وسوف تظل كذلك. .9المسؤوليات التي تقع على عاتقك 1.9يجوز حماية المحتوى اآلخر في الخدمات من خالل حقوق الملكية الفكرية لآلخرين، ويعتبر هذا المحتوى سري. ويُرجى أال تنسخ هذه الملفات أو ترفعها أو تُح ّملها أو تشاركها. وتعتبر المسؤول الوحيد عن المواد التي تنسخها أو تشاركها أو ترفعها أو تُحملها أو أي طريقة أخرى أثناء استخدامك للخدمات. 2.9تتحمل المسؤولية الكاملة عن الحفاظ على جميع بياناتك وحمايتها وضمان سالمتها. وال تعتبر &quot; &quot; مسؤولة عن أي فقدان لبياناتك أو تلفها، أو أي تكاليف أو نفقات تتصل بصنع نسخ احتياطية من بياناتك أو استعادتها، أو التعويض عن أي أضرار تلحق بك بسبب انعدام الحماية لبياناتك. 3.9ال يحق لك استخدام الخدمات في إبرام أي اتفاقية أو محاولة إبرامها أو تنفيذها أو محاولة تنفيذها، أو تنسيق أسعار أي منتج أو خدمة تقدمها &quot; &quot; أو تواترها أو كمياتها، أو التدخل بأي طريقة أخرى أو محاولة التدخل في تحديد األسعار أو تقييد اإلنتاج أو تقاسم العمالء أو األسواق. ال يحق لك استخدام الخدمات، سواء بشكل مباشر أو غير مباشر، للنخراط في أي ممارسات غير عادلة أو مضللة أو مناهضة للمنافسة، أو مخالفة بأي طريقة أخرى القوانين أو اللوائح المتعلقة بحماية العمالء أو المنافسة أو مكافحة االحتكار المعمول بها. 4.9توفر &quot; &quot; خدمات يسهل الوصول إليها على آالت وأجهزة مختلفة، بما في ذلك على سبيل المثال ال الحصر، بعض الهواتف المحمولة وأجهزة الحاسب اآللي التي ستُوفرها. وال تقع على &quot; &quot; مسؤولية توفير األجهزة المطلوبة أو مرافق االتصاالت السلكية والالسلكية، أي االتصال بشبكة اإلنترنت أو خدمة االتصاالت. .10المبالغ المردودة 1.10تعتبر الرسوم التي تدفعها نهائية وغير قابلة لالسترداد ما لم تقرر &quot; &quot; خالف ذلك. 2.10يُرد المبلغ من خالل طريقة الدفع ذاتها، إن وجدت. 3.10تحتفظ &quot; &quot; بحقها في رد أية مبالغ إلى حساب المستخدمين الستخدامها في . ا لتقديرها المطلق خدمات أخرى وفقً 4.10ال ينطبق رد المبالغ في حال كان المستخدم غير را ٍض عن الخدمة االفنية المقدمة. 5.10يحق للمستخدم استرداد كامل المبلغ الذي دفعه في الحاالت التالية: 1.5.10إذا ألغى المستخدم الحجز قبل موعد الحجز؛ 2.5.10في حال ألغى مقدم الخدمة الحجز، أو لم يحضر الموعد الذي دفع المستخدم رسومه؛ .11سرية المستخدم 1.11نحن نعتبر خصوصية وسرية البيانات الشخصية لمستخدمينا أمر مقدس. مع ذلك، نحن نفهم طبيعة الخدمة التي تُقدمها ومدى أهمية وضرورة أن تُحدد معلومات شخصية معينة. 2.11لذلك، نتيح لك بموجب هذا إمكانية الوصول إلى البيانات التي تعتبر ضرورية لتنفيذ خدماتك، وتحدي ًدا أسماء المستخدمين وأرقام هواتفهم وعناوين بريدهم اإللكتروني. مع ذلك، يُمارس حق الوصول إلى البيانات لغرض وحيد وهو تعزيز العمليات الداخلية وليس ألغراض ترويجية. في حالة اإلخالل بما سبق، تُقر بأنك تعتبر مسؤوالً &quot; وتحميها 3.11 وتدافع عن &quot; وتعوضها وتبرئها من أي مسؤولية تجاه كافة المطالبات أو اإلجراءات أو الدعاوى التي تنشأ عن األضرار أو الخسائر أو اإلصابات أو التكاليف أو النفقات مهما كان نوعها والتي تلحق بالمستخدمين بسبب كشف مقدم الخدمة عن معلوماتهم الشخصية. .12الملكية الفكرية 1.12تحترم &quot; &quot; حقوق الملكية الفكرية للغير، وتنتظر من مستخدميها أن تحذو ا لتقديرها المطلق أنه ينتهك حقوق حذوها. ويجوز ل حذف المحتوى الذي ترى وفقً وفقً لق الملكية الفكرية للغير. باإلضافة إلى ذلك، يحق ل ا لسلطتها التقديرية غ حسابات المستخدمين الذين ينتهكون حقوق الملكية الفكرية للغير. وفي حال كنت تعتقد أن أحد مستخدمي التطبيق أو الخدمات قد انتهك حقوق الطبع والنشر أو العالمات التجارية الخاصة بك أو بالغير، يُرجى إخطار &quot; &quot; بذلك من خالل البريد اإللكتروني أو عن طريق التواصل مع قسم الشؤون القانونية التابع ل . 2.12تحتفظ &quot; &quot; بملكية حقوق الملكية الفكرية المملوكة لها، وال يجوز لك الحصول على أي حقوق في هذا الصدد باستثناء ما تنص عليه موافقة خطية صراحة. وال يحق لك استخدام، أو نسخ، أو عرض، أو تنفيذ، أو إنشاء أعمال مشتقة، أو توزيع، أو نقل، او ترخيص من الباطن أي مواد أو محتويات متاحة على التطبيق باستثناء ما قد يكون ضروريًا بالقدر المعقول الستخدام الخدمات لألغراض المقصودة منها وفي حدود ما تنص عليه هذه الشروط صراحة. وال يجوز لك محاولة عكس هندسة التكنولوجيا المستخدمة في توفير الخدمات. وإذا ترائ لك أي تصرف يمثل انتها ًكا لهذه الشروط، يُرجى التواصل مع &quot; &quot; وإخطارها بذلك. 3.12ربما تحتوي منصتنا على روابط لمواقع أو إعالنات أو خدمات مملوكة للغير والتي ال تملكها &quot; &quot;. وأنت تُقر وتوافق على أن هذا المحتوى يجوز أن يخضع لشروط استخدام وسياسات خصوصية مختلفة عن شروط االستخدام وسياسات الخصوصية التي تطبقها &quot; &quot;. ولذلك، ال تنطبق عليك الشروط الحالية عند الحصول على خدمات الغير أو استخدامها. وفي حال ولج َت إلى مواقع الغير من خدماتنا، فأنت تقوم بذلك على مسؤوليتك الشخصية، وتوافق على إعفاء &quot; &quot; من كافة المسؤوليات التي تنشأ عن هذا االستخدام. .13التمثيالت والضمانات 1.13أنت تُقر وتتعهد ل بأن) )1 )أنك تتمتع بكامل الصالحيات للدخول في االلتزامات التي تنص عليها هذه الشروط وأدائها؛ )2 )أن موافقتك على االلتزامات التي تقع على عاتقك بموجب هذه الشروط وأدائها ال تشكل انتها ًكا أو تعار ًضا مع أي التزامات قانونية أخرى، أو اتفاقيات، أو ترتيبات، أو أي قوانين أو لوائح أو قواعد معمول بها، أو أي أحكام أو قرارات قضائية ملتزم بتنفيذها؛ )3 )هذه الشروط تشكل ا للشروط واألحكام؛ التزامات قانونية وصحيحة و ُملزمة لك وتعتبر سارية المفعول طبقً )4 )ال يحق لك انتهاك حقوق الطبع والنشر، أو العالمة التجارية، أو األسرار التجارية، أو حق الدعاية أو أي حقوق ملكية فكرية أخرى يملكها أي طرف ثالث أثناء استخدام الموقع اإللكتروني أو الخدمات، أو حق خصوصية عمالئك/ مرضاك؛ )5 ) أنك تتعهد باالمتثال لكافة القوانين واللوائح والقواعد السارية فيما يتعلق باستخدامك للخدمات والموقع اإللكتروني، ومنها هذه الشروط؛ )6 )أنك فني- مقدم خدمة مؤهل على النحو الواجب في مجال )مجاالت( ممارستك. .14إخالء المسؤولية من الضمان 1.14أنت توافق على أنك المسؤول الوحيد عن استخدامك للتطبيق. وتتنصل &quot; &quot; ومسؤوليها ومدرائها وموظفيها ووكالئها ومساهميها من المسؤولين عن كافة الضمانات، سواء كانت ضمانات صريحة أو ضمنية، فيما يتعلق بالخدمات واستخدامك لها. 2.14ال تضمن &quot; &quot;، إلى أقصى حد يسمح بها القانون، أو توافق أو تتحمل المسؤولية عن أي منتجات أو خدمات يعلن عنها أو يوفرها الغير من خالل الخدمات أو الخدمات ذات االرتباط التشعبي التي تُعرض في أي الفتات أو أي وسيلة إعالن &quot; لن تكون طرفً أخرى، وأن &quot; ا أو مسؤولة بأي طريقة أخرى عن مراقبة أي معامالت بينك وبين الغير. .15حدود المسؤولية 1.15أنت توافق على أنك تعتبر مسؤول عن توفير المعالجة الفنية الدقيقة والمهنية للمستخدم والذي يقدمه مقدمي الخدمة الفنية المؤهلين وذوي المهارات العالية. وفقً &quot;، تحت أي ظرف من الظروف، مسؤولة ال عن عدم 2.15 ا لذلك، ال تعتبر ُ رضا المستخدم حيال االستشارة والفحص الفني أو الخدمات الفنية جري الذي أ ت من طرفك، وال استيائه بشأن تجربته معك بشكل عام. 3.15ال يجوز في أي حال من األحوال، وبالقدر الذي يجيزه القانون، أن تكون &quot; &quot; أو مسؤوليها أو مدرائها أو موظفيها أو وكالئها مسؤولين أمامك عن أية أضرار مباشرة أو غير مباشرة أو عرضية أو خاصة أو جزائية أو تبعية مهما كانت والتي تنشأ عن أو تنتج عن أو تتصل بـ )1 )أي أخطاء أو هفوات أو عدم دقة المحتوى، )2 )أي أضرار أو إصابات شخصية مهما كانت طبيعتها والتي تنجم عن وصولك إلى خدماتنا أو استخدامك لها، )3 )الولوج غير المصرح به أو استخدام خوادمنا اآلمنة، و/أو كافة المعلومات الشخصية، و/أو المعلومات المالية المخزنة في تلك الخوادم، )4 )أي انقطاع أو وقف اإلرسال من خدماتنا وإليها، )5 )أي برامج خبيثة أو فيروسات إلكترونية أو فيروس حصان طروادة وما شابه ذلك التي قد تُنقل إلى خدمتنا أو من خاللها من قبل الغير، )6 )أي أخطاء أو إغفاالت في أي محتوى، أو وى منشور أو ُم أي خسائر أو أضرار متكبدة نتيجة الستخدامك ألي محت رسل عبر البريد اإللكتورني أو منقول أو متاح بأي طريقة أخرى من خالل الخدمات، سواء استنا ًدا إلى أي ضمان، أو عقد، أو مسؤولية أو أي نظرية قانونية أخرى، وسواء ما إذا كانت الشركة قد حذرت بشأن احتمالية حدوث تلك األضرار. ويعتبر حد المسؤولية السابق ذكره ساري بالقدر الذي يجيزه القانون. 4.15أنت تُقر صراحة بأن &quot; &quot; ليست مسؤولة عن أي تصرفات تشهيرية أو مسيئة أو غير قانونية من جانب الغير، وأن المسؤولية عن األخطار أو األضرار الناجمة من التصرفات سالفة الذكر تقع بالكامل على عاتقك. 5.15عالوة على ذلك، توفر &quot; &quot; الخدمات وتديرها من منشآتها. وال تقدم &quot; &quot; أي إقرارات تفيد بأن الخدمة مالئمة أو متاحة لالستخدام في مواقع أخرى. ويقوم األشخاص الذين يحصلون على الخدمة أو يستخدمونها من مواقع أخرى بذلك على مسؤوليتهم الشخصية، وهم المسؤولون عن االمتثال لقانونها المحلي. .16التعويض 1.16أنت توافق، بالقدر الذي يجيزه القانون المعمول به، على الدفاع عن &quot; &quot; وممثليها ومسؤوليها ومدرائها وموظفيها ووكالئها ومساهميها )&quot;األطراف المستلمة للتعويض&quot;( وتعويضهم وتبرئتهم من المسؤولية عن أية أضرار أو خسائر أو تكاليف أو نفقات )بما في ذلك على سبيل المثال ال الحصر أتعاب المحامين وتكاليفهم( المتكبدة فيما يتصل بأي مطالبات أو مطالب أو دعاوى التي تُرفع أو تُقام ضد أي من األطراف المستلمة للتعويض، والتي تنشأ أو تتصل بما يلي) )1 )حصولك على الخدمات واستخدامك لها؛ )2 )انتهاك أي شرط من هذه الشروط من طرفك؛ )3 )ادعاء حقائق أو ظروف تشكل انتها ًكا من طرفك ألية أحكام واردة في هذه الشروط، ومنها انتهاكات القانون أو مزاعم تتعلق بانتهاك الخصوصية أو الدعاية، أو حقوق الملكية الفكرية المتعلقة بالمحتوى الذي يُنشأه المستخدم والذي تقدمه أو المحتوى الذي تنشأه &quot; &quot;؛ )4 )ما ينشأ أو يتصل باستخدامك للموقع اإللكتروني أو الخدمات والذي يشكل انتها ًكا ألي من حقوق الغير، بما في ذلك على سبيل المثال ال الحصر أي حقوق للتأليف والنشر، أو حقوق الملكية، أو حق الخصوصية؛ )5 )استخدام الغير ووصوله إلى الخدمات من خالل استخدام اسم المستخدم الخاص بك، أو كلمة مرورك، أو أي رمز سري آخر. ، وفقً 2.16في حال كن َت ُملز ًما بدفع تعويضات بموجب هذا الحكم، يجوز ل ا لتقديرها المطلق والحصري، التحكم في التصرف في أي مطالبة على نفقتك الخاصة. ودون المساس بما تقدم، ال يجوز لك تسوية أي مطالبة، أو التوصل إلى حل وسط بشأنها، أو التصرف فيها بأي طريقة أخرى بدون الحصول على موافقة خطية مسبقة من &quot; .&quot; 3.16أنت تُقر وتتعهد بالدفاع عن &quot; &quot; ومسؤوليها وموظفيها وحمايتهم وتعويضهم وتبرئة ذمتهم من كافة المطالبات أو اإلصابات أو األضرار أو الخسائر أو الدعاوى القانونية التي تشمل أتعاب المحاماة، والتي تنشأ أو تنجم عن أو تتصل بأي تصرفات احتيالية أو خادعة أو مضللة أو تتعلق بالتزوير أو تعتبر غير قانونية بشكل عام ترتكبها مهما كانت األسباب. 4.16على مقدم الخدمة الدفاع عن &quot; &quot; ومسؤوليها وموظفيها وتعويضهم وتبرئة ذمتهم من كافة المطالبات أو اإلصابات أو األضرار أو الخسائر أو الدعاوى القانونية التي تشمل أتعاب المحاماة، والتي تنشأ أو تنجم عن أو تتصل بأية تصرفات أو أخطاء أو إغفاالت من قبل المستخدم. 5.16باإلضافة إلى ذلك، أنت تُقر بأنك تتحمل المسؤولية الكاملة عن دقة الخدمات الفنية المقدمة للمستخدم الذي تعاملت معه من خالل خدمات &quot; &quot;. وال يجوز مساءلة &quot; &quot;، تحت أي ظرف من الظروف، وتحميلها المسؤولية عن أي خطأ فني، أو سوء ممارسة المهنة، ، بما أن &quot; &quot; هي وحدها من تمارس دور الطرف الوسيط بين مقدم الخدمة المستخدم . .17القوة القاهرة 1.17ال تعتبر &quot; &quot; مسؤولة عن عدم الوفاء بالتزاماتها المنصوص عليها في هذه الشروط في حالة وقوع أي حدث خارج عن سيطرتها المعقولة، بما في ذلك على سبيل المثال ال الحصر الحرائق، أو األعمال اإلرهابية، أو الكوارث الطبيعية، أو الحروب، أو المقاطعات، أو اضطرابات العمال، أو انقطاع اإلنترنت أو االتصاالت، أو انقطاع الخدمة، أو عدم وفاء أحد مقدمي الخدمات التابعين في الوفاء بالتزاماته. .18اإلنهاء والفسخ ، وفقً 1.18يحق ل ا لتقديرها المطلق وألي سبب، إنهاء حسابك أو وصولك للتطبيق أو الخدمات، بدون أي مسؤولية تجاهك أو الغير. وقد تشمل هذه األسباب، على سبيل المثال ال الحصر) )1 )انتهاكك ألي جزء من هذه الشروط؛ )2 )انتهاكك لحقوق الغير؛ )3 )عدم سريان بطاقتك االئتمانية، أو تجاوز الحد االئتماني للبطاقة، أو &quot;تح ّمل&quot; أي رسوم أو مدفوعات أخرى؛ )4 )عدم نشاط حساب مقدم الخدمة الخاص بك لفترة زمنية طويلة. وفقً 2.18أثر إنهاء الحساب) إذا تم إنهاء حسابك، يجوز ل ا لتقديرها المطلق حذف أي مواقع أو ملفات أو رسوم بيانية أو أي محتوى آخر أو مواد تتعلق باستخدامك للموقع اإللكتروني أو الخدمات والمتاحة على الخوادم التي تملكها أو تديرها &quot; &quot; أو التي تعتبر بحوزتها بأي طريقة أخرى، وال تتحمل &quot; &quot; أي مسؤولية عن القيام بذلك تجاهك أو تجاه الغير. ولن يُسمح لك بعد إنهاء الحساب باستخدام الموقع اإللكتروني أو الخدمات. وفي حال تم إنهاء حسابك أو وصولك إلى الموقع اإللكتروني أو الخدمات، تحتفظ &quot; بالحق في اللجوء إلى أي وسيلة تراها ضرورية لمنع الوصول غير المصرح به إلى الموقع اإللكتروني أو الخدمات، بما في ذلك على سبيل المثال ال الحصر الحواجز التقنية وإعادة توجيه عنوان بروتوكول اإلنترنت والتواصل المباشر مع مزود خدمة اإلنترنت الخاص بك. وفي حال تم إنهاء حسابك، يتعين عليك دفع أية رسوم تدين بها ل فو ًرا، بصرف النظر عما إذا كنت تملك الحق في الوصول إلى الموقع اإللكتروني أو الخدمات أو استخدامهما. .19أحكام متنوعة 1.19تشكل هذه الشروط ُمجمل االتفاقية والتفاهم بينك وبين &quot; &quot; بخصوص وحالية ُم ن &quot; استخدام التطبيق، وتُلغي أي اتفاقيات وتفاهمات سابقة برمة بينك وبي &quot; بشأن موضوع االتفاقية. وتعتبر هذه الشروط ُملزمة لكل طرف وخلفائه والمتنازل إليهم المصرح لهم. وال يعتبر إخفاق أحد الطرفين أو تأخره في ممارسة أي حق، أو سلطة، أو امتياز منصوص عليه في هذه الشروط تنازالً عنه، وال تمنع أية ممارسة كلية أو جزئية ألي حق أو سلطة أو امتياز الطرف اآلخر من الممارسة اإلضافية له أو ممارسة أي حق أو سلطة أو امتياز آخر تنص عليه هذه الشروط. 2.19تعتبر أنت و&quot; &quot; متعاقدون مستقلون. وال تشكل عالقتك ب بأي حال من األحوال وكالة أو شراكة أو مشروع مشترك أو عالقة بين موظف وصاحب العمل. 3.19ال يؤثر عدم صحة أي من األحكام الواردة في هذه الشروط أو عدم قابلتها للنفاذ على صحة أو قابلية إنفاذ أية أحكام أخرى واردة في هذه الشروط، وتعتبر كافة األحكام نافذة وسارية المفعول. 4.19تم االتفاق على هذه الشروط و ُحرر العقد باللغة العربية، و ُحرر العقد والشروط من نسخ متطابقة؛ ُسلمت نسخة أصلية لكل طرف للعمل بموجبها. 5.19تحتفظ &quot; &quot; بالحق في تحديث أو تغيير أو تعديل هذه الشروط في أي وقت وألي سبب من األسباب، وذلك عن طريق نشر النسخة المعدلة على التطبيق لكي تسري الشروط المعدلة على جميع خدمات &quot; &quot;، وتصبح سارية المفعول مباشرة بعد نشرها على التطبيق. وبعبارة أخرى، تخضع الخدمة التي تُقدم لك للشروط القائمة في تاريخ تقديم الخدمة. ويعتبر قبولك للشروط بنسختها المعدلة استمرار لوصولك واستخدامك للتطبيق والخدمات الواردة فيها اعتبا ًرا من تاريخ سريان هذا التعديل. .20القانون المنظم ومناط االختصاص القضائي تخضع هذه الشروط وتُفسر وفقً 1.20 ا للقوانين المصرية. وأي نزاع ينشأ عن أو يتصل بتفسير هذه االتفاقية و/أو تنفيذها يُسوى نهائيًا عن طريق التحكيم أمام مركز لمركز&quot;( طبقً ي القاهرة اإلقليمي للتحكيم التجاري الدولي )&quot;ا ا لقوانين المركز السارية ف وقت النزاع. وتتكون هيئة التحكيم من ُمح ّكم واحد. وتُستخدم اللغة العربية في اإلجراءات. وباعتباره استثناء مما سبق، تحتفظ &quot; &quot; بالحق في ممارسة سلطتها التقديرية لمباشرة إجراءات رفع الدعوى أمام إحدى المحاكم التي تمتد صالحيتها القضائية لتشمل مقدم الخدمة</p>');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `url`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com/%D8%A7%D9%86%D8%AA%D8%B1%D9%86%D8%A7%D8%B4%D9%8A%D9%88%D9%86%D8%A7%D9%84-%D9%84%D9%84%D9%85%D9%82%D8%A7%D9%88%D9%84%D8%A7%D8%AA-%D9%88%D8%A7%D9%84%D8%A5%D9%86%D8%B4%D8%A7%D8%A1%D8%A7%D8%AA-508079179262920/about/?ref=page_internal', 'facebook.png', '2022-05-21 11:03:53', NULL),
(2, 'https://www.facebook.com/%D8%A7%D9%86%D8%AA%D8%B1%D9%86%D8%A7%D8%B4%D9%8A%D9%88%D9%86%D8%A7%D9%84-%D9%84%D9%84%D9%85%D9%82%D8%A7%D9%88%D9%84%D8%A7%D8%AA-%D9%88%D8%A7%D9%84%D8%A5%D9%86%D8%B4%D8%A7%D8%A1%D8%A7%D8%AA-508079179262920/about/?ref=page_internal', 'instagram.png', '2022-05-21 11:03:53', NULL),
(3, 'https://www.facebook.com/%D8%A7%D9%86%D8%AA%D8%B1%D9%86%D8%A7%D8%B4%D9%8A%D9%88%D9%86%D8%A7%D9%84-%D9%84%D9%84%D9%85%D9%82%D8%A7%D9%88%D9%84%D8%A7%D8%AA-%D9%88%D8%A7%D9%84%D8%A5%D9%86%D8%B4%D8%A7%D8%A1%D8%A7%D8%AA-508079179262920/about/?ref=page_internal', 'twitter.png', '2022-05-21 11:03:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`id`, `created_at`, `updated_at`) VALUES
(1, '2022-09-14 08:25:06', NULL),
(2, '2022-09-14 08:25:10', NULL),
(3, '2022-09-14 08:25:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `title_translations`
--

CREATE TABLE `title_translations` (
  `titles_trans_id` int(10) UNSIGNED NOT NULL,
  `title_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `title_translations`
--

INSERT INTO `title_translations` (`titles_trans_id`, `title_id`, `locale`, `title`) VALUES
(1, 1, 'en', 'withdraw done'),
(2, 1, 'ar', 'تم السحب\r\n'),
(3, 2, 'en', 'charging done\r\n'),
(4, 2, 'ar', 'تم الشحن'),
(5, 3, 'en', 'Added to wallet'),
(6, 3, 'ar', 'تم اضافة الي المحفظة');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => inactive, 1 => active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-05-22 12:33:30', NULL),
(2, 1, '2022-05-22 12:33:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_translations`
--

CREATE TABLE `type_translations` (
  `types_trans_id` int(10) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_translations`
--

INSERT INTO `type_translations` (`types_trans_id`, `type_id`, `locale`, `name`) VALUES
(1, 1, 'en', 'technician'),
(2, 1, 'ar', 'فني'),
(3, 2, 'en', 'company'),
(4, 2, 'ar', 'شركة');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => not verified, 1 => verified',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => not active, 1 => active',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `available` tinyint(4) DEFAULT NULL COMMENT '0 => not available, 1 => available',
  `firebase_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '0 =>male, 1 => female',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `rate`, `email_verified_at`, `service_id`, `type_id`, `country_id`, `city`, `remember_token`, `lat`, `lng`, `address`, `verified_status`, `status`, `image`, `available`, `firebase_token`, `bio`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'amr tarek', 'engamrtarek1992@gmail.com', '02001097253062', NULL, NULL, NULL, NULL, 1, 'cairo', NULL, '31.9876', '29.5432', 'test', 1, 1, 'user.png', NULL, 'test123456789', NULL, NULL, '2022-09-11 08:41:09', '2022-09-11 08:41:21'),
(3, 'amr tarek', 'engamrtarek1992@gmail.com', '02001097253062', NULL, NULL, 1, 1, 1, 'cairo', NULL, '31.9876', '29.5432', 'test', 1, 1, 'user.png', 1, 'test123456789', 'test1', NULL, '2022-09-11 08:46:35', '2022-09-11 08:46:44'),
(4, 'يسري السيد', 'int412@yahoo.com', '02001023444476', 0, NULL, 1, 1, 1, 'Cairo', NULL, '30.05974275', '31.334881433333333', '385M+VR6، المنطقة الأولى، مدينة نصر، محافظة القاهرة‬ 4450151، مصر', 1, 1, 'user.png', 0, 'f9GxypuRTWayk5R3VKmOo9:APA91bFlkw-ide1EkKLWptoka-2xoNDODoftBqRp_l0iHp90dQf5wcO0_UmLTChDY_Y9z2HX16VhtflCZuzMBvuKeLuIJzprwG4utOPKvYrpYrRZHLAXPz4nuBddxEenUDB9766eE2IS', 'مقاول فني كهرباء', NULL, '2022-08-03 17:22:56', '2022-08-07 11:19:05'),
(5, 'Ahmed Hegazy Hegazy Hegazy', 'enga7074@gmail.com', '02001023701839', NULL, NULL, NULL, NULL, 1, 'Cairo', NULL, '30.033333', '31.233334', '1 الصناعة، المنطقة الأولى، مدينة نصر، محافظة القاهرة‬ 4450151، مصر', 1, 1, '1661551715.jpeg', 1, 'fjRPx8DhRlWSoG6HrMLgUU:APA91bEA-sh-EpGgb0K2eaf5uYgKz0VqtCdYWOUvwH-mCjg82_nClMS5P2t9DzDePIduI8JtBs4K3kup5ARJc7ZzALz5cY8EPJ1QoBBCdsitlFsY2bg49ko82u3qn1I3YIxl5aN9w3a2', NULL, NULL, '2022-08-03 17:23:45', '2022-08-28 08:10:48'),
(6, 'rana salah', 'enga70745@gmail.com', '02001092438140', 5, NULL, 1, 1, 1, 'Cairo', NULL, '30.0616965', '31.3346478', '386M+MRR، البطراوي، المنطقة الأولى، مدينة نصر، محافظة القاهرة‬ 4450153، مصر', 1, 1, 'user.png', 0, 'fEZ078VoTLCeWyNKAZK0GT:APA91bH0qI38Y6gRGmzLOPEyPpPp7LtPpmb0o3_jxM62ghENfu4OgL7Pv4W732NMIXxE3IVEshQlhDm1YQDkXUwJcAYMa0h58EAWpXHF3eOw0yhTCJJbEE8sRGxYOSxXu352qB8rVO6U', 'hhhhh', NULL, '2022-08-04 21:29:25', '2022-08-30 13:10:46'),
(7, 'ayyy', 's@gmail.com', '020258258258258', NULL, NULL, NULL, NULL, 1, '', NULL, '29.84262', '31.33736', 'عزبة جبريل, شارع مبروك احمد, القاهرة, مصر', 1, 1, 'user.png', NULL, '123456789test', NULL, NULL, '2022-08-06 04:47:16', '2022-09-06 13:00:44'),
(9, 'gggggg', 'z@z.com', '02001023701818', NULL, NULL, NULL, 2, 1, 'Cairo', NULL, '30.069657444377665', '31.34482763707638', 'طريق النصر، مساكن المهندسين، مدينة نصر، محافظة القاهرة‬،، 389V+VXJ، مساكن المهندسين، مدينة نصر، محافظة القاهرة‬ 4451610، مصر', 1, 1, 'user.png', 0, 'cNpe-DXxT1-Oj8eF3JsDQI:APA91bFkvInUP32uVxEZON_9IIIVTxkbgeHYJfevBTCI4WV6VbQmSuH6ovQI2HkyU5F29F12BP1llfF2MbiOlUiPMRj7bK_5n2r2zzeSBtpktFZ63b_ecfVnj-bBFXPlvBMV7CwkPmer', 'iiii', NULL, '2022-08-08 06:16:20', '2022-08-21 09:21:58'),
(10, 'shush', 'd@gmail.com', '02001096013034', NULL, NULL, NULL, NULL, 1, 'Cairo', NULL, '30.062008927334', '31.334653837103', 'المنطقة الاولى, شارع نصر احمد ذكى, القاهرة, مصر', 1, 1, 'user.png', NULL, '123456789test', NULL, NULL, '2022-08-13 09:17:13', '2022-08-27 12:25:48'),
(12, 'رانا صلاح الغالي', 'ranaelhendy55@gmail.com', '02001033009930', 0, NULL, 1, 1, 1, 'Cairo', NULL, '30.0617026', '31.3346434', '3 أبراج عثمان، معادي الخبيري الغربية، حي المعادي، محافظة القاهرة‬،، معادي الخبيري الغربية، حي المعادي، محافظة القاهرة‬،، معادي الخبيري الغربية، قسم المعادي، محافظة القاهرة‬ 4211211، مصر', 1, 1, '1661164992.png', 1, 'bjhjhjj', 'فني تكييفات', NULL, '2022-08-22 08:12:52', '2022-08-25 09:07:46'),
(13, 'رانا صلاح', 'ranaelhendy55@gmail.com', '02001033009930', NULL, NULL, NULL, NULL, 1, 'Cairo', NULL, '29.965198699999995', '31.247555966666663', '3 أبراج عثمان، معادي الخبيري الغربية، حي المعادي، محافظة القاهرة‬،، معادي الخبيري الغربية، حي المعادي، محافظة القاهرة‬،، معادي الخبيري الغربية، قسم المعادي، محافظة القاهرة‬ 4211211، مصر', 1, 1, 'user.png', NULL, 'cxsWkq9sTqC9Yh81ZQ_lqY:APA91bG7zPqVy9LXUGItZV0YX7wl9GVDvTga4Zer2g2_9dGFoHqnrSowLDTZGU-qsbV5qO7DGYK1GiG5pL1GZxjiDZoLWaX9aEYfUpLCbijAiqHM2tzEpIMmKUg_vR9LmCqLpW-feTaq', NULL, NULL, '2022-08-22 08:50:25', '2022-08-22 08:50:40'),
(15, 'mohamed sharaqi', 'mohamed.sharaqi@gmail.com', '02001030692427', NULL, NULL, NULL, NULL, 1, 'Cairo', NULL, '31.9876', '29.5432', 'test', 0, 1, 'user.png', NULL, 'test123456789', NULL, NULL, '2022-08-25 08:18:19', '2022-08-25 08:18:19'),
(16, 'تست', 'enga707f4@gmail.com', '02001023701899', NULL, NULL, 3, 2, 1, 'Cairo', NULL, '30.0616947', '31.3346397', '17 د/ البطراوي، المنطقة الأولى، مدينة نصر، محافظة القاهرة‬ 4450153، مصر', 0, 1, 'user.png', 1, 'fEZ078VoTLCeWyNKAZK0GT:APA91bH0qI38Y6gRGmzLOPEyPpPp7LtPpmb0o3_jxM62ghENfu4OgL7Pv4W732NMIXxE3IVEshQlhDm1YQDkXUwJcAYMa0h58EAWpXHF3eOw0yhTCJJbEE8sRGxYOSxXu352qB8rVO6U', 'uuu', NULL, '2022-08-25 11:05:27', '2022-08-25 11:05:27'),
(18, 'Ahmed', 'enga@gmail.com', 'nulll01023701839', NULL, NULL, NULL, NULL, 1, 'Cairo', NULL, '0', '0', '386M+MRH، المنطقة الأولى، مدينة نصر، محافظة القاهرة‬ 4450153، مصرمحافظة القاهرة‬مدينة نصر', 1, 1, 'user.png', NULL, 'eCn1Fqa1SdWO_SHsThivOd:APA91bF_k11-2_SU4XV4aoHJ6WIb7lOIW6yGnzViWtz9GIbQ14PBwj-srnNaigeW5A7DioqWto_IBvzqs7t7Rz8y4JFDp1MxyLFfrbi_VOD6Zt-flyh0FagjAJLxKG16a53fkHuNCe8K', NULL, NULL, '2022-08-27 08:15:03', '2022-08-30 12:06:52'),
(20, 'aya nabil provider', 'ayanabil194314@gmail.com', '02001201304319', NULL, NULL, 1, 1, 1, 'Cairo', NULL, '30.06173073', '31.33462041', '386M+MRH، المنطقة الأولى، مدينة نصر، محافظة القاهرة‬ 4450153، مصر', 1, 1, 'user.png', 0, '123456789test', 'ayanabil194314@gmail.comcmxkzkzixixcixixixixjxxkcickcicckckcic', NULL, '2022-08-27 10:59:01', '2022-08-27 12:23:12'),
(21, 'toady', 'int412@yahoo.com', '01023444476', NULL, NULL, NULL, NULL, 1, 'Cairo', NULL, '30.0617554', '31.3309046', 'المنطقة الاولى, شارع البطراوي, القاهرة, مصر', 1, 1, '1661605900.jpeg', NULL, '123456789test', NULL, NULL, '2022-08-27 11:09:25', '2022-08-27 11:11:40'),
(24, 'amr', 'engamrtarek1992@gmail.com', '02001097253062', NULL, NULL, 1, 1, 1, 'Helwan', NULL, '31.9876', '29.5432', 'test', 1, 1, 'user.png', 1, 'cp2W9UUDQrOzYtou7GqsiV:APA91bHBChexMFBk1JRqzEaeWCICV7Lso4fr57_EcilkeqW9s9IuOgJz5XkmA1Z4_FY7CQwlXf_TD1th9pd4D6IoJFHwlvlaYXkxVCuj4_MizI-2GH1NUlzQh8LJ8MfNd4lGqqSbWbMu', 'test1', NULL, '2022-08-27 13:31:03', '2022-08-27 13:32:08'),
(27, 'احمد تيست', 'salhaliwshووatbli@gmail.com', '02001023701866', NULL, NULL, NULL, 2, 1, 'Giza', NULL, '30.0617003', '31.3346463', '386M+MRH، المنطقة الأولى، مدينة نصر، محافظة القاهرة‬ 4450153، مصرمحافظة القاهرة‬مدينة نصر', 0, 1, 'user.png', 1, 'cBbrKsKIR2CSrQeOFFRvub:APA91bHNi8AuXk7NxWWmdFhyvsGM-WuQdQFJRwX_iaZmNsw8OpSQjmENhJJj98L85PTj1IsEkiQcYwgMLLLKf3T5GBLpbdpJiOzGkQo7iC4nWO5_lc1b9RO7v_0ciGylkRARLZADAnVC', 'زظظظ', NULL, '2022-08-28 07:35:00', '2022-08-28 07:35:00'),
(28, 'تيست', 'salhaliwshatةوbli@gmail.com', '02001023701888', NULL, NULL, 3, 1, 1, 'Giza', NULL, '30.0617033', '31.3346403', '386M+MRH، المنطقة الأولى، مدينة نصر، محافظة القاهرة‬ 4450153، مصرمحافظة القاهرة‬مدينة نصر', 1, 1, 'user.png', 1, 'cBbrKsKIR2CSrQeOFFRvub:APA91bHNi8AuXk7NxWWmdFhyvsGM-WuQdQFJRwX_iaZmNsw8OpSQjmENhJJj98L85PTj1IsEkiQcYwgMLLLKf3T5GBLpbdpJiOzGkQo7iC4nWO5_lc1b9RO7v_0ciGylkRARLZADAnVC', 'ززز', NULL, '2022-08-28 07:43:28', '2022-08-28 07:43:36'),
(29, 'ujjuj', 'salhaliwshatblighh@gmail.com', '02008552384565', NULL, NULL, NULL, 2, 1, 'Cairo', NULL, '30.061651', '31.3346476', '17 د/ البطراوي، المنطقة الأولى، مدينة نصر، محافظة القاهرة‬ 4450153، مصرمحافظة القاهرة‬مدينة نصر', 0, 1, 'user.png', 1, 'cBbrKsKIR2CSrQeOFFRvub:APA91bHNi8AuXk7NxWWmdFhyvsGM-WuQdQFJRwX_iaZmNsw8OpSQjmENhJJj98L85PTj1IsEkiQcYwgMLLLKf3T5GBLpbdpJiOzGkQo7iC4nWO5_lc1b9RO7v_0ciGylkRARLZADAnVC', 'nnn', NULL, '2022-08-28 08:25:26', '2022-08-28 08:25:26'),
(30, 'jj', 'salhaliwshatblvbbi@gmail.com', '02001023701666', NULL, NULL, NULL, 2, 1, 'Cairo', NULL, '30.0616617', '31.3346094', '386M+MRH، المنطقة الأولى، مدينة نصر، محافظة القاهرة‬ 4450153، مصرمحافظة القاهرة‬مدينة نصر', 0, 1, 'user.png', 1, 'cBbrKsKIR2CSrQeOFFRvub:APA91bHNi8AuXk7NxWWmdFhyvsGM-WuQdQFJRwX_iaZmNsw8OpSQjmENhJJj98L85PTj1IsEkiQcYwgMLLLKf3T5GBLpbdpJiOzGkQo7iC4nWO5_lc1b9RO7v_0ciGylkRARLZADAnVC', 'nn', NULL, '2022-08-28 08:44:30', '2022-08-28 08:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE `verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 =>pending, 1 => accepted, 2 => rejected',
  `type` tinyint(4) NOT NULL COMMENT 'withdraw, 1 => charging, 2=> added to wallet',
  `price` double NOT NULL,
  `op_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `worker_prices`
--

CREATE TABLE `worker_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ads_offer_id_foreign` (`offer_id`),
  ADD KEY `ads_package_id_foreign` (`package_id`);

--
-- Indexes for table `cancellation_reasons`
--
ALTER TABLE `cancellation_reasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cancellation_reasons_user_id_foreign` (`user_id`),
  ADD KEY `cancellation_reasons_provider_id_foreign` (`provider_id`),
  ADD KEY `cancellation_reasons_order_id_foreign` (`order_id`),
  ADD KEY `cancellation_reasons_reason_id_foreign` (`reason_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_translations`
--
ALTER TABLE `client_translations`
  ADD PRIMARY KEY (`clients_trans_id`),
  ADD UNIQUE KEY `client_translations_client_id_locale_unique` (`client_id`,`locale`),
  ADD KEY `client_translations_locale_index` (`locale`);

--
-- Indexes for table `company_services`
--
ALTER TABLE `company_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_services_company_id_foreign` (`company_id`),
  ADD KEY `company_services_service_id_foreign` (`service_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_us_user_id_foreign` (`user_id`),
  ADD KEY `contact_us_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_translations`
--
ALTER TABLE `country_translations`
  ADD PRIMARY KEY (`countries_trans_id`),
  ADD UNIQUE KEY `country_translations_country_id_locale_unique` (`country_id`,`locale`),
  ADD KEY `country_translations_locale_index` (`locale`);

--
-- Indexes for table `descriptions`
--
ALTER TABLE `descriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descriptions_package_id_foreign` (`package_id`),
  ADD KEY `descriptions_service_id_foreign` (`service_id`);

--
-- Indexes for table `description_translations`
--
ALTER TABLE `description_translations`
  ADD PRIMARY KEY (`descriptions_trans_id`),
  ADD UNIQUE KEY `description_translations_description_id_locale_unique` (`description_id`,`locale`),
  ADD KEY `description_translations_locale_index` (`locale`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluations_user_id_foreign` (`user_id`),
  ADD KEY `evaluations_provider_id_foreign` (`provider_id`),
  ADD KEY `evaluations_order_id_foreign` (`order_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_user_id_foreign` (`user_id`),
  ADD KEY `favorites_worker_id_foreign` (`worker_id`),
  ADD KEY `favorites_company_id_foreign` (`company_id`);

--
-- Indexes for table `instructions`
--
ALTER TABLE `instructions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instruction_translations`
--
ALTER TABLE `instruction_translations`
  ADD PRIMARY KEY (`instructions_trans_id`),
  ADD UNIQUE KEY `instruction_translations_instruction_id_locale_unique` (`instruction_id`,`locale`),
  ADD KEY `instruction_translations_locale_index` (`locale`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_contents`
--
ALTER TABLE `notification_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_contents_notification_id_foreign` (`notification_id`),
  ADD KEY `notification_contents_order_id_foreign` (`order_id`),
  ADD KEY `notification_contents_user_id_foreign` (`user_id`),
  ADD KEY `notification_contents_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `notification_translations`
--
ALTER TABLE `notification_translations`
  ADD PRIMARY KEY (`notifications_trans_id`),
  ADD UNIQUE KEY `notification_translations_notification_id_locale_unique` (`notification_id`,`locale`),
  ADD KEY `notification_translations_locale_index` (`locale`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_service_id_foreign` (`service_id`),
  ADD KEY `offers_package_id_foreign` (`package_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_provider_id_foreign` (`provider_id`),
  ADD KEY `orders_service_id_foreign` (`service_id`),
  ADD KEY `orders_offer_id_foreign` (`offer_id`),
  ADD KEY `orders_package_id_foreign` (`package_id`);

--
-- Indexes for table `order_package_services`
--
ALTER TABLE `order_package_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_package_services_package_id_foreign` (`package_id`),
  ADD KEY `order_package_services_order_id_foreign` (`order_id`),
  ADD KEY `order_package_services_service_id_foreign` (`service_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_companies`
--
ALTER TABLE `package_companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_companies_package_id_foreign` (`package_id`),
  ADD KEY `package_companies_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `package_translations`
--
ALTER TABLE `package_translations`
  ADD PRIMARY KEY (`packages_trans_id`),
  ADD UNIQUE KEY `package_translations_package_id_locale_unique` (`package_id`,`locale`),
  ADD KEY `package_translations_locale_index` (`locale`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `provider_offers`
--
ALTER TABLE `provider_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_offers_offer_id_foreign` (`offer_id`),
  ADD KEY `provider_offers_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qr_codes_worker_id_foreign` (`worker_id`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reason_translations`
--
ALTER TABLE `reason_translations`
  ADD PRIMARY KEY (`reasons_trans_id`),
  ADD UNIQUE KEY `reason_translations_reason_id_locale_unique` (`reason_id`,`locale`),
  ADD KEY `reason_translations_locale_index` (`locale`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD PRIMARY KEY (`services_trans_id`),
  ADD UNIQUE KEY `service_translations_service_id_locale_unique` (`service_id`,`locale`),
  ADD KEY `service_translations_locale_index` (`locale`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_translations`
--
ALTER TABLE `setting_translations`
  ADD PRIMARY KEY (`settings_trans_id`),
  ADD UNIQUE KEY `setting_translations_setting_id_locale_unique` (`setting_id`,`locale`),
  ADD KEY `setting_translations_locale_index` (`locale`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscribes_user_id_foreign` (`user_id`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `title_translations`
--
ALTER TABLE `title_translations`
  ADD PRIMARY KEY (`titles_trans_id`),
  ADD UNIQUE KEY `title_translations_title_id_locale_unique` (`title_id`,`locale`),
  ADD KEY `title_translations_locale_index` (`locale`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_translations`
--
ALTER TABLE `type_translations`
  ADD PRIMARY KEY (`types_trans_id`),
  ADD UNIQUE KEY `type_translations_type_id_locale_unique` (`type_id`,`locale`),
  ADD KEY `type_translations_locale_index` (`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_service_id_foreign` (`service_id`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_type_id_foreign` (`type_id`);

--
-- Indexes for table `verifications`
--
ALTER TABLE `verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_worker_id_foreign` (`worker_id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`),
  ADD KEY `wallets_title_id_foreign` (`title_id`);

--
-- Indexes for table `worker_prices`
--
ALTER TABLE `worker_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_prices_worker_id_foreign` (`worker_id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `works_worker_id_foreign` (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cancellation_reasons`
--
ALTER TABLE `cancellation_reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_translations`
--
ALTER TABLE `client_translations`
  MODIFY `clients_trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_services`
--
ALTER TABLE `company_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `country_translations`
--
ALTER TABLE `country_translations`
  MODIFY `countries_trans_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `descriptions`
--
ALTER TABLE `descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `description_translations`
--
ALTER TABLE `description_translations`
  MODIFY `descriptions_trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instruction_translations`
--
ALTER TABLE `instruction_translations`
  MODIFY `instructions_trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notification_contents`
--
ALTER TABLE `notification_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notification_translations`
--
ALTER TABLE `notification_translations`
  MODIFY `notifications_trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_package_services`
--
ALTER TABLE `order_package_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `package_companies`
--
ALTER TABLE `package_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `package_translations`
--
ALTER TABLE `package_translations`
  MODIFY `packages_trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `provider_offers`
--
ALTER TABLE `provider_offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `qr_codes`
--
ALTER TABLE `qr_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reason_translations`
--
ALTER TABLE `reason_translations`
  MODIFY `reasons_trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_translations`
--
ALTER TABLE `service_translations`
  MODIFY `services_trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_translations`
--
ALTER TABLE `setting_translations`
  MODIFY `settings_trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `title_translations`
--
ALTER TABLE `title_translations`
  MODIFY `titles_trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_translations`
--
ALTER TABLE `type_translations`
  MODIFY `types_trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `worker_prices`
--
ALTER TABLE `worker_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ads_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cancellation_reasons`
--
ALTER TABLE `cancellation_reasons`
  ADD CONSTRAINT `cancellation_reasons_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cancellation_reasons_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cancellation_reasons_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `reasons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cancellation_reasons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_translations`
--
ALTER TABLE `client_translations`
  ADD CONSTRAINT `client_translations_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_services`
--
ALTER TABLE `company_services`
  ADD CONSTRAINT `company_services_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD CONSTRAINT `contact_us_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_us_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `country_translations`
--
ALTER TABLE `country_translations`
  ADD CONSTRAINT `country_translations_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `descriptions`
--
ALTER TABLE `descriptions`
  ADD CONSTRAINT `descriptions_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `descriptions_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluations_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `instruction_translations`
--
ALTER TABLE `instruction_translations`
  ADD CONSTRAINT `instruction_translations_instruction_id_foreign` FOREIGN KEY (`instruction_id`) REFERENCES `instructions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_contents`
--
ALTER TABLE `notification_contents`
  ADD CONSTRAINT `notification_contents_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_contents_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_contents_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_contents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_translations`
--
ALTER TABLE `notification_translations`
  ADD CONSTRAINT `notification_translations_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `offers_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_package_services`
--
ALTER TABLE `order_package_services`
  ADD CONSTRAINT `order_package_services_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_package_services_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_package_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_companies`
--
ALTER TABLE `package_companies`
  ADD CONSTRAINT `package_companies_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `package_companies_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_translations`
--
ALTER TABLE `package_translations`
  ADD CONSTRAINT `package_translations_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `provider_offers`
--
ALTER TABLE `provider_offers`
  ADD CONSTRAINT `provider_offers_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `provider_offers_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD CONSTRAINT `qr_codes_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reason_translations`
--
ALTER TABLE `reason_translations`
  ADD CONSTRAINT `reason_translations_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `reasons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD CONSTRAINT `service_translations_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `setting_translations`
--
ALTER TABLE `setting_translations`
  ADD CONSTRAINT `setting_translations_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD CONSTRAINT `subscribes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `title_translations`
--
ALTER TABLE `title_translations`
  ADD CONSTRAINT `title_translations_title_id_foreign` FOREIGN KEY (`title_id`) REFERENCES `titles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `type_translations`
--
ALTER TABLE `type_translations`
  ADD CONSTRAINT `type_translations_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `verifications`
--
ALTER TABLE `verifications`
  ADD CONSTRAINT `verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_title_id_foreign` FOREIGN KEY (`title_id`) REFERENCES `titles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wallets_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `worker_prices`
--
ALTER TABLE `worker_prices`
  ADD CONSTRAINT `worker_prices_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `works_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
