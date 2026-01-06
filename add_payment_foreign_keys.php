<?php
// Migration: Thêm khóa ngoại cho bảng vnpay và momo
// Chạy file này để thêm foreign key liên kết với bảng booking

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie_ticket_db";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

echo "Đang thực hiện migration...<br>";

// Thêm foreign key cho bảng momo
$sql_momo = "ALTER TABLE `momo`
ADD COLUMN `id_booking` INT(11) DEFAULT NULL AFTER `signature`,
ADD CONSTRAINT `fk_momo_booking` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_ve`) ON DELETE SET NULL ON UPDATE CASCADE";

if ($conn->query($sql_momo) === TRUE) {
    echo "✓ Đã thêm khóa ngoại cho bảng momo<br>";
} else {
    echo "✗ Lỗi thêm khóa ngoại cho bảng momo: " . $conn->error . "<br>";
}

// Thêm foreign key cho bảng vnpay
$sql_vnpay = "ALTER TABLE `vnpay`
ADD COLUMN `id_booking` INT(11) DEFAULT NULL AFTER `vnp_SecureHash`,
ADD CONSTRAINT `fk_vnpay_booking` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_ve`) ON DELETE SET NULL ON UPDATE CASCADE";

if ($conn->query($sql_vnpay) === TRUE) {
    echo "✓ Đã thêm khóa ngoại cho bảng vnpay<br>";
} else {
    echo "✗ Lỗi thêm khóa ngoại cho bảng vnpay: " . $conn->error . "<br>";
}

// Thêm index để tối ưu hiệu suất
$sql_index_momo = "ALTER TABLE `momo` ADD KEY `idx_momo_booking` (`id_booking`)";
$sql_index_vnpay = "ALTER TABLE `vnpay` ADD KEY `idx_vnpay_booking` (`id_booking`)";

if ($conn->query($sql_index_momo) === TRUE) {
    echo "✓ Đã thêm index cho bảng momo<br>";
} else {
    echo "✗ Lỗi thêm index cho bảng momo: " . $conn->error . "<br>";
}

if ($conn->query($sql_index_vnpay) === TRUE) {
    echo "✓ Đã thêm index cho bảng vnpay<br>";
} else {
    echo "✗ Lỗi thêm index cho bảng vnpay: " . $conn->error . "<br>";
}

echo "<br>Migration hoàn thành!<br>";
echo "Các bảng vnpay và momo giờ đã có khóa ngoại liên kết với bảng booking.<br>";

$conn->close();
?>


