FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libonig-dev libxml2-dev curl \
    libjpeg-dev libpng-dev libfreetype6-dev default-mysql-client \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip mbstring pcntl bcmath sockets gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy composer files first (caching layer)
COPY backend/composer.json backend/composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy rest of the application
COPY backend ./

# Set permissions
RUN chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data /var/www

EXPOSE 9000
CMD ["php-fpm"]
