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

# VHOST estable a /public
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Copia el código
COPY . /var/www/html

# Composer en la imagen
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 🔹 Instalar dependencias PHP (crea vendor/)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database /var/www/html/vendor \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80
CMD ["/entrypoint.sh"]
