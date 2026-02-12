FROM php:7.4-apache

# 1. SETUP THE FLAG
# The flag is in the environment, NOT a file.
# You MUST get RCE to read this. LFI-ing files won't help.
ENV FLAG="XPL8{p0lygl0t_1m4g3_ch41n_m4st3r}"

# 2. SETUP PERMISSIONS
WORKDIR /var/www/html
COPY src/ .

# Ensure uploads folder is writable
RUN chown -R www-data:www-data /var/www/html/uploads \
    && chmod 755 /var/www/html/uploads

# 3. SECURITY CONFIGURATION
# Disable directory listing to make it harder to guess files
RUN echo "Options -Indexes" >> /etc/apache2/apache2.conf

# Hide server signature
RUN echo "ServerSignature Off" >> /etc/apache2/apache2.conf
RUN echo "ServerTokens Prod" >> /etc/apache2/apache2.conf

EXPOSE 80