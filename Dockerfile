FROM php:8.2-apache
WORKDIR /var/www/html

# Paquetes del sistema + extensiones PHP
RUN apt-get update && apt-get install -y \
    git unzip curl ca-certificates gnupg \
    libzip-dev libpng-dev libicu-dev \
    libsqlite3-0 libsqlite3-dev libjpeg62-turbo-dev libfreetype6-dev \
 && docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install pdo pdo_sqlite gd intl zip \
 && a2enmod rewrite \
 && rm -rf /var/lib/apt/lists/*

# VHOST apuntando a /public
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Código de la app
COPY . /var/www/html

# Composer en la imagen
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Dependencias PHP
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# --- Node + build de Vite ---
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && node -v && npm -v

# MUY IMPORTANTE: no pongas NODE_ENV=production antes de esto.
# Ejecuta con dev-deps y luego prune.
RUN npm ci --include=dev --no-audit --no-fund \
    && npm run build \
    && npm prune --omit=dev
# --- FIN Node ---

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database /var/www/html/vendor \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
RUN ls -la public && ls -la public/build

EXPOSE 80
CMD ["/entrypoint.sh"]
