# Etapa 1: Construcción y dependencias
FROM composer:2.7 AS builder

# Establecer directorio de trabajo
WORKDIR /app

# Copiar solo archivos relevantes para Composer (optimiza el cache)
COPY composer.json composer.lock ./

# Instalar dependencias de producción
RUN composer install --no-interaction --no-dev --prefer-dist --no-autoloader

# Copiar la aplicación
COPY . .

# Etapa 2: Producción
FROM php:8.2.20-fpm-alpine

# Establecer directorio de trabajo
WORKDIR /app

# Instalar extensiones de PHP necesarias y dependencias
RUN apk add --no-cache bash && \
    docker-php-ext-install pdo pdo_mysql

# Copiar dependencias instaladas y código desde la etapa de construcción
COPY --from=builder /app /app

# Ajustar permisos y propietario
RUN chmod -R 775 /app/storage /app/bootstrap/cache

# Crear el enlace simbólico para almacenamiento público
RUN php artisan storage:link

# Exponer el puerto para el servidor de desarrollo
EXPOSE 8000

# Cambiar al usuario www-data para evitar ejecutar como root
USER www-data

# Comando por defecto
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
