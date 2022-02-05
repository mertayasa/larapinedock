FROM php:7.4-fpm

ARG user
ARG uid

RUN apt-get update
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install required libraries
RUN apt-get update && \
    apt-get install --no-install-recommends -y \
        zip \
        unzip \
        zlib1g-dev \
        libzip-dev \
        libpng-dev \
        libicu-dev 

# RUN docker-php-ext-configure intl
        
# Install php extension
RUN docker-php-ext-install \
        gd \
        pdo \
        intl \
        exif \
        pcntl \
        mysqli \
        bcmath \
        pdo_mysql

# Increase memory for post upload, etc
RUN echo upload_max_filesize = 512M >> /usr/local/etc/php/conf.d/docker-post-size.ini && \
    echo post_max_size = 512M >> /usr/local/etc/php/conf.d/docker-post-size.ini && \
    echo memory_limit = 512M >> /usr/local/etc/php/conf.d/docker-post-size.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user


WORKDIR /var/www
USER $user

# RUN npm install

# git \
# curl \ 
# nodejs \
# npm \
# cron \
# supervisor \
# nano