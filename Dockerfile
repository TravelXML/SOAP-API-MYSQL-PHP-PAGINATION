# Use the official PHP image.
FROM php:8.0-apache

# Install dependencies
RUN apt-get update && \
    apt-get install -y libzip-dev zip unzip libxml2-dev && \
    docker-php-ext-install zip mysqli soap && \
    pecl install redis && \
    docker-php-ext-enable redis

# Enable apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY composer.json ./
RUN composer install

# Copy the rest of the application files
COPY . .

# Expose port 80
EXPOSE 80
