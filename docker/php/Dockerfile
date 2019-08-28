FROM php:7.3-fpm-alpine

RUN apk --no-cache add ca-certificates curl bash git zlib-dev autoconf make grep gcc libc-dev openssh openssl shadow

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

ARG UID=82
RUN usermod -u $UID www-data
USER www-data

WORKDIR /var/www/html

CMD ["php-fpm"]

EXPOSE 9000