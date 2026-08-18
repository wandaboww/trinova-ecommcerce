#!/bin/sh
set -e

cd /var/www/html

mkdir -p storage/framework/{views,sessions,cache} \
         storage/logs \
         storage/app/{private,public} \
         bootstrap/cache \
         /data

chown -R www-data:www-data storage bootstrap/cache /data
chmod -R 775 storage bootstrap/cache /data

DB_FILE="${DB_DATABASE:-/data/database.sqlite}"

if [ ! -f "$DB_FILE" ]; then
    touch "$DB_FILE"
    chown www-data:www-data "$DB_FILE"
    chmod 664 "$DB_FILE"
    echo "[entrypoint] Created fresh $DB_FILE"
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

php artisan migrate --force --no-interaction

php artisan storage:link --force 2>/dev/null || true

echo "[entrypoint] Bootstrap complete, starting Octane..."

exec php artisan octane:frankenphp \
    --host=0.0.0.0 \
    --port=8000 \
    --workers=auto \
    --no-interaction
