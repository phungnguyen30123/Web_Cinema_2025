-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2025 at 06:24 AM
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
-- Database: `movie_ticket_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_ve` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_calendar` int(11) NOT NULL,
  `tong_tien` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `seats` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_ve`, `id_user`, `id_calendar`, `tong_tien`, `status`, `seats`) VALUES
(1, 49, 254, '140 000 đ', 0, ' F8, F7'),
(2, 49, 255, '210 000 đ', 1, ' E9, E8, E7'),
(3, 49, 258, '110 000 đ', 0, ' D7, D6'),
(4, 49, 255, '245 000 đ', 0, ' J9, G12, C6'),
(5, 49, 255, '110 000 đ', 0, ' C5, C4'),
(6, 49, 255, '140 000 đ', 0, ' G5, G4'),
(7, 49, 255, '140 000 đ', 0, ' G8, G7'),
(8, 49, 255, '110 000 đ', 0, ' D9, D8'),
(9, 49, 268, '55 000 đ', 0, ' B6');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id_calendar` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `day` date DEFAULT NULL,
  `id_phong` int(11) DEFAULT NULL,
  `time` varchar(11) DEFAULT NULL,
  `gia_ve` bigint(20) DEFAULT 60000
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id_calendar`, `id_movie`, `day`, `id_phong`, `time`, `gia_ve`) VALUES
(254, 14, '2025-12-26', 1, '20:10', 60000),
(255, 14, '2025-12-25', 1, '17:30', 60000),
(256, 15, '2025-12-25', 2, '20:10', 60000),
(257, 13, '2025-12-25', NULL, NULL, 60000),
(258, 15, '2025-12-25', 2, '08:00', 60000),
(259, 15, '2025-12-26', 2, '20:10', 60000),
(261, 15, '2025-12-25', 1, '19:30', 60000),
(268, 14, '2025-12-25', 1, '18:30', 60000),
(269, 14, '2025-12-25', 1, '18:30', 60000),
(270, 14, '2025-12-25', 1, '18:30', 60000),
(271, 14, '2025-12-25', 1, '18:30', 60000),
(272, 14, '2025-12-25', 1, '18:30', 60000),
(273, 14, '2025-12-25', 1, '18:30', 60000),
(274, 14, '2025-12-25', 1, '18:30', 60000),
(275, 14, '2025-12-25', 1, '18:30', 60000);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 = chưa xử lý, 1 = đã xử lý',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id_comment`, `id_movie`, `id_user`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 14, 39, 'Phim hay quá, rất đáng xem!', 0, '2025-12-24 12:54:33', '2025-12-24 12:54:33'),
(2, 14, 45, 'Diễn viên diễn xuất tốt, cốt truyện hấp dẫn.', 0, '2025-12-24 12:54:33', '2025-12-24 12:54:33'),
(3, 13, 39, 'Phim vui nhộn, phù hợp với gia đình.', 0, '2025-12-24 12:54:33', '2025-12-24 12:54:33'),
(8, 14, 49, 'hohoaa', 0, '2025-12-24 16:29:28', '2025-12-24 16:31:10'),
(9, 14, 49, 'hihipppp', 0, '2025-12-24 17:42:29', '2025-12-24 17:43:56'),
(10, 14, 49, 'đù má mi', 0, '2025-12-25 18:51:29', '2025-12-25 18:51:29'),
(12, 14, 49, 'đụ mẹ', 0, '2025-12-25 18:51:57', '2025-12-25 18:51:57'),
(13, 14, 49, 'phim hay lắm', 0, '2025-12-25 18:52:20', '2025-12-25 18:55:21'),
(14, 14, 49, 'theo mình thì phim tạm thôi, không hay lắm', 0, '2025-12-25 18:54:13', '2025-12-25 18:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `comment_sentiment`
--

CREATE TABLE `comment_sentiment` (
  `id` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  `sentiment` enum('positive','negative','neutral') NOT NULL DEFAULT 'neutral',
  `score` decimal(3,2) NOT NULL DEFAULT 0.50,
  `confidence` decimal(3,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment_sentiment`
--

INSERT INTO `comment_sentiment` (`id`, `id_comment`, `sentiment`, `score`, `confidence`, `created_at`, `updated_at`) VALUES
(1, 10, 'neutral', 0.50, 0.30, '2025-12-25 12:51:29', '2025-12-25 12:51:29'),
(3, 12, 'neutral', 0.50, 0.30, '2025-12-25 12:51:57', '2025-12-25 12:51:57'),
(4, 13, 'negative', 0.00, 0.67, '2025-12-25 12:52:20', '2025-12-25 12:52:20'),
(5, 14, 'positive', 0.67, 1.00, '2025-12-25 12:54:13', '2025-12-25 12:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `momo`
--

CREATE TABLE `momo` (
  `id` int(11) NOT NULL,
  `partnerCode` varchar(50) DEFAULT NULL,
  `orderId` varchar(50) DEFAULT NULL,
  `requestId` varchar(50) DEFAULT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `orderInfo` varchar(50) DEFAULT NULL,
  `orderType` varchar(50) DEFAULT NULL,
  `transId` varchar(50) DEFAULT NULL,
  `payType` varchar(50) DEFAULT NULL,
  `signature` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `momo`
--

INSERT INTO `momo` (`id`, `partnerCode`, `orderId`, `requestId`, `amount`, `orderInfo`, `orderType`, `transId`, `payType`, `signature`) VALUES
(1, 'MOMOBKUN20180529', '17666623901061', '1766662390', '110000', 'Thanh toán vé xem phim - AVATAR - DÒNG CHẢY CỦA NƯ', 'momo_wallet', '4636196484', 'napas', 'a6e8c61f40c5a5aaae4732a167b46f657d3f5464e26fc6eb74'),
(2, 'MOMOBKUN20180529', '17666625708113', '1766662570', '140000', 'Thanh toán vé xem phim - AVATAR - DÒNG CHẢY CỦA NƯ', 'momo_wallet', '4636176999', 'napas', '86c57f6bc45ef80ac6b0a34beb138dcf1e0a320162b6dc5441');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `actor` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `open_date` date DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `imgtra1` varchar(255) DEFAULT NULL,
  `imgtra2` varchar(255) DEFAULT NULL,
  `trailer1` varchar(500) DEFAULT NULL,
  `trailer2` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `title`, `duration`, `director`, `actor`, `language`, `country`, `description`, `open_date`, `category`, `poster`, `image1`, `image2`, `image3`, `image4`, `imgtra1`, `imgtra2`, `trailer1`, `trailer2`) VALUES
(13, 'TẤM VÉ ĐẾN THIÊN ĐƯỜNG', '105 phút', 'Ol Parker', 'George Clooney, Julia Roberts, Kaitlyn Dever, Maxime Bouttier', 'Phụ đề Tiếng Việt', NULL, 'Hai diễn viên kỳ cựu của Hollywood - George Clooney và Julia Roberts sẽ tái hợp trên màn ảnh rộng trong vai đôi vợ chồng đã li hôn, nhưng lại cùng chung sứ mệnh ngăn cản cuộc kết hôn của đứa con gái yêu. Bởi họ sợ rằng con gái đang mắc phải sai lầm tương tự điều mà họ đã từng trải qua. Ticket to Paradise là một bộ phim hài lãng mạn về sự ngọt ngào bất ngờ của \"cơ hội thứ hai”.', '2025-12-24', 'Hài Hước', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvtd.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvtd1.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvtd2.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvtd3.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvtd4.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvdtd_of.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvdtd_ts.jpg', ' https://www.youtube.com/watch?v=g8ona3jTuys  ', ' https://www.youtube.com/watch?v=g8ona3jTuys  '),
(14, 'AVATAR - DÒNG CHẢY CỦA NƯỚC', '150 phút', 'James Cameron', 'Sam Worthington, Zoe Saldana, Dương Tử Quỳnh,...', 'Phụ đề Tiếng Việt', 'Mỹ', 'Câu chuyện của “Avatar: Dòng Chảy Của Nước” lấy bối cảnh 10 năm sau những sự kiện xảy ra ở phần đầu tiên. Phim kể câu chuyện về gia đình mới của Jake Sully (Sam Worthington thủ vai) cùng những rắc rối theo sau và bi kịch họ phải chịu đựng khi phe loài người xâm lược hành tinh Pandora.', '2025-12-20', 'Khoa Học Viễn Tưởng', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766578903/web_cinema/movies/14/ev7g0xrfyleauennbieu.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766564563/web_cinema/movies/14/t1gqinws7yhlrszo0tnf.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766564565/web_cinema/movies/14/rtm7yq0fv18fng88gkec.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766564566/web_cinema/movies/14/fmlzp0lcf3wxcsjhliz2.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766564568/web_cinema/movies/14/nsja2j38mm8znihbacsh.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766564819/web_cinema/movies/14/rdxnnhzhnjqb2xifcufn.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766576054/web_cinema/movies/14/k47vh5upaho6m71l3brl.jpg', 'https://www.youtube.com/watch?v=gq2xKJXYZ80      ', 'https://www.youtube.com/watch?v=bf4yyStDWHE    '),
(15, 'MÈO ĐI HIA - ĐIỀU ƯỚC CUỐI CÙNG', '98 phút', 'Joel Crawford', 'Antonio Banderas, Harvey Guillén, Olivia Colman, Salma Hayek, Samson Kayo', 'Phụ đề Tiếng Việt', 'Mỹ', 'Phim MÈO ĐI HIA: ĐIỀU ƯỚC CUỐI CÙNG  chú mèo yêu thích của chúng ta sẽ trở lại màn ảnh rộng trong những gì các nhà sản xuất mô tả. Nửa giờ đầu tiên của bộ phim hoạt hình  đã được chiếu trước trong Liên hoan phim hoạt hình quốc tế Annecy . Đầu tiên trong tâm trí của đạo diễn không chỉ giới thiệu lại Puss với thế giới, mà còn giới thiệu thế giới về vị trí của nhân vật chú mèo Đinhia này.', '2025-12-21', 'Hoạt Hình', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766576583/web_cinema/movies/15/ftxb6bp1ssvf40fexhyr.png', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766576586/web_cinema/movies/15/kumvho4bd0zunrjbqdrm.png', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766576588/web_cinema/movies/15/snylygohrbs6myannlxt.png', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766576591/web_cinema/movies/15/fzwey3kqcpxc6fg4qbmu.png', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766576593/web_cinema/movies/15/hqc4ldan6hm8dlhtwfij.png', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766576801/web_cinema/movies/15/quf03xc9dathxqet2ukn.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766576802/web_cinema/movies/15/qutzxfdc0nqrszaqj1cr.jpg', ' https://www.youtube.com/watch?v=rcpuVDA9JPY           ', ' https://www.youtube.com/watch?v=rcpuVDA9JPY           '),
(18, 'FAST & FURIOUS 10', '140 phút', 'Louis Leterrier', 'Vin Diesel, Jason Momoa', 'Phụ đề Việt', 'Mỹ', 'Phần mới nhất của loạt phim Fast & Furious', '2025-12-19', 'Hành Động', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766578045/web_cinema/movies/18/yf2q1cntedirhd9k8bw4.jpg', 'f1.jpg', 'f2.jpg', 'f3.jpg', 'f4.jpg', 'of_fast.jpg', 'ts_fast.jpg', 'https://youtube.com/fast_trailer1 ', 'https://youtube.com/fast_trailer2 '),
(19, 'CONAN: TÀU NGẦM SẮT MÀU ĐEN', '110 phút', 'Yuzuru Tachikawa', 'Conan Edogawa', 'Phụ đề Việt', 'Nhật Bản', 'Thám tử lừng danh Conan bản điện ảnh', '2025-12-30', 'Hoạt Hình', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766577450/web_cinema/movies/19/awzbf5ejpsne1mfoygib.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766577452/web_cinema/movies/19/wlixbgkqarstshl3nth4.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766577454/web_cinema/movies/19/wgztkvkw8czoctwvfjtp.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766577456/web_cinema/movies/19/o7jc8ic2jlyfkibft2xu.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766577458/web_cinema/movies/19/oelacl838ret2dkybpzt.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766577460/web_cinema/movies/19/kfxv04td7tnpxlehhryz.jpg', 'https://res.cloudinary.com/dv4syzarc/image/upload/v1766577464/web_cinema/movies/19/magog7lisjgnhdtibhuv.jpg', 'https://www.youtube.com/watch?v=NwnQI9izPFc', 'https://www.youtube.com/watch?v=NwnQI9izPFc');

-- --------------------------------------------------------

--
-- Table structure for table `movie_category`
--

CREATE TABLE `movie_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `movie_category`
--

INSERT INTO `movie_category` (`id`, `title`) VALUES
(8, 'Gia Đình'),
(3, 'Hài Hước'),
(5, 'Hành Động'),
(4, 'Hoạt Hình'),
(6, 'Khoa Học Viễn Tưởng'),
(1, 'Kinh Dị'),
(7, 'Phiêu Lưu'),
(2, 'Tình Cảm');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `ten_phong` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id_room`, `ten_phong`) VALUES
(1, 'Phòng 1'),
(2, 'Phòng 2'),
(3, 'Phòng 3'),
(4, 'Phòng 4');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `sdt` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `fullname`, `birthday`, `sdt`, `address`, `is_admin`, `created`, `modified`) VALUES
(35, 'phungntk.21it@vku.udn.vn', 'e3afed0047b08059d0fada10f400c1e5', 'Búp', '30/12/2003', '0796660590', 'Đà Nẵng', 1, NULL, NULL),
(39, 'kimphung30123@gmail.com', '202cb962ac59075b964b07152d234b70', 'Phung', '2003-12-30', '0796660590', 'DN', 0, NULL, NULL),
(45, 'bupcute38@gmail.com', '4157c0d2d00b445783cda381a1b3cc08', 'Búp', '2003-12-31', '0567188403', 'DN', 1, NULL, NULL),
(49, 'phanquan17803@gmail.com', '2e5431b35cb57f01a96d8d674f5d3aa2', 'Quân', '2003-08-17', '0932610014', 'DN', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vnpay`
--

CREATE TABLE `vnpay` (
  `id` int(11) NOT NULL,
  `vnp_Amount` varchar(50) DEFAULT NULL,
  `vnp_BankCode` varchar(50) DEFAULT NULL,
  `vnp_BankTranNo` varchar(50) DEFAULT NULL,
  `vnp_CardType` varchar(50) DEFAULT NULL,
  `vnp_OrderInfo` varchar(255) DEFAULT NULL,
  `vnp_PayDate` varchar(20) DEFAULT NULL,
  `vnp_ResponseCode` varchar(10) DEFAULT NULL,
  `vnp_TmnCode` varchar(20) DEFAULT NULL,
  `vnp_TransactionNo` varchar(50) DEFAULT NULL,
  `vnp_TransactionStatus` varchar(10) DEFAULT NULL,
  `vnp_TxnRef` varchar(50) DEFAULT NULL,
  `vnp_SecureHash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vnpay`
--

INSERT INTO `vnpay` (`id`, `vnp_Amount`, `vnp_BankCode`, `vnp_BankTranNo`, `vnp_CardType`, `vnp_OrderInfo`, `vnp_PayDate`, `vnp_ResponseCode`, `vnp_TmnCode`, `vnp_TransactionNo`, `vnp_TransactionStatus`, `vnp_TxnRef`, `vnp_SecureHash`) VALUES
(1, '14000000', 'NCB', 'VNP15368601', 'ATM', 'Noi dung thanh toan', '20251225184016', '00', '0Y2DZ2YT', '15368601', '00', '2808', '791dde4d50dd34ba13931b85bc2d45fb065dd7a3876041ab753b1c7b338cd1a634db557d9f54a84c1f5bb94c726c5ed56125320c159a442284e622fd4d9d2f7e'),
(2, '11000000', 'VNPAY', NULL, 'QRCODE', 'Noi dung thanh toan', '20251225193932', '24', '0Y2DZ2YT', '0', '02', '3471', 'f6e4e361918a9459d82c9beae49259f30c50c2d6ef3f9f5ea411e1d06d532aee0a69af4db512aa1d26d427358c11fd55fecead4241602fb4f6818fe9450389fb'),
(3, '11000000', 'VNPAY', NULL, 'QRCODE', 'Noi dung thanh toan', '20251225193932', '24', '0Y2DZ2YT', '0', '02', '3471', 'f6e4e361918a9459d82c9beae49259f30c50c2d6ef3f9f5ea411e1d06d532aee0a69af4db512aa1d26d427358c11fd55fecead4241602fb4f6818fe9450389fb'),
(4, '11000000', 'VNPAY', NULL, 'QRCODE', 'Noi dung thanh toan', '20251225193932', '24', '0Y2DZ2YT', '0', '02', '3471', 'f6e4e361918a9459d82c9beae49259f30c50c2d6ef3f9f5ea411e1d06d532aee0a69af4db512aa1d26d427358c11fd55fecead4241602fb4f6818fe9450389fb'),
(5, '5500000', 'VNPAY', NULL, 'QRCODE', 'Noi dung thanh toan', '20251225203918', '24', '0Y2DZ2YT', '0', '02', '6036', 'd4ff4167a2a4ece6e4c178f37960a6f0667f9335bb8a663875009ac5120f38a3a1feab282853ff5c0e1f34e3bbde8a61eea773ce38fe948d2206727bf4813241'),
(6, '5500000', 'VNPAY', NULL, 'QRCODE', 'Noi dung thanh toan', '20251225203918', '24', '0Y2DZ2YT', '0', '02', '6036', 'd4ff4167a2a4ece6e4c178f37960a6f0667f9335bb8a663875009ac5120f38a3a1feab282853ff5c0e1f34e3bbde8a61eea773ce38fe948d2206727bf4813241');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_ve`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_calendar` (`id_calendar`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id_calendar`),
  ADD KEY `id_movie` (`id_movie`),
  ADD KEY `id_phong` (`id_phong`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `idx_movie` (`id_movie`),
  ADD KEY `idx_user` (`id_user`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `comment_sentiment`
--
ALTER TABLE `comment_sentiment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_comment` (`id_comment`),
  ADD KEY `sentiment` (`sentiment`);

--
-- Indexes for table `momo`
--
ALTER TABLE `momo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `movie_category`
--
ALTER TABLE `movie_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vnpay`
--
ALTER TABLE `vnpay`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_ve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id_calendar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comment_sentiment`
--
ALTER TABLE `comment_sentiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `momo`
--
ALTER TABLE `momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `movie_category`
--
ALTER TABLE `movie_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `vnpay`
--
ALTER TABLE `vnpay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_calendar`) REFERENCES `calendar` (`id_calendar`);

--
-- Constraints for table `calendar`
--
ALTER TABLE `calendar`
  ADD CONSTRAINT `calendar_ibfk_1` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `calendar_ibfk_2` FOREIGN KEY (`id_phong`) REFERENCES `room` (`id_room`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_sentiment`
--
ALTER TABLE `comment_sentiment`
  ADD CONSTRAINT `comment_sentiment_ibfk_1` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id_comment`) ON DELETE CASCADE;

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`category`) REFERENCES `movie_category` (`title`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
