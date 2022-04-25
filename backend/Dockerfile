FROM php:8.0.12-fpm

RUN set -eux; \
    apt-get update; \
    apt-get install -y git; \
    apt-get install -y vim

COPY --from=composer:2.1.8 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . ./

RUN set -eux; \
	composer install --prefer-dist --no-autoloader --no-scripts --no-progress; \
	composer clear-cache

RUN set -eux; \
    bin/console cache:clear
