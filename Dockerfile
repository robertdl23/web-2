# Imagen base con PHP CLI 8.2
FROM php:8.2-cli

# Dependencias del sistema y extensiones PHP necesarias (sqlite, gd, zip, intl)
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libicu-dev libsqlite3-0 libsqlite3-dev curl \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install pdo pdo_sqlite gd intl zip \
    && rm -rf /var/lib/apt/lists/*

# Composer (desde imagen oficial)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Node.js 20 (para compilar Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm -v && node -v

# Directorio de trabajo
WORKDIR /app

# Instalar dependencias de PHP (usando cache por capas)
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

# Instalar y construir assets (usando cache por capas)
COPY package*.json vite.config.js ./
COPY resources ./resources
COPY public ./public
RUN npm ci --no-audit --no-fund && npm run build

# Copiar el resto del proyecto
COPY . .

# Permisos para storage y cache
RUN chown -R www-data:www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache

# Puerto para Render
ENV PORT=8000
EXPOSE 8000

# Crear SQLite en /tmp, migrar y levantar Laravel
CMD sh -lc "php -r 'file_exists(\"/tmp/database.sqlite\") || touch(\"/tmp/database.sqlite\");' \
    && php artisan migrate --force \
    && php artisan serve --host 0.0.0.0 --port=$PORT"
