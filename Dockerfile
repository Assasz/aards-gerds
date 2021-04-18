FROM php:8.0-fpm

### Setup environment
RUN apt-get update -y && apt-get install -y zip unzip ngrep \
    && rm -r /var/lib/apt/lists/*

RUN pecl install xdebug && docker-php-ext-enable xdebug

### Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_MEMORY_LIMIT -1

WORKDIR /app

COPY ./ ./
