FROM php:8.3-cli

RUN apt-get update && apt-get install -y unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

WORKDIR /app

COPY . .

RUN curl -sS https://getcomposer.org/installer | php \
    && php composer.phar install --no-dev --optimize-autoloader

RUN php artisan key:generate || true

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
