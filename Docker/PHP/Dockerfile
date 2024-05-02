# Use official PHP image as base
FROM php:8.0-fpm

# Set working directory in the container
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update \
    && apt-get install -y \
        git \
        unzip \
        libpq-dev \
    && docker-php-ext-install pdo_pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the entire Symfony project into the container
COPY . .

# Expose port 9000 to communicate with PHP-FPM
EXPOSE 9000