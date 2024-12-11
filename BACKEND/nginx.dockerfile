# Usar Nginx oficial
FROM nginx:stable-alpine

WORKDIR /app/public

# Copiar configuración personalizada
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copiar archivos públicos desde la etapa PHP-FPM
COPY ./public .

# Exponer el puerto 80 para Nginx
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]