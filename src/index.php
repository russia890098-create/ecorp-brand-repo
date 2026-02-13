<?php
/**
 * E CORP INTERNAL SYSTEM - v4.0.2
 * BRAND ASSET MANAGEMENT PORTAL
 * 
 * SECURITY NOTICE: All activity is monitored and logged.
 * Unauthorized access attempts will result in immediate termination.
 */

// Define a constant to prevent direct access to included files
define('ECORP_ACCESS', true);

// Session for tracking (adds realism, not functional for CTF)
session_start();

// Get the page from the URL, default to 'home'
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Security Filter - Looks strict but has a logical flaw
// Strip dangerous protocols to prevent RFI
$page = str_replace(array("http://", "https://", "ftp://", "php://", "data://"), "", $page);

// Additional "security" - strip null bytes (looks professional)
$page = str_replace("\0", "", $page);

// Construct the file path
// The logic expects pages to be in 'pages/', but allows traversal
$file = "pages/" . $page . ".php";

// LOGIC HOLE: If the page with .php doesn't exist, check if it exists exactly as provided
// This allows: ?page=uploads/malicious.jpg to work
if (!file_exists($file)) {
    // Check if the raw page parameter is a valid file
    if (file_exists($page)) {
        $file = $page;
    }
}

// Log attempt (adds realism, could actually log in production)
if (isset($_SERVER['REMOTE_ADDR'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $timestamp = date('Y-m-d H:i:s');
    // In production, this would write to a log file
    // For CTF, we just make it look official
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E Corp Brand Repository</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🏢</text></svg>">
</head>
<body>
    <div class="sidebar">
        <div class="logo">E CORP</div>
        <nav>
            <a href="?page=home" class="<?php echo ($page == 'home') ? 'active' : ''; ?>">
                <span class="nav-icon">📊</span> Dashboard
            </a>
            <a href="?page=upload" class="<?php echo ($page == 'upload') ? 'active' : ''; ?>">
                <span class="nav-icon">📤</span> Upload Asset
            </a>
            <a href="?page=policy" class="<?php echo ($page == 'policy') ? 'active' : ''; ?>">
                <span class="nav-icon">📋</span> Brand Policy
            </a>
            <a href="?page=admin" class="<?php echo ($page == 'admin') ? 'active' : ''; ?>" style="opacity: 0.5;">
                <span class="nav-icon">🔒</span> Admin Panel
            </a>
        </nav>
        <div class="user-info">
            <div style="margin-bottom: 10px;">User: <strong>Guest</strong></div>
            <div>Level: <span style="color: #c70000;">RESTRICTED</span></div>
            <div style="margin-top: 10px; font-size: 0.7rem; opacity: 0.3;">
                Session: <?php echo substr(session_id(), 0, 8); ?>
            </div>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h1>Brand Asset Management</h1>
            <div class="status-group">
                <div class="status">SYSTEM: <span style="color: #00ff00;">ONLINE</span></div>
                <div class="timestamp"><?php echo date('Y-m-d H:i:s'); ?> UTC</div>
            </div>
        </header>
        
        <div class="content-window">
            <?php
            /**
             * THE VULNERABILITY:
             * include() will execute PHP code inside ANY file (jpg, txt, png, etc.)
             * Even though uploads/ directory has PHP execution disabled via .htaccess,
             * include() bypasses that restriction and executes the code.
             */
            if (file_exists($file)) {
                // Include the file - this is where the magic happens
                include($file);
            } else {
                // Fallback logic for upload page
                if ($page === 'upload') {
                    if (file_exists('upload_form.php')) {
                        include('upload_form.php');
                    } else {
                        echo "<div class='error'>ERROR: Upload module not found.</div>";
                    }
                } else {
                    // Custom 404 error
                    echo "<div class='error'>";
                    echo "<h3>ERROR 404: ASSET NOT FOUND</h3>";
                    echo "<p>The requested resource does not exist in the E Corp repository.</p>";
                    echo "<div style='margin-top: 20px; padding: 15px; background: #0d0d0d; border: 1px solid #333; font-size: 0.85rem;'>";
                    echo "<strong>Attempted Resource:</strong> " . htmlspecialchars($page) . "<br>";
                    echo "<strong>Resolved Path:</strong> " . htmlspecialchars($file) . "<br>";
                    echo "<strong>Timestamp:</strong> " . date('Y-m-d H:i:s') . " UTC<br>";
                    echo "</div>";
                    echo "<p style='margin-top: 20px; font-size: 0.85rem; opacity: 0.7;'>";
                    echo "If you believe this is an error, contact your system administrator.";
                    echo "</p>";
                    echo "</div>";
                }
            }
            ?>
        </div>

        <footer class="footer">
            <div class="footer-content">
                <div>E Corp © <?php echo date('Y'); ?> | All Rights Reserved</div>
                <div style="opacity: 0.5;">v4.0.2 | Build 20240215</div>
            </div>
        </footer>
    </div>
</body>
</html>
