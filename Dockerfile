FROM php:8.2-apache

WORKDIR /var/www/html

# Paquetes + extensiones PHP
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libicu-dev \
    libsqlite3-0 libsqlite3-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_sqlite gd intl zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Copia el vhost fijo (sin sed)
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Copia el proyecto
COPY . /var/www/html

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Permisos mínimos para storage y DB sqlite
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Entrypoint (migraciones + caches y arranque de Apache)
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80
CMD ["/entrypoint.sh"]
