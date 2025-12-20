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

INSERT INTO user VALUES
(34,'bupcute38@gmail.com','202cb962ac59075b964b07152d234b70','Búp','30/12/2003','0796660590','Đà Nẵng',0,NULL,NULL),
(35,'phungntk.21it@vku.udn.vn','e3afed0047b08059d0fada10f400c1e5','Admin','30/12/2003','0796660590','Đà Nẵng',1,NULL,NULL);

-- ===== MOVIE CATEGORY =====
CREATE TABLE movie_category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) UNIQUE NOT NULL
) ENGINE=InnoDB;

INSERT INTO movie_category VALUES
(1,'Kinh Dị'),
(2,'Tình Cảm'),
(3,'Hài Hước'),
(4,'Hoạt Hình'),
(5,'Hành Động'),
(6,'Khoa Học Viễn Tưởng');

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

INSERT INTO movie (
  id, title, duration, director, actor, language, country,
  description, open_date, category, poster,
  image1, image2, image3, image4,
  imgtra1, imgtra2, trailer1, trailer2
) VALUES
(14,'AVATAR 2','150 phút','James Cameron',
 'Sam Worthington, Zoe Saldana',
 'Phụ đề Việt','Mỹ',
 'Phần tiếp theo của Avatar',
 '2022-12-16','Khoa Học Viễn Tưởng',
 'avatar.jpg','a1.jpg','a2.jpg','a3.jpg','a4.jpg',
 'of.jpg','ts.jpg',
 'https://youtube.com/trailer1','https://youtube.com/trailer2'),

(15,'MÈO ĐI HIA','98 phút','Joel Crawford',
 'Antonio Banderas',
 'Phụ đề Việt','Mỹ',
 'Phim hoạt hình mèo đi hia',
 '2022-12-30','Hoạt Hình',
 'meo.jpg','m1.jpg','m2.jpg','m3.jpg','m4.jpg',
 'of2.jpg','ts2.jpg',
 'https://youtube.com/trailer3','https://youtube.com/trailer4');

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

INSERT INTO calendar VALUES
(252,14,'2025-01-10',1,'20:10',60000),
(253,15,'2025-01-11',2,'18:30',65000);

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

INSERT INTO booking VALUES
(5,34,252,'120000',1),
(6,34,253,'65000',1);
