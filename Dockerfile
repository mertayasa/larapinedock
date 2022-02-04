FROM php:7.4-fpm

ARG user
ARG uid

RUN apt-get update
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN apt-get update && \
    apt-get install --no-install-recommends -y \
        zlib1g-dev \
        libzip-dev \
        zip \
        unzip \
        libpng-dev 

        # git \
        # curl \ 
        # nodejs \
        # npm \
        # cron \
        # supervisor \
        # nano
        
RUN docker-php-ext-install \
        gd \
        pdo \
        exif \
        pcntl \
        mysqli \
        bcmath \
        pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# RUN npm install

WORKDIR /var/www
USER $user
