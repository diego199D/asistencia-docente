# Imagen base de PHP
FROM php:8.2-fpm

# Instalar dependencias del sistema y librerías para PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev

# Instalar extensiones de PHP con soporte para PostgreSQL
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Obtener Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear directorio de trabajo para la aplicación Laravel
WORKDIR /var/www

# Exponer puerto del servidor php-fpm
EXPOSE 9000

# Comando para iniciar el servidor PHP-FPM
CMD ["php-fpm"]