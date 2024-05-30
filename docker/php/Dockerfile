FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
