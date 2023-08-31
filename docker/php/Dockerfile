FROM php:7.4.33-fpm

COPY ./docker/php/php.ini /usr/local/etc/php/

# composer のインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update \
    && apt-get install -y \
        zlib1g-dev \
        mariadb-client \
        libzip-dev \
        
        tzdata \
        git \
        zip \
        unzip \
        vim \
    && docker-php-ext-install \
        zip \
        pdo_mysql

# Install Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#COPY --from=composer /usr/bin/composer /usr/bin/composer

#RUN composer require nesbot/carbon
#RUN composer require fakerphp/faker




ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV COMPOSER_PROCESS_TIMEOUT 600

ENV PATH $PATH:/composer/vendor/bin



#WORKDIR /var/www

RUN composer global require "laravel/installer"
