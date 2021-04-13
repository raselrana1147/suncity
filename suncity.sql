-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2021 at 06:22 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suncity`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `avatar`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Rasel Rana', 'raselrana1147@gmail.com', '$2y$10$ejzReoUuGmdPs.1d/nA8FuXj5t1i/xZ2jzSbbRrP3dYpfjGMduDPu', NULL, 'admin', '2021-03-28 23:19:28', '2021-03-28 23:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `name` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active;2=deactivated',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `status`, `created_at`) VALUES
(1, 0, 'Suits & Blazers', 1, '2020-04-27 04:43:20'),
(2, 0, 'Formal & Casual Shirts', 1, '2020-04-27 04:43:20'),
(9, 0, 'Sherwani & Punjabis', 1, '2020-04-27 04:43:20'),
(11, 1, 'Coat', 1, '2020-04-27 04:43:20'),
(12, 1, 'Safari', 1, '2020-04-27 04:43:20'),
(13, 1, 'W. Coat', 1, '2020-04-27 04:43:20'),
(14, 1, 'Prince Coat', 1, '2020-04-27 04:43:20'),
(15, 1, 'Over Coat', 1, '2020-04-27 04:43:20'),
(16, 1, 'Cotay', 1, '2020-04-27 04:43:20'),
(17, 1, 'Mujib Coat', 1, '2020-04-27 04:43:20'),
(18, 1, 'Modi Coat', 1, '2020-04-27 04:43:20'),
(19, 2, 'Shirt', 1, '2020-04-27 04:43:20'),
(20, 2, 'Pant', 1, '2020-04-27 04:43:20'),
(21, 2, 'Pajama', 1, '2020-04-27 04:43:20'),
(22, 2, 'Collar Design', 1, '2020-04-27 04:43:20'),
(23, 9, 'Punjabi', 1, '2020-04-27 04:43:20'),
(24, 9, 'Fatua', 1, '2020-04-27 04:43:20'),
(25, 9, 'Apron', 1, '2020-04-27 04:43:20'),
(26, 9, 'Sherwani', 1, '2020-04-27 04:43:20'),
(27, 9, 'Sherwani Cutting Punjabi', 1, '2020-04-27 04:43:20'),
(28, 9, 'Jubba', 1, '2020-04-27 04:43:20'),
(29, 9, 'Kabli', 1, '2020-04-27 04:43:20'),
(31, 24, 'Halim Mia', 1, '2020-11-17 14:58:49');

-- --------------------------------------------------------

--
-- Table structure for table `collars`
--

CREATE TABLE `collars` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` text NOT NULL,
  `thumb` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active;2=deactive;',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collars`
--

INSERT INTO `collars` (`id`, `title`, `subtitle`, `thumb`, `status`, `created_at`, `price`) VALUES
(1, 'Classic', '', 'uploads/custom/collar/collar-business.svg', 1, '2020-04-05 23:49:06', 0),
(2, 'Button Down', 'A Classic spread collar with ample room for a tie knot.', 'uploads/custom/collar/7d56576ba1458e4cc3b12595e26a9adastandard.png', 1, '2020-04-05 23:49:06', 0),
(3, 'Semi Cut Away', '', 'uploads/custom/collar/collar-cut-away.svg', 1, '2020-04-05 23:49:06', 0),
(4, 'Cut Away', '', 'uploads/custom/collar/17d8de1ff27a65e0746d2a5bb5b69e83centered.png', 1, '2020-04-05 23:49:06', 0),
(5, 'Full Cut Away', 'To be gorgeous', 'uploads/custom/collar/eae19fe31635f21fab92e0ce9151c2fbwith_flap.png', 1, '2020-04-05 23:49:06', 40);

-- --------------------------------------------------------

--
-- Table structure for table `fabrics`
--

CREATE TABLE `fabrics` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `tag_ling` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `thumb` text DEFAULT NULL,
  `pro_img` text DEFAULT NULL,
  `is_default` int(11) NOT NULL DEFAULT 2 COMMENT '1=yes;2=no',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active;2=deactive;',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fabrics`
--

