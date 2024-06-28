<?php
// Check if a video file path is provided in the URL
if (isset($_GET['video'])) {
    $videoPath = 'uploads/videos/' . $_GET['video'];
    $fileExtension = strtolower(pathinfo($videoPath, PATHINFO_EXTENSION));

    // Check if the file extension is a supported video format
    $supportedExtensions = array('mp4');
    if (in_array($fileExtension, $supportedExtensions) && file_exists($videoPath)) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>ZeroMedia Player</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="player">
        <video controls>
            <source src="<?php echo $videoPath; ?>" type="video/<?php echo $fileExtension; ?>">
        </video>
        <a href="index.php">Back to Upload</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Invalid video file.";
    }
} else {
    echo "No video specified.";
}
?>
