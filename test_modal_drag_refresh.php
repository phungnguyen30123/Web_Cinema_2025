<?php
// Test script for modal drag and refresh functionality
echo "<h1>Test Modal Drag & Refresh Functionality</h1>";

// Test the new AJAX endpoint
echo "<h2>Test ajax_get_all_schedules endpoint:</h2>";
$url = 'http://localhost/Web_Cinema/index.php/Qlylich_controller/ajax_get_all_schedules';

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
            echo "<p><strong>Schedules found:</strong> " . count($data['schedules']) . "</p>";
            if (count($data['schedules']) > 0) {
                echo "<p><strong>Sample schedule:</strong></p>";
                echo "<pre>" . json_encode($data['schedules'][0], JSON_PRETTY_PRINT) . "</pre>";
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

echo "<hr>";
echo "<h2>Testing Instructions:</h2>";
echo "<ol>";
echo "<li>Go to: <a href='http://localhost/Web_Cinema/index.php/Qlylich_controller/indexCalendar'>Calendar Page</a></li>";
echo "<li><strong>Test Modal Dragging:</strong></li>";
echo "<ol>";
echo "<li>Click 'Thêm lịch chiếu' button</li>";
echo "<li>Try to drag the modal by its header</li>";
echo "<li>The modal should be movable around the screen</li>";
echo "</ol>";
echo "<li><strong>Test Refresh Instead of Reload:</strong></li>";
echo "<ol>";
echo "<li>Add a new schedule successfully</li>";
echo "<li>Check browser console for 'Refreshing calendar data...' message</li>";
echo "<li>Calendar should update without full page reload</li>";
echo "<li>Statistics should update automatically</li>";
echo "</ol>";
echo "<li><strong>Check Console Logs:</strong></li>";
echo "<ol>";
echo "<li>Open Developer Tools (F12) → Console</li>";
echo "<li>Look for messages about calendar refresh and modal drag initialization</li>";
echo "</ol>";
echo "</ol>";

echo "<h2>Expected Behaviors:</h2>";
echo "<ul>";
echo "<li>✅ Modal can be dragged by clicking and holding the header</li>";
echo "<li>✅ After adding schedule, calendar updates without full reload</li>";
echo "<li>✅ Statistics (total schedules, active movies) update automatically</li>";
echo "<li>✅ Console shows appropriate log messages</li>";
echo "</ul>";
?>







