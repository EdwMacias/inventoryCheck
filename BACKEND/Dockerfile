FROM php:8.2.20-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql 
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apk add nodejs npm

# RUN  addgroup laravel && adduser -S -G laravel laravel
# USER laravel
WORKDIR /app/

COPY  package*.json .
RUN npm install

COPY  composer.* .
COPY  . .
RUN composer update

# RUN composer update
EXPOSE 8000

CMD [ "php","artisan","serve","--host","0.0.0.0" ]