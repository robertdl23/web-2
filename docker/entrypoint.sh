#!/usr/bin/env bash
set -e

echo "🚀 Iniciando contenedor Laravel..."

# Asegurar BD sqlite
[ -f /var/www/html/database/database.sqlite ] || touch /var/www/html/database/database.sqlite
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Limpiar y reconstruir caches con ENV reales de Render
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migraciones
php artisan migrate --force || true

# Arrancar Apache
exec apache2-foreground
