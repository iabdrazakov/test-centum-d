FROM php:8.1.8-fpm-alpine

COPY --chown=www-data:www-data ./ /application

WORKDIR /application

# Installing dependencies
RUN apk --update add nano

# Install Redis
RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
        && pecl install redis \
        && docker-php-ext-enable redis.so

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