INSERT INTO `fabrics` (`id`, `title`, `tag_ling`, `price`, `description`, `thumb`, `pro_img`, `is_default`, `status`, `created_at`, `category`) VALUES
(14, 'Nice fabric', 'new tag line', 60, 'What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.  Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'uploads/fabrics/5ff0b664974ee7118f428e25c4bea62f200130_f e.jpg', 'uploads/fabrics/5ff0b664974ee7118f428e25c4bea62f200130_f e.jpg', 1, 1, '2020-10-01 00:25:22', 16),
(23, 'Nice fabric', 'new tag line', 55, 'fdfsd', 'uploads/fabrics/31e485d2286c1c155eb15bbc8ee02ab777752d24c9137ba5c6311425065a94f2--shirt-quilts-blue-plaid.jpg', 'uploads/fabrics/1a400fe1700c588872e929a5f9718c28checks-250x250.jpg', 2, 1, '2020-11-17 20:06:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mi_admin`
--

CREATE TABLE `mi_admin` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `user_name` text DEFAULT NULL,
  `user_email` text DEFAULT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_verification_code` int(15) NOT NULL,
  `user_password` text DEFAULT NULL,
  `user_salt` text DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_photo` text DEFAULT NULL,
  `user_status` varchar(11) NOT NULL DEFAULT '1' COMMENT '1=Pending; 2=Activated; 3=Deactivated',
  `user_attepts` int(11) DEFAULT 0 COMMENT 'Failed Login attempts. More then 5 will block the user',
  `user_authen_time` datetime DEFAULT NULL COMMENT 'block remove timer',
  `user_last_login` datetime DEFAULT NULL COMMENT 'Login ',
  `user_signed_up` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'User Signup Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_admin`
--

INSERT INTO `mi_admin` (`id`, `role_id`, `user_name`, `user_email`, `user_phone`, `user_verification_code`, `user_password`, `user_salt`, `user_address`, `user_photo`, `user_status`, `user_attepts`, `user_authen_time`, `user_last_login`, `user_signed_up`) VALUES
(10, 6, 'Rasel Rana', 'admin@gmail.com', '01620193118', 166090, '202cb962ac59075b964b07152d234b70', '123', 'Tallaba, Subahanbug, Dhanmondhi, Dhaka', 'staff-uploads/staff-profile/6162ac3b2475bd5effec314875c79c7e90196161_206161847146362_5245028351231393792_n.jpg', '2', 0, '0000-00-00 00:00:00', '2020-11-18 12:22:43', '2019-08-20 18:05:13'),
(34, 1, 'Zena Mccall1', 'maamun79@gmail.com', '0174242650', 0, '202cb962ac59075b964b07152d234b70', '123', '0174242650', 'staff-uploads/staff-profile/04c24e25b9997e306a305ad906b47e0aheadphone.jpg', '2', 0, '0000-00-00 00:00:00', '2020-07-29 15:38:00', '2020-07-23 19:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `mi_users`
--

CREATE TABLE `mi_users` (
  `id` int(11) NOT NULL,
  `user_name` text DEFAULT NULL,
  `user_email` text DEFAULT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_verification_code` int(15) NOT NULL,
  `user_password` text DEFAULT NULL,
  `user_salt` text DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_photo` text DEFAULT NULL,
  `user_status` varchar(11) NOT NULL DEFAULT '1' COMMENT '1=Pending; 2=Activated; 3=Deactivated',
  `user_attepts` int(11) DEFAULT 0 COMMENT 'Failed Login attempts. More then 5 will block the user',
  `user_authen_time` datetime DEFAULT NULL COMMENT 'block remove timer',
  `user_last_login` datetime DEFAULT NULL COMMENT 'Login ',
  `user_signed_up` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'User Signup Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_users`
--

INSERT INTO `mi_users` (`id`, `user_name`, `user_email`, `user_phone`, `user_verification_code`, `user_password`, `user_salt`, `user_address`, `user_photo`, `user_status`, `user_attepts`, `user_authen_time`, `user_last_login`, `user_signed_up`) VALUES
(10, 'Monirul Islam Sujon1', 'misujon58262@gmail.com', '01676707067', 166090, '81dc9bdb52d04dc20036dbd8313ed055', '1234', '43/1, Bilasdi, Narsingdi, Dhaka, Bangladesh', '', '2', 9, '2020-11-11 13:51:26', '2020-10-09 15:16:20', '2019-08-20 18:05:13'),
(31, 'Meskat Ahosan', 'meskat@gmail.com', '01742426503', 0, '698d51a19d8a121ce581499d7b701668', '111', '51/A', '', '2', 2, '2020-05-30 11:53:23', '2020-05-22 16:55:17', '2020-05-22 04:59:07'),
(32, 'Mamun', 't@g.com', '01742426503', 0, '8d5e957f297893487bd98fa830fa6413', '147', '51/A/1', '', '1', 0, '0000-00-00 00:00:00', '2020-07-23 22:24:30', '2020-07-22 20:17:52'),
(33, 'Zenia Giles up', 'm@g.com', '01742426503', 0, '202cb962ac59075b964b07152d234b70', '123', '51/A/1', '', '1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-07-24 16:51:16'),
(34, 'sakib', 'rasel@gmail.com', '01676707067', 0, '827ccb0eea8a706c4c34a16891f84e7b', '12345', 'Tallaba, Dhaka', 'staff-uploads/staff-profile/cea87acc94a1e6929750d370e26740d6image.JPG', '2', 0, '0000-00-00 00:00:00', '2020-07-27 17:30:18', '2020-07-27 17:29:36'),
(36, 'Sujon hhh', 'sujon@gmail.com', '01742426503', 0, '202cb962ac59075b964b07152d234b70', '123', '51/A/1', 'staff-uploads/staff-profile/930e1a97fef945ef1d82a611759af85690196161_206161847146362_5245028351231393792_n.jpg', '2', 0, '0000-00-00 00:00:00', '2020-11-11 13:41:54', '2020-09-13 13:22:22'),
(37, 'tahsan', 'tahsan@gmail.cm', '01744460010', 0, '202cb962ac59075b964b07152d234b70', '123', 'Tallaba, haka', 'staff-uploads/staff-profile/1782ac59405184c55890662c818b073e25319758_2002127486725089_1728884689_o.jpg', '1', 0, NULL, NULL, '2020-11-18 16:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `meta_name` varchar(100) DEFAULT NULL,
  `meta_value` text DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `meta_name`, `meta_value`, `type`) VALUES
(1, 'site_title_text', 'MI Tailoring Service', 'home_page'),
(2, 'site_logo', 'uploads/site-logo/3e1a5a17a7b7ff8c2be763e24a5bbfd5f6356f7c8343b4730d9338001d03b29101png.png', 'home_page'),
(3, 'footer_title', 'Contact Information', 'footer'),
(4, 'footer_text', '36-Commercial Area, Cavalry Ground<br>\r\nLahor, Pakistan<br><br>\r\n\r\ninfo@perennial.com.pak<br>\r\nsales@perennial.com.pak<br>\r\nsupport@perennial.com.pak', 'footer'),
(5, 'footer_copyright', 'Perennial.com', 'footer'),
(6, 'copyright_link', 'https://misujon.com/', 'footer'),
(7, 'fa-facebook', 'https://www.facebook.com/', 'social_icon'),
(8, 'fa-twitter', 'https://www.twitter.com/', 'social_icon'),
(9, 'fa-linkedin', 'https://www.linkedin.com/\r\n', 'social_icon'),
(10, 'fa-instagram', 'https://www.instagram.com/', 'social_icon'),
(11, 'contact_info', '<p><b>36-Commercial Area, Cavalry Ground<br>Lahor, Pakistan</b></p><ul><li>info@perennial.com.pak</li><li>sales@perennial.com.pak</li><li>support@perennial.com.pak</li></ul>', 'contact'),
(12, 'fabric_thumb', 'uploads/custom/shirt-element/af454646f879d7e5dedc3c900b3772fbdownload (1).png', 'shirt_element'),
(13, 'button_thumb', 'uploads/custom/shirt-element/bb5a268a620f19e6cb0dd3f61bb0d548download (1).jpg', 'shirt_element'),
(14, 'button_thread_thumb', 'uploads/custom/shirt-element/bf8b0c8881cb4816f95e12f4cae9d6c1MSC_0160296-11.jpg', 'shirt_element'),
(15, 'contrast_thumb', 'uploads/custom/shirt-element/11e1e7edf311d1efe506a0e8756287cc29cccc118d67f9c98d3b98018e99ba53.jpg', 'shirt_element'),
(16, 'embroidery_thumb', 'uploads/custom/shirt-element/d67bf903b0f7952f33ff6bdd00caf1acdownload (3).jpg', 'shirt_element'),
(17, 'paypal_client_id', 'AXYd5BJF5uA_2eKZgaOiesf9jh4BuEHEb1ELQfkLuYmwNuJNPpqP3kNH7Sa1WMlI2ine3FfgCR2iHMUC', 'payment_getaway'),
(18, 'paypal_currency', 'USD', 'payment_getaway'),
(19, 'button_hole_thread_thumb', 'uploads/custom/shirt-element/85466799172e230c3407dd9d62f1a07espider-plug-hole.jpg', 'shirt_element');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `design` int(11) DEFAULT NULL,
  `tailoring` int(11) DEFAULT NULL,
  `orders` int(11) DEFAULT NULL,
  `user_management` int(11) DEFAULT NULL,
  `settings` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL COMMENT '1=active\r\n2=deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_name`, `design`, `tailoring`, `orders`, `user_management`, `settings`, `status`) VALUES
(1, 'Manager', 1, 0, 1, 1, 1, '1'),
(6, 'Admin', 1, 1, 1, 1, 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collars`
--
ALTER TABLE `collars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fabrics`
--
ALTER TABLE `fabrics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_admin`
--
ALTER TABLE `mi_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_users`
--
ALTER TABLE `mi_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `collars`
--
ALTER TABLE `collars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fabrics`
--
ALTER TABLE `fabrics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `mi_admin`
--
ALTER TABLE `mi_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `mi_users`
--
ALTER TABLE `mi_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
