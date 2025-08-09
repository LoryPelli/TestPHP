FROM php:8.4.5-fpm-alpine

RUN apk add --no-cache postgresql-dev
RUN docker-php-ext-install pdo_pgsql