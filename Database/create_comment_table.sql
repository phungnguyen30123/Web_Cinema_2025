-- Tạo bảng comment để lưu bình luận của người dùng về phim
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` INT AUTO_INCREMENT PRIMARY KEY,
  `id_movie` INT NOT NULL,
  `id_user` INT NOT NULL,
  `content` TEXT NOT NULL,
  `status` TINYINT DEFAULT 0 COMMENT '0 = chưa xử lý, 1 = đã xử lý',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_movie`) REFERENCES `movie`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_user`) REFERENCES `user`(`id`) ON DELETE CASCADE,
  INDEX `idx_movie` (`id_movie`),
  INDEX `idx_user` (`id_user`),
  INDEX `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Thêm một số bình luận mẫu để test (tùy chọn)
-- INSERT INTO `comment` (`id_movie`, `id_user`, `content`, `status`) VALUES
-- (14, 39, 'Phim hay quá, rất đáng xem!', 0),
-- (14, 45, 'Diễn viên diễn xuất tốt, cốt truyện hấp dẫn.', 0),
-- (13, 39, 'Phim vui nhộn, phù hợp với gia đình.', 0);






