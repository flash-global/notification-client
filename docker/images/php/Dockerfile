FROM php:5.5-apache

RUN apt-get update

# Install zip
RUN apt-get install -y libzzip-dev zlib1g zlib1g-dbg zlib1g-dev zlibc

# Installing some PHP extensions
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

RUN usermod -u 1000 www-data

RUN a2enmod rewrite
