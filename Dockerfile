FROM php:8.1-fpm-alpine

# Install php extensions
RUN apk --no-cache add $PHPIZE_DEPS icu-dev tini git && \
    pecl install xdebug && \
    docker-php-ext-install bcmath intl opcache pcntl && \
    docker-php-ext-enable pcntl xdebug

# Install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Configure php-fpm & php
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY docker/php.ini $PHP_INI_DIR/conf.d/custom.ini

# Setup Directory
RUN chown www-data:www-data /srv
WORKDIR /srv/share
