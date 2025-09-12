# Stage 1: Composer vendor builder
FROM composer:2 AS vendor
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install vendor deps (tanpa dev, optimize)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Stage 2: PHP-FPM app
FROM php:8.3-fpm

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libonig-dev libxml2-dev curl \
    libjpeg-dev libpng-dev libfreetype6-dev default-mysql-client \
    libicu-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip mbstring pcntl bcmath sockets gd intl

WORKDIR /var/www

# Copy app source
COPY . .

# Copy vendor from builder stage
COPY --from=vendor /app/vendor ./vendor

# Set permissions
RUN chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data /var/www

EXPOSE 9000
CMD ["php-fpm"]
