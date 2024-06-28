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
        
</head>
<body>
    <div id="player">
        <form>
            <input type="file" id="fileInput" onchange="loadFile(this.files[0])">
        </form>
        <div id="playerContainer"></div>
    </div>
    
    <script>
        function loadFile(file) {
            // Clear the previous player
            var playerContainer = document.getElementById('playerContainer');
            playerContainer.innerHTML = '';

            // Create a new player element based on the file type
            var fileExtension = file.name.split('.').pop().toLowerCase();
            var isVideo = ['mp4', 'mov', 'avi'].includes(fileExtension);
            var player;

            if (isVideo) {
                player = document.createElement('video');
                player.controls = true;
            } else if (['mp3', 'wav', 'flac'].includes(fileExtension)) {
                player = document.createElement('audio');
                player.controls = true;
            } else {
                alert('Unsupported file format.');
                return;
            }

            var fileURL = URL.createObjectURL(file);
            player.src = fileURL;

            playerContainer.appendChild(player);
        }
    </script>
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
