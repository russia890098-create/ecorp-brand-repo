<h2>Upload New Brand Asset</h2>
<p>Ensure all uploads comply with Brand Policy 99-Z. Only valid image formats (JPG/PNG) are permitted.</p>

<form action="upload.php" method="post" enctype="multipart/form-data" class="upload-box">
    <div class="form-group">
        <label for="fileToUpload">Select Image Asset:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" required>
    </div>
    <button type="submit" name="submit">INITIATE UPLOAD</button>
</form>