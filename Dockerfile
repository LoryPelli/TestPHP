FROM dunglas/frankenphp:php8.4.5-alpine

RUN apk add --no-cache postgresql-dev
RUN docker-php-ext-install pdo_pgsql