FROM php:7.2-fpm

# Install PHP extensions and PECL modules.
RUN apt-get update && apt-get install -y curl \


#COPY php/php.ini    /usr/local/etc/php/

# Install Composer.
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer\
WORKDIR /app
    COPY . ./
    RUN composer install --no-dev --no-interaction -o

