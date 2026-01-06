<?php
/**
 * Test file to verify rating display functionality
 * Access this via: http://localhost/Web_Cinema/test_rating_display.php
 */

// Include necessary files
require_once 'application/config/database.php';
require_once 'system/core/Model.php';

// Simple test class to test our modified methods
class TestRatingDisplay {
    private $db;

    public function __construct() {
        // Connect to database
        $this->db = mysqli_connect(
            $db['default']['hostname'],
            $db['default']['username'],
            $db['default']['password'],
            $db['default']['database']
        );

        if (!$this->db) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }

    public function testPhimDCQuery() {
        echo "<h2>Testing Phim Đang Chiếu (Currently Showing Movies) Query</h2>";

        $query = "SELECT movie.*, AVG(COALESCE(rating.rating, 0)) as avg_rating, COUNT(rating.id) as rating_count
                 FROM movie
                 LEFT JOIN rating ON rating.id_movie = movie.id
                 WHERE DATEDIFF(CURRENT_DATE, open_date) > 0 AND DATEDIFF(CURRENT_DATE, open_date) < 30
                 GROUP BY movie.id";

        $result = mysqli_query($this->db, $query);

        if ($result) {
            echo "<p>Query executed successfully. Found " . mysqli_num_rows($result) . " movies.</p>";
            echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
            echo "<tr><th>ID</th><th>Title</th><th>Avg Rating</th><th>Rating Count</th><th>Open Date</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td>" . ($row['avg_rating'] > 0 ? number_format($row['avg_rating'], 1) : 'Chưa có đánh giá') . "</td>";
                echo "<td>" . $row['rating_count'] . " lượt bình chọn</td>";
                echo "<td>" . $row['open_date'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Query failed: " . mysqli_error($this->db) . "</p>";
        }
    }

    public function testPhimSCQuery() {
        echo "<h2>Testing Phim Sắp Chiếu (Upcoming Movies) Query</h2>";

        $query = "SELECT movie.*, AVG(COALESCE(rating.rating, 0)) as avg_rating, COUNT(rating.id) as rating_count
                 FROM movie
                 LEFT JOIN rating ON rating.id_movie = movie.id
                 WHERE DATEDIFF(open_date, CURRENT_DATE) > 2
                 GROUP BY movie.id";

        $result = mysqli_query($this->db, $query);

        if ($result) {
            echo "<p>Query executed successfully. Found " . mysqli_num_rows($result) . " movies.</p>";
            echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
            echo "<tr><th>ID</th><th>Title</th><th>Avg Rating</th><th>Rating Count</th><th>Open Date</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td>" . ($row['avg_rating'] > 0 ? number_format($row['avg_rating'], 1) : 'Chưa có đánh giá') . "</td>";
                echo "<td>" . $row['rating_count'] . " lượt bình chọn</td>";
                echo "<td>" . $row['open_date'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Query failed: " . mysqli_error($this->db) . "</p>";
        }
    }

    public function __destruct() {
        mysqli_close($this->db);
    }
}

// Run tests
echo "<h1>Testing Rating Display Functionality</h1>";
echo "<p>This test verifies that our modified queries work correctly.</p>";

$test = new TestRatingDisplay();
$test->testPhimDCQuery();
echo "<br><br>";
$test->testPhimSCQuery();

echo "<br><br><h2>Summary</h2>";
echo "<p>If you can see movie data with rating information above, the changes are working correctly.</p>";
echo "<p>The rating display should now show dynamic data instead of the hardcoded '170 lượt bình chọn' and '5.0' values.</p>";
?>
