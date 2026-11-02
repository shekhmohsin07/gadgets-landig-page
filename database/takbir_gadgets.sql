-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2026 at 08:36 AM
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
-- Database: `takbir_gadgets`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image`, `link`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Welcome', 'images/banners/welcome.jpg', NULL, 1, 1, '2026-11-02 06:58:51', '2026-11-02 06:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
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
(4, '2026_11_02_000001_create_store_tables', 1),
(5, '2026_11_02_000002_apply_takbir_theme_defaults', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `unit_price` int(10) UNSIGNED NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `delivery_zone` varchar(20) NOT NULL DEFAULT 'inside',
  `delivery_fee` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `total` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `thana` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `product_id`, `product_name`, `unit_price`, `quantity`, `delivery_zone`, `delivery_fee`, `total`, `customer_name`, `phone`, `district`, `thana`, `address`, `note`, `status`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'TG9R5TX75', 1, 'Red Light Scalp Massager 100% Orjinal', 750, 2, 'outside', 120, 1620, 'Shekh Mohsin', '01858012033', 'Dhaka', 'Dohar', 'Road-11, Mirpur-2, Dhaka', NULL, 'pending', '127.0.0.1', '2026-11-02 07:11:01', '2026-11-02 07:11:01');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `old_price` int(10) UNSIGNED DEFAULT NULL,
  `badge` varchar(40) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `review_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`review_images`)),
  `description` longtext DEFAULT NULL,
  `rating` decimal(2,1) NOT NULL DEFAULT 4.9,
  `reviews_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_top_selling` tinyint(1) NOT NULL DEFAULT 0,
  `is_popular` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `slug`, `name`, `price`, `old_price`, `badge`, `image`, `gallery`, `review_images`, `description`, `rating`, `reviews_count`, `is_top_selling`, `is_popular`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'red-light-scalp-massager-100-orjinal', 'Red Light Scalp Massager 100% Orjinal', 750, 1250, 'Best Selling', 'images/products/scalp-massager.svg', NULL, NULL, '৫ মিনিটে মাথা ব্যথা দূর করুন Original Scalp Massager দিয়ে।\n\n✅ রেড লাইট থেরাপি ও ভাইব্রেশন মাসাজ\n✅ Low, Medium, High — ৩টি স্পিড মোড\n✅ রিচার্জেবল ব্যাটারি, দীর্ঘ সময় ব্যাকআপ\n✅ চুল ও স্ক্যাল্পের জন্য আরামদায়ক সিলিকন হেড\n\nপণ্য হাতে পেয়ে চেক করে টাকা পরিশোধ করুন (ক্যাশ অন ডেলিভারি)। অর্ডার করতে নিচের ফর্মটি পূরণ করুন।', 4.9, 128, 1, 0, 1, 0, '2026-11-02 06:58:51', '2026-11-02 06:58:51'),
