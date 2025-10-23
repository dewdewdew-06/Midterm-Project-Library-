# Use PHP with Apache (has web server pre-installed)
FROM php:8.2-apache

# Enable required PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl && \
    docker-php-ext-install pdo pdo_mysql zip

# Set working directory
WORKDIR /var/www/html

# Copy all project files into the container
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    composer install --no-dev --optimize-autoloader

# Generate Laravel app key
RUN php artisan key:generate || true

# Expose port 8080
EXPOSE 8080

# Start Apache (instead of php artisan serve)
CMD ["apache2-foreground"]
