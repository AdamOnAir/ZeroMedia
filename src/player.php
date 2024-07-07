<?php
// Get a list of video files in the uploads/videos directory
$videoDir = 'uploads/videos/';
$videoFiles = array_diff(scandir($videoDir), array('.', '..'));
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
        <select id="video-selector">
            <?php foreach ($videoFiles as $file) { ?>
                <option value="<?php echo $videoDir . $file; ?>"><?php echo $file; ?></option>
            <?php } ?>
        </select>
    </div>

    <video id="video-player" width="800" controls></video>

    <script>
        var videoPlayer = document.getElementById('video-player');
        var videoSelector = document.getElementById('video-selector');

        videoSelector.addEventListener('change', function() {
            var selectedVideo = this.value;
            videoPlayer.src = selectedVideo;
            videoPlayer.play();
        });
    </script>
</body>
</html>
