#!/usr/bin/env bash
set -e

cd /var/www/html

# Asegura rutas y permisos
mkdir -p storage/framework/{cache,sessions,views} bootstrap/cache database
touch database/database.sqlite || true
chown -R www-data:www-data storage bootstrap/cache database
chmod -R 775 storage bootstrap/cache database

# Limpia (si falla, no rompas el boot)
php artisan config:clear || true
php artisan route:clear  || true
php artisan view:clear   || true

# Migraciones
php artisan migrate --force

# Cachea
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Arranca Apache
exec apache2-foreground
