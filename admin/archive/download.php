<?php
$dir = __DIR__ . '/../../paper/archive';  // Adjust the relative path to your PDF folder

if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = $dir . '/' . $file;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Set headers to force a file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));

        // Clear the output buffer
        ob_clean();
        flush();

        // Read the file and send it to the browser
        readfile($filePath);
        exit;
    } else {
        echo 'The requested file does not exist.';
    }
} else {
    echo 'No file specified.';
}
?>
