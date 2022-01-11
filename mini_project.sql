-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 10, 2022 lúc 04:03 PM
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
(1, 6, 'b9164bce1fa7da49f10b617a6abde771'),
(2, 6, '7e729b433971ad8e995541f707054e58'),
(3, 6, 'b3f680a025baa760d2e70a0e9ff7ff01'),
(4, 6, '601a51ccab6734a5e239aaa3d322f468'),
(5, 6, '91bd41cdb94ef506543b542b08883317'),
(6, 6, '76494711eeed93ef8de0eeeaed06966c'),
(7, 6, 'ae17faabbcbfa55201d99ccc495c6aeb'),
(8, 6, 'fd9a8fa328865c97d6a21de805e161f4'),
(9, 6, '5210a50394fe9fbd2501ef160852f583'),
(10, 6, '186debbb3053cedb1309a50edad4871e'),
(11, 6, '5fdb5fd1f10f8db01d20a24235588add'),
(12, 6, 'fb79d67707508fecd97e601c6829f994'),
(13, 6, 'f4029cfc83e7916d6343acd8ab0af5dc'),
(14, 6, '107429d2aa9d7759dacdf78eccfccced'),
(15, 6, '80a78456d5d7a087ee54911fc97b304d'),
(16, 6, 'adcc4c66fe8257eed443f73bcea2a297'),
(17, 6, '82169f2d933531f5bfb32210c2f2a033'),
(18, 6, '912b56141e320828c1997abd34f06921'),
(19, 6, 'cedc7af37a3374cc4222a3cf032983aa'),
(20, 6, 'bcc8718a071a1eee1238b2daff3e3348');

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
(10, 'khieutrung1234@gmail.com', '6c7fafe5183d45bbb5df575ae54549b8', 'thaihungxyz', NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
