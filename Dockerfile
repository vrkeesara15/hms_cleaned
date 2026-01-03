FROM php:7.4-apache

# Install system deps and PHP extensions commonly needed by CodeIgniter + mpdf.
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mbstring zip mysqli \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . /var/www/html

# Ensure runtime-writable directories are writable by Apache.
RUN chown -R www-data:www-data application/cache application/logs \
    && composer install --no-dev --optimize-autoloader --no-interaction
