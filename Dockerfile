FROM php:8.2-apache

# Habilitar rewrite y apuntar a /public
RUN a2enmod rewrite \
 && sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf \
 && sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

# Paquetes y extensiones
RUN apt-get update && apt-get install -y \
    git unzip curl pkg-config \
    libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libicu-dev libsqlite3-0 libsqlite3-dev \
 && docker-php-ext-configure gd --with-jpeg \
 && docker-php-ext-install pdo pdo_sqlite gd intl zip \
 && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Código
WORKDIR /var/www/html
COPY . .

# Dependencias PHP
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

# (Opcional) build de assets si usas Vite en prod:
# RUN apt-get update && apt-get install -y nodejs npm \
#  && npm ci --no-audit --no-fund \
#  && npm run build \
#  && rm -rf /var/lib/apt/lists/*

# Crear BD sqlite y permisos
RUN mkdir -p database \
 && touch database/database.sqlite \
 && chown -R www-data:www-data storage bootstrap/cache database \
 && chmod -R 775 storage bootstrap/cache database

# Entrypoint hará migraciones y cache en runtime
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8080
CMD ["/entrypoint.sh"]
