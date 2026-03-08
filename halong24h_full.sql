-- ============================================================
-- HaLong24h - Full Database (Complete Import File)
-- Version 3.0 | Date: 2026-03-08
-- File DUY NHẤT — thay thế hotel_manager.sql & migration_v2.sql
-- Import vào phpMyAdmin: chọn tab Import → Choose File → Go
-- Admin: admin / Abcd@1234
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

-- Tạo & chọn database
CREATE DATABASE IF NOT EXISTS `halong24h_full`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `halong24h_full`;

-- Tắt kiểm tra FK tạm thời để drop thoải mái
SET FOREIGN_KEY_CHECKS = 0;

-- ============================================================
-- XÓA BẢNG CŨ (theo thứ tự phụ thuộc)
-- ============================================================
DROP TABLE IF EXISTS `room_paid_services`;
DROP TABLE IF EXISTS `room_amenities`;
DROP TABLE IF EXISTS `bedroom_layouts`;
DROP TABLE IF EXISTS `room_images`;
DROP TABLE IF EXISTS `room_features`;
DROP TABLE IF EXISTS `room_facilities`;
DROP TABLE IF EXISTS `rooms`;
DROP TABLE IF EXISTS `paid_services`;
DROP TABLE IF EXISTS `facilities`;
DROP TABLE IF EXISTS `amenity_categories`;
DROP TABLE IF EXISTS `view_types`;
DROP TABLE IF EXISTS `buildings`;
DROP TABLE IF EXISTS `room_types`;
DROP TABLE IF EXISTS `property_types`;
DROP TABLE IF EXISTS `features`;
DROP TABLE IF EXISTS `rating_review`;
DROP TABLE IF EXISTS `booking_details`;
DROP TABLE IF EXISTS `booking_order`;
DROP TABLE IF EXISTS `user_queries`;
DROP TABLE IF EXISTS `user_cred`;
DROP TABLE IF EXISTS `team_details`;
DROP TABLE IF EXISTS `settings`;
DROP TABLE IF EXISTS `contact_details`;
DROP TABLE IF EXISTS `carousel`;
DROP TABLE IF EXISTS `admin_cred`;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- PHẦN 1: BẢNG HỆ THỐNG (GIỮ NGUYÊN TỪ PHIÊN BẢN CŨ)
-- ============================================================

