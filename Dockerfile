FROM php:7.4-apache

# ==============================================================================
# E CORP BRAND REPOSITORY - PRODUCTION CTF DOCKERFILE
# ==============================================================================
# Security Level: HARD
# Vulnerability: Polyglot Upload + LFI → RCE (No shortcuts allowed)
# ==============================================================================

# 1. INSTALL REQUIRED PACKAGES
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    cron \
    && rm -rf /var/lib/apt/lists/*

# 2. CONFIGURE PHP GD LIBRARY (Required for getimagesize())
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# 3. SETUP THE FLAG ENVIRONMENT
# Primary flag - this is what contestants need to capture
ENV FLAG="XPL8{p0lygl0t_1m4g3_ch41n_m4st3r}"

# Decoy flags to confuse automated scrapers
ENV DECOY_FLAG_1="XPL8{n1c3_try_but_wr0ng_fl4g}"
ENV DECOY_FLAG_2="XPL8{4lm0st_th3r3_k33p_g01ng}"
ENV DATABASE_PASSWORD="admin123"
ENV API_KEY="sk-fake-key-12345"
ENV ADMIN_TOKEN="Bearer_eyJ0eXAiOiJKV1QiLCJhbGc"

# 4. CREATE NON-ROOT USER FOR SECURITY
# This prevents /proc/self/environ from being easily readable
RUN useradd -m -s /bin/bash www-ctf && \
    usermod -aG www-data www-ctf

# 5. SETUP WORKING DIRECTORY AND COPY FILES
WORKDIR /var/www/html
COPY src/ .

# 6. CREATE UPLOADS DIRECTORY STRUCTURE
RUN mkdir -p /var/www/html/uploads && \
    chown -R www-data:www-data /var/www/html && \
    chmod 755 /var/www/html/uploads && \
    chmod 644 /var/www/html/*.php && \
    chmod 644 /var/www/html/style.css && \
    chmod 755 /var/www/html/pages

# 7. CREATE .htaccess FOR UPLOADS DIRECTORY
# This disables direct PHP execution in uploads/ (but include() still works - that's the vuln!)
RUN echo '<FilesMatch "\.ph(p[3457]?|tml)$">' > /var/www/html/uploads/.htaccess && \
    echo '    Order Deny,Allow' >> /var/www/html/uploads/.htaccess && \
    echo '    Deny from all' >> /var/www/html/uploads/.htaccess && \
    echo '</FilesMatch>' >> /var/www/html/uploads/.htaccess && \
    echo 'php_flag engine off' >> /var/www/html/uploads/.htaccess && \
    echo 'Options -Indexes' >> /var/www/html/uploads/.htaccess && \
    chown www-ctf:www-data /var/www/html/uploads/.htaccess && \
    chmod 644 /var/www/html/uploads/.htaccess

# 8. RESTRICT /proc FILESYSTEM ACCESS
# This prevents easy flag capture via /proc/self/environ
RUN echo '#!/bin/bash' > /usr/local/bin/restrict-proc.sh && \
    echo 'chmod 000 /proc/self/environ 2>/dev/null || true' >> /usr/local/bin/restrict-proc.sh && \
    echo 'chmod 000 /proc/1/environ 2>/dev/null || true' >> /usr/local/bin/restrict-proc.sh && \
    chmod +x /usr/local/bin/restrict-proc.sh

# 9. CONFIGURE APACHE SECURITY SETTINGS
RUN echo "# Security Configuration for E Corp CTF" >> /etc/apache2/apache2.conf && \
    echo "ServerSignature Off" >> /etc/apache2/apache2.conf && \
    echo "ServerTokens Prod" >> /etc/apache2/apache2.conf && \
    echo "Options -Indexes -FollowSymLinks" >> /etc/apache2/apache2.conf && \
    echo "TraceEnable Off" >> /etc/apache2/apache2.conf && \
    echo "" >> /etc/apache2/apache2.conf && \
    echo "# Disable dangerous PHP functions (but keep system/exec for the challenge)" >> /etc/apache2/apache2.conf && \
    echo "<Directory /var/www/html>" >> /etc/apache2/apache2.conf && \
    echo "    Options -Indexes -FollowSymLinks" >> /etc/apache2/apache2.conf && \
    echo "    AllowOverride All" >> /etc/apache2/apache2.conf && \
    echo "    Require all granted" >> /etc/apache2/apache2.conf && \
    echo "</Directory>" >> /etc/apache2/apache2.conf

# 10. ENABLE REQUIRED APACHE MODULES
RUN a2enmod rewrite headers

# 11. CONFIGURE PHP SETTINGS FOR SECURITY
RUN echo "expose_php = Off" >> /usr/local/etc/php/php.ini && \
    echo "display_errors = Off" >> /usr/local/etc/php/php.ini && \
    echo "log_errors = On" >> /usr/local/etc/php/php.ini && \
    echo "error_log = /var/log/apache2/php_errors.log" >> /usr/local/etc/php/php.ini && \
    echo "upload_max_filesize = 2M" >> /usr/local/etc/php/php.ini && \
    echo "post_max_size = 2M" >> /usr/local/etc/php/php.ini && \
    echo "max_execution_time = 30" >> /usr/local/etc/php/php.ini && \
    echo "memory_limit = 128M" >> /usr/local/etc/php/php.ini && \
    echo "allow_url_fopen = Off" >> /usr/local/etc/php/php.ini && \
    echo "allow_url_include = Off" >> /usr/local/etc/php/php.ini

# 12. CREATE CLEANUP CRON JOB
# Deletes uploaded files older than 30 minutes (keeps challenge clean)
RUN echo "*/30 * * * * find /var/www/html/uploads -type f -name '*.jpg' -mmin +30 -delete 2>/dev/null" > /etc/cron.d/cleanup-uploads && \
    echo "*/30 * * * * find /var/www/html/uploads -type f -name '*.png' -mmin +30 -delete 2>/dev/null" >> /etc/cron.d/cleanup-uploads && \
    echo "*/30 * * * * find /var/www/html/uploads -type f -name '*.jpeg' -mmin +30 -delete 2>/dev/null" >> /etc/cron.d/cleanup-uploads && \
    chmod 0644 /etc/cron.d/cleanup-uploads && \
    crontab /etc/cron.d/cleanup-uploads

