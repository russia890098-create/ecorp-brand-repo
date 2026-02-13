<?php if(!defined('ECORP_ACCESS')) die('Direct access denied'); ?>

<div style="max-width: 700px; margin: 0 auto;">
    
    <div style="text-align: center; padding: 60px 20px;">
        
        <div style="font-size: 4rem; margin-bottom: 20px; opacity: 0.5;">🔒</div>
        
        <h2 style="color: var(--ecorp-red); margin-bottom: 10px; text-transform: uppercase;">
            ACCESS DENIED
        </h2>
        
        <div style="height: 2px; width: 100px; background: var(--ecorp-red); margin: 20px auto;"></div>
        
        <p style="font-size: 1.1rem; line-height: 1.6; margin-bottom: 30px; opacity: 0.8;">
            This area requires <strong>Level 5 Administrative Clearance</strong> or higher.
        </p>

        <!-- Fake Login Attempt Counter -->
        <div style="background: rgba(199, 0, 0, 0.1); border: 1px solid var(--ecorp-red); padding: 20px; margin-bottom: 30px;">
            <div style="font-size: 0.85rem; color: var(--ecorp-red);">
                <strong>SECURITY NOTICE</strong>
            </div>
            <div style="margin-top: 10px; font-size: 0.9rem; opacity: 0.8;">
                Unauthorized access attempts are logged and monitored.
                This incident has been recorded.
            </div>
        </div>

        <!-- Fake Security Details -->
        <div style="background: rgba(0, 0, 0, 0.5); border: 1px solid #333; padding: 20px; text-align: left; font-size: 0.85rem; font-family: monospace;">
            <div style="opacity: 0.5; margin-bottom: 10px;">SYSTEM LOG:</div>
            <div style="color: #00ff00;">
                [<?php echo date('Y-m-d H:i:s'); ?>] ACCESS_DENIED: /admin<br>
                [<?php echo date('Y-m-d H:i:s'); ?>] USER: Guest (Session: <?php echo substr(session_id(), 0, 8); ?>)<br>
                [<?php echo date('Y-m-d H:i:s'); ?>] CLEARANCE: Level 0 (RESTRICTED)<br>
                [<?php echo date('Y-m-d H:i:s'); ?>] REQUIRED: Level 5 (ADMIN)<br>
                [<?php echo date('Y-m-d H:i:s'); ?>] ACTION: Request denied, incident logged<br>
            </div>
        </div>

        <!-- Required Privileges Info -->
        <div style="margin-top: 30px; padding: 20px; border: 1px solid #333; text-align: left;">
            <h4 style="color: var(--text); margin-top: 0;">Administrative Functions Require:</h4>
            <ul style="line-height: 1.8; opacity: 0.7;">
                <li>Multi-factor authentication token</li>
                <li>VPN connection from authorized network</li>
                <li>Active directory administrator credentials</li>
                <li>Physical security key (YubiKey or similar)</li>
                <li>Approval from Security Operations Center</li>
            </ul>
        </div>

        <!-- Fake Hint (Red Herring) -->
        <div style="margin-top: 30px; padding: 15px; background: rgba(255, 153, 0, 0.05); border-left: 3px solid #ff9900;">
            <div style="font-size: 0.85rem; opacity: 0.6; line-height: 1.6;">
                <strong>Note:</strong> If you believe you should have access to this area, 
                contact your system administrator to request privilege elevation. 
                Attempts to bypass security controls will result in account termination.
            </div>
        </div>

        <!-- Return Link -->
        <div style="margin-top: 40px;">
            <a href="?page=home" style="display: inline-block; padding: 12px 30px; background: var(--panel); border: 1px solid var(--ecorp-red); color: var(--text); text-decoration: none; transition: 0.3s;">
                ← Return to Dashboard
            </a>
        </div>

    </div>

</div>

<!-- Hidden comment hint for clever contestants -->
<!-- 
    Nice try! Admin access won't help here.
    The real vulnerability isn't in authentication bypass.
    Think about how files are processed... 
-->
