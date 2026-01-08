<?php
// Test script để chạy migration tạo bảng rating
// Kết nối đến database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'movie_ticket_db';

// Kết nối MySQL
$conn = new mysqli($host, $user, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

echo "Đã kết nối thành công đến database '$dbname'\n";

// Đọc file SQL
$sql = file_get_contents('create_rating_table.sql');

if (!$sql) {
    die("Không thể đọc file create_rating_table.sql\n");
}

// Tách các câu lệnh SQL
$statements = array_filter(array_map('trim', explode(';', $sql)));

$success = 0;
$errors = 0;

foreach ($statements as $statement) {
    if (!empty($statement)) {
        echo "Đang thực thi: " . substr($statement, 0, 50) . "...\n";

        if ($conn->query($statement) === TRUE) {
            echo "✓ Thành công\n";
            $success++;
        } else {
            echo "✗ Lỗi: " . $conn->error . "\n";
            $errors++;
        }
    }
}

echo "\nKết quả:\n";
echo "- Câu lệnh thành công: $success\n";
echo "- Câu lệnh thất bại: $errors\n";

// Đóng kết nối
$conn->close();
?>





