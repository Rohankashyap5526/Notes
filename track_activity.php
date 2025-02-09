<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "Rohan@sql5526";
$database = "test";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to log visitor activity
function logVisit($ip, $conn) {
    $stmt = $conn->prepare("INSERT INTO activity_log (activity_type, ip_address) VALUES ('visit', ?)");
    $stmt->bind_param("s", $ip);
    $stmt->execute();
    $stmt->close();
}

// Function to log download activity
function logDownload($noteName, $conn) {
    $stmt = $conn->prepare("INSERT INTO activity_log (activity_type, notes_name) VALUES ('download', ?)");
    $stmt->bind_param("s", $noteName);
    $stmt->execute();
    $stmt->close();
}

// Fetch the visitor's IP address
$visitorIP = $_SERVER['REMOTE_ADDR'];

// Check if the request is for a download or a visit
if (isset($_GET['file'])) {
    // Handle download
    $fileName = $_GET['file'];
    $filePath = "notes/" . $fileName;
    
    if (file_exists($filePath)) {
        // Log the download activity
        logDownload($fileName, $conn);
        
        // Force download the file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filePath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush();
        readfile($filePath);
        exit;
    } else {
        echo "File does not exist.";
    }
} else {
    // Handle visit (check for unique visit within 24 hours)
    $stmt = $conn->prepare("SELECT * FROM activity_log WHERE activity_type = 'visit' AND ip_address = ? AND activity_time >= NOW() - INTERVAL 1 DAY");
    $stmt->bind_param("s", $visitorIP);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        // No visit in the last 24 hours, log the new visit
        logVisit($visitorIP, $conn);
    } else {
        echo "Visitor already counted within the last 24 hours.";
    }
    
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
