FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libonig-dev libxml2-dev curl \
    libjpeg-dev libpng-dev libfreetype6-dev default-mysql-client \
    libicu-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip mbstring pcntl bcmath sockets gd intl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy composer files first 
COPY composer.json composer.lock ./

# Install dependencies
RUN COMPOSER_ALLOW_SUPERUSER=1 COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --optimize-autoloader --no-scripts

# Copy source code
COPY . .

# Set permissions
RUN chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data /var/www

EXPOSE 9000
CMD ["php-fpm"]
