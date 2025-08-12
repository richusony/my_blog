# Use the official PHP 8.3 image as the base image
FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk update && apk add \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    icu-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . .

# Install dependencies
RUN composer install --no-scripts --no-autoloader

# Generate autoload files
RUN composer dump-autoload

# Generate the Laravel application key
RUN php artisan key:generate

# Generate database migrations
RUN php artisan migrate

# Expose the port the app will run on
EXPOSE 9000

# Start the server
CMD ["php-fpm"]