FROM php:8.3-fpm

# Instala extensões necessárias (GD para imagens e extensões de banco)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Define diretório de trabalho
WORKDIR /var/www

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

# Permissões para o Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]