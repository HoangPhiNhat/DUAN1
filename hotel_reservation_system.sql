-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 14, 2023 lúc 08:43 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hotel_reservation_system`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `comment_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `rating` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`comment_id`, `room_id`, `customer_id`, `comment_text`, `created_at`, `rating`) VALUES
(149, 57, 2, 'địt', '2023-12-13 04:45:24', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles_id` int(11) DEFAULT 2,
  `gender` varchar(20) DEFAULT NULL,
  `address` varchar(455) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone_number`, `email`, `password`, `roles_id`, `gender`, `address`) VALUES
(2, 'Hoàng Trung', '', 'hoangductrung09112004@gmail.com', '$2y$10$p.fIbtMwgi06m3C1BoKw0eZRR7wKEtaU3wNbz/utXlKc9KxgW.uW.', 1, NULL, ''),
(3, 'trung', '', 'hdtlucky09112004@gmail.com', '$2y$10$iO/pQgczv8WVkvGJb3XRPu8FMU1MbJafdJNJ8JziT.iu5nleGBrbC', 1, NULL, '');

--
-- Bẫy `customers`
--
DELIMITER $$
CREATE TRIGGER `before_insert_customers` BEFORE INSERT ON `customers` FOR EACH ROW BEGIN
  SET NEW.roles_id = COALESCE(NEW.roles_id, (SELECT id FROM roles WHERE name = 'User'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone_number` varchar(45) NOT NULL,
  `starts` int(11) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(245) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `email`, `phone_number`, `starts`, `description`, `address`, `created_date`, `updated_date`) VALUES
(3, 'Cơ Sở Hà Nội', 'hoangductrung09112004@gmail.com', '0975847485', 5, 'Vừa Đi Vào Hoạt Động', 'Nam Từ liêm Hà Nội', '2023-11-19 09:40:41', '2023-12-14 07:27:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotel_payment`
--

CREATE TABLE `hotel_payment` (
  `id` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `confirmation_code` varchar(30) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `message` tinyint(1) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hotel_payment`
--

INSERT INTO `hotel_payment` (`id`, `transaction_date`, `confirmation_code`, `customer_id`, `price`, `message`, `status`) VALUES
(71, '2023-12-13 11:24:21', '811702441461', 2, 1438112200, 1, 'success'),
(72, '2023-12-14 01:18:31', '821702491511', 2, 438112200, 1, 'success'),
(73, '2023-12-14 13:51:41', '831702536701', 2, 4381122, 1, 'success'),
(74, '2023-12-14 13:52:11', '841702536731', 2, 4381122, 1, 'success'),
(75, '2023-12-14 14:08:27', '851702537707', 2, 8381122, 1, 'success'),
(76, '2023-12-14 14:10:07', '861702537807', 2, 11381122, 1, 'success'),
(77, '2023-12-14 14:13:10', '871702537990', 2, 11381122, 1, 'success'),
(78, '2023-12-14 14:16:08', '881702538168', 2, 9381122, 1, 'success'),
(79, '2023-12-14 14:16:08', '891702538168', 2, 9381122, 1, 'success');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price_per_night` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_path` varchar(455) DEFAULT NULL,
  `available_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `price_per_night`, `capacity`, `facility_id`, `room_type_id`, `created_date`, `updated_date`, `image_path`, `available_date`) VALUES
(50, 'phòng 403', '4.000.000', 2, 3, 8, '2023-11-25 06:50:38', '2023-12-14 07:09:29', 'tải xuống (4).jfif', '2023-12-15'),
(52, 'phòng 202', '2.000.000', 1, 3, 6, '2023-11-25 06:53:38', '2023-12-13 18:18:45', 'tải xuống (2).jfif', '2023-12-15'),
(53, 'phong 325', '7.000.000', 4, 3, 9, '2023-11-26 16:17:42', '2023-12-14 07:26:07', 'tải xuống (3).jfif', '2023-12-15'),
(55, 'phòng 555', '4.000.000', 2, 3, 8, '2023-11-30 09:18:09', '2023-12-14 07:11:09', 'tải xuống (3).jfif', '2023-12-15'),
(57, 'phòng 309', '4.000.000', 1, 3, 7, '2023-11-30 09:18:58', '2023-12-14 07:15:33', 'tải xuống (2).jfif', '2023-12-15'),
(59, 'Single Room', '2.000.000', 1, 3, 6, '2023-12-05 11:24:14', '2023-12-14 07:26:07', 'phong-don.jpeg', '2023-12-15'),
(60, 'phòng 204', '2.000.000', 1, 3, 6, '2023-12-06 11:57:11', '2023-12-13 20:34:01', 'phong-don.jpeg', '2023-12-15'),
(61, 'Phong 532', '2.000.000', 1, 3, 6, '2023-12-13 18:58:00', '2023-12-13 18:58:00', 'tải xuống (2).jfif', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_reservations`
--

CREATE TABLE `room_reservations` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL COMMENT 'Tham chiếu đến phòng đang được đặt, thiết lập mối quan hệ với phòng',
  `checkin_date` datetime NOT NULL,
  `checkout_date` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL DEFAULT 'Chờ Xác Nhận'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT=' ';

--
-- Đang đổ dữ liệu cho bảng `room_reservations`
--

INSERT INTO `room_reservations` (`id`, `customer_id`, `room_id`, `checkin_date`, `checkout_date`, `total_amount`, `created_date`, `updated_date`, `status`) VALUES
(83, 2, 52, '2023-12-14 00:00:00', '2023-12-15 00:00:00', 4381122.00, '2023-12-14 06:51:41', '2023-12-14 06:51:41', 'Chờ Xác Nhận'),
(84, 2, 52, '2023-12-14 00:00:00', '2023-12-15 00:00:00', 4381122.00, '2023-12-14 06:52:11', '2023-12-14 06:52:11', 'Chờ Xác Nhận'),
(85, 2, 50, '2023-12-14 00:00:00', '2023-12-15 00:00:00', 8381122.00, '2023-12-14 07:08:27', '2023-12-14 07:08:27', 'Chờ Xác Nhận'),
(86, 2, 55, '2023-12-14 00:00:00', '2023-12-15 00:00:00', 11381122.00, '2023-12-14 07:10:07', '2023-12-14 07:10:07', 'Chờ Xác Nhận'),
(87, 2, 57, '2023-12-14 00:00:00', '2023-12-15 00:00:00', 11381122.00, '2023-12-14 07:13:10', '2023-12-14 07:13:10', 'Chờ Xác Nhận'),
(88, 2, 53, '2023-12-14 00:00:00', '2023-12-15 00:00:00', 9381122.00, '2023-12-14 07:16:08', '2023-12-14 07:16:08', 'Chờ Xác Nhận'),
(89, 2, 59, '2023-12-14 00:00:00', '2023-12-15 00:00:00', 9381122.00, '2023-12-14 07:16:08', '2023-12-14 07:16:08', 'Chờ Xác Nhận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(445) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_quantity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='loại phòng';

--
-- Đang đổ dữ liệu cho bảng `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `description`, `created_date`, `updated_date`, `total_quantity`) VALUES
(6, 'Single Room', 'Phòng Dành Cho Một Người', '2023-11-24 08:56:44', '2023-12-13 20:01:44', '4'),
(7, 'Luxury Room', 'Được thiết kế sang trọng và hoàn hảo với các tiện nghi hiện đại, đáp ứng mọi kỳ nghỉ thư thái của bạn trong một căn phòng rộng 32m2 với cửa sổ lớn nhìn ra thành phố.', '2023-11-24 08:59:04', '2023-12-12 12:44:09', '1'),
(8, 'Double Room', 'Phong Cho Hai Người', '2023-11-24 08:59:37', '2023-12-12 18:34:05', '2'),
(9, 'Family Room', 'Phòng Cho Gia Đình.', '2023-11-24 09:01:07', '2023-12-13 20:01:50', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_id` (`roles_id`);

--
-- Chỉ mục cho bảng `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hotel_payment`
--
ALTER TABLE `hotel_payment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type_id_idx` (`room_type_id`),
  ADD KEY `hotel_id_idx` (`facility_id`);

--
-- Chỉ mục cho bảng `room_reservations`
--
ALTER TABLE `room_reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_idx` (`room_id`),
  ADD KEY `customer_idx` (`customer_id`);

--
-- Chỉ mục cho bảng `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_idx` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `hotel_payment`
--
ALTER TABLE `hotel_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `room_reservations`
--
ALTER TABLE `room_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT cho bảng `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Các ràng buộc cho bảng `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `facility_id` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`),
  ADD CONSTRAINT `room_type_id` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`);

--
-- Các ràng buộc cho bảng `room_reservations`
--
ALTER TABLE `room_reservations`
  ADD CONSTRAINT `customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
