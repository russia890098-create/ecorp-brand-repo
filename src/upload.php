<?php
// E CORP ASSET INGESTION NODE

$target_dir = "uploads/";
// Generate a random hash for the filename to prevent overwriting
$random_name = bin2hex(random_bytes(8));
$uploadOk = 1;
$message = "";

if(isset($_POST["submit"])) {
    $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . $random_name . "." . $imageFileType;

    // CHECK 1: Real Image? (Magic Bytes)
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        // It's an image
        $uploadOk = 1;
    } else {
        $message = "CRITICAL: File is not a valid image structure.";
        $uploadOk = 0;
    }

    // CHECK 2: Allowed Extensions (Strict)
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $message = "SECURITY: Only JPG, JPEG, PNG files are authorized.";
        $uploadOk = 0;
    }

    // CHECK 3: Size Limit (2MB)
    if ($_FILES["fileToUpload"]["size"] > 2000000) {
        $message = "ERROR: Asset exceeds 2MB limit.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $status = "FAILED";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $status = "SUCCESS";
            $message = "Asset archived successfully.<br><strong>Storage Path:</strong> " . $target_file;
        } else {
            $status = "ERROR";
            $message = "Internal Storage Error.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: #000; color: #fff; padding: 20px; font-family: monospace;">
    <h2 style="color: <?php echo ($status == 'SUCCESS') ? '#00ff00' : '#ff0000'; ?>">
        UPLOAD STATUS: <?php echo $status; ?>
    </h2>
    <p><?php echo $message; ?></p>
    
    <?php if($status == 'SUCCESS'): ?>
        <p><em>Notice: Asset is now pending review. You may verify the file via the dashboard using the storage path.</em></p>
    <?php endif; ?>

    <a href="index.php?page=upload" style="color: #fff; text-decoration: underline;">Return to Dashboard</a>
</body>
</html>