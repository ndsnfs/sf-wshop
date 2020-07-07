FROM php:7.2-fpm

ARG composer_home_dir=/home/.composer

ENV COMPOSER_HOME=$composer_home_dir

RUN apt-get update && apt-get install -y \
        curl \
        git \
        zip \
        unzip \
        libpq-dev \
    && mkdir /app \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-install pdo pdo_pgsql \
    && chown -R 1000:www-data $composer_home_dir \
    && chmod -R g+rwx $composer_home_dir

WORKDIR /app