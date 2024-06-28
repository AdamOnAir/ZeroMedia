<?php
// Check if a file path is provided in the URL
if (isset($_GET['file'])) {
    $filePath = $_GET['file'];
    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

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
        body {
            margin: 0;
            padding: 0;
            background-color: #000;
        }
        #player {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        <?php if ($isVideo) { ?>
        video {
            max-width: 100%;
            max-height: 100%;
        }
        <?php } else { ?>
        audio {
            width: 100%;
        }
        <?php } ?>
    </style>
</head>
<body>
    <div id="player">
        <?php if ($isVideo) { ?>
        <video controls>
            <source src="<?php echo $filePath; ?>" type="video/<?php echo $fileExtension; ?>">
            Your browser does not support the video tag.
        </video>
        <?php } else { ?>
        <audio controls>
            <source src="<?php echo $filePath; ?>" type="audio/<?php echo $fileExtension; ?>">
            Your browser does not support the audio tag.
        </audio>
        <?php } ?>
    </div>
</body>
</html>
<?php
    } else {
        echo "Unsupported file format.";
    }
} else {
    echo "No file specified.";
}
?>