# 13. CREATE HEALTH CHECK ENDPOINT FOR RENDER
RUN echo "<?php http_response_code(200); echo 'OK'; ?>" > /var/www/html/health.php && \
    chown www-ctf:www-data /var/www/html/health.php && \
    chmod 644 /var/www/html/health.php

# 14. CREATE STARTUP SCRIPT
RUN echo '#!/bin/bash' > /usr/local/bin/start-ctf.sh && \
    echo 'set -e' >> /usr/local/bin/start-ctf.sh && \
    echo '' >> /usr/local/bin/start-ctf.sh && \
    echo '# Restrict proc access' >> /usr/local/bin/start-ctf.sh && \
    echo '/usr/local/bin/restrict-proc.sh' >> /usr/local/bin/start-ctf.sh && \
    echo '' >> /usr/local/bin/start-ctf.sh && \
    echo '# Start cron for cleanup' >> /usr/local/bin/start-ctf.sh && \
    echo 'cron' >> /usr/local/bin/start-ctf.sh && \
    echo '' >> /usr/local/bin/start-ctf.sh && \
    echo '# Set proper ownership' >> /usr/local/bin/start-ctf.sh && \
    echo 'chmod 777 /var/www/html/uploads' >> /usr/local/bin/start-ctf.sh && \
    echo '' >> /usr/local/bin/start-ctf.sh && \
    echo '# Start Apache' >> /usr/local/bin/start-ctf.sh && \
    echo 'echo "🚀 E Corp Brand Repository - ONLINE"' >> /usr/local/bin/start-ctf.sh && \
    echo 'echo "⚠️  All activity is monitored and logged."' >> /usr/local/bin/start-ctf.sh && \
    echo 'echo ""' >> /usr/local/bin/start-ctf.sh && \
    echo 'exec apache2-foreground' >> /usr/local/bin/start-ctf.sh && \
    chmod +x /usr/local/bin/start-ctf.sh

# 15. ADD SECURITY HEADERS VIA APACHE
RUN echo '<IfModule mod_headers.c>' > /etc/apache2/conf-available/security-headers.conf && \
    echo '    Header always set X-Frame-Options "DENY"' >> /etc/apache2/conf-available/security-headers.conf && \
    echo '    Header always set X-Content-Type-Options "nosniff"' >> /etc/apache2/conf-available/security-headers.conf && \
    echo '    Header always set X-XSS-Protection "1; mode=block"' >> /etc/apache2/conf-available/security-headers.conf && \
    echo '    Header always set Referrer-Policy "no-referrer"' >> /etc/apache2/conf-available/security-headers.conf && \
    echo '    Header always set Permissions-Policy "geolocation=(), microphone=(), camera=()"' >> /etc/apache2/conf-available/security-headers.conf && \
    echo '</IfModule>' >> /etc/apache2/conf-available/security-headers.conf && \
    a2enconf security-headers

# 16. SET FINAL PERMISSIONS
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type f -exec chmod 644 {} \; && \
    find /var/www/html -type d -exec chmod 755 {} \;

# 17. EXPOSE PORT
EXPOSE 80

# 18. HEALTH CHECK (For Render monitoring)
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/health.php || exit 1

# 19. START THE APPLICATION
CMD ["/usr/local/bin/start-ctf.sh"]


