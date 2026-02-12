<?php
// E CORP INTERNAL SYSTEM - v4.0.2
// SECURITY NOTICE: All activity is logged.

// Define a constant to prevent direct access to included files
define('ECORP_ACCESS', true);

// Get the page from the URL, default to 'home'
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Basic Directory Traversal Filter (The "Hard" part - it looks safe but isn't)
// We strip "http://" to prevent Remote File Inclusion (RFI), but we allow local traversal.
$page = str_replace(array("http://", "https://"), "", $page);

// Construct the file path
// The user expects pages to be in 'pages/', but the logic allows traversing out.
$file = "pages/" . $page . ".php";

// If the user provides a path with an extension (like uploads/image.jpg), 
// we might not want to append .php.
// LOGIC HOLE: If the file doesn't exist with .php, check if it exists exactly as requested.
if (!file_exists($file)) {
    if (file_exists($page)) {
        $file = $page;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E Corp Brand Repository</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">E CORP</div>
        <nav>
            <a href="?page=home">Dashboard</a>
            <a href="?page=upload">Upload Asset</a> <a href="?page=policy">Brand Policy</a>
        </nav>
        <div class="user-info">User: Guest<br>Level: restricted</div>
    </div>

    <div class="main-content">
        <header>
            <h1>Brand Asset Management</h1>
            <div class="status">SYSTEM: ONLINE</div>
        </header>
        
        <div class="content-window">
            <?php
            // THE VULNERABILITY:
            // include() will execute PHP code inside ANY file (jpg, txt, png).
            if (file_exists($file)) {
                include($file);
            } else {
                // If the direct include fails, check if we need to load the upload form
                if ($page === 'upload') {
                    include('upload_form.php'); 
                } else {
                    echo "<div class='error'>ERROR 404: ASSET NOT FOUND</div>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>