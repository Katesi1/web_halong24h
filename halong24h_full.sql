-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 09, 2026 lúc 10:11 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `halong24h_full`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'admin', 'Abcd@1234');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `amenity_categories`
--

CREATE TABLE `amenity_categories` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `amenity_categories`
--

INSERT INTO `amenity_categories` (`id`, `slug`, `name`, `icon`, `sort_order`) VALUES
(1, 'general', 'Chung', 'fa-star', 1),
(2, 'bedroom', 'Phòng ngủ', 'fa-bed', 2),
(3, 'bathroom', 'Phòng tắm', 'fa-shower', 3),
(4, 'kitchen', 'Bếp & Ăn uống', 'fa-utensils', 4),
(5, 'entertainment', 'Giải trí', 'fa-tv', 5),
(6, 'outdoor', 'Ngoài trời', 'fa-tree', 6),
(7, 'transport', 'Đi lại & Xe', 'fa-car', 7),
(8, 'safety', 'An ninh & An toàn', 'fa-shield-alt', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bedroom_layouts`
--

CREATE TABLE `bedroom_layouts` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `label` varchar(100) DEFAULT NULL COMMENT 'Phòng master, Phòng ngủ 1, ...',
  `bed_config` varchar(200) NOT NULL COMMENT '1 giường Kingsize 2m, 2 giường 1m6',
  `area` int(11) DEFAULT NULL COMMENT 'm²',
  `has_ensuite` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=có phòng tắm riêng',
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bedroom_layouts`
--

INSERT INTO `bedroom_layouts` (`id`, `room_id`, `label`, `bed_config`, `area`, `has_ensuite`, `sort_order`) VALUES
(1, 1, 'Phòng ngủ Master 1', '1 giường Kingsize 2m', 55, 1, 1),
(2, 1, 'Phòng ngủ Master 2', '1 giường Kingsize 2m', 50, 1, 2),
(3, 1, 'Phòng ngủ Master 3', '1 giường Kingsize 2m', 45, 1, 3),
(4, 1, 'Phòng ngủ Master 4', '1 giường Kingsize 2m', 40, 1, 4),
(5, 2, 'Phòng ngủ 1', '1 giường 1m8', NULL, 1, 1),
(6, 2, 'Phòng ngủ 2', '1 giường 1m8', NULL, 1, 2),
(7, 2, 'Phòng ngủ 3', '1 giường 1m8', NULL, 1, 3),
(8, 2, 'Phòng ngủ 4', '2 giường 1m6', NULL, 1, 4),
(9, 2, 'Phòng ngủ 5', '2 giường 1m5', NULL, 1, 5),
(10, 2, 'Phòng nhỏ', '1 giường 1m6', NULL, 0, 6),
(11, 3, 'Phòng ngủ Master', '1 giường 2m', NULL, 1, 1),
(12, 3, 'Phòng ngủ 2', '1 giường 1m8', NULL, 1, 2),
(13, 3, 'Phòng ngủ 3', '1 giường 1m8', NULL, 1, 3),
(14, 3, 'Phòng ngủ 4', '1 giường 1m8', NULL, 1, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `trans_id` varchar(200) DEFAULT NULL,
  `trans_amt` int(11) DEFAULT NULL,
  `trans_status` varchar(100) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` varchar(200) DEFAULT NULL,
  `rate_review` int(11) DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `booking_status`, `order_id`, `trans_status`, `rate_review`, `datentime`) VALUES
(1, 2, 1, '2025-12-20', '2025-12-22', 1, 'confirmed', 'ORD-20251220-001', 'success', 1, '2025-12-18 10:30:00'),
(2, 3, 3, '2026-01-05', '2026-01-07', 1, 'confirmed', 'ORD-20260105-002', 'success', 1, '2026-01-03 14:15:00'),
(3, 4, 4, '2026-01-10', '2026-01-12', 1, 'confirmed', 'ORD-20260110-003', 'success', 1, '2026-01-08 09:45:00'),
(4, 5, 1, '2026-01-15', '2026-01-18', 1, 'confirmed', 'ORD-20260115-004', 'success', 1, '2026-01-13 16:20:00'),
(5, 6, 3, '2026-02-01', '2026-02-03', 1, 'confirmed', 'ORD-20260201-005', 'success', 1, '2026-01-30 11:00:00'),
(6, 7, 2, '2026-02-10', '2026-02-14', 1, 'confirmed', 'ORD-20260210-006', 'success', 1, '2026-02-08 08:30:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buildings`
--

CREATE TABLE `buildings` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `short_name` varchar(100) DEFAULT NULL,
  `address` varchar(400) NOT NULL,
  `ward` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT 'Bãi Cháy',
  `city` varchar(100) DEFAULT 'Hạ Long, Quảng Ninh',
  `total_floors` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `gmap_url` varchar(500) DEFAULT NULL,
  `gmap_iframe` text DEFAULT NULL,
  `nearby_landmarks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`nearby_landmarks`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `buildings`
--

INSERT INTO `buildings` (`id`, `property_type_id`, `slug`, `name`, `short_name`, `address`, `ward`, `district`, `city`, `total_floors`, `description`, `gmap_url`, `gmap_iframe`, `nearby_landmarks`, `status`, `created_at`) VALUES
(1, 1, 'sun-grand-feria', 'Sun Grand City Feria Hạ Long', 'Sun Feria', 'Khu biệt thự Sun Grand City Feria, Bãi Cháy, Hạ Long', 'Bãi Cháy', 'Hạ Long', 'Quảng Ninh', NULL, 'Khu biệt thự ven biển cao cấp thuộc tổ hợp Sun Grand City Feria Hạ Long. Tọa lạc ngay trung tâm bãi tắm Bãi Cháy – bãi tắm đẹp nhất Miền Bắc, mang đến không gian nghỉ dưỡng riêng tư đẳng cấp với đầy đủ tiện ích cao cấp. Dự án nằm trong khuôn viên có hồ bơi, bãi biển, phố đi bộ và hàng loạt tiện ích ngoại khu phục vụ 24/7.', NULL, NULL, '[{\"name\":\"Bãi tắm Bãi Cháy\",\"distance\":\"Đối diện\",\"transport\":\"walk\"},{\"name\":\"Cảng tàu quốc tế Sun Group\",\"distance\":\"~1km\",\"transport\":\"walk\"},{\"name\":\"Sun World Ha Long Park\",\"distance\":\"~1km\",\"transport\":\"walk\"},{\"name\":\"Phố đi bộ\",\"distance\":\"~1km\",\"transport\":\"walk\"},{\"name\":\"Chợ hải sản Cái Dăm\",\"distance\":\"~1km\",\"transport\":\"drive\"},{\"name\":\"Beach Bar (Top Asia)\",\"distance\":\"200-300m\",\"transport\":\"walk\"},{\"name\":\"Nhà hàng hải sản\",\"distance\":\"<500m\",\"transport\":\"walk\"}]', 1, '2026-03-08 06:30:42'),
(2, 2, 'newlife', 'Chung cư Newlife Hạ Long', 'Newlife', 'Bãi Cháy, Hạ Long, Quảng Ninh', 'Bãi Cháy', 'Hạ Long', 'Quảng Ninh', NULL, 'Chung cư Newlife tọa lạc tại trung tâm du lịch Bãi Cháy – Hạ Long. Từ toà nhà có thể dễ dàng tiếp cận mọi điểm du lịch và vui chơi giải trí. Căn hộ sở hữu tầm view rộng ôm trọn thành phố biển và vịnh Hạ Long từ ban công riêng.', NULL, NULL, '[{\"name\":\"Chợ hải sản Cái Dăm\",\"distance\":\"300m\",\"transport\":\"walk\"},{\"name\":\"Bãi tắm Bãi Cháy\",\"distance\":\"700m\",\"transport\":\"walk\"},{\"name\":\"Quảng trường Sun & Bãi biển\",\"distance\":\"2km\",\"transport\":\"drive\"},{\"name\":\"Phố đi bộ Sunworld\",\"distance\":\"2km\",\"transport\":\"drive\"},{\"name\":\"Bến tàu du lịch\",\"distance\":\"3km\",\"transport\":\"drive\"},{\"name\":\"Ha Long Park / Công viên nước\",\"distance\":\"2.5km\",\"transport\":\"drive\"},{\"name\":\"Suối khoáng nóng Yoko Onsen\",\"distance\":\"15km\",\"transport\":\"drive\"},{\"name\":\"Bãi chèo SUP\",\"distance\":\"7km\",\"transport\":\"drive\"}]', 1, '2026-03-08 06:30:42'),
(3, 2, 'alacarte', 'À La Carte Ha Long Bay', 'Alcatel', 'Bán đảo 2, Khu đô thị Marina Hạ Long, Phường Hùng Thắng, Hạ Long, Quảng Ninh', 'Hùng Thắng', 'Hạ Long', 'Quảng Ninh', 41, 'Tòa tháp À La Carte Ha Long Bay (tên địa phương: Alcatel) là công trình căn hộ cao cấp nổi bật tại khu Marina Hạ Long. Toà nhà 41 tầng với 932 căn hộ sở hữu 100% view trực diện vịnh Hạ Long – một trong những kỳ quan thiên nhiên thế giới. Vị trí cách mặt biển chưa đến 200m, cư dân được tận hưởng không khí trong lành và tầm nhìn panorama không tỳ vết ngay từ ban công căn hộ.', NULL, NULL, '[{\"name\":\"Bãi biển\",\"distance\":\"<200m\",\"transport\":\"walk\"},{\"name\":\"Cảng tàu thăm vịnh\",\"distance\":\"Gần\",\"transport\":\"walk\"},{\"name\":\"Chợ đêm Hạ Long\",\"distance\":\"Gần\",\"transport\":\"walk\"},{\"name\":\"Nhà hàng & dịch vụ ven biển\",\"distance\":\"Xung quanh\",\"transport\":\"walk\"},{\"name\":\"Sun World Ha Long Park\",\"distance\":\"~5km\",\"transport\":\"drive\"},{\"name\":\"Đảo Tuần Châu\",\"distance\":\"~3.7km\",\"transport\":\"drive\"}]', 1, '2026-03-08 06:30:42'),
(4, 2, 'citadines', 'Citadines Marina Hạ Long', 'Citadines', 'Bán đảo 3, Khu Marina Hạ Long, Đại lộ Biển Hạ Long, Phường Bãi Cháy, Hạ Long, Quảng Ninh', 'Bãi Cháy', 'Hạ Long', 'Quảng Ninh', 26, 'Citadines Marina Hạ Long là căn hộ dịch vụ 5 sao được quản lý bởi The Ascott Limited. Toà nhà 26 tầng với 580 căn hộ nằm ngay mặt tiền đại lộ ven biển Hạ Long, sở hữu tầm view trực diện vịnh Hạ Long với những khối đá vôi hùng vĩ và làn nước ngọc lục bảo. Thiết kế hiện đại với đầy đủ tiện ích: bếp đầy đủ, máy giặt/sấy, hồ bơi trong nhà + rooftop ngoài trời view vịnh 360°, bar rooftop, nhà hàng và Kids Club.', NULL, NULL, '[{\"name\":\"Bãi biển (trực tiếp)\",\"distance\":\"Trực diện\",\"transport\":\"walk\"},{\"name\":\"Cầu tàu kayak & tàu du lịch\",\"distance\":\"Gần\",\"transport\":\"walk\"},{\"name\":\"Halong Marine Plaza Outlet\",\"distance\":\"Đi bộ\",\"transport\":\"walk\"},{\"name\":\"Chợ đêm Hạ Long\",\"distance\":\"Gần\",\"transport\":\"walk\"},{\"name\":\"Sun World Ha Long Park\",\"distance\":\"~5km\",\"transport\":\"drive\"},{\"name\":\"Đảo Tuần Châu\",\"distance\":\"~3.7km\",\"transport\":\"drive\"}]', 1, '2026-03-08 06:30:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(1, '1.jpg'),
(2, '2.jpg'),
(3, '3.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gmap` varchar(300) NOT NULL DEFAULT '',
  `pn1` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `fb` varchar(200) NOT NULL DEFAULT '',
  `insta` varchar(200) NOT NULL DEFAULT '',
  `tw` varchar(200) NOT NULL DEFAULT '',
  `iframe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'Bãi Cháy, Hạ Long, Quảng Ninh', 'https://maps.app.goo.gl/HaLong', '0912345678', 'info@halong24h.vn', 'https://facebook.com/halong24h', 'https://instagram.com/halong24h', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29842.0!2d107.045!3d20.951!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a5791b0f5d671%3A0xaa46a5ce6a88b4f5!2zQuG6o2kgQ2jDonksIEjhuqEgTG9uZywgUXXhuqNuZyBOaW5o!5e0!3m2!1sen!2s\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `icon` varchar(100) NOT NULL DEFAULT 'fa-check',
  `name` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL DEFAULT '',
  `is_common` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=mặc định tích cho tất cả phòng mới'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `facilities`
--

INSERT INTO `facilities` (`id`, `category_id`, `icon`, `name`, `description`, `is_common`) VALUES
(1, 1, 'fa-wifi', 'Wi-Fi miễn phí', 'Kết nối Internet tốc độ cao, miễn phí toàn khu vực.', 1),
(2, 1, 'fa-snowflake', 'Điều hoà', 'Hệ thống điều hoà nhiệt độ hiện đại.', 1),
(3, 1, 'fa-fire', 'Lò sưởi', 'Lò sưởi điện cho những ngày trời lạnh.', 0),
(4, 1, 'fa-bottle-water', 'Nước suối miễn phí', 'Nước suối, trà và cà phê miễn phí.', 0),
(5, 1, 'fa-mug-hot', 'Trà & Cà phê', 'Trà và cà phê miễn phí tại phòng.', 0),
(6, 2, 'fa-bed', 'Giường Kingsize (2m)', 'Giường kingsize 2m sang trọng, đệm cao cấp.', 0),
(7, 2, 'fa-bed', 'Giường Queen (1m8)', 'Giường 1m8, nệm thoải mái.', 0),
(8, 2, 'fa-bed', 'Giường đôi (1m6)', 'Giường đôi 1m6.', 0),
(9, 2, 'fa-lock', 'Két an toàn', 'Két an toàn trong phòng.', 0),
(10, 3, 'fa-bath', 'Bồn tắm', 'Bồn tắm thư giãn đầy đủ tiện nghi.', 0),
(11, 3, 'fa-shower', 'Vòi sen', 'Vòi sen nước nóng lạnh.', 1),
(12, 3, 'fa-pump-soap', 'Đồ dùng phòng tắm', 'Dầu gội, sữa tắm, khăn tắm, khăn mặt, bàn chải, kem đánh răng.', 1),
(13, 3, 'fa-wind', 'Máy sấy tóc', 'Máy sấy tóc chuyên dụng.', 1),
(14, 3, 'fa-sun', 'Đèn sưởi phòng tắm', 'Đèn sưởi hồng ngoại trong phòng tắm.', 0),
(15, 4, 'fa-fire-burner', 'Bếp từ', 'Bếp từ đôi, có đủ nồi niêu.', 1),
(16, 4, 'fa-box-archive', 'Tủ lạnh', 'Tủ lạnh lớn (≥200L).', 1),
(17, 4, 'fa-bullseye', 'Lò vi sóng', 'Lò vi sóng đa năng.', 1),
(18, 4, 'fa-mug-hot', 'Ấm siêu tốc', 'Ấm điện siêu tốc.', 1),
(19, 4, 'fa-bowl-rice', 'Nồi cơm điện', 'Nồi cơm điện.', 1),
(20, 4, 'fa-utensils', 'Bát đũa & dụng cụ', 'Đầy đủ bát đũa, dao, thớt, nồi cho nhiều người.', 1),
(21, 4, 'fa-fire', 'Bếp nướng BBQ', 'Bếp nướng BBQ ngoài trời.', 0),
(22, 4, 'fa-pot-food', 'Nồi lẩu', 'Nồi lẩu điện.', 0),
(23, 4, 'fa-fan', 'Hút mùi', 'Máy hút mùi bếp.', 0),
(24, 5, 'fa-tv', 'Smart TV', 'Smart TV màn hình lớn (≥50 inch).', 1),
(25, 5, 'fa-music', 'Loa kéo Karaoke', 'Loa kéo karaoke giải trí.', 0),
(26, 5, 'fa-gamepad', 'Máy chơi game', 'Máy chơi game console.', 0),
(27, 6, 'fa-person-swimming', 'Bể bơi riêng', 'Bể bơi riêng tư trong khuôn viên villa/căn hộ.', 0),
(28, 6, 'fa-water', 'Bể tạo sóng', 'Bể bơi tạo sóng đặc biệt.', 0),
(29, 6, 'fa-umbrella', 'Mái che bể bơi', 'Bể bơi có mái che, dùng được cả khi trời mưa.', 0),
(30, 6, 'fa-tree', 'Sân vườn', 'Không gian sân vườn xanh mát, thoáng đãng.', 0),
(31, 6, 'fa-chair', 'Bàn ghế ngoài trời', 'Bộ bàn ghế ăn/nghỉ ngoài trời.', 0),
(32, 6, 'fa-umbrella-beach', 'Ban công/Sân thượng', 'Ban công hoặc sân thượng riêng.', 0),
(33, 7, 'fa-square-parking', 'Đỗ xe miễn phí', 'Bãi đỗ xe ô tô miễn phí trong khuôn viên.', 0),
(34, 8, 'fa-camera', 'Camera an ninh', 'Hệ thống camera an ninh 24/7.', 0),
(35, 8, 'fa-door-closed', 'Khoá thẻ điện tử', 'Hệ thống khoá cửa thẻ từ hoặc mã số.', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(1, 'Phòng Ngủ'),
(2, 'Ban Công'),
(3, 'Nhà Bếp'),
(4, 'Ghế Sofa'),
(5, 'View Biển'),
(6, 'View Phố'),
(7, 'Sân Vườn'),
(8, 'Bể Bơi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `paid_services`
--

CREATE TABLE `paid_services` (
  `id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `price_min` int(11) DEFAULT NULL,
  `price_max` int(11) DEFAULT NULL,
  `price_unit` varchar(50) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `paid_services`
--

INSERT INTO `paid_services` (`id`, `slug`, `name`, `description`, `price_min`, `price_max`, `price_unit`, `icon`, `sort_order`, `status`) VALUES
(1, 'cooking', 'Thuê nấu ăn theo Set Menu', 'Đầu bếp đến nấu theo set menu thoả thuận tại villa/căn hộ.', NULL, NULL, '/bữa', 'fa-hat-chef', 1, 1),
(2, 'bbq-setup', 'Setup tiệc BBQ', 'Setup bàn tiệc BBQ ngoài trời, chuẩn bị đầy đủ đồ nướng.', NULL, NULL, '/lần', 'fa-fire', 2, 1),
(3, 'birthday-setup', 'Setup sinh nhật / sự kiện', 'Trang trí, setup tiệc sinh nhật hoặc sự kiện theo yêu cầu.', NULL, NULL, '/lần', 'fa-cake-candles', 3, 1),
(4, 'cleaning', 'Dọn dẹp sau bữa ăn', 'Dọn dẹp bát đĩa, vệ sinh bếp và khu ăn uống sau bữa ăn.', 500000, 1000000, '/lần', 'fa-broom', 4, 1),
(5, 'grocery', 'Đi chợ hộ', 'Mua sắm thực phẩm, hải sản tươi sống tại chợ theo yêu cầu.', NULL, NULL, '/lần', 'fa-basket-shopping', 5, 1),
(6, 'early-checkin', 'Check-in sớm', 'Nhận phòng trước 14h00, tuỳ khả năng hỗ trợ.', 250000, NULL, '/giờ', 'fa-clock', 6, 1),
(7, 'late-checkout', 'Check-out muộn', 'Trả phòng sau 12h00, tuỳ khả năng hỗ trợ.', 250000, NULL, '/giờ', 'fa-clock', 7, 1),
(8, 'transport', 'Đặt xe / Đưa đón', 'Dịch vụ đặt xe hoặc đưa đón sân bay, bến tàu.', NULL, NULL, '/chuyến', 'fa-car', 8, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `property_types`
--

CREATE TABLE `property_types` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `property_types`
--

INSERT INTO `property_types` (`id`, `slug`, `name`, `icon`, `sort_order`) VALUES
(1, 'villa', 'Villa', 'fa-house', 1),
(2, 'homestay', 'Homestay', 'fa-building', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rating_review`
--

CREATE TABLE `rating_review` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(500) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rating_review`
--

INSERT INTO `rating_review` (`sr_no`, `booking_id`, `room_id`, `user_id`, `rating`, `review`, `seen`, `datentime`) VALUES
(1, 1, 1, 2, 5, 'Gia đình mình vừa có chuyến nghỉ dưỡng 3 ngày 2 đêm tại villa và thực sự rất hài lòng. Villa rộng rãi với 4 phòng ngủ, đủ chỗ cho cả đại gia đình 10 người. Bể bơi ngoài trời siêu rộng, bọn trẻ con tắm cả ngày không chán. Phòng ốc sạch sẽ, chăn ga gối đệm thơm tho. Từ ban công nhìn ra được biển, buổi sáng ngắm bình minh cực kỳ thơ mộng. Bếp đầy đủ tiện nghi, cả nhà tự nấu hải sản mua ở chợ Hạ Long. Chủ nhà rất nhiệt tình hướng dẫn. Chắc chắn sẽ quay lại!', 1, '2025-12-23 09:15:00'),
(2, 2, 3, 3, 5, 'Mình và bạn gái đặt penthouse tầng 27, view toàn cảnh vịnh Hạ Long và không thể tin được mắt mình khi mở cửa bước vào. Căn hộ rộng rãi, nội thất sang trọng, phòng khách có cửa kính lớn từ sàn đến trần nhìn thẳng ra vịnh. Buổi tối đứng ở ban công ngắm thành phố lên đèn, xa xa là những con du thuyền sáng rực trên vịnh, lãng mạn vô cùng. Phòng ngủ sạch sẽ, ga trải giường trắng muốt. Vị trí rất thuận tiện, đi bộ ra bãi biển chỉ 5 phút. Xứng đáng từng đồng!', 1, '2026-01-08 17:30:00'),
(3, 3, 4, 4, 4, 'Nhóm 8 đứa bọn mình thuê căn hộ ở Newlife cho chuyến đi Hạ Long cuối tuần. Căn hộ nằm trên tầng cao nên view cực đỉnh, nhìn thẳng ra biển Bãi Cháy. Phòng decor xinh xắn, tone trắng rất hợp chụp ảnh. Chủ homestay siêu thân thiện, tư vấn lịch trình đi chơi rất chi tiết. Phòng sạch sẽ, khăn tắm đầy đủ, có cả máy giặt riêng rất tiện. Điểm trừ nhỏ là hơi khó tìm đường vào lần đầu. Nhưng nhìn chung với giá này thì quá ổn, nhất định sẽ đặt lại!', 1, '2026-01-13 14:20:00'),
(4, 4, 1, 5, 5, 'Vợ chồng mình cùng 2 con nhỏ vừa nghỉ tại villa và đây là một trong những chuyến đi đáng nhớ nhất. Villa có sân vườn rộng, bọn nhỏ chạy nhảy thỏa thích. Bể bơi được chia khu riêng cho trẻ em với mực nước nông, rất yên tâm. Phòng ngủ thoáng mát, sạch sẽ. Bếp trang bị đủ từ bếp từ, lò vi sóng đến nồi cơm điện, rất tiện cho gia đình có con nhỏ. Bãi cát trắng ngay trước villa, chiều chiều cả nhà ra chơi cát ngắm hoàng hôn. Chủ villa còn chuẩn bị sẵn bộ đồ BBQ. Rất phù hợp cho gia đình!', 1, '2026-01-19 10:45:00'),
(5, 5, 3, 6, 4, 'Hai vợ chồng mình chọn căn penthouse ở Newlife để kỷ niệm ngày cưới. View từ phòng nhìn ra vịnh Hạ Long đẹp mê hồn, nhất là lúc bình minh, ánh nắng vàng chiếu lên những hòn đảo đá vôi thật sự như tranh vẽ. Phòng rất ấm cúng, sạch sẽ, có bồn tắm nhìn ra biển. Chủ nhà để sẵn trà và cà phê, sáng dậy ngồi ban công ngắm vịnh thì tuyệt vời. Xung quanh có Sun World, chợ đêm Bãi Cháy đi bộ được, rất thuận tiện. Trải nghiệm rất tuyệt, sẽ giới thiệu cho bạn bè!', 1, '2026-02-04 16:00:00'),
(6, 6, 2, 7, 5, 'Dịp Tết vừa rồi cả đại gia đình 15 người thuê nguyên căn villa lớn 6 phòng ngủ để nghỉ dưỡng 4 ngày. Phòng nào cũng rộng rãi, sạch sẽ và có toilet riêng. Phòng khách siêu rộng, cả nhà ngồi quây quần đông đủ vẫn thoải mái. Bể bơi nước trong vắt, được vệ sinh hàng ngày. Khu BBQ ngoài trời rộng rãi, tối tổ chức tiệc nướng hải sản rất vui. View nhìn xuống biển đẹp, không khí trong lành. Chủ nhà hướng dẫn chi tiết qua Zalo, còn đặt giúp tour du thuyền giá ưu đãi. Cả nhà ai cũng khen, chắc chắn sẽ quay lại mỗi dịp lễ Tết!', 1, '2026-02-15 11:30:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) DEFAULT NULL COMMENT 'FK → property_types',
  `room_type_id` int(11) DEFAULT NULL COMMENT 'FK → room_types',
  `building_id` int(11) DEFAULT NULL COMMENT 'FK → buildings',
  `view_type_id` int(11) DEFAULT NULL COMMENT 'FK → view_types',
  `name` varchar(150) NOT NULL,
  `code` varchar(50) DEFAULT NULL COMMENT 'Mã căn: M3-26, C603, 2701B',
  `slug` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `tagline` varchar(300) DEFAULT NULL COMMENT 'Slogan hiển thị trên card',
  `bedroom_count` int(11) DEFAULT NULL,
  `bed_count` int(11) DEFAULT NULL,
  `bathroom_count` int(11) DEFAULT NULL,
  `wc_count` int(11) DEFAULT NULL,
  `area` int(11) DEFAULT NULL COMMENT 'Diện tích m² (hoặc min)',
  `area_max` int(11) DEFAULT NULL COMMENT 'Diện tích tối đa (nếu villa có range)',
  `floor` varchar(50) DEFAULT NULL COMMENT 'Tầng (homestay)',
  `adult` int(11) NOT NULL DEFAULT 2 COMMENT 'Tương thích: =standard_adults',
  `children` int(11) NOT NULL DEFAULT 0 COMMENT 'Tương thích: =standard_children',
  `standard_adults` int(11) DEFAULT NULL COMMENT 'Tiêu chuẩn người lớn',
  `standard_children` int(11) DEFAULT NULL COMMENT 'Tiêu chuẩn trẻ em',
  `free_children_age` int(11) DEFAULT 6 COMMENT 'Trẻ < N tuổi miễn phí',
  `max_guests` int(11) DEFAULT NULL COMMENT 'Tổng khách tối đa sau phụ thu',
  `surcharge_adult_price` int(11) DEFAULT 250000 COMMENT 'đ/người/đêm',
  `surcharge_adult_from_age` int(11) DEFAULT 12 COMMENT 'Từ N tuổi = người lớn',
  `surcharge_child_price` int(11) DEFAULT 150000 COMMENT 'đ/trẻ/đêm',
  `surcharge_child_age_min` int(11) DEFAULT 6,
  `surcharge_child_age_max` int(11) DEFAULT 11,
  `checkin_time` time DEFAULT '14:00:00',
  `checkout_time` time DEFAULT '12:00:00',
  `extra_hour_fee` int(11) DEFAULT 500000 COMMENT 'Phụ thu thêm giờ đ/giờ',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT 'Giá ngày thường',
  `price_weekend` int(11) DEFAULT NULL COMMENT 'Giá cuối tuần',
  `price_holiday` int(11) DEFAULT NULL COMMENT 'Giá lễ/cao điểm',
  `deposit_amount` int(11) DEFAULT 0 COMMENT 'Tiền cọc tài sản',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`id`, `property_type_id`, `room_type_id`, `building_id`, `view_type_id`, `name`, `code`, `slug`, `description`, `tagline`, `bedroom_count`, `bed_count`, `bathroom_count`, `wc_count`, `area`, `area_max`, `floor`, `adult`, `children`, `standard_adults`, `standard_children`, `free_children_age`, `max_guests`, `surcharge_adult_price`, `surcharge_adult_from_age`, `surcharge_child_price`, `surcharge_child_age_min`, `surcharge_child_age_max`, `checkin_time`, `checkout_time`, `extra_hour_fee`, `price`, `price_weekend`, `price_holiday`, `deposit_amount`, `status`, `removed`) VALUES
(1, 1, 6, 1, 1, 'Amanda Villa Hạ Long', 'M3-26', 'amanda-villa-ha-long-m3-26', 'Villa 4 phòng ngủ master sang trọng, mỗi phòng diện tích 40–60m² với giường Kingsize 2m, 4 nhà tắm riêng và 5 WC đầy đủ đồ dùng. Phòng bếp đầy đủ tiện nghi, phòng khách Smart TV 50 inch. Bể bơi riêng tạo sóng đặc biệt, loa kéo karaoke và đầy đủ mọi tiện nghi cho kỳ nghỉ hoàn hảo.', 'Villa biển 4PN | Bể bơi tạo sóng | Trung tâm Bãi Cháy', 4, 6, 4, 5, 40, 60, NULL, 10, 4, 10, 4, 6, 20, 250000, 11, 150000, 6, 10, '14:00:00', '12:00:00', 500000, 0, NULL, NULL, 0, 1, 0),
(2, 1, 7, 1, 4, 'Sun Feria C603', 'C603', 'sun-feria-c603', '6 phòng ngủ (5 phòng chính + 1 phòng nhỏ) với 8 giường lớn, 5 WC riêng + 1 WC chung. Không gian bếp mở rộng rãi, bể bơi riêng ngoài vườn có mái che, sân vườn xanh mát. Miễn phí: nước suối, trà cà phê, BBQ, karaoke. Lý tưởng cho chuyến du lịch nhóm hoặc kỳ nghỉ đáng nhớ tại Hạ Long.', 'Villa 6PN | Bể bơi mái che | Sân vườn riêng | Bãi Cháy', 6, 8, 5, 6, 72, NULL, NULL, 12, 6, 12, 6, 6, 25, 250000, 12, 150000, 7, 11, '14:00:00', '12:00:00', 500000, 0, NULL, NULL, 0, 1, 0),
(3, 2, 5, 2, 1, 'Penthouse 4 Ngủ Newlife Hạ Long', '2701B', 'penthouse-4pn-newlife-ha-long', 'Căn Penthouse sang trọng, đẳng cấp tại tầng 27 toà B chung cư Newlife Hạ Long. 4 phòng ngủ (1 giường 2m phòng master + 3 giường 1m8), 3 phòng tắm riêng, phòng khách Smart TV, bếp đầy đủ tiện nghi (bếp từ, tủ lạnh, lò vi sóng, bếp lẩu). Ban công thoáng mát, view biển và thành phố tuyệt đẹp.', 'Penthouse tầng 27 | View biển & thành phố | Newlife Hạ Long', 4, 4, 3, 3, 64, NULL, 'Tầng 27, Toà B', 8, 4, 8, 4, 6, NULL, 150000, 11, 100000, 6, 10, '14:00:00', '12:00:00', 250000, 0, NULL, NULL, 1000000, 1, 0),
(4, 2, 4, 2, 3, 'Căn hộ 3 Phòng Ngủ Newlife', NULL, 'can-ho-3pn-newlife', 'Căn hộ 3 phòng ngủ thiết kế khéo léo tối ưu hóa không gian sinh hoạt. Phòng khách rộng rãi, ban công riêng với tầm view ôm trọn thành phố biển Hạ Long. Đầy đủ thiết bị bếp hiện đại. Chỉ 5 phút đi bộ đến chợ hải sản Cái Dăm.', 'Căn hộ 3PN | View phố biển | Newlife Hạ Long', 3, 3, 2, 2, 72, NULL, NULL, 6, 3, 6, 3, 6, 7, 150000, 12, 100000, 6, 11, '14:00:00', '12:00:00', 250000, 0, NULL, NULL, 0, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_amenities`
--

CREATE TABLE `room_amenities` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `is_free` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=miễn phí, 0=trả phí',
  `note` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_amenities`
--

INSERT INTO `room_amenities` (`id`, `room_id`, `facility_id`, `is_free`, `note`) VALUES
(1, 1, 1, 1, NULL),
(2, 1, 2, 1, NULL),
(3, 1, 3, 1, NULL),
(4, 1, 11, 1, NULL),
(5, 1, 12, 1, NULL),
(6, 1, 13, 1, NULL),
(7, 1, 14, 1, NULL),
(8, 1, 10, 1, NULL),
(9, 1, 24, 1, NULL),
(10, 1, 15, 1, NULL),
(11, 1, 16, 1, NULL),
(12, 1, 17, 1, NULL),
(13, 1, 18, 1, NULL),
(14, 1, 20, 1, NULL),
(15, 1, 21, 1, NULL),
(16, 1, 27, 1, NULL),
(17, 1, 25, 1, NULL),
(18, 1, 30, 1, NULL),
(19, 1, 32, 1, NULL),
(20, 2, 1, 1, NULL),
(21, 2, 2, 1, NULL),
(22, 2, 4, 1, NULL),
(23, 2, 5, 1, NULL),
(24, 2, 12, 1, NULL),
(25, 2, 13, 1, NULL),
(26, 2, 24, 1, NULL),
(27, 2, 15, 1, NULL),
(28, 2, 16, 1, NULL),
(29, 2, 18, 1, NULL),
(30, 2, 19, 1, NULL),
(31, 2, 20, 1, NULL),
(32, 2, 22, 1, NULL),
(33, 2, 23, 1, NULL),
(34, 2, 21, 1, NULL),
(35, 2, 25, 1, NULL),
(36, 2, 26, 1, NULL),
(37, 2, 28, 1, NULL),
(38, 2, 29, 1, NULL),
(39, 2, 30, 1, NULL),
(40, 2, 32, 1, NULL),
(41, 3, 1, 1, NULL),
(42, 3, 2, 1, NULL),
(43, 3, 11, 1, NULL),
(44, 3, 12, 1, NULL),
(45, 3, 13, 1, NULL),
(46, 3, 24, 1, NULL),
(47, 3, 15, 1, NULL),
(48, 3, 16, 1, NULL),
(49, 3, 17, 1, NULL),
(50, 3, 18, 1, NULL),
(51, 3, 19, 1, NULL),
(52, 3, 20, 1, NULL),
(53, 3, 22, 1, NULL),
(54, 3, 31, 1, NULL),
(55, 4, 1, 1, NULL),
(56, 4, 2, 1, NULL),
(57, 4, 11, 1, NULL),
(58, 4, 12, 1, NULL),
(59, 4, 13, 1, NULL),
(60, 4, 24, 1, NULL),
(61, 4, 15, 1, NULL),
(62, 4, 16, 1, NULL),
(63, 4, 18, 1, NULL),
(64, 4, 19, 1, NULL),
(65, 4, 20, 1, NULL),
(66, 4, 31, 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(11, 4, 1),
(12, 4, 2),
(13, 4, 5),
(14, 4, 13),
(15, 4, 15),
(16, 4, 17),
(17, 4, 18),
(18, 4, 19),
(19, 4, 21),
(20, 4, 22),
(21, 4, 23),
(22, 4, 25),
(23, 4, 35),
(34, 1, 1),
(35, 1, 2),
(36, 1, 5),
(37, 1, 6),
(38, 1, 10),
(39, 1, 13),
(40, 1, 14),
(41, 1, 21),
(42, 1, 25),
(43, 1, 33);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(1, 4, 2),
(2, 4, 6),
(3, 2, 7),
(4, 3, 8),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=ảnh chính',
  `sort_order` int(11) DEFAULT 0,
  `caption` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`, `sort_order`, `caption`) VALUES
(4, 1, 'IMG_1772982276_6750.jpg', 0, 0, NULL),
(5, 1, 'IMG_1772982326_6202.jpg', 0, 0, NULL),
(6, 1, 'IMG_1772982330_9053.jpg', 0, 0, NULL),
(7, 1, 'IMG_1772983041_5958.jpg', 0, 0, NULL),
(8, 1, 'IMG_1772983049_3070.jpg', 0, 0, NULL),
(9, 1, 'IMG_1772983057_5368.jpg', 1, 0, NULL),
(10, 1, 'IMG_1772983063_8584.jpg', 0, 0, NULL),
(11, 1, 'IMG_1772983068_5119.jpg', 0, 0, NULL),
(12, 1, 'IMG_1772983073_4597.jpg', 0, 0, NULL),
(13, 1, 'IMG_1772983077_3359.jpg', 0, 0, NULL),
(14, 1, 'IMG_1772983082_1990.jpg', 0, 0, NULL),
(15, 1, 'IMG_1772983085_1872.jpg', 0, 0, NULL),
(16, 2, 'IMG_1772985836_7430.jpg', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_paid_services`
--

CREATE TABLE `room_paid_services` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `price_override_min` int(11) DEFAULT NULL,
  `price_override_max` int(11) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_paid_services`
--

INSERT INTO `room_paid_services` (`id`, `room_id`, `service_id`, `price_override_min`, `price_override_max`, `note`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL),
(3, 1, 4, NULL, NULL, NULL),
(4, 2, 1, NULL, NULL, NULL),
(5, 2, 2, NULL, NULL, NULL),
(6, 2, 3, NULL, NULL, NULL),
(7, 2, 4, NULL, NULL, NULL),
(8, 2, 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bedroom_count` int(11) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_types`
--

INSERT INTO `room_types` (`id`, `property_type_id`, `slug`, `name`, `bedroom_count`, `sort_order`) VALUES
(1, 2, 'studio', 'Studio', 0, 1),
(2, 2, '1pn', '1 Phòng ngủ', 1, 2),
(3, 2, '2pn', '2 Phòng ngủ', 2, 3),
(4, 2, '3pn', '3 Phòng ngủ', 3, 4),
(5, 2, 'penthouse', 'Penthouse', NULL, 5),
(6, 1, '4pn', 'Villa 4 Phòng ngủ', 4, 10),
(7, 1, '5pn', 'Villa 5 Phòng ngủ', 5, 11),
(8, 1, '6pn', 'Villa 6 Phòng ngủ', 6, 12),
(9, 1, '7pn', 'Villa 7 Phòng ngủ', 7, 13),
(10, 1, '8pn', 'Villa 8 Phòng ngủ', 8, 14),
(11, 1, '9pn', 'Villa 9 Phòng ngủ', 9, 15),
(12, 1, '10pn', 'Villa 10 Phòng ngủ', 10, 16),
(13, 1, '11pn', 'Villa 11 Phòng ngủ', 11, 17),
(14, 1, '12pn', 'Villa 12 Phòng ngủ', 12, 18);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `site_about` varchar(500) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `shutdown` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'HaLong24h', 'HaLong24h - Nền tảng đặt phòng Villa & Homestay cao cấp tại Hạ Long, Quảng Ninh. Chúng tôi cung cấp đa dạng lựa chọn từ Villa biển sang trọng tại Sun Grand City Feria đến Homestay, Penthouse view vịnh Hạ Long tại các toà nhà cao cấp. Trải nghiệm nghỉ dưỡng đẳng cấp chỉ với vài cú nhấp chuột!', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL DEFAULT '',
  `phonenum` varchar(100) NOT NULL DEFAULT '',
  `pincode` int(11) NOT NULL DEFAULT 0,
  `dob` date NOT NULL DEFAULT '2000-01-01',
  `profile` varchar(100) NOT NULL DEFAULT 'avatar-default.png',
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `status`) VALUES
(2, 'Nguyễn Thị Minh Trang', 'minhtrang.nguyen@gmail.com', 'Hà Nội', '0912345678', 0, '1990-05-15', 'avatar-default.png', '$2y$10$YWVmMjRiZDdhYjYyMGJlZuDqGqyIaGMRxRLhGFE4Zmh3NzdiNGFh', 1, 1),
(3, 'Trần Đức Huy', 'duchuy.tran@gmail.com', 'Hải Phòng', '0987654321', 0, '1995-08-20', 'avatar-default.png', '$2y$10$YWVmMjRiZDdhYjYyMGJlZuDqGqyIaGMRxRLhGFE4Zmh3NzdiNGFh', 1, 1),
(4, 'Lê Hoàng Anh', 'hoanganh.le@gmail.com', 'Hà Nội', '0901234567', 0, '1998-03-10', 'avatar-default.png', '$2y$10$YWVmMjRiZDdhYjYyMGJlZuDqGqyIaGMRxRLhGFE4Zmh3NzdiNGFh', 1, 1),
(5, 'Phạm Quốc Đạt', 'quocdat.pham@gmail.com', 'TP. Hồ Chí Minh', '0978123456', 0, '1988-11-25', 'avatar-default.png', '$2y$10$YWVmMjRiZDdhYjYyMGJlZuDqGqyIaGMRxRLhGFE4Zmh3NzdiNGFh', 1, 1),
(6, 'Nguyễn Mai Phương', 'maiphuong.nguyen@gmail.com', 'Đà Nẵng', '0965432187', 0, '1993-07-08', 'avatar-default.png', '$2y$10$YWVmMjRiZDdhYjYyMGJlZuDqGqyIaGMRxRLhGFE4Zmh3NzdiNGFh', 1, 1),
(7, 'Đỗ Thành Sơn', 'thanhson.do@gmail.com', 'Quảng Ninh', '0943216789', 0, '1985-01-30', 'avatar-default.png', '$2y$10$YWVmMjRiZDdhYjYyMGJlZuDqGqyIaGMRxRLhGFE4Zmh3NzdiNGFh', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `view_types`
--

CREATE TABLE `view_types` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `view_types`
--

INSERT INTO `view_types` (`id`, `slug`, `name`, `icon`) VALUES
(1, 'sea', 'View Biển', 'fa-water'),
(2, 'bay', 'View Vịnh Hạ Long', 'fa-ship'),
(3, 'city', 'View Phố', 'fa-city'),
(4, 'garden', 'View Vườn/Sân', 'fa-tree'),
(5, 'pool', 'View Bể Bơi', 'fa-person-swimming');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Chỉ mục cho bảng `amenity_categories`
--
ALTER TABLE `amenity_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `bedroom_layouts`
--
ALTER TABLE `bedroom_layouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Chỉ mục cho bảng `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Chỉ mục cho bảng `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Chỉ mục cho bảng `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `property_type_id` (`property_type_id`);

--
-- Chỉ mục cho bảng `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Chỉ mục cho bảng `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Chỉ mục cho bảng `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `paid_services`
--
ALTER TABLE `paid_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `rating_review`
--
ALTER TABLE `rating_review`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_type_id` (`property_type_id`),
  ADD KEY `room_type_id` (`room_type_id`),
  ADD KEY `building_id` (`building_id`),
  ADD KEY `view_type_id` (`view_type_id`);

--
-- Chỉ mục cho bảng `room_amenities`
--
ALTER TABLE `room_amenities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_facility` (`room_id`,`facility_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `facility_id` (`facility_id`);

--
-- Chỉ mục cho bảng `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities_id` (`facilities_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Chỉ mục cho bảng `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features_id` (`features_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Chỉ mục cho bảng `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Chỉ mục cho bảng `room_paid_services`
--
ALTER TABLE `room_paid_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_service` (`room_id`,`service_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Chỉ mục cho bảng `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_type_id` (`property_type_id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Chỉ mục cho bảng `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Chỉ mục cho bảng `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- Chỉ mục cho bảng `view_types`
--
ALTER TABLE `view_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `amenity_categories`
--
ALTER TABLE `amenity_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `bedroom_layouts`
--
ALTER TABLE `bedroom_layouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `paid_services`
--
ALTER TABLE `paid_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `rating_review`
--
ALTER TABLE `rating_review`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `room_amenities`
--
ALTER TABLE `room_amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `room_paid_services`
--
ALTER TABLE `room_paid_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `view_types`
--
ALTER TABLE `view_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bedroom_layouts`
--
ALTER TABLE `bedroom_layouts`
  ADD CONSTRAINT `fk_bl_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `fk_bd_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Các ràng buộc cho bảng `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `fk_bo_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `fk_bo_user` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Các ràng buộc cho bảng `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `fk_bld_prop` FOREIGN KEY (`property_type_id`) REFERENCES `property_types` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `facilities`
--
ALTER TABLE `facilities`
  ADD CONSTRAINT `fk_fac_cat` FOREIGN KEY (`category_id`) REFERENCES `amenity_categories` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `rating_review`
--
ALTER TABLE `rating_review`
  ADD CONSTRAINT `fk_rr_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `fk_rr_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `fk_rr_user` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Các ràng buộc cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_bld` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rooms_pt` FOREIGN KEY (`property_type_id`) REFERENCES `property_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rooms_rt` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rooms_view` FOREIGN KEY (`view_type_id`) REFERENCES `view_types` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `room_amenities`
--
ALTER TABLE `room_amenities`
  ADD CONSTRAINT `fk_ra_fac` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ra_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `fk_rf_fac` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rf_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `fk_rfeat_feat` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rfeat_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `fk_ri_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `room_paid_services`
--
ALTER TABLE `room_paid_services`
  ADD CONSTRAINT `fk_rps_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rps_svc` FOREIGN KEY (`service_id`) REFERENCES `paid_services` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `room_types`
--
ALTER TABLE `room_types`
  ADD CONSTRAINT `fk_rt_prop` FOREIGN KEY (`property_type_id`) REFERENCES `property_types` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
