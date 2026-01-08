-- Tạo bảng rating để lưu trữ đánh giá của user cho movie
-- Tạo ngày: 06/01/2026
-- Mục đích: Cho phép user đánh giá phim từ 1-5 sao

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL DEFAULT 0.0 COMMENT 'Đánh giá từ 0.0 đến 5.0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Chỉ mục cho bảng `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_movie` (`id_user`,`id_movie`),
  ADD KEY `idx_user` (`id_user`),
  ADD KEY `idx_movie` (`id_movie`),
  ADD KEY `idx_rating` (`rating`);

--
-- AUTO_INCREMENT cho bảng `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho bảng `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id`) ON DELETE CASCADE;

--
-- Thêm một số dữ liệu mẫu cho bảng rating
--
INSERT INTO `rating` (`id_user`, `id_movie`, `rating`, `created_at`, `updated_at`) VALUES
(39, 14, 5.0, '2025-12-25 10:00:00', '2025-12-25 10:00:00'),
(45, 14, 4.5, '2025-12-25 11:00:00', '2025-12-25 11:00:00'),
(49, 14, 4.0, '2025-12-25 12:00:00', '2025-12-25 12:00:00'),
(39, 13, 4.5, '2025-12-26 10:00:00', '2025-12-26 10:00:00'),
(45, 13, 4.0, '2025-12-26 11:00:00', '2025-12-26 11:00:00'),
(39, 15, 5.0, '2025-12-27 10:00:00', '2025-12-27 10:00:00'),
(49, 15, 4.5, '2025-12-27 11:00:00', '2025-12-27 11:00:00');





