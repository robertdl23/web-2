#!/usr/bin/env bash
set -o pipefail
# NO usamos "set -e" para que errores no detengan el arranque web.

cd /var/www/html

echo "[entrypoint] Iniciando…"

# Asegurar permisos
chown -R www-data:www-data storage bootstrap/cache || true

# Si usamos sqlite, asegurar archivo
if [ "${DB_CONNECTION:-}" = "sqlite" ]; then
  DB_PATH="${DB_DATABASE:-/var/www/html/database/database.sqlite}"
  if [ ! -f "$DB_PATH" ]; then
    echo "[entrypoint] Creando SQLite en $DB_PATH"
    mkdir -p "$(dirname "$DB_PATH")"
    touch "$DB_PATH"
    chown www-data:www-data "$DB_PATH" || true
  fi
fi

# Enlaces y caches (no fatales)
php artisan storage:link       || true
php artisan config:cache       || true
php artisan route:cache        || true
php artisan view:cache         || true

# Migraciones y seeds (no fatales para que Apache arranque sí o sí)
php artisan migrate --force    || true
php artisan db:seed --force    || true

echo "[entrypoint] Lanzando Apache…"
exec apache2-foreground
