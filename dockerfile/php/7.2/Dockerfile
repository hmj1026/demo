FROM php:8.2-fpm-alpine

WORKDIR /src

RUN apk update && \
    apk upgrade && \
    apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev icu-dev && \
    docker-php-ext-install pdo pdo_mysql exif intl && \
    docker-php-ext-configure gd \
      --with-freetype \
      --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd


COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# RUN addgroup -S nginx && adduser -S -G nginx nginx
