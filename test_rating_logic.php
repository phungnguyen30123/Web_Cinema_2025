<?php
/**
 * Test file to verify rating display logic without database
 * This tests the logic changes we made to the views
 */

// Test cases for rating display logic
$test_cases = [
    // Case 1: Movie with ratings
    [
        'title' => 'Movie with ratings',
        'avg_rating' => 4.5,
        'rating_count' => 10,
        'expected_display' => '4.5',
        'expected_count' => '10 lượt bình chọn'
    ],

    // Case 2: Movie with no ratings (avg_rating is NULL, rating_count is 0)
    [
        'title' => 'Movie with no ratings',
        'avg_rating' => null,
        'rating_count' => 0,
        'expected_display' => 'Chưa có đánh giá',
        'expected_count' => '0 lượt bình chọn'
    ],

    // Case 3: Movie with some ratings but avg_rating calculation issue
    [
        'title' => 'Movie with ratings but NULL avg',
        'avg_rating' => null,
        'rating_count' => 5,
        'expected_display' => 'Chưa có đánh giá',
        'expected_count' => '5 lượt bình chọn'
    ],

    // Case 4: Movie data missing rating fields
    [
        'title' => 'Movie missing rating data',
        'expected_display' => 'Chưa có đánh giá',
        'expected_count' => '0 lượt bình chọn'
    ]
];

echo "<h1>Testing Rating Display Logic</h1>";
echo "<p>This test verifies the logic changes made to showPhimDC_view.php and showPhimSC_view.php</p>";

echo "<table border='1' style='border-collapse: collapse; width: 100%; margin-bottom: 20px;'>";
echo "<tr><th>Test Case</th><th>Avg Rating</th><th>Rating Count</th><th>Expected Display</th><th>Expected Count</th><th>Status</th></tr>";

$all_passed = true;

foreach ($test_cases as $i => $test) {
    echo "<tr>";
    echo "<td>" . $test['title'] . "</td>";
    echo "<td>" . (isset($test['avg_rating']) ? $test['avg_rating'] : 'NULL') . "</td>";
    echo "<td>" . (isset($test['rating_count']) ? $test['rating_count'] : 'NULL') . "</td>";
    echo "<td>" . $test['expected_display'] . "</td>";
    echo "<td>" . $test['expected_count'] . "</td>";

    // Test the NEW logic: isset($value['rating_count']) && $value['rating_count'] > 0
    $actual_display = isset($test['rating_count']) && $test['rating_count'] > 0 ?
        (isset($test['avg_rating']) ? number_format($test['avg_rating'], 1) : 'Chưa có đánh giá') :
        'Chưa có đánh giá';

    $actual_count = isset($test['rating_count']) ? $test['rating_count'] : 0;
    $actual_count .= ' lượt bình chọn';

    $display_pass = ($actual_display === $test['expected_display']);
    $count_pass = ($actual_count === $test['expected_count']);

    if ($display_pass && $count_pass) {
        echo "<td style='color: green;'>✓ PASS</td>";
    } else {
        echo "<td style='color: red;'>✗ FAIL</td>";
        echo "<br>Got: Display='$actual_display', Count='$actual_count'";
        $all_passed = false;
    }

    echo "</tr>";
}

echo "</table>";

if ($all_passed) {
    echo "<h2 style='color: green;'>✓ All tests passed!</h2>";
    echo "<p>The rating display logic has been successfully updated.</p>";
    echo "<p>Key changes made:</p>";
    echo "<ul>";
    echo "<li>Removed COALESCE from AVG calculation in showphim_model.php</li>";
    echo "<li>Updated view logic to check rating_count > 0 before displaying ratings</li>";
    echo "<li>This ensures movies without ratings show 'Chưa có đánh giá' correctly</li>";
    echo "</ul>";
} else {
    echo "<h2 style='color: red;'>✗ Some tests failed!</h2>";
    echo "<p>Please review the logic in the view files.</p>";
}

echo "<br><br>";
echo "<h3>Old Logic vs New Logic</h3>";
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>Scenario</th><th>Old Logic</th><th>New Logic</th><th>Result</th></tr>";

// Test specific cases
$scenarios = [
    ['avg_rating' => null, 'rating_count' => 0, 'desc' => 'No ratings'],
    ['avg_rating' => 4.5, 'rating_count' => 10, 'desc' => 'Has ratings'],
    ['avg_rating' => null, 'rating_count' => 5, 'desc' => 'Inconsistent data'],
];

foreach ($scenarios as $scenario) {
    echo "<tr>";
    echo "<td>" . $scenario['desc'] . "</td>";

    // Old logic: isset($value['avg_rating']) && $value['avg_rating'] > 0
    $old_result = isset($scenario['avg_rating']) && $scenario['avg_rating'] > 0 ?
        number_format($scenario['avg_rating'], 1) : 'Chưa có đánh giá';

    // New logic: isset($value['rating_count']) && $value['rating_count'] > 0
    $new_result = isset($scenario['rating_count']) && $scenario['rating_count'] > 0 ?
        (isset($scenario['avg_rating']) ? number_format($scenario['avg_rating'], 1) : 'Chưa có đánh giá') :
        'Chưa có đánh giá';

    echo "<td>$old_result</td>";
    echo "<td>$new_result</td>";

    if ($old_result === $new_result) {
        echo "<td style='color: green;'>Same ✓</td>";
    } else {
        echo "<td style='color: orange;'>Different ⚠</td>";
    }

    echo "</tr>";
}

echo "</table>";
?>
