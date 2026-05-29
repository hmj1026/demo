FROM php:7.2-fpm-alpine

WORKDIR /src

RUN apk update && \
    apk upgrade && \
    apk add --no-cache libmcrypt-dev freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev && \
    docker-php-ext-install pdo pdo_mysql exif && \
    docker-php-ext-configure gd \
      --with-freetype-dir=/usr/include/ \
      --with-jpeg-dir=/usr/include/ \
      --with-png-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd


COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# RUN addgroup -S nginx && adduser -S -G nginx nginx
