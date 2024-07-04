<?php
// Get a list of video files in the uploads/videos directory
$videoDir = 'uploads/videos/';
$videoFiles = array_diff(scandir($videoDir), array('.', '..'));

// Get a list of movie files and their cover images
$movieFiles = array();
foreach ($videoFiles as $file) {
    $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if ($fileExtension === 'mp4' || $fileExtension === 'mov' || $fileExtension === 'avi') {
        $coverImage = str_replace(".$fileExtension", '.jpg', $file);
        $coverImagePath = $videoDir . $coverImage;
        if (file_exists($coverImagePath)) {
            $movieFiles[$file] = $coverImage;
        } else {
            $movieFiles[$file] = 'default_cover.jpg'; // Use a default cover image if none is found
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ZeroMedia Player</title>
    <style>
        .movie-cover {
            width: 200px;
            height: 300px;
            object-fit: cover;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>ZeroMedia Player</h1>

    <div>
        <h2>Select a video to play:</h2>
        <div>
            <?php foreach ($movieFiles as $movieFile => $coverImage) { ?>
                <img class="movie-cover" src="<?php echo $videoDir . $coverImage; ?>" onclick="playVideo('<?php echo $videoDir . $movieFile; ?>')">
            <?php } ?>
        </div>
    </div>

    <video id="video-player" width="800" controls></video>

    <script>
        function playVideo(videoPath) {
            var videoPlayer = document.getElementById('video-player');
            videoPlayer.src = videoPath;
            videoPlayer.play();
        }
    </script>
</body>
</html>
