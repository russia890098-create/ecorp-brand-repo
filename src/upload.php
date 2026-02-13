<?php
/**
 * E CORP ASSET INGESTION NODE
 * SECURE UPLOAD PROCESSOR v2.1.4
 * 
 * This module handles all brand asset submissions.
 * All uploads are subject to strict validation protocols.
 */

// Security: Prevent direct access
if (!defined('ECORP_ACCESS')) {
    // Allow direct access for upload processing, but set constant
    define('ECORP_ACCESS', true);
}

// Initialize variables
$target_dir = "uploads/";
$uploadOk = 1;
$message = "";
$status = "PENDING";
$target_file = "";

// Process upload if form was submitted
if(isset($_POST["submit"])) {
    
    // Generate a cryptographically secure random filename
    $random_name = bin2hex(random_bytes(8));
    
    // Get the file extension
    $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    
    // Construct target file path
    $target_file = $target_dir . $random_name . "." . $imageFileType;
    
    // VALIDATION LAYER 1: Magic Bytes Check
    // This uses getimagesize() which reads the file header to verify it's a real image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
        $imageInfo = "Detected: " . $check['mime'] . " (" . $check[0] . "x" . $check[1] . " pixels)";
    } else {
        $message = "CRITICAL SECURITY VIOLATION: File failed structural validation. Magic bytes do not match image format.";
        $uploadOk = 0;
    }
    
    // VALIDATION LAYER 2: File Extension Whitelist
    $allowed_extensions = array("jpg", "jpeg", "png");
    if(!in_array($imageFileType, $allowed_extensions)) {
        $message = "SECURITY ALERT: File extension '" . htmlspecialchars($imageFileType) . "' is not authorized. Only JPG, JPEG, and PNG formats are permitted.";
        $uploadOk = 0;
    }
    
    // VALIDATION LAYER 3: File Size Limit (2MB)
    if ($_FILES["fileToUpload"]["size"] > 2000000) {
        $filesize_mb = round($_FILES["fileToUpload"]["size"] / 1000000, 2);
        $message = "RESOURCE LIMIT EXCEEDED: Asset size ({$filesize_mb}MB) exceeds the 2MB corporate standard.";
        $uploadOk = 0;
    }
    
    // VALIDATION LAYER 4: Empty File Check
    if ($_FILES["fileToUpload"]["size"] == 0) {
        $message = "ERROR: Cannot process empty file.";
        $uploadOk = 0;
    }
    
    // Attempt to move the file if all checks passed
    if ($uploadOk == 0) {
        $status = "REJECTED";
    } else {
        // Try to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $status = "SUCCESS";
            
            // SUCCESS MESSAGE - This is intentionally detailed to help contestants
            $message = "<div style='margin-bottom: 15px;'>";
            $message .= "Asset successfully archived to secure storage.";
            $message .= "</div>";
            
            $message .= "<div style='background: #0d0d0d; padding: 15px; border: 1px solid #00ff00; margin: 15px 0;'>";
            $message .= "<strong style='color: #00ff00;'>ASSET DETAILS:</strong><br><br>";
            $message .= "<strong>Storage Path:</strong> <code style='color: #00ff00; background: #000; padding: 2px 8px;'>" . htmlspecialchars($target_file) . "</code><br>";
            $message .= "<strong>Asset ID:</strong> " . htmlspecialchars($random_name) . "<br>";
            $message .= "<strong>File Type:</strong> " . strtoupper($imageFileType) . "<br>";
            if(isset($imageInfo)) {
                $message .= "<strong>Image Info:</strong> " . htmlspecialchars($imageInfo) . "<br>";
            }
            $message .= "<strong>Timestamp:</strong> " . date('Y-m-d H:i:s') . " UTC<br>";
            $message .= "</div>";
            
            $message .= "<div style='padding: 10px; background: rgba(199, 0, 0, 0.1); border-left: 3px solid #c70000; margin-top: 15px;'>";
            $message .= "<strong>⚠️ SECURITY NOTICE:</strong><br>";
            $message .= "Assets are stored in a protected directory with PHP execution disabled. ";
            $message .= "You may verify the file integrity via the dashboard using the storage path above.";
            $message .= "</div>";
            
        } else {
            $status = "SYSTEM_ERROR";
            $message = "INTERNAL ERROR: Asset could not be written to storage. Contact system administrator.";
            
            // Add debug info (helpful for contestants to troubleshoot)
            $message .= "<div style='margin-top: 10px; font-size: 0.85rem; opacity: 0.7;'>";
            $message .= "Target: " . htmlspecialchars($target_file) . "<br>";
            $message .= "Permissions: Check write access to uploads directory";
            $message .= "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Status - E Corp</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: #000; color: #fff; padding: 40px; font-family: 'Courier New', Courier, monospace; min-height: 100vh;">
    
    <div style="max-width: 800px; margin: 0 auto;">
        <!-- Header -->
        <div style="border-bottom: 2px solid #c70000; padding-bottom: 20px; margin-bottom: 30px;">
            <div style="font-size: 2rem; font-weight: bold; color: #c70000; letter-spacing: 4px;">
                E CORP
            </div>
            <div style="font-size: 0.9rem; opacity: 0.7; margin-top: 5px;">
                Asset Ingestion Status Report
            </div>
        </div>

        <!-- Status Display -->
        <div style="background: #1a1a1a; border: 2px solid <?php 
            echo ($status == 'SUCCESS') ? '#00ff00' : 
                 (($status == 'REJECTED') ? '#c70000' : '#ff9900'); 
        ?>; padding: 30px; margin-bottom: 30px;">
            
            <h2 style="color: <?php 
                echo ($status == 'SUCCESS') ? '#00ff00' : 
                     (($status == 'REJECTED') ? '#c70000' : '#ff9900'); 
            ?>; margin-top: 0; font-size: 1.5rem; letter-spacing: 2px;">
                <?php 
                if ($status == 'SUCCESS') {
                    echo "✓ UPLOAD STATUS: SUCCESS";
                } elseif ($status == 'REJECTED') {
                    echo "✗ UPLOAD STATUS: REJECTED";
                } elseif ($status == 'SYSTEM_ERROR') {
                    echo "⚠ UPLOAD STATUS: SYSTEM ERROR";
                } else {
                    echo "○ UPLOAD STATUS: PENDING";
                }
                ?>
            </h2>
            
            <div style="line-height: 1.6; margin-top: 20px;">
                <?php echo $message; ?>
            </div>
        </div>

        <?php if($status == 'SUCCESS'): ?>
        <!-- Success Additional Info -->
        <div style="background: rgba(0, 255, 0, 0.05); border: 1px solid #00ff00; padding: 20px; margin-bottom: 30px;">
            <h3 style="color: #00ff00; margin-top: 0; font-size: 1.1rem;">NEXT STEPS:</h3>
            <ol style="line-height: 1.8; padding-left: 20px;">
                <li>Asset has been archived to the repository</li>
                <li>File is now accessible via the storage path</li>
                <li>You may view or reference the asset through the main dashboard</li>
                <li>All assets are subject to periodic compliance review</li>
            </ol>
        </div>
        <?php endif; ?>

        <?php if($status == 'REJECTED'): ?>
        <!-- Rejection Troubleshooting -->
        <div style="background: rgba(199, 0, 0, 0.1); border: 1px solid #c70000; padding: 20px; margin-bottom: 30px;">
            <h3 style="color: #c70000; margin-top: 0; font-size: 1.1rem;">TROUBLESHOOTING:</h3>
            <ul style="line-height: 1.8; padding-left: 20px;">
                <li>Ensure file is a valid JPG, JPEG, or PNG image</li>
                <li>Verify file size does not exceed 2MB</li>
                <li>Check that file headers match image format specifications</li>
                <li>Remove any non-standard metadata or embedded content</li>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Navigation -->
        <div style="text-align: center; padding-top: 20px; border-top: 1px solid #333;">
            <a href="index.php?page=upload" style="color: #00ff00; text-decoration: none; padding: 10px 20px; border: 1px solid #00ff00; display: inline-block; margin-right: 10px; transition: 0.3s;">
                ← Return to Upload
            </a>
            <a href="index.php?page=home" style="color: #fff; text-decoration: none; padding: 10px 20px; border: 1px solid #fff; display: inline-block; transition: 0.3s;">
                Go to Dashboard
            </a>
        </div>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #333; opacity: 0.5; font-size: 0.85rem;">
            E Corp Asset Management System v4.0.2<br>
            © <?php echo date('Y'); ?> E Corp. All activity is logged and monitored.
        </div>
    </div>

</body>
</html>
