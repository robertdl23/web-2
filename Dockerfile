# Dockerfile en la RAÍZ del proyecto
FROM php:8.2-apache

# 1) Paquetes del sistema necesarios (incluye libjpeg/freetype y pkg-config)
RUN apt-get update && apt-get install -y \
    git unzip curl \
    pkg-config \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libsqlite3-0 libsqlite3-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) pdo_sqlite gd intl zip \
 && a2enmod rewrite \
 && rm -rf /var/lib/apt/lists/*

# 2) Copia del proyecto
WORKDIR /var/www/html
COPY . /var/www/html

# 3) Composer (desde imagen oficial)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# 4) Node 20 + build de Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get update && apt-get install -y nodejs \
 && npm ci --no-audit --no-fund \
 && npm run build \
 && rm -rf /var/lib/apt/lists/*

# 5) SQLite en /tmp (como definiste en las variables de Render)
RUN touch /tmp/database.sqlite \
 && chown -R www-data:www-data /tmp /var/www/html/storage /var/www/html/bootstrap/cache

# 6) Variables/puerto y arranque
ENV PORT=8080
EXPOSE 8080

CMD php artisan migrate --force \
 && php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache \
 && php artisan serve --host=0.0.0.0 --port=$PORT
