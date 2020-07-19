FROM composer:latest as composer

FROM php:7.4-apache-buster

LABEL maintainer="Yassine Afnisse <yassine@afnisse.com>"

ARG USER_ID

COPY --from=composer /usr/bin/composer /usr/bin/composer

#
# -------------------------------------------------- Install dependencies -- #
RUN apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
        less \
        git \
        nano \
        apt-utils \
        openssh-client \
        zip \
        unzip \
        libzip-dev \
        libicu-dev \
        libxml2-dev \
        libpq-dev \
        libpng-dev \
        zlib1g-dev; \
    apt-get clean && rm -rf /var/lib/apt/lists/*

#
# ---------------------------------------------------- Install extensions -- #
RUN docker-php-ext-install zip
RUN docker-php-ext-install intl
RUN docker-php-ext-install opcache
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install ctype
RUN docker-php-ext-install json
RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install xml
RUN docker-php-ext-install gd

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install

#
# -------------------------------------------------------------- Security -- #
RUN usermod --non-unique --uid $USER_ID www-data; \
    chown -R www-data:www-data /var/www/html

RUN a2enmod rewrite headers

RUN sed -i "s~DocumentRoot /var/www/html~DocumentRoot /var/www/html/public~" /etc/apache2/sites-available/000-default.conf



# vi: ft=dockerfile
