<?php
// Script kiểm tra cấu trúc bảng vnpay và momo sau khi thêm foreign key

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie_ticket_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

echo "<h2>Kiểm tra cấu trúc bảng sau khi thêm khóa ngoại</h2>";

// Kiểm tra cấu trúc bảng momo
echo "<h3>Cấu trúc bảng momo:</h3>";
$result = $conn->query("DESCRIBE momo");
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Field"]."</td><td>".$row["Type"]."</td><td>".$row["Null"]."</td><td>".$row["Key"]."</td><td>".$row["Default"]."</td><td>".$row["Extra"]."</td></tr>";
    }
    echo "</table>";
}

// Kiểm tra cấu trúc bảng vnpay
echo "<h3>Cấu trúc bảng vnpay:</h3>";
$result = $conn->query("DESCRIBE vnpay");
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Field"]."</td><td>".$row["Type"]."</td><td>".$row["Null"]."</td><td>".$row["Key"]."</td><td>".$row["Default"]."</td><td>".$row["Extra"]."</td></tr>";
    }
    echo "</table>";
}

// Hiển thị dữ liệu mẫu
echo "<h3>Dữ liệu bảng momo (5 bản ghi đầu):</h3>";
$result = $conn->query("SELECT id, orderId, amount, orderInfo, id_booking FROM momo LIMIT 5");
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Order ID</th><th>Amount</th><th>Order Info</th><th>ID Booking</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["orderId"]."</td><td>".$row["amount"]."</td><td>".$row["orderInfo"]."</td><td>".($row["id_booking"] ?? 'NULL')."</td></tr>";
    }
    echo "</table>";
}

echo "<h3>Dữ liệu bảng vnpay (5 bản ghi đầu):</h3>";
$result = $conn->query("SELECT id, vnp_TxnRef, vnp_Amount, vnp_OrderInfo, id_booking FROM vnpay LIMIT 5");
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>TxnRef</th><th>Amount</th><th>Order Info</th><th>ID Booking</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["vnp_TxnRef"]."</td><td>".$row["vnp_Amount"]."</td><td>".$row["vnp_OrderInfo"]."</td><td>".($row["id_booking"] ?? 'NULL')."</td></tr>";
    }
    echo "</table>";
}

// Kiểm tra foreign key constraints
echo "<h3>Kiểm tra Foreign Key Constraints:</h3>";
$result = $conn->query("SELECT TABLE_NAME, COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE REFERENCED_TABLE_SCHEMA = 'movie_ticket_db'
AND (TABLE_NAME = 'momo' OR TABLE_NAME = 'vnpay')");

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Table</th><th>Column</th><th>Constraint</th><th>Referenced Table</th><th>Referenced Column</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["TABLE_NAME"]."</td><td>".$row["COLUMN_NAME"]."</td><td>".$row["CONSTRAINT_NAME"]."</td><td>".$row["REFERENCED_TABLE_NAME"]."</td><td>".$row["REFERENCED_COLUMN_NAME"]."</td></tr>";
    }
    echo "</table>";
}

$conn->close();
?>


