-- Tạo bảng lưu kết quả phân tích cảm xúc bình luận
CREATE TABLE IF NOT EXISTS `comment_sentiment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_comment` int(11) NOT NULL,
  `sentiment` enum('positive','negative','neutral') NOT NULL DEFAULT 'neutral',
  `score` decimal(3,2) NOT NULL DEFAULT '0.50',
  `confidence` decimal(3,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_comment` (`id_comment`),
  KEY `sentiment` (`sentiment`),
  CONSTRAINT `comment_sentiment_ibfk_1` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id_comment`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

