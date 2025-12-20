CREATE DATABASE IF NOT EXISTS movie_ticket_db CHARACTER SET utf8;
USE movie_ticket_db;

-- ===== DROP TABLE (đúng thứ tự FK) =====
DROP TABLE IF EXISTS booking;
DROP TABLE IF EXISTS calendar;
DROP TABLE IF EXISTS movie;
DROP TABLE IF EXISTS room;
DROP TABLE IF EXISTS movie_category;
DROP TABLE IF EXISTS user;

-- ===== USER =====
CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL,
  password TEXT NOT NULL,
  fullname VARCHAR(255),
  birthday VARCHAR(255),
  sdt VARCHAR(255),
  address VARCHAR(255),
  is_admin TINYINT DEFAULT 0,
  created DATETIME,
  modified DATETIME
) ENGINE=InnoDB;

-- ===== MOVIE CATEGORY =====
CREATE TABLE movie_category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) UNIQUE NOT NULL
) ENGINE=InnoDB;

-- ===== MOVIE =====
CREATE TABLE movie (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) UNIQUE NOT NULL,
  duration VARCHAR(255),
  director VARCHAR(255),
  actor VARCHAR(255),
  language VARCHAR(255),
  country VARCHAR(50),
  description TEXT,
  open_date DATE,
  category VARCHAR(255),
  poster VARCHAR(255),
  image1 VARCHAR(255),
  image2 VARCHAR(255),
  image3 VARCHAR(255),
  image4 VARCHAR(255),
  imgtra1 VARCHAR(255),
  imgtra2 VARCHAR(255),
  trailer1 VARCHAR(500),
  trailer2 VARCHAR(500),
  FOREIGN KEY (category) REFERENCES movie_category(title)
) ENGINE=InnoDB;

