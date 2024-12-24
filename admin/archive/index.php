<html lang="en">
<style>
    #content {
        display: none;
    }
</style>
<script>
if (document.cookie) {
document.write("<style>#content {display: block;}</style>")
}
else {
location.replace("/");
}

const cookieToElementMap = {
    'name': 'name'
};

const cookies = document.cookie.split(';');
cookies.forEach(cookie => {
    const [name, value] = cookie.trim().split('=');

    if (cookieToElementMap[name]) {
        console.log(`${name.charAt(0).toUpperCase() + name.slice(1)}:`, value);

        const elementId = cookieToElementMap[name];
        const element = document.getElementById(elementId);
        if (element == admin) {
            document.write("<style>#content {display: block;}</style>")
        }
    }
});

</script>
<body id="content" style="text-align: center; background-color: #0F4C81; scroll-behavior: smooth">
<?php
$dir = __DIR__ . '/../../paper/archive';  // Adjust the relative path to your PDF folder

// Check if the directory exists
if (is_dir($dir)) {
    $files = scandir($dir);  // Get all files in the directory

    // Filter out directories (dot directories: . and ..)
    $pdfFiles = array_filter($files, function($file) use ($dir) {
        return is_file($dir . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
    });

    // If there are PDF files, display them
    if (count($pdfFiles) > 0) {
        echo '<ul>';
        foreach ($pdfFiles as $pdf) {
            // Get the absolute file path
            $filePath = $dir . '/' . $pdf;

            // Display each PDF as a download link
            echo '<li><a style="color: white" href="archive/download.php?file=' . urlencode($pdf) . '">' . $pdf . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo 'No PDF files found in the specified folder.';
    }
} else {
    echo 'The specified folder does not exist.';
}
?>
</body>
</html>