<?php
// Demo script to show calendar functionality
echo "<h1>Lịch Chiếu Rạp Demo</h1>";
echo "<p>Truy cập: <a href='http://localhost/Web_Cinema/index.php/Qlylich_controller/indexCalendar'>http://localhost/Web_Cinema/index.php/Qlylich_controller/indexCalendar</a></p>";

// Simulate getting schedule data
$host = 'localhost';
$dbname = 'movie_ticket_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get schedule data for next 30 days
    $stmt = $pdo->prepare("
        SELECT
            calendar.*,
            movie.title as movie_title,
            movie.duration,
            movie.poster,
            room.ten_phong
        FROM calendar
        LEFT JOIN movie ON calendar.id_movie = movie.id
        LEFT JOIN room ON calendar.id_phong = room.id_room
        WHERE calendar.day >= CURDATE()
        ORDER BY calendar.day ASC, calendar.time ASC
        LIMIT 20
    ");
    $stmt->execute();
    $schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Dữ liệu lịch chiếu hiện tại:</h2>";
    if (count($schedules) > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Ngày</th><th>Giờ</th><th>Phim</th><th>Thời lượng</th><th>Phòng</th></tr>";
        foreach ($schedules as $schedule) {
            echo "<tr>";
            echo "<td>{$schedule['id_calendar']}</td>";
            echo "<td>{$schedule['day']}</td>";
            echo "<td>{$schedule['time']}</td>";
            echo "<td>{$schedule['movie_title']}</td>";
            echo "<td>{$schedule['duration']}</td>";
            echo "<td>{$schedule['ten_phong']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Không có lịch chiếu nào. Hãy thêm một số lịch chiếu mẫu.</p>";

        // Insert sample data
        echo "<h3>Đang tạo dữ liệu mẫu...</h3>";

        // Get existing movies
        $movieStmt = $pdo->query("SELECT id, title FROM movie LIMIT 3");
        $movies = $movieStmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($movies) > 0) {
            $sampleSchedules = [];

            // Create schedules for next 7 days
            for ($i = 0; $i < 7; $i++) {
                $date = date('Y-m-d', strtotime("+{$i} days"));
                $movie = $movies[$i % count($movies)];

                // Morning show
                $sampleSchedules[] = [
                    'id_movie' => $movie['id'],
                    'day' => $date,
                    'id_phong' => 1,
                    'time' => '10:00'
                ];

                // Evening show
                $sampleSchedules[] = [
                    'id_movie' => $movie['id'],
                    'day' => $date,
                    'id_phong' => 2,
                    'time' => '20:00'
                ];
            }

            foreach ($sampleSchedules as $schedule) {
                $insertStmt = $pdo->prepare("INSERT INTO calendar (id_movie, day, id_phong, time) VALUES (?, ?, ?, ?)");
                $insertStmt->execute([
                    $schedule['id_movie'],
                    $schedule['day'],
                    $schedule['id_phong'],
                    $schedule['time']
                ]);
            }

            echo "<p>Đã tạo " . count($sampleSchedules) . " lịch chiếu mẫu. Hãy refresh trang để xem calendar!</p>";
        } else {
            echo "<p>Không có phim nào trong database. Hãy thêm phim trước.</p>";
        }
    }

} catch (PDOException $e) {
    echo "<p>Lỗi database: " . $e->getMessage() . "</p>";
}
?>


