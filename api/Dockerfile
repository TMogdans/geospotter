FROM php:8.1-fpm-alpine

ARG user
ARG uid

RUN apk add --no-cache $PHPIZE_DEPT \
    build-base \
    doas \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    icu-dev \
    zip \
    unzip \
    autoconf \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql exif pcntl bcmath gd intl \
    && pecl install xdebug-3.1.5 \
    && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN adduser $user -G wheel; \
    echo 'test1234' | chpasswd; \
    echo 'permit :wheel as root' > /etc/doas.d/doas.conf

USER $user

RUN mkdir -p /home/$user/.composer && \
    chown -R $user:wheel /home/$user

WORKDIR /var/www/html/geospotter
