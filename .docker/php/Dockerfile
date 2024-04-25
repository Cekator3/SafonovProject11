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
RUN docker-php-ext-install \
    zip \
    pdo \
    pgsql \
    pdo_pgsql \
    opcache

# Install and enable redis PHP extension
RUN pecl install -o -f redis-6.0.2
RUN docker-php-ext-enable redis

# Create PHP-FPM's and nginx user
RUN groupadd \
    --gid 1010 \
    www
RUN useradd \
    --uid 1010 \
    --gid www \
    --no-create-home \
    www

# Set image's user
USER www

# Install the PHP production configuration
COPY .docker/php/php.ini "$PHP_INI_DIR/php.ini"
COPY .docker/php/php-fpm.config "$PHP_INI_DIR/php-fpm.config"
COPY .docker/php/opcache.ini $PHP_INI_DIR/conf.d/

# Install project files
COPY --chown=www . /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
# Install project's dependencies
RUN composer install \
            --no-dev \
            --prefer-dist \
            --no-scripts \
            --no-autoloader \
            --no-progress \
            --ignore-platform-reqs

# Generate autoload files
RUN composer dump-autoload
RUN composer check-platform-reqs

# Create image storage (symbolic link)
RUN php artisan storage:link
# Optimize stuff
RUN php artisan optimize
