<?php
// Define the mapping of file extensions to target directories
$extensions = array(
    'mp4' => 'videos/',
    'mov' => 'videos/',
    'avi' => 'videos/',
    'jpg' => 'images/',
    'png' => 'images/',
    'gif' => 'images/',
    'mp3' => 'music/',
    'wav' => 'music/',
    'flac' => 'music/',
    'ogg' => 'music/',
    'zip' => 'archives/',
    'rar' => 'archives/',
    '7z' => 'archives/',
    'pdf' => 'documents/',
    'doc' => 'documents/',
    'docx' => 'documents/',
    'xls' => 'documents/',
    'xlsx' => 'documents/',
    'ppt' => 'documents/',
    'pptx' => 'documents/',
    'odt' => 'documents/',
    'ods' => 'documents/',
    'odp' => 'documents/',
    'csv' => 'documents/',
    'txt' => 'documents/',
    'rtf' => 'documents/',
    'tex' => 'documents/',
);

$uploadDir = 'uploads/';

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Check if the file extension is in the $extensions array
    if (array_key_exists($fileExtension, $extensions)) {
        $targetDir = $uploadDir . $extensions[$fileExtension];

        // Move the file to the target directory
        $targetPath = $targetDir . $fileName;
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        if (move_uploaded_file($fileTmpName, $targetPath)) {
            $message = "File $fileName uploaded and moved to $targetDir";
        } else {
            $message = "Error uploading and moving $fileName";
        }
    } else {
        $message = "Unknown file extension for $fileName, report it to your administrator";
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
        <h1>ZeroMedia</h1>
        <nav>
            <ul>
                <li><a href="#">Upload</a></li>
                <li><a href="#" onclick="showPlayer()">Player</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

        <div id="upload-section">
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="file">
                <input type="submit" value="Upload">
            </form>
        </div>

        <div id="player-section" style="display: none;">
            <iframe id="player-iframe" src="" frameborder="0" allowfullscreen></iframe>
        </div>
    </main>

    <footer>
        &copy; 2023 ZeroMedia
    </footer>

    <script>
        function showPlayer() {
            var playerSection = document.getElementById('player-section');
            var uploadSection = document.getElementById('upload-section');

            playerSection.style.display = 'block';
            uploadSection.style.display = 'none';

            var playerIframe = document.getElementById('player-iframe');
            playerIframe.src = 'player.php'; // Replace with the actual file path
        }
    </script>
</body>
</html>
