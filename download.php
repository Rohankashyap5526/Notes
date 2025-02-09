<?php
// Get the file name from the query parameter
if (isset($_GET['file'])) {
    $pdfFileName = $_GET['file'];
    $filePath = 'notes/' . $pdfFileName;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Send appropriate headers for file download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');
        header('Content-Length: ' . filesize($filePath));

        // Read and output the file content
        readfile($filePath);
        exit;
    } else {
        echo 'File not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
