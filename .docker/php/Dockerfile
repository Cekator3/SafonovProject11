# FROM php:8.3.6-fpm-alpine
FROM php:8.3.6-fpm

# ENV PHP_INI_DIR=/usr/local/etc/php

ARG UID=1000
ARG GID=1000

WORKDIR /var/www/html

# Update all applications
RUN apt-get update

# Install applications
RUN apt-get install --quiet --yes --no-install-recommends \
    libzip-dev \
    libpq-dev \
    unzip

# Install Database PHP extensions and zip ext.
RUN docker-php-ext-install zip pdo pgsql pdo_pgsql

# Install redis PHP extension
RUN pecl install -o -f redis-6.0.2
# Enable redis ext.
RUN docker-php-ext-enable redis

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Create app user (with mine user and group id)
RUN groupadd --gid ${GID} www
RUN useradd --uid ${UID} -g www www

# Copy existing application directory contents
ADD . /var/www/html

# Copy existing application directory permissions
RUN chown -R www:www /var/www/html
RUN find /var/www/html -type d -exec chmod 0775 '{}' \;

# Change php fpm user
RUN sed -i "s/user = www-data/user = www/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = www/g" /usr/local/etc/php-fpm.d/www.conf

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
