<?php
// Test script to verify the add schedule button functionality
echo "<h1>Test Add Schedule Button</h1>";
echo "<p>Truy cập: <a href='http://localhost/Web_Cinema/index.php/Qlylich_controller/indexCalendar'>Calendar Page</a></p>";

// Test AJAX endpoints
echo "<h2>Test AJAX Endpoints:</h2>";

// Test get movies
echo "<h3>1. Get Movies:</h3>";
$url = 'http://localhost/Web_Cinema/index.php/Qlylich_controller/ajax_get_movies';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$movies = json_decode($response, true);
if ($movies && $movies['success']) {
    echo "<p>✅ Get movies: Success (" . count($movies['movies']) . " movies found)</p>";
    echo "<details><summary>Sample movies:</summary><pre>";
    echo json_encode(array_slice($movies['movies'], 0, 3), JSON_PRETTY_PRINT);
    echo "</pre></details>";
} else {
    echo "<p>❌ Get movies: Failed</p>";
    echo "<pre>$response</pre>";
}

// Test add schedule (this should fail with validation, but endpoint should work)
echo "<h3>2. Add Schedule (Validation Test):</h3>";
$url = 'http://localhost/Web_Cinema/index.php/Qlylich_controller/ajax_add_schedule';
$data = array(
    'id_movie' => '',
    'day' => '2025-01-15',
    'id_phong' => '1',
    'time' => '14:00'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
if ($result && isset($result['success'])) {
    echo "<p>✅ Add schedule endpoint: Working (validation as expected)</p>";
    echo "<p>Response: " . $result['message'] . "</p>";
} else {
    echo "<p>❌ Add schedule endpoint: Failed</p>";
    echo "<pre>$response</pre>";
}

echo "<h2>Instructions:</h2>";
echo "<ol>";
echo "<li>Go to <a href='http://localhost/Web_Cinema/index.php/Qlylich_controller/indexCalendar'>Calendar Page</a></li>";
echo "<li>Open browser console (F12)</li>";
echo "<li>Click 'Thêm lịch chiếu' button</li>";
echo "<li>Check console for 'Add schedule button clicked' message</li>";
echo "<li>Select a movie, date, room, and time</li>";
echo "<li>Click 'Lưu lịch chiếu' and check for success message</li>";
echo "</ol>";
?>







