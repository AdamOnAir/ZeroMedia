<?php
/*
 * This script moves files from the uploads directory to their respective
 * directories based on their file extensions.
 */

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
);

$uploadDir = 'uploads/';

// Check if a file was uploaded
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Check if the file extension is in the $extensions array
    if (array_key_exists($fileExtension, $extensions)) {
        $targetDir = $extensions[$fileExtension];

        // Move the file to the target directory
        $targetPath = $targetDir . $fileName;
        if (rename($fileTmpName, $targetPath)) {
            echo "File $fileName moved to $targetDir\n";
        } else {
            echo "Error moving $fileName\n";
        }
    } else {
        echo "Unknown file extension for $fileName\n";
    }
} else {
    echo "No file was uploaded.\n";
}
