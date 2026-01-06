<?php
// Test script to debug ajax_get_movies
echo "<h1>Test ajax_get_movies</h1>";

// Test direct model call
echo "<h2>Test Model Method:</h2>";
try {
    // Include necessary files
    require_once 'application/models/showPhim_model.php';

    // Mock CodeIgniter
    class CI_DB_mysqli_driver {
        public function select($fields) { return $this; }
        public function order_by($field, $order) { return $this; }
        public function get($table) {
            // Mock result
            return new MockQuery();
        }
    }

    class MockQuery {
        public function result_array() {
            return array(
                array('id' => 1, 'title' => 'Test Movie 1', 'duration' => '120 phút', 'open_date' => '2025-01-01'),
                array('id' => 2, 'title' => 'Test Movie 2', 'duration' => '105 phút', 'open_date' => '2025-01-02')
            );
        }
    }

    class CI_Model {
        public $db;
        public function __construct() {
            $this->db = new CI_DB_mysqli_driver();
        }
    }

    // Test model
    $model = new Showphim_model();
    $movies = $model->getAllMovies();

    echo "<p>✅ Model method works</p>";
    echo "<pre>" . print_r($movies, true) . "</pre>";

} catch (Exception $e) {
    echo "<p>❌ Model error: " . $e->getMessage() . "</p>";
}

// Test API endpoint
echo "<h2>Test API Endpoint:</h2>";
$url = 'http://localhost/Web_Cinema/index.php/Qlylich_controller/ajax_get_movies';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "<p>❌ cURL error: " . curl_error($ch) . "</p>";
} else {
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo "<p>HTTP Code: $httpCode</p>";

    if ($httpCode == 200) {
        $data = json_decode($response, true);
        if ($data) {
            echo "<p>✅ API response valid</p>";
            echo "<pre>" . print_r($data, true) . "</pre>";
        } else {
            echo "<p>❌ Invalid JSON response</p>";
            echo "<pre>$response</pre>";
        }
    } else {
        echo "<p>❌ HTTP error $httpCode</p>";
        echo "<pre>$response</pre>";
    }
}

curl_close($ch);
?>


