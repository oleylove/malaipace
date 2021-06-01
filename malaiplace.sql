-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2021 at 07:24 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `malaiplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL COMMENT 'วันลงบัญชี',
  `income` int(11) NOT NULL DEFAULT 0 COMMENT 'เงินได้',
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'หมายเหตุ',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'วันลงบัญชี',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `date`, `income`, `remark`, `created_at`, `updated_at`) VALUES
(9, '2020-10-02', 200, 'อื่นๆ', '2020-10-02 19:33:17', '2020-10-02 19:33:17'),
(10, '2020-10-02', -7000, 'จ่ายค่าไฟ', '2020-10-02 19:35:02', '2020-10-02 19:35:02'),
(11, '2020-10-01', -8000, 'จ่ายค่าน้ำ', '2020-10-02 19:35:32', '2020-10-02 19:35:32'),
(12, '2020-10-01', -750, 'จ่ายค่าอินเตอร์เน็ต', '2020-10-02 19:38:12', '2020-10-02 19:38:12'),
(13, '2020-10-03', -5000, 'จ่ายค่าจ้างคนงาน', '2020-10-02 19:38:21', '2020-10-02 19:38:21'),
(14, '2020-10-03', -200, 'อื่นๆ', '2020-10-02 19:57:33', '2020-10-02 19:57:33'),
(15, '2021-01-08', 2000, 'ค่าเช่าห้อง', '2021-01-08 08:23:27', '2021-01-08 08:23:27'),
(16, '2021-01-08', -500, 'จ่ายค่าจ้างคนงาน', '2021-01-08 08:24:32', '2021-01-08 08:24:32'),
(17, '2021-01-08', -10000, 'จ่ายค่าไฟ', '2021-01-08 08:24:45', '2021-01-08 08:24:45'),
(18, '2021-01-08', 500, 'ค่าเช่าห้อง', '2021-01-08 08:24:56', '2021-01-08 08:24:56'),
(19, '2021-01-08', -2000, 'จ่ายค่าจ้างคนงาน', '2021-01-08 08:25:07', '2021-01-08 08:25:07'),
(20, '2021-01-08', -50000, 'จ่ายค่าไฟ', '2021-01-08 08:25:21', '2021-01-08 08:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'รหัสใบแจ้งหนี้',
  `les_id` int(11) NOT NULL COMMENT 'รหัสเช่า',
  `date` date DEFAULT NULL COMMENT 'วันออกใบแจ้งหนี้',
  `date_pay` timestamp NULL DEFAULT NULL COMMENT 'วันแจ้งชำระเงิน',
  `pay_date` date DEFAULT NULL COMMENT 'วันกำหนดชำระเงิน',
  `delay_date` int(11) NOT NULL DEFAULT 0 COMMENT 'วันเกินกำหนด',
  `meter_wo` int(11) NOT NULL COMMENT 'มิเตอร์น้ำเก่า',
  `meter_wn` int(11) NOT NULL COMMENT 'มิเตอร์น้ำใหม่',
  `meter_wu` int(11) NOT NULL COMMENT 'จำนวนหน่วย',
  `meter_wpu` int(11) NOT NULL COMMENT 'ค่าน้ำต่อหน่วย',
  `meter_wtp` int(11) NOT NULL COMMENT 'รวมค่าน้ำ',
  `meter_po` int(11) NOT NULL COMMENT 'มิเตอร์ไฟเก่า',
  `meter_pn` int(11) NOT NULL COMMENT 'มิเตอร์ไฟใหม่',
  `meter_pu` int(11) NOT NULL COMMENT 'จำนวนหน่วย',
  `meter_ppu` int(11) NOT NULL COMMENT 'ค่าไฟต่อหน่วย',
  `meter_ptp` int(11) NOT NULL COMMENT 'รวมค่าไฟ',
  `typ_centric` int(11) NOT NULL COMMENT 'ค่าส่วนกลาง',
  `typ_wifi` int(11) NOT NULL COMMENT 'ค่าอินเตอร์เน็ต',
  `typ_vehicle` int(11) NOT NULL COMMENT 'ค่าที่จอดรถ',
  `typ_mulct` int(11) NOT NULL COMMENT 'ค่าปรับล่าช้า',
  `les_price` int(11) NOT NULL COMMENT 'ค่าเช่าห้อง',
  `net_pay` int(11) NOT NULL COMMENT 'จ่ายสุทธิ',
  `typ_doposit` int(11) NOT NULL DEFAULT 0 COMMENT 'คืนค่าประกัน',
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สถานะใบแจ้งหนี้',
  `slip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'หลักฐานการชำระเงิน',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'วันออกใบแจ้งหนี้',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `les_id`, `date`, `date_pay`, `pay_date`, `delay_date`, `meter_wo`, `meter_wn`, `meter_wu`, `meter_wpu`, `meter_wtp`, `meter_po`, `meter_pn`, `meter_pu`, `meter_ppu`, `meter_ptp`, `typ_centric`, `typ_wifi`, `typ_vehicle`, `typ_mulct`, `les_price`, `net_pay`, `typ_doposit`, `status`, `slip`, `created_at`, `updated_at`) VALUES
