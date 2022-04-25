FROM php:8.1-fpm-alpine

COPY ./docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh

WORKDIR /var/www/html

RUN apk --no-cache add autoconf g++ make\
    && pecl update-channels \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install mysqli pdo_mysql

EXPOSE 9000

HEALTHCHECK --interval=3s \
    --timeout=3s \
    --start-period=2m \
    --retries=3 \
    CMD netstat -an | grep :9000

ENTRYPOINT [ "entrypoint.sh" ]
CMD [ "php-fpm" ]