FROM php:8.4.5-fpm-alpine

RUN apk add --no-cache libcurl curl-dev postgresql-dev file
RUN docker-php-ext-install pdo_pgsql curl fileinfo