<?php
// track_visitors.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "Rohan@sql5526";
$database = "test";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Log the visitor (you can add more details if needed)
$ip_address = $_SERVER['REMOTE_ADDR'];
$timestamp = date('Y-m-d H:i:s');

$logQuery = "INSERT INTO visitors (ip_address, visit_time) VALUES ('$ip_address', '$timestamp')";
$conn->query($logQuery);

// Get visitor count
$countQuery = "SELECT COUNT(*) AS visitor_count FROM visitors";
$result = $conn->query($countQuery);
$row = $result->fetch_assoc();
$visitor_count = $row['visitor_count'];

$conn->close();

// Return visitor count as JSON
header('Content-Type: application/json');
echo json_encode(['visitor_count' => $visitor_count]);
?>