(123, 18, '2020-12-25', '2021-01-05 08:07:08', '2021-01-05', 0, 0, 5, 5, 30, 150, 0, 10, 10, 6, 60, 200, 0, 0, 0, 2000, 2410, 0, 'ชำระเงินแล้ว', 'slips/123-invSlip-1609834028.jpg', '2021-01-05 07:59:54', '2021-01-05 08:07:08'),
(124, 19, '2020-12-25', '2021-01-05 08:07:16', '2021-01-05', 0, 0, 5, 5, 30, 150, 0, 10, 10, 6, 60, 200, 0, 300, 0, 2200, 2910, 0, 'ชำระเงินแล้ว', 'slips/124-invSlip-1609834036.jpg', '2021-01-05 07:59:54', '2021-01-05 08:07:16'),
(125, 20, '2020-12-25', '2021-01-05 08:07:21', '2021-01-05', 0, 0, 5, 5, 30, 150, 0, 10, 10, 6, 60, 200, 150, 300, 0, 2300, 3160, 0, 'ชำระเงินแล้ว', 'slips/125-invSlip-1609834042.jpg', '2021-01-05 07:59:54', '2021-01-05 08:07:22'),
(126, 21, '2020-12-25', '2021-01-05 08:07:29', '2021-01-05', 0, 0, 5, 5, 30, 150, 0, 10, 10, 6, 60, 200, 0, 0, 0, 2500, 2910, 0, 'ชำระเงินแล้ว', 'slips/126-invSlip-1609834049.jpg', '2021-01-05 07:59:54', '2021-01-05 08:07:29'),
(127, 22, '2020-12-25', '2021-01-05 08:35:06', '2021-01-05', 0, 0, 5, 5, 30, 150, 0, 10, 10, 6, 60, 200, 0, 300, 0, 2000, 2710, 0, 'ชำระเงินแล้ว', 'slips/127-invSlip-1609835706.jpg', '2021-01-05 07:59:54', '2021-01-05 08:38:04'),
(153, 24, '2021-01-07', '2021-01-07 05:20:21', '2021-02-05', 0, 0, 5, 5, 30, 150, 0, 10, 10, 6, 60, 200, 0, 0, 0, 2000, 2410, 0, 'ชำระเงินแล้ว', 'slips/153-invSlip-1609996821.jpg', '2021-01-07 05:17:58', '2021-01-07 05:20:30'),
(154, 24, '2021-01-07', '2021-01-07 06:15:10', '2021-01-07', 0, 5, 15, 10, 30, 300, 10, 15, 5, 6, 30, 700, 0, 0, 0, 0, -1970, 3000, 'ชำระเงินแล้ว', NULL, '2021-01-07 06:15:10', '2021-01-07 06:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `leases`
--

CREATE TABLE `leases` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'รหัสเช่า',
  `rm_id` int(11) NOT NULL COMMENT 'รหัสห้องเช่า',
  `user_id` int(11) NOT NULL COMMENT 'รหัสห้องผู้เช่า',
  `idcard` varchar(17) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสบัตร',
  `date_start` date DEFAULT NULL COMMENT 'วันเช่า',
  `date_end` date DEFAULT NULL COMMENT 'ครบสัญญาเช่า',
  `vehicle` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ไม่มี' COMMENT 'พาหนะ',
  `vehicle_reg` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ไม่มี' COMMENT 'ทะเบียน',
  `number` int(11) DEFAULT NULL COMMENT 'ผู้อาศัย',
  `typ_wifi` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'ใช้wifi',
  `typ_vehicle` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'เช่าที่จอดรถ',
  `typ_price` int(11) NOT NULL COMMENT 'ค่าเช่าห้อง',
  `typ_booking` int(11) NOT NULL COMMENT 'ค่าจอง',
  `typ_doposit` int(11) NOT NULL COMMENT 'ค่ามัดจำ',
  `net_pay` int(11) DEFAULT NULL COMMENT 'รวมจ่ายสุทธิ',
  `meter_ws` int(11) DEFAULT NULL COMMENT 'มิเตอร์น้ำเริ่มต้น',
  `meter_ps` int(11) DEFAULT NULL COMMENT 'มิเตอร์ไฟเริ่มต้น',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานะเช่า',
  `bkg_slip` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานะเช่า',
  `idcard_doc` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สำเนาบัตร',
  `lease_doc` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สัญญา',
  `checkout` timestamp NULL DEFAULT NULL COMMENT 'วันแจ้งย้าย',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leases`
--

INSERT INTO `leases` (`id`, `rm_id`, `user_id`, `idcard`, `date_start`, `date_end`, `vehicle`, `vehicle_reg`, `number`, `typ_wifi`, `typ_vehicle`, `typ_price`, `typ_booking`, `typ_doposit`, `net_pay`, `meter_ws`, `meter_ps`, `status`, `bkg_slip`, `idcard_doc`, `lease_doc`, `checkout`, `created_at`, `updated_at`) VALUES
(18, 1, 2, '1-4801-00130-66-6', '2020-11-25', '2021-05-25', 'ไม่มี', 'ไม่มี', 1, 'no', 'no', 2000, 500, 3000, 4500, 0, 0, 'เช่าอยู่', 'slips/18-bkgSlip-1609815387.jpg', 'leases/18-CardCoppy-1609829423.pdf', 'leases/18-LeaseDoc-1609829455.pdf', NULL, '2021-01-05 02:56:27', '2021-01-05 06:50:55'),
(19, 2, 3, '1-4801-00130-11-1', '2020-11-25', '2021-05-25', 'รถยนต์', '6กพ-2458', 2, 'no', 'yes', 2200, 500, 3000, 5000, 0, 0, 'เช่าอยู่', 'slips/19-bkgSlip-1609815434.jpg', 'leases/19-CardCoppy-1609829360.pdf', 'leases/19-LeaseDoc-1609829397.pdf', NULL, '2021-01-05 02:57:14', '2021-01-05 06:49:57'),
(20, 3, 4, '1-4801-00130-22-2', '2020-11-25', '2021-05-25', 'ไม่มี', 'ไม่มี', 2, 'yes', 'yes', 2300, 500, 3000, 5250, 0, 0, 'เช่าอยู่', 'slips/20-bkgSlip-1609815464.jpg', 'leases/20-CardCoppy-1609829281.pdf', 'leases/20-LeaseDoc-1609829315.pdf', NULL, '2021-01-05 02:57:44', '2021-01-05 06:48:35'),
(21, 4, 5, '1-4801-00130-77-7', '2020-11-25', '2021-05-25', 'ไม่มี', 'ไม่มี', 2, 'no', 'no', 2500, 500, 3000, 5000, 0, 0, 'เช่าอยู่', 'slips/21-bkgSlip-1609815509.jpg', 'leases/21-CardCoppy-1609829211.pdf', 'leases/21-LeaseDoc-1609829257.pdf', NULL, '2021-01-05 02:58:29', '2021-01-05 06:47:37'),
(22, 9, 6, '1-4801-00130-88-8', '2020-11-25', '2021-05-25', 'รถยนต์', '6กพ-2555', 2, 'no', 'yes', 2000, 500, 3000, 4800, 0, 0, 'เช่าอยู่', 'slips/22-bkgSlip-1609815548.jpg', 'leases/22-CardCoppy-1609815687.pdf', 'leases/22-LeaseDoc-1609828814.pdf', NULL, '2021-01-05 02:59:07', '2021-01-05 06:40:14'),
(24, 13, 7, '1-4801-00130-55-5', '2020-10-30', '2021-07-07', 'ไม่มี', 'ไม่มี', 3, 'no', 'no', 2000, 500, 3000, 4500, 0, 0, 'ย้ายออก', 'slips/24-bkgSlip-1609996635.jpg', 'leases/24-CardCoppy-1609996658.pdf', NULL, '2021-09-01 07:15:46', '2021-01-07 05:17:15', '2021-01-07 06:15:10'),
(26, 13, 9, '1-4801-00135-88-8', '2021-01-25', NULL, 'ไม่มี', 'ไม่มี', NULL, 'no', 'no', 2000, 500, 3000, NULL, NULL, NULL, 'ยืนยันจอง', 'slips/26-bkgSlip-1610425387.jpg', NULL, NULL, NULL, '2021-01-12 04:23:07', '2021-01-12 04:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `maintenances`
--

CREATE TABLE `maintenances` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'รหัสแจ้งซ่อม',
  `rm_id` int(11) DEFAULT NULL COMMENT 'รหัสห้องแจ้ง',
  `date` date DEFAULT NULL COMMENT 'วันแจ้งซ่อม',
  `ready_date` datetime DEFAULT NULL COMMENT 'วันที่ต้องการซ่อม',
  `detail` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'รายละเอียด',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานะ',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT 'ค่าซ่อม',
  `date_done` timestamp NULL DEFAULT NULL COMMENT 'วันซ่อมเสร็จ',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'วันแจ้งซ่อม',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `maintenances`
--

INSERT INTO `maintenances` (`id`, `rm_id`, `date`, `ready_date`, `detail`, `status`, `price`, `date_done`, `created_at`, `updated_at`) VALUES
(14, 4, '2021-01-06', '2021-01-06 09:00:00', 'เปลี่ยนหลอดไฟในห้องน้ำ', 'ซ่อมเสร็จแล้ว', 50, '2021-01-06 03:02:09', '2021-01-06 01:50:44', '2021-01-06 03:02:09'),
(15, 1, '2021-01-06', '2021-01-06 09:20:00', 'ซ่อมประตูห้องน้ำ', 'ซ่อมเสร็จแล้ว', 500, '2021-01-06 03:02:04', '2021-01-06 02:20:53', '2021-01-06 03:02:04'),
(16, NULL, '2021-01-06', '2021-01-03 09:00:00', 'ทาสีประตูรั่วที่จอดรถ', 'ซ่อมเสร็จแล้ว', 1000, '2021-01-06 03:01:55', '2021-01-06 02:22:19', '2021-01-06 03:01:55'),
(17, 2, '2021-01-06', '2021-01-06 10:18:00', 'ทาสีห้องใหม่', 'ซ่อมเสร็จแล้ว', 1500, '2021-01-06 03:19:00', '2021-01-06 03:18:24', '2021-01-06 03:19:01'),
(18, 13, '2021-01-06', '2021-01-06 15:21:00', 'เปลี่ยนฝักบัวห้องน้ำ', 'ซ่อมเสร็จแล้ว', 200, '2021-01-06 09:03:55', '2021-01-06 08:21:09', '2021-01-06 09:03:55');

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
(4, '2020_09_06_162113_create_rooms_table', 1),
(5, '2020_09_06_162120_create_types_table', 1),
(6, '2020_09_06_162127_create_webconfigs_table', 1),
(7, '2020_09_06_162136_create_leases_table', 1),
(8, '2020_09_06_162143_create_invoices_table', 1),
(9, '2020_09_06_162156_create_maintenances_table', 1),
(10, '2020_09_06_162229_create_incomes_table', 1),
(11, '2020_10_22_170307_create_notices_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `detail` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `date`, `detail`, `photo`, `file`, `created_at`, `updated_at`) VALUES
(1, '2020-10-31 08:36:04', 'น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19', 'notices/1photo-1605165393.jpg', 'notices/1file-1605165001.pdf', '2020-10-31 08:36:04', '2020-11-12 07:16:33'),
(2, '2020-11-13 03:00:02', 'น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19 น้ำไม่ไหล วันที่ 18-19', '55', NULL, '2020-11-13 03:00:02', '2020-11-13 03:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'รหัสห้อง',
  `typ_id` int(11) NOT NULL COMMENT 'รหัสประเภท',
  `number` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เลขห้อง',
  `building` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ตึก',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานะ',
  `meter_wn` int(11) NOT NULL DEFAULT 0 COMMENT 'มิเตอร์น้ำล่าสุด',
  `meter_pn` int(11) NOT NULL DEFAULT 0 COMMENT 'มิเตอร์ไฟล่าสุด',
  `photo1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'photo1' COMMENT 'รูปห้อง1',
  `photo2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'photo2' COMMENT 'รูปห้อง2',
  `photo3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'photo3' COMMENT 'รูปห้อง3',
  `photo4` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'photo4' COMMENT 'รูปห้อง4',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `typ_id`, `number`, `building`, `status`, `meter_wn`, `meter_pn`, `photo1`, `photo2`, `photo3`, `photo4`, `created_at`, `updated_at`) VALUES
