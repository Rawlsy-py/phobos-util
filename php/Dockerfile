FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    curl \
    && docker-php-ext-install zip pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js 22
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Set working directory
WORKDIR /var/www

# Copy composer.json and composer.lock first to leverage Docker cache
COPY ../composer.json ../composer.lock /var/www/

# Install Laravel dependencies
RUN composer install --no-interaction

# Copy existing application directory contents
COPY ./ /var/www

# Expose port 8000 and serve the application
EXPOSE 8000
CMD ["php", "artisan", "serve"]
