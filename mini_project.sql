-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
<<<<<<< HEAD
-- Thời gian đã tạo: Th1 11, 2022 lúc 03:42 PM
=======
-- Thời gian đã tạo: Th1 10, 2022 lúc 04:03 PM
>>>>>>> d152dbe84888825ab7a79355d1fd1044f454cead
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mini_project`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_logins_token`
--

CREATE TABLE `tbl_logins_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_logins_token`
--

INSERT INTO `tbl_logins_token` (`id`, `user_id`, `token`) VALUES
(38, 6, 'b3f3adeb17057472d520be3c9dce5408'),
(39, 6, 'ba90e047db935740583201f1fbcaec28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_email`, `user_password`, `user_name`, `user_avatar`, `created_at`, `updated_at`) VALUES
(6, 'khieutrung12@gmail.com', '6c7fafe5183d45bbb5df575ae54549b8', 'thaihung', NULL, NULL, NULL),
(7, 'khieutrung1@gmail.com', '6c7fafe5183d45bbb5df575ae54549b8', 'thaihung1109', NULL, NULL, NULL),
<<<<<<< HEAD
(10, 'khieutrung1234@gmail.com', '6c7fafe5183d45bbb5df575ae54549b8', 'thaihungxyz', NULL, NULL, NULL),
(11, 'khieutrung12345@gmail.com', '6c7fafe5183d45bbb5df575ae54549b8', 'thaihung', '61dd8e8e61eff4.84282346.jpg', '2022-01-11 21:05:02', '2022-01-11 21:05:02'),
(12, 'khieutrung12321@gmail.com', '6c7fafe5183d45bbb5df575ae54549b8', 'thaihung', '61dd92db3b9541.65154207.jpg', '2022-01-11 21:23:23', '2022-01-11 21:23:23');
=======
(10, 'khieutrung1234@gmail.com', '6c7fafe5183d45bbb5df575ae54549b8', 'thaihungxyz', NULL, NULL, NULL);
>>>>>>> d152dbe84888825ab7a79355d1fd1044f454cead

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_logins_token`
--
ALTER TABLE `tbl_logins_token`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_logins_token`
--
ALTER TABLE `tbl_logins_token`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
>>>>>>> d152dbe84888825ab7a79355d1fd1044f454cead

--
-- AUTO_INCREMENT cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
<<<<<<< HEAD
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
=======
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
>>>>>>> d152dbe84888825ab7a79355d1fd1044f454cead
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
