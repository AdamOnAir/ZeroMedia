<?php
// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $uploadDir = 'uploads/';
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];

    if (move_uploaded_file($fileTmpName, $uploadDir . $fileName)) {
        $message = "File uploaded successfully.";
    } else {
        $message = "Error uploading file.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ZeroMedia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>PyMedia</h1>
    </header>

    <main>
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

        <form method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="submit" value="Upload">
        </form>
    </main>
</body>
</html>