(1, 1, '101', 'A', 'เช่า', 5, 10, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2021-01-07 07:39:18'),
(2, 2, '102', 'A', 'เช่า', 5, 10, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2021-01-07 07:39:18'),
(3, 3, '103', 'A', 'เช่า', 5, 10, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2021-01-07 07:39:18'),
(4, 4, '104', 'A', 'เช่า', 5, 10, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2021-01-07 07:39:18'),
(5, 4, '105', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2021-01-02 19:41:40'),
(6, 2, '106', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(7, 3, '107', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2021-01-02 19:41:40'),
(8, 4, '108', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-12 14:53:12'),
(9, 1, '201', 'A', 'เช่า', 5, 10, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2021-01-07 07:39:18'),
(10, 2, '202', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-12 14:52:49'),
(11, 3, '203', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(12, 4, '204', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(13, 1, '205', 'A', 'จอง', 15, 15, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2021-01-12 04:23:07'),
(14, 2, '206', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(15, 3, '207', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(16, 4, '208', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(17, 1, '209', 'A', 'เช่า', 5, 10, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2021-01-07 07:39:18'),
(18, 2, '210', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(19, 3, '211', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(20, 4, '212', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(21, 1, '213', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(22, 2, '214', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(23, 3, '301', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(24, 4, '302', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(25, 1, '303', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(26, 2, '304', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(27, 3, '305', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(28, 4, '306', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(29, 1, '307', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:25'),
(30, 2, '308', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(31, 3, '309', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(32, 4, '310', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(33, 1, '311', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(34, 2, '312', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(35, 3, '313', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(36, 4, '314', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(37, 1, '401', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(38, 2, '402', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(39, 3, '403', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(40, 4, '404', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(41, 1, '405', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(42, 2, '406', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(43, 3, '407', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(44, 4, '408', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(45, 1, '409', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(46, 2, '410', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(47, 3, '411', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(48, 4, '412', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(49, 1, '413', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(50, 2, '414', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(51, 3, '501', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(52, 4, '502', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(53, 1, '503', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(54, 2, '504', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(55, 3, '505', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(56, 4, '506', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(57, 1, '507', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(58, 2, '508', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:26'),
(59, 3, '509', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(60, 4, '510', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(61, 1, '511', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(62, 2, '512', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(63, 3, '513', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(64, 4, '514', 'A', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(65, 1, '101', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(66, 2, '102', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(67, 3, '103', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(68, 4, '104', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(69, 1, '105', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(70, 2, '106', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(71, 3, '107', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(72, 4, '108', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(73, 1, '201', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(74, 2, '202', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(75, 3, '203', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(76, 4, '204', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(77, 1, '205', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(78, 2, '206', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(79, 3, '207', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(80, 4, '208', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(81, 1, '209', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(82, 2, '210', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(83, 3, '211', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(84, 4, '212', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:27'),
(85, 1, '213', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(86, 2, '214', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(87, 3, '301', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(88, 4, '302', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(89, 1, '303', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(90, 2, '304', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(91, 3, '305', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(92, 4, '306', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(93, 1, '307', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(94, 2, '308', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(95, 3, '309', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(96, 4, '310', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(97, 1, '311', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(98, 2, '312', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(99, 3, '313', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(100, 4, '314', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(101, 1, '401', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(102, 2, '402', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(103, 3, '403', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(104, 4, '404', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(105, 1, '405', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(106, 2, '406', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(107, 3, '407', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(108, 4, '408', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(109, 1, '409', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(110, 2, '410', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(111, 3, '411', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(112, 4, '412', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(113, 1, '413', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(114, 2, '414', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(115, 3, '501', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(116, 4, '502', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(117, 1, '503', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:28'),
(118, 2, '504', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:29'),
(119, 3, '505', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:29'),
(120, 4, '506', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:29'),
(121, 1, '507', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:29'),
(122, 2, '508', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:29'),
(123, 3, '509', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:29'),
(124, 4, '510', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:29'),
(125, 1, '511', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:29'),
(126, 2, '512', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:29'),
(127, 3, '513', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:29'),
(128, 4, '514', 'B', 'ว่าง', 0, 0, 'rooms/room1.jpeg', 'rooms/room2.jpeg', 'rooms/room3.jpeg', 'rooms/room4.jpeg', '2020-09-09 23:40:44', '2020-09-11 20:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'รหัสประเภท',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภท',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT 'ค่าเช่าห้อง',
  `water` int(11) NOT NULL DEFAULT 0 COMMENT 'ค่าน้ำต่อหน่วย',
  `power` int(11) NOT NULL DEFAULT 0 COMMENT 'ค่าไฟต่อหน่วย',
  `centric` int(11) NOT NULL DEFAULT 0 COMMENT 'ค่าส่วนกลาง',
  `wifi` int(11) NOT NULL DEFAULT 0 COMMENT 'ค่าอินเตอร์เน็ต',
  `vehicle` int(11) NOT NULL DEFAULT 0 COMMENT 'ค่าที่จอดรถ',
  `mulct` int(11) NOT NULL DEFAULT 0 COMMENT 'ค่าล่าช้าต่อวัน',
  `booking` int(11) NOT NULL DEFAULT 0 COMMENT 'ค่าจอง',
  `doposit` int(11) NOT NULL DEFAULT 0 COMMENT 'ค่ามัดจำ',
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'photo' COMMENT 'รูปภาพ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `price`, `water`, `power`, `centric`, `wifi`, `vehicle`, `mulct`, `booking`, `doposit`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'ธรรมดา', 2000, 30, 6, 200, 150, 300, 50, 500, 3000, 'types/typ1.jpeg', '2020-09-06 09:50:10', '2020-09-06 09:50:10'),
(2, 'เฟอร์นิเจอร์', 2200, 30, 6, 200, 150, 300, 50, 500, 3000, 'types/typ2.jpeg', '2020-09-06 09:50:10', '2020-09-06 09:50:10'),
(3, 'แอร์', 2300, 30, 6, 200, 150, 300, 50, 500, 3000, 'types/typ3.jpeg', '2020-09-06 09:50:10', '2020-09-06 09:50:10'),
(4, 'แอร์+เฟอร์นิเจอร์', 2500, 30, 6, 200, 150, 300, 50, 500, 3000, 'types/typ4.jpeg', '2020-09-06 09:50:10', '2020-09-06 09:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'photo',
  `role` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'guest',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'สมาชิกใหม่',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `age`, `gender`, `phone`, `photo`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'นาย มาลัยเพลส อพาร์ทเม้นท์', 'admin@gmail.com', 31, 'ชาย', '088-328-8235', 'users/cSH7iL94EtBvHyO2TOPFbWbXfm1bUceSkHvdXi9e.jpg', 'admin', 'ผู้ดูแลหอพัก', NULL, '$2y$10$hKt8EL6HWewzo.ztokLg1.Sl2ndW59czsbpTGWZgmRFybqjBtqBLW', 'IKLbqIxBt5XURwqJuKOcxpe42P263tCbzYTxCaD7RDjEYUuDy2t6VAEuLnRN', '2020-10-01 17:55:48', '2021-01-07 10:09:26'),
(2, 'นายประวิตร อยู่ดีมีสุข', 'user1@gmail.com', 52, 'ชาย', '088-328-1234', 'users/2Photo-1601575558.jpg', 'guest', 'สมาชิกเช่า', NULL, '$2y$10$LgBa2ziMJKlEpR/Oj5Ns7.3rZ24otUZp1gAvzUnbaDbf2i2w.7hb2', 'Yr5jZQvasWpUuTSwYrX63MtN4fXXM6Bo8fPvpnR6byx5Vp9MAJQxwqA5wxEI', '2020-10-01 17:55:48', '2021-01-05 06:50:23'),
(3, 'นายสมคิด อยู่ดีมีสุข', 'user2@gmail.com', 35, 'ชาย', '088-328-5678', 'users/10JGgC863k6OlcT1j7Az0W9WJjG6KulyW1OKXHWg.jpe', 'guest', 'สมาชิกเช่า', NULL, '$2y$10$LgBa2ziMJKlEpR/Oj5Ns7.3rZ24otUZp1gAvzUnbaDbf2i2w.7hb2', '5oWDmvTUvr9BARJcOOW0Wsy2G9yzWNUchnnKW54JmiFFjKjLVVewnltgdtRE', '2020-10-01 17:55:48', '2021-01-05 06:49:20'),
(4, 'นายวิษณุ อยู่ดีมีสุข', 'user3@gmail.com', 45, 'ชาย', '088-328-9874', 'users/10JGgC863k6OlcT1j7Az0W9WJjG6KulyW1OKXHWg.jpe', 'guest', 'สมาชิกเช่า', NULL, '$2y$10$LgBa2ziMJKlEpR/Oj5Ns7.3rZ24otUZp1gAvzUnbaDbf2i2w.7hb2', NULL, '2020-10-01 17:55:48', '2021-01-05 06:48:01'),
(5, 'นางสาวกัลยา อยู่ดีมีสุข', 'user4@gmail.com', 25, 'หญิง', '088-328-4569', 'users/5Photo-1601575632.jpg', 'guest', 'สมาชิกเช่า', NULL, '$2y$10$.mqCHdOIL2eEPn4UUfBDlut725cPI0XnQOfLZwMQt2reCZlosHjlG', 'iEXTHdNqTK6akmXBFXMfaXrk55KvRmc0Wi2dv9q6DG6UkZTGHtdbhl0S8Zgm', '2020-10-01 17:55:48', '2021-01-05 06:46:51'),
(6, 'นางสาวกนกวรรณ อยู่ดีมีสุข', 'user5@gmail.com', 34, 'หญิง', '088-328-2365', 'users/jQxO0QZvrkyFQu3THP0g3SKcwsPA3sYNIKz6v5BY.jpg', 'guest', 'สมาชิกเช่า', NULL, '$2y$10$LgBa2ziMJKlEpR/Oj5Ns7.3rZ24otUZp1gAvzUnbaDbf2i2w.7hb2', '3PGbNqzTD2oOV1qv8h7lHDUs5KU6mpOqVU6DA0EW6fNFULcg7xyULkzfEU2c', '2020-10-01 17:55:48', '2021-01-12 04:20:35'),
(7, 'นายอนุทิน อยู่ดีมีสุข', 'user6@gmail.com', 54, 'ชาย', '088-328-2547', 'users/7Photo-1609921698.jpg', 'guest', 'สมาชิกออกแล้ว', NULL, '$2y$10$LgBa2ziMJKlEpR/Oj5Ns7.3rZ24otUZp1gAvzUnbaDbf2i2w.7hb2', NULL, '2020-10-01 17:55:48', '2021-01-07 07:37:18'),
(8, 'นางสาวเทวัญ อยู่ดีมีสุข', 'user7@gmail.com', 45, 'ชาย', '088-328-3654', 'users/10JGgC863k6OlcT1j7Az0W9WJjG6KulyW1OKXHWg.jpe', 'guest', 'สมาชิกใหม่', NULL, '$2y$10$LgBa2ziMJKlEpR/Oj5Ns7.3rZ24otUZp1gAvzUnbaDbf2i2w.7hb2', NULL, '2020-10-01 17:55:48', '2021-01-06 10:14:51'),
(9, 'นางสาวมนัญญา  อยู่ดีมีสุข', 'user8@gmail.com', 35, 'หญิง', '088-328-2545', 'users/10JGgC863k6OlcT1j7Az0W9WJjG6KulyW1OKXHWg.jpe', 'guest', 'สมาชิกจอง', NULL, '$2y$10$LgBa2ziMJKlEpR/Oj5Ns7.3rZ24otUZp1gAvzUnbaDbf2i2w.7hb2', NULL, '2020-10-01 17:55:48', '2021-01-12 04:23:07'),
(10, 'นายธรรมนัส อยู่ดีมีสุข', 'user9@gmail.com', 57, 'ชาย', '088-328-5789', 'users/10JGgC863k6OlcT1j7Az0W9WJjG6KulyW1OKXHWg.jpe', 'guest', 'สมาชิกใหม่', NULL, '$2y$10$LgBa2ziMJKlEpR/Oj5Ns7.3rZ24otUZp1gAvzUnbaDbf2i2w.7hb2', NULL, '2020-10-01 17:55:48', '2021-01-06 10:15:09'),
(11, 'ศักดิ์สยาม อยู่ดีมีสุข', 'user10@gmail.com', 68, 'ชาย', '088-328-3246', 'users/10JGgC863k6OlcT1j7Az0W9WJjG6KulyW1OKXHWg.jpe', 'guest', 'สมาชิกใหม่', NULL, '$2y$10$LgBa2ziMJKlEpR/Oj5Ns7.3rZ24otUZp1gAvzUnbaDbf2i2w.7hb2', NULL, '2020-10-01 17:55:48', '2020-10-01 17:55:48'),
(12, 'พุทธิพงษ์ อยู่ดีมีสุข', 'user11@gmail.com', 51, 'ชาย', '088-328-8759', 'users/10JGgC863k6OlcT1j7Az0W9WJjG6KulyW1OKXHWg.jpe', 'guest', 'สมาชิกใหม่', NULL, '$2y$10$LgBa2ziMJKlEpR/Oj5Ns7.3rZ24otUZp1gAvzUnbaDbf2i2w.7hb2', NULL, '2020-10-01 17:55:48', '2020-10-01 17:55:48'),
(13, 'สนธิรัตน์  อยู่ดีมีสุข', 'user12@gmail.com', 36, 'ชาย', '088-328-2222', 'users/10JGgC863k6OlcT1j7Az0W9WJjG6KulyW1OKXHWg.jpe', 'guest', 'สมาชิกใหม่', NULL, '$2y$10$LgBa2ziMJKlEpR/Oj5Ns7.3rZ24otUZp1gAvzUnbaDbf2i2w.7hb2', NULL, '2020-10-01 17:55:48', '2020-10-01 17:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `webconfigs`
--

CREATE TABLE `webconfigs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `bbl` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'เลขบัญชี xxx-x-xxxxx-x ชื่่อบัญชี Apartment Management System',
  `bbl_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'banks/bbl_logo.png',
  `kbsnk` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'เลขบัญชี xxx-x-xxxxx-x ชื่่อบัญชี Apartment Management System',
  `kbsnk_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'banks/kbsnk_logo.png',
  `scb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'เลขบัญชี xxx-x-xxxxx-x ชื่่อบัญชี Apartment Management System',
  `scb_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'banks/scb_logo.png',
  `bay` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'เลขบัญชี xxx-x-xxxxx-x ชื่่อบัญชี Apartment Management System',
  `bay_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'banks/bay_logo.png',
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'photo',
  `photo1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'photo',
  `photo2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'photo',
  `photo3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'photo',
  `photo4` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'photo',
  `photo5` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'photo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `webconfigs`
--

INSERT INTO `webconfigs` (`id`, `title`, `website`, `address`, `bbl`, `bbl_logo`, `kbsnk`, `kbsnk_logo`, `scb`, `scb_logo`, `bay`, `bay_logo`, `logo`, `photo1`, `photo2`, `photo3`, `photo4`, `photo5`, `created_at`, `updated_at`) VALUES
(1, 'Malaipace', 'www.apartment.malaipace.com', 'หอพักมาลัยเพลส เลขที่ 30/13 หมู่ 3\r\n              ตำบล คลองหนึ่ง อำเภอ คลองหลวง จังหวัด ปทุมธานี 12120', 'เลขบัญชี 036-5-12345-6  ชื่่อบัญชี Apartment สาขา กรุงเทพมหานคร', 'webconfigs/bbl_logo.png', 'เลขบัญชี 036-5-12345-6  ชื่่อบัญชี Apartment สาขา กรุงเทพมหานคร', 'webconfigs/kbsnk_logo.png', 'เลขบัญชี 036-5-12345-6  ชื่่อบัญชี Apartment สาขา กรุงเทพมหานคร', 'webconfigs/scb_logo.png', 'เลขบัญชี 036-5-12345-6  ชื่่อบัญชี Apartment สาขา กรุงเทพมหานคร', 'webconfigs/bay_logo.png', 'webconfigs/logo.png', 'webconfigs/photo1-1599876854.jpeg', 'webconfigs/photo2-1599876855.jpeg', 'webconfigs/photo3-1599876855.jpeg', 'webconfigs/photo4-1599876856.jpeg', 'webconfigs/photo5-1599876856.jpeg', '2020-09-06 09:48:32', '2020-09-12 02:14:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leases`
--
ALTER TABLE `leases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `webconfigs`
--
ALTER TABLE `webconfigs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'รหัสใบแจ้งหนี้', AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `leases`
--
ALTER TABLE `leases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'รหัสเช่า', AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'รหัสแจ้งซ่อม', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'รหัสห้อง', AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภท', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `webconfigs`
--
ALTER TABLE `webconfigs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
