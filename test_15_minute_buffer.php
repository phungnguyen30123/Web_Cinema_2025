<?php
// Test script to verify 15-minute buffer between show times
echo "<h1>Test 15-Minute Buffer Between Show Times</h1>";

// Test cases
$test_cases = [
    [
        'name' => 'Suất 1: 10:00 (120 phút) -> kết thúc 12:00 + 15 phút buffer = 12:15',
        'existing_start' => '10:00',
        'existing_duration' => 120,
        'new_start' => '12:00', // Should conflict (12:00 < 12:15)
        'expected_conflict' => true
    ],
    [
        'name' => 'Suất 1: 10:00 (120 phút) -> kết thúc 12:00 + 15 phút buffer = 12:15',
        'existing_start' => '10:00',
        'existing_duration' => 120,
        'new_start' => '12:15', // Should be OK (12:15 == 12:15, but let's test edge case)
        'expected_conflict' => false
    ],
    [
        'name' => 'Suất 1: 10:00 (120 phút) -> kết thúc 12:00 + 15 phút buffer = 12:15',
        'existing_start' => '10:00',
        'existing_duration' => 120,
        'new_start' => '12:30', // Should be OK (12:30 > 12:15)
        'expected_conflict' => false
    ],
    [
        'name' => 'Suất 1: 14:00 (90 phút) -> kết thúc 15:30 + 15 phút buffer = 15:45',
        'existing_start' => '14:00',
        'existing_duration' => 90,
        'new_start' => '15:30', // Should conflict
        'expected_conflict' => true
    ],
    [
        'name' => 'Suất 1: 14:00 (90 phút) -> kết thúc 15:30 + 15 phút buffer = 15:45',
        'existing_start' => '14:00',
        'existing_duration' => 90,
        'new_start' => '15:45', // Should be OK
        'expected_conflict' => false
    ]
];

// Test logic
function checkTimeConflict($existing_start, $existing_duration, $new_start, $new_duration, $buffer_minutes = 15) {
    // Convert to minutes
    $existing_parts = explode(':', $existing_start);
    $existing_start_minutes = intval($existing_parts[0]) * 60 + intval($existing_parts[1]);
    $existing_end_minutes = $existing_start_minutes + $existing_duration + $buffer_minutes;

    $new_parts = explode(':', $new_start);
    $new_start_minutes = intval($new_parts[0]) * 60 + intval($new_parts[1]);
    $new_end_minutes = $new_start_minutes + $new_duration + $buffer_minutes;

    // Check overlap: (start1 < end2) && (start2 < end1)
    return ($new_start_minutes < $existing_end_minutes) && ($existing_start_minutes < $new_end_minutes);
}

echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Test Case</th><th>Existing Show</th><th>New Show</th><th>Expected</th><th>Actual</th><th>Result</th></tr>";

foreach ($test_cases as $test) {
    $conflict = checkTimeConflict($test['existing_start'], $test['existing_duration'], $test['new_start'], 120, 15);

    $expected = $test['expected_conflict'] ? 'Conflict' : 'No Conflict';
    $actual = $conflict ? 'Conflict' : 'No Conflict';
    $result = (($test['expected_conflict'] && $conflict) || (!$test['expected_conflict'] && !$conflict)) ? '✅ PASS' : '❌ FAIL';

    echo "<tr>";
    echo "<td>{$test['name']}</td>";
    echo "<td>{$test['existing_start']} ({$test['existing_duration']}min)</td>";
    echo "<td>{$test['new_start']} (120min)</td>";
    echo "<td>{$expected}</td>";
    echo "<td>{$actual}</td>";
    echo "<td>{$result}</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h2>Giải thích Logic:</h2>";
echo "<ul>";
echo "<li><strong>Buffer 15 phút:</strong> Mỗi suất chiếu cần có ít nhất 15 phút buffer sau khi kết thúc</li>";
echo "<li><strong>Thời gian kết thúc có buffer:</strong> start_time + duration + 15 phút</li>";
echo "<li><strong>Kiểm tra overlap:</strong> (new_start < existing_end_with_buffer) AND (existing_start < new_end_with_buffer)</li>";
echo "<li><strong>Ví dụ:</strong> Suất 10:00 (120min) → kết thúc 12:00 + 15min buffer = 12:15</li>";
echo "<li><strong>Kết quả:</strong> Suất mới phải bắt đầu từ 12:15 trở đi</li>";
echo "</ul>";

echo "<h2>Test với API:</h2>";
echo "<p>Để test thực tế, hãy thử thêm lịch chiếu với khoảng cách:</p>";
echo "<ul>";
echo "<li>Suất 1: 10:00 (120 phút) → kết thúc buffer: 12:15</li>";
echo "<li>Suất 2: 12:00 → Sẽ bị từ chối (quá gần)</li>";
echo "<li>Suất 2: 12:15 → Có thể được chấp nhận</li>";
echo "<li>Suất 2: 12:30 → Được chấp nhận</li>";
echo "</ul>";
?>







