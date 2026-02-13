<?php if(!defined('ECORP_ACCESS')) die('Direct access denied'); ?>

<div style="max-width: 800px; margin: 0 auto;">
    
    <h3 style="color: var(--ecorp-red); margin-bottom: 10px;">Corporate Identity Policy 99-Z</h3>
    
    <p style="line-height: 1.6; margin-bottom: 30px; opacity: 0.9;">
        All brand assets submitted to the E Corp repository must adhere to the following 
        guidelines. Non-compliance will result in automatic rejection and possible disciplinary action.
    </p>

    <!-- Critical Requirements -->
    <div style="background: rgba(199, 0, 0, 0.1); border-left: 3px solid var(--ecorp-red); padding: 20px; margin-bottom: 30px;">
        <h4 style="margin-top: 0; color: var(--ecorp-red);">CRITICAL REQUIREMENTS</h4>
        <ul style="line-height: 1.8; padding-left: 20px;">
            <li>All logos and brand marks must use <strong>E Corp Red</strong> (<code style="background: #c70000; color: #fff; padding: 2px 8px;">#c70000</code>) as the primary color</li>
            <li>Typography must conform to the approved corporate font family</li>
            <li>White space requirements must be maintained per the brand manual</li>
            <li>Assets must not contain unauthorized watermarks or attribution</li>
        </ul>
    </div>

    <!-- File Requirements -->
    <div style="margin-bottom: 30px;">
        <h4 style="color: var(--text); margin-bottom: 15px;">FILE SPECIFICATIONS</h4>
        
        <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
            <tr>
                <td style="padding: 12px; border-bottom: 1px solid #333; opacity: 0.7; width: 40%;">Accepted Formats</td>
                <td style="padding: 12px; border-bottom: 1px solid #333;">JPG, JPEG, PNG only</td>
            </tr>
            <tr>
                <td style="padding: 12px; border-bottom: 1px solid #333; opacity: 0.7;">Maximum File Size</td>
                <td style="padding: 12px; border-bottom: 1px solid #333;">2MB (2,000,000 bytes)</td>
            </tr>
            <tr>
                <td style="padding: 12px; border-bottom: 1px solid #333; opacity: 0.7;">Minimum Resolution</td>
                <td style="padding: 12px; border-bottom: 1px solid #333;">300 DPI for print materials</td>
            </tr>
            <tr>
                <td style="padding: 12px; border-bottom: 1px solid #333; opacity: 0.7;">Color Space</td>
                <td style="padding: 12px; border-bottom: 1px solid #333;">RGB for digital, CMYK for print</td>
            </tr>
            <tr>
                <td style="padding: 12px; border-bottom: 1px solid #333; opacity: 0.7;">Metadata Policy</td>
                <td style="padding: 12px; border-bottom: 1px solid #333;">Must not contain unauthorized embedded data</td>
            </tr>
        </table>
    </div>

    <!-- Security Policies -->
    <div style="margin-bottom: 30px;">
        <h4 style="color: var(--text); margin-bottom: 15px;">SECURITY POLICIES</h4>
        
        <div style="background: rgba(0, 0, 0, 0.5); border: 1px solid #333; padding: 20px;">
            <ol style="line-height: 1.8; padding-left: 20px;">
                <li>
                    <strong>File Validation:</strong> All uploads undergo automated validation to ensure 
                    structural integrity. Files must contain valid image headers (magic bytes) matching 
                    their declared format.
                </li>
                <li>
                    <strong>Metadata Screening:</strong> Assets must not contain unauthorized metadata, 
                    EXIF data, or embedded scripts. Any suspicious content will trigger immediate rejection.
                </li>
                <li>
                    <strong>Execution Prevention:</strong> The uploads directory has PHP execution disabled 
                    via <code>.htaccess</code> configuration to prevent security vulnerabilities.
                </li>
                <li>
                    <strong>Access Logging:</strong> All file access and upload attempts are logged for 
                    security auditing purposes. Unusual patterns may trigger investigation.
                </li>
                <li>
                    <strong>Automated Cleanup:</strong> Uploaded files are subject to periodic review and 
                    may be removed if they fail compliance checks.
                </li>
            </ol>
        </div>
    </div>

    <!-- Brand Usage Guidelines -->
    <div style="margin-bottom: 30px;">
        <h4 style="color: var(--text); margin-bottom: 15px;">BRAND USAGE GUIDELINES</h4>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
            <div style="padding: 15px; background: rgba(255, 255, 255, 0.02); border: 1px solid #333;">
                <div style="font-size: 1.5rem; margin-bottom: 10px;">✓</div>
                <strong style="color: #00ff00;">APPROVED</strong>
                <ul style="margin-top: 10px; font-size: 0.85rem; line-height: 1.6;">
                    <li>Official marketing materials</li>
                    <li>Corporate presentations</li>
                    <li>Internal communications</li>
                    <li>Authorized partner content</li>
                </ul>
            </div>
            
            <div style="padding: 15px; background: rgba(199, 0, 0, 0.05); border: 1px solid var(--ecorp-red);">
                <div style="font-size: 1.5rem; margin-bottom: 10px;">✗</div>
                <strong style="color: var(--ecorp-red);">PROHIBITED</strong>
                <ul style="margin-top: 10px; font-size: 0.85rem; line-height: 1.6;">
                    <li>Modified or altered logos</li>
                    <li>Unauthorized color variations</li>
                    <li>Third-party endorsements</li>
                    <li>Competitive comparisons</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Violation Consequences -->
    <div style="background: rgba(199, 0, 0, 0.2); border: 2px solid var(--ecorp-red); padding: 20px; margin-bottom: 30px;">
        <h4 style="margin-top: 0; color: var(--ecorp-red); text-transform: uppercase;">⚠️ VIOLATION CONSEQUENCES</h4>
        <p style="line-height: 1.6; margin: 0;">
            Any attempt to subvert the archival process, upload malicious content, or bypass 
            security measures will result in:
        </p>
        <ul style="line-height: 1.8; margin-top: 10px;">
            <li>Immediate termination of access privileges</li>
            <li>Account suspension pending investigation</li>
            <li>Referral to corporate security team</li>
            <li>Possible legal action for damages</li>
        </ul>
        <p style="line-height: 1.6; margin: 15px 0 0 0; font-style: italic; opacity: 0.8;">
            All activity on this system is monitored and logged. By using this service, 
            you acknowledge and accept these terms.
        </p>
    </div>

    <!-- Contact Information -->
    <div style="padding: 20px; background: rgba(0, 0, 0, 0.5); border: 1px solid #333;">
        <h4 style="margin-top: 0; color: #00ff00; font-size: 0.9rem;">NEED ASSISTANCE?</h4>
        <div style="font-size: 0.85rem; line-height: 1.6;">
            <p>For questions regarding brand compliance or upload issues:</p>
            <ul style="padding-left: 20px;">
                <li>Email: <code>brand-compliance@ecorp.com</code></li>
                <li>Internal: Extension 4502</li>
                <li>Emergency: Contact IT Security immediately</li>
            </ul>
        </div>
    </div>

</div>
