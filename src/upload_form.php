<?php if(!defined('ECORP_ACCESS')) die('Direct access denied'); ?>

<div style="max-width: 700px; margin: 0 auto;">
    
    <h2 style="color: var(--ecorp-red); margin-bottom: 10px;">Upload New Brand Asset</h2>
    
    <p style="line-height: 1.6; opacity: 0.9;">
        Submit new corporate assets for archival in the E Corp brand repository. 
        All uploads must comply with <a href="?page=policy" style="color: #00ff00;">Brand Policy 99-Z</a>.
    </p>

    <!-- Security Notice -->
    <div style="background: rgba(199, 0, 0, 0.1); border-left: 3px solid var(--ecorp-red); padding: 15px; margin: 20px 0;">
        <strong>⚠️ SECURITY REQUIREMENTS:</strong>
        <ul style="margin: 10px 0; padding-left: 20px;">
            <li>Only <strong>JPG, JPEG, and PNG</strong> formats are permitted</li>
            <li>Maximum file size: <strong>2MB</strong></li>
            <li>Files must contain valid image headers (magic bytes)</li>
            <li>All uploads are subject to automated validation</li>
        </ul>
    </div>

    <!-- Upload Form -->
    <form action="upload.php" method="post" enctype="multipart/form-data" class="upload-box">
        <div style="margin-bottom: 20px;">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity: 0.5;">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
        </div>
        
        <div class="form-group">
            <label for="fileToUpload">Select Image Asset:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg,.jpeg,.png,image/jpeg,image/png" required>
        </div>
        
        <button type="submit" name="submit">INITIATE UPLOAD</button>
        
        <div style="margin-top: 20px; font-size: 0.85rem; opacity: 0.6;">
            By submitting, you confirm this asset is authorized for corporate use.
        </div>
    </form>

    <!-- Technical Information -->
    <div style="margin-top: 40px; padding: 20px; background: rgba(0, 0, 0, 0.5); border: 1px solid #333;">
        <h3 style="color: #00ff00; margin-top: 0; font-size: 1rem;">TECHNICAL SPECIFICATIONS</h3>
        <table style="width: 100%; font-size: 0.85rem;">
            <tr>
                <td style="padding: 8px 0; opacity: 0.7;">Accepted Formats:</td>
                <td style="padding: 8px 0;"><code>JPG, JPEG, PNG</code></td>
            </tr>
            <tr>
                <td style="padding: 8px 0; opacity: 0.7;">Maximum Size:</td>
                <td style="padding: 8px 0;"><code>2,000,000 bytes (2MB)</code></td>
            </tr>
            <tr>
                <td style="padding: 8px 0; opacity: 0.7;">Validation Method:</td>
                <td style="padding: 8px 0;"><code>getimagesize() + ext check</code></td>
            </tr>
            <tr>
                <td style="padding: 8px 0; opacity: 0.7;">Storage Location:</td>
                <td style="padding: 8px 0;"><code>uploads/[random].{ext}</code></td>
            </tr>
            <tr>
                <td style="padding: 8px 0; opacity: 0.7;">Execution Policy:</td>
                <td style="padding: 8px 0;"><code>PHP disabled in uploads/</code></td>
            </tr>
        </table>
    </div>

    <!-- Troubleshooting Tips -->
    <details style="margin-top: 20px; padding: 15px; background: rgba(255, 255, 255, 0.02); border: 1px solid #333; cursor: pointer;">
        <summary style="font-weight: bold; color: var(--ecorp-red); user-select: none;">
            Troubleshooting Upload Issues
        </summary>
        <div style="margin-top: 15px; line-height: 1.6; font-size: 0.9rem; opacity: 0.8;">
            <p><strong>If your upload is rejected:</strong></p>
            <ul>
                <li>Ensure the file is a genuine image (not renamed from another format)</li>
                <li>Verify file size is under 2MB using: <code>ls -lh filename.jpg</code></li>
                <li>Check file headers using: <code>file filename.jpg</code></li>
                <li>Remove any extraneous data or metadata</li>
                <li>Try converting the image to ensure valid structure</li>
            </ul>
            
            <p style="margin-top: 15px;"><strong>Supported MIME types:</strong></p>
            <ul>
                <li><code>image/jpeg</code> - JPEG/JPG format</li>
                <li><code>image/png</code> - PNG format</li>
            </ul>
        </div>
    </details>

</div>
