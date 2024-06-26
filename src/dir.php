<?php
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
);

$uploadDir = 'uploads/';

// Loop through all files in the uploads directory
$files = scandir($uploadDir);
foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        // Check if the file extension is in the $extensions array
        if (array_key_exists($fileExtension, $extensions)) {
            $targetDir = $extensions[$fileExtension];

            // Move the file to the target directory
            if (rename($uploadDir . $file, $targetDir . $file)) {
                echo "Moved $file to $targetDir\n";
            } else {
                echo "Error moving $file\n";
            }
        } else {
            echo "Unknown file extension for $file\n";
        }
    }
}
