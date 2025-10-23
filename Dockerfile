# Use PHP with Apache (has web server pre-installed)
FROM php:8.2-apache

# Enable required PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl nodejs npm && \
    docker-php-ext-install pdo pdo_mysql zip

# Set working directory
WORKDIR /var/www/html

# Copy all project files into the container
COPY ./ /var/www/html

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    composer install --no-dev --optimize-autoloader --no-interaction

# Build front-end assets (CSS + JS)
RUN npm install && npm run build

# Generate Laravel app key
RUN php artisan key:generate || true

# Fix permissions for Laravel
RUN chmod -R 777 storage bootstrap/cache

# Expose port 8080
EXPOSE 8080

# Run migrations (ignore if already migrated)
RUN php artisan migrate --force || true

# Start Apache
CMD ["apache2-foreground"]
