# install PHP
FROM php:8.3.6-fpm

WORKDIR /var/www/html

# Update all applications
RUN apt-get update

# Install applications
RUN apt-get install --quiet --yes --no-install-recommends \
    libzip-dev \
    libpq-dev \
    unzip

# Install Database PHP extensions and zip ext.
RUN docker-php-ext-install zip pdo pgsql pdo_pgsql opcache
# Install redis PHP extension
RUN pecl install -o -f redis-6.0.2
# Enable redis ext.
RUN docker-php-ext-enable redis

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY .docker/php/opcache.ini $PHP_INI_DIR/conf.d/

# Copy project files to image
COPY --chown=www-data . /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
# Install project's dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --prefer-dist --no-scripts --no-autoloader --no-progress --ignore-platform-reqs
# Generate autoload files
RUN composer dump-autoload
RUN composer check-platform-reqs

# Create image storage (symbolic link)
RUN php artisan storage:link
# Optimize stuff
RUN php artisan optimize