-- 1. Admin
CREATE TABLE `admin_cred` (
  `sr_no`      INT(11)      NOT NULL AUTO_INCREMENT,
  `admin_name` VARCHAR(150) NOT NULL,
  `admin_pass` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin_cred` (`admin_name`, `admin_pass`) VALUES
('admin', 'Abcd@1234');

-- 2. Users
CREATE TABLE `user_cred` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(100) NOT NULL,
  `email`       VARCHAR(150) NOT NULL,
  `address`     VARCHAR(120) NOT NULL DEFAULT '',
  `phonenum`    VARCHAR(100) NOT NULL DEFAULT '',
  `pincode`     INT(11)      NOT NULL DEFAULT 0,
  `dob`         DATE         NOT NULL DEFAULT '2000-01-01',
  `profile`     VARCHAR(100) NOT NULL DEFAULT 'chill-guy.png',
  `password`    VARCHAR(200) NOT NULL,
  `is_verified` INT(11)      NOT NULL DEFAULT 0,
  `token`       VARCHAR(200) DEFAULT NULL,
  `t_expire`    DATE         DEFAULT NULL,
  `status`      INT(11)      NOT NULL DEFAULT 1,
  `datentime`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 3. Booking Order
CREATE TABLE `booking_order` (
  `booking_id`     INT(11)      NOT NULL AUTO_INCREMENT,
  `user_id`        INT(11)      NOT NULL,
  `room_id`        INT(11)      NOT NULL,
  `check_in`       DATE         NOT NULL,
  `check_out`      DATE         NOT NULL,
  `arrival`        INT(11)      NOT NULL DEFAULT 0,
  `refund`         INT(11)      DEFAULT NULL,
  `booking_status` VARCHAR(100) NOT NULL DEFAULT 'pending',
  `order_id`       VARCHAR(150) NOT NULL,
  `trans_id`       VARCHAR(200) DEFAULT NULL,
  `trans_amt`      INT(11)      DEFAULT NULL,
  `trans_status`   VARCHAR(100) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` VARCHAR(200) DEFAULT NULL,
  `rate_review`    INT(11)      DEFAULT NULL,
  `datentime`      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_id`),
  KEY `user_id` (`user_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 4. Booking Details
CREATE TABLE `booking_details` (
  `sr_no`      INT(11)      NOT NULL AUTO_INCREMENT,
  `booking_id` INT(11)      NOT NULL,
  `room_name`  VARCHAR(100) NOT NULL,
  `price`      INT(11)      NOT NULL,
  `total_pay`  INT(11)      NOT NULL,
  `room_no`    VARCHAR(100) DEFAULT NULL,
  `user_name`  VARCHAR(100) NOT NULL,
  `phonenum`   VARCHAR(100) NOT NULL,
  `address`    VARCHAR(150) NOT NULL,
  PRIMARY KEY (`sr_no`),
  KEY `booking_id` (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 5. Rating & Review
CREATE TABLE `rating_review` (
  `sr_no`      INT(11)      NOT NULL AUTO_INCREMENT,
  `booking_id` INT(11)      NOT NULL,
  `room_id`    INT(11)      NOT NULL,
  `user_id`    INT(11)      NOT NULL,
  `rating`     INT(11)      NOT NULL,
  `review`     VARCHAR(500) NOT NULL,
  `seen`       INT(11)      NOT NULL DEFAULT 0,
  `datentime`  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sr_no`),
  KEY `booking_id` (`booking_id`),
  KEY `room_id` (`room_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 6. Carousel
CREATE TABLE `carousel` (
  `sr_no` INT(11)      NOT NULL AUTO_INCREMENT,
  `image` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `carousel` (`image`) VALUES ('1.jpg'), ('2.jpg'), ('3.jpg');

-- 7. Contact Details
CREATE TABLE `contact_details` (
  `sr_no`   INT(11)      NOT NULL AUTO_INCREMENT,
  `address` VARCHAR(200) NOT NULL,
  `gmap`    VARCHAR(300) NOT NULL DEFAULT '',
  `pn1`     VARCHAR(20)  NOT NULL DEFAULT '',
  `email`   VARCHAR(100) NOT NULL DEFAULT '',
  `fb`      VARCHAR(200) NOT NULL DEFAULT '',
  `insta`   VARCHAR(200) NOT NULL DEFAULT '',
  `tw`      VARCHAR(200) NOT NULL DEFAULT '',
  `iframe`  TEXT         NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `contact_details` (`address`, `gmap`, `pn1`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
('Bãi Cháy, Hạ Long, Quảng Ninh',
 'https://maps.app.goo.gl/HaLong',
 '0912345678',
 'info@halong24h.vn',
 'https://facebook.com/halong24h',
 'https://instagram.com/halong24h',
 '',
 '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29842.0!2d107.045!3d20.951!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a5791b0f5d671%3A0xaa46a5ce6a88b4f5!2zQuG6o2kgQ2jDonksIEjhuqEgTG9uZywgUXXhuqNuZyBOaW5o!5e0!3m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>');

-- 8. Settings
CREATE TABLE `settings` (
  `sr_no`      INT(11)      NOT NULL AUTO_INCREMENT,
  `site_title` VARCHAR(50)  CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `site_about` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `shutdown`   TINYINT(1)   NOT NULL DEFAULT 0,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `settings` (`site_title`, `site_about`, `shutdown`) VALUES
('HaLong24h',
 'HaLong24h - Nền tảng đặt phòng Villa & Homestay cao cấp tại Hạ Long, Quảng Ninh. Chúng tôi cung cấp đa dạng lựa chọn từ Villa biển sang trọng tại Sun Grand City Feria đến Homestay, Penthouse view vịnh Hạ Long tại các toà nhà cao cấp. Trải nghiệm nghỉ dưỡng đẳng cấp chỉ với vài cú nhấp chuột!',
 0);

-- 9. Team
CREATE TABLE `team_details` (
  `sr_no`   INT(11)      NOT NULL AUTO_INCREMENT,
  `name`    VARCHAR(50)  NOT NULL,
  `picture` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 10. User Queries
CREATE TABLE `user_queries` (
  `sr_no`     INT(11)      NOT NULL AUTO_INCREMENT,
  `name`      VARCHAR(50)  NOT NULL,
  `email`     VARCHAR(150) NOT NULL,
  `subject`   VARCHAR(200) NOT NULL,
  `message`   VARCHAR(1000) NOT NULL,
  `datentime` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen`      TINYINT(4)   NOT NULL DEFAULT 0,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 11. Features (cũ, giữ lại cho tương thích)
CREATE TABLE `features` (
  `id`   INT(11)     NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `features` (`name`) VALUES
('Phòng Ngủ'), ('Ban Công'), ('Nhà Bếp'), ('Ghế Sofa'),
('View Biển'), ('View Phố'), ('Sân Vườn'), ('Bể Bơi');


-- ============================================================
-- PHẦN 2: BẢNG PHÂN LOẠI DÙNG CHUNG (MỚI)
-- ============================================================

-- 2.1 Loại bất động sản
CREATE TABLE `property_types` (
  `id`         INT(11)      NOT NULL AUTO_INCREMENT,
  `slug`       VARCHAR(50)  NOT NULL,
  `name`       VARCHAR(100) NOT NULL,
  `icon`       VARCHAR(100) DEFAULT NULL,
  `sort_order` INT(11)      NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `property_types` (`slug`, `name`, `icon`, `sort_order`) VALUES
('villa',    'Villa',    'fa-house',    1),
('homestay', 'Homestay', 'fa-building', 2);


-- 2.2 Loại phòng
CREATE TABLE `room_types` (
  `id`               INT(11)      NOT NULL AUTO_INCREMENT,
  `property_type_id` INT(11)      NOT NULL,
  `slug`             VARCHAR(50)  NOT NULL,
  `name`             VARCHAR(100) NOT NULL,
  `bedroom_count`    INT(11)      DEFAULT NULL,
  `sort_order`       INT(11)      NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `property_type_id` (`property_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `room_types` (`property_type_id`, `slug`, `name`, `bedroom_count`, `sort_order`) VALUES
-- Homestay (property_type_id = 2)
(2, 'studio',    'Studio',             0,  1),
(2, '1pn',       '1 Phòng ngủ',        1,  2),
(2, '2pn',       '2 Phòng ngủ',        2,  3),
(2, '3pn',       '3 Phòng ngủ',        3,  4),
(2, 'penthouse', 'Penthouse',          NULL, 5),
-- Villa (property_type_id = 1)
(1, '4pn',   'Villa 4 Phòng ngủ',  4,  10),
(1, '5pn',   'Villa 5 Phòng ngủ',  5,  11),
(1, '6pn',   'Villa 6 Phòng ngủ',  6,  12),
(1, '7pn',   'Villa 7 Phòng ngủ',  7,  13),
(1, '8pn',   'Villa 8 Phòng ngủ',  8,  14),
(1, '9pn',   'Villa 9 Phòng ngủ',  9,  15),
(1, '10pn',  'Villa 10 Phòng ngủ', 10, 16),
(1, '11pn',  'Villa 11 Phòng ngủ', 11, 17),
(1, '12pn',  'Villa 12 Phòng ngủ', 12, 18);


-- 2.3 View / Hướng nhìn
CREATE TABLE `view_types` (
  `id`   INT(11)      NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(50)  NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `icon` VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `view_types` (`slug`, `name`, `icon`) VALUES
('sea',    'View Biển',         'fa-water'),
('bay',    'View Vịnh Hạ Long', 'fa-ship'),
('city',   'View Phố',          'fa-city'),
('garden', 'View Vườn/Sân',     'fa-tree'),
('pool',   'View Bể Bơi',       'fa-person-swimming');


-- 2.4 Toà nhà / Khu nghỉ dưỡng
CREATE TABLE `buildings` (
  `id`               INT(11)      NOT NULL AUTO_INCREMENT,
  `property_type_id` INT(11)      NOT NULL,
  `slug`             VARCHAR(100) NOT NULL,
  `name`             VARCHAR(200) NOT NULL,
  `short_name`       VARCHAR(100) DEFAULT NULL,
  `address`          VARCHAR(400) NOT NULL,
  `ward`             VARCHAR(100) DEFAULT NULL,
  `district`         VARCHAR(100) DEFAULT 'Bãi Cháy',
  `city`             VARCHAR(100) DEFAULT 'Hạ Long, Quảng Ninh',
  `total_floors`     INT(11)      DEFAULT NULL,
  `description`      TEXT         DEFAULT NULL,
  `gmap_url`         VARCHAR(500) DEFAULT NULL,
  `gmap_iframe`      TEXT         DEFAULT NULL,
  `nearby_landmarks` JSON         DEFAULT NULL,
  `status`           TINYINT(1)   NOT NULL DEFAULT 1,
  `created_at`       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `property_type_id` (`property_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `buildings`
  (`property_type_id`, `slug`, `name`, `short_name`, `address`, `ward`, `district`, `city`, `total_floors`, `description`, `nearby_landmarks`)
VALUES
-- Khu Villa: Sun Grand City Feria
(1, 'sun-grand-feria',
 'Sun Grand City Feria Hạ Long', 'Sun Feria',
 'Khu biệt thự Sun Grand City Feria, Bãi Cháy, Hạ Long',
 'Bãi Cháy', 'Hạ Long', 'Quảng Ninh', NULL,
 'Khu biệt thự ven biển cao cấp thuộc tổ hợp Sun Grand City Feria Hạ Long. Tọa lạc ngay trung tâm bãi tắm Bãi Cháy – bãi tắm đẹp nhất Miền Bắc, mang đến không gian nghỉ dưỡng riêng tư đẳng cấp với đầy đủ tiện ích cao cấp. Dự án nằm trong khuôn viên có hồ bơi, bãi biển, phố đi bộ và hàng loạt tiện ích ngoại khu phục vụ 24/7.',
 '[{"name":"Bãi tắm Bãi Cháy","distance":"Đối diện","transport":"walk"},{"name":"Cảng tàu quốc tế Sun Group","distance":"~1km","transport":"walk"},{"name":"Sun World Ha Long Park","distance":"~1km","transport":"walk"},{"name":"Phố đi bộ","distance":"~1km","transport":"walk"},{"name":"Chợ hải sản Cái Dăm","distance":"~1km","transport":"drive"},{"name":"Beach Bar (Top Asia)","distance":"200-300m","transport":"walk"},{"name":"Nhà hàng hải sản","distance":"<500m","transport":"walk"}]'
),

-- Homestay: Newlife
(2, 'newlife',
 'Chung cư Newlife Hạ Long', 'Newlife',
 'Bãi Cháy, Hạ Long, Quảng Ninh',
 'Bãi Cháy', 'Hạ Long', 'Quảng Ninh', NULL,
 'Chung cư Newlife tọa lạc tại trung tâm du lịch Bãi Cháy – Hạ Long. Từ toà nhà có thể dễ dàng tiếp cận mọi điểm du lịch và vui chơi giải trí. Căn hộ sở hữu tầm view rộng ôm trọn thành phố biển và vịnh Hạ Long từ ban công riêng.',
 '[{"name":"Chợ hải sản Cái Dăm","distance":"300m","transport":"walk"},{"name":"Bãi tắm Bãi Cháy","distance":"700m","transport":"walk"},{"name":"Quảng trường Sun & Bãi biển","distance":"2km","transport":"drive"},{"name":"Phố đi bộ Sunworld","distance":"2km","transport":"drive"},{"name":"Bến tàu du lịch","distance":"3km","transport":"drive"},{"name":"Ha Long Park / Công viên nước","distance":"2.5km","transport":"drive"},{"name":"Suối khoáng nóng Yoko Onsen","distance":"15km","transport":"drive"},{"name":"Bãi chèo SUP","distance":"7km","transport":"drive"}]'
),

-- Homestay: Alcatel (À La Carte Ha Long Bay)
(2, 'alacarte',
 'À La Carte Ha Long Bay', 'Alcatel',
 'Bán đảo 2, Khu đô thị Marina Hạ Long, Phường Hùng Thắng, Hạ Long, Quảng Ninh',
 'Hùng Thắng', 'Hạ Long', 'Quảng Ninh', 41,
 'Tòa tháp À La Carte Ha Long Bay (tên địa phương: Alcatel) là công trình căn hộ cao cấp nổi bật tại khu Marina Hạ Long. Toà nhà 41 tầng với 932 căn hộ sở hữu 100% view trực diện vịnh Hạ Long – một trong những kỳ quan thiên nhiên thế giới. Vị trí cách mặt biển chưa đến 200m, cư dân được tận hưởng không khí trong lành và tầm nhìn panorama không tỳ vết ngay từ ban công căn hộ.',
 '[{"name":"Bãi biển","distance":"<200m","transport":"walk"},{"name":"Cảng tàu thăm vịnh","distance":"Gần","transport":"walk"},{"name":"Chợ đêm Hạ Long","distance":"Gần","transport":"walk"},{"name":"Nhà hàng & dịch vụ ven biển","distance":"Xung quanh","transport":"walk"},{"name":"Sun World Ha Long Park","distance":"~5km","transport":"drive"},{"name":"Đảo Tuần Châu","distance":"~3.7km","transport":"drive"}]'
),

-- Homestay: Citadines Marina Ha Long
(2, 'citadines',
 'Citadines Marina Hạ Long', 'Citadines',
 'Bán đảo 3, Khu Marina Hạ Long, Đại lộ Biển Hạ Long, Phường Bãi Cháy, Hạ Long, Quảng Ninh',
 'Bãi Cháy', 'Hạ Long', 'Quảng Ninh', 26,
 'Citadines Marina Hạ Long là căn hộ dịch vụ 5 sao được quản lý bởi The Ascott Limited. Toà nhà 26 tầng với 580 căn hộ nằm ngay mặt tiền đại lộ ven biển Hạ Long, sở hữu tầm view trực diện vịnh Hạ Long với những khối đá vôi hùng vĩ và làn nước ngọc lục bảo. Thiết kế hiện đại với đầy đủ tiện ích: bếp đầy đủ, máy giặt/sấy, hồ bơi trong nhà + rooftop ngoài trời view vịnh 360°, bar rooftop, nhà hàng và Kids Club.',
 '[{"name":"Bãi biển (trực tiếp)","distance":"Trực diện","transport":"walk"},{"name":"Cầu tàu kayak & tàu du lịch","distance":"Gần","transport":"walk"},{"name":"Halong Marine Plaza Outlet","distance":"Đi bộ","transport":"walk"},{"name":"Chợ đêm Hạ Long","distance":"Gần","transport":"walk"},{"name":"Sun World Ha Long Park","distance":"~5km","transport":"drive"},{"name":"Đảo Tuần Châu","distance":"~3.7km","transport":"drive"}]'
);


-- ============================================================
-- PHẦN 3: BẢNG TIỆN ÍCH (AMENITIES) DÙNG CHUNG
-- ============================================================

-- 3.1 Danh mục tiện ích
CREATE TABLE `amenity_categories` (
  `id`         INT(11)      NOT NULL AUTO_INCREMENT,
  `slug`       VARCHAR(50)  NOT NULL,
  `name`       VARCHAR(100) NOT NULL,
  `icon`       VARCHAR(100) DEFAULT NULL,
  `sort_order` INT(11)      DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `amenity_categories` (`slug`, `name`, `icon`, `sort_order`) VALUES
('general',       'Chung',              'fa-star',        1),
('bedroom',       'Phòng ngủ',          'fa-bed',         2),
('bathroom',      'Phòng tắm',          'fa-shower',      3),
('kitchen',       'Bếp & Ăn uống',      'fa-utensils',    4),
('entertainment', 'Giải trí',           'fa-tv',          5),
('outdoor',       'Ngoài trời',         'fa-tree',        6),
('transport',     'Đi lại & Xe',        'fa-car',         7),
('safety',        'An ninh & An toàn',  'fa-shield-alt',  8);


-- 3.2 Danh sách tiện ích (mở rộng từ bảng facilities cũ)
CREATE TABLE `facilities` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `category_id` INT(11)      DEFAULT NULL,
  `icon`        VARCHAR(100) NOT NULL DEFAULT 'fa-check',
  `name`        VARCHAR(100) NOT NULL,
  `description` VARCHAR(300) NOT NULL DEFAULT '',
  `is_common`   TINYINT(1)   NOT NULL DEFAULT 0
    COMMENT '1=mặc định tích cho tất cả phòng mới',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `facilities` (`category_id`, `icon`, `name`, `description`, `is_common`) VALUES
-- Chung (cat 1)
(1, 'fa-wifi',              'Wi-Fi miễn phí',       'Kết nối Internet tốc độ cao, miễn phí toàn khu vực.',                  1),
(1, 'fa-snowflake',         'Điều hoà',             'Hệ thống điều hoà nhiệt độ hiện đại.',                                  1),
(1, 'fa-fire',              'Lò sưởi',              'Lò sưởi điện cho những ngày trời lạnh.',                                0),
(1, 'fa-bottle-water',      'Nước suối miễn phí',   'Nước suối, trà và cà phê miễn phí.',                                   0),
(1, 'fa-mug-hot',           'Trà & Cà phê',         'Trà và cà phê miễn phí tại phòng.',                                    0),
-- Phòng ngủ (cat 2)
(2, 'fa-bed',               'Giường Kingsize (2m)', 'Giường kingsize 2m sang trọng, đệm cao cấp.',                          0),
(2, 'fa-bed',               'Giường Queen (1m8)',   'Giường 1m8, nệm thoải mái.',                                           0),
(2, 'fa-bed',               'Giường đôi (1m6)',     'Giường đôi 1m6.',                                                      0),
(2, 'fa-lock',              'Két an toàn',          'Két an toàn trong phòng.',                                              0),
-- Phòng tắm (cat 3)
(3, 'fa-bath',              'Bồn tắm',              'Bồn tắm thư giãn đầy đủ tiện nghi.',                                   0),
(3, 'fa-shower',            'Vòi sen',              'Vòi sen nước nóng lạnh.',                                               1),
(3, 'fa-pump-soap',         'Đồ dùng phòng tắm',   'Dầu gội, sữa tắm, khăn tắm, khăn mặt, bàn chải, kem đánh răng.',     1),
(3, 'fa-wind',              'Máy sấy tóc',          'Máy sấy tóc chuyên dụng.',                                             1),
(3, 'fa-sun',               'Đèn sưởi phòng tắm',  'Đèn sưởi hồng ngoại trong phòng tắm.',                                0),
-- Bếp (cat 4)
(4, 'fa-fire-burner',       'Bếp từ',              'Bếp từ đôi, có đủ nồi niêu.',                                           1),
(4, 'fa-box-archive',       'Tủ lạnh',             'Tủ lạnh lớn (≥200L).',                                                  1),
(4, 'fa-bullseye',          'Lò vi sóng',          'Lò vi sóng đa năng.',                                                   1),
(4, 'fa-mug-hot',           'Ấm siêu tốc',         'Ấm điện siêu tốc.',                                                    1),
(4, 'fa-bowl-rice',         'Nồi cơm điện',        'Nồi cơm điện.',                                                         1),
(4, 'fa-utensils',          'Bát đũa & dụng cụ',   'Đầy đủ bát đũa, dao, thớt, nồi cho nhiều người.',                     1),
(4, 'fa-fire',              'Bếp nướng BBQ',        'Bếp nướng BBQ ngoài trời.',                                            0),
(4, 'fa-pot-food',          'Nồi lẩu',             'Nồi lẩu điện.',                                                         0),
(4, 'fa-fan',               'Hút mùi',             'Máy hút mùi bếp.',                                                      0),
-- Giải trí (cat 5)
(5, 'fa-tv',                'Smart TV',            'Smart TV màn hình lớn (≥50 inch).',                                     1),
(5, 'fa-music',             'Loa kéo Karaoke',     'Loa kéo karaoke giải trí.',                                             0),
(5, 'fa-gamepad',           'Máy chơi game',       'Máy chơi game console.',                                                0),
-- Ngoài trời (cat 6)
(6, 'fa-person-swimming',   'Bể bơi riêng',        'Bể bơi riêng tư trong khuôn viên villa/căn hộ.',                       0),
(6, 'fa-water',             'Bể tạo sóng',         'Bể bơi tạo sóng đặc biệt.',                                            0),
(6, 'fa-umbrella',          'Mái che bể bơi',      'Bể bơi có mái che, dùng được cả khi trời mưa.',                       0),
(6, 'fa-tree',              'Sân vườn',            'Không gian sân vườn xanh mát, thoáng đãng.',                            0),
(6, 'fa-chair',             'Bàn ghế ngoài trời',  'Bộ bàn ghế ăn/nghỉ ngoài trời.',                                      0),
(6, 'fa-umbrella-beach',    'Ban công/Sân thượng', 'Ban công hoặc sân thượng riêng.',                                      0),
-- Đi lại (cat 7)
(7, 'fa-square-parking',    'Đỗ xe miễn phí',      'Bãi đỗ xe ô tô miễn phí trong khuôn viên.',                           0),
-- An ninh (cat 8)
(8, 'fa-camera',            'Camera an ninh',       'Hệ thống camera an ninh 24/7.',                                        0),
(8, 'fa-door-closed',       'Khoá thẻ điện tử',    'Hệ thống khoá cửa thẻ từ hoặc mã số.',                                0);


-- 3.3 Dịch vụ trả phí dùng chung
CREATE TABLE `paid_services` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `slug`        VARCHAR(100) NOT NULL,
  `name`        VARCHAR(150) NOT NULL,
  `description` VARCHAR(300) DEFAULT NULL,
  `price_min`   INT(11)      DEFAULT NULL,
  `price_max`   INT(11)      DEFAULT NULL,
  `price_unit`  VARCHAR(50)  DEFAULT NULL,
  `icon`        VARCHAR(100) DEFAULT NULL,
  `sort_order`  INT(11)      DEFAULT 0,
  `status`      TINYINT(1)   NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `paid_services` (`slug`, `name`, `description`, `price_min`, `price_max`, `price_unit`, `icon`, `sort_order`) VALUES
('cooking',        'Thuê nấu ăn theo Set Menu',   'Đầu bếp đến nấu theo set menu thoả thuận tại villa/căn hộ.',      NULL,   NULL,    '/bữa',    'fa-hat-chef',        1),
('bbq-setup',      'Setup tiệc BBQ',               'Setup bàn tiệc BBQ ngoài trời, chuẩn bị đầy đủ đồ nướng.',       NULL,   NULL,    '/lần',    'fa-fire',            2),
('birthday-setup', 'Setup sinh nhật / sự kiện',    'Trang trí, setup tiệc sinh nhật hoặc sự kiện theo yêu cầu.',      NULL,   NULL,    '/lần',    'fa-cake-candles',    3),
('cleaning',       'Dọn dẹp sau bữa ăn',           'Dọn dẹp bát đĩa, vệ sinh bếp và khu ăn uống sau bữa ăn.',       500000, 1000000, '/lần',    'fa-broom',           4),
('grocery',        'Đi chợ hộ',                    'Mua sắm thực phẩm, hải sản tươi sống tại chợ theo yêu cầu.',     NULL,   NULL,    '/lần',    'fa-basket-shopping', 5),
('early-checkin',  'Check-in sớm',                 'Nhận phòng trước 14h00, tuỳ khả năng hỗ trợ.',                   250000, NULL,    '/giờ',    'fa-clock',           6),
('late-checkout',  'Check-out muộn',                'Trả phòng sau 12h00, tuỳ khả năng hỗ trợ.',                      250000, NULL,    '/giờ',    'fa-clock',           7),
('transport',      'Đặt xe / Đưa đón',             'Dịch vụ đặt xe hoặc đưa đón sân bay, bến tàu.',                  NULL,   NULL,    '/chuyến', 'fa-car',             8);


-- ============================================================
-- PHẦN 4: BẢNG PHÒNG (ROOMS) - SCHEMA MỚI ĐẦY ĐỦ
-- ============================================================

CREATE TABLE `rooms` (
  `id`               INT(11)      NOT NULL AUTO_INCREMENT,

  -- Phân loại
  `property_type_id` INT(11)      DEFAULT NULL  COMMENT 'FK → property_types',
  `room_type_id`     INT(11)      DEFAULT NULL  COMMENT 'FK → room_types',
  `building_id`      INT(11)      DEFAULT NULL  COMMENT 'FK → buildings',
  `view_type_id`     INT(11)      DEFAULT NULL  COMMENT 'FK → view_types',

  -- Định danh
  `name`             VARCHAR(150) NOT NULL,
  `code`             VARCHAR(50)  DEFAULT NULL  COMMENT 'Mã căn: M3-26, C603, 2701B',
  `slug`             VARCHAR(200) DEFAULT NULL,

  -- Mô tả
  `description`      TEXT         DEFAULT NULL,
  `tagline`          VARCHAR(300) DEFAULT NULL  COMMENT 'Slogan hiển thị trên card',

  -- Phòng ngủ
  `bedroom_count`    INT(11)      DEFAULT NULL,
  `bed_count`        INT(11)      DEFAULT NULL,
  `bathroom_count`   INT(11)      DEFAULT NULL,
  `wc_count`         INT(11)      DEFAULT NULL,

  -- Diện tích
  `area`             INT(11)      DEFAULT NULL  COMMENT 'Diện tích m² (hoặc min)',
  `area_max`         INT(11)      DEFAULT NULL  COMMENT 'Diện tích tối đa (nếu villa có range)',
  `floor`            VARCHAR(50)  DEFAULT NULL  COMMENT 'Tầng (homestay)',

  -- Sức chứa
  `adult`            INT(11)      NOT NULL DEFAULT 2  COMMENT 'Tương thích: =standard_adults',
  `children`         INT(11)      NOT NULL DEFAULT 0  COMMENT 'Tương thích: =standard_children',
  `standard_adults`  INT(11)      DEFAULT NULL  COMMENT 'Tiêu chuẩn người lớn',
  `standard_children`INT(11)      DEFAULT NULL  COMMENT 'Tiêu chuẩn trẻ em',
  `free_children_age`INT(11)      DEFAULT 6     COMMENT 'Trẻ < N tuổi miễn phí',
  `max_guests`       INT(11)      DEFAULT NULL  COMMENT 'Tổng khách tối đa sau phụ thu',

  -- Phụ thu
  `surcharge_adult_price`    INT(11) DEFAULT 250000 COMMENT 'đ/người/đêm',
  `surcharge_adult_from_age` INT(11) DEFAULT 12     COMMENT 'Từ N tuổi = người lớn',
  `surcharge_child_price`    INT(11) DEFAULT 150000 COMMENT 'đ/trẻ/đêm',
  `surcharge_child_age_min`  INT(11) DEFAULT 6,
  `surcharge_child_age_max`  INT(11) DEFAULT 11,

  -- Check-in / Check-out
  `checkin_time`     TIME         DEFAULT '14:00:00',
  `checkout_time`    TIME         DEFAULT '12:00:00',
  `extra_hour_fee`   INT(11)      DEFAULT 500000 COMMENT 'Phụ thu thêm giờ đ/giờ',

  -- Giá
  `price`            INT(11)      NOT NULL DEFAULT 0  COMMENT 'Giá ngày thường',
  `price_weekend`    INT(11)      DEFAULT NULL        COMMENT 'Giá cuối tuần',
  `price_holiday`    INT(11)      DEFAULT NULL        COMMENT 'Giá lễ/cao điểm',
  -- quantity đã bỏ: mỗi villa/phòng là duy nhất (quantity luôn = 1)
  `deposit_amount`   INT(11)      DEFAULT 0           COMMENT 'Tiền cọc tài sản',

  -- Trạng thái
  `status`           TINYINT(4)   NOT NULL DEFAULT 1,
  `removed`          INT(11)      NOT NULL DEFAULT 0,

  PRIMARY KEY (`id`),
  KEY `property_type_id` (`property_type_id`),
  KEY `room_type_id`     (`room_type_id`),
  KEY `building_id`      (`building_id`),
  KEY `view_type_id`     (`view_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Ảnh phòng (1 ảnh chính thumb=1 + 15-20 ảnh phụ thumb=0)
CREATE TABLE `room_images` (
  `sr_no`      INT(11)      NOT NULL AUTO_INCREMENT,
  `room_id`    INT(11)      NOT NULL,
  `image`      VARCHAR(150) NOT NULL,
  `thumb`      TINYINT(4)   NOT NULL DEFAULT 0  COMMENT '1=ảnh chính',
  `sort_order` INT(11)      DEFAULT 0,
  `caption`    VARCHAR(200) DEFAULT NULL,
  PRIMARY KEY (`sr_no`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Bố trí phòng ngủ chi tiết
CREATE TABLE `bedroom_layouts` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `room_id`     INT(11)      NOT NULL,
  `label`       VARCHAR(100) DEFAULT NULL  COMMENT 'Phòng master, Phòng ngủ 1, ...',
  `bed_config`  VARCHAR(200) NOT NULL      COMMENT '1 giường Kingsize 2m, 2 giường 1m6',
  `area`        INT(11)      DEFAULT NULL  COMMENT 'm²',
  `has_ensuite` TINYINT(1)   NOT NULL DEFAULT 0 COMMENT '1=có phòng tắm riêng',
  `sort_order`  INT(11)      NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Tiện ích theo phòng (tích chọn từ facilities)
CREATE TABLE `room_amenities` (
  `id`          INT(11)    NOT NULL AUTO_INCREMENT,
  `room_id`     INT(11)    NOT NULL,
  `facility_id` INT(11)    NOT NULL,
  `is_free`     TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1=miễn phí, 0=trả phí',
  `note`        VARCHAR(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `room_facility` (`room_id`, `facility_id`),
  KEY `room_id`     (`room_id`),
  KEY `facility_id` (`facility_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Dịch vụ trả phí theo phòng
CREATE TABLE `room_paid_services` (
  `id`                 INT(11)    NOT NULL AUTO_INCREMENT,
  `room_id`            INT(11)    NOT NULL,
  `service_id`         INT(11)    NOT NULL,
  `price_override_min` INT(11)    DEFAULT NULL,
  `price_override_max` INT(11)    DEFAULT NULL,
  `note`               VARCHAR(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `room_service` (`room_id`, `service_id`),
  KEY `room_id`    (`room_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Legacy (giữ lại cho code cũ tương thích)
CREATE TABLE `room_facilities` (
  `sr_no`        INT(11) NOT NULL AUTO_INCREMENT,
  `room_id`      INT(11) NOT NULL,
  `facilities_id`INT(11) NOT NULL,
  PRIMARY KEY (`sr_no`),
  KEY `facilities_id` (`facilities_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `room_features` (
  `sr_no`      INT(11) NOT NULL AUTO_INCREMENT,
  `room_id`    INT(11) NOT NULL,
  `features_id`INT(11) NOT NULL,
  PRIMARY KEY (`sr_no`),
  KEY `features_id` (`features_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- ============================================================
-- PHẦN 5: DỮ LIỆU MẪU PHÒNG
-- ============================================================

-- ------- Villa 1: Amanda Villa M3-26 (4PN) -------
INSERT INTO `rooms` (
  `property_type_id`, `room_type_id`, `building_id`, `view_type_id`,
  `name`, `code`, `slug`,
  `description`, `tagline`,
  `bedroom_count`, `bed_count`, `bathroom_count`, `wc_count`,
  `area`, `area_max`,
  `adult`, `children`,
  `standard_adults`, `standard_children`, `free_children_age`, `max_guests`,
  `surcharge_adult_price`, `surcharge_adult_from_age`,
  `surcharge_child_price`, `surcharge_child_age_min`, `surcharge_child_age_max`,
  `checkin_time`, `checkout_time`, `extra_hour_fee`,
  `price`, `deposit_amount`, `status`
) VALUES (
  1, 6, 1, 1,
  'Amanda Villa Hạ Long', 'M3-26', 'amanda-villa-ha-long-m3-26',
  'Villa 4 phòng ngủ master sang trọng, mỗi phòng diện tích 40–60m² với giường Kingsize 2m, 4 nhà tắm riêng và 5 WC đầy đủ đồ dùng. Phòng bếp đầy đủ tiện nghi, phòng khách Smart TV 50 inch. Bể bơi riêng tạo sóng đặc biệt, loa kéo karaoke và đầy đủ mọi tiện nghi cho kỳ nghỉ hoàn hảo.',
  'Villa biển 4PN | Bể bơi tạo sóng | Trung tâm Bãi Cháy',
  4, 6, 4, 5,
  40, 60,
  10, 4,
  10, 4, 6, 20,
  250000, 11,
  150000, 6, 10,
  '14:00:00', '12:00:00', 500000,
  0, 0, 1
);
SET @amanda = LAST_INSERT_ID();

INSERT INTO `bedroom_layouts` (`room_id`, `label`, `bed_config`, `area`, `has_ensuite`, `sort_order`) VALUES
(@amanda, 'Phòng ngủ Master 1', '1 giường Kingsize 2m', 55, 1, 1),
(@amanda, 'Phòng ngủ Master 2', '1 giường Kingsize 2m', 50, 1, 2),
(@amanda, 'Phòng ngủ Master 3', '1 giường Kingsize 2m', 45, 1, 3),
(@amanda, 'Phòng ngủ Master 4', '1 giường Kingsize 2m', 40, 1, 4);

INSERT INTO `room_amenities` (`room_id`, `facility_id`, `is_free`) VALUES
(@amanda, 1,  1), -- WiFi
(@amanda, 2,  1), -- Điều hoà
(@amanda, 3,  1), -- Lò sưởi
(@amanda, 11, 1), -- Vòi sen
(@amanda, 12, 1), -- Đồ dùng phòng tắm
(@amanda, 13, 1), -- Máy sấy tóc
(@amanda, 14, 1), -- Đèn sưởi phòng tắm
(@amanda, 10, 1), -- Bồn tắm
(@amanda, 24, 1), -- Smart TV
(@amanda, 15, 1), -- Bếp từ
(@amanda, 16, 1), -- Tủ lạnh
(@amanda, 17, 1), -- Lò vi sóng
(@amanda, 18, 1), -- Ấm siêu tốc
(@amanda, 20, 1), -- Bát đũa
(@amanda, 21, 1), -- BBQ
(@amanda, 27, 1), -- Bể tạo sóng
(@amanda, 25, 1), -- Loa Karaoke
(@amanda, 30, 1), -- Bàn ghế ngoài trời
(@amanda, 32, 1); -- Đỗ xe

INSERT INTO `room_paid_services` (`room_id`, `service_id`) VALUES
(@amanda, 1), (@amanda, 2), (@amanda, 4);


-- ------- Villa 2: Sun Feria C603 (6PN) -------
INSERT INTO `rooms` (
  `property_type_id`, `room_type_id`, `building_id`, `view_type_id`,
  `name`, `code`, `slug`,
  `description`, `tagline`,
  `bedroom_count`, `bed_count`, `bathroom_count`, `wc_count`,
  `area`, `area_max`,
  `adult`, `children`,
  `standard_adults`, `standard_children`, `free_children_age`, `max_guests`,
  `surcharge_adult_price`, `surcharge_adult_from_age`,
  `surcharge_child_price`, `surcharge_child_age_min`, `surcharge_child_age_max`,
  `checkin_time`, `checkout_time`, `extra_hour_fee`,
  `price`, `deposit_amount`, `status`
) VALUES (
  1, 7, 1, 4,
  'Sun Feria C603', 'C603', 'sun-feria-c603',
  '6 phòng ngủ (5 phòng chính + 1 phòng nhỏ) với 8 giường lớn, 5 WC riêng + 1 WC chung. Không gian bếp mở rộng rãi, bể bơi riêng ngoài vườn có mái che, sân vườn xanh mát. Miễn phí: nước suối, trà cà phê, BBQ, karaoke. Lý tưởng cho chuyến du lịch nhóm hoặc kỳ nghỉ đáng nhớ tại Hạ Long.',
  'Villa 6PN | Bể bơi mái che | Sân vườn riêng | Bãi Cháy',
  6, 8, 5, 6,
  NULL, NULL,
  12, 6,
  12, 6, 6, 25,
  250000, 12,
  150000, 7, 11,
  '14:00:00', '12:00:00', 500000,
  0, 0, 1
);
SET @c603 = LAST_INSERT_ID();

INSERT INTO `bedroom_layouts` (`room_id`, `label`, `bed_config`, `area`, `has_ensuite`, `sort_order`) VALUES
(@c603, 'Phòng ngủ 1', '1 giường 1m8', NULL, 1, 1),
(@c603, 'Phòng ngủ 2', '1 giường 1m8', NULL, 1, 2),
(@c603, 'Phòng ngủ 3', '1 giường 1m8', NULL, 1, 3),
(@c603, 'Phòng ngủ 4', '2 giường 1m6', NULL, 1, 4),
(@c603, 'Phòng ngủ 5', '2 giường 1m5', NULL, 1, 5),
(@c603, 'Phòng nhỏ',   '1 giường 1m6', NULL, 0, 6);

INSERT INTO `room_amenities` (`room_id`, `facility_id`, `is_free`) VALUES
(@c603, 1,  1), -- WiFi
(@c603, 2,  1), -- Điều hoà
(@c603, 4,  1), -- Nước suối
(@c603, 5,  1), -- Trà & cà phê
(@c603, 12, 1), -- Đồ dùng phòng tắm
(@c603, 13, 1), -- Máy sấy tóc
(@c603, 24, 1), -- Smart TV
(@c603, 15, 1), -- Bếp từ
(@c603, 16, 1), -- Tủ lạnh
(@c603, 18, 1), -- Ấm siêu tốc
(@c603, 19, 1), -- Nồi cơm điện
(@c603, 20, 1), -- Bát đũa
(@c603, 22, 1), -- Nồi lẩu
(@c603, 23, 1), -- Hút mùi
(@c603, 21, 1), -- BBQ
(@c603, 25, 1), -- Loa Karaoke
(@c603, 26, 1), -- Bể bơi riêng
(@c603, 28, 1), -- Mái che bể bơi
(@c603, 29, 1), -- Sân vườn
(@c603, 30, 1), -- Bàn ghế ngoài trời
(@c603, 32, 1); -- Đỗ xe

INSERT INTO `room_paid_services` (`room_id`, `service_id`) VALUES
(@c603, 1), (@c603, 2), (@c603, 3), (@c603, 4), (@c603, 5);


-- ------- Homestay: Penthouse 4PN Newlife -------
INSERT INTO `rooms` (
  `property_type_id`, `room_type_id`, `building_id`, `view_type_id`,
  `name`, `code`, `slug`,
  `description`, `tagline`,
  `bedroom_count`, `bed_count`, `bathroom_count`, `wc_count`,
  `floor`,
  `adult`, `children`,
  `standard_adults`, `standard_children`, `free_children_age`, `max_guests`,
  `surcharge_adult_price`, `surcharge_adult_from_age`,
  `surcharge_child_price`, `surcharge_child_age_min`, `surcharge_child_age_max`,
  `checkin_time`, `checkout_time`, `extra_hour_fee`,
  `price`, `deposit_amount`, `status`
) VALUES (
  2, 5, 2, 1,
  'Penthouse 4 Ngủ Newlife Hạ Long', '2701B', 'penthouse-4pn-newlife-ha-long',
  'Căn Penthouse sang trọng, đẳng cấp tại tầng 27 toà B chung cư Newlife Hạ Long. 4 phòng ngủ (1 giường 2m phòng master + 3 giường 1m8), 3 phòng tắm riêng, phòng khách Smart TV, bếp đầy đủ tiện nghi (bếp từ, tủ lạnh, lò vi sóng, bếp lẩu). Ban công thoáng mát, view biển và thành phố tuyệt đẹp.',
  'Penthouse tầng 27 | View biển & thành phố | Newlife Hạ Long',
  4, 4, 3, 3,
  'Tầng 27, Toà B',
  8, 4,
  8, 4, 6, NULL,
  150000, 11,
  100000, 6, 10,
  '14:00:00', '12:00:00', 250000,
  0, 1000000, 1
);
SET @phouse = LAST_INSERT_ID();

INSERT INTO `bedroom_layouts` (`room_id`, `label`, `bed_config`, `area`, `has_ensuite`, `sort_order`) VALUES
(@phouse, 'Phòng ngủ Master', '1 giường 2m',  NULL, 1, 1),
(@phouse, 'Phòng ngủ 2',      '1 giường 1m8', NULL, 1, 2),
(@phouse, 'Phòng ngủ 3',      '1 giường 1m8', NULL, 1, 3),
(@phouse, 'Phòng ngủ 4',      '1 giường 1m8', NULL, 1, 4);

INSERT INTO `room_amenities` (`room_id`, `facility_id`, `is_free`) VALUES
(@phouse, 1,  1), -- WiFi
(@phouse, 2,  1), -- Điều hoà
(@phouse, 11, 1), -- Vòi sen
(@phouse, 12, 1), -- Đồ dùng phòng tắm
(@phouse, 13, 1), -- Máy sấy tóc
(@phouse, 24, 1), -- Smart TV
(@phouse, 15, 1), -- Bếp từ
(@phouse, 16, 1), -- Tủ lạnh
(@phouse, 17, 1), -- Lò vi sóng
(@phouse, 18, 1), -- Ấm siêu tốc
(@phouse, 19, 1), -- Nồi cơm điện
(@phouse, 20, 1), -- Bát đũa
(@phouse, 22, 1), -- Nồi lẩu
(@phouse, 31, 1); -- Ban công


-- ------- Homestay: Căn hộ 3PN Newlife (mẫu thứ 2) -------
INSERT INTO `rooms` (
  `property_type_id`, `room_type_id`, `building_id`, `view_type_id`,
  `name`, `code`, `slug`,
  `description`, `tagline`,
  `bedroom_count`, `bed_count`, `bathroom_count`, `wc_count`,
  `adult`, `children`,
  `standard_adults`, `standard_children`, `free_children_age`, `max_guests`,
  `surcharge_adult_price`, `surcharge_adult_from_age`,
  `surcharge_child_price`, `surcharge_child_age_min`, `surcharge_child_age_max`,
  `checkin_time`, `checkout_time`, `extra_hour_fee`,
  `price`, `deposit_amount`, `status`
) VALUES (
  2, 4, 2, 3,
  'Căn hộ 3 Phòng Ngủ Newlife', NULL, 'can-ho-3pn-newlife',
  'Căn hộ 3 phòng ngủ thiết kế khéo léo tối ưu hóa không gian sinh hoạt. Phòng khách rộng rãi, ban công riêng với tầm view ôm trọn thành phố biển Hạ Long. Đầy đủ thiết bị bếp hiện đại. Chỉ 5 phút đi bộ đến chợ hải sản Cái Dăm.',
  'Căn hộ 3PN | View phố biển | Newlife Hạ Long',
  3, 3, 2, 2,
  6, 3,
  6, 3, 6, 7,
  150000, 12,
  100000, 6, 11,
  '14:00:00', '12:00:00', 250000,
  0, 0, 1
);
SET @apt3pn = LAST_INSERT_ID();

INSERT INTO `room_amenities` (`room_id`, `facility_id`, `is_free`) VALUES
(@apt3pn, 1,  1), -- WiFi
(@apt3pn, 2,  1), -- Điều hoà
(@apt3pn, 11, 1), -- Vòi sen
(@apt3pn, 12, 1), -- Đồ dùng phòng tắm
(@apt3pn, 13, 1), -- Máy sấy tóc
(@apt3pn, 24, 1), -- Smart TV
(@apt3pn, 15, 1), -- Bếp từ
(@apt3pn, 16, 1), -- Tủ lạnh
(@apt3pn, 18, 1), -- Ấm siêu tốc
(@apt3pn, 19, 1), -- Nồi cơm điện
(@apt3pn, 20, 1), -- Bát đũa
(@apt3pn, 31, 1); -- Ban công


-- ============================================================
-- PHẦN 6: FOREIGN KEYS
-- ============================================================

ALTER TABLE `booking_details`
  ADD CONSTRAINT `fk_bd_booking` FOREIGN KEY (`booking_id`)
    REFERENCES `booking_order` (`booking_id`);

ALTER TABLE `booking_order`
  ADD CONSTRAINT `fk_bo_user` FOREIGN KEY (`user_id`)
    REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `fk_bo_room` FOREIGN KEY (`room_id`)
    REFERENCES `rooms` (`id`);

ALTER TABLE `rating_review`
  ADD CONSTRAINT `fk_rr_booking` FOREIGN KEY (`booking_id`)
    REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `fk_rr_room` FOREIGN KEY (`room_id`)
    REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `fk_rr_user` FOREIGN KEY (`user_id`)
    REFERENCES `user_cred` (`id`);

ALTER TABLE `room_types`
  ADD CONSTRAINT `fk_rt_prop` FOREIGN KEY (`property_type_id`)
    REFERENCES `property_types` (`id`) ON UPDATE CASCADE;

ALTER TABLE `buildings`
  ADD CONSTRAINT `fk_bld_prop` FOREIGN KEY (`property_type_id`)
    REFERENCES `property_types` (`id`) ON UPDATE CASCADE;

ALTER TABLE `facilities`
  ADD CONSTRAINT `fk_fac_cat` FOREIGN KEY (`category_id`)
    REFERENCES `amenity_categories` (`id`) ON UPDATE CASCADE;

ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_pt`   FOREIGN KEY (`property_type_id`)
    REFERENCES `property_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rooms_rt`   FOREIGN KEY (`room_type_id`)
    REFERENCES `room_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rooms_bld`  FOREIGN KEY (`building_id`)
    REFERENCES `buildings` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rooms_view` FOREIGN KEY (`view_type_id`)
    REFERENCES `view_types` (`id`) ON UPDATE CASCADE;

ALTER TABLE `room_images`
  ADD CONSTRAINT `fk_ri_room` FOREIGN KEY (`room_id`)
    REFERENCES `rooms` (`id`) ON DELETE CASCADE;

ALTER TABLE `bedroom_layouts`
  ADD CONSTRAINT `fk_bl_room` FOREIGN KEY (`room_id`)
    REFERENCES `rooms` (`id`) ON DELETE CASCADE;

ALTER TABLE `room_amenities`
  ADD CONSTRAINT `fk_ra_room` FOREIGN KEY (`room_id`)
    REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ra_fac`  FOREIGN KEY (`facility_id`)
    REFERENCES `facilities` (`id`) ON UPDATE CASCADE;

ALTER TABLE `room_paid_services`
  ADD CONSTRAINT `fk_rps_room` FOREIGN KEY (`room_id`)
    REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rps_svc`  FOREIGN KEY (`service_id`)
    REFERENCES `paid_services` (`id`) ON UPDATE CASCADE;

ALTER TABLE `room_facilities`
  ADD CONSTRAINT `fk_rf_fac`  FOREIGN KEY (`facilities_id`)
    REFERENCES `facilities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rf_room` FOREIGN KEY (`room_id`)
    REFERENCES `rooms` (`id`) ON DELETE CASCADE;

ALTER TABLE `room_features`
  ADD CONSTRAINT `fk_rfeat_feat` FOREIGN KEY (`features_id`)
    REFERENCES `features` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rfeat_room` FOREIGN KEY (`room_id`)
    REFERENCES `rooms` (`id`) ON DELETE CASCADE;

COMMIT;

-- ============================================================
-- HƯỚNG DẪN NHANH CRUD PHÒNG MỚI
-- ============================================================
-- Bước 1: INSERT vào `rooms` (chọn property_type_id, room_type_id, building_id, view_type_id)
-- Bước 2: INSERT vào `bedroom_layouts` (từng phòng ngủ)
-- Bước 3: INSERT vào `room_amenities`  (tích tiện ích từ facilities)
-- Bước 4: INSERT vào `room_paid_services` (chọn dịch vụ trả phí)
-- Bước 5: INSERT vào `room_images` (thumb=1 cho ảnh chính)
-- ============================================================
