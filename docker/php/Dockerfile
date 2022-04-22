FROM php:8.1-fpm-alpine

WORKDIR /var/www/html

RUN apk --no-cache add autoconf g++ make\
    && pecl update-channels \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

EXPOSE 9000

HEALTHCHECK --interval=3s \
    --timeout=3s \
    --start-period=30s \
    --retries=3 \
    CMD netstat -an | grep :9000