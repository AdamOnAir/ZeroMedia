<?php
// Define the base directory where files are stored
$baseDir = 'uploads/';

// Check if the search query is provided
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];

    // Perform a recursive search for files matching the query
    $files = searchFiles($baseDir, $searchQuery);
} else {
    $files = array();
}

// Function to recursively search for files
function searchFiles($dir, $query) {
    $matches = array();
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $path = $dir . '/' . $file;
            if (is_dir($path)) {
                $matches = array_merge($matches, searchFiles($path, $query));
            } else {
                if (stripos($file, $query) !== false) {
                    $matches[] = $path;
                }
            }
        }
    }

    return $matches;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ZeroMedia - Download</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
</head>
<body>
    <header>
        <h1>ZeroMedia</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="download.php">Download</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Search and Download Files</h2>
        <form method="get" action="download.php">
            <input type="text" name="search" placeholder="Search for files...">
            <input type="submit" value="Search">
        </form>

        <?php if (!empty($files)) { ?>
            <h3>Search Results:</h3>
            <ul>
                <?php foreach ($files as $file) { ?>
                    <li><a href="<?php echo $file; ?>" download><?php echo basename($file); ?></a></li>
                <?php } ?>
            </ul>
        <?php } else if (isset($searchQuery)) { ?>
            <p>No files found matching the search query "<?php echo $searchQuery; ?>".</p>
        <?php } ?>
    </main>
</body>
</html>
