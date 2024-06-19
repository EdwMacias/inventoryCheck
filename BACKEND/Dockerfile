FROM php:8.2.20-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql 
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apk add nodejs npm

WORKDIR /app/

COPY  composer.* .
COPY  . .
RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader

# RUN composer update
EXPOSE 8000

CMD [ "php","artisan","serve","--host","0.0.0.0" ]