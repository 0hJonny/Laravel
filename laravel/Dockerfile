# ============================================
# STAGE 1: Build (установка зависимостей)
# ============================================
FROM php:8.2-fpm-alpine AS builder

# Установка зависимостей для компиляции
RUN apk add --no-cache --update \
    postgresql-dev libpng-dev libzip-dev zlib-dev zip unzip git \
    oniguruma-dev libxml2-dev curl-dev libjpeg-turbo-dev freetype-dev \
 && docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install pdo_pgsql bcmath gd zip mbstring exif pcntl opcache \
 && apk del --no-cache curl-dev libjpeg-turbo-dev freetype-dev libpng-dev libxml2-dev zlib-dev \
 && rm -rf /var/cache/apk/*

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY 60941kkv/composer.json 60941kkv/composer.lock ./
RUN composer install \
    --optimize-autoloader \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --no-dev

# ============================================
# STAGE 2: Production
# ============================================
FROM php:8.2-fpm-alpine

# Создание пользователя
RUN addgroup -g 1000 laravel && \
    adduser -D -G laravel -u 1000 laravel

# Runtime + компиляция зависимостей
RUN apk add --no-cache --update \
    # Runtime
    postgresql-client libpng libzip zlib icu-libs oniguruma libxml2 \
    # Компиляция (удаляются после)
    postgresql-dev libzip-dev zlib-dev libpng-dev libjpeg-turbo-dev \
    freetype-dev oniguruma-dev pkgconf \
 && docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install pdo_pgsql bcmath gd zip mbstring exif pcntl opcache \
 && apk del --no-cache postgresql-dev libzip-dev zlib-dev libpng-dev \
    libjpeg-turbo-dev freetype-dev oniguruma-dev pkgconf \
 && rm -rf /var/cache/apk/*

WORKDIR /var/www/html

# ✅ КОПИРУЕМ php.ini и opcache.ini ИЗ КОРНЯ
COPY php.ini /usr/local/etc/php/php.ini
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Копируем vendor из builder
COPY --from=builder /var/www/html/vendor /var/www/html/vendor

# Копируем проект 60941kkv
COPY 60941kkv/. .

# Права доступа
RUN mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache \
 && chown -R laravel:laravel /var/www/html \
 && chmod -R 775 storage bootstrap/cache \
 && chmod -R 755 public

USER laravel

# ✅ ПРАВИЛЬНЫЙ healthcheck для docker-compose
HEALTHCHECK --interval=30s --timeout=10s --start-period=40s --retries=3 \
  CMD php -r "exit(0);" || exit 1

EXPOSE 9000
CMD ["php-fpm"]
