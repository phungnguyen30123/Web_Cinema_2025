<?php
// Test API endpoints
echo "<h1>Test API Endpoints</h1>";

// Test ajax_get_movies
echo "<h2>1. Testing ajax_get_movies</h2>";
$url = 'http://localhost/Web_Cinema/index.php/Qlylich_controller/ajax_get_movies';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "<p><strong>URL:</strong> $url</p>";
echo "<p><strong>HTTP Code:</strong> $httpCode</p>";

if ($httpCode == 200) {
    $data = json_decode($response, true);
    if ($data && isset($data['success'])) {
        echo "<p><strong>Status:</strong> ✅ Success</p>";
        if ($data['success']) {
            echo "<p><strong>Movies found:</strong> " . count($data['movies']) . "</p>";
            if (count($data['movies']) > 0) {
                echo "<p><strong>Sample movie:</strong></p>";
                echo "<pre>" . json_encode($data['movies'][0], JSON_PRETTY_PRINT) . "</pre>";
            }
        } else {
            echo "<p><strong>Error:</strong> " . ($data['message'] ?? 'Unknown error') . "</p>";
        }
    } else {
        echo "<p><strong>Status:</strong> ❌ Invalid JSON response</p>";
        echo "<pre>$response</pre>";
    }
} else {
    echo "<p><strong>Status:</strong> ❌ HTTP Error $httpCode</p>";
    echo "<pre>$response</pre>";
}

curl_close($ch);

// Test ajax_add_schedule with validation error
echo "<hr><h2>2. Testing ajax_add_schedule (Validation)</h2>";
$url = 'http://localhost/Web_Cinema/index.php/Qlylich_controller/ajax_add_schedule';
$data = array(
    'id_movie' => '', // Empty to trigger validation
    'day' => '2025-01-15',
    'id_phong' => '1',
    'time' => '14:00'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "<p><strong>HTTP Code:</strong> $httpCode</p>";

if ($httpCode == 200) {
    $result = json_decode($response, true);
    if ($result && isset($result['success'])) {
        echo "<p><strong>Status:</strong> ✅ API Working</p>";
        echo "<p><strong>Response:</strong> " . ($result['message'] ?? 'No message') . "</p>";
    } else {
        echo "<p><strong>Status:</strong> ❌ Invalid response</p>";
        echo "<pre>$response</pre>";
    }
} else {
    echo "<p><strong>Status:</strong> ❌ HTTP Error $httpCode</p>";
    echo "<pre>$response</pre>";
}

curl_close($ch);

echo "<hr><h2>3. Instructions</h2>";
echo "<ol>";
echo "<li>If ajax_get_movies returns 500 error, check CodeIgniter logs</li>";
echo "<li>If ajax_add_schedule doesn't work, check model loading</li>";
echo "<li>Go to calendar page and try clicking 'Thêm lịch chiếu' button</li>";
echo "<li>Check browser console for any remaining errors</li>";
echo "</ol>";
?>


