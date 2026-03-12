FROM php:8.3-fpm

# Instalar dependències del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    nodejs \
    npm \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# Instalar extensions PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define /var/www como carpeta de trabajo y copia todo el proyecto ahí
WORKDIR /var/www

COPY . .

RUN composer install --no-interaction --optimize-autoloader
RUN npm install && npm run build

# Crea el .env a partir del ejemplo y genera la clave de la app
RUN cp .env.example .env
RUN php artisan key:generate

#Da permisos de escritura a las carpetas que Laravel necesita
RUN chmod -R 775 storage bootstrap/cache

#Abre el puerto 8000 y arranca el servidor de Laravel
EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]