-- ===== ROOM =====
CREATE TABLE room (
  id_room INT AUTO_INCREMENT PRIMARY KEY,
  ten_phong VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

INSERT INTO room VALUES
(1,'Phòng 1'),
(2,'Phòng 2'),
(3,'Phòng 3'),
(4,'Phòng 4');

-- ===== CALENDAR =====
CREATE TABLE calendar (
  id_calendar INT AUTO_INCREMENT PRIMARY KEY,
  id_movie INT NOT NULL,
  day DATE,
  id_phong INT,
  time VARCHAR(11),
  gia_ve BIGINT DEFAULT 60000,
  FOREIGN KEY (id_movie) REFERENCES movie(id),
  FOREIGN KEY (id_phong) REFERENCES room(id_room)
) ENGINE=InnoDB;

-- ===== BOOKING =====
CREATE TABLE booking (
  id_ve INT AUTO_INCREMENT PRIMARY KEY,
  id_user INT NOT NULL,
  id_calendar INT NOT NULL,
  tong_tien VARCHAR(255),
  status TINYINT,
  FOREIGN KEY (id_user) REFERENCES user(id),
  FOREIGN KEY (id_calendar) REFERENCES calendar(id_calendar)
) ENGINE=InnoDB;

-- ===== INSERT DATA =====
INSERT INTO `calendar` (`id_calendar`, `id_movie`, `day`, `id_phong`, `time`, `gia_ve`) VALUES
    (252, 14, '2025-12-20', 1, '20:10', 60000),
    (253, 14, '2025-12-20', 1, '12:12', 60000),
    (254, 14, '2025-12-21', 1, '20:10', 60000);

    --
    -- Dumping data for table `movie`
    --

    INSERT INTO `movie` (`id`, `title`, `duration`, `director`, `actor`, `language`, `country`, `description`, `open_date`, `category`, `poster`, `image1`, `image2`, `image3`, `image4`, `imgtra1`, `imgtra2`, `trailer1`, `trailer2`) VALUES
    (13, 'TẤM VÉ ĐẾN THIÊN ĐƯỜNG', '105 phút', 'Ol Parker', 'George Clooney, Julia Roberts, Kaitlyn Dever, Maxime Bouttier', 'Phụ đề Tiếng Việt', NULL, 'Hai diễn viên kỳ cựu của Hollywood - George Clooney và Julia Roberts sẽ tái hợp trên màn ảnh rộng trong vai đôi vợ chồng đã li hôn, nhưng lại cùng chung sứ mệnh ngăn cản cuộc kết hôn của đứa con gái yêu. Bởi họ sợ rằng con gái đang mắc phải sai lầm tương tự điều mà họ đã từng trải qua. Ticket to Paradise là một bộ phim hài lãng mạn về sự ngọt ngào bất ngờ của \"cơ hội thứ hai”.', '2025-12-24', 'Hài Hước', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvtd.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvtd1.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvtd2.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvtd3.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvtd4.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvdtd_of.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/tamvdtd_ts.jpg', ' https://www.youtube.com/watch?v=g8ona3jTuys  ', ' https://www.youtube.com/watch?v=g8ona3jTuys  '),
    (14, 'AVATAR - DÒNG CHẢY CỦA NƯỚC', '150 phút', 'James Cameron', 'Sam Worthington, Zoe Saldana, Dương Tử Quỳnh,...', 'Phụ đề Tiếng Việt', 'Mỹ', 'Câu chuyện của “Avatar: Dòng Chảy Của Nước” lấy bối cảnh 10 năm sau những sự kiện xảy ra ở phần đầu tiên. Phim kể câu chuyện về gia đình mới của Jake Sully (Sam Worthington thủ vai) cùng những rắc rối theo sau và bi kịch họ phải chịu đựng khi phe loài người xâm lược hành tinh Pandora.', '2025-12-14', 'Khoa Học Viễn Tưởng', 'http://localhost/Doan_Banvexemphim/Fileupload/avatar.jpg', 'http://localhost/Web_Cinema-main/Fileupload/tải xuống.jpg', 'http://localhost/Web_Cinema-main/Fileupload/images (3).jpg', 'http://localhost/Web_Cinema-main/Fileupload/images (1).jpg', 'http://localhost/Web_Cinema-main/Fileupload/images (2).jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/avatar_of.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/avatar_tss.jpg', ' https://www.youtube.com/watch?v=oeRG9A6bDdY                ', ' https://www.youtube.com/watch?v=oeRG9A6bDdY                '),
    (15, 'MÈO ĐI HIA - ĐIỀU ƯỚC CUỐI CÙNG', '98 phút', 'Joel Crawford', 'Antonio Banderas, Harvey Guillén, Olivia Colman, Salma Hayek, Samson Kayo', 'Phụ đề Tiếng Việt', 'Mỹ', 'Phim MÈO ĐI HIA: ĐIỀU ƯỚC CUỐI CÙNG  chú mèo yêu thích của chúng ta sẽ trở lại màn ảnh rộng trong những gì các nhà sản xuất mô tả. Nửa giờ đầu tiên của bộ phim hoạt hình  đã được chiếu trước trong Liên hoan phim hoạt hình quốc tế Annecy . Đầu tiên trong tâm trí của đạo diễn không chỉ giới thiệu lại Puss với thế giới, mà còn giới thiệu thế giới về vị trí của nhân vật chú mèo Đinhia này.', '2025-12-14', 'Hoạt Hình', 'http://localhost/Web_Cinema-main/Fileupload/1765805525_69400dd596b6d_Poster.jpg', 'http://localhost/Web_Cinema-main/Fileupload/1765805632_69400e407a8ff_tixung.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/meohia2.png', 'http://localhost/Web_Cinema-main/Fileupload/1765805625_69400e39e43e6_tixung.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/meohia4.png', 'http://localhost/Doan_Banvexemphim/Fileupload/meo_of.jpg', 'http://localhost/Doan_Banvexemphim/Fileupload/meo_ts.jpg', ' https://www.youtube.com/watch?v=rcpuVDA9JPY         ', ' https://www.youtube.com/watch?v=rcpuVDA9JPY         '),
    (18, 'FAST & FURIOUS 10', '140 phút', 'Louis Leterrier', 'Vin Diesel, Jason Momoa', 'Phụ đề Việt', 'Mỹ', 'Phần mới nhất của loạt phim Fast & Furious', '2025-12-19', 'Hành Động', 'fast10.jpg', 'f1.jpg', 'f2.jpg', 'f3.jpg', 'f4.jpg', 'of_fast.jpg', 'ts_fast.jpg', 'https://youtube.com/fast_trailer1', 'https://youtube.com/fast_trailer2'),
    (19, 'CONAN: TÀU NGẦM SẮT MÀU ĐEN', '110 phút', 'Yuzuru Tachikawa', 'Conan Edogawa', 'Phụ đề Việt', 'Nhật Bản', 'Thám tử lừng danh Conan bản điện ảnh', '2025-12-19', 'Hoạt Hình', 'conan.jpg', 'c1.jpg', 'c2.jpg', 'c3.jpg', 'c4.jpg', 'of_conan.jpg', 'ts_conan.jpg', 'https://youtube.com/conan_trailer1', 'https://youtube.com/conan_trailer2');

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

    --
    -- Dumping data for table `room`
    --

    INSERT INTO `room` (`id_room`, `ten_phong`) VALUES
    (1, 'Phòng 1'),
    (2, 'Phòng 2'),
    (3, 'Phòng 3'),
    (4, 'Phòng 4');

    --
    -- Dumping data for table `user`
    --

    INSERT INTO `user` (`id`, `email`, `password`, `password_re`, `fullname`, `birthday`, `sdt`, `address`, `is_admin`, `created`, `modified`) VALUES
    (35, 'phungntk.21it@vku.udn.vn', 'e3afed0047b08059d0fada10f400c1e5', 'e3afed0047b08059d0fada10f400c1e5', 'Búp', '30/12/2003', '0796660590', 'Đà Nẵng', 1, NULL, NULL),
    (39, 'kimphung30123@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'Phung', '2003-12-30', '0796660590', 'DN', 0, NULL, NULL),
    (45, 'bupcute38@gmail.com', '4157c0d2d00b445783cda381a1b3cc08', '', 'Búp Nguyễn ', '2003-12-31', '0567188403', 'DN', 0, NULL, NULL),
    (49, 'phanquan17803@gmail.com', '2e5431b35cb57f01a96d8d674f5d3aa2', '', 'Quân', '2003-08-17', '0932610014', 'DN', 2, NULL, NULL),
    (50, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'A', '2025-12-25', '0966443517', '432 quốc lộ 9', 0, NULL, NULL),
    (51, 'user1@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'Nguyễn Văn A', '2002-05-12', '0901111111', 'Huế', 0, '2025-12-20 17:09:35', '2025-12-20 17:09:35'),
    (52, 'user2@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'Trần Thị B', '2001-08-20', '0902222222', 'Quảng Nam', 0, '2025-12-20 17:09:35', '2025-12-20 17:09:35'),
    (53, 'admin2@gmail.com', 'e3afed0047b08059d0fada10f400c1e5', '', 'Admin 2', '1998-01-01', '0909999999', 'Đà Nẵng', 1, '2025-12-20 17:09:35', '2025-12-20 17:09:35'),
    (54, 'user1@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'Nguyễn Văn A', '2002-05-12', '0901111111', 'Huế', 0, '2025-12-20 17:10:26', '2025-12-20 17:10:26'),
    (55, 'user2@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'Trần Thị B', '2001-08-20', '0902222222', 'Quảng Nam', 0, '2025-12-20 17:10:26', '2025-12-20 17:10:26'),
    (56, 'admin2@gmail.com', 'e3afed0047b08059d0fada10f400c1e5', '', 'Admin 2', '1998-01-01', '0909999999', 'Đà Nẵng', 1, '2025-12-20 17:10:26', '2025-12-20 17:10:26');
    COMMIT;
