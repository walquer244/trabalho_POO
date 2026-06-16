# PHP 8.2 + Apache
FROM php:8.2-apache

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    default-mysql-client

# Extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Apache Rewrite
RUN a2enmod rewrite

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Diretório de trabalho
WORKDIR /var/www/html

# Configuração do Apache para Laravel
RUN sed -i 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/000-default.conf

# Permissões
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]