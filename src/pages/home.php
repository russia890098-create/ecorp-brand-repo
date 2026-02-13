<?php if(!defined('ECORP_ACCESS')) die('Direct access denied'); ?>

<div style="max-width: 900px; margin: 0 auto;">
    
    <h3 style="color: var(--ecorp-red); margin-bottom: 10px;">Dashboard Overview</h3>
    
    <p style="line-height: 1.6; margin-bottom: 30px;">
        Welcome to the E Corp Brand Repository. This centralized asset management system 
        provides secure storage and retrieval of all corporate brand materials. Use the 
        navigation to submit new assets or review corporate identity guidelines.
    </p>

    <!-- System Status -->
    <div style="background: rgba(0, 255, 0, 0.05); border: 1px solid #00ff00; padding: 20px; margin-bottom: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <strong style="color: #00ff00;">SYSTEM STATUS:</strong> All services operational
            </div>
            <div style="font-size: 0.8rem; opacity: 0.7;">
                Last updated: <?php echo date('Y-m-d H:i:s'); ?> UTC
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-box">
            <div style="font-size: 2rem; font-weight: bold; color: var(--ecorp-red);">14,203</div>
            <div style="margin-top: 10px; opacity: 0.7; font-size: 0.9rem;">TOTAL ASSETS</div>
        </div>
        <div class="stat-box">
            <div style="font-size: 2rem; font-weight: bold; color: #ff9900;">4</div>
            <div style="margin-top: 10px; opacity: 0.7; font-size: 0.9rem;">PENDING REVIEW</div>
        </div>
        <div class="stat-box">
            <div style="font-size: 2rem; font-weight: bold; color: #00ff00;">84%</div>
            <div style="margin-top: 10px; opacity: 0.7; font-size: 0.9rem;">STORAGE USED</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div style="margin-top: 40px;">
        <h3 style="color: var(--text); margin-bottom: 20px;">Quick Actions</h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
            <a href="?page=upload" style="display: block; padding: 20px; background: rgba(199, 0, 0, 0.1); border: 1px solid var(--ecorp-red); text-decoration: none; color: var(--text); transition: 0.3s;">
                <div style="font-size: 1.5rem; margin-bottom: 10px;">📤</div>
                <strong>Upload New Asset</strong>
                <div style="font-size: 0.85rem; opacity: 0.7; margin-top: 5px;">
                    Submit brand materials for archival
                </div>
            </a>
            
            <a href="?page=policy" style="display: block; padding: 20px; background: rgba(255, 255, 255, 0.02); border: 1px solid #333; text-decoration: none; color: var(--text); transition: 0.3s;">
                <div style="font-size: 1.5rem; margin-bottom: 10px;">📋</div>
                <strong>Brand Guidelines</strong>
                <div style="font-size: 0.85rem; opacity: 0.7; margin-top: 5px;">
                    Review corporate identity standards
                </div>
            </a>
            
            <a href="?page=admin" style="display: block; padding: 20px; background: rgba(255, 255, 255, 0.02); border: 1px solid #333; text-decoration: none; color: var(--text); transition: 0.3s; opacity: 0.5;">
                <div style="font-size: 1.5rem; margin-bottom: 10px;">🔒</div>
                <strong>Admin Panel</strong>
                <div style="font-size: 0.85rem; opacity: 0.7; margin-top: 5px;">
                    Requires elevated privileges
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div style="margin-top: 40px;">
        <h3 style="color: var(--text); margin-bottom: 20px;">Recent Activity</h3>
        
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid var(--ecorp-red);">
                    <th style="padding: 12px; text-align: left;">TIMESTAMP</th>
                    <th style="padding: 12px; text-align: left;">ACTION</th>
                    <th style="padding: 12px; text-align: left;">USER</th>
                    <th style="padding: 12px; text-align: left;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 12px; opacity: 0.7; font-size: 0.85rem;">2024-02-15 14:23:11</td>
                    <td style="padding: 12px;">Asset Upload</td>
                    <td style="padding: 12px; opacity: 0.7;">marketing@ecorp.com</td>
                    <td style="padding: 12px; color: #00ff00;">APPROVED</td>
                </tr>
                <tr>
                    <td style="padding: 12px; opacity: 0.7; font-size: 0.85rem;">2024-02-15 13:45:02</td>
                    <td style="padding: 12px;">Asset Upload</td>
                    <td style="padding: 12px; opacity: 0.7;">design@ecorp.com</td>
                    <td style="padding: 12px; color: #ff9900;">PENDING</td>
                </tr>
                <tr>
                    <td style="padding: 12px; opacity: 0.7; font-size: 0.85rem;">2024-02-15 12:18:55</td>
                    <td style="padding: 12px;">Policy Review</td>
                    <td style="padding: 12px; opacity: 0.7;">admin@ecorp.com</td>
                    <td style="padding: 12px; color: #00ff00;">COMPLETED</td>
                </tr>
                <tr>
                    <td style="padding: 12px; opacity: 0.7; font-size: 0.85rem;">2024-02-15 11:02:33</td>
                    <td style="padding: 12px;">Asset Upload</td>
                    <td style="padding: 12px; opacity: 0.7;">external@contractor.com</td>
                    <td style="padding: 12px; color: #c70000;">REJECTED</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- System Information -->
    <div style="margin-top: 40px; padding: 20px; background: rgba(0, 0, 0, 0.5); border: 1px solid #333;">
        <h3 style="color: #00ff00; margin-top: 0; font-size: 1rem;">SYSTEM INFORMATION</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; font-size: 0.85rem;">
            <div>
                <div style="opacity: 0.6;">Platform Version:</div>
                <div style="color: #00ff00;">v4.0.2</div>
            </div>
            <div>
                <div style="opacity: 0.6;">PHP Version:</div>
                <div style="color: #00ff00;"><?php echo PHP_VERSION; ?></div>
            </div>
            <div>
                <div style="opacity: 0.6;">Server Time:</div>
                <div style="color: #00ff00;"><?php echo date('H:i:s'); ?> UTC</div>
            </div>
            <div>
                <div style="opacity: 0.6;">Upload Limit:</div>
                <div style="color: #00ff00;">2MB</div>
            </div>
        </div>
    </div>

</div>
