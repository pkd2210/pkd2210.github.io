<!DOCTYPE html>
<!--היי, מה את/ה עושה כאן?







-->
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
<h1 style="color: white">העלאת עיתון חדש:</h1>
<form action="" method="post" enctype="multipart/form-data"><br>
<input type="file" name="file" id="file" accept=".pdf" required><br>
<button value="העלאת עיתון" type="submit" name="submit" required>העלאת עיתון</button>
</form>
<br><br><br>
<a href="admin/archive" style="color: white">לארכיונים</a>
</body>
 <?php
    if (isset($_POST['submit'])) {
        // Handle the uploaded file
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploadedFileTmp = $_FILES['file']['tmp_name']; // Temp file path
            $uploadedFileDest = $uploadDir . 'paper.pdf'; // Destination for uploaded file

            // Move uploaded file and rename it
            if (move_uploaded_file($uploadedFileTmp, $uploadedFileDest)) {
                echo "<p style='color: green;'>העיתון החדש הועלה בהצלחה</p>";
            } else {
                echo "<p style='color: red;'>Error uploading new file.</p>";
            }
        } else {
            echo "<p style='color: red;'>No file uploaded or an error occurred.</p>";
        }
        $uploadDir = __DIR__ . '/../paper/';
        $archiveDir = $uploadDir . 'archive/'; // Archive directory

        // Ensure directories exist
        if (!is_dir($archiveDir)) {
            mkdir($archiveDir, 0777, true);
        }

        $currentFile = $uploadDir . 'paper.pdf'; // Current paper path
        $timestamp = date('d-m-Y-H-i'); // Generate timestamp without colons
		$archiveFile = $archiveDir . $timestamp . '.pdf'; // Archived file name

        // Check if current file exists and move it to the archive
        if (file_exists($currentFile)) {
            if (!rename($currentFile, $archiveFile)) {
                echo "<p style='color: red;'>Error archiving current file.</p>";
                exit;
            }
        }
    }
    ?>
</body>
</html>