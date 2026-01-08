<?php
// Test file để kiểm tra rating system có hoạt động trên trang movie page
echo "<h1>Test Rating System Integration</h1>";
echo "<p>Truy cập <a href='http://localhost/Web_Cinema/index.php/movie_page_controller/showinfophim/14' target='_blank'>trang movie</a> để kiểm tra rating system</p>";

// Kiểm tra database connection
try {
    $conn = new mysqli('localhost', 'root', '', 'movie_ticket_db');
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    echo "<h2>✅ Database Connection: OK</h2>";

    // Kiểm tra bảng rating
    $result = $conn->query("SELECT COUNT(*) as count FROM rating");
    $row = $result->fetch_assoc();
    echo "<p>📊 Số bản ghi rating: " . $row['count'] . "</p>";

    // Kiểm tra rating của movie ID 14
    $result = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(*) as count FROM rating WHERE id_movie = 14");
    $row = $result->fetch_assoc();
    echo "<p>🎬 Rating trung bình của movie 14: " . number_format($row['avg_rating'], 1) . " (" . $row['count'] . " đánh giá)</p>";

    // Kiểm tra user rating (giả sử user_id = 39)
    $result = $conn->query("SELECT rating FROM rating WHERE id_user = 39 AND id_movie = 14");
    $row = $result->fetch_row();
    $user_rating = $row ? $row[0] : 0;
    echo "<p>👤 Rating của user 39 cho movie 14: " . ($user_rating ?: 'Chưa đánh giá') . "</p>";

    $conn->close();

} catch (Exception $e) {
    echo "<h2>❌ Database Error: " . $e->getMessage() . "</h2>";
}

// Kiểm tra file tồn tại
$files_to_check = [
    'application/models/Rating_model.php',
    'application/controllers/Rating_controller.php',
    'application/views/movie_page_view.php',
    'js/custom.js'
];

echo "<h2>📁 File Status:</h2>";
foreach ($files_to_check as $file) {
    if (file_exists($file)) {
        echo "<p>✅ $file: Tồn tại</p>";
    } else {
        echo "<p>❌ $file: Thiếu</p>";
    }
}

echo "<h2>🔧 Next Steps:</h2>";
echo "<ol>";
echo "<li>Truy cập trang movie: http://localhost/Web_Cinema/index.php/movie_page_controller/showinfophim/14</li>";
echo "<li>Đăng nhập với tài khoản user</li>";
echo "<li>Kiểm tra phần 'Your vote' có hiển thị ngôi sao không</li>";
echo "<li>Thử click vào ngôi sao để đánh giá</li>";
echo "<li>Kiểm tra rating trung bình có cập nhật không</li>";
echo "</ol>";
?>





