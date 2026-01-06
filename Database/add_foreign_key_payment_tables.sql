-- Migration: Thêm khóa ngoại cho bảng vnpay và momo liên kết với bảng booking
-- Ngày tạo: 04/01/2026

-- Thêm cột id_booking vào bảng momo
ALTER TABLE `momo`
ADD COLUMN `id_booking` INT(11) DEFAULT NULL AFTER `signature`,
ADD CONSTRAINT `fk_momo_booking` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_ve`) ON DELETE SET NULL ON UPDATE CASCADE;

-- Thêm cột id_booking vào bảng vnpay
ALTER TABLE `vnpay`
ADD COLUMN `id_booking` INT(11) DEFAULT NULL AFTER `vnp_SecureHash`,
ADD CONSTRAINT `fk_vnpay_booking` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_ve`) ON DELETE SET NULL ON UPDATE CASCADE;

-- Thêm index để tối ưu hiệu suất truy vấn
ALTER TABLE `momo` ADD KEY `idx_momo_booking` (`id_booking`);
ALTER TABLE `vnpay` ADD KEY `idx_vnpay_booking` (`id_booking`);

COMMIT;


