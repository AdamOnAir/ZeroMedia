<?php
// Define the mapping of file extensions to media types
$mediaTypes = array(
    'mp4' => 'video',
    'mov' => 'video',
    'avi' => 'video',
    'jpg' => 'image',
    'png' => 'image',
    'gif' => 'image',
    'mp3' => 'audio',
    'wav' => 'audio',
    'flac' => 'audio',
    'ogg' => 'audio'
);

// Check if a search query is provided
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $uploadDir = 'uploads/';

    // Scan the uploads directory for matching files
    $files = scandir($uploadDir);
    $matchingFiles = array();
    foreach ($files as $file) {
        if (strpos($file, $searchQuery) !== false) {
            $filePath = $uploadDir . $file;
            $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            if (array_key_exists($fileExtension, $mediaTypes)) {
                $matchingFiles[] = array(
                    'name' => $file,
                    'path' => $filePath,
                    'type' => $mediaTypes[$fileExtension]
                );
            }
        }
    }

    // Display the matching files
    if (!empty($matchingFiles)) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>ZeroMedia Player</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="player">
        <?php foreach ($matchingFiles as $file) { ?>
            <?php if ($file['type'] === 'video') { ?>
                <video controls>
                    <source src="<?php echo $file['path']; ?>" type="video/<?php echo $fileExtension; ?>">
                </video>
            <?php } elseif ($file['type'] === 'image') { ?>
                <img src="<?php echo $file['path']; ?>" alt="<?php echo $file['name']; ?>">
            <?php } elseif ($file['type'] === 'audio') { ?>
                <audio controls>
                    <source src="<?php echo $file['path']; ?>" type="audio/<?php echo $fileExtension; ?>">
                </audio>
            <?php } else { ?>
                <a href="<?php echo $file['path']; ?>" download>Download <?php echo $file['name']; ?></a>
            <?php } ?>
        <?php } ?>
        <a href="index.php">Back to Upload</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "No matching files found.";
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
        <form action="player.php" method="GET">
            <input type="text" name="search" placeholder="Search for a file...">
            <button type="submit">Search</button>
        </form>
        <a href="index.php">Back to Upload</a>
    </div>
</body>
</html>
<?php
}
?>
