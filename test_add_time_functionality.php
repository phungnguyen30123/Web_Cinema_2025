<?php
// Test script to verify adding show times functionality works
echo "<h1>Test Adding Show Times Functionality</h1>";

// Simulate the AJAX request for adding a show time
$url = 'http://localhost/Web_Cinema/index.php/Qlylich_controller/ajax_themgio/1/14:30'; // room=1, time=14:30
$data = array(
    'id_movie' => '1',
    'day' => '2025-01-15'
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo "<h2>Request URL:</h2>";
echo "<pre>$url</pre>";

echo "<h2>POST Data:</h2>";
echo "<pre>" . print_r($data, true) . "</pre>";

echo "<h2>Response:</h2>";
echo "<pre>$result</pre>";

echo "<h2>Response as JSON:</h2>";
$json = json_decode($result, true);
if ($json) {
    echo "<pre>" . print_r($json, true) . "</pre>";
} else {
    echo "<p>Response is not valid JSON</p>";
}
?>


