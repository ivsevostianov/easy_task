# Use the official PHP 8.2 image with Apache
FROM php:8.2-apache

# Install system dependencies needed by Laravel
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache's mod_rewrite for Laravel clean URLs
RUN a2enmod rewrite

# Install Node.js and npm
RUN apt-get update && apt-get install -y nodejs npm

# Copy the custom Apache configuration to set DocumentRoot to /var/www/html/public
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Set working directory
WORKDIR /var/www/html

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
