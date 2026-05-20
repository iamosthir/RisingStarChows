-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2026 at 06:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `risingchows`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `content`, `image`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'Hello', 'uploads/about-us/1770461276_about_us.png', '2026-02-07 04:47:56', '2026-02-07 05:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `competition_wins` int(11) NOT NULL DEFAULT 0,
  `best_in_shows` int(11) NOT NULL DEFAULT 0,
  `champions` int(11) NOT NULL DEFAULT 0,
  `international_shows` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(191) NOT NULL,
  `call_name` varchar(191) DEFAULT NULL,
  `sire_name` varchar(191) DEFAULT NULL,
  `dam_name` varchar(191) DEFAULT NULL,
  `owner_name` varchar(191) DEFAULT NULL,
  `breeder_name` varchar(191) DEFAULT NULL,
  `reg_no` varchar(191) DEFAULT NULL,
  `sex` varchar(191) NOT NULL,
  `birthdate` varchar(191) NOT NULL,
  `color` int(11) DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `OFA` varchar(191) DEFAULT NULL,
  `ref_link` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `primaryImg` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_messages`
--

CREATE TABLE `application_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_application_id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` enum('admin','user') NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message_text` longtext NOT NULL,
  `message_html` longtext NOT NULL,
  `email_message_id` varchar(255) DEFAULT NULL,
  `email_in_reply_to` varchar(255) DEFAULT NULL,
  `email_references` text DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_messages`
--

INSERT INTO `application_messages` (`id`, `reservation_application_id`, `sender_type`, `sender_id`, `message_text`, `message_html`, `email_message_id`, `email_in_reply_to`, `email_references`, `is_read`, `sent_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'user', NULL, 'Quod eius est in qui', 'Quod eius est in qui', NULL, NULL, NULL, 1, '2026-02-14 12:29:24', '2026-02-14 13:30:32', '2026-02-14 13:30:32'),
(9, 1, 'admin', 1, 'Hello sir,Thanks for contacting with us.&nbsp;I need to fuck your mom', '<p>Hello sir,<br>Thanks for contacting with us.&nbsp;<br>I need to fuck your mom</p>', '6990d2ba8eda7.1771098810@thebengal.club', NULL, '', 1, '2026-02-14 19:53:31', '2026-02-14 13:53:30', '2026-02-14 13:53:31'),
(10, 1, 'user', NULL, 'Fuck my life idiot\r\n\r\nরবি, ১৫ ফেব, ২০২৬ তারিখে ১:৫৩ AM টায় তারিখে Laravel <info@thebengal.club>\r\nলিখেছেন:\r\n\r\n> RisingStarChows\r\n> Premium Chow Chow Breeders\r\n> Hello lagututo! 👋\r\n>\r\n> We have a new message for you regarding your reservation application.\r\n> *Application Reference:* #1\r\n> Message from Our Team\r\n>\r\n> Hello sir,\r\n> Thanks for contacting with us.\r\n> I need to fuck your mom\r\n>\r\n> *Sent:* Feb 14, 2026 7:53 PM\r\n>\r\n> *💬 Have more questions?*\r\n> Simply reply to this email and we\'ll get back to you promptly!\r\n> Visit Our Website <http://localhost:8000>\r\n> RisingStarChows\r\n> Where Champions Are Born & Raised\r\n> This is a message regarding your reservation application.\r\n> *Reply to this email to continue the conversation.*\r\n>', 'Fuck my life idiot<br>রবি, ১৫ ফেব, ২০২৬ তারিখে ১:৫৩ AM টায় তারিখে Laravel &lt;info@thebengal.club&gt; লিখেছেন:<br><blockquote class=\"gmail_quote\" style=\"margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex\"><u></u>\r\n\r\n\r\n    \r\n    \r\n    \r\n    \r\n    \r\n\r\n\r\n    \r\n        \r\n        \r\n            RisingStarChows\r\n            Premium Chow Chow Breeders\r\n        \r\n\r\n        \r\n        \r\n            Hello lagututo! 👋\r\n            <p class=\"m_4354633930061476953intro-text\">\r\n                We have a new message for you regarding your reservation application.\r\n            </p>\r\n\r\n            \r\n            \r\n                <strong>Application Reference:</strong> #1<br>\r\n                            \r\n\r\n            \r\n            \r\n                Message from Our Team\r\n                \r\n                    <p>Hello sir,<br>Thanks for contacting with us. <br>I need to fuck your mom</p>\r\n                \r\n                <p style=\"margin-top:16px;font-size:14px;color:rgb(107,114,128)\">\r\n                    <strong>Sent:</strong> Feb 14, 2026 7:53 PM\r\n                </p>\r\n            \r\n\r\n            \r\n\r\n            <p class=\"m_4354633930061476953intro-text\" style=\"margin-bottom:16px;text-align:center\">\r\n                <strong>💬 Have more questions?</strong><br>\r\n                Simply reply to this email and we&#39;ll get back to you promptly!\r\n            </p>\r\n\r\n            \r\n            \r\n                <a href=\"http://localhost:8000\" class=\"m_4354633930061476953btn-primary\" target=\"_blank\">Visit Our Website</a>\r\n            \r\n        \r\n\r\n        \r\n        \r\n            RisingStarChows\r\n            Where Champions Are Born &amp; Raised\r\n            \r\n                This is a message regarding your reservation application.<br>\r\n                <strong>Reply to this email to continue the conversation.</strong>\r\n            \r\n        \r\n    \r\n\r\n\r\n\r\n</blockquote>', 'CADXojhat0ip7_ug-ef4O_4Czi-q-jvo7NVP1f+g8tN3fu0YPaw@mail.gmail.com', '6990d2ba8eda7.1771098810@thebengal.club', '6990d2ba8eda7.1771098810@thebengal.club', 0, '2026-02-14 19:54:04', '2026-02-14 13:55:21', '2026-02-14 13:55:21'),
(11, 1, 'user', NULL, 'hey\r\n\r\nরবি, ১৫ ফেব, ২০২৬ তারিখে ১:৫৪ AM টায় তারিখে Md Sazzad 0073 <\r\nmdeasinislam6@gmail.com> লিখেছেন:\r\n\r\n> Fuck my life idiot\r\n>\r\n> রবি, ১৫ ফেব, ২০২৬ তারিখে ১:৫৩ AM টায় তারিখে Laravel <info@thebengal.club>\r\n> লিখেছেন:\r\n>\r\n>> RisingStarChows\r\n>> Premium Chow Chow Breeders\r\n>> Hello lagututo! 👋\r\n>>\r\n>> We have a new message for you regarding your reservation application.\r\n>> *Application Reference:* #1\r\n>> Message from Our Team\r\n>>\r\n>> Hello sir,\r\n>> Thanks for contacting with us.\r\n>> I need to fuck your mom\r\n>>\r\n>> *Sent:* Feb 14, 2026 7:53 PM\r\n>>\r\n>> *💬 Have more questions?*\r\n>> Simply reply to this email and we\'ll get back to you promptly!\r\n>> Visit Our Website <http://localhost:8000>\r\n>> RisingStarChows\r\n>> Where Champions Are Born & Raised\r\n>> This is a message regarding your reservation application.\r\n>> *Reply to this email to continue the conversation.*\r\n>>\r\n>\r\n', 'hey<br>রবি, ১৫ ফেব, ২০২৬ তারিখে ১:৫৪ AM টায় তারিখে Md Sazzad 0073 &lt;<a href=\"mailto:mdeasinislam6@gmail.com\">mdeasinislam6@gmail.com</a>&gt; লিখেছেন:<br><blockquote class=\"gmail_quote\" style=\"margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex\">Fuck my life idiot<br>রবি, ১৫ ফেব, ২০২৬ তারিখে ১:৫৩ AM টায় তারিখে Laravel &lt;info@thebengal.club&gt; লিখেছেন:<br><blockquote class=\"gmail_quote\" style=\"margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex\"><u></u>\r\n\r\n\r\n    \r\n    \r\n    \r\n    \r\n    \r\n\r\n\r\n    \r\n        \r\n        \r\n            RisingStarChows\r\n            Premium Chow Chow Breeders\r\n        \r\n\r\n        \r\n        \r\n            Hello lagututo! 👋\r\n            <p>\r\n                We have a new message for you regarding your reservation application.\r\n            </p>\r\n\r\n            \r\n            \r\n                <strong>Application Reference:</strong> #1<br>\r\n                            \r\n\r\n            \r\n            \r\n                Message from Our Team\r\n                \r\n                    <p>Hello sir,<br>Thanks for contacting with us. <br>I need to fuck your mom</p>\r\n                \r\n                <p style=\"margin-top:16px;font-size:14px;color:rgb(107,114,128)\">\r\n                    <strong>Sent:</strong> Feb 14, 2026 7:53 PM\r\n                </p>\r\n            \r\n\r\n            \r\n\r\n            <p style=\"margin-bottom:16px;text-align:center\">\r\n                <strong>💬 Have more questions?</strong><br>\r\n                Simply reply to this email and we&#39;ll get back to you promptly!\r\n            </p>\r\n\r\n            \r\n            \r\n                <a href=\"http://localhost:8000\" target=\"_blank\">Visit Our Website</a>\r\n            \r\n        \r\n\r\n        \r\n        \r\n            RisingStarChows\r\n            Where Champions Are Born &amp; Raised\r\n            \r\n                This is a message regarding your reservation application.<br>\r\n                <strong>Reply to this email to continue the conversation.</strong>\r\n            \r\n        \r\n    \r\n\r\n\r\n\r\n</blockquote>\r\n</blockquote>', 'CADXojha=zviWKW_=XcwJpeCrswv6JsKEfTUQ_kHL28unEZxO3w@mail.gmail.com', 'CADXojhat0ip7_ug-ef4O_4Czi-q-jvo7NVP1f+g8tN3fu0YPaw@mail.gmail.com', '6990d2ba8eda7.1771098810@thebengal.club, CADXojhat0ip7_ug-ef4O_4Czi-q-jvo7NVP1f+g8tN3fu0YPaw@mail.gmail.com', 0, '2026-02-14 19:57:29', '2026-02-14 13:58:29', '2026-02-14 13:58:29'),
(12, 1, 'user', NULL, 'gg', 'gg<br>রবি, ১৫ ফেব, ২০২৬ তারিখে ১:৫৭ AM টায় তারিখে Md Sazzad 0073 &lt;<a href=\"mailto:mdeasinislam6@gmail.com\">mdeasinislam6@gmail.com</a>&gt; লিখেছেন:<br><blockquote class=\"gmail_quote\" style=\"margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex\">hey<br>রবি, ১৫ ফেব, ২০২৬ তারিখে ১:৫৪ AM টায় তারিখে Md Sazzad 0073 &lt;<a href=\"mailto:mdeasinislam6@gmail.com\" target=\"_blank\">mdeasinislam6@gmail.com</a>&gt; লিখেছেন:<br><blockquote class=\"gmail_quote\" style=\"margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex\">Fuck my life idiot<br>রবি, ১৫ ফেব, ২০২৬ তারিখে ১:৫৩ AM টায় তারিখে Laravel &lt;info@thebengal.club&gt; লিখেছেন:<br><blockquote class=\"gmail_quote\" style=\"margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex\"><u></u>\r\n\r\n\r\n    \r\n    \r\n    \r\n    \r\n    \r\n\r\n\r\n    \r\n        \r\n        \r\n            RisingStarChows\r\n            Premium Chow Chow Breeders\r\n        \r\n\r\n        \r\n        \r\n            Hello lagututo! 👋\r\n            <p>\r\n                We have a new message for you regarding your reservation application.\r\n            </p>\r\n\r\n            \r\n            \r\n                <strong>Application Reference:</strong> #1<br>\r\n                            \r\n\r\n            \r\n            \r\n                Message from Our Team\r\n                \r\n                    <p>Hello sir,<br>Thanks for contacting with us. <br>I need to fuck your mom</p>\r\n                \r\n                <p style=\"margin-top:16px;font-size:14px;color:rgb(107,114,128)\">\r\n                    <strong>Sent:</strong> Feb 14, 2026 7:53 PM\r\n                </p>\r\n            \r\n\r\n            \r\n\r\n            <p style=\"margin-bottom:16px;text-align:center\">\r\n                <strong>💬 Have more questions?</strong><br>\r\n                Simply reply to this email and we&#39;ll get back to you promptly!\r\n            </p>\r\n\r\n            \r\n            \r\n                <a href=\"http://localhost:8000\" target=\"_blank\">Visit Our Website</a>\r\n            \r\n        \r\n\r\n        \r\n        \r\n            RisingStarChows\r\n            Where Champions Are Born &amp; Raised\r\n            \r\n                This is a message regarding your reservation application.<br>\r\n                <strong>Reply to this email to continue the conversation.</strong>\r\n            \r\n        \r\n    \r\n\r\n\r\n\r\n</blockquote>\r\n</blockquote>\r\n</blockquote>', 'CADXojhZd2-PMk3K9vbjO+hvO5ehtTULotQRY+Hgw0kNhVzwX9Q@mail.gmail.com', 'CADXojha=zviWKW_=XcwJpeCrswv6JsKEfTUQ_kHL28unEZxO3w@mail.gmail.com', '6990d2ba8eda7.1771098810@thebengal.club, CADXojhat0ip7_ug-ef4O_4Czi-q-jvo7NVP1f+g8tN3fu0YPaw@mail.gmail.com, CADXojha=zviWKW_=XcwJpeCrswv6JsKEfTUQ_kHL28unEZxO3w@mail.gmail.com', 0, '2026-02-14 20:04:06', '2026-02-14 14:27:02', '2026-02-14 14:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-seo_settings', 'O:21:\"App\\Models\\SeoSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"seo_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:12:{s:2:\"id\";i:1;s:10:\"meta_title\";s:79:\"RisingStarChows - Premium Chow Chow Breeders | Champion Dog Training & Breeding\";s:16:\"meta_description\";s:146:\"Professional Chow Chow breeders specializing in champion bloodlines, dog training, and breeding services. Find your perfect Chow Chow puppy today.\";s:13:\"meta_keywords\";s:109:\"chow chow, chow chow breeders, chow chow puppies, dog breeding, dog training, champion dogs, premium breeders\";s:8:\"og_title\";s:44:\"RisingStarChows - Premium Chow Chow Breeders\";s:14:\"og_description\";s:105:\"Professional Chow Chow breeders specializing in champion bloodlines, dog training, and breeding services.\";s:8:\"og_image\";N;s:16:\"google_analytics\";N;s:18:\"google_tag_manager\";N;s:14:\"facebook_pixel\";N;s:10:\"created_at\";s:19:\"2026-02-16 13:59:00\";s:10:\"updated_at\";s:19:\"2026-02-16 13:59:00\";}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:1;s:10:\"meta_title\";s:79:\"RisingStarChows - Premium Chow Chow Breeders | Champion Dog Training & Breeding\";s:16:\"meta_description\";s:146:\"Professional Chow Chow breeders specializing in champion bloodlines, dog training, and breeding services. Find your perfect Chow Chow puppy today.\";s:13:\"meta_keywords\";s:109:\"chow chow, chow chow breeders, chow chow puppies, dog breeding, dog training, champion dogs, premium breeders\";s:8:\"og_title\";s:44:\"RisingStarChows - Premium Chow Chow Breeders\";s:14:\"og_description\";s:105:\"Professional Chow Chow breeders specializing in champion bloodlines, dog training, and breeding services.\";s:8:\"og_image\";N;s:16:\"google_analytics\";N;s:18:\"google_tag_manager\";N;s:14:\"facebook_pixel\";N;s:10:\"created_at\";s:19:\"2026-02-16 13:59:00\";s:10:\"updated_at\";s:19:\"2026-02-16 13:59:00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:10:\"meta_title\";i:1;s:16:\"meta_description\";i:2;s:13:\"meta_keywords\";i:3;s:8:\"og_title\";i:4;s:14:\"og_description\";i:5;s:8:\"og_image\";i:6;s:16:\"google_analytics\";i:7;s:18:\"google_tag_manager\";i:8;s:14:\"facebook_pixel\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1779296880);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '49d0af34-1de5-4402-8b01-040f95eb29a4', 'database', 'default', '{\"uuid\":\"49d0af34-1de5-4402-8b01-040f95eb29a4\",\"displayName\":\"App\\\\Jobs\\\\SendApplicationReply\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":3,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":\"60,180,600\",\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendApplicationReply\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendApplicationReply\\\":2:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\ApplicationMessage\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:22:\\\"reservationApplication\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"application\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:33:\\\"App\\\\Models\\\\ReservationApplication\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"},\"createdAt\":1771097907,\"delay\":null}', 'Symfony\\Component\\Mime\\Exception\\LogicException: The \"Message-ID\" header must be an instance of \"Symfony\\Component\\Mime\\Header\\IdentificationHeader\" (got \"Symfony\\Component\\Mime\\Header\\UnstructuredHeader\"). in H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\mime\\Header\\Headers.php:244\nStack trace:\n#0 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\mime\\Header\\Headers.php(167): Symfony\\Component\\Mime\\Header\\Headers::checkHeaderClass(Object(Symfony\\Component\\Mime\\Header\\UnstructuredHeader))\n#1 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\mime\\Header\\Headers.php(124): Symfony\\Component\\Mime\\Header\\Headers->add(Object(Symfony\\Component\\Mime\\Header\\UnstructuredHeader))\n#2 H:\\Laravel\\RisingStarChowsLatest\\app\\Mail\\ApplicationReply.php(77): Symfony\\Component\\Mime\\Header\\Headers->addTextHeader(\'Message-ID\', \'<6990d16b664c0....\')\n#3 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(565): App\\Mail\\ApplicationReply->App\\Mail\\{closure}(Object(Symfony\\Component\\Mime\\Email))\n#4 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(213): Illuminate\\Mail\\Mailable->runCallbacks(Object(Illuminate\\Mail\\Message))\n#5 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(315): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Object(Illuminate\\Mail\\Message))\n#6 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(\'emails.applicat...\', Array, Object(Closure))\n#7 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#8 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#9 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(353): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#10 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(300): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\ApplicationReply))\n#11 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\PendingMail.php(123): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\ApplicationReply))\n#12 H:\\Laravel\\RisingStarChowsLatest\\app\\Jobs\\SendApplicationReply.php(80): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\ApplicationReply))\n#13 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\SendApplicationReply->handle()\n#14 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#15 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#16 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#17 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#18 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(129): Illuminate\\Container\\Container->call(Array)\n#19 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendApplicationReply))\n#20 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendApplicationReply))\n#21 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(133): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#22 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(135): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendApplicationReply), false)\n#23 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendApplicationReply))\n#24 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendApplicationReply))\n#25 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(128): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#26 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendApplicationReply))\n#27 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#28 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(485): Illuminate\\Queue\\Jobs\\Job->fire()\n#29 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(435): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#30 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(201): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#31 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#33 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#34 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#35 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#36 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#37 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#38 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#39 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Command\\Command.php(341): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#40 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Application.php(1102): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Application.php(356): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Application.php(195): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 H:\\Laravel\\RisingStarChowsLatest\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#47 {main}', '2026-02-14 13:47:55'),
(2, '6d513249-c377-4a9e-a568-afc3d24a1927', 'database', 'default', '{\"uuid\":\"6d513249-c377-4a9e-a568-afc3d24a1927\",\"displayName\":\"App\\\\Jobs\\\\SendApplicationReply\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":3,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":\"60,180,600\",\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendApplicationReply\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendApplicationReply\\\":2:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\ApplicationMessage\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:22:\\\"reservationApplication\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"application\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:33:\\\"App\\\\Models\\\\ReservationApplication\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"},\"createdAt\":1771097964,\"delay\":null}', 'Symfony\\Component\\Mime\\Exception\\LogicException: The \"Message-ID\" header must be an instance of \"Symfony\\Component\\Mime\\Header\\IdentificationHeader\" (got \"Symfony\\Component\\Mime\\Header\\UnstructuredHeader\"). in H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\mime\\Header\\Headers.php:244\nStack trace:\n#0 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\mime\\Header\\Headers.php(167): Symfony\\Component\\Mime\\Header\\Headers::checkHeaderClass(Object(Symfony\\Component\\Mime\\Header\\UnstructuredHeader))\n#1 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\mime\\Header\\Headers.php(124): Symfony\\Component\\Mime\\Header\\Headers->add(Object(Symfony\\Component\\Mime\\Header\\UnstructuredHeader))\n#2 H:\\Laravel\\RisingStarChowsLatest\\app\\Mail\\ApplicationReply.php(77): Symfony\\Component\\Mime\\Header\\Headers->addTextHeader(\'Message-ID\', \'<6990d16b6ae7a....\')\n#3 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(565): App\\Mail\\ApplicationReply->App\\Mail\\{closure}(Object(Symfony\\Component\\Mime\\Email))\n#4 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(213): Illuminate\\Mail\\Mailable->runCallbacks(Object(Illuminate\\Mail\\Message))\n#5 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(315): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Object(Illuminate\\Mail\\Message))\n#6 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(\'emails.applicat...\', Array, Object(Closure))\n#7 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#8 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#9 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(353): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#10 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(300): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\ApplicationReply))\n#11 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\PendingMail.php(123): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\ApplicationReply))\n#12 H:\\Laravel\\RisingStarChowsLatest\\app\\Jobs\\SendApplicationReply.php(80): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\ApplicationReply))\n#13 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\SendApplicationReply->handle()\n#14 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#15 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#16 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#17 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#18 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(129): Illuminate\\Container\\Container->call(Array)\n#19 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendApplicationReply))\n#20 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendApplicationReply))\n#21 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(133): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#22 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(135): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendApplicationReply), false)\n#23 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendApplicationReply))\n#24 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendApplicationReply))\n#25 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(128): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#26 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendApplicationReply))\n#27 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#28 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(485): Illuminate\\Queue\\Jobs\\Job->fire()\n#29 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(435): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#30 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(201): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#31 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#33 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#34 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#35 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#36 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#37 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#38 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#39 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Command\\Command.php(341): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#40 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Application.php(1102): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Application.php(356): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Application.php(195): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 H:\\Laravel\\RisingStarChowsLatest\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#47 {main}', '2026-02-14 13:47:55'),
(3, '0929f1c3-ad8e-43c9-a6a5-89d9408bafdf', 'database', 'default', '{\"uuid\":\"0929f1c3-ad8e-43c9-a6a5-89d9408bafdf\",\"displayName\":\"App\\\\Jobs\\\\SendApplicationReply\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":3,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":\"60,180,600\",\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendApplicationReply\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendApplicationReply\\\":2:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\ApplicationMessage\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:1:{i:0;s:22:\\\"reservationApplication\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"application\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:33:\\\"App\\\\Models\\\\ReservationApplication\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"},\"createdAt\":1771098262,\"delay\":null}', 'Symfony\\Component\\Mime\\Exception\\LogicException: The \"Message-ID\" header must be an instance of \"Symfony\\Component\\Mime\\Header\\IdentificationHeader\" (got \"Symfony\\Component\\Mime\\Header\\UnstructuredHeader\"). in H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\mime\\Header\\Headers.php:244\nStack trace:\n#0 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\mime\\Header\\Headers.php(167): Symfony\\Component\\Mime\\Header\\Headers::checkHeaderClass(Object(Symfony\\Component\\Mime\\Header\\UnstructuredHeader))\n#1 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\mime\\Header\\Headers.php(124): Symfony\\Component\\Mime\\Header\\Headers->add(Object(Symfony\\Component\\Mime\\Header\\UnstructuredHeader))\n#2 H:\\Laravel\\RisingStarChowsLatest\\app\\Mail\\ApplicationReply.php(77): Symfony\\Component\\Mime\\Header\\Headers->addTextHeader(\'Message-ID\', \'<6990d18986df4....\')\n#3 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(565): App\\Mail\\ApplicationReply->App\\Mail\\{closure}(Object(Symfony\\Component\\Mime\\Email))\n#4 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(213): Illuminate\\Mail\\Mailable->runCallbacks(Object(Illuminate\\Mail\\Message))\n#5 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(315): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}(Object(Illuminate\\Mail\\Message))\n#6 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(\'emails.applicat...\', Array, Object(Closure))\n#7 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#8 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#9 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(353): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#10 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(300): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\ApplicationReply))\n#11 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\PendingMail.php(123): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\ApplicationReply))\n#12 H:\\Laravel\\RisingStarChowsLatest\\app\\Jobs\\SendApplicationReply.php(80): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\ApplicationReply))\n#13 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\SendApplicationReply->handle()\n#14 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#15 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#16 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#17 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#18 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(129): Illuminate\\Container\\Container->call(Array)\n#19 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendApplicationReply))\n#20 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendApplicationReply))\n#21 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(133): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#22 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(135): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendApplicationReply), false)\n#23 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendApplicationReply))\n#24 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendApplicationReply))\n#25 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(128): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#26 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendApplicationReply))\n#27 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#28 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(485): Illuminate\\Queue\\Jobs\\Job->fire()\n#29 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(435): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#30 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(201): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#31 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#32 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#33 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#34 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#35 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#36 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#37 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#38 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#39 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Command\\Command.php(341): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#40 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#41 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Application.php(1102): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Application.php(356): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Application.php(195): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 H:\\Laravel\\RisingStarChowsLatest\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#47 {main}', '2026-02-14 13:48:25'),
(4, 'a0ce3501-bc54-41b2-b503-56a62bf76576', 'database', 'default', '{\"uuid\":\"a0ce3501-bc54-41b2-b503-56a62bf76576\",\"displayName\":\"App\\\\Jobs\\\\SendApplicationReply\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":3,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":\"60,180,600\",\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendApplicationReply\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendApplicationReply\\\":2:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:29:\\\"App\\\\Models\\\\ApplicationMessage\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:1:{i:0;s:22:\\\"reservationApplication\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"application\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:33:\\\"App\\\\Models\\\\ReservationApplication\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"},\"createdAt\":1771098572,\"delay\":null}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\ApplicationMessage]. in H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:780\nStack trace:\n#0 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(110): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(63): App\\Jobs\\SendApplicationReply->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(97): App\\Jobs\\SendApplicationReply->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Jobs\\SendApplicationReply->__unserialize(Array)\n#4 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(96): unserialize(\'O:29:\"App\\\\Jobs\\\\...\')\n#5 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(63): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#7 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(485): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(435): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(201): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#12 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#18 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Command\\Command.php(341): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Application.php(1102): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Application.php(356): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 H:\\Laravel\\RisingStarChowsLatest\\vendor\\symfony\\console\\Application.php(195): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 H:\\Laravel\\RisingStarChowsLatest\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 H:\\Laravel\\RisingStarChowsLatest\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#26 {main}', '2026-02-14 13:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `inquiry` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_06_164733_create_website_settings_table', 1),
(5, '2026_02_06_164734_create_seo_settings_table', 1),
(6, '2026_02_06_170309_remove_footer_and_about_from_website_settings_table', 2),
(7, '2026_02_06_172607_create_slide_shows_table', 3),
(8, '2026_02_06_173845_create_pets_table', 4),
(9, '2026_02_06_173928_create_pet_colors_table', 4),
(10, '2026_02_07_103750_add_is_reserved_to_pets_table', 5),
(11, '2026_02_07_104505_create_about_us_table', 6),
(12, '2026_02_07_105412_create_reservation_applications_table', 7),
(13, '2026_02_07_110046_create_inquiries_table', 8),
(14, '2026_02_07_110648_update_reservation_applications_table_add_new_fields', 9),
(16, '2026_02_10_082624_add_is_featured_dog_to_pets_table', 10),
(18, '2026_02_10_134934_create_achievements_table', 11),
(19, '2026_02_14_182740_simplify_reservation_applications_table', 12),
(20, '2026_02_14_190807_create_application_messages_table', 13),
(21, '2026_02_14_190837_add_conversation_fields_to_reservation_applications_table', 13),
(22, '2026_02_15_160810_add_footer_text_and_about_us_to_website_settings_table', 14),
(23, '2026_02_16_150543_create_pet_images_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `call_name` varchar(255) DEFAULT NULL,
  `sire_name` varchar(255) DEFAULT NULL,
  `dam_name` varchar(255) DEFAULT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `breeder_name` varchar(255) DEFAULT NULL,
  `reg_no` varchar(255) DEFAULT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_reserved` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured_dog` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(255) NOT NULL,
  `OFA` varchar(255) DEFAULT NULL,
  `ref_link` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `primaryImg` varchar(255) DEFAULT NULL,
  `image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`image`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `full_name`, `call_name`, `sire_name`, `dam_name`, `owner_name`, `breeder_name`, `reg_no`, `sex`, `birthdate`, `color`, `status`, `is_reserved`, `is_featured_dog`, `slug`, `OFA`, `ref_link`, `description`, `primaryImg`, `image`, `created_at`, `updated_at`) VALUES
(1, 'CH GCH Cross B Calvin', 'Calvin', 'CROSS B\'S IF I\'D LEFT IT UP TO YOU', 'CROSS B\'S IN THE STILL OF THE NIGHT', 'Hugo Tobar', 'Janet Burke', 'NP52031402', 'Male', '0000-00-00', '1', 'Current', 0, 0, 'gch-cross-b-calvin2433', NULL, 'https://pedigree.chowhealth.org/cgi-bin/geneal.pl?op=tree&index=54187&gens=5&db=chow.dbw', NULL, 'uploads/pets/primary_1930411647.png', NULL, '2020-07-09 20:29:06', '2023-02-21 02:51:56'),
(2, 'Freddie De Los Perros De Bigo', 'Armani', 'KING OF EGYPT DE LOS PERROS DE BIGO', 'GALA DE LOS PERROS DE BIGO', 'Hugo Tobar', 'Raquel Vigo Navajon, Nuria Vigo Navajon', 'LOE2433054', 'Male', '0000-00-00', '1', 'Current', 0, 0, 'freddie-de-los-perros-de-bigo6231', NULL, 'https://pedigree.chowhealth.org/cgi-bin/geneal.pl?op=tree&index=54091&gens=5&db=chow.dbw', NULL, 'uploads/pets/primary_147600007.png', NULL, '2020-07-09 20:32:53', '2022-02-22 00:51:45'),
(3, 'Helena Tian\'e Chows', 'Chantilly', 'ORCHARD IN BLOOM', 'JASMINE SHEN TE CHOWS', 'Hugo Tobar', 'Tian\'e Chows Aleksandra Djordjevic', 'JR 73086 Cho', 'Female', '0000-00-00', '1', 'Current', 0, 0, 'helena-tiane-chows7957', NULL, 'http://ingrus.net/chow-chow/en/details/37614', NULL, 'uploads/pets/primary_661662168.png', NULL, '2020-07-09 20:37:58', '2022-02-22 00:50:08'),
(4, 'Cross B Chanel', 'Chanel', 'CROSS B\'S RETURN TO SENDER', 'CROSS B\'S WHITE IRIS IN BLOOM', 'Hugo Tobar', 'Janet Burke', NULL, 'Female', '0000-00-00', '1', 'Current', 0, 0, 'cross-b-chanel2133', NULL, 'https://pedigree.chowhealth.org/cgi-bin/geneal.pl?op=tree&index=54199&gens=5&db=chow.dbw', NULL, 'uploads/pets/primary_1453691601.png', NULL, '2020-07-09 20:40:50', '2022-02-22 00:49:52'),
(5, 'CH Cross B Darkest Before Dawn', 'Phoenix', 'CROSS B\'S SO WHO\'S YOUR DADDY', 'CROSS B\'S IVORY CREAM', 'Janet Burke, Hugo Tobar', 'Janet Burke, Kaila Shinkle', 'NP44987101', 'Male', '0000-00-00', '2', 'Current', 0, 0, 'cross-b-darkest-before-dawn1517', NULL, 'https://pedigree.chowhealth.org/cgi-bin/geneal.pl?op=tree&index=53419&gens=5&db=chow.dbw', NULL, 'uploads/pets/primary_337972002.png', NULL, '2020-07-09 20:43:35', '2022-02-23 19:13:24'),
(6, 'Cross B Queen of Hearts', 'Daisy', 'CH CROSS B\'S GREAT EXPECTATION', 'TABU-N-CROSS B\'S PRETTY PRISCILLA', 'Janet Burke, Hugo Tobar', 'Janet Burke, Kaila Shinkle', 'NM', 'Female', '0000-00-00', '1', 'Current', 0, 0, 'cross-b-queen-of-hearts4630', NULL, 'https://pedigree.chowhealth.org/cgi-bin/geneal.pl?op=tree&index=53848&gens=5&db=chow.dbw', NULL, 'uploads/pets/primary_1258011919.png', NULL, '2020-07-09 20:46:32', '2022-02-22 00:48:36'),
(7, 'Padows Cartier', 'Cartier', 'CH PADOW\'S EASY LIKE SUNDAY MORNING', 'PADOWS @ FAMOUS\" PAINTING THE TOWN RED', 'Hugo Tobar', 'Kurt Williams, Jeremiah Leen', 'NM', 'Female', '0000-00-00', '1', 'Current', 0, 0, 'padows-cartier6894', NULL, 'https://pedigree.chowhealth.org/cgi-bin/trial.pl?sire=53297&dam=50910&sirepattern=PADOW%27S+EASY+LIKE+SUNDAY+MORNING&dampattern=PADOW%27S+JUST+ADD+A+LITTLE+SUGAR&gens=5&submit=Create+Now', NULL, 'uploads/pets/primary_1482687368.png', NULL, '2020-07-09 20:50:42', '2022-02-22 00:47:28'),
(8, 'Tokio of The Secret Temple', 'Tokio', 'LOKI OF THE SECRET TEMPLE', 'JAMAICAN SKA OF THE SECRET TEMPLE', 'Hugo Tobar', NULL, NULL, 'Female', '0000-00-00', '1', 'Current', 0, 0, 'tokio-of-the-secret-temple3850', NULL, 'http://ingrus.net/chow-chow/en/details/39155', NULL, 'uploads/pets/primary_94042680.png', NULL, '2020-07-20 06:46:29', '2022-02-22 00:47:06'),
(10, 'Notorius Star Ibiza', 'Fendi', 'Oscar De Los Perros De Vigo', 'Renee Zellweger Goes To King Victoria', 'Hugo Tobar', 'Manea Betty', 'ROI 20/56108', 'Female', '0000-00-00', '1', 'Current', 0, 0, 'notorius-star-ibiza7771', NULL, 'http://ingrus.net/chow-chow/en/testmating/18054/34587', 'my dream girl from italy', 'uploads/pets/primary_321801120.png', NULL, '2020-08-24 23:05:23', '2022-02-22 00:46:39'),
(11, 'GCH CH Rising Star Just Call Me Valentino', 'Valentino', 'GCH CH Cross B Calvin', 'Cross B Queen of Hearts', 'Stuart Bangma', 'Stuart Bangma', 'NP64669302', 'Male', '0000-00-00', '1', 'Current', 0, 0, 'just-call-me-valentino2076', NULL, NULL, 'Valentino is our sweet loving Grand Champion Dog. He is the son of our Grand Champion Calvin. Valentino is very friendly and affectionate, and he knows how to be a show dog.', 'uploads/pets/primary_1413093004.png', NULL, '2022-02-07 00:00:49', '2022-02-23 19:12:56'),
(12, 'CH Rising Star Prada', 'Prada', 'Freddie De Los Perros De Bigo', 'Helena Tian\'e Chows', 'Rosalie Bangma', 'Stuart Bangma', 'NP62082206', 'Female', '0000-00-00', '1', 'Current', 0, 0, 'rising-star-prada3843', NULL, 'http://ingrus.net/chow-chow/en/testmating/39509/37614', 'Prada is a sweet loving girl, who became a Champion at a very young age.  She is well balanced with a sweet face, and wonderful temperament.', 'uploads/pets/primary_170859302.png', NULL, '2022-02-07 00:21:39', '2022-02-23 19:12:04'),
(13, 'Puppies Cartier & Phoenix', NULL, 'Phoenix', 'Cartier', NULL, NULL, NULL, '', '0000-00-00', NULL, 'Litter', 0, 0, 'puppies-cartier-phoenix4578', NULL, NULL, 'A couple of our current available puppies', 'uploads/pets/primary_566121188.png', NULL, '2022-02-13 03:04:01', '2022-02-13 03:04:01'),
(15, 'CH Notorious Star LOL', 'Lola', 'El Omar Sharif Of Swiss', 'Hilary Duff', NULL, 'Betty Manea', 'NP78385401', 'Female', '0000-00-00', '1', 'Current', 0, 0, 'notorious-star-lol5035', NULL, '[url=http://ingrus.net/chow-chow/en/details/44721][img]http://ingrus.net/chow-chow/user-bar.php?id=44721&breed=chow-chow[/img][/url]', 'LOL is a sweet and fun girl, who makes everyone laugh', 'uploads/pets/primary_1388656922.png', NULL, '2023-02-21 02:29:35', '2023-02-21 02:51:13'),
(16, 'Soho of the Blue Mystery', 'Soho', 'CRIMSON RED-HENRY', 'VALKYRIE OF THE BLUE MYSTERY', 'Hugo Tobar', 'MiraMiki Kostadinovic', NULL, 'Female', '0000-00-00', '1', 'Current', 0, 0, 'soho-of-the-blue-mystery4590', NULL, NULL, 'Soho is a very loving and affectionate girl.', 'uploads/pets/primary_465491219.png', NULL, '2023-02-21 02:37:16', '2023-02-21 02:37:16'),
(17, 'Westchows Peice of my Heart', 'Punkin', 'CH Cross B\'s Jazz With Barjo', 'Cross B\'s Apple Dumplin', 'Hugo Tobar', 'Emma West', 'NP58218002', 'Male', '0000-00-00', '1', 'Current', 0, 0, 'westchows-peice-of-my-heart6653', NULL, 'https://pedigree.chowhealth.org/cgi-bin/geneal.pl?op=tree&index=62881&gens=5&db=chow.dbw', 'Punkin', 'uploads/pets/primary_1351657215.png', NULL, '2023-02-21 02:49:42', '2023-02-21 02:49:42'),
(18, 'Notorious Star Queen Of Hearts Shakira Cali', 'Shakira', 'Notorious Star Bach', '5th Avenue Star Paris Hilton', 'Hugo Tobar', 'Bety Manea', NULL, 'Female', NULL, NULL, 'Current', 0, 0, 'notorious-star-queen-of-hearts-shakira-cali5898', NULL, NULL, 'Shakira', 'uploads/pets/primary_15568969.png', NULL, '2023-02-21 03:04:17', '2026-02-16 09:20:31');

-- --------------------------------------------------------

--
-- Table structure for table `pet_colors`
--

CREATE TABLE `pet_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_colors`
--

INSERT INTO `pet_colors` (`id`, `color_name`, `created_at`, `updated_at`) VALUES
(1, 'Red Rough', '2020-07-09 14:26:36', '2020-07-09 14:26:36'),
(2, 'Black Rough', '2020-07-09 14:26:51', '2020-07-09 14:26:51'),
(3, 'Blue Rough', '2020-07-09 14:26:58', '2020-07-09 14:26:58'),
(4, 'Cream Rough', '2020-07-09 14:27:04', '2020-07-09 14:27:04'),
(5, 'Cinnamon Rough', '2020-07-09 14:27:14', '2020-07-09 14:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `pet_images`
--

CREATE TABLE `pet_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pet_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_images`
--

INSERT INTO `pet_images` (`id`, `pet_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 7, 'uploads/pet-gallery/251719688_1594309957.jpeg', '2020-07-09 14:52:37', '2020-07-09 14:52:37'),
(2, 7, 'uploads/pet-gallery/1666288688_1594309969.JPG', '2020-07-09 14:52:49', '2020-07-09 14:52:49'),
(3, 5, 'uploads/pet-gallery/618330473_1594310023.jpeg', '2020-07-09 14:53:44', '2020-07-09 14:53:44'),
(6, 4, 'uploads/pet-gallery/1753056151_1594310134.JPG', '2020-07-09 14:55:35', '2020-07-09 14:55:35'),
(7, 4, 'uploads/pet-gallery/766470137_1594310163.JPG', '2020-07-09 14:56:03', '2020-07-09 14:56:03'),
(8, 4, 'uploads/pet-gallery/2015172699_1594310178.JPG', '2020-07-09 14:56:18', '2020-07-09 14:56:18'),
(9, 1, 'uploads/pet-gallery/711433884_1594310300.JPG', '2020-07-09 14:58:20', '2020-07-09 14:58:20'),
(10, 1, 'uploads/pet-gallery/1666067307_1594310315.jpeg', '2020-07-09 14:58:35', '2020-07-09 14:58:35'),
(11, 2, 'uploads/pet-gallery/1630381583_1594310413.JPG', '2020-07-09 15:00:13', '2020-07-09 15:00:13'),
(12, 2, 'uploads/pet-gallery/1722916264_1594310430.JPG', '2020-07-09 15:00:30', '2020-07-09 15:00:30'),
(13, 2, 'uploads/pet-gallery/1506676031_1594310444.JPG', '2020-07-09 15:00:44', '2020-07-09 15:00:44'),
(14, 3, 'uploads/pet-gallery/1982023769_1594310495.JPG', '2020-07-09 15:01:35', '2020-07-09 15:01:35'),
(15, 3, 'uploads/pet-gallery/359154535_1594310518.JPG', '2020-07-09 15:01:58', '2020-07-09 15:01:58'),
(16, 8, 'uploads/pet-gallery/1426355634_Tokio.jpg', '2020-07-20 00:46:29', '2020-07-20 00:46:29'),
(21, 6, 'uploads/pet-gallery/1713412923_1598295133.jpeg', '2020-08-24 16:52:13', '2020-08-24 16:52:13'),
(22, 10, 'uploads/pet-gallery/1817901796_1598295995.jpeg', '2020-08-24 17:06:35', '2020-08-24 17:06:35'),
(23, 11, 'uploads/pet-gallery/302065760_Valentino.jpeg', '2022-02-06 18:00:50', '2022-02-06 18:00:50'),
(24, 8, 'uploads/pet-gallery/110844751_1644170973.jpeg', '2022-02-06 18:09:33', '2022-02-06 18:09:33'),
(25, 12, 'uploads/pet-gallery/665465488_Prada.jpeg', '2022-02-06 18:21:40', '2022-02-06 18:21:40'),
(26, 13, 'uploads/pet-gallery/1512729434_.JPG', '2022-02-12 21:04:02', '2022-02-12 21:04:02'),
(31, 15, 'uploads/pet-gallery/2078345921_.jpeg', '2023-02-20 20:29:35', '2023-02-20 20:29:35'),
(32, 15, 'uploads/pet-gallery/699622606_1676925061.JPG', '2023-02-20 20:31:01', '2023-02-20 20:31:01'),
(33, 15, 'uploads/pet-gallery/1121238809_1676925073.jpeg', '2023-02-20 20:31:13', '2023-02-20 20:31:13'),
(34, 15, 'uploads/pet-gallery/1551835217_1676925095.JPG', '2023-02-20 20:31:35', '2023-02-20 20:31:35'),
(35, 16, 'uploads/pet-gallery/282621901_Soho.JPG', '2023-02-20 20:37:17', '2023-02-20 20:37:17'),
(36, 16, 'uploads/pet-gallery/1929192488_Soho.jpeg', '2023-02-20 20:37:17', '2023-02-20 20:37:17'),
(37, 16, 'uploads/pet-gallery/963909406_Soho.JPG', '2023-02-20 20:37:18', '2023-02-20 20:37:18'),
(38, 17, 'uploads/pet-gallery/296899241_Punkin.jpeg', '2023-02-20 20:49:42', '2023-02-20 20:49:42'),
(39, 17, 'uploads/pet-gallery/1582046583_Punkin.jpeg', '2023-02-20 20:49:43', '2023-02-20 20:49:43'),
(40, 18, 'uploads/pet-gallery/413078219_Shakira.jpeg', '2023-02-20 21:04:17', '2023-02-20 21:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_applications`
--

CREATE TABLE `reservation_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `inquiry` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `last_message_at` timestamp NULL DEFAULT NULL,
  `unread_messages_count` int(11) NOT NULL DEFAULT 0,
  `email_thread_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation_applications`
--

INSERT INTO `reservation_applications` (`id`, `pet_id`, `user_name`, `email`, `phone`, `inquiry`, `status`, `last_message_at`, `unread_messages_count`, `email_thread_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'lagututo', 'mdeasinislam6@gmail.com', '+1 (139) 809-9244', 'Quod eius est in qui', 'pending', '2026-02-14 20:04:06', 3, 'APP-1-1771097432', '2026-02-14 12:29:24', '2026-02-14 14:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `google_analytics` text DEFAULT NULL,
  `google_tag_manager` text DEFAULT NULL,
  `facebook_pixel` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `meta_title`, `meta_description`, `meta_keywords`, `og_title`, `og_description`, `og_image`, `google_analytics`, `google_tag_manager`, `facebook_pixel`, `created_at`, `updated_at`) VALUES
(1, 'RisingStarChows - Premium Chow Chow Breeders | Champion Dog Training & Breeding', 'Professional Chow Chow breeders specializing in champion bloodlines, dog training, and breeding services. Find your perfect Chow Chow puppy today.', 'chow chow, chow chow breeders, chow chow puppies, dog breeding, dog training, champion dogs, premium breeders', 'RisingStarChows - Premium Chow Chow Breeders', 'Professional Chow Chow breeders specializing in champion bloodlines, dog training, and breeding services.', NULL, NULL, NULL, NULL, '2026-02-16 07:59:00', '2026-02-16 07:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('h0qEJHiW8NuUC2KIPTZ3QYqwSstaGQBzj24FIO1l', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSUNUY3pBbnZaT3JmSXZYeUhPOUpKMW50c2NEcFZVcE9odHU2M2FMUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXNlcnZhdGlvbi8xMyI7czo1OiJyb3V0ZSI7czoxNjoicmVzZXJ2YXRpb24uc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1778754326),
('HTjdz7yWRmmf5RmmP2PMD23hU85MnNpOArsYR1CT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEZlN0tkeGNuWkhjRUtGTXlEeUgwaWZZMDNibVFkQlM3dk5GQUQ0RSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1779294001),
('pf3zPzSNemQDXymikMBJCCie12nq3obPrpB4QLWy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.120.0 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibW1Ha3hDR2NrR3ZjazBqQTdmUXF4U1daSzFnMEtDVU5tYmhvRENmSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778750951),
('SDudTgHWfn54LNDKCok55WlDpfVtPqc8aImFN6CE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUJSYWhyRDJweklDaVhJcFk4a2tEVTg2Q2xWRVhpUlNqd01DczJzUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778168437),
('t1sO11NnwknP9GHRkUsheBo6MdAjdhw4OxvixB0p', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWkp5ZnowS2FmUEhzaW56Nm1sRllCbUpHVmVKT1l3U2p6bmY4UVBhQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXQvbm90b3Jpb3VzLXN0YXItbG9sNTAzNSI7czo1OiJyb3V0ZSI7czoxMToicGV0LmRldGFpbHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1771260295);

-- --------------------------------------------------------

--
-- Table structure for table `slide_shows`
--

CREATE TABLE `slide_shows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `enable_action_button` tinyint(1) NOT NULL DEFAULT 0,
  `action_button_text` varchar(255) DEFAULT NULL,
  `action_button_link` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slide_shows`
--

INSERT INTO `slide_shows` (`id`, `title`, `description`, `image`, `enable_action_button`, `action_button_text`, `action_button_link`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Accusantium omnis co', 'Quis esse praesenti', 'uploads/slide-shows/1770399145_698625a9ef21d.jpg', 1, NULL, NULL, 1, 71, '2026-02-06 11:32:25', '2026-02-07 05:24:41'),
(2, 'Little Life', 'sad', 'uploads/slide-shows/1770463474_698720f29d1f8.jpg', 1, 'Learn More', 'https://google.com', 1, 2, '2026-02-07 05:24:34', '2026-02-07 05:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', '2026-02-06 10:54:22', '$2y$12$iYzhoVnFe4DGUuil44NAu.9I75Lonar0SFXt7jGK3V98XVG/ztEJq', 'oJ3Gslh7z6llLQ2DVEQ6Hwr8B7oPyX0BR9TcyYGNnbdOYdjGBJEKPdBQcdwC', '2026-02-06 10:54:22', '2026-02-06 10:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `footer_text` text DEFAULT NULL,
  `about_us` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `site_name`, `logo`, `favicon`, `email`, `phone`, `address`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `footer_text`, `about_us`, `created_at`, `updated_at`) VALUES
(1, 'Rising Star Chows', 'uploads/settings/1771173445_logo.png', NULL, 'super@admin.com', '01533860142', 'CHALABON, HOUSE #289, SHAH KABIR MAJAR ROAD\r\nDAKSHINKHAN, AJAMPUR-1230, DHAKA', 'https://www.raxozubo.org', 'https://www.raxozubo.org', 'https://www.raxozubo.org', 'https://www.raxozubo.org', 'https://www.raxozubo.org', '&copy; 2026 RisingStarChows. Premium Chow Chow Breeders. All Rights Reserved.', 'We are dedicated to breeding healthy, happy, and high-quality Chow Chow puppies.', '2026-02-15 09:45:09', '2026-02-15 10:37:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_messages`
--
ALTER TABLE `application_messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `application_messages_email_message_id_unique` (`email_message_id`),
  ADD KEY `application_messages_sender_id_foreign` (`sender_id`),
  ADD KEY `application_messages_reservation_application_id_index` (`reservation_application_id`),
  ADD KEY `application_messages_sender_type_is_read_index` (`sender_type`,`is_read`),
  ADD KEY `application_messages_created_at_index` (`created_at`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pets_slug_unique` (`slug`);

--
-- Indexes for table `pet_colors`
--
ALTER TABLE `pet_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_images`
--
ALTER TABLE `pet_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_images_pet_id_foreign` (`pet_id`);

--
-- Indexes for table `reservation_applications`
--
ALTER TABLE `reservation_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_applications_pet_id_foreign` (`pet_id`),
  ADD KEY `reservation_applications_last_message_at_index` (`last_message_at`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `slide_shows`
--
ALTER TABLE `slide_shows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `application_messages`
--
ALTER TABLE `application_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pet_colors`
--
ALTER TABLE `pet_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pet_images`
--
ALTER TABLE `pet_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `reservation_applications`
--
ALTER TABLE `reservation_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slide_shows`
--
ALTER TABLE `slide_shows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_messages`
--
ALTER TABLE `application_messages`
  ADD CONSTRAINT `application_messages_reservation_application_id_foreign` FOREIGN KEY (`reservation_application_id`) REFERENCES `reservation_applications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `application_messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pet_images`
--
ALTER TABLE `pet_images`
  ADD CONSTRAINT `pet_images_pet_id_foreign` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservation_applications`
--
ALTER TABLE `reservation_applications`
  ADD CONSTRAINT `reservation_applications_pet_id_foreign` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
