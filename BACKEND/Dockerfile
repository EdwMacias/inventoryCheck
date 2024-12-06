# Etapa 1: Construcción y dependencias
FROM composer:2.7 AS builder

# Establecer directorio de trabajo
WORKDIR /app

# Copiar solo archivos relevantes para Composer (optimiza el cache)
COPY composer.json composer.lock ./

# Copiar la aplicación
COPY . .

# Instalar dependencias de producción
RUN composer install --optimize-autoloader --no-dev

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
RUN chmod -R 777 /app/storage /app/bootstrap/cache
# Crear el enlace simbólico para almacenamiento público
RUN php artisan storage:link
# Exponer el puerto para el servidor de desarrollo
EXPOSE 9000
# Comando por defecto
CMD ["php-fpm"]