(2, 'blackhead-remover-hair-oil-applicator-comb', 'Blackhead Remover + Hair Oil Applicator Comb', 849, 1250, 'Best Selling', 'images/products/blackhead-remover.svg', NULL, NULL, 'ব্ল্যাকহেড রিমুভার + হেয়ার অয়েল অ্যাপ্লিকেটর কম্ব — একটি ডিভাইসে দুই কাজ।\n\n✅ মাল্টি-ফাংশনাল ক্লিনিং ডিভাইস\n✅ একাধিক সাকশন হেড\n✅ স্ক্যাল্পে তেল লাগানোর জন্য অ্যাপ্লিকেটর চিরুনি\n\nক্যাশ অন ডেলিভারি — পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।', 4.9, 0, 1, 0, 1, 1, '2026-11-02 06:58:51', '2026-11-02 06:58:51'),
(3, '3-head-fascia-massage-gun-with-9-difference-heads-100-original', '3 Head Fascia Massage Gun – With 9 Difference Heads – 100% Original', 999, 1650, 'Hot Deal', 'images/products/massage-gun.svg', NULL, NULL, 'পেশীর ব্যথা ও আড়ষ্টতা কমাতে ফ্যাসিয়া মাসাজ গান।\n\n✅ ৯টি ভিন্ন মাসাজ হেড\n✅ একাধিক স্পিড লেভেল\n✅ হালকা ও সহজে বহনযোগ্য\n\nক্যাশ অন ডেলিভারি — পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।', 4.9, 0, 1, 0, 1, 2, '2026-11-02 06:58:51', '2026-11-02 06:58:51'),
(4, '6500-wt-power-silver-crest-rak-electric-grinder-blender', '🔥 6500 WT Power 🔥 Silver Crest RAK Electric Grinder Blender', 1050, 1800, 'Hot Deal', 'images/products/grinder.svg', NULL, NULL, 'শক্তিশালী মোটরের ইলেকট্রিক গ্রাইন্ডার ও ব্লেন্ডার।\n\n✅ মশলা, ডাল, শুকনো ও ভেজা পণ্য পিষতে সক্ষম\n✅ স্টেইনলেস স্টিল বডি\n✅ সহজে পরিষ্কার করা যায়\n\nক্যাশ অন ডেলিভারি — পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।', 4.9, 0, 1, 0, 1, 3, '2026-11-02 06:58:51', '2026-11-02 06:58:51'),
(5, 'prestige-32-liter-electric-multi-cooker', 'Prestige 3.2 Liter Electric Multi cooker', 989, 1260, NULL, 'images/products/multi-cooker.svg', NULL, NULL, 'এই পণ্যটি সম্পর্কে বিস্তারিত জানতে বা অর্ডার করতে নিচের ফর্মটি পূরণ করুন। ক্যাশ অন ডেলিভারি — পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।', 4.9, 0, 0, 1, 1, 4, '2026-11-02 06:58:51', '2026-11-02 06:58:51'),
(6, 'hoco-mmj-24-tws-wireless-earbuds', 'Hoco MMJ-24 TWS Wireless Earbuds', 990, 1650, NULL, 'images/products/earbuds.svg', NULL, NULL, 'এই পণ্যটি সম্পর্কে বিস্তারিত জানতে বা অর্ডার করতে নিচের ফর্মটি পূরণ করুন। ক্যাশ অন ডেলিভারি — পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।', 4.9, 0, 0, 1, 1, 5, '2026-11-02 06:58:51', '2026-11-02 06:58:51'),
(7, 'osaka-electric-chopper', 'Osaka Electric Chopper', 950, 1650, NULL, 'images/products/chopper.svg', NULL, NULL, 'এই পণ্যটি সম্পর্কে বিস্তারিত জানতে বা অর্ডার করতে নিচের ফর্মটি পূরণ করুন। ক্যাশ অন ডেলিভারি — পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।', 4.9, 0, 0, 1, 1, 6, '2026-11-02 06:58:51', '2026-11-02 06:58:51'),
(8, '40000-mah-battery-high-power-chaina-jambu-light', '40000 mAh Battery High Power Chaina Jambu Light', 1150, 2600, NULL, 'images/products/power-light.svg', NULL, NULL, 'এই পণ্যটি সম্পর্কে বিস্তারিত জানতে বা অর্ডার করতে নিচের ফর্মটি পূরণ করুন। ক্যাশ অন ডেলিভারি — পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।', 4.9, 0, 0, 1, 1, 7, '2026-11-02 06:58:51', '2026-11-02 06:58:51');

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

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key`, `value`) VALUES
('accent_color', '#0a0a0a'),
('address', 'Tokyo square shopping malls ,Japan garden city ,ring road, Dhaka'),
('custom_body_code', ''),
('custom_head_code', ''),
('delivery_inside', '70'),
('delivery_outside', '120'),
('facebook_url', 'https://www.facebook.com/share/1CHMKobQA3/?mibextid=wwXIfr'),
('fb_pixel_id', ''),
('footer_about', 'আপনার বিশ্বস্ত গ্যাজেট শপ! আধুনিক ও মানসম্মত গ্যাজেট, সেরা দামে — সারা বাংলাদেশে ক্যাশ অন ডেলিভারি।'),
('ga4_id', ''),
('gtm_id', ''),
('meta_description', 'Takbir Gadgets - original gadgets at the best price. Cash on delivery all over Bangladesh.'),
('phone', '01918503372'),
('pixel_enabled', '1'),
('primary_color', '#e30000'),
('site_logo', 'images/logo.jpg'),
('site_name', 'Takbir Gadgets'),
('tiktok_pixel_id', ''),
('tiktok_url', ''),
('whatsapp_number', '01918503372'),
('youtube_url', '');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `handle` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT 5,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `handle`, `message`, `rating`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Fatema Akter', '@fatema_student', 'iPad Keyboard Case টা পেয়ে পড়াশোনা অনেক সহজ হয়ে গেছে। দাম তুলনামূলক অনেক কম।', 5, 1, 1, '2026-11-02 06:58:51', '2026-11-02 06:58:51'),
(2, 'Nahid Islam', '@nahid_islam', 'Torch টা পেয়ে পড়াশোনা অনেক সহজ হয়ে গেছে। দাম তুলনামূলক অনেক কম।', 5, 2, 1, '2026-11-02 07:30:11', '2026-11-02 07:30:11');

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
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@takbirgadgets.com', NULL, '$2y$12$GOBuko1BDes86FL2FEJA5OgMU7deyEcPLpHJlz2yKA5H91yXgpEGq', 1, NULL, '2026-11-02 06:58:50', '2026-11-02 06:58:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_product_id_foreign` (`product_id`),
  ADD KEY `orders_status_index` (`status`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
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
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
