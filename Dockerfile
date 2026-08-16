FROM node:22-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci --frozen-lockfile

COPY vite.config.js ./
COPY resources/ ./resources/
COPY public/ ./public/

RUN npm run build

FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader \
    --ignore-platform-reqs \
    --no-scripts


FROM dunglas/frankenphp:latest-php8.2-alpine

LABEL org.opencontainers.image.title="Trinova Digital"
LABEL org.opencontainers.image.source="https://github.com/trinova/digital"

RUN install-php-extensions \
    pdo_sqlite \
    sqlite3 \
    opcache \
    intl \
    pcntl \
    zip \
    bcmath \
    exif

# Recommended php.ini for production
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Tune OPcache and upload limits
COPY docker/php.ini "$PHP_INI_DIR/conf.d/99-app.ini"

WORKDIR /var/www/html

COPY . .
COPY --from=assets /app/public/build ./public/build
COPY --from=vendor /app/vendor ./vendor
COPY docker/entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

RUN mkdir -p storage/framework/{views,sessions,cache} \
             storage/logs \
             storage/app/{private,public} \
             bootstrap/cache \
             database \
 && chown -R www-data:www-data storage bootstrap/cache database \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 8000

RUN apk add --no-cache curl

HEALTHCHECK --interval=30s --timeout=10s --start-period=60s --retries=3 \
    CMD curl -sf http://localhost:8000/up || exit 1

ENTRYPOINT ["/entrypoint.sh"]
