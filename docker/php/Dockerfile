FROM php:7.4-fpm

RUN docker-php-ext-install pdo_mysql
RUN apt-get update && apt-get install --no-install-recommends zlib1g-dev -y \
        libmcrypt-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        xvfb libfontconfig wkhtmltopdf \
    && docker-php-ext-install -j$(nproc) pdo \
    && docker-php-ext-install -j$(nproc) gd \
    && apt-get install git -y \
    && apt-get install zip -y

RUN pecl install redis && docker-php-ext-enable redis
RUN pecl channel-update pecl.php.net
RUN pecl install inotify
RUN docker-php-ext-enable inotify
RUN docker-php-ext-install pcntl
RUN apt-get install curl -y

WORKDIR /home

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN apt-get autoremove -y
RUN apt-get clean

EXPOSE 8000
