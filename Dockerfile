# php:8.2-fpm-alpine — smallest official PHP runtime that runs Laravel 10 + Filament 3.
FROM php:8.2-fpm-alpine AS base
COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/local/bin/
# intl: filament/support. exif: spatie/image + medialibrary. gd: intervention/image driver.
RUN install-php-extensions pdo_mysql intl exif gd bcmath opcache \
    && printf 'upload_max_filesize=32M\npost_max_size=32M\nmemory_limit=256M\n' \
       > /usr/local/etc/php/conf.d/app.ini
WORKDIR /var/www/html

FROM base AS vendor
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction
COPY . .
RUN composer dump-autoload --optimize --no-dev

FROM base
COPY --from=vendor --chown=www-data:www-data /var/www/html .
RUN chown -R www-data:www-data storage bootstrap/cache
