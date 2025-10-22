#!/usr/bin/env bash
set -e

echo "🚀 Iniciando contenedor Laravel en Render..."

# Asegurar base de datos SQLite
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "📦 Creando base de datos SQLite..."
    mkdir -p /var/www/html/database
    touch /var/www/html/database/database.sqlite
fi

# Asignar permisos correctos
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Ejecutar migraciones automáticamente (sin shell)
echo "🗄 Ejecutando migraciones..."
php artisan migrate --force || true

# Arrancar Apache
echo "🌐 Levantando servidor Apache..."
exec apache2-foreground
