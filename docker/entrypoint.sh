#!/bin/sh
set -e

cd /var/www/html

mkdir -p storage/framework/{views,sessions,cache} \
         storage/logs \
         storage/app/{private,public} \
         bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache

if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
    chown www-data:www-data database/database.sqlite
    echo "[entrypoint] Created fresh database/database.sqlite"
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
