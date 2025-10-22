# Usa PHP con Apache
FROM php:8.2-apache

# Instala dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    git curl zip unzip sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Habilita mod_rewrite de Apache
RUN a2enmod rewrite

# Copia archivos del proyecto al contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Instala Node y compila los assets
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    npm ci && npm run build

# Crea base de datos SQLite temporal
RUN php -r "if (!file_exists('/tmp/database.sqlite')) touch('/tmp/database.sqlite');"

# Configura permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Define variable de entorno para el puerto
ENV PORT=80

# Expone el puerto
EXPOSE 80

# Comando de inicio
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
