<?php
// Script kiểm tra bảng rating đã được tạo thành công
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'movie_ticket_db';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

echo "=== KIỂM TRA BẢNG RATING ===\n\n";

// 1. Kiểm tra bảng có tồn tại không
$result = $conn->query("SHOW TABLES LIKE 'rating'");
if ($result->num_rows > 0) {
    echo "✓ Bảng 'rating' đã được tạo thành công\n";
} else {
    echo "✗ Bảng 'rating' chưa được tạo\n";
    exit;
}

// 2. Hiển thị cấu trúc bảng
echo "\n=== CẤU TRÚC BẢNG RATING ===\n";
$result = $conn->query("DESCRIBE rating");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "- {$row['Field']}: {$row['Type']} ";
        if ($row['Key'] == 'PRI') echo "(PRIMARY KEY) ";
        if ($row['Key'] == 'UNI') echo "(UNIQUE) ";
        if ($row['Key'] == 'MUL') echo "(INDEX) ";
        if ($row['Null'] == 'NO') echo "(NOT NULL) ";
        if ($row['Default']) echo "DEFAULT '{$row['Default']}' ";
        if ($row['Extra']) echo "[{$row['Extra']}] ";
        echo "\n";
    }
}

// 3. Hiển thị dữ liệu mẫu
echo "\n=== DỮ LIỆU MẪU TRONG BẢNG RATING ===\n";
$result = $conn->query("SELECT r.id, u.fullname, m.title, r.rating, r.created_at
                       FROM rating r
                       JOIN user u ON r.id_user = u.id
                       JOIN movie m ON r.id_movie = m.id
                       ORDER BY r.created_at DESC");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: {$row['id']} | User: {$row['fullname']} | Movie: {$row['title']} | Rating: {$row['rating']} sao | Thời gian: {$row['created_at']}\n";
    }
} else {
    echo "Không có dữ liệu mẫu\n";
}

// 4. Kiểm tra foreign key constraints
echo "\n=== KIỂM TRA FOREIGN KEY CONSTRAINTS ===\n";
$result = $conn->query("SELECT CONSTRAINT_NAME, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
                       FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                       WHERE REFERENCED_TABLE_SCHEMA = 'movie_ticket_db'
                       AND TABLE_NAME = 'rating'");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "- {$row['CONSTRAINT_NAME']}: {$row['TABLE_NAME']}.{$row['COLUMN_NAME']} -> {$row['REFERENCED_TABLE_NAME']}.{$row['REFERENCED_COLUMN_NAME']}\n";
    }
}

// 5. Kiểm tra indexes
echo "\n=== KIỂM TRA INDEXES ===\n";
$result = $conn->query("SHOW INDEX FROM rating");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "- {$row['Key_name']}: {$row['Column_name']} ";
        if ($row['Non_unique'] == 0) echo "(UNIQUE) ";
        echo "\n";
    }
}

$conn->close();
echo "\n=== HOÀN THÀNH KIỂM TRA ===\n";
?>
