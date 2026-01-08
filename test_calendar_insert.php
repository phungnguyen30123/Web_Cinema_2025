<?php
// Test script to check calendar table and insert functionality
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'movie_ticket_db';

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to database successfully.\n";

    // Check if calendar table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'calendar'");
    if ($stmt->rowCount() > 0) {
        echo "✓ Calendar table exists.\n";

        // Check table structure
        $stmt = $pdo->query("DESCRIBE calendar");
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "\nCalendar table columns:\n";
        foreach ($columns as $col) {
            echo "  " . $col['Field'] . " - " . $col['Type'] . " - " . ($col['Null'] == 'NO' ? 'NOT NULL' : 'NULL') . "\n";
        }

        // Test insert query (similar to what the model does)
        echo "\nTesting insert query (id_movie=1, day=2025-01-10)...\n";
        $stmt = $pdo->prepare("INSERT INTO calendar (id_movie, day) VALUES (?, ?)");
        $result = $stmt->execute([1, '2025-01-10']);

        if ($result) {
            $lastId = $pdo->lastInsertId();
            echo "✓ Insert successful. Last insert ID: $lastId\n";

            // Verify the insert
            $stmt = $pdo->prepare("SELECT * FROM calendar WHERE id_calendar = ?");
            $stmt->execute([$lastId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "✓ Inserted data: " . json_encode($row) . "\n";

            // Clean up test data
            $pdo->exec("DELETE FROM calendar WHERE id_calendar = $lastId");
            echo "✓ Test data cleaned up.\n";
        } else {
            echo "✗ Insert failed.\n";
        }

        // Check if movie with id=1 exists
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM movie WHERE id = 1");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "\nMovie with id=1 exists: " . ($result['count'] > 0 ? 'Yes' : 'No') . "\n";

    } else {
        echo "✗ Calendar table does not exist.\n";
    }

} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
?>







