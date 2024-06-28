<?php
// Check if a file is uploaded
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['file'];
    $filePath = $file['tmp_name'];
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    // Check if the file extension is supported
    $supportedExtensions = array('mp4', 'mov', 'avi', 'mp3', 'wav', 'flac');
    if (in_array($fileExtension, $supportedExtensions)) {
        $isVideo = in_array($fileExtension, array('mp4', 'mov', 'avi'));
?>
<!DOCTYPE html>
<html>
<head>
    <title>ZeroMedia Player</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <div id="player">
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="fileInput" accept="video/*,audio/*" required>
            <input type="submit" value="Play">
        </form>
        <?php if ($isVideo) { ?>
            <video controls>
                <source src="<?php echo $filePath; ?>" type="video/<?php echo $fileExtension; ?>">
            </video>
        <?php } else { ?>
            <audio controls>
                <source src="<?php echo $filePath; ?>" type="audio/<?php echo $fileExtension; ?>">
            </audio>
        <?php } ?>
        <a href="index.php">Back to Upload</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Unsupported file format.";
    }
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <title>ZeroMedia Player</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="player">
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="fileInput" accept="video/*,audio/*" required>
            <input type="submit" value="Play">
        </form>
        <a href="index.php">Back to Upload</a>
    </div>
</body>
</html>
<?php
}
?>